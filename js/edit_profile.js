function handleUpdateProfile(event) {
    event.preventDefault();

    // Collect form data
    const formData = new FormData();
    formData.append("profile_picture", document.getElementById("profile_picture").files[0]);
    formData.append("fname", document.getElementById("fname").value);
    formData.append("lname", document.getElementById("lname").value);
    formData.append("descrip", document.getElementById("description").value);
    formData.append("dob", document.getElementById("date_of_birth").value);
    formData.append("cv", document.getElementById("cv").files[0]);

    // Send the data to the server
    fetch("./actions/edit_profile.php", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok: " + response.statusText);
        }
        return response.json();
    })
    .then(response => {
        if (response.status === 1) {
            alert("Profile updated successfully!");
            window.location.href = response.redirect;
        } else {
            alert("Error updating profile: " + response.message);
            throw new Error(response.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while updating the profile.");
    });

    console.log('Profile updated');
    toggleEdit();
  }