-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 02:47 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressSite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageBrand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mahiyat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `about`, `addressSite`, `country`, `company`, `imageBrand`, `created_at`, `updated_at`, `mahiyat`) VALUES
(1, 'سامسونگ', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'ایران', 'داو', 'brands\\April2020\\99m5F7NdaBrEzf3dQ6YB.png', '2020-04-14 07:09:00', '2020-04-14 07:14:07', NULL),
(2, 'مای', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'ایران', 'مای', 'brands\\April2020\\99m5F7NdaBrEzf3dQ6YB.png', '2020-04-14 07:09:00', '2020-04-14 07:14:07', NULL),
(3, 'ژیلا', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'ایران', 'ژیلا', 'brands\\April2020\\99m5F7NdaBrEzf3dQ6YB.png', '2020-04-14 07:09:00', '2020-04-14 07:14:07', NULL),
(4, 'سیب', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'ایران', 'سیب', 'brands\\April2020\\99m5F7NdaBrEzf3dQ6YB.png', '2020-04-14 07:09:00', '2020-04-14 07:14:07', NULL),
(6, 'محمد اکبری', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'klj', 'kjndk', 'brands\\May2020\\8DEIZ4GN021fkZ7hj0p7.png', '2020-05-18 10:07:58', '2020-05-18 10:07:58', 12),
(7, 'محمد اکبری', 'برند نمونه کشور در سال 1200', 'http://dav.com', 'ایران', 'kjndk', 'brands\\May2020\\DcRnyFeHeIgDH6hxxRtl.png', '2020-05-18 10:25:25', '2020-05-18 10:25:25', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`, `product_id`) VALUES
(1, NULL, 2, 'لوازم بزرگ آشپزخانه', 'lavazembozorgashpazkhaneh', '2020-04-23 01:44:29', '2020-05-08 02:58:10', NULL),
(2, NULL, 20, 'تجهیزات آشپزخانه', 'taghizatAshpazzKhaneh', '2020-04-23 01:45:00', '2020-05-08 02:58:01', 1),
(3, NULL, 19, 'صوتی و تصویری', 'sotivatasviri', '2020-04-23 01:45:24', '2020-05-08 02:58:01', 2),
(4, NULL, 18, 'لوازم منزل', 'lavazemManzel', '2020-04-23 01:45:48', '2020-05-08 02:58:01', 4),
(5, NULL, 17, 'کالای خواب', 'kalayeKhab', '2020-04-23 01:46:08', '2020-05-08 02:58:00', 5),
(6, NULL, 16, 'آماده سازی غذا', 'amadehSaziGhaza', '2020-04-23 01:46:31', '2020-05-08 02:58:00', 6),
(7, NULL, 15, 'تهیه و نگهداری نوشیدنی', 'tahievanegahdarinoushidani', '2020-04-23 01:47:06', '2020-05-08 02:58:00', 7),
(8, NULL, 14, 'تجهیزات حمام و دستشویی', 'taghizathamamvadastshouei', '2020-04-23 01:47:43', '2020-05-08 02:58:00', 8),
(9, 1, 13, 'یخچال و فریز', 'yakhchalvaferizer', '2020-04-23 01:50:43', '2020-05-08 02:58:00', 9),
(10, 1, 12, 'ماشین لباسشویی', 'mashinlebasshouie', '2020-04-23 01:51:46', '2020-05-08 02:58:03', 10),
(11, 1, 11, 'ماشین ظرفشویی', 'mashinzarfshouei', '2020-04-23 01:52:40', '2020-05-08 02:58:03', 11),
(12, 2, 10, 'هود', 'houd', '2020-04-23 01:53:09', '2020-05-08 02:58:03', 12),
(13, 2, 9, 'فر', 'fer', '2020-04-23 01:53:26', '2020-05-08 02:58:03', 13),
(14, 2, 8, 'سینک', 'sink', '2020-04-23 01:53:46', '2020-05-08 02:58:07', 14),
(15, 3, 7, 'تلویزیون', 'telvision', '2020-04-23 01:54:24', '2020-05-08 02:58:07', 15),
(16, 15, 6, 'سینما خانگی', 'sinemakhanegi', '2020-04-23 01:54:42', '2020-05-08 02:58:07', 16),
(17, 15, 5, 'سامسونگ', 'samsung', '2020-04-23 01:55:33', '2020-05-08 02:58:07', 17),
(18, 15, 4, 'ال جی', 'lg', '2020-04-23 01:55:55', '2020-05-08 02:58:07', 18),
(19, 9, 3, 'دوو', 'dwo', '2020-04-23 04:52:20', '2020-05-08 02:58:10', 19),
(20, NULL, 1, 'صفحه اصلی', 'home', '2020-05-13 08:16:30', '2020-05-07 08:26:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'نام', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'ایمیل', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'پسورد', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'hidden', 'به یادسپاری توکن', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'ایجاد شده در', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'به روز شده در', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'تصویر پروفایل', 0, 1, 1, 1, 1, 1, '{}', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'نقش', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\"}\r\n\r\n\r\n', 10),
(11, 1, 'settings', 'hidden', 'تنظیمات', 0, 1, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'نام', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'ایجاد شده در', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'به روز شده در', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'نام', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'ایجاد شده در', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'به روز شده در', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'نام نمایشی', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'نقش', 0, 1, 1, 1, 1, 1, '{}', 9),
(22, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(23, 4, 'parent_id', 'select_dropdown', 'والد', 0, 1, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(24, 4, 'order', 'text', 'چیدمان', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(25, 4, 'name', 'text', 'نام', 1, 1, 1, 1, 1, 1, '{}', 4),
(26, 4, 'slug', 'text', 'نامک', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(27, 4, 'created_at', 'timestamp', 'ایجاد شده در', 0, 0, 1, 0, 0, 0, '{}', 6),
(28, 4, 'updated_at', 'timestamp', 'به روز شده در', 0, 0, 0, 0, 0, 0, '{}', 7),
(50, 6, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(51, 6, 'name', 'text', 'نام برند', 1, 1, 1, 1, 1, 1, '{}', 2),
(52, 6, 'about', 'text', 'درباره برند', 1, 1, 1, 1, 1, 1, '{}', 3),
(53, 6, 'addressSite', 'text', 'آدرس برند', 1, 1, 1, 1, 1, 1, '{}', 4),
(54, 6, 'country', 'text', 'کشور', 0, 1, 1, 1, 1, 1, '{}', 5),
(55, 6, 'company', 'text', 'شرکت', 0, 1, 1, 1, 1, 1, '{}', 6),
(56, 6, 'imageBrand', 'image', 'آدرس تصویر برند', 1, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"100\",\"height\":null},\"quality\":\"70%\",\"upsize\":true}', 7),
(57, 6, 'created_at', 'timestamp', 'تاریخ ایجاد', 0, 1, 1, 1, 0, 1, '{}', 8),
(58, 6, 'updated_at', 'timestamp', 'تاریخ اخرین ویرایش', 0, 0, 0, 0, 0, 0, '{}', 9),
(59, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(60, 7, 'user_id', 'text', 'User Id', 0, 0, 1, 1, 1, 1, '{}', 2),
(61, 7, 'name', 'text', 'نام و نام خانوادگی', 1, 1, 1, 1, 1, 1, '{}', 3),
(62, 7, 'mobile', 'text', 'شماره همراه', 0, 1, 1, 1, 1, 1, '{}', 4),
(63, 7, 'message', 'text', 'پیام', 1, 1, 1, 1, 1, 1, '{}', 5),
(64, 7, 'email', 'text', 'آدرس ایمیل', 0, 1, 1, 1, 1, 1, '{}', 6),
(65, 7, 'created_at', 'timestamp', 'تاریخ ارسال', 0, 1, 1, 1, 0, 1, '{}', 7),
(66, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(67, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(68, 8, 'name', 'text', 'نام محصول', 1, 1, 1, 1, 1, 1, '{}', 3),
(69, 8, 'comment', 'text', 'نظر', 1, 1, 1, 1, 1, 1, '{}', 4),
(70, 8, 'created_at', 'timestamp', 'تاریخ ارسال', 0, 1, 1, 1, 0, 1, '{}', 5),
(71, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(72, 8, 'product_id', 'text', 'ردیف محصول', 1, 1, 1, 1, 1, 1, '{}', 2),
(73, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(74, 9, 'mablagh', 'text', 'مبلغ پرداختی', 1, 1, 1, 1, 1, 1, '{}', 3),
(75, 9, 'transId', 'text', 'شماره تراکنش', 1, 1, 1, 1, 1, 1, '{}', 4),
(76, 9, 'cardNumber', 'text', 'شماره کارت', 1, 1, 1, 1, 1, 1, '{}', 5),
(77, 9, 'created_at', 'timestamp', 'تاریخ پرداخت', 0, 1, 1, 1, 0, 1, '{}', 6),
(78, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(79, 9, 'user_id', 'text', 'ای دی کاربر', 1, 1, 1, 1, 1, 1, '{}', 2),
(89, 11, 'id', 'text', 'ردیف', 1, 0, 0, 0, 0, 0, '{}', 1),
(90, 11, 'name', 'text', 'نام محصول', 1, 1, 1, 1, 1, 1, '{}', 5),
(91, 11, 'catagory1', 'text', 'دسته بندی سطح 1', 1, 1, 1, 1, 1, 1, '{}', 6),
(92, 11, 'catagory2', 'text', 'دسته بندی سطح 2', 1, 0, 1, 1, 1, 1, '{}', 7),
(93, 11, 'catagory3', 'text', 'دسته بندی سطح 3', 1, 0, 1, 1, 1, 1, '{}', 8),
(94, 11, 'price', 'text', 'قیمت ( تومان )', 1, 1, 1, 1, 1, 1, '{}', 9),
(95, 11, 'number', 'text', 'تعداد', 1, 1, 1, 1, 1, 1, '{}', 10),
(96, 11, 'takhfif', 'text', 'درصد تخفیف', 0, 0, 1, 1, 1, 1, '{}', 11),
(97, 11, 'transId', 'text', 'شماره تراکنش', 1, 1, 1, 1, 1, 1, '{}', 4),
(98, 11, 'date', 'text', 'date', 0, 0, 0, 0, 0, 0, '{}', 12),
(99, 11, 'created_at', 'timestamp', 'تاریخ سفارش', 0, 1, 1, 1, 0, 1, '{}', 13),
(100, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 16),
(101, 11, 'user_id', 'text', 'ای دی کاربر خریدار', 1, 1, 1, 1, 1, 1, '{}', 2),
(102, 11, 'product_id', 'text', 'ای دی محصول', 1, 1, 1, 1, 1, 1, '{}', 3),
(103, 1, 'age', 'text', 'سن', 0, 1, 1, 1, 1, 1, '{}', 4),
(104, 1, 'gener', 'text', 'جنسیت', 0, 1, 1, 1, 1, 1, '{}', 5),
(105, 1, 'shoghl', 'text', 'شغل', 0, 1, 1, 1, 1, 1, '{}', 6),
(106, 1, 'tahsilat', 'text', 'تحصیلات', 0, 1, 1, 1, 1, 1, '{}', 7),
(107, 1, 'mahalZendegi', 'text', 'محل زندگی', 0, 1, 1, 1, 1, 1, '{}', 8),
(108, 1, 'mahalTavalod', 'text', 'محل تولد', 0, 1, 1, 1, 1, 1, '{}', 9),
(109, 1, 'mobile', 'text', 'شماره همراه', 0, 1, 1, 1, 1, 1, '{}', 10),
(110, 1, 'email_verified_at', 'timestamp', 'تاریخ تایید ایمیل', 0, 1, 1, 1, 1, 1, '{}', 13),
(111, 1, 'api_token', 'hidden', 'Api Token', 0, 0, 0, 0, 0, 0, '{}', 15),
(133, 13, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(134, 13, 'name', 'text', 'نام محصول', 1, 1, 1, 1, 1, 1, '{}', 2),
(136, 13, 'price', 'text', 'قیمت ( تومان )', 1, 1, 1, 1, 1, 1, '{}', 4),
(137, 13, 'takhfif', 'text', 'درصد تخفیف', 0, 1, 1, 1, 1, 1, '{}', 5),
(139, 13, 'catagory1', 'select_dropdown', 'دسته بندی سطح 1', 1, 1, 1, 1, 1, 1, '{}', 7),
(140, 13, 'catagory2', 'select_dropdown', 'دسته بندی سطح 2', 0, 1, 1, 1, 1, 1, '{}', 8),
(141, 13, 'catagory3', 'select_dropdown', 'دسته بندی سطح 3', 0, 1, 1, 1, 1, 1, '{}', 9),
(142, 13, 'company', 'text', 'شرکت', 0, 1, 1, 1, 1, 1, '{}', 10),
(144, 13, 'aboutProduct', 'text', 'درباره محصول', 0, 1, 1, 1, 1, 1, '{}', 12),
(148, 13, 'nahvehEstefadeh', 'text', 'نحوه مصرف', 0, 1, 1, 1, 1, 1, '{}', 16),
(152, 13, 'created_at', 'timestamp', 'تاریخ ایجاد', 0, 1, 1, 1, 0, 1, '{}', 20),
(153, 13, 'updated_at', 'timestamp', 'تاریخ اخرین ویرایش', 0, 0, 0, 0, 0, 0, '{}', 21),
(154, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(155, 15, 'imageAddress', 'image', 'ادرس تصویر', 1, 1, 1, 1, 1, 1, '{\"resize\":{\"height\":\"300px\",\"width\":null},\"quality\":\"70%\"}', 2),
(156, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(157, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(163, 6, 'mahiyat', 'text', 'Mahiyat', 0, 1, 1, 1, 1, 1, '{}', 10),
(173, 23, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(174, 23, 'name', 'text', 'نام  فیلتر', 1, 1, 1, 1, 1, 1, '{}', 2),
(175, 23, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 4),
(176, 23, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(188, 13, 'available', 'text', 'تعدا موجود', 0, 1, 1, 1, 1, 1, '{}', 22),
(189, 25, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(190, 25, 'filter_id', 'text', 'ای دی فیلتر', 1, 1, 1, 1, 1, 1, '{}', 4),
(191, 25, 'value', 'text', 'مقدار', 1, 1, 1, 1, 1, 1, '{}', 3),
(192, 25, 'created_at', 'timestamp', 'تاریخ ایجاد', 0, 1, 1, 1, 0, 1, '{}', 5),
(193, 25, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(194, 25, 'filtervalue_belongsto_filter_relationship', 'relationship', 'نام فیلتر', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Filter\",\"table\":\"filters\",\"type\":\"belongsTo\",\"column\":\"filter_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"brands\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(196, 13, 'featuers', 'text', 'ویژگی محصول', 0, 1, 1, 1, 1, 1, '{}', 16),
(197, 23, 'slug', 'text', 'نامک', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 3),
(198, 4, 'product_id', 'text', 'Product Id', 0, 0, 0, 0, 0, 0, '{}', 8),
(225, 29, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(226, 29, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":null,\"height\":\"200\"},\"quality\":\"70%\",\"upsize\":true}', 3),
(227, 29, 'product_id', 'text', 'Product Id', 1, 0, 0, 0, 0, 0, '{}', 2),
(228, 29, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(229, 29, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(230, 29, 'mostpopular_belongsto_product_relationship', 'relationship', 'products', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Product\",\"table\":\"products\",\"type\":\"belongsTo\",\"column\":\"product_id\",\"key\":\"id\",\"label\":\"fullname\",\"pivot_table\":\"brands\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(231, 29, 'Order', 'text', 'Order', 0, 1, 1, 1, 1, 1, '{}', 6),
(232, 13, 'Order', 'text', 'Order', 0, 1, 1, 1, 1, 1, '{}', 15),
(236, 23, 'filter_hasmany_filtervalue_relationship', 'relationship', 'مقادیر', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Filtervalue\",\"table\":\"filtervalues\",\"type\":\"hasMany\",\"column\":\"filter_id\",\"key\":\"id\",\"label\":\"value\",\"pivot_table\":\"brands\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(237, 11, 'address', 'text', 'آدرس گیرنده', 0, 1, 1, 1, 1, 1, '{}', 15),
(238, 11, 'namegirandeh', 'text', 'نام و نام خانوادگی گیرنده', 0, 1, 1, 1, 1, 1, '{}', 17),
(239, 11, 'mobile', 'text', 'شماره همراه', 0, 1, 1, 1, 1, 1, '{}', 18),
(240, 11, 'kodemelli', 'text', 'کد ملی گیرنده', 0, 1, 1, 1, 1, 1, '{}', 19),
(241, 11, 'status', 'text', 'وضعیت سفارش', 0, 1, 1, 1, 1, 1, '{}', 14);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'کاربر', 'کاربران', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-04-11 11:41:10', '2020-05-06 09:11:30'),
(2, 'menus', 'menus', 'منو', 'منوها', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-04-11 11:41:10', '2020-04-11 11:41:10'),
(3, 'roles', 'roles', 'نقش', 'نقش ها', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-04-11 11:41:10', '2020-04-11 11:41:10'),
(4, 'categories', 'categories', 'دسته بندی', 'دسته بندی ها', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"order\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":\"name\",\"scope\":null}', '2020-04-11 11:41:19', '2020-05-21 13:27:30'),
(6, 'brands', 'brands', 'برند', 'برندها', 'voyager-company', 'App\\Brand', NULL, NULL, 'تمامی برندهای حاضر در فروشگاه', 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-04-11 20:15:16', '2020-05-18 10:24:47'),
(7, 'messages', 'messages', 'پیام های کاربران', 'پیام های کاربران', NULL, 'App\\Message', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"name\"}', '2020-04-11 20:18:04', '2020-04-11 20:18:04'),
(8, 'comments', 'comments', 'نظرات', 'نظرات', NULL, 'App\\Comment', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"product_id\"}', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(9, 'payments', 'payments', 'پرداخت ها', 'پرداخت ها', NULL, 'App\\Payment', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"user_id\",\"scope\":null}', '2020-04-11 20:21:19', '2020-06-12 10:43:34'),
(11, 'sales', 'sales', 'فروش ها', 'فروش ها', NULL, 'App\\Sale', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"product_id\",\"scope\":null}', '2020-04-11 20:31:34', '2020-06-13 17:47:49'),
(13, 'products', 'products', 'مدیریت محصول', 'محصولات', NULL, 'App\\Product', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"Order\",\"order_display_column\":\"id\",\"order_direction\":\"asc\",\"default_search_key\":\"name\",\"scope\":null}', '2020-04-11 22:14:24', '2020-05-19 19:08:15'),
(15, 'sliders', 'sliders', 'اسلایدر', 'اسلایدر', NULL, 'App\\Slider', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-04-13 12:56:05', '2020-05-17 01:47:15'),
(23, 'filters', 'filters', 'فیلتر', 'فیلترها', 'voyager-thumb-tack', 'App\\Filter', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-04-22 16:59:16', '2020-05-21 15:15:29'),
(25, 'filtervalues', 'filtervalues', 'مقدار فیلتر', 'مقادیر فیلترها', 'voyager-pizza', 'App\\Filtervalue', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-04-23 20:28:15', '2020-04-27 07:15:30'),
(29, 'mostpopulars', 'mostpopulars', 'Mostpopular', 'Mostpopulars', NULL, 'App\\Mostpopular', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"Order\",\"order_display_column\":\"image\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-18 16:49:10', '2020-05-30 05:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `name`, `created_at`, `updated_at`, `slug`) VALUES
(2, 'برند', NULL, NULL, 'brand'),
(4, 'رنگ', NULL, NULL, 'color'),
(5, 'نوع سوخت', NULL, NULL, 'soukht'),
(6, 'کشور سازنده', NULL, NULL, 'country'),
(7, 'سایز', NULL, NULL, 'size'),
(8, 'برچسب مصرف انرژی', NULL, NULL, 'tagEnergy'),
(9, 'توان مصرفی', NULL, NULL, 'tavanMasrafi'),
(12, 'جنسیت', NULL, NULL, 'gener'),
(13, 'تعداد درب', '2020-04-27 14:37:38', '2020-04-27 14:37:38', 'numberOfDoor'),
(16, 'محمد اکبری فیلتری2', '2020-05-21 20:54:17', '2020-05-21 21:40:33', 'mhmd-a-br');

-- --------------------------------------------------------

--
-- Table structure for table `filtervalues`
--

CREATE TABLE `filtervalues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filtervalues`
--

INSERT INTO `filtervalues` (`id`, `filter_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 4, 'سفید', '2020-04-23 13:03:52', '2020-04-23 13:35:46'),
(2, 4, 'قرمز', '2020-04-23 13:04:07', '2020-04-23 13:36:01'),
(3, 7, '32 اینچ', '2020-04-23 13:17:08', '2020-04-23 13:17:08'),
(4, 6, 'ایران', '2020-04-23 20:42:18', '2020-04-23 20:42:18'),
(5, 6, 'چین', '2020-04-23 20:42:29', '2020-04-23 20:42:29'),
(6, 2, 'پارس خزر', '2020-04-23 20:52:47', '2020-04-23 20:52:47'),
(7, 2, 'ال جی', '2020-04-23 20:53:08', '2020-04-23 20:53:08'),
(8, 2, 'سامسونگ', '2020-04-23 20:53:23', '2020-04-23 20:53:23'),
(9, 2, 'هایسنس', '2020-04-23 20:53:38', '2020-04-23 20:53:38'),
(10, 12, 'مرد', '2020-04-25 01:37:58', '2020-04-25 01:37:58'),
(11, 12, 'زن', '2020-04-25 01:38:09', '2020-04-25 01:38:09'),
(12, 9, '50 کیلووات', '2020-04-25 02:08:32', '2020-04-25 02:08:32'),
(14, 8, 'B', '2020-04-25 02:09:13', '2020-04-25 02:09:13'),
(15, 5, 'بنزین', '2020-04-25 02:09:33', '2020-04-25 02:09:33'),
(16, 5, 'گازوییل', '2020-04-25 02:09:55', '2020-04-25 02:09:55'),
(19, 8, 'D', '2020-04-25 02:15:00', '2020-04-25 02:15:22'),
(20, 13, '1', '2020-04-27 14:39:35', '2020-04-27 14:39:35'),
(21, 13, '2', '2020-04-27 14:39:48', '2020-04-27 14:39:48'),
(35, 16, 'م\r', '2020-05-21 21:40:34', '2020-05-21 21:40:34'),
(36, 16, 'ا\r', '2020-05-21 21:40:34', '2020-05-21 21:40:34'),
(37, 16, 'ف', '2020-05-21 21:40:34', '2020-05-21 21:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-04-11 11:41:11', '2020-04-11 11:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'داشبورد', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-04-11 11:41:11', '2020-04-11 11:41:11', 'voyager.dashboard', NULL),
(2, 1, 'چند رسانه ای', '', '_self', 'voyager-images', NULL, NULL, 11, '2020-04-11 11:41:11', '2020-05-21 03:29:23', 'voyager.media.index', NULL),
(3, 1, 'کاربران', '', '_self', 'voyager-person', NULL, NULL, 3, '2020-04-11 11:41:11', '2020-05-21 03:29:22', 'voyager.users.index', NULL),
(4, 1, 'نقش ها', '', '_self', 'voyager-lock', NULL, NULL, 2, '2020-04-11 11:41:11', '2020-05-21 03:29:22', 'voyager.roles.index', NULL),
(5, 1, 'ابزارها', '', '_self', 'voyager-tools', NULL, NULL, 16, '2020-04-11 11:41:11', '2020-05-21 03:29:23', NULL, NULL),
(6, 1, 'منو ساز', '', '_self', 'voyager-list', NULL, 5, 1, '2020-04-11 11:41:12', '2020-04-27 07:19:01', 'voyager.menus.index', NULL),
(7, 1, 'دیتابیس', '', '_self', 'voyager-data', NULL, 5, 2, '2020-04-11 11:41:12', '2020-04-27 07:19:01', 'voyager.database.index', NULL),
(8, 1, 'قطب نما', '', '_self', 'voyager-compass', NULL, 5, 3, '2020-04-11 11:41:12', '2020-04-27 07:19:01', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2020-04-11 11:41:12', '2020-04-27 07:19:01', 'voyager.bread.index', NULL),
(10, 1, 'تنظیمات', '', '_self', 'voyager-settings', NULL, NULL, 18, '2020-04-11 11:41:12', '2020-05-21 03:29:23', 'voyager.settings.index', NULL),
(11, 1, 'دسته بندی ها', '', '_self', 'voyager-categories', NULL, NULL, 13, '2020-04-11 11:41:20', '2020-05-21 03:29:23', 'voyager.categories.index', NULL),
(12, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, NULL, 17, '2020-04-11 11:42:23', '2020-05-21 03:29:23', 'voyager.hooks', NULL),
(14, 1, 'برندها', '', '_self', 'voyager-company', '#000000', NULL, 7, '2020-04-11 20:15:18', '2020-05-21 03:29:23', 'voyager.brands.index', 'null'),
(15, 1, 'پیام های کاربران', '', '_self', 'voyager-heart', '#000000', NULL, 9, '2020-04-11 20:18:05', '2020-05-21 03:29:23', 'voyager.messages.index', 'null'),
(16, 1, 'نظرات', '', '_self', 'voyager-smile', '#000000', NULL, 10, '2020-04-11 20:19:55', '2020-05-21 03:29:23', 'voyager.comments.index', 'null'),
(17, 1, 'پرداخت ها', '', '_self', 'voyager-paypal', '#000000', NULL, 6, '2020-04-11 20:21:20', '2020-05-21 03:29:22', 'voyager.payments.index', 'null'),
(18, 1, 'فروش ها', '', '_self', 'voyager-basket', '#000000', NULL, 5, '2020-04-11 20:31:34', '2020-05-21 03:29:22', 'voyager.sales.index', 'null'),
(20, 1, 'مدیریت محصولات', '', '_self', 'voyager-shop', '#000000', NULL, 4, '2020-04-11 22:14:24', '2020-05-21 03:29:22', 'voyager.products.index', 'null'),
(21, 1, 'اسلایدر', '', '_self', 'voyager-bar-chart', '#000000', NULL, 8, '2020-04-13 12:56:10', '2020-05-21 03:29:23', 'voyager.sliders.index', 'null'),
(22, 1, 'ورودی / خروجی اکسل', 'import-export', '_self', 'voyager-book-download', '#000000', NULL, 12, '2020-04-13 14:09:33', '2020-05-21 03:29:23', NULL, ''),
(30, 1, 'فیلترها', '', '_self', 'voyager-thumb-tack', NULL, NULL, 14, '2020-04-22 16:59:17', '2020-05-21 03:29:23', 'voyager.filters.index', NULL),
(32, 1, 'مقادیر فیلترها', '', '_self', 'voyager-pizza', '#000000', NULL, 15, '2020-04-23 20:28:16', '2020-05-21 03:29:23', 'voyager.filtervalues.index', 'null'),
(36, 1, 'Mostpopulars', '', '_self', NULL, NULL, NULL, 19, '2020-05-18 16:49:11', '2020-05-21 03:29:23', 'voyager.mostpopulars.index', NULL),
(37, 1, 'فیلتر', '', '_self', NULL, '#000000', NULL, 20, '2020-05-21 10:41:35', '2020-05-21 10:41:35', 'voyager.filters.index', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2020_02_22_063632_updateteableusers', 1),
(24, '2020_03_03_154330_create_cache_table', 1),
(25, '2020_03_05_200918_create_notifications_table', 1),
(26, '2020_03_05_220858_create_jobs_table', 1),
(27, '2020_03_19_125147_create_sessions_table', 1),
(28, '2020_03_27_112049_create_product_table', 1),
(29, '2020_03_27_113417_create_brands_table', 1),
(30, '2020_03_27_115719_create_sales_table', 1),
(31, '2020_03_27_131614_Create_payments_table', 1),
(32, '2020_04_09_165820_create_comments_table', 1),
(33, '2020_04_10_155907_create_messages_table', 1),
(34, '2016_01_01_000000_create_pages_table', 2),
(35, '2016_01_01_000000_create_posts_table', 2),
(36, '2016_02_15_204651_create_categories_table', 2),
(37, '2017_04_11_000000_alter_post_nullable_fields_table', 2),
(38, '2020_04_13_171830_create_sliders_table', 3),
(42, '2020_04_22_203617_create_filters_table', 6),
(45, '2020_04_22_203851_create_filtervalues_table', 7),
(48, '2020_04_23_234902_create_productfilters_table', 8),
(49, '2020_04_26_054806_add_featuers_to_products', 9),
(50, '2020_05_07_014721_create_productimages_table', 10),
(51, '2020_05_07_024511_delete_image_product', 10),
(52, '2020_05_18_161100_create_mostpopulars_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mostpopulars`
--

CREATE TABLE `mostpopulars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Order` int(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mablagh` double(8,2) NOT NULL,
  `transId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `mablagh`, `transId`, `cardNumber`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 39600.00, '6224', '123456******1234', '2020-04-11 20:54:11', '2020-04-11 20:54:11', 1),
(2, 125840.00, '6602', '123456******1234', '2020-04-12 12:30:20', '2020-04-12 12:30:20', 1),
(3, 46640.00, '7696', '123456******1234', '2020-04-14 09:03:13', '2020-04-14 09:03:13', 1),
(4, 12125.00, '8706', '123456******1234', '2020-04-22 04:49:00', '2020-04-22 04:49:00', 1),
(5, 12125.00, '8707', '123456******1234', '2020-04-22 04:51:27', '2020-04-22 04:51:27', 1),
(6, 12125.00, '8709', '123456******1234', '2020-04-22 04:53:11', '2020-04-22 04:53:11', 1),
(7, 12125.00, '8714', '123456******1234', '2020-04-22 04:58:29', '2020-04-22 04:58:29', 1),
(8, 44762.00, '1086', '123456******1234', '2020-06-09 05:02:17', '2020-06-09 05:02:17', 1),
(9, 44650.00, '1330', '123456******1234', '2020-06-12 11:15:18', '2020-06-12 11:15:18', 1),
(10, 44650.00, '1335', '123456******1234', '2020-06-12 11:27:26', '2020-06-12 11:27:26', 1),
(11, 65075.00, '1336', '123456******1234', '2020-06-12 11:28:52', '2020-06-12 11:28:52', 1),
(12, 44650.00, '1341', '123456******1234', '2020-06-12 11:42:52', '2020-06-12 11:42:52', 1),
(13, 44650.00, '1342', '123456******1234', '2020-06-12 11:46:56', '2020-06-12 11:46:56', 1),
(14, 56170.00, '1396', '123456******1234', '2020-06-12 13:49:29', '2020-06-12 13:49:29', 1),
(15, 65075.00, '1397', '123456******1234', '2020-06-12 13:52:20', '2020-06-12 13:52:20', 1),
(16, 44650.00, '1399', '123456******1234', '2020-06-12 13:54:37', '2020-06-12 13:54:37', 1),
(17, 65075.00, '1400', '123456******1234', '2020-06-12 13:55:46', '2020-06-12 13:55:46', 1),
(18, 44650.00, '1625', '123456******1234', '2020-06-12 22:29:20', '2020-06-12 22:29:20', 1),
(19, 68500.00, '1789', '123456******1234', '2020-06-13 05:34:45', '2020-06-13 05:34:45', 1),
(20, 30140.00, '1790', '123456******1234', '2020-06-13 05:51:08', '2020-06-13 05:51:08', 1),
(21, 130150.00, '1792', '123456******1234', '2020-06-13 05:59:40', '2020-06-13 05:59:40', 1),
(22, 68500.00, '1796', '123456******1234', '2020-06-13 06:09:55', '2020-06-13 06:09:55', 1),
(23, 89300.00, '82', '123456******1234', '2020-06-13 07:17:35', '2020-06-13 07:17:35', 1),
(24, 44650.00, '83', '123456******1234', '2020-06-13 07:19:25', '2020-06-13 07:19:25', 1),
(25, 68500.00, '84', '123456******1234', '2020-06-13 07:24:31', '2020-06-13 07:24:31', 1),
(26, 44650.00, '85', '123456******1234', '2020-06-13 07:25:41', '2020-06-13 07:25:41', 1),
(27, 44650.00, '86', '123456******1234', '2020-06-13 07:29:40', '2020-06-13 07:29:40', 1),
(28, 267900.00, '87', '123456******1234', '2020-06-13 07:31:54', '2020-06-13 07:31:54', 1),
(29, 44650.00, '88', '123456******1234', '2020-06-13 07:35:12', '2020-06-13 07:35:12', 1),
(30, 44650.00, '89', '123456******1234', '2020-06-13 07:48:23', '2020-06-13 07:48:23', 1),
(31, 89361.70, '92', '123456******1234', '2020-06-13 08:02:29', '2020-06-13 08:02:29', 1),
(32, 44650.00, '247', '123456******1234', '2020-06-13 16:14:49', '2020-06-13 16:14:49', 1),
(33, 44650.00, '250', '123456******1234', '2020-06-13 16:19:07', '2020-06-13 16:19:07', 1),
(34, 44650.00, '251', '123456******1234', '2020-06-13 16:20:07', '2020-06-13 16:20:07', 1),
(35, 44650.00, '260', '123456******1234', '2020-06-13 17:06:10', '2020-06-13 17:06:10', 1),
(36, 44650.00, '263', '123456******1234', '2020-06-13 17:16:29', '2020-06-13 17:16:29', 1),
(37, 68561.70, '264', '123456******1234', '2020-06-13 17:18:30', '2020-06-13 17:18:30', 1),
(38, 44650.00, '269', '123456******1234', '2020-06-13 17:26:35', '2020-06-13 17:26:35', 1),
(39, 44650.00, '273', '123456******1234', '2020-06-13 17:28:27', '2020-06-13 17:28:27', 1),
(40, 30140.00, '274', '123456******1234', '2020-06-13 17:37:50', '2020-06-13 17:37:50', 1),
(41, 44650.00, '1938', '123456******1234', '2020-06-21 09:54:52', '2020-06-21 09:54:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(2, 'browse_bread', NULL, '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(3, 'browse_database', NULL, '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(4, 'browse_media', NULL, '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(5, 'browse_compass', NULL, '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(6, 'browse_menus', 'menus', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(7, 'read_menus', 'menus', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(8, 'edit_menus', 'menus', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(9, 'add_menus', 'menus', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(10, 'delete_menus', 'menus', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(11, 'browse_roles', 'roles', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(12, 'read_roles', 'roles', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(13, 'edit_roles', 'roles', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(14, 'add_roles', 'roles', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(15, 'delete_roles', 'roles', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(16, 'browse_users', 'users', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(17, 'read_users', 'users', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(18, 'edit_users', 'users', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(19, 'add_users', 'users', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(20, 'delete_users', 'users', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(21, 'browse_settings', 'settings', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(22, 'read_settings', 'settings', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(23, 'edit_settings', 'settings', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(24, 'add_settings', 'settings', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(25, 'delete_settings', 'settings', '2020-04-11 11:41:13', '2020-04-11 11:41:13'),
(26, 'browse_categories', 'categories', '2020-04-11 11:41:20', '2020-04-11 11:41:20'),
(27, 'read_categories', 'categories', '2020-04-11 11:41:20', '2020-04-11 11:41:20'),
(28, 'edit_categories', 'categories', '2020-04-11 11:41:20', '2020-04-11 11:41:20'),
(29, 'add_categories', 'categories', '2020-04-11 11:41:20', '2020-04-11 11:41:20'),
(30, 'delete_categories', 'categories', '2020-04-11 11:41:20', '2020-04-11 11:41:20'),
(31, 'browse_hooks', NULL, '2020-04-11 11:42:23', '2020-04-11 11:42:23'),
(37, 'browse_brands', 'brands', '2020-04-11 20:15:18', '2020-04-11 20:15:18'),
(38, 'read_brands', 'brands', '2020-04-11 20:15:18', '2020-04-11 20:15:18'),
(39, 'edit_brands', 'brands', '2020-04-11 20:15:18', '2020-04-11 20:15:18'),
(40, 'add_brands', 'brands', '2020-04-11 20:15:18', '2020-04-11 20:15:18'),
(41, 'delete_brands', 'brands', '2020-04-11 20:15:18', '2020-04-11 20:15:18'),
(42, 'browse_messages', 'messages', '2020-04-11 20:18:04', '2020-04-11 20:18:04'),
(43, 'read_messages', 'messages', '2020-04-11 20:18:05', '2020-04-11 20:18:05'),
(44, 'edit_messages', 'messages', '2020-04-11 20:18:05', '2020-04-11 20:18:05'),
(45, 'add_messages', 'messages', '2020-04-11 20:18:05', '2020-04-11 20:18:05'),
(46, 'delete_messages', 'messages', '2020-04-11 20:18:05', '2020-04-11 20:18:05'),
(47, 'browse_comments', 'comments', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(48, 'read_comments', 'comments', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(49, 'edit_comments', 'comments', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(50, 'add_comments', 'comments', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(51, 'delete_comments', 'comments', '2020-04-11 20:19:55', '2020-04-11 20:19:55'),
(52, 'browse_payments', 'payments', '2020-04-11 20:21:19', '2020-04-11 20:21:19'),
(53, 'read_payments', 'payments', '2020-04-11 20:21:19', '2020-04-11 20:21:19'),
(54, 'edit_payments', 'payments', '2020-04-11 20:21:19', '2020-04-11 20:21:19'),
(55, 'add_payments', 'payments', '2020-04-11 20:21:19', '2020-04-11 20:21:19'),
(56, 'delete_payments', 'payments', '2020-04-11 20:21:19', '2020-04-11 20:21:19'),
(57, 'browse_sales', 'sales', '2020-04-11 20:31:34', '2020-04-11 20:31:34'),
(58, 'read_sales', 'sales', '2020-04-11 20:31:34', '2020-04-11 20:31:34'),
(59, 'edit_sales', 'sales', '2020-04-11 20:31:34', '2020-04-11 20:31:34'),
(60, 'add_sales', 'sales', '2020-04-11 20:31:34', '2020-04-11 20:31:34'),
(61, 'delete_sales', 'sales', '2020-04-11 20:31:34', '2020-04-11 20:31:34'),
(67, 'browse_products', 'products', '2020-04-11 22:14:24', '2020-04-11 22:14:24'),
(68, 'read_products', 'products', '2020-04-11 22:14:24', '2020-04-11 22:14:24'),
(69, 'edit_products', 'products', '2020-04-11 22:14:24', '2020-04-11 22:14:24'),
(70, 'add_products', 'products', '2020-04-11 22:14:24', '2020-04-11 22:14:24'),
(71, 'delete_products', 'products', '2020-04-11 22:14:24', '2020-04-11 22:14:24'),
(72, 'browse_sliders', 'sliders', '2020-04-13 12:56:08', '2020-04-13 12:56:08'),
(73, 'read_sliders', 'sliders', '2020-04-13 12:56:08', '2020-04-13 12:56:08'),
(74, 'edit_sliders', 'sliders', '2020-04-13 12:56:08', '2020-04-13 12:56:08'),
(75, 'add_sliders', 'sliders', '2020-04-13 12:56:08', '2020-04-13 12:56:08'),
(76, 'delete_sliders', 'sliders', '2020-04-13 12:56:08', '2020-04-13 12:56:08'),
(112, 'browse_filters', 'filters', '2020-04-22 16:59:17', '2020-04-22 16:59:17'),
(113, 'read_filters', 'filters', '2020-04-22 16:59:17', '2020-04-22 16:59:17'),
(114, 'edit_filters', 'filters', '2020-04-22 16:59:17', '2020-04-22 16:59:17'),
(115, 'add_filters', 'filters', '2020-04-22 16:59:17', '2020-04-22 16:59:17'),
(116, 'delete_filters', 'filters', '2020-04-22 16:59:17', '2020-04-22 16:59:17'),
(122, 'browse_filtervalues', 'filtervalues', '2020-04-23 20:28:15', '2020-04-23 20:28:15'),
(123, 'read_filtervalues', 'filtervalues', '2020-04-23 20:28:15', '2020-04-23 20:28:15'),
(124, 'edit_filtervalues', 'filtervalues', '2020-04-23 20:28:15', '2020-04-23 20:28:15'),
(125, 'add_filtervalues', 'filtervalues', '2020-04-23 20:28:15', '2020-04-23 20:28:15'),
(126, 'delete_filtervalues', 'filtervalues', '2020-04-23 20:28:15', '2020-04-23 20:28:15'),
(142, 'browse_mostpopulars', 'mostpopulars', '2020-05-18 16:49:10', '2020-05-18 16:49:10'),
(143, 'read_mostpopulars', 'mostpopulars', '2020-05-18 16:49:10', '2020-05-18 16:49:10'),
(144, 'edit_mostpopulars', 'mostpopulars', '2020-05-18 16:49:10', '2020-05-18 16:49:10'),
(145, 'add_mostpopulars', 'mostpopulars', '2020-05-18 16:49:11', '2020-05-18 16:49:11'),
(146, 'delete_mostpopulars', 'mostpopulars', '2020-05-18 16:49:11', '2020-05-18 16:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productfilters`
--

CREATE TABLE `productfilters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filterName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filterValue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productfilters`
--

INSERT INTO `productfilters` (`id`, `filterName`, `filterValue`, `slug`, `product_id`, `created_at`, `updated_at`) VALUES
(136, 'برند', 'پارس خزر', 'brand', 138, '2020-05-09 10:30:37', '2020-05-09 10:30:37'),
(137, 'رنگ', 'سفید', 'color', 138, '2020-05-09 10:30:37', '2020-05-09 10:30:37'),
(138, 'کشور سازنده', 'ایران', 'country', 138, '2020-05-09 10:30:37', '2020-05-09 10:30:37'),
(139, 'برند', 'پارس خزر', 'brand', 145, '2020-05-17 09:02:02', '2020-05-17 09:02:02'),
(140, 'رنگ', 'سفید', 'color', 145, '2020-05-17 09:02:02', '2020-05-17 09:02:02'),
(141, 'نوع سوخت', 'بنزین', 'soukht', 145, '2020-05-17 09:02:02', '2020-05-17 09:02:02'),
(157, 'برند', 'ال جی', 'brand', 172, '2020-05-28 14:16:21', '2020-05-28 14:16:21'),
(158, 'رنگ', 'زرد', 'color', 172, '2020-05-28 14:16:21', '2020-05-28 14:16:21'),
(159, 'برند', 'پارس خزر', 'brand', 173, '2020-05-29 04:47:42', '2020-05-29 04:47:42'),
(160, 'رنگ', 'سفید', 'color', 173, '2020-05-29 04:47:42', '2020-05-29 04:47:42'),
(161, 'کشور سازنده', 'ایران', 'country', 173, '2020-05-29 04:47:42', '2020-05-29 04:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`id`, `image`, `product_id`) VALUES
(26, 'image_resized1589032607.png', 138),
(28, 'image_resized1589035591.png', 138),
(33, 'image_resized1589037908.png', 142),
(34, 'image_resized1589038075.png', 143),
(35, 'image_resized1589038184.png', 144),
(36, 'image_resized1589038983.png', 144),
(37, 'image_resized1589722322.png', 145),
(38, 'hamyarnet1589737653.png', 149),
(39, 'hamyarnet1589747633.png', 150),
(40, 'hamyarnet1589747636.png', 151),
(41, 'hamyarnet1589747639.png', 152),
(42, 'hamyarnet1589747639.png', 153),
(43, 'hamyarnet1589747640.png', 154),
(44, 'hamyarnet1589747641.png', 155),
(45, 'hamyarnet1589747644.png', 156),
(46, 'Capture1589748080.png', 157),
(47, 'Capture1589782297.png', 158),
(48, 'hamyarnet1589782381.png', 159),
(49, 'hamyarnet1589782610.png', 160),
(50, 'hamyarnet1589782794.png', 162),
(51, 'hamyarnet1589784293.png', 163),
(52, 'Capture1589784391.png', 164),
(53, 'hamyarnet1589785533.png', 165),
(54, 'hamyarnet1589786026.png', 166),
(55, 'tahkim1589927884.png', 167),
(56, 'tahkim1589927982.png', 168),
(57, 'tahkim1589928150.png', 169),
(58, 'tahkim1589931030.png', 170),
(59, 'hamyarnet1590681473.png', 172),
(60, 'tahkim1590743863.png', 173),
(61, 'image_resized1590849843.png', 141);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(50) NOT NULL,
  `takhfif` double(8,2) DEFAULT '0.00',
  `catagory1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catagory3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutProduct` longtext COLLATE utf8mb4_unicode_ci,
  `nahvehEstefadeh` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available` int(11) DEFAULT '1',
  `featuers` text COLLATE utf8mb4_unicode_ci,
  `Order` int(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `takhfif`, `catagory1`, `catagory2`, `catagory3`, `company`, `aboutProduct`, `nahvehEstefadeh`, `created_at`, `updated_at`, `available`, `featuers`, `Order`) VALUES
(138, 'اتو نفتی2', 68500, 2.00, 'لوازم منزل', 'یخچال و فریز', 'دوو', 'ننن', 'نتدنم', 'نتئمن', '2020-05-09 09:21:32', '2020-05-19 19:08:29', 5, 'ن\r\nم\r\nن', 13),
(141, 'محمد اکبری16', 5, 5.00, 'تجهیزات آشپزخانه', 'هود', 'دوو', '5', '<p>5</p>\r\n\r\n<p>6</p>', NULL, '2020-05-09 10:53:54', '2020-05-30 14:09:09', 5, '5', 16),
(142, 'محمد اکبری16', 5, 5.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '5', '5', '5', '2020-05-09 10:55:08', '2020-05-19 19:08:30', 5, '5', 17),
(143, 'محمد اکبری16', 5, 5.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '5', '5', '5', '2020-05-09 10:57:55', '2020-05-19 19:08:30', 5, '5', 18),
(144, 'محمد اکبری18', 9, 9.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '9', '9', '9', '2020-05-09 10:59:44', '2020-05-19 19:08:30', 9, '9', 19),
(145, 'محمد اکبری', 850000, 87.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjk', 'kljl', NULL, '2020-05-17 09:02:02', '2020-05-19 19:08:30', 5, 'lkjkl\r\nlkvlf\r\nkfdlv', 20),
(146, 'محمد اکبری', 56987755, 12.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjndk', 'برای استفاده در افتاب تند تابستان', NULL, '2020-05-17 13:08:49', '2020-05-19 19:08:30', 89, NULL, 21),
(147, 'محمد اکبری', 56987755, 12.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjndk', 'برای استفاده در افتاب تند تابستان', NULL, '2020-05-17 13:11:39', '2020-05-19 19:08:30', 89, NULL, 22),
(148, 'محمد اکبری', 56987755, 12.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjndk', 'برای استفاده در افتاب تند تابستان', NULL, '2020-05-17 13:14:28', '2020-05-19 19:08:30', 89, NULL, 23),
(149, 'محمد اکبری55', 68500, 5.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjndk', 'برای استفاده در افتاب تند تابستان', NULL, '2020-05-17 13:17:33', '2020-06-12 13:52:20', 42, NULL, 24),
(150, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:03:53', '2020-05-19 19:08:30', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 25),
(151, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:03:56', '2020-05-19 19:08:30', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 26),
(152, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:03:57', '2020-05-19 19:08:30', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 27),
(153, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:03:59', '2020-05-19 19:08:31', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 28),
(154, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:03:59', '2020-05-19 19:08:31', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 29),
(155, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:04:00', '2020-05-19 19:08:31', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 30),
(156, 'اتو99', 56, 3.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', '3', 'بت', NULL, '2020-05-17 16:04:04', '2020-05-19 19:08:31', 5, '1\r\nبب\r\nب\r\nبی\r\nبب', 31),
(157, 'اتو 90', 68500, 18.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 'kjndk', 'برای ضد عفونی', NULL, '2020-05-17 16:11:20', '2020-06-12 13:49:29', 8, NULL, 32),
(158, 'محمد اکبری65', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 01:41:37', '2020-05-19 19:08:31', 89, NULL, 33),
(159, 'محمد اکبری652', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 01:43:01', '2020-05-19 19:08:31', 89, NULL, 34),
(160, 'محمد اکبری6525', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 01:46:50', '2020-05-19 19:08:31', 89, NULL, 35),
(161, 'محمد اکبری6525', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 01:48:26', '2020-05-19 19:08:31', 89, NULL, 36),
(162, 'محمد اکبری6525', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 01:49:54', '2020-05-19 19:08:31', 89, NULL, 37),
(163, 'ادامه دار', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 02:14:53', '2020-05-19 19:08:31', 37, NULL, 38),
(164, 'ادامه دار', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 02:16:31', '2020-05-19 19:08:31', 37, NULL, 39),
(165, 'محمد اکبری', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-18 02:35:32', '2020-06-13 17:18:30', 8, NULL, 40),
(166, 'محمد اکبریp', 56, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, '<p>یک محصول خیلی خوب می باشد .</p><h1>یک محصول خیلی خوب می باشد.</h1><h3>ینبتینبتیبتینب</h3>', NULL, '2020-05-18 02:43:46', '2020-06-09 05:02:16', 87, NULL, 41),
(167, 'محمد اکبری', 68500, 56.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, '<p>یک محصول خیلی خوب می باشد .</p>\r\n\r\n<h1>یک محصول خیلی خوب می باشد.</h1>\r\n\r\n<h3>ینبتینبتیبتینب</h3>', NULL, '2020-05-19 18:08:03', '2020-06-13 17:37:50', 87, NULL, 42),
(168, 'محمد اکبریg', 68500, 5.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-19 18:09:41', '2020-06-13 05:59:40', 5, NULL, 45),
(169, 'محمد اکبری', 68500, NULL, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, NULL, NULL, '2020-05-19 18:12:30', '2020-06-13 07:24:31', 86, NULL, 44),
(170, 'محمد اکبری جدید', 1235, 95.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, '<p>یک محصول خیلی خوب می باشد .</p>\r\n\r\n<h1>یک محصول خیلی خوب می باشد.</h1>\r\n\r\n<h3>ینبتینبتیبتینب</h3>\r\n\r\n<p>ئتیمنبتیمنبتینمتبمنسیتبمسیکشبسی</p>', NULL, '2020-05-19 19:00:29', '2020-06-13 17:18:30', 87, '1\r\n2\r\n3', 43),
(172, 'ابگرمکن خورشیدی', 47000, 5.00, 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', NULL, '<p>دربازه محصول</p>', NULL, '2020-05-28 11:27:53', '2020-06-21 09:54:52', 12, '1\r\n2\r\n3', NULL),
(173, 'سینک دوقلو', 68500, 18.00, 'تجهیزات آشپزخانه', 'سینک', NULL, NULL, '<p>خیلی خوب</p>', NULL, '2020-05-29 04:47:42', '2020-05-29 04:47:55', 89, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ادمین', '2020-04-11 11:41:12', '2020-04-11 11:41:12'),
(2, 'user', 'کاربر عادی', '2020-04-11 11:41:12', '2020-04-11 11:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catagory3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `number` int(11) NOT NULL,
  `takhfif` int(11) DEFAULT '0',
  `transId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namegirandeh` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kodemelli` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `catagory1`, `catagory2`, `catagory3`, `price`, `number`, `takhfif`, `transId`, `date`, `created_at`, `updated_at`, `user_id`, `product_id`, `address`, `namegirandeh`, `mobile`, `kodemelli`, `status`) VALUES
(32, 'محمد اکبری', 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 68500.00, 1, NULL, '264', NULL, '2020-06-13 17:18:30', '2020-06-13 19:03:04', 1, 165, 'استان: فارس شهرستان : نی‌ریزنشانی : خیابان بهداشت پلاک : 54 واحد : 1   کد پستی : 85587', 'سعید قنبری', '0917', '25500', 'تکمیل سفارش'),
(33, 'ابگرمکن خورشیدی', 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 47000.00, 1, 5, '269', NULL, '2020-06-13 17:26:35', '2020-06-13 17:26:35', 1, 172, 'استان: فارس شهرستان : نی‌ریزنشانی : خیابان بهداشت پلاک : 54 واحد : 1   کد پستی : 85587', 'سعید قنبری', '0917', '25500', 'در حال پردازش'),
(34, 'ابگرمکن خورشیدی', 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 47000.00, 1, 5, '273', NULL, '2020-06-13 17:28:27', '2020-06-13 17:28:27', 1, 172, 'استان: فارس شهرستان : نی‌ریزنشانی : خیابان بهداشت پلاک : 54 واحد : 1   کد پستی : 85587', 'سعید قنبری', '0917', '25500', 'در حال پردازش'),
(35, 'محمد اکبری', 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 68500.00, 1, 56, '274', NULL, '2020-06-13 17:37:50', '2020-06-13 18:59:02', 1, 167, 'استان: فارس شهرستان : نی‌ریزنشانی : خیابان بهداشت خیابان نواب پلاک : 54 واحد : 1   کد پستی : 85587', 'سعید قنبری', '0917', '25500', 'تکمیل سفارش'),
(36, 'ابگرمکن خورشیدی', 'لوازم بزرگ آشپزخانه', 'یخچال و فریز', 'دوو', 47000.00, 1, 5, '1938', NULL, '2020-06-21 09:54:51', '2020-06-21 09:54:51', 1, 172, 'استان: فارس شهرستان : نی‌ریزنشانی : خیابان بهداشت پلاک : 54 واحد : 1   کد پستی : 85587', 'سعید قنبری', '0917', '25500', 'در حال پردازش');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'عنوان سایت', 'عنوان سایت', '', 'text', 1, 'Site'),
(2, 'site.description', 'شرح مختصر فعالیت سایت', 'شرح مختصر فعالیت سایت', '', 'text', 2, 'Site'),
(3, 'site.logo', 'لوگوی سایت', 'settings\\May2020\\sC9KjPSFqL9w5vcE9gNo.jpg', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'شناسه رهگیری گوگل آنالیز', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'تصویر پس زمینه برای ادمین', 'settings\\April2020\\9j0vpVvgi3YNynTGB13X.jpg', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'عنوان ادمین', 'داشبورد', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'توضیحات ادمین', 'به پنل مدیریت فروشگاه اینترنتی خوش آمدید', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'لودر ادمین', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'تصویر آیکون ادمین', 'settings\\April2020\\8P3uftjESIp7AZbkHnRF.jpg', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'شناسه گوگل انالیز (برای داشبورد ادمین مورد استفاده قرار می گیرد)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageAddress` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `imageAddress`, `created_at`, `updated_at`) VALUES
(8, 'sliders\\May2020\\789pWHouH1xJJxELy1Wn.jpg', '2020-05-17 01:47:31', '2020-05-17 01:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gener` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shoghl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahsilat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahalZendegi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahalTavalod` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ostan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neshaniposti` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pelak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vahed` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kodeposti` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kodemelli` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `age`, `gener`, `shoghl`, `tahsilat`, `mahalZendegi`, `mahalTavalod`, `mobile`, `email`, `avatar`, `email_verified_at`, `password`, `api_token`, `remember_token`, `settings`, `created_at`, `updated_at`, `ostan`, `city`, `neshaniposti`, `pelak`, `vahed`, `kodeposti`, `kodemelli`) VALUES
(1, 1, 'سعید قنبری', 18, 'مرد', 'برنامه نویس', 'لیسانس', 'نی ریز خبابان بهداشت', NULL, '0917', 'sghanbari1990@gmail.com', 'users\\April2020\\BamVbytZiUnG3if2f8PX.jpg', NULL, '$2y$10$b9ILmDfjPXQHLJawT/05a.CwY9vfpocVsxbqoWaX5ApLs/o5kpORG', 'GUBuEdO1LyRwb4AbGB1HYtChP2Sgk5uwRSjtp0yNQBxfnayVm01zSBi9vzywXeMJzIAuj4DDTtl0jxYU', 'Z7cl9nVxBzXOhCvaGePYciTe43sqFpIqGUR0RZ47oIx0ssAhrQVqPuC1gMpO', '{\"locale\":\"fa\"}', '2020-04-11 11:48:59', '2020-06-09 03:59:04', 'فارس', 'نی‌ریز', 'خیابان بهداشت', '54', '1', '85587', '25500'),
(3, 2, 'امیر نظری', 25, 'مرد', 'برنامه نویس', 'لیسانس', 'شیراز خیابان مدرس', 'شیراز', '09389706286', 'amirnazari500@gmail.com', 'users/default.png', NULL, '$2y$10$mh5WEZ.2ljPLXA3IC4CED.Ag48y2dgfZHhJ/1igxFls2QBq.H257y', 'ChtefQ2QZ9sGgYlteCg3kGrbVasxFqAu10KgRT6auMJWQOS5MMiR9UJQttUrp7UjiHNWl02VyT4l6B5w', NULL, NULL, '2020-04-13 16:06:22', '2020-04-13 16:06:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'محمد', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mohammad@gmail.com', 'users/default.png', NULL, '$2y$10$zI6J1IPsip4rfDxSElsw.u4cC0f4Wc0Ncwo1sw4y5P9D13GrwxZH.', NULL, NULL, '{\"locale\":\"fa\"}', '2020-05-06 10:15:44', '2020-05-06 10:15:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `filtervalues`
--
ALTER TABLE `filtervalues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filtervalues_filter_id_foreign` (`filter_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mostpopulars`
--
ALTER TABLE `mostpopulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mostpopulars_product_id_foreign` (`product_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `productfilters`
--
ALTER TABLE `productfilters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productfilters_product_id_foreign` (`product_id`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productimages_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_product_id_foreign` (`product_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `filtervalues`
--
ALTER TABLE `filtervalues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `mostpopulars`
--
ALTER TABLE `mostpopulars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productfilters`
--
ALTER TABLE `productfilters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filtervalues`
--
ALTER TABLE `filtervalues`
  ADD CONSTRAINT `filtervalues_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mostpopulars`
--
ALTER TABLE `mostpopulars`
  ADD CONSTRAINT `mostpopulars_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productfilters`
--
ALTER TABLE `productfilters`
  ADD CONSTRAINT `productfilters_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
