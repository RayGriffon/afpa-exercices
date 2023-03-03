CREATE TABLE Suppliers(
   sup_id INT,
   sup_name VARCHAR(50)  NOT NULL,
   sup_city VARCHAR(50)  NOT NULL,
   sup_address VARCHAR(150)  NOT NULL,
   sup_mail VARCHAR(75) ,
   sup_phone INT,
   PRIMARY KEY(sup_id)
);

CREATE TABLE Customers(
   cus_id INT,
   cus_lastname VARCHAR(50)  NOT NULL,
   cus_firstname VARCHAR(50)  NOT NULL,
   cus_address VARCHAR(150)  NOT NULL,
   cus_zipcode VARCHAR(5)  NOT NULL,
   cus_mail VARCHAR(75) ,
   cus_phone INT,
   PRIMARY KEY(cus_id)
);

CREATE TABLE Orders(
   ord_id INT AUTO_INCREMENT,
   ord_order_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
   ord_ship_date DATE,
   ord_bill_date DATE,
   ord_reception_date VARCHAR(50) ,
   ord_status VARCHAR(25)  NOT NULL,
   cus_id INT NOT NULL,
   PRIMARY KEY(ord_id),
   UNIQUE(cus_id),
   FOREIGN KEY(cus_id) REFERENCES Customers(cus_id)
);

CREATE TABLE Categories(
   cat_id INT,
   cat_name VARCHAR(200) ,
   cat_id_1 INT,
   PRIMARY KEY(cat_id),
   FOREIGN KEY(cat_id_1) REFERENCES Categories(cat_id)
);

CREATE TABLE Products(
   pro_id INT AUTO_INCREMENT,
   pro_ref VARCHAR(10)  NOT NULL,
   pro_name VARCHAR(200)  NOT NULL,
   pro_desc BLOB(1000)  NOT NULL,
   pro_price DECIMAL(6,2)   NOT NULL,
   pro_stock SMALLINT,
   pro_color VARCHAR(30) ,
   pro_picture VARCHAR(40) ,
   pro_add_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
   pro_update_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   pro_publish TINYINT NOT NULL,
   sup_id INT NOT NULL,
   cat_id INT NOT NULL,
   PRIMARY KEY(pro_id),
   FOREIGN KEY(sup_id) REFERENCES Suppliers(sup_id),
   FOREIGN KEY(cat_id) REFERENCES Categories(cat_id)
);

CREATE TABLE Details(
   det_id INT,
   det_price DECIMAL(6,2)   NOT NULL,
   det_quantity INT NOT NULL CHECK (det_quantity BETWEEN 1 AND 100),
   pro_id INT NOT NULL,
   ord_id INT NOT NULL,
   PRIMARY KEY(det_id),
   FOREIGN KEY(pro_id) REFERENCES Products(pro_id),
   FOREIGN KEY(ord_id) REFERENCES Orders(ord_id)
);
