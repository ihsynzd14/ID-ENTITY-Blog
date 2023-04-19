<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateBlog.php");

$table = 'blogs';

$topics = selectAll('topics');
$users = selectAll('users');
$blogs = selectAll($table);

$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$published = "";
$userid = "";


if (isset($_GET['id'])) {
    $blog = selectOne($table, ['id' => $_GET['id']]);

    $id = $blog['id'];
    $title = $blog['title'];
    $body = $blog['body'];
    $topic_id = $blog['topic_id'];
    $published = $blog['published'];
    $userid = $blog['user_id'];
}

if (isset($_GET['delete_id'])) {
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Post eliminato con successo";
    $_SESSION['type'] = "success";
    header("location: " . BASE_URL . "/admin/blogs/index.php"); 
    exit();   
}


if (isset($_GET['published']) && isset($_GET['p_id'])) {
        $published = $_GET['published'];
        $p_id = $_GET['p_id'];
        $count = update($table, $p_id, ['published' => $published]);
        $_SESSION['message'] = "Lo stato del blog è cambiato!";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/blogs/index.php"); 
        exit();
}



if (isset($_POST['add-blog'])) {
     
    $errors = validateBlog($_POST);

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
       array_push($errors, "Blog immagine necessario");
    }
    if (count($errors) == 0) {
        unset($_POST['add-blog']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $blog_id = create($table, $_POST);
        $_SESSION['message'] = "Blog creato con successo";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/blogs/index.php"); 
        exit();    
    } else {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body =  mysqli_real_escape_string($conn, $_POST['body']);
        $topic_id = mysqli_real_escape_string($conn, $_POST['topic_id']);
        $published = mysqli_real_escape_string($conn, isset($_POST['published']) ? 1 : 0);
    }
}

if (isset($_POST['update-blog'])) {
     
    $errors = validateBlog($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Non è possibile caricare foto");
        }
    } else {
       array_push($errors, "Blog immagine necessario");
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-blog'], $_POST['id']);
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $blog_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Blog aggiornato con successo";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/blogs/index.php");       
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $coautore = $_POST['coautore'];
        $published = isset($_POST['published']) ? 1 : 0;
    }

}