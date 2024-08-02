<?php

session_start();
header("Content-Type: application/json");
include "../settings/connection.php";
global $conn;

$formData = json_decode(file_get_contents("php://input"), true);

if (isset($formData)) {
    $jobTitle = $formData['jobTitle'];
    $jobDescription = $formData['jobDescription'];
    $userId = $_SESSION['user_id'];
    $responsibility = $formData['responsibility'];
    $experience = $formData['experience'];
    $benefits = $formData['benefits'];
    $vacancy = $formData['vacancy'];
    $status = $formData['status'];
    $jobLocation = $formData['jobLocation'];
    $salary = $formData['salary'];
    $gender = $formData['gender'];
    $applicationDeadline = $formData['applicationDeadline'];

    // Handle file upload
    $targetDir = "uploads/";
    $featuredImage = null;
    if (!empty($_FILES['featuredImage']['name'])) {
        $featuredImage = $targetDir . basename($_FILES["featuredImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($featuredImage, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["featuredImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($featuredImage)) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["featuredImage"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $response = ["status" => 0, "message" => "Sorry, your file was not uploaded."];
            echo json_encode($response);
            exit();
        } else {
            if (!move_uploaded_file($_FILES["featuredImage"]["tmp_name"], $featuredImage)) {
                $response = ["status" => 0, "message" => "Sorry, there was an error uploading your file."];
                echo json_encode($response);
                exit();
            }
        }
    }

    // Prepare SQL query
    $sql = "INSERT INTO job_req (job_title, job_description, user_id, responsibility, experience, benefits, vacancy, status, job_location, salary, gender, application_deadline) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssissdss",
        $jobTitle, $jobDescription, $userId, $responsibility, $experience, $benefits, $vacancy, $status, $jobLocation, $salary, $gender, $applicationDeadline);

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
