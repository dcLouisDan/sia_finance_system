-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 07:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Stand-in structure for view `student_course_amount_view`
-- (See below for the actual view)
--
CREATE TABLE `student_course_amount_view` (
`student_id` int(11)
,`student_course_id` int(11)
,`last_name` varchar(150)
,`first_name` varchar(150)
,`middle_name` varchar(150)
,`program_name` varchar(255)
,`amount` decimal(15,2)
,`remaining_balance` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_course_view`
-- (See below for the actual view)
--
CREATE TABLE `student_course_view` (
`id` int(11)
,`student_course_id` int(11)
,`last_name` varchar(150)
,`first_name` varchar(150)
,`middle_name` varchar(150)
,`program_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fees`
--

CREATE TABLE `tbl_fees` (
  `id` int(11) NOT NULL,
  `student_course_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `remaining_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_fees`
--

INSERT INTO `tbl_fees` (`id`, `student_course_id`, `amount`, `remaining_balance`, `record_date`) VALUES
(1, 1, '5950.00', '5950.00', '2023-04-03 13:05:38'),
(2, 2, '5950.00', '5950.00', '2023-04-03 15:15:28'),
(3, 3, '4850.00', '4850.00', '2023-04-03 15:15:28');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 1, '2023-03-25 11:49:33', 'Updated personal information'),
(12, 1, '2023-03-26 19:14:28', 'Login'),
(13, 1, '2023-04-03 11:25:23', 'Login'),
(14, 1, '2023-04-03 15:18:28', 'Logout'),
(15, 1, '2023-04-05 01:23:46', 'Login'),
(16, 1, '2023-04-05 02:03:13', 'Updated personal information'),
(17, 1, '2023-04-05 02:03:44', 'Updated personal information'),
(18, 1, '2023-04-05 02:04:23', 'Logout'),
(19, 1, '2023-04-05 02:05:22', 'Login'),
(20, 1, '2023-04-05 02:05:27', 'Updated personal information'),
(21, 1, '2023-04-05 02:05:45', 'Updated personal information'),
(22, 1, '2023-04-05 02:07:01', 'Updated personal information'),
(23, 1, '2023-04-05 02:07:11', 'Updated personal information'),
(24, 1, '2023-04-05 02:07:19', 'Updated personal information'),
(25, 1, '2023-04-05 02:13:11', 'Updated profile photo.'),
(26, 1, '2023-04-05 02:13:39', 'Updated profile photo.'),
(27, 1, '2023-04-05 02:19:09', 'Updated fee structure of Program ID #1'),
(28, 1, '2023-04-05 02:21:29', 'Logout'),
(29, 1, '2023-04-05 22:11:52', 'Login'),
(30, 1, '2023-04-06 00:12:28', 'Login'),
(31, 1, '2023-04-06 01:13:23', 'Updated personal information'),
(32, 1, '2023-04-06 02:23:54', 'New user: Gustavo Fring added to the system.'),
(33, 1, '2023-04-06 02:32:07', 'New user: Gustavo Fring added to the system.'),
(34, 1, '2023-04-06 02:37:11', 'Logout'),
(35, 2, '2023-04-06 02:37:40', 'Login'),
(36, 2, '2023-04-06 02:37:45', 'Logout'),
(37, 2, '2023-04-06 02:37:56', 'Login'),
(38, 2, '2023-04-06 02:39:39', 'Updated profile photo.'),
(39, 2, '2023-04-06 02:45:01', 'Logout'),
(40, 1, '2023-04-06 02:45:05', 'Login'),
(41, 1, '2023-04-07 11:00:39', 'Login'),
(42, 1, '2023-04-07 12:23:36', 'Updated personal account password'),
(43, 1, '2023-04-07 12:23:40', 'Logout'),
(44, 2, '2023-04-07 12:24:44', 'Login'),
(45, 2, '2023-04-07 12:24:54', 'Logout'),
(46, 1, '2023-04-07 12:29:28', 'Login'),
(47, 1, '2023-04-07 12:29:44', 'Updated personal account password'),
(48, 1, '2023-04-07 12:29:46', 'Logout'),
(49, 1, '2023-04-07 12:30:00', 'Login'),
(50, 1, '2023-04-07 13:14:39', 'Updated user information of User: Gus Fring'),
(51, 1, '2023-04-07 13:16:16', 'Updated user information of User: Gustavo Fring'),
(52, 1, '2023-04-07 13:26:56', 'New user: Saul Goodman added to the system.'),
(53, 1, '2023-04-07 13:27:04', 'Updated user information of User: Saul Goodman'),
(54, 1, '2023-04-07 13:27:42', 'Deleted User:  '),
(55, 1, '2023-04-07 13:30:23', 'New user: Saul Goodman added to the system.'),
(56, 1, '2023-04-07 13:30:31', 'Deleted User:  '),
(57, 1, '2023-04-07 13:31:06', 'New user: Saul Goodman added to the system.'),
(58, 1, '2023-04-07 13:31:09', 'Deleted User: Saul Goodman');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_finance_users`
--

INSERT INTO `tbl_finance_users` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_photo`, `access_lvl`, `date_created`) VALUES
(1, 'Juan', 'Dela Cruz', 'jdc@gmail.com', '$2y$10$TqZsxrjRG0Pl2ueZiws.LeWnCnSI1rago0afcFfTQTAs9q7JdONK6', '../uploads/profile_photos/Juan642d11932f81f6.72625293.png', 0, '2023-03-17 18:56:14'),
(2, 'Gustavo', 'Fring', 'gus@gmail.com', '$2y$10$bO72GhlnIZ/Fix35nU0rSuRllONbZy7yA3.S92gmEAxKlgqZBp8AO', '../uploads/profile_photos/Gustavo642e692b9b2c75.45248743.jpeg', 0, '2023-04-06 02:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `amount_paid` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payment_method` int(11) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programs`
--

CREATE TABLE `tbl_programs` (
  `id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_desc` text NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`id`, `sem_num`, `start_year`, `end_year`, `date_created`) VALUES
(1, '1', 2022, 2023, '2023-04-03 11:16:13'),
(2, '2', 2022, 2023, '2023-04-03 11:16:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `first_name`, `middle_name`, `last_name`, `date_added`) VALUES
(1, 'Walter', 'Hartwell', 'White', '2023-04-03 11:17:07'),
(2, 'James', 'Morgan', 'McGill', '2023-04-03 15:12:20'),
(3, 'Jesse', 'Bruce', 'Pinkman', '2023-04-03 15:12:37');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_course`
--

INSERT INTO `tbl_student_course` (`id`, `student_id`, `program_id`, `sem_id`, `units`, `date_created`) VALUES
(1, 1, 1, 1, 21, '2023-04-03 11:18:12'),
(2, 2, 3, 1, 21, '2023-04-03 15:14:38'),
(3, 3, 2, 1, 16, '2023-04-03 15:14:59');

-- --------------------------------------------------------

--
-- Structure for view `student_course_amount_view`
--
DROP TABLE IF EXISTS `student_course_amount_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_course_amount_view`  AS SELECT `student_course_view`.`id` AS `student_id`, `student_course_view`.`student_course_id` AS `student_course_id`, `student_course_view`.`last_name` AS `last_name`, `student_course_view`.`first_name` AS `first_name`, `student_course_view`.`middle_name` AS `middle_name`, `student_course_view`.`program_name` AS `program_name`, `tbl_fees`.`amount` AS `amount`, `tbl_fees`.`remaining_balance` AS `remaining_balance` FROM (`student_course_view` left join `tbl_fees` on(`student_course_view`.`student_course_id` = `tbl_fees`.`student_course_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `student_course_view`
--
DROP TABLE IF EXISTS `student_course_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_course_view`  AS SELECT `tbl_students`.`id` AS `id`, `tbl_student_course`.`id` AS `student_course_id`, `tbl_students`.`last_name` AS `last_name`, `tbl_students`.`first_name` AS `first_name`, `tbl_students`.`middle_name` AS `middle_name`, `tbl_programs`.`program_name` AS `program_name` FROM ((`tbl_students` left join `tbl_student_course` on(`tbl_students`.`id` = `tbl_student_course`.`student_id`)) left join `tbl_programs` on(`tbl_student_course`.`program_id` = `tbl_programs`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee studcour id` (`student_course_id`);

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
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
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
  ADD KEY `program` (`program_id`),
  ADD KEY `cor sem id` (`sem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_finance_audit_log`
--
ALTER TABLE `tbl_finance_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_finance_users`
--
ALTER TABLE `tbl_finance_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  ADD CONSTRAINT `fee studcour id` FOREIGN KEY (`student_course_id`) REFERENCES `tbl_student_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `cor sem id` FOREIGN KEY (`sem_id`) REFERENCES `tbl_semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program` FOREIGN KEY (`program_id`) REFERENCES `tbl_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student id` FOREIGN KEY (`student_id`) REFERENCES `tbl_students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
