-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: פברואר 27, 2019 בזמן 09:32 AM
-- גרסת שרת: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moshehasapar`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `admin_change`
--

DROP TABLE IF EXISTS `admin_change`;
CREATE TABLE IF NOT EXISTS `admin_change` (
  `day` date NOT NULL,
  `day_start` time NOT NULL,
  `day_end` time NOT NULL,
  `admin_message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `day` (`day`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- הוצאת מידע עבור טבלה `admin_change`
--

INSERT INTO `admin_change` (`day`, `day_start`, `day_end`, `admin_message`) VALUES
('2019-02-24', '04:00:00', '20:00:00', ''),
('2019-02-25', '03:02:00', '16:00:00', ''),
('2019-02-26', '03:00:00', '21:00:00', ''),
('2019-02-27', '13:00:00', '14:00:00', ''),
('2019-02-23', '02:00:00', '18:00:00', ''),
('2019-02-22', '09:00:00', '15:00:00', ''),
('2019-02-19', '09:00:00', '18:00:00', ''),
('2019-02-21', '09:00:00', '17:00:00', ''),
('2019-03-05', '15:00:00', '23:00:00', ''),
('2019-03-04', '11:00:00', '17:00:00', ''),
('2019-03-03', '09:00:00', '11:00:00', ''),
('2019-02-28', '09:00:00', '18:00:00', ''),
('2019-02-20', '10:00:00', '21:00:00', ''),
('2019-03-01', '11:00:00', '14:00:00', ''),
('2019-03-31', '09:00:00', '20:00:00', ''),
('2019-03-30', '00:00:00', '02:00:00', ''),
('2019-03-22', '09:00:00', '13:00:00', ''),
('2019-03-20', '09:00:00', '17:00:00', ''),
('2019-03-21', '09:00:00', '19:00:00', ''),
('2019-04-01', '10:00:00', '16:00:00', '');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- הוצאת מידע עבור טבלה `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `phone_number`) VALUES
(4, 'amir3', 'jaffailana3@gmail.com', '$2y$10$/Zt25hDA4Xj8aTEWi2bH5ek9hFRNqJpiyi/oqFaUW5g4e40D29hHa', '3332583257'),
(5, 'amir4', 'jaffailana4@gmail.com', '$2y$10$klILwVRo2XeEODiibE1z0OxIoOXjQ30dnBj7p5.Fskg83oo.XqgLW', '4444583257'),
(8, 'mosheAdmin', 'wqdad@daa.com', '$2y$10$6rXLzSCzBCwQAMuW5jnLB.NYEJZy7ZusyaXe9QWuAco18kG7hvDXe', '0584257119'),
(9, 'amir11', 'jaffailana@gmail.com11', '$2y$10$NLJ6Z6oW/hswufuIfRVw5.aKf9zce5zxYyr53hzbFzKvHHf8fpQvC', '1111115832'),
(10, 'adasdxc', 'wqdaxd@daa.com', '$2y$10$W0w/i7S0yksCEIwDbWnq.OQb5sbscsWKaIJFGk4x6aHhQp.XPHPDe', '442583257'),
(11, 'amir6', 'jaffailan6@gmail.com', '$2y$10$qeGNb0dihRnCkRevQED/Eewulm5MgzDiCUX3JZjxRyKJ5TDLYY/7q', '6683257119'),
(12, 'aharon', 'aharon@ovits.com', '$2y$10$mB2DoFQ2ZAvILY9wO0hGqusy20ptjVNEq061dW.XCBl3IhFSCjQvy', '12341234');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL,
  `time` time NOT NULL,
  `customer` int(25) NOT NULL,
  `order_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `customer` (`customer`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- הוצאת מידע עבור טבלה `orders`
--

INSERT INTO `orders` (`order_id`, `day`, `time`, `customer`, `order_time`) VALUES
(1, '2019-02-26', '05:40:00', 8, '2019-02-26 12:22:05'),
(2, '2019-02-26', '00:00:00', 8, '2019-02-26 12:22:07'),
(3, '2019-02-26', '07:00:00', 8, '2019-02-26 12:22:10'),
(4, '2019-02-26', '07:20:00', 8, '2019-02-26 12:22:12'),
(5, '2019-02-26', '06:40:00', 8, '2019-02-26 12:22:16'),
(6, '2019-02-26', '07:40:00', 8, '2019-02-26 12:22:19'),
(7, '2019-02-26', '08:00:00', 8, '2019-02-26 12:22:21'),
(8, '2019-02-26', '08:40:00', 9, '2019-02-26 12:22:23'),
(9, '2019-02-26', '09:00:00', 9, '2019-02-26 12:22:27'),
(10, '2019-02-26', '09:20:00', 9, '2019-02-26 12:22:29'),
(11, '2019-02-26', '09:40:00', 9, '2019-02-26 12:22:33'),
(12, '2019-02-26', '10:00:00', 9, '2019-02-26 12:22:35'),
(13, '2019-02-26', '10:20:00', 9, '2019-02-26 12:22:37'),
(14, '2019-02-26', '10:40:00', 9, '2019-02-26 12:22:40'),
(15, '2019-02-26', '11:00:00', 9, '2019-02-26 12:22:42'),
(16, '2019-02-26', '11:40:00', 9, '2019-02-26 12:22:46'),
(17, '2019-02-26', '12:20:00', 9, '2019-02-26 12:22:48'),
(18, '2019-02-26', '12:40:00', 9, '2019-02-26 12:22:51'),
(19, '2019-02-26', '13:00:00', 9, '2019-02-26 12:22:55'),
(20, '2019-02-26', '14:20:00', 9, '2019-02-26 12:23:02'),
(21, '2019-02-26', '14:40:00', 9, '2019-02-26 12:23:05'),
(22, '2019-02-26', '15:00:00', 9, '2019-02-26 12:23:08'),
(23, '2019-02-26', '15:40:00', 9, '2019-02-26 12:23:12'),
(24, '2019-02-26', '18:00:00', 9, '2019-02-26 12:23:16'),
(25, '2019-02-26', '18:20:00', 9, '2019-02-26 12:23:21'),
(27, '2019-02-28', '09:40:00', 9, '2019-02-26 12:24:14'),
(28, '2019-02-28', '10:00:00', 9, '2019-02-26 12:24:16'),
(29, '2019-02-28', '11:00:00', 9, '2019-02-26 12:24:19'),
(30, '2019-02-28', '11:20:00', 9, '2019-02-26 12:24:21'),
(31, '2019-02-28', '11:40:00', 9, '2019-02-26 12:24:23'),
(32, '2019-02-28', '12:20:00', 9, '2019-02-26 12:24:26'),
(33, '2019-02-28', '12:40:00', 9, '2019-02-26 12:24:28'),
(34, '2019-02-28', '13:00:00', 9, '2019-02-26 12:24:32'),
(35, '2019-02-28', '13:20:00', 9, '2019-02-26 12:24:34'),
(36, '2019-02-28', '14:00:00', 9, '2019-02-26 12:24:36'),
(37, '2019-02-28', '14:20:00', 9, '2019-02-26 12:24:39'),
(38, '2019-02-28', '14:40:00', 9, '2019-02-26 12:24:42'),
(39, '2019-02-28', '15:20:00', 9, '2019-02-26 12:24:45'),
(40, '2019-02-28', '15:40:00', 9, '2019-02-26 12:24:49'),
(41, '2019-02-28', '16:00:00', 9, '2019-02-26 12:24:52'),
(42, '2019-02-26', '08:20:00', 8, '2019-02-26 14:13:21'),
(43, '2019-02-26', '16:00:00', 8, '2019-02-26 20:59:42'),
(44, '2019-02-26', '14:00:00', 8, '2019-02-26 20:59:57'),
(45, '2019-02-26', '13:40:00', 8, '2019-02-26 21:00:23'),
(46, '2019-02-26', '13:20:00', 8, '2019-02-26 21:00:34'),
(47, '2019-02-26', '06:20:00', 8, '2019-02-26 21:08:29'),
(48, '2019-02-26', '06:20:00', 8, '2019-02-26 21:08:36'),
(49, '2019-02-26', '06:00:00', 8, '2019-02-26 21:09:18'),
(50, '2019-02-26', '05:20:00', 8, '2019-02-26 21:09:21'),
(51, '2019-02-26', '03:20:00', 8, '2019-02-26 21:09:24'),
(52, '2019-02-26', '05:00:00', 8, '2019-02-26 21:09:26'),
(55, '2019-02-26', '04:40:00', 8, '2019-02-26 21:09:41'),
(56, '2019-02-26', '03:40:00', 8, '2019-02-26 21:12:59'),
(57, '2019-02-26', '03:00:00', 8, '2019-02-26 21:14:23'),
(58, '2019-02-26', '04:20:00', 8, '2019-02-26 21:14:45'),
(59, '2019-02-26', '11:20:00', 8, '2019-02-26 21:28:11'),
(60, '2019-02-26', '04:00:00', 8, '2019-02-26 21:28:46'),
(61, '2019-02-26', '12:00:00', 8, '2019-02-26 21:28:55'),
(62, '2019-02-26', '15:20:00', 8, '2019-02-26 21:31:57'),
(63, '2019-02-26', '17:40:00', 8, '2019-02-26 21:32:09'),
(64, '2019-02-26', '17:20:00', 8, '2019-02-26 21:35:35'),
(65, '2019-02-26', '17:00:00', 8, '2019-02-26 21:36:28'),
(66, '2019-02-26', '16:40:00', 8, '2019-02-26 21:36:34'),
(67, '2019-02-26', '16:20:00', 8, '2019-02-26 21:36:52'),
(68, '2019-02-28', '09:20:00', 8, '2019-02-27 11:26:27');

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
