<?php
// Set session lifetime to 5 minutes (300 seconds)
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

// Retrieve the professional's ID and service's ID from the session
$professional_id = $_SESSION['selectedProfessionalId'] ?? '';
$service_id = $_SESSION['selectedServiceId'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Date and Time</title>

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles to fix datepicker appearance -->
    <style>
        .ui-datepicker {
            z-index: 1000 !important; /* Ensure the datepicker is above other elements */
        }
    </style>

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI JavaScript -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Initialize Datepicker -->
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd" // Format the date as you need
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Select a Date and Time for Your Appointment</h1>
        <form action="book-appointment.php" method="post" class="mb-3">
    <input type="hidden" name="professional_id" value="<?php echo htmlspecialchars($professional_id); ?>">
    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service_id); ?>">
    
    <div class="form-group">
        <label for="datepicker">Choose a date:</label>
        <input type="text" id="datepicker" name="selected_appointment_date" class="form-control">
    </div>

    <div class="form-group">
        <label for="timeSlot">Choose a time:</label>
        <select id="timeSlot" name="selected_appointment_time" class="form-control">
            <?php for ($i = 10; $i <= 19; $i++): ?>
                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>:00"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>:00</option>
            <?php endfor; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Book Appointment</button>
</form>
    </div>

    <!-- Bootstrap JS and its dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
