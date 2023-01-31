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
   email VARCHAR(255) NOT NULL,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   phone VARCHAR(20),
   color VARCHAR(50),
   model_name VARCHAR(50),
   license_number VARCHAR(20) NOT NULL,
   license_photo VARCHAR(255)
);

CREATE TABLE PASSENGER (
   PassengerID INT PRIMARY KEY,
   email VARCHAR(255) NOT NULL,
   fname VARCHAR(50) NOT NULL,
   lname VARCHAR(50) NOT NULL,
   phone VARCHAR(20),
   credit_card VARCHAR(20) NOT NULL
);

CREATE TABLE TRIP (
    TripID INT PRIMARY KEY,
    DriverID INT,
    Start_location VARCHAR(255),
    End_location VARCHAR(255),
    Distance DECIMAL(10,2),
    FOREIGN KEY (DriverID) REFERENCES DRIVER(DriverID)
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

/* CREATE TABLE CHAT (
    UserID INT,
    Playlist VARCHAR(50),
    Images VARCHAR(255),
    Location VARCHAR(255),
    Text_messages VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES USER(UserID)
); */

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

INSERT INTO USER (UserID, fname, lname, address, phone, email, biography, user_type)
VALUES
    (1, 'John', 'Doe', '123 Main St', '555-555-5555', 'johndoe@email.com', 'John is a friendly and experienced driver.', 'driver'),
    (2, 'Jane', 'Smith', '456 Elm St', '555-555-5556', 'janesmith@email.com', 'Jane is a frequent passenger who values safety and comfort.', 'passenger'),
    (3, 'Bob', 'Johnson', '789 Oak St', '555-555-5557', 'bobjohnson@email.com', 'Bob is a new driver who is eager to learn and improve.', 'driver'),
    (4, 'Stella', 'Simanenko', '8265 Westend Avenue', '377-475-4305', 'ssimanenko3@yale.edu', 'Right-sized multi-state moderator', 'driver'),
    (5, 'Devlin', 'Sloey', '59937 Clyde Gallagher Hill', '133-648-7898', 'dsloey4@typepad.com', 'Ergonomic stable methodology', 'driver'),
    (6, 'Lawry', 'Lauder', '8679 Dakota Way', '996-692-4661', 'llauder5@parallels.com', 'Stand-alone interactive methodology', 'passenger'),
    (7, 'Bellina', 'Bartlett', '709 Hanson Hill', '742-407-7779', 'bbartlett6@amazonaws.com', 'Cross-platform real-time function', 'driver'),
    (8, 'Hieronymus', 'Franks', '39527 Portage Alley', '860-267-5940', 'hfranks7@amazon.co.jp', 'Polarised non-volatile forecast', 'passenger'),
    (9, 'Giacopo', 'Bainbridge', '54 Melrose Street', '977-433-5913', 'gbainbridge8@imageshack.us', 'Polarised systemic help-desk', 'passenger'),
    (10, 'Ameline', 'Lownes', '07353 Burning Wood Plaza', '623-655-1538', 'alownes9@smugmug.com', 'De-engineered multi-state circuit', 'driver'),
    (11, 'Bobbee', 'Fosdick', '12475 Loomis Crossing', '711-124-4748', 'bfosdicka@nytimes.com', 'Centralized directional productivity', 'passenger'),
    (12, 'Brendan', 'Bellard', '4 Sutherland Alley', '874-291-3363', 'bbellardb@ovh.net', 'Future-proofed actuating software', 'driver'),
    (13, 'Renault', 'Truckett', '9 Fairview Hill', '577-722-9012', 'rtruckettc@cornell.edu', 'Public-key bandwidth-monitored policy', 'passenger'),
    (14, 'Catherin', 'Pilley', '176 Cambridge Plaza', '815-522-2082', 'cpilleyd@oracle.com', 'Open-source web-enabled instruction set', 'driver'),
    (15, 'Kristian', 'Humbie', '26 Ridgeview Junction', '573-109-2244', 'khumbiee@youku.com', 'Grass-roots intermediate emulation', 'driver'),
    (16, 'Maryl', 'Torbett', '5418 East Street', '766-367-7089', 'mtorbettf@multiply.com', 'Profound multi-state artificial intelligence', 'passenger'),
    (17, 'Rodge', 'Letixier', '890 Meadow Vale Court', '376-797-8416', 'rletixierg@cornell.edu', 'Assimilated non-volatile throughput', 'driver'),
    (18, 'Aymer', 'Cornehl', '4 Karstens Circle', '673-129-7075', 'acornehlh@t.co', 'Visionary multi-state capacity', 'passenger'),
    (19, 'Sergent', 'Ingrey', '39 Marcy Court', '943-354-1084', 'singreyi@parallels.com', 'Reverse-engineered radical benchmark', 'driver'),
    (20, 'Gayelord', 'Bunford', '506 Independence Park', '566-913-8364', 'gbunfordj@topsy.com', 'Multi-lateral foreground application', 'driver'),
    (21, 'Ailbert', 'Caudwell', '9 5th Pass', '519-791-0146', 'acaudwellk@chicagotribune.com', 'Open-architected incremental budgetary management', 'passenger'),
    (22, 'Marya', 'Gergely', '263 Anhalt Pass', '338-607-3468', 'mgergelyl@gnu.org', 'Persistent national capacity', 'driver'),
    (23, 'Carita', 'Ayscough', '50799 Harper Street', '546-886-3531', 'cayscoughm@zdnet.com', 'Cross-group scalable customer loyalty', 'passenger'),
    (24, 'Gilly', 'Fairlie', '19149 Mayer Parkway', '650-175-8164', 'gfairlien@blog.com', 'Multi-tiered non-volatile access', 'driver'),
    (25, 'Blayne', 'Raubenheimers', '21760 Dorton Plaza', '275-567-3323', 'braubenheimerso@marketwatch.com', 'Multi-channelled hybrid analyzer', 'driver'),
    (26, 'Elspeth', 'Tynan', '86945 Shopko Crossing', '851-123-7229', 'etynanp@msu.edu', 'Advanced 5th generation methodology', 'driver'),
    (27, 'Elsinore', 'Kaman', '5 Petterle Park', '574-906-8188', 'ekamanq@webmd.com', 'Grass-roots needs-based productivity', 'passenger'),
    (28, 'Galven', 'Hindsberg', '63727 Lunder Avenue', '170-906-6944', 'ghindsbergr@unicef.org', 'Pre-emptive fault-tolerant throughput', 'driver'),
    (29, 'Kip', 'Primmer', '7 Hanover Terrace', '628-621-8480', 'kprimmers@yelp.com', 'Business-focused national algorithm', 'passenger'),
    (30, 'Kalindi', 'Roubay', '88 Charing Cross Trail', '647-852-9716', 'kroubayt@cbsnews.com', 'Extended multimedia local area network', 'driver');
    
INSERT INTO DRIVER (DriverID, license_number, license_photo)
VALUES
    (2, '5372353384', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUg'),
    (4, 'GHI789', 'path/to/photo3.jpg'),
    (5, '7879569979', 'data:image/png;base64,iVBORw0KGgoA'),
    (6, '4628007578', 'data:image/png;base64,iVBORw0KGgoAAAANSUhI='),
    (7, '0916366863', 'data:image/png;base64,iVBORw0KGgoAAAANSUhAAASUVORK5CYII='),
    (8, '1024971406', 'data:image/png;base64,iVBORw0KGgoAAAANSUh5CYII='),
    (9, '2122639199', 'data:image/png;base64,iVBORw0KGgoAAAANSUhI='),
    (10, '2521477761', 'data:image/png;base64,iVBORw0KGgoAAAANSU'),
    (11, '1457107163', 'data:image/png;base64,iVBORw0KGgoAAAANSUgg=='),
    (12, '0053671252', 'data:image/png;base64,iVBORw0KGgoAAAANSU='),
    (13, '4083423110', 'data:image/png;base64,iVBORw0KGgoAAAANSU'),
    (14, '0369236610', 'data:image/png;base64,iVBORw0KGgoAAAANSUCYII='),
    (15, '4054315593', 'data:image/png;base64,iVBORw0KGgoAg=='),
    (16, '4092555652', 'data:image/png;base64,iVBORw0KGgoAg=='),
    (17, '6985423876', 'data:image/png;base64,iVB='),
    (18, '3403460355', 'data:image/png;base64,iVBORw0KGgoAAA'),
    (19, '2987836392', 'data:image/png;base64,iVBORw0KGgoAAA=='),
    (20, '7112665000', 'data:image/png;base64,iVBORw0KGgoAAAvnAlAAAAAElFTkSuQmCC'),
    (21, '6533171569', 'data:image/png;base64,iVBORw0KGgoAAA'),
    (22, '8087980859', 'data:image/png;base64,iVVQAAAAASUVORK5CYII='),
    (23, '5634292042', 'data:image/png;base64,iVtXW4xpbWpAAAAAElFTkSuQmCC'),
    (24, '5674601259', 'data:image/png;base64,iVggg=='),
    (25, '7865976712', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAARK5CYII='),
    (26, '0142505404', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/IpX+oHaI9cJDajhlcAAAAASUVORK5CYII='),
    (27, '1566337976', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABVORK5CYII='),
    (28, '6157176121', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABs5XQAAAABJRU5ErkJggg=='),
    (29, '8856237482', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABYII='),
    (30, '3276072769', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABC');
    
INSERT INTO PASSENGER (PassengerID, credit_card)
VALUES
    (1, '5048370199463308'),
    (3, '5048377193344939'),
    (4, '5108757924503282'),
    (5, '5048377626409762'),
    (6, '5108759460164669'),
    (7, '5108753041085246'),
    (8, '5108750322682477'),
    (9, '5108755474156667'),
    (10, '5048377906187534'),
    (11, '5108755724718852'),
    (12, '5048375457347184'),
    (13, '5048377410336288'),
    (14, '5108752645660974'),
    (15, '5048370774111033'),
    (16, '5048378651937495'),
    (17, '5048376195389413'),
    (18, '5048377656341570'),
    (19, '5108756642603911'),
    (20, '5048370436585509'),
    (21, '5048376121964461'),
    (22, '5108758551875514'),
    (23, '5048370701510158'),
    (24, '5048371429556382'),
    (25, '5048372946816580'),
    (26, '5108753452365053'),
    (27, '5108759111239050'),
    (28, '5108753655151805'),
    (29, '5048373226907461'),
    (30, '5048379004364478');

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
