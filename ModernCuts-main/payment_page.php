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

// Fetch the service price from the database based on the service ID
$sql = "SELECT price FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $serviceId);
$stmt->execute();
$stmt->bind_result($servicePrice);
$stmt->fetch();
$stmt->close();

// You can calculate the total price or perform other necessary operations here
$totalPrice = $servicePrice ?? 0; // Default to 0 if the price is not found

// Handle payment processing if necessary

// For this example, we'll assume payment processing and confirmation

if (isset($_POST['confirmPayment'])) {
    // Payment processing logic can be added here
    
    // Redirect to a thank you page on successful payment
    header("Location: view_appointment.php ");
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment/Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Payment / Checkout</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Payment Details</h2>
            <p><strong>Professional:</strong> <?= htmlspecialchars($professionalName) ?></p>
            <p><strong>Service:</strong> <?= htmlspecialchars($serviceName) ?></p>
            <p><strong>Total Price: $</strong> <?= htmlspecialchars($totalPrice) ?></p>
            
            <form method="post">
                <div class="row">
                    <!-- Billing Information -->
                    <div class="col-md-6">
                        <h3>Billing Information</h3>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="middleInitial">Middle Initial (optional)</label>
                            <input type="text" class="form-control" id="middleInitial" name="middleInitial">
                        </div>
                        <div class="form-group">
                            <label for="address">Billing Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="zip">ZIP</label>
                            <input type="number" class="form-control" id="zip" name="zip" inputmode="numeric" required>
                        </div>
                    </div>
                    <!-- Credit Card Information -->
                    <div class="col-md-6">
                        <h3>Credit Card Information</h3>
                        <div class="form-group">
                            <label for="cardNumber">Credit Card Number</label>
                            <input type="number" class="form-control" id="cardNumber" name="cardNumber" input="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="expiryDate">Expiration Date</label>
                            <input type="number" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" inputmode="numeric" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="number" class="form-control" id="cvv" name="cvv" inputmode="numeric" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="confirmPayment" class="btn btn-secondary">Confirm Payment</button>
            </form>
        </div>
        <div class="card-footer">
            <!-- Link to change the booking or go back to the previous page -->
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
