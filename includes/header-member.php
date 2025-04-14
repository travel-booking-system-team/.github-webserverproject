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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="css/main.css" rel="stylesheet">
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

        <!-- left nav -->
        <nav class="header-nav-left">
          <ul>
            <li><a href="<?= $baseLink ?>/index.php">Home</a></li>
            <li><a href="<?= $baseLink ?>/pages/aboutus.php">About US</a></li>
            <li><a href="<?= $baseLink ?>/pages/contact.php">Contact</a></li>
          </ul>
        </nav>
        <!-- right nav -->
        <nav class="header-nav-right">
          
          <ul>        
            <li class="user-name"><?= $fullname ?></li>
          </ul>
          
          <ul>
            <?php if ($logged_in): ?>
              <!-- Exibe o nome do usuário e os links de Dashboard e My Account -->
              <li><a href="<?= $baseLink ?>/pages/dashboard.php">Dashboard</a></li>
              <li><a href="<?= $baseLink ?>/pages/account.php">My Account</a></li>
              <li><a href="<?= $baseLink ?>/pages/logout.php">Log Out</a></li>
            <?php else: ?>
              <!-- Se não estiver logado, exibe os links para Login e Sign Up -->
              <li><a href="<?= $baseLink ?>/pages/signup.php">Sign Up</a></li>
              <li><a href="<?= $baseLink ?>/pages/login.php">Log In</a></li>
            <?php endif; ?>
        <!-- right nav -->
        <nav class="header-nav-right">
          <ul>
            <li><a href="#" onclick="openModal('SingUp')">Sign Up</a></li>
            <li><a href="#" onclick="openModal('LogIn')">Log In</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>
