-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2023 at 12:18 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demoproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(32, 'role', 'role-create', 'web', '2023-10-03 03:28:46', '2023-10-03 03:28:46'),
(33, 'role', 'role-edit', 'web', '2023-10-03 03:28:57', '2023-10-03 03:28:57'),
(34, 'role', 'role-delete', 'web', '2023-10-03 03:29:08', '2023-10-03 03:29:08'),
(35, 'role', 'role-manage', 'web', '2023-10-03 03:30:37', '2023-10-03 03:30:37'),
(36, 'contact', 'contact-create', 'web', '2023-10-03 03:31:00', '2023-10-03 03:31:00'),
(37, 'contact', 'contact-edit', 'web', '2023-10-03 03:31:14', '2023-10-03 03:31:14'),
(38, 'contact', 'contact-delete', 'web', '2023-10-03 03:31:24', '2023-10-03 03:31:24'),
(39, 'contact', 'contact-manage', 'web', '2023-10-03 03:31:36', '2023-10-03 03:31:36'),
(40, 'support', 'support-create', 'web', '2023-10-03 03:33:14', '2023-10-03 03:33:14'),
(41, 'support', 'support-edit', 'web', '2023-10-03 03:33:26', '2023-10-03 03:33:26'),
(42, 'support', 'support-delete', 'web', '2023-10-03 03:33:37', '2023-10-03 03:33:37'),
(43, 'support', 'support-reply', 'web', '2023-10-03 03:34:00', '2023-10-03 03:34:00'),
(44, 'support', 'support-manage', 'web', '2023-10-03 03:48:52', '2023-10-03 03:48:52'),
(45, 'note', 'note-create', 'web', '2023-10-03 03:49:49', '2023-10-03 03:49:49'),
(46, 'note', 'note-edit', 'web', '2023-10-03 03:49:58', '2023-10-03 03:49:58'),
(47, 'note', 'note-delete', 'web', '2023-10-03 03:50:06', '2023-10-03 03:50:06'),
(48, 'note', 'note-manage', 'web', '2023-10-03 03:50:16', '2023-10-03 03:50:16'),
(49, 'manage', 'manage-account-settings', 'web', '2023-10-03 03:51:54', '2023-10-03 03:51:54'),
(50, 'manage', 'manage-company-settings', 'web', '2023-10-03 03:52:16', '2023-10-03 03:52:16'),
(51, 'manage', 'manage-general-settings', 'web', '2023-10-03 03:52:35', '2023-10-03 03:52:35'),
(52, 'manage', 'manage-password-settings', 'web', '2023-10-03 03:53:41', '2023-10-03 03:53:41'),
(53, 'reply', 'reply-support', 'web', '2023-10-03 03:54:26', '2023-10-03 03:54:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
