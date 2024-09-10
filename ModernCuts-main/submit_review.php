<?php
include 'config.php'; // Include your config file

// Get POST data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Reviews (firstName, lastName, email, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstName, $lastName, $email, $message);

// Execute and respond
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Review submitted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error submitting review"]);
}

$stmt->close();
$conn->close();
?>
