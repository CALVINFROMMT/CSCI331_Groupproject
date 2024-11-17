document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("login-form");
    const loginStatus = document.getElementById("login-status");

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(loginForm);

        // Send form data to login_user.php via fetch
        fetch("php/login_user.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Display the login status message
            if (data === "success") {
                loginStatus.textContent = "Login successful!";
                loginStatus.style.color = "green";
            } else {
                loginStatus.textContent = "Login failed. Please check your username and password.";
                loginStatus.style.color = "red";
            }
        })
        .catch(error => {
            loginStatus.textContent = "An error occurred. Please try again later.";
            loginStatus.style.color = "red";
        });
    });
});
