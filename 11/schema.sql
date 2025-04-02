CREATE DATABASE gtbit_db;
USE gtbit_db;

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

CREATE TABLE faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    department_id INT,
    designation VARCHAR(255),
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Insert Sample Data
INSERT INTO departments (name) VALUES ('Computer Science'), ('Electronics'), ('Mechanical');

INSERT INTO courses (department_id, name) VALUES 
(1, 'B.Tech CSE'), 
(1, 'B.Tech IT'), 
(2, 'B.Tech ECE'),
(3, 'B.Tech ME');

INSERT INTO faculty (name, department_id, designation) VALUES 
('Dr. Rajesh Kumar', 1, 'Professor'),
('Dr. Anita Sharma', 2, 'Associate Professor'),
('Mr. Rahul Mehta', 3, 'Assistant Professor');
