-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2020 at 07:35 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roger_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bug_report`
--

DROP TABLE IF EXISTS `bug_report`;
CREATE TABLE IF NOT EXISTS `bug_report` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` int(11) NOT NULL,
  `triager_id` int(11) DEFAULT NULL,
  `developer_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `version_no` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `priority` int(11) NOT NULL,
  `ts_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `ts_closed` datetime DEFAULT NULL,
  `ts_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`bug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bug_report`
--

INSERT INTO `bug_report` (`bug_id`, `reporter_id`, `triager_id`, `developer_id`, `reviewer_id`, `title`, `description`, `keyword`, `version_no`, `status`, `priority`, `ts_created`, `ts_closed`, `ts_modified`) VALUES
(1, 1, 11, 21, NULL, 'c++', 'sdf', 'sdf', '123', 'reviewed', 1, NULL, NULL, NULL),
(2, 1, 11, 21, NULL, 'd', 'dsf', 'sdf', '123', 'open', 1, '2020-10-14 22:34:00', NULL, NULL),
(3, 1, NULL, NULL, NULL, 'no dev', 'no dev', 'sdf', '123', 'open', 2, '2020-10-16 03:03:57', NULL, NULL),
(4, 1, NULL, NULL, NULL, 'tester', 'easdf', 'sdf', '123', 'open', 2, '2020-10-16 14:13:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bug_report_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `ts_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `bug_report_id`, `comment`, `ts_created`) VALUES
(1, 1, 2, 'sdf', '2020-10-14 23:08:54'),
(2, 1, 2, 'test', '2020-10-14 23:09:13'),
(3, 21, 1, 'dsf', '2020-10-16 03:07:45'),
(4, 1, 4, 'comments', '2020-10-16 14:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `full_name`, `user_type`) VALUES
(1, '1@roger.com', '1@rogerpassword', 'Robert Harris', 'Reporter'),
(2, '2@roger.com', '2@rogerpassword', 'Robert Brown', 'Reporter'),
(3, '3@roger.com', '3@rogerpassword', 'Robert Smith', 'Reporter'),
(4, '4@roger.com', '4@rogerpassword', 'Robert Johnson', 'Reporter'),
(5, '5@roger.com', '5@rogerpassword', 'Robert Jones', 'Reporter'),
(6, '6@roger.com', '6@rogerpassword', 'Robert Garcia', 'Reporter'),
(7, '7@roger.com', '7@rogerpassword', 'Robert Davis', 'Reporter'),
(8, '8@roger.com', '8@rogerpassword', 'Andy Harris', 'Reporter'),
(9, '9@roger.com', '9@rogerpassword', 'Andy Brown', 'Reporter'),
(10, '10@roger.com', '10@rogerpassword', 'Andy Smith', 'Reporter'),
(11, '11@roger.com', '11@rogerpassword', 'Andy Johnson', 'Triager'),
(12, '12@roger.com', '12@rogerpassword', 'Andy Jones', 'Triager'),
(13, '13@roger.com', '13@rogerpassword', 'Andy Garcia', 'Triager'),
(14, '14@roger.com', '14@rogerpassword', 'Andy Davis', 'Triager'),
(15, '15@roger.com', '15@rogerpassword', 'Matthew Harris', 'Triager'),
(16, '16@roger.com', '16@rogerpassword', 'Matthew Brown', 'Triager'),
(17, '17@roger.com', '17@rogerpassword', 'Matthew Smith', 'Triager'),
(18, '18@roger.com', '18@rogerpassword', 'Matthew Johnson', 'Triager'),
(19, '19@roger.com', '19@rogerpassword', 'Matthew Jones', 'Triager'),
(20, '20@roger.com', '20@rogerpassword', 'Matthew Garcia', 'Triager'),
(21, '21@roger.com', '21@rogerpassword', 'Matthew Davis', 'Developer'),
(22, '22@roger.com', '22@rogerpassword', 'Greg Harris', 'Developer'),
(23, '23@roger.com', '23@rogerpassword', 'Greg Brown', 'Developer'),
(24, '24@roger.com', '24@rogerpassword', 'Greg Smith', 'Developer'),
(25, '25@roger.com', '25@rogerpassword', 'Greg Johnson', 'Developer'),
(26, '26@roger.com', '26@rogerpassword', 'Greg Jones', 'Developer'),
(27, '27@roger.com', '27@rogerpassword', 'Greg Garcia', 'Developer'),
(28, '28@roger.com', '28@rogerpassword', 'Greg Davis', 'Developer'),
(29, '29@roger.com', '29@rogerpassword', 'Budi Harris', 'Developer'),
(30, '30@roger.com', '30@rogerpassword', 'Budi Brown', 'Developer'),
(31, '31@roger.com', '31@rogerpassword', 'Budi Smith', 'Reviewer'),
(32, '32@roger.com', '32@rogerpassword', 'Budi Johnson', 'Reviewer'),
(33, '33@roger.com', '33@rogerpassword', 'Budi Jones', 'Reviewer'),
(34, '34@roger.com', '34@rogerpassword', 'Budi Garcia', 'Reviewer'),
(35, '35@roger.com', '35@rogerpassword', 'Budi Davis', 'Reviewer'),
(36, '36@roger.com', '36@rogerpassword', 'Joe Harris', 'Reviewer'),
(37, '37@roger.com', '37@rogerpassword', 'Joe Brown', 'Reviewer'),
(38, '38@roger.com', '38@rogerpassword', 'Joe Smith', 'Reviewer'),
(39, '39@roger.com', '39@rogerpassword', 'Joe Johnson', 'Reviewer'),
(40, '40@roger.com', '40@rogerpassword', 'Joe Jones', 'Reviewer'),
(41, '41@roger.com', '41@rogerpassword', 'Joe Garcia', 'Reporter'),
(42, '42@roger.com', '42@rogerpassword', 'Joe Davis', 'Reporter'),
(43, '43@roger.com', '43@rogerpassword', 'Charles Harris', 'Triager'),
(44, '44@roger.com', '44@rogerpassword', 'Charles Brown', 'Triager'),
(45, '45@roger.com', '45@rogerpassword', 'Charles Smith', 'Developer'),
(46, '46@roger.com', '46@rogerpassword', 'Charles Johnson', 'Developer'),
(47, '47@roger.com', '47@rogerpassword', 'Charles Jones', 'Reviewer'),
(48, '48@roger.com', '48@rogerpassword', 'Charles Garcia', 'Reporter'),
(49, '49@roger.com', '49@rogerpassword', 'Charles Davis', 'Reporter'),
(50, '50@roger.com', '50@rogerpassword', 'Kim Harris', 'Reporter');

-- --------------------------------------------------------

--
-- Table structure for table `user_developer`
--

DROP TABLE IF EXISTS `user_developer`;
CREATE TABLE IF NOT EXISTS `user_developer` (
  `developer_id` int(11) NOT NULL,
  `bug_report_fixed` int(11) NOT NULL,
  `expertise` varchar(100) NOT NULL,
  PRIMARY KEY (`developer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_developer`
--

INSERT INTO `user_developer` (`developer_id`, `bug_report_fixed`, `expertise`) VALUES
(21, 0, 'C++'),
(22, 0, 'Java'),
(23, 0, 'Python'),
(24, 0, 'C'),
(25, 0, 'R'),
(26, 0, 'C++'),
(27, 0, 'Java'),
(28, 0, 'Python'),
(29, 0, 'C'),
(30, 0, 'R'),
(45, 0, 'Python'),
(46, 0, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `user_reporter`
--

DROP TABLE IF EXISTS `user_reporter`;
CREATE TABLE IF NOT EXISTS `user_reporter` (
  `reporter_id` int(11) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `bugs_reported` int(11) NOT NULL,
  PRIMARY KEY (`reporter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reviewer`
--

DROP TABLE IF EXISTS `user_reviewer`;
CREATE TABLE IF NOT EXISTS `user_reviewer` (
  `reviewer_id` int(11) NOT NULL,
  `bug_report_resolved` int(11) NOT NULL,
  PRIMARY KEY (`reviewer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_reviewer`
--

INSERT INTO `user_reviewer` (`reviewer_id`, `bug_report_resolved`) VALUES
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(38, 0),
(39, 0),
(40, 0),
(47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_triager`
--

DROP TABLE IF EXISTS `user_triager`;
CREATE TABLE IF NOT EXISTS `user_triager` (
  `triager_id` int(11) NOT NULL,
  `bug_report_closed` int(11) NOT NULL,
  PRIMARY KEY (`triager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_triager`
--

INSERT INTO `user_triager` (`triager_id`, `bug_report_closed`) VALUES
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(20, 0),
(43, 0),
(44, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_developer`
--
ALTER TABLE `user_developer`
  ADD CONSTRAINT `developer_id constraint` FOREIGN KEY (`developer_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_reporter`
--
ALTER TABLE `user_reporter`
  ADD CONSTRAINT `reporter_id constraint` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_reviewer`
--
ALTER TABLE `user_reviewer`
  ADD CONSTRAINT `reviewer_id constraint` FOREIGN KEY (`reviewer_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_triager`
--
ALTER TABLE `user_triager`
  ADD CONSTRAINT `triager_id constraint` FOREIGN KEY (`triager_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
