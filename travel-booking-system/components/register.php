<?php include 'includes/sessions.php'; ?>
<?php include 'includes/header-member.php'; ?>

<div class="register-container">
    <h2>Sign Up</h2>

    <form action="process_register.php" method="POST">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
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
            <button type="button" class="cancel-button">Cancel</button>
            <button type="submit" class="submit-button">Sign Up</button>
        </div>
    </form>

    <p class="login-link">
        Already have an account? <a href="login.php">Log in here</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>