-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 10:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `placementdbce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Email`) VALUES
('warren@dbcegoa.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `Class_id` int(11) NOT NULL,
  `Class_name` varchar(255) NOT NULL,
  `Dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`Class_id`, `Class_name`, `Dept_id`) VALUES
(1, 'TE COMP', 1),
(2, 'BE COMP', 1),
(3, 'TE MECH', 2),
(4, 'BE MECH', 2),
(5, 'TE ECS', 3),
(6, 'BE ECS', 3),
(7, 'TE CIVIL', 4),
(8, 'BE CIVIL', 4);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `C_id` int(11) NOT NULL,
  `C_Name` varchar(255) NOT NULL,
  `C_Logo` varchar(255) DEFAULT NULL,
  `C_Domain` varchar(255) DEFAULT NULL,
  `C_Scope` varchar(255) DEFAULT NULL,
  `C_Description` text DEFAULT NULL,
  `C_Location` varchar(255) DEFAULT NULL,
  `C_Website` varchar(255) DEFAULT NULL,
  `C_HR_name` varchar(255) DEFAULT NULL,
  `C_HR_email` varchar(255) DEFAULT NULL,
  `C_HR_phone` varchar(20) DEFAULT NULL,
  `C_Date_of_Reg` date DEFAULT current_timestamp(),
  `C_PC_Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`C_id`, `C_Name`, `C_Logo`, `C_Domain`, `C_Scope`, `C_Description`, `C_Location`, `C_Website`, `C_HR_name`, `C_HR_email`, `C_HR_phone`, `C_Date_of_Reg`, `C_PC_Email`) VALUES
(3, 'Indus Valley Partners', 'C_id_3.png', 'Web Dev', 'International', 'Voluptas ipsum harum', 'Pune', 'nybimazihu.com', 'John', 'John@gmail.com', '9018273645', '2024-08-07', 'warren@dbcegoa.ac.in'),
(4, 'Remote Softwares', 'C_id_4.jpeg', 'Software Testing', 'International', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. \r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Pune', 'www.remotesoftwares.com', 'John', 'John@gmail.com', '9018273645', '2024-08-07', 'warren@dbcegoa.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `deletedstudents`
--

CREATE TABLE `deletedstudents` (
  `S_College_Email` varchar(255) NOT NULL,
  `S_Fname` varchar(255) DEFAULT NULL,
  `S_Mname` varchar(255) DEFAULT NULL,
  `S_Lname` varchar(255) DEFAULT NULL,
  `S_Personal_Email` varchar(255) DEFAULT NULL,
  `S_Address` text DEFAULT NULL,
  `S_Phone_no` varchar(20) DEFAULT NULL,
  `S_Roll_no` varchar(50) DEFAULT NULL,
  `S_PR_No` varchar(50) DEFAULT NULL,
  `S_10th_Perc` decimal(5,2) DEFAULT NULL,
  `S_12th_Perc` decimal(5,2) DEFAULT NULL,
  `S_Password` varchar(255) DEFAULT NULL,
  `S_Resume` varchar(255) DEFAULT NULL,
  `S_Profile_pic` varchar(255) DEFAULT NULL,
  `S_10th_marksheet` varchar(255) DEFAULT NULL,
  `S_12th_marksheet` varchar(255) DEFAULT NULL,
  `S_Class_id` int(11) DEFAULT NULL,
  `S_Year_of_Admission` year(4) DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `PLACED` varchar(10) DEFAULT NULL,
  `registration_complete` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Dept_id` int(11) NOT NULL,
  `Dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Dept_id`, `Dept_name`) VALUES
(1, 'COMP'),
(2, 'MECH'),
(3, 'ECS'),
(4, 'CIVIL');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `C_id` int(11) NOT NULL,
  `S_College_Email` varchar(255) NOT NULL,
  `Message` text DEFAULT NULL,
  `Message_Date` date DEFAULT current_timestamp(),
  `Rating` int(11) DEFAULT 0,
  `J_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`C_id`, `S_College_Email`, `Message`, `Message_Date`, `Rating`, `J_id`) VALUES
(3, '2114018@dbcegoa.ac.in', 'Interview Process Was Good', '2024-09-29', 5, 96);

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `S_College_Email` varchar(255) NOT NULL,
  `J_id` int(11) NOT NULL,
  `Interest` tinyint(1) NOT NULL,
  `Offer_Letter` varchar(255) NOT NULL,
  `J_apply_date` date NOT NULL DEFAULT current_timestamp(),
  `placed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobapplication`
--

INSERT INTO `jobapplication` (`S_College_Email`, `J_id`, `Interest`, `Offer_Letter`, `J_apply_date`, `placed`) VALUES
('2112001@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112002@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112003@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112004@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112005@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112006@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112007@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112008@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112009@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112010@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112011@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112012@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112013@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112014@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112015@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112016@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112017@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112018@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112019@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2112020@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114001@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114002@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114002@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114003@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114004@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114004@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114005@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114006@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114006@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114007@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114008@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114008@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114009@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114010@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114010@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114011@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114012@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114012@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114013@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114014@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114014@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114015@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114016@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114016@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114017@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114018@dbcegoa.ac.in', 96, 1, '', '2024-09-29', 1),
('2114018@dbcegoa.ac.in', 97, 1, '', '2024-09-30', 1),
('2114019@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2114020@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2114020@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115001@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115001@dbcegoa.ac.in', 97, 1, '', '2024-09-30', 1),
('2115002@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115003@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115003@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115004@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115005@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115005@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115006@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115007@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115007@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115008@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115009@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115009@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115010@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115011@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115011@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115012@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115013@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115013@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115014@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115015@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115015@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115016@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115017@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115017@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115018@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115019@dbcegoa.ac.in', 96, 0, '', '2024-09-29', 0),
('2115019@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2115020@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118001@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118002@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118003@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118004@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118005@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118006@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118007@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118008@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118009@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118010@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118011@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118012@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118013@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118014@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118015@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118016@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118017@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118018@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118019@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0),
('2118020@dbcegoa.ac.in', 97, 0, '', '2024-09-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobdepartments`
--

CREATE TABLE `jobdepartments` (
  `J_id` int(11) NOT NULL,
  `Dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobdepartments`
--

INSERT INTO `jobdepartments` (`J_id`, `Dept_id`) VALUES
(96, 1),
(96, 3),
(97, 1),
(97, 2),
(97, 3),
(97, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jobplacements`
--

CREATE TABLE `jobplacements` (
  `J_id` int(11) NOT NULL,
  `J_Position` varchar(255) NOT NULL,
  `J_Backlogs_allowed` tinyint(1) DEFAULT NULL,
  `J_Description` text DEFAULT NULL,
  `J_Due_date` date DEFAULT NULL,
  `J_Offered_salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `J_Req_cgpa` decimal(4,2) DEFAULT NULL,
  `J_No_of_posts` int(11) DEFAULT NULL,
  `Accept_Responses` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobplacements`
--

INSERT INTO `jobplacements` (`J_id`, `J_Position`, `J_Backlogs_allowed`, `J_Description`, `J_Due_date`, `J_Offered_salary`, `J_Req_cgpa`, `J_No_of_posts`, `Accept_Responses`) VALUES
(96, 'Junior Developer', NULL, 'Test IVP Drive', '2024-10-25', 500000.00, 0.00, 5, 0),
(97, 'Trainee Software Engineer', NULL, 'Test 2', '2024-10-17', 350000.00, 0.00, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobposting`
--

CREATE TABLE `jobposting` (
  `PC_Email` varchar(255) DEFAULT NULL,
  `C_id` int(11) DEFAULT NULL,
  `J_id` int(11) NOT NULL,
  `Job_Post_Date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobposting`
--

INSERT INTO `jobposting` (`PC_Email`, `C_id`, `J_id`, `Job_Post_Date`) VALUES
('warren@dbcegoa.ac.in', 3, 96, '2024-09-29'),
('warren@dbcegoa.ac.in', 4, 97, '2024-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `jobquestions`
--

CREATE TABLE `jobquestions` (
  `JobQuestion_ID` int(11) NOT NULL,
  `Job_ID` int(11) DEFAULT NULL,
  `Question_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobquestions`
--

INSERT INTO `jobquestions` (`JobQuestion_ID`, `Job_ID`, `Question_ID`) VALUES
(42, 96, 6),
(43, 96, 7),
(44, 97, 7);

-- --------------------------------------------------------

--
-- Table structure for table `notificationdetails`
--

CREATE TABLE `notificationdetails` (
  `Notification_ID` int(11) NOT NULL,
  `PC_Email` varchar(255) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Attachment1` varchar(255) DEFAULT NULL,
  `Attachment2` varchar(255) DEFAULT NULL,
  `Notification_Due_Date` date DEFAULT NULL,
  `Notification_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_table`
--

CREATE TABLE `otp_table` (
  `otp_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `placementcoordinator`
--

CREATE TABLE `placementcoordinator` (
  `PC_Email` varchar(255) NOT NULL,
  `PC_Fname` varchar(255) NOT NULL,
  `PC_Mname` varchar(255) NOT NULL,
  `PC_Lname` varchar(255) NOT NULL,
  `PC_Password` varchar(255) NOT NULL,
  `PC_Contact_no` varchar(20) NOT NULL,
  `PC_Profile_pic` varchar(255) NOT NULL,
  `PC_Dept_id` int(11) DEFAULT NULL,
  `PC_Status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placementcoordinator`
--

INSERT INTO `placementcoordinator` (`PC_Email`, `PC_Fname`, `PC_Mname`, `PC_Lname`, `PC_Password`, `PC_Contact_no`, `PC_Profile_pic`, `PC_Dept_id`, `PC_Status`) VALUES
('jog@dbcegoa.ac.in', 'Bliss', '', 'Rodrigues', '$2y$10$uAM8VNGeRgoD8Lm0TTND.e3r8Y/s2Z6F7taqjKV79jH2gq/HPe31y', '9745628515', 'jog', 1, 'active'),
('prachi@dbcegoa.ac.in', 'Siddhart', '', 'Desai', 'par@123', '9745628890', 'prachi', 4, 'active'),
('sachin@dbcegoa.ac.in', 'Sachin', '', 'Damodar', 'dam@123', '9745628516', 'sachin', 2, 'active'),
('warren@dbcegoa.ac.in', 'Warren', 'Lester', 'Dias', '$2y$10$ARIQEz5L9z/.FUYTxvCub.oSMiDxCA7o1eu.lm8/xcHchf35zvLLq', '9745628514', 'warren@dbcegoa.ac.in.jpg', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Question_ID` int(11) NOT NULL,
  `Question_Text` varchar(255) NOT NULL,
  `Is_Deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Question_ID`, `Question_Text`, `Is_Deleted`) VALUES
(6, 'Do Your Relatives Work in the Company ? (Yes/No)', 0),
(7, 'Are you ready to work outside Goa ? (Yes/No)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `S_College_Email` varchar(255) NOT NULL,
  `Sem1_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem2_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem3_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem4_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem5_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem6_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem7_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Sem8_SGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `CGPA` decimal(4,2) NOT NULL DEFAULT 0.00,
  `has_backlogs` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`S_College_Email`, `Sem1_SGPA`, `Sem2_SGPA`, `Sem3_SGPA`, `Sem4_SGPA`, `Sem5_SGPA`, `Sem6_SGPA`, `Sem7_SGPA`, `Sem8_SGPA`, `CGPA`, `has_backlogs`) VALUES
('2112001@dbcegoa.ac.in', 8.50, 8.20, 7.00, 6.50, 0.00, 7.30, 0.00, 0.00, 7.50, 1),
('2112002@dbcegoa.ac.in', 9.00, 8.80, 8.50, 8.20, 7.90, 0.00, 0.00, 0.00, 8.50, 0),
('2112003@dbcegoa.ac.in', 7.50, 6.90, 5.00, 0.00, 6.00, 0.00, 0.00, 0.00, 6.10, 1),
('2112004@dbcegoa.ac.in', 8.80, 8.20, 7.60, 6.90, 7.00, 7.40, 0.00, 0.00, 7.60, 0),
('2112005@dbcegoa.ac.in', 7.90, 8.00, 7.50, 7.00, 7.80, 0.00, 0.00, 0.00, 7.50, 0),
('2112006@dbcegoa.ac.in', 8.70, 8.50, 7.50, 7.20, 7.90, 0.00, 0.00, 0.00, 8.00, 0),
('2112007@dbcegoa.ac.in', 7.40, 7.00, 5.90, 0.00, 6.30, 0.00, 0.00, 0.00, 6.70, 1),
('2112008@dbcegoa.ac.in', 8.60, 8.30, 7.80, 7.40, 7.50, 0.00, 0.00, 0.00, 7.60, 0),
('2112009@dbcegoa.ac.in', 6.50, 5.70, 0.00, 0.00, 6.10, 0.00, 0.00, 0.00, 5.80, 1),
('2112010@dbcegoa.ac.in', 8.00, 8.50, 8.20, 0.00, 8.10, 0.00, 0.00, 0.00, 8.10, 0),
('2112011@dbcegoa.ac.in', 8.20, 8.10, 7.00, 7.30, 0.00, 7.60, 0.00, 0.00, 7.50, 0),
('2112012@dbcegoa.ac.in', 9.00, 8.80, 8.40, 8.00, 0.00, 8.20, 0.00, 0.00, 8.50, 0),
('2112013@dbcegoa.ac.in', 7.10, 7.50, 6.80, 0.00, 7.00, 0.00, 0.00, 0.00, 6.70, 1),
('2112014@dbcegoa.ac.in', 8.30, 8.10, 8.00, 0.00, 8.10, 0.00, 0.00, 0.00, 8.20, 0),
('2112015@dbcegoa.ac.in', 8.60, 8.50, 0.00, 0.00, 7.50, 0.00, 0.00, 0.00, 8.00, 0),
('2112016@dbcegoa.ac.in', 8.40, 7.90, 7.80, 7.60, 0.00, 7.90, 0.00, 0.00, 7.80, 0),
('2112017@dbcegoa.ac.in', 9.00, 8.60, 8.00, 0.00, 8.50, 0.00, 0.00, 0.00, 8.30, 0),
('2112018@dbcegoa.ac.in', 6.00, 5.50, 5.80, 0.00, 5.70, 0.00, 0.00, 0.00, 5.60, 1),
('2112019@dbcegoa.ac.in', 7.80, 8.10, 8.20, 0.00, 0.00, 0.00, 0.00, 0.00, 7.60, 0),
('2112020@dbcegoa.ac.in', 8.20, 8.00, 8.00, 0.00, 8.00, 0.00, 0.00, 0.00, 8.00, 0),
('2114001@dbcegoa.ac.in', 8.90, 8.20, 5.00, 0.00, 7.00, 6.30, 0.00, 0.00, 7.00, 1),
('2114002@dbcegoa.ac.in', 9.10, 8.50, 7.20, 6.00, 7.80, 0.00, 0.00, 0.00, 7.40, 0),
('2114003@dbcegoa.ac.in', 7.50, 8.00, 7.80, 7.00, 6.90, 7.10, 0.00, 0.00, 7.20, 0),
('2114004@dbcegoa.ac.in', 8.00, 7.50, 6.90, 7.20, 7.80, 0.00, 0.00, 0.00, 7.40, 1),
('2114005@dbcegoa.ac.in', 7.90, 8.10, 6.00, 7.00, 0.00, 7.30, 0.00, 0.00, 7.20, 1),
('2114006@dbcegoa.ac.in', 8.50, 9.00, 8.70, 8.20, 8.10, 8.00, 0.00, 0.00, 8.40, 0),
('2114007@dbcegoa.ac.in', 7.40, 7.80, 6.20, 0.00, 6.80, 7.00, 0.00, 0.00, 7.00, 1),
('2114008@dbcegoa.ac.in', 9.00, 8.90, 8.50, 8.30, 8.10, 7.80, 0.00, 0.00, 8.40, 0),
('2114009@dbcegoa.ac.in', 6.90, 7.00, 5.00, 0.00, 6.30, 6.80, 0.00, 0.00, 6.00, 0),
('2114010@dbcegoa.ac.in', 8.30, 7.90, 7.50, 6.80, 7.40, 7.00, 0.00, 0.00, 7.50, 0),
('2114011@dbcegoa.ac.in', 7.80, 8.00, 7.20, 6.90, 0.00, 7.10, 0.00, 0.00, 7.40, 1),
('2114012@dbcegoa.ac.in', 8.10, 8.40, 8.20, 8.00, 7.90, 7.50, 0.00, 0.00, 8.00, 0),
('2114013@dbcegoa.ac.in', 7.30, 6.90, 6.00, 7.00, 0.00, 6.70, 0.00, 0.00, 6.80, 0),
('2114014@dbcegoa.ac.in', 9.20, 9.00, 8.70, 8.90, 8.30, 8.10, 0.00, 0.00, 8.70, 0),
('2114015@dbcegoa.ac.in', 6.80, 7.00, 5.00, 0.00, 6.50, 6.90, 0.00, 0.00, 6.40, 0),
('2114016@dbcegoa.ac.in', 8.90, 9.20, 8.80, 8.70, 8.10, 7.90, 0.00, 0.00, 8.60, 0),
('2114017@dbcegoa.ac.in', 7.60, 7.40, 6.80, 6.50, 0.00, 6.90, 0.00, 0.00, 6.80, 0),
('2114018@dbcegoa.ac.in', 9.10, 9.00, 8.50, 8.30, 8.00, 7.70, 0.00, 0.00, 8.40, 0),
('2114019@dbcegoa.ac.in', 7.40, 7.20, 6.50, 6.80, 7.00, 0.00, 0.00, 0.00, 6.80, 0),
('2114020@dbcegoa.ac.in', 8.00, 8.20, 7.50, 7.20, 7.80, 7.00, 0.00, 0.00, 7.60, 0),
('2115001@dbcegoa.ac.in', 8.90, 8.50, 7.00, 0.00, 6.70, 7.30, 0.00, 0.00, 7.50, 1),
('2115002@dbcegoa.ac.in', 9.10, 8.80, 8.40, 8.00, 7.60, 0.00, 0.00, 0.00, 8.30, 0),
('2115003@dbcegoa.ac.in', 6.80, 7.00, 5.00, 0.00, 6.50, 0.00, 0.00, 0.00, 6.30, 1),
('2115004@dbcegoa.ac.in', 9.50, 9.00, 8.90, 0.00, 8.00, 0.00, 0.00, 0.00, 8.30, 0),
('2115005@dbcegoa.ac.in', 8.60, 8.40, 7.80, 7.90, 0.00, 0.00, 0.00, 0.00, 8.10, 0),
('2115006@dbcegoa.ac.in', 7.50, 7.60, 0.00, 0.00, 6.80, 0.00, 0.00, 0.00, 7.00, 1),
('2115007@dbcegoa.ac.in', 8.20, 8.50, 8.30, 7.90, 7.00, 0.00, 0.00, 0.00, 8.20, 0),
('2115008@dbcegoa.ac.in', 6.50, 7.00, 5.50, 6.00, 0.00, 0.00, 0.00, 0.00, 6.00, 1),
('2115009@dbcegoa.ac.in', 9.20, 9.50, 0.00, 8.40, 7.50, 0.00, 0.00, 0.00, 8.10, 0),
('2115010@dbcegoa.ac.in', 8.00, 8.10, 0.00, 0.00, 7.20, 0.00, 0.00, 0.00, 7.50, 1),
('2115011@dbcegoa.ac.in', 8.80, 8.60, 8.30, 7.80, 8.10, 0.00, 0.00, 0.00, 8.40, 0),
('2115012@dbcegoa.ac.in', 9.00, 9.20, 8.90, 0.00, 8.50, 0.00, 0.00, 0.00, 8.40, 0),
('2115013@dbcegoa.ac.in', 8.30, 8.40, 0.00, 7.20, 6.90, 0.00, 0.00, 0.00, 7.50, 1),
('2115014@dbcegoa.ac.in', 8.70, 9.00, 0.00, 0.00, 8.00, 0.00, 0.00, 0.00, 8.20, 0),
('2115015@dbcegoa.ac.in', 7.80, 7.60, 8.00, 8.50, 0.00, 0.00, 0.00, 0.00, 7.80, 0),
('2115016@dbcegoa.ac.in', 8.60, 8.50, 8.30, 8.10, 7.00, 0.00, 0.00, 0.00, 8.20, 0),
('2115017@dbcegoa.ac.in', 9.20, 9.30, 8.70, 0.00, 8.00, 0.00, 0.00, 0.00, 8.40, 0),
('2115018@dbcegoa.ac.in', 7.90, 8.20, 7.60, 0.00, 7.50, 0.00, 0.00, 0.00, 7.80, 1),
('2115019@dbcegoa.ac.in', 9.50, 9.00, 8.50, 8.30, 0.00, 0.00, 0.00, 0.00, 8.50, 0),
('2115020@dbcegoa.ac.in', 9.10, 9.40, 9.20, 0.00, 9.00, 0.00, 0.00, 0.00, 9.00, 0),
('2118001@dbcegoa.ac.in', 9.00, 8.70, 8.20, 0.00, 7.50, 0.00, 0.00, 0.00, 8.20, 0),
('2118002@dbcegoa.ac.in', 6.70, 6.50, 5.00, 0.00, 6.50, 0.00, 0.00, 0.00, 6.30, 1),
('2118003@dbcegoa.ac.in', 9.50, 8.80, 8.30, 9.00, 8.60, 0.00, 0.00, 0.00, 8.60, 0),
('2118004@dbcegoa.ac.in', 8.90, 9.00, 8.00, 0.00, 7.20, 0.00, 0.00, 0.00, 8.40, 0),
('2118005@dbcegoa.ac.in', 7.50, 6.90, 5.50, 0.00, 6.00, 0.00, 0.00, 0.00, 6.50, 1),
('2118006@dbcegoa.ac.in', 8.00, 8.10, 7.00, 0.00, 7.80, 0.00, 0.00, 0.00, 7.60, 0),
('2118007@dbcegoa.ac.in', 9.10, 8.50, 8.00, 0.00, 8.20, 0.00, 0.00, 0.00, 8.50, 0),
('2118008@dbcegoa.ac.in', 9.30, 9.00, 9.00, 0.00, 9.10, 0.00, 0.00, 0.00, 9.00, 0),
('2118009@dbcegoa.ac.in', 7.80, 7.50, 6.00, 0.00, 7.00, 0.00, 0.00, 0.00, 7.50, 1),
('2118010@dbcegoa.ac.in', 8.50, 8.60, 7.50, 0.00, 7.80, 0.00, 0.00, 0.00, 7.90, 0),
('2118011@dbcegoa.ac.in', 6.90, 6.50, 6.00, 0.00, 6.70, 0.00, 0.00, 0.00, 6.60, 1),
('2118012@dbcegoa.ac.in', 9.00, 8.90, 8.50, 9.20, 8.80, 0.00, 0.00, 0.00, 8.70, 0),
('2118013@dbcegoa.ac.in', 7.00, 6.50, 7.50, 0.00, 6.50, 0.00, 0.00, 0.00, 6.60, 1),
('2118014@dbcegoa.ac.in', 8.20, 8.50, 9.00, 0.00, 8.00, 0.00, 0.00, 0.00, 8.40, 0),
('2118015@dbcegoa.ac.in', 7.50, 7.80, 7.00, 0.00, 7.20, 0.00, 0.00, 0.00, 7.40, 1),
('2118016@dbcegoa.ac.in', 9.10, 9.20, 8.90, 0.00, 9.00, 0.00, 0.00, 0.00, 8.90, 0),
('2118017@dbcegoa.ac.in', 6.00, 6.50, 5.00, 0.00, 6.00, 0.00, 0.00, 0.00, 5.80, 1),
('2118018@dbcegoa.ac.in', 8.60, 8.90, 8.50, 0.00, 8.30, 0.00, 0.00, 0.00, 8.50, 0),
('2118019@dbcegoa.ac.in', 9.50, 9.00, 8.90, 0.00, 9.10, 0.00, 0.00, 0.00, 9.00, 0),
('2118020@dbcegoa.ac.in', 7.00, 6.80, 6.50, 0.00, 7.50, 0.00, 0.00, 0.00, 6.80, 1),
('2224001@dbcegoa.ac.in', 8.90, 8.20, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7.00, 1),
('2224002@dbcegoa.ac.in', 7.50, 6.80, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6.20, 1),
('2224003@dbcegoa.ac.in', 8.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6.00, 1),
('2224004@dbcegoa.ac.in', 9.00, 8.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7.70, 0),
('2224005@dbcegoa.ac.in', 6.50, 7.20, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6.20, 1),
('2224006@dbcegoa.ac.in', 8.70, 7.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7.10, 0),
('2224007@dbcegoa.ac.in', 8.40, 8.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7.40, 0),
('2224008@dbcegoa.ac.in', 5.00, 6.20, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5.60, 1),
('2224009@dbcegoa.ac.in', 7.30, 7.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6.70, 0),
('2224010@dbcegoa.ac.in', 0.00, 8.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `R_id` int(11) NOT NULL,
  `J_id` int(11) DEFAULT NULL,
  `Round_no` int(11) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`R_id`, `J_id`, `Round_no`, `Location`, `Link`, `Time`, `Date`, `Description`) VALUES
(24, 96, 1, 'Seminar Hall', '', '11:50:00', '2024-09-30', 'Test Round 1'),
(25, 97, 1, 'Online', 'meet.google.com', '15:02:00', '2024-10-04', 'Online Coding Round'),
(26, 97, 2, 'Seminar Hall', '', '17:03:00', '2024-10-20', 'HR Interview');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `S_College_Email` varchar(255) NOT NULL,
  `S_Fname` varchar(255) NOT NULL,
  `S_Mname` varchar(255) NOT NULL,
  `S_Lname` varchar(255) NOT NULL,
  `S_Personal_Email` varchar(255) NOT NULL,
  `S_Address` text NOT NULL,
  `S_Phone_no` varchar(20) NOT NULL,
  `S_Roll_no` varchar(50) NOT NULL,
  `S_PR_No` varchar(50) NOT NULL,
  `S_10th_Perc` decimal(5,2) NOT NULL,
  `S_12th_Perc` decimal(5,2) NOT NULL,
  `S_Password` varchar(255) NOT NULL,
  `S_Resume` varchar(255) NOT NULL,
  `S_Profile_pic` varchar(255) NOT NULL,
  `S_10th_marksheet` varchar(255) NOT NULL,
  `S_12th_marksheet` varchar(255) NOT NULL,
  `S_Class_id` int(11) DEFAULT NULL,
  `S_Year_of_Admission` year(4) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `PLACED` int(10) NOT NULL DEFAULT 0,
  `registration_complete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`S_College_Email`, `S_Fname`, `S_Mname`, `S_Lname`, `S_Personal_Email`, `S_Address`, `S_Phone_no`, `S_Roll_no`, `S_PR_No`, `S_10th_Perc`, `S_12th_Perc`, `S_Password`, `S_Resume`, `S_Profile_pic`, `S_10th_marksheet`, `S_12th_marksheet`, `S_Class_id`, `S_Year_of_Admission`, `Gender`, `PLACED`, `registration_complete`) VALUES
('2112001@dbcegoa.ac.in', 'John', 'A.', 'Doe', 'john.doe@gmail.com', 'Margao, Goa', '9876543210', '2112001', '202111100', 86.50, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112002@dbcegoa.ac.in', 'Sarah', '', 'Fernandes', 'sarah.fernandes@gmail.com', 'Vasco, Goa', '9876543211', '2112002', '202111101', 85.00, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112003@dbcegoa.ac.in', 'Michael', 'B.', 'Rodrigues', 'michael.rodrigues@gmail.com', 'Panaji, Goa', '9876543212', '2112003', '202111102', 78.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112004@dbcegoa.ac.in', 'Julia', '', 'Pereira', 'julia.pereira@gmail.com', 'Panjim, Goa', '9876543213', '2112004', '202111103', 83.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112005@dbcegoa.ac.in', 'David', '', 'Silva', 'david.silva@gmail.com', 'Ponda, Goa', '9876543214', '2112005', '202111104', 84.00, 85.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112006@dbcegoa.ac.in', 'Sophia', '', 'Mendez', 'sophia.mendez@gmail.com', 'Bicholim, Goa', '9876543215', '2112006', '202111105', 88.00, 92.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112007@dbcegoa.ac.in', 'Matthew', '', 'Rao', 'matthew.rao@gmail.com', 'Bardez, Goa', '9876543216', '2112007', '202111106', 79.00, 81.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112008@dbcegoa.ac.in', 'Emma', '', 'Verma', 'emma.verma@gmail.com', 'Mapusa, Goa', '9876543217', '2112008', '202111107', 85.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112009@dbcegoa.ac.in', 'Joshua', '', 'Khan', 'joshua.khan@gmail.com', 'Sanguem, Goa', '9876543218', '2112009', '202111108', 82.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112010@dbcegoa.ac.in', 'Olivia', '', 'Melo', 'olivia.melo@gmail.com', 'Cortalim, Goa', '9876543219', '2112010', '202111109', 89.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112011@dbcegoa.ac.in', 'Jacob', '', 'Gomes', 'jacob.gomes@gmail.com', 'Pernem, Goa', '9876543220', '2112011', '202111110', 87.00, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112012@dbcegoa.ac.in', 'Ella', '', 'Fernandes', 'ella.fernandes@gmail.com', 'Quepem, Goa', '9876543221', '2112012', '202111111', 84.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112013@dbcegoa.ac.in', 'Ethan', '', 'Almeida', 'ethan.almeida@gmail.com', 'Saligao, Goa', '9876543222', '2112013', '202111112', 86.50, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112014@dbcegoa.ac.in', 'Grace', '', 'Naik', 'grace.naik@gmail.com', 'Ponda, Goa', '9876543223', '2112014', '202111113', 79.50, 80.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112015@dbcegoa.ac.in', 'Daniel', '', 'Pinto', 'daniel.pinto@gmail.com', 'Bardez, Goa', '9876543224', '2112015', '202111114', 88.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112016@dbcegoa.ac.in', 'Ava', '', 'Fernandes', 'ava.fernandes@gmail.com', 'Cortalim, Goa', '9876543225', '2112016', '202111115', 86.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112017@dbcegoa.ac.in', 'Lucas', '', 'Sharma', 'lucas.sharma@gmail.com', 'Dona Paula, Goa', '9876543226', '2112017', '202111116', 87.00, 89.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112018@dbcegoa.ac.in', 'Mia', '', 'Fernandes', 'mia.fernandes@gmail.com', 'Mapusa, Goa', '9876543227', '2112018', '202111117', 82.00, 84.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2112019@dbcegoa.ac.in', 'Alexander', '', 'DSouza', 'alexander.dsouza@gmail.com', 'Verna, Goa', '9876543228', '2112019', '202111118', 80.00, 81.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112020@dbcegoa.ac.in', 'Chloe', '', 'Fernandes', 'chloe.fernandes@gmail.com', 'Margao, Goa', '9876543229', '2112020', '202111119', 84.50, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2114001@dbcegoa.ac.in', 'Gavin', 'Romaldo', 'Da Costa', 'gavindacosta9307@gmail.com', 'Guirdolim Goa', '9307325976', '2114001', '202111349', 72.60, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114002@dbcegoa.ac.in', 'Sarah', '', 'Fernandes', 'sarahfernandes1999@gmail.com', 'Margao Goa', '9822154785', '2114002', '202111350', 75.30, 88.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114003@dbcegoa.ac.in', 'Nathan', 'Terrence', 'Pereira', 'nathanpereira123@gmail.com', 'Benaulim Goa', '7876541239', '2114003', '202111351', 68.90, 82.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114004@dbcegoa.ac.in', 'Ana', '', 'Rodrigues', 'anarodrigues@mail.com', 'Panaji Goa', '9900876543', '2114004', '202111352', 70.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114005@dbcegoa.ac.in', 'Ivan', '', 'Menezes', 'ivanmenezes123@gmail.com', 'Ponda Goa', '8995643275', '2114005', '202111353', 65.80, 79.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114006@dbcegoa.ac.in', 'Maria', 'Benita', 'Sequeira', 'mariasequeira@mail.com', 'Vasco Goa', '9900432187', '2114006', '202111354', 80.20, 92.70, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114007@dbcegoa.ac.in', 'John', 'Matthew', 'Dias', 'johndias7@gmail.com', 'Colva Goa', '9812347654', '2114007', '202111355', 73.50, 85.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114008@dbcegoa.ac.in', 'Emily', '', 'D\'Souza', 'emilydsouza45@gmail.com', 'Salcete Goa', '9900035472', '2114008', '202111356', 76.20, 88.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114009@dbcegoa.ac.in', 'Alex', '', 'De Souza', 'alexdesouza99@gmail.com', 'Fatorda Goa', '9876543210', '2114009', '202111357', 78.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114010@dbcegoa.ac.in', 'Nicole', '', 'Fernandes', 'nicolefernandes77@gmail.com', 'Mapusa Goa', '9871234567', '2114010', '202111358', 80.30, 91.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114011@dbcegoa.ac.in', 'Daniel', '', 'Lopes', 'daniellopes@gmail.com', 'Candolim Goa', '9901245678', '2114011', '202111359', 69.70, 82.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114012@dbcegoa.ac.in', 'Sophie', '', 'Carvalho', 'sophiecarvalho21@gmail.com', 'Cortalim Goa', '9812378945', '2114012', '202111360', 75.10, 86.90, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114013@dbcegoa.ac.in', 'Ryan', '', 'Fernandes', 'ryanfernandes007@gmail.com', 'Verna Goa', '9321457890', '2114013', '202111361', 74.90, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114014@dbcegoa.ac.in', 'Jessica', '', 'Silva', 'jessicasilva95@gmail.com', 'Porvorim Goa', '9901324578', '2114014', '202111362', 78.50, 89.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114015@dbcegoa.ac.in', 'Ethan', '', 'Noronha', 'ethannoronha99@gmail.com', 'Calangute Goa', '9822351479', '2114015', '202111363', 65.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114016@dbcegoa.ac.in', 'Sophia', '', 'Pinto', 'sophiapinto22@gmail.com', 'Assagao Goa', '9312456987', '2114016', '202111364', 80.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114017@dbcegoa.ac.in', 'Leon', '', 'Fernandes', 'leonfernandes100@gmail.com', 'Colvale Goa', '9876549321', '2114017', '202111365', 72.40, 87.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114018@dbcegoa.ac.in', 'Olivia', '', 'Dias', 'oliviadias93@gmail.com', 'Betalbatim Goa', '9991256347', '2114018', '202111366', 77.50, 89.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', '2114018.jpg', '', '', 2, '2021', 'F', 1, 1),
('2114019@dbcegoa.ac.in', 'David', 'Gregory', 'Martins', 'davidmartins98@gmail.com', 'Anjuna Goa', '9875632148', '2114019', '202111367', 79.20, 90.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114020@dbcegoa.ac.in', 'Grace', '', 'Costa', 'gracecosta01@gmail.com', 'Cansaulim Goa', '9876543712', '2114020', '202111368', 73.60, 87.90, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2115001@dbcegoa.ac.in', 'Alice', '', 'D\'Souza', 'alice.dsouza@gmail.com', 'Mapusa, Goa', '9876543220', '2115001', '202111200', 87.00, 89.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 1, 1),
('2115002@dbcegoa.ac.in', 'Brian', 'C.', 'Gomes', 'brian.gomes@gmail.com', 'Vasco, Goa', '9876543221', '2115002', '202111201', 85.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115003@dbcegoa.ac.in', 'Christine', '', 'Fernandes', 'christine.fernandes@gmail.com', 'Panjim, Goa', '9876543222', '2115003', '202111202', 80.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115004@dbcegoa.ac.in', 'David', '', 'Menezes', 'david.menezes@gmail.com', 'Margao, Goa', '9876543223', '2115004', '202111203', 90.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115005@dbcegoa.ac.in', 'Eva', '', 'Almeida', 'eva.almeida@gmail.com', 'Panjim, Goa', '9876543224', '2115005', '202111204', 86.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115006@dbcegoa.ac.in', 'Frank', '', 'Fernandes', 'frank.fernandes@gmail.com', 'Bardez, Goa', '9876543225', '2115006', '202111205', 80.00, 83.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115007@dbcegoa.ac.in', 'Grace', '', 'Nunes', 'grace.nunes@gmail.com', 'Mapusa, Goa', '9876543226', '2115007', '202111206', 88.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115008@dbcegoa.ac.in', 'Henry', '', 'Khan', 'henry.khan@gmail.com', 'Vasco, Goa', '9876543227', '2115008', '202111207', 75.00, 78.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115009@dbcegoa.ac.in', 'Isabella', '', 'Fernandes', 'isabella.fernandes@gmail.com', 'Panjim, Goa', '9876543228', '2115009', '202111208', 82.00, 84.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115010@dbcegoa.ac.in', 'James', '', 'Gomes', 'james.gomes@gmail.com', 'Margao, Goa', '9876543229', '2115010', '202111209', 78.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115011@dbcegoa.ac.in', 'Kate', '', 'Almeida', 'kate.almeida@gmail.com', 'Dona Paula, Goa', '9876543230', '2115011', '202111210', 84.50, 86.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115012@dbcegoa.ac.in', 'Liam', '', 'Rodrigues', 'liam.rodrigues@gmail.com', 'Vasco, Goa', '9876543231', '2115012', '202111211', 88.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115013@dbcegoa.ac.in', 'Mia', '', 'D\'Souza', 'mia.dsouza@gmail.com', 'Mapusa, Goa', '9876543232', '2115013', '202111212', 79.00, 81.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115014@dbcegoa.ac.in', 'Noah', '', 'Fernandes', 'noah.fernandes@gmail.com', 'Bardez, Goa', '9876543233', '2115014', '202111213', 85.50, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115015@dbcegoa.ac.in', 'Olivia', '', 'Menezes', 'olivia.menezes@gmail.com', 'Margao, Goa', '9876543234', '2115015', '202111214', 83.00, 85.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115016@dbcegoa.ac.in', 'Paul', '', 'Khan', 'paul.khan@gmail.com', 'Vasco, Goa', '9876543235', '2115016', '202111215', 89.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115017@dbcegoa.ac.in', 'Quinn', '', 'Almeida', 'quinn.almeida@gmail.com', 'Panjim, Goa', '9876543236', '2115017', '202111216', 85.00, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115018@dbcegoa.ac.in', 'Ryan', '', 'Gomes', 'ryan.gomes@gmail.com', 'Mapusa, Goa', '9876543237', '2115018', '202111217', 80.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2115019@dbcegoa.ac.in', 'Sophie', '', 'Fernandes', 'sophie.fernandes@gmail.com', 'Vasco, Goa', '9876543238', '2115019', '202111218', 88.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2115020@dbcegoa.ac.in', 'Thomas', '', 'Rodrigues', 'thomas.rodrigues@gmail.com', 'Dona Paula, Goa', '9876543239', '2115020', '202111219', 90.00, 92.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2118001@dbcegoa.ac.in', 'Emma', '', 'Pinto', 'emma.pinto@gmail.com', 'Porvorim, Goa', '9876543230', '2118001', '202111300', 86.00, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118002@dbcegoa.ac.in', 'Liam', '', 'DSouza', 'liam.dsouza@gmail.com', 'Bambolim, Goa', '9876543231', '2118002', '202111301', 88.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118003@dbcegoa.ac.in', 'Olivia', '', 'Fernandes', 'olivia.fernandes@gmail.com', 'Margao, Goa', '9876543232', '2118003', '202111302', 92.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118004@dbcegoa.ac.in', 'Noah', '', 'Pereira', 'noah.pereira@gmail.com', 'Mapusa, Goa', '9876543233', '2118004', '202111303', 85.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118005@dbcegoa.ac.in', 'Ava', '', 'Sharma', 'ava.sharma@gmail.com', 'Dona Paula, Goa', '9876543234', '2118005', '202111304', 80.00, 81.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118006@dbcegoa.ac.in', 'Isabella', '', 'Khan', 'isabella.khan@gmail.com', 'Vasco, Goa', '9876543235', '2118006', '202111305', 78.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118007@dbcegoa.ac.in', 'Mason', '', 'Lobo', 'mason.lobo@gmail.com', 'Candolim, Goa', '9876543236', '2118007', '202111306', 88.00, 87.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118008@dbcegoa.ac.in', 'Sophia', '', 'Naik', 'sophia.naik@gmail.com', 'Panjim, Goa', '9876543237', '2118008', '202111307', 90.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118009@dbcegoa.ac.in', 'Jackson', '', 'Rao', 'jackson.rao@gmail.com', 'Vasco, Goa', '9876543238', '2118009', '202111308', 86.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118010@dbcegoa.ac.in', 'Aiden', '', 'Bhat', 'aiden.bhat@gmail.com', 'Bambolim, Goa', '9876543239', '2118010', '202111309', 89.00, 88.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118011@dbcegoa.ac.in', 'Mia', '', 'Fernandes', 'mia.fernandes@gmail.com', 'Porvorim, Goa', '9876543240', '2118011', '202111310', 87.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118012@dbcegoa.ac.in', 'Zoe', '', 'Coutinho', 'zoe.coutinho@gmail.com', 'Vasco, Goa', '9876543241', '2118012', '202111311', 83.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118013@dbcegoa.ac.in', 'Lucas', '', 'DSouza', 'lucas.dsouza@gmail.com', 'Mapusa, Goa', '9876543242', '2118013', '202111312', 84.00, 82.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118014@dbcegoa.ac.in', 'Charlotte', '', 'Rodrigues', 'charlotte.rodrigues@gmail.com', 'Vasco, Goa', '9876543243', '2118014', '202111313', 90.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118015@dbcegoa.ac.in', 'Henry', '', 'Cruz', 'henry.cruz@gmail.com', 'Porvorim, Goa', '9876543244', '2118015', '202111314', 79.00, 80.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118016@dbcegoa.ac.in', 'Evelyn', '', 'Patel', 'evelyn.patel@gmail.com', 'Panjim, Goa', '9876543245', '2118016', '202111315', 77.00, 78.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118017@dbcegoa.ac.in', 'Liam', '', 'Menon', 'liam.menon@gmail.com', 'Bambolim, Goa', '9876543246', '2118017', '202111316', 75.00, 76.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2118018@dbcegoa.ac.in', 'Ella', '', 'Kumar', 'ella.kumar@gmail.com', 'Mapusa, Goa', '9876543247', '2118018', '202111317', 83.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118019@dbcegoa.ac.in', 'Ava', '', 'Mishra', 'ava.mishra@gmail.com', 'Vasco, Goa', '9876543248', '2118019', '202111318', 80.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2118020@dbcegoa.ac.in', 'James', '', 'Sharma', 'james.sharma@gmail.com', 'Panjim, Goa', '9876543249', '2118020', '202111319', 84.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2224001@dbcegoa.ac.in', 'Bruce', '', 'Lee', 'bruce@gmail.com', 'Guirdolim Goa', '9307325976', '2224001', '202211349', 72.60, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', 0, 1),
('2224002@dbcegoa.ac.in', 'Anna', '', 'Smith', 'anna@gmail.com', 'Panjim Goa', '9307325977', '2224002', '202211350', 75.40, 88.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', 0, 1),
('2224003@dbcegoa.ac.in', 'John', '', 'Doe', 'john@gmail.com', 'Margao Goa', '9307325978', '2224003', '202211351', 68.90, 79.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', 0, 1),
('2224004@dbcegoa.ac.in', 'Linda', '', 'Johnson', 'linda@gmail.com', 'Vasco Goa', '9307325979', '2224004', '202211352', 82.10, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', 0, 1),
('2224005@dbcegoa.ac.in', 'Michael', '', 'Williams', 'michael@gmail.com', 'Bardez Goa', '9307325980', '2224005', '202211353', 90.00, 95.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', 0, 1),
('2224006@dbcegoa.ac.in', 'Emily', '', 'Davis', 'emily@gmail.com', 'Mapusa Goa', '9307325981', '2224006', '202211354', 77.80, 85.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', 0, 1),
('2224007@dbcegoa.ac.in', 'David', '', 'Brown', 'david@gmail.com', 'Sanguem Goa', '9307325982', '2224007', '202211355', 70.50, 82.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', 0, 1),
('2224008@dbcegoa.ac.in', 'Sophia', '', 'Wilson', 'sophia@gmail.com', 'Saligao Goa', '9307325983', '2224008', '202211356', 85.40, 90.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', 0, 1),
('2224009@dbcegoa.ac.in', 'James', '', 'Taylor', 'james@gmail.com', 'Porvorim Goa', '9307325984', '2224009', '202211357', 88.00, 93.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', 0, 1),
('2224010@dbcegoa.ac.in', 'Olivia', '', 'Anderson', 'olivia@gmail.com', 'Candolim Goa', '9307325985', '2224010', '202211358', 80.00, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', 0, 1);

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `after_student_delete` AFTER DELETE ON `student` FOR EACH ROW BEGIN
    INSERT INTO deletedstudents (
        S_College_Email,
        S_Fname,
        S_Mname,
        S_Lname,
        S_Personal_Email,
        S_Address,
        S_Phone_no,
        S_Roll_no,
        S_PR_No,
        S_10th_Perc,
        S_12th_Perc,
        S_Password,
        S_Resume,
        S_Profile_pic,
        S_10th_marksheet,
        S_12th_marksheet,
        S_Class_id,
        S_Year_of_Admission,
        Gender,
        PLACED,
        registration_complete,
        deleted_at
    ) VALUES (
        OLD.S_College_Email,
        OLD.S_Fname,
        OLD.S_Mname,
        OLD.S_Lname,
        OLD.S_Personal_Email,
        OLD.S_Address,
        OLD.S_Phone_no,
        OLD.S_Roll_no,
        OLD.S_PR_No,
        OLD.S_10th_Perc,
        OLD.S_12th_Perc,
        OLD.S_Password,
        OLD.S_Resume,
        OLD.S_Profile_pic,
        OLD.S_10th_marksheet,
        OLD.S_12th_marksheet,
        OLD.S_Class_id,
        OLD.S_Year_of_Admission,
        OLD.Gender,
        OLD.PLACED,
        OLD.registration_complete,
        CURRENT_TIMESTAMP
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `studentnotifications`
--

CREATE TABLE `studentnotifications` (
  `Notification_ID` int(11) DEFAULT NULL,
  `S_College_Email` varchar(255) DEFAULT NULL,
  `Dismiss_Notification` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentresponses`
--

CREATE TABLE `studentresponses` (
  `Response_ID` int(11) NOT NULL,
  `Job_ID` int(11) DEFAULT NULL,
  `Student_Email` varchar(255) DEFAULT NULL,
  `Question_ID` int(11) DEFAULT NULL,
  `Response_Text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentresponses`
--

INSERT INTO `studentresponses` (`Response_ID`, `Job_ID`, `Student_Email`, `Question_ID`, `Response_Text`) VALUES
(24, 96, '2114018@dbcegoa.ac.in', 6, 'Yes'),
(25, 96, '2114018@dbcegoa.ac.in', 7, 'No'),
(26, 97, '2114018@dbcegoa.ac.in', 7, 'Yes'),
(27, 97, '2115001@dbcegoa.ac.in', 7, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `studentrounds`
--

CREATE TABLE `studentrounds` (
  `S_College_Email` varchar(255) NOT NULL,
  `R_id` int(11) NOT NULL,
  `RoundStatus` enum('pending','rejected','passed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentrounds`
--

INSERT INTO `studentrounds` (`S_College_Email`, `R_id`, `RoundStatus`) VALUES
('2114018@dbcegoa.ac.in', 24, 'passed'),
('2114018@dbcegoa.ac.in', 25, 'passed'),
('2114018@dbcegoa.ac.in', 26, 'passed'),
('2115001@dbcegoa.ac.in', 25, 'passed'),
('2115001@dbcegoa.ac.in', 26, 'passed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_Email`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Class_id`),
  ADD KEY `Dept_id` (`Dept_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`C_id`),
  ADD KEY `C_PC_Email` (`C_PC_Email`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dept_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`C_id`,`S_College_Email`,`J_id`),
  ADD KEY `S_College_Email` (`S_College_Email`),
  ADD KEY `J_id` (`J_id`),
  ADD KEY `C_id` (`C_id`);

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`S_College_Email`,`J_id`),
  ADD KEY `J_id` (`J_id`);

--
-- Indexes for table `jobdepartments`
--
ALTER TABLE `jobdepartments`
  ADD PRIMARY KEY (`J_id`,`Dept_id`),
  ADD KEY `Dept_id` (`Dept_id`);

--
-- Indexes for table `jobplacements`
--
ALTER TABLE `jobplacements`
  ADD PRIMARY KEY (`J_id`);

--
-- Indexes for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD PRIMARY KEY (`J_id`),
  ADD KEY `PC_Email` (`PC_Email`),
  ADD KEY `C_id` (`C_id`);

--
-- Indexes for table `jobquestions`
--
ALTER TABLE `jobquestions`
  ADD PRIMARY KEY (`JobQuestion_ID`),
  ADD KEY `Job_ID` (`Job_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `PC_Email` (`PC_Email`);

--
-- Indexes for table `otp_table`
--
ALTER TABLE `otp_table`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `placementcoordinator`
--
ALTER TABLE `placementcoordinator`
  ADD PRIMARY KEY (`PC_Email`),
  ADD KEY `PC_Dept_id` (`PC_Dept_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Question_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`S_College_Email`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`R_id`),
  ADD KEY `J_id` (`J_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`S_College_Email`),
  ADD KEY `S_Class_id` (`S_Class_id`);

--
-- Indexes for table `studentnotifications`
--
ALTER TABLE `studentnotifications`
  ADD KEY `Notification_ID` (`Notification_ID`),
  ADD KEY `S_College_Email` (`S_College_Email`);

--
-- Indexes for table `studentresponses`
--
ALTER TABLE `studentresponses`
  ADD PRIMARY KEY (`Response_ID`),
  ADD UNIQUE KEY `Job_ID` (`Job_ID`,`Student_Email`,`Question_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `studentrounds`
--
ALTER TABLE `studentrounds`
  ADD PRIMARY KEY (`S_College_Email`,`R_id`),
  ADD KEY `R_id` (`R_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `Class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobplacements`
--
ALTER TABLE `jobplacements`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `jobposting`
--
ALTER TABLE `jobposting`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `jobquestions`
--
ALTER TABLE `jobquestions`
  MODIFY `JobQuestion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `otp_table`
--
ALTER TABLE `otp_table`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `studentresponses`
--
ALTER TABLE `studentresponses`
  MODIFY `Response_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Admin_Email`) REFERENCES `placementcoordinator` (`PC_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`Dept_id`) REFERENCES `department` (`Dept_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`C_PC_Email`) REFERENCES `placementcoordinator` (`PC_Email`) ON DELETE SET NULL;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `company` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`J_id`) REFERENCES `jobplacements` (`J_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD CONSTRAINT `jobapplication_ibfk_1` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobapplication_ibfk_2` FOREIGN KEY (`J_id`) REFERENCES `jobplacements` (`J_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobdepartments`
--
ALTER TABLE `jobdepartments`
  ADD CONSTRAINT `jobdepartments_ibfk_1` FOREIGN KEY (`Dept_id`) REFERENCES `department` (`Dept_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `jobdepartments_ibfk_2` FOREIGN KEY (`J_id`) REFERENCES `jobplacements` (`J_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `jobposting`
--
ALTER TABLE `jobposting`
  ADD CONSTRAINT `jobposting_ibfk_1` FOREIGN KEY (`PC_Email`) REFERENCES `placementcoordinator` (`PC_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobposting_ibfk_2` FOREIGN KEY (`C_id`) REFERENCES `company` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobquestions`
--
ALTER TABLE `jobquestions`
  ADD CONSTRAINT `jobquestions_ibfk_1` FOREIGN KEY (`Job_ID`) REFERENCES `jobplacements` (`J_id`),
  ADD CONSTRAINT `jobquestions_ibfk_2` FOREIGN KEY (`Question_ID`) REFERENCES `questions` (`Question_ID`);

--
-- Constraints for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  ADD CONSTRAINT `notificationdetails_ibfk_1` FOREIGN KEY (`PC_Email`) REFERENCES `placementcoordinator` (`PC_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placementcoordinator`
--
ALTER TABLE `placementcoordinator`
  ADD CONSTRAINT `placementcoordinator_ibfk_1` FOREIGN KEY (`PC_Dept_id`) REFERENCES `department` (`Dept_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rounds`
--
ALTER TABLE `rounds`
  ADD CONSTRAINT `rounds_ibfk_1` FOREIGN KEY (`J_id`) REFERENCES `jobplacements` (`J_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`S_Class_id`) REFERENCES `class` (`Class_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `studentnotifications`
--
ALTER TABLE `studentnotifications`
  ADD CONSTRAINT `studentnotifications_ibfk_1` FOREIGN KEY (`Notification_ID`) REFERENCES `notificationdetails` (`Notification_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentnotifications_ibfk_2` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentresponses`
--
ALTER TABLE `studentresponses`
  ADD CONSTRAINT `studentresponses_ibfk_1` FOREIGN KEY (`Job_ID`) REFERENCES `jobplacements` (`J_id`),
  ADD CONSTRAINT `studentresponses_ibfk_2` FOREIGN KEY (`Question_ID`) REFERENCES `questions` (`Question_ID`);

--
-- Constraints for table `studentrounds`
--
ALTER TABLE `studentrounds`
  ADD CONSTRAINT `studentrounds_ibfk_1` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentrounds_ibfk_2` FOREIGN KEY (`R_id`) REFERENCES `rounds` (`R_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
