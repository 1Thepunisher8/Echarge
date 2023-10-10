CREATE DATABASE `e-charge`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
CREATE TABLE `station_information` (
  `id` INT AUTO_INCREMENT,
  `charger_number` INT NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `station_name` VARCHAR(100) NOT NULL UNIQUE,
  `open_time` TIME NOT NULL,
  `close_time` TIME NOT NULL,
  PRIMARY KEY (`id`)
);
-- Add phone_number column
ALTER TABLE `user`
ADD COLUMN `phone_number` VARCHAR(20) NOT NULL UNIQUE;

-- Add car_plate column
ALTER TABLE `user`
ADD COLUMN `car_plate` VARCHAR(20) NOT NULL UNIQUE;

CREATE TABLE `car` (
  `car_plate_number` VARCHAR(20) PRIMARY KEY,
  `charging_type` VARCHAR(50)
);

