-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 06:41 AM
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
  `FISH_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `FOOD_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IS_VERIFIED` tinyint(1) NOT NULL,
  `IS_DELETED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alternative_fish`
--

INSERT INTO `alternative_fish` (`FISH_ID`, `NAME`, `DESCRIPTION`, `FOOD_ID`, `IMAGE`, `IS_VERIFIED`, `IS_DELETED`) VALUES
('4a5a7f05-7b98-4cad-9745-106f6922baca', 'Ikan CipiCipi', 'tes', 'FOD00001', 'asd', 0, 0),
('89260d50-c9cf-4189-a1eb-4f6519da0c7f', 'Ikan kamu', 'alamak', '3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', 'C7bx9eVOcoAhPDyGcrxtPQRWsYD1gEnULd5J07H1.jpg', 0, 0),
('FSH00001', 'Ikan Channa', 'Ikan yang suka nyupang', 'FOD00001', '', 0, 0),
('FSH00002', 'Ikan Guppy', 'gaptek', 'FOD00001', '', 0, 0),
('FSH00003', 'Ikan Arwana', 'asd', 'FOD00001', 'tes', 0, 0),
('FSH00004', 'Ikan Molly', 'asd', 'FOD00001', 'test', 0, 0);

--
-- Triggers `alternative_fish`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_alternative_fish` BEFORE INSERT ON `alternative_fish` FOR EACH ROW BEGIN
    SET NEW.is_deleted = 0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_insert_alternative_fish_is_verified` BEFORE INSERT ON `alternative_fish` FOR EACH ROW BEGIN
    SET NEW.is_verified = 0;
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
  `FISH_VARIETY_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `VARIETY_NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `FISH_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IS_DELETED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fish_variety`
--

INSERT INTO `fish_variety` (`FISH_VARIETY_ID`, `VARIETY_NAME`, `DESCRIPTION`, `FISH_ID`, `IMAGE`, `IS_DELETED`) VALUES
('FVT00001', 'Half Moon', 'Terang bulan', 'FSH00001', '', 0),
('FVT00002', 'Crown Tail', 'Ekor Mahkota', 'FSH00001', '', 0),
('FVT00003', 'Red Dragon', 'saya suka naga merah', 'FSH00002', '', 0),
('FVT00004', 'Blue Dragon', 'naga biru lee', 'FSH00002', '', 0);

--
-- Triggers `fish_variety`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_fish_variety` BEFORE INSERT ON `fish_variety` FOR EACH ROW BEGIN
    SET NEW.is_deleted = 0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `FOOD_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IS_DELETED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`FOOD_ID`, `NAME`, `DESCRIPTION`, `IMAGE`, `IS_DELETED`) VALUES
('3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', 'Udang Kering', 'tes', 'asd', 0),
('FOD00001', 'Pelet', 'Pelet merupakan makanan paling umum', '', 0);

--
-- Triggers `food`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_food` BEFORE INSERT ON `food` FOR EACH ROW BEGIN
    SET NEW.is_deleted = 0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `master_alternatives`
--

CREATE TABLE `master_alternatives` (
  `MASTER_ALTERNATIVES_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CRITERIA_ID` varchar(10) DEFAULT NULL,
  `FISH_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `VALUE` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_alternatives`
--

INSERT INTO `master_alternatives` (`MASTER_ALTERNATIVES_ID`, `CRITERIA_ID`, `FISH_ID`, `VALUE`) VALUES
('MAL00001', 'CRT00001', 'FSH00001', 4),
('MAL00002', 'CRT00002', 'FSH00001', 4),
('MAL00003', 'CRT00003', 'FSH00001', 1),
('MAL00004', 'CRT00004', 'FSH00001', 4),
('MAL00005', 'CRT00005', 'FSH00001', 3),
('MAL00006', 'CRT00006', 'FSH00001', 2),
('MAL00007', 'CRT00007', 'FSH00001', 1),
('MAL00008', 'CRT00001', 'FSH00002', 4),
('MAL00009', 'CRT00002', 'FSH00002', 3),
('MAL00010', 'CRT00003', 'FSH00002', 2),
('MAL00011', 'CRT00004', 'FSH00002', 3),
('MAL00012', 'CRT00005', 'FSH00002', 3),
('MAL00013', 'CRT00006', 'FSH00002', 2),
('MAL00014', 'CRT00007', 'FSH00002', 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_criteria`
--

CREATE TABLE `master_criteria` (
  `MASTER_CRITERIA_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `USER_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CRITERIA_ID` varchar(10) DEFAULT NULL,
  `WEIGHT_TXT` varchar(20) DEFAULT NULL,
  `WEIGHT_INT` int DEFAULT NULL,
  `RESULT_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `RESULT_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TIME_ADDED` datetime DEFAULT NULL,
  `USER_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`RESULT_ID`, `TIME_ADDED`, `USER_ID`) VALUES
('RES00001', '2025-05-18 10:03:11', 'USR00001'),
('RES00002', '2025-05-18 10:14:00', 'USR00001');

-- --------------------------------------------------------

--
-- Table structure for table `result_detail`
--

CREATE TABLE `result_detail` (
  `RESULT_DETAIL_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RANKING` int DEFAULT NULL,
  `RESULT_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FISH_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result_detail`
--

INSERT INTO `result_detail` (`RESULT_DETAIL_ID`, `RANKING`, `RESULT_ID`, `FISH_ID`) VALUES
('RDT00001', 1, 'RES00001', 'FSH00001'),
('RDT00002', 2, 'RES00001', 'FSH00002'),
('RDT00003', 1, 'RES00002', 'FSH00002'),
('RDT00004', 2, 'RES00002', 'FSH00001');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PiT0gWsLTZaOBflew4Sm29gwqDLWufZbmHgBzzav', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1lQckl0a1ZDUDBoaWFVZkNBdTlkMGJJUDhwRURwMXNPMWlCcUxMdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747807896);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `USER_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `DISPLAY_NAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `ROLE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `IMAGE` varchar(255) NOT NULL,
  `IS_DELETED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`USER_ID`, `USERNAME`, `DISPLAY_NAME`, `PASSWORD`, `ROLE`, `EMAIL`, `IMAGE`, `IS_DELETED`) VALUES
('USR00001', 'Ripat', 'ripatganteng', 'aduhai', 'user', 'mochamad@gmail.com', '', 0),
('USR00002', 'admin', 'iniAdminWo', 'sultantanahsunda', 'admin', 'admin@gmail.com', '', 0);

--
-- Triggers `user_account`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_user_account` BEFORE INSERT ON `user_account` FOR EACH ROW BEGIN
    SET NEW.is_deleted = 0;
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
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`FOOD_ID`);

--
-- Indexes for table `master_alternatives`
--
ALTER TABLE `master_alternatives`
  ADD PRIMARY KEY (`MASTER_ALTERNATIVES_ID`),
  ADD KEY `CRITERIA_ID` (`CRITERIA_ID`),
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `master_criteria`
--
ALTER TABLE `master_criteria`
  ADD PRIMARY KEY (`MASTER_CRITERIA_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `CRITERIA_ID` (`CRITERIA_ID`),
  ADD KEY `fk_result_id` (`RESULT_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`RESULT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `result_detail`
--
ALTER TABLE `result_detail`
  ADD PRIMARY KEY (`RESULT_DETAIL_ID`),
  ADD KEY `RESULT_ID` (`RESULT_ID`),
  ADD KEY `FISH_ID` (`FISH_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

ALTER TABLE user_account ADD remember_token VARCHAR(100) NULL;


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `AUTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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