<?php
// Start the session
session_start();

// Assuming these services would be fetched from a database or another source
$services = [
    ['id' => 1, 'name' => 'Clipper Haircut', 'duration' => '1 hr', 'price' => '$50'],
    ['id' => 2, 'name' => 'Scissor Haircut/Styled', 'duration' => '1 hr', 'price' => '$60'],
    ['id' => 3, 'name' => 'Clipper Haircut + Beard/Shave', 'duration' => '1 hr', 'price' => '$60'],
    ['id' => 4, 'name' => 'Scissor Haircut/Styled + Beard/Shave', 'duration' => '1 hr', 'price' => '$65'],
];

$selectedService = null;
if (isset($_GET['service_id'])) {
    $serviceId = (int)$_GET['service_id'];
    foreach ($services as $service) {
        if ($service['id'] === $serviceId) {
            $selectedService = $service;
            break;
        }
    }
}

// Initialize selectedProfessional to an empty string as a fallback
$professional = '';
// Check if 'selectedProfessional' exists in the session
if (isset($_SESSION['selectedProfessional'])) {
    // If it exists, assign it to the $professional variable
    $professional = $_SESSION['selectedProfessional'];
}


/// Save professional's name to session if it exists in URL
if (isset($_GET['professional'])) {
    $_SESSION['selectedProfessional'] = $_GET['professional'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service-selection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function checkServiceSelected() {
            if (!document.getElementById('chooseTimeBtn').hasAttribute('href')) {
                alert('Please select a service before choosing a professional.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="container mt-4">
    <div class="breadcrumb mb-4">
        Professional > Service 
    </div>

    <h1 class="mb-4">Choose a service</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($services as $service): ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title"><?= $service['name'] ?></h2>
                        <p class="card-text"><?= $service['duration'] ?></p>
                        <p class="card-text"><?= $service['price'] ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="?service_id=<?= $service['id'] ?>&professional=<?= urlencode($professional) ?>" class="btn btn-primary">Select</a>
                    </div>
                </div>
            </div>
            <!-- To force "Clipper Haircut + Beard/Shave" to the next row after "Scissor Haircut/Styled" -->
            <?php if ($service['id'] === 2): ?>
                <div class="w-100"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Your order box -->
<div class="card mt-4">
    <div class="card-body">
        <h2>Your order</h2>
        
        <?php if ($selectedService): ?>
            <p><?= $selectedService['name'] ?></p>
            <p><?= $selectedService['price'] ?></p>
            <!-- A button to proceed to the next step -->
            <a id="chooseTimeBtn" href="professional-selection2.php?service_id=<?= $selectedService['id'] ?>&professional=<?= urlencode($professional) ?>&service_name=<?= urlencode($selectedService['name']) ?>&service_price=<?= urlencode($selectedService['price']) ?>" class="btn btn-primary" onclick="return checkServiceSelected();">Choose a Professional</a>


        <?php else: ?>
            <p>No service selected</p>
            <!-- If no service is selected, we display a button without href attribute -->
            <a id="chooseTimeBtn" class="btn btn-primary" onclick="return checkServiceSelected();">Choose a Professional</a>
        <?php endif; ?>
    </div>
</div>

</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
