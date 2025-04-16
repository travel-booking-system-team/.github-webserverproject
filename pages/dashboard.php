<?php
// Include necessary files
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if user is logged in
require_login($logged_in);

// Get user ID
$user_id = $_SESSION['user_id'] ?? null;

include '../includes/header-member.php';

// Fetch reservations for the current user
$sql = "SELECT r.reservation_id, r.*, f.flight_number, f.departure_airport, f.arrival_airport, f.departure_date, f.arrival_date, f.price
        FROM reservations r
        JOIN flights f ON r.flight_id = f.flight_id
        WHERE r.user_id = :user_id 
        AND (r.status != 'cancelled' OR r.status IS NULL)
        ORDER BY r.reservation_date DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$reservations = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../css/main.css">
<div class="register-container_dash">
    <h2>My Flights</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success-message">
            <?= $_SESSION['success_message'] ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error-message">
            <?= $_SESSION['error_message'] ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (count($reservations) === 0): ?>
        <div class="no-flights">
            <h1>No flights on your account yet</h1>
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
                        <div class="card-footer">
                            <p><strong>Reserved on:</strong> <?= date('Y-m-d H:i', strtotime($flight['reservation_date'])) ?></p>
                            <p><strong>Flight number:</strong> <?= $flight['flight_number'] ?></p>
                            <form action="cancel_flight.php" method="POST" onsubmit="return confirmCancel()">
                                <input type="hidden" name="reservation_id" value="<?= $flight['reservation_id'] ?>">
                                <button type="submit" class="dashboard-cancel-button">Cancel Flight</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function confirmCancel() {
    return confirm('Are you sure you want to cancel this flight? This action cannot be undone.');
}
</script>

<?php include '../includes/footer.php'; ?>
