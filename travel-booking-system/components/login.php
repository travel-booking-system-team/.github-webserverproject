<?php
// Simulação de verificação de login
$logged_in = false; // Aqui você definiria a verificação real de login
$email = "usuario@example.com"; // Email de exemplo
$password = "senha123"; // Senha de exemplo

// Si el usuario ya está logueado, redirigirlo a su cuenta
if ($logged_in) {
    header('Location: account.php');
    exit;
}

// Manejar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['email']; // Capturar email del formulario
    $user_password = $_POST['password']; // Capturar password del formulario

    // Verificar as credenciais
    if ($user_email == $email && $user_password == $password) {
        // Função de login (exemplo)
        login(); // Substitua esta função pela lógica real de login

        // Redirecionar para o dashboard
        header('Location: pages/dashboard.php'); 
        exit;
    } else {
        // Mensagem de erro
        $error_message = "Invalid email or password.";
    }
}

?>

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($error_message)) : ?>
        <p class="error"><?= $error_message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-buttons">
            <button type="button" class="cancel-button" onclick="closeModal()">Cancel</button>
            <button type="submit" class="submit-button">Login</button>
        </div>
    </form>
    
    <!-- Link to register page -->
    <p class="register-link">
        Don't have an account? <a href="register.php">Sign up here</a>
    </p>
</div>
