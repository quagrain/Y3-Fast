<?php
include '../settings/connection.php';
global $conn;

function registerNewUser(
    $profilePic=null,
    $email,
    $hashedPassword,
    $username,
    $usertype,
    $cv=null
){
    $query = "INSERT INTO users (email, passwd, username, usertype) VALUE (?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param('ssss', $email, $hashedPassword, $username, $usertype);
    return $create_record->execute();
}
