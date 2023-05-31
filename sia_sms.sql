-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 04:49 PM
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
,`sem_id` int(11)
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
,`sem_id` int(11)
,`units` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_semester_view`
-- (See below for the actual view)
--
CREATE TABLE `student_semester_view` (
`id` int(11)
,`student_id` int(11)
,`program_id` int(11)
,`year_lvl` int(11)
,`sem_id` int(11)
,`sem_num` varchar(10)
,`start_year` int(11)
,`end_year` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 0,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `employee_id`, `attendance_date`, `status_id`, `time_in`, `time_out`) VALUES
(1, 3, '2023-05-27', 1, '08:38:00', '20:39:00'),
(2, 4, '2023-05-27', 1, '09:39:00', '20:39:00'),
(3, 5, '2023-05-27', 1, '08:20:00', '20:39:00'),
(4, 3, '2023-05-28', 1, '08:21:35', '15:46:50'),
(5, 4, '2023-05-28', 1, '08:21:35', '15:46:51'),
(6, 5, '2023-05-28', 0, NULL, NULL),
(7, 3, '2023-05-29', 1, '10:41:47', '22:41:53'),
(8, 4, '2023-05-29', 1, '10:41:48', '22:41:52'),
(9, 5, '2023-05-29', 1, '10:41:49', '22:41:51'),
(10, 6, '2023-05-29', 1, '10:41:50', '22:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_name`) VALUES
(1, 'Faculty'),
(2, 'Administation'),
(3, 'Staff'),
(4, 'Registrar'),
(5, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `hire_date` datetime NOT NULL DEFAULT current_timestamp(),
  `salary_hour` decimal(15,2) NOT NULL DEFAULT 0.00,
  `profile_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`id`, `first_name`, `middle_name`, `last_name`, `birthday`, `address`, `email`, `title`, `department_id`, `hire_date`, `salary_hour`, `profile_photo`) VALUES
(3, 'Dan', 'Louis', 'Dela Cruz', '2001-02-20', 'Sta. Rita, Pampanga', 'dan@email.com', 'Professor', 1, '2023-05-23 10:22:22', '200.00', ''),
(4, 'James', 'Morgan', 'McGill', '1990-04-10', 'San Fernando, Pampanga', 'saul@gmail.com', 'Manager', 2, '2023-05-23 10:31:00', '300.00', ''),
(5, 'Walter', 'Hartwell', 'White', '1980-11-04', 'San Fernando, Pampanga', 'walt@gmail.com', 'Supervisor', 4, '2023-05-23 10:31:47', '250.00', ''),
(6, 'Gus', 'Tavo', 'Fring', '1970-02-09', 'San Fernando, Pampanga', 'gus@gmail.com', 'Supervisor', 2, '2023-05-28 15:22:05', '250.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payroll`
--

CREATE TABLE `tbl_employee_payroll` (
  `id` int(11) NOT NULL,
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay` decimal(15,2) NOT NULL,
  `record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_payroll`
--

INSERT INTO `tbl_employee_payroll` (`id`, `payroll_id`, `employee_id`, `pay`, `record_date`) VALUES
(17, 5, 3, '6200.00', '2023-05-31 22:45:56'),
(18, 5, 4, '9000.00', '2023-05-31 22:45:56'),
(19, 5, 5, '6000.00', '2023-05-31 22:45:56'),
(20, 5, 6, '3000.00', '2023-05-31 22:45:56');

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
(1, 1, '5740.00', '0.00', '2023-04-03 13:05:38'),
(2, 2, '5950.00', '0.00', '2023-04-03 15:15:28'),
(3, 3, '4850.00', '0.00', '2023-04-03 15:15:28'),
(4, 4, '6160.00', '0.00', '2023-05-06 18:11:30'),
(5, 5, '5730.00', '0.00', '2023-05-06 20:05:11'),
(6, 6, '5730.00', '5730.00', '2023-05-06 20:05:11'),
(7, 17, '5950.00', '5950.00', '2023-05-07 22:28:40'),
(8, 18, '5730.00', '5730.00', '2023-05-07 22:28:40'),
(9, 19, '6170.00', '6170.00', '2023-05-07 22:28:40'),
(10, 20, '5740.00', '5740.00', '2023-05-07 22:28:40'),
(11, 21, '6170.00', '6170.00', '2023-05-07 22:28:40'),
(12, 22, '5290.00', '5290.00', '2023-05-07 22:28:40'),
(13, 23, '5950.00', '5950.00', '2023-05-07 22:28:40'),
(14, 24, '5950.00', '5950.00', '2023-05-07 22:28:40'),
(15, 25, '5950.00', '5950.00', '2023-05-07 22:28:40'),
(16, 26, '5530.00', '5530.00', '2023-05-07 22:28:40'),
(17, 7, '5320.00', '0.00', '2023-05-07 22:29:09'),
(18, 8, '5730.00', '0.00', '2023-05-07 22:29:09'),
(19, 9, '5950.00', '5950.00', '2023-05-07 22:29:09'),
(20, 10, '5950.00', '5950.00', '2023-05-07 22:29:09'),
(21, 11, '6170.00', '6170.00', '2023-05-07 22:29:09'),
(22, 12, '6170.00', '0.00', '2023-05-07 22:29:09'),
(23, 13, '5530.00', '5530.00', '2023-05-07 22:29:09'),
(24, 14, '6390.00', '6390.00', '2023-05-07 22:29:09'),
(25, 15, '5290.00', '5290.00', '2023-05-07 22:29:09'),
(26, 16, '5740.00', '5740.00', '2023-05-07 22:29:09');

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
(1, 1, '200.00', '70.00', '100.00', '150.00', '600.00', '50.00', '200.00', '160.00', '2023-05-08 08:06:34'),
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
(58, 1, '2023-04-07 13:31:09', 'Deleted User: Saul Goodman'),
(59, 1, '2023-04-08 12:54:29', 'Login'),
(60, 1, '2023-04-08 12:54:50', 'Updated personal information'),
(61, 1, '2023-04-08 12:55:06', 'Updated profile photo.'),
(62, 1, '2023-04-08 12:55:14', 'Updated profile photo.'),
(63, 1, '2023-04-08 12:55:50', 'Updated personal account password'),
(64, 1, '2023-04-08 12:56:32', 'New user: Saul Goodman added to the system.'),
(65, 1, '2023-04-08 12:56:43', 'Updated user information of User: Jimmy Goodman'),
(66, 1, '2023-04-08 12:56:53', 'Updated user information of User: Jimmy Goodman'),
(67, 1, '2023-04-08 12:57:01', 'Deleted User: Jimmy Goodman'),
(68, 1, '2023-04-08 12:58:18', 'Updated fee structure of Program ID #1'),
(69, 1, '2023-04-08 12:58:44', 'Logout'),
(70, 1, '2023-04-16 18:11:54', 'Login'),
(71, 1, '2023-05-01 09:36:33', 'Login'),
(72, 1, '2023-05-02 17:30:13', 'Login'),
(73, 1, '2023-05-02 22:36:23', 'Php 100 was paid for Fee No. 2 by Student NO. 2'),
(74, 1, '2023-05-02 22:48:51', 'Php 4000 was paid for Fee No. 2 by Student NO. 2'),
(75, 1, '2023-05-02 22:49:54', 'Php 50 was paid for Fee No. 2 by Student NO. 2'),
(76, 1, '2023-05-02 22:50:23', 'Php 50 was paid for Fee No. 2 by Student NO. 2'),
(77, 1, '2023-05-02 22:54:39', 'Php 5740 was paid for Fee No. 1 by Student NO. 1'),
(78, 1, '2023-05-06 12:57:48', 'Login'),
(79, 1, '2023-05-06 13:04:42', 'Php 200 was paid for Fee No. 2 by Student NO. 2'),
(80, 1, '2023-05-06 19:41:55', 'Php 5000 was paid for Fee No. 4 by Student NO. 1'),
(81, 1, '2023-05-06 19:44:46', 'Php 1160 was paid for Fee No. 4 by Student NO. 1'),
(82, 1, '2023-05-06 19:57:33', 'Php 1550 was paid for Fee No. 2 by Student NO. 2'),
(83, 1, '2023-05-06 20:06:23', 'Php 1550 was paid for Fee No. 2 by Student NO. 2'),
(84, 1, '2023-05-07 18:14:29', 'Login'),
(85, 1, '2023-05-07 19:58:48', 'Php 4850 was paid for Fee No. 3 by Student NO. 3'),
(86, 1, '2023-05-07 21:15:50', 'Logout'),
(87, 1, '2023-05-07 22:28:33', 'Login'),
(88, 1, '2023-05-07 22:29:43', 'Php 6170 was paid for Fee No. 22 by Student NO. 9'),
(89, 1, '2023-05-07 22:32:11', 'Php 5320 was paid for Fee No. 17 by Student NO. 4'),
(90, 1, '2023-05-07 22:32:31', 'Php 5730 was paid for Fee No. 18 by Student NO. 5'),
(91, 1, '2023-05-07 22:33:21', 'Logout'),
(92, 2, '2023-05-08 07:51:26', 'Login'),
(93, 2, '2023-05-08 07:51:43', 'Logout'),
(94, 1, '2023-05-08 08:00:47', 'Login'),
(95, 1, '2023-05-08 08:01:44', 'Updated personal information'),
(96, 1, '2023-05-08 08:02:00', 'Updated profile photo.'),
(97, 1, '2023-05-08 08:02:35', 'New user: Saul Goodman added to the system.'),
(98, 1, '2023-05-08 08:02:42', 'Updated user information of User: James Goodman'),
(99, 1, '2023-05-08 08:02:45', 'Deleted User: James Goodman'),
(100, 1, '2023-05-08 08:04:49', 'Php 5730 was paid for Fee No. 5 by Student NO. 2'),
(101, 1, '2023-05-08 08:05:57', 'Updated fee structure of Program ID #1'),
(102, 1, '2023-05-08 08:06:34', 'Updated fee structure of Program ID #1'),
(103, 1, '2023-05-08 08:28:56', 'Logout'),
(104, 1, '2023-05-22 16:27:28', 'Login'),
(105, 1, '2023-05-22 19:21:57', 'New employee: Dan Dela Cruz added to the system.'),
(106, 1, '2023-05-22 19:24:39', 'New employee: Gustavo Fring added to the system.'),
(107, 1, '2023-05-22 19:25:57', 'New employee: Dan Dela Cruz added to the system.'),
(108, 1, '2023-05-22 19:43:44', 'Updated profile photo of Employee No. 1.'),
(109, 1, '2023-05-22 19:45:00', 'Logout'),
(110, 1, '2023-05-22 19:45:05', 'Login'),
(111, 1, '2023-05-22 19:45:37', 'Updated profile photo of Employee No. 1.'),
(112, 1, '2023-05-22 19:45:51', 'Updated profile photo of Employee No. 1.'),
(113, 1, '2023-05-22 19:56:15', 'Employee: Daniel Dela Cruz information successfully updated.'),
(114, 1, '2023-05-22 19:56:24', 'Employee: Daniel Dela Cruz information successfully updated.'),
(115, 1, '2023-05-22 19:59:11', 'Deleted Employee: Daniel Dela Cruz'),
(116, 1, '2023-05-22 19:59:45', 'New employee: Dan Dela Cruz added to the system.'),
(117, 1, '2023-05-22 19:59:52', 'Updated profile photo of Employee No. 2.'),
(118, 1, '2023-05-23 09:54:08', 'Login'),
(119, 1, '2023-05-23 10:01:07', 'Employee: Dan Dela Cruz information successfully updated.'),
(120, 1, '2023-05-23 10:02:28', 'Employee: Dan Dela Cruz information successfully updated.'),
(121, 1, '2023-05-23 10:09:46', 'Deleted Employee: Dan Dela Cruz'),
(122, 1, '2023-05-23 10:22:22', 'New employee: Dan Dela Cruz added to the system.'),
(123, 1, '2023-05-23 10:31:00', 'New employee: James McGill added to the system.'),
(124, 1, '2023-05-23 10:31:47', 'New employee: Walter White added to the system.'),
(125, 1, '2023-05-23 11:15:10', 'Employee Attendance for 2023-05-23 successfully recorded.'),
(126, 1, '2023-05-23 11:15:45', 'Employee Attendance for 2023-05-24 successfully recorded.'),
(127, 1, '2023-05-27 19:23:18', 'Login'),
(128, 1, '2023-05-27 19:30:48', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(129, 1, '2023-05-27 19:54:55', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(130, 1, '2023-05-27 19:55:51', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(131, 1, '2023-05-27 19:58:19', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(132, 1, '2023-05-27 20:06:12', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(133, 1, '2023-05-27 20:06:50', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(134, 1, '2023-05-27 20:07:50', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(135, 1, '2023-05-27 20:11:12', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(136, 1, '2023-05-27 20:13:40', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(137, 1, '2023-05-27 20:14:49', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(138, 1, '2023-05-27 20:15:14', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(139, 1, '2023-05-27 20:15:25', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(140, 1, '2023-05-27 20:15:26', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(141, 1, '2023-05-27 20:15:28', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(142, 1, '2023-05-27 20:15:29', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(143, 1, '2023-05-27 20:17:19', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(144, 1, '2023-05-27 20:17:44', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(145, 1, '2023-05-27 20:17:45', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(146, 1, '2023-05-27 20:17:46', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(147, 1, '2023-05-27 20:18:02', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(148, 1, '2023-05-27 20:18:05', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(149, 1, '2023-05-27 20:18:23', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(150, 1, '2023-05-27 20:18:59', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(151, 1, '2023-05-27 20:19:11', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(152, 1, '2023-05-27 20:19:43', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(153, 1, '2023-05-27 20:19:50', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(154, 1, '2023-05-27 20:19:53', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(155, 1, '2023-05-27 20:20:03', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(156, 1, '2023-05-27 20:20:34', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(157, 1, '2023-05-27 20:25:42', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(158, 1, '2023-05-27 20:25:52', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(159, 1, '2023-05-27 20:26:02', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(160, 1, '2023-05-27 20:27:10', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(161, 1, '2023-05-27 20:27:19', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(162, 1, '2023-05-27 20:28:12', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(163, 1, '2023-05-27 20:31:22', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(164, 1, '2023-05-27 20:37:49', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(165, 1, '2023-05-27 20:37:53', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(166, 1, '2023-05-27 20:38:22', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(167, 1, '2023-05-27 20:38:35', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(168, 1, '2023-05-27 20:39:08', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(169, 1, '2023-05-27 20:39:17', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(170, 1, '2023-05-27 22:03:05', 'Employee Attendance for  successfully recorded.'),
(171, 1, '2023-05-28 12:34:15', 'Login'),
(172, 1, '2023-05-28 12:45:50', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(173, 1, '2023-05-28 12:46:42', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(174, 1, '2023-05-28 12:47:05', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(175, 1, '2023-05-28 14:19:18', 'Employee Attendance for 2023-05-27 successfully recorded.'),
(176, 1, '2023-05-28 14:21:38', 'Employee Attendance for 2023-05-28 successfully recorded.'),
(177, 1, '2023-05-28 14:27:23', 'Employee Attendance for 2023-05-28 successfully recorded.'),
(178, 1, '2023-05-28 15:21:03', 'Employee: James McGill information successfully updated.'),
(179, 1, '2023-05-28 15:22:05', 'New employee: Gus Fring added to the system.'),
(180, 1, '2023-05-28 15:26:00', 'Employee Attendance for 2023-05-28 successfully recorded.'),
(181, 1, '2023-05-28 15:30:57', 'Employee Attendance for 2023-05-28 successfully recorded.'),
(182, 1, '2023-05-28 15:46:53', 'Employee Attendance for 2023-05-28 successfully recorded.'),
(183, 1, '2023-05-30 20:19:39', 'Login'),
(184, 1, '2023-05-30 20:59:32', 'New leave for Employee No: 3 added to the system.'),
(185, 1, '2023-05-30 21:32:29', 'New leave for Employee No: 4 added to the system.'),
(186, 1, '2023-05-30 21:41:51', 'New leave for Employee No: 4 added to the system.'),
(187, 1, '2023-05-30 21:42:14', 'Leave for Employee No: 5 updated.'),
(188, 1, '2023-05-30 21:42:23', 'Leave for Employee No: 5 updated.'),
(189, 1, '2023-05-30 21:55:31', 'Leave id: 3 deleted'),
(190, 1, '2023-05-31 20:59:38', 'Login'),
(191, 1, '2023-05-31 21:31:39', 'New payroll added to the system.'),
(192, 1, '2023-05-31 22:13:10', 'New payroll added to the system.'),
(193, 1, '2023-05-31 22:16:20', 'New payroll added to the system.'),
(194, 1, '2023-05-31 22:18:38', 'New payroll added to the system.'),
(195, 1, '2023-05-31 22:41:27', 'Payroll id: 1 deleted'),
(196, 1, '2023-05-31 22:41:58', 'Employee Attendance for 2023-05-29 successfully recorded.'),
(197, 1, '2023-05-31 22:42:09', 'New payroll added to the system.'),
(198, 1, '2023-05-31 22:42:59', 'New payroll added to the system.'),
(199, 1, '2023-05-31 22:44:14', 'Payroll id: 3 deleted'),
(200, 1, '2023-05-31 22:44:32', 'Employee Attendance for 2023-05-29 successfully recorded.'),
(201, 1, '2023-05-31 22:44:41', 'Payroll id: 2 deleted'),
(202, 1, '2023-05-31 22:44:48', 'New payroll added to the system.'),
(203, 1, '2023-05-31 22:45:06', 'Payroll id: 4 deleted'),
(204, 1, '2023-05-31 22:45:24', 'Employee: Dan Dela Cruz information successfully updated.'),
(205, 1, '2023-05-31 22:45:31', 'Employee: James McGill information successfully updated.'),
(206, 1, '2023-05-31 22:45:39', 'Employee: Walter White information successfully updated.'),
(207, 1, '2023-05-31 22:45:48', 'Employee: Gus Fring information successfully updated.'),
(208, 1, '2023-05-31 22:45:56', 'New payroll added to the system.');

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
(1, 'Juan', 'Dela Cruz', 'jdc@gmail.com', '$2y$10$hMWJ2vpIbdMLv8whZyHzLuhQo4ynpLsw0tCBnGIYSehX5lGJVopt2', '../uploads/profile_photos/Juan64583bf8079d20.89281810.jpg', 0, '2023-03-17 18:56:14'),
(2, 'Gustavo', 'Fring', 'gus@gmail.com', '$2y$10$bO72GhlnIZ/Fix35nU0rSuRllONbZy7yA3.S92gmEAxKlgqZBp8AO', '../uploads/profile_photos/Gustavo642e692b9b2c75.45248743.jpeg', 0, '2023-04-06 02:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_type` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0,
  `record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`id`, `employee_id`, `start_date`, `end_date`, `leave_type`, `status_id`, `record_date`) VALUES
(1, 3, '2023-05-31', '2023-06-02', 1, 2, '2023-05-30 20:59:32'),
(2, 5, '2023-05-31', '2023-06-01', 2, 4, '2023-05-30 21:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_status`
--

CREATE TABLE `tbl_leave_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_status`
--

INSERT INTO `tbl_leave_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Ongoing'),
(3, 'Finished'),
(4, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_type`
--

CREATE TABLE `tbl_leave_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_type`
--

INSERT INTO `tbl_leave_type` (`id`, `name`) VALUES
(1, 'Vacation'),
(2, 'Sick'),
(3, 'Maternity'),
(4, 'Paternity'),
(5, 'Unpaid');

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

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `student_id`, `fee_id`, `amount_paid`, `payment_method`, `payment_date`) VALUES
(1, 2, 2, '100.00', 0, '2023-05-02 22:36:23'),
(2, 2, 2, '4000.00', 1, '2023-05-02 22:48:50'),
(3, 2, 2, '50.00', 0, '2023-05-02 22:49:54'),
(4, 2, 2, '50.00', 0, '2023-05-02 22:50:23'),
(5, 1, 1, '5740.00', 0, '2023-05-02 22:54:39'),
(6, 2, 2, '200.00', 0, '2023-05-06 13:04:42'),
(7, 1, 4, '5000.00', 0, '2023-05-06 19:41:55'),
(8, 1, 4, '1160.00', 0, '2023-05-06 19:44:46'),
(9, 2, 2, '1550.00', 0, '2023-05-06 20:06:23'),
(10, 3, 3, '4850.00', 0, '2023-05-07 19:58:48'),
(11, 9, 22, '6170.00', 0, '2023-05-07 22:29:43'),
(12, 4, 17, '5320.00', 0, '2023-05-07 22:32:11'),
(13, 5, 18, '5730.00', 0, '2023-05-07 22:32:31'),
(14, 2, 5, '5730.00', 0, '2023-05-08 08:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payroll`
--

CREATE TABLE `tbl_payroll` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payroll`
--

INSERT INTO `tbl_payroll` (`id`, `start_date`, `end_date`, `record_date`) VALUES
(5, '2023-05-27', '2023-05-29', '2023-05-31 22:45:56');

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
(3, 'Jesse', 'Bruce', 'Pinkman', '2023-04-03 15:12:37'),
(4, 'John', 'Michael', 'Doe', '2023-05-07 22:19:31'),
(5, 'Jane', 'Elizabeth', 'Smith', '2023-05-07 22:19:31'),
(6, 'David', 'William', 'Johnson', '2023-05-07 22:19:31'),
(7, 'Emily', 'Marie', 'Brown', '2023-05-07 22:19:31'),
(8, 'James', 'Robert', 'Taylor', '2023-05-07 22:19:31'),
(9, 'Sophia', 'Grace', 'Davis', '2023-05-07 22:19:31'),
(10, 'William', 'Andrew', 'Wilson', '2023-05-07 22:19:31'),
(11, 'Olivia', 'Jane', 'Thomas', '2023-05-07 22:19:31'),
(12, 'Benjamin', 'Edward', 'Clark', '2023-05-07 22:19:31'),
(13, 'Isabella', 'Rose', 'Green', '2023-05-07 22:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_course`
--

CREATE TABLE `tbl_student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `year_lvl` int(11) NOT NULL DEFAULT 1,
  `units` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_course`
--

INSERT INTO `tbl_student_course` (`id`, `student_id`, `program_id`, `sem_id`, `year_lvl`, `units`, `date_created`) VALUES
(1, 1, 1, 1, 1, 21, '2023-04-03 11:18:12'),
(2, 2, 3, 1, 1, 21, '2023-04-03 15:14:38'),
(3, 3, 2, 1, 1, 16, '2023-04-03 15:14:59'),
(4, 1, 1, 2, 1, 23, '2023-05-06 17:42:17'),
(5, 2, 3, 2, 1, 20, '2023-05-06 20:05:04'),
(6, 3, 2, 2, 1, 20, '2023-05-06 20:05:04'),
(7, 4, 1, 1, 1, 19, '2023-05-07 22:26:36'),
(8, 5, 3, 1, 1, 20, '2023-05-07 22:26:36'),
(9, 6, 2, 1, 1, 21, '2023-05-07 22:26:36'),
(10, 7, 1, 1, 1, 22, '2023-05-07 22:26:36'),
(11, 8, 2, 1, 1, 22, '2023-05-07 22:26:36'),
(12, 9, 3, 1, 1, 22, '2023-05-07 22:26:36'),
(13, 10, 1, 1, 1, 20, '2023-05-07 22:26:36'),
(14, 11, 2, 1, 1, 23, '2023-05-07 22:26:36'),
(15, 12, 3, 1, 1, 18, '2023-05-07 22:26:36'),
(16, 13, 1, 1, 1, 21, '2023-05-07 22:26:36'),
(17, 4, 1, 2, 1, 22, '2023-05-07 22:28:19'),
(18, 5, 3, 2, 1, 20, '2023-05-07 22:28:19'),
(19, 6, 2, 2, 1, 22, '2023-05-07 22:28:19'),
(20, 7, 1, 2, 1, 21, '2023-05-07 22:28:19'),
(21, 8, 2, 2, 1, 22, '2023-05-07 22:28:19'),
(22, 9, 3, 2, 1, 18, '2023-05-07 22:28:19'),
(23, 10, 1, 2, 1, 22, '2023-05-07 22:28:19'),
(24, 11, 2, 2, 1, 21, '2023-05-07 22:28:19'),
(25, 12, 3, 2, 1, 21, '2023-05-07 22:28:19'),
(26, 13, 1, 2, 1, 20, '2023-05-07 22:28:19');

-- --------------------------------------------------------

--
-- Structure for view `student_course_amount_view`
--
DROP TABLE IF EXISTS `student_course_amount_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_course_amount_view`  AS SELECT `student_course_view`.`id` AS `student_id`, `student_course_view`.`student_course_id` AS `student_course_id`, `student_course_view`.`sem_id` AS `sem_id`, `student_course_view`.`last_name` AS `last_name`, `student_course_view`.`first_name` AS `first_name`, `student_course_view`.`middle_name` AS `middle_name`, `student_course_view`.`program_name` AS `program_name`, `tbl_fees`.`amount` AS `amount`, `tbl_fees`.`remaining_balance` AS `remaining_balance` FROM (`student_course_view` left join `tbl_fees` on(`student_course_view`.`student_course_id` = `tbl_fees`.`student_course_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `student_course_view`
--
DROP TABLE IF EXISTS `student_course_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_course_view`  AS SELECT `tbl_students`.`id` AS `id`, `tbl_student_course`.`id` AS `student_course_id`, `tbl_students`.`last_name` AS `last_name`, `tbl_students`.`first_name` AS `first_name`, `tbl_students`.`middle_name` AS `middle_name`, `tbl_programs`.`program_name` AS `program_name`, `tbl_student_course`.`sem_id` AS `sem_id`, `tbl_student_course`.`units` AS `units` FROM ((`tbl_students` left join `tbl_student_course` on(`tbl_students`.`id` = `tbl_student_course`.`student_id`)) left join `tbl_programs` on(`tbl_student_course`.`program_id` = `tbl_programs`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `student_semester_view`
--
DROP TABLE IF EXISTS `student_semester_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_semester_view`  AS SELECT `tbl_student_course`.`id` AS `id`, `tbl_student_course`.`student_id` AS `student_id`, `tbl_student_course`.`program_id` AS `program_id`, `tbl_student_course`.`year_lvl` AS `year_lvl`, `tbl_student_course`.`sem_id` AS `sem_id`, `tbl_semester`.`sem_num` AS `sem_num`, `tbl_semester`.`start_year` AS `start_year`, `tbl_semester`.`end_year` AS `end_year` FROM (`tbl_student_course` left join `tbl_semester` on(`tbl_student_course`.`sem_id` = `tbl_semester`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee-attend` (`employee_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_payroll` (`employee_id`),
  ADD KEY `payroll_id` (`payroll_id`);

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
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_employee` (`employee_id`),
  ADD KEY `leave_type` (`leave_type`),
  ADD KEY `leave_status` (`status_id`);

--
-- Indexes for table `tbl_leave_status`
--
ALTER TABLE `tbl_leave_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payroll`
--
ALTER TABLE `tbl_payroll`
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
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_fees`
--
ALTER TABLE `tbl_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_finance_audit_log`
--
ALTER TABLE `tbl_finance_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `tbl_finance_users`
--
ALTER TABLE `tbl_finance_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_leave_status`
--
ALTER TABLE `tbl_leave_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_payroll`
--
ALTER TABLE `tbl_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `employee-attend` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD CONSTRAINT `department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employee_payroll`
--
ALTER TABLE `tbl_employee_payroll`
  ADD CONSTRAINT `employee_payroll` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_id` FOREIGN KEY (`payroll_id`) REFERENCES `tbl_payroll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD CONSTRAINT `leave_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_status` FOREIGN KEY (`status_id`) REFERENCES `tbl_leave_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_type` FOREIGN KEY (`leave_type`) REFERENCES `tbl_leave_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
