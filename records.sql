-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 10:53 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) NOT NULL,
  `beneficiary` varchar(100) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `description` varchar(255) NOT NULL,
  `entrydate` date NOT NULL,
  `paydate` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `beneficiary`, `amount`, `description`, `entrydate`, `paydate`, `status`) VALUES
(1, 'Kevin Akaniru', '50000', 'Free Gift given for his bravery', '2018-11-13', '2018-11-20', 'pending'),
(2, 'Pedro Opara', '500000', 'Over time and loyalty bonus', '2018-11-13', '2018-11-14', 'overdue'),
(5, 'Chioma\'s Technologies', '50000', 'Payment for the new phones', '2018-11-13', '2018-11-22', 'pending'),
(6, 'Kelechi Nkele', '30000', 'Trip to Enugu', '2018-11-13', '2018-11-20', 'due'),
(10, 'Favour Obasi', '50000', 'Bonus on extra items', '2018-11-13', '2018-11-20', 'paid'),
(11, 'Richard Bassey', '50000', 'PDC Cabling and routing', '2018-11-13', '2018-11-20', 'paid'),
(12, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(13, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(14, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(15, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(16, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(17, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(18, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(19, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(20, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(21, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(22, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(23, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(24, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(25, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(26, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(27, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(28, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(29, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(30, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(31, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(32, 'Kevin Akaniru', '50000', 'Free Goft given for his bravery', '2018-11-13', '2018-11-20', 'nill'),
(33, 'Beneficiary', '', 'Description', '0000-00-00', '0000-00-00', 'status'),
(34, 'Krestel Hioli', '', 'Payment for sweet services', '2010-03-18', '2011-12-18', 'paid'),
(35, 'Beneficiary', '', 'Description', '0000-00-00', '0000-00-00', 'status'),
(36, 'Krestel Hioli', '', 'Payment for sweet services', '2010-03-18', '2011-12-18', 'paid'),
(37, 'Brad Pitt ', '', 'Payment for sweet services everdya', '2010-05-18', '2011-10-18', 'overdue'),
(38, 'Bovi Akpan ', '', 'Payment for sweet services', '2010-01-18', '0000-00-00', 'due'),
(39, 'Basket mouth', '', 'Payment for sweet services', '0000-00-00', '0000-00-00', 'pending'),
(40, 'Mr Mac', '', 'Payment for sweet services', '2010-11-18', '0000-00-00', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
