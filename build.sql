DROP TABLE IF EXISTS SURVEY;
DROP TABLE IF EXISTS HELP;
DROP TABLE IF EXISTS RATING_PASSENGER;
DROP TABLE IF EXISTS RATING_DRIVER;
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
    Payment_amount DECIMAL(10,2),
    TripID INT,
    PRIMARY KEY (PaymentID),
    FOREIGN KEY (TripID) REFERENCES TRIP(TripID)
);

CREATE TABLE RATING_DRIVER (
    RatingID INT AUTO_INCREMENT,
    DriverID INT NOT NULL,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255),
    PRIMARY KEY (RatingID),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID)
);

CREATE TABLE RATING_PASSENGER (
    RatingID INT AUTO_INCREMENT,
    PassengerID INT,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255),
    PRIMARY KEY (RatingID),
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



INSERT INTO DRIVER (fname, lname, address, phone, email, password, biography, license_number, license_photo, color, model_name)
VALUES
    ('John', 'Doe', '123 Main St', '555-555-5555', 'rhee@email.com', PASSWORD('11111111'), 'John is a friendly and experienced driver.', '5372353384', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUg', 'Red', 'Honda Civic'),
    ('Bob', 'Johnson', '789 Oak St', '555-555-5557', 'choi@email.com', PASSWORD('11111111'), 'Bob is a new driver who is eager to learn and improve.', 'GHI789', 'path/to/photo3.jpg', 'Blue', 'Toyota Camry'),
    ('Stella', 'Simanenko', '8265 Westend Avenue', '377-475-4305', 'ssimanenko3@yale.edu', PASSWORD('11111111'), 'Right-sized multi-state moderator', '7879569979', 'data:image/png;base64,iVBORw0KGgoA', 'Grey', 'Honda Civic');

INSERT INTO PASSENGER (fname, lname, address, phone, email, password, biography, credit_card) 
VALUES 
    ('Hansang', 'Rhee', '524 N', '812-929-0435', 'rheeh@iu.edu', PASSWORD('Bomiles12!'), 'I am Rhee','11111111111'),
    ('Woojin', 'Choi', '124 N', '812-929-0435', 'choi@iu.edu', PASSWORD('11111111'), 'I am Choi','11111111111');
    
INSERT INTO TRIP (DriverID, PassengerID, Start_location, End_location, Distance, Date)
VALUES 
    (1, 2, 'Los Angeles', 'San Francisco', 383.22, '2022-02-14'),
    (2, 1, '789 Oak St', '321 Pine St', 15.25, , '2022-02-14');

INSERT INTO PAYMENT (Payment_amount, TripID)
VALUES
    (25.00, 1),
    (30.00, 2);

INSERT INTO RATING_DRIVER (DriverID, Star_rating, Comments)
VALUES
    (2, 4.5, 'John was a great driver and the ride was very comfortable.');

INSERT INTO RATING_PASSENGER (PassengerID, Star_rating, Comments)
VALUES
    (1, 3.5, 'Bob is a new driver and still needs improvement.');


