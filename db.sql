CREATE DATABASE IF NOT EXISTS roblox_airport CHARACTER SET utf8mb4;
USE roblox_airport;

CREATE TABLE IF NOT EXISTS users (
    roblox_id BIGINT PRIMARY KEY,
    username VARCHAR(50),
    display_name VARCHAR(100),
    tag VARCHAR(20) UNIQUE,
    avatar_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
