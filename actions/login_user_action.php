<?php
// TO BE EDITED
session_start();
include "../settings/connection.php";
global $conn;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT COUNT(*) AS email_count FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $emailCount = $row['email_count'];

    mysqli_stmt_free_result($stmt);

    if ($emailCount > 0) {
        $query = "SELECT User_ID, rid, passwd FROM Users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $hashedPasswordFromDatabase = $row['passwd'];

        // Verify the entered password against the stored hash
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            // Passwords match, login successful, set user_id & role
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['usertype'];
            if ($row['usertype']=='Admin') {
                header("location: ../admin/dashboard.php");
            } else if ($row['usertype']=='Jobseeker' || $row['usertype']=='Employer') {
                header("location: ");
            }
            exit();
        } else {
            // Passwords do not match, login failed
            header("location: ");
        }
        exit();
    } else {
        // Email does not exist, login failed
        header("location: ");
    }

    mysqli_stmt_free_result($stmt);
    $conn->close();
}

?>