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
}

function showToolTip() {}
