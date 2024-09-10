<?php
include 'config.php'; // Include your config file

// Fetch reviews
$sql = "SELECT firstName, lastName, message FROM Reviews";
$result = $conn->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($reviews, $row);
    }
    echo json_encode($reviews);
} else {
    echo json_encode([]);
}

$conn->close();
?>
