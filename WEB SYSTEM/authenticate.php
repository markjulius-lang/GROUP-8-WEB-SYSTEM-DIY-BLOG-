<?php
// Start a new session or resume an existing one
session_start();

// Connect to the MySQL database
// DB NAME: dbreg
$conn = new mysqli('localhost', 'root', '', 'dbreg');

// Check kung ang connection sa database ay connected
if ($conn->connect_error) {
    die("❌ Connection Failed: " . $conn->connect_error);
}

// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize email input to prevent SQL injection and XSS attacks
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Retrieve the entered password (hindi pa naka hashed $2dgd)

    // Query para icheck kung ang email ay available na sa Database
    $stmt = $conn->prepare("SELECT password FROM register WHERE emailAddress = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // Store the result to check if the user exists

    if ($stmt->num_rows > 0) {
        // Fetch the hashed password from the database
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the entered password
        if (password_verify($password, $hashedPassword)) {
            //  Password is correct → Start user session
            $_SESSION['user_email'] = $email; // Store email in session
            header("Location: index.html?success=logged_in"); // papunta sa dashboard.php
            exit();
        } else {
            // kung incorrect ibabalik ka sa login.php with error message
            header("Location: login.php?error=incorrect_password");
            exit();
        }
    } else {
        // kung hindi mahanap sa database ibabalik ka ulit sa login.php with error message
        header("Location: login.php?error=user_not_recognized");
        exit();
    }
    
    $stmt->close(); // Close the prepared statement
}

// Close the database connection
$conn->close();
?>
