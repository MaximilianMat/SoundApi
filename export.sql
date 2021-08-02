-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 04, 2020 at 05:00 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Soundservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `Song`
--

CREATE TABLE `Song` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Album` varchar(50) NOT NULL,
  `Interpret` varchar(50) NOT NULL,
  `Genre` varchar(50) NOT NULL,
  `Dateipfad` varchar(50) DEFAULT NULL,
  `Coverpfad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Song`
--

INSERT INTO `Song` (`ID`, `Name`, `Album`, `Interpret`, `Genre`, `Dateipfad`, `Coverpfad`) VALUES
(1, 'Smells Like Teen Spirit', 'Nevermind', 'Nirvana', 'Rock', '0a93c52a41b7c685257ed96233bdd1ae', '8203bb644f810774fc71d0e7f2358256'),
(3, 'Imagine', 'Imagine', 'John Lennon', 'Pop', 'e0153c297b537a978b7a8f74d60e35c7', '3a1c561608ac5e572118d4309552a235'),
(4, 'One', 'Achtung Baby', 'U2', 'Rock', '869ea1091d51e54df60f101def243241', 'a29b245e715945b7454301f8699607ff'),
(5, 'Billie Jean', 'Thriller', 'Michael Jackson', 'Funk', 'be378f21cbd0e6efde51e97a35bbc40c', '1ca744f519d451303ab6ccf91caac4b8'),
(6, 'Bohemian Rhapsody', 'A Night at the Opera', 'Queen', 'Pop', '66dee7c5549fe64db186890c488add6d', '2ba5b10924c318a880367dac623d0229');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Username` varchar(50) NOT NULL,
  `Passwort` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Username`, `Passwort`) VALUES
('test', '$2y$10$JDjZe8xTZq1vxw5tbCcmOOAmUpV9GxLKzGsRzI93YXHngel2SuwUe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Song`
--
ALTER TABLE `Song`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Song`
--
ALTER TABLE `Song`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
