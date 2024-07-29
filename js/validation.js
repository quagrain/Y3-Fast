// Function to validate email
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Function to validate username
function validateUsername(username) {
    const re = /^[a-zA-Z0-9_]{3,20}$/;
    return re.test(username);
}

// Function to validate password
function validatePassword(password) {
    const re = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{5,50}$/;
    return re.test(password);
}

// Function to set validation status
function setValidationStatus(inputElement, isValid) {
    if (isValid) {
        inputElement.classList.remove('is-invalid');
        inputElement.classList.add('is-valid');
    } else {
        inputElement.classList.remove('is-valid');
        inputElement.classList.add('is-invalid');
    }
}

// Add event listeners to input fields
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('passwd');
    const rePasswordInput = document.getElementById('re_passwd');

    emailInput.addEventListener('input', function() {
        setValidationStatus(this, validateEmail(this.value));
    });
    usernameInput.addEventListener('input', function() {
        setValidationStatus(this, validateUsername(this.value));
    });
    passwordInput.addEventListener('input', function() {
        setValidationStatus(this, validatePassword(this.value));
        if (rePasswordInput.value) {
            setValidationStatus(rePasswordInput, this.value === rePasswordInput.value);
        }
    });
    rePasswordInput.addEventListener('input', function() {
        setValidationStatus(this, this.value === passwordInput.value);
    });
});