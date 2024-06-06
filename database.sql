create database test;

use test;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    city VARCHAR(100) NOT NULL,
    photo VARCHAR(255) NOT NULL
);