<?php
  include 'includes/sessions.php';
  // Make use of the `require_login` function which you define in includes/sessions.php
  require_login( $logged_in );
?>

<?php include 'includes/header-member.php'; ?>

<h1>Account</h1>
A user account page goes here.

<?php include 'includes/footer.php'; ?>