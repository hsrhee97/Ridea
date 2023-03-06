DROP TABLE IF EXISTS CHAT;
DROP TABLE IF EXISTS SURVEY;
DROP TABLE IF EXISTS HELP;
DROP TABLE IF EXISTS RATING;
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
    SurveyID INT,
    payment_gross FLOAT(10,2),
    txn_id VARCHAR(20),
    currency_code VARCHAR(5),
    payment_status VARCHAR(20),
    PRIMARY KEY (PaymentID),
    FOREIGN KEY (SurveyID) REFERENCES SURVEY(SurveyID)
);

CREATE TABLE RATING_DRIVER (
    Rating_D_ID INT AUTO_INCREMENT,
    DriverID INT NOT NULL,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255),
    PRIMARY KEY (Rating_D_ID),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID)
);

CREATE TABLE RATING_PASSENGER (
    Rating_P_ID INT AUTO_INCREMENT,
    PassengerID INT NOT NULL,
    Star_rating DECIMAL(5,1),
    Comments VARCHAR(255),
    PRIMARY KEY (Rating_P_ID),
    FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);

CREATE TABLE HELP (
   HelpID INT AUTO_INCREMENT,
   DriverID INT,
   PassengerID INT,
   TripID INT,
   email VARCHAR(255),
   trip_date DATE NOT NULL,
   lost_items VARCHAR(255),
   description TEXT,
   help_type TEXT NOT NULL,
   PRIMARY KEY (HelpID),
   FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID),
   FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID),
   FOREIGN KEY (TripID) REFERENCES TRIP(TripID)
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
   status tinyint(1) NOT NULL DEFAULT '1',
   Distance INT,
   price FLOAT(10,2),
   PRIMARY KEY (SurveyID),
   FOREIGN KEY (PassengerID) REFERENCES PASSENGER(PassengerID)
);

CREATE TABLE CHAT (
   ChatID INT AUTO_INCREMENT,
   SenderID INT NOT NULL,
   ReceiverID INT NOT NULL,
   message TEXT,
   message_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (ChatID),
   FOREIGN KEY (SenderID) REFERENCES PASSENGER(PassengerID),
   FOREIGN KEY (ReceiverID) REFERENCES PASSENGER(PassengerID)
);



INSERT INTO DRIVER (fname, lname, address, phone, email, password, biography, license_number, license_photo, color, model_name)
VALUES
    ('John', 'Doe', '123 Main St', '555-555-5555', 'rhee@email.com', PASSWORD('11111111'), 'John is a friendly and experienced driver.', '5372353384', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUg', 'Red', 'Honda Civic'),
    ('Bob', 'Johnson', '789 Oak St', '555-555-5557', 'choi@email.com', PASSWORD('11111111'), 'Bob is a new driver who is eager to learn and improve.', 'GHI789', 'path/to/photo3.jpg', 'Blue', 'Toyota Camry'),
    ('Stella', 'Simanenko', '8265 Westend Avenue', '377-475-4305', 'ssimanenko3@yale.edu', PASSWORD('11111111'), 'Right-sized multi-state moderator', '7879569979', 'data:image/png;base64,iVBORw0KGgoA', 'Grey', 'Honda Civic'),
    ("John", "Doe", "123 Main St, Bloomington, IN", "123-456-7890", "johndoe@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "123456", "/uploads/license1.jpg", "red", "Ford Mustang"),
    ("Jane", "Doe", "456 Broad St, Bloomington, IN", "123-456-7890", "janedoe@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "654321", "/uploads/license2.jpg", "blue", "Toyota Camry"),
    ("Bob", "Smith", "789 Elm St, Bloomington, IN", "123-456-7890", "bobsmith@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "987654", "/uploads/license3.jpg", "green", "Honda Accord"),
    ("Alice", "Johnson", "111 State St, Bloomington, IN", "123-456-7890", "alicejohnson@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "456789", "/uploads/license4.jpg", "yellow", "Nissan Altima"),
    ("Mike", "Brown", "222 College Ave, Bloomington, IN", "123-456-7890", "mikebrown@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "654321", "/uploads/license5.jpg", "silver", "Honda Civic"),
    ("Sarah", "Davis", "333 Walnut St, Bloomington, IN", "123-456-7890", "sarahdavis@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "123456", "/uploads/license6.jpg", "black", "Chevrolet Malibu"),
    ("David", "Wilson", "444 Kirkwood Ave, Bloomington, IN", "123-456-7890", "davidwilson@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "987654", "/uploads/license7.jpg", "white", "Ford Fusion"),
    ("Amy", "Taylor", "555 Indiana Ave, Bloomington, IN", "123-456-7890", "amytaylor@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "456789", "/uploads/license8.jpg", "gray", "Toyota Corolla"),
    ("Tom", "Anderson", "666 Jordan Ave, Bloomington, IN", "123-456-7890", "tomanderson@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "654321", "/uploads/license9.jpg", "red", "Honda Fit"),
    ("Linda", "Martin", "777 Dunn St, Bloomington, IN", "123-456-7890", "lindamartin@example.com", PASSWORD('11111111'), "Lorem ipsum dolor sit amet", "123456", "/uploads/license10.jpg", "blue", "Nissan Sentra");

INSERT INTO PASSENGER (fname, lname, address, phone, email, password, biography) 
VALUES 
    ('Hansang', 'Rhee', '524 N', '812-929-0435', 'rheeh@iu.edu', PASSWORD('Bomiles12!'), 'I am Rhee'),
    ('Woojin', 'Choi', '124 N', '812-929-0435', 'choi@iu.edu', PASSWORD('11111111'), 'I am Choi'),
    ("John", "Doe", "123 Main St, Bloomington, IN", "123-456-7890", "johndoe@example.com", PASSWORD('11111111'), "I'm a software engineer"),
    ("Jane", "Doe", "456 Elm St, Bloomington, IN", "234-567-8901", "janedoe@example.com", PASSWORD('11111111'), "I'm a student at IU"),
    ("Bob", "Smith", "789 Walnut St, Bloomington, IN", "345-678-9012", "bobsmith@example.com", PASSWORD('11111111'), "I'm a teacher"),
    ("Alice", "Jones", "321 Oak St, Bloomington, IN", "456-789-0123", "alicejones@example.com", PASSWORD('11111111'), "I'm an artist"),
    ("Tom", "Brown", "654 Pine St, Bloomington, IN", "567-890-1234", "tombrown@example.com", PASSWORD('11111111'), "I'm a musician"),
    ("Samantha", "Miller", "987 Cedar St, Bloomington, IN", "678-901-2345", "samanthamiller@example.com", PASSWORD('11111111'), "I'm a nurse"),
    ("David", "Wilson", "246 Maple St, Bloomington, IN", "789-012-3456", "davidwilson@example.com", PASSWORD('11111111'), "I'm a chef"),
    ("Maria", "Garcia", "135 Cherry St, Bloomington, IN", "890-123-4567", "mariagarcia@example.com", PASSWORD('11111111'), "I'm a librarian"),
    ("Megan", "Lee", "864 Birch St, Bloomington, IN", "901-234-5678", "meganlee@example.com", PASSWORD('11111111'), "I'm a photographer"),
    ("Michael", "Davis", "579 Spruce St, Bloomington, IN", "012-345-6789", "michaeldavis@example.com", PASSWORD('11111111'), "I'm a lawyer");

    
INSERT INTO TRIP(DriverID, PassengerID, Start_location, End_location, Distance, Date)
VALUES 
    (3, 16, 'Bloomington', 'Miami', 482.12, '2023-03-19'),
    (2, 16, 'Greenville', 'Brownville', 123.98, '2022-07-26'),
    (3, 16, 'Chicago', 'Miami', 456.32, '2022-07-29'),
    (4, 16, 'San Francisco', 'Seattle', 456.32, '2022-07-21'),
    (6, 16, 'Boston', 'Bloomington', 5982.34, '2022-07-12'),
    (6, 16, 'Los Angeles', 'San Francisco', 383.22, '2022-02-13'),
    (2, 16, '789 Oak St', '321 Pine St', 15.25, '2022-02-14'),
    (3, 5, 'Chicago', 'Los Angeles', 4329.45, '2022-08-23'),
    (4, 4, 'BOSTON', 'MIAMI', 324.87, '2022-08-04'),
    (5, 6, 'ORLANDO', 'CANCUN', 1234.87, '2022-09-29');

INSERT INTO PAYMENT (Payment_amount, TripID)
VALUES
    (25.00, 1),
    (30.00, 2);

INSERT INTO RATING_DRIVER (DriverID, Star_rating, Comments)
VALUES
    (2, 4.5, 'Bob was a great driver and the ride was very comfortable.');

INSERT INTO RATING_PASSENGER (PassengerID, Star_rating, Comments)
VALUES
    (1, 3.5, 'Bob is a new driver and still needs improvement.'),
    (2, 3.5, 'Bob is a new driver and still needs improvement.'),
    (3, 3.5, 'Bob is a new driver and still needs improvement.'),
    (4, 3.5, 'Bob is a new driver and still needs improvement.');

INSERT INTO SURVEY (PassengerID, start_address, start_city, end_address, end_city, trip_date, other, Distance, price) 
VALUES 
    (1, '123 Main St', 'New York', '456 Elm St', 'Portland', '2023-01-15', 'None', 230, 3.99),
    (2, '456 Elm St', 'Boston', '789 Maple Ave', 'Portland', '2024-02-02', 'Traffic was terrible!', 250, 3.99),
    (3, '444 1st Ave', 'Seattle', '555 2nd St', 'Los Angeles', '2024-02-02', NULL, 100, 9.99),
    (6, '423 Elm St', 'Boston', '723 Ave', 'Portland', '2024-02-02', 'Traffic was terrible!',234, 103.99),
    (5, '900 Beach Blvd', 'New York', '1000 Ocean Ave', 'Jacksonville', '2023-05-12', 'Stopped for lunch in Orlando.',23, 6.99),
    (4, '1000 Ocean Ave', 'Boston', '123 Main St', 'New York', '2023-06-25', NULL,23, 124.99), 
    (6, '123 Main St', 'New York', '456 Elm St', 'Portland', '2023-01-15', 'None', 230, 2.99),
    (8, '534 College St', 'New York', '456 Elm St', 'Bloomington', '2023-04-15', 'None', 11, 3.99);

INSERT INTO CHAT (SenderID, ReceiverID, message)
VALUES 
    (1, 2, 'Hi?'),
    (2, 1, 'What up?'),
    (1, 3, 'hello'),
    (2, 4, 'I am h'),
    (2, 3, 'I am here'),
    (2, 1, 'good'),
    (3, 4, 'why');

