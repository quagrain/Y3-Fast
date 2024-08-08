<?php

session_start();
include '../settings/connection.php';
global $conn;

$response = [
    "status" => 0,
    "message" => "",
    "redirect" => "."
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $profilePicDir = "../uploads/profile_pic/";
    $profilePicPath = "DEFAULT";

    if (isset($_POST["hasChangedPP"]) && $_POST["hasChangedPP"]) {
        $profilePicPath = "";
        if (!is_dir($profilePicDir)) {
            mkdir($profilePicDir, 0755, true);
        }

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
    }
    
    
    $cvDir = "../uploads/cv/";
    $cvPath = "DEFAULT";

    if (isset($_POST["hasChangedCV"]) && $_POST["hasChangedCV"]) {
        $cvPath = "";
        if (!is_dir($cvDir)) {
            mkdir($cvDir, 0755, true);
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
    }

    // Collect other form data
    if ($_SESSION['role']=='JobSeeker') {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $occupation = $_POST["occupation"];
        $description = $_POST["descrip"];
        $dob = $_POST["dob"];
    } else if ($_SESSION['role']=='Employer') {
        $orgName = $_POST["org_name"];
        $industry = $_POST["industry"];
        $creationDate = $_POST["creation_date"];
        $tagIds = $_POST["tagIds"];
        $tagIdsJson = $tagIds ? json_encode($tagIds) : null;
    }

    $userId = $_SESSION["user_id"];
    $usertype = $_SESSION['role'];
    

    if (isset($_POST['hasPassChanged']) && $_POST["hasPassChanged"]) {
        $hashedPassword = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Update the users table
        $sqlUsers = "UPDATE users SET profile_pic = ?, passwd = ? WHERE user_id = ?";
        $stmtUsers = $conn->prepare($sqlUsers);
        $stmtUsers->bind_param("ssi", $profilePicPath, $hashedPassword, $userId);
        $stmtUsers->execute();
    
        if ($usertype === 'JobSeeker') {
            // Update the job_seekers table
            $sqlJobSeekers = "UPDATE job_seekers SET fname = ?, lname = ?, date_of_birth = ?, description = ?, cv = ? WHERE user_id = ?";
            $stmtJobSeekers = $conn->prepare($sqlJobSeekers);
            $stmtJobSeekers->bind_param("sssssi", $fname, $lname, $dob, $description, $cvPath, $userId);
            $stmtJobSeekers->execute();
            $stmtJobSeekers->close();
        } else if ($usertype === 'Employer') {
            // Update the employers table
            $sqlEmployers = "UPDATE employers SET org_name = ?, industry = ?, creation_date = ?, tag_ids = ? WHERE user_id = ?";
            $stmtEmployers = $conn->prepare($sqlEmployers);
            $stmtEmployers->bind_param("ssssi", $orgName, $industry, $creationDate, $tagIdsJson, $userId);
            $stmtEmployers->execute();
            $stmtEmployers->close();
        }
    
        // Commit the transaction
        $conn->commit();
    
        $response['status'] = 1;
        $response['message'] = "Profile updated successfully!";
    
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        $response['message'] = "Database update failed: " . $e->getMessage();
    }
    
    // Clean up
    $stmtUsers->close();
    $conn->close();
}

echo json_encode($response);
exit();
