<?php include '../includes/sessions.php'; ?>
<?php include '../includes/header-member.php'; ?>
<link rel="stylesheet" href="../css/main.css">

<div class="register-container">
  <h2>About Us</h2>
  <p><strong>FlyBridge Travel</strong> is a student-run airline booking project designed to make travel planning fast, intuitive, and inspiring. We believe travel should be accessible, simple, and exciting for everyone.</p>

  <h3>Our Vision</h3>
  <p>To become the most user-friendly and affordable online travel solution for discovering global destinations.</p>

  <h3>Our Mission</h3>
  <p>We strive to simplify travel by connecting travelers with the best flight deals, flexible search tools, and a seamless booking experience.</p>

  <h3>Our Values</h3>
  <ul style="text-align:left; padding-left: 2em;">
    <li><strong>Innovation:</strong> We embrace technology to improve the way people plan and book trips.</li>
    <li><strong>Transparency:</strong> No hidden fees or misleading prices.</li>
    <li><strong>Trust:</strong> We prioritize secure and reliable transactions.</li>
    <li><strong>Teamwork:</strong> We collaborate to build great digital experiences.</li>
  </ul>
</div>

<!-- Team Members Carousel -->
<div class="register-container">
  <h2>Our Team</h2>
  <div class="team-wrapper">
  <div class="team-member">
    <img src="../images/jess.jpeg" alt="Jessica Narita">
    <h4>Jessica Narita</h4>
    <p>Web Designer</p>
  </div>
  <div class="team-member">
    <img src="../images/diana.jpeg" alt="Diana Toala">
    <h4>Diana Toala</h4>
    <p>CEO</p>
  </div>
  <div class="team-member">
    <img src="../images/zenha.jpeg" alt="Caroline Zenha">
    <h4>Caroline Zenha</h4>
    <p>Marketing</p>
  </div>
  <div class="team-member">
    <img src="../images/lucas.jpeg" alt="Lucas Otaviano">
    <h4>Lucas Otaviano</h4>
    <p>Sales</p>
  </div>
</div>

</div>

<?php include '../includes/footer.php'; ?>

<!-- Carousel Script -->
<script>
function scrollTeamCarousel(direction) {
  const carousel = document.getElementById('teamCarousel');
  const scrollAmount = 200;
  carousel.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth'
  });
}
</script>
