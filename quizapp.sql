CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255),
    lastname varchar(255),
    email varchar(50),
    password varchar(255),
    username varchar(50),
    profilepic varchar(255),
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    registration_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_role int(1),
    PRIMARY KEY (id)
);

CREATE TABLE questions (
    id int NOT NULL AUTO_INCREMENT,
    question_number int NOT NULL,
    question text,
    answer varchar(255),
    question_image varchar(255),
    subject varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE quiz_record (
    id int NOT NULL AUTO_INCREMENT,   
    username varchar(255),
    score int,
    time_of_submission datetime,
    subject varchar(255),
    PRIMARY KEY (id)
);

