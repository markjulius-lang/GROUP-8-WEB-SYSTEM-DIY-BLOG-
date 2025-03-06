<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $emailAddress = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if ($password !== $repassword) {
        header("Location: registration.php?error=password_mismatch");
        exit();
    }

    // Hash the password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'dbreg');

    if ($conn->connect_error) {
        die("❌ Connection Failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT emailAddress FROM register WHERE emailAddress = ?");
    $checkEmail->bind_param("s", $emailAddress);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $checkEmail->close();
        header("Location: registration.php?error=duplicate_email");
        exit();
    }
    $checkEmail->close();

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO register (firstName, emailAddress, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $firstName, $emailAddress, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: login.php?success=registered"); // Redirect to login page after registration
        exit();
    } else {
        header("Location: registration.php?error=database_error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
