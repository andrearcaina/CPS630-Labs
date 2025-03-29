CREATE TABLE reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    UserID Int UNSIGNED NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Review TEXT NOT NULL,
    Rating INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

INSERT INTO reviews (UserID, Title, Review, Rating)
VALUES (1, "Fast Shipping", "I ordered an S25 ultra and it shipped very fast", 5),
(2,"I bought 4 phones!", "I bought 4 Pixel 9 smartphones at a very good price", 5),
(3,"You can't find a better deal anywhere else", "I bought an Iphone 16 and I'm super happy with the price and fast shipping", 5),
(4,"I met the love of my life here!!!", "And we're happily married for 5 years going strong!!!", 5),
(5,"I HATE IPHONES", "I bought an Iphone 16 pro max and it absolutely sucks!! The store however, was pretty damn good", 3);