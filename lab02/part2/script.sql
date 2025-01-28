CREATE TABLE IF NOT EXISTS StRec (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    year INT(4)
);

INSERT INTO StRec (firstName, lastName, year)
VALUES 
    ('John', 'Smith', 1),
    ('Jack', 'Smick', 2),
    ('Jane', 'Snide', 3),
    ('Jake', 'Sneer', 4);