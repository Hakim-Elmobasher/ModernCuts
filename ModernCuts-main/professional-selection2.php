<?php
// Start the session
session_start();

$professionals = [
    ['name' => 'Miguel', 'availability' => 'Available Wednesday, Oct 4', 'image' => 'Miguel5.jpg'],
    ['name' => 'Walter', 'availability' => 'Available Wednesday, Oct 4', 'image' => 'Walter3.jpg'],
    ['name' => 'Hakim', 'availability' => 'Available Wednesday, Oct 4', 'image' => 'Hakim.jpg'],
    ['name' => 'Greg', 'availability' => 'Available Wednesday, Oct 4', 'image' => 'Greg1.jpg'],
    ['name' => 'Will', 'availability' => 'Available Wednesday, Oct 4', 'image' => 'Will.jpg'],
    // ... add other professionals here
];

// Check if professional name is passed and set it to session
if (isset($_GET['professional'])) {
    $_SESSION['selectedProfessional'] = $_GET['professional'];
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
                <div class="card professional" data-name="<?= $pro['name'] ?>">
                    <img src="images/<?= $pro['image'] ?>" alt="<?= $pro['name'] ?>" class="card-img-top">

                    <div class="card-body">
                        <h5 class="card-title"><?= $pro['name'] ?></h5>
                        <p class="card-text"><?= $pro['availability'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- JavaScript to handle professional selection -->
<script>
    // Attach click event to each professional
    document.querySelectorAll('.professional').forEach(professional => {
        professional.addEventListener('click', function() {
            // Get the professional's name
            let professionalName = this.getAttribute('data-name');
            
            // Redirect to the service selection page with the professional's name as a GET parameter
            window.location.href = `booking_time.php?professional=${professionalName}`;
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
