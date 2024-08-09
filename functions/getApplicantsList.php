<?php

include 'settings/connection.php';

function getApplicantsList($start, $applicantsPerPage, $userId, $jobId)
{
    global $conn;

    $offset = $start - 1;

    $sql = "SELECT 
                jr.job_id, 
                jr.job_title, 
                jr.job_description, 
                jr.job_location, 
                jr.status, 
                jr.published_on, 
                e.org_name, 
                u.profile_pic, 
                u.username, 
                js.fname, 
                js.lname, 
                u.email, 
                a.date_of_application,
                a.status AS app_status,
                a.app_id,
                js.cv 
            FROM job_req jr 
            INNER JOIN employers e ON jr.user_id = e.user_id 
            INNER JOIN applications a ON jr.job_id = a.job_id 
            INNER JOIN users u ON a.user_id = u.user_id 
            INNER JOIN job_seekers js ON u.user_id = js.user_id
            WHERE jr.user_id = $userId AND jr.job_id = $jobId 
            ORDER BY a.date_of_application ASC
            LIMIT $offset, $applicantsPerPage";

    $result = $conn->query($sql);
    // echo $result;

    if ($result) {
        if ($result->num_rows > 0) {
            echo '<ul class="job-listings mb-5">';

            while ($row = $result->fetch_assoc()) {
                // Applicant details
                $applicantName = htmlspecialchars($row['fname'] . ' ' . $row['lname']);
                $applicantEmail = htmlspecialchars($row['email']);
                $dateOfApplication = htmlspecialchars($row['date_of_application']);
                $profilePic = htmlspecialchars($row['profile_pic']);

                // Display job listing with applicant details
                echo '<li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">';

                echo '<h3 id="appId" style="display: none;">' . $row['app_id'] . '</h3>';

                echo '<div class="applicant-logo">';
                echo '<img src="' . $profilePic . '" alt="Applicant Logo" class="img-fluid" width="100px" height="100px"/>';
                echo '</div>';

                echo '<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">';

                echo '<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0 mt-1">';
                echo '<h2>' . $applicantName . '</h2>';
                echo '<div><a href="mailto:' . $applicantEmail . '"style="color:#a91212 !important; border:none; background-color:transparent">' . $applicantEmail . '</a></div><br>';
                echo '<strong>' . $dateOfApplication . '</strong>';
                echo '</div>';

                echo '<div class="mb-3 mb-sm-0 custom-width w-50 mt-4">';
                echo '<span class="btn btn-outline-info dropdown" data-src=' . htmlspecialchars($row['cv']) . ' onclick="downloadCV(event)">Resume</span>';
                echo '</div>';

                echo '<div class="job-listing-meta">';
                echo '<span>
                    <select id="application_status_' . $row['app_id'] . '" class="application_status btn-danger p-2 mt-4 dropdown" onchange="changeButton(event, ' . $row['app_id'] . ')">';

                // Option for "Rejected"
                echo '<option value="Rejected" ';
                if ($row['app_status'] == 'Rejected') echo 'selected';
                echo '>Rejected</option>';

                // Option for "Accepted"
                echo '<option value="Accepted" ';
                if ($row['app_status'] == 'Accepted') echo 'selected';
                echo '>Accepted</option>';

                // Option for "Pending"
                echo '<option value="Pending" ';
                if ($row['app_status'] == 'Pending') echo 'selected';
                echo '>Pending</option>';

                echo '</select>
                    </span>';
                echo '</div>';

                echo '</li>';
            }

            echo '</ul>';
        } else {
            echo '<p>No applicants found.</p>';
        }
    } else {
        echo 'SQL ERROR: ';
    }

    // $stmt->close();
    $conn->close();
}

?>
