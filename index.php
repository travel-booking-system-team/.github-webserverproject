<?php 
include 'includes/sessions.php'; 
include 'includes/header-member.php'; 
?>

<h1>Welcome to Travel Booking</h1>

<section class="search">
  <h2>Flight Search</h2>
  <form id="flightSearchForm" onsubmit="searchFlights(event)">
    <label>From:</label>
    <input type="text" name="from" value="Montreal">
    <label>To:</label>
    <input type="text" name="to" value="Paris">
    <label>Departure:</label>
    <input type="date" name="departure" value="2025-06-10">
    <label>Return:</label>
    <input type="date" name="return" value="2025-06-17">
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
</section>

<!-- Modal for Flight Options -->
<div id="flightModal" class="modal-overlay">
  <div class="modal-content">
    <button class="close-btn" onclick="closeFlightModal()">×</button>
    <h3>Available Flights</h3>
    <div class="flight-carousel-container">
      <button class="carousel-nav prev" onclick="scrollCarousel(-1)">‹</button>
      <div class="flight-carousel" id="flightCarousel">
        <!-- Flight cards go here -->
      </div>
      <button class="carousel-nav next" onclick="scrollCarousel(1)">›</button>
    </div>
  </div>
</div>

<section class="faq">
  <h3>Frequently Asked Questions</h3>
  <div class="faq-section">
    <div class="faq-question" onclick="toggleFAQ('faq1')">How can I find last-minute flight deals?</div>
    <div class="faq-answer" id="faq1">Check airline websites frequently, use flight comparison tools, and set up price alerts.</div>

    <div class="faq-question" onclick="toggleFAQ('faq2')">How can I find deals if my travel plans are flexible?</div>
    <div class="faq-answer" id="faq2">Try searching on different days or from nearby airports to find better fares.</div>

    <div class="faq-question" onclick="toggleFAQ('faq3')">How can I find cheap flights to anywhere?</div>
    <div class="faq-answer" id="faq3">Use tools like Google Flights' "Explore" feature or Skyscanner to view multiple destinations.</div>

    <div class="faq-question" onclick="toggleFAQ('faq4')">How can I get flight alerts for my trip?</div>
    <div class="faq-answer" id="faq4">Sign up for alerts on airline websites or with services like Hopper, Kayak, and Google Flights.</div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- JavaScript -->
<script>
function searchFlights(event) {
  event.preventDefault();
  const formData = new FormData(document.getElementById('flightSearchForm'));
  fetch('fetch_flights.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById('flightCarousel');
    container.innerHTML = data.length ? '' : '<p>No flights found.</p>';

    data.forEach(flight => {
      const div = document.createElement('div');
      div.className = 'flight-option';
      div.innerHTML = `
        <img src="${flight.image_url}" width="200" style="border-radius:6px">
        <h4>${flight.departure_city} → ${flight.arrival_city}</h4>
        <p>${flight.departure_date} to ${flight.return_date}</p>
        <p>${flight.airline} | ${flight.duration}</p>
        <p><strong>CA$${flight.price}</strong></p>
        <button onclick="bookFlight(${flight.id})">Book</button>
      `;
      container.appendChild(div);
    });

    document.getElementById('flightModal').style.display = 'flex';
  })
  .catch(error => alert("Error fetching flights."));
}

function closeFlightModal() {
  document.getElementById('flightModal').style.display = 'none';
}

function bookFlight(flightId) {
  window.location.href = `pages/book_flight.php?flight_id=${flightId}`;
}

function scrollCarousel(direction) {
  const carousel = document.getElementById('flightCarousel');
  const scrollAmount = 300;
  carousel.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth'
  });
}

function toggleFAQ(id) {
  const el = document.getElementById(id);
  el.style.display = (el.style.display === "block") ? "none" : "block";
}
</script>
