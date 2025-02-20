CREATE TABLE orders (
  OrderID INT PRIMARY KEY AUTO_INCREMENT,
  UserID INT(6) UNSIGNED,
  StoreID INT NOT NULL,
  DateIssued DATE NOT NULL,
  ArrivalDate DATE NOT NULL,
  TotalPrice DECIMAL(10, 2) NOT NULL,
  PaymentCode INT NOT NULL,
  TruckID INT NOT NULL,
  
  CONSTRAINT fk_orders_users FOREIGN KEY (UserID) REFERENCES users(UserID),
  CONSTRAINT fk_orders_store FOREIGN KEY (StoreID) REFERENCES stores(id)
);