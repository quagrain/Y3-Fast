<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");

header("Content-Type: application/json");

include "../settings/connection.php";
include "../functions/registerUser.php";
global $conn;

$user = json_decode(file_get_contents("php://input"), true);

$err;
$response = [];

// const Data = {
//     email: email,
//     username: username,
//     usertype: usertype,
//     passwd1: password,
//     passwd2: rePassword,
//     fname: fname,
//     lname: lname,
//     dob: dob,
//     occup: occup,
//     descrip: occup,
//     org_name: org_name,
//     creation_date: creation_date,
//     industry: industry,
//     tagIds: {}
// };

$data = new stdClass();

$data->email = $user["email"];
$data->username = $user["username"];
$data->usertype = $user["usertype"];

$password1 = $user["passwd1"];
$password2 = $user["passwd2"];

if ($data->usertype == "JobSeeker") {
    $data->fname = $user["fname"];
    $data->lname = $user["lname"];
    $data->dob = $user["dob"];
    $data->occup = $user["occup"];
    $data->descrip = $user["descrip"];
} elseif ($data->usertype == "Employer") {
    $data->org_name = $user["org_name"];
    $data->creation_date = $user["creation_date"];
    $data->industry = $user["industry"];
    $data->tagIds = $user["tagIds"];
}

if ($password1 != $password2) {
    $err = new Error("passwords don't match");
    $response = [
        "status" => 0,
        "message" => $err->getMessage(),
        "redirect" => "./register.php"
    ];
    echo json_encode($response);
    exit();
}

$data->hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

// $query = "INSERT INTO users (email, passwd, username, usertype) VALUE (?, ?, ?, ?)";
// $create_record = $conn->prepare($query);
// $create_record->bind_param('ssss', $email, $hashedPassword, $username, $usertype);
// if ($create_record->execute()) {
//     $response = ["status" => 1, "message" => "Registered successfully", "redirect" => "../login/login.php"];
// } else {
//     $response = ["status" => 0, "message" => "Registration failed", "redirect" => "../login/register.php"];
// }

if (Register($data)) {
    $response = [
        "status" => 1,
        "message" => "Registered successfully",
        "redirect" => "./login.php"
    ];
} else {
    $err = new Error("Registration failed");
    $response = [
        "status" => 0,
        "message" => $err->getMessage(),
        "redirect" => "./register.php"
    ];
}

echo json_encode($response);
exit();
