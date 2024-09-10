<?php
session_start();

// Here we are fetching the details from the session
$professionalId = $_SESSION['selectedProfessionalId'] ?? 'Not Specified';
$serviceId = $_SESSION['selectedServiceId'] ?? 'Not Specified';
$appointmentDate = $_SESSION['selected_appointment_date'] ?? 'Not Specified';
$appointmentTime = $_SESSION['selected_appointment_time'] ?? 'Not Specified';


// Assuming you have a user ID stored in the session
$userId = $_SESSION['user_id'] ?? null;

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

// Fetch the user's information from the database
$userInfo = null;
if ($userId) {
    $sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $email);
    $stmt->fetch();
    $stmt->close();

    // Store user information in an array
    $userInfo = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
    ];
}

// Fetch the service name from the database based on service_id
$serviceName = 'Not Specified';
if ($serviceId) {
    $sqlService = "SELECT name FROM services WHERE id = ?";
    $stmtService = $conn->prepare($sqlService);

    // Check if the preparation of the statement was successful
    if ($stmtService) {
        $stmtService->bind_param("i", $serviceId);
        $stmtService->execute();
        $stmtService->bind_result($serviceName);
        $stmtService->fetch();
        $stmtService->close();
    } else {
        // Output an error message if preparation fails
        echo "Error: " . $conn->error;
    }
}

// Fetch the professional name from the database based on professional_id
$professionalName = 'Not Specified';
if ($professionalId) {
    $sqlProfessional = "SELECT name FROM professionals WHERE id = ?";
    $stmtProfessional = $conn->prepare($sqlProfessional);

    // Check if the preparation of the statement was successful
    if ($stmtProfessional) {
        $stmtProfessional->bind_param("i", $professionalId);
        $stmtProfessional->execute();
        $stmtProfessional->bind_result($professionalName);
        $stmtProfessional->fetch();
        $stmtProfessional->close();
    } else {
        // Output an error message if preparation fails
        echo "Error: " . $conn->error;
    }
}



// Close the database connection
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed</title>
    <!-- Include Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Your CSS styles remain unchanged */
        body, html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, white, silver, black);
        }

        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency to the container */
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .confirmation-details {
            margin-top: 20px;
        }

        .check-icon {
            color: green;
            font-size: 48px; /* Adjust the font size to make it bigger */
            margin-top: 20px; /* Optional: Add margin for spacing */
        }
        
         .home-button {
            margin-top: 20px;
        }
        
        
      .buttons {
    margin-top: 20px;
    text-align: center;
}

.home-button,
.view-appointment-button {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: black;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.home-button:hover,
.view-appointment-button:hover {
    background-color: #333;
}
        
        
    </style>
</head>

<body>
    <div class="container">
        <h1>Appointment Confirmed</h1>

        <div class="confirmation-details">
            <h2>Customer Details:</h2>
            <?php if ($userInfo) : ?>
                <p><strong>Name:</strong> <?= htmlspecialchars($userInfo['first_name'] . ' ' . $userInfo['last_name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($userInfo['email']) ?></p>
            <?php else : ?>
                <p>Unable to fetch user information.</p>
            <?php endif; ?> 

            <h2>Booking Details:</h2>
            <p><strong>Service:</strong> <?= htmlspecialchars($serviceName) ?></p>
            <p><strong>Professional:</strong> <?= htmlspecialchars($professionalName) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($appointmentDate) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($appointmentTime) ?></p>
            <p><strong>Location:</strong> ModernCuts</p>

            <h2>Confirmation Message:</h2>
            <p>Thank you for your booking! Your reservation has been confirmed. We look forward to serving you on at modercuts barbershop''.</p>
            <i class="fas fa-check-circle check-icon"></i>
            <div class="buttons">
    <a href="home.php" class="home-button">Home</a>
    <a href="appointment-history.php" class="view-appointment-button">View Appointment History</a>
</div>
          
        </div>
    </div></body>

</html>