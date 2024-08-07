<?php

// Include the database connection file
include 'settings/connection.php';

function getJobListings($start, $jobsPerPage) {
    global $conn;

    $offset = $start - 1;

    // Fetch job listings from the database with the organization name
    $sql = "SELECT job_req.job_id, job_req.job_title, job_req.job_description, job_req.job_location, job_req.status, job_req.published_on, employers.org_name 
            FROM job_req 
            JOIN employers ON job_req.user_id = employers.user_id
            LIMIT $offset, $jobsPerPage";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul class="job-listings mb-5">';
        
        while($row = $result->fetch_assoc()) {
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
            echo '<a href="job-single.php?job_id='.$jobId.'"></a>';
            echo '<div class="job-listing-logo">';
            echo '<img src="images/job_logo_1.jpg" alt="Job Logo" class="img-fluid" />';
            echo '</div>';
            echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';
            echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">';
            echo '<h2>'.$jobTitle.'</h2>';
            echo '<strong>'.$orgName.'</strong>';
            echo '</div>';
            echo '<div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">';
            echo '<span class="icon-room"></span> '.$jobLocation;
            echo '</div>';
            echo '<div class="job-listing-meta">';
            echo '<span class="badge badge-danger">'.$status.'</span>';
            echo '</div>';
            echo '</div>';
            echo '</li>';
        }
        
        echo '</ul>';
    } else {
        echo '<p>No job listings found.</p>';
    }

    // $conn->close();
}

// <ul class="job-listings mb-5">
//     <li
//         class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center"
//     >
//         <a href="job-single.php"></a>
//         <div class="job-listing-logo">
//             <img
//                 src="images/job_logo_1.jpg"
//                 alt="Free Website Template by Free-Template.co"
//                 class="img-fluid"
//             />
//         </div>

//         <div
//             class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4"
//         >
//             <div
//                 class="job-listing-position custom-width w-50 mb-3 mb-sm-0"
//             >
//                 <h2>Product Designer</h2>
//                 <strong>Adidas</strong>
//             </div>
//             <div
//                 class="job-listing-location mb-3 mb-sm-0 custom-width w-25"
//             >
//                 <span class="icon-room"></span> New York,
//                 New York
//             </div>
//             <div class="job-listing-meta">
//                 <span class="badge badge-danger"
//                     >Part Time</span
//                 >
//             </div>
//         </div>
//     </li>
// </ul>
