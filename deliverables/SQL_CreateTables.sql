DROP TABLE IF EXISTS checkoutLog;
DROP TABLE IF EXISTS lostLog;
DROP TABLE IF EXISTS damagedLog;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS equipment;

CREATE TABLE employee (
empID varchar(30) NOT NULL,
firstName varchar(30) NOT NULL,
lastName varchar(30) NOT NULL,
Position varchar(30) NOT NULL,
PRIMARY KEY(empID)
)
ENGINE=INNODB;

/**I don't think we need hasEar
**can't put null for size, so I used 'NA' as the null size*/
CREATE TABLE equipment (
equipID varchar(30) NOT NULL,
type varchar(30) NOT NULL,
size varchar(3) NOT NULL, 
quantityOwned int NOT NULL DEFAULT 1,
PRIMARY KEY(equipID)
)
ENGINE=INNODB;

CREATE TABLE checkoutLog (
equipID varchar(30) NOT NULL,
empID varchar(30) NOT NULL,
quantityOut int NOT NULL DEFAULT 1,
hasEar boolean NOT NULL DEFAULT 0,
checkoutDate date NOT NULL,
checkinDate date,
Event varchar(100) NOT NULL,
FOREIGN KEY (equipID) REFERENCES equipment (equipID),
FOREIGN KEY (empID) REFERENCES employee (empID)
)
ENGINE=INNODB;

CREATE TABLE lostLog (
equipID varchar(30) NOT NULL,
empID varchar(30) NOT NULL,
reportDate date NOT NULL,
foundDate date,
quantityLost int NOT NULL DEFAULT 1,
FOREIGN KEY (equipID) REFERENCES equipment (equipID),
FOREIGN KEY (empID) REFERENCES employee (empID)
)
ENGINE=INNODB;

CREATE TABLE damagedLog (
equipID varchar(30) NOT NULL,
empID varchar(30) NOT NULL,
reportDate date NOT NULL,
sentDate date,
recievedDate date,
quantityDamaged int NOT NULL DEFAULT 1,
FOREIGN KEY (equipID) REFERENCES equipment (equipID),
FOREIGN KEY (empID) REFERENCES employee (empID)
)
ENGINE=INNODB;
