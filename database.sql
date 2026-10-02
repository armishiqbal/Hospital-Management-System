-- Hospital Management System Database Schema
-- Developed for PHP & MySQL (XAMPP / WAMP)
-- Author: Armish Iqbal

CREATE DATABASE IF NOT EXISTS `hospital_management_system`;
USE `hospital_management_system`;

-- 1. Department Table
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` INT AUTO_INCREMENT PRIMARY KEY,
  `dept_name` VARCHAR(100) NOT NULL,
  `building` VARCHAR(100) DEFAULT NULL,
  `head_of_dept` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `department` (`dept_id`, `dept_name`, `building`, `head_of_dept`) VALUES
(1, 'Pathology', '1st Floor', 'Dr. Ayesha Malik'),
(2, 'Radiology', '2nd Floor', 'Dr. Imran Raza'),
(3, 'Cardiology', '3rd Floor', 'Dr. Sarah Khan'),
(4, 'Neurology', '4th Floor', 'Dr. Kamran Shah')
ON DUPLICATE KEY UPDATE `dept_name`=VALUES(`dept_name`);

-- 2. Patient Table
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `age` INT NOT NULL,
  `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
  `contact` VARCHAR(25) NOT NULL,
  `address` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Doctor Table
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `specialization` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Appointment Table
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_name` VARCHAR(100) NOT NULL,
  `doctor_name` VARCHAR(100) NOT NULL,
  `appointment_date` DATE NOT NULL,
  `appointment_time` TIME NOT NULL,
  `reason` TEXT DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT 'Scheduled',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Staff Table
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `role` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Room Table
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` INT AUTO_INCREMENT PRIMARY KEY,
  `room_number` VARCHAR(20) NOT NULL UNIQUE,
  `room_type` VARCHAR(50) NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'Available',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Prescription Table
CREATE TABLE IF NOT EXISTS `prescription` (
  `prescription_id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_id` INT NOT NULL,
  `doctor_name` VARCHAR(100) NOT NULL,
  `medication` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Lab Report Table
CREATE TABLE IF NOT EXISTS `lab_report` (
  `report_id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_id` INT NOT NULL,
  `test_name` VARCHAR(100) NOT NULL,
  `report_result` TEXT NOT NULL,
  `report_date` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Medical Record Table
CREATE TABLE IF NOT EXISTS `medical_record` (
  `record_id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_id` INT NOT NULL,
  `diagnosis` TEXT NOT NULL,
  `treatment` TEXT NOT NULL,
  `record_date` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Surgery Table
CREATE TABLE IF NOT EXISTS `surgery` (
  `surgery_id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_id` INT NOT NULL,
  `surgery_type` VARCHAR(100) NOT NULL,
  `surgeon_name` VARCHAR(100) NOT NULL,
  `surgery_date` DATE NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
