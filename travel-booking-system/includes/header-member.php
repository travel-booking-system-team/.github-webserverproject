<?php
if (!isset($logged_in)) {
    $logged_in = false; // Asign false if the variable is not defined
}
?>

<!DOCTYPE html>
<html>
<head>
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

        <!-- Navegação esquerda -->
        <nav class="header-nav-left">
          <ul>
            <li><a href="<?= $baseLink ?>/index.php">Home</a></li>
            <li><a href="<?= $baseLink ?>/pages/aboutus.php">About US</a></li>
            <li><a href="<?= $baseLink ?>/pages/contact.php">Contact</a></li>
          </ul>
        </nav>
        
        <!-- Navegação direita -->
        <nav class="header-nav-right">
          <ul>
            <li><a href="<?= $baseLink ?>/components/register.php">Sign Up</a></li>
            <li><a href="#" onclick="openModal()">Log In</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Modal -->
    <div id="modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
      <div>
        <?php
        $loginPath = __DIR__ . '/../components/login.php';
        if (file_exists($loginPath)) {
            include $loginPath;
        } else {
            echo "<p>Erro: Formulário de login não encontrado.</p>";
        }
        ?>
      </div>
    </div>

    <script>
      function openModal() {
        document.getElementById('modal').style.display = 'flex';
      }

      function closeModal() {
        document.getElementById('modal').style.display = 'none';
      }

      function login(){
        closeModal();
        header('Location: index.php');
        exit;
      }
    </script>
  </body>
</html>
