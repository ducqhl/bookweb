-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2017 at 07:36 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btcn08`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Id` int(11) NOT NULL,
  `Name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `Author` varchar(256) CHARACTER SET utf8 NOT NULL,
  `Image` varchar(256) CHARACTER SET utf8 NOT NULL,
  `Price` decimal(15,0) NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `UserId` int(11) NOT NULL,
  `DayAdd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `View` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Fullname` varchar(256) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `Phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(256) NOT NULL,
  `DayRegisted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Fullname`, `Email`, `Phone`, `Password`, `DayRegisted`) VALUES
(1, 'tye', 'tye@pxq.vn', '011011011', '$2y$10$9e8PhZtvJ6ImQxWNUACn6OUz1qQ8/1jcP9byoM1KL.UWd50IczFJS', '2017-11-02'),
(2, 'ekyt', 'ekyt@pxq.vn', '01110111', '$2y$10$XZQd2NUEmIXrvyrIXYevn.rsp3cxzFmxJio5Z5IZ6QMgoaErg.QpO', '2017-11-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_USERID` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
