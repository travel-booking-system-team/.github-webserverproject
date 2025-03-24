<?php
include '../includes/sessions.php'; // sessions

// Si el usuario ya está logueado, redirigirlo a su cuenta
if ($logged_in) {
    header('Location: account.php');
    exit;
}

// Manejar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['email']; // Capturar email del formulario
    $user_password = $_POST['password']; // Capturar password del formulario

    // Verificar credenciales (esto se reemplazará con la base de datos en el futuro)
    if ($user_email == $email && $user_password == $password) {
        login(); // Iniciar sesión
        header('Location: account.php'); // Redirigir al dashboard
        exit;
    } else {
        $error_message = "Invalid email or password.";
    }
}

include '../includes/header-member.php'; // includes header

?>
<link rel="stylesheet" href="../css/main.css">

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($error_message)) : ?>
        <p class="error"><?= $error_message; ?></p>
    <?php endif; ?>

    <form action="pages/login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-buttons">
            <button type="button" class="cancel-button">Cancel</button>
            <button type="submit" class="submit-button">Login</button>
        </div>
    </form>
        <!-- Link to register page -->
        <p class="register-link">
        Don't have an account? <a href="register.php">Sign up here</a>
    </p>
</div>

<?php include '../includes/footer.php'; // Incluir el footer ?>