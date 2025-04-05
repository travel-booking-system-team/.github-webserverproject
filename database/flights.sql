CREATE TABLE flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_city VARCHAR(100),
    arrival_city VARCHAR(100),
    departure_date DATE,
    return_date DATE,
    price DECIMAL(10,2),
    airline VARCHAR(100),
    duration VARCHAR(50),
    image_url VARCHAR(255)
);


-- seed entries flights table: 

INSERT INTO flights (departure_city, arrival_city, departure_date, return_date, price, airline, duration, image_url)

VALUES 

('Montreal', 'Paris', '2025-06-10', '2025-06-17', 799.00, 'Air France', '7h 30m', 'https://source.unsplash.com/200x100/?paris,eiffel'),

('Toronto', 'Tokyo', '2025-07-01', '2025-07-15', 1200.00, 'Japan Airlines', '13h', 'https://source.unsplash.com/200x100/?tokyo,japan'),

('Montreal', 'Miami', '2025-04-20', '2025-04-25', 299.00, 'Air Canada', '3h 30m', 'https://source.unsplash.com/200x100/?miami,beach'),

('Vancouver', 'Rome', '2025-08-10', '2025-08-24', 999.00, 'ITA Airways', '11h', 'https://source.unsplash.com/200x100/?rome,italy'),

('Calgary', 'Cancun', '2025-05-05', '2025-05-12', 675.00, 'Sunwing', '5h 15m', 'https://source.unsplash.com/200x100/?cancun,beach,resort');