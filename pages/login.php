<?php
// login example
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/db.php';
$logged_in = false; // login verification

// Incluir arquivo de conexão ao banco
include  '../includes/db.php';


//if logged, it goes to the account page
if ($logged_in) {
    header('Location: dashboard.php');
    exit;
}

// A senha que você quer hashificar
$senha = '123456'; // Substitua por sua senha

// Gerar o hash usando bcrypt
$hash = password_hash($senha, PASSWORD_BCRYPT);

// Exibir o hash gerado
echo "O hash da sua senha é: " . $hash;

// login form
if ( $logged_in ) {
    header( 'Location: account.php' );
    // What command can you use here to stop script execution?
    exit;
  }
  $errors=[];

  if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $user_email    = $_POST[ 'email'    ]; // Capture the email from the body of the POST request
    $user_password = $_POST[ 'password' ]; // Capture the password from the body of the POST request

    $sql = "SELECT user_id,fullname,email,password FROM users 
        WHERE email =:email;";

    $member=pdo( $pdo, $sql, ['email' => $user_email])-> fetch();

    if(!$member ){
      $errors['member'] = 'No user with this email can be found!';
    }else {
      if ( password_verify($user_password, $member['password']) ) {
        login($member);
        // Redirect the user to the account page
        header( 'Location: dashboard.php' );
        exit;
      }else{
        $errors['message'] = 'Please try again';
      }
    }
    
}
?>

<?php include '../includes/header-member.php'; ?>
<link rel="stylesheet" href="../css/main.css">
<div class="login-container">
    <?php
        $baseLink = (str_contains($_SERVER['SCRIPT_NAME'], '/pages/')) ? '..' : '.';
    ?>

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
        Don't have an account? <a href="signup.php">Sign Up here</a>
     </p>
</div>
<?php include '../includes/footer.php'; ?>