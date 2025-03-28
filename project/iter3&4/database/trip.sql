CREATE TABLE Trip (
    Trip_Id INT AUTO_INCREMENT PRIMARY KEY,
    Source_Code VARCHAR(50) NOT NULL,
    Destination_Code VARCHAR(50) NOT NULL,
    Distance DECIMAL(10, 2) NOT NULL,
    Truck_Id INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL
);

INSERT INTO Trip (Source_Code, Destination_Code, Distance, Truck_Id, Price) VALUES
('SRC001', 'DST001', 150.00, 1, 500.00),
('SRC002', 'DST002', 300.00, 2, 1000.00),
('SRC003', 'DST003', 450.00, 3, 1500.00),
('SRC004', 'DST004', 600.00, 4, 2000.00),
('SRC005', 'DST005', 750.00, 5, 2500.00);
