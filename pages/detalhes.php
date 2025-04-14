<?php
// Simulando a obtenção do voo com base no ID
$viagens = [
    1 => [
        'flight_number' => 'AA101',
        'departure_airport' => 'JFK International Airport',
        'arrival_airport' => 'Toronto Pearson International Airport',
        'departure_date' => '2025-05-01 08:00:00',
        'arrival_date' => '2025-05-01 10:30:00',
        'price' => 320.00,
        'available_seats' => 150
    ],
    2 => [
        'flight_number' => 'DL202',
        'departure_airport' => 'Toronto Pearson International Airport',
        'arrival_airport' => 'Montreal-Pierre Elliott Trudeau International Airport',
        'departure_date' => '2025-05-02 11:00:00',
        'arrival_date' => '2025-05-02 12:30:00',
        'price' => 180.00,
        'available_seats' => 120
    ],
    3 => [
        'flight_number' => 'UA303',
        'departure_airport' => 'Montreal-Pierre Elliott Trudeau International Airport',
        'arrival_airport' => 'Vancouver International Airport',
        'departure_date' => '2025-05-03 13:00:00',
        'arrival_date' => '2025-05-03 15:30:00',
        'price' => 220.00,
        'available_seats' => 180
    ],
    4 => [
        'flight_number' => 'SW404',
        'departure_airport' => 'Vancouver International Airport',
        'arrival_airport' => 'Calgary International Airport',
        'departure_date' => '2025-05-04 07:30:00',
        'arrival_date' => '2025-05-04 09:00:00',
        'price' => 250.00,
        'available_seats' => 200
    ],
    5 => [
        'flight_number' => 'BA505',
        'departure_airport' => 'Calgary International Airport',
        'arrival_airport' => 'Ottawa Macdonald-Cartier International Airport',
        'departure_date' => '2025-05-05 14:00:00',
        'arrival_date' => '2025-05-05 17:00:00',
        'price' => 210.00,
        'available_seats' => 10
    ]
];

// Obter o ID do voo a partir da URL
$flight_id = $_GET['flight_id'] ?? null;

if ($flight_id && isset($viagens[$flight_id])) {
    $voo = $viagens[$flight_id];
} else {
    // Caso o ID do voo não seja válido, podemos redirecionar ou exibir um erro.
    echo "flight not found";
    exit;
}

include '../includes/sessions.php'; 
require_login($logged_in);
include '../includes/header-member.php';
?>

<link rel="stylesheet" href="../css/main.css">

<div class="register-container">
    <h2>Detalhes do Voo</h2>

    <div class="flight-card_d">
        <div class="card_d-header">
            <h3 class="flight-number"><?php echo $voo['flight_number']; ?></h3>
            <p class="price">$<?php echo number_format($voo['price'], 2, '.', ','); ?></p>
        </div>
        <div class="card_d-body">
            <div class="departure">
                <h4>Departure</h4>
                <p><strong>From:</strong> <?php echo $voo['departure_airport']; ?></p>
                <p><strong>Date:</strong> <?php echo date('Y-m-d H:i', strtotime($voo['departure_date'])); ?></p>
            </div>
            <div class="arrival_d">
                <h4>Arrival</h4>
                <p><strong>To:</strong> <?php echo $voo['arrival_airport']; ?></p>
                <p><strong>Date:</strong> <?php echo date('Y-m-d H:i', strtotime($voo['arrival_date'])); ?></p>
            </div>
        </div>
        <div class="card_d-footer">
            <p><strong>Available Seats:</strong> <?php echo $voo['available_seats']; ?></p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
