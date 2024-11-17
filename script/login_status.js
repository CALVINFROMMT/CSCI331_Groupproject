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
            
            if (data === "success") {
                loginStatus.textContent = "Not admin Login successful!";
                loginStatus.style.color = "green";
            } 
            else if (data === "admin") {
                loginStatus.textContent = "Admin successful!";
                loginStatus.style.color = "red";
            }else {
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
