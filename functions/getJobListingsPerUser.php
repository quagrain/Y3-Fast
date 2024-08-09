<?php

// Include the database connection file
include 'settings/connection.php';

function getAppliedJobListings($start, $jobsPerPage, $jobSeekerId)
{
    global $conn;

    $offset = $start - 1;

    // Fetch job listings that the job seeker has applied to
    $sql = "SELECT 
                job_req.job_id, 
                job_req.job_title, 
                job_req.job_description, 
                job_req.job_location, 
                job_req.status, 
                job_req.published_on, 
                employers.org_name, 
                users.profile_pic,
                applications.status AS app_status 
            FROM 
                job_req 
            INNER JOIN 
                applications ON job_req.job_id = applications.job_id
            INNER JOIN 
                employers ON job_req.user_id = employers.user_id
            INNER JOIN 
                users ON job_req.user_id = users.user_id
            WHERE 
                applications.user_id = ? 
            LIMIT 
                ?, ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $jobSeekerId, $offset, $jobsPerPage);
    $stmt->execute();
    $result = $stmt->get_result();

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
            echo '<a href="job-single.php?job_id=' . $jobId . '"></a>';
            echo '<div class="job-listing-logo">';
            echo '<img src="' . htmlspecialchars($row['profile_pic']) . '" alt="Job Logo" width="150px" height="150px"/>';
            echo '</div>';
            echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';
            echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">';
            echo '<h2>' . htmlspecialchars($jobTitle) . '</h2>';
            echo '<strong>' . htmlspecialchars($orgName) . '</strong>';
            echo '</div>';
            echo '<div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">';
            echo '<span class="icon-room"></span> ' . htmlspecialchars($jobLocation);
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span class="badge badge-danger">' . htmlspecialchars($status) . '</span>';
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span class="badge badge-danger">' . htmlspecialchars($row['app_status']) . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p>No job listings found that you have applied to.</p>';
    }

    $stmt->close();
    $conn->close();
}

function getNumJobsAppliedTo($jobSeekerId)
{
    global $conn;

    // SQL query to count the number of job applications for the job seeker
    $sql = "SELECT COUNT(*) AS num_applied FROM applications WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobSeekerId);
    $stmt->execute();
    $stmt->bind_result($numApplied);
    $stmt->fetch();

    $stmt->close();

    return $numApplied;
}


function getNumJobsApproved($jobSeekerId)
{
    global $conn;

    // SQL query to count the number of approved job applications for the job seeker
    $sql = "SELECT COUNT(*) AS num_approved FROM applications WHERE user_id = ? AND status = 'Accepted'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobSeekerId);
    $stmt->execute();
    $stmt->bind_result($numApproved);
    $stmt->fetch();

    $stmt->close();

    return $numApproved;
}

