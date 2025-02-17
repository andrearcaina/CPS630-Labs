CREATE TABLE users (
    UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    FirstName varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    DOB DATE NOT NULL,
    Pass varchar(255) NOT NULL,
    TelNo varchar(10) NOT NULL,
    Address varchar(255) NOT NULL,
    City varchar(255) NOT NULL,
    PostalCode varchar(20) NOT NULL,
    Balance DECIMAL(10,2) NOT NULL
)

INSERT INTO USERS (FirstName, LastName, Email, DOB, Pass, TelNo, Address, City, PostalCode, Balance) 
VALUES ('Felipe', 'Quiroga', 'tanke@gmail.com', '2003-06-17', 'tumami123', '1234567890', '31 Burningham Road', 'Ajax', 'L1S7D4', 1000.00);