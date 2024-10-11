-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 10:13 PM
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

--
-- Dumping data for table `deletedstudents`
--

INSERT INTO `deletedstudents` (`S_College_Email`, `S_Fname`, `S_Mname`, `S_Lname`, `S_Personal_Email`, `S_Address`, `S_Phone_no`, `S_Roll_no`, `S_PR_No`, `S_10th_Perc`, `S_12th_Perc`, `S_Password`, `S_Resume`, `S_Profile_pic`, `S_10th_marksheet`, `S_12th_marksheet`, `S_Class_id`, `S_Year_of_Admission`, `Gender`, `PLACED`, `registration_complete`, `deleted_at`) VALUES
('2112001@dbcegoa.ac.in', 'John', 'A.', 'Doe', 'john.doe@gmail.com', 'Margao, Goa', '9876543210', '2112001', '202111100', 86.50, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112002@dbcegoa.ac.in', 'Sarah', '', 'Fernandes', 'sarah.fernandes@gmail.com', 'Vasco, Goa', '9876543211', '2112002', '202111101', 85.00, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112003@dbcegoa.ac.in', 'Michael', 'B.', 'Rodrigues', 'michael.rodrigues@gmail.com', 'Panaji, Goa', '9876543212', '2112003', '202111102', 78.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112004@dbcegoa.ac.in', 'Julia', '', 'Pereira', 'julia.pereira@gmail.com', 'Panjim, Goa', '9876543213', '2112004', '202111103', 83.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112005@dbcegoa.ac.in', 'David', '', 'Silva', 'david.silva@gmail.com', 'Ponda, Goa', '9876543214', '2112005', '202111104', 84.00, 85.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112006@dbcegoa.ac.in', 'Sophia', '', 'Mendez', 'sophia.mendez@gmail.com', 'Bicholim, Goa', '9876543215', '2112006', '202111105', 88.00, 92.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112007@dbcegoa.ac.in', 'Matthew', '', 'Rao', 'matthew.rao@gmail.com', 'Bardez, Goa', '9876543216', '2112007', '202111106', 79.00, 81.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112008@dbcegoa.ac.in', 'Emma', '', 'Verma', 'emma.verma@gmail.com', 'Mapusa, Goa', '9876543217', '2112008', '202111107', 85.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112009@dbcegoa.ac.in', 'Joshua', '', 'Khan', 'joshua.khan@gmail.com', 'Sanguem, Goa', '9876543218', '2112009', '202111108', 82.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112010@dbcegoa.ac.in', 'Olivia', '', 'Melo', 'olivia.melo@gmail.com', 'Cortalim, Goa', '9876543219', '2112010', '202111109', 89.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112011@dbcegoa.ac.in', 'Jacob', '', 'Gomes', 'jacob.gomes@gmail.com', 'Pernem, Goa', '9876543220', '2112011', '202111110', 87.00, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112012@dbcegoa.ac.in', 'Ella', '', 'Fernandes', 'ella.fernandes@gmail.com', 'Quepem, Goa', '9876543221', '2112012', '202111111', 84.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112013@dbcegoa.ac.in', 'Ethan', '', 'Almeida', 'ethan.almeida@gmail.com', 'Saligao, Goa', '9876543222', '2112013', '202111112', 86.50, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112014@dbcegoa.ac.in', 'Grace', '', 'Naik', 'grace.naik@gmail.com', 'Ponda, Goa', '9876543223', '2112014', '202111113', 79.50, 80.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112015@dbcegoa.ac.in', 'Daniel', '', 'Pinto', 'daniel.pinto@gmail.com', 'Bardez, Goa', '9876543224', '2112015', '202111114', 88.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112016@dbcegoa.ac.in', 'Ava', '', 'Fernandes', 'ava.fernandes@gmail.com', 'Cortalim, Goa', '9876543225', '2112016', '202111115', 86.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112017@dbcegoa.ac.in', 'Lucas', '', 'Sharma', 'lucas.sharma@gmail.com', 'Dona Paula, Goa', '9876543226', '2112017', '202111116', 87.00, 89.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112018@dbcegoa.ac.in', 'Mia', '', 'Fernandes', 'mia.fernandes@gmail.com', 'Mapusa, Goa', '9876543227', '2112018', '202111117', 82.00, 84.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2112019@dbcegoa.ac.in', 'Alexander', '', 'DSouza', 'alexander.dsouza@gmail.com', 'Verna, Goa', '9876543228', '2112019', '202111118', 80.00, 81.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2112020@dbcegoa.ac.in', 'Chloe', '', 'Fernandes', 'chloe.fernandes@gmail.com', 'Margao, Goa', '9876543229', '2112020', '202111119', 84.50, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114001@dbcegoa.ac.in', 'Gavin', 'Romaldo', 'Da Costa', 'gavindacosta9307@gmail.com', 'Guirdolim Goa', '9307325976', '2114001', '202111349', 72.60, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114002@dbcegoa.ac.in', 'Sarah', '', 'Fernandes', 'sarahfernandes1999@gmail.com', 'Margao Goa', '9822154785', '2114002', '202111350', 75.30, 88.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114003@dbcegoa.ac.in', 'Nathan', 'Terrence', 'Pereira', 'nathanpereira123@gmail.com', 'Benaulim Goa', '7876541239', '2114003', '202111351', 68.90, 82.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114004@dbcegoa.ac.in', 'Ana', '', 'Rodrigues', 'anarodrigues@mail.com', 'Panaji Goa', '9900876543', '2114004', '202111352', 70.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114005@dbcegoa.ac.in', 'Ivan', '', 'Menezes', 'ivanmenezes123@gmail.com', 'Ponda Goa', '8995643275', '2114005', '202111353', 65.80, 79.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114006@dbcegoa.ac.in', 'Maria', 'Benita', 'Sequeira', 'mariasequeira@mail.com', 'Vasco Goa', '9900432187', '2114006', '202111354', 80.20, 92.70, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114007@dbcegoa.ac.in', 'John', 'Matthew', 'Dias', 'johndias7@gmail.com', 'Colva Goa', '9812347654', '2114007', '202111355', 73.50, 85.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114008@dbcegoa.ac.in', 'Emily', '', 'D\'Souza', 'emilydsouza45@gmail.com', 'Salcete Goa', '9900035472', '2114008', '202111356', 76.20, 88.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114009@dbcegoa.ac.in', 'Alex', '', 'De Souza', 'alexdesouza99@gmail.com', 'Fatorda Goa', '9876543210', '2114009', '202111357', 78.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114010@dbcegoa.ac.in', 'Nicole', '', 'Fernandes', 'nicolefernandes77@gmail.com', 'Mapusa Goa', '9871234567', '2114010', '202111358', 80.30, 91.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114011@dbcegoa.ac.in', 'Daniel', '', 'Lopes', 'daniellopes@gmail.com', 'Candolim Goa', '9901245678', '2114011', '202111359', 69.70, 82.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114012@dbcegoa.ac.in', 'Sophie', '', 'Carvalho', 'sophiecarvalho21@gmail.com', 'Cortalim Goa', '9812378945', '2114012', '202111360', 75.10, 86.90, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114013@dbcegoa.ac.in', 'Ryan', '', 'Fernandes', 'ryanfernandes007@gmail.com', 'Verna Goa', '9321457890', '2114013', '202111361', 74.90, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114014@dbcegoa.ac.in', 'Jessica', '', 'Silva', 'jessicasilva95@gmail.com', 'Porvorim Goa', '9901324578', '2114014', '202111362', 78.50, 89.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114015@dbcegoa.ac.in', 'Ethan', '', 'Noronha', 'ethannoronha99@gmail.com', 'Calangute Goa', '9822351479', '2114015', '202111363', 65.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114016@dbcegoa.ac.in', 'Sophia', '', 'Pinto', 'sophiapinto22@gmail.com', 'Assagao Goa', '9312456987', '2114016', '202111364', 80.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2114017@dbcegoa.ac.in', 'Leon', '', 'Fernandes', 'leonfernandes100@gmail.com', 'Colvale Goa', '9876549321', '2114017', '202111365', 72.40, 87.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114018@dbcegoa.ac.in', 'Olivia', '', 'Dias', 'oliviadias93@gmail.com', 'Betalbatim Goa', '9991256347', '2114018', '202111366', 77.50, 89.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', '2114018.jpg', '', '', 2, '2021', 'F', '1', 1, '2024-10-10 18:20:04'),
('2114019@dbcegoa.ac.in', 'David', 'Gregory', 'Martins', 'davidmartins98@gmail.com', 'Anjuna Goa', '9875632148', '2114019', '202111367', 79.20, 90.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2114020@dbcegoa.ac.in', 'Grace', '', 'Costa', 'gracecosta01@gmail.com', 'Cansaulim Goa', '9876543712', '2114020', '202111368', 73.60, 87.90, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115001@dbcegoa.ac.in', 'Alice', '', 'D\'Souza', 'alice.dsouza@gmail.com', 'Mapusa, Goa', '9876543220', '2115001', '202111200', 87.00, 89.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '1', 1, '2024-10-10 18:20:04'),
('2115002@dbcegoa.ac.in', 'Brian', 'C.', 'Gomes', 'brian.gomes@gmail.com', 'Vasco, Goa', '9876543221', '2115002', '202111201', 85.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115003@dbcegoa.ac.in', 'Christine', '', 'Fernandes', 'christine.fernandes@gmail.com', 'Panjim, Goa', '9876543222', '2115003', '202111202', 80.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115004@dbcegoa.ac.in', 'David', '', 'Menezes', 'david.menezes@gmail.com', 'Margao, Goa', '9876543223', '2115004', '202111203', 90.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115005@dbcegoa.ac.in', 'Eva', '', 'Almeida', 'eva.almeida@gmail.com', 'Panjim, Goa', '9876543224', '2115005', '202111204', 86.50, 88.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115006@dbcegoa.ac.in', 'Frank', '', 'Fernandes', 'frank.fernandes@gmail.com', 'Bardez, Goa', '9876543225', '2115006', '202111205', 80.00, 83.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115007@dbcegoa.ac.in', 'Grace', '', 'Nunes', 'grace.nunes@gmail.com', 'Mapusa, Goa', '9876543226', '2115007', '202111206', 88.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115008@dbcegoa.ac.in', 'Henry', '', 'Khan', 'henry.khan@gmail.com', 'Vasco, Goa', '9876543227', '2115008', '202111207', 75.00, 78.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115009@dbcegoa.ac.in', 'Isabella', '', 'Fernandes', 'isabella.fernandes@gmail.com', 'Panjim, Goa', '9876543228', '2115009', '202111208', 82.00, 84.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115010@dbcegoa.ac.in', 'James', '', 'Gomes', 'james.gomes@gmail.com', 'Margao, Goa', '9876543229', '2115010', '202111209', 78.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115011@dbcegoa.ac.in', 'Kate', '', 'Almeida', 'kate.almeida@gmail.com', 'Dona Paula, Goa', '9876543230', '2115011', '202111210', 84.50, 86.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115012@dbcegoa.ac.in', 'Liam', '', 'Rodrigues', 'liam.rodrigues@gmail.com', 'Vasco, Goa', '9876543231', '2115012', '202111211', 88.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115013@dbcegoa.ac.in', 'Mia', '', 'D\'Souza', 'mia.dsouza@gmail.com', 'Mapusa, Goa', '9876543232', '2115013', '202111212', 79.00, 81.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115014@dbcegoa.ac.in', 'Noah', '', 'Fernandes', 'noah.fernandes@gmail.com', 'Bardez, Goa', '9876543233', '2115014', '202111213', 85.50, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115015@dbcegoa.ac.in', 'Olivia', '', 'Menezes', 'olivia.menezes@gmail.com', 'Margao, Goa', '9876543234', '2115015', '202111214', 83.00, 85.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115016@dbcegoa.ac.in', 'Paul', '', 'Khan', 'paul.khan@gmail.com', 'Vasco, Goa', '9876543235', '2115016', '202111215', 89.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115017@dbcegoa.ac.in', 'Quinn', '', 'Almeida', 'quinn.almeida@gmail.com', 'Panjim, Goa', '9876543236', '2115017', '202111216', 85.00, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115018@dbcegoa.ac.in', 'Ryan', '', 'Gomes', 'ryan.gomes@gmail.com', 'Mapusa, Goa', '9876543237', '2115018', '202111217', 80.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2115019@dbcegoa.ac.in', 'Sophie', '', 'Fernandes', 'sophie.fernandes@gmail.com', 'Vasco, Goa', '9876543238', '2115019', '202111218', 88.00, 90.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2115020@dbcegoa.ac.in', 'Thomas', '', 'Rodrigues', 'thomas.rodrigues@gmail.com', 'Dona Paula, Goa', '9876543239', '2115020', '202111219', 90.00, 92.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118001@dbcegoa.ac.in', 'Emma', '', 'Pinto', 'emma.pinto@gmail.com', 'Porvorim, Goa', '9876543230', '2118001', '202111300', 86.00, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118002@dbcegoa.ac.in', 'Liam', '', 'DSouza', 'liam.dsouza@gmail.com', 'Bambolim, Goa', '9876543231', '2118002', '202111301', 88.00, 90.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118003@dbcegoa.ac.in', 'Olivia', '', 'Fernandes', 'olivia.fernandes@gmail.com', 'Margao, Goa', '9876543232', '2118003', '202111302', 92.00, 91.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118004@dbcegoa.ac.in', 'Noah', '', 'Pereira', 'noah.pereira@gmail.com', 'Mapusa, Goa', '9876543233', '2118004', '202111303', 85.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118005@dbcegoa.ac.in', 'Ava', '', 'Sharma', 'ava.sharma@gmail.com', 'Dona Paula, Goa', '9876543234', '2118005', '202111304', 80.00, 81.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118006@dbcegoa.ac.in', 'Isabella', '', 'Khan', 'isabella.khan@gmail.com', 'Vasco, Goa', '9876543235', '2118006', '202111305', 78.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118007@dbcegoa.ac.in', 'Mason', '', 'Lobo', 'mason.lobo@gmail.com', 'Candolim, Goa', '9876543236', '2118007', '202111306', 88.00, 87.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118008@dbcegoa.ac.in', 'Sophia', '', 'Naik', 'sophia.naik@gmail.com', 'Panjim, Goa', '9876543237', '2118008', '202111307', 90.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118009@dbcegoa.ac.in', 'Jackson', '', 'Rao', 'jackson.rao@gmail.com', 'Vasco, Goa', '9876543238', '2118009', '202111308', 86.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118010@dbcegoa.ac.in', 'Aiden', '', 'Bhat', 'aiden.bhat@gmail.com', 'Bambolim, Goa', '9876543239', '2118010', '202111309', 89.00, 88.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118011@dbcegoa.ac.in', 'Mia', '', 'Fernandes', 'mia.fernandes@gmail.com', 'Porvorim, Goa', '9876543240', '2118011', '202111310', 87.00, 86.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118012@dbcegoa.ac.in', 'Zoe', '', 'Coutinho', 'zoe.coutinho@gmail.com', 'Vasco, Goa', '9876543241', '2118012', '202111311', 83.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118013@dbcegoa.ac.in', 'Lucas', '', 'DSouza', 'lucas.dsouza@gmail.com', 'Mapusa, Goa', '9876543242', '2118013', '202111312', 84.00, 82.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118014@dbcegoa.ac.in', 'Charlotte', '', 'Rodrigues', 'charlotte.rodrigues@gmail.com', 'Vasco, Goa', '9876543243', '2118014', '202111313', 90.00, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118015@dbcegoa.ac.in', 'Henry', '', 'Cruz', 'henry.cruz@gmail.com', 'Porvorim, Goa', '9876543244', '2118015', '202111314', 79.00, 80.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118016@dbcegoa.ac.in', 'Evelyn', '', 'Patel', 'evelyn.patel@gmail.com', 'Panjim, Goa', '9876543245', '2118016', '202111315', 77.00, 78.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118017@dbcegoa.ac.in', 'Liam', '', 'Menon', 'liam.menon@gmail.com', 'Bambolim, Goa', '9876543246', '2118017', '202111316', 75.00, 76.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2118018@dbcegoa.ac.in', 'Ella', '', 'Kumar', 'ella.kumar@gmail.com', 'Mapusa, Goa', '9876543247', '2118018', '202111317', 83.00, 84.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118019@dbcegoa.ac.in', 'Ava', '', 'Mishra', 'ava.mishra@gmail.com', 'Vasco, Goa', '9876543248', '2118019', '202111318', 80.00, 82.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', '0', 1, '2024-10-10 18:20:04'),
('2118020@dbcegoa.ac.in', 'James', '', 'Sharma', 'james.sharma@gmail.com', 'Panjim, Goa', '9876543249', '2118020', '202111319', 84.00, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224001@dbcegoa.ac.in', 'Bruce', '', 'Lee', 'bruce@gmail.com', 'Guirdolim Goa', '9307325976', '2224001', '202211349', 72.60, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224002@dbcegoa.ac.in', 'Anna', '', 'Smith', 'anna@gmail.com', 'Panjim Goa', '9307325977', '2224002', '202211350', 75.40, 88.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', '0', 1, '2024-10-10 18:20:04'),
('2224003@dbcegoa.ac.in', 'John', '', 'Doe', 'john@gmail.com', 'Margao Goa', '9307325978', '2224003', '202211351', 68.90, 79.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224004@dbcegoa.ac.in', 'Linda', '', 'Johnson', 'linda@gmail.com', 'Vasco Goa', '9307325979', '2224004', '202211352', 82.10, 91.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', '0', 1, '2024-10-10 18:20:04'),
('2224005@dbcegoa.ac.in', 'Michael', '', 'Williams', 'michael@gmail.com', 'Bardez Goa', '9307325980', '2224005', '202211353', 90.00, 95.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224006@dbcegoa.ac.in', 'Emily', '', 'Davis', 'emily@gmail.com', 'Mapusa Goa', '9307325981', '2224006', '202211354', 77.80, 85.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', '0', 1, '2024-10-10 18:20:04'),
('2224007@dbcegoa.ac.in', 'David', '', 'Brown', 'david@gmail.com', 'Sanguem Goa', '9307325982', '2224007', '202211355', 70.50, 82.10, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224008@dbcegoa.ac.in', 'Sophia', '', 'Wilson', 'sophia@gmail.com', 'Saligao Goa', '9307325983', '2224008', '202211356', 85.40, 90.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', '0', 1, '2024-10-10 18:20:04'),
('2224009@dbcegoa.ac.in', 'James', '', 'Taylor', 'james@gmail.com', 'Porvorim Goa', '9307325984', '2224009', '202211357', 88.00, 93.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'M', '0', 1, '2024-10-10 18:20:04'),
('2224010@dbcegoa.ac.in', 'Olivia', '', 'Anderson', 'olivia@gmail.com', 'Candolim Goa', '9307325985', '2224010', '202211358', 80.00, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 1, '2022', 'F', '0', 1, '2024-10-10 18:20:04');

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

-- --------------------------------------------------------

--
-- Table structure for table `jobdepartments`
--

CREATE TABLE `jobdepartments` (
  `J_id` int(11) NOT NULL,
  `Dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(29, 'warren@dbcegoa.ac.in', 'Offer Letter Submission', 'Please paste your offer letter link', NULL, NULL, '2024-10-03', '2024-09-30 09:40:56');

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
('2111004@dbcegoa.ac.in', 8.19, 6.78, 0.00, 7.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2111006@dbcegoa.ac.in', 9.75, 7.78, 6.35, 6.33, 5.82, 0.00, 0.00, 0.00, 7.01, 0),
('2111009@dbcegoa.ac.in', 8.94, 6.78, 5.61, 5.71, 5.77, 0.00, 0.00, 0.00, 6.38, 0),
('2111010@dbcegoa.ac.in', 9.56, 6.83, 6.00, 7.04, 6.82, 0.00, 0.00, 0.00, 7.12, 0),
('2111012@dbcegoa.ac.in', 9.94, 9.50, 9.09, 9.88, 9.55, 0.00, 0.00, 0.00, 9.59, 1),
('2111015@dbcegoa.ac.in', 8.88, 6.83, 6.30, 7.63, 7.00, 0.00, 0.00, 0.00, 7.33, 0),
('2111017@dbcegoa.ac.in', 9.81, 8.97, 7.52, 8.50, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2111018@dbcegoa.ac.in', 9.50, 7.83, 7.22, 5.92, 7.77, 0.00, 0.00, 0.00, 7.49, 0),
('2111023@dbcegoa.ac.in', 8.63, 7.44, 6.04, 5.25, 6.50, 0.00, 0.00, 0.00, 6.60, 0),
('2111026@dbcegoa.ac.in', 9.19, 7.06, 7.13, 6.75, 7.55, 0.00, 0.00, 0.00, 0.00, 0),
('2111027@dbcegoa.ac.in', 9.75, 9.33, 8.57, 9.46, 9.18, 0.00, 0.00, 0.00, 9.25, 0),
('2112001@dbcegoa.ac.in', 8.13, 6.89, 5.78, 6.71, 7.00, 0.00, 0.00, 0.00, 6.81, 0),
('2112005@dbcegoa.ac.in', 9.25, 8.67, 6.09, 6.71, 6.64, 0.00, 0.00, 0.00, 7.47, 0),
('2112007@dbcegoa.ac.in', 9.50, 8.33, 5.22, 6.63, 0.00, 0.00, 0.00, 0.00, 7.17, 1),
('2112010@dbcegoa.ac.in', 9.38, 8.22, 7.09, 8.13, 7.91, 0.00, 0.00, 0.00, 8.06, 0),
('2112013@dbcegoa.ac.in', 9.56, 8.72, 5.52, 6.63, 0.00, 0.00, 0.00, 0.00, 7.36, 1),
('2112020@dbcegoa.ac.in', 9.13, 8.31, 6.87, 6.67, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2112021@dbcegoa.ac.in', 9.50, 8.61, 7.22, 8.63, 8.09, 0.00, 0.00, 0.00, 8.41, 0),
('2112066@dbcegoa.ac.in', 8.81, 7.67, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 8.24, 1),
('2112067@dbcegoa.ac.in', 8.63, 7.94, 6.74, 7.42, 0.00, 0.00, 0.00, 0.00, 7.58, 1),
('2112077@dbcegoa.ac.in', 8.81, 7.22, 5.26, 6.50, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2112083@dbcegoa.ac.in', 8.44, 6.00, 5.35, 6.17, 5.14, 0.00, 0.00, 0.00, 6.22, 0),
('2112085@dbcegoa.ac.in', 9.06, 8.17, 6.48, 0.00, 0.00, 0.00, 0.00, 0.00, 7.74, 1),
('2112086@dbcegoa.ac.in', 9.00, 8.00, 5.78, 7.17, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2113001@dbcegoa.ac.in', 9.56, 8.94, 8.26, 8.17, 8.50, 0.00, 0.00, 0.00, 8.57, 0),
('2113002@dbcegoa.ac.in', 8.75, 7.06, 6.60, 6.20, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2113003@dbcegoa.ac.in', 9.06, 6.11, 6.84, 6.46, 5.77, 0.00, 0.00, 0.00, 7.00, 0),
('2113005@dbcegoa.ac.in', 8.94, 7.56, 6.57, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2113007@dbcegoa.ac.in', 9.00, 8.78, 8.13, 7.21, 7.77, 0.00, 0.00, 0.00, 8.17, 0),
('2113008@dbcegoa.ac.in', 8.31, 6.89, 6.39, 5.83, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2113009@dbcegoa.ac.in', 9.06, 8.33, 8.91, 8.67, 8.23, 0.00, 0.00, 0.00, 8.74, 0),
('2113016@dbcegoa.ac.in', 9.50, 8.50, 8.22, 6.83, 8.09, 0.00, 0.00, 0.00, 8.11, 0),
('2113017@dbcegoa.ac.in', 8.38, 7.11, 6.35, 5.75, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2113020@dbcegoa.ac.in', 9.25, 6.89, 7.57, 7.71, 7.55, 0.00, 0.00, 0.00, 7.73, 0),
('2113021@dbcegoa.ac.in', 9.19, 7.06, 6.78, 7.33, 6.59, 0.00, 0.00, 0.00, 7.29, 0),
('2113022@dbcegoa.ac.in', 9.75, 8.16, 7.26, 6.42, 6.14, 0.00, 0.00, 0.00, 0.00, 0),
('2113023@dbcegoa.ac.in', 8.81, 7.89, 7.09, 6.92, 6.41, 0.00, 0.00, 0.00, 7.67, 0),
('2113025@dbcegoa.ac.in', 8.56, 8.44, 8.78, 7.71, 7.05, 0.00, 0.00, 0.00, 0.00, 0),
('2113026@dbcegoa.ac.in', 9.31, 9.26, 8.78, 8.67, 8.82, 0.00, 0.00, 0.00, 0.00, 0),
('2113027@dbcegoa.ac.in', 8.63, 7.00, 6.65, 6.21, 0.00, 0.00, 0.00, 0.00, 6.99, 1),
('2114002@dbcegoa.ac.in', 9.38, 7.06, 5.91, 6.33, 6.32, 0.00, 0.00, 0.00, 7.02, 0),
('2114003@dbcegoa.ac.in', 9.56, 8.00, 7.04, 7.54, 7.64, 0.00, 0.00, 0.00, 7.80, 0),
('2114005@dbcegoa.ac.in', 8.44, 7.59, 7.10, 6.70, 5.50, 0.00, 0.00, 0.00, 7.03, 0),
('2114006@dbcegoa.ac.in', 9.63, 9.11, 7.52, 8.38, 8.05, 0.00, 0.00, 0.00, 8.37, 0),
('2114007@dbcegoa.ac.in', 8.63, 5.94, 5.57, 5.25, 0.00, 0.00, 0.00, 0.00, 6.33, 1),
('2114010@dbcegoa.ac.in', 9.38, 9.11, 8.17, 8.46, 8.14, 0.00, 0.00, 0.00, 8.42, 0),
('2114011@dbcegoa.ac.in', 8.88, 6.06, 0.00, 5.46, 6.00, 0.00, 0.00, 0.00, 0.00, 1),
('2114012@dbcegoa.ac.in', 9.00, 8.00, 7.00, 7.00, 6.00, 0.00, 0.00, 0.00, 6.00, 0),
('2114014@dbcegoa.ac.in', 9.63, 9.61, 8.74, 9.08, 9.00, 0.00, 0.00, 0.00, 9.17, 0),
('2114015@dbcegoa.ac.in', 9.25, 9.28, 8.78, 8.92, 8.82, 0.00, 0.00, 0.00, 8.95, 0),
('2114016@dbcegoa.ac.in', 7.50, 7.00, 6.26, 6.00, 6.10, 0.00, 0.00, 0.00, 6.50, 0),
('2114017@dbcegoa.ac.in', 9.12, 8.26, 6.35, 6.67, 6.41, 0.00, 0.00, 0.00, 7.40, 0),
('2114018@dbcegoa.ac.in', 9.63, 9.44, 8.74, 9.08, 8.86, 0.00, 0.00, 0.00, 9.03, 0),
('2114019@dbcegoa.ac.in', 9.13, 8.61, 8.22, 8.21, 7.45, 0.00, 0.00, 0.00, 8.32, 0),
('2114020@dbcegoa.ac.in', 8.88, 8.61, 8.88, 7.38, 6.50, 0.00, 0.00, 0.00, 7.97, 0),
('2114022@dbcegoa.ac.in', 8.94, 8.33, 8.39, 8.25, 7.95, 0.00, 0.00, 0.00, 8.33, 0),
('2114023@dbcegoa.ac.in', 9.06, 8.39, 8.39, 8.17, 7.86, 0.00, 0.00, 0.00, 7.88, 0),
('2114026@dbcegoa.ac.in', 8.38, 7.89, 7.65, 7.75, 7.45, 0.00, 0.00, 0.00, 7.82, 0),
('2114028@dbcegoa.ac.in', 9.63, 8.83, 7.61, 7.71, 7.41, 0.00, 0.00, 0.00, 8.02, 0),
('2114030@dbcegoa.ac.in', 9.25, 9.44, 8.48, 9.04, 7.91, 0.00, 0.00, 0.00, 8.82, 0),
('2114031@dbcegoa.ac.in', 9.00, 7.67, 7.74, 7.79, 7.54, 0.00, 0.00, 0.00, 7.77, 0),
('2114032@dbcegoa.ac.in', 9.56, 9.11, 9.04, 9.04, 8.64, 0.00, 0.00, 0.00, 9.07, 0),
('2114033@dbcegoa.ac.in', 9.44, 7.94, 7.52, 6.46, 7.32, 0.00, 0.00, 0.00, 7.61, 0),
('2114034@dbcegoa.ac.in', 9.06, 7.28, 6.39, 4.75, 4.95, 0.00, 0.00, 0.00, 6.27, 0),
('2114035@dbcegoa.ac.in', 9.63, 8.22, 7.48, 7.29, 7.50, 0.00, 0.00, 0.00, 7.91, 0),
('2114037@dbcegoa.ac.in', 8.38, 5.78, 6.13, 6.83, 5.86, 0.00, 0.00, 0.00, 6.52, 0),
('2114038@dbcegoa.ac.in', 8.13, 7.17, 8.20, 6.50, 6.00, 0.00, 0.00, 0.00, 7.20, 0),
('2114039@dbcegoa.ac.in', 9.63, 8.28, 7.70, 8.00, 7.32, 0.00, 0.00, 0.00, 8.18, 0),
('2114040@dbcegoa.ac.in', 9.81, 9.33, 8.87, 9.08, 8.45, 0.00, 0.00, 0.00, 8.92, 0),
('2114041@dbcegoa.ac.in', 9.56, 7.28, 6.52, 7.13, 6.45, 0.00, 0.00, 0.00, 7.22, 0),
('2114043@dbcegoa.ac.in', 9.44, 8.85, 7.30, 6.92, 5.60, 0.00, 0.00, 0.00, 7.45, 0),
('2114044@dbcegoa.ac.in', 9.25, 9.39, 9.30, 8.92, 8.59, 0.00, 0.00, 0.00, 8.97, 0),
('2114045@dbcegoa.ac.in', 9.06, 8.33, 6.83, 6.88, 7.50, 0.00, 0.00, 0.00, 7.46, 0),
('2114046@dbcegoa.ac.in', 9.81, 9.20, 7.40, 7.60, 8.10, 0.00, 0.00, 0.00, 8.21, 0),
('2114047@dbcegoa.ac.in', 9.44, 7.22, 7.04, 6.71, 7.09, 0.00, 0.00, 0.00, 7.41, 0),
('2114048@dbcegoa.ac.in', 9.19, 6.33, 7.00, 5.96, 6.55, 0.00, 0.00, 0.00, 7.55, 0),
('2114049@dbcegoa.ac.in', 9.81, 9.61, 8.78, 9.75, 8.95, 0.00, 0.00, 0.00, 9.30, 0),
('2114050@dbcegoa.ac.in', 9.00, 5.33, 5.96, 6.54, 7.14, 0.00, 0.00, 0.00, 7.00, 0),
('2114051@dbcegoa.ac.in', 9.63, 9.35, 8.87, 8.17, 7.64, 0.00, 0.00, 0.00, 8.33, 0),
('2114053@dbcegoa.ac.in', 9.25, 8.28, 7.00, 5.83, 5.86, 0.00, 0.00, 0.00, 7.24, 0),
('2114056@dbcegoa.ac.in', 9.25, 8.33, 7.04, 6.00, 5.64, 0.00, 0.00, 0.00, 7.07, 0),
('2114057@dbcegoa.ac.in', 9.44, 9.44, 8.61, 8.63, 8.05, 0.00, 0.00, 0.00, 8.75, 0),
('2114058@dbcegoa.ac.in', 9.63, 7.78, 6.78, 8.08, 7.59, 0.00, 0.00, 0.00, 7.97, 0),
('2114059@dbcegoa.ac.in', 9.38, 9.44, 9.00, 9.17, 8.00, 0.00, 0.00, 0.00, 9.00, 0),
('2114060@dbcegoa.ac.in', 9.63, 9.32, 8.00, 8.13, 8.23, 0.00, 0.00, 0.00, 8.52, 0),
('2114061@dbcegoa.ac.in', 9.56, 8.22, 7.35, 8.00, 8.09, 0.00, 0.00, 0.00, 8.24, 0),
('2114062@dbcegoa.ac.in', 8.69, 9.06, 8.65, 8.17, 7.68, 0.00, 0.00, 0.00, 8.41, 0),
('2114063@dbcegoa.ac.in', 8.70, 7.80, 6.22, 5.67, 6.14, 0.00, 0.00, 0.00, 6.52, 0),
('2123018@dbcegoa.ac.in', 0.00, 0.00, 6.96, 5.00, 0.00, 0.00, 0.00, 0.00, 5.96, 1),
('2221003@dbcegoa.ac.in', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2221005@dbcegoa.ac.in', 0.00, 0.00, 5.35, 0.00, 5.50, 0.00, 0.00, 0.00, 5.42, 1),
('2221007@dbcegoa.ac.in', 0.00, 0.00, 5.26, 5.21, 5.27, 0.00, 0.00, 0.00, 5.24, 0),
('2221009@dbcegoa.ac.in', 0.00, 0.00, 5.52, 5.69, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2221015@dbcegoa.ac.in', 0.00, 0.00, 6.70, 6.08, 6.95, 0.00, 0.00, 0.00, 6.58, 0),
('2221019@dbcegoa.ac.in', 0.00, 0.00, 6.09, 6.54, 6.95, 0.00, 0.00, 0.00, 6.50, 0),
('2221023@dbcegoa.ac.in', 0.00, 0.00, 5.13, 0.00, 6.59, 0.00, 0.00, 0.00, 0.00, 1),
('2221025@dbcegoa.ac.in', 0.00, 0.00, 6.43, 6.40, 6.50, 0.00, 0.00, 0.00, 6.44, 0),
('2221028@dbcegoa.ac.in', 0.00, 0.00, 5.83, 6.67, 6.59, 0.00, 0.00, 0.00, 0.00, 0),
('2221030@dbcegoa.ac.in', 0.00, 0.00, 6.52, 7.83, 8.09, 0.00, 0.00, 0.00, 0.00, 0),
('2221034@dbcegoa.ac.in', 0.00, 0.00, 6.26, 6.63, 7.50, 0.00, 0.00, 0.00, 0.00, 0),
('2221035@dbcegoa.ac.in', 0.00, 0.00, 6.30, 5.58, 5.86, 0.00, 0.00, 0.00, 5.91, 0),
('2221037@dbcegoa.ac.in', 0.00, 0.00, 5.52, 0.00, 5.77, 0.00, 0.00, 0.00, 5.65, 1),
('2222003@dbcegoa.ac.in', 0.00, 0.00, 6.13, 7.04, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2222005@dbcegoa.ac.in', 0.00, 0.00, 6.48, 7.33, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2222006@dbcegoa.ac.in', 0.00, 0.00, 7.52, 7.96, 7.74, 0.00, 0.00, 0.00, 7.74, 0),
('2223001@dbcegoa.ac.in', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2223005@dbcegoa.ac.in', 0.00, 0.00, 6.17, 5.63, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2223012@dbcegoa.ac.in', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2223015@dbcegoa.ac.in', 0.00, 0.00, 5.96, 5.88, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2224001@dbcegoa.ac.in', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1),
('2224003@dbcegoa.ac.in', 0.00, 0.00, 6.50, 6.80, 7.00, 0.00, 0.00, 0.00, 6.76, 0),
('2224004@dbcegoa.ac.in', 0.00, 0.00, 6.65, 7.02, 6.50, 0.00, 0.00, 0.00, 6.72, 0),
('2224005@dbcegoa.ac.in', 0.00, 0.00, 5.61, 7.33, 6.86, 0.00, 0.00, 0.00, 6.68, 0),
('2224007@dbcegoa.ac.in', 0.00, 0.00, 5.70, 5.71, 5.81, 0.00, 0.00, 0.00, 6.00, 0);

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
('2111004@dbcegoa.ac.in', 'Angel', '', 'Rodrigues', 'angelrods2003@gmail.com', 'DBCE Fatorda', '8530461670', '2111004', '565021052', 75.00, 65.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2111006@dbcegoa.ac.in', 'Ashish', '', 'Dhuri', 'ashishdhuri55@gmail.com', 'DBCE Fatorda', '8390458925', '2111006', '437296877', 53.00, 56.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111009@dbcegoa.ac.in', 'Bigesh', '', 'Velip', 'bigeshvelip08@gmail.com', 'DBCE Fatorda', '9130768171', '2111009', '622139836', 62.17, 56.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111010@dbcegoa.ac.in', 'Brendon', '', 'Rodrigues', 'brendonrod07@gmail.com', 'DBCE Fatorda', '7020757900', '2111010', '194263039', 81.50, 93.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111012@dbcegoa.ac.in', 'Clarita', '', 'De Souza', 'claritadesouza07@gmail.com', 'DBCE Fatorda', '9067700378', '2111012', '736408607', 87.50, 75.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2111015@dbcegoa.ac.in', 'Kshitiz', '', 'KC', 'kshitizkc658@gmail.com', 'DBCE Fatorda', '7798280609', '2111015', '405738700', 81.60, 68.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111017@dbcegoa.ac.in', 'Rachel', 'Abigail', 'Fernandes', 'rachel02ferns@gmail.com', 'DBCE Fatorda', '8275056817', '2111017', '115483258', 80.33, 76.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2111018@dbcegoa.ac.in', 'Rajat', '', 'Kashalkar', 'rajatkashalkar35@gmail.com', 'DBCE Fatorda', '7875911506', '2111018', '178919757', 72.50, 65.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111023@dbcegoa.ac.in', 'Sunraj', 'Naik', 'Gaonkar', 'sanrajdesai971@gmail.com', 'DBCE Fatorda', '9823951346', '2111023', '407224116', 91.00, 89.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111026@dbcegoa.ac.in', 'Yashdeep', 'Suresh', 'Naik', 'naikyashdeep@gmail.com', 'DBCE Fatorda', '7350611639', '2111026', '200267361', 74.00, 59.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2111027@dbcegoa.ac.in', 'Yohan', '', 'Antao', 'yohanantao@gmail.com', 'DBCE Fatorda', '9527800810', '2111027', '103397508', 87.50, 81.17, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2112001@dbcegoa.ac.in', 'Aaron', '', 'Rodrigues', 'aaronantoniorodrigues@gmail.com', 'DBCE Fatorda', '9405864618', '2112001', '572313888', 79.83, 74.17, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112005@dbcegoa.ac.in', 'AKSHAY', '', 'KADAM', 'akshaykadamx10@gmail.com', 'DBCE Fatorda', '9960871964', '2112005', '245751940', 78.00, 70.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112007@dbcegoa.ac.in', 'ANIKET', '', 'BHASKAR', 'Aniketbhaskar0911@gmail.com', 'DBCE Fatorda', '8208670959', '2112007', '898103174', 73.00, 70.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112010@dbcegoa.ac.in', 'Cavan', '', 'Serrao', 'cavanserrao@gmail.com', 'DBCE Fatorda', '8669531298', '2112010', '149034214', 82.50, 65.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112013@dbcegoa.ac.in', 'Ignatius', 'Jonas Benson', 'D\'silva', 'dsilvajonas13@gmail.com', 'DBCE Fatorda', '9146256414', '2112013', '556338319', 85.00, 69.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112020@dbcegoa.ac.in', 'Masilon', '', 'Mascarenhas', 'masilonofffcial@gmail.com', 'DBCE Fatorda', '9359307310', '2112020', '311386351', 84.00, 72.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112021@dbcegoa.ac.in', 'Mohammad', 'Ali', 'Sheikh', 'MOHAMMADALISHEIKH059@GMAIL.COM', 'DBCE Fatorda', '8856975377', '2112021', '667635086', 76.50, 66.66, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112066@dbcegoa.ac.in', 'Imran', '', 'Suhel', 'mohammed.imran0811@gmail.com', 'DBCE Fatorda', '9960084838', '2112066', '994284990', 77.33, 68.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112067@dbcegoa.ac.in', 'MYRON', '', 'FERNANDES', 'myronfernandes906@gmail.com', 'DBCE Fatorda', '9373495139', '2112067', '556871237', 81.00, 75.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112077@dbcegoa.ac.in', 'Rio', '', 'De Mello', 'riodmello28@gmail.com', 'DBCE Fatorda', '9970798828', '2112077', '174032192', 69.00, 57.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112083@dbcegoa.ac.in', 'Vishalkumar', '', 'Singh', 'vishals8997@gmail.com', 'DBCE Fatorda', '7887489901', '2112083', '575301068', 47.83, 58.66, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112085@dbcegoa.ac.in', 'Xavier', '', 'Furtado', 'xavierfurtado20@gmail.com', 'DBCE Fatorda', '9405226427', '2112085', '979970701', 84.50, 73.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2112086@dbcegoa.ac.in', 'Yash', '', 'Kurade', 'yashkurade13@gmail.com', 'DBCE Fatorda', '9011654654', '2112086', '183139098', 87.50, 80.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2113001@dbcegoa.ac.in', 'Ackyshma', '', 'Fernandes', 'ackyshmafernandes0206@gmail.com', 'DBCE Fatorda', '7972319073', '2113001', '792693092', 85.33, 76.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113002@dbcegoa.ac.in', 'Aloysh', '', 'Costa', 'aloyshcosta@gmail.com', 'DBCE Fatorda', '7038843620', '2113002', '760363893', 71.00, 60.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113003@dbcegoa.ac.in', 'Anushka', '', 'Bhagat', 'anushkabhagat03@gmail.com', 'DBCE Fatorda', '8975924820', '2113003', '192968491', 70.33, 62.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113005@dbcegoa.ac.in', 'Ravi', 'kiran', 'Boina', 'b.ravikiran19@gmail.com', 'DBCE Fatorda', '9392711379', '2113005', '773657921', 65.60, 80.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113007@dbcegoa.ac.in', 'Ketan', '', 'Gaonkar', 'ketangaonkar3@gmail.com', 'DBCE Fatorda', '9284580717', '2113007', '227139923', 75.17, 72.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113008@dbcegoa.ac.in', 'Aryan', '', 'Khochare', 'aryankhochare184@gmail.com', 'DBCE Fatorda', '8356906948', '2113008', '992671281', 85.00, 81.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113009@dbcegoa.ac.in', 'LAKSHMI', 'DURGA', 'MOPIDEVI', 'lakshmidurgamopidevi@gmail.com', 'DBCE Fatorda', '9403654716', '2113009', '728268670', 66.00, 87.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113016@dbcegoa.ac.in', 'Sachi', '', 'Bokade', 'Sachibokade22@gmail.com', 'DBCE Fatorda', '9356951051', '2113016', '553949866', 86.83, 85.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113017@dbcegoa.ac.in', 'Sahil', '', 'Velip', 'sahilvelip8@gmail.com', 'DBCE Fatorda', '7972726689', '2113017', '811583466', 83.50, 63.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113020@dbcegoa.ac.in', 'Sanika', '', 'Desai', 'sanikadesai5810@gmail.com', 'DBCE Fatorda', '9356774173', '2113020', '715190500', 78.83, 69.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113021@dbcegoa.ac.in', 'Shan', '', 'Jammihal', 'shanjammihal13@gmail.com', 'DBCE Fatorda', '9637874166', '2113021', '748808963', 64.00, 58.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113022@dbcegoa.ac.in', 'Shravni', '', 'Ubale', 'shravni.ubale3012@gmail.com', 'DBCE Fatorda', '9309980284', '2113022', '567225192', 78.60, 78.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'F', 0, 1),
('2113023@dbcegoa.ac.in', 'Shreyash', '', 'Shinde', 'shreyashshinde895@gmail.com', 'DBCE Fatorda', '7798656774', '2113023', '699986618', 79.00, 62.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113025@dbcegoa.ac.in', 'Stencio', '', 'Dias', 'stenciodias@gmail.com', 'DBCE Fatorda', '9307185830', '2113025', '143495538', 85.00, 69.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113026@dbcegoa.ac.in', 'Sushant', '', 'Shetti', 'sushantshetti775@gmail.com', 'DBCE Fatorda', '7499223622', '2113026', '485356796', 89.83, 80.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2113027@dbcegoa.ac.in', 'Varun', '', 'Castello', 'ccvarun07@gmail.com', 'DBCE Fatorda', '9146992833', '2113027', '839307234', 79.00, 73.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2114002@dbcegoa.ac.in', 'Aartika', '', 'Salkar', 'aartikasalkar74@gmail.com', 'DBCE Fatorda', '9309183563', '2114002', '801309958', 91.00, 71.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114003@dbcegoa.ac.in', 'Abhinav', '', 'Naik', 'abhinavnaik238@gmail.com', 'DBCE Fatorda', '7420940568', '2114003', '295756152', 69.50, 63.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114005@dbcegoa.ac.in', 'Andrea', 'Treeza', 'Fernandes', 'andreafernandes1903@gmail.com', 'DBCE Fatorda', '8805899119', '2114005', '201689357', 79.00, 72.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114006@dbcegoa.ac.in', 'Anish', '', 'Naik Mule', 'nanish909@gmail.com', 'DBCE Fatorda', '9022541380', '2114006', '413351959', 86.00, 70.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114007@dbcegoa.ac.in', 'Anurag', '', 'Mallela', 'anuragmallela@gmail.com', 'DBCE Fatorda', '9049746999', '2114007', '288901936', 67.30, 58.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114010@dbcegoa.ac.in', 'Christie', '', 'Fernandes', 'christie.ferns36@gmail.com', 'DBCE Fatorda', '9579286178', '2114010', '253639642', 89.00, 77.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114011@dbcegoa.ac.in', 'Darshil', '', 'Naik', 'darshilnaik14@gmail.com', 'DBCE Fatorda', '8010145292', '2114011', '478924910', 77.00, 60.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114012@dbcegoa.ac.in', 'Dhiraj', '', 'Pagui', 'dhirajpagi06@gmail.com', 'DBCE Fatorda', '9607477211', '2114012', '713355970', 69.00, 69.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114014@dbcegoa.ac.in', 'Dhruv', '', 'Naik', 'dbbdnaik27@gmail.com', 'DBCE Fatorda', '9545869437', '2114014', '312178231', 96.20, 96.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114015@dbcegoa.ac.in', 'Dickson', '', 'Dias', 'diasdickson94@gmail.com', 'DBCE Fatorda', '8767563165', '2114015', '999725583', 88.00, 75.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114016@dbcegoa.ac.in', 'Divyatej', '', 'Sawant', 'divyatejsawant@gmail.com', 'DBCE Fatorda', '9922064670', '2114016', '338710186', 86.00, 71.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114017@dbcegoa.ac.in', 'Eshan', 'Sawant', 'Desai', 'eshandesai13@gmail.com', 'DBCE Fatorda', '8329587975', '2114017', '218810333', 76.00, 67.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114018@dbcegoa.ac.in', 'Gavin', '', 'Da Costa', 'gavindacosta9307@gmail.com', 'DBCE Fatorda', '9307325976', '2114018', '386018443', 89.50, 83.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114019@dbcegoa.ac.in', 'Glory', '', 'D\'Cruz', 'dcruzglory03@gmail.com', 'DBCE Fatorda', '8605983242', '2114019', '531015652', 85.00, 70.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114020@dbcegoa.ac.in', 'Jessica', '', 'Alvares', 'jessalvares203@gmail.com', 'DBCE Fatorda', '9860026753', '2114020', '140527602', 80.00, 71.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114022@dbcegoa.ac.in', 'Jonas', '', 'Ferrao', 'jonaschris2103@gmail.com', 'DBCE Fatorda', '8805513038', '2114022', '111055312', 80.30, 68.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114023@dbcegoa.ac.in', 'Joseph', '', 'Makkimane', 'josephmmakkimane@gmail.com', 'DBCE Fatorda', '8669162393', '2114023', '636822702', 90.00, 81.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114026@dbcegoa.ac.in', 'Khizer', '', 'Khan', 'khizer2113khan@gmail.com', 'DBCE Fatorda', '9373660399', '2114026', '325346548', 82.50, 60.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114028@dbcegoa.ac.in', 'Langer', '', 'Pereira', 'langerpereira12@gmail.com', 'DBCE Fatorda', '7218389307', '2114028', '656675557', 78.17, 65.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114030@dbcegoa.ac.in', 'Mathias', '', 'Fernandes', 'fernandesmathias15@gmail.com', 'DBCE Fatorda', '7666023115', '2114030', '715707992', 76.70, 63.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114031@dbcegoa.ac.in', 'Nathan', '', 'Ferrao', 'ferraonathan@gmail.com', 'DBCE Fatorda', '9511906793', '2114031', '187737765', 78.10, 72.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114032@dbcegoa.ac.in', 'Nikhil', '', 'Rao', 'raonik1003@gmail.com', 'DBCE Fatorda', '9359206776', '2114032', '190530406', 90.00, 79.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114033@dbcegoa.ac.in', 'Patric', '', 'Colaco', 'patcolaco2507@gmail.com', 'DBCE Fatorda', '9075664525', '2114033', '511839412', 81.83, 73.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114034@dbcegoa.ac.in', 'Pierson', '', 'Fernandes', 'fernandespierson03@gmail.com', 'DBCE Fatorda', '7066829410', '2114034', '412053845', 74.50, 62.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114035@dbcegoa.ac.in', 'Pranav', '', 'Naik', 'naikpranav110803@gmail.com', 'DBCE Fatorda', '7720996607', '2114035', '454792296', 88.83, 78.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114037@dbcegoa.ac.in', 'Ralph', '', 'Rodrigues', 'ralphr2910@gmail.com', 'DBCE Fatorda', '7517617029', '2114037', '688890528', 72.00, 65.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114038@dbcegoa.ac.in', 'Rhys', '', 'Rodrigues', 'Rod.', 'DBCE Fatorda', '7588354003', '2114038', '186998558', 70.00, 62.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114039@dbcegoa.ac.in', 'Ruchi', '', 'Bokade', 'ruchibokade023@gmail.com', 'DBCE Fatorda', '8668445692', '2114039', '573361806', 91.83, 89.50, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114040@dbcegoa.ac.in', 'Sagar', '', 'Lotlikar', 'sagarlotlikar2003@gmail.com', 'DBCE Fatorda', '9356022795', '2114040', '847023787', 80.83, 80.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114041@dbcegoa.ac.in', 'Sahil', '', 'Kholkar', 'Sahilkholkar@gmail.com', 'DBCE Fatorda', '7620568859', '2114041', '734514881', 81.20, 89.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114043@dbcegoa.ac.in', 'Samuel', '', 'Miranda', 'mirandasamuel728@gmail.com', 'DBCE Fatorda', '9028452328', '2114043', '969443039', 76.16, 65.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114044@dbcegoa.ac.in', 'Samuel', 'Thomas', 'Mesquita', 'sammesquita1604@gmail.com', 'DBCE Fatorda', '7083096516', '2114044', '110008249', 84.50, 79.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114045@dbcegoa.ac.in', 'Sarthak', '', 'Mhalsekar', 'Sarthakmhalsekar26@gmail.com', 'DBCE Fatorda', '8767083780', '2114045', '840516361', 70.16, 61.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114046@dbcegoa.ac.in', 'Shaunak', '', 'Narvekar', '2114046@dbcegoa.ac.in', 'DBCE Fatorda', '7588116943', '2114046', '471618851', 93.60, 80.30, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114047@dbcegoa.ac.in', 'Sherwin', '', 'Gonsalves', 'Sherwingonsalves.sg@gmail.com', 'DBCE Fatorda', '8605609000', '2114047', '538609321', 74.16, 66.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114048@dbcegoa.ac.in', 'Shivani', '', 'Shirodkar', 'shivanishirodkar19@gmail.com', 'DBCE Fatorda', '8208925809', '2114048', '106990540', 72.00, 61.33, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114049@dbcegoa.ac.in', 'Shridevi', '', 'Bharne', 'shridevibharne33@gmail.com', 'DBCE Fatorda', '9823988533', '2114049', '612369270', 88.17, 82.17, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114050@dbcegoa.ac.in', 'Shrusti', '', 'Khadji', 'shrustikhadji0211@gmail.com', 'DBCE Fatorda', '8390335346', '2114050', '161268730', 69.00, 58.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114051@dbcegoa.ac.in', 'SHUBHAM', '', 'NAIK', 'shubhamnaik106@gmail.com', 'DBCE Fatorda', '8208903823', '2114051', '481165610', 84.00, 75.16, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114053@dbcegoa.ac.in', 'Stephen', '', 'Fernandes', 'stephenferns2003@gmail.com', 'DBCE Fatorda', '9561022953', '2114053', '527515981', 65.00, 67.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114056@dbcegoa.ac.in', 'Syndroy', '', 'Araujo', 'syndroy20araujo@gmail.com', 'DBCE Fatorda', '7775968113', '2114056', '314504023', 76.00, 70.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114057@dbcegoa.ac.in', 'Terrence', '', 'Braganca', 'terrencebraganca987@gmail.com', 'DBCE Fatorda', '8421048011', '2114057', '825070652', 86.50, 78.67, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114058@dbcegoa.ac.in', 'Vaibhavi', '', 'Naik', 'vaibhavinaik17032003@gmail.com', 'DBCE Fatorda', '8669017292', '2114058', '694282380', 83.00, 63.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114059@dbcegoa.ac.in', 'Ved', '', 'Kerkar', 'vedkerkar10@gmail.com', 'DBCE Fatorda', '8767388109', '2114059', '143646205', 83.66, 80.83, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114060@dbcegoa.ac.in', 'Vedant', '', 'Gad', 'vedantgad25@gmail.com', 'DBCE Fatorda', '9130021185', '2114060', '172499201', 90.90, 77.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114061@dbcegoa.ac.in', 'Vishakha', '', 'Durbhatkar', 'vishakhadurbhatkar08@gmail.com', 'DBCE Fatorda', '9850477369', '2114061', '570087190', 86.50, 76.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'F', 0, 1),
('2114062@dbcegoa.ac.in', 'Warren', '', 'Rodrigues', 'warrenrod7@gmail.com', 'DBCE Fatorda', '9518572503', '2114062', '975712846', 82.50, 68.80, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2114063@dbcegoa.ac.in', 'Yagnesh', '', 'Karwarker', 'yagneshkarwarker. 1@gmail.com', 'DBCE Fatorda', '9370835016', '2114063', '165082685', 91.40, 72.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2123018@dbcegoa.ac.in', 'Maynard', '', 'Rodrigues', 'Maynardrodrigues111@gmail.com', 'DBCE Fatorda', '9921969516', '2123018', '213952603', 51.60, 74.08, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2221003@dbcegoa.ac.in', 'Brenie', '', 'Fernandes', 'breniefernandes3@gmail.com', 'DBCE Fatorda', '7767989398', '2221003', '861042927', 64.00, 60.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221005@dbcegoa.ac.in', 'Bhasker', '', 'Gain', 'bhaskargains21@gmail.com', 'DBCE Fatorda', '9834905388', '2221005', '561624564', 66.00, 63.61, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221007@dbcegoa.ac.in', 'Harsh', '', 'Kambli', 'harshkambli1@gmail.com', 'DBCE Fatorda', '8208067346', '2221007', '660025755', 54.83, 49.60, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221009@dbcegoa.ac.in', 'Houston', '', 'Andrade', 'andradehouston1@gmail.com', 'DBCE Fatorda', '7798966377', '2221009', '134656402', 68.00, 56.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221015@dbcegoa.ac.in', 'Mohammed', 'Sahil', 'Shaikh', '007sahilshaik@gmail.com', 'DBCE Fatorda', '8975705402', '2221015', '987328201', 53.67, 69.78, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221019@dbcegoa.ac.in', 'Pranil', '', 'Naik', '2221019@dbcegoa.ac.in', 'DBCE Fatorda', '7972075904', '2221019', '217694865', 73.50, 68.80, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221023@dbcegoa.ac.in', 'Purva', '', 'Kankonkar', 'kankonkar10purva@gmail.com', 'DBCE Fatorda', '9921830314', '2221023', '749804549', 72.00, 57.51, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2221025@dbcegoa.ac.in', 'Ruisha', '', 'Chari', 'rchari123abc@gmail.com', 'DBCE Fatorda', '9823844963', '2221025', '542166784', 71.33, 68.58, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2221028@dbcegoa.ac.in', 'Sanjana', '', 'Gaude', 'sanjanagaude6@gmail.com', 'DBCE Fatorda', '7821061994', '2221028', '307249609', 41.23, 62.76, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2221030@dbcegoa.ac.in', 'Sejal', '', 'Shet Govekar', 'Sejalgovekar811@gmail.com', 'DBCE Fatorda', '9834433538', '2221030', '627593917', 78.00, 72.18, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2221034@dbcegoa.ac.in', 'Tirtesh', '', 'Paryekar', 'tirteshpayekar@gmail.com', 'DBCE Fatorda', '9405370158', '2221034', '712507004', 63.33, 68.71, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2221035@dbcegoa.ac.in', 'Vanchita', '', 'Kauthankar', 'vanchitakauthankar@gmail.com', 'DBCE Fatorda', '7820853807', '403504', '567416218', 69.00, 65.24, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'F', 0, 1),
('2221037@dbcegoa.ac.in', 'Shubham', '', 'Verlekar', 'verlekar.shubham2000@gmail.com', 'DBCE Fatorda', '9145570696', '2221037', '999259778', 66.33, 63.40, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 8, '2021', 'M', 0, 1),
('2222003@dbcegoa.ac.in', 'Arya', '', 'Naik', 'aryanaik88@gmail.com', 'DBCE Fatorda', '7218522968', '2222003', '402780880', 61.20, 77.20, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'F', 0, 1),
('2222005@dbcegoa.ac.in', 'Delton', '', 'Fernandes', 'delton19mh03@gmail.com', 'DBCE Fatorda', '9623856798', '2222005', '124750771', 73.00, 77.16, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2222006@dbcegoa.ac.in', 'Somesh', '', 'Sawant', 'sawantsomesh3@gmail.com', 'DBCE Fatorda', '8552963242', '2222006', '328693940', 68.00, 66.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 4, '2021', 'M', 0, 1),
('2223001@dbcegoa.ac.in', 'Ashvek', '', 'Dessai', 'ashdessai2002@gmail.com', 'DBCE Fatorda', '9518778690', '2223001', '727756042', 60.00, 78.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2223005@dbcegoa.ac.in', 'Deep', '', 'Velip', 'velipdeep6@gmail.com', 'DBCE Fatorda', '9420185026', '2223005', '193414765', 68.50, 82.75, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2223012@dbcegoa.ac.in', 'Sahil', '', 'Rane', 'sahilrane38@gmail.com', 'DBCE Fatorda', '8530885075', '2223012', '106446536', 62.00, 69.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2223015@dbcegoa.ac.in', 'Soham', '', 'Tulaskar', 'sohamtulaskar94@gmail.com', 'DBCE Fatorda', '8830487603', '2223015', '508866189', 54.66, 70.31, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 6, '2021', 'M', 0, 1),
('2224001@dbcegoa.ac.in', 'ADITYA', '', 'PATIL', 'rngmr.frizz@gmail.com', 'DBCE Fatorda', '8208288391', '2224001', '141708356', 60.00, 74.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2224003@dbcegoa.ac.in', 'Elton', '', 'Costa', 'elton02costa@gmail.com', 'DBCE Fatorda', '9604344945', '2224003', '134356011', 76.00, 80.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2224004@dbcegoa.ac.in', 'Pio', '', 'D\'silva', '2224004@dbcegoa.ac.in', 'DBCE Fatorda', '7038969640', '2224004', '220782206', 72.83, 77.42, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2224005@dbcegoa.ac.in', 'Sagar', '', 'Verlekar', 'sagarverlekar2017@gmail.com', 'DBCE Fatorda', '7038191276', '2224005', '358605151', 60.66, 79.64, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1),
('2224007@dbcegoa.ac.in', 'Siddant', '', 'Prabhudessai', 'siddantprabhudessai@gmail.com', 'DBCE Fatorda', '7558697595', '2224007', '264719546', 66.00, 70.00, '$2y$10$l4bOsCIKE7YXIk/hD1KEY.5zrWzKm1VgXWjs05Ym.8dak3Uy9i2JC', '', 'Default_Profile_Pic.jpg', '', '', 2, '2021', 'M', 0, 1);

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
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
