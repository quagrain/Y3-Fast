<?php
// TO BE EDITED
session_start();
include "../settings/connection.php";
global $conn;

if (isset($_POST['sign-up-button'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['first-name-input']);

    $lname = mysqli_real_escape_string($conn, $_POST['last-name-input']);

    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $dob = mysqli_real_escape_string($conn, $_POST['date-of-birth']);

    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $phone_num = mysqli_real_escape_string($conn, $_POST['phone-number']);

    $email = mysqli_real_escape_string($conn, $_POST['email-input']);

    $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    if ($password1 != $password2) {
        echo '<script>alert("passwords do not match");</script>';
        echo '<script>window.location.href="../login/register.php";</script>';
        exit();
    }

    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

    $query = "INSERT INTO Users (fname, lname, gender, dob,  email, passwd, tel, address, rid) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $create_record = $conn->prepare($query);
    $rid = 3;
    $create_record->bind_param('ssssssssi', $fname, $lname, $gender, $dob, $email, $hashedPassword, $phone_num, $address, $rid);

    $create_record->execute();


    if ($create_record->affected_rows > 0) {
        echo '<script>window.location.href="../login/login.php";</script>';
        exit();
    } else {
        echo '<script>alert("Couldn\'t register. An error occurred.")</script>';
        echo '<script>window.location.href="../login/register.php";</script>';
    }

    $create_record->close();
    $conn->close();
}


?>