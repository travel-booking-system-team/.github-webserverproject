CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(100),
    flight_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (flight_id) REFERENCES flights(id)
);