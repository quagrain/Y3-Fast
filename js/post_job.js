function handlePostJob(event) {
    event.preventDefault();

    const jobTitle = document.getElementById('job-title').value;
    const jobDescription = document.getElementById('job_description').textContent.trim();
    const userId = null; // Set this to the ID of the logged-in employer (done in the php side)
    const experience = document.getElementById('experience').value;

    const responsibilities = [document.getElementById('responsibility').value, ...Array.from(document.querySelectorAll('#additional_responsibilities input')).map(input => input.value)];
    const benefits = [document.getElementById('benefits').value, ...Array.from(document.querySelectorAll('#additional_benefits input')).map(input => input.value)];

    const vacancy = document.getElementById('vacancy').value;
    const status = document.getElementById('job-type').value;
    const jobLocation = document.getElementById('job-location').value;
    const salary = document.getElementById('salary').value;
    const gender = document.getElementById('gender').value;
    const applicationDeadline = document.getElementById('application_deadline').value;

    const featuredImage = document.getElementById('featured_image').files[0];

    // Collect form data
    const formData = new FormData();
    formData.append("jobTitle", jobTitle);
    formData.append("jobDescription", jobDescription);
    formData.append("userId", userId);
    formData.append("responsibility", JSON.stringify(responsibilities));
    formData.append("experience", experience);
    formData.append("benefits", JSON.stringify(benefits));
    formData.append("vacancy", vacancy);
    formData.append("status", status);
    formData.append("jobLocation", jobLocation);
    formData.append("salary", salary);
    formData.append("gender", gender);
    formData.append("applicationDeadline", applicationDeadline);
    formData.append("featured_image", featuredImage);

    // const formData = {
    //     'jobTitle': jobTitle,
    //     'jobDescription': jobDescription,
    //     'userId': userId,
    //     'responsibility': responsibilities,
    //     'experience': experience,
    //     'benefits': benefits,
    //     'vacancy': vacancy,
    //     'status': status,
    //     'jobLocation': jobLocation,
    //     'salary': salary,
    //     'gender': gender,
    //     'applicationDeadline': applicationDeadline,
    //     'featuredImage': featuredImage
    // };

    fetch('./actions/post_job.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
          }
          return response.json();
    })
    .then(response => {
        if (response.status === 1) {
            window.location.href = response.redirect;
            console.log(response.message);
        } else {
            alert('Job posting failed: ' + response.message);
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('An error occurred during job posting: ' + err.message);
    });
}
