DROP TABLE IF EXISTS CUSTOMER_CARE;
DROP TABLE IF EXISTS CHAT;
DROP TABLE IF EXISTS EXAM_RESULT;
DROP TABLE IF EXISTS TRAINING;
DROP TABLE IF EXISTS EXAM;
DROP TABLE IF EXISTS RATING;
DROP TABLE IF EXISTS PAYMENT;
DROP TABLE IF EXISTS TRIP;
DROP TABLE IF EXISTS VEHICLE;
DROP TABLE IF EXISTS PASSENGER;
DROP TABLE IF EXISTS DRIVER;


CREATE TABLE DRIVER (
   DriverID INT PRIMARY KEY,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   address VARCHAR(255),
   phone VARCHAR(20),
   email VARCHAR(255) NOT NULL,
   password VARCHAR(250) NOT NULL,
   biography TEXT,
   license_number VARCHAR(20) NOT NULL,
   license_photo VARCHAR(255)
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

CREATE TABLE VEHICLE (
    VehicleID INT PRIMARY KEY,
    DriverID INT,
    Color VARCHAR(50),
    Model_Name VARCHAR(50),
    license_number VARCHAR(20) NOT NULL,
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID)
);

CREATE TABLE TRIP (
    TripID INT PRIMARY KEY,
    DriverID INT,
    PassengerID INT,
    Start_location VARCHAR(255),
    End_location VARCHAR(255),
    Distance DECIMAL(10,2),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID),
    FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);


CREATE TABLE PAYMENT (
    PaymentID INT PRIMARY KEY,
    TripID INT,
    `Payment_amount` DECIMAL(10,2),
    FOREIGN KEY (TripID) REFERENCES TRIP(TripID)
);

CREATE TABLE RATING (
    RatingID INT PRIMARY KEY,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255)
);

CREATE TABLE EXAM (
    Exam_ID INT PRIMARY KEY,
    Title VARCHAR(50),
    Questions VARCHAR(255),
    Passing_score DECIMAL(3,1)
);

CREATE TABLE TRAINING (
    TrainingID INT PRIMARY KEY,
    Module_capacity INT,
    Location VARCHAR(255),
    Subject VARCHAR(50),
    Verification BOOLEAN
);

CREATE TABLE EXAM_RESULT (
    Exam_ID INT,
    Exam_date DATE NOT NULL,
    Exam_hours TIME NOT NULL,
    Score DECIMAL(3,1),
    FOREIGN KEY (Exam_ID) REFERENCES EXAM(Exam_ID)
);


CREATE TABLE CUSTOMER_CARE (
   EmpID INT PRIMARY KEY,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   Address VARCHAR(255),
   Phone VARCHAR(20),
   Email VARCHAR(255) NOT NULL,
   Biography TEXT,
   MentorID INT,
   FOREIGN KEY (MentorID) REFERENCES CUSTOMER_CARE(EmpID)
);



INSERT INTO PASSENGER (fname, lname, address, phone, email, password, biography, credit_card) VALUES ('Hansang', 'Rhee', '524 N', '812-929-0435', 'rheeh@iu.edu', PASSWORD('Bomiles12!'), 'I am Rhee','11111111111')

INSERT INTO DRIVER (DriverID, fname, lname, address, phone, email, biography, license_number, license_photo)
VALUES
    (2, 'John', 'Doe', '123 Main St', '555-555-5555', 'johndoe@email.com', 'John is a friendly and experienced driver.', '5372353384', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUg'),
    (4, 'Bob', 'Johnson', '789 Oak St', '555-555-5557', 'bobjohnson@email.com', 'Bob is a new driver who is eager to learn and improve.', 'GHI789', 'path/to/photo3.jpg'),
    (5, 'Stella', 'Simanenko', '8265 Westend Avenue', '377-475-4305', 'ssimanenko3@yale.edu', 'Right-sized multi-state moderator', '7879569979', 'data:image/png;base64,iVBORw0KGgoA');

INSERT INTO PASSENGER (PassengerID, fname, lname, address, phone, email, biography, credit_card)
VALUES
    (1, 'Jane', 'Smith', '456 Elm St', '555-555-5556', 'janesmith@email.com', 'Jane is a frequent passenger who values safety and comfort.', '5048370199463308'),
    (3, 'Kip', 'Primmer', '7 Hanover Terrace', '628-621-8480', 'kprimmers@yelp.com', 'Business-focused national algorithm', '5048377193344939'),
    (4, 'Elsinore', 'Kaman', '5 Petterle Park', '574-906-8188', 'ekamanq@webmd.com', 'Grass-roots needs-based productivity', '5108757924503282');


INSERT INTO VEHICLE (VehicleID, Color, Model_Name, license_number)
VALUES
    (1, 'Red', 'Honda Civic', 'ABC123'),
    (2, 'Blue', 'Toyota Camry', 'DEF456');
    
INSERT INTO TRIP (TripID, Start_location, End_location, Distance, DriverID)
VALUES
    (1, '123 Main St', '456 Elm St', 10.5, 1),
    (2, '789 Oak St', '321 Pine St', 15.25, 3);

INSERT INTO PAYMENT (PaymentID, Payment_amount, TripID)
VALUES
    (1, 25.00, 1),
    (2, 30.00, 2);

INSERT INTO RATING (RatingID, Star_rating, Comments)
VALUES
    (1, 4.5, 'John was a great driver and the ride was very comfortable.'),
    (2, 3.5, 'Bob is a new driver and still needs improvement.');
    
INSERT INTO EXAM (Exam_ID, Title, Questions, Passing_score)
VALUES
    (1, 'Driver Safety Exam', 'Questions about safe driving practices and traffic laws', 80);

INSERT INTO TRAINING (TrainingID, Module_capacity, Location, Subject, Verification)
VALUES
    (1, 20, '123 Main St', 'Driver Safety', 1);

INSERT INTO EXAM_RESULT (Exam_date, Exam_hours, Score, Exam_ID)
VALUES
    ('2022-01-01', '10:00:00', 85, 1);

INSERT INTO CHAT (Playlist, Images, Location, Text_messages, UserID)
VALUES
    ('Road Trip', 'path/to/image1.jpg, path/to/image2.jpg', '123 Main St', 'Hello, how are you doing?', 1),
    ('Commute', 'path/to/image3.jpg', '456 Elm St', 'Good morning!', 2);

INSERT INTO CUSTOMER_CARE (EmpID, fname, lname, Address, Phone, Email, Biography, MentorID)
VALUES
    (1, 'Emily', 'Richards', '1000 Market St', '555-555-5558', 'emily@email.com', 'Emily is an experienced customer service representative and a great mentor.', null),
    (2, 'Michael', 'DeSanta', '2000 Market St', '555-555-5559', 'michael@email.com', 'Michael is a new customer service representative and is being mentored by Emily.', 1);