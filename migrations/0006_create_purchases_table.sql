USE pet_shop;
DROP TABLE IF EXISTS purchases;

CREATE TABLE purchases (
id INT NOT NULL AUTO_INCREMENT,
date_time DATETIME NOT NULL,
total_amount DECIMAL(8, 2),
payment_type ENUM("cash","card") NOT NULL,
PRIMARY KEY (id)    
);