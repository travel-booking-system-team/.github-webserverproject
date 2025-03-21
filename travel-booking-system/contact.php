<?php
include 'includes/header-member.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];


    $success_message = "Thank you, $name! Your message has been sent.";
}
?>

<div class="contact-info-container">
    <h2>Contact Information</h2>
    <p><img src="img/address-icon.png" alt="Address"> <strong>Address:</strong> 2000 Saint-Catherine St W, Montreal, QC</p>
    <p><img src="img/phone-icon.png" alt="Phone"> <strong>Phone:</strong> +1 (438) 123-4567</p>
    <p><img src="img/email-icon.png" alt="Email"> <strong>Email:</strong> contact@travelbookingsystem.com</p>
    <p><img src="img/clock-icon.png" alt="Hours"> <strong>Hours:</strong> Mon-Fri, 9:00 AM - 6:00 PM</p>
</div>


<div class="login-container">
    <h2>Send us a message</h2>

    <?php if (isset($success_message)) : ?>
        <p class="success"><?= $success_message; ?></p>
    <?php endif; ?>

    <form action="contact.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" style="width: 90%; height: 80px;" required></textarea>
        </div>

        <div class="form-buttons">
            <button type="submit" class="submit-button">Send Message</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>