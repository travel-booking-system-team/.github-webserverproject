<?php 
  include 'includes/sessions.php';
  // Include header-member in the includes/ directory
?>
<link rel="stylesheet" href="css/main.css">

<?php include 'includes/header-member.php'; ?>

<h1>Home</h1>

<div class="search">
<h2>Flight Search</h2>
    <form method="POST">
        <label>From:</label>
        <input type="text" name="from" value="Montreal">
        <label>To:</label>
        <input type="text" name="to" value="Caracas">
        <label>Departure:</label>
        <input type="date" name="departure" value="2025-03-12">
        <label>Return:</label>
        <input type="date" name="return" value="2025-03-19">
        <label>Passengers:</label>
        <select name="passengers">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <label>Class:</label>
        <select name="class">
            <option>Economy</option>
            <option>Business</option>
            <option>First Class</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<h3>Flight Results</h3>';
        for ($i = 0; $i < 4; $i++) {
            echo '
            <div class="flight-result">
                <img src="https://source.unsplash.com/200x100/?beach" alt="Miami">
                <h4>Miami</h4>
                <p>Apr 4 - Apr 10</p>
                <p>Nonstop 3h 50 min</p>
                <p><strong>CA$175</strong></p>
            </div>';
        }
    }
    ?>

</div>

<div class="faq">
    
  <h3>Frequently Asked Questions</h3>
      <div class="faq-section">
          <div class="faq-question" onclick="toggleFAQ('faq1')">How can I find last-minute flight deals?</div>
          <div class="faq-answer" id="faq1">Check airline websites frequently, use flight comparison tools, and set up price alerts.</div>

          <div class="faq-question" onclick="toggleFAQ('faq2')">How can I find deals if my travel plans are flexible?</div>
          <div class="faq-answer" id="faq2">Try searching for flights on different days or nearby airports to find better deals.</div>

          <div class="faq-question" onclick="toggleFAQ('faq3')">How can I find cheap flights to anywhere?</div>
          <div class="faq-answer" id="faq3">Use tools like Google Flights' "Explore" feature to see cheap flights to various destinations.</div>

          <div class="faq-question" onclick="toggleFAQ('faq4')">How can I get flight alerts for my trip?</div>
          <div class="faq-answer" id="faq4">Sign up for alerts on airline websites or use services like Skyscanner and Google Flights.</div>
      </div>
</div>

<p><b>Incluide details of the home page<b></p>

<!-- Include the footer in the includes/ directory -->
<?php include 'includes/footer.php'; ?>