<?php
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Verificar se o usuário está logado
require_login($logged_in);

if (!$logged_in || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$reservation_id = $_POST['reservation_id'];
$user_id = $_SESSION['user_id'];

// Inicia transação
try {
    $pdo->beginTransaction();

    // Primeiro, verificar se a reserva pertence ao usuário
    $check_sql = "SELECT r.reservation_id, r.flight_id 
                  FROM reservations r
                  WHERE r.reservation_id = :reservation_id 
                  AND r.user_id = :user_id";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute([
        ':reservation_id' => $reservation_id,
        ':user_id' => $user_id
    ]);
    
    $reservation = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        throw new Exception('Reservation not found or does not belong to you.');
    }

    // Store flight_id for updating seats later
    $flight_id = $reservation['flight_id'];

    // 1. Deletar registros de passageiros relacionados
    $sql_passengers = "DELETE FROM passengers WHERE reservation_id = :reservation_id";
    $stmt = $pdo->prepare($sql_passengers);
    $stmt->execute([':reservation_id' => $reservation_id]);

    // 2. Deletar registros de pagamento relacionados (se existirem)
    $sql_payments = "DELETE FROM payments WHERE reservation_id = :reservation_id";
    $stmt = $pdo->prepare($sql_payments);
    $stmt->execute([':reservation_id' => $reservation_id]);

    // 3. Finalmente, delete a reserva
    $sql_reservation = "DELETE FROM reservations 
                       WHERE reservation_id = :reservation_id 
                       AND user_id = :user_id";
    $stmt = $pdo->prepare($sql_reservation);
    $stmt->execute([
        ':reservation_id' => $reservation_id,
        ':user_id' => $user_id
    ]);

    // 4. Update available seats in flights table
    $update_seats_sql = "UPDATE flights 
                        SET available_seats = available_seats + 1,
                            updated_at = NOW()
                        WHERE flight_id = :flight_id";
    $update_stmt = $pdo->prepare($update_seats_sql);
    $update_stmt->execute([':flight_id' => $flight_id]);

    // Get the updated seat count
    $get_seats_sql = "SELECT available_seats, departure_airport, arrival_airport 
                      FROM flights 
                      WHERE flight_id = :flight_id";
    $seats_stmt = $pdo->prepare($get_seats_sql);
    $seats_stmt->execute([':flight_id' => $flight_id]);
    $flight_info = $seats_stmt->fetch(PDO::FETCH_ASSOC);

    // Se chegamos aqui, commit a transação
    $pdo->commit();

    // Set success message with updated seat count
    $_SESSION['success_message'] = "Flight cancelled successfully! Flight from {$flight_info['departure_airport']} to {$flight_info['arrival_airport']} now has {$flight_info['available_seats']} available seats.";

} catch (Exception $e) {
    // Algo deu errado, rollback da transação
    $pdo->rollBack();
    $_SESSION['error_message'] = "Error: " . $e->getMessage();
}

// Redirecionar de volta para o dashboard
header("Location: dashboard.php");
exit;