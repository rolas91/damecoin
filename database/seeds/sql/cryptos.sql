-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2020 at 09:03 PM
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
-- Dumping data for table `cryptos`
--

INSERT INTO `cryptos` (`id`, `name`, `img`, `maker_fee`, `taker_fee`, `code`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bitcoin (BTC)', '1566955746.png', 0.01, 0.01, 'BTC', 1, '2019-08-28 05:12:34', '2020-03-18 18:02:43', NULL),
(2, 'Litecoin (LTC)', '1566955846.png', 0.01, 0.01, 'LTC', 1, '2019-08-28 05:12:34', '2020-03-18 18:15:52', NULL),
(3, 'Ethereum (ETH)', '1566955858.png', 0.01, 0.01, 'ETH', 1, '2019-08-28 05:12:34', '2020-03-18 18:16:54', NULL),
(5, 'Plata (SILVER)', '1567352151.jpg', 0.01, 0.01, 'SILVER', 1, '2019-09-01 13:35:51', '2020-03-18 18:17:10', NULL),
(6, 'Ripple (XRP)', '1567354133.jpg', 0.01, 0.01, 'XRP', 1, '2019-09-01 13:59:34', '2020-03-18 18:17:36', NULL),
(7, 'Bitcoin Cash (BCH)', '1567354525.jpg', 0.01, 0.01, 'BCH', 1, '2019-09-01 14:15:25', '2020-03-18 18:17:54', NULL),
(8, 'Eos (EOS)', '1567363771.jpg', 0.01, 0.01, 'EOS', 1, '2019-09-01 16:49:31', '2020-03-18 18:18:46', NULL),
(9, 'Tether (USDT)', '1567364535.jpg', 0.01, 0.01, 'USDT', 1, '2019-09-01 17:02:15', '2020-03-18 18:18:59', NULL),
(10, 'Stellar (XLM)', '1567365710.jpg', 0.01, 0.01, 'XLM', 1, '2019-09-01 17:21:50', '2020-03-18 18:19:11', NULL),
(11, 'Cardano (ADA)', '1567366001.jpg', 0.01, 0.01, 'ADA', 1, '2019-09-01 17:26:41', '2020-03-18 18:19:28', NULL),
(12, 'Tron (TRX)', '1567366241.jpg', 0.01, 0.01, 'TRX', 1, '2019-09-01 17:30:41', '2020-03-18 18:20:05', NULL),
(13, 'Etherium Classic (ETC)', '1567367427.jpg', 0.01, 0.01, 'ETC', 1, '2019-09-01 17:50:27', '2020-03-18 18:20:21', NULL),
(14, 'Dash (DASH)', '1567367691.jpg', 0.01, 0.01, 'DASH', 1, '2019-09-01 17:54:51', '2020-03-18 18:20:34', NULL),
(15, 'Iota (MIOTA)', '1567372102.jpg', 0.01, 0.01, 'MIOTA', 1, '2019-09-01 19:08:22', '2020-03-18 18:20:49', NULL),
(16, 'Tezos (XTZ)', '1567372313.jpg', 0.01, 0.01, 'XTZ', 1, '2019-09-01 19:11:53', '2020-03-18 18:21:01', NULL),
(17, 'Chainlink (LINK)', '1567372586.jpg', 0.01, 0.01, 'LINK', 1, '2019-09-01 19:16:26', '2020-03-18 18:21:16', NULL),
(18, 'Neo (NEO)', '1567373588.jpg', 0.01, 0.01, 'NEO', 1, '2019-09-01 19:33:08', '2020-03-18 18:21:27', NULL),
(19, 'Usd Coin (USDC)', '1567373797.jpg', 0.01, 0.01, 'USDC', 1, '2019-09-01 19:36:37', '2020-03-18 18:21:41', NULL),
(20, 'Nem (XEM)', '1567374034.jpg', 0.01, 0.01, 'XEM', 1, '2019-09-01 19:40:34', '2020-03-18 18:21:54', NULL),
(21, 'Cosmos (ATOM)', '1567375179.jpg', 0.01, 0.01, 'ATOM', 1, '2019-09-01 19:59:39', '2020-03-18 18:22:16', NULL),
(22, 'Zcash (ZEC)', '1567375410.jpg', 0.01, 0.01, 'ZEC', 1, '2019-09-01 20:03:30', '2020-03-18 18:22:53', NULL),
(23, 'Basic Attention Token (BAT)', '1567375659.jpg', 0.01, 0.01, 'BAT', 1, '2019-09-01 20:07:39', '2020-03-18 18:23:04', NULL),
(24, 'Omisego (OMG)', '1567377524.jpg', 0.01, 0.01, 'OMG', 1, '2019-09-01 20:38:44', '2020-03-18 18:23:58', NULL),
(25, 'Lisk (LSK)', '1567377662.jpg', 0.01, 0.01, 'LSK', 1, '2019-09-01 20:41:02', '2020-03-18 18:24:10', NULL),
(26, 'Waves (WAVES)', '1567379453.jpg', 0.01, 0.01, 'WAVES', 1, '2019-09-01 21:10:53', '2020-03-18 18:24:20', NULL),
(27, 'Ox (ZRX)', '1567379631.jpg', 0.01, 0.01, 'ZRX', 1, '2019-09-01 21:13:51', '2020-03-18 18:24:32', NULL),
(28, 'Augur (REP)', '1567379894.jpg', 0.01, 0.01, 'REP', 1, '2019-09-01 21:18:14', '2020-03-18 18:24:49', NULL),
(29, 'Komodo (KMD)', '1567380040.jpg', 0.01, 0.01, 'KMD', 1, '2019-09-01 21:20:40', '2020-03-18 18:25:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cryptos`
--
ALTER TABLE `cryptos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cryptos_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cryptos`
--
ALTER TABLE `cryptos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
