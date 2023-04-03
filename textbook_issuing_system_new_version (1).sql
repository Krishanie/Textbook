-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 05:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textbook_issuing_system_new_version`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_grades`
--

CREATE TABLE `available_grades` (
  `id` int(11) NOT NULL,
  `grade` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_grades`
--

INSERT INTO `available_grades` (`id`, `grade`, `value`) VALUES
(1, 'Grade 1', 'grd1'),
(2, 'Grade 2', 'grd2'),
(3, 'Grade 3', 'grd3'),
(4, 'Grade 4', 'grd4'),
(5, 'Grade 5', 'grd5'),
(6, 'Grade 6', 'grd6'),
(7, 'Grade 7', 'grd7'),
(8, 'Grade 8', 'grd8'),
(9, 'Grade 9', 'grd9');

-- --------------------------------------------------------

--
-- Table structure for table `book_site_data`
--

CREATE TABLE `book_site_data` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `title` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_site_data`
--

INSERT INTO `book_site_data` (`id`, `name`, `title`, `logo`) VALUES
(1, 'Text Book Issuing System', 'Defence Services College', 'site_logo-63ce34f1266b41.18466967.png');

-- --------------------------------------------------------

--
-- Table structure for table `book_stock`
--

CREATE TABLE `book_stock` (
  `book_id` int(11) NOT NULL,
  `book_serial_id` text NOT NULL,
  `book_name` text NOT NULL,
  `book_language` text NOT NULL,
  `book_grade` text NOT NULL,
  `studing_students` text NOT NULL,
  `leftover_books` text NOT NULL,
  `extra_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_stock`
--

INSERT INTO `book_stock` (`book_id`, `book_serial_id`, `book_name`, `book_language`, `book_grade`, `studing_students`, `leftover_books`, `extra_requests`, `total_books`) VALUES
(1, '342', 'Maths', 's', 'grd1', '24', '2', '5', '36'),
(4, '334', 'Sinhala', 's', 'grd2', '34', '5', '2', '45'),
(5, '345', 'sdg', 's', 'grd1', '234', '235', '234', '234'),
(6, '234', 'rtgjhrtrfhh weryrwehrhy', 's', 'grd1', '456', '46', '454', '5');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` text NOT NULL,
  `reciver_id` text NOT NULL,
  `msg` text NOT NULL,
  `type` text NOT NULL,
  `msg_date_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `reciver_id`, `msg`, `type`, `msg_date_time`) VALUES
(321, 'system', '', 'Sir, Grade 1 Maths Only 2 books left.', 'all', '2023-03-20 08:59 pm'),
(322, 'system', '', 'Sir, Grade 9 PTS Only 4 books left.', 'all', '2023-03-20 08:59 pm'),
(323, '1', '', 'hi', 'all', '2023-03-20 08:59 pm'),
(324, '1', '', 'd', 'all', '2023-03-20 09:00 pm'),
(325, '1', '', 'sad', 'all', '2023-03-20 09:00 pm'),
(326, '1', '', 'ss', 'all', '2023-03-20 09:01 pm'),
(327, '4', '', 'ss', 'all', '2023-03-20 09:01 pm'),
(328, '4', '', 'ss', 'all', '2023-03-20 09:01 pm'),
(329, '1', '', 'sss', 'all', '2023-03-20 09:02 pm'),
(330, 'system', '', 'Sir, Grade 1 Maths Only 1 books left.', 'all', '2023-03-29 08:12 pm'),
(331, 'system', '', 'Sir, Grade 1 Maths Only -1 books left.', 'all', '2023-03-29 08:14 pm'),
(332, 'system', '', 'Sir, Grade 1 Maths Only -2 books left.', 'all', '2023-03-29 08:17 pm'),
(333, 'system', '', 'Sir, Grade 1 Maths Only -3 books left.', 'all', '2023-03-29 08:21 pm'),
(334, 'system', '', 'Sir, Grade 1 Maths Only -5 books left.', 'all', '2023-03-29 08:21 pm'),
(335, 'system', '', 'Sir, Grade 1 Maths Only -6 books left.', 'all', '2023-03-29 08:22 pm'),
(336, 'system', '', 'Sir, Grade 1 Maths Only -7 books left.', 'all', '2023-03-29 08:22 pm'),
(337, 'system', '', 'Sir, Grade 1 Maths Only -8 books left.', 'all', '2023-03-29 08:23 pm'),
(338, 'system', '', 'Sir, Grade 1 Maths Only -10 books left.', 'all', '2023-03-29 08:23 pm'),
(339, 'system', '', 'Sir, Grade 1 Maths Only -11 books left.', 'all', '2023-03-29 08:23 pm'),
(340, 'system', '', 'Sir, Grade 1 Maths Only -12 books left.', 'all', '2023-03-29 08:24 pm'),
(341, 'system', '', 'Sir, Grade 1 Maths Only -13 books left.', 'all', '2023-03-29 08:25 pm'),
(342, 'system', '', 'Sir, Grade 1 Maths Only -14 books left.', 'all', '2023-03-29 08:26 pm'),
(343, 'system', '', 'Sir, Grade 1 Maths Only -15 books left.', 'all', '2023-03-29 08:27 pm'),
(344, 'system', '', 'Sir, Grade 1 Maths Only -17 books left.', 'all', '2023-03-29 08:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `grade_connections`
--

CREATE TABLE `grade_connections` (
  `id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `grade_name` text NOT NULL,
  `take_grade` text NOT NULL,
  `give_grade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_connections`
--

INSERT INTO `grade_connections` (`id`, `grade_id`, `grade_name`, `take_grade`, `give_grade`) VALUES
(1, 1, 'grd1', 'grd1', 'grd2'),
(2, 2, 'grd2', 'grd2', 'grd3'),
(3, 3, 'grd3', 'grd3', 'grd4'),
(4, 4, 'grd4', 'grd4', 'grd5'),
(5, 5, 'grd5', 'grd5', 'grd6'),
(6, 6, 'grd6', 'grd6', 'grd7'),
(7, 7, 'grd7', 'grd7', 'grd8'),
(8, 8, 'grd8', 'grd8', 'grd9'),
(9, 9, 'grd9', 'grd9', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `index_no` text NOT NULL,
  `grade` text NOT NULL,
  `class` text NOT NULL,
  `language` text NOT NULL,
  `added_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `index_no`, `grade`, `class`, `language`, `added_date`) VALUES
(26, 'dsaf', '123', 'grd4', 'F', 's', '2023-02-12'),
(27, 'sas', '123', 'grd1', 'C', 's', '2023-02-19'),
(42, 'name2', '1023', 'grd2', 'A', 's', ''),
(43, 'name3', '1024', 'grd2', 'A', 'e', ''),
(44, 'name4', '1025', 'grd2', 'F', 's', ''),
(46, 'name6', '1027', 'grd2', 'A', 'e', ''),
(47, 'name7', '1028', 'grd2', 'A', 's', ''),
(48, 'name8', '1029', 'grd2', 'D', 's', ''),
(49, 'name9', '1030', 'grd2', 'A', 'e', ''),
(50, 'name10', '1031', 'grd2', 'A', 'e', '');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `img` text NOT NULL,
  `role` text NOT NULL,
  `grade` text NOT NULL,
  `lang` text NOT NULL,
  `added_date` text NOT NULL,
  `last_login` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `username`, `password`, `img`, `role`, `grade`, `lang`, `added_date`, `last_login`) VALUES
(1, 'Vibodha Sasmitha', 'main-admin', '12345', 'main-default.png', 'main-admin', 'all', 'sin', '', '1680252529'),
(4, 'Admin 1', 'admin1', '123', 'default.png', 'admin', 'grd1', 'en', '', '1679326421'),
(5, 'Admin 2', 'admin2', '123', 'default.png', 'admin', 'grd2', 'en', '', '1674794690');

-- --------------------------------------------------------

--
-- Table structure for table `will_give_books`
--

CREATE TABLE `will_give_books` (
  `id` int(11) NOT NULL,
  `book_id` text NOT NULL,
  `stu_id` text NOT NULL,
  `book_grade` text NOT NULL,
  `give` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `will_give_books`
--

INSERT INTO `will_give_books` (`id`, `book_id`, `stu_id`, `book_grade`, `give`) VALUES
(1, '1', '1', 'grd2', '1'),
(2, '2', '1', 'grd2', '1'),
(3, '3', '1', 'grd2', '1'),
(4, '5', '15', 'grd1', '1'),
(5, '5', '11', 'grd1', '1'),
(6, '5', '18', 'grd1', '0'),
(7, '6', '27', 'grd1', '1'),
(8, '1', '27', 'false', '1'),
(9, '4', '43', 'false', '1');

-- --------------------------------------------------------

--
-- Table structure for table `will_take_books`
--

CREATE TABLE `will_take_books` (
  `id` int(11) NOT NULL,
  `book_id` text NOT NULL,
  `stu_id` text NOT NULL,
  `book_grade` text NOT NULL,
  `take` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `will_take_books`
--

INSERT INTO `will_take_books` (`id`, `book_id`, `stu_id`, `book_grade`, `take`) VALUES
(1, '2', '1', 'grd2', '1'),
(2, '3', '1', 'grd2', '1'),
(3, '1', '1', 'grd2', '1'),
(4, '6', '27', 'grd1', '1'),
(5, '5', '27', 'grd1', '0'),
(6, '1', '27', 'grd1', '1'),
(7, '4', '47', 'grd2', '1'),
(8, '4', '42', 'grd2', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_grades`
--
ALTER TABLE `available_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_stock`
--
ALTER TABLE `book_stock`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_connections`
--
ALTER TABLE `grade_connections`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `will_give_books`
--
ALTER TABLE `will_give_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `will_take_books`
--
ALTER TABLE `will_take_books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_grades`
--
ALTER TABLE `available_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book_stock`
--
ALTER TABLE `book_stock`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT for table `grade_connections`
--
ALTER TABLE `grade_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `will_give_books`
--
ALTER TABLE `will_give_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `will_take_books`
--
ALTER TABLE `will_take_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
