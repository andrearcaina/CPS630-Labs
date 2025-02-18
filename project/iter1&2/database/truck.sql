CREATE TABLE Truck (
    Truck_Id INT AUTO_INCREMENT PRIMARY KEY,
    Truck_Code VARCHAR(50) NOT NULL,
    Availability_Code VARCHAR(50) NOT NULL
);

INSERT INTO Truck (Truck_Code, Availability_Code) VALUES
('TRK001', 'AVL001'),
('TRK002', 'AVL002'),
('TRK003', 'AVL003'),
('TRK004', 'AVL004'),
('TRK005', 'AVL005');
