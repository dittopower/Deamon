-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2015 at 07:12 AM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deamon_INB201`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `TheaterID` varchar(3) NOT NULL,
  `BookingID` decimal(6,0) NOT NULL,
  `BookerID` decimal(6,0) NOT NULL,
  `Patient` decimal(10,0) NOT NULL,
  `StartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`TheaterID`, `BookingID`, `BookerID`, `Patient`, `StartTime`, `EndTime`) VALUES
('119', '3', '5', '64645549', '2014-06-03 02:40:00', '2014-06-03 03:00:00'),
('201', '4', '5', '456414', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('120', '5', '0', '64645549', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('120', '6', '57896', '64645550', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('201', '7', '0', '24254', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `filepermissions`
--

CREATE TABLE IF NOT EXISTS `filepermissions` (
  `FileName` varchar(255) NOT NULL DEFAULT '',
  `Access` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filepermissions`
--

INSERT INTO `filepermissions` (`FileName`, `Access`) VALUES
('adminsql', '--'),
('admit', 'RR,DD,HA'),
('admitPatient', 'RR,DD,HA'),
('bookMeeting', 'RR,DD,HA'),
('bookTheater', 'TT,DD,HA'),
('connection_include', '--'),
('connection_include.php~', '--'),
('createUser', 'HA'),
('exportButton', 'DD,HA'),
('exporttopdf', 'HA'),
('filePermissions', '--'),
('footer', 'AA'),
('functions', '--'),
('header', 'AA'),
('index', 'AA'),
('login', '--'),
('loginpage', 'AA'),
('logout', 'AA'),
('mypatients', 'NN,DD'),
('newPatient', 'RR,DD,HA'),
('overview', '--'),
('patient', 'RR,NN,DD,HA'),
('patientList', 'RR,NN,DD,HA'),
('prescription', 'DD'),
('sidebar', '--'),
('user', 'HA'),
('userAuth', '--'),
('users', 'HA'),
('ward', 'RR,NN,DD,HA'),
('xraySubmit', 'TT'),
('xrayView', 'TT,DD');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `NoteNo` decimal(10,0) NOT NULL,
  `StaffID` decimal(6,0) NOT NULL,
  `Date` date NOT NULL,
  `Note` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`NoteNo`, `StaffID`, `Date`, `Note`) VALUES
('12', '57894', '2014-03-20', 'Is a good tester');

-- --------------------------------------------------------

--
-- Table structure for table `patientfinancial`
--

CREATE TABLE IF NOT EXISTS `patientfinancial` (
  `billID` varchar(255) NOT NULL,
  `PatientID` decimal(10,0) NOT NULL,
  `OperationID` varchar(20) NOT NULL,
  `MoneyOwed` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientfinancial`
--

INSERT INTO `patientfinancial` (`billID`, `PatientID`, `OperationID`, `MoneyOwed`) VALUES
('Script-1', '24254', 'script01', '55'),
('Script-2', '64645551', 'script01', '60'),
('Script-3', '1135646', 'script01', '85'),
('sur001-0', '64645549', 'sur001', '500'),
('sur001-1', '64645550', 'sur001', '500'),
('ward-1', '64645546', 'WardBed01', '35'),
('ward-2', '64645546', 'WardBed01', '35'),
('ward-3', '64645551', 'WardBed01', '35'),
('ward-4', '112378', 'WardBed01', '35'),
('xray-1', '24254', 'xray001', '50'),
('xray-2', '456414', 'xray001', '0'),
('xray-3', '64645549', 'xray001', '50'),
('xray-4', '24254', 'xray001', '50'),
('xray001-0', '456414', 'xray001', '50'),
('xray001-1', '24254', 'xray001', '50');

-- --------------------------------------------------------

--
-- Table structure for table `patientlocation`
--

CREATE TABLE IF NOT EXISTS `patientlocation` (
  `PatientNo` decimal(10,0) NOT NULL,
  `DoctorID` decimal(6,0) NOT NULL,
  `BedNo` decimal(3,0) DEFAULT NULL,
  `WardId` varchar(3) DEFAULT NULL,
  `EnterTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ExitEst` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientlocation`
--

INSERT INTO `patientlocation` (`PatientNo`, `DoctorID`, `BedNo`, `WardId`, `EnterTime`, `ExitEst`) VALUES
('24254', '57894', '0', 'A11', '2014-06-02 06:14:19', NULL),
('112378', '57894', '0', 'A11', '2014-06-03 07:33:28', NULL),
('7854212', '57897', '0', 'A11', '2014-06-02 06:14:18', NULL),
('15466466', '57894', '2', 'T11', '2014-04-02 13:00:00', NULL),
('64645546', '57896', '0', 'T11', '2014-06-02 15:49:31', NULL),
('64645551', '57896', '0', 'T11', '2014-06-03 02:44:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `PatientNo` decimal(10,0) NOT NULL,
  `Lastname` varchar(30) DEFAULT NULL,
  `Firstname` varchar(30) DEFAULT NULL,
  `Sex` varchar(1) DEFAULT NULL,
  `Notes` varchar(200) DEFAULT NULL,
  `dob` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `medicare` varchar(255) DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientNo`, `Lastname`, `Firstname`, `Sex`, `Notes`, `dob`, `address`, `phone`, `email`, `medicare`, `insurance`) VALUES
('24254', 'Green ', ' Christopher ', 'M', 'Nose Bleed', '01 May 2014', '123 Default street', '3125 8484', '', '68161', ''),
('112378', 'Tester', 'Patient', 'M', 'blah', '01 May 2014', '123 Default street', '3125 8484', '', '9681468189618', ''),
('456414', 'Price ', 'Timothy', 'M', NULL, '01-05-2014', '123 Default street', '3125 8484', NULL, '681961681', NULL),
('1135646', 'Morris ', 'Anthony ', 'M', NULL, '01-05-2014', '123 Default street', '3125 8484', NULL, '4561237', NULL),
('7854212', 'Butler', 'Bobby', 'M', NULL, '01-05-2014', '123 Default street', '3125 8484', NULL, NULL, 'Health fund'),
('15466466', 'Goldman', 'Larry', 'M', 'Another tester', '01-05-2014', '123 Default street', '3125 8484', NULL, NULL, 'Union Fund'),
('64645546', 'Goldman', 'Barry', 'M', 'Yet Another Tester', '01-05-2014', '123 Default street', '3125 8484', NULL, NULL, NULL),
('64645549', 'Bush', 'George', 'M', NULL, '11-06-2025', 'The White House, Washington, USA', '000-000-0000', 'GB@email.co.uk', '19618191982894', ''),
('64645550', 'Doe', 'John', 'M', NULL, '11-06-1987', 'Z403, qut, gardens point', '1236547890', 'testing@email.com', NULL, 'none'),
('64645551', 'Jonesq', 'Damon', 'M', NULL, '01-01-1970', '3205 51515', '125545', 'email@email.com', '123 street', '45435545');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `PrescriptionID` int(6) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Price` double NOT NULL,
  `PrescriptionName` varchar(100) NOT NULL,
  `Amount` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`PrescriptionID`, `PatientID`, `Price`, `PrescriptionName`, `Amount`) VALUES
(1, 24254, 25, 'Panadol', '10'),
(2, 7854212, 35, 'Panadol plus', '10'),
(3, 1135646, 25, 'Panadol', '10');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `OperationID` varchar(10) NOT NULL,
  `Operation` varchar(20) NOT NULL,
  `OperationCost` decimal(10,0) DEFAULT NULL,
  `Rebate` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`OperationID`, `Operation`, `OperationCost`, `Rebate`) VALUES
('cat001', 'Cat Scan', '200', '50'),
('script01', 'New Prescription', '100', '100'),
('sur001', 'Surgery', '500', '150'),
('WardBed01', 'Hospital Bed', '35', '0'),
('xray001', 'X-ray scan', '50', '10');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `Username` varchar(20) NOT NULL,
  `StaffID` decimal(6,0) NOT NULL,
  `Stafftype` varchar(15) NOT NULL,
  `Room` varchar(10) NOT NULL DEFAULT '',
  `Lastname` varchar(30) NOT NULL,
  `Firstname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Username`, `StaffID`, `Stafftype`, `Room`, `Lastname`, `Firstname`) VALUES
('demon', '0', 'System Admin', '', 'Jones', 'Damon'),
('jordan', '1', 'System Admin', '', 'Pearce', 'Jordan'),
('jesh', '5', 'System Admin', '', 'Henley', 'Josh'),
('dTester', '57894', 'Doctor', '', 'Tesla', 'Thomas'),
('roflmonsterjh', '57895', 'System Admin', '', 'Henley', 'Joshua'),
('walt', '57896', 'Hospital Admin', '', 'Bishop', 'Walter'),
('doctor', '57897', 'Doctor', '', 'Brown', 'Mr. Doctor'),
('frontdesk', '57898', 'Receptionist', '', 'test', 'Miss. Recptionist'),
('sysadmin', '57899', 'System Admin', '', 'Test', 'Sys. Admin'),
('xray', '57900', 'Technician', '', 'Jonas', 'X-ray Technican'),
('nurse', '57901', 'Nurse', 'A11', 'Strating', 'Mr. Nurse'),
('hosadmin', '57902', 'Hospital Admin', '', 'Test', 'Hospital Admin'),
('asd', '57903', 'Nurse', '', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE IF NOT EXISTS `theaters` (
  `TheaterID` varchar(3) NOT NULL,
  `RoomNumber` decimal(3,0) NOT NULL,
  `BuildingNo` varchar(2) NOT NULL,
  `RoomType` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`TheaterID`, `RoomNumber`, `BuildingNo`, `RoomType`) VALUES
('118', '403', 'G', 'Surgery'),
('119', '404', 'G', 'Surgery'),
('120', '405', 'G', 'Surgery'),
('200', '112', 'B', 'X-ray scan'),
('201', '113', 'B', 'X-ray scan'),
('221', '301', 'B', 'Cat Scan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `AccessCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `AccessCode`) VALUES
('asd', '7815696ecbf1c96e6894b779456d330e', 'NN'),
('demon', '8214bece6414a00cb71dcc4cf7fc750f', 'SA'),
('doctor', '098f6bcd4621d373cade4e832627b4f6', 'DD'),
('dTester', '098f6bcd4621d373cade4e832627b4f6', 'DD'),
('frontdesk', '83c0cf468771e10150e77501f8beb4ab', 'RR'),
('hosadmin', '439deaab513fc63dc279a48411071077', 'HA'),
('jesh', '098f6bcd4621d373cade4e832627b4f6', 'SA'),
('jim', '098f6bcd4621d373cade4e832627b4f6', 'RR'),
('jordan', 'd16d377af76c99d27093abc22244b342', 'SA'),
('lathaam', '098f6bcd4621d373cade4e832627b4f6', 'SA'),
('nurse', '098f6bcd4621d373cade4e832627b4f6', 'NN'),
('roflmonsterjh', 'f2bd5ed67d354f5561943f2b7e320c1e', 'SA'),
('sysadmin', '48a365b4ce1e322a55ae9017f3daf0c0', 'SA'),
('walt', 'fb1c9e05e53928d05f77f4eab0dc587c', 'DD'),
('xray', '32599e5387251a477e16894dca7417bf', 'TT');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE IF NOT EXISTS `wards` (
  `WardId` varchar(3) NOT NULL,
  `NoOfBeds` varchar(3) NOT NULL,
  `Buildinglvl` decimal(2,0) NOT NULL,
  `BuildingNo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`WardId`, `NoOfBeds`, `Buildinglvl`, `BuildingNo`) VALUES
('A11', '10', '2', 'A'),
('T11', '12', '4', 'T'),
('Z23', '20', '4', 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `xray`
--

CREATE TABLE IF NOT EXISTS `xray` (
  `XrayFileId` decimal(10,0) NOT NULL,
  `Xray` varchar(255) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `StaffID` decimal(6,0) NOT NULL,
  `XrayDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xray`
--

INSERT INTO `xray` (`XrayFileId`, `Xray`, `PatientID`, `StaffID`, `XrayDate`) VALUES
('1', '0-24254-1-xray.jpg', 24254, '0', '2014-06-01'),
('2', '5-456414-2-xray.jpg', 456414, '5', '2014-06-02'),
('3', '0-64645549-3-xray.jpg', 64645549, '0', '2014-06-02'),
('4', '57900-24254-4-xray.jpg', 24254, '57900', '2014-06-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`), ADD KEY `TheaterID` (`TheaterID`), ADD KEY `Patient` (`Patient`), ADD KEY `Booker` (`BookerID`);

--
-- Indexes for table `filepermissions`
--
ALTER TABLE `filepermissions`
  ADD PRIMARY KEY (`FileName`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`NoteNo`), ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `patientfinancial`
--
ALTER TABLE `patientfinancial`
  ADD PRIMARY KEY (`billID`), ADD UNIQUE KEY `billID` (`billID`), ADD KEY `PatientID` (`PatientID`), ADD KEY `OperationID` (`OperationID`);

--
-- Indexes for table `patientlocation`
--
ALTER TABLE `patientlocation`
  ADD UNIQUE KEY `PatientNo` (`PatientNo`), ADD KEY `WardId` (`WardId`), ADD KEY `PatientLocation_ibfk_2_idx` (`DoctorID`), ADD KEY `PatientLocation_ibfk_3_idx` (`PatientNo`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientNo`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`PrescriptionID`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`OperationID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`), ADD KEY `Username` (`Username`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`TheaterID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`WardId`);

--
-- Indexes for table `xray`
--
ALTER TABLE `xray`
  ADD PRIMARY KEY (`XrayFileId`), ADD KEY `StaffID` (`StaffID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`BookerID`) REFERENCES `staff` (`StaffID`),
ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`Patient`) REFERENCES `patients` (`PatientNo`),
ADD CONSTRAINT `TheaterBooking_ibfk_1` FOREIGN KEY (`TheaterID`) REFERENCES `theaters` (`TheaterID`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `Notes_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`);

--
-- Constraints for table `patientfinancial`
--
ALTER TABLE `patientfinancial`
ADD CONSTRAINT `PatientFinancial_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientNo`),
ADD CONSTRAINT `PatientFinancial_ibfk_2` FOREIGN KEY (`OperationID`) REFERENCES `prices` (`OperationID`);

--
-- Constraints for table `patientlocation`
--
ALTER TABLE `patientlocation`
ADD CONSTRAINT `PatientLocation_ibfk_1` FOREIGN KEY (`WardId`) REFERENCES `wards` (`WardId`),
ADD CONSTRAINT `PatientLocation_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `staff` (`StaffID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `PatientLocation_ibfk_3` FOREIGN KEY (`PatientNo`) REFERENCES `patients` (`PatientNo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `xray`
--
ALTER TABLE `xray`
ADD CONSTRAINT `XRay_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
