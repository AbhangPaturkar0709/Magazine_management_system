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


-- Dumping database structure for magzinedb
CREATE DATABASE IF NOT EXISTS `magzinedb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `magzinedb`;

-- Dumping structure for table magzinedb.articles
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
  CONSTRAINT `FK_SID` FOREIGN KEY (`stud_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magzinedb.articles: ~17 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `category`, `file`, `uploaddate`, `status`, `comment`, `stud_id`) VALUES
	(1, 'JACK ART 1', 'Technical', 'Pages_0362023191354.pdf', '2023-03-06 23:43:54', 'pending', '', '20CE012'),
	(2, 'jack art 2', 'Non-Technical', '1st_page_0322023142005.pdf', '2023-03-06 13:01:17', 'Apporved', 'Article Approved! ', '20CE012'),
	(13, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165837.pdf', '2023-03-06 13:43:11', 'Apporved', 'Article Approved! ', '20ME005'),
	(14, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165842.pdf', '2023-03-06 13:49:45', 'Apporved', 'Article Approved! ', '20ME005'),
	(15, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165853.pdf', '2023-03-03 12:08:21', 'Rejected', 'Article Rejected! ', '20ME005'),
	(19, 'jacks art 555', 'Technical', 'Pages_0362023183559.pdf', '2023-03-06 23:05:59', 'pending', '', '20CE012'),
	(20, 'jacks art 555', 'Non-Technical', 'Pages_0362023190908.pdf', '2023-03-06 23:39:08', 'pending', '', '20CE012'),
	(21, 'jacks art 555', 'Non-Technical', '6th_sem_course_reg_0322023170242.pdf', '2023-03-02 21:32:42', 'pending', '', '20CE012'),
	(27, 'qwert art', 'Non-Technical', '1st_page_0342023231513.pdf', '2023-03-05 03:45:13', 'pending', '', '20CM001'),
	(28, 'qwert art', 'Non-Technical', '1st_page_0342023231722.pdf', '2023-03-05 03:47:22', 'pending', '', '20CM001'),
	(29, 'ABCDEF', 'TECHNICAL', 'ABC', '2023-03-06 14:42:43', 'pending', 'Modify Article. ', '19IF001'),
	(30, 'ABCDEF', 'TECHNICAL', 'ABC', '2023-03-06 23:53:33', 'Modify', 'Modify Article. You Want To Make Changes On Page No 6', '19IF001'),
	(31, 'ABC123', 'Non-Technical', 'Pages_0362023190438.pdf', '2023-03-06 23:35:05', 'Apporved', 'Article Approved! ', '19IF001'),
	(32, 'aradhana art 1', 'Technical', 'Miss._Gauri_Anantrao_Gawande_Script_0362023191515.', '2023-03-06 23:45:15', 'pending', '', '20IF019'),
	(33, 'aradhana art 2', 'Non-Technical', 'Miss._Gauri_Anantrao_Gawande_PPT_0362023191531.pdf', '2023-03-06 23:50:09', 'Modify', 'Modify Article. You Want To Make Changes On Page No 6', '20IF019'),
	(34, 'sample', 'Technical', 'Miss._Gauri_Anantrao_Gawande_Script_0362023191806.', '2023-03-06 23:48:06', 'pending', '', '20IF019'),
	(35, 'mohan 5', 'Technical', 'Miss._Gauri_Anantrao_Gawande_Script_0362023191925.', '2023-03-06 23:49:25', 'pending', '', '19IF001');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table magzinedb.department
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `d_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magzinedb.department: ~8 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`id`, `d_name`) VALUES
	(1, 'CIVIL ENGINEERING'),
	(2, 'MECHANICAL ENGINEERING'),
	(3, 'ELECTRICAL ENGINEERING'),
	(4, 'ELECTRONICS AND TELECOMMUNICATION ENGINEERING'),
	(5, 'COMPUTER ENGINEERING'),
	(6, 'INFORMATION TECHNOLOGY'),
	(7, 'CHEMICAL ENGINEERING'),
	(8, 'PLASTIC AND POLYMER ENGINEERING');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table magzinedb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(7) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `deptno` int(11) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL DEFAULT '',
  `mob` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FKDEPTNO` (`deptno`),
  CONSTRAINT `FKDEPTNO` FOREIGN KEY (`deptno`) REFERENCES `department` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magzinedb.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `deptno`, `role`, `email`, `password`, `mob`) VALUES
	('', '', '', '', NULL, '', '', 'Abc@1234', 0),
	('001', 'ADMIN', 'ADMIN', 'ADMIN', NULL, 'ADMIN', 'admin123@gmail.com', 'admin@123', 7894561230),
	('002', 'UJWAL', 'PRAMOD', 'NIMBOKAR', 6, 'STAFF', 'ujwal111@gmail.com', 'ujwal@111', 7894561233),
	('19IF001', 'MOHAN', 'SUNIL', 'GAWANDE', 6, 'COORDINATOR', 'mohan12@gmail.com', 'mohan@123', 7894561230),
	('20CE005', 'ABHANG', 'KISHOR', 'PATURKAR', 1, 'STUDENT', 'abhangpaturkar0709@gmail.com', '789', 9158787125),
	('20CE012', 'JACK', 'JAMES', 'SMITH', 1, 'STUDENT', 'jack123@gmail.com', 'jack@123', 8380969121),
	('20CM001', 'RAM', 'SHAM', 'RAUT', 5, 'STUDENT', 'ram123@gmail.com', 'ram@123', 7788994455),
	('20CM014', 'PRATIK', 'VINAYAKRAO', 'GHURDE', 5, 'STUDENT', 'pratikghurde123@gmail.com', 'Pratik@1', 9730161120),
	('20CM051', 'ABHANG', 'KISHOR', 'PATURKAR', 5, 'STUDENT', 'abhangpaturkar0709@gmail.com', 'ABHYA@123', 8308969121),
	('20IF001', 'ABHANG', 'KISHOR', 'PATURKAR', 6, 'STUDENT', 'abhang123@gmail.com', 'abhang@123', 7894561230),
	('20IF019', 'ARADHANA', 'SHRIKRUSHNA', 'HINGANE', 6, 'STUDENT', 'aradhana123@gmail.com', 'aradhana@1', 7894561230),
	('20ME001', 'Abhang', 'Kishor', 'Paturkar', 2, 'STUDENT', 'abhangpaturkar0709@gmail.com', '789', 9158787125),
	('20ME005', 'ATHARAV', 'SURESH', 'MANKAR', 2, 'COORDINATOR', 'atharav123@gmail.com', 'atharav@12', 7894561230);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
