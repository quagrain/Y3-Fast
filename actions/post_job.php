<?php

session_start();
// header("Content-Type: application/json");
include "../settings/connection.php";
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $formData = json_decode(file_get_contents("php://input"), true);

    $jobTitle = $_POST['jobTitle'];
    $jobDescription = $_POST['jobDescription'];
    $userId = $_SESSION['user_id'];
    $responsibility = $_POST['responsibility'];
    $experience = $_POST['experience'];
    $benefits = $_POST['benefits'];
    $vacancy = $_POST['vacancy'];
    $status = $_POST['status'];
    $jobLocation = $_POST['jobLocation'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];
    $applicationDeadline = $_POST['applicationDeadline'];

    // Define upload directories
    $featuredImgDir = "../uploads/featured_img/";

    // Check and create directories if not exist
    if (!is_dir($featuredImgDir)) {
        mkdir($featuredImgDir, 0755, true);
    }

    // Initialize variables
    $featuredImgPath = "";

    if (isset($_FILES["featured_image"])) {
        if ($_FILES["featured_image"]["error"] === UPLOAD_ERR_OK) {
            // Validate file type and size
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $fileType = mime_content_type($_FILES["featured_image"]["tmp_name"]);
            $fileSize = $_FILES["featured_image"]["size"];
        
            if (!in_array($fileType, $allowedTypes)) {
                $response['message'] = "Invalid file type. Only JPG, JPEG, and PNG types are allowed.";
                echo json_encode($response);
                exit;
            }
        
            if ($fileSize > 5000000) { // 5MB limit
                $response['message'] = "File size exceeds the limit of 5MB.";
                echo json_encode($response);
                exit;
            }
        
            $featuredImgPath = $featuredImgDir . basename($_FILES["featured_image"]["name"]);
        
            if (!move_uploaded_file($_FILES["featured_image"]["tmp_name"], $featuredImgPath)) {
                $response['message'] = "Error uploading featured image.";
                echo json_encode($response);
                exit;
            }
        
            // Remove the first period from the filename if exists
            $firstPeriodPos = strpos($featuredImgPath, '.');
            if ($firstPeriodPos !== false) {
                $featuredImgPath = substr_replace($featuredImgPath, '', $firstPeriodPos, 1);
            }
            $response['message'] = "succesfully uploaded";
        } else {
            $response['message'] = "UPLOAD_ERR_OK is not ok lmao";
            echo json_encode($response);
            exit;
        }
        
        $response['message'] = '$_FILES["featured_image"] is set';

    } else {
        $response['message'] = '$_FILES["featured_image"] is not set';
        echo json_encode($response);
        exit;
    }

    // // Handle profile picture upload
    // if (isset($_FILES["featured_image"]) && $_FILES["featured_image"]["error"] === UPLOAD_ERR_OK) {
    //     $featuredImgPath = $featuredImgDir . basename($_FILES["featured_image"]["name"]);
    //     if (!move_uploaded_file($_FILES["featured_image"]["tmp_name"], $featuredImgPath)) {
    //         $response['message'] = "Error uploading featured image.";
    //         echo json_encode($response);
    //         exit;
    //     }

    //     $firstPeriodPos = strpos($featuredImgPath, '.');
    //     if ($firstPeriodPos !== false) {
    //         $featuredImgPath = substr_replace($featuredImgPath, '', $firstPeriodPos, 1);
    //     }
    // }

    // Prepare SQL query
    $sql = "INSERT INTO job_req (job_title, job_description, user_id, responsibility, experience, benefits, vacancy, status, job_location, salary, gender, application_deadline, featured_image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        'ssissssssssss',
        $jobTitle,
        $jobDescription,
        $userId,
        $responsibility,
        $experience,
        $benefits,
        $vacancy,
        $status,
        $jobLocation,
        $salary,
        $gender,
        $applicationDeadline,
        $featuredImgPath
    );

    if ($stmt->execute()) {
        $response = ["status" => 1, "message" => "Job posted successfully!", "redirect" => "./index.php"];
    } else {
        $response = ["status" => 0, "message" => "Failed to post job: " . $stmt->error];
    }
    $stmt->close();
    echo json_encode($response);
    exit();
} else {
    $response = ["status" => 0, "message" => "No data received"];
    echo json_encode($response);
    exit();
}

$conn->close();
exit();
