-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2016 at 05:46 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(10) UNSIGNED NOT NULL,
  `disease_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `position`, `menu_type`, `icon`, `name`, `title`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, 'User', 'User', NULL, NULL, NULL),
(2, NULL, 0, NULL, 'Role', 'Role', NULL, NULL, NULL),
(9, 0, 1, 'fa-database', 'Symptom', 'Symptom Info', NULL, '2016-07-14 01:17:47', '2016-07-14 01:17:47'),
(10, 0, 1, 'fa-database', 'Diseases', 'Diseases Info', NULL, '2016-07-14 02:24:41', '2016-07-14 02:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_id`, `role_id`) VALUES
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_27_100635_create_students_table', 1),
('2015_10_10_000000_create_menus_table', 2),
('2015_10_10_000000_create_roles_table', 2),
('2015_10_10_000000_update_users_table', 2),
('2015_12_11_000000_create_users_logs_table', 2),
('2016_03_14_000000_update_menus_table', 2),
('2016_07_14_054206_create_symptom_table', 3),
('2016_07_14_063009_create_symptom_table', 4),
('2016_07_14_064748_create_symptom_table', 5),
('2016_07_14_075442_create_diseases_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2016-07-14 00:01:16', '2016-07-14 00:01:16'),
(2, 'User', '2016-07-14 00:01:16', '2016-07-14 00:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE `symptom` (
  `id` int(10) UNSIGNED NOT NULL,
  `symptom_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symptom_description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `symptom`
--

INSERT INTO `symptom` (`id`, `symptom_name`, `symptom_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Back pain ssss', 'Back pain is pain felt in the back. Episodes of back pain may be acute, sub-acute, or chronic depending on the duration. The pain may be characterized as a dull ache, shooting or piercing pain, or a burning sensation. The pain may radiate into the arms and hands as well as the legs or feet, and may include paresthesia (tingling with no apparent cause),[1] weakness or numbness in the legs and arms. The anatomic classification of back pain follows the segments of the spine: neck pain (cervical), middle back pain (thoracic), lower back pain (lumbar) or coccydynia (tailbone or sacral pain) with the lumbar vertebrae area most common for pain.', 'Active', '2016-07-14 01:18:22', '2016-07-14 02:25:22', NULL),
(2, 'Abdominal pain', 'Abdominal pain, also known as stomach pain, is a common symptom associated with both temporary, non-serious disorders and more serious conditions.', 'Active', '2016-07-14 01:18:52', '2016-07-14 01:18:52', NULL),
(3, 'Chest pain', 'Chest pain may be a symptom of a number of serious disorders and is, in general, considered a medical emergency. Even though it may be determined that the pain is noncardiac in origin (does not come from a heart problem), this is often a diagnosis of exclusion made after ruling out more serious causes of the pain. Cardiac (heart-related) chest pain is called angina pectoris. Pain in the chest wall muscles is called by other names, such as pectoralgia, stethalgia, thoracalgia, and thoracodynia.', 'Active', '2016-07-14 01:19:15', '2016-07-14 01:19:15', NULL),
(4, 'Headache', 'Headache, also known as cephalalgia, is the symptom of pain anywhere in the region of the head or neck. It occurs in migraines, tension-type headaches, and cluster headaches.[1] Frequent headaches can affect relationships and employment.[1] There is also an increased risk of depression in those with severe headaches.', 'Active', '2016-07-14 01:19:42', '2016-07-14 01:19:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'asknuma', 'asknuma@yopmail.com', '$2y$10$Ea30AlZOiuwfjdotL0YiDOZlrztg3Ht1CUxeZKVF0.ck5REgP4OE6', 'wGguTvvzGKOlZXUsUkdNi15UBTseSjCFK1sr0uOzatCgcaujOtsHDylY0Lja', '2016-07-14 00:02:32', '2016-07-14 22:14:15'),
(2, 2, 'sudhir kumar', 'sudhir@yopmail.com', '$2y$10$8DLr1l6P.VZz0U96TwleEO6B4sU/pMnmVCxqRYreTS8MfVCnu0lwK', 'eJk1FPIoN3uJ4fRM9YKrp0kUrJhXys63VfExpgb9s54UoTkTlvtzUIu2IwrR', '2016-07-14 22:12:37', '2016-07-14 22:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `action`, `action_model`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'created', 'symptom', 1, '2016-07-14 00:13:45', '2016-07-14 00:13:45'),
(2, 1, 'created', 'symptom', 1, '2016-07-14 01:18:22', '2016-07-14 01:18:22'),
(3, 1, 'created', 'symptom', 2, '2016-07-14 01:18:52', '2016-07-14 01:18:52'),
(4, 1, 'created', 'symptom', 3, '2016-07-14 01:19:15', '2016-07-14 01:19:15'),
(5, 1, 'created', 'symptom', 4, '2016-07-14 01:19:42', '2016-07-14 01:19:42'),
(6, 1, 'updated', 'symptom', 1, '2016-07-14 02:25:22', '2016-07-14 02:25:22'),
(7, 1, 'updated', 'users', 1, '2016-07-14 03:19:21', '2016-07-14 03:19:21'),
(8, 1, 'created', 'users', 2, '2016-07-14 22:12:37', '2016-07-14 22:12:37'),
(9, 1, 'updated', 'users', 2, '2016-07-14 22:12:57', '2016-07-14 22:12:57'),
(10, 1, 'updated', 'users', 2, '2016-07-14 22:13:08', '2016-07-14 22:13:08'),
(11, 1, 'updated', 'users', 1, '2016-07-14 22:13:13', '2016-07-14 22:13:13'),
(12, 1, 'updated', 'users', 2, '2016-07-14 22:14:07', '2016-07-14 22:14:07'),
(13, 1, 'updated', 'users', 1, '2016-07-14 22:14:15', '2016-07-14 22:14:15'),
(14, 2, 'updated', 'users', 2, '2016-07-14 22:14:40', '2016-07-14 22:14:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD UNIQUE KEY `menu_role_menu_id_role_id_unique` (`menu_id`,`role_id`),
  ADD KEY `menu_role_menu_id_index` (`menu_id`),
  ADD KEY `menu_role_role_id_index` (`role_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
