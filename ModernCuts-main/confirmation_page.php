<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "moderncuts2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching details from the session
$professionalId = $_SESSION['selectedProfessionalId'] ?? 'Not Specified';
$serviceId = $_SESSION['selectedServiceId'] ?? 'Not Specified';
$appointmentDate = $_SESSION['selected_appointment_date'] ?? 'Not Specified';
$appointmentTime = $_SESSION['selected_appointment_time'] ?? 'Not Specified';

// Fetch the professional name from the database based on the professional ID
$professionalName = 'Not Specified'; // Default value
if ($professionalId !== 'Not Specified') {
    $sqlProfessional = "SELECT name FROM professionals WHERE id = ?";
    $stmtProfessional = $conn->prepare($sqlProfessional);
    $stmtProfessional->bind_param("i", $professionalId);
    $stmtProfessional->execute();
    $stmtProfessional->bind_result($professionalName);
    $stmtProfessional->fetch();
    $stmtProfessional->close();
}

// Fetch the service name from the database based on the service ID
$serviceName = 'Not Specified'; // Default value
if ($serviceId !== 'Not Specified') {
    $sqlService = "SELECT name FROM services WHERE id = ?";
    $stmtService = $conn->prepare($sqlService);
    $stmtService->bind_param("i", $serviceId);
    $stmtService->execute();
    $stmtService->bind_result($serviceName);
    $stmtService->fetch();
    $stmtService->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Booking Confirmation</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Your Booking Details</h2>
            <p><strong>Professional Name:</strong> <?= htmlspecialchars($professionalName) ?></p>
            <p><strong>Service Name:</strong> <?= htmlspecialchars($serviceName) ?></p>
            <p><strong>Appointment Date:</strong> <?= htmlspecialchars($appointmentDate) ?></p>
            <p><strong>Appointment Time:</strong> <?= htmlspecialchars($appointmentTime) ?></p>

            <!-- You can add additional information or actions here -->
        </div>
        <div class="card-footer">
            <!-- Link to proceed to payment, thank you page, or other actions -->
            <a href="payment_page.php" class="btn btn-success">Confirm Booking</a>
            <!-- Link to change the booking -->
            <a href="professional-selection.php" class="btn btn-secondary">Change Booking</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
