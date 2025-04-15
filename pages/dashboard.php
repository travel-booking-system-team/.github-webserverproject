<?php
// Includes
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if user is logged in
require_login($logged_in);

// Get user ID
$user_id = $_SESSION['user_id'] ?? null;

// Processo de cancelar se necessario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    
    try {
        // inicio da trasacao
        $pdo->beginTransaction();
        
        // primeir, deleta o record do passageiro
        $delete_passengers_sql = "DELETE FROM passengers WHERE reservation_id = :reservation_id";
        $delete_passengers_stmt = $pdo->prepare($delete_passengers_sql);
        $delete_passengers_stmt->execute(['reservation_id' => $reservation_id]);
        
        // depois deleta a reserva
        $delete_reservation_sql = "DELETE FROM reservations WHERE reservation_id = :reservation_id AND user_id = :user_id";
        $delete_reservation_stmt = $pdo->prepare($delete_reservation_sql);
        $delete_reservation_stmt->execute([
            'reservation_id' => $reservation_id,
            'user_id' => $user_id
        ]);
        
        // grava o comando
        $pdo->commit();
        $success_message = "Flight reservation cancelled successfully!";
    } catch (PDOException $e) {
        // volta atras se algo der errado
        $pdo->rollBack();
        $error_message = "Error cancelling reservation: " . $e->getMessage();
    }
}

include '../includes/header-member.php';

// Fetch reservas para o usuario atual
$sql = "SELECT r.*, f.flight_number, f.departure_airport, f.arrival_airport, f.departure_date, f.arrival_date, f.price
        FROM reservations r
        JOIN flights f ON r.flight_id = f.flight_id
        WHERE r.user_id = :user_id
        ORDER BY r.reservation_date DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$reservations = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../css/main.css">
<div class="register-container_dash">
    <h2>My Flights</h2>

    <?php if (isset($success_message)): ?>
        <div class="success-message">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if (count($reservations) === 0): ?>
        <div class="no-flights">
            <h1>No flights on your dashboard yet</h1>
        </div>
    <?php else: ?>
        <div class="flights-grid_hash">
            <?php foreach ($reservations as $flight): ?>
                <div class="flight-card">
                    <div class="card-header">
                        <h3 class="flight-number"><?= htmlspecialchars($flight['arrival_airport']) ?></h3>
                        <p class="price">$<?= number_format($flight['price'], 2, '.', ',') ?></p>
                    </div>
                    <div class="card-body">
                        <div class="departure">
                            <h4>Departure</h4>
                            <p><strong>From:</strong> <?= htmlspecialchars($flight['departure_airport']) ?></p>
                            <p><strong>Date:</strong> <?= date('Y-m-d H:i', strtotime($flight['departure_date'])) ?></p>
                        </div>
                        <div class="departure">
                            <h4>Arrival</h4>
                            <p><strong>To:</strong> <?= htmlspecialchars($flight['arrival_airport']) ?></p>
                            <p><strong>Date:</strong> <?= date('Y-m-d H:i', strtotime($flight['arrival_date'])) ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p><strong>Reserved on:</strong> <?= date('Y-m-d H:i', strtotime($flight['reservation_date'])) ?></p>
                        <p><strong>Flight number:</strong> <?= $flight['flight_number'] ?></p>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this flight reservation?');">
                            <input type="hidden" name="reservation_id" value="<?= $flight['reservation_id'] ?>">
                            <button type="submit" name="cancel_reservation" class="cancel-button">Cancel Flight</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
