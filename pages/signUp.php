<?php
include '../includes/db.php';
include '../includes/functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'All fields are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    $sql = "SELECT user_id FROM users WHERE email = :email";
    $existing_user = pdo($pdo, $sql, ['email' => $email])->fetch();

    if ($existing_user) {
        $errors[] = 'Email is already registered.';
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (fullname, email, password, created_at, updated_at)
                VALUES (:fullname, :email, :password, NOW(), NOW())";

        pdo($pdo, $sql, [
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password_hash
        ]);

        //redirect_to('login.php');
        echo "<script>
                alert('User registered successfully!');
                window.location.href = 'login.php';
            </script>";
        exit;

    }

    
    if (strlen($fullname) < 3) {
        $errors[] = 'Full name must be at least 3 characters long.';
    }

    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must be at least 8 characters long and include uppercase, lowercase letters and a number.';
    }
}


?>

<?php include '../includes/header-member.php'; ?>
<link href="../css/main.css" rel="stylesheet">

<div class="register-container">
    <h2>Sign Up</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?= isset($fullname) ? htmlspecialchars($fullname) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-buttons">
            <button type="submit" class="submit-button">Sign Up</button>
            <a href="index.php" class="cancel-button">Cancel</a>
        </div>
    </form>

    <p class="login-link">
        Already have an account? <a href="login.php">Log in here</a>
    </p>
</div>

<!-- Include the footer in the includes/ directory -->
<?php include '../includes/footer.php'; ?>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const fullName = document.getElementById('full_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    let errors = [];

    if (fullName.length < 3) {
        errors.push("Full name must be at least 3 characters.");
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors.push("Invalid email format.");
    }

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        errors.push("Password must be at least 8 characters and include uppercase, lowercase, and a number.");
    }

    if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
    }

    if (errors.length > 0) {
        e.preventDefault(); // Evita o envio do formulário
        alert(errors.join("\n"));
    }
});
</script>
