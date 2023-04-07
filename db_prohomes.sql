-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 03:38 PM
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
-- Database: `db_prohomes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `Address_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `House` varchar(50) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `State` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Locality` varchar(50) NOT NULL,
  `Landmark` varchar(50) NOT NULL,
  `Pincode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`Address_ID`, `User_ID`, `House`, `Street`, `State`, `City`, `Locality`, `Landmark`, `Pincode`) VALUES
(7, 42, 'Room no 413', 'Koovapally', 'Kanjirappaly', 'kochi', 'Kanjirappaly', 'Amal Jyothi Collage', '686610'),
(9, 42, 'Narithookil House', 'Shanthinagar', 'Kerala', 'kochi', 'Kattappana', 'St George Church', '685515'),
(20, 44, '234 B', 'b35 avenue', 'kerala', 'kochi', 'kadavanthra', 'lulu mall', '675678'),
(21, 46, 'iluhjgf', 'fhgd', 'trhygd', 'kottayam', 'rtgr', 'rtyr', '345345'),
(22, 45, 'xdf', 'sfs', 'sdfs', 'kottayam', 'sdfs', 'fsf', '343255'),
(23, 54, 'wer', 'wer', 'wer', 'kottayam', 'wer', 'werwe', '324544'),
(24, 84, 'fghfd', 'fghf', 'ghfghfg', 'kottayam', 'hfgh', 'fghfg', '453343');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `Payment_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Request_ID` int(11) NOT NULL,
  `Provider_ID` int(11) NOT NULL,
  `Gateway_Order_ID` varchar(50) NOT NULL,
  `Amount` varchar(10) NOT NULL,
  `Payment_Status` varchar(20) NOT NULL,
  `Payment_Request_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Payment_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`Payment_ID`, `User_ID`, `Request_ID`, `Provider_ID`, `Gateway_Order_ID`, `Amount`, `Payment_Status`, `Payment_Request_Date`, `Payment_Date`) VALUES
(5, 46, 7, 21, 'order_20230326123109', '275.98', 'paid', '2023-03-14 15:24:20', '2023-03-26'),
(6, 54, 15, 21, '', '403.82', 'pending', '2023-03-14 15:31:51', '0000-00-00'),
(11, 84, 16, 21, '', '144.51', 'pending', '2023-03-14 15:43:36', '0000-00-00'),
(12, 42, 17, 21, '', '321.77', 'paid', '2023-03-14 16:53:16', '0000-00-00'),
(13, 45, 18, 21, '', '363.15', 'pending', '2023-03-14 17:13:21', '0000-00-00'),
(14, 45, 19, 21, '', '148.22', 'pending', '2023-03-15 03:44:55', '0000-00-00'),
(15, 42, 20, 23, 'order_20230326085402', '844.78', 'paid', '2023-03-17 09:07:49', '2023-03-26'),
(16, 42, 22, 24, 'order_20230322182235', '3562.87', 'paid', '2023-03-22 17:22:25', '2023-03-22'),
(17, 42, 23, 24, 'order_20230328163100', '2001.59', 'paid', '2023-03-26 09:03:23', '2023-03-28'),
(18, 46, 24, 21, 'order_20230329115311', '1617.82', 'paid', '2023-03-29 09:52:56', '2023-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `Service_ID` int(11) NOT NULL,
  `Service_Name` varchar(50) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`Service_ID`, `Service_Name`, `Description`) VALUES
(1, 'Electrician', 'Provides electrical repair and maintenance services.'),
(2, 'Plumbing', 'Provides plumbing repair and maintenance services.'),
(3, 'Deep Cleaning', 'Provides deep cleaning services for residential and commercial spaces.'),
(4, 'Bathroom Cleaning', 'Provides cleaning services specifically for bathrooms.'),
(5, 'Repair/Installation', 'Provides repair and installation services for appliances and fixtures.'),
(6, 'Home Cleaning', 'Provides general cleaning services for residential spaces.'),
(7, 'Painting', 'Provides painting services for residential and commercial spaces.'),
(8, 'Carpenters', 'Provides carpentry and woodworking services.'),
(9, 'Packers/Movers', 'Provides packing and moving services for residential and commercial spaces.'),
(10, 'Computer Repair', 'Provides repair and maintenance services for computers and related equipment.'),
(11, 'Exterminator', 'Provides pest control services.'),
(12, 'Driver', 'Provides transportation services for people or goods.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider`
--

CREATE TABLE `tbl_service_provider` (
  `Provider_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Service_Desc` text NOT NULL,
  `Qualification_File` varchar(200) NOT NULL,
  `Insurance_File` varchar(200) NOT NULL,
  `Certificate_File` varchar(200) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Verification_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_provider`
--

INSERT INTO `tbl_service_provider` (`Provider_ID`, `User_ID`, `Service_ID`, `Address`, `Service_Desc`, `Qualification_File`, `Insurance_File`, `Certificate_File`, `Price`, `Verification_status`) VALUES
(19, 46, 1, '123 Main St', 'Provides electrical repair and maintenance services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '100.99', 'verfied'),
(21, 42, 3, '789 Oak St', 'Provides deep cleaning services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '300.99', 'verfied'),
(22, 85, 4, '321 Pine St', 'Provides cleaning services specifically for bathrooms.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '240.99', 'verfied'),
(23, 45, 5, '654 Maple St', 'Provides repair and installation services for appliances and fixtures.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '150.99', 'verfied'),
(24, 84, 6, '987 Cedar St', 'Provides general cleaning services for residential spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '360.99', 'verfied'),
(25, 49, 7, '147 Walnut St', 'Provides painting services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '470.99', 'verfied'),
(26, 48, 8, '258 Birch St', 'Provides carpentry and woodworking services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '180.99', 'verfied'),
(27, 51, 9, '369 Elm St', 'Provides packing and moving services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '290.99', 'verfied'),
(28, 54, 10, '753 Oak St', 'Provides repair and maintenance services for computers and related equipment.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '100.99', 'verfied'),
(29, 44, 11, '246 Pine St', 'Provides pest control services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '110.99', 'verfied'),
(30, 57, 12, '369 Maple St', 'Provides transportation services for people or goods.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '120.99', 'verfied'),
(31, 43, 1, '369 Cedar St', 'Provides electrical repair and maintenance services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '130.99', 'verfied');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider_availability`
--

CREATE TABLE `tbl_service_provider_availability` (
  `Provider_Availability_ID` int(10) NOT NULL,
  `Provider_ID` int(10) NOT NULL,
  `Unavailable Dates` text NOT NULL,
  `Sunday_Unvailable` varchar(10) NOT NULL DEFAULT 'no',
  `Workday_Start` time NOT NULL,
  `Workday_End` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_provider_availability`
--

INSERT INTO `tbl_service_provider_availability` (`Provider_Availability_ID`, `Provider_ID`, `Unavailable Dates`, `Sunday_Unvailable`, `Workday_Start`, `Workday_End`) VALUES
(10, 19, '2023-03-24, 2023-03-28', 'No', '08:45:00', '20:40:00'),
(12, 21, '2023-03-30, 2023-03-31, 2023-04-05, 2023-04-06', 'Yes', '07:00:00', '20:00:00'),
(13, 22, '', 'No', '08:08:50', '20:15:28'),
(14, 23, '2023-03-29, 2023-03-30', 'Yes', '08:00:00', '20:00:00'),
(15, 24, '', 'No', '08:50:49', '20:27:42'),
(16, 25, '', 'Yes', '08:00:00', '20:00:00'),
(17, 26, '', 'No', '08:46:03', '20:27:10'),
(18, 27, '', 'Yes', '08:00:00', '20:00:00'),
(19, 28, '', 'No', '08:00:00', '20:00:00'),
(20, 29, '', 'No', '08:00:00', '20:00:00'),
(21, 30, '', 'No', '08:00:00', '20:00:00'),
(22, 31, '', 'No', '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider_ratings`
--

CREATE TABLE `tbl_service_provider_ratings` (
  `Rating_ID` int(11) NOT NULL,
  `Provider_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Review` text NOT NULL,
  `Review_Date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_provider_ratings`
--

INSERT INTO `tbl_service_provider_ratings` (`Rating_ID`, `Provider_ID`, `User_ID`, `Rating`, `Review`, `Review_Date`) VALUES
(1, 19, 46, 5, 'I had a great experience with this provider. They were very professional and friendly. Highly recommended.', '2022-08-11 14:22:05'),
(2, 19, 89, 4, 'Decent service. I had some issues with the quality of work, but they were resolved quickly.', '2022-06-23 09:15:43'),
(3, 19, 42, 4, 'The provider was prompt and efficient. Overall, I am satisfied with the service.', '2022-07-08 11:30:22'),
(4, 19, 85, 5, 'I am very happy with the service I received from this provider. They went above and beyond to make sure I was satisfied.', '2022-05-29 16:40:17'),
(5, 19, 45, 2, 'I had a bad experience with this provider. The work was not up to par and they were difficult to work with.', '2022-09-01 13:55:12'),
(6, 21, 84, 4, 'The provider was very professional and did a good job. I would recommend them.', '2022-07-15 10:20:09'),
(7, 21, 49, 4, 'The service was decent, but nothing exceptional. I had some issues with scheduling and communication.', '2022-06-05 12:45:34'),
(8, 21, 48, 5, 'I had an excellent experience with this provider. They were very responsive and did a great job.', '2022-05-10 15:30:02'),
(9, 21, 51, 2, 'I was very disappointed with the service I received from this provider. The work was subpar and the communication was poor.', '2022-08-27 08:50:56'),
(10, 21, 54, 5, 'I had a great experience with this provider. They were very professional and the work was completed quickly.', '2022-09-12 17:10:23'),
(11, 19, 46, 4, 'Great service! The provider was very professional and efficient.', '2022-11-15 10:30:00'),
(12, 19, 89, 3, 'The provider was okay. The service was completed, but nothing special.', '2022-10-20 14:45:00'),
(13, 19, 42, 5, 'The provider was amazing! They went above and beyond to make sure the job was done right.', '2022-09-05 16:20:00'),
(14, 19, 85, 2, 'I was disappointed with the service. The provider seemed uninterested in the job.', '2022-08-01 12:10:00'),
(15, 19, 45, 4, 'The provider was great! They were on time and did a fantastic job.', '2022-07-12 09:15:00'),
(16, 21, 84, 3, 'The provider was fine, but not exceptional. The service was completed as expected.', '2022-12-10 13:30:00'),
(17, 21, 49, 2, 'I was not satisfied with the service. The provider seemed inexperienced.', '2022-11-05 11:40:00'),
(18, 21, 48, 4, 'The provider was great! They were very friendly and did a wonderful job.', '2022-10-02 16:00:00'),
(19, 21, 51, 5, 'The provider was amazing! They were very knowledgeable and efficient.', '2022-09-14 10:45:00'),
(20, 21, 54, 3, 'The provider was okay. The service was completed, but nothing stood out.', '2022-08-11 12:30:00'),
(21, 22, 44, 5, 'The provider was fantastic! They did a great job and were very professional.', '2022-12-20 14:00:00'),
(22, 22, 57, 4, 'The provider was great! Theyarrived on time and completed the job to a high standard.', '2022-11-18 11:20:00'),
(23, 22, 43, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-10-15 15:30:00'),
(24, 22, 86, 2, 'I was disappointed with the service. The provider was not very professional.', '2022-09-22 09:00:00'),
(25, 22, 47, 4, 'The provider was great! They were very friendly and efficient.', '2022-08-25 12:45:00'),
(26, 23, 50, 3, 'The provider was fine, but nothing stood out about the service.', '2022-12-23 16:00:00'),
(27, 23, 38, 2, 'I was not satisfied with the service. The provider was not very professional.', '2022-11-29 10:10:00'),
(28, 23, 53, 5, 'The provider was fantastic! They were very knowledgeable and completed the job quickly.', '2022-10-26 13:15:00'),
(29, 23, 52, 4, 'The provider was great! They were on time and did a fantastic job.', '2022-09-30 15:40:00'),
(30, 23, 58, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-08-27 11:30:00'),
(31, 24, 10, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-12-08 12:00:00'),
(32, 24, 46, 3, 'The provider was okay. The service was completed, but nothing stood out.', '2022-11-05 14:20:00'),
(33, 24, 89, 5, 'The provider was fantastic! They were very professional and efficient.', '2022-10-08 10:30:00'),
(34, 24, 42, 4, 'The provider was great! They completed the job to a high standard.', '2022-09-16 09:15:00'),
(35, 24, 85, 2, 'I was disappointed with the service. The provider was not very professional.', '2022-08-20 13:00:00'),
(36, 25, 45, 5, 'The provider was fantastic! They were very professional and efficient.', '2022-12-31 10:45:00'),
(37, 25, 84, 4, 'The provider was great! They were on time and completed the job to a high standard.', '2022-11-27 12:30:00'),
(38, 25, 49, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-10-31 15:20:00'),
(39, 25, 48, 2, 'I was not satisfied with the service. The provider was not very professional.', '2022-09-24 09:30:00'),
(40, 25, 51, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-08-28 11:50:00'),
(41, 26, 54, 3, 'The provider was okay. The service was completed, but nothing stood out.', '2022-12-22 14:15:00'),
(42, 26, 44, 4, 'The provider was great! They were very professional and efficient.', '2022-11-16 16:40:00'),
(43, 26, 57, 5, 'The provider was fantastic! They completed the job to a high standard.', '2022-10-19 10:10:00'),
(44, 26, 43, 2, 'I was disappointed with the service. The provider was not very professional.', '2022-09-22 09:00:00'),
(45, 26, 86, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-08-25 12:45:00'),
(46, 27, 47, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '0000-00-00 00:00:00'),
(47, 27, 50, 5, 'The provider was fantastic! They were very professional and efficient.', '2022-11-28 11:30:00'),
(48, 27, 38, 3, 'The provider was okay. The service was completed, but nothing stood out.', '2022-10-25 13:50:00'),
(49, 27, 53, 2, 'I was not satisfied with the service. The provider was not very professional.', '2022-09-18 08:00:00'),
(50, 27, 52, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-08-21 10:15:00'),
(51, 28, 89, 5, 'The provider was fantastic! They completed the job to a high standard.', '2022-12-29 09:30:00'),
(52, 28, 42, 4, 'The provider was great! They were very professional and efficient.', '2022-11-26 11:45:00'),
(53, 28, 85, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-10-30 14:00:00'),
(54, 28, 47, 2, 'I was disappointed with the service. The provider was not very professional.', '2022-09-23 15:30:00'),
(55, 28, 50, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-08-27 12:10:00'),
(56, 29, 38, 3, 'The provider was okay. The service was completed, but nothing stood out.', '2022-12-21 14:15:00'),
(57, 29, 53, 4, 'The provider was great! They were very professional and efficient.', '2022-11-15 16:40:00'),
(58, 29, 52, 5, 'The provider was fantastic! They completed the job to a high standard.', '2022-10-18 10:10:00'),
(59, 29, 58, 2, 'I was not satisfied with the service. The provider was not very professional.', '2022-09-11 08:00:00'),
(60, 29, 57, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-08-14 10:15:00'),
(61, 30, 44, 3, 'The provider was okay. The service was completed, but there were some minor issues.', '2022-12-12 13:00:00'),
(62, 30, 57, 4, 'The provider was great! They were very professional and efficient.', '2022-11-09 11:30:00'),
(63, 30, 43, 5, 'The provider was fantastic! They completed the job to a high standard.', '2022-10-14 09:45:00'),
(64, 30, 86, 2, 'I was disappointed with the service. The provider was not very professional.', '2022-09-17 16:00:00'),
(65, 30, 47, 4, 'The provider was great! They were very friendly and completed the job to a high standard.', '2022-08-20 10:15:00'),
(66, 19, 89, 4, 'Great service, very professional!', '2022-05-20 10:30:00'),
(67, 19, 89, 4, 'Great service, very professional!', '2022-05-20 10:30:00'),
(68, 19, 46, 5, 'Amazing experience, would definitely recommend!', '2022-03-12 14:45:00'),
(69, 19, 46, 5, 'Amazing experience, would definitely recommend!', '2022-03-12 14:45:00'),
(70, 19, 85, 3, 'Decent service, but could be better.', '2021-12-05 09:15:00'),
(71, 19, 85, 3, 'Decent service, but could be better.', '2021-12-05 09:15:00'),
(72, 19, 44, 4, 'Good work, very efficient!', '2021-09-02 11:00:00'),
(73, 19, 44, 4, 'Good work, very efficient!', '2021-09-02 11:00:00'),
(74, 19, 57, 4, 'Satisfied with the service, would use again.', '2021-08-10 15:20:00'),
(75, 19, 57, 4, 'Satisfied with the service, would use again.', '2021-08-10 15:20:00'),
(76, 21, 49, 5, 'Fantastic job, very impressed!', '2022-04-16 12:00:00'),
(77, 21, 49, 5, 'Fantastic job, very impressed!', '2022-04-16 12:00:00'),
(78, 21, 51, 3, 'Okay service, nothing extraordinary.', '2022-01-20 17:30:00'),
(79, 21, 51, 3, 'Okay service, nothing extraordinary.', '2022-01-20 17:30:00'),
(80, 21, 45, 4, 'Very satisfied with the work done!', '2021-10-08 08:45:00'),
(81, 21, 45, 4, 'Very satisfied with the work done!', '2021-10-08 08:45:00'),
(82, 22, 47, 5, 'Absolutely amazing service, thank you!', '2022-02-22 13:15:00'),
(83, 22, 47, 5, 'Absolutely amazing service, thank you!', '2022-02-22 13:15:00'),
(84, 22, 58, 4, 'Good work, happy with the results.', '2021-11-14 09:30:00'),
(85, 22, 58, 4, 'Good work, happy with the results.', '2021-11-14 09:30:00'),
(86, 22, 43, 2, 'Not very impressed with the service provided.', '2021-07-29 16:00:00'),
(87, 22, 43, 2, 'Not very impressed with the service provided.', '2021-07-29 16:00:00'),
(88, 22, 50, 3, 'Could have been better, but it was alright.', '2021-06-05 10:45:00'),
(89, 22, 50, 3, 'Could have been better, but it was alright.', '2021-06-05 10:45:00'),
(90, 29, 10, 5, 'Excellent service provided by the provider. Would highly recommend!', '2022-06-12 09:45:00'),
(91, 29, 10, 5, 'Excellent service provided by the provider. Would highly recommend!', '2022-06-12 09:45:00'),
(92, 29, 46, 3, 'The service provided by the provider was average. Could be better.', '2022-05-03 15:20:00'),
(93, 29, 46, 3, 'The service provided by the provider was average. Could be better.', '2022-05-03 15:20:00'),
(94, 29, 89, 4, 'Good service provided by the provider. Satisfied with the work.', '2022-03-22 12:10:00'),
(95, 29, 89, 4, 'Good service provided by the provider. Satisfied with the work.', '2022-03-22 12:10:00'),
(96, 30, 42, 4, 'Satisfactory service provided by the provider. Would consider hiring again.', '2022-04-08 08:30:00'),
(97, 30, 42, 4, 'Satisfactory service provided by the provider. Would consider hiring again.', '2022-04-08 08:30:00'),
(98, 30, 85, 5, 'Amazing service provided by the provider. Highly recommended!', '2022-03-15 11:25:00'),
(99, 30, 85, 5, 'Amazing service provided by the provider. Highly recommended!', '2022-03-15 11:25:00'),
(100, 30, 45, 2, 'The service provided by the provider was not up to the mark. Needs improvement.', '2022-02-02 14:05:00'),
(101, 30, 45, 2, 'The service provided by the provider was not up to the mark. Needs improvement.', '2022-02-02 14:05:00'),
(102, 30, 84, 5, 'Excellent service provided by the provider. Would definitely hire again!', '2022-01-12 10:15:00'),
(103, 30, 84, 5, 'Excellent service provided by the provider. Would definitely hire again!', '2022-01-12 10:15:00'),
(104, 31, 49, 4, 'Good service provided by the provider. Satisfied with the work.', '2022-06-22 12:40:00'),
(105, 31, 49, 4, 'Good service provided by the provider. Satisfied with the work.', '2022-06-22 12:40:00'),
(106, 31, 48, 5, 'Excellent service provided by the provider. Highly recommended!', '2022-04-19 09:30:00'),
(107, 31, 48, 5, 'Excellent service provided by the provider. Highly recommended!', '2022-04-19 09:30:00'),
(108, 31, 51, 3, 'The service provided by the provider was average. Could be better.', '2022-02-27 16:50:00'),
(109, 31, 51, 3, 'The service provided by the provider was average. Could be better.', '2022-02-27 16:50:00'),
(110, 31, 54, 4, 'Satisfactory service provided by the provider. Would consider hiring again.', '2022-01-08 14:20:00'),
(111, 31, 54, 4, 'Satisfactory service provided by the provider. Would consider hiring again.', '2022-01-08 14:20:00'),
(112, 19, 10, 4, 'The service was good. The provider was professional and friendly. I will definitely use their services again.', '2022-08-02 09:23:12'),
(113, 19, 46, 5, 'Amazing service and great communication. The provider was very knowledgeable and efficient. Highly recommend!', '2022-07-18 16:47:45'),
(114, 19, 89, 3, 'The service was decent but the provider was not very friendly. Overall, an okay experience.', '2022-06-24 11:38:32'),
(115, 19, 42, 4, 'The provider did a good job and was very helpful. I would recommend them to others.', '2022-06-11 14:55:09'),
(116, 19, 85, 5, 'Fantastic service and very professional provider. They went above and beyond to ensure everything was taken care of. Highly recommend!', '2022-05-30 08:12:27'),
(117, 19, 45, 4, 'The provider was friendly and did a good job. I would use their services again.', '2022-04-29 12:20:13'),
(118, 19, 84, 3, 'Service was decent but nothing special. The provider was friendly enough.', '2022-04-11 17:33:50'),
(119, 21, 49, 5, 'The service was excellent and the provider was very professional and friendly. Highly recommend!', '2022-09-03 10:14:22'),
(120, 21, 48, 4, 'The provider did a good job and was very knowledgeable. I would use their services again.', '2022-08-15 13:48:55'),
(121, 21, 51, 3, 'Service was okay but the provider was not very friendly. Overall, an average experience.', '2022-07-23 16:27:30'),
(122, 21, 54, 5, 'Amazing service and great communication. The provider was very helpful and efficient. Highly recommend!', '2022-06-29 11:06:17'),
(123, 21, 44, 4, 'The provider was professional and did a good job. I would recommend them to others.', '2022-06-01 09:37:05'),
(124, 22, 57, 5, 'Fantastic service and very professional provider. They went above and beyond to ensure everything was taken care of. Highly recommend!', '2022-05-16 14:09:47'),
(125, 22, 43, 4, 'The service was good and the provider was friendly. I would use their services again.', '2022-04-25 17:28:03'),
(126, 22, 86, 3, 'The provider was not very knowledgeable and the service was just okay. Nothing special.', '2022-03-27 12:53:51'),
(127, 23, 47, 5, 'The service was excellent and the provider was very professional and helpful. Highly recommend!', '2022-09-10 09:02:12'),
(128, 23, 50, 4, 'The provider did a good job and was very knowledgeable. I would use their services again.', '2022-08-25 14:17:35'),
(129, 24, 42, 4, 'Great guy Great work', '2023-03-28 20:03:03'),
(130, 21, 46, 4, 'good service', '2023-03-29 15:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_request`
--

CREATE TABLE `tbl_service_request` (
  `Request_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Provider_ID` int(10) NOT NULL,
  `Serivce_ID` int(10) NOT NULL,
  `Address_ID` int(10) NOT NULL,
  `Service_Description` text NOT NULL,
  `Appointment_Date` date NOT NULL,
  `Appoinment_Start_Time` time NOT NULL,
  `Appoinment_End_Time` time NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_request`
--

INSERT INTO `tbl_service_request` (`Request_ID`, `User_ID`, `Provider_ID`, `Serivce_ID`, `Address_ID`, `Service_Description`, `Appointment_Date`, `Appoinment_Start_Time`, `Appoinment_End_Time`, `Status`) VALUES
(6, 42, 19, 1, 7, 'sdsfsfsfsf', '2023-03-22', '12:00:00', '00:00:00', 'requested'),
(7, 46, 21, 3, 21, 'ergdg', '2023-03-23', '12:00:00', '20:54:20', 'completed'),
(9, 45, 23, 5, 22, 'sadfadsa', '2023-03-28', '12:00:00', '19:21:00', 'completed'),
(13, 45, 19, 1, 22, 'help please', '2023-03-13', '08:45:00', '10:01:40', 'completed'),
(14, 42, 19, 1, 9, 'jygdhfjfds', '2023-03-20', '08:45:00', '00:00:00', 'requested'),
(15, 54, 21, 3, 23, 'sdfsfs', '2023-03-16', '08:00:00', '21:01:51', 'completed'),
(16, 84, 21, 3, 24, 'tyfhfggfhf', '2023-03-24', '10:00:00', '21:13:36', 'completed'),
(17, 42, 21, 3, 7, 'fdsdgdsg', '2023-03-15', '12:00:00', '22:22:59', 'completed'),
(18, 45, 21, 3, 22, 'dsfsfsdfs342', '2023-03-17', '11:00:00', '22:43:06', 'completed'),
(19, 45, 21, 3, 22, 'jshsjfsas', '2023-03-18', '14:00:00', '09:13:01', 'completed'),
(20, 42, 23, 5, 9, 'tfguhji', '2023-03-20', '09:00:00', '14:35:42', 'completed'),
(21, 46, 21, 3, 21, 'hjdkdafa', '2023-03-20', '09:00:00', '15:22:24', 'requested'),
(22, 42, 24, 6, 7, 'rgsf', '2023-03-23', '13:00:00', '22:52:11', 'completed'),
(23, 42, 24, 6, 7, 'dfsfs', '2023-03-27', '09:00:00', '14:32:41', 'completed'),
(24, 46, 21, 3, 21, 'sdfafs', '2023-04-12', '10:00:00', '15:22:30', 'completed'),
(25, 46, 23, 5, 21, 'cdaa', '2023-04-03', '20:00:00', '00:00:00', 'requested');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `User_ID` int(10) NOT NULL,
  `First_Name` varchar(80) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Phone_Number` varchar(20) NOT NULL,
  `Profile_Picture` varchar(200) NOT NULL,
  `City` varchar(20) NOT NULL,
  `User_Type` varchar(15) NOT NULL,
  `Last_Log_Date` datetime NOT NULL,
  `Register_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Verification_status` varchar(10) NOT NULL,
  `User_Status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Last_Name`, `Username`, `Email`, `Password`, `Phone_Number`, `Profile_Picture`, `City`, `User_Type`, `Last_Log_Date`, `Register_Date`, `Verification_status`, `User_Status`) VALUES
(10, 'Admin', 'Admin', 'Admin123', 'admin@mail.com', '$2y$10$PBZ.8oEJtuKBkxaNr6GJOe8DsWjgklxg2Z7DesD3dYKdlq/HfkNna', '9876543210', '_DSC0062.png', 'Kottayam', 'Admin', '2023-03-30 14:09:09', '2023-02-18 00:00:00', 'verified', 'active'),
(38, 'Rini', 'Kurian', 'Rini', 'rinikurian@amaljyothi.ac.in', '$2y$10$IinNVCRXt2HEI3J52EP6E.qoDSGuZfEmUPpoYDZNmfyMTC8bhRlKy', '9847298901', 'Certificate_6.png', 'Kottayam', 'Customer', '2023-03-19 20:11:11', '2023-02-23 15:33:39', 'verified', 'active'),
(42, 'Amal', 'Antoney', 'Amal123', 'amalantoney123@gmail.com', '$2y$10$/hOxzmpGWHZRAZsVDHckZOB9RcQU3crdmHa7RhjZIGOWRLAGimrWG', '6238543016', '_DSC1114.jpg', 'Kottayam', 'provider', '2023-03-30 14:39:45', '2023-02-24 16:07:38', 'verified', 'active'),
(43, 'John', 'Doe', 'johndoe', 'johndoe@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '1.jpg', 'Kochi', 'provider', '2023-03-30 14:03:59', '2023-02-25 15:20:56', 'verified', 'active'),
(44, 'Jane', 'Doe', 'janedoe', 'janedoe@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '2.jpg', 'Kottayam', 'provider', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(45, 'Bob', 'Smith', 'bobsmith', 'bobsmith@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '3.jpg', 'Trivandrum', 'provider', '2023-03-30 14:36:58', '2023-02-25 15:20:56', 'verified', 'active'),
(46, 'Alice', 'Jones', 'alicejones', 'alicejones@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '4.jpg', 'Kochi', 'provider', '2023-03-30 14:37:40', '2023-02-25 15:20:56', 'verified', 'active'),
(47, 'Mike', 'Johnson', 'mikejohnson', 'mikejohnson@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '5.jpg', 'Kottayam', 'Customer', '2023-03-30 14:04:25', '2023-02-25 15:20:56', 'verified', 'active'),
(48, 'Emily', 'Brown', 'emilybrown', 'emilybrown@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '6.jpg', 'Trivandrum', 'provider', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(49, 'David', 'Taylor', 'davidtaylor', 'davidtaylor@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '7.jpg', 'Kochi', 'provider', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(50, 'Olivia', 'Miller', 'oliviamiller', 'oliviamiller@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '8.jpg', 'Kottayam', 'Customer', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(51, 'Emma', 'Wilson', 'emmawilson', 'emmawilson@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '9.jpg', 'Trivandrum', 'provider', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(52, 'William', 'Garcia', 'williamgarcia', 'williamgarcia@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '10.jpg', 'Kochi', 'Customer', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(53, 'Sophia', 'Martinez', 'sophiamartinez', 'sophiamartinez@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '11.jpg', 'Kottayam', 'Customer', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(54, 'James', 'Lee', 'jameslee', 'jameslee@gmail.com', '$2y$10$iGzUjUGAsixYaEhgH0Xi.edbcpjLIfI6iXd2gErrVskTooCTEnFnO', '1234567890', '12.jpg', 'Trivandrum', 'provider', '2023-03-19 20:11:11', '2023-02-25 15:20:56', 'verified', 'active'),
(57, 'jills', 'wilson', 'jills', 'jillsantony@gmail.com', '$2y$10$qF2QorCCykiPj4IWURXBqewghNSND/MeIqGj9CzbavqCcDee5.x5O', '9562954551', '_DSC0061.jpg', 'Kochi', 'provider', '2023-03-19 20:11:11', '2023-02-25 18:47:29', 'verified', 'active'),
(58, 'wilson', 'george', 'wilson123', 'wilson2008george@gmail.com', '$2y$10$4NMoSsV2hJAF.AybIuTYRu78iSwZv6k3gpdgJOLxs2dhECDu9okLq', '8606677859', '_DSC0859.jpg', 'Kottayam', 'Customer', '2023-03-19 20:11:11', '2023-02-25 19:07:29', 'verified', 'active'),
(84, 'dave', 'lee', 'davelee', 'davelee@mail.com', '$2y$10$7hUK3Im96teiongQqazeZ.pImIesZgoroYtWy021J/mAjcgraF336', '8273642245', '_DSC0896.jpg', 'Kottayam', 'provider', '2023-03-29 10:19:09', '2023-03-02 09:42:01', 'verified', 'active'),
(85, 'amal', 'tomy', 'amal321', 'amaltomy2025@mca.ajce.in', '$2y$10$BeEBI7l5RnVLpAioHPQqUO1J4yO.uvMjAth.uvj6kJzR5TfkjMr9a', '7424923241', '_DSC0913.jpg', 'Kottayam', 'provider', '2023-03-19 20:11:11', '2023-03-02 12:48:26', 'verified', 'active'),
(86, 'judin', 'mathew', 'judin', 'judinmathew2025@mca.ajce.in', '$2y$10$KU./cebfOkOtSNDPPwNGwOQs7CFcjBp85ZzUP/EJmMrmUzO59kwnu', '9872423433', '_DSC0007.jpg', 'Trivandrum', 'Customer', '2023-03-19 20:11:11', '2023-03-03 12:45:28', 'verified', 'active'),
(89, 'amal', 'antoney', 'amal', 'amalantoney2025@mca.ajce.in', '$2y$10$gXaIFQE7tOfMkKc6wM6jOuBVf13aZ2G1GJb0IKOYlIELpED4MFzBi', '7553455622', 'test 2.png', 'Kottayam', 'Customer', '2023-03-19 20:11:11', '2023-03-17 11:46:46', 'verified', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`Address_ID`),
  ADD KEY `Foreign key` (`User_ID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Provider_ID` (`Provider_ID`),
  ADD KEY `Request_ID` (`Request_ID`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`Service_ID`);

--
-- Indexes for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD PRIMARY KEY (`Provider_ID`),
  ADD KEY `Service_ID` (`Service_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `tbl_service_provider_availability`
--
ALTER TABLE `tbl_service_provider_availability`
  ADD PRIMARY KEY (`Provider_Availability_ID`),
  ADD KEY `Provider_ID` (`Provider_ID`);

--
-- Indexes for table `tbl_service_provider_ratings`
--
ALTER TABLE `tbl_service_provider_ratings`
  ADD PRIMARY KEY (`Rating_ID`),
  ADD KEY `Provider_ID` (`Provider_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `tbl_service_request`
--
ALTER TABLE `tbl_service_request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `User` (`User_ID`),
  ADD KEY `Service` (`Serivce_ID`),
  ADD KEY `Address` (`Address_ID`),
  ADD KEY `Service Provider` (`Provider_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `Address_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `Service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  MODIFY `Provider_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_service_provider_availability`
--
ALTER TABLE `tbl_service_provider_availability`
  MODIFY `Provider_Availability_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_service_provider_ratings`
--
ALTER TABLE `tbl_service_provider_ratings`
  MODIFY `Rating_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tbl_service_request`
--
ALTER TABLE `tbl_service_request`
  MODIFY `Request_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`),
  ADD CONSTRAINT `tbl_payment_ibfk_2` FOREIGN KEY (`Provider_ID`) REFERENCES `tbl_service_provider` (`Provider_ID`),
  ADD CONSTRAINT `tbl_payment_ibfk_3` FOREIGN KEY (`Request_ID`) REFERENCES `tbl_service_request` (`Request_ID`);

--
-- Constraints for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD CONSTRAINT `tbl_service_provider_ibfk_2` FOREIGN KEY (`Service_ID`) REFERENCES `tbl_services` (`Service_ID`),
  ADD CONSTRAINT `tbl_service_provider_ibfk_3` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`);

--
-- Constraints for table `tbl_service_provider_availability`
--
ALTER TABLE `tbl_service_provider_availability`
  ADD CONSTRAINT `tbl_service_provider_availability_ibfk_1` FOREIGN KEY (`Provider_ID`) REFERENCES `tbl_service_provider` (`Provider_ID`);

--
-- Constraints for table `tbl_service_provider_ratings`
--
ALTER TABLE `tbl_service_provider_ratings`
  ADD CONSTRAINT `tbl_service_provider_ratings_ibfk_1` FOREIGN KEY (`Provider_ID`) REFERENCES `tbl_service_provider` (`Provider_ID`),
  ADD CONSTRAINT `tbl_service_provider_ratings_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`);

--
-- Constraints for table `tbl_service_request`
--
ALTER TABLE `tbl_service_request`
  ADD CONSTRAINT `Address` FOREIGN KEY (`Address_ID`) REFERENCES `tbl_address` (`Address_ID`),
  ADD CONSTRAINT `Service` FOREIGN KEY (`Serivce_ID`) REFERENCES `tbl_services` (`Service_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
