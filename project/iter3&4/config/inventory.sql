CREATE TABLE inventory(
 	store_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (store_id, item_id),
    FOREIGN KEY (store_id) REFERENCES stores(id),
    FOREIGN KEY (item_id) REFERENCES item(ItemID)
);

INSERT INTO inventory (store_id, item_id, quantity) VALUES
(1, 1, 10), (1, 2, 10), (1, 3, 10), (1, 4, 10), (1, 5, 10), (1, 6, 10), (1, 7, 10),
(2, 1, 10), (2, 2, 10), (2, 3, 10), (2, 4, 10), (2, 5, 10), (2, 6, 10), (2, 7, 10),
(3, 1, 10), (3, 2, 10), (3, 3, 10), (3, 4, 10), (3, 5, 10), (3, 6, 10), (3, 7, 10),
(4, 1, 10), (4, 2, 10), (4, 3, 10), (4, 4, 10), (4, 5, 10), (4, 6, 10), (4, 7, 10);

SELECT s.name 
FROM stores s
WHERE 
    s.id IN (
        SELECT i.store_id 
        FROM inventory i
        WHERE (i.item_id = 1 AND i.quantity >= 5)
    )
    AND 
    s.id IN (
        SELECT i.store_id 
        FROM inventory i
        WHERE (i.item_id = 2 AND i.quantity >= 10)
    );