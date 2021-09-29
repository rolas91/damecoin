-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2020 at 08:43 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `isoCountry`, `status`, `secure`, `idioma`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'USD', 'USD', '$', 'US', 1, 1, 'en', '2019-08-28 05:12:34', '2020-02-24 12:39:10', NULL),
(2, 'EUR', 'EUR', '€', 'ES', 1, 1, 'es', '2019-08-28 05:12:34', '2019-10-25 12:35:14', NULL),
(3, 'COP', 'Colombia(pesos)', 'COP', 'CO', 1, 1, 'es', '2019-08-28 05:12:34', '2020-03-13 18:33:27', NULL),
(4, 'CLP', 'Chile (pesos)', 'CLP', 'CL', 1, 1, 'es', '2019-08-28 05:12:34', '2020-03-13 18:33:36', NULL),
(5, 'ARS', 'Argentina (pesos)', 'ARS', 'AR', 1, 1, 'es', '2019-08-28 05:12:34', '2020-03-13 18:33:47', NULL),
(6, 'MXN', 'México (pesos)', 'MXN', 'MX', 1, 1, 'es', '2019-08-28 05:12:34', '2020-03-13 18:33:55', NULL),
(7, 'PEN', 'Perú (soles)', 'PEN', 'PE', 1, 1, 'es', '2019-08-29 22:26:22', '2020-03-13 18:34:05', NULL),
(8, 'BOB', 'Bolivia (boliviano)', 'BOB', 'BO', 1, 1, 'es', '2019-08-31 16:23:53', '2020-03-13 18:34:15', NULL),
(9, 'BRL', 'Brasil (real)', 'BRL', 'BR', 1, 1, 'pt', '2019-08-31 16:31:34', '2020-04-02 14:22:36', NULL),
(10, 'CRC', 'Costa Rica (Colón)', 'CRC', 'CR', 1, 1, 'es', '2019-08-31 16:35:01', '2020-03-13 18:34:33', NULL),
(11, 'GTQ', 'Guatemala (Quetzal)', 'GTQ', 'GT', 1, 1, 'es', '2019-08-31 16:38:36', '2020-03-13 18:34:46', NULL),
(14, 'HNL', 'Honduras (Lempira)', 'HNL', 'HN', 1, 1, 'es', '2019-08-31 16:55:33', '2020-03-13 18:34:56', NULL),
(15, 'NIO', 'Nicaragua (Córdoba)', 'NIO', 'NI', 1, 1, 'es', '2019-08-31 20:11:42', '2020-03-13 18:35:06', NULL),
(24, 'PYG', 'Paraguay (Guaraní)', 'PYG', 'PR', 1, 1, 'es', '2019-08-31 20:20:11', '2020-03-13 18:35:18', NULL),
(25, 'DOP', 'Rep. Dominicana (pesos)', 'DOP', 'DO', 1, 1, 'es', '2019-08-31 20:43:21', '2020-03-13 18:35:28', NULL),
(26, 'GBP', 'United Kingdom (GBP)', '£', 'GB', 1, 1, 'en', '2019-08-31 20:48:43', '2020-04-02 14:23:28', NULL),
(27, 'UYU', 'Uruguay (peso)', 'UYU', 'UR', 1, 1, 'es', '2019-08-31 21:04:43', '2020-03-13 18:35:54', NULL),
(28, 'AUD', 'Australian dolar (AUD)', 'AUD', 'AU', 1, 1, 'en', '2019-08-31 21:24:52', '2020-03-13 18:36:04', NULL),
(29, 'CAD', 'Canadian dollar (CAD)', 'CA$', 'CA', 1, 1, 'en', '2019-08-31 21:38:16', '2020-03-13 18:36:17', NULL),
(30, 'CNY', 'Chinese Yuan RMB人民币 (CNY)', 'CNY', 'CN', 1, 1, 'ch', '2019-08-31 22:18:22', '2020-03-13 18:38:19', NULL),
(31, 'CZK', 'Czech Koruna (CZK)', 'Kč', 'CZ', 1, 1, 'cz', '2019-08-31 22:23:31', '2020-03-13 18:37:33', NULL),
(32, 'CKK', 'Czech Koruna (CZK)', 'CKK', 'DN', 1, 1, 'cz', '2019-08-31 22:31:53', '2020-04-02 14:24:46', NULL),
(33, 'HKD', 'Hong Kong dollar (HKD)', 'HKD', 'CH', 1, 1, 'ch', '2019-08-31 22:53:19', '2020-04-02 14:24:53', NULL),
(34, 'HUF', 'Hungarian Forint (HUF)', 'HUF', 'HU', 1, 1, 'en', '2019-08-31 23:09:32', '2020-03-13 18:38:34', NULL),
(35, 'INR', 'Indian rupee (INR)', 'INR', 'IN', 1, 1, 'hi', '2019-08-31 23:12:02', '2020-04-02 14:25:13', NULL),
(36, 'IDR', 'Indonesian Rupiah (IDR)', 'IDR', 'ID', 1, 1, 'en', '2019-08-31 23:14:20', '2020-03-13 18:39:04', NULL),
(37, 'PHP', 'Philippine peso (PHP)', 'PHP', 'PH', 1, 1, 'en', '2019-08-31 23:36:53', '2020-03-13 18:39:23', NULL),
(38, 'PLN', 'Polish zloty (PLN)', 'PLN', 'PO', 1, 1, 'en', '2019-08-31 23:40:28', '2020-03-13 18:39:38', NULL),
(39, 'RUB', 'Russian ruble (RUB)', 'RUB', 'RU', 1, 1, 'ru', '2019-08-31 23:42:54', '2020-03-13 18:39:50', NULL),
(40, 'SGD', 'Singapore dollar (SGD)', 'SGD', 'SG', 1, 1, 'en', '2019-09-01 00:05:44', '2020-03-13 18:41:53', NULL),
(41, 'ZAR', 'South African rand (ZAR)', 'ZAR', 'ZA', 1, 1, 'en', '2019-09-01 00:25:31', '2020-03-13 18:42:09', NULL),
(42, 'SEK', 'Swedish krona (SEK)', 'SEK', 'SW', 1, 1, 'en', '2019-09-01 00:41:30', '2020-03-13 18:42:28', NULL),
(43, 'CHF', 'Swiss franc (CHF)', 'CHF', 'CH', 1, 1, 'en', '2019-09-01 00:45:02', '2020-03-13 18:42:51', NULL),
(44, 'TWD', 'Taiwan dollar (TWD)', 'TWD', 'TW', 1, 1, 'ch', '2019-09-01 00:52:16', '2020-04-02 14:26:27', NULL),
(45, 'THB', 'Thai bath (THB)', '฿', 'TH', 1, 1, 'th', '2019-09-01 00:58:12', '2020-03-13 18:43:56', NULL),
(46, 'TRY', 'Turkish lira (TRY)', 'TRY', 'TU', 1, 1, 'en', '2019-09-01 01:00:29', '2020-03-13 18:44:16', NULL),
(47, 'ILS', 'Israel New Shekel (ILS)', 'ILS', 'IS', 1, 1, 'en', '2019-09-01 21:46:39', '2020-03-13 18:44:33', NULL),
(48, 'JPY', 'Japanese Yen (JPY)', 'JPY', 'JP', 1, 1, 'jp', '2019-09-01 21:54:31', '2020-03-13 18:44:43', NULL),
(49, 'KRW', 'Korean won (KRW)', 'KRW', 'KO', 1, 1, 'kr', '2019-09-01 22:00:00', '2020-04-02 14:27:08', NULL),
(50, 'MYR', 'Malaysian ringgit (MYR)', 'MYR', 'MY', 1, 1, 'en', '2019-09-01 22:01:44', '2020-03-13 18:45:17', NULL),
(51, 'EUR', 'EUR', '€', 'FR', 1, 1, 'fr', '2019-10-25 13:03:09', '2019-10-25 13:03:09', NULL),
(52, 'EUR', 'EUR', '€', 'IT', 1, 1, 'it', '2019-12-30 02:48:05', '2019-12-30 02:48:05', NULL),
(53, 'AED', 'Dírham Arab Emirates (AED)', 'درهم', 'AE', 1, 1, 'ae', '2020-03-26 17:52:31', '2020-03-26 18:00:55', NULL),
(54, 'INR', 'Rupia india(INR)', '₹', 'HI', 1, 1, 'hi', '2020-03-26 18:18:56', '2020-03-26 18:18:56', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
