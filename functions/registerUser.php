<?php
include "../settings/connection.php";
global $conn;

function Register($data)
{
    $email = $data->email;
    $hashedPassword = $data->hashedPassword;
    $username = $data->username;
    $usertype = $data->usertype;
    $profilePic = null;
    $cv = null;
    $fname = $data->fname ?? null;
    $lname = $data->lname ?? null;
    $dob = $data->dob ?? null;
    $occup = $data->occup ?? null;
    $descrip = $data->descrip ?? null;
    $orgName = $data->org_name ?? null;
    $creationDate = $data->creation_date ?? null;
    $industry = $data->industry ?? null;
    $tagIds = $data->tagIds ?? null;

    return registerUser(
        $email,
        $hashedPassword,
        $username,
        $usertype,
        $profilePic,
        $cv,
        $fname,
        $lname,
        $dob,
        $occup,
        $descrip,
        $orgName,
        $creationDate,
        $industry,
        $tagIds
    );
}

function registerUser(
    $email,
    $hashedPassword,
    $username,
    $usertype,
    $profilePic = null,
    $cv = null,
    $fname = null,
    $lname = null,
    $dob = null,
    $occup = null,
    $descrip = null,
    $orgName = null,
    $creationDate = null,
    $industry = null,
    $tagIds = null
) {
    global $conn;

    // users table
    $query =
        "INSERT INTO users (profile_pic, email, passwd, username, usertype) VALUE (?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param(
        "sssss",
        $profilePic,
        $email,
        $hashedPassword,
        $username,
        $usertype
    );
    $create_record->execute();

    // get user_id
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];

    switch ($usertype) {
        case "JobSeeker":
            return registerJobSeeker(
                $user_id,
                $fname,
                $lname,
                $dob,
                $occup,
                $descrip,
                $cv
            );

        case "Employer":
            return registerEmployer(
                $user_id,
                $orgName,
                $creationDate,
                $industry,
                $tagIds
            );

        default:
            break;
    }
}

function registerJobSeeker($user_id, $fname, $lname, $dob, $occup, $descrip, $cv)
{
    global $conn;
    $query =
        "INSERT INTO job_seekers (user_id, fname, lname, date_of_birth, occupation, description, cv) VALUE (?, ?, ?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param(
        "issssss",
        $user_id,
        $fname,
        $lname,
        $dob,
        $occup,
        $descrip,
        $cv
    );
    return $create_record->execute();
}

function registerEmployer($user_id, $orgName, $creationDate, $industry, $tagIds)
{
    global $conn;
    $tag_ids_json = json_encode($tagIds);
    $query =
        "INSERT INTO employers (user_id, org_name, creation_date, industry, tag_ids) VALUE (?, ?, ?, ?, ?)";
    $create_record = $conn->prepare($query);
    $create_record->bind_param(
        "issss",
        $user_id,
        $orgName,
        $creationDate,
        $industry,
        $tag_ids_json
    );
    return $create_record->execute();
}
