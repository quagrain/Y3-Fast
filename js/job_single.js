function handleJobApplication($userId, $jobId) {
    var Data = {
        'userId': $userId,
        'jobId': $jobId
    }

    fetch("./actions/applyForJob.php", {
        method: "POST",
        body: JSON.stringify(Data),
    })
    .then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok: " + response.statusText);
        }
        return response.json();
    })
    .then((response) => {
        if (response.status === 1) {
            alert("Job Applied successfully!");
            window.location.href = response.redirect;
        } else {
            alert("Error applying for the job: " + response.message);
            throw new Error(response.message);
        }
    })
    .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while applying for the job");
    });
}