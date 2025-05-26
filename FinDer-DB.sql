-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 26, 2025 at 02:55 AM
-- Server version: 8.0.35
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finder`
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
  `IMAGE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IS_VERIFIED` tinyint(1) NOT NULL,
  `IS_DELETED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alternative_fish`
--

INSERT INTO `alternative_fish` (`FISH_ID`, `NAME`, `DESCRIPTION`, `FOOD_ID`, `IMAGE`, `IS_VERIFIED`, `IS_DELETED`) VALUES
('001823ac-4140-4fda-8072-75d0985c3cf4', 'Ikan Platy', 'Ikan ramah pemula yang mudah dipelihara.', '3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', '01lvvWW74XuoqoAdJsOWYh8LGqwYXtQp79PpsfTV.jpg', 1, 0),
('2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 'Ikan Neon Tetra', 'Ikan kecil yang indah dan aktif, cocok untuk akuarium.', '3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', '', 1, 0),
('2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 'Ikan Black Ghost', 'Ikan misterius dengan warna hitam pekat.', NULL, '', 1, 0),
('367b9705-6ee7-47e7-8ac6-b351eea26f92', 'Ikan Mas Koki', 'Ikan dengan tubuh bulat dan gerakan anggun.', NULL, '', 1, 0),
('4587a79b-8c80-406a-b223-cec7636fb92f', 'testing', 'ini ngetes', '3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', 'pOLpe2R2Wqm3KA0o8FmNEn2ysX1yp5QuKtWaDU1g.png', 0, 0),
('5e8bda67-0500-47e9-a68f-3bd50f7238d7', 'Ikan Oscar', 'Ikan agresif yang membutuhkan ruang cukup besar.', NULL, '', 1, 0),
('9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 'Ikan Discus', 'Ikan eksotis dengan warna dan bentuk tubuh menarik.', NULL, '', 1, 0),
('a329fe9f-684b-4f08-94d6-1deac127a877', 'Ikan Rainbow Fish', 'Ikan kecil berwarna-warni yang aktif bergerak.', NULL, '', 1, 0),
('a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 'Ikan Channa', 'Ikan predator semi-agresif yang populer di kalangan hobiis.', NULL, '', 1, 0),
('b3730910-8a6a-4a56-8b30-c69d1d398c75', 'Ikan Guppy', 'Ikan kecil berwarna cerah yang mudah dipelihara.', NULL, '', 1, 0),
('b6202190-87df-44d5-9ec1-09f92f0e41aa', 'Ikan Arwana', 'Ikan predator besar yang eksotis dan langka.', NULL, '', 1, 0),
('b6e6999e-0063-4608-93cd-9c9420b6c7e5', 'Ikan Arapaima', 'Ikan raksasa dari Amazon yang sangat langka.', NULL, '', 1, 0),
('bf53c165-4350-4bd4-b3e3-2dd2ccc67979', 'Ikan Sapu-sapu', 'Ikan pembersih akuarium yang aktif di dasar.', NULL, '', 1, 0),
('cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 'Ikan Botia', 'Ikan unik dengan pola belang dan aktif di dasar.', NULL, '', 1, 0),
('d90a003a-bf1d-43ea-ade2-b169a69f49db', 'Ikan Koi', 'Ikan mahal dengan warna indah dan ukuran besar.', NULL, '', 1, 0),
('dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 'Ikan Corydoras', 'Ikan dasar yang damai dan aktif di malam hari.', NULL, '', 1, 0),
('dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 'Ikan Molly', 'Ikan damai yang cocok untuk akuarium komunitas.', NULL, '', 1, 0),
('f22cf792-5938-4a35-8e03-8f05c35dc672', 'Ikan Manfish', 'Ikan elegan dengan sirip panjang dan gerakan tenang.', NULL, '', 1, 0),
('f7be6d0c-31f0-4d2b-9511-27022a826a84', 'Ikan Louhan', 'Ikan eksotis dengan bentuk unik dan warna mencolok.', NULL, '', 1, 0),
('fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 'Ikan Palmas', 'Ikan mirip naga kecil dengan tubuh panjang.', NULL, '', 1, 0),
('fed6cbc1-bce9-4778-a511-ada651bc848d', 'Ikan Cupang', 'Ikan hias populer dengan warna mencolok dan sirip indah.', NULL, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `CRITERIA_ID` varchar(10) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `TYPE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`CRITERIA_ID`, `NAME`, `TYPE`) VALUES
('CRT00001', 'Harga', 'COST'),
('CRT00002', 'Kompleksitas Pemeliharaan', 'COST'),
('CRT00003', 'Biaya Pemeliharaan', 'COST'),
('CRT00004', 'Ukuran', 'COST'),
('CRT00005', 'Kelangkaan', 'BENEFIT'),
('CRT00006', 'Estetika', 'BENEFIT'),
('CRT00007', 'Perilaku', 'BENEFIT');

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
('200ab5f0-4abc-49a1-843c-a81b89e4e611', 'Cacing', 'Makanan favorit ikan karnivora seperti ikan cupang dan arwana.', '', 0),
('2491bebb-3f19-4706-b63b-c23b3516a2ff', 'Microworms', 'Makanan hidup untuk menambah variasi diet ikan kecil.', '', 0),
('368d8948-92b7-45d9-816b-8e74d08d4368', 'Krill', 'Makanan hidup kaya protein untuk ikan hias yang aktif.', '', 0),
('3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f', 'Udang Kering', 'tes', 'asd', 0),
('412d773f-a2b0-44c0-9ed7-ca9dadec486c', 'Sayuran cincang', 'Makanan kaya serat untuk ikan seperti ikan mas koi dan goldfish.', '', 0),
('426767da-412b-4e9e-a41f-7e2963cbb8c2', 'Sayuran zucchini', 'Sayuran yang cocok untuk ikan sapu-sapu dan pleco.', '', 0),
('5a845c06-1237-4564-9813-588e247cddd1', 'Makanan beku', 'Makanan sehat untuk ikan discus dan cichlid.', '', 0),
('6330e20b-30ef-488d-b807-50be8a8e5b5d', 'Serangga kecil', 'Makanan alami untuk banyak ikan hias karnivora.', '', 0),
('67fab212-589b-4bc7-8482-c276d06c1421', 'Pelet untuk ikan komunitas', 'Pelet lengkap untuk berbagai jenis ikan hias.', '', 0),
('7eee5796-9877-46bf-b6a5-91d05fb09ca2', 'Sayuran muda', 'Sayuran segar untuk ikan herbivora.', '', 0),
('8538c45d-ff02-424b-ac1e-46f896defa29', 'Pelet warna-warni', 'Pelet untuk meningkatkan warna ikan seperti rainbow fish.', '', 0),
('998e9258-495b-4d69-b968-ab4cf970e46f', 'Pelet khusus cichlid', 'Pelet diformulasikan khusus untuk kebutuhan cichlid.', '', 0),
('a06f42a2-1d30-4e64-9aff-289ad936d9fc', 'Tubifex worms', 'Cacing hidup yang disukai oleh ikan karnivora.', '', 0),
('af676823-765c-4575-8c39-998a8d69a7ff', 'Makanan hidup kecil', 'Makanan seperti serangga kecil untuk ikan manfish dan black ghost.', '', 0),
('b08dbd38-4858-4864-9da6-ca19eddd3728', 'Daphnia', 'Makanan hidup yang kaya protein untuk ikan hias.', '', 0),
('d372cee5-a8da-4510-95d0-70438c16a304', 'Larva serangga', 'Makanan hidup yang disukai ikan betta dan channa.', '', 0),
('d9ed69dc-b7ef-4e2c-984c-6cf9cccf5605', 'Pelet ikan besar', 'Pelet untuk ikan besar seperti ikan oscar dan arwana.', '', 0),
('da43c35e-5c02-40ab-8337-8e125c4def9f', 'Makanan serangga kering', 'Alternatif makanan kering kaya protein.', '', 0),
('e6e995d4-bf76-490f-98c8-a2476aa15149', 'Pelet ikan kecil', 'Pelet yang cocok untuk ikan kecil seperti guppy dan neon tetra.', '', 0),
('eb1d3457-fabe-4c8c-b35f-82e8797c8af0', 'Alga', 'Makanan alami untuk ikan herbivora seperti pleco.', '', 0),
('f819a6d5-9f95-4d4e-86ea-4f4878c68dbd', 'Cacing darah', 'Makanan favorit ikan betta dan beberapa ikan predator.', '', 0),
('f980b966-39bc-4579-a71c-695f14163d30', 'Artemia (brine shrimp)', 'Makanan hidup terbaik untuk anak ikan dan ikan kecil.', '', 0),
('FOD00001', 'Pelet', 'Pelet merupakan makanan paling umum', '', 0);

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
('01be4579-051c-4fdb-a404-84fcc42402ed', 'CRT00007', '001823ac-4140-4fda-8072-75d0985c3cf4', 3),
('084fee28-9a8d-4c93-9615-cf02c769e179', 'CRT00003', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('09457a26-0834-4946-85fa-ec2547a684cf', 'CRT00004', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 1),
('0a9ce069-6088-40f7-a4eb-8cb1d7101a71', 'CRT00004', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 2),
('0b9ab08d-c69e-4fda-b64a-11e369a02c4e', 'CRT00005', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1),
('0c0f11d6-75b7-490b-8861-2338bc08efab', 'CRT00001', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 3),
('0c7d79e1-4979-4d9d-9b53-6d9c42eb2e47', 'CRT00003', 'a329fe9f-684b-4f08-94d6-1deac127a877', 1),
('0ecd9074-0355-4e3d-b55f-9f752d56e460', 'CRT00004', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 4),
('1458b3bc-de1a-41b3-9988-63b4f939f2d8', 'CRT00003', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 1),
('14c6477c-7b2f-425c-a7ac-5c39229000f5', 'CRT00006', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 1),
('14ff735c-c2ad-4e20-81d7-406d379222d2', 'CRT00006', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('166b455c-f617-4c16-8e25-0809e9ea6171', 'CRT00001', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 4),
('16e79cb6-679d-4a20-8148-b0318f04147d', 'CRT00004', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 2),
('188511b6-fe01-44ae-8dc3-f50ad1f5c61f', 'CRT00002', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 2),
('18c7b33c-0c4a-4ae0-886e-99f03266225e', 'CRT00006', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 2),
('1aceb696-a828-48e0-b15c-41217bfb80b8', 'CRT00006', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 2),
('1b55a0b0-0ae7-4602-a324-81ad659d6555', 'CRT00005', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 3),
('1d59aa0d-53d3-4935-bf65-71cfa1ab0e95', 'CRT00005', 'a329fe9f-684b-4f08-94d6-1deac127a877', 2),
('20caacc2-2e13-4ca7-a58e-62e13b267ebf', 'CRT00001', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 2),
('28f473e5-beb8-4833-a210-079e4577535b', 'CRT00003', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 1),
('2b9b7829-bf4d-49d8-ab5b-fcca9b3189a3', 'CRT00001', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 4),
('2d305dba-194f-4896-84cb-4c7f32c13bde', 'CRT00007', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 3),
('2e32b0a8-5fd5-40a9-9291-77cc1ad40943', 'CRT00001', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 2),
('31d2d7f6-673e-4c4e-978c-a1e74420d9c3', 'CRT00007', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 3),
('334b15f4-862b-4b70-971a-c249c09f5b8b', 'CRT00005', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 4),
('344ffddb-d41f-4404-9fd4-2a12556af593', 'CRT00004', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 2),
('345aa7bf-b91b-4655-b190-4b1fa4f0ac86', 'CRT00003', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 2),
('36b244b8-195c-47a2-96d0-ca89b0169e81', 'CRT00003', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 2),
('3b025f19-1034-48bc-941c-487b3f38fb2d', 'CRT00006', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('408275b7-ee6b-4ddc-ad64-450251dd692f', 'CRT00003', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 2),
('41c1d7a6-dd55-41e0-b6f7-1c4723927405', 'CRT00001', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 1),
('42691848-4835-4696-9c9d-ec0f21e6040d', 'CRT00001', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1),
('427ca519-2421-4019-9a5c-7184d729bb29', 'CRT00005', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('4283bd32-7880-4242-a06e-06b50db95be6', 'CRT00001', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 2),
('45ee6ab6-c66d-4769-8a0f-5e6f4b6d04a7', 'CRT00002', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('47e0f6c7-3a50-4dab-81bc-ba70f25a9ac9', 'CRT00006', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 1),
('48358067-e508-4012-8da8-99d0ba8a9a56', 'CRT00002', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 2),
('4880b28f-e6a9-4f0d-b065-805a3f2ea4b3', 'CRT00006', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 4),
('49b1fecc-8f3d-4777-9c9f-7fa70c4bb07e', 'CRT00002', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('49fff57e-57e9-4bb0-b99a-4dbe9609cb3b', 'CRT00007', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 3),
('4ac361a8-b8f9-4aa0-b12f-ea5c361e1ba6', 'CRT00003', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 2),
('4c11ca69-72b3-4632-8d0a-d06279ffb3cc', 'CRT00007', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 3),
('4ea28df1-3038-49b1-b87a-a83e9fa17ddd', 'CRT00006', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 1),
('4eaf4fcf-e652-4be1-a565-3f30eee10bb3', 'CRT00006', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 2),
('4fbb59ae-a18f-4bc6-abf3-4f30d9b61f84', 'CRT00002', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 2),
('51395767-4877-4b8e-93cd-77c989458db1', 'CRT00001', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('53952acd-5474-446d-9564-d7aedfb6e3dd', 'CRT00004', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 1),
('53b64231-df28-44c9-b92f-a6fee01ccfb0', 'CRT00003', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('575b9ed0-40a3-4af0-b2b7-bd5d3a883204', 'CRT00003', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 4),
('58d7a73f-ff6b-4c3c-af1a-674b2626d684', 'CRT00007', '001823ac-4140-4fda-8072-75d0985c3cf4', 2),
('5b9197fa-5800-480d-9e23-587d32203f90', 'CRT00001', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 3),
('5bc449b7-3f60-4f99-9202-3892d366d873', 'CRT00003', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 1),
('5e4df24f-c546-4e50-a134-2aa3a1d1cefc', 'CRT00004', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 3),
('5ff0ac45-67dc-409a-a9de-ab41ef1ed37b', 'CRT00002', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 1),
('637cb2ba-8617-49fb-be95-fc87e7d44e58', 'CRT00004', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('64277836-b401-41ab-81b1-2a2094840e27', 'CRT00002', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('64f6ff15-3e9d-4f14-8130-2ed56a87b993', 'CRT00001', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 2),
('6685b99b-1418-4f9f-b304-b667ef9bb239', 'CRT00001', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('67170c7c-4190-48fb-9e97-c73f102e022d', 'CRT00007', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 3),
('677d7b3f-0cc7-44bf-b230-e97935e02c5e', 'CRT00005', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 4),
('6a0f5787-a993-4c4a-b3d0-72b270c0322e', 'CRT00002', 'a329fe9f-684b-4f08-94d6-1deac127a877', 1),
('6a8326cd-ffd3-47eb-bc38-7522a594fd0c', 'CRT00001', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 1),
('6b18ee33-47dd-40a4-819d-632af7c44b6c', 'CRT00001', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('6ec75cfb-43da-4a9c-8af9-af50e6e08bbe', 'CRT00007', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 3),
('71009d74-58f0-4775-b5c4-65f828334bad', 'CRT00005', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 3),
('73675883-71f9-48ee-87fa-4d4e89a8f42b', 'CRT00005', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 2),
('739df52b-b31c-4b63-b2eb-1720d7f008b1', 'CRT00006', 'a329fe9f-684b-4f08-94d6-1deac127a877', 2),
('78b5f5be-b1e3-46e2-88bd-4bcf41b5af5e', 'CRT00004', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 2),
('805f1116-b152-46dc-82f7-17a1ccc68173', 'CRT00001', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('8109c7a1-864b-41aa-bbcb-018f949c60d2', 'CRT00007', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 3),
('81459f6d-5705-48fa-9480-7678dcfa3ea0', 'CRT00002', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 2),
('82b199c0-721e-4135-b781-6fed80a3f2f6', 'CRT00003', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('83d62abd-f2a9-4221-89be-67cf8703067a', 'CRT00001', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 2),
('849bb957-6dd2-4a0f-86a9-6c2d8bf210a5', 'CRT00004', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('8519dcfd-4e98-46f0-98a9-1c1739177c3d', 'CRT00007', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 3),
('88e8b595-c947-43a5-bec2-196a14474999', 'CRT00005', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 2),
('891a855d-24cf-4a44-a781-ffd7cff7ec9b', 'CRT00003', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1),
('8e7b9ab9-6b20-41a3-8df7-5df10fc9efdf', 'CRT00001', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 1),
('8f7a8f58-2694-4210-b7cd-d7b73f19b2bb', 'CRT00006', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 1),
('8fbb502e-160b-4d76-b3a1-710df3cec3c7', 'CRT00005', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 2),
('90224149-ae78-4bcd-a494-c3b014d393f5', 'CRT00007', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 3),
('91c4ed0d-99a8-411a-ac25-023159598012', 'CRT00002', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 1),
('926b80ba-0e70-40ff-9736-6a4400e403ab', 'CRT00005', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 2),
('92a9acf6-927e-45e5-81f3-82f0a8d988ac', 'CRT00001', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 1),
('940e6018-c7b8-4112-891e-715a649bb663', 'CRT00003', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 1),
('955440aa-6182-468e-85ce-d1b14ef75685', 'CRT00004', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 2),
('95cbb6d6-85cb-4425-b157-56935c1147d3', 'CRT00005', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 2),
('960be674-13f1-4d84-a651-133cd12194ab', 'CRT00007', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 4),
('96875e41-783f-4d6a-a7e6-b9d3af21b68b', 'CRT00003', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 1),
('972b080b-10cc-4af8-8147-b84ab527281c', 'CRT00005', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('9e8a94a5-3cc3-4c84-911a-496a74a99195', 'CRT00002', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('a3035b99-8079-45c9-a7f1-c116687ad4be', 'CRT00007', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 3),
('a4ef7203-b3b4-44d0-9598-ae84eeda5e4c', 'CRT00004', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 2),
('a6327afa-c3f3-4711-9360-5998f21fa87a', 'CRT00002', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 1),
('a8ff1645-06be-41df-98fb-f050d24863bb', 'CRT00004', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 1),
('ab54bb63-02a0-481d-ad78-db4e02007c8d', 'CRT00003', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 2),
('acb48924-cb17-4cf3-bb06-407ce21b1a6a', 'CRT00006', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 1),
('ad9d570b-c565-4402-82e1-29feaefe7a8f', 'CRT00004', '001823ac-4140-4fda-8072-75d0985c3cf4', 3),
('b178f927-2c41-4765-b383-76d2f3162e21', 'CRT00003', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 3),
('b46bc2fc-4093-430e-8ff9-bb1fabecc330', 'CRT00004', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 2),
('b6553f62-ff28-463b-adef-75678e12dd93', 'CRT00006', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 2),
('b96c6df7-6af1-4d33-81bf-69d1cdb49fbf', 'CRT00002', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 1),
('b9a7d2e6-e485-4f79-9426-fd8e0e27d71c', 'CRT00002', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 4),
('bb0c601f-56eb-4e86-82d4-5df1918786fa', 'CRT00005', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('bb72cc49-3b5b-4041-9a5e-213db42189e7', 'CRT00007', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 3),
('c1cf68c4-cc2f-4873-8cee-20eb632dbc27', 'CRT00004', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1),
('c2dcf184-7293-42e5-849a-c6754951ed03', 'CRT00006', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('c2f9bb00-8a21-4435-9074-211a3b38883b', 'CRT00001', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 2),
('c4434b40-dea5-47a3-8e0a-7cce9867620f', 'CRT00007', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 4),
('c4ba414e-7187-4a57-8570-9aee86ea311b', 'CRT00005', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 2),
('c79eca25-3544-4fa2-a113-8899bc70f5cf', 'CRT00002', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 1),
('c96d28a7-f55f-4b21-93c7-bd17656355fa', 'CRT00007', 'a329fe9f-684b-4f08-94d6-1deac127a877', 3),
('ce20f283-3119-4643-a53d-d13be7b102d9', 'CRT00003', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 2),
('d077bbaf-2587-46b8-aac1-5bddfb833c39', 'CRT00004', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 3),
('d26c8aa0-4ee6-4ebf-bcce-a02cdc5b3016', 'CRT00006', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 2),
('d3a0c78c-6924-4ec3-9965-cbbde9d0a4c1', 'CRT00006', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 3),
('d3f07fd9-529e-496a-ad1c-0a2dab6de65e', 'CRT00003', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 1),
('d4d991cc-1d95-425e-82f7-c9c999a010d2', 'CRT00007', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 3),
('d64ecf25-8a5d-4497-930a-6acecad3c28e', 'CRT00001', 'a329fe9f-684b-4f08-94d6-1deac127a877', 1),
('d6b16d47-655a-42f4-b246-ca451ce41993', 'CRT00005', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 3),
('d766b306-a8a6-4e30-b56d-0e5c84f1636c', 'CRT00006', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('dd132519-cd39-486a-81d7-e7692c3f4e25', 'CRT00005', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 1),
('dd830bb3-1e3f-489b-9f12-79fd1fb0bef8', 'CRT00005', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 2),
('dd981300-f23d-4e95-bb3b-2d1bfb4df4b2', 'CRT00004', 'a329fe9f-684b-4f08-94d6-1deac127a877', 1),
('de6614ab-7602-44f1-8a85-f589b22491a7', 'CRT00006', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 3),
('df454981-ac3d-4bf9-89a8-285cd4c196c8', 'CRT00004', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 4),
('e289d0a7-bc66-4853-afea-a4a206bd1639', 'CRT00005', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 1),
('e5e1e29d-7be0-4349-ae87-6b21aed6cdc8', 'CRT00003', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 3),
('e736daac-605e-4894-87bf-0f290b42272b', 'CRT00002', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 3),
('e902e96b-749d-4a07-bd1e-ccae56f3c87f', 'CRT00006', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 3),
('ea5fd5aa-5130-41a1-8e43-9e6152fa831a', 'CRT00002', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 2),
('ec3f2717-26f4-46af-89c9-d6f0b499c5e3', 'CRT00004', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 1),
('f24c798d-a4a7-4129-b2ee-c8c539456230', 'CRT00007', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 2),
('f5c65265-bd55-4266-8782-ee518a27c8cd', 'CRT00002', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 4),
('f670d82a-3d16-4f52-8ef2-a08c2f667958', 'CRT00007', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 2),
('f74a7849-d2d1-471c-8836-e68426c57fed', 'CRT00002', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1),
('f82d8c8b-d302-410a-9188-5f4174ccfe47', 'CRT00002', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 3),
('fc5d4b1f-ee71-46a4-86cc-2d2228faefa2', 'CRT00006', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 3),
('fef1bfde-c315-4683-9bc4-e41c11fff3fe', 'CRT00005', '001823ac-4140-4fda-8072-75d0985c3cf4', 1),
('ffcdceed-0f98-4151-b9f4-769dd7ce21b8', 'CRT00007', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_criteria`
--

CREATE TABLE `master_criteria` (
  `MASTER_CRITERIA_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `USER_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CRITERIA_ID` varchar(10) DEFAULT NULL,
  `WEIGHT_TXT` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `WEIGHT_INT` int DEFAULT NULL,
  `RESULT_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_criteria`
--

INSERT INTO `master_criteria` (`MASTER_CRITERIA_ID`, `USER_ID`, `CRITERIA_ID`, `WEIGHT_TXT`, `WEIGHT_INT`, `RESULT_ID`) VALUES
('061a5940-e9e9-4ebb-8eba-ac6c7105d433', 'USR00001', 'CRT00004', 'Tidak Penting', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('2977830b-3499-4be4-84c7-055e0e5e3816', 'USR00001', 'CRT00007', 'Tidak Penting', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('43f71e45-4255-4281-8848-7cf993e246c1', 'USR00001', 'CRT00005', 'Sangat Penting', 4, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('69c58d21-b769-4d1f-bcd1-7672b631c1dd', 'USR00001', 'CRT00006', 'Sangat Penting', 4, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('9eb86b40-0b1a-4b0e-a122-7997602d4f19', 'USR00001', 'CRT00003', 'Tidak Penting', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('a97e06af-f243-46de-b6c2-2bd4e8f0871a', 'USR00001', 'CRT00002', 'Tidak Penting', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f'),
('fb1da789-c0ff-4961-8df6-30cde970dc38', 'USR00001', 'CRT00001', 'Tidak Penting', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_22_110916_create_cache_table', 1),
(2, '2025_05_23_042301_google_social_auth_id', 2),
(3, '2025_05_23_073421_create_sessions_table', 3);

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
('ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '2025-05-26 01:02:24', 'USR00001');

-- --------------------------------------------------------

--
-- Table structure for table `result_detail`
--

CREATE TABLE `result_detail` (
  `RESULT_DETAIL_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RANKING` int DEFAULT NULL,
  `RESULT_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FISH_ID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `SCORE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result_detail`
--

INSERT INTO `result_detail` (`RESULT_DETAIL_ID`, `RANKING`, `RESULT_ID`, `FISH_ID`, `SCORE`) VALUES
('0ca9f90b-f392-410e-beeb-8105c0703706', 3, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'b6e6999e-0063-4608-93cd-9c9420b6c7e5', 1.4611237260423),
('10059e76-1c8b-4e98-8aa5-416aebb4daa7', 5, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'd90a003a-bf1d-43ea-ade2-b169a69f49db', 1.3770135400526),
('1ec59e01-b08e-43c4-9966-554ef8ef7b80', 13, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb', 0.99853589299233),
('271f25ae-5202-4fd0-bc08-4e720ac558be', 15, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f', 0.86242079944925),
('2a4f15bd-c207-443e-9136-182165f3fe33', 6, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'a329fe9f-684b-4f08-94d6-1deac127a877', 1.3241152306547),
('45b911d6-921b-4880-8ab7-131f9e23fdbb', 1, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'b6202190-87df-44d5-9ec1-09f92f0e41aa', 1.7452375102669),
('52323f2f-a252-4cad-9e1b-3906f044d477', 18, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '5e8bda67-0500-47e9-a68f-3bd50f7238d7', 0.36183662268026),
('69278add-16d2-48a6-8244-0b8688bd68ac', 7, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11', 1.1874322950282),
('6c8c566e-d49c-4400-9df1-0337873b874c', 16, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '367b9705-6ee7-47e7-8ac6-b351eea26f92', 0.82368357367753),
('6d9c6e34-6696-46a4-80a7-9567b434a09e', 17, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'f22cf792-5938-4a35-8e03-8f05c35dc672', 0.66721422272826),
('6e01f792-026f-4384-8523-315eff751a1b', 10, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'fed6cbc1-bce9-4778-a511-ada651bc848d', 1.0369507783085),
('787679e5-537a-4378-aeb2-534ca812f5eb', 8, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'b3730910-8a6a-4a56-8b30-c69d1d398c75', 1.1169482179676),
('8467e087-65d3-4209-b32c-5cf2ca52ddd9', 19, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '001823ac-4140-4fda-8072-75d0985c3cf4', 0.30204092063555),
('8f15bd7b-c52d-4c54-99f7-8d07fb229325', 11, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86', 1.0095867705412),
('c40d737e-09e9-468f-ad08-c56fa6ec6635', 2, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '2ca10b74-ec5e-4eff-9058-47dbcf484c7f', 1.7090154101145),
('d9fa86b7-2962-4394-b6dd-ffb578ff9697', 4, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4', 1.4262332247958),
('e7d84db8-2618-46b0-9ac5-846e120560ae', 9, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87', 1.1076448381103),
('f055cf36-babd-4bf3-abd0-d0eb06d21208', 14, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc', 0.93921505119496),
('ff29dc17-0e14-476d-b2d6-3729e5150fa9', 12, 'ea9066c5-dda4-40c7-b5fc-7665e7d7278f', 'f7be6d0c-31f0-4d2b-9511-27022a826a84', 1.0028011591147);

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
('6zAlpZ9kwZZTQ982u4oyMnRsouArTAayP14x7QKa', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVFiNm9JSng0ZGJkbml5ZDg5aFBIcVNCYk04VXBDb2RhdVZPWDcyUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdXRoIjt9fQ==', 1748227506),
('A82EP1mhKKKMHKO0e0cMQ8RzooPf9iHMQtg3zACj', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzQ3YUtoVHhZMEFrczVETnNUandwZVV0SzU0S25SSnNtNGExMUpMOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZS9yZWRpcmVjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IjRrMFFxUmZndXFFQ29FTHJwM2xoT3A1SUg5NHNyTlJLUDRNZUttSk0iO30=', 1748227450),
('jh7f0oGiaquoSZXMy3PoRc9JfCuI5QmYvZbVrrQt', 'aed03260-6103-4441-b632-df78399fdc69', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSDI0OHhqUnQ5bzZZdUlXZ1BRT21Nb0FvZkloV0xodnkwWlFZbDh2RiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NToic3RhdGUiO3M6NDA6IjRYUTVMNkxiS2hwRUpXRWd4TG5KRHBOVThSTXBFbzV0OHN3NVUyOEsiO3M6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiYWVkMDMyNjAtNjEwMy00NDQxLWI2MzItZGY3ODM5OWZkYzY5Ijt9', 1748224633),
('l212xjYLgFl3SyaFiiRF8LloQ6Gm7AaVuaOHSK63', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUZvdVJWUms4a3BFWmJnR043OXlONFpSS0xlVXZiZ1ZxejF2d0VzVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdXRoIjt9fQ==', 1748227867);

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
  `IS_DELETED` tinyint(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`USER_ID`, `USERNAME`, `DISPLAY_NAME`, `PASSWORD`, `ROLE`, `EMAIL`, `IMAGE`, `IS_DELETED`, `remember_token`) VALUES
('aed03260-6103-4441-b632-df78399fdc69', 'test', 'test', '$2y$12$iJIpn.AItdlzjxKwDwJwE.FJKB9VYTcbx4rBVOSPv6eFnOyV7K/xG', 'user', 'sultan@gmail.com', '', 0, NULL),
('bb97a8b7-9da0-4df7-b335-3b3ee31fd7e9', 'Team4PCD', 'Team4PCD', '$2y$12$CaiGZ/13tcwSbiKsfymklu824Pk5i.WK9n6r0EbcRq0ZD.3aFW0Pq', 'user', 'teampcd4@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocIsnUjQfpayNINDlAZ7cTaxdjIKW0qqENnDcESb3L0qfjM3UA=s96-c', 0, 'Dyn70j4EuDKgFmTNHS2tbUjTnEeadSN2KMHXMXO5byaey5iwI6Zyoa0l10hG'),
('fdd426fe-47de-4550-8442-228fb5b6a6ca', 'Sulthan Islami Zacky', 'Sulthan Islami Zacky', '$2y$12$56rv/.VhNItVQME/dVTiXOEhvDkIqSC37DAuSavAYmR3FGICZ6zua', 'user', 'xmipa733sulthanislamizacky@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocLKCFqyNu1pPuUtpwyE-F6-5_O8BuKsQD09oWKE43iX9KRRfA=s96-c', 0, 'YHWa5IVuGVLBzujEohOqxRuUr224RsiJiuHaCOt14DbChBtJvD7YfO0DHrQM'),
('USR00001', 'Ripat', 'ripatganteng', 'aduhai', 'user', 'mochamad@gmail.com', '', 0, NULL),
('USR00002', 'admin', 'iniAdminWo', '$2y$12$635bjVQ8P.OW4xgZrtJoluGhzCpYXgeP5izo13rXE6nK4SEyPQ0fK', 'admin', 'admin@gmail.com', '', 0, NULL);

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
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`CRITERIA_ID`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
