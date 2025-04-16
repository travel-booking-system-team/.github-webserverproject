<?php
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if user is logged in
require_login($logged_in);

if (!$logged_in || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/myFlights.php");
    exit;
}

$reservation_id = $_POST['reservation_id'];
$user_id = $_SESSION['user_id'];

// Start transaction
try {
    $pdo->beginTransaction();

    // First, verify that the reservation belongs to the user
    $check_sql = "SELECT reservation_id FROM reservations 
                  WHERE reservation_id = :reservation_id 
                  AND user_id = :user_id";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute([
        ':reservation_id' => $reservation_id,
        ':user_id' => $user_id
    ]);

    if ($check_stmt->rowCount() === 0) {
        throw new Exception('Reservation not found or does not belong to you.');
    }

    // 1. Delete related passenger records
    $sql_passengers = "DELETE FROM passengers WHERE reservation_id = :reservation_id";
    $stmt = $pdo->prepare($sql_passengers);
    $stmt->execute([':reservation_id' => $reservation_id]);

    // 2. Delete related payment records (if any exist)
    $sql_payments = "DELETE FROM payments WHERE reservation_id = :reservation_id";
    $stmt = $pdo->prepare($sql_payments);
    $stmt->execute([':reservation_id' => $reservation_id]);

    // 3. Finally, delete the reservation
    $sql_reservation = "DELETE FROM reservations 
                       WHERE reservation_id = :reservation_id 
                       AND user_id = :user_id";
    $stmt = $pdo->prepare($sql_reservation);
    $stmt->execute([
        ':reservation_id' => $reservation_id,
        ':user_id' => $user_id
    ]);

    // If we got here, commit the transaction
    $pdo->commit();
    $_SESSION['success_message'] = 'Flight cancelled successfully!';

} catch (Exception $e) {
    // Something went wrong, rollback the transaction
    $pdo->rollBack();
    $_SESSION['error_message'] = 'Error cancelling flight. Please try again.';
}

// Redirect back to dashboard
header("Location: dashboard.php");
exit;