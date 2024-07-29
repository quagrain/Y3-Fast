document.addEventListener("DOMContentLoaded", function() {
    // Set the minimum date limit to the current day
    const dateInput = document.getElementById("application_deadline");
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);

    // Add an extra input field for responsibility when the user clicks the plus button
    const addResponsibilityButton = document.getElementById("add_responsibility");
    const additionalResponsibilitiesContainer = document.getElementById("additional_responsibilities");

    addResponsibilityButton.addEventListener("click", function() {
        const newResponsibilityField = document.createElement("div");
        newResponsibilityField.className = "input-group mb-3";
        newResponsibilityField.innerHTML = `
                        <input class="form-control" type="text" placeholder="Additional responsibility">
                        <div class="input-group-append">
                          <button class="btn btn-secondary btn-outline-black remove-responsibility" type="button">-</button>
                        </div>
                      `;
        additionalResponsibilitiesContainer.appendChild(newResponsibilityField);

        newResponsibilityField.querySelector(".remove-responsibility").addEventListener("click", function() {
            additionalResponsibilitiesContainer.removeChild(newResponsibilityField);
        });
    });

    // Add extra benefits field when the button is clicked
    const addBenefitsButton = document.getElementById("add_benefits");
    const additionalBenefitsContainer = document.getElementById("additional_benefits");
    addBenefitsButton.addEventListener("click", function() {
        const newBenefitsField = document.createElement("div");
        newBenefitsField.className = "input-group mb-3";
        newBenefitsField.innerHTML = `
        <input class="form-control" type="text" placeholder="Additional benefit">
        <div class="input-group-append">
          <button class="btn btn-secondary btn-outline-black remove-benefit" type="button">-</button>
        </div>
      `;
        additionalBenefitsContainer.appendChild(newBenefitsField);
        newBenefitsField.querySelector(".remove-benefit").addEventListener("click", function() {
            additionalBenefitsContainer.removeChild(newBenefitsField);
        });
    });

});