<?php include '../includes/header-member.php'; ?>

<link rel="stylesheet" href="../css/main.css">

<div class="faq-page">
    <h1>Frequently Asked Questions</h1>
    
    <div class="faq-categories">
        <h2>Booking & Reservations</h2>
        <div class="faq-section">
            <div class="faq-question" onclick="toggleFAQ('faq1')">
                <span class="faq-icon">+</span>
                How can I find last-minute flight deals?
            </div>
            <div class="faq-answer" id="faq1">Check airline websites frequently, use flight comparison tools, and set up price alerts.</div>

            <div class="faq-question" onclick="toggleFAQ('faq2')">
                <span class="faq-icon">+</span>
                How can I find deals if my travel plans are flexible?
            </div>
            <div class="faq-answer" id="faq2">Try searching for flights on different days or nearby airports to find better deals.</div>
        </div>

        <h2>Flight Information</h2>
        <div class="faq-section">
            <div class="faq-question" onclick="toggleFAQ('faq3')">
                <span class="faq-icon">+</span>
                What happens if my flight is delayed or cancelled?
            </div>
            <div class="faq-answer" id="faq3">In case of delays or cancellations, you will be notified via email and SMS. You can choose to be rebooked on the next available flight or request a refund.</div>

            <div class="faq-question" onclick="toggleFAQ('faq4')">
                <span class="faq-icon">+</span>
                Can I change my seat assignment?
            </div>
            <div class="faq-answer" id="faq4">Yes, you can change your seat assignment through our website or mobile app up until check-in, subject to availability.</div>
        </div>

        <h2>Payment & Refunds</h2>
        <div class="faq-section">
            <div class="faq-question" onclick="toggleFAQ('faq5')">
                <span class="faq-icon">+</span>
                What payment methods do you accept?
            </div>
            <div class="faq-answer" id="faq5">We accept all major credit cards, debit cards, and PayPal. Some routes also support payment in installments.</div>

            <div class="faq-question" onclick="toggleFAQ('faq6')">
                <span class="faq-icon">+</span>
                What is your refund policy?
            </div>
            <div class="faq-answer" id="faq6">Refund policies vary by fare type. Generally, refundable tickets can be fully refunded, while non-refundable tickets may only qualify for airline credit.</div>
        </div>
    </div>
</div>

<script>
function toggleFAQ(id) {
    const answer = document.getElementById(id);
    const question = answer.previousElementSibling;
    const icon = question.querySelector('.faq-icon');
    
    // fecha as outrasFAQs
    document.querySelectorAll('.faq-answer').forEach(item => {
        if (item.id !== id && item.classList.contains('active')) {
            item.classList.remove('active');
            item.previousElementSibling.querySelector('.faq-icon').textContent = '+';
        }
    });
    
    // Toggle na FAQ atual
    answer.classList.toggle('active');
    icon.textContent = answer.classList.contains('active') ? '−' : '+';
}
</script>

<?php include '../includes/footer.php'; ?> 