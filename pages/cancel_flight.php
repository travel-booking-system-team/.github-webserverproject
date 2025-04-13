<?php
include '../includes/sessions.php';
include '../includes/db.php';
if (!$logged_in || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/myFlights.php");
    exit;
}
$reservation_id = $_POST['reservation_id'];
$stmt = $conn->prepare("DELETE FROM reservations WHERE id = ? AND user_email = ?");
$stmt->bind_param("is", $reservation_id, $_SESSION['email']);
$stmt->execute();
header("Location: myFlights.php");
exit;