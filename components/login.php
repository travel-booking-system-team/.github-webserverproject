<?php
// login example
$logged_in = false; // login verification
$email = "usuario@example.com"; 
$password = "senha123"; 

//if logged, it goes to the account page
if ($logged_in) {
    header('Location: account.php');
    exit;
}

// login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['email'];
    $user_password = $_POST['password']; 

    if ($user_email == $email && $user_password == $password) {
        login(); 
        header('Location: pages/dashboard.php'); 
        exit;
    } else {
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
        Don't have an account? <a onclick="goToModal('modalSingUp')" style="cursor: pointer;">Sign up here</a>
    </p>
</div>
