-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 05:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rodo`
--
drop database if exists `rodo`;
CREATE DATABASE IF NOT EXISTS `rodo` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `rodo`;

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
(1, '222333', '123123', '2020-10-31'),
(2, '222444', 'ec1e7077d02cb3dbd61ab73018c4a319', NULL),
(3, '215730', '215730', NULL),
(4, '215911', '215911', NULL),
(5, '215887', '215887', NULL),
(6, '215997', '215997', NULL),
(7, '215774', '215774', NULL),
(74, '123456', 'KEQClZByLD', '2020-09-01'),
(75, '123457', 'PdOxm7zXp5', '2020-09-01'),
(76, '123458', 'YJrz5Xl7Uf', '2020-09-01'),
(77, '123459', 'I0dTIjtJu9', '2020-09-01'),
(78, '123460', 'RZkBZ48ZOe', '2020-09-01'),
(79, '123461', 'IdrtJknQeh', '2020-09-01'),
(80, '123462', 'PVkstvZVgt', '2020-09-01'),
(81, '123463', 'oJRmhKqU00', '2020-09-01'),
(82, '123464', 'czxfalcGEa', '2020-09-01'),
(83, '123465', 'L3H9onhEaD', '2020-09-01'),
(85, '123467', 'qKWLjs9eyB', '2020-09-01'),
(86, '123468', 'bGKcKxCLoG', '2020-09-01');

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
(1, 'adamko1', 'adamko1', 'dr. inż. Adam Kowalczyk'),
(2, 'adamko2', 'adamko2', 'prof. Jan Kowalski');



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
