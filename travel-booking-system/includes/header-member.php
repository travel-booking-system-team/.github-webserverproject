<?php
  if (!isset($logged_in)) {
      $logged_in = false; // Asign false if the variable is not defined
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link href="css/main.css" rel="stylesheet">  <!-- Asegura que apunte correctamente al CSS -->
  </head>
  <body>
    <div class="page">
      <div class="header-container">
        <!-- Imagen del header -->
        <div class="header-image">
          <img src="images/header_fly.png" alt="Travel Header">

          <!-- Nav rigleft login -->
          <nav class="header-nav-left">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="aboutus.php">About US</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </nav>
          
          <!-- Nav right login -->
          <nav class="header-nav-right">
            <ul>
              <li><a href="contact.php">Sing Up</a></li>
              <li>
                <?= $logged_in 
                    ? '<a href="logout.php">Log Out</a>' 
                    : '<a href="login.php">Log In</a>'; 
                ?>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <section>