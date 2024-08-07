<?php

include_once '../settings/connection.php';

function getProfileData($user_id, $usertype) {
    global $conn;

    $sql = "";

    switch ($usertype) {
        case 'JobSeeker':
            $sql = "SELECT u.user_id, u.profile_pic, u.email, u.username, js.fname, js.lname, js.date_of_birth, js.occupation, js.description, js.cv 
                    FROM users u
                    JOIN job_seekers js ON u.user_id = js.user_id
                    WHERE u.user_id = ?";
            break;
        
        case 'Employer':
            $sql = "SELECT u.user_id, u.profile_pic, u.email, u.username, e.org_name, e.creation_date, e.industry, e.tag_ids
                    FROM users u
                    JOIN employers e ON u.user_id = e.user_id
                    WHERE u.user_id = ?";
            break;
        
        default:
            return null;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
