-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 03:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessment_code` int(9) NOT NULL,
  `module_code` varchar(15) NOT NULL,
  `name` varchar(250) NOT NULL,
  `marking_scheme` varchar(9) NOT NULL,
  `weighs` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` varchar(15) NOT NULL,
  `sub_assessment` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessment_code`, `module_code`, `name`, `marking_scheme`, `weighs`, `description`, `deadline`, `sub_assessment`) VALUES
(22, '103', 'lab work', 'yes', '25%', 'weekly tutorials', '2017-09-03', 'hw'),
(18, '101', 'HW', 'no', '75%', 'two exams', '2017-09-03', 'project');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(5) NOT NULL,
  `lecturer_id` varchar(9) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `lecturer_id`, `student_id`, `module_code`, `module_name`) VALUES
(2, '111', '666', '101', 'Database'),
(1, '111', '777', '103', 'Operating Systems'),
(3, '444', '777', '102', 'software');

-- --------------------------------------------------------

--
-- Table structure for table `marking_scheme`
--

CREATE TABLE `marking_scheme` (
  `id` int(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `criteria` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `percentage` int(9) NOT NULL,
  `range_type` varchar(50) NOT NULL,
  `marks_range` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme`
--

INSERT INTO `marking_scheme` (`id`, `module_code`, `module_name`, `assessment_code`, `criteria`, `description`, `percentage`, `range_type`, `marks_range`) VALUES
(26, '103', 'Operating Systems', '22', 'Project Plan and Proposed Solution', 'Relation being theory and practical work produced', 40, 'Yes', '5'),
(25, '102', 'Software', '22', 'Problem Definition and Literature Review', 'Understanding of topic area', 20, 'Yes', '3'),
(24, '101', 'Database', '22', 'Problem Definition and Literature Review', 'How well does the report identify the problem being invested?', 40, 'No', '3');

-- --------------------------------------------------------

--
-- Table structure for table `marking_scheme_marks`
--

CREATE TABLE `marking_scheme_marks` (
  `id` int(9) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `module_code` varchar(10) NOT NULL,
  `assessment_code` varchar(10) NOT NULL,
  `marker` varchar(250) NOT NULL,
  `mark_given` int(5) NOT NULL,
  `total_marks` int(5) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme_marks`
--

INSERT INTO `marking_scheme_marks` (`id`, `student_id`, `module_code`, `assessment_code`, `marker`, `mark_given`, `total_marks`, `feedback`) VALUES
(39, '777', '103', '78', 's1', 1, 6, 'Good effort'),
(40, '777', '102', '12', 's1', 2, 6, 'Good effort'),
(41, '666', '101', '99', 's1', 3, 6, 'Good effort');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `mark_id` int(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `sub_assessment` varchar(50) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `final_mark` int(5) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`mark_id`, `module_code`, `assessment_code`, `sub_assessment`, `student_id`, `final_mark`, `feedback`) VALUES
(66, '103', '1', 'hw', '777', 45, 'Good attempt'),
(68, '101', '2', 'project', '666', 50, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(9) NOT NULL,
  `module_code` varchar(7) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `lecturer_id` int(255) NOT NULL,
  `module_leader` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `level` varchar(25) NOT NULL,
  `assessment1` varchar(50) NOT NULL,
  `assessment2` varchar(50) NOT NULL,
  `assessment3` varchar(50) NOT NULL,
  `lecturers_linked` varchar(250) NOT NULL,
  `engagement_points` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_code`, `module_name`, `lecturer_id`, `module_leader`, `description`, `level`, `assessment1`, `assessment2`, `assessment3`, `lecturers_linked`, `engagement_points`) VALUES
(1, '102', 'Software', 444, 'Ahmad hassan', 'Advanced software m', '0', '', '', '', '', ''),
(2, '103', 'Operating System', 111, 'Adel amer', 'Scripting', '5', '', '', '', '', ''),
(3, '101', 'Database', 111, 'Hakeem yaish', 'Database SQL tutorials', '5', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `rank` varchar(15) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `rank`, `level`) VALUES
(111, 'Hamam', 'Ahamd', 'asdwe@gmai.com', 'hamam', 'sa', 'lecturer', 2),
(15, 'rami', 'sal', 'rr@gmail.com', 'Rami', '00', 'lecturer', 2),
(444, 'nasser', 'naeem', 'example@test.co.uk', 'nasser', 'pass', 'lecturer', 3),
(555, 'abood', 'islam', 'example@test.com', 'abood', 'pass', 'Admin', 4),
(666, 'ameer', 'moujdi', 'test@example.com', 'ameer', 'pass', 'student', 5),
(0, 'Ahmad', 'Khaled', 'sjsis@gmail.com', 'Ahmad', '123', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessment_code`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marking_scheme`
--
ALTER TABLE `marking_scheme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marking_scheme_marks`
--
ALTER TABLE `marking_scheme_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assessment_code` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `marking_scheme`
--
ALTER TABLE `marking_scheme`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `marking_scheme_marks`
--
ALTER TABLE `marking_scheme_marks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
