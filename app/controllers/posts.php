<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'posts';
$topics = selectAll('topics');
$blogs = selectAll('blogs');
$posts = selectAll($table);

$errors = array();
$id = "";
$title = "";
$body = "";
$blog_id = "";
$published = "";



if (isset($_GET['id'])) { 
    $post = selectOne($table, ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $blog_id = $post['blog_id'];
    $published = $post['published'];
    $uid = $post['user_id'];
}

if (isset($_GET['delete_id'])) {
        $count = delete($table, $_GET['delete_id']);
        $_SESSION['message'] = "Post eliminato con successo";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php"); 
        exit();   
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
      
        $published = $_GET['published'];
        $p_id = $_GET['p_id'];
        $count = update($table, $p_id, ['published' => $published]);
        $_SESSION['message'] = "Lo stato del post è cambiato!";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php"); 
        exit();

}



if (isset($_POST['add-post'])) {
     
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Non è possibile caricare immagine");
        }
    } else {
       array_push($errors, "Necessario mettere immagine per post");
    }
    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Post creato con successo";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php"); 
        exit();    
    } else {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $blog_id = mysqli_real_escape_string($conn, $_POST['blog_id']);
        $published = mysqli_real_escape_string($conn, isset($_POST['published']) ? 1 : 0);
    }
}


if (isset($_POST['update-post'])) {
     
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Non è possibile caricare la foto");
        }
    } else {
       array_push($errors, "Immagine per post neccessaria");
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Post aggiornato con successo";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php");       
    } else {
        $title =  mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn,  $_POST['body']);
        $blog_id = mysqli_real_escape_string($conn, $_POST['blog_id']);
        $published = mysqli_real_escape_string($conn, isset($_POST['published']) ? 1 : 0);
    }

}