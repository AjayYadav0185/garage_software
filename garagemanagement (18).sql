-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2026 at 12:39 PM
-- Server version: 8.4.7
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garagemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_mechanics`
--

DROP TABLE IF EXISTS `all_mechanics`;
CREATE TABLE IF NOT EXISTS `all_mechanics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `m_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_mob` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_add` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_mechanics`
--

INSERT INTO `all_mechanics` (`id`, `g_id`, `m_name`, `m_mob`, `m_email`, `m_add`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rahul Sharma', '9876543210', 'rahul@example.com', '123, Main Street, Delhi', 'password123', 1, '2025-11-29 11:36:48', '2025-11-29 11:36:48'),
(2, 1, 'Amit Kumar', '9123456780', 'amit@example.com', '45, Park Avenue, Mumbai', 'password123', 1, '2025-11-29 11:36:48', '2025-11-29 11:36:48'),
(3, 1, 'Sonal Verma', '9988776655', 'sonal@example.com', '89, Lake Road, Bangalore', 'password123', 1, '2025-11-29 11:36:48', '2025-11-29 11:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `all_vehicle`
--

DROP TABLE IF EXISTS `all_vehicle`;
CREATE TABLE IF NOT EXISTS `all_vehicle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `c_id` int NOT NULL,
  `mechanic_id` int DEFAULT NULL,
  `v_id` int NOT NULL,
  `messageid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_plate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carbrand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carmodel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fueltype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chassis_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmission` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `braking` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_service_date` date DEFAULT NULL,
  `service_interval_days` int DEFAULT NULL,
  `service_interval_km` int DEFAULT NULL,
  `next_service_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_vehicle_mechanic` (`mechanic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_vehicle`
--

INSERT INTO `all_vehicle` (`id`, `g_id`, `c_id`, `mechanic_id`, `v_id`, `messageid`, `number_plate`, `name`, `contact`, `registration`, `carbrand`, `carmodel`, `fueltype`, `chassis_no`, `engine_no`, `transmission`, `braking`, `last_service_date`, `service_interval_days`, `service_interval_km`, `next_service_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 101, 2, 1, NULL, 'HR98E3526', NULL, NULL, 'HR98E3526', 'Toyota', 'Camry', 'Diesel', '343434', '878222', 'Manual', NULL, '2025-12-10', 365, NULL, '2026-12-10', 1, '2025-12-01 10:12:51', '2025-12-10 06:53:20'),
(3, 1, 101, 3, 1, NULL, 'HR98E3521', NULL, NULL, NULL, 'Honda', 'Civic', 'Petrol', '234578', '5678', 'Auto', NULL, '2025-11-30', 1221, 6272, NULL, 1, '2025-12-02 06:40:28', '2025-12-10 11:59:16'),
(4, 1, 105, 2, 1, NULL, 'HR98E3529', NULL, NULL, NULL, 'BMW', 'X5', 'Petrol', '456789', '2345678', 'Auto', NULL, '2025-11-03', 365, 6272, '2026-02-01', 1, '2025-12-02 06:40:56', '2025-12-10 06:42:27'),
(5, 1, 101, 1, 1, NULL, 'HR98E3578', NULL, NULL, NULL, 'Toyota', 'Camry', 'Petrol', '764', '43', 'Auto', NULL, '2025-10-27', 365, NULL, '2026-10-27', 1, '2025-12-03 10:07:54', '2025-12-10 06:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `auth_accounts`
--

DROP TABLE IF EXISTS `auth_accounts`;
CREATE TABLE IF NOT EXISTS `auth_accounts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('admin','employee') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_accounts_type_ref_id_index` (`type`,`ref_id`),
  KEY `auth_accounts_country_id_index` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_accounts`
--

INSERT INTO `auth_accounts` (`id`, `type`, `ref_id`, `name`, `login_type`, `email`, `password`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'Ajay Yadav', 'admin', 'ajayretro1@gmail.com', '$2y$10$JVNRas5d1A8lGVEdvQFkUeYf72EaQugopjCzTFx3QZJGOf8XiNe9i', 2, '2025-12-27 00:42:44', '2025-12-27 00:42:44'),
(2, 'employee', 5, 'Super Adm1in', 'employee', 'ajayretro1@gmail.com', '$2y$10$JVNRas5d1A8lGVEdvQFkUeYf72EaQugopjCzTFx3QZJGOf8XiNe9i', NULL, '2025-12-27 01:22:41', '2025-12-27 01:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `call_login`
--

DROP TABLE IF EXISTS `call_login`;
CREATE TABLE IF NOT EXISTS `call_login` (
  `g_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `g_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `g_gst` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'N/A',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `g_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `g_mob` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qrcode` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stamp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `g_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trial_end_date` date DEFAULT NULL,
  `permission_status_user_man` tinyint(1) DEFAULT '0',
  `permission_status_gst` tinyint(1) DEFAULT '0',
  `role_id` int DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`g_id`),
  KEY `fk_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_login`
--

INSERT INTO `call_login` (`g_id`, `username`, `name`, `g_name`, `g_gst`, `email`, `g_email`, `g_mob`, `img`, `qrcode`, `stamp`, `sign`, `state`, `city`, `g_address`, `password`, `remember_token`, `created_at`, `trial_end_date`, `permission_status_user_man`, `permission_status_gst`, `role_id`, `country_id`) VALUES
(1, 'Ajay Yadav', NULL, 'Ajay Yadav', 'N/A', 'ajayretro1@gmail.com', 'ajayretro1@gmail.com', '8802929885', 'images/LCasQfiRyHlnupDsbO8Qw8WZxub0s9pH1SaurVPX.png', 'images/LCasQfiRyHlnupDsbO8Qw8WZxub0s9pH1SaurVPX.png', 'images/LCasQfiRyHlnupDsbO8Qw8WZxub0s9pH1SaurVPX.png', 'images/LCasQfiRyHlnupDsbO8Qw8WZxub0s9pH1SaurVPX.png', 'Haryana', 'Gurgaon', 'H.No 148 Shivji Park Sector 10A Gurgaon Haryana', '$2y$10$JVNRas5d1A8lGVEdvQFkUeYf72EaQugopjCzTFx3QZJGOf8XiNe9i', '7E4tt9NCqYqKIvskCVYXiHGHPhxPYyiQt0MKKRaLNi9C8U3bUGrllXY0F3qt', '2025-12-06 01:27:35', '2025-12-13', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_makers`
--

DROP TABLE IF EXISTS `car_makers`;
CREATE TABLE IF NOT EXISTS `car_makers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `checkin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_makers_country_id_foreign` (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_makers`
--

INSERT INTO `car_makers` (`id`, `name`, `country_id`, `checkin`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 3, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(2, 'Honda', 3, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(3, 'BMW', 2, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(4, 'Mercedes', 2, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(5, 'Ford', 1, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(6, 'Chevrolet', 1, 1, '2025-11-27 02:14:47', '2025-11-27 02:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

DROP TABLE IF EXISTS `car_models`;
CREATE TABLE IF NOT EXISTS `car_models` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `maker_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_models_maker_id_foreign` (`maker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_models`
--

INSERT INTO `car_models` (`id`, `maker_id`, `name`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'Corolla', 2023, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(2, 1, 'Camry', 2022, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(3, 2, 'Civic', 2023, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(4, 2, 'Accord', 2022, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(5, 3, 'X5', 2023, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(6, 4, 'C-Class', 2022, '2025-11-27 02:14:47', '2025-11-27 02:14:47'),
(7, 5, 'F-150', 2023, '2025-11-27 02:14:47', '2025-11-27 02:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Active',
  `language` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`, `code`, `currency`, `status`, `language`) VALUES
(1, 'India', '2025-12-27 09:23:03', '2025-12-27 09:23:03', 'IN', '{{currency()}}', 'Active', 'en'),
(2, 'UAE', '2025-12-27 09:23:03', '2025-12-27 09:23:03', 'AE', 'AED', 'Active', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `c_id` int NOT NULL,
  `cus_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_mob` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_gst` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_add` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `g_id`, `c_id`, `cus_name`, `cus_mob`, `cus_email`, `c_gst`, `c_add`, `created_at`, `updated_at`) VALUES
(1, 1, 101, 'Rahul Sharma', '9876543210', 'rahul@example.com', 'GST12345', 'Mumbai, Maharashtra', '2025-11-29 11:01:41', '2025-11-29 11:01:41'),
(2, 1, 102, 'Amit Verma', '9988776655', 'amit@example.com', 'GST99887', 'Pune, Maharashtra', '2025-11-29 11:01:41', '2025-11-29 11:01:41'),
(3, 1, 103, 'Neha Singh', '7896541230', 'neha@example.com', 'GST44556', 'Nashik, Maharashtra', '2025-11-29 11:01:41', '2025-11-29 11:01:41'),
(4, 1, 104, 'Vijay Patel', '9123456780', 'vijay@example.com', 'GST88001', 'Ahmedabad, Gujarat', '2025-11-29 11:01:41', '2025-11-29 11:01:41'),
(5, 1, 105, 'rohhit', '8728278287', 'ajayretro1@gmail.com', '1235678', 'gurgaon', '2025-12-02 12:08:52', '2025-12-02 12:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

DROP TABLE IF EXISTS `fuel_types`;
CREATE TABLE IF NOT EXISTS `fuel_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `carFuel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `carFuel`, `code`, `description`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Petrol', 'PET', NULL, 1, NULL, '2025-11-27 03:57:28', '2025-11-27 03:57:28'),
(2, 'Diesel', 'DSL', NULL, 1, NULL, '2025-11-27 03:57:28', '2025-11-27 03:57:28'),
(3, 'Electric', 'ELEC', NULL, 1, NULL, '2025-11-27 03:57:28', '2025-11-27 03:57:28'),
(4, 'Hybrid', 'HYB', NULL, 1, NULL, '2025-11-27 03:57:28', '2025-11-27 03:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `pid` int DEFAULT '0',
  `Product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PartNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HsnCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Category` enum('Internal','External','Spare Part','Accessory','Consumable') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Spare Part',
  `UnitType` enum('PCS','SET','PAIR','LITRE','KG') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'PCS',
  `Location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Stock` int DEFAULT '0',
  `MinStock` int DEFAULT '0',
  `CostPrice` decimal(10,2) DEFAULT '0.00',
  `SalePrice` decimal(10,2) DEFAULT '0.00',
  `cgst_percentage` decimal(5,2) DEFAULT '0.00',
  `sgst_percentage` decimal(5,2) DEFAULT '0.00',
  `igst_percentage` decimal(5,2) DEFAULT '0.00',
  `ProductAdded` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `g_id`, `pid`, `Product`, `Photo`, `PartNumber`, `HsnCode`, `Category`, `UnitType`, `Location`, `Stock`, `MinStock`, `CostPrice`, `SalePrice`, `cgst_percentage`, `sgst_percentage`, `igst_percentage`, `ProductAdded`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'Windsheild back', '1764741228_logo1.png', '5678', NULL, 'External', 'PCS', 'Gurgaon', 10, NULL, 1222.00, 12.00, 2.00, 2.00, 12.00, '2025-12-03 05:53:03', '2025-12-03 05:53:03', '2026-01-03 09:59:20'),
(6, 1, 2, 'Engine Oil', '1764741228_logo2.png', '1234', '1001201', 'Spare Part', 'LITRE', 'Delhi', 46, 10, 500.00, 600.00, 5.00, 5.00, 5.00, '2025-12-03 06:00:00', '2025-12-03 06:00:00', '2026-01-03 10:18:19'),
(7, 2, 3, 'Brake Pads', '1764741228_logo3.png', '6789', '1001301', 'Spare Part', 'SET', 'Mumbai', 3, 5, 1200.00, 1400.00, 6.00, 6.00, 6.00, '2025-12-03 06:15:00', '2025-12-03 06:15:00', '2026-01-03 11:11:43'),
(8, 2, 4, 'Air Filter', '1764741228_logo4.png', '1122', '1001401', 'Spare Part', 'PCS', 'Pune', 29, 5, 150.00, 180.00, 4.00, 4.00, 4.00, '2025-12-03 06:30:00', '2025-12-03 06:30:00', '2026-01-03 11:02:38'),
(9, 3, 5, 'Car Battery', '1764741228_logo5.png', '3345', '1001501', 'Spare Part', 'PCS', 'Kolkata', 5, 3, 2500.00, 2800.00, 7.00, 7.00, 7.00, '2025-12-03 06:45:00', '2025-12-03 06:45:00', '2026-01-03 12:30:43'),
(11, 1, 7, 'Windsheld', 'N/A', '2345679', NULL, 'Internal', 'PAIR', '2', 0, NULL, 2.00, 2.00, 2.00, 2.00, 2.00, '2025-12-08 11:57:00', '2025-12-08 11:57:00', '2026-01-03 09:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

DROP TABLE IF EXISTS `inventory_categories`;
CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_clients`
--

DROP TABLE IF EXISTS `inventory_clients`;
CREATE TABLE IF NOT EXISTS `inventory_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory_clients`
--

INSERT INTO `inventory_clients` (`id`, `g_id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ajay Yadav', 'ajayretro1@gmail.com', NULL, 'H.No 148 Shivji Park Sector 10A Gurgaon Haryana', '2026-01-03 01:54:14', '2026-01-03 01:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_payments`
--

DROP TABLE IF EXISTS `inventory_payments`;
CREATE TABLE IF NOT EXISTS `inventory_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sales_order_id` int NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_mode` enum('cash','card','upi','bank_transfer') DEFAULT 'cash',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sales_order_id` (`sales_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory_payments`
--

INSERT INTO `inventory_payments` (`id`, `sales_order_id`, `payment_date`, `payment_amount`, `payment_mode`, `remarks`, `created_at`, `updated_at`) VALUES
(5, 12, '2025-12-28', 2700.00, 'card', 'sd', '2026-01-03 06:51:20', '2026-01-03 06:51:20'),
(6, 12, '2025-12-31', 2700.00, 'card', 'ds', '2026-01-03 06:52:27', '2026-01-03 06:52:27'),
(7, 13, '2025-12-31', 1222.00, 'cash', 'wdeded', '2026-01-03 07:02:05', '2026-01-03 07:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_history`
--

DROP TABLE IF EXISTS `inventory_stock_history`;
CREATE TABLE IF NOT EXISTS `inventory_stock_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inventory_id` int NOT NULL,
  `change_type` enum('added','removed','sale','purchase') NOT NULL,
  `quantity` int NOT NULL,
  `previous_stock` int NOT NULL,
  `new_stock` int NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `inventory_id` (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory_stock_history`
--

INSERT INTO `inventory_stock_history` (`id`, `inventory_id`, `change_type`, `quantity`, `previous_stock`, `new_stock`, `remarks`, `created_at`) VALUES
(1, 9, 'sale', 1, 4, 3, 'Order #17 Completed', '2026-01-03 06:11:07'),
(2, 9, 'added', 1, 3, 4, 'Order #17 status changed to Cancelled', '2026-01-03 06:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `repair_id` bigint UNSIGNED NOT NULL,
  `additional_charges` decimal(8,2) DEFAULT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_repair_id_index` (`repair_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobcard`
--

DROP TABLE IF EXISTS `jobcard`;
CREATE TABLE IF NOT EXISTS `jobcard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `v_id` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `m_id` int DEFAULT NULL,
  `invoice_no` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_gst` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `carbrand` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carmodel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fueltype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chassis_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odometer` int DEFAULT NULL,
  `transmission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `braking` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fuelmeter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inventory` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `insurance_company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insexpiry` date DEFAULT NULL,
  `service` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `voice_of_customer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `instruction_for_mechanic` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `totalPrice` decimal(15,2) DEFAULT NULL,
  `dueamount` decimal(15,2) DEFAULT NULL,
  `status` enum('C','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'C = Closed\r\nP = Pending',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Cash = Cash\r\nCredit = Credit\r\nBank Transfer = Bank Transfer\r\n',
  `part_discount` decimal(10,2) DEFAULT NULL,
  `service_discount` decimal(10,2) DEFAULT NULL,
  `packageDiscount` decimal(15,2) DEFAULT NULL,
  `packageDiscountAmount` decimal(15,2) DEFAULT NULL,
  `work_status` tinyint(1) DEFAULT NULL COMMENT '1- pending\r\n2- approve\r\n3- working\r\n4- complete\r\n5- reject',
  `service_due_date` date DEFAULT NULL,
  `completed_work_date` date DEFAULT NULL,
  `job_card_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job_card_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insurance_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insurance_gstin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insurance_claim_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insurance_policy_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insurance_company_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_job_card_no` (`job_card_no`),
  KEY `idx_g_id_insexpiry` (`g_id`,`insexpiry`),
  KEY `idx_invoice_no` (`invoice_no`),
  KEY `idx_customer` (`c_id`),
  KEY `idx_vehicle` (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobcard`
--

INSERT INTO `jobcard` (`id`, `g_id`, `c_id`, `v_id`, `uid`, `m_id`, `invoice_no`, `name`, `contact`, `email`, `c_gst`, `address`, `carbrand`, `carmodel`, `fueltype`, `registration`, `chassis_no`, `odometer`, `transmission`, `braking`, `fuelmeter`, `img1`, `img2`, `document`, `inventory`, `insurance_company`, `insexpiry`, `service`, `voice_of_customer`, `instruction_for_mechanic`, `remark`, `totalPrice`, `dueamount`, `status`, `payment_method`, `part_discount`, `service_discount`, `packageDiscount`, `packageDiscountAmount`, `work_status`, `service_due_date`, `completed_work_date`, `job_card_type`, `job_card_no`, `insurance_code`, `insurance_gstin`, `insurance_claim_number`, `insurance_policy_number`, `insurance_company_name`, `created_at`, `updated_at`) VALUES
(1, 1, 101, 2, 2, 2, 'INVC-5467', 'Rahul Sharma', '9876543210', 'rahul@example.com', NULL, 'Mumbai, Maharashtra', 'Toyota', 'Camry', 'Diesel', 'HR98E3526', '343434', NULL, 'Manual', NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Engine Oil\",\"mrp\":600,\"partNo\":\"1234\",\"hsn\":\"1001201\",\"qty\":1,\"cgst\":5,\"sgst\":5,\"igst\":5,\"discount\":10,\"finalDiscount\":10,\"total\":590}]', 'Null', '2025-12-25', '[{\"service_name\":\"Car Battery\",\"mrp\":2800,\"discount\":10,\"total\":2790,\"finalDiscount\":10}]', 'try', 'try 1', 'try 2', 0.00, 0.00, 'P', NULL, 0.00, 10.00, NULL, NULL, 2, '2025-12-25', NULL, 'Accident', 'JC-9934', '2345', NULL, '2345678', '12356654', 'Null', '2025-12-10 05:33:06', '2025-12-10 14:48:31'),
(2, 1, 101, 2, 2, 2, 'INVC-5467', 'Rahul Sharma', '9876543210', 'rahul@example.com', NULL, 'Mumbai, Maharashtra', 'Toyota', 'Camry', 'Diesel', 'HR98E3526', '343434', NULL, 'Manual', NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Engine Oil\",\"mrp\":600,\"partNo\":\"1234\",\"hsn\":\"1001201\",\"qty\":1,\"cgst\":5,\"sgst\":5,\"igst\":5,\"discount\":10,\"finalDiscount\":10,\"total\":590}]', 'Null', '2025-12-25', '[{\"service_name\":\"Car Battery\",\"mrp\":2800,\"discount\":10,\"total\":2790,\"finalDiscount\":10}]', 'try', 'try 1', 'try 2', 0.00, 0.00, 'P', NULL, 0.00, 10.00, NULL, NULL, 2, '2025-12-25', NULL, 'Accident', 'JC-9932', '2345', NULL, '2345678', '12356654', 'Null', '2025-12-10 05:33:06', '2025-12-10 14:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(33, '2014_10_12_000000_create_users_table', 1),
(34, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(35, '2019_08_19_000000_create_failed_jobs_table', 1),
(36, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(37, '2025_11_27_073420_create_countries_table', 1),
(38, '2025_11_27_073554_create_car_makers_table', 1),
(39, '2025_11_27_074400_create_car_models_table', 1),
(40, '2025_11_27_092544_create_fuel_types_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `misc_expenses`
--

DROP TABLE IF EXISTS `misc_expenses`;
CREATE TABLE IF NOT EXISTS `misc_expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `misc_date` date NOT NULL,
  `misc_amount` decimal(10,2) NOT NULL,
  `misc_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `misc_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status_spare` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'General',
  `reference_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 1),
(26, 'App\\Models\\User', 1),
(27, 'App\\Models\\User', 1),
(28, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\UserManage', 5),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\UserManage', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\UserManage', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ajayretro1@gmail.com', '$2y$10$36wJl8I2uS4kQ.3iF8EY/.8kN5Low6YKi8A4m/Ny1c/whmnqzL0IG', '2025-12-08 00:26:32'),
('ajayretro21@gmail.com', '$2y$10$U7eORQQwJfmYWGtiZJB7i.lXRkt4qmML/A14L4jcLld4k/ASDMcJW', '2025-12-06 01:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE IF NOT EXISTS `payment_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `c_id` int NOT NULL,
  `jobcard_id` int NOT NULL,
  `amount` double(15,2) NOT NULL,
  `status` enum('C','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'C = Complete paid\r\nP = Partical paid',
  `payment_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'paid\r\n\r\npartial',
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `g_id`, `c_id`, `jobcard_id`, `amount`, `status`, `payment_type`, `created_at`) VALUES
(1, 1, 101, 1, 8500.00, 'C', 'paid', '2025-01-05 10:00:00'),
(2, 1, 102, 2, 9200.00, 'C', 'UPI', '2025-01-15 12:30:00'),
(3, 1, 103, 3, 7000.00, 'P', 'Card', '2025-01-25 17:20:00'),
(4, 1, 104, 4, 6000.00, 'C', 'Cash', '2025-02-07 09:15:00'),
(5, 1, 105, 5, 9500.00, 'C', 'Online', '2025-02-18 18:00:00'),
(6, 1, 106, 6, 7200.00, 'P', 'UPI', '2025-02-27 14:50:00'),
(7, 1, 107, 7, 15000.00, 'C', 'Cash', '2025-03-04 15:30:00'),
(8, 1, 108, 8, 5000.00, 'C', 'UPI', '2025-03-16 11:30:00'),
(9, 1, 109, 9, 8300.00, 'P', 'Card', '2025-03-28 13:10:00'),
(10, 1, 110, 10, 14500.00, 'C', 'Cash', '2025-04-03 09:45:00'),
(11, 1, 111, 11, 8700.00, 'C', 'Online', '2025-04-12 11:25:00'),
(12, 1, 112, 12, 5200.00, 'P', 'UPI', '2025-04-29 19:40:00'),
(13, 1, 113, 13, 12200.00, 'C', 'Cash', '2025-05-06 10:50:00'),
(14, 1, 114, 14, 9500.00, 'C', 'UPI', '2025-05-18 16:30:00'),
(15, 1, 115, 15, 7700.00, 'P', 'Online', '2025-05-26 21:15:00'),
(16, 1, 116, 16, 8400.00, 'C', 'Cash', '2025-06-03 13:00:00'),
(17, 1, 117, 17, 10200.00, 'C', 'UPI', '2025-06-14 15:20:00'),
(18, 1, 118, 18, 6900.00, 'P', 'Cash', '2025-06-28 20:10:00'),
(19, 1, 119, 19, 9300.00, 'C', 'Card', '2025-07-05 11:10:00'),
(20, 1, 120, 20, 11000.00, 'C', 'UPI', '2025-07-20 12:20:00'),
(21, 1, 121, 21, 7600.00, 'P', 'Cash', '2025-07-29 18:40:00'),
(22, 1, 122, 22, 14000.00, 'C', 'Cash', '2025-08-02 10:35:00'),
(23, 1, 123, 23, 7800.00, 'C', 'Card', '2025-08-19 17:30:00'),
(24, 1, 124, 24, 6200.00, 'P', 'UPI', '2025-08-27 20:25:00'),
(25, 1, 125, 25, 15500.00, 'C', 'UPI', '2025-09-08 14:10:00'),
(26, 1, 126, 26, 9900.00, 'C', 'Online', '2025-09-15 15:40:00'),
(27, 1, 127, 27, 7500.00, 'P', 'Cash', '2025-09-29 18:55:00'),
(28, 1, 128, 28, 13400.00, 'C', 'UPI', '2025-10-04 09:10:00'),
(29, 1, 129, 29, 8400.00, 'C', 'Cash', '2025-10-21 12:40:00'),
(30, 1, 130, 30, 6700.00, 'P', 'Card', '2025-10-27 16:15:00'),
(31, 1, 131, 31, 16000.00, 'C', 'Online', '2025-11-03 10:05:00'),
(32, 1, 132, 32, 9200.00, 'C', 'UPI', '2025-11-14 17:20:00'),
(33, 1, 133, 33, 8100.00, 'P', 'Cash', '2025-11-29 20:50:00'),
(34, 1, 134, 34, 17500.00, 'C', 'Cash', '2025-12-01 11:45:00'),
(35, 1, 135, 35, 9900.00, 'C', 'Card', '2025-12-15 16:30:00'),
(36, 1, 136, 36, 8800.00, 'P', 'UPI', '2025-12-28 22:10:00'),
(37, 1, 137, 37, 7200.00, 'C', 'UPI', '2025-01-05 12:00:00'),
(38, 1, 138, 38, 5500.00, 'C', 'Cash', '2025-01-18 13:20:00'),
(39, 1, 139, 39, 8900.00, 'P', 'Card', '2025-01-29 19:45:00'),
(40, 1, 140, 40, 10400.00, 'C', 'Online', '2025-02-02 09:25:00'),
(41, 1, 141, 41, 7800.00, 'C', 'UPI', '2025-02-17 17:10:00'),
(42, 1, 142, 42, 6600.00, 'P', 'Cash', '2025-02-27 22:30:00'),
(43, 1, 143, 43, 14200.00, 'C', 'Cash', '2025-03-05 10:40:00'),
(44, 1, 144, 44, 9500.00, 'C', 'UPI', '2025-03-17 16:35:00'),
(45, 1, 145, 45, 7200.00, 'P', 'Card', '2025-03-28 21:00:00'),
(46, 1, 146, 46, 16300.00, 'C', 'Card', '2025-04-07 11:10:00'),
(47, 1, 147, 47, 8700.00, 'C', 'UPI', '2025-04-18 14:55:00'),
(48, 1, 148, 48, 6200.00, 'P', 'Cash', '2025-04-29 19:20:00'),
(49, 1, 149, 49, 13000.00, 'C', 'Cash', '2025-05-04 12:45:00'),
(50, 1, 150, 50, 10400.00, 'C', 'Online', '2025-05-21 16:40:00'),
(51, 1, 151, 51, 7300.00, 'P', 'UPI', '2025-05-31 20:15:00'),
(52, 1, 152, 52, 12800.00, 'C', 'Card', '2025-06-06 09:50:00'),
(53, 1, 153, 53, 9100.00, 'C', 'Cash', '2025-06-19 13:15:00'),
(54, 1, 154, 54, 7400.00, 'P', 'UPI', '2025-06-25 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'jobcards.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(2, 'jobcards.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(3, 'jobcards.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(4, 'jobcards.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(5, 'inventory.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(6, 'inventory.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(7, 'inventory.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(8, 'inventory.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(9, 'mechanics.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(10, 'mechanics.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(11, 'mechanics.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(12, 'mechanics.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(13, 'customers.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(14, 'customers.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(15, 'customers.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(16, 'customers.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(17, 'vehicles.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(18, 'vehicles.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(19, 'vehicles.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(20, 'vehicles.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(21, 'vendors.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(22, 'vendors.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(23, 'vendors.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(24, 'vendors.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(25, 'reminders.view', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(26, 'reminders.create', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(27, 'reminders.update', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19'),
(28, 'reminders.delete', 'web', '2025-12-12 06:14:19', '2025-12-12 06:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
CREATE TABLE IF NOT EXISTS `reminders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reminder_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_date` date DEFAULT NULL,
  `is_sent` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `name`, `email`, `reminder_type`, `service_date`, `is_sent`, `created_at`, `updated_at`) VALUES
(1, 'Ajay Yadav', 'ajayretro1@gmail.com', 'service', '2025-12-10', 27, '2025-12-10 01:44:46', '2025-12-10 02:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Accounts', 'web', '2025-12-11 03:04:55', '2025-12-11 03:04:55'),
(2, 'HR', 'web', '2025-12-11 03:04:55', '2025-12-11 03:04:55'),
(3, 'Manager', 'web', '2025-12-12 01:48:01', '2025-12-12 01:48:01'),
(4, 'Inventory Manager', 'web', '2025-12-12 04:02:08', '2025-12-12 04:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(5, 1),
(9, 1),
(11, 3),
(13, 1),
(14, 4),
(15, 3),
(17, 1),
(18, 4),
(21, 1),
(25, 1),
(26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `salary_expenses`
--

DROP TABLE IF EXISTS `salary_expenses`;
CREATE TABLE IF NOT EXISTS `salary_expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `salary_date` date NOT NULL,
  `mechanic_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL,
  `salary_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status_spare` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Due',
  `designation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

DROP TABLE IF EXISTS `sales_orders`;
CREATE TABLE IF NOT EXISTS `sales_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `client_id` int NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `status` enum('Pending','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(210) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `g_id`, `client_id`, `order_date`, `total_amount`, `status`, `payment_status`, `created_at`, `updated_at`) VALUES
(12, 1, 1, '2026-01-13', 2800.00, 'Completed', 'paid', '2026-01-03 05:33:30', '2026-01-03 06:52:27'),
(13, 1, 1, '2026-01-21', 1400.00, 'Completed', 'partial', '2026-01-03 05:36:43', '2026-01-03 07:02:05'),
(14, 1, 1, '2026-01-15', 1400.00, 'Completed', 'pending', '2026-01-03 05:37:21', '2026-01-03 12:17:05'),
(15, 1, 1, '2026-01-14', 1400.00, 'Completed', 'pending', '2026-01-03 05:39:18', '2026-01-03 12:19:24'),
(16, 1, 1, '2026-01-06', 1400.00, 'Completed', 'pending', '2026-01-03 05:39:35', '2026-01-03 12:17:05'),
(17, 1, 1, '2026-01-03', 0.00, 'Completed', 'pending', '2026-01-03 06:11:06', '2026-01-03 07:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_items`
--

DROP TABLE IF EXISTS `sales_order_items`;
CREATE TABLE IF NOT EXISTS `sales_order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sales_order_id` int NOT NULL,
  `inventory_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) DEFAULT '0.00',
  `total_price` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sales_order_id` (`sales_order_id`),
  KEY `inventory_id` (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_order_items`
--

INSERT INTO `sales_order_items` (`id`, `sales_order_id`, `inventory_id`, `quantity`, `unit_price`, `total_price`, `created_at`) VALUES
(27, 12, 7, 2, 1400.00, 2800.00, '2026-01-03 11:05:19'),
(28, 13, 7, 1, 1400.00, 1400.00, '2026-01-03 11:06:43'),
(29, 14, 7, 1, 1400.00, 1400.00, '2026-01-03 11:07:21'),
(30, 15, 7, 1, 1400.00, 1400.00, '2026-01-03 11:09:18'),
(31, 16, 7, 1, 1400.00, 1400.00, '2026-01-03 11:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `servicepackage`
--

DROP TABLE IF EXISTS `servicepackage`;
CREATE TABLE IF NOT EXISTS `servicepackage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `pid` int NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `package` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `packageprice` decimal(10,2) NOT NULL,
  `discountprice` decimal(10,2) DEFAULT NULL,
  `package_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hsncode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int DEFAULT '0',
  `cgst_percentage` decimal(5,2) DEFAULT '0.00',
  `sgst_percentage` decimal(5,2) DEFAULT '0.00',
  `igst_percentage` decimal(5,2) DEFAULT '0.00',
  `created_package_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servicepackage`
--

INSERT INTO `servicepackage` (`id`, `g_id`, `pid`, `items`, `package`, `packageprice`, `discountprice`, `package_desc`, `hsncode`, `stock`, `cgst_percentage`, `sgst_percentage`, `igst_percentage`, `created_package_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '[{\"id\":\"5\",\"quantity\":1}]', 'Basic Service Package', 1500.00, 0.00, 'Basic service package including essential parts and labor.', NULL, 20, 5.00, 5.00, 18.00, '2025-12-03 12:43:17', '2025-12-03 12:43:17', '2025-12-03 12:43:17'),
(2, 1, 2, '[{\"id\":\"8\",\"quantity\":1},{\"id\":\"7\",\"quantity\":1},{\"id\":\"9\",\"quantity\":1},{\"id\":\"6\",\"quantity\":1},{\"id\":\"10\",\"quantity\":1},{\"id\":\"5\",\"quantity\":1}]', 'Premium Service Package', 1500.00, 100.00, 'Premium service with additional features and parts replacement.', '1001201', 15, 6.00, 6.00, 18.00, '2025-12-03 13:00:00', '2025-12-03 13:00:00', '2025-12-06 14:36:28'),
(3, 2, 3, '[{\"id\":\"8\",\"quantity\":1}]', 'Full Car Detailing Package', 3500.00, 200.00, 'Full detailing including interior and exterior cleaning and polishing.', NULL, 10, 7.00, 7.00, 18.00, '2025-12-03 14:15:00', '2025-12-03 14:15:00', '2025-12-03 14:15:00'),
(4, 1, 4, '[{\"id\":\"5\",\"quantity\":1}]', 'try', 12.00, 0.00, '12', NULL, 0, 10.00, 10.00, 10.00, '2025-12-08 17:34:33', '2025-12-08 17:34:33', '2025-12-08 17:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  `cgst_percentage` float NOT NULL DEFAULT '0',
  `sgst_percentage` float NOT NULL DEFAULT '0',
  `igst_percentage` float NOT NULL DEFAULT '0',
  `service_duration` int NOT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `service_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_code`, `service_name`, `service_price`, `cgst_percentage`, `sgst_percentage`, `igst_percentage`, `service_duration`, `service_description`, `service_status`, `created_at`, `updated_at`) VALUES
(1, 'SVC001', 'Oil Change', 499.99, 9, 9, 0, 30, 'Change engine oil and filter, check fluid levels, and ensure everything is working smoothly.', '0', '2025-12-06 08:06:16', '2025-12-06 08:06:16'),
(2, 'SVC002', 'Tyre Replacement', 1999.99, 9, 9, 0, 60, 'Replacing worn-out tyres with new ones. Includes balancing and alignment.', '0', '2025-12-06 08:06:16', '2025-12-06 08:06:16'),
(3, 'SVC003', 'Brake Inspection', 299.99, 9, 9, 0, 45, 'Inspect brake pads and discs. Replace any worn-out parts.', '0', '2025-12-06 08:06:16', '2025-12-06 08:06:16'),
(4, 'SVC004', 'AC Service', 799.99, 9, 9, 0, 90, 'Cleaning and refilling the air conditioning system, checking for leaks.', '0', '2025-12-06 08:06:16', '2025-12-06 08:06:16'),
(5, 'SVC005', 'Battery Check', 199.99, 9, 9, 0, 20, 'Testing the car battery and replacing it if necessary.', '0', '2025-12-06 08:06:16', '2025-12-06 08:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `spare_expenses`
--

DROP TABLE IF EXISTS `spare_expenses`;
CREATE TABLE IF NOT EXISTS `spare_expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `vendor_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spare_date` date NOT NULL,
  `spare_amount` decimal(10,2) NOT NULL,
  `spare_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spare_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status_spare` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Due',
  `vendor_invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'AED',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Spare Parts',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sublet_expenses`
--

DROP TABLE IF EXISTS `sublet_expenses`;
CREATE TABLE IF NOT EXISTS `sublet_expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `sublet_vendor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sublet_date` date NOT NULL,
  `sublet_amount` decimal(10,2) NOT NULL,
  `sublet_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sublet_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status_spare` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Due',
  `sublet_invoice_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Sublet Services',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'admin@example.com', NULL, '$2y$10$QVr/c3Baae1v4dz0KQla2OapSbXT65ogFIwYgFYNk3.xrl6lIcKZe', NULL, '2025-12-11 00:04:32', '2025-12-11 00:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_manage`
--

DROP TABLE IF EXISTS `user_manage`;
CREATE TABLE IF NOT EXISTS `user_manage` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `user_code` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` bigint DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_manage_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_manage`
--

INSERT INTO `user_manage` (`id`, `g_id`, `user_code`, `name`, `user_image`, `email`, `user_phone`, `password`, `gender`, `role_id`, `status`, `created_at`) VALUES
(5, 1, 1001, 'Super Adm1in', 'default.png', 'ajayretro1@gmail.com', 1234567890, '$2y$10$JVNRas5d1A8lGVEdvQFkUeYf72EaQugopjCzTFx3QZJGOf8XiNe9i', 'Male', 1, 'Active', '2025-12-12 09:45:36'),
(6, 1, NULL, 'Keshav', NULL, 'keshav@gmail.com', NULL, '$2y$10$.Y3gLsDk8D6Yb3V1AflF0Od9cNi1t0PMvvUBWyTnfSDv7eT0R.IEO', NULL, 4, 'Active', '2025-12-27 09:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `make` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_type` enum('gasoline','diesel','hybrid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_client_id_foreign` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make`, `model`, `fuel_type`, `year`, `registration`, `photo`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'Camry', 'gasoline', NULL, NULL, NULL, 1, '2025-11-24 05:50:54', '2025-11-24 05:50:54'),
(2, 'Honda', 'Accord', 'gasoline', '2019', NULL, NULL, 1, '2025-11-24 05:50:54', '2025-11-24 05:50:54'),
(3, 'Maruti', 'Swift', 'gasoline', '2020', 'MH12AB1234', NULL, 1, NULL, NULL),
(4, 'Honda', 'City', 'diesel', '2019', 'MH14XY9876', NULL, 1, NULL, NULL),
(5, 'Hyundai', 'i20', 'gasoline', '2021', 'MH04ZA4455', NULL, 2, NULL, NULL),
(6, 'Tata', 'Harrier', 'diesel', '2022', 'GJ01MN7788', NULL, 3, NULL, NULL),
(7, 'Toyota', 'Fortuner', 'diesel', '2021', 'MH03CY4452', NULL, 4, NULL, NULL),
(8, 'Maruti', 'WagonR', 'gasoline', '2018', 'MH15DK9987', NULL, 2, NULL, NULL),
(9, 'Kia', 'Seltos', 'hybrid', '2023', 'GJ05TR2345', NULL, 4, NULL, NULL),
(10, '1', 'Camry', 'diesel', NULL, 'hr88', NULL, 2, '2025-11-29 02:21:29', '2025-11-29 02:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `g_id` int NOT NULL,
  `vender_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_vendor_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_gst_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `g_id`, `vender_name`, `contact_info`, `vendor_image`, `description`, `add_vendor_date`, `vendor_gst_number`, `created_at`) VALUES
(1, 1, 'my vendor', 'gurgaon', 'vendors/my-vendor_1764592964.png', 'SSDS', '2025-12-01 18:12:44', 'DSDS', '2025-12-01 18:12:44');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_payments`
--
ALTER TABLE `inventory_payments`
  ADD CONSTRAINT `inventory_payments_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_stock_history`
--
ALTER TABLE `inventory_stock_history`
  ADD CONSTRAINT `inventory_stock_history_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `sales_orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `inventory_clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_order_items`
--
ALTER TABLE `sales_order_items`
  ADD CONSTRAINT `sales_order_items_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_order_items_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
