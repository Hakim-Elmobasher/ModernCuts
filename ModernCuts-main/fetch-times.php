<?php
include 'config.php';

$professional = $_GET['professional'];
$sql = "SELECT * FROM available_times WHERE professional='$professional' AND is_booked=0";
$result = $conn->query($sql);

$times = [];
while($row = $result->fetch_assoc()) {
    $times[] = $row;
}

echo json_encode($times);
?>
