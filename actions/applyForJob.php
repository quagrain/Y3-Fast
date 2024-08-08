<?php

include "../settings/connection.php";
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userID'];
    $jobId = $_POST['jobId'];
    $sql = "INSERT INTO applications (job_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ii',
        $jobId,
        $userId
    );
    if ($stmt->execute()) {
        $response = ["status" => 1, "message" => "Job Applied successfully!", "redirect" => "./index.php"];
    } else {
        $response = ["status" => 0, "message" => "Failed to apply: " . $stmt->error];
    }
    $stmt->close();
    echo json_encode($response);
}

$conn->close();
exit();
