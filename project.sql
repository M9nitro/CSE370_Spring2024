--Project Name: Animal Adoption Site
--Course: CSE370 Spring 2024
--Group: 06
--Name: Meheruba Hasin Alif
--Name: Marzanul Momenine


--Drop
DROP DATABASE IF EXISTS furever_370;

--CREATE database

CREATE DATABASE furever_370;
USE furever370;

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



