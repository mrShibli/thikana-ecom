-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2024 at 08:48 PM
-- Server version: 8.0.37-0ubuntu0.24.04.1
-- PHP Version: 8.3.8

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qunt` int NOT NULL,
  `price` int NOT NULL,
  `option_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `qunt`, `price`, `option_id`, `created_at`, `updated_at`) VALUES
(1, 39, 6, 1, 279, 16, '2024-06-24 14:44:28', '2024-06-24 14:44:28');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_23_135806_create_product_categors_table', 2),
(7, '2024_05_23_155743_create_product_categories_table', 3),
(8, '2024_06_24_162554_create_products_table', 4),
(9, '2024_06_24_162600_create_variations_table', 4),
(10, '2024_06_24_162604_create_variation_options_table', 4),
(11, '2024_06_24_162608_create_product_variation_options_table', 4),
(12, '2024_06_24_203341_create_carts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_price` decimal(8,2) NOT NULL,
  `offer` decimal(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `quantity` int NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `thumb_image`, `images`, `tags`, `old_price`, `offer`, `status`, `quantity`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(6, 'Wyoming Campos', '<p>sdfsdfsd sgvksjdfhbvjsdfghvnekn bvbjdsjv ndhvn awjvbskfsjv bjdnv&nbsp;</p>', 'product/1719252442-pinterest.png', '[\"product/1719252442-esoesmio_logo_small_1.png\", \"product/1719252442-Capture d’écran 2024-06-18 à 8.53.42 AM.png\", \"product/1719252442-address-icon-round.png\", \"product/1719252442-mail-icon-round.png\"]', 'Totam rerum nulla ne', 453453.00, 3453.00, 1, 345, 1, 1, '2024-06-24 12:07:22', '2024-06-24 12:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
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
-- Table structure for table `product_variation_options`
--

CREATE TABLE `product_variation_options` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variation_option_id` bigint UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variation_options`
--

INSERT INTO `product_variation_options` (`id`, `product_id`, `variation_option_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 279.00, '2024-06-24 10:34:12', '2024-06-24 10:34:12'),
(2, 2, 2, 279.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(3, 2, 3, 455345.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(4, 2, 4, 345345.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(5, 3, 5, 279.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(6, 3, 6, 642.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(7, 3, 7, 803.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(8, 4, 8, 279.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(9, 4, 9, 642.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(10, 4, 10, 803.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(11, 5, 11, 332.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(12, 5, 12, 251.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(13, 5, 13, 803.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(14, 6, 14, 279.00, '2024-06-24 12:07:22', '2024-06-24 12:07:22'),
(15, 6, 15, 251.00, '2024-06-24 12:07:23', '2024-06-24 12:07:23'),
(16, 6, 16, 803.00, '2024-06-24 12:07:23', '2024-06-24 12:07:23');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Mahedi Hasan', 'mdmahedihasan792@gmail.com', NULL, '$2y$10$tABqsWovAjCehDIzXsYnzeayRWuzEmevCgofaVhZoLaSd4g9dr3P.', '6ij2L5czIaTlSyVCAR2NVpciKqmZ0ElWLOoE3Fyy1GbKAml6BNm8dtRHYdYe', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(2, 'Md Mahedi Hasan', 'asan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(3, 'Md Mahedi', 'mahedihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(34, 'Md Mahedi Hasan', 'dfgedihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(35, 'EF Mahedi Hasan', 'trydihasan792@gmail.com', NULL, '$2y$10$dFPs6As8W1tPSiyR/gTlruPCWDcfuimfQJExJtITzP8qlDMrFTDeG', 'qIf1KGxnN3jPz6ohQxMAa3gmflzUlZFW0gTHPQeWj2ct7ckYBDmAcmxWABYg', '2024-05-22 06:29:58', '2024-05-22 06:29:58'),
(36, 'Md Mahedi Hasan', 'mdmahedihasan7942@gmail.com', NULL, '$2y$10$M1c1ZwmoPKahYOjjD84byeaV4CpYfY.UMmDOH4.3vHK3/uDPJSX1S', NULL, '2024-05-22 23:11:10', '2024-05-22 23:11:10'),
(37, 'mAHEDI', 'mdmahedihasan7932@gmail.com', NULL, '$2y$10$gPfzl2gFtz9RgvYVGow/uuXoYxnYeFsnSPucE3vle8y6ALVIYpKRe', NULL, '2024-05-23 10:34:15', '2024-05-23 10:34:15'),
(38, 'Alom Khan', 'mdmahedihasan792a@gmail.com', NULL, '$2y$10$gj.VhBSyCoTA1VJNSEXmPeJcreAdhwwLz.flQ5YrM.9l1.e7I5I4S', NULL, '2024-05-24 10:08:03', '2024-05-24 10:08:03'),
(39, 'shibli raihan', 'shibli.raihan.bangli@gmail.com', NULL, '$2y$10$zBAxpeIMD0rt8cewyQP6d.AB1DazVlcP7MkeGlavsyb7SRhL2N.xK', NULL, '2024-06-24 14:26:28', '2024-06-24 14:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `product_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Harper Hansen', '2024-06-24 10:34:12', '2024-06-24 10:34:12'),
(2, 2, 'Harper Hansen', '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(3, 2, 'Nola Bullock', '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(4, 3, 'Harper Hansen', '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(5, 3, 'Nola Bullock', '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(6, 4, 'dgdfgdfg', '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(7, 4, 'Nola Bullock', '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(8, 5, 'Katell Morrow', '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(9, 5, 'Nola Bullock', '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(10, 6, 'Harper Hansen', '2024-06-24 12:07:22', '2024-06-24 12:07:22'),
(11, 6, 'Nola Bullock', '2024-06-24 12:07:23', '2024-06-24 12:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `variation_options`
--

CREATE TABLE `variation_options` (
  `id` bigint UNSIGNED NOT NULL,
  `variation_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variation_options`
--

INSERT INTO `variation_options` (`id`, `variation_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hedy Livingston', 279.00, '2024-06-24 10:34:12', '2024-06-24 10:34:12'),
(2, 2, 'Hedy Livingston', 279.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(3, 2, 'sdfsdfds', 455345.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(4, 2, 'sdfsdf', 345345.00, '2024-06-24 10:35:08', '2024-06-24 10:35:08'),
(5, 4, 'Hedy Livingston', 279.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(6, 4, 'Aimee Byers', 642.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(7, 5, 'Haley Pollard', 803.00, '2024-06-24 10:35:29', '2024-06-24 10:35:29'),
(8, 6, 'dfgdfgdf', 279.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(9, 6, 'Aimee Byers', 642.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(10, 7, 'Haley Pollard', 803.00, '2024-06-24 10:56:56', '2024-06-24 10:56:56'),
(11, 8, 'Flynn Zamora', 332.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(12, 8, 'Aimee Byers', 251.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(13, 9, 'Haley Pollard', 803.00, '2024-06-24 11:51:32', '2024-06-24 11:51:32'),
(14, 10, 'Hedy Livingston', 279.00, '2024-06-24 12:07:22', '2024-06-24 12:07:22'),
(15, 10, 'Aimee Byers', 251.00, '2024-06-24 12:07:22', '2024-06-24 12:07:22'),
(16, 11, 'Haley Pollard', 803.00, '2024-06-24 12:07:23', '2024-06-24 12:07:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

--
-- Indexes for table `product_variation_options`
--
ALTER TABLE `product_variation_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation_options`
--
ALTER TABLE `variation_options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_variation_options`
--
ALTER TABLE `product_variation_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `variation_options`
--
ALTER TABLE `variation_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
