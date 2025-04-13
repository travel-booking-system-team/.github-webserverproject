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
            <li><a href="#" onclick="openModal('SingUp')">Sign Up</a></li>
            <li><a href="#" onclick="openModal('LogIn')">Log In</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Modal Log in -->
    <div id="modalLogIn" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
      <div>
        <?php
        $loginPath = __DIR__ . '/../components/login.php';
        if (file_exists($loginPath)) {
            include $loginPath;
        } else {
            echo "<p>Error: form not found.</p>";
        }
        ?>
      </div>
    </div>

    <!-- Modal sing Up to do also a component -->
    <div id="modalSingUp" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
      <div>
        <?php
        $loginPath = __DIR__ . '/../components/singUp.php';
        if (file_exists($loginPath)) {
            include $loginPath;
        } else {
            echo "<p>Error: form not found.</p>";
        }
        ?>
      </div>
    </div>

    <script>
      function openModal(typeModal) {
        if (typeModal == "LogIn"){
          document.getElementById('modalLogIn').style.display = 'flex';

        }else if (typeModal == "SingUp"){
          document.getElementById('modalSingUp').style.display = 'flex';
        }
      }

      function closeModal() {
        document.getElementById('modalSingUp').style.display = 'none';
        document.getElementById('modalLogIn').style.display = 'none';
      }

      function login(){
        closeModal();
        header('Location: index.php');
        exit;
      }

      function goToModal(type) {
        if (type == "modalLogIn"){
          document.getElementById('modalLogIn').style.display = 'flex';
          document.getElementById('modalSingUp').style.display = 'none';

        }else if (type == "modalSingUp"){
          document.getElementById('modalSingUp').style.display = 'flex';
          document.getElementById('modalLogIn').style.display = 'none';
        }
      }

    </script>
  </body>
</html>
