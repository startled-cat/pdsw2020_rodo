<?PHP

$sql = "-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 05:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
START TRANSACTION;
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rodo`
--
drop database if exists `rodo2`;
CREATE DATABASE IF NOT EXISTS `rodo2` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `rodo2`;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Truncate table before insert `bugs`
--

TRUNCATE TABLE `bugs`;
-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL COMMENT 'to whom',
  `teacher_id` int(11) NOT NULL COMMENT 'by whom',
  `value` decimal(10,0) NOT NULL COMMENT 'actual grade value',
  `task` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'for what is this grade',
  `comment` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp() COMMENT 'date when grade was added',
  `expire_date` date DEFAULT NULL COMMENT 'date after which grade should be deleted',
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Truncate table before insert `grades`
--

TRUNCATE TABLE `grades`;
--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `teacher_id`, `value`, `task`, `comment`, `date`, `expire_date`, `seen`) VALUES
(1, 1, 1, '4', 'zaliczenie zad -1', NULL, '2020-05-27', '2020-08-13', 0),
(3, 1, 1, '3', 'zaliczenie zad -2', NULL, '2020-05-20', '2020-08-13', 0),
(4, 1, 2, '5', 'praca domowa 2', NULL, '2020-05-18', '2020-08-14', 0),
(5, 2, 1, '4', 'egzamin - pierwszy termin', NULL, '2020-05-22', '2020-07-21', 1),
(6, 2, 2, '3', 'kolokwium 1', NULL, '2020-05-19', '2020-07-11', 0),
(7, 2, 1, '5', 'egzamin - psi', NULL, '2020-05-26', '2020-07-21', 1),
(8, 2, 2, '3', 'kolokwium 3', NULL, '2020-05-25', '2020-07-11', 1),
(50, 3, 1, '4', 'Systemy Operacyjne 2 kolokwium 1\r', 'ok\r', '2020-06-01', '0000-00-00', 0),
(51, 4, 1, '5', 'Systemy Operacyjne 2 kolokwium 1\r', 'ok\r', '2020-06-01', '0000-00-00', 0),
(52, 5, 1, '5', 'Systemy Operacyjne 2 kolokwium 1\r', 'ok\r', '2020-06-01', '0000-00-00', 0),
(53, 7, 1, '5', 'Systemy Operacyjne 2 kolokwium 1\r', 'ok\r', '2020-06-01', '0000-00-00', 0),
(54, 6, 1, '4', 'Systemy Operacyjne 2 kolokwium 1\r', '(-) wszystko gra', '2020-06-01', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL COMMENT 'student''s account id',
  `number` varchar(8) COLLATE utf8_polish_ci NOT NULL COMMENT 'student''s index number',
  `password` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'student''s account password',
  `expire_date` date DEFAULT NULL COMMENT 'student''s account expire date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Truncate table before insert `students`
--

TRUNCATE TABLE `students`;
--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `number`, `password`, `expire_date`) VALUES
(1, '222333', '731982a033a5cc815ac03c8504abb748', '2020-10-31'),
(2, '222444', 'ec1e7077d02cb3dbd61ab73018c4a319', NULL),
(3, '215730', '5cf8a0bbd2474282cec5659bd1bd984b', NULL),
(4, '215911', 'd65c63693338bc9fcb684a23eb0d9dcd', NULL),
(5, '215887', '919428f5e4671dcc62d516b582299f48', NULL),
(6, '215997', 'f8db673d73ce453d86e2c281934576aa', NULL),
(7, '215774', '62540281ca326288cac096fc65d6f815', NULL),
(74, '123456', 'e10adc3949ba59abbe56e057f20f883e', '2020-01-01'),
(75, '123457', 'f1887d3f9e6ee7a32fe5e76f4ab80d63', '2020-01-01'),
(76, '123458', '93897cc117a734be93733779051c9926', '2020-01-01'),
(77, '123459', '51f6f8fe03a390d3de50ad49913d4b66', '2020-09-01'),
(78, '123460', '2a4580ee18f163a2458a87bba7d9d743', '2020-09-01'),
(79, '123461', '3ad3eb6695d1443bdd674db109b5866f', '2020-09-01'),
(80, '123462', '85668a5d527f9c145b940c26310f7270', '2020-09-01'),
(81, '123463', '23e46c0a54fc138466ba9687429c6216', '2020-09-01'),
(82, '123464', '821718d0413f23eeb626ddb895bddb51', '2020-09-01'),
(83, '123465', '3d9188577cc9bfe9291ac66b5cc872b7', '2020-09-01'),
(85, '123467', '0052069db1a0017f6a27f27e6dcbb919', '2020-09-01'),
(86, '123468', '5796c320fc57746358429ef5bb5dc4f3', '2020-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `display_name` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'name and surname displayed to students'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Truncate table before insert `teachers`
--

TRUNCATE TABLE `teachers`;
--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `login`, `password`, `display_name`) VALUES
(1, 'adamko1', '509497fec7f7a18815f65916d10db0f0', 'dr. inż. Adam Kowalczyk'),
(2, 'adamko2', '8b08f83454d0e0e43a56c52303ad9366', 'prof. Jan Kowalski');



-- Indexes for dumped tables
--

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade-teacher` (`teacher_id`),
  ADD KEY `grade-student` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'student''s account id', AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grade-student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grade-teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;


DROP table IF EXISTS `v_students_grades`;
DROP view IF EXISTS `v_students_grades`;

CREATE VIEW `v_students_grades` AS SELECT
    `grades`.`id` AS `id`,
    `grades`.`student_id` AS `student_id`,
    `students`.`number` AS `student_number`,
    `teachers`.`id` AS `teacher_id`,
    `teachers`.`display_name` AS `teacher_name`,
    `grades`.`value` AS `value`,
    `grades`.`task` AS `task`,
    `grades`.`comment` AS `comment`,
    `grades`.`date` AS `date`,
    `grades`.`expire_date` AS `expire_date`,
    `grades`.`seen` AS `seen`
FROM
    (
        (`grades`
    JOIN `teachers`)
    JOIN `students`
    )
WHERE
    `grades`.`teacher_id` = `teachers`.`id` AND `grades`.`student_id` = `students`.`id`;

    

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
";

?>