-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2023 at 01:29 PM
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
(1, 1, '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '2023-03-18 20:27:13'),
(2, 2, '8.00', '7.00', '6.00', '5.00', '4.00', '3.00', '2.00', '1.00', '2023-03-18 20:27:37'),
(3, 3, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2023-03-17 18:54:13');

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
(1, 'Juan', 'Dela Cruz', 'jdc@gmail.com', '12345', '', 0, '2023-03-17 18:56:14');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_fee_struc`
--
ALTER TABLE `tbl_fee_struc`
  ADD CONSTRAINT `Program ID` FOREIGN KEY (`program_id`) REFERENCES `tbl_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
