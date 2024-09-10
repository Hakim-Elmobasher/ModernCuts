<?php
// Start the session
// Set session lifetime to 5 minutes (300 seconds)
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();


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

// SQL query to fetch professionals data
$sql = "SELECT * FROM professionals";
$result = $conn->query($sql);

$professionals = [];
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $professionals[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

// Handling professional selection and redirection
if (isset($_GET['professional'])) {
    // Store the selected professional's ID in a session variable
    $_SESSION['selectedProfessionalId'] = $_GET['professional'];

    // Then redirect to the service selection page
    header("Location: servive-selection.php?professional=" . $_SESSION['selectedProfessionalId']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a professional</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <!-- Add some basic styling -->
    <style>
        .professional img {
            max-width: 110%; /* Make images responsive */
            height: 180px;
            border-radius: 0%; /* Circular images */
            margin-bottom: 10px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Choose a professional</h1>

    <!-- Breadcrumbs using Bootstrap's breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Professional</li>
            <li class="breadcrumb-item">Service</li>
            <li class="breadcrumb-item">Time</li>
            <li class="breadcrumb-item">Done</li>
        </ol>
    </nav>

    <!-- Professionals listing using Bootstrap's cards -->
    <div class="row">
    <?php foreach ($professionals as $pro): ?>
        <div class="col-sm-4 col-md-3 mb-4">
            <div class="card professional" data-id="<?= $pro['id'] ?>">
                <!-- Corrected the image source path -->
                <img src="/Other option/Images/<?= $pro['image'] ?>" alt="<?= $pro['name'] ?>" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title"><?= $pro['name'] ?></h5>
                    <p class="card-text"><?= $pro['availability'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- JavaScript to handle professional selection -->
<script>
    // Attach click event to each professional
    document.querySelectorAll('.professional').forEach(professional => {
        professional.addEventListener('click', function() {
            // Get the professional's ID
            let professionalId = this.getAttribute('data-id');
            
            // Redirect to the service selection page with the professional's ID as a GET parameter
            window.location.href = `service-selection.php?professional=${professionalId}`;
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>