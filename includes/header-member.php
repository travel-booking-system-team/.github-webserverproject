<?php
// Iniciar ou retomar a sessão
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Verificar se o usuário está logado
$logged_in = $_SESSION['logged_in'] ?? false;
$fullname = $_SESSION['fullname'] ?? '';

// Definir o caminho da imagem do header
$basePath = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';
$imagePath = $basePath . '/images/header_fly.png';
$baseLink = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';

include 'sessions.php';
include 'functions.php';
require_login($logged_in);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - YouFly</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Your custom CSS -->
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <div class="page">
    <div class="header-container">
      <?php
        $basePath = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';
        $imagePath = $basePath . '/images/header_fly.png';
        $baseLink = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';
      ?>

      <div class="header-image">
        <img src="<?= $imagePath ?>" alt="Travel Header">

        <!-- Hamburger Menu Button -->
        <div class="hamburger" onclick="toggleMenu()">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>

        <!-- Navigation Menu -->
        <nav class="nav-menu">
          <ul>
            <li><a href="<?= $baseLink ?>/index.php">Home</a></li>
            <li><a href="<?= $baseLink ?>/pages/aboutus.php">About US</a></li>
            <li><a href="<?= $baseLink ?>/pages/contact.php">Contact</a></li>
            <li><a href="<?= $baseLink ?>/pages/faq.php">FAQ</a></li>
            <li><a href="<?= $baseLink ?>/pages/dashboard.php">My Flights</a></li>
            <li><a href="<?= $baseLink ?>/pages/account.php">My Account</a></li>
            <li><a href="<?= $baseLink ?>/pages/logout.php" onclick="logout()">Logout</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <script>
  function toggleMenu() {
    const navMenu = document.querySelector('.nav-menu');
    const hamburger = document.querySelector('.hamburger');
    
    navMenu.classList.toggle('active');
    hamburger.classList.toggle('active');
  }

  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    const navMenu = document.querySelector('.nav-menu');
    const hamburger = document.querySelector('.hamburger');
    
    if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) {
      navMenu.classList.remove('active');
      hamburger.classList.remove('active');
    }
  });
  </script>
</body>
</html>


