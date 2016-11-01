-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2016 at 11:30 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatty`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `user_id`, `friend_id`, `accepted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, NULL),
(2, 2, 3, 1, NULL, NULL),
(4, 3, 4, 1, NULL, NULL),
(6, 1, 5, 1, NULL, NULL),
(7, 5, 2, 1, NULL, NULL),
(8, 4, 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `user_id`, `likeable_id`, `likeable_type`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 'Chatty\\Models\\Status', '2016-11-01 01:30:00', '2016-11-01 01:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_10_27_022211_create_user_table', 1),
(2, '2016_10_29_103336_create_friend_table', 2),
(4, '2016_10_30_052201_create_table_status', 3),
(8, '2016_10_31_072220_create_like_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `user_id`, `parent_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, 'Hi evryone', '2016-10-30 04:15:02', '2016-10-30 04:15:02'),
(2, 2, NULL, 'hi al apeople', '2016-10-30 20:03:10', '2016-10-30 20:03:10'),
(3, 2, NULL, 'Not fun', '2016-10-30 21:14:52', '2016-10-30 21:14:52'),
(4, 2, 3, 'Why not fun', '2016-10-30 21:21:38', '2016-10-30 21:21:38'),
(5, 2, 2, 'Not things', '2016-10-30 21:44:20', '2016-10-30 21:44:20'),
(6, 2, 3, 'Not things', '2016-10-30 21:44:53', '2016-10-30 21:44:53'),
(7, 2, 1, 'Hi all to day have fun', '2016-10-30 21:49:06', '2016-10-30 21:49:06'),
(8, 2, 1, ' Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus', '2016-10-30 21:49:31', '2016-10-30 21:49:31'),
(9, 3, NULL, 'Hi all i;m luongitbkap', '2016-10-30 23:52:39', '2016-10-30 23:52:39'),
(10, 1, NULL, 'Hi all my nam is luongit', '2016-10-30 23:57:42', '2016-10-30 23:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'luongit', 'luongitvnsoft@gmail.com', '$2y$10$hIyYeAqkXfbzF//ugGPDruFxZv8R9FcaZIx7gbbRh60MbRG2kycBO', 'Nguyen', 'Anh Luong', 'Duong Qua Ham - Ha Noi Viet Nam', 'S3txEPUeH1y8JkrCwFA4i4oSdZdHKvk1IDb6pwWAQCw8r0zNRZ8JpfN9Hcw0', '2016-10-26 23:54:56', '2016-11-01 03:23:58'),
(2, 'admin', 'luongbkap@gmail.com', '$2y$10$6Dp0KgF0wWYCI6wAsduxneBknuqbRcKsVZ3kxmHKrkA7NsOA.qqBq', NULL, NULL, 'Sai gon TP HCM Viet nam', '4JofGvQGPxil2OE6pmfFHQw1wQv3iqLAXaCy5aczPSvWfSmi3ts5ZK1ZvfI5', '2016-10-27 00:06:22', '2016-11-01 03:16:45'),
(3, 'luongbkap', 'luongta@gmail.com', '$2y$10$75WBvpgmizgoUdRMU07dPO.za92bLZ60s26LMMHwwzl10AqgXDs82', NULL, NULL, 'Hoi An Hue Viet Nam', 'NTDRGwuxrLqOmc8jXIHmEar4sol6yYXznugV3YyTKZrdlsRU6SAqXBdGS1Ld', '2016-10-28 03:58:17', '2016-10-30 23:53:09'),
(4, 'bend', 'bane@gmail.com', '$2y$10$kQN2O2KB67xALjEjaqFz/eCVTxh93fWFTUdat.6qK714kTwJ7N0aO', NULL, NULL, NULL, NULL, '2016-10-29 06:30:07', '2016-10-29 06:30:07'),
(5, 'hoanganh', 'hoanganh@gmail.com', '$2y$10$kQN2O2KB67xALjEjaqFz/eCVTxh93fWFTUdat.6qK714kTwJ7N0aO', NULL, NULL, NULL, '7XflnPCesPcrxmZDGkj6PIrtpF0TtUU2UQmbUg4tSDOHuDcDcdDf18ikWrAf', '2016-10-29 06:39:00', '2016-10-30 20:02:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
