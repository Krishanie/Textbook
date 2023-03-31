-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 04:38 PM
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
-- Database: `textbook_issuing_system`
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
(1, 'Text Books', 'Text Book Issuing System', 'site_logo-63ce34f1266b41.18466967.png');

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
(293, '4', '', 'Hi', 'all', '2023-01-27 11:10 am'),
(294, '1', '', 'Hi', 'all', '2023-01-27 11:10 am'),
(298, '4', '', 'oo', 'all', '2023-01-27 11:10 am'),
(314, 'system', '', 'Sir, Grade 1 Maths Only 5 books left.', 'all', '2023-01-27 11:19 am'),
(315, 'system', '', 'Sir, Grade 1 Sinhala Only 4 books left.', 'all', '2023-01-27 11:19 am'),
(317, '4', '', 'Hi', 'all', '2023-02-19 09:06 pm'),
(319, 'system', '', 'Sir, Grade 9 PTS Only 4 books left.', 'all', '2023-02-19 09:07 pm');

-- --------------------------------------------------------

--
-- Table structure for table `grd1_books`
--

CREATE TABLE `grd1_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grd1_books`
--

INSERT INTO `grd1_books` (`id`, `book_name`, `gv_id`, `language`, `total_stu`, `leftover_books`, `ex_requests`, `total_books`) VALUES
(6, 'Maths', '001', 's', '12', '5', '5', '8');

-- --------------------------------------------------------

--
-- Table structure for table `grd2_books`
--

CREATE TABLE `grd2_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd3_books`
--

CREATE TABLE `grd3_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd4_books`
--

CREATE TABLE `grd4_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd5_books`
--

CREATE TABLE `grd5_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd6_books`
--

CREATE TABLE `grd6_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd7_books`
--

CREATE TABLE `grd7_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd8_books`
--

CREATE TABLE `grd8_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grd9_books`
--

CREATE TABLE `grd9_books` (
  `id` int(11) NOT NULL,
  `book_name` text NOT NULL,
  `gv_id` text NOT NULL,
  `language` text NOT NULL,
  `total_stu` text NOT NULL,
  `leftover_books` text NOT NULL,
  `ex_requests` text NOT NULL,
  `total_books` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grd9_books`
--

INSERT INTO `grd9_books` (`id`, `book_name`, `gv_id`, `language`, `total_stu`, `leftover_books`, `ex_requests`, `total_books`) VALUES
(6, 'PTS', '003', 's', '54', '4', '3', '56');

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
(19, '', '', '', '', '', '2023-01-26'),
(20, '', '', '', '', '', '2023-01-26'),
(21, '', '', '', '', '', '2023-01-26'),
(22, '', '', '', '', '', '2023-01-26'),
(23, '', '', '', '', '', '2023-01-26'),
(24, '', '', '', '', '', '2023-01-26'),
(25, '', '', '', '', '', '2023-01-26'),
(26, 'dsaf', '123', 'grd4', 'F', 's', '2023-02-12');

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
  `added_date` text NOT NULL,
  `last_login` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `username`, `password`, `img`, `role`, `added_date`, `last_login`) VALUES
(1, 'Main Admin ', 'main-admin', '12345', 'main-default.png', 'main-admin', '', '1676821118'),
(4, 'Admin 1', 'admin1', '123', 'default.png', 'admin', '', '1676821118'),
(5, 'Admin 2', 'admin2', '123', 'default.png', 'admin', '', '1674794690');

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
(6, '5', '18', 'grd1', '0');

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
(3, '1', '1', 'grd2', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_grades`
--
ALTER TABLE `available_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd1_books`
--
ALTER TABLE `grd1_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd2_books`
--
ALTER TABLE `grd2_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd3_books`
--
ALTER TABLE `grd3_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd4_books`
--
ALTER TABLE `grd4_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd5_books`
--
ALTER TABLE `grd5_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd6_books`
--
ALTER TABLE `grd6_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd7_books`
--
ALTER TABLE `grd7_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd8_books`
--
ALTER TABLE `grd8_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grd9_books`
--
ALTER TABLE `grd9_books`
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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `grd1_books`
--
ALTER TABLE `grd1_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grd2_books`
--
ALTER TABLE `grd2_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grd3_books`
--
ALTER TABLE `grd3_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grd4_books`
--
ALTER TABLE `grd4_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grd5_books`
--
ALTER TABLE `grd5_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grd6_books`
--
ALTER TABLE `grd6_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grd7_books`
--
ALTER TABLE `grd7_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grd8_books`
--
ALTER TABLE `grd8_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grd9_books`
--
ALTER TABLE `grd9_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `will_give_books`
--
ALTER TABLE `will_give_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `will_take_books`
--
ALTER TABLE `will_take_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
