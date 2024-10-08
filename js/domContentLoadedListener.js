function toggleEdit() {
  const editButton = document.getElementById('edit-profile-btn');
  const editableFields = document.querySelectorAll('.editable');
  const updateButton = document.getElementById('update-profile-btn');

  if (editButton.textContent.trim() === 'Edit') {
    editButton.innerHTML = 'Cancel <span class="icon-close pl-4"></span>';
    editableFields.forEach(field => field.disabled = false);
    updateButton.disabled = false;
  } else {
    editButton.innerHTML = 'Edit <span class="icon-pencil pl-4"></span>';
    editableFields.forEach(field => field.disabled = true);
    updateButton.disabled = true;
  }
}

// function handleUpdateProfile(event) {
//   event.preventDefault();
//   // Add your update profile logic here
//   console.log('Profile updated');
//   toggleEdit(); // Reset the form to non-editable state
// }

document.addEventListener("DOMContentLoaded", function () {

  // Hide the editable fields in the profile
  const editableFields = document.querySelectorAll('.editable');
  editableFields.forEach(field => field.disabled = true);


  // Show or hide password when the Eye of Horus is clicked
  const passwordInput = document.getElementById("passwd");
  const toggleButton = document.getElementById("togglePassword");
  const toggleIcon = toggleButton ? toggleButton.querySelector("i") : null;

  if (passwordInput && toggleButton && toggleIcon) {
    toggleButton.addEventListener("click", function () {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    });
  }

  // Set the minimum date limit to the current day
  const dateInput = document.getElementById("application_deadline");
  const today = new Date().toISOString().split("T")[0];
  if (dateInput) dateInput.setAttribute("min", today);

  // Add an extra input field for responsibility when the user clicks the plus button
  const addResponsibilityButton = document.getElementById("add_responsibility");
  const additionalResponsibilitiesContainer = document.getElementById(
    "additional_responsibilities",
  );

  if (addResponsibilityButton && additionalResponsibilitiesContainer) {
    addResponsibilityButton.addEventListener("click", function () {
      const existingFields =
        additionalResponsibilitiesContainer.querySelectorAll(
          ".input-group",
        ).length;
      if (existingFields < 10) {
        const newResponsibilityField = document.createElement("div");
        newResponsibilityField.className = "input-group mb-3";
        newResponsibilityField.innerHTML = `
                    <input class="form-control" type="text" placeholder="Additional responsibility">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-outline-black remove-responsibility" type="button">-</button>
                    </div>
                `;
        additionalResponsibilitiesContainer.appendChild(newResponsibilityField);

        newResponsibilityField
          .querySelector(".remove-responsibility")
          .addEventListener("click", function () {
            additionalResponsibilitiesContainer.removeChild(
              newResponsibilityField,
            );
          });
      } else {
        alert("You can only add up to 10 additional responsibilities.");
      }
    });
  }

  // Add extra benefits field when the button is clicked
  const addBenefitsButton = document.getElementById("add_benefits");
  const additionalBenefitsContainer = document.getElementById(
    "additional_benefits",
  );

  if (addBenefitsButton && additionalBenefitsContainer) {
    addBenefitsButton.addEventListener("click", function () {
      const existingFields =
        additionalBenefitsContainer.querySelectorAll(".input-group").length;
      if (existingFields < 10) {
        const newBenefitsField = document.createElement("div");
        newBenefitsField.className = "input-group mb-3";
        newBenefitsField.innerHTML = `
                    <input class="form-control" type="text" placeholder="Additional benefit">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-outline-black remove-benefit" type="button">-</button>
                    </div>
                `;
        additionalBenefitsContainer.appendChild(newBenefitsField);

        newBenefitsField
          .querySelector(".remove-benefit")
          .addEventListener("click", function () {
            additionalBenefitsContainer.removeChild(newBenefitsField);
          });
      } else {
        alert("You can only add up to 10 additional benefits.");
      }
    });
  }
});





