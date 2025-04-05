<?php
if (!isset($logged_in)) {
  session_start();
  $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
  $user_email = $logged_in ? $_SESSION['email'] : null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Travel Booking</title>
  <link href="css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="page">
  <div class="header-container">
  <?php
  $basePath = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';
  $imagePath = $basePath . '/images/header_fly.png';
  $baseLink = $basePath;
  ?>
    <div class="header-image">
      <img src="<?= $imagePath ?>" alt="Travel Header">

      <!-- Left Navigation -->
      <nav class="header-nav-left">
        <ul>
          <li><a href="<?= $baseLink ?>/index.php">Home</a></li>
          <li><a href="<?= $baseLink ?>/pages/aboutus.php">About Us</a></li>
          <li><a href="<?= $baseLink ?>/pages/contact.php">Contact</a></li>
        </ul>
      </nav>

      <!-- Right Navigation -->
      <nav class="header-nav-right">
        <ul>
          <?php if ($logged_in): ?>
            <li><a href="<?= $baseLink ?>/pages/account.php">My Account</a></li>
            <li><a href="<?= $baseLink ?>/pages/myFlights.php">My Bookings</a></li>
            <li><a href="<?= $baseLink ?>/components/logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="#" onclick="openModal('SignUp')">Sign Up</a></li>
            <li><a href="#" onclick="openModal('LogIn')">Log In</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>

 
  
  
</body>

<script>
function openModal(type) {
  closeModal();
  if (type === 'LogIn') {
    document.getElementById('modalLogIn').style.display = 'flex';
  } else if (type === 'SignUp') {
    document.getElementById('modalSignUp').style.display = 'flex';
  }
}

function closeModal() {
  document.getElementById('modalLogIn').style.display = 'none';
  document.getElementById('modalSignUp').style.display = 'none';
}
</script>
</html>
