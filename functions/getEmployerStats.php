<?php

include './settings/connection.php';

function getEmployer($user_id) {
    global $conn;
    
    // Prepare the SQL statement with a JOIN to include employer information
    $sql = "
        SELECT 
            employers.org_name, 
            employers.creation_date, 
            employers.industry, 
            employers.tag_ids 
        FROM 
            employers  
        WHERE 
            employers.user_id = ?";
    
    // Initialize a statement and prepare it
    $stmt = $conn->prepare($sql);
    
    // Bind the job_id parameter to the statement
    $stmt->bind_param("i", $user_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the data
    if ($result->num_rows > 0) {
        $emp = $result->fetch_assoc();
    } else {
        $emp = null;
    }
    
    // Close the statement
    $stmt->close();
    
    return $emp;

}

function getEmpNumCandidates(){
    global $conn;
    $query = "SELECT COUNT(user_id) AS num_count FROM job_seekers";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numCandidates = $row['num_count'];
    return $numCandidates;
}

function getEmpNumJobsPosted($userId){
    global $conn;
    $query = "SELECT COUNT(job_id) AS num_count FROM job_req WHERE user_id=$userId";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numJobsPosted = $row['num_count'];
    return $numJobsPosted;
}

function getEmpNumJobsFilled($userId) {
    global $conn;
    $query = "
        SELECT COUNT(a.app_id) AS num_count
        FROM applications a
        JOIN job_req j ON a.job_id = j.job_id
        WHERE j.user_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numJobsFilled = $row['num_count'];
    return $numJobsFilled;
}
