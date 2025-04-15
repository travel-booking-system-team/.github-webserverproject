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

// Fetch user data
$sql = "SELECT fullname, email, created_at, updated_at FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();
?>

<link rel="stylesheet" href="../css/main.css">
<div class="register-container_dash_account">
    <h2>My Profile</h2>

    <?php if (!$user): ?>
        <div class="no-flights_account">
            <h1>User not found</h1>
        </div>
    <?php else: ?>
        <div class="flight-card_account">
            <div class="card-header_account">
                <h3 class="name_account"><?= htmlspecialchars($user['fullname']) ?></h3>
                <p class="price_account"><?= htmlspecialchars($user['email']) ?></p>
            </div>
            <div class="card-body_account">
                <p><strong>Account created:</strong> <?= htmlspecialchars($user['created_at']) ?></p>
                <p><strong>Last updated:</strong> <?= htmlspecialchars($user['updated_at']) ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
