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
  `comment` varchar(50) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SID` (`stud_id`),
  CONSTRAINT `FK_SID` FOREIGN KEY (`stud_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table magzinedb.articles: ~22 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `category`, `file`, `uploaddate`, `status`, `comment`, `stud_id`) VALUES
	(1, 'jack art 1', 'Technical', '1st_page_0322023141947.pdf', '2023-03-02 19:44:52', 'Rejected', 'Article Rejected! ', '20CE012'),
	(2, 'jack art 2', 'Non-Technical', '1st_page_0322023142005.pdf', '2023-03-02 18:50:05', 'pending', '', '20CE012'),
	(3, 'Abhang art1', 'Technical', 'Pages_0322023142318.pdf', '2023-03-02 18:53:18', 'pending', '', '20IF001'),
	(4, 'abhang art 2', 'Non-Technical', 'Pages_0322023142334.pdf', '2023-03-02 18:53:34', 'pending', '', '20IF001'),
	(5, 'aradhana art 1', 'Technical', '6th_sem_course_reg_0322023142457.pdf', '2023-03-02 18:54:57', 'pending', '', '20IF019'),
	(6, 'aradhana art 2', 'Non-Technical', '6th_sem_course_reg._fees_0322023142520.pdf', '2023-03-02 18:55:20', 'pending', '', '20IF019'),
	(7, 'mohan art 1', 'Technical', 'post_edit_correction_0322023142546.pdf', '2023-03-02 18:55:46', 'pending', '', '19IF001'),
	(8, 'mohan art 2', 'Non-Technical', '6th_sem_course_reg_0322023142600.pdf', '2023-03-02 18:56:00', 'pending', '', '19IF001'),
	(13, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165837.pdf', '2023-03-02 21:28:37', 'pending', '', '20ME005'),
	(14, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165842.pdf', '2023-03-02 21:28:42', 'pending', '', '20ME005'),
	(15, 'ATHARAV ART 1', 'Technical', 'post_edit_correction_0322023165853.pdf', '2023-03-03 12:08:21', 'Rejected', 'Article Rejected! ', '20ME005'),
	(16, 'art 3', 'Technical', '6th_sem_course_reg_0322023165949.pdf', '2023-03-02 21:29:49', 'pending', '', '20IF019'),
	(17, 'art 3', 'Technical', '6th_sem_course_reg_0322023165953.pdf', '2023-03-02 21:29:53', 'pending', '', '20IF019'),
	(18, 'art 3', 'Technical', '6th_sem_course_reg_0322023170141.pdf', '2023-03-02 21:31:41', 'pending', '', '20IF019'),
	(19, 'jacks art 555', 'Non-Technical', '6th_sem_course_reg_0322023170207.pdf', '2023-03-02 21:32:07', 'pending', '', '20CE012'),
	(20, 'jacks art 555', 'Non-Technical', '6th_sem_course_reg_0322023170214.pdf', '2023-03-02 21:32:14', 'pending', '', '20CE012'),
	(21, 'jacks art 555', 'Non-Technical', '6th_sem_course_reg_0322023170242.pdf', '2023-03-02 21:32:42', 'pending', '', '20CE012'),
	(22, 'Mohan article', 'Technical', '6th_sem_course_reg_0322023170343.pdf', '2023-03-02 21:33:43', 'pending', '', '19IF001'),
	(23, 'Mohan article', 'Technical', '6th_sem_course_reg_0322023170402.pdf', '2023-03-02 21:34:02', 'pending', '', '19IF001'),
	(24, 'Mohan article', 'Technical', '6th_sem_course_reg_0322023170454.pdf', '2023-03-02 21:34:56', 'pending', '', '19IF001'),
	(25, 'art mohan', 'Non-Technical', '6th_sem_course_reg_0322023170519.pdf', '2023-03-02 21:35:19', 'pending', '', '19IF001'),
	(26, 'art mohan', 'Non-Technical', '6th_sem_course_reg_0322023170527.pdf', '2023-03-02 21:35:27', 'pending', '', '19IF001');
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
  `id` varchar(10) NOT NULL,
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

-- Dumping data for table magzinedb.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `deptno`, `role`, `email`, `password`, `mob`) VALUES
	('001', 'ADMIN', 'ADMIN', 'ADMIN', NULL, 'ADMIN', 'admin123@gmail.com', 'admin@123', 7894561230),
	('19IF001', 'MOHAN', 'SUNIL', 'GAWANDE', 6, 'COORDINATOR', 'mohan12@gmail.com', 'mohan@123', 7894561230),
	('20CE012', 'JACK', 'JAMES', 'SMITH', 1, 'STUDENT', 'jack123@gmail.com', 'jack@123', 8380969121),
	('20CM001', 'RAM', 'SHAM', 'RAUT', 5, 'STUDENT', 'ram123@gmail.com', 'ram@123', 7788994455),
	('20IF001', 'ABHANG', 'KISHOR', 'PATURKAR', 6, 'STUDENT', 'abhang123@gmail.com', 'abhang@123', 7894561230),
	('20IF019', 'ARADHANA', 'SHRIKRUSHNA', 'HINGANE', 6, 'STUDENT', 'aradhana123@gmail.com', 'aradhana@1', 7894561230),
	('20ME005', 'ATHARAV', 'SURESH', 'MANKAR', 2, 'COORDINATOR', 'atharav123@gmail.com', 'atharav@12', 7894561230);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
