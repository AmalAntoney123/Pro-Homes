-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 10:00 AM
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
(22, 45, 'xdf', 'sfs', 'sdfs', 'kottayam', 'sdfs', 'fsf', '343255');

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
(19, 46, 1, '123 Main St', 'Provides electrical repair and maintenance services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '10.99', 'verfied'),
(20, 87, 2, '456 Elm St', 'Provides plumbing repair and maintenance services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '20.99', 'verfied'),
(21, 42, 3, '789 Oak St', 'Provides deep cleaning services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '30.99', 'verfied'),
(22, 85, 4, '321 Pine St', 'Provides cleaning services specifically for bathrooms.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '40.99', 'verfied'),
(23, 45, 5, '654 Maple St', 'Provides repair and installation services for appliances and fixtures.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '50.99', 'verfied'),
(24, 84, 6, '987 Cedar St', 'Provides general cleaning services for residential spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '60.99', 'verfied'),
(25, 49, 7, '147 Walnut St', 'Provides painting services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '70.99', 'verfied'),
(26, 48, 8, '258 Birch St', 'Provides carpentry and woodworking services.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '80.99', 'verfied'),
(27, 51, 9, '369 Elm St', 'Provides packing and moving services for residential and commercial spaces.', 'file1.pdf', 'file2.pdf', 'file3.pdf', '90.99', 'verfied'),
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
(11, 20, '', 'No', '08:06:21', '20:29:35'),
(12, 21, '2023-03-22, 2023-03-21', 'No', '08:00:00', '20:00:00'),
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
(6, 42, 19, 1, 7, 'sdsfsfsfsf', '2023-03-22', '12:00:00', '00:00:00', 'accepted'),
(7, 46, 21, 3, 21, 'ergdg', '2023-03-23', '12:00:00', '00:00:00', 'requested'),
(8, 42, 23, 5, 7, 'rhf', '2023-03-21', '13:00:00', '00:00:00', 'completed'),
(9, 45, 23, 5, 22, 'sadfadsa', '2023-03-28', '12:00:00', '19:21:00', 'completed'),
(13, 45, 19, 1, 22, 'help please', '2023-03-13', '08:45:00', '10:01:40', 'completed'),
(14, 42, 19, 1, 9, 'jygdhfjfds', '2023-03-20', '08:45:00', '00:00:00', 'requested');

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
  `Password` varchar(50) NOT NULL,
  `Phone_Number` varchar(20) NOT NULL,
  `Profile_Picture` varchar(200) NOT NULL,
  `City` varchar(20) NOT NULL,
  `User_Type` varchar(15) NOT NULL,
  `Register_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Verification_status` varchar(10) NOT NULL,
  `User_Status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Last_Name`, `Username`, `Email`, `Password`, `Phone_Number`, `Profile_Picture`, `City`, `User_Type`, `Register_Date`, `Verification_status`, `User_Status`) VALUES
(10, 'Admin', 'Admin', 'Admin123', 'admin@mail.com', 'Admin@123', '9876543210', '_DSC0062.png', 'Kottayam', 'Admin', '2023-02-18 00:00:00', 'verified', 'active'),
(38, 'Rini', 'Kurian', 'Rini', 'rinikurian@amaljyothi.ac.in', 'Jerin@123', '9847298901', 'Certificate_6.png', 'Kottayam', 'Customer', '2023-02-23 15:33:39', 'verified', 'active'),
(42, 'Amal', 'Antoney', 'Amal123', 'amalantoney123@gmail.com', 'Amal@123', '6238543016', '_DSC1114.jpg', 'Kottayam', 'provider', '2023-02-24 16:07:38', 'verified', 'active'),
(43, 'John', 'Doe', 'johndoe', 'johndoe@gmail.com', 'password123', '1234567890', '1.jpg', 'Kochi', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(44, 'Jane', 'Doe', 'janedoe', 'janedoe@gmail.com', 'password123', '1234567890', '2.jpg', 'Kottayam', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(45, 'Bob', 'Smith', 'bobsmith', 'bobsmith@gmail.com', 'password123', '1234567890', '3.jpg', 'Trivandrum', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(46, 'Alice', 'Jones', 'alicejones', 'alicejones@gmail.com', 'password123', '1234567890', '4.jpg', 'Kochi', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(47, 'Mike', 'Johnson', 'mikejohnson', 'mikejohnson@gmail.com', 'password123', '1234567890', '5.jpg', 'Kottayam', 'Customer', '2023-02-25 15:20:56', 'verified', 'active'),
(48, 'Emily', 'Brown', 'emilybrown', 'emilybrown@gmail.com', 'password123', '1234567890', '6.jpg', 'Trivandrum', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(49, 'David', 'Taylor', 'davidtaylor', 'davidtaylor@gmail.com', 'password123', '1234567890', '7.jpg', 'Kochi', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(50, 'Olivia', 'Miller', 'oliviamiller', 'oliviamiller@gmail.com', 'password123', '1234567890', '8.jpg', 'Kottayam', 'Customer', '2023-02-25 15:20:56', 'verified', 'active'),
(51, 'Emma', 'Wilson', 'emmawilson', 'emmawilson@gmail.com', 'password123', '1234567890', '9.jpg', 'Trivandrum', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(52, 'William', 'Garcia', 'williamgarcia', 'williamgarcia@gmail.com', 'password123', '1234567890', '10.jpg', 'Kochi', 'Customer', '2023-02-25 15:20:56', 'verified', 'active'),
(53, 'Sophia', 'Martinez', 'sophiamartinez', 'sophiamartinez@gmail.com', 'password123', '1234567890', '11.jpg', 'Kottayam', 'Customer', '2023-02-25 15:20:56', 'verified', 'active'),
(54, 'James', 'Lee', 'jameslee', 'jameslee@gmail.com', 'password123', '1234567890', '12.jpg', 'Trivandrum', 'provider', '2023-02-25 15:20:56', 'verified', 'active'),
(57, 'jills', 'wilson', 'jills', 'jillsantony@gmail.com', 'Wilson070#', '9562954551', '_DSC0061.jpg', 'Kochi', 'provider', '2023-02-25 18:47:29', 'verified', 'active'),
(58, 'wilson', 'george', 'wilson123', 'wilson2008george@gmail.com', 'Antoney@007', '8606677859', '_DSC0859.jpg', 'Kottayam', 'Customer', '2023-02-25 19:07:29', 'verified', 'active'),
(84, 'dave', 'lee', 'davelee', 'davelee@mail.com', 'Password@123', '8273642245', '_DSC0896.jpg', 'Kottayam', 'provider', '2023-03-02 09:42:01', 'verified', 'active'),
(85, 'amal', 'tomy', 'amal321', 'amaltomy2025@mca.ajce.in', '#Amal123', '7424923241', '_DSC0913.jpg', 'Kottayam', 'provider', '2023-03-02 12:48:26', 'verified', 'active'),
(86, 'judin', 'mathew', 'judin', 'judinmathew2025@mca.ajce.in', 'Judin@123', '9872423433', '_DSC0007.jpg', 'Trivandrum', 'Customer', '2023-03-03 12:45:28', 'verified', 'active'),
(87, 'amal', 'antoney', 'amal', 'amalantoney2025@mca.ajce.in', '#Amal123', '9876578986', '_DSC0059.jpg', 'Kottayam', 'provider', '2023-03-06 11:23:56', 'verified', 'active');

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
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`Service_ID`);

--
-- Indexes for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD PRIMARY KEY (`Provider_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Service_ID` (`Service_ID`);

--
-- Indexes for table `tbl_service_provider_availability`
--
ALTER TABLE `tbl_service_provider_availability`
  ADD PRIMARY KEY (`Provider_Availability_ID`),
  ADD KEY `Provider_ID` (`Provider_ID`);

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
  MODIFY `Address_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- AUTO_INCREMENT for table `tbl_service_request`
--
ALTER TABLE `tbl_service_request`
  MODIFY `Request_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`);

--
-- Constraints for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD CONSTRAINT `tbl_service_provider_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`),
  ADD CONSTRAINT `tbl_service_provider_ibfk_2` FOREIGN KEY (`Service_ID`) REFERENCES `tbl_services` (`Service_ID`);

--
-- Constraints for table `tbl_service_provider_availability`
--
ALTER TABLE `tbl_service_provider_availability`
  ADD CONSTRAINT `tbl_service_provider_availability_ibfk_1` FOREIGN KEY (`Provider_ID`) REFERENCES `tbl_service_provider` (`Provider_ID`);

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
