/*
Name: Neelipalayam Masilamani, Archana
Student ID: 1001415817
*/

DROP TABLE IF EXISTS `customer`;
create table customer (
   username   varchar(10) primary key,
   password   varchar(32),
   address    varchar(100),
   phone	  varchar(20),
   email      varchar(45)
);

DROP TABLE IF EXISTS `ShoppingBasket`;
create table ShoppingBasket (
   basketId   varchar(13) primary key,
   username	  varchar(10) references Customers (username)
);

DROP TABLE IF EXISTS `author`;
create table author (
ssn varchar(11) primary key,
name varchar(25),
address varchar(100),
phone varchar(20)
);

DROP TABLE IF EXISTS `book`;
create table book (
isbn varchar(30) primary key,
title varchar(50),
year number(4),
price decimal(19,2),
publisher varchar(30)
);

DROP TABLE IF EXISTS `writtenby`;
create table writtenby(
ssn varchar(11) references author (ssn),
isbn varchar(30) references book (ISBN)
);

DROP TABLE IF EXISTS `warehouse`;
create table warehouse(
warehouseCode varchar(15) primary key,
name varchar(25),
aaddress varchar(100),
phone varchar(20)
);

DROP TABLE IF EXISTS `stocks`;
create table stocks(
isbn varchar(30) references book (isbn),
warehouseCode varchar(15) references warehouse (warehouseCode),
number int(10)
);

DROP TABLE IF EXISTS `customer`;
create table customer(
username varchar(15) primary key,
address varchar(100),
email varchar(20),
phone varchar(20),
password varchar(10)
);

DROP TABLE IF EXISTS `shoppingbasket`;
create table shoppingbasket(
basketId varchar(15) primary key,
username varchar(15) references customer (username)
);

DROP TABLE IF EXISTS `contains`;
create table contains(
isbn varchar(30) references book (isbn),
basketId varchar(15) references shoppingbasket (basketId),
number int(10)
);

DROP TABLE IF EXISTS `shippingorder`;
create table shippingorder(
isbn varchar(30) references book (isbn),
warehouseCode varchar(15) references warehouse (warehouseCode),
username varchar(15) references customer (username)
number int(10)
);

insert into `author` values('123-45-6789','Dan Brown','55 Fifth Ave., Fl. 15,New York, NY 10003','6822453456');
insert into `author` values('123-45-6790','Agatha Christie','50 Bedford Square, London, WC1B 3DP','4822483456');
insert into `author` values('123-45-6791','Michael Crichton','2118 Wilshire Blvd.,Suite 433,Santa Barbara, CA 90402','5821487456');
insert into `author` values('123-45-6792','Gillian Flynn','414 E. 12th St.Kansas City, MO 64106','8165131313');

insert into `book` values('0-385-50420-9','Da Vinci code',2003,100.00,'Doubleday');
insert into `book` values('978-1-57912-624-7','The A.B.C. Murders',1936,5.00,'Collins Crime Club');
insert into `book` values('0-394-49401-6','The Great Train Robbery',1975,10.00,'Knopf');
insert into `book` values('978-0307588364','Gone Girl',2012,50.00,'Crown Publishing Group');
insert into `book` values('978-0307588365','The Grown Up',2013,70.00,'Crown Publishing Group');

insert into `writtenby` values('123-45-6789','0-385-50420-9');
insert into `writtenby` values('123-45-6790','978-1-57912-624-7');
insert into `writtenby` values('123-45-6791','0-394-49401-6');
insert into `writtenby` values('123-45-6792','978-0307588364');
insert into `writtenby` values('123-45-6792','978-0307588365');	

insert into `warehouse` values('AB1111','WA1111','8150 Country Club St. Lorton, VA 22079','6833453456');
insert into `warehouse` values('AB2222','WA2222','8731 N. Cactus St. Tucson, AZ 85718','6833453457');
insert into `warehouse` values('AB3333','WA3333','9202 James Dr. Methuen, MA 01844','6833453458');
insert into `warehouse` values('AB4444','WA4444','8793 White Lane Hattiesburg, MS 39401','6833453459');

insert into `stocks` values('0-385-50420-9','AB1111',3);
insert into `stocks` values('978-1-57912-624-7','AB1111',4);
insert into `stocks` values('978-1-57912-624-7','AB2222',8);
insert into `stocks` values('0-385-50420-9','AB2222',2);
insert into `stocks` values('0-394-49401-6','AB3333',6);
insert into `stocks` values('978-0307588364','AB4444',10);
insert into `stocks` values('978-0307588364','AB2222',8);
insert into `stocks` values('978-0307588365','AB1111',5);
insert into `stocks` values('978-0307588365','AB2222',3);


