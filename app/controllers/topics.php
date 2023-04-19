<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);


if (isset($_POST['add-topic'])) {
     
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-topic']);
        $topic_id = create($table, $_POST);
        $_SESSION['message'] = 'Argomento già creato con successo';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit(); 
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]); // si deve fare un controllo

}

if (isset($_GET['del_id'])) {
    if($_SESSION['id'] == $userid || $_SESSION['admin'] == 1){
        $id = $_GET['del_id'];
        $count = delete($table, $id);
        $_SESSION['message'] = 'Argomento già eliminato';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
    else{
        header("Location: /blog/404.php");
    }
    
}


if (isset($_POST['update-topic'])) {
     
    $errors = validateTopic($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Argomento aggiornato con successo';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn,  $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
    }

}
