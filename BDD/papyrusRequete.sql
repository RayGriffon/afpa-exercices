CREATE TABLE Produit(
   codart CHAR(4) ,
   libart VARCHAR(30)  NOT NULL,
   stkale INT NOT NULL,
   stkphy INT NOT NULL,
   qteann INT NOT NULL,
   unimes CHAR(5)  NOT NULL,
   PRIMARY KEY(codart)
);

CREATE TABLE Fournis(
   numfou VARCHAR(25) ,
   nomfou VARCHAR(25) NOT NULL,
   ruefou VARCHAR(50) NOT NULL,
   posfou CHAR(5) NOT NULL,
   vilfou VARCHAR(30) NOT NULL,
   confou VARCHAR(15) NOT NULL,
   satisf TINYINT CHECK (satisf BETWEEN 1 AND 10),
   PRIMARY KEY(numfou)
);

CREATE TABLE Entcom(
   numcom INT AUTO_INCREMENT,
   obscom VARCHAR(50) ,
   datcom DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ;
   numfou VARCHAR(25),
   PRIMARY KEY(numcom),
   FOREIGN KEY(numfou) REFERENCES Fournis(numfou)
);

CREATE TABLE Ligcom(
   numlig TINYINT,
   qtecde INT,
   priuni VARCHAR(50) NOT NULL,
   derliv DATETIME NOT NULL,
   numcom INT NOT NULL,
   codart CHAR(4)  NOT NULL,
   PRIMARY KEY(numlig),
   FOREIGN KEY(numcom) REFERENCES Entcom(numcom),
   FOREIGN KEY(codart) REFERENCES Produit(codart)
);

CREATE TABLE Vente(
   codart CHAR(4) ,
   numfou VARCHAR(25) NOT NULL,
   delliv SMALLINT NOT NULL,
   qte1 INT NOT NULL,
   prix1 VARCHAR(50) NOT NULL,
   qte2 INT,
   prix2 VARCHAR(50) ,
   qte3 INT,
   prix3 VARCHAR(50) ,
   PRIMARY KEY(codart, numfou),
   FOREIGN KEY(codart) REFERENCES Produit(codart),
   FOREIGN KEY(numfou) REFERENCES Fournis(numfou)
);