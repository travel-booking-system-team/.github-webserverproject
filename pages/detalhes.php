<?php

// Include necessary files
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if the user is logged in
require_login($logged_in);

$flight_id = $_GET['flight_id'] ?? null;

if (!$flight_id) {
    die("No flight selected");
}

// Get flight details from database
$sql = "SELECT * FROM flights WHERE flight_id = :flight_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['flight_id' => $flight_id]);
$flight = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$flight) {
    die("Flight not found");
}

include '../includes/header-member.php';

// Handle the purchase
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_ticket'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    
    if ($user_id && $flight_id) {
        try {
            $pdo->beginTransaction();
            
            // Check if seats are available
            $check_sql = "SELECT available_seats FROM flights 
                         WHERE flight_id = :flight_id 
                         AND available_seats > 0 
                         FOR UPDATE";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->execute(['flight_id' => $flight_id]);
            $available_seats = $check_stmt->fetchColumn();
            
            if ($available_seats <= 0) {
                throw new Exception("No seats available");
            }

            // Create reservation
            $now = date('Y-m-d H:i:s');
            $reservation_sql = "INSERT INTO reservations 
                              (user_id, flight_id, reservation_date, status, payment_status, created_at, updated_at)
                              VALUES 
                              (:user_id, :flight_id, :reservation_date, 'confirmed', 'paid', :created_at, :updated_at)";
            
            $res_stmt = $pdo->prepare($reservation_sql);
            $res_stmt->execute([
                'user_id' => $user_id,
                'flight_id' => $flight_id,
                'reservation_date' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            // Update available seats
            $update_sql = "UPDATE flights 
                          SET available_seats = available_seats - 1,
                              updated_at = NOW()
                          WHERE flight_id = :flight_id";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->execute(['flight_id' => $flight_id]);

            // Commit transaction
            $pdo->commit();

            // Get updated flight data
            $sql = "SELECT available_seats FROM flights WHERE flight_id = :flight_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['flight_id' => $flight_id]);
            $updated_seats = $stmt->fetchColumn();

            // After successful purchase, update the success message
            $_SESSION['success_message'] = "Flight booked successfully! 
                From {$flight['departure_airport']} to {$flight['arrival_airport']}. 
                Remaining seats: {$updated_seats}";
            header("Location: dashboard.php");
            exit();

        } catch (Exception $e) {
            $pdo->rollBack();
            $error = $e->getMessage();
        }
    }
}

// Get fresh flight data before display
$sql = "SELECT * FROM flights WHERE flight_id = :flight_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['flight_id' => $flight_id]);
$flight = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="register-container">
    <h2>Flight Details</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <div class="card_d-header">
        <h3 class="flight-number"><?= htmlspecialchars($flight['arrival_airport']) ?></h3>
        <p class="price">$<?= number_format($flight['price'], 2, '.', ',') ?></p>
    </div>
    
    <div class="card_d-body">
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
    
    <div class="card_d-footer">
        <div class="seats-status <?= $flight['available_seats'] > 0 ? 'seats-available' : 'seats-full' ?>">
            <div class="seats-icon">
                <i class="fas fa-chair"></i>
            </div>
            <div class="seats-info">
                <span class="seats-count"><?= $flight['available_seats'] ?></span>
                <span class="seats-label">Seats Available</span>
            </div>
        </div>
    </div>
</div>

<?php if ($flight['available_seats'] > 0): ?>
    <div class="register-container">
        <form method="POST" class="buy-form">
            <h3>Payment Information</h3>
            
            <input type="hidden" name="flight_id" value="<?= $flight_id ?>">

            <div class="form-group">
                <label for="card_name">Cardholder Name:</label>
                <input type="text" id="card_name" name="card_name" required>
            </div>

            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" maxlength="16" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date (MM/YY):</label>
                <input type="text" id="expiry_date" name="expiry_date" maxlength="5" placeholder="MM/YY" required>
            </div>

            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="4" required>
            </div>

            <button type="submit" name="buy_ticket" class="submit-button">Purchase Ticket</button>
        </form>
    </div>
<?php else: ?>
    <div class="sold-out-message">
        <i class="fas fa-exclamation-circle"></i>
        <p class="error-message">Sorry, this flight is fully booked.</p>
    </div>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>

<style>
.seats-available {
    font-size: 1.2em;
    text-align: center;
    margin: 15px 0;
    color: #1a2745ff;
    font-weight: bold;
}

.alert {
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    text-align: center;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.error-message {
    color: #dc3545;
    text-align: center;
    font-weight: bold;
    margin: 20px 0;
}

.submit-button {
    background-color: #eab308ff;
    color: #1a2745ff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-family: 'Quicksand', sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 15px;
    width: 100%;
}

.submit-button:hover {
    opacity: 0.9;
}

.card_d-footer {
    padding: 15px;
    border-top: 1px solid #eee;
    margin-top: 20px;
}

.seats-status {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    border-radius: 8px;
    margin: 10px 0;
}

.seats-available {
    background-color: #d4edda;
    color: #155724;
}

.seats-full {
    background-color: #f8d7da;
    color: #721c24;
}

.seats-icon {
    margin-right: 10px;
    font-size: 24px;
}

.seats-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.seats-count {
    font-size: 24px;
    font-weight: bold;
    line-height: 1;
}

.seats-label {
    font-size: 14px;
    margin-top: 4px;
}

.seats-summary {
    margin: 20px 0;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 5px;
    text-align: center;
}

.seats-remaining {
    color: #1a2745ff;
    font-weight: bold;
    margin-top: 5px;
}

.sold-out-message {
    text-align: center;
    padding: 20px;
    background-color: #f8d7da;
    border-radius: 5px;
    margin: 20px 0;
}

.sold-out-message i {
    font-size: 24px;
    color: #dc3545;
    margin-bottom: 10px;
}
</style>
