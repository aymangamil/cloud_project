create database cloud_database;
use cloud_database;
CREATE TABLE Students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    password VARCHAR(255),
    cgpa DECIMAL(3,2) CHECK (cgpa >= 0 AND cgpa <= 4),
    gender VARCHAR(10) CHECK (gender IN ('male', 'female')), -- Using VARCHAR and CHECK constraint
    age INT
);
SELECT * FROM Students ;
