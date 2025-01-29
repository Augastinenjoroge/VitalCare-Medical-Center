-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2024 at 06:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `AdminID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`AdminID`, `UserID`, `FirstName`, `LastName`, `ContactNumber`, `Email`, `CreatedAt`) VALUES
(1, 22, 'Fred', 'njtr', '070000000', 'nakle@gmail.com', '2024-06-01 16:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `Appointments`
--

CREATE TABLE `Appointments` (
  `AppointmentID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AppointmentDateTime` datetime DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Appointments`
--

INSERT INTO `Appointments` (`AppointmentID`, `PatientID`, `DoctorID`, `AppointmentDateTime`, `Status`, `CreatedAt`) VALUES
(9, 6, 1, '2024-06-18 08:00:00', 'Cancelled', '2024-06-05 13:33:13'),
(10, 6, 1, '2024-06-18 13:00:00', 'Booked', '2024-06-05 13:37:41'),
(11, 6, 3, '2024-06-18 09:30:00', 'Booked', '2024-06-09 10:43:48'),
(14, 6, 2, '2024-06-06 08:30:00', 'Booked', '2024-06-09 10:57:02'),
(15, 6, 2, '2024-06-06 11:00:00', 'Booked', '2024-06-12 10:59:12'),
(16, 6, 3, '2024-06-03 11:30:00', 'Booked', '2024-06-12 11:03:49'),
(17, 6, 1, '2024-06-04 12:00:00', 'Booked', '2024-06-12 11:07:03'),
(18, 6, 1, '2024-06-27 11:30:00', 'Booked', '2024-06-24 14:31:58'),
(19, 6, 3, '2024-07-17 10:30:00', 'Booked', '2024-07-16 05:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `Departments`
--

CREATE TABLE `Departments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Departments`
--

INSERT INTO `Departments` (`DepartmentID`, `DepartmentName`, `Description`) VALUES
(1, 'Emergency Department', '(ED): This is where patients with urgent medical conditions are treated.'),
(2, 'Intensive Care Unit', '(ICU): This is a specialized department that provides critical care to patients with life-threatening conditions.');

-- --------------------------------------------------------

--
-- Table structure for table `Doctors`
--

CREATE TABLE `Doctors` (
  `DoctorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Doctors`
--

INSERT INTO `Doctors` (`DoctorID`, `UserID`, `FirstName`, `LastName`, `DepartmentID`, `ContactNumber`, `Email`, `Address`, `CreatedAt`) VALUES
(2, 23, 'Peter', 'Thuo', 2, '0789674534', 'peterthuo@gmail.com', 'kiambu', '2024-06-02 10:28:00'),
(3, 24, 'Jane', 'Njeri', 1, '078594393', 'janenjeri@gmail.com', 'Thika', '2024-06-02 10:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `Doctor_Schedules`
--

CREATE TABLE `Doctor_Schedules` (
  `ScheduleID` int(11) NOT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AvailableDate` date DEFAULT NULL,
  `AvailableFrom` time DEFAULT NULL,
  `AvailableTo` time DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Doctor_Schedules`
--

INSERT INTO `Doctor_Schedules` (`ScheduleID`, `DoctorID`, `AvailableDate`, `AvailableFrom`, `AvailableTo`, `CreatedAt`) VALUES
(2, 1, '2024-06-18', '08:00:00', '17:00:00', '2024-06-02 10:22:25'),
(3, 2, '2024-06-04', '08:00:00', '17:00:00', '2024-06-02 10:28:58'),
(4, 3, '2024-06-03', '08:00:00', '17:00:00', '2024-06-02 10:33:48'),
(5, 2, '2024-06-03', '08:00:00', '17:00:00', '2024-06-03 06:27:49'),
(7, 2, '2024-06-06', '08:00:00', '17:00:00', '2024-06-03 06:28:54'),
(8, 1, '2024-06-04', '08:00:00', '17:00:00', '2024-06-04 05:47:14'),
(9, 1, '2024-06-20', '08:00:00', '17:00:00', '2024-06-04 05:47:14'),
(10, 1, '2024-06-27', '08:00:00', '17:00:00', '2024-06-24 14:25:19'),
(11, 1, '2024-06-29', '08:00:00', '17:00:00', '2024-06-28 22:02:01'),
(12, 3, '2024-07-17', '08:00:00', '17:00:00', '2024-07-16 05:48:40'),
(13, 3, '2024-07-19', '08:00:00', '17:00:00', '2024-07-16 05:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `Medications`
--

CREATE TABLE `Medications` (
  `MedicationID` int(11) NOT NULL,
  `HistoryID` int(11) DEFAULT NULL,
  `MedicationName` varchar(100) DEFAULT NULL,
  `Dosage` varchar(50) DEFAULT NULL,
  `Frequency` varchar(50) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Medications`
--

INSERT INTO `Medications` (`MedicationID`, `HistoryID`, `MedicationName`, `Dosage`, `Frequency`, `StartDate`, `EndDate`, `CreatedAt`) VALUES
(1, 4, 'Ibuprofen', '200mg', 'Twice a day', '2024-06-26', '2024-07-26', '2024-06-26 20:31:17'),
(14, 20, 'Omeprazole', '20mg', 'Once a day', '2024-07-01', NULL, '2024-07-01 16:49:56'),
(15, 22, 'Ibuprofen', '200mg', 'Twice a day', '2024-07-16', NULL, '2024-07-16 05:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `Patients`
--

CREATE TABLE `Patients` (
  `PatientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Patients`
--

INSERT INTO `Patients` (`PatientID`, `UserID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `ContactNumber`, `Email`, `Address`, `CreatedAt`) VALUES
(6, 19, 'Harry', 'Utra', '1999-05-13', 'Male', '0745688031', 'nakleagusto@gmail.com', 'Nairobi', '2024-05-25 16:22:38'),
(7, 25, 'Emily', 'Lily', '2002-01-09', 'Female', '0745688031', 'EmilyLily@gmail.com', 'Nairobi', '2024-06-09 12:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `Patient_History`
--

CREATE TABLE `Patient_History` (
  `HistoryID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `VisitDate` date DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Patient_History`
--

INSERT INTO `Patient_History` (`HistoryID`, `PatientID`, `DoctorID`, `VisitDate`, `Notes`, `CreatedAt`) VALUES
(4, 6, 1, '2024-06-26', 'Patient is experiencing mild side effects from the medication.', '2024-06-26 20:31:17'),
(20, 6, 1, '2024-07-01', 'Patient needs to take this medication with food to avoid stomach upset', '2024-07-01 16:49:56'),
(21, 6, 2, '2024-07-01', 'Patient has a history of allergic reactions to this medication.', '2024-07-01 20:57:04'),
(22, 6, 3, '2024-07-16', 'HEART PROBREM', '2024-07-16 05:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `PasswordHash` varchar(255) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Email`, `PasswordHash`, `RoleID`, `CreatedAt`) VALUES
(22, 'nakle@gmail.com', '$2y$10$J9XiajPMhQjJOPivjIpmZeXc4jrB8KdBwEchevS0PrilIOrFRWhpi', 3, '2024-06-01 16:00:14'),
(23, 'peterthuo@gmail.com', '$2y$10$iLa.aabHU6jNKPPuC5uOuOsrPY3G172OA/.c2wO1F6TsD5vxg6yfm', 2, '2024-06-02 10:28:00'),
(24, 'janenjeri@gmail.com', '$2y$10$GUxbM0L8vAswEkw1nlHeF.6DSsfDVWZCEt8ciPsmY90UGSX17SOiO', 2, '2024-06-02 10:32:57'),
(25, 'EmilyLily@gmail.com', '$2y$10$BQKTt7YtSnbwI6fJllP7EOFk0yw83D4dFDBlei3BAjUzldAQubfVy', 1, '2024-06-09 12:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `User_Roles`
--

CREATE TABLE `User_Roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `User_Roles`
--

INSERT INTO `User_Roles` (`RoleID`, `RoleName`) VALUES
(3, 'Admin'),
(2, 'Doctor'),
(1, 'Patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `Appointments`
--
ALTER TABLE `Appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `Departments`
--
ALTER TABLE `Departments`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `Doctors`
--
ALTER TABLE `Doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `Doctor_Schedules`
--
ALTER TABLE `Doctor_Schedules`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `Medications`
--
ALTER TABLE `Medications`
  ADD PRIMARY KEY (`MedicationID`),
  ADD KEY `HistoryID` (`HistoryID`);

--
-- Indexes for table `Patients`
--
ALTER TABLE `Patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `Patient_History`
--
ALTER TABLE `Patient_History`
  ADD PRIMARY KEY (`HistoryID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Email`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `User_Roles`
--
ALTER TABLE `User_Roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Departments`
--
ALTER TABLE `Departments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Doctors`
--
ALTER TABLE `Doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Doctor_Schedules`
--
ALTER TABLE `Doctor_Schedules`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Medications`
--
ALTER TABLE `Medications`
  MODIFY `MedicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Patients`
--
ALTER TABLE `Patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Patient_History`
--
ALTER TABLE `Patient_History`
  MODIFY `HistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `User_Roles`
--
ALTER TABLE `User_Roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admins`
--
ALTER TABLE `Admins`
  ADD CONSTRAINT `Admins_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Appointments`
--
ALTER TABLE `Appointments`
  ADD CONSTRAINT `Appointments_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patients` (`PatientID`),
  ADD CONSTRAINT `Appointments_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `Doctors` (`DoctorID`);

--
-- Constraints for table `Doctors`
--
ALTER TABLE `Doctors`
  ADD CONSTRAINT `Doctors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `Doctors_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `Departments` (`DepartmentID`);

--
-- Constraints for table `Doctor_Schedules`
--
ALTER TABLE `Doctor_Schedules`
  ADD CONSTRAINT `Doctor_Schedules_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `Doctors` (`DoctorID`);

--
-- Constraints for table `Medications`
--
ALTER TABLE `Medications`
  ADD CONSTRAINT `Medications_ibfk_1` FOREIGN KEY (`HistoryID`) REFERENCES `Patient_History` (`HistoryID`);

--
-- Constraints for table `Patients`
--
ALTER TABLE `Patients`
  ADD CONSTRAINT `Patients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Patient_History`
--
ALTER TABLE `Patient_History`
  ADD CONSTRAINT `Patient_History_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patients` (`PatientID`),
  ADD CONSTRAINT `Patient_History_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `Doctors` (`DoctorID`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `User_Roles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
