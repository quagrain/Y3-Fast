<?php

include '../settings/connection.php';

function getAllTags() {

    global $conn;

    $query = "SELECT * FROM tags";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
    
}

function getTagID($tag_name) {

    global $conn;

    $query = "SELECT tag_id FROM tags WHERE tag_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tag_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result){
        $row = $result->fetch_assoc();
        $tag_id = $row['tag_id'];
        return $tag_id;
    }

    return $result;

}

function addNewTag($tagName) {
    global $conn;

    $query = "INSERT INTO tags (tag_name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tagName);

    if ($stmt->execute()) {
        return $stmt->insert_id; // Return the ID of the newly inserted tag
    } else {
        return false; // Return false on failure
    }
}