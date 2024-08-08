<?php

include "../settings/connection.php";
header('Content-Type: application/json');
global $conn;

$response = ["status" => 0, "message" => "default msg", "redirect" => "."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $userId = $data['userId'];
    $jobId = $data['jobId'];
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
}

$conn->close();
echo json_encode($response);
exit();
