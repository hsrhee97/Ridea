DROP TABLE IF EXISTS SURVEY;
DROP TABLE IF EXISTS HELP;
DROP TABLE IF EXISTS RATING;
DROP TABLE IF EXISTS PAYMENT;
DROP TABLE IF EXISTS TRIP;
DROP TABLE IF EXISTS PASSENGER;
DROP TABLE IF EXISTS DRIVER;



CREATE TABLE DRIVER (
   DriverID INT AUTO_INCREMENT,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   address VARCHAR(255),
   phone VARCHAR(20),
   email VARCHAR(255) NOT NULL,
   password VARCHAR(250) NOT NULL,
   biography TEXT,
   license_number VARCHAR(20) NOT NULL,
   license_photo VARCHAR(255),
   color VARCHAR(50) NOT NULL,
   model_name VARCHAR(50) NOT NULL,
   PRIMARY KEY (DriverID)
);

CREATE TABLE PASSENGER (
   PassengerID INT AUTO_INCREMENT,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   address VARCHAR(255),
   phone VARCHAR(20),
   email VARCHAR(255) NOT NULL,
   password VARCHAR(250) NOT NULL,
   biography TEXT,
   credit_card VARCHAR(20) NOT NULL,
   PRIMARY KEY (PassengerID)
);

CREATE TABLE TRIP (
    TripID INT AUTO_INCREMENT NOT NULL,
    DriverID INT,
    PassengerID INT,
    Start_location VARCHAR(255),
    End_location VARCHAR(255),
    Distance DECIMAL(10,2),
    Date DATE,
    PRIMARY KEY (TripID),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID),
    FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);

CREATE TABLE PAYMENT (
    PaymentID INT AUTO_INCREMENT,
    TripID INT,
    Payment_amount DECIMAL(10,2),
    PRIMARY KEY (PaymentID),
    FOREIGN KEY (TripID) REFERENCES TRIP(TripID)
);

CREATE TABLE RATING (
    RatingID INT AUTO_INCREMENT,
    DriverID INT,
    PassengerID INT,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255),
    PRIMARY KEY (RatingID),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID),
    FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);

CREATE TABLE HELP (
   HelpID INT AUTO_INCREMENT,
   DriverID INT,
   PassengerID INT,
   email VARCHAR(255),
   trip_date DATE NOT NULL,
   lost_items VARCHAR(255),
   description TEXT,
   help_type TEXT NOT NULL,
   PRIMARY KEY (HelpID),
   FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID),
   FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);

CREATE TABLE SURVEY (
   SurveyID INT AUTO_INCREMENT,
   PassengerID INT NOT NULL,
   start_address VARCHAR(255),
   start_city VARCHAR(100),
   end_address VARCHAR(255),
   end_city VARCHAR(100),
   trip_date DATE NOT NULL,
   other TEXT,
   PRIMARY KEY (SurveyID),
   FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);



INSERT INTO DRIVER (DriverID, fname, lname, address, phone, email, password, biography, license_number, license_photo, color, model_name)
VALUES
    (1, 'John', 'Doe', '123 Main St', '555-555-5555', 'rhee@email.com', PASSWORD('11111111'), 'John is a friendly and experienced driver.', '5372353384', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUg', 'Red', 'Honda Civic'),
    (2, 'Bob', 'Johnson', '789 Oak St', '555-555-5557', 'choi@email.com', PASSWORD('11111111'), 'Bob is a new driver who is eager to learn and improve.', 'GHI789', 'path/to/photo3.jpg', 'Blue', 'Toyota Camry'),
    (3, 'Stella', 'Simanenko', '8265 Westend Avenue', '377-475-4305', 'ssimanenko3@yale.edu', PASSWORD('11111111'), 'Right-sized multi-state moderator', '7879569979', 'data:image/png;base64,iVBORw0KGgoA', 'Grey', 'Honda Civic');

INSERT INTO PASSENGER (PassengerID, fname, lname, address, phone, email, password, biography, credit_card) 
VALUES 
    (1, 'Hansang', 'Rhee', '524 N', '812-929-0435', 'rheeh@iu.edu', PASSWORD('Bomiles12!'), 'I am Rhee','11111111111'),
    (2, 'Woojin', 'Choi', '124 N', '812-929-0435', 'choi@iu.edu', PASSWORD('11111111'), 'I am Choi','11111111111');
    
INSERT INTO TRIP (TripID, DriverID, PassengerID, Start_location, End_location, Distance, Date)
VALUES 
    (1, 1, 2, 'Los Angeles', 'San Francisco', 383.22, '2022-02-14'),
    (2, 2, 1, '789 Oak St', '321 Pine St', 15.25, , '2022-02-14');

INSERT INTO PAYMENT (PaymentID, Payment_amount, TripID)
VALUES
    (1, 25.00, 1),
    (2, 30.00, 2);

INSERT INTO RATING (RatingID, Star_rating, Comments)
VALUES
    (1, 4.5, 'John was a great driver and the ride was very comfortable.'),
    (2, 3.5, 'Bob is a new driver and still needs improvement.');
