<?php

// Include the database connection file
include 'settings/connection.php';

function getJobListings($start, $jobsPerPage, $userId)
{
    global $conn;

    $offset = $start - 1;

    // Fetch job listings from the database with the organization name
    $sql = "SELECT job_req.job_id, job_req.job_title, job_req.job_description, job_req.job_location, job_req.status, job_req.published_on, employers.org_name, users.profile_pic 
            FROM job_req 
            INNER JOIN employers 
            INNER JOIN users 
            ON job_req.user_id = employers.user_id AND job_req.user_id = users.user_id 
            WHERE job_req.user_id = $userId 
            LIMIT $offset, $jobsPerPage";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul class="job-listings mb-5">';

        while ($row = $result->fetch_assoc()) {
            // Job details
            $jobId = $row['job_id'];
            $jobTitle = $row['job_title'];
            $jobDescription = $row['job_description'];
            $jobLocation = $row['job_location'];
            $status = $row['status'];
            $publishedOn = $row['published_on'];
            $orgName = $row['org_name'];

            // Display job listing
            echo '<li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">';
            echo '<a href="applications.php?job_id=' . $jobId . '"></a>';
            echo '<div class="job-listing-logo">';
            echo '<img src=' . $row['profile_pic'] . '" alt="Job Logo" class="" width="150px" height="150px"/>';
            echo '</div>';
            echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';
            echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">';
            echo '<h2>' . $jobTitle . '</h2>';
            echo '<strong>' . $orgName . '</strong>';
            echo '</div>';
            echo '<div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">';
            echo '<span class="icon-room"></span> ' . $jobLocation;
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span class="badge badge-danger">' . $status . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p>No job listings found.</p>';
    }

    $conn->close();
}
