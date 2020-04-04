insert into employee(empID, firstName, lastName, Position) values (001, 'Larry', 'Bean', 'Worker');
insert into employee(empID, firstName, lastName, Position) values (002, 'Amanda', 'Sill', 'Manager');
insert into employee(empID, firstName, lastName, Position) values (003, 'Kyle', 'Peters', 'Worker');
insert into employee(empID, firstName, lastName, Position) values (004, 'Akhilesh', 'Datar', 'Admin');

insert into equipment(equipID, type, size,quantityOwned, hasEar) values (1, 'Polo', 'M', 50, 0);
insert into equipment(equipID, type, size,quantityOwned, hasEar) values (2, 'Radio', 'NA' , 1, 1);
insert into equipment(equipID, type, size,quantityOwned, hasEar) values (3, 'Sweater Vest', '3XL', 17, 0);
insert into equipment(equipID, type, size,quantityOwned, hasEar) values (4, 'Radio', 'NA', 1, 0);
insert into equipment(equipID, type, size,quantityOwned, hasEar) values (5, 'Jacket', 'L', 45, 0);
insert into equipment(equipID, type, size,quantityOwned, hasEar) values (6, 'Blazer', 'S', 12, 0);

Insert into checkoutLog(equipID,empID, quantityOut, hasEar, checkoutDate, event) values (2, 1, 1, 0, '2019-02-03', 'football');
Insert into checkoutLog(equipID,empID, quantityOut, hasEar, checkoutDate, event) values (4, 2, 1, 0, '2019-02-03', 'basketball');
Insert into checkoutLog(equipID,empID, quantityOut, hasEar, checkoutDate, event) values (5, 3, 1, 0, '2019-02-03', 'soccer');
