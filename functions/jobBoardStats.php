<?php

include './settings/connection.php';

function getNumCandidates(){
    global $conn;
    $query = "SELECT COUNT(user_id) AS num_count FROM job_seekers";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numCandidates = $row['num_count'];
    return $numCandidates;
}

function getNumJobsPosted(){
    global $conn;
    $query = "SELECT COUNT(job_id) AS num_count FROM job_req";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numJobsPosted = $row['num_count'];
    return $numJobsPosted;
}

function getNumJobsFilled(){
    global $conn;
    $query = "SELECT COUNT(app_id) AS num_count FROM applications";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numJobsFilled = $row['num_count'];
    return $numJobsFilled;
}

function getNumCompanies(){
    global $conn;
    $query = "SELECT COUNT(org_name) AS num_count FROM employers";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $numCompanies = $row['num_count'];
    return $numCompanies;
}
