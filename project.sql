--Project Name: Animal Adoption Site
--Course: CSE370 Spring 2024
--Group: 06
--Name: Meheruba Hasin Alif
--Name: Marzanul Momenine


--Drop
DROP DATABASE IF EXISTS furever_370;

--CREATE database

CREATE DATABASE furever_370;
USE furever_370;

--Table definitions

--User Entity

CREATE TABLE USER (
    userID CHAR(10) not NULL,
    user_name VARCHAR(30) not NULL,
    user_NID INT not NULL,
    user_password CHAR(10) not NULL,
    user_DOB date,
    user_phone CHAR(11),
    user_email VARCHAR(20),
    user_address VARCHAR(20),
    
    -- 0 is Admin
    -- 1 is Rescuer
    -- 2 is Adoptee
    user_type TINYINT not NULL CHECK(user_type BETWEEN 0 AND 2),
    
    PRIMARY KEY (userID)
);

-- PET Entity

CREATE TABLE PET (

    petID VARCHAR(10) not NULL,
    rescuerID VARCHAR(10) not NULL,
    pet_name VARCHAR(10),
    pet_age int not NULL,
    pet_Breed VARCHAR(10),

    -- 0 is CAT
    -- 1 is DOG
    -- 2 is RABBIT
    pet_type TINYINT not NULL CHECK(pet_type BETWEEN 0 AND 2),
    vet_report VARCHAR(30),
    rescue_date DATE,

    PRIMARY KEY(petID),
    FOREIGN KEY(rescuerID) references USER(userID)
);

-- PAST Owner MultiValue

CREATE TABLE Past_petOwner (

    petID CHAR(10),
    OwnerName VARCHAR(10),

    PRIMARY KEY (petID, OwnerName),
    FOREIGN KEY (petID) references PET(petID)
);

--Donation

CREATE TABLE Donation (

    userID CHAR(10) not NULL,
    TransactionID CHAR(10) not NULL,
    donation_amount INT not NULL CHECK(donation_amount >= 0),
    -- 0 is Bank Transfer
    -- 1 is Bkash
    -- 2 is Nagad
    donation_method TINYINT not NULL CHECK(donation_method BETWEEN 0 AND 2),
    donation_date DATE,

    PRIMARY KEY (userID, TransactionID),
    FOREIGN KEY (userID) references USER(userID)
);

-- Review Entity

CREATE TABLE Review (

    adopteeID CHAR(10) not NULL,
    reviewNO CHAR(10) not NULL,
    rating INT not NULL CHECK(rating BETWEEN 1 AND 5),
    review_date DATE,
    Review_story VARCHAR(40),

    PRIMARY KEY(adopteeID, reviewNO),
    FOREIGN KEY(adopteeID) references USER(userID)
);

--Gift Entity

CREATE TABLE Gift (

    giftID CHAR(10) not NULL,
    number_gift int,
    animal_breed VARCHAR(10),

    -- 0 is CAT
    -- 1 is DOG
    -- 2 is RABBIT
    animal_type TINYINT not NULL CHECK(animal_type BETWEEN 0 AND 2),

    PRIMARY KEY (giftID)
);

--Gift Given relation

CREATE TABLE Gift_given (

    giftID CHAR(10),
    animalID CHAR(10),
    userID CHAR(10),

    PRIMARY KEY (giftID, animalID, userID),
    FOREIGN KEY (animalID) references PET(petID),
    FOREIGN KEY (userID) references USER(userID)
);


-- Inserting data into USER table
INSERT INTO USER (userID, user_name, user_NID, user_password, user_DOB, user_phone, user_email, user_address, user_type)
VALUES 
('U001', 'John Doe', 1234567890, 'password1', '1990-05-15', '1234567890', 'john@example.com', '123 Main St', 0),
('U002', 'Jane Smith', 0987654321, 'password2', '1985-10-20', '0987654321', 'jane@example.com', '456 Oak St', 1),
('U003', 'Alice Johnson', 1357924680, 'password3', '2000-03-25', '1357924680', 'alice@example.com', '789 Pine St', 2);

-- Inserting data into PET table
INSERT INTO PET (petID, rescuerID, pet_name, pet_age, pet_Breed, pet_type, vet_report, rescue_date)
VALUES 
('P001', 'U002', 'Fluffy', 3, 'Persian', 0, 'Healthy', '2023-07-10'),
('P002', 'U002', 'Buddy', 2, 'Labrador', 1, 'Vaccinated', '2023-08-05'),
('P003', 'U002', 'Snowball', 1, 'Lionhead', 2, 'Underweight', '2023-09-20');

-- Inserting data into Past_petOwner table
INSERT INTO Past_petOwner (petID, OwnerName)
VALUES 
('P001', 'John Doe'),
('P002', 'Alice Johnson'),
('P003', 'John Doe');

-- Inserting data into Donation table
INSERT INTO Donation (userID, TransactionID, donation_amount, donation_method, donation_date)
VALUES 
('U001', 'T001', 1000, 0, '2023-07-15'),
('U002', 'T002', 500, 1, '2023-08-20'),
('U003', 'T003', 750, 2, '2023-09-25');

-- Inserting data into Review table
INSERT INTO Review (adopteeID, reviewNO, rating, review_date, Review_story)
VALUES 
('U003', 'R001', 5, '2023-08-01', 'Great experience, highly recommend!'),
('U002', 'R002', 4, '2023-09-10', 'Good service, could improve communication.');

-- Inserting data into Gift table
INSERT INTO Gift (giftID, number_gift, animal_breed, animal_type)
VALUES 
('G001', 10, 'Persian', 0),
('G002', 5, 'Labrador', 1),
('G003', 3, 'Lionhead', 2);

-- Inserting data into Gift_given table
INSERT INTO Gift_given (giftID, animalID, userID)
VALUES 
('G001', 'P001', 'U001'),
('G002', 'P002', 'U003'),
('G003', 'P003', 'U002');
