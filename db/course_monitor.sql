-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2016 at 02:14 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_years`
--

CREATE TABLE IF NOT EXISTS `tbl_academic_years` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `course_leader_users_id` int(11) NOT NULL,
  `course_moderator_users_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_academic_years`
--

INSERT INTO `tbl_academic_years` (`id`, `year`, `courses_id`, `course_leader_users_id`, `course_moderator_users_id`) VALUES
(4, 2015, 4, 4, 5),
(5, 2016, 4, 4, 10),
(6, 2015, 6, 4, 5),
(7, 2016, 7, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `faculties_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `code`, `name`, `faculties_id`) VALUES
(4, 'BP 01', 'Basic programming', 8),
(5, 'JP1', 'Java Programming', 8),
(6, 'M1', 'Math 01', 9),
(7, 'BE 1', 'Biology English ', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculties`
--

CREATE TABLE IF NOT EXISTS `tbl_faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `vice_chancellor_users_id` int(11) NOT NULL,
  `learning_director_users_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_faculties`
--

INSERT INTO `tbl_faculties` (`id`, `name`, `vice_chancellor_users_id`, `learning_director_users_id`) VALUES
(8, 'Information Techonology', 2, 3),
(9, 'Biology', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE IF NOT EXISTS `tbl_reports` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin,
  `file_url` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `status` int(1) NOT NULL,
  `create_by` int(11) NOT NULL,
  `approve_by` int(11) NOT NULL,
  `feedback_by` int(11) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `approve_datetime` datetime NOT NULL,
  `feedback_datetime` datetime NOT NULL,
  `academic_years_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`id`, `name`, `description`, `file_url`, `status`, `create_by`, `approve_by`, `feedback_by`, `create_datetime`, `approve_datetime`, `feedback_datetime`, `academic_years_id`) VALUES
(10, 'wewe', 'ewewe', 'E:/Work/3.PHP/6.CourseMonitorReport/assets/files/Untitled9.png', 1, 4, 0, 0, '2016-04-03 15:09:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(11, 'dsd', 'dsd', '', 1, 4, 0, 0, '2016-04-03 15:16:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(12, 'sdsdsdxx', 'xsdds', '', 1, 4, 0, 0, '2016-04-03 15:18:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(13, 'vcv', 'cvcv', 'E:/Work/3.PHP/6.CourseMonitorReport/assets/files/Untitled10.png', 1, 4, 0, 0, '2016-04-03 15:23:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(14, 'sdd', 'dsds', '', 1, 4, 0, 0, '2016-04-03 15:31:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(15, 'ds', 'dsd', '', 1, 4, 0, 0, '2016-04-03 15:37:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(16, 'dsdx', 'dsd', 'E:/Work/3.PHP/6.CourseMonitorReport/assets/files/Academic_English_Handbook_for_International_Students.pdf', 1, 4, 0, 0, '2016-04-03 15:37:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL,
  `account_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `account_name`, `password`, `name`, `email`, `role_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 1),
(2, 'chancellor', 'e10adc3949ba59abbe56e057f20f883e', 'Pro-Vice Chancellor', 'phucsystem@gmail.com', 2),
(3, 'director', 'e10adc3949ba59abbe56e057f20f883e', 'Director of Learning and Quality', '', 3),
(4, 'leader', 'e10adc3949ba59abbe56e057f20f883e', 'Course Leader', 'phucsystem@gmail.com', 4),
(5, 'moderator', 'e10adc3949ba59abbe56e057f20f883e', 'Course Moderator', 'phucsystem@gmail.com', 5),
(7, 'sdads', '4297f44b13955235245b2497399d7a93', '111', 'phucsystem@gmail.com', 1),
(9, 'leader2', 'e10adc3949ba59abbe56e057f20f883e', 'Leader 2', 'phucsystem@gmail.com', 4),
(10, 'moderator2', 'e10adc3949ba59abbe56e057f20f883e', 'moderator2', 'phucsystem@gmail.com', 5),
(12, 'chancellor2', '4297f44b13955235245b2497399d7a93', '123123', 'phucsystem@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_academic_years`
--
ALTER TABLE `tbl_academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faculties`
--
ALTER TABLE `tbl_faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academic_years`
--
ALTER TABLE `tbl_academic_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_faculties`
--
ALTER TABLE `tbl_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
