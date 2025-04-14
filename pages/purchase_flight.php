<?php
// Include necessary files
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';

// Check if the user is logged in
require_login($logged_in);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_id = $_POST['flight_id']; // Get the selected flight ID
    $user_id = $id; // The logged-in user's ID

    // Insert the reservation into the reservations table
    $sql = "INSERT INTO reservations (user_id, flight_id, reservation_date) VALUES (:user_id, :flight_id, NOW())";
    
    try {
        pdo($pdo, $sql, ['user_id' => $user_id, 'flight_id' => $flight_id]);
        $success_message = 'Your flight has been successfully purchased!';
    } catch (PDOException $e) {
        $errors['message'] = 'Error making reservation: ' . $e->getMessage();
    }
}

// Query to get the available flights
$sql = "SELECT * FROM flights";
$flights = pdo($pdo, $sql)->fetchAll();
?>
<link rel="stylesheet" href="../css/main.css">
<?php include '../includes/header-member.php'; ?>

<div class="purchase-container">
    <h2>Purchase a Flight</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <p class="error"><?= $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($success_message)): ?>
        <p class="success"><?= $success_message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="flight_id">Choose your flight:</label>
            <select name="flight_id" id="flight_id" required>
                <?php foreach ($flights as $flight): ?>
                    <option value="<?= $flight['id']; ?>"><?= $flight['origin']; ?> → <?= $flight['destination']; ?> (<?= $flight['price']; ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-buttons">
            <button type="submit" class="submit-button">Buy Now</button>
        </div>
    </form>

    <h3>Available Flights</h3>
    <table>
        <thead>
            <tr>
                <th>Origin</th>
                <th>Destination</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?= $flight['origin']; ?></td>
                    <td><?= $flight['destination']; ?></td>
                    <td><?= $flight['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
