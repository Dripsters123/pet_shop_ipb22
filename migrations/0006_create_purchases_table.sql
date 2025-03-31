USE pet_shop;
DROP TABLE IF EXISTS purchases;

CREATE TABLE purchases (
id INT NOT NULL AUTO_INCREMENT,
client_id INT NOT NULL,
workers_id INT NOT NULL,
date_time DATETIME NOT NULL,
total_amount DECIMAL(8, 2),
payment_type ENUM("cash","card") NOT NULL,
PRIMARY KEY (id),
CONSTRAINT fk_purchases_clients FOREIGN KEY (client_id)
                           REFERENCES clients(id)
                           ON DELETE CASCADE
                           ON UPDATE CASCADE,
CONSTRAINT fk_purchases_workers FOREIGN KEY (workers_id)
                           REFERENCES workers(id)
                           ON DELETE CASCADE
                           ON UPDATE CASCADE   
 

);