<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['new_username'];
    $password = $_POST['new_password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Perform basic input validation here

    // Hash the password (you should use password_hash() for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, hashed_password, email, first_name, last_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $email, $first_name, $last_name);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now <a href='login_registration_page.html'>login</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
