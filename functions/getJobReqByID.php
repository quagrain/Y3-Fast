<?php
include './settings/connection.php';

function getJobReqByID($job_id) {
    global $conn;
    
    // Prepare the SQL statement with a JOIN to include employer information
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
            job_req.job_id = ?";
    
    // Initialize a statement and prepare it
    $stmt = $conn->prepare($sql);
    
    // Bind the job_id parameter to the statement
    $stmt->bind_param("i", $job_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the data
    if ($result->num_rows > 0) {
        $job_req = $result->fetch_assoc();
    } else {
        $job_req = null;
    }
    
    // Close the statement
    $stmt->close();
    
    return $job_req;
}
?>
