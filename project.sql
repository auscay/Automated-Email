-- create database automated_email
CREATE DATABASE automated_email;

-- create user table
CREATE TABLE users (
    users_id INT AUTO_INCREMENT PRIMARY KEY, 
    users_username VARCHAR(11) NOT NULL,
    users_email VARCHAR(100) NOT NULL,
    users_password VARCHAR(255) NOT NULL
);

-- create scheduled_emails table 
CREATE TABLE scheduled_emails (
    email_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    recipient_email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    scheduled_time DATETIME NOT NULL,
    status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
    attempts INT(11) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

