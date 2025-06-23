-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 03:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_luthfi@gmail.com|127.0.0.1', 'i:3;', 1750667066),
('laravel_cache_luthfi@gmail.com|127.0.0.1:timer', 'i:1750667066;', 1750667066);

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Lumbir', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(2, 'Wangon', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(3, 'Jatilawang', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(4, 'Rawalo', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(5, 'Kebasen', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(6, 'Kemranjen', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(7, 'Sumpiuh', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(8, 'Tambak', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(9, 'Somagede', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(10, 'Kalibagor', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(11, 'Banyumas', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(12, 'Patikraja', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(13, 'Purwojati', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(14, 'Ajibarang', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(15, 'Gumelar', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(16, 'Pekuncen', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(17, 'Cilongok', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(18, 'Karanglewas', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(19, 'Kedungbanteng', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(20, 'Baturraden', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(21, 'Sumbang', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(22, 'Kembaran', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(23, 'Sokaraja', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(24, 'Purwokerto Selatan', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(25, 'Purwokerto Barat', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(26, 'Purwokerto Timur', '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(27, 'Purwokerto Utara', '2025-06-21 20:43:05', '2025-06-21 20:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `nama`, `kecamatan_id`, `created_at`, `updated_at`) VALUES
(1, 'Ajibarang Kulon', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(2, 'Ajibarang Wetan', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(3, 'Banjarsari', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(4, 'Ciberung', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(5, 'Darmakradenan', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(6, 'Jingkang', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(7, 'Kalibenda', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(8, 'Karangbawang', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(9, 'Kracak', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(10, 'Lesmana', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(11, 'Pancasan', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(12, 'Pancurendang', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(13, 'Pandansari', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(14, 'Sawangan', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(15, 'Tipar Kidul', 14, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(16, 'Binangun', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(17, 'Danaraja', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(18, 'Dawuhan', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(19, 'Kalisube', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(20, 'Karangrau', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(21, 'Kedunggede', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(22, 'Kedunguter', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(23, 'Kejawar', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(24, 'Papringan', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(25, 'Pasinggangan', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(26, 'Pekunden', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(27, 'Sudagaran', 11, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(28, 'Karang Tengah', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(29, 'Karangmangu', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(30, 'Karangsalam Lor', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(31, 'Kebumen', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(32, 'Kemutug Kidul', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(33, 'Kemutug Lor', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(34, 'Ketenger', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(35, 'Kutasari', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(36, 'Pamijen', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(37, 'Pandak', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(38, 'Purwosari', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(39, 'Rempoah', 20, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(40, 'Batuanten', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(41, 'Cikidang', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(42, 'Cilongok', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(43, 'Cipete', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(44, 'Gununglurah', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(45, 'Jatisaba', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(46, 'Kalisari', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(47, 'Karanglo', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(48, 'Karangtengah', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(49, 'Kasegeran', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(50, 'Langgongsari', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(51, 'Pageraji', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(52, 'Panembangan', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(53, 'Panusupan', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(54, 'Pejogol', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(55, 'Pernasidi', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(56, 'Rancamaya', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(57, 'Sambirata', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(58, 'Sokawera', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(59, 'Sudimara', 17, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(60, 'Cihonje', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(61, 'Cilangkap', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(62, 'Gancang', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(63, 'Gumelar', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(64, 'Karangkemojing', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(65, 'Kedungurang', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(66, 'Paningkaban', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(67, 'Samudra', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(68, 'Samudra Kulon', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(69, 'Tlaga', 15, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(70, 'Kalibagor', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(71, 'Kalicupak Kidul', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(72, 'Kalicupak Lor', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(73, 'Kaliori', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(74, 'Kalisogra Wetan', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(75, 'Karangdadap', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(76, 'Pajerukan', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(77, 'Pekaja', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(78, 'Petir', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(79, 'Srowot', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(80, 'Suro', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(81, 'Wlahar Wetan', 10, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(82, 'Babakan', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(83, 'Jipang', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(84, 'Karanggude Kulon', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(85, 'Karangkemiri', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(86, 'Karanglewas Kidul', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(87, 'Kediri', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(88, 'Pangebatan', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(89, 'Pasir Kulon', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(90, 'Pasir Lor', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(91, 'Pasir Wetan', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(92, 'Singasari', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(93, 'Sunyalangu', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(94, 'Tamansari', 18, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(95, 'Adisana', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(96, 'Bangsa', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(97, 'Cindaga', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(98, 'Gambarsari', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(99, 'Kalisalak', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(100, 'Kaliwedi', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(101, 'Karangsari', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(102, 'Kebasen', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(103, 'Mandirancan', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(104, 'Randegan', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(105, 'Sawangan', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(106, 'Tumiyang', 5, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(107, 'Baseh', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(108, 'Beji', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(109, 'Dawuhan Kulon', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(110, 'Dawuhan Wetan', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(111, 'Kalikesur', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(112, 'Kalisalak', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(113, 'Karangnangka', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(114, 'Karangsalam Kidul', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(115, 'Kebocoran', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(116, 'Kedung Banteng', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(117, 'Keniten', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(118, 'Kutaliman', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(119, 'Melung', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(120, 'Windujaya', 19, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(121, 'Bantarwuni', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(122, 'Bojongsari', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(123, 'Dukuhwaluh', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(124, 'Karangsari', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(125, 'Karangsoka', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(126, 'Karangtengah', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(127, 'Kembaran', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(128, 'Kramat', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(129, 'Ledug', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(130, 'Linggasari', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(131, 'Pliken', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(132, 'Purbadana', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(133, 'Purwodadi', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(134, 'Sambeng Kulon', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(135, 'Sambeng Wetan', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(136, 'Tambaksari Kidul', 22, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(137, 'Alasmalang', 6, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(138, 'Grujugan', 6, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(139, 'Karanggintung', 6, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(140, 'Karangjati', 6, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(141, 'Karangsalam', 6, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(142, 'Adisara', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(143, 'Bantar', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(144, 'Gentawangi', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(145, 'Gunung Wetan', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(146, 'Karanganyar', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(147, 'Karanglewas', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(148, 'Kedungwringin', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(149, 'Margasana', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(150, 'Pekuncen', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(151, 'Tinggarjaya', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(152, 'Tunjung', 3, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(153, 'Besuki', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(154, 'Canduk', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(155, 'Cidora', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(156, 'Cingebul', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(157, 'Cirahab', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(158, 'Dermaji', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(159, 'Karanggayam', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(160, 'Kedunggede', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(161, 'Lumbir', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(162, 'Parungkamal', 1, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(163, 'Karanganyar', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(164, 'Karangendep', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(165, 'Kedungrandu', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(166, 'Kedungwringin', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(167, 'Kedungwuluh Kidul', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(168, 'Kedungwuluh Lor', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(169, 'Notog', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(170, 'Patikraja', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(171, 'Pegalongan', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(172, 'Sawangan Wetan', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(173, 'Sidabowa', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(174, 'Sokawera Kidul', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(175, 'Wlahar Kulon', 12, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(176, 'Banjaranyar', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(177, 'Candinegara', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(178, 'Cibangkong', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(179, 'Cikawung', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(180, 'Cikembulan', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(181, 'Glempang', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(182, 'Karangkemiri', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(183, 'Karangklesem', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(184, 'Krajan', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(185, 'Kranggan', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(186, 'Pasiraman Kidul', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(187, 'Pasiraman Lor', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(188, 'Pekuncen', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(189, 'Petahunan', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(190, 'Semedo', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(191, 'Tumiyang', 16, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(192, 'Gerduren', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(193, 'Kaliputih', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(194, 'Kalitapen', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(195, 'Kaliurip', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(196, 'Kaliwangi', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(197, 'Karangmangu', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(198, 'Karangtalun Kidul', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(199, 'Karangtalun Lor', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(200, 'Klapasawit', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(201, 'Purwojati', 13, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(202, 'Bantarsoka', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(203, 'Karanglewas Lor', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(204, 'Kedungwuluh', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(205, 'Kober', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(206, 'Pasir Kidul', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(207, 'Pasirmuncang', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(208, 'Rejasari', 25, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(209, 'Berkoh', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(210, 'Karangklesem', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(211, 'Karangpucung', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(212, 'Purwokerto Kidul', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(213, 'Purwokerto Kulon', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(214, 'Tanjung', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(215, 'Teluk', 24, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(216, 'Arcawinangun', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(217, 'Kranji', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(218, 'Mersi', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(219, 'Purwokerto Lor', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(220, 'Purwokerto Wetan', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(221, 'Sokanegara', 26, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(222, 'Bancarkembar', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(223, 'Bobosan', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(224, 'Grendeng', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(225, 'Karangwangkal', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(226, 'Pabuaran', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(227, 'Purwanegara', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(228, 'Sumampir', 27, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(229, 'Banjarparakan', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(230, 'Losari', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(231, 'Menganti', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(232, 'Pesawahan', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(233, 'Rawalo', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(234, 'Sanggreman', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(235, 'Sidamulih', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(236, 'Tambaknegara', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(237, 'Tipar', 4, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(238, 'Banjaranyar', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(239, 'Banjarsari Kidul', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(240, 'Jompo Kulon', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(241, 'Kalikidang', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(242, 'Karangduren', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(243, 'Karangkedawung', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(244, 'Karangnanas', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(245, 'Karangrau', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(246, 'Kedondong', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(247, 'Klahang', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(248, 'Lemberang', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(249, 'Pamijen', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(250, 'Sokaraja Kidul', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(251, 'Sokaraja Kulon', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(252, 'Sokaraja Lor', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(253, 'Sokaraja Tengah', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(254, 'Sokaraja Wetan', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(255, 'Wiradadi', 23, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(256, 'Kanding', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(257, 'Kemawi', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(258, 'Klinting', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(259, 'Piasa Kulon', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(260, 'Plana', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(261, 'Sokawera', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(262, 'Somagede', 9, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(263, 'Banjarsari Kulon', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(264, 'Banjarsari Wetan', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(265, 'Banteran', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(266, 'Ciberem', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(267, 'Datar', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(268, 'Gandatapa', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(269, 'Karangcegak', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(270, 'Karanggintung', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(271, 'Karangturi', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(272, 'Kawungcarang', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(273, 'Kebanggan', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(274, 'Kedungmalang', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(275, 'Kotayasa', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(276, 'Limpakuwus', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(277, 'Sikapat', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(278, 'Silado', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(279, 'Sumbang', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(280, 'Susukan', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(281, 'Tambaksogra', 21, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(282, 'Banjarpanepen', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(283, 'Bogangin', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(284, 'Karanggedang', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(285, 'Kemiri', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(286, 'Ketanda', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(287, 'Kuntili', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(288, 'Lebeng', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(289, 'Nusadadi', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(290, 'Pandak', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(291, 'Selandaka', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(292, 'Selanegara', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(293, 'Kebokura', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(294, 'Kradenan', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(295, 'Sumpiuh', 7, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(296, 'Karangpetir', 8, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(297, 'Karangpucung', 8, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(298, 'Kamulyan', 8, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(299, 'Banteran', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(300, 'Cikakak', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(301, 'Jambu', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(302, 'Jurangbahas', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(303, 'Klapagading', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(304, 'Klapagading Kulon', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(305, 'Pangadegan', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05'),
(306, 'Wangon', 2, '2025-06-21 20:43:05', '2025-06-21 20:43:05');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_21_104706_add_role_to_users_table', 1),
(5, '2025_06_21_114246_create_pendaftaran_pelanggans_table', 1),
(6, '2025_06_21_115314_create_kecamatans_table', 1),
(7, '2025_06_21_115323_create_kelurahans_table', 1),
(8, '2025_06_21_125739_remove_kecamatan_column_from_pendaftaran_pelanggans_table', 1),
(9, '2025_06_21_125955_remove_kecamatan_and_kelurahan_columns_from_pendaftaran_pelanggans_table', 1),
(10, '2025_06_21_132822_create_pembayarans_table', 1),
(11, '2025_06_21_143810_modify_bukti_transfer_nullable', 1),
(12, '2025_06_21_151132_remove_bukti_transfer_from_pembayarans_table', 1),
(13, '2025_06_21_153355_add_order_id_to_pembayarans_table', 1),
(14, '2025_06_22_031557_add_payment_type_to_pembayarans_table', 1),
(16, '2025_06_22_032518_recreate_pembayarans_table', 2),
(17, '2025_06_22_062806_add_midtrans_transaction_status_raw_to_pembayarans_table', 3),
(18, '2025_06_22_130235_add_midtrans_raw_status_to_pembayarans_table', 4),
(19, '2025_06_23_012723_add_location_ids_to_pendaftaran_pelanggans_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pendaftaran_pelanggan_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'midtrans',
  `nominal` bigint NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_amount` decimal(10,2) DEFAULT NULL,
  `midtrans_transaction_status_raw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `user_id`, `pendaftaran_pelanggan_id`, `token`, `order_id`, `metode_pembayaran`, `nominal`, `bukti_transfer`, `status`, `payment_type`, `gross_amount`, `midtrans_transaction_status_raw`, `created_at`, `updated_at`) VALUES
(57, 4, 53, '32d4fafd-620c-4ef8-80e2-ab0e6df9f2c1', 'PDAM-PBHLDPTQ3T', 'midtrans', 150000, NULL, 'diterima', 'bank_transfer', 150000.00, 'settlement', '2025-06-23 07:57:35', '2025-06-23 07:59:37'),
(58, 4, 54, 'ba44292e-1a0e-442f-b988-bfc6cf610464', 'PDAM-FSCH2H5UR2', 'midtrans', 150000, NULL, 'ditolak', 'bank_transfer', 150000.00, 'settlement', '2025-06-23 08:01:18', '2025-06-23 08:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_pelanggans`
--

CREATE TABLE `pendaftaran_pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `foto_rumah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `kelurahan_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran_pelanggans`
--

INSERT INTO `pendaftaran_pelanggans` (`id`, `user_id`, `nama_lengkap`, `pekerjaan`, `latitude`, `longitude`, `foto_rumah`, `foto_ktp`, `created_at`, `updated_at`, `kecamatan_id`, `kelurahan_id`) VALUES
(53, 4, 'Mikasa Ackerman', 'Tentara', -7.475666, 109.299631, 'uploads/rumah/c7tNhZNkRz42k7CH0GLAOphEaSNbD0gPyVvCyCTr.jpg', 'uploads/ktp/kKUk9D4QjvK7A3zoCjqXZ9PG7z9Vh6avBLzce6AA.jpg', '2025-06-23 07:57:35', '2025-06-23 07:57:35', 10, 77),
(54, 4, 'Mikasa Ackerman', 'Tentara', -7.374405, 109.152120, 'uploads/rumah/TO3BB61sl7EINT4ay0x8bsqXhGf8nxFOCgEBw486.jpg', 'uploads/ktp/wLkLQkxMKUV2ExX8WubfGWJYvw4kCTsZSO1qg5F7.jpg', '2025-06-23 08:01:18', '2025-06-23 08:01:18', 19, 116);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1jXCqB0H0i6mvZr9RVk1o8vTZsdExP7LNwl8zIQ4', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoianpHTzNvbWtMdXRQTjZGM0ZQNmtOOEdYbEFqNU9tQ2Z3RHB2WDJFWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638752),
('1yGSVVhZJzQuzqzpU3pObxUusvygi4pe4IhrwxRH', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSWt6cDNkaHc0YTh5R3c2OFNHNTJiVHpJdGtvcTJ2UmRLUWl6WlU1bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750691007),
('78XEzPtxtdge6I1teEjLFs1xfp8XRhIJXkYsN0yf', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieGhRUVBTT3J3U1JaUXF4T2lWbkRET1dldlFNVzd6cUF4eWRrZlFkdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638594),
('aYWFUFR8PnUiNNhKIuWdtL1yRstKDUJfEsNymiFG', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1ZWMDd4bmIyOVJaZ25jN2RoQUZxZmtoNmk4c3lDdWpzaXgwQ2tCZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1750691394),
('BXnluyvsDOwcxQxcsBOCrgyg8lE6vw4sOge4wDXR', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicm5IQ0RzWTF4TGI3TUVmcTFpQzJZb1M0WnhIWk1Ic3RaVU05U3JFYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750690677),
('EB1oMuaoblKsnra4DBBLlkkKn12C8DyHDzbKhuJr', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUjRoTElkajluMG9hNnZEdVNaY3V4dUExa3NFbmlyUE9IU0ZqR0ZORSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750690690),
('EzYIpTZQzidLN3iVL4MLaybIoGU5RcVjZ3acMGlB', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYWx3QkRFYnpROWRCbnhLek5mYXoyT29oQmMwdkNVU2ZyZ0xtSHNWeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638244),
('FdxcobLBy51zTDqZ51NNJ4d1QOZGfSbPoFwuHum7', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiY0VLSHJHNEJuV0JQdjVHRWdPWmNtTTRvUHlUTlZWRkI4Qm1rR3dicyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750642878),
('fFDr5HycG3XNBIyc1Mp7YUo6DAOIWeY8Q3c4YR4h', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUUZrUWRiblE3aGdCSGJ6bG5rTml2SlFVN1FJZmdaa2xxWXFXam90ayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750690973),
('FXIdejjfsDohZrXY8J3iSHWMLygLl1KedgcoTk6R', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVzdlQnlJbW1Td0tEY0doTjU4elgwbXdDVEZPTUx0V2VBdTYxSUFtSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750642850),
('GfEiEHD14ivLrcTE5j2QlWZXsyJEFtuC9TVsiSTl', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTXNNMjlLb2RrbVVsYUtxUm5EbDNhRE9UODJyVFpnVWk4Q3dkYjJ2OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638436),
('hAruHLnD5dA6jpqsVtlu2uAAkyh8lHe32ecViKKp', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQ0RqNlRES083YnB6VnJPR0VSSE1yU2o4SHNPSTRkN2U5eGVBQlh5ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750691351),
('HSuO8cFQHJbJz6uygDmzo6YKUB8WifW5NVQjK88L', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQUREYkdsNmRPd1RJQ1BFSlNINXRPMzNDeHJBVllkU0xjZWlPV1YzWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750642729),
('MDB3IT9gRcPJPmNvbLgaiBBVzlhBEWHJgrWf8LU1', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQlgyNHdkT1c3eHA1dWRUbkljdFBkT20wM09MZXN6NjNmZXRTTnc2YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1750691554),
('MEHi5fk7PL8ZOcH7vS1KijdsBbbQ9TZKDCc2A06Y', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibGowemlibWU1eWo5eTk2cXZoTGlmY2ZRZVlodmlrbTI4ZU1uOFcwNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638604),
('mfnGe6PYw4Lg8TbrpKXgy9Qwbkc0Xw0ctqgfrRue', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibjI1M2k3R0puWE91VGdzcDRJcnk4eVUxd3NnNFRzcW9TUGhmcDBqSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750642887),
('n0NP8lfrUMXk8K5XvBVph4xU4xL5Vvj93L3Yutmm', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS2Fwd3VoYmNQOXdLTllXSWthazN1SnRIV2t5T2Nrdzh0VUFGSXRmVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750642738),
('QNJwmOS42TiEyqO0a8SrLTahjoTcZdyEuuydApR1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVhGZlR2dER4c0VieUtTazlBMUo3d09vNnZKVWY2bXRORjdacDQxRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1750644203),
('QxniIRiW9JYLV4Yy72dlAlhfRiDnCd6bYQ4xZBKa', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidzVNbXQ1Z0U5aWp1R3FsQ0tyb0VVRDhOaHBWQmsyd2E4WUVPVG1kTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638545),
('sM8RX9aXxWqhByhdl13dDWZKln0OVHeML125q2aA', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaFdXQXVWTUVXZHJ6ZkhFUUZMQm5WbHNKUGFKc1FUNVJPRVpIQjNrRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638534),
('tmj3VQWH0gZi95ob5RmS4Ku8DOBLZ4bl7DR2GKVo', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicTlQZVkzZk1iSjl0VVhLTDF1T0djR09GYXcyRUlTQldCRDN2bmVSQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750691339),
('vhSlsmvsxQyXyUIg1nvKekBuQRD46a7BMy3rsgRV', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidktVb0RPMHdiYkxMU0ZYYzZoNFR0UUhFR2JPdkR0RmJjZktoZFJnViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638227),
('VIe8THJe8SUh1F71HQUs5p7FCrM68xlyMHCIxiDm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDFNWTh2dDQySW1HM0JZbnU4aHB4UE1nYVVjaXJqbEZQUnhZN3JvdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1750644195),
('W4WkZpDJ9IbBClv9uaLf7mDMA0QgZqrFgRQQSfR1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlhtTlFWRWFPdThqeG5zMG5CR2YxWGw4bzkyYTUyY2ZzSGZOaGc5RyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1750667756),
('XgBFiLFUhdiWj66cMltfksYazcpSt4mkEyHdirkQ', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibjZrN090Zk1DYkN5UXBoM040cTFuMUVMcUtFSE50SWZybEhwSWlFVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750638760),
('yCcfhED27q2Cn7oLby8m13IP573TVVl7fl8Qh76o', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicWJZQ2FobG92SFBEVnZLVGxEMWlYSDFwN1pZN2VoVml5dVg1QnlFbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750690933);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(3, 'Super Admin', 'admin@admin.co', NULL, '$2y$12$40DsoYFybyBc8UpHxPv.4OaTSHZys.LNKvjFNUE1EqdNaglertgyu', NULL, '2025-06-21 20:48:12', '2025-06-21 20:48:12', 'admin'),
(4, 'Mikasa Ackerman', 'mikasa@aot.com', NULL, '$2y$12$aDjgtSP0xq3vIxnrDIf6OuArDD.mLBUxEs19QNdL91KQOnmJKqb2u', NULL, '2025-06-23 01:24:19', '2025-06-23 01:24:19', 'user');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahans_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayarans_order_id_unique` (`order_id`),
  ADD KEY `pembayarans_user_id_foreign` (`user_id`),
  ADD KEY `pembayarans_pendaftaran_pelanggan_id_foreign` (`pendaftaran_pelanggan_id`);

--
-- Indexes for table `pendaftaran_pelanggans`
--
ALTER TABLE `pendaftaran_pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_pelanggans_user_id_foreign` (`user_id`),
  ADD KEY `pendaftaran_pelanggans_kecamatan_id_foreign` (`kecamatan_id`),
  ADD KEY `pendaftaran_pelanggans_kelurahan_id_foreign` (`kelurahan_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pendaftaran_pelanggans`
--
ALTER TABLE `pendaftaran_pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD CONSTRAINT `kelurahans_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_pendaftaran_pelanggan_id_foreign` FOREIGN KEY (`pendaftaran_pelanggan_id`) REFERENCES `pendaftaran_pelanggans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran_pelanggans`
--
ALTER TABLE `pendaftaran_pelanggans`
  ADD CONSTRAINT `pendaftaran_pelanggans_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pendaftaran_pelanggans_kelurahan_id_foreign` FOREIGN KEY (`kelurahan_id`) REFERENCES `kelurahans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pendaftaran_pelanggans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
