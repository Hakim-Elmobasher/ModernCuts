<?php
session_start();
include 'config.php';

// Check if the user is logged in and has the necessary data
if (isset($_SESSION['user_id']) && isset($_GET['date']) && isset($_GET['timeSlot']) && isset($_GET['professional_id']) && isset($_GET['service_id'])) {
    $userId = $_SESSION['user_id']; // assuming user_id is stored in session after login
    $date = $_GET['date'];
    $timeSlot = $_GET['timeSlot'];
    $professionalId = $_GET['professional_id'];
    $serviceId = $_GET['service_id'];

    // Combine date and time slot to form the appointment_time
    $appointmentDateTime = $date . ' ' . $timeSlot;

    // Prepare an INSERT statement
    $stmt = $conn->prepare("INSERT INTO appointments (professional_id, service_id, user_id, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $professionalId, $serviceId, $userId, $appointmentDateTime);

    if ($stmt->execute()) {
        echo "Booking successful!";
        // Redirect to a confirmation page or display a success message
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Required data not provided.";
}
?>
