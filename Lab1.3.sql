-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lab1.3
CREATE DATABASE IF NOT EXISTS `lab1.3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lab1.3`;

-- Dumping structure for table lab1.3.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table lab1.3.user: ~0 rows (approximately)
INSERT INTO `user` (`id`, `email`, `firstname`, `lastname`, `status`, `created_at`, `password`) VALUES
	(1, 'user1@example.com', 'John', 'Doe', 1, '2024-01-05 13:37:01', 'password123'),
	(2, 'user2@example.com', 'Alice', 'Smith', 1, '2024-01-05 13:37:01', 'securepass'),
	(3, 'user3@example.com', 'Bob', 'Johnson', 1, '2024-01-05 13:37:01', 'pass123'),
	(4, 'user4@example.com', 'Eva', 'White', 1, '2024-01-05 13:37:01', 'password456'),
	(5, 'user5@example.com', 'Charlie', 'Brown', 1, '2024-01-05 13:37:01', 'strongpass'),
	(6, 'user6@example.com', 'Grace', 'Davis', 1, '2024-01-05 13:37:01', 'letmein'),
	(7, 'user7@example.com', 'Oliver', 'Taylor', 1, '2024-01-05 13:37:01', 'pass567'),
	(8, 'user8@example.com', 'Sophie', 'Miller', 1, '2024-01-05 13:37:01', 'mypassword'),
	(9, 'user9@example.com', 'Daniel', 'Wilson', 1, '2024-01-05 13:37:01', 'securepass123'),
	(10, 'user10@example.com', 'Emily', 'Jones', 1, '2024-01-05 13:37:01', 'newpass');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
