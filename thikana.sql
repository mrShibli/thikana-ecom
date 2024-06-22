-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 08:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thikana`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_23_135806_create_product_categors_table', 2),
(7, '2024_05_23_155743_create_product_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `image`, `background_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'my full name', 'this-is-a-comment', 'this is a comment', 'Meta Title', 'Meta Description', 'Meta Keywords', 'category_images/1716480005_664f68056afbe.jpg', 'category_background_images/1716480005_664f68056eec9.jpg', 'active', '2024-05-23 10:00:05', '2024-05-23 10:00:05'),
(2, 'Mahedi Hasan MA', 'test-sulug', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:34:55', '2024-05-23 10:34:55'),
(4, 'Mahedi Hasan MA', 'test-sulugweew', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:35:08', '2024-05-23 10:35:08'),
(5, 'Mahedi Hasan MA', 'test-sulugsdsdsd', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:35:48', '2024-05-23 10:35:48'),
(6, 'Mahedi Hasan MA', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:35:54', '2024-05-23 10:35:54'),
(7, 'asdasdsad', 'asdasdasd', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:35:58', '2024-05-23 10:35:58'),
(8, 'dfgdfgfdg', 'asdfdgdg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:04', '2024-05-23 10:36:04'),
(9, 'fdhdfga', 'fghfhs', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:09', '2024-05-23 10:36:09'),
(10, 'fhsdfas', 'fggfhfgh', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:14', '2024-05-23 10:36:14'),
(11, 'fgsfsd', 'dfhfghs', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:18', '2024-05-23 10:36:18'),
(12, 'fgsdfsdf', 'gfghs', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:23', '2024-05-23 10:36:23'),
(13, 'dhshdfh', 'hdfgsdg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:28', '2024-05-23 10:36:28'),
(14, 'fghh', 'fsdgda', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:34', '2024-05-23 10:36:34'),
(15, 'hfghgfhs', 'sdfgsghsd', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:39', '2024-05-23 10:36:39'),
(16, 'gjhgfhadgdsfsd', 'dsfsdfafsg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:45', '2024-05-23 10:36:45'),
(17, 'fgjfgjdf', 'asdasfghdfh', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:51', '2024-05-23 10:36:51'),
(18, 'fghfgha', 'gdfhgdfh', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2024-05-23 10:36:55', '2024-05-23 10:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Mahedi Hasan', 'mdmahedihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', '6ij2L5czIaTlSyVCAR2NVpciKqmZ0ElWLOoE3Fyy1GbKAml6BNm8dtRHYdYe', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(2, 'Md Mahedi Hasan', 'asan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(3, 'Md Mahedi', 'mahedihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(34, 'Md Mahedi Hasan', 'dfgedihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(35, 'EF Mahedi Hasan', 'trydihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(36, 'Md Mahedi Hasan', 'mdmahedihasan7942@gmail.com', NULL, '$2y$10$M1c1ZwmoPKahYOjjD84byeaV4CpYfY.UMmDOH4.3vHK3/uDPJSX1S', NULL, '2024-05-22 23:11:10', '2024-05-22 23:11:10'),
(37, 'mAHEDI', 'mdmahedihasan7932@gmail.com', NULL, '$2y$10$gPfzl2gFtz9RgvYVGow/uuXoYxnYeFsnSPucE3vle8y6ALVIYpKRe', NULL, '2024-05-23 10:34:15', '2024-05-23 10:34:15'),
(38, 'Alom Khan', 'mdmahedihasan792a@gmail.com', NULL, '$2y$10$gj.VhBSyCoTA1VJNSEXmPeJcreAdhwwLz.flQ5YrM.9l1.e7I5I4S', NULL, '2024-05-24 10:08:03', '2024-05-24 10:08:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
