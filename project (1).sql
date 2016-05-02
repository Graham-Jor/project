-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 02, 2016 at 04:20 PM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` text NOT NULL,
  `Full name` text NOT NULL,
  `Department` text NOT NULL,
  `Phone Number` int(11) NOT NULL,
  `password` text,
  `level` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `Full name`, `Department`, `Phone Number`, `password`, `level`) VALUES
('gjordan\r\n', 'Graham Jordan', 'Computers', 851111111, 'password', 1),
('jsmith', 'John Smith', 'Business', 872222222, 'password', 1),
('msmith', 'Matt Smith', 'Computing', 871111111, 'password', 1),
('vmonaghan', 'Vicky monaghan', 'Childcare', 843222222, 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `cvID` int(4) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT 'John Doe',
  `Education` varchar(10000) NOT NULL DEFAULT 'None',
  `Employment` varchar(10000) NOT NULL DEFAULT 'None',
  `Comments` varchar(10000) NOT NULL,
  `Age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`cvID`, `Name`, `Education`, `Employment`, `Comments`, `Age`) VALUES
(1234, 'John Doe', 'None', 'None', '', NULL),
(2345, 'John Doe', 'None', 'None', '', NULL),
(3456, 'John Doe', 'None', 'None', '', NULL),
(4567, 'John Doe', 'None', 'None', '', NULL),
(5678, 'John Doe', 'None', 'None', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `title` text,
  `employer` text,
  `job_description` text,
  `field` text,
  `expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`title`, `employer`, `job_description`, `field`, `expire`) VALUES
('Programmer', 'Microsoft', 'Microsoft are looking for programmers to develop windows 12', 'Computers', '2016-06-04 11:39:13'),
('Game dev', 'Blizzard', 'Blizzard are looking for game developers to create the new hearthstone 2.0', 'Computers', '2016-05-08 11:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `username` varchar(100) NOT NULL,
  `password` text,
  `name` varchar(100) NOT NULL,
  `cvID` int(10) NOT NULL,
  `isEmployed` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `level` int(2) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`username`, `password`, `name`, `cvID`, `isEmployed`, `level`) VALUES
('andrew', 'pass', 'Andrew Maxwell', 1234, 'yes', 2),
('frank', 'password', 'Frankie Boyle', 2345, 'no', 2),
('jimmy', 'password', 'Jimmy Carr', 3456, 'yes', 2),
('stephen', 'password', 'Steven merchant', 4567, 'no', 2),
('tommy', 'password', 'tommy tiernan', 5678, 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `id` int(11) DEFAULT NULL,
  `Department` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `id`, `Department`, `level`) VALUES
('graham', 'pass', 123, 'Computers', 1),
('matt', 'pass', 234, 'computers', 1),
('john', 'pass', 345, 'english', 1),
('andrew', 'pass', 111, 'student', 2),
('frank', 'pass', 222, 'student', 2),
('jimmy', 'pass', 333, 'student', 2),
('stephen', 'pass', 444, 'student', 2),
('tommy', 'pass', 555, 'student', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`(100));

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`cvID`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
