-- World Series website — database schema
-- Import this once in phpMyAdmin (or `mysql -u root -p < schema.sql`)

CREATE DATABASE IF NOT EXISTS world_series_db
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE world_series_db;

CREATE TABLE IF NOT EXISTS users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;