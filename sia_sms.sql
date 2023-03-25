-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2023 at 06:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fee_struc`
--

CREATE TABLE `tbl_fee_struc` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL DEFAULT 0,
  `tuition_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `misc_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `registration_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `library_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `laboratory_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `guidance_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `computer_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `athletic_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fee_struc`
--

INSERT INTO `tbl_fee_struc` (`id`, `program_id`, `tuition_fee`, `misc_fee`, `registration_fee`, `library_fee`, `laboratory_fee`, `guidance_fee`, `computer_fee`, `athletic_fee`, `updated_on`) VALUES
(1, 1, '220.00', '70.00', '100.00', '150.00', '600.00', '50.00', '200.00', '160.00', '2023-03-25 11:47:16'),
(2, 2, '220.00', '70.00', '100.00', '150.00', '600.00', '50.00', '200.00', '160.00', '2023-03-25 11:47:16'),
(3, 3, '220.00', '70.00', '100.00', '150.00', '600.00', '50.00', '200.00', '160.00', '2023-03-25 11:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finance_audit_log`
--

CREATE TABLE `tbl_finance_audit_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_date` datetime NOT NULL DEFAULT current_timestamp(),
  `action_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_finance_audit_log`
--

INSERT INTO `tbl_finance_audit_log` (`id`, `user_id`, `action_date`, `action_desc`) VALUES
(1, 1, '2023-03-24 21:10:13', 'Login'),
(2, 1, '2023-03-24 21:42:49', 'Updated personal information'),
(3, 1, '2023-03-24 21:43:14', 'Updated profile photo.'),
(4, 1, '2023-03-24 21:47:47', 'Login'),
(5, 1, '2023-03-24 21:47:49', 'Logout'),
(6, 1, '2023-03-24 21:48:04', 'Login'),
(7, 1, '2023-03-24 21:48:35', 'Updated fee structure of Program ID #1'),
(8, 1, '2023-03-24 21:48:59', 'Updated profile photo.'),
(9, 1, '2023-03-25 10:32:55', 'Login'),
(10, 1, '2023-03-25 11:47:16', 'Updated fee structure of all College Programs'),
(11, 1, '2023-03-25 11:49:33', 'Updated personal information');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finance_users`
--

CREATE TABLE `tbl_finance_users` (
  `id` int(255) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `access_lvl` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_finance_users`
--

INSERT INTO `tbl_finance_users` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_photo`, `access_lvl`, `date_created`) VALUES
(1, 'Juan', 'Dela Cruz', 'jdc@gmail.com', '12345', '../uploads/profile_photos/John641daa4b8f9351.98352420.jpg', 0, '2023-03-17 18:56:14');

--
-- Triggers `tbl_finance_users`
--
DELIMITER $$
CREATE TRIGGER `insert_total_fee` AFTER INSERT ON `tbl_finance_users` FOR EACH ROW UPDATE tbl_fee_struc
    SET total = tuition_fee + lab_fee + misc_fee + registration_fee + library_fee + laboratory_fee + guidance_fee + computer_fee + athletic_fee
    WHERE id = NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programs`
--

CREATE TABLE `tbl_programs` (
  `id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_desc` text NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_programs`
--

INSERT INTO `tbl_programs` (`id`, `program_name`, `program_desc`, `updated_on`) VALUES
(1, 'BACHELOR OF SCIENCE IN  INFORMATION TECHNOLOGY', 'The BS Information Technology (BSIT) program includes the study of the utilization of both hardware and software technologies involving planning, installing, customizing, operating, managing and administering, and maintaining information technology infrastructure that provides computing solutions to address the needs of an organization.', '2023-03-17 18:53:46'),
(2, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'The BS Computer Science (BSCS) program includes the study of computing concepts and theories, algorithm foundations and new developments in computing. The program prepares students to design and create algorithmically complex software and develop new and effective algorithms for solving computing problems.\r\n\r\nThe program also includes the study of standards and practices in Software Engineering. It prepares students to acquire skills and disciplines required for designing, writing and modifying software components, modules and applications that comprise software solutions.', '2023-03-17 18:54:21'),
(3, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEMS', 'The BS Information System (BSIS) program includes the study of application and effect of information technology to organizations. Graduates of the program should be able to implement an information system, which considers complex technological and organizational factors affecting it. These include components, tools, techniques, strategies, methodologies. etc.', '2023-03-17 18:54:26');

--
-- Triggers `tbl_programs`
--
DELIMITER $$
CREATE TRIGGER `update_fee_struc` AFTER INSERT ON `tbl_programs` FOR EACH ROW INSERT INTO tbl_fee_struc (tbl_fee_struc.program_id) VALUES (NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

CREATE TABLE `tbl_semester` (
  `id` int(11) NOT NULL,
  `sem_num` varchar(10) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_course`
--

CREATE TABLE `tbl_student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_id` (`program_id`);

--
-- Indexes for table `tbl_finance_audit_log`
--
ALTER TABLE `tbl_finance_audit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit user` (`user_id`);

--
-- Indexes for table `tbl_finance_users`
--
ALTER TABLE `tbl_finance_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student id` (`student_id`),
  ADD KEY `program` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_finance_audit_log`
--
ALTER TABLE `tbl_finance_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_finance_users`
--
ALTER TABLE `tbl_finance_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  ADD CONSTRAINT `Program ID` FOREIGN KEY (`program_id`) REFERENCES `tbl_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_finance_audit_log`
--
ALTER TABLE `tbl_finance_audit_log`
  ADD CONSTRAINT `audit user` FOREIGN KEY (`user_id`) REFERENCES `tbl_finance_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  ADD CONSTRAINT `program` FOREIGN KEY (`program_id`) REFERENCES `tbl_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student id` FOREIGN KEY (`student_id`) REFERENCES `tbl_students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
