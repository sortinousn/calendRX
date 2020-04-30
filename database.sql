-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.20 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for wyndata
CREATE DATABASE IF NOT EXISTS `wyndata` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wyndata`;

-- Dumping structure for table wyndata.medications
CREATE TABLE IF NOT EXISTS `medications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `dose` int DEFAULT NULL,
  `refill_date` datetime DEFAULT NULL,
  `frequency` varchar(45) DEFAULT NULL,
  `dose_count` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wyndata.medications: ~3 rows (approximately)
/*!40000 ALTER TABLE `medications` DISABLE KEYS */;
INSERT INTO `medications` (`id`, `user_id`, `name`, `quantity`, `dose`, `refill_date`, `frequency`, `dose_count`) VALUES
	(30, 1, 'Losartan', 30, 20, '2020-08-19 00:00:00', 'daily', 1),
	(31, 1, 'Azithromycin ', 30, 15, '2020-06-09 00:00:00', 'daily', 1),
	(32, 1, 'Amoxicillin', 30, 20, '2020-07-11 00:00:00', 'monthly', 2);
/*!40000 ALTER TABLE `medications` ENABLE KEYS */;

-- Dumping structure for table wyndata.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(245) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wyndata.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `phone`, `firstname`, `lastname`) VALUES
	(1, 'admin@admin.com', '$2y$10$hZKZtOZuM6y2dNQEh1nrz.yWHsnd1VnlPz12Ja36v0hE0NcQYmEZW', '123-456-7890', 'Joseph', 'Sortino');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
