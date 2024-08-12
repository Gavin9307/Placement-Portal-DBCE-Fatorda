-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 09:07 AM
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
(1, 'One Shield', 'C_id_1.jpg', 'Software Testing', 'International', 'asdfvbabna r he h fbsfvf ffab e br a vsav afg fvfab eaf gfe\r\n\r\na ggarg  vsv sgv  wr vsdgv egw ', 'Margao', 'www.examplecompany.com', 'Tejal Raut', 'sdvbdvb@Sdvsvb.com', '9307122412', '2024-07-03', 'warren@dbcegoa.ac.in'),
(2, 'Bliss Company', 'C_id_2.jpg', 'Artificial Intelligence', 'International', 'Quasi explicabo voluptatum ratione minus rem maiores vitae quibusdam accusantium. Nemo quo nisi. Fuga quas labore repudiandae quos quasi ullam non commodi.', 'Panaji', 'www.blissferns.com', 'Bliss Fernandes', 'bliss@gmail.com', '9448756514', '2024-07-30', 'warren@dbcegoa.ac.in'),
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
  `Rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`C_id`, `S_College_Email`, `Message`, `Message_Date`, `Rating`) VALUES
(1, '2114033@dbcegoa.ac.in', 'Very Good Company', '2024-07-17', 3);

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
('2113045@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2113046@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2113047@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114001@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114001@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114002@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114002@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114003@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114003@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114004@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114004@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114005@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114005@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114006@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114006@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114007@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114007@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114008@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114008@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114009@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114009@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114010@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114010@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114027@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114033@dbcegoa.ac.in', 1, 1, '', '2024-07-22', 1),
('2114033@dbcegoa.ac.in', 48, 1, '', '2024-08-07', 0),
('2114033@dbcegoa.ac.in', 53, 1, '', '2024-08-07', 0),
('2114034@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114034@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0),
('2114053@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114066@dbcegoa.ac.in', 48, 1, '', '2024-08-07', 0),
('2114066@dbcegoa.ac.in', 53, 1, '', '2024-08-07', 0),
('2114078@dbcegoa.ac.in', 48, 0, '', '2024-08-07', 0),
('2114078@dbcegoa.ac.in', 53, 0, '', '2024-08-07', 0);

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
(48, 1),
(53, 1),
(53, 2);

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
  `J_Offered_salary` float DEFAULT NULL,
  `J_Req_cgpa` decimal(4,2) DEFAULT NULL,
  `J_No_of_posts` int(11) DEFAULT NULL,
  `Accept_Responses` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobplacements`
--

INSERT INTO `jobplacements` (`J_id`, `J_Position`, `J_Backlogs_allowed`, `J_Description`, `J_Due_date`, `J_Offered_salary`, `J_Req_cgpa`, `J_No_of_posts`, `Accept_Responses`) VALUES
(1, 'Junior Developer', 1, 'BAjcba ca scjhajsc a casjc ajsc ascja cjas cja cja scjh asjc jacfqascvasljcao', '2024-07-27', 700000, 5.00, 10, 1),
(48, 'Associate Developer', 1, 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on p', '2024-08-31', 7000000, 10.00, 34, 1),
(53, 'sfbwdv', 1, 'ruxryu yiyy ', '2024-08-11', 523253, 10.00, 5, 1);

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
('warren@dbcegoa.ac.in', 1, 1, '2024-07-22'),
('warren@dbcegoa.ac.in', 1, 6, '2024-07-29'),
('warren@dbcegoa.ac.in', 1, 9, '2024-07-29'),
('warren@dbcegoa.ac.in', 1, 11, '2024-07-29'),
('warren@dbcegoa.ac.in', 1, 48, '2024-08-07'),
('warren@dbcegoa.ac.in', 3, 52, '2024-08-07'),
('warren@dbcegoa.ac.in', 4, 53, '2024-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `jobquestionsanswers`
--

CREATE TABLE `jobquestionsanswers` (
  `Answer_ID` int(11) NOT NULL,
  `Question_ID` int(11) DEFAULT NULL,
  `Answer_Text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_questions`
--

CREATE TABLE `job_questions` (
  `JQ_ID` int(11) NOT NULL,
  `J_ID` int(11) DEFAULT NULL,
  `Question_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 'warren@dbcegoa.ac.in', 'efwfw', 'wefwef', NULL, NULL, '2024-07-30', '2024-07-26 00:43:59'),
(20, 'warren@dbcegoa.ac.in', 'Hi Hello', NULL, 'notification_20_attachment_1.png', NULL, '2024-08-10', '2024-08-07 04:08:23'),
(22, 'warren@dbcegoa.ac.in', 'New Noti', 'kgsaci a csouigsc i', NULL, NULL, '2024-08-31', '2024-08-07 06:59:51'),
(23, 'warren@dbcegoa.ac.in', 'TRIAL', 'uiags cagussai', NULL, NULL, '2024-08-31', '2024-08-07 07:02:11');

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
('warren@dbcegoa.ac.in', 'Warren', '', 'Dias', '$2y$10$5t2ApMiU8c3m.Uy9Qq0iV.p./F7x22b65J9xZ5fRs6R9YRO4TE2Ke', '9745628514', 'warren@dbcegoa.ac.in.jpg', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Question_ID` int(11) NOT NULL,
  `Question_Text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Question_ID`, `Question_Text`) VALUES
(1, 'Do you have any relatives working in the company?'),
(2, 'Do you have a pan card?');

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
('2114008@dbcegoa.ac.in', 7.00, 7.00, 6.00, 7.00, 6.00, 6.00, 6.00, 0.00, 6.00, 0),
('2114009@dbcegoa.ac.in', 7.00, 7.00, 7.00, 7.00, 6.00, 7.00, 6.00, 0.00, 7.00, 0),
('2114010@dbcegoa.ac.in', 8.00, 8.00, 8.00, 7.00, 8.00, 8.00, 8.00, 0.00, 8.00, 0),
('2114027@dbcegoa.ac.in', 9.00, 8.00, 9.00, 8.00, 7.00, 8.00, 0.00, 0.00, 9.00, 0),
('2114033@dbcegoa.ac.in', 9.50, 9.80, 6.30, 7.30, 8.90, 7.30, 5.60, 7.30, 7.20, 0),
('2114034@dbcegoa.ac.in', 9.00, 8.00, 9.00, 7.00, 0.00, 6.00, 7.00, 4.00, 8.00, 1),
('2114053@dbcegoa.ac.in', 9.00, 9.00, 8.00, 9.00, 7.00, 8.00, 9.00, 8.00, 9.00, 0),
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
(12, 48, 1, 'Online ', 'www.google.com', '14:03:00', '2024-08-16', 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on p'),
(13, 48, 2, 'Seminar Hall 1', ' www.google.com', '02:04:00', '2024-08-25', 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on p');

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
  `PLACED` varchar(10) NOT NULL DEFAULT 'No',
  `registration_complete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`S_College_Email`, `S_Fname`, `S_Mname`, `S_Lname`, `S_Personal_Email`, `S_Address`, `S_Phone_no`, `S_Roll_no`, `S_PR_No`, `S_10th_Perc`, `S_12th_Perc`, `S_Password`, `S_Resume`, `S_Profile_pic`, `S_10th_marksheet`, `S_12th_marksheet`, `S_Class_id`, `S_Year_of_Admission`, `Gender`, `PLACED`, `registration_complete`) VALUES
('2112001@dbcegoa.ac.in', '', '', '', '', '', '', '', '', 0.00, 0.00, '$2y$10$/0WeP87rNmX70Wki7FY3E.ImZivTW1AbBPJWDwXKTngupZAnZn0cq', '', '', '', '', NULL, '0000', '', 'No', 0),
('2113045@dbcegoa.ac.in', 'Aryan', '', 'Rege', 'ayranrege@gmail.com', 'Vasco', '9876543210', '2113045', '974465728', 80.00, 75.00, '$2y$10$LjX/9BgtIYrHxkEbJMYox.kondUPdy096/KMO/NHn69lrX38GfzN6', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 'No', 1),
('2113046@dbcegoa.ac.in', 'Shawn', 'Anthony', 'Fernandes', 'shawnferns@gmail.com', 'Margao', '9876543210', '2113046', '836263481', 89.00, 72.00, '$2y$10$ENXS2FsLkCCU7nfPDM/7Z.vQ8pBc/8wV3mTYq7iPb4JB5o8ZSIqRy', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 'No', 1),
('2113047@dbcegoa.ac.in', 'Teran', 'Steph', 'Rodrigues', 'teran@gmail.com', 'Hno 37 Sapana greens Fatorda, Goa', '7382184659', '2113047', '836462526', 97.00, 90.00, '$2y$10$rC30.jE8GmVPfFimbTZkqOr1O5kkiZ65pXlprMYU3toSC0IQK9pXm', '', 'Default_Profile_Pic.jpg', '', '', 7, '2022', 'M', 'No', 1),
('2114001@dbcegoa.ac.in', 'Ansley', 'Lester', 'Fernandes', 'anseyfernandes@gmail.com', 'Quepem', '9568421365', '2114001', '21110656', 75.00, 73.00, '$2y$10$2kvE8WArxs3KrIDy1a/Om.y1ixmLnp5HG4BBsZQccUrrO8vLctL.m', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114002@dbcegoa.ac.in', 'Shweta', '', 'Colaco', 'shwetacolaco@gmail.com', 'Cavelossim', '9768758452', '2114002', '21110006', 78.00, 72.00, '$2y$10$0aVdptNfZ5iU.fUvcMBEV.UGQ/FBm9obtiBR/jU2cAoZ5HU6o7Tze', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 'No', 1),
('2114003@dbcegoa.ac.in', 'Aaron', '', 'Rodrigues', 'aaronrodrigues@gmail.com', 'Colva', '9188976452', '2114003', '21112306', 76.00, 74.00, '$2y$10$cNRMYLn3uNf3KEroxr/Aluk2whMB.3f3ncpkywdIlTqRqmbEIy8je', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114004@dbcegoa.ac.in', 'John', '', 'Pereira', 'johnpereira@gmail.com', 'Panjim', '956841656', '2114004', '21145856', 78.00, 74.00, '$2y$10$Yeaaz8OP6VP2Z6zK6xfe2OIdasY0EIrUkMcSDI939dMfWiag4F/la', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114005@dbcegoa.ac.in', 'Langer', '', 'Pereria', 'langerpereira@gmail.com', 'Margao', '9185656452', '2114005', '21115356', 80.00, 78.00, '$2y$10$A/cOUzkpoIIPCYZB0QrPIeJtMCvbUuJyFzge5cg7Giql.AEpOh4D2', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114006@dbcegoa.ac.in', 'Ashley', '', 'Fernandes', 'ashleyfernandes@gmail.com', 'Chinchinim', '9185876452', '2114006', '21110578', 74.00, 73.00, '$2y$10$k5lWWWowmEIY3usuRduYu.OErp3BBQRgh/n4ozO4fbV0v.4FUJIaK', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 'No', 1),
('2114007@dbcegoa.ac.in', 'Gavin', '', 'Fernandes', 'gavinfernandes@gmail.com', 'Margao', '9768758636', '2114007', '21112636', 75.00, 74.00, '$2y$10$GkUxIkEVw1Ore/8Ahm6ReuxnUpAcMhw0vmfAHpSe/Iw.d/lKmf2/O', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114008@dbcegoa.ac.in', 'Ronaldo', '', 'Colaco', 'ronaldocolaco@gmail.com', 'Assolna', '9568854365', '2114008', '21112106', 76.00, 74.00, '$2y$10$DgYr/P3igWDWDUP/gMqRKOrvS0K6hpV1I38yCdhgmhqk/busmNA5u', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114009@dbcegoa.ac.in', 'Peter', '', 'Fernandes', 'peterfernandes@gmail.com', 'Margao', '9768412452', '2114009', '21136506', 76.00, 74.00, '$2y$10$Wvso8DJEygVRc7fFFa/t8.kl5bJKgpHHHjIudU.kP5p02x/Yej0QG', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114010@dbcegoa.ac.in', 'Bliss ', '', 'Fernandes', 'blissfernandes@gmail.com', 'Fatorda', '9768778952', '2114010', '21110565', 79.00, 78.00, '$2y$10$OqZTvatd0u/zIfH.Kda0re/XrH6zSHGd/wEGFphwRd9AnHz3z6/xK', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114027@dbcegoa.ac.in', 'Samuela', '', 'Fernandes', 'samuel1@gmail.com', ' Ftorda', '9854621256', '2114027', '21114056', 80.00, 90.00, '$2y$10$dYNUO77ThsstHSh1zEYv2OvbbPRXBdYFJAT5R4gUvzEMAiWDdVf7G', '', '2114027.png', '', '', 8, '2021', 'M', 'No', 1),
('2114033@dbcegoa.ac.in', 'Syndroy', 'Anthony', 'Colaco', 'patcolaco@gmail.com', 'Quelossim Goa', '7893268762', '2114033', '202150442', 97.22, 81.20, '$2y$10$yB2xT7I6BpxRw61IWU5qTOsOChISsAkpkaEzQHt/.ZArCw048Ce0q', '', '2114033.jpg', '', '', 2, '2021', 'M', 'No', 1),
('2114034@dbcegoa.ac.in', 'Pierson', '', 'Fernandes', 'piersonferns@gmail.com', 'Fatorda Goa', '9182736452', '2114034', '124123562', 80.00, 90.00, '$2y$10$jAxjfWJ2TC2hNK1BvI51kuCa8Iocu7yiSMCf4WnJL4nBzDfoJemie', '', '2114034.jpg', '', '', 2, '2024', 'M', 'No', 1),
('2114053@dbcegoa.ac.in', 'Bliss', '', 'Fernandes', 'blissferns@gmail.com', 'Colva Goa', '9182736453', '2114053', '202111356', 90.00, 92.00, '$2y$10$AK8JaujJWMgUCwQGdfPErOzzoYUjSYS.975/1mL6i/fytomDVMsny', '', 'Default_Profile_Pic.jpg', '', '', 8, '2023', 'M', 'No', 1),
('2114066@dbcegoa.ac.in', 'Anna', 'Carson', 'Townsend', 'anna@gmail.com', 'Quelossim Goa', '9307325976', '2114066', '202111382', 80.00, 90.00, '$2y$10$w5np0qZSADzFJjYlcpTIiOwqpl1LmXl8Kfb4KqjE5JOYN9IVuBQZC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 'No', 1),
('2114078@dbcegoa.ac.in', 'Langer', 'dvadva', 'Pereira', 'langerferns@gmail.com', 'Fatorda Goa', '9182736432', '2114078', '21140235', 80.00, 67.00, '$2y$10$lTIztES8RLAYUZpycrhJguGlwbwg6yVUxbfl9O3/LvD959l/Vjlsm', '', 'Default_Profile_Pic.jpg', '', '', 4, '2023', 'M', 'No', 1);

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
(22, '2114008@dbcegoa.ac.in', 0),
(22, '2114009@dbcegoa.ac.in', 0),
(22, '2114010@dbcegoa.ac.in', 0),
(22, '2114033@dbcegoa.ac.in', 0),
(22, '2114034@dbcegoa.ac.in', 0),
(23, '2114001@dbcegoa.ac.in', 0),
(23, '2114002@dbcegoa.ac.in', 0),
(23, '2114003@dbcegoa.ac.in', 0),
(23, '2114004@dbcegoa.ac.in', 0),
(23, '2114005@dbcegoa.ac.in', 0),
(23, '2114006@dbcegoa.ac.in', 0),
(23, '2114007@dbcegoa.ac.in', 0),
(23, '2114008@dbcegoa.ac.in', 0),
(23, '2114009@dbcegoa.ac.in', 0),
(23, '2114010@dbcegoa.ac.in', 0),
(23, '2114033@dbcegoa.ac.in', 0),
(23, '2114034@dbcegoa.ac.in', 0),
(23, '2114066@dbcegoa.ac.in', 0);

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
('2114033@dbcegoa.ac.in', 1, 'passed'),
('2114033@dbcegoa.ac.in', 2, 'pending'),
('2114066@dbcegoa.ac.in', 12, 'pending'),
('2114066@dbcegoa.ac.in', 13, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `S_Answer_ID` int(11) NOT NULL,
  `S_College_Email` varchar(255) DEFAULT NULL,
  `J_ID` int(11) DEFAULT NULL,
  `Question_ID` int(11) DEFAULT NULL,
  `Predefined_Answer_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`C_id`,`S_College_Email`),
  ADD KEY `S_College_Email` (`S_College_Email`);

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
-- Indexes for table `jobquestionsanswers`
--
ALTER TABLE `jobquestionsanswers`
  ADD PRIMARY KEY (`Answer_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `job_questions`
--
ALTER TABLE `job_questions`
  ADD PRIMARY KEY (`JQ_ID`),
  ADD KEY `J_ID` (`J_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `PC_Email` (`PC_Email`);

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
-- Indexes for table `studentrounds`
--
ALTER TABLE `studentrounds`
  ADD PRIMARY KEY (`S_College_Email`,`R_id`),
  ADD KEY `R_id` (`R_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`S_Answer_ID`),
  ADD KEY `S_College_Email` (`S_College_Email`),
  ADD KEY `J_ID` (`J_ID`),
  ADD KEY `Question_ID` (`Question_ID`),
  ADD KEY `Predefined_Answer_ID` (`Predefined_Answer_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `Class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobplacements`
--
ALTER TABLE `jobplacements`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `jobposting`
--
ALTER TABLE `jobposting`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `jobquestionsanswers`
--
ALTER TABLE `jobquestionsanswers`
  MODIFY `Answer_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_questions`
--
ALTER TABLE `job_questions`
  MODIFY `JQ_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificationdetails`
--
ALTER TABLE `notificationdetails`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `S_Answer_ID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `jobquestionsanswers`
--
ALTER TABLE `jobquestionsanswers`
  ADD CONSTRAINT `jobquestionsanswers_ibfk_1` FOREIGN KEY (`Question_ID`) REFERENCES `questions` (`Question_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_questions`
--
ALTER TABLE `job_questions`
  ADD CONSTRAINT `job_questions_ibfk_1` FOREIGN KEY (`J_ID`) REFERENCES `jobplacements` (`J_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_questions_ibfk_2` FOREIGN KEY (`Question_ID`) REFERENCES `questions` (`Question_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `studentrounds`
--
ALTER TABLE `studentrounds`
  ADD CONSTRAINT `studentrounds_ibfk_1` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentrounds_ibfk_2` FOREIGN KEY (`R_id`) REFERENCES `rounds` (`R_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_ibfk_1` FOREIGN KEY (`S_College_Email`) REFERENCES `student` (`S_College_Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_answers_ibfk_2` FOREIGN KEY (`J_ID`) REFERENCES `jobplacements` (`J_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_answers_ibfk_3` FOREIGN KEY (`Question_ID`) REFERENCES `questions` (`Question_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_answers_ibfk_4` FOREIGN KEY (`Predefined_Answer_ID`) REFERENCES `jobquestionsanswers` (`Answer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
