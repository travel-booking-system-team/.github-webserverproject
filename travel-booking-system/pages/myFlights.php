<?php
  include '../includes/sessions.php';
  include '../includes/db.php';
  if (!$logged_in) {
      header("Location: ../components/login.php");
      exit;
  }

  $user_email = $_SESSION['email'];
  $stmt = $conn->prepare("SELECT r.id AS reservation_id, f.* FROM reservations r JOIN flights f ON r.flight_id = f.id WHERE r.user_email = ? ORDER BY r.booking_date DESC");
  $stmt->bind_param("s", $user_email);
  $stmt->execute();
  $result = $stmt->get_result();

?>

<!-- HTML loop showing each booking + cancel form -->

<?php include '../includes/header-member.php'; ?>
<link rel="stylesheet" href="../css/main.css">

  <div class="register-container">
      <h2>My flights</h2>


  </div>
<?php include '../includes/footer.php'; ?>
