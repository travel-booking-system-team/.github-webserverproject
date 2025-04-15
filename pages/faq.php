<?php
include '../includes/sessions.php';
include '../includes/functions.php';
include '../includes/header-member.php';
?>

<link rel="stylesheet" href="../css/main.css">

<div class="faq-container">
    <h1>Frequently Asked Questions</h1>
    
    <div class="faq-section">
        <div class="faq-question" onclick="toggleFAQ('faq1')">How can I find last-minute flight deals?</div>
        <div class="faq-answer" id="faq1">
            <p>There are several ways to find last-minute flight deals:</p>
            <ul>
                <li>Check airline websites frequently for flash sales</li>
                <li>Use flight comparison tools like Skyscanner or Google Flights</li>
                <li>Set up price alerts for your desired routes</li>
                <li>Follow airlines on social media for special promotions</li>
                <li>Consider flexible travel dates for better deals</li>
            </ul>
        </div>

        <div class="faq-question" onclick="toggleFAQ('faq2')">How can I find deals if my travel plans are flexible?</div>
        <div class="faq-answer" id="faq2">
            <p>If you have flexible travel plans, you can:</p>
            <ul>
                <li>Use the "Flexible Dates" search option on our website</li>
                <li>Search for flights to nearby airports</li>
                <li>Consider traveling on weekdays instead of weekends</li>
                <li>Look for flights during off-peak seasons</li>
                <li>Book flights with longer layovers for better prices</li>
            </ul>
        </div>

        <div class="faq-question" onclick="toggleFAQ('faq3')">How can I find cheap flights to anywhere?</div>
        <div class="faq-answer" id="faq3">
            <p>To find cheap flights to any destination:</p>
            <ul>
                <li>Use our "Explore" feature to see prices to various destinations</li>
                <li>Set up price alerts for multiple destinations</li>
                <li>Check for error fares and special promotions</li>
                <li>Consider booking connecting flights</li>
                <li>Travel during shoulder seasons for better prices</li>
            </ul>
        </div>

        <div class="faq-question" onclick="toggleFAQ('faq4')">How can I get flight alerts for my trip?</div>
        <div class="faq-answer" id="faq4">
            <p>To set up flight alerts:</p>
            <ul>
                <li>Create an account on our website</li>
                <li>Use the "Price Alerts" feature for your desired routes</li>
                <li>Choose your preferred price range and travel dates</li>
                <li>Select how often you want to receive alerts</li>
                <li>We'll notify you when prices change</li>
            </ul>
        </div>

        <div class="faq-question" onclick="toggleFAQ('faq5')">What is the best time to book a flight?</div>
        <div class="faq-answer" id="faq5">
            <p>For the best flight prices:</p>
            <ul>
                <li>Book domestic flights 1-3 months in advance</li>
                <li>Book international flights 2-8 months in advance</li>
                <li>Avoid booking during peak travel seasons</li>
                <li>Consider booking on weekdays rather than weekends</li>
                <li>Set up price alerts to track price trends</li>
            </ul>
        </div>

        <div class="faq-question" onclick="toggleFAQ('faq6')">How do I change or cancel my flight?</div>
        <div class="faq-answer" id="faq6">
            <p>To change or cancel your flight:</p>
            <ul>
                <li>Log in to your account</li>
                <li>Go to "My Flights" in your dashboard</li>
                <li>Select the flight you want to modify</li>
                <li>Choose to change or cancel your booking</li>
                <li>Follow the prompts to complete the process</li>
                <li>Note: Changes and cancellations may be subject to fees depending on your fare type</li>
            </ul>
        </div>
    </div>
</div>

<script>
function toggleFAQ(id) {
    const answer = document.getElementById(id);
    const question = answer.previousElementSibling;
    
    // Toggle the active class on the question
    question.classList.toggle('active');
    
    // Toggle the display of the answer
    if (answer.style.display === 'block') {
        answer.style.display = 'none';
    } else {
        answer.style.display = 'block';
    }
}
</script>

<?php include '../includes/footer.php'; ?> 