<?php
include '../includes/sessions.php';
include '../includes/db.php';
if (!$logged_in) {
    header("Location: ../components/login.php");
    exit;
}
$flight_id = $_GET['flight_id'] ?? null;
if (!$flight_id) exit("No flight selected.");
$stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
$stmt->bind_param("i", $flight_id);
$stmt->execute();
$flight = $stmt->get_result()->fetch_assoc();
if (!$flight) exit("Flight not found.");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO reservations (user_email, flight_id) VALUES (?, ?)");
    $stmt->bind_param("si", $_SESSION['email'], $flight_id);
    if ($stmt->execute()) {
        echo "<h2>Booking confirmed!</h2><p><a href='../index.php'>Back to Home</a></p>";
        exit;
    } else {
        echo "Error booking flight: " . $stmt->error;
    }
}
?>
<!-- HTML with form to confirm booking -->