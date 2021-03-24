CREATE DATABASE hackerhero_practice;

CREATE TABLE Users (
    id INT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    encrypted_password VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO Users(id, first_name, last_name, email, encrypted_password, created_at, updated_at) VALUES(1, 'John', 'Doe', 'johndoe@gmail.com', 'cb4e0bdaf038454fd1f3be246a7de2c5', CURDATE(), CURDATE());
INSERT INTO Users(id, first_name, last_name, email, encrypted_password, created_at, updated_at) VALUES(2, 'Morris', 'Philip', 'philimorris@gmail.com', 'w220bdaf038454fd1f3be246a7de2c5', CURDATE(), CURDATE());
INSERT INTO Users(id, first_name, last_name, email, encrypted_password, created_at, updated_at) VALUES(3, 'John', 'Doe', 'johndoe@gmail.com', 'eww11e0bdafw2e1e4fd1f3be246a7de2c5', CURDATE(), CURDATE());

UPDATE Users SET first_name = 'Jack', last_name = 'Nordan', email = 'jacknordan@gmail.com', encrypted_password = 'm2qm34m6038454fd1f3be246a7de2c5' WHERE id in (3, 5, 7, 12, 19);

DELETE FROM Users WHERE id = 1;

DELETE FROM Users;

DROP TABLE Users;
-- the DROP TABLE is deleting the entire table while DELETE is deleting the specific rows within the table

ALTER TABLE users CHANGE email email_address VARCHAR(255);

ALTER TABLE users MODIFY id BIGINT;

ALTER TABLE users ADD is_active BOOLEAN NOT NULL;