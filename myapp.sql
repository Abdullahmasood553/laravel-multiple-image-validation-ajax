-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2020 at 04:29 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_instagram` int(11) DEFAULT NULL,
  `is_twitter` int(11) DEFAULT NULL,
  `is_facebook` int(11) DEFAULT NULL,
  `department` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `profile_pic`, `is_active`, `country`, `description`, `price`, `is_instagram`, `is_twitter`, `is_facebook`, `department`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abnation', 'Masood Ahmed', 'abdullahmasood554@gmail.com', 'img_avatar.png', 0, 'pakistan', 'Quick sample text to create the card title and make up the body of the card\'s\r\n                        content.', '50', NULL, 1, NULL, 'software', NULL, '$2y$10$1aKcBCH1ndBUKp.yAOdBg.ewsDsP6PfoB0zu7dGPnUi.ZUaxkvedK', 'oHWuUuasnDfiQBWbjsMruM0Ltj19Zb3EoiU9dqpzcENHzLfTWhTmHwAYS8l1', '2019-12-01 11:06:33', '2019-12-08 11:51:12'),
(9, 'Abdullah', 'Masood', 'abdullahmasood552@gmail.com', 'users/ab_w-499094034_1578507587.png', 0, 'paris', 'Quick sample text to create the card title and make up the body of the card\'s\r\n                        content.', '250', 1, 0, NULL, 'hardware', NULL, '$2y$10$5k4UelD0GPR/IC/93ipGV.r72Y845NQPLpntV1ck2oIWFhUg137T6', 'a4P4G3WTh2fUJX3LZdfuJHAPPX02NI4DouDVcAHJlWnR3HXHcjRG7Z5jt2oE', '2019-12-06 15:39:46', '2020-01-08 13:19:47'),
(10, 'adil', 'ahmed', 'asad@gmail.com', 'img_avatar.png', 0, 'pakistan ', 'Quick sample text to create the card title and make up the body of the card\'s\r\n                        content.', '10000', NULL, 1, NULL, 'electrical', NULL, '$2y$10$wyKks0ozOTlrcJ7FfzGfpe2AF5LGFQks7j7YnRA1fXs83puNqIUOy', NULL, NULL, NULL),
(11, 'amir', 'hassan', 'amir@gmail.com', 'img_avatar2.png', 0, 'paris', 'Quick sample text to create the card title and make up the body of the card\'s\r\n                        content.', '800', 1, 1, NULL, 'software', NULL, '$2y$10$wyKks0ozOTlrcJ7FfzGfpe2AF5LGFQks7j7YnRA1fXs83puNqIUOy', NULL, NULL, NULL),
(19, 'Abdullah', 'Masood', 'abdullah1.codingpixel@gmail.com', 'users/ab_w-1205955257_1578571285.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:25:30', '$2y$10$kC0cjRcgLd8G/met/kxGs.fky4m3SMp4eN5kWtb.3R3DCbrxeTRTC', NULL, '2020-01-09 06:24:28', '2020-01-09 09:32:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
