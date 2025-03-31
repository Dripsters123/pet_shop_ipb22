USE pet_shop;
DROP TABLE IF EXISTS purchase_pets;

CREATE TABLE purchase_pets (
id INT NOT NULL AUTO_INCREMENT,
pet_id INT NOT NULL,
purchase_id INT NOT NULL,
PRIMARY KEY (id)    
);