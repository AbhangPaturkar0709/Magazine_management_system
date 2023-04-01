-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for magazinedb
CREATE DATABASE IF NOT EXISTS `magazinedb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `magazinedb`;

-- Dumping structure for table magazinedb.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `uploaddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `stud_id` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SID` (`stud_id`),
  CONSTRAINT `FK_SID` FOREIGN KEY (`stud_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magazinedb.articles: ~1 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table magazinedb.department
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `d_name` varchar(50) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magazinedb.department: ~9 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`id`, `d_name`, `code`) VALUES
	(0, '', NULL),
	(1, 'CIVIL ENGINEERING', 'CE'),
	(2, 'MECHANICAL ENGINEERING', 'ME'),
	(3, 'ELECTRICAL ENGINEERING', 'EE'),
	(4, 'ELECTRONICS AND TELECOMMUNICATION ENGINEERING', 'EC'),
	(5, 'COMPUTER ENGINEERING', 'CM'),
	(6, 'INFORMATION TECHNOLOGY', 'IF'),
	(7, 'CHEMICAL ENGINEERING', 'CH'),
	(8, 'PLASTIC AND POLYMER ENGINEERING', 'PP');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table magazinedb.magazines
CREATE TABLE IF NOT EXISTS `magazines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `coverpage` varchar(255) DEFAULT NULL,
  `uploadyear` year(4) DEFAULT NULL,
  `uploadby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKUPLOADBY` (`uploadby`),
  CONSTRAINT `FKUPLOADBY` FOREIGN KEY (`uploadby`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magazinedb.magazines: ~0 rows (approximately)
/*!40000 ALTER TABLE `magazines` DISABLE KEYS */;
/*!40000 ALTER TABLE `magazines` ENABLE KEYS */;

-- Dumping structure for table magazinedb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(7) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `deptno` int(11) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '',
  `mob` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FKDEPTNO` (`deptno`),
  CONSTRAINT `FKDEPTNO` FOREIGN KEY (`deptno`) REFERENCES `department` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magazinedb.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `deptno`, `year`, `role`, `email`, `password`, `mob`) VALUES
	('001', 'ADMIN', 'ADMIN', 'ADMIN', 0, NULL, 'ADMIN', 'admin123@gmail.com', 'admin@123', 7894561230);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
