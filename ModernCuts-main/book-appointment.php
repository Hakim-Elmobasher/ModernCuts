<?php
// Start the session
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

// Retrieve the professional's ID and service's ID from the session
$professional_id = $_SESSION['selectedProfessionalId'] ?? '';
$service_id = $_SESSION['selectedServiceId'] ?? '';

// Retrieve data from the form submission
$selected_appointment_date = $_POST['selected_appointment_date'] ?? '';
$selected_appointment_time = $_POST['selected_appointment_time'] ?? '';

// Set session variables for date and time
$_SESSION['selected_appointment_date'] = $selected_appointment_date;
$_SESSION['selected_appointment_time'] = $selected_appointment_time;

// Database connection settings - replace with your actual database credentials
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

// Check if 'user_id' is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you have user authentication and user_id stored in session

    // SQL to insert the new appointment
    $sql = "INSERT INTO appointments (professional_id, service_id, user_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("iiiss", $professional_id, $service_id, $user_id, $selected_appointment_date, $selected_appointment_time);

    // Execute the prepared statement
    $result = $stmt->execute();

    if ($result === false) {
        die("Error in executing the statement: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();

    // Redirect to a confirmation page or display a success message
    header('Location: confirmation_page.php');
    exit;
} else {
    // Handle the case where 'user_id' is not set in the session
    echo "Error: User ID not found in session.";
    exit;
}

// Close the database connection
$conn->close();
?>
