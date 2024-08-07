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
    const lengthValid = password.length >= 5 && password.length <= 50;
    const letterValid = /[A-Za-z]/.test(password);
    const numberValid = /\d/.test(password);
    const specialValid = /[@$!%*#?&]/.test(password);

    return {
        lengthValid,
        letterValid,
        numberValid,
        specialValid,
        allValid: lengthValid && letterValid && numberValid && specialValid
    };
}

// Function to set validation status
function setValidationStatus(inputElement, isValid, errorElement) {
    if (isValid) {
        inputElement.classList.remove('is-invalid');
        inputElement.classList.add('is-valid');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    } else {
        inputElement.classList.remove('is-valid');
        inputElement.classList.add('is-invalid');
        if (errorElement) {
            errorElement.style.display = 'block';
        }
    }
}

// Add event listeners to input fields
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('passwd');
    const rePasswordInput = document.getElementById('re_passwd');
    const userTypeSelect = document.getElementById('usertype');

    emailInput.addEventListener('input', function () {
        setValidationStatus(this, validateEmail(this.value));
    });

    usernameInput.addEventListener('input', function () {
        setValidationStatus(this, validateUsername(this.value));
    });

    passwordInput.addEventListener('input', function () {
        const validationResult = validatePassword(this.value);
        setValidationStatus(this, validationResult.allValid);

        document.getElementById('lengthError').style.display = validationResult.lengthValid ? 'none' : 'list-item';
        document.getElementById('letterError').style.display = validationResult.letterValid ? 'none' : 'list-item';
        document.getElementById('numberError').style.display = validationResult.numberValid ? 'none' : 'list-item';
        document.getElementById('specialError').style.display = validationResult.specialValid ? 'none' : 'list-item';

        if (rePasswordInput.value) {
            setValidationStatus(rePasswordInput, this.value === rePasswordInput.value);
        }
    });

    userTypeSelect.addEventListener('change', function () {
        setValidationStatus(this, this.value !== "");
    });

    
    if (rePasswordInput !== null) {
        rePasswordInput.addEventListener('input', function () {
            setValidationStatus(this, this.value === passwordInput.value);
        });
    }


});
