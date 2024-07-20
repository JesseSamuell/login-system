<?php
require 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        die("Please enter both email and password.");
    }

    // Prepare SQL statement to find user by email
    $stmt = $conn->prepare("SELECT email, password FROM user WHERE email = ?");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_email, $db_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $db_password)) {
            $_SESSION['user'] = $db_email;
            header('Location: dashboard.php');
            exit();
        } else {
            die("Invalid email or password.");
        }
    } else {
        die("Invalid email or password.");
    }

    $stmt->close();
    $conn->close();
}
?>
