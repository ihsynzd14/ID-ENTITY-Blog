<?php


function validateBlog($blog)
{
    $errors = array();

    if (empty($blog['title'])) {
        array_push($errors, 'Devi mettere il titolo');
    }

    if (empty($blog['body'])) {
        array_push($errors, 'Devi mettere la descrizione');
    }

    if (empty($blog['topic_id'])) {
        array_push($errors, 'Devi scegliere un argomento');
    }
    
    $existingPost = selectOne('posts', ['title' => $blog['title']]);
    if ($existingPost) {
        if (isset($blog['update-post']) && $existingPost['id'] != $blog['id']) {
            array_push($errors, 'Post con questo titolo già esiste');
        }

        if (isset($blog['add-post'])) {
            array_push($errors, 'Post con questo titolo già esiste');
        }
    }

    return $errors;
}
