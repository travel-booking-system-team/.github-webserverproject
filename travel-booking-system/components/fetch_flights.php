<?php
include 'includes/db.php';
$from = $_POST['from'] ?? '';
$to = $_POST['to'] ?? '';
$stmt = $conn->prepare("SELECT * FROM flights WHERE departure_city = ? AND arrival_city = ?");
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();
$flights = [];
while ($row = $result->fetch_assoc()) {
    $flights[] = $row;
}
echo json_encode($flights);
?>