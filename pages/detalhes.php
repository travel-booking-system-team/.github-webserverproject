<?php

// Include necessary files
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if the user is logged in
require_login($logged_in);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_id = $_POST['flight_id'];
    $user_id = $id;

    // Insert reservation
    $sql = "INSERT INTO reservations (user_id, flight_id, reservation_date) VALUES (:user_id, :flight_id, NOW())";
    
    try {
        pdo($pdo, $sql, ['user_id' => $user_id, 'flight_id' => $flight_id]);
        $success_message = 'Your flight has been successfully purchased!';
    } catch (PDOException $e) {
        $errors['message'] = 'Error making reservation: ' . $e->getMessage();
    }
}

// Flight data (example/mock)
$viagens = [
    1 => [
        'flight_number' => 'AA101',
        'departure_airport' => 'Caracas',
        'arrival_airport' => 'Toronto',
        'departure_date' => '2025-05-01 08:00:00',
        'arrival_date' => '2025-05-01 10:30:00',
        'price' => 320.00,
        'available_seats' => 150
    ],
    2 => [
        'flight_number' => 'DL202',
        'departure_airport' => 'Toronto',
        'arrival_airport' => 'Montreal',
        'departure_date' => '2025-05-02 11:00:00',
        'arrival_date' => '2025-05-02 12:30:00',
        'price' => 180.00,
        'available_seats' => 120
    ],
    3 => [
        'flight_number' => 'UA303',
        'departure_airport' => 'Montreal',
        'arrival_airport' => 'Vancouver',
        'departure_date' => '2025-05-03 13:00:00',
        'arrival_date' => '2025-05-03 15:30:00',
        'price' => 220.00,
        'available_seats' => 180
    ],
    4 => [
        'flight_number' => 'SW404',
        'departure_airport' => 'Vancouver',
        'arrival_airport' => 'Calgary',
        'departure_date' => '2025-05-04 07:30:00',
        'arrival_date' => '2025-05-04 09:00:00',
        'price' => 250.00,
        'available_seats' => 200
    ],
    5 => [
        'flight_number' => 'BA505',
        'departure_airport' => 'Calgary',
        'arrival_airport' => 'Ottawa',
        'departure_date' => '2025-05-05 14:00:00',
        'arrival_date' => '2025-05-05 17:00:00',
        'price' => 210.00,
        'available_seats' => 10
    ]
];

// Get flight ID from URL
$flight_id = $_GET['flight_id'] ?? null;

if ($flight_id && isset($viagens[$flight_id])) {
    $flight = $viagens[$flight_id];
} else {
    echo "Flight not found";
    exit;
}

include '../includes/header-member.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_ticket'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    $flight_id = $_POST['flight_id'];

    if ($user_id && $flight_id) {
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO reservations (user_id, flight_id, reservation_date, status, payment_status, created_at, updated_at)
                VALUES (:user_id, :flight_id, :reservation_date, 'pending', 'unpaid', :created_at, :updated_at)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':flight_id' => $flight_id,
            ':reservation_date' => $now,
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);

        echo "<script>alert('Purchase completed successfully!'); window.location.href='dashboard.php';</script>";
        exit;
    }
}
?>

<link rel="stylesheet" href="../css/main.css">

<div class="register-container">
    <h2>Flight Details</h2>
        <div class="card_d-header">
            <h3 class="flight-number"><?= $flight['arrival_airport']; ?></h3>
            <p class="price">$<?= number_format($flight['price'], 2, '.', ','); ?></p>
        </div>
        <div class="card_d-body">
            <div class="departure">
                <h4>Departure</h4>
                <p><strong>From:</strong> <?= $flight['departure_airport']; ?></p>
                <p><strong>Date:</strong> <?= date('Y-m-d H:i', strtotime($flight['departure_date'])); ?></p>
            </div>
            <div class="departure">
                <h4>Arrival</h4>
                <p><strong>To:</strong> <?= $flight['arrival_airport']; ?></p>
                <p><strong>Date:</strong> <?= date('Y-m-d H:i', strtotime($flight['arrival_date'])); ?></p>
            </div>
        </div>
        <div class="card_d-footer">
            <p><strong>Available Seats:</strong> <?= $flight['available_seats']; ?></p>
        </div>
</div>

<div class="register-container">
    <?php if (isset($flight) && isset($_SESSION['user_id'])): ?>
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

            <button type="submit" name="buy_ticket">Purchase Ticket</button>
        </form>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>
