<?php

include './settings/connection.php';

function getNumApplicantsPerJob($userId, $jobId) {
    global $conn;
    
    $query = "
        SELECT COUNT(a.app_id) AS num_count
        FROM applications a
        JOIN job_req j ON a.job_id = j.job_id
        WHERE j.user_id = ? AND j.job_id = ?
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $jobId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numApplicants = $row['num_count'];
    
    $stmt->close();
    
    return $numApplicants;
}