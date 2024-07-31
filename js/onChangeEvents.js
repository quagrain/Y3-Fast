// Show additional fields in the register form based on userType
function showAdditionalFields() {
  var userType = document.getElementById("usertype").value;
  var employerFields = document.getElementById("employer_fields");
  var jobSeekerFields = document.getElementById("job_seeker_fields");

  if (userType == "JobSeeker") {
    jobSeekerFields.style.display = "block";
    employerFields.style.display = "none";
  } else if (userType == "Employer") {
    employerFields.style.display = "block";
    jobSeekerFields.style.display = "none";
  } else {
    employerFields.style.display = "none";
    jobSeekerFields.style.display = "none";
  }

  // Changes that can only happen when the display is set (not none)
  const dateEstablished = document.getElementById("creation_date");
  const today = new Date().toISOString().split("T")[0];
  if (dateEstablished) dateEstablished.setAttribute("max", today);

  const additionalTag = document.getElementById("add_tag");
  const additionalTagContainer = document.getElementById("additional_tags");

  if (additionalTag && additionalTagContainer) {
    additionalTag.addEventListener("click", function () {
      const existingFields =
        additionalTagContainer.querySelectorAll(".input-group").length;
      if (existingFields < 3) {
        const newTagField = document.createElement("div");
        newTagField.className = "input-group mb-3";
        newTagField.innerHTML = `
                    <input class="form-control" type="text" placeholder="Additional tag">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-outline-black remove-tag" type="button">-</button>
                    </div>
                `;
        additionalTagContainer.appendChild(newTagField);

        newTagField
          .querySelector(".remove-tag")
          .addEventListener("click", function () {
            additionalTagContainer.removeChild(newTagField);
          });
      } else {
        alert("You can only add up to 3 additional tags.");
      }
    });
  }
}
