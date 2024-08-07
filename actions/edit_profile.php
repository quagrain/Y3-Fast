<?php

session_start();
include '../settings/connection.php';
global $conn;

$response = [
    "status" => 0,
    "message" => "",
    "redirect" => "./profile.php"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Define upload directories
    $profilePicDir = "../uploads/profile_pic/";
    $cvDir = "../uploads/cv/";

    // Check and create directories if not exist
    if (!is_dir($profilePicDir)) {
        mkdir($profilePicDir, 0755, true);
    }
    if (!is_dir($cvDir)) {
        mkdir($cvDir, 0755, true);
    }

    // Initialize variables
    $profilePicPath = "";
    $cvPath = "";

    // Handle profile picture upload
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK) {
        $profilePicPath = $profilePicDir . basename($_FILES["profile_picture"]["name"]);
        if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profilePicPath)) {
            $response['message'] = "Error uploading profile picture.";
            echo json_encode($response);
            exit;
        }

        // Remove the first period '.' in $profilePicPath
        $firstPeriodPos = strpos($profilePicPath, '.');
        if ($firstPeriodPos !== false) {
            $profilePicPath = substr_replace($profilePicPath, '', $firstPeriodPos, 1);
        }
    }

    // Handle CV upload
    if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === UPLOAD_ERR_OK) {
        $cvPath = $cvDir . basename($_FILES["cv"]["name"]);
        if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $cvPath)) {
            $response['message'] = "Error uploading CV.";
            echo json_encode($response);
            exit;
        }

        $firstPeriodPos = strpos($cvPath, '.');
        if ($firstPeriodPos !== false) {
            $cvPath = substr_replace($cvPath, '', $firstPeriodPos, 1);
        }
    }

    // Collect other form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $description = $_POST["descrip"];
    $dob = $_POST["dob"];
    $userId = $_SESSION["user_id"];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Update users table
        $sqlUsers = "UPDATE users SET profile_pic=? WHERE user_id=?";
        $stmtUsers = $conn->prepare($sqlUsers);
        $stmtUsers->bind_param("si", $profilePicPath, $userId);
        $stmtUsers->execute();

        // Update job_seekers table
        $sqlJobSeekers = "UPDATE job_seekers SET fname=?, lname=?, date_of_birth=?, description=?, cv=? WHERE user_id=?";
        $stmtJobSeekers = $conn->prepare($sqlJobSeekers);
        $stmtJobSeekers->bind_param("sssssi", $fname, $lname, $dob, $description, $cvPath, $userId);
        $stmtJobSeekers->execute();

        // Commit the transaction
        $conn->commit();

        $response['status'] = 1;
        $response['message'] = "Profile updated successfully!";

    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        $response['message'] = "Database update failed: " . $e->getMessage();
    }

    $stmtUsers->close();
    $stmtJobSeekers->close();
    $conn->close();

}

echo json_encode($response);
exit();
