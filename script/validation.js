document.addEventListener("DOMContentLoaded", function() {
    const passwordField = document.getElementById("c-password");

    // Validation criteria elements
    const minLength = document.getElementById("minLength");
    const lowercase = document.getElementById("lowercase");
    const uppercase = document.getElementById("uppercase");
    const number = document.getElementById("number");
    const specialChar = document.getElementById("specialChar");

    passwordField.addEventListener("input", function() {
        const password = passwordField.value;

        // Validate each criterion
        if (password.length >= 8) {
            minLength.classList.add("valid");
            minLength.querySelector(".checkmark").textContent = "✔";
        } else {
            minLength.classList.remove("valid");
            minLength.querySelector(".checkmark").textContent = "✘";
        }

        if (/[a-z]/.test(password)) {
            lowercase.classList.add("valid");
            lowercase.querySelector(".checkmark").textContent = "✔";
        } else {
            lowercase.classList.remove("valid");
            lowercase.querySelector(".checkmark").textContent = "✘";
        }

        if (/[A-Z]/.test(password)) {
            uppercase.classList.add("valid");
            uppercase.querySelector(".checkmark").textContent = "✔";
        } else {
            uppercase.classList.remove("valid");
            uppercase.querySelector(".checkmark").textContent = "✘";
        }
        if (/[^a-zA-Z0-9]/.test(password)) {
            specialChar.classList.add("valid");
            specialChar.querySelector(".checkmark").textContent = "✔";
        } else {
            specialChar.classList.remove("valid");
            specialChar.querySelector(".checkmark").textContent = "✘";
        }
        if (/\d/.test(password)) {
            number.classList.add("valid");
            number.querySelector(".checkmark").textContent = "✔";
        } else {
            number.classList.remove("valid");
            number.querySelector(".checkmark").textContent = "✘";
        }

    });

});
