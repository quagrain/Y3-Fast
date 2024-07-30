<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");

include "../settings/connection.php";
include '../functions/registerUser.php';
global $conn;

$user = json_decode( file_get_contents('php://input'), true );

$email = $user['email'];
$username = $user['username'];
$usertype = $user['usertype'];
$password1 = $user['passwd1'];
$password2 = $user['passwd2'];

if ($password1 != $password2) {
    $response = ["status" => 0, "message" => "passwords don't match", "redirect" => "../login/register.php"];
    echo json_encode($response);
    exit();
}

$hashedPassword = password_hash($password1, PASSWORD_DEFAULT);


$query = "INSERT INTO users (email, passwd, username, usertype) VALUE (?, ?, ?, ?)";
$create_record = $conn->prepare($query);
$create_record->bind_param('ssss', $email, $hashedPassword, $username, $usertype);
if ($create_record->execute()) {
    $response = ["status" => 1, "message" => "Registered successfully", "redirect" => "../login/login.php"];
} else {
    $response = ["status" => 0, "message" => "Registration failed", "redirect" => "../login/register.php"];
}
echo json_encode($response);
exit();
