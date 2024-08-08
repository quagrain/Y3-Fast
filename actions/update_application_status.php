<?php
include '../settings/connection.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->appId) && isset($data->status)) {
    $appId = $data->appId;
    $status = $data->status;

    $sql = "UPDATE applications SET status = ? WHERE app_id = ?";

    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $status, $appId);
        if($stmt->execute()) {
            echo json_encode(["status" => 1, "message" => "Application status updated successfully."]);
        } else {
            echo json_encode(["status" => 0, "message" => "Failed to update application status."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => 0, "message" => "SQL preparation failed."]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => 0, "message" => "Invalid input."]);
}
?>
