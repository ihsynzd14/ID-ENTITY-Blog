<?php


function validatePost($post)
{
    $errors = array();

    if (empty($post['title'])) {
        array_push($errors, 'Devi mettere il titolo');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Devi mettere la descrizione');
    }

    if (empty($post['blog_id'])) {
        array_push($errors, 'Devi scegliere un blog');
    }
    
    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost) {
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Post con questo titolo già esiste');
        }

        if (isset($post['add-post'])) {
            array_push($errors, 'Post con questo titolo già esiste');
        }
    }

    return $errors;
}