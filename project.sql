-- create user table
CREATE TABLE users (
    users_id INT AUTO_INCREMENT PRIMARY KEY, 
    users_username VARCHAR(11) NOT NULL,
    users_email VARCHAR(100) NOT NULL,
    users_password VARCHAR(255) NOT NULL
);
