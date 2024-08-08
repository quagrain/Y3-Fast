<?php

include "./settings/connection.php";

function hasApplied($userId, $jobId): bool {
    global $conn;

    $sql = "SELECT COUNT(*) FROM applications WHERE user_id = ? AND job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $jobId);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    return $count > 0;
}
