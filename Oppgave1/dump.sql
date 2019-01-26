CREATE DATABASE Aplia;
CREATE TABLE Hotel (
    HotelId int(4) NOT NULL AUTO_INCREMENT,
    HotelName varChar(50),
    NumberOfRooms int(4),
    Price int (5),
   City varChar(50),
   PRIMARY KEY (HotelId))ENGINE = InnoDB;
INSERT INTO Hotel ( HotelName, NumberOfRooms,Price, City)
VALUES 
('Hotell Oslo', 5, 500, 'Oslo'),
('Hotel London',10,1000,'London'),
('Hôtel Paris',20,700,'Paris'),
('Gasthof Berlin ',10,50,'Berlin');

CREATE TABLE Customer ( CustomerId INT(4) NOT NULL AUTO_INCREMENT ,
FirstName VARCHAR(50) NOT NULL , 
LastName VARCHAR(50) NOT NULL , 
Phone VARCHAR(10) NOT NULL , 
Email VARCHAR(50) NOT NULL , 
PRIMARY KEY (CustomerId)) ENGINE = InnoDB;


CREATE TABLE Bookings (
BookingId INT NOT NULL AUTO_INCREMENT , 
CustomerId INT NOT NULL , 
HotelId INT NOT NULL , 
ArrivalDate DATE NOT NULL , 
DepartDate DATE NOT NULL , 
TotalRooms INT NOT NULL , 
PRIMARY KEY (BookingId)
FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerId)
FOREIGN KEY (HotelId) REFERENCES Hotel(HotelId)
) ENGINE = InnoDB;


/*DECLARE @hotel TABLE (CustomerID INT),

INSERT INTO MyTable(FirstName, LastName, Phone,E)
OUTPUT INSERTED.CustomerID INTO @hotel(CustomerID)
VALUES ('Yatrix', '1234 Address Stuff', '1112223333')

SELECT LAST_INSERT_ID()

INSERT INTO customer(FirstName,LastName,Phone,Email)VALUES("Fornavn","Etternvn","telefon","email");
SELECT LAST_INSERT_ID();



SELECT *FROM hotel
 INNER JOIN
 bookings ON hotel.HotelId = bookings.HotelId
 WHERE hotel.City LIKE 'London'
 AND (bookings.ArrivalDate NOT BETWEEN '2019-02-28' AND'2019-03-01')
 GROUP BY bookings.TotalRooms
 HAVING hotel.NumberOfRooms>sum(bookings.TotalRooms-200)
 ORDER BY hotel.RoomPrice DESC

*/