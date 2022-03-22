-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 20, 2022 at 03:42 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountSum`
--

CREATE TABLE `accountSum` (
  `accountID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accountType` varchar(20) NOT NULL,
  `accountNum` varchar(20) NOT NULL,
  `accountBalance` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountSum`
--

INSERT INTO `accountSum` (`accountID`, `user_id`, `accountType`, `accountNum`, `accountBalance`) VALUES
(1, 50554027, 'Savings', 'FB-809651', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_type` varchar(20) CHARACTER SET armscii8 NOT NULL,
  `transaction_amount` varchar(20) CHARACTER SET armscii8 NOT NULL,
  `transaction_processtype` varchar(20) CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `transaction_date`, `transaction_type`, `transaction_amount`, `transaction_processtype`) VALUES
(1, 50554027, '2022-03-20 15:06:58', 'Payment', '50000', 'Credited'),
(2, 50554027, '2022-03-20 15:06:52', 'Transfer', '100000', 'Debited');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `U_TableId` int(20) NOT NULL,
  `User_Id` int(50) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `Reg_Date` varchar(30) CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`U_TableId`, `User_Id`, `First_Name`, `Last_Name`, `Email_Address`, `User_Password`, `Reg_Date`) VALUES
(1, 50554027, 'test', 'test', 'test@email.com', '$2y$10$m3TbOGDPXmXtL0K/HgdsauvwV7/UsF02ANqg/JD7.vhbv7hkH3KNy', '20/Mar/2022 --- 07:57:41am'),
(2, 487559, 'test2', 'test2', 'test2@email.com', '$2y$10$4TeAmKqGtgGoXcPUyu1tBO0HNLpfAjSQmuEG1dbmxrfxRq7YYdLrO', '20/Mar/2022 --- 08:15:38am'),
(3, 95542, 'test3', 'test3', 'test3@email.com', '$2y$10$MbGxWg6LjjnlL/2bmK9wSu4U41I0cxF60VVSf775qHASNwl79ysyG', '20/Mar/2022 --- 08:16:33am'),
(5, 44126, 'test4', 'test4', 'test4@email.com', '$2y$10$UHIgmdMzlrVgj673td5f2Ouh4Sff5QPyUxkUjTL1wcXlbCJi9mnqq', '20/Mar/2022 --- 08:35:47am'),
(6, 649688, 'test5', 'test5', 'test5@email.com', '$2y$10$Z5NF30Fxa341jA/3ffLVB.2epVAaf520UJWffolOh3jvaCY2a3ZVK', '20/Mar/2022 --- 08:36:17am'),
(7, 8258, 'test6', 'test6', 'test6@email.com', '$2y$10$CtNXFsHDa24hK8fGpBftx.YbqTMd5MhqNQGporLCrq6C8sZJKvA5S', '20/Mar/2022 --- 09:47:06am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountSum`
--
ALTER TABLE `accountSum`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`U_TableId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountSum`
--
ALTER TABLE `accountSum`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `U_TableId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
