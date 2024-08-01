<?php
include "../settings/connection.php";
global $conn;

function Register($data) {
    $email = $data['email'];
    $hashedPassword = $data['hashedPassword'];
    $username = $data['username'];
    $usertype = $data['usertype'];
    $profilePic=null;
    $cv=null;
    $fname=null;
    $lname=null;
    $dob=null;
    $occup=null;
    $descrip=null;
    $orgName=null;
    $creationDate=null;
    $industry=null;
    $tagIds=null;

    registerUser(
        $email,
        $hashedPassword,
        $username,
        $usertype,
        $profilePic=null,
        $cv=null,
        $fname=null,
        $lname=null,
        $dob=null,
        $occup=null,
        $descrip=null,
        $orgName=null,
        $creationDate=null,
        $industry=null,
        $tagIds=null
    );
}

function registerUser(
    $email,
    $hashedPassword,
    $username,
    $usertype,
    $profilePic=null,
    $cv=null,
    $fname=null,
    $lname=null,
    $dob=null,
    $occup=null,
    $descrip=null,
    $orgName=null,
    $creationDate=null,
    $industry=null,
    $tagIds=null
){
    global $conn;

    // users table
    $query = "INSERT INTO users (profile_pic, email, passwd, username, usertype, cv) VALUE (?, ?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param('ssssss', $profilePic, $email, $hashedPassword, $username, $usertype, $cv);
    $create_record->execute();

    // get user_id
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    $result2 = false; 

    switch ($usertype) {
        case 'JobSeeker':
            $result2 = registerJobSeeker($user_id, $fname, $lname, $dob, $occup, $descrip);
            break;
        
        case 'Employer':
            $result2 = registerEmployer($user_id, $orgName, $creationDate, $industry, $tagIds);
            break;
        
        default:
            break;
    }

    return $result2;
}

function registerJobSeeker($user_id, $fname, $lname, $dob, $occup, $descrip){
    global $conn;
    $query = "INSERT INTO job_seekers (user_id, fname, lname, date_of_birth, occupation, description) VALUE (?, ?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param('isssss', $user_id, $fname, $lname, $dob, $occup, $descrip);
    return $create_record->execute();
}

function registerEmployer($user_id, $orgName, $creationDate, $industry, $tagIds){
    global $conn;
    $query = "INSERT INTO employers (user_id, org_name, creation_date, industry, tag_ids) VALUE (?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param('issss', $user_id, $orgName, $creationDate, $industry, $tagIds);
    return $create_record->execute();
}
