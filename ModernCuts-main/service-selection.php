<?php
// Start the session
// Set session lifetime to 5 minutes (300 seconds)
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

/// Retrieve the selected professional's ID from the GET parameter
$selectedProfessionalId = $_GET['professional'] ?? '';

// Store the selected professional's ID in a session variable
$_SESSION['selectedProfessionalId'] = $selectedProfessionalId;

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

// SQL query to fetch services data
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
} else {
    echo "No services found";
}
$conn->close();

// Handle form submission
if (isset($_POST['selectedServiceId'])) {
    // Store the selected service's ID in a session variable
    $_SESSION['selectedServiceId'] = $_POST['selectedServiceId'];

    // Then redirect to the login and registration page
    header("Location: login_registration_page copy.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a Service</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Choose a Service</h1>

        <!-- Breadcrumbs using Bootstrap's breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Professional</li>
                <li class="breadcrumb-item active" aria-current="page">Service</li>
                <li class="breadcrumb-item">Time</li>
                <li class="breadcrumb-item">Done</li>
            </ol>
        </nav>

        <!-- Display the selected professional's ID (for demonstration purposes) -->
        <?php if ($selectedProfessionalId !== null): ?>
            <p>Selected Professional ID: <?= $selectedProfessionalId ?></p>
        <?php endif; ?>

        <!-- Services listing using Bootstrap's cards -->
        <form method="post" action="">
            <div class="row">
                <?php foreach ($services as $index => $service): ?>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card service">
                            <?php
                                // Define placeholder image for each service
                                $placeholderImages = [
                                    "clipper_haircut.jpg",    // Placeholder image for the first service
                                    "scissor_beard_shave.jpg",  // Placeholder image for the second service
                                    "ClipperHaircut.jpg",   // Placeholder image for the third service
                                    "scissor_haircut.jpg",   // Placeholder image for the fourth service
                                    "clipper_beard_shave.jpg"    // Placeholder image for the fifth service
                                    // Add more placeholder images as needed
                                ];

                                // Use the appropriate placeholder image based on the service index
                                $placeholderImage = isset($placeholderImages[$index]) ? $placeholderImages[$index] : "placeholder_image.jpg";
                            ?>
                            <!-- Service image -->
                            <img src="<?= $placeholderImage ?>" class="card-img-top" alt="Service Image">

                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $service['name'] ?></h5>
                                <p class="card-text">Duration: <?= $service['duration'] ?></p>
                                <p class="card-text">Price: <?= $service['price'] ?></p>
                                <button type="submit" class="btn btn-primary" name="selectedServiceId"
                                    value="<?= $service['id'] ?>">Select Service</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Centered boxes at the bottom -->
            <div class="row justify-content-center mt-4">
                <div class="col-sm-6 col-md-4 mb-4">
                    <!-- Add content for the first centered box -->
                </div>
                <div class="col-sm-6 col-md-4 mb-4">
                    <!-- Add content for the second centered box -->
                </div>
                <!-- Add more centered boxes as needed -->
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>