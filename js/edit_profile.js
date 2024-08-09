// Change the image when one is uploaded
const img_div = document.getElementById("img_div");
const img = document.getElementById("photo");
const img_file = document.getElementById("profile_picture");
const placeholder_icon = document.getElementById("placeholder_icon");

const cv_file = document.getElementById("cv");

var hasChangedPP, hasChangedCV;

// If src attribute of image is empty,
document.addEventListener("DOMContentLoaded", function () {
    if (img.getAttribute('src') !== "") {
        img.setAttribute('src', img.getAttribute('src'));
        placeholder_icon.style.display = 'none';
        img.style.display = 'block';
        img_div.setAttribute('class', 'btn btn-file');
    }
})

img_file.addEventListener('change', function () {
    hasChangedPP = true;
    const chosenFile = this.files[0];
    if (chosenFile) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            img.setAttribute('src', reader.result);
        })
        reader.readAsDataURL(chosenFile);
        placeholder_icon.style.display = 'none';
        img.style.display = 'block';
        img_div.setAttribute('class', 'btn btn-file');
    }
})

const userType = document.getElementById('usertype');

if (userType.textContent === "JobSeeker") {
    cv_file.addEventListener('change', function () {
        hasChangedCV = true;
    })
}


if (userType.textContent === "JobSeeker") {
    // Change the file name beside the resume submission
    let file = document.getElementById("cv");
    let name = document.getElementById("cv_name");
    file.addEventListener("input", () => {
        // if user selects a file, get file name
        if (file.files.length) {
            name.innerHTML = file.files[0].name;
        }
    })
}

const oldHashPass = document.getElementById("oldHashPass").textContent
var passwd;
var hasPassChanged = false

document.getElementById("passwd").addEventListener('change', function () {
    passwd = document.getElementById("passwd").value;
    hasPassChanged = true
})

// process profile editing
function handleUpdateProfile(event) {
    event.preventDefault();

    const usertype = document.getElementById("usertype").textContent;

    if (!hasPassChanged) {
        passwd = oldHashPass;
    }

    // Collect form data
    const formData = new FormData();

    formData.append("usertype", usertype);
    formData.append("profile_picture", document.getElementById("profile_picture").files[0]);
    formData.append("hasChangedPP", hasChangedPP);
    formData.append("passwd", passwd);
    formData.append("hasPassChanged", hasPassChanged);

    if (usertype === 'JobSeeker') {

        formData.append("fname", document.getElementById("fname").value);
        formData.append("lname", document.getElementById("lname").value);
        formData.append("occupation", document.getElementById("occupation").value);
        formData.append("descrip", document.getElementById("description").value);
        formData.append("dob", document.getElementById("date_of_birth").value);
        formData.append("cv", document.getElementById("cv").files[0]);
        formData.append("hasChangedCV", hasChangedCV);

    } else if (usertype === 'Employer') {

        formData.append("org_name", document.getElementById("org_name").value);
        formData.append("industry", document.getElementById("industry").value);
        formData.append("creation_date", document.getElementById("creation_date").value);
        var tagIds = [];
        var select = document.getElementById("tags");
        for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].selected) {
                tagIds.push(select.options[i].value);
            }
        }
        formData.append("tagIds", tagIds);

    }

    // Send the data to the server
    fetch("./actions/edit_profile.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok: " + response.statusText);
            }
            return response.json();
        })
        .then((response) => {
            if (response.status === 1) {
                alert("Profile updated successfully!");
                window.location.href = response.redirect;
            } else {
                alert("Error updating profile: " + response.message);
                throw new Error(response.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while updating the profile.");
        });

    console.log('Profile updated');
    toggleEdit();
}