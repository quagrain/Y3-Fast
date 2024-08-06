
<?php

include './settings/connection.php';

// Function to get tags for a specific job ID
function getTagsForJobId($jobId) {
    global $conn;

    $sql = "
        SELECT employers.tag_ids 
        FROM job_req 
        INNER JOIN employers 
        ON job_req.user_id = employers.user_id 
        WHERE job_req.job_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $jobId);
    $stmt->execute();
    $result = $stmt->get_result();
    $tagIds = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tagIds = $row['tag_ids'];
    }

    $stmt->close();
    return $tagIds;
}

// Function to get related job listings based on tag IDs
function getRelatedJobListings($tagIds, $currentJobId, $start, $jobsPerPage) {
    global $conn;

    $offset = $start - 1;

    // Convert tag IDs to array
    $tagIdsArray = json_decode($tagIds, true);
    if (!$tagIdsArray) {
        return [];
    }
    
    // Create a LIKE pattern for tags
    $relatedJobListings = [];
    foreach ($tagIdsArray as $tagId) {
        $sql = "
            SELECT 
                job_req.*, 
                employers.org_name, 
                employers.creation_date, 
                employers.industry, 
                employers.tag_ids,
                users.profile_pic
            FROM 
                job_req 
            INNER JOIN 
                employers 
            INNER JOIN
                users 
            ON 
                job_req.user_id = employers.user_id AND job_req.user_id = users.user_id 
            WHERE 
                employers.tag_ids LIKE CONCAT('%', ?, '%') 
                AND job_req.job_id != ?
            LIMIT $offset, $jobsPerPage";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $tagId, $currentJobId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $relatedJobListings[] = $row;
        }

        $stmt->close();
    }

    return array_unique($relatedJobListings, SORT_REGULAR); // Remove duplicates
}

function getNumRelatedJobs($jobId) {
    global $conn;

    $tagIds=getTagsForJobId($jobId);
    $currentJobId = $jobId;
    
    // Convert tag IDs to array
    $tagIdsArray = json_decode($tagIds, true);
    if (!$tagIdsArray) {
        return [];
    }
    
    // Create a LIKE pattern for tags
    $relatedJobListings = [];
    foreach ($tagIdsArray as $tagId) {
        $sql = "
            SELECT 
                job_req.*, 
                employers.org_name, 
                employers.creation_date, 
                employers.industry, 
                employers.tag_ids,
                users.profile_pic
            FROM 
                job_req 
            INNER JOIN 
                employers 
            INNER JOIN
                users 
            ON 
                job_req.user_id = employers.user_id AND job_req.user_id = users.user_id 
            WHERE 
                employers.tag_ids LIKE CONCAT('%', ?, '%') 
                AND job_req.job_id != ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $tagId, $currentJobId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows;
    }
}

// Function to get job listings with related jobs
function getJobWithRelatedListings($jobId, $start, $jobsPerPage) {
    // Fetch the tags for the given job ID
    $tagIds = getTagsForJobId($jobId);

    // Fetch related jobs based on the tags
    $relatedJobs = getRelatedJobListings($tagIds, $jobId, $start, $jobsPerPage);

    return $relatedJobs;
}