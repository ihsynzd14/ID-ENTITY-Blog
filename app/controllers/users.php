<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");


$table = 'users';

$admin_users = selectAll($table);

$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$nome = '';
$cognome = '';
$dataNascita = '';
$biografia = '';
$password = '';
$passwordConf = '';


function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['message'] = 'Hai già effettuato l`accesso';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . '/index.php'); 
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = 'Admin già creato';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/admin/users/index.php?id='.$_SESSION['id'].''); 
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            loginUser($user);
        }
    } else {
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $admin = mysqli_real_escape_string($conn, isset($_POST['admin']) ? 1 : 0);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
        $dataNascita = mysqli_real_escape_string($conn, $_POST['dataNascita']);
        $biografia = mysqli_real_escape_string($conn, $_POST['biografia']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $passwordConf = mysqli_real_escape_string($conn, $_POST['passwordConf']);
    }
}

if (isset($_POST['update-user'])) {
     
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = 'Informazioni del utente Aggiornato';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/index.php'); 
        exit();
        
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $admin = mysqli_real_escape_string($conn, isset($_POST['admin']) ? 1 : 0);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $passwordConf = mysqli_real_escape_string($conn, $_POST['passwordConf']);
    }
}


if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $user['id'];
    $username = $user['username'];
    $admin = $user['admin'];
    $email = $user['email'];
}


if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        } else {
           array_push($errors, 'Credenziali Errate');
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
}

if (isset($_GET['delete_id'])) {
    if ($_SESSION['admin'] == 1) {
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'Admin eliminato un utente';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/users/index.php?id='.$_SESSION['id'].''); 
    }
    else {
        $count = delete($table, $_GET['delete_id']);
        $_SESSION['message'] = 'Utente eliminato';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/logout.php'); 
        exit();
    }
    
}