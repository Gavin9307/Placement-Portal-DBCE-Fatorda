-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 01:34 AM
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
(3, 'IVP', 'C_id_3.png', 'Web DEv', 'International', 'Voluptas ipsum harum', 'Pune', 'nybimazihu.com', 'John', 'John@gmail.com', '9018273645', '2024-08-07', 'warren@dbcegoa.ac.in'),
(4, 'Remote Softw', 'C_id_4.jpeg', 'Web DEv', 'International', 'lodach abcs a iuasgci ', 'Pune', 'bshka.com', 'John', 'John@gmail.com', '9018273645', '2024-08-07', 'warren@dbcegoa.ac.in');

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

--
-- Dumping data for table `deletedstudents`
--

INSERT INTO `deletedstudents` (`S_College_Email`, `S_Fname`, `S_Mname`, `S_Lname`, `S_Personal_Email`, `S_Address`, `S_Phone_no`, `S_Roll_no`, `S_PR_No`, `S_10th_Perc`, `S_12th_Perc`, `S_Password`, `S_Resume`, `S_Profile_pic`, `S_10th_marksheet`, `S_12th_marksheet`, `S_Class_id`, `S_Year_of_Admission`, `Gender`, `PLACED`, `registration_complete`, `deleted_at`) VALUES
('2214077@dbcegoa.ac.in', 'Akansha', '', 'Naik', 'akansha@gmail.com', 'Margao Goa', '9768758452', '2214077', '202211342', 80.00, 90.00, '$2y$10$O2pA3QDbcVtsSx2WJ2jQK.ZtbnKpxnJ87QcItXf7shxrK3DPb1RaS', '', '2214077.png', '', '', 1, '2022', 'F', 'No', 1, '2024-08-28 09:52:34'),
('warren@dbcegoa.ac.in', 'Warren', '', 'Dias', 'warren@dbcegoa.ac.in', '', '9745628514', '', '', 0.00, 0.00, '$2y$10$Bqemv3im.3JD34QEBqpoYeIIY7snjdZtfcop1uqHo/.XniiA0S2sS', '', '', '', '', NULL, '0000', '', 'No', 0, '2024-09-12 00:10:01'),
('2114018@dbcegoa.ac.in', 'Gavin', 'Romaldo', 'Da Costa', 'gavindacosta9307@gmail.com', 'Guirdolim Goa', '9307325978', '2114018', '21110398', 89.03, 83.00, '$2y$10$p0EfuON9.Yy7tkB3I7rdwezuuA4uHiMtjFsEqhGMAedM0HE/HXoXW', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1, '2024-09-16 14:27:14'),
('', '', '', '', '', '', '', '', '', 0.00, 0.00, '$2y$10$r9xi.GnWsPZcXzTaRUrNu.1VkvPxuFPqDKtebOb4pZwWWlkCaaXa.', '', '', '', '', NULL, '0000', '', 'No', 0, '2024-09-16 14:41:02'),
('2112001@dbcegoa.ac.in', '', '', '', '', '', '', '', '', 0.00, 0.00, '$2y$10$/0WeP87rNmX70Wki7FY3E.ImZivTW1AbBPJWDwXKTngupZAnZn0cq', 'https://drive.google.com/file/d/1G9eGOcn_TMe5cNugDE4tqJlKoV6cA9s1/view?usp=sharing', '', '', '', NULL, '0000', '', 'No', 0, '2024-09-16 14:48:32'),
('2114053@dbcegoa.ac.in', 'Bliss', '', 'Fernandes', 'blissferns@gmail.com', 'Colva Goa', '9182736453', '2114053', '202111356', 90.00, 92.00, '$2y$10$AK8JaujJWMgUCwQGdfPErOzzoYUjSYS.975/1mL6i/fytomDVMsny', '', 'Default_Profile_Pic.jpg', '', '', 8, '2023', 'M', 'No', 1, '2024-09-16 17:16:10'),
('2114056@dbcegoa.ac.in', 'asca', 'Lester1', 'Colaco', 'anseyfernandes@gmail.com', 'Fatorda Goa', '9182736452', '2114003', '2114', 10.00, 12.00, '$2y$10$5TK4Hes9L4HUQ7niWDdS3ulKljQnWr2nBI/45SqxmpL7gfKJ2p8QC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2024', '', '0', 1, '2024-09-20 09:28:33'),
('2114053@dbcegoa.ac.in', '', '', '', '', '', '', '', '', 0.00, 0.00, '$2y$10$KqWDf/2NKWbJcq0Yxi/2kOsnnHxcbPOattD.4FoMrwL3W/MwrBxmO', '', '', '', '', NULL, '0000', '', '0', 0, '2024-09-23 23:31:25');

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
(3, '2114018@dbcegoa.ac.in', 'Hello', '2024-09-20', 3, 86);

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
('2113045@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2113046@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2113047@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114001@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114001@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114001@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114001@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114001@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114001@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114001@dbcegoa.ac.in', 76, 1, '', '2024-08-23', 0),
('2114001@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114001@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114001@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114002@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114002@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114002@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114002@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114002@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114002@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114002@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114002@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114002@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114002@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114002@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114003@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114003@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114003@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114003@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114003@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114003@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114003@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114003@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114003@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114003@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114004@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114004@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114004@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114004@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114004@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114004@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114004@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114004@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114004@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114004@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114004@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114005@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114005@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114005@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114005@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114005@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114005@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114005@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114005@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114005@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114005@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114005@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114006@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114006@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114006@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114006@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114006@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114006@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114006@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114006@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114006@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114006@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114006@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114007@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114007@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114007@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114007@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114007@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114007@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114007@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114007@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114007@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114007@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114007@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114009@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114009@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114009@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114009@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114009@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114009@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114009@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114009@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114009@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114009@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114009@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114010@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114010@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114010@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114010@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114010@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114010@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114010@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114010@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114010@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114010@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114010@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114018@dbcegoa.ac.in', 86, 1, '', '2024-09-20', 1),
('2114027@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114033@dbcegoa.ac.in', 1, 1, '', '2024-07-22', 1),
('2114033@dbcegoa.ac.in', 53, 1, '', '2024-08-07', 0),
('2114033@dbcegoa.ac.in', 64, 1, '', '2024-08-14', 0),
('2114033@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114033@dbcegoa.ac.in', 67, 1, '', '2024-08-16', 0),
('2114033@dbcegoa.ac.in', 69, 0, '', '2024-08-20', 0),
('2114033@dbcegoa.ac.in', 70, 0, '', '2024-08-20', 0),
('2114033@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114033@dbcegoa.ac.in', 77, 0, '', '2024-08-23', 0),
('2114033@dbcegoa.ac.in', 78, 0, '', '2024-08-28', 0),
('2114033@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114033@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114034@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114034@dbcegoa.ac.in', 64, 0, '', '2024-08-14', 0),
('2114034@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0),
('2114034@dbcegoa.ac.in', 67, 0, '', '2024-08-16', 0),
('2114034@dbcegoa.ac.in', 76, 0, '', '2024-08-23', 0),
('2114034@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114034@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114066@dbcegoa.ac.in', 53, 1, '', '2024-08-07', 0),
('2114066@dbcegoa.ac.in', 64, 1, '', '2024-08-14', 1),
('2114066@dbcegoa.ac.in', 65, 1, '', '2024-08-16', 0),
('2114066@dbcegoa.ac.in', 69, 1, 'hjfjfjyfncj', '2024-08-20', 1),
('2114066@dbcegoa.ac.in', 70, 1, '', '2024-08-20', 1),
('2114066@dbcegoa.ac.in', 76, 1, '', '2024-08-23', 0),
('2114066@dbcegoa.ac.in', 79, 0, '', '2024-09-03', 0),
('2114066@dbcegoa.ac.in', 86, 0, '', '2024-09-20', 0),
('2114078@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114078@dbcegoa.ac.in', 65, 0, '', '2024-08-16', 0);

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
(1, 1),
(1, 2),
(53, 1),
(53, 2),
(64, 1),
(65, 1),
(65, 2),
(65, 3),
(65, 4),
(67, 1),
(69, 1),
(70, 1),
(70, 2),
(76, 1),
(76, 3),
(77, 1),
(78, 1),
(79, 1),
(86, 1);

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
  `J_Offered_salary` varchar(255) NOT NULL,
  `J_Req_cgpa` decimal(4,2) DEFAULT NULL,
  `J_No_of_posts` int(11) DEFAULT NULL,
  `Accept_Responses` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobplacements`
--

INSERT INTO `jobplacements` (`J_id`, `J_Position`, `J_Backlogs_allowed`, `J_Description`, `J_Due_date`, `J_Offered_salary`, `J_Req_cgpa`, `J_No_of_posts`, `Accept_Responses`) VALUES
(1, 'Junior Developer', 1, 'BAjcba ca scjhajsc a casjc ajsc ascja cjas cja cja scjh asjc jacfqascvasljcao', '2024-07-27', '700000', 5.00, 10, 1),
(53, 'sfbwdv', 1, 'ruxryu yiyy ', '2024-08-11', '523253', 10.00, 5, 1),
(64, 'Associate Developer 2', 1, 'qq qqwed q3eqeqq qqdq', '2024-08-31', '324352', 10.00, 12, 0),
(65, 'Associate Developer', NULL, 'Test Company', '2024-08-15', '324352', 10.00, 34, 0),
(67, 'fafa', 1, 'HHF', '2024-08-24', '324352', NULL, 232, 1),
(69, 'ZOZ', 1, 'adcscva', '2024-08-19', '534', NULL, 34, 0),
(70, 'Associate Developer', 1, 'uttu', '2024-08-23', '7000000', 1.00, 10, 0),
(76, 'Developer', NULL, 'csa', '2024-09-05', '70000', 0.00, 12, 0),
(77, 'trainee', NULL, '', '2024-08-23', '60000', 7.00, 10, 1),
(78, 'Munoz Giles Inc', NULL, '', '2024-09-07', '12 LPA', 2.00, 25, 1),
(79, 'Developer', NULL, 'Test Job', '2024-09-27', '80000', 0.00, 20, 0),
(86, 'Jr Developer', NULL, 'Test 3', '2024-09-30', '500000', 0.00, 2, 0);

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
('warren@dbcegoa.ac.in', 3, 52, '2024-08-07'),
('warren@dbcegoa.ac.in', 4, 53, '2024-08-07'),
('warren@dbcegoa.ac.in', 3, 54, '2024-08-13'),
('warren@dbcegoa.ac.in', 3, 64, '2024-08-14'),
('warren@dbcegoa.ac.in', 3, 69, '2024-08-20'),
('warren@dbcegoa.ac.in', 4, 76, '2024-08-23'),
('warren@dbcegoa.ac.in', 3, 77, '2024-08-23'),
('warren@dbcegoa.ac.in', 3, 79, '2024-09-03'),
('warren@dbcegoa.ac.in', 3, 80, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 81, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 82, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 83, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 84, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 85, '2024-09-20'),
('warren@dbcegoa.ac.in', 3, 86, '2024-09-20');

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
(6, 64, 6),
(7, 65, 6),
(8, 65, 7),
(11, 67, 6),
(12, 67, 7),
(14, 69, 7),
(15, 70, 6),
(23, 79, 6),
(36, 86, 6),
(37, 86, 7);

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

--
-- Dumping data for table `notificationdetails`
--

INSERT INTO `notificationdetails` (`Notification_ID`, `PC_Email`, `Subject`, `Message`, `Attachment1`, `Attachment2`, `Notification_Due_Date`, `Notification_Date`) VALUES
(20, 'warren@dbcegoa.ac.in', 'Hi Hello', NULL, 'notification_20_attachment_1.png', NULL, '2024-08-10', '2024-08-07 04:08:23'),
(22, 'warren@dbcegoa.ac.in', 'New Noti', 'kgsaci a csouigsc i', NULL, NULL, '2024-08-31', '2024-08-07 06:59:51');

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

--
-- Dumping data for table `otp_table`
--

INSERT INTO `otp_table` (`otp_id`, `email`, `otp`, `otp_expiration`, `created_at`) VALUES
(1, '2114018@dbcegoa.ac.in', 526441, 1726497614, '2024-09-16 14:30:14'),
(2, '2114018@dbcegoa.ac.in', 492283, 1726497692, '2024-09-16 14:31:32'),
(3, '2114018@dbcegoa.ac.in', 980961, 1726498013, '2024-09-16 14:36:53'),
(4, '2114018@dbcegoa.ac.in', 161536, 1726498198, '2024-09-16 14:39:58'),
(5, '2114053@dbcegoa.ac.in', 612615, 1726507573, '2024-09-16 17:16:13'),
(6, '2114053@dbcegoa.ac.in', 662777, 1726570132, '2024-09-17 10:38:52'),
(7, '2114053@dbcegoa.ac.in', 470542, 1726570210, '2024-09-17 10:40:10'),
(8, '2114056@dbcegoa.ac.in', 410103, 1726821297, '2024-09-20 08:24:57');

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
(7, 'Are you ready to work outside Goa ? (Yes/No)', 0),
(8, 'iuehwfiuwefwefwef', 1),
(9, 'em5e', 1),
(10, 'lshso', 1);

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
('2113045@dbcegoa.ac.in', 9.00, 9.00, 9.00, 9.00, 9.00, 9.00, 9.00, 0.00, 9.00, 0),
('2113046@dbcegoa.ac.in', 8.00, 5.60, 6.00, 5.70, 8.00, 7.80, 0.00, 0.00, 6.80, 0),
('2113047@dbcegoa.ac.in', 8.00, 8.80, 6.00, 9.00, 9.50, 8.00, 0.00, 0.00, 9.10, 0),
('2114001@dbcegoa.ac.in', 6.00, 7.00, 6.00, 5.00, 0.00, 6.00, 6.00, 0.00, 6.00, 0),
('2114002@dbcegoa.ac.in', 7.00, 7.00, 6.00, 7.00, 7.00, 0.00, 6.00, 0.00, 7.00, 0),
('2114003@dbcegoa.ac.in', 7.00, 7.00, 6.00, 6.00, 6.00, 6.00, 6.00, 0.00, 6.00, 0),
('2114004@dbcegoa.ac.in', 7.00, 7.00, 6.00, 6.00, 6.00, 6.00, 7.00, 0.00, 7.00, 0),
('2114005@dbcegoa.ac.in', 7.00, 8.00, 8.00, 7.00, 0.00, 7.00, 7.00, 0.00, 7.00, 0),
('2114006@dbcegoa.ac.in', 7.00, 7.00, 6.00, 6.00, 7.00, 0.00, 7.00, 0.00, 7.00, 0),
('2114007@dbcegoa.ac.in', 7.00, 7.00, 6.00, 7.00, 0.00, 6.00, 7.00, 0.00, 7.00, 0),
('2114009@dbcegoa.ac.in', 7.00, 7.00, 7.00, 7.00, 6.00, 7.00, 6.00, 0.00, 7.00, 0),
('2114010@dbcegoa.ac.in', 8.00, 8.00, 8.00, 7.00, 8.00, 8.00, 8.00, 0.00, 8.00, 0),
('2114018@dbcegoa.ac.in', 1.00, 2.00, 3.00, 4.00, 2.00, 3.00, 4.00, 0.00, 5.00, 0),
('2114027@dbcegoa.ac.in', 9.00, 8.00, 9.00, 8.00, 7.00, 8.00, 0.00, 0.00, 9.00, 0),
('2114033@dbcegoa.ac.in', 9.50, 9.80, 6.30, 7.30, 8.90, 7.30, 5.60, 7.30, 7.27, 0),
('2114034@dbcegoa.ac.in', 9.00, 8.00, 9.00, 7.00, 0.00, 6.00, 7.00, 4.00, 8.00, 1),
('2114066@dbcegoa.ac.in', 8.00, 9.00, 8.00, 9.00, 0.00, 10.00, 0.00, 0.00, 5.00, 1),
('2114078@dbcegoa.ac.in', 9.00, 8.00, 7.00, 7.00, 8.00, 9.00, 9.00, 0.00, 9.00, 0);

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
(1, 1, 1, 'Goa Panaji', 'https://www.google.com/imgres?imgurl=https://www.czma.goa.gov.in/images/colva-beach-goa.jpg&tbnid=N_Jz6Ox3kB45cM&vet=1&imgrefurl=https://www.czma.goa.gov.in/&docid=-9UvyAK6XtuJfM&w=1500&h=986&hl=en-US&source=sh/x/im/m6/4&kgs=b24a4e22489e6c4c&shem=abme,tri', '12:00:00', '2024-07-22', 'Resume Screening: Initial screening of resumes by recruiters to ensure technical requirements, education, and experience meet the job requirements.Phone Screenings: Some sources mention a phone screening round, which may involve a 15-20 minute phone conversation with a recruiter or an engineer. This round may assess the candidate’s background, experience, and fit for the role.Technical Interviews: In some cases, Round 1 may involve a technical interview, often conducted via video call (Hangout), focusing on Data Structures and Algorithms (DSA). This may include questions such as:Tell me something about yourself.Algorithmic problems, such as the “time needed to inform all employees” problem mentioned in one source.Other DSA-based challenges.'),
(2, 1, 2, 'Goa', 'meet.com', '12:07:07', '2024-07-22', 'Hi  jeke fndf kfj slknn fkdnf kndsk jfsne '),
(17, 65, 1, 'Seminar Hall 1', 'www.google.com', '00:05:00', '2024-08-17', 'avasvavas'),
(18, 64, 1, 'Iure excepteur sint ', 'Vel voluptatibus off', '13:49:00', '2020-08-08', 'Iure aspernatur ut d'),
(19, 69, 1, 'ascasca', 'dbvzasvda', '22:31:00', '2024-08-21', 'aiudfhiaufva'),
(20, 70, 1, 'Seminar Hall 1', 'www.google.com', '23:06:00', '2024-08-21', 'Demo round'),
(21, 76, 1, 'Seminar Hall', 'wefwef', '20:23:00', '2024-09-15', 'ascasc'),
(22, 79, 1, 'Seminar Hall 1', '', '22:06:00', '2024-09-20', 'ggjkdwc'),
(23, 86, 1, 'Seminar Hall 1', '', '17:30:00', '2024-09-24', 'Round Test 1');

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
('2113045@dbcegoa.ac.in', 'Aryan', '', 'Rege', 'ayranrege@gmail.com', 'Vasco', '9876543210', '2113045', '974465728', 80.00, 75.00, '$2y$10$LjX/9BgtIYrHxkEbJMYox.kondUPdy096/KMO/NHn69lrX38GfzN6', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2113046@dbcegoa.ac.in', 'Shawn', 'Anthony', 'Fernandes', 'shawnferns@gmail.com', 'Margao', '9876543210', '2113046', '836263481', 89.00, 72.00, '$2y$10$ENXS2FsLkCCU7nfPDM/7Z.vQ8pBc/8wV3mTYq7iPb4JB5o8ZSIqRy', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2113047@dbcegoa.ac.in', 'Teran', 'Steph', 'Rodrigues', 'teran@gmail.com', 'Hno 37 Sapana greens Fatorda, Goa', '7382184659', '2113047', '836462526', 97.00, 90.00, '$2y$10$rC30.jE8GmVPfFimbTZkqOr1O5kkiZ65pXlprMYU3toSC0IQK9pXm', '', 'Default_Profile_Pic.jpg', '', '', 7, '2022', 'M', 0, 1),
('2114001@dbcegoa.ac.in', 'Ansley', 'Lester', 'Fernandes', 'anseyfernandes@gmail.com', 'Quepem', '9568421365', '2114001', '21110656', 75.00, 73.00, '$2y$10$2kvE8WArxs3KrIDy1a/Om.y1ixmLnp5HG4BBsZQccUrrO8vLctL.m', '=HYPERLINK(\"https://drive.google.com/file/d/1G9eGOcn_TMes5cNugDE4tqJlKoV6cA9s1/view?usp=sharing\",\"Resume\")', 'Default_Profile_Pic.jpg', '', '', 1, '2021', 'M', 0, 1),
('2114002@dbcegoa.ac.in', 'Shweta', '', 'Colaco', 'shwetacolaco@gmail.com', 'Cavelossim', '9768758452', '2114002', '21110006', 78.00, 72.00, '$2y$10$0aVdptNfZ5iU.fUvcMBEV.UGQ/FBm9obtiBR/jU2cAoZ5HU6o7Tze', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114003@dbcegoa.ac.in', 'Aaron', '', 'Rodrigues', 'aaronrodrigues@gmail.com', 'Colva', '9188976452', '2114003', '21112306', 76.00, 74.00, '$2y$10$cNRMYLn3uNf3KEroxr/Aluk2whMB.3f3ncpkywdIlTqRqmbEIy8je', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114004@dbcegoa.ac.in', 'John', '', 'Pereira', 'johnpereira@gmail.com', 'Panjim', '956841656', '2114004', '21145856', 78.00, 74.00, '$2y$10$Yeaaz8OP6VP2Z6zK6xfe2OIdasY0EIrUkMcSDI939dMfWiag4F/la', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114005@dbcegoa.ac.in', 'Langer', '', 'Pereria', 'langerpereira@gmail.com', 'Margao', '9185656452', '2114005', '21115356', 80.00, 78.00, '$2y$10$A/cOUzkpoIIPCYZB0QrPIeJtMCvbUuJyFzge5cg7Giql.AEpOh4D2', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114006@dbcegoa.ac.in', 'Ashley', '', 'Fernandes', 'ashleyfernandes@gmail.com', 'Chinchinim', '9185876452', '2114006', '21110578', 74.00, 73.00, '$2y$10$k5lWWWowmEIY3usuRduYu.OErp3BBQRgh/n4ozO4fbV0v.4FUJIaK', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114007@dbcegoa.ac.in', 'Gavin', '', 'Fernandes', 'gavinfernandes@gmail.com', 'Margao', '9768758636', '2114007', '21112636', 75.00, 74.00, '$2y$10$GkUxIkEVw1Ore/8Ahm6ReuxnUpAcMhw0vmfAHpSe/Iw.d/lKmf2/O', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114009@dbcegoa.ac.in', 'Peter', '', 'Fernandes', 'peterfernandes@gmail.com', 'Margao', '9768412452', '2114009', '21136506', 76.00, 74.00, '$2y$10$Wvso8DJEygVRc7fFFa/t8.kl5bJKgpHHHjIudU.kP5p02x/Yej0QG', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114010@dbcegoa.ac.in', 'Bliss ', '', 'Fernandes', 'blissfernandes@gmail.com', 'Fatorda', '9768778952', '2114010', '21110565', 79.00, 78.00, '$2y$10$OqZTvatd0u/zIfH.Kda0re/XrH6zSHGd/wEGFphwRd9AnHz3z6/xK', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114018@dbcegoa.ac.in', 'Gavin', 'Romaldo', 'Da Costa', 'piersonferns@gmail.com', 'Margao', '9307325976', '2114018', '21115356', 12.00, 53.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 1, 1),
('2114027@dbcegoa.ac.in', 'Samuela', '', 'Fernandes', 'samuel1@gmail.com', ' Ftorda', '9854621256', '2114027', '21114056', 80.00, 90.00, '$2y$10$dYNUO77ThsstHSh1zEYv2OvbbPRXBdYFJAT5R4gUvzEMAiWDdVf7G', '', '2114027.png', '', '', 8, '2021', 'M', 0, 1),
('2114033@dbcegoa.ac.in', 'Syndroy', 'Anthony', 'Araujo', 'patcolaco@gmail.com', 'Quelossim Goa', '7893268762', '2114033', '202150442', 97.22, 81.20, '$2y$10$xLfOTgZzl4hYCJn6drbQwuC6IwbHrP7faM.azCMli4xUup1H9BJfi', '=HYPERLINK(\"https://drive.google.com/file/d/1Y9m6cQGdMy5_YFvHG05l00nElgZ866u_/view?usp=drive_link\",\"Resume\")', '2114033.jpg', '=HYPERLINK(\"kscacscsdv.gmasb.com\",\"10th Marksheet\")', '=HYPERLINK(\"ascasc\",\"12th Marksheet\")', 2, '2021', 'M', 1, 1),
('2114034@dbcegoa.ac.in', 'Pierson', '', 'Fernandes', 'piersonferns@gmail.com', 'Fatorda Goa', '9182736452', '2114034', '124123562', 80.00, 90.00, '$2y$10$jAxjfWJ2TC2hNK1BvI51kuCa8Iocu7yiSMCf4WnJL4nBzDfoJemie', '', '2114034.jpg', '', '', 2, '2024', 'M', 0, 1),
('2114066@dbcegoa.ac.in', 'Annaa', 'Carson', 'Townsend', 'anna@gmail.com', 'Quelossim Goa', '9307325976', '2114066', '202111382', 10.00, 90.00, '$2y$10$w5np0qZSADzFJjYlcpTIiOwqpl1LmXl8Kfb4KqjE5JOYN9IVuBQZC', '=HYPERLINK(\"jvh\",\"Resume\")', 'Default_Profile_Pic.jpg', '=HYPERLINK(\"sc\",\"10th Marksheet\")', '=HYPERLINK(\"ca\",\"12th Marksheet\")', 2, '2021', 'F', 1, 1),
('2114078@dbcegoa.ac.in', 'Langer', 'dvadva', 'Pereira', 'langerferns@gmail.com', 'Fatorda Goa', '9182736432', '2114078', '21140235', 80.00, 67.00, '$2y$10$lTIztES8RLAYUZpycrhJguGlwbwg6yVUxbfl9O3/LvD959l/Vjlsm', '', 'Default_Profile_Pic.jpg', '', '', 4, '2023', 'M', 0, 1);

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

--
-- Dumping data for table `studentnotifications`
--

INSERT INTO `studentnotifications` (`Notification_ID`, `S_College_Email`, `Dismiss_Notification`) VALUES
(20, '2114001@dbcegoa.ac.in', 0),
(22, '2114001@dbcegoa.ac.in', 0),
(22, '2114002@dbcegoa.ac.in', 0),
(22, '2114003@dbcegoa.ac.in', 0),
(22, '2114004@dbcegoa.ac.in', 0),
(22, '2114005@dbcegoa.ac.in', 0),
(22, '2114006@dbcegoa.ac.in', 0),
(22, '2114007@dbcegoa.ac.in', 0),
(22, '2114009@dbcegoa.ac.in', 0),
(22, '2114010@dbcegoa.ac.in', 0),
(22, '2114033@dbcegoa.ac.in', 0),
(22, '2114034@dbcegoa.ac.in', 0);

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
(9, 64, '2114066@dbcegoa.ac.in', 6, 'dsvsvs'),
(10, 65, '2114066@dbcegoa.ac.in', 6, 'Yes'),
(11, 65, '2114066@dbcegoa.ac.in', 7, 'No'),
(12, 64, '2114033@dbcegoa.ac.in', 6, 'No'),
(13, 69, '2114066@dbcegoa.ac.in', 7, 'Yes'),
(15, 70, '2114066@dbcegoa.ac.in', 6, 'Yes'),
(18, 67, '2114033@dbcegoa.ac.in', 6, 'ene'),
(19, 67, '2114033@dbcegoa.ac.in', 7, 'en'),
(21, 79, '2114018@dbcegoa.ac.in', 6, ''),
(22, 86, '2114018@dbcegoa.ac.in', 6, 'Yes'),
(23, 86, '2114018@dbcegoa.ac.in', 7, 'Yes');

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
('2114001@dbcegoa.ac.in', 21, 'pending'),
('2114018@dbcegoa.ac.in', 23, 'passed'),
('2114033@dbcegoa.ac.in', 1, 'passed'),
('2114033@dbcegoa.ac.in', 2, 'pending'),
('2114033@dbcegoa.ac.in', 18, 'passed'),
('2114066@dbcegoa.ac.in', 17, 'pending'),
('2114066@dbcegoa.ac.in', 18, 'passed'),
('2114066@dbcegoa.ac.in', 19, 'passed'),
('2114066@dbcegoa.ac.in', 20, 'passed'),
('2114066@dbcegoa.ac.in', 21, 'pending');

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
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `jobposting`
--
ALTER TABLE `jobposting`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `jobquestions`
--
ALTER TABLE `jobquestions`
  MODIFY `JobQuestion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `studentresponses`
--
ALTER TABLE `studentresponses`
  MODIFY `Response_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
