-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2025 at 02:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngepeth`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative_fish`
--

CREATE TABLE `alternative_fish` (
  `AUTO_ID` int NOT NULL,
  `FISH_ID` varchar(10) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `FOOD_ID` varchar(10) DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alternative_fish`
--

INSERT INTO `alternative_fish` (`AUTO_ID`, `FISH_ID`, `NAME`, `DESCRIPTION`, `FOOD_ID`, `IMAGE`) VALUES
(1, 'FSH00001', 'Ikan Cupang', 'Ikan yang suka nyupang', 'FOD00001', ''),
(2, 'FSH00002', 'Ikan Guppy', 'gaptek', 'FOD00001', '');

--
-- Triggers `alternative_fish`
--
DELIMITER $$
CREATE TRIGGER `trg_fish_id` BEFORE INSERT ON `alternative_fish` FOR EACH ROW BEGIN
  IF NEW.FISH_ID IS NULL OR NEW.FISH_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM ALTERNATIVE_FISH);
    SET NEW.FISH_ID = CONCAT('FSH', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `AUTO_ID` int NOT NULL,
  `CRITERIA_ID` varchar(10) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`AUTO_ID`, `CRITERIA_ID`, `NAME`) VALUES
(1, 'CRT00001', 'Harga'),
(2, 'CRT00002', 'Kompleksitas Pemeliharaan'),
(3, 'CRT00003', 'Kelangkaan'),
(4, 'CRT00004', 'Biaya Pemeliharaan'),
(5, 'CRT00005', 'Ukuran'),
(6, 'CRT00006', 'Estetika'),
(7, 'CRT00007', 'Perilaku');

--
-- Triggers `criteria`
--
DELIMITER $$
CREATE TRIGGER `trg_criteria_id` BEFORE INSERT ON `criteria` FOR EACH ROW BEGIN
  IF NEW.CRITERIA_ID IS NULL OR NEW.CRITERIA_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM CRITERIA);
    SET NEW.CRITERIA_ID = CONCAT('CRT', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fish_variety`
--

CREATE TABLE `fish_variety` (
  `AUTO_ID` int NOT NULL,
  `FISH_VARIETY_ID` varchar(10) NOT NULL,
  `VARIETY_NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `FISH_ID` varchar(10) DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fish_variety`
--

INSERT INTO `fish_variety` (`AUTO_ID`, `FISH_VARIETY_ID`, `VARIETY_NAME`, `DESCRIPTION`, `FISH_ID`, `IMAGE`) VALUES
(1, 'FVT00001', 'Half Moon', 'Terang bulan', 'FSH00001', ''),
(2, 'FVT00002', 'Crown Tail', 'Ekor Mahkota', 'FSH00001', ''),
(3, 'FVT00003', 'Red Dragon', 'saya suka naga merah', 'FSH00002', ''),
(4, 'FVT00004', 'Blue Dragon', 'naga biru lee', 'FSH00002', '');

--
-- Triggers `fish_variety`
--
DELIMITER $$
CREATE TRIGGER `trg_fish_variety_id` BEFORE INSERT ON `fish_variety` FOR EACH ROW BEGIN
  IF NEW.FISH_VARIETY_ID IS NULL OR NEW.FISH_VARIETY_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM FISH_VARIETY);
    SET NEW.FISH_VARIETY_ID = CONCAT('FVT', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `AUTO_ID` int NOT NULL,
  `FOOD_ID` varchar(10) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`AUTO_ID`, `FOOD_ID`, `NAME`, `DESCRIPTION`, `IMAGE`) VALUES
(1, 'FOD00001', 'Pelet', 'Pelet merupakan makanan paling umum', '');

--
-- Triggers `food`
--
DELIMITER $$
CREATE TRIGGER `trg_food_id` BEFORE INSERT ON `food` FOR EACH ROW BEGIN
  IF NEW.FOOD_ID IS NULL OR NEW.FOOD_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM FOOD);
    SET NEW.FOOD_ID = CONCAT('FOD', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `master_alternatives`
--

CREATE TABLE `master_alternatives` (
  `AUTO_ID` int NOT NULL,
  `MASTER_ALTERNATIVES_ID` varchar(10) NOT NULL,
  `CRITERIA_ID` varchar(10) DEFAULT NULL,
  `FISH_ID` varchar(10) DEFAULT NULL,
  `VALUE` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_alternatives`
--

INSERT INTO `master_alternatives` (`AUTO_ID`, `MASTER_ALTERNATIVES_ID`, `CRITERIA_ID`, `FISH_ID`, `VALUE`) VALUES
(1, 'MAL00001', 'CRT00001', 'FSH00001', 4),
(2, 'MAL00002', 'CRT00002', 'FSH00001', 4),
(3, 'MAL00003', 'CRT00003', 'FSH00001', 1),
(4, 'MAL00004', 'CRT00004', 'FSH00001', 4),
(5, 'MAL00005', 'CRT00005', 'FSH00001', 3),
(6, 'MAL00006', 'CRT00006', 'FSH00001', 2),
(7, 'MAL00007', 'CRT00007', 'FSH00001', 1),
(8, 'MAL00008', 'CRT00001', 'FSH00002', 4),
(9, 'MAL00009', 'CRT00002', 'FSH00002', 3),
(10, 'MAL00010', 'CRT00003', 'FSH00002', 2),
(11, 'MAL00011', 'CRT00004', 'FSH00002', 3),
(12, 'MAL00012', 'CRT00005', 'FSH00002', 3),
(13, 'MAL00013', 'CRT00006', 'FSH00002', 2),
(14, 'MAL00014', 'CRT00007', 'FSH00002', 2);

--
-- Triggers `master_alternatives`
--
DELIMITER $$
CREATE TRIGGER `trg_master_alternatives_id` BEFORE INSERT ON `master_alternatives` FOR EACH ROW BEGIN
  IF NEW.MASTER_ALTERNATIVES_ID IS NULL OR NEW.MASTER_ALTERNATIVES_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM MASTER_ALTERNATIVES);
    SET NEW.MASTER_ALTERNATIVES_ID = CONCAT('MAL', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `master_criteria`
--

CREATE TABLE `master_criteria` (
  `AUTO_ID` int NOT NULL,
  `MASTER_CRITERIA_ID` varchar(10) NOT NULL,
  `USER_ID` varchar(10) DEFAULT NULL,
  `CRITERIA_ID` varchar(10) DEFAULT NULL,
  `WEIGHT_TXT` varchar(20) DEFAULT NULL,
  `WEIGHT_INT` int DEFAULT NULL,
  `RESULT_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `master_criteria`
--
DELIMITER $$
CREATE TRIGGER `trg_master_criteria_id` BEFORE INSERT ON `master_criteria` FOR EACH ROW BEGIN
  IF NEW.MASTER_CRITERIA_ID IS NULL OR NEW.MASTER_CRITERIA_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM MASTER_CRITERIA);
    SET NEW.MASTER_CRITERIA_ID = CONCAT('MCR', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `AUTO_ID` int NOT NULL,
  `RESULT_ID` varchar(10) NOT NULL,
  `TIME_ADDED` datetime DEFAULT NULL,
  `USER_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`AUTO_ID`, `RESULT_ID`, `TIME_ADDED`, `USER_ID`) VALUES
(1, 'RES00001', '2025-05-18 10:03:11', 'USR00001'),
(2, 'RES00002', '2025-05-18 10:14:00', 'USR00001');

--
-- Triggers `result`
--
DELIMITER $$
CREATE TRIGGER `trg_result_id` BEFORE INSERT ON `result` FOR EACH ROW BEGIN
  IF NEW.RESULT_ID IS NULL OR NEW.RESULT_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM RESULT);
    SET NEW.RESULT_ID = CONCAT('RES', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `result_detail`
--

CREATE TABLE `result_detail` (
  `AUTO_ID` int NOT NULL,
  `RESULT_DETAIL_ID` varchar(10) NOT NULL,
  `RANKING` int DEFAULT NULL,
  `RESULT_ID` varchar(10) DEFAULT NULL,
  `FISH_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result_detail`
--

INSERT INTO `result_detail` (`AUTO_ID`, `RESULT_DETAIL_ID`, `RANKING`, `RESULT_ID`, `FISH_ID`) VALUES
(1, 'RDT00001', 1, 'RES00001', 'FSH00001'),
(2, 'RDT00002', 2, 'RES00001', 'FSH00002'),
(3, 'RDT00003', 1, 'RES00002', 'FSH00002'),
(4, 'RDT00004', 2, 'RES00002', 'FSH00001');

--
-- Triggers `result_detail`
--
DELIMITER $$
CREATE TRIGGER `trg_result_detail_id` BEFORE INSERT ON `result_detail` FOR EACH ROW BEGIN
  IF NEW.RESULT_DETAIL_ID IS NULL OR NEW.RESULT_DETAIL_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM RESULT_DETAIL);
    SET NEW.RESULT_DETAIL_ID = CONCAT('RDT', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `AUTO_ID` int NOT NULL,
  `USER_ID` varchar(10) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `DISPLAY_NAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `ROLE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`AUTO_ID`, `USER_ID`, `USERNAME`, `DISPLAY_NAME`, `PASSWORD`, `ROLE`, `EMAIL`) VALUES
(1, 'USR00001', 'Ripat', 'ripatganteng', 'aduhai', 'user', 'mochamad@gmail.com'),
(2, 'USR00002', 'admin', 'iniAdminWo', 'sultantanahsunda', 'admin', 'admin@gmail.com');

--
-- Triggers `user_account`
--
DELIMITER $$
CREATE TRIGGER `trg_user_id` BEFORE INSERT ON `user_account` FOR EACH ROW BEGIN
  IF NEW.USER_ID IS NULL OR NEW.USER_ID = '' THEN
    SET @next_id = (SELECT IFNULL(MAX(AUTO_ID), 0) + 1 FROM User_Account);
    SET NEW.USER_ID = CONCAT('USR', LPAD(@next_id, 5, '0'));
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative_fish`
--
ALTER TABLE `alternative_fish`
  ADD PRIMARY KEY (`FISH_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `FOOD_ID` (`FOOD_ID`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`CRITERIA_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`);

--
-- Indexes for table `fish_variety`
--
ALTER TABLE `fish_variety`
  ADD PRIMARY KEY (`FISH_VARIETY_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`FOOD_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`);

--
-- Indexes for table `master_alternatives`
--
ALTER TABLE `master_alternatives`
  ADD PRIMARY KEY (`MASTER_ALTERNATIVES_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `CRITERIA_ID` (`CRITERIA_ID`),
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `master_criteria`
--
ALTER TABLE `master_criteria`
  ADD PRIMARY KEY (`MASTER_CRITERIA_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `CRITERIA_ID` (`CRITERIA_ID`),
  ADD KEY `fk_result_id` (`RESULT_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`RESULT_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `result_detail`
--
ALTER TABLE `result_detail`
  ADD PRIMARY KEY (`RESULT_DETAIL_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD KEY `RESULT_ID` (`RESULT_ID`),
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `AUTO_ID` (`AUTO_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative_fish`
--
ALTER TABLE `alternative_fish`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fish_variety`
--
ALTER TABLE `fish_variety`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_alternatives`
--
ALTER TABLE `master_alternatives`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_criteria`
--
ALTER TABLE `master_criteria`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `result_detail`
--
ALTER TABLE `result_detail`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternative_fish`
--
ALTER TABLE `alternative_fish`
  ADD CONSTRAINT `alternative_fish_ibfk_1` FOREIGN KEY (`FOOD_ID`) REFERENCES `food` (`FOOD_ID`);

--
-- Constraints for table `fish_variety`
--
ALTER TABLE `fish_variety`
  ADD CONSTRAINT `fish_variety_ibfk_1` FOREIGN KEY (`FISH_ID`) REFERENCES `alternative_fish` (`FISH_ID`);

--
-- Constraints for table `master_alternatives`
--
ALTER TABLE `master_alternatives`
  ADD CONSTRAINT `master_alternatives_ibfk_1` FOREIGN KEY (`CRITERIA_ID`) REFERENCES `criteria` (`CRITERIA_ID`),
  ADD CONSTRAINT `master_alternatives_ibfk_2` FOREIGN KEY (`FISH_ID`) REFERENCES `alternative_fish` (`FISH_ID`);

--
-- Constraints for table `master_criteria`
--
ALTER TABLE `master_criteria`
  ADD CONSTRAINT `fk_result_id` FOREIGN KEY (`RESULT_ID`) REFERENCES `result` (`RESULT_ID`),
  ADD CONSTRAINT `master_criteria_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user_account` (`USER_ID`),
  ADD CONSTRAINT `master_criteria_ibfk_2` FOREIGN KEY (`CRITERIA_ID`) REFERENCES `criteria` (`CRITERIA_ID`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user_account` (`USER_ID`);

--
-- Constraints for table `result_detail`
--
ALTER TABLE `result_detail`
  ADD CONSTRAINT `result_detail_ibfk_1` FOREIGN KEY (`RESULT_ID`) REFERENCES `result` (`RESULT_ID`),
  ADD CONSTRAINT `result_detail_ibfk_2` FOREIGN KEY (`FISH_ID`) REFERENCES `alternative_fish` (`FISH_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
