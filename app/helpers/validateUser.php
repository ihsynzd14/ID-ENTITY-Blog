<?php

function validateUser($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username richiesto');
    }

    if (empty($user['email'])) {
        array_push($errors, 'Email richiesta');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password richiesta');
    }

    if (empty($user['nome'])) {
        array_push($errors, 'Nome richiesto');
    }

    if (empty($user['cognome'])) {
        array_push($errors, 'Cognome richiesto');
    }

    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'La password non corrisponde');
    }
    if (!preg_match("/^[\w]*$/",$user['username'])) {
        array_push($errors, "Solo lettere e numeri ammessi (username)"); 
    }

    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$user['email'])) {
        array_push($errors, "Formato non valido per email");
    } 

    if (!preg_match("/^[a-zA-Z]*$/",$user['nome'])) {
        array_push($errors, "Solo lettere ammesse (nome)"); 
    }

    if (!preg_match("/^[a-zA-Z]*$/",$user['cognome'])) {
        array_push($errors, "Solo lettere ammesse (cognome)"); 
    }


    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if ($existingUser['id'] != $user['id']) {
            array_push($errors, 'Email già utilizzata');
        }

        if (isset($user['create-admin'])) {
            array_push($errors, 'Email già utilizzata');
        }
    }

    return $errors;
}


function validateLogin($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username richiesto');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password richiesta');
    }

    return $errors;
}