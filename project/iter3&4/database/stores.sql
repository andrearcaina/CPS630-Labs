CREATE TABLE stores(
 	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(255) NOT NULL,
    address varchar(255) NOT NULL
);

INSERT INTO stores(name, address)  VALUES 
('TPS Scarborough Town Centre', '300 Borough Dr, Scarborough, ON M1P4P5'),
('TPS Toronto Eaton Centre', '220 Yonge St, Toronto, ON M5B2H1'),
('TPS Missisauga Square One Shopping Centre', '100 City Centre Dr, Missiauga, ON L5B2C9'),
('TPS Yorkdale Shopping Centre', '3401 Dufferin St, North York, ON M6A2T9');