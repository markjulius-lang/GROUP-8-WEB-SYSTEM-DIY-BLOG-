document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert("❌ Error: Passwords do not match!");
        event.preventDefault(); // Prevents form submission
    }
});

// Redirect to login.php after successful registration
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("success") === "true") {
        //alert("✅ Registration Completed!");
        window.location.href = "login.php"; // Redirect to login.php after alert
    }
});
