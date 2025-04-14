<?php 
include 'includes/sessions.php'; 
include 'includes/db.php'; // Incluir a conexão com o banco de dados

// Inicializa as variáveis dos parâmetros da pesquisa
$departure = $_POST['departure'] ?? null;
$origin = $_POST['origin'] ?? null;
$destination = $_POST['destination'] ?? null;

// Inicializa a variável para armazenar os resultados da busca
$flights = [];

// Prepara a consulta SQL para buscar as viagens com os parâmetros fornecidos pelo usuário
$sql = "SELECT * FROM flights WHERE 1";

// Adiciona condições à consulta SQL com base nos parâmetros recebidos no formulário
if ($origin) {
    $sql .= " AND departure_airport = :origin";
}

if ($destination) {
    $sql .= " AND arrival_airport = :destination";
}

// Ordenar por data de partida (ascending)
$sql .= " ORDER BY departure_date ASC";

// Prepara a declaração SQL
$stmt = $pdo->prepare($sql);

// Bind dos parâmetros da consulta
if ($origin) {
    $stmt->bindValue(':origin', $origin);
}

if ($destination) {
    $stmt->bindValue(':destination', $destination);
}

// Executa a consulta
$stmt->execute();

// Obtém todos os resultados da consulta
$flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exibe uma mensagem caso não haja resultados após a pesquisa
$no_flights_found = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && count($flights) === 0) {
    $no_flights_found = true;
}
?>

<?php include 'includes/header-member.php'; ?>

<div class="search-container">
    <div class="search">
        <h2>Flight Search</h2>
        <form method="POST">
            <div>
                <label>From:</label>
                <select name="origin">
                <option>Select</option>
                    <option>JFK</option>
                    <option>Toronto</option>
                    <option>Los Angeles</option>
                    <option>Miami</option>
                    <option>Mariscal</option>
                    <option>São Paulo</option>
                    <option>Rio de Janeiro</option>
                    <option>Montreal</option>
                    <option>Vancouver</option>
                    <option>Calgary</option>
                    <option>Ottawa</option>
                </select>                
            </div>
            <div>
               <label>To:</label>
               <select name="destination">
                    <option>Select</option>
                    <option>JFK</option>
                    <option>Toronto</option>
                    <option>Los Angeles</option>
                    <option>Miami</option>
                    <option>Mariscal</option>
                    <option>São Paulo</option>
                    <option>Rio de Janeiro</option>
                    <option>Montreal</option>
                    <option>Vancouver</option>
                    <option>Calgary</option>
                    <option>Ottawa</option>
                </select>  
            </div>
            <div>
                <label>Departure:</label>
                <input type="date" name="departure" value="2025-03-12">
            </div>
            <div>
                <label>Return:</label>
                <input type="date" name="return" value="2025-03-19">    
            </div>
            <div>
                <label>Passengers:</label>
                <select name="passengers">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>  
            </div>
            <div>
                <label>Class:</label>
                <select name="class">
                    <option>Economy</option>
                    <option>Business</option>
                    <option>First Class</option>
                </select> 
            </div>
            <div>
                <button type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<?php
// Exibe os resultados das viagens, caso tenham sido encontrados
if ($_SERVER["REQUEST_METHOD"] == "POST" && count($flights) > 0) {
    echo '<h3 style="margin-top: 2%;"><b>Flight Results</b></h3>';
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && $no_flights_found) {
    // Exibe a mensagem de "No flights found" somente após a pesquisa
    echo '<p>No flights found matching your criteria.</p>';
}
?>

<div class="container_trips">
    <div class="cards">
        <?php foreach ($flights as $flight): ?>
            <div class="card">
                <a href="pages/detalhes.php?flight_id=<?php echo $flight['flight_id']; ?>">
                    <div class="card-content">
                    <img src="https://source.unsplash.com/200x100/?beach" alt="Flight Image">
                        <h3 class="card-title"><?php echo $flight['flight_number']; ?></h3>
                        <p><strong>Origin:</strong> <?php echo $flight['departure_airport']; ?></p>
                        <p><strong>Destiny:</strong> <?php echo $flight['arrival_airport']; ?></p>
                        <p><strong>Day:</strong> <?php echo date('d/m/Y H:i', strtotime($flight['departure_date'])); ?></p>
                        <p><strong>Price:</strong> $ <?php echo number_format($flight['price'], 2, ',', '.'); ?></p>
                        <p><strong>Avaliable seats:</strong> <?php echo $flight['available_seats']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="faq">
<b><p><h3>Frequently Asked Questions</h3></b></p>
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

<!-- Include the footer in the includes/ directory -->

<?php include 'includes/footer.php'; ?>
