CREATE TABLE USERS (
    UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    TelNo VARCHAR(30) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    DOB DATE NOT NULL,
    CityCode VARCHAR(30) NOT NULL,
    Password VARCHAR(30) NOT NULL,
    Balance DECIMAL(10,2) NOT NULL
);

INSERT INTO USERS (Name, TelNo, Email, DOB, CityCode, Password, Balance) 
VALUES ('Felipe Quiroga', '1234567890', 'tanke@gmail.com', '2003-06-17', '12345', 'tumami123', 1000.00);

INSERT INTO USERS (Name, TelNo, Email, DOB, CityCode, Password, Balance)
VALUES ('Juan Perez', '1234567890', 'jaunaito@outlook.com', '2003-06-17', '45555', 'tetetete', 5005.00);