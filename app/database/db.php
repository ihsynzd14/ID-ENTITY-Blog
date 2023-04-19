<?php

session_start();
require('connect.php');



function dd($value) // to be deleted
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}


function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}


function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";

    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}


function create($table, $data)
{
    global $conn;
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}



function update($table, $id, $data)
{
    global $conn;
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}



function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";

    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}


function getPublishedBlogs()
{
    global $conn;
    $sql = "SELECT b.*, u.username FROM blogs AS b JOIN users AS u ON b.user_id=u.id WHERE b.published=? ORDER BY created_at DESC";

    $stmt = executeQuery($sql, ['published'=>1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


function getPublishedPosts()
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? ORDER BY created_at DESC";

    $stmt = executeQuery($sql, ['published'=>1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getArchivedPosts()
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQuery($sql, ['published'=> 0]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getArchivedBlogs()
{
    global $conn;
    $sql = "SELECT b.*, u.username FROM blogs AS b JOIN users AS u ON b.user_id=u.id WHERE b.published=?";

    $stmt = executeQuery($sql, ['published'=> 0]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


function getBlogsByTopicId($topic_id)
{
    global $conn;
    $sql = "SELECT b.*, u.username FROM blogs AS b JOIN users AS u ON b.user_id=u.id WHERE b.published=? AND topic_id=?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}



function searchPosts($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "SELECT 
            p.*, u.username 
            FROM posts AS p 
            JOIN users AS u 
            ON p.user_id=u.id 
            WHERE p.published=?
            AND p.title LIKE ?";


    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}