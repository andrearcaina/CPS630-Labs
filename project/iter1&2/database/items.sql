CREATE TABLE Item (
    ItemID INT AUTO_INCREMENT PRIMARY KEY,
    Item_name VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Made_in VARCHAR(255) NOT NULL,
    Department_Code VARCHAR(50) NOT NULL,
    Phone_Type VARCHAR(255) NOT NULL,
    Phone_Brand VARCHAR(255) NOT NULL,
    Image_URL VARCHAR(255) NOT NULL
);

INSERT INTO Item (Item_name, Price, Made_in, Department_Code, Phone_Type, Phone_Brand, Image_URL) VALUES
('iPhone 16 Pro Max', 2049.00, 'USA', 'PHN001', 'iOS', 'Apple', 'https://www.jumpplus.com/web/image/product.product/40358/image_1024/%5BMYWJ3VC-A%5D%20Apple%20iPhone%2016%20Pro%20Max%20%28Desert%20Titanium%2C%20256GB%29?unique=498cb1c'),
('Samsung Galaxy S25 Ultra', 1919.00, 'South Korea', 'PHN002', 'Android', 'Samsung', 'https://images.samsung.com/ca/smartphones/galaxy-s25-ultra/buy/product_color_silverBlue_PC.png'),
('Google Pixel 9', 1099.99, 'USA', 'PHN003', 'Android', 'Google', 'https://www.wireless.walmart.ca/wp-content/uploads/2024/10/Pixel-9-Dual-1.jpg'),
('OnePlus 9', 729.99, 'China', 'PHN004', 'Android', 'OnePlus', 'https://oasis.opstatics.com/content/dam/oasis/page/2021/9-series/spec-image/9/Wintermist_2080a_euna.png'),
('Sony Xperia 5 II', 949.99, 'Japan', 'PHN005', 'Android', 'Sony', 'https://www.mi4canada.com/wp-content/uploads/2021/05/sony-xperia-5-ii-5g-Pink.jpg'),
('Huawei P40 Pro', 899.99, 'China', 'PHN006', 'Android', 'Huawei', 'https://m.media-amazon.com/images/I/51ihfOtMKqL.jpg'),
('iPhone 14', 849.99, 'USA', 'PHN007', 'iOS', 'Apple', 'https://images.ctfassets.net/vx12w8gtks6f/1jvf87prwZFWlaXnayhNNd/630e63c69291d8e02a37e6fbe8ebc06c/iPhone_14_Midnight_PDP_Image_Position-1_CAEN.jpg');