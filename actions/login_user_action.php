<?php
// TO BE EDITED
session_start();
include "../settings/connection.php";
global $conn;

$response = [
    "status" => 0,
    "message" => "default msg",
    "redirect" => "../"
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);


    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['passwd']);

    $query = "SELECT COUNT(*) AS email_count FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $emailCount = $row['email_count'];

    mysqli_stmt_free_result($stmt);

    if ($emailCount > 0) {
        $query = "SELECT user_id, usertype, email, passwd FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $hashedPasswordFromDatabase = $row['passwd'];

        $hashed= password_hash('securepassword123', PASSWORD_DEFAULT);

        // Verify the entered password against the stored hash
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            // Passwords match, login successful, set user_id & role
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['usertype'];
            if ($row['usertype']=='Admin') {
                $response = ["status" => 1, "message" => "login successful1", "redirect" => "../view/dashboard.php"];
            } else if ($row['usertype']=='Jobseeker' || $row['usertype']=='Employer') {
                $response = ["status" => 1, "message" => "login successful2", "redirect" => "../view/dashboard.php"];
            }
        } else {
            // Passwords do not match, login failed
            $response = ["status" => 0, "message" => $hashed, "redirect" => "../view/dashboard.php"];
        }
        echo json_encode($response);
        exit();
    } else {
        // Email does not exist, login failed
        $response = ["status" => 0, "message" => "login failed2", "redirect" => "../view/dashboard.php"];
    }

    mysqli_stmt_free_result($stmt);
    $conn->close();
    echo json_encode($response);
    exit();
}

?>