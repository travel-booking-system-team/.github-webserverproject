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
$sql = "SELECT r.reservation_id, r.*, 
        f.flight_number, f.departure_airport, f.arrival_airport, 
        f.departure_date, f.arrival_date, f.price, f.available_seats
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
                        <div class="seats-info">
                            <p class="available-seats <?= $flight['available_seats'] > 0 ? 'seats-available' : 'seats-full' ?>">
                                <i class="fas fa-chair"></i>
                                <?= $flight['available_seats'] ?> seats available
                            </p>
                        </div>
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
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function confirmCancel() {
    return confirm('Are you sure you want to cancel this flight? This action cannot be undone.');
}
</script>

<style>
.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 15px;
    margin: 20px auto;
    border-radius: 4px;
    text-align: center;
    max-width: 80%;
    border: 1px solid #c3e6cb;
}

.seats-info {
    margin-top: 15px;
    text-align: center;
}

.available-seats {
    display: inline-flex;
    align-items: center;
    padding: 8px 15px;
    border-radius: 4px;
    font-weight: bold;
}

.available-seats i {
    margin-right: 8px;
}

.seats-available {
    background-color: #d4edda;
    color: #155724;
}

.seats-full {
    background-color: #f8d7da;
    color: #721c24;
}

.card-footer {
    padding: 15px;
    border-top: 1px solid #eee;
    text-align: center;
}

.cancel-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

.cancel-button:hover {
    background-color: #c82333;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php include '../includes/footer.php'; ?>
