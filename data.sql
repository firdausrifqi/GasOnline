-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for gasonline
CREATE DATABASE IF NOT EXISTS `gasonline` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gasonline`;

-- Dumping structure for table gasonline.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(25) NOT NULL,
  `fandom` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `product_img_name` varchar(100) NOT NULL DEFAULT 'no_image.jpg',
  `product_name` varchar(100) NOT NULL,
  `price` int(5) NOT NULL,
  `product_qty` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Dumping data for table gasonline.products: ~5 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_code`, `fandom`, `category`, `product_img_name`, `product_name`, `price`, `product_qty`) VALUES
	(1, 'Gas_12Kg', 'Elpiji', 'Gas', '12Kg.jpg', 'Gas 12 (Biru) Kg', 140000, 99),
	(2, 'Gas_12aKg', 'Elpiji', 'Gas', '12aKg.jpg', 'Gas 12 (Ungu) Kg', 140000, 99),
	(3, 'Gas_5-5Kg', 'Elpiji', 'Gas', '55Kg.jpg', 'Gas 5.5Kg', 65000, 99),
	(4, 'Gas_40Kg', 'Elpiji', 'Gas', '40Kg.jpg', 'Gas 50Kg', 665000, 99);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table gasonline.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table gasonline.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `password`) VALUES
	(16, 'Jimit', 'Dholakia', 12345678, 'jimit@example.com', 'b15fbfaac3776e5a2ad330fbf7976da7'),
	(17, 'Admin', 'Admin', 12345, 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3'),
	(21, 'MRifqi', 'Firdaus', 82214536095, 'firdausrifqi123@gmail.com', '03eafa72501467e253ddd957fb75b9bf');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
