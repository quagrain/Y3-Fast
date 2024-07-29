<?php
include "../settings/connection.php";
global $conn;

function registerUser(
    $profilePic=null,
    $email,
    $hashedPassword,
    $username,
    $usertype,
    $cv=null
){
    global $conn;
    $query = "INSERT INTO users (profile_pic, email, passwd, username, usertype, cv) VALUE (?, ?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param('ssssss', $profilePic, $email, $hashedPassword, $username, $usertype, $cv);
    return $create_record->execute();
}

function registerJobSeeker(){}

function registerEmployer(){}
