const applyButtons = document.querySelectorAll(".applyButton");

function handleJobApplication(event, userId, jobId) {
    event.preventDefault();

    if (event.target.disabled) {
        return;
    }

    var Data = {
        'userId': userId,
        'jobId': jobId
    }

    fetch("./actions/applyForJob.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(Data)
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
            // window.location.href = response.redirect;

            // Apply changes to all apply buttons
            applyButtons.forEach(function(btn) {
                btn.classList.remove("btn-primary");
                btn.classList.add("btn-success");
                btn.textContent = "Applied";
                btn.disabled = true; // Disable the button
            });
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

document.addEventListener("DOMContentLoaded", function() {
    // Select all elements with the class 'applyButton'
    const applyButtons = document.querySelectorAll(".applyButton");
    const hasApplied = document.getElementById("hasApplied").textContent === 'true';


    if (hasApplied) {
        // Apply changes to all apply buttons
        applyButtons.forEach(function(btn) {
            btn.classList.remove("btn-primary");
            btn.classList.add("btn-success");
            btn.textContent = "Applied";
            btn.disabled = true; // Disable the button
        });
    }
});
