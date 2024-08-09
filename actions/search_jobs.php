<?php

include '../settings/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jobTitle = $_POST['job_title'] ?? '';
    $location = $_POST['location'] ?? '';
    $jobType = $_POST['job_type'] ?? '';
    $start = 1;
    $jobsPerPage = 7;

    $sql = "SELECT job_req.job_id, job_req.job_title, job_req.job_description, job_req.job_location, job_req.status, job_req.published_on, employers.org_name, users.profile_pic 
            FROM job_req 
            INNER JOIN employers ON job_req.user_id = employers.user_id 
            INNER JOIN users ON job_req.user_id = users.user_id 
            WHERE 1=1";

    if (!empty($jobTitle)) {
        $sql .= " AND (job_req.job_title LIKE '%$jobTitle%' OR employers.org_name LIKE '%$jobTitle%')";
    }

    if (!empty($location)) {
        $sql .= " AND job_req.job_location LIKE '%$location%'";
    }

    if (!empty($jobType)) {
        $sql .= " AND job_req.job_type = '$jobType'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">';
            echo '<a href="job-single.php?job_id=' . $row['job_id'] . '"></a>';
            echo '<div class="job-listing-logo">';
            echo '<img src="' . $row['profile_pic'] . '" alt="Job Logo" class="img-fluid" width="150px" height="150px"/>';
            echo '</div>';
            echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';
            echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">';
            echo '<h2>' . $row['job_title'] . '</h2>';
            echo '<strong>' . $row['org_name'] . '</strong>';
            echo '</div>';
            echo '<div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">';
            echo '<span class="icon-room"></span> ' . $row['job_location'];
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span class="badge badge-danger">' . $row['status'] . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</li>';
        }
    } else {
        echo '<p>No job listings found.</p>';
    }

    $conn->close();
}
?>
