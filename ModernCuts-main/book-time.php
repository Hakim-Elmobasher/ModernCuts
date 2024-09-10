<?php
include 'config.php';

$id = $_POST['id'];
$sql = "UPDATE available_times SET is_booked=1 WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Booking successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
