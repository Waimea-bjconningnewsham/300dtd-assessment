-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `contains`;
CREATE TABLE `contains` (
  `orders id` int NOT NULL,
  `menu id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`orders id`,`menu id`),
  KEY `menu id` (`menu id`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`orders id`) REFERENCES `orders` (`id`),
  CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`menu id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contains` (`orders id`, `menu id`, `qty`) VALUES
(35,	1,	6),
(35,	3,	20),
(35,	4,	3);

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `customers` (`id`, `email`, `hash`, `name`, `admin`) VALUES
(15,	'owner@owner.com',	'$2y$10$T2u/9a3xgSyiQNA8jNPu1e1ocYSJqThiNicmSHJY9wCVcmwNTyidy',	'Owner',	1),
(16,	'customer@gmail.com',	'$2y$10$0qdWFT1HK26YWiSi84g85eFzobNknIZ99I/TatBw7VYY/oKk7lpyi',	'customer',	0);

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `price` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu` (`id`, `product`, `product_description`, `price`) VALUES
(1,	'Hamburger',	'pending',	12),
(2,	'Cheeseburger',	'pending',	12),
(3,	'Fries',	'pending',	6),
(4,	'Coca cola',	'pending',	4);

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `body` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orders` (`id`, `customer_id`, `date`) VALUES
(35,	16,	'2024-08-16 09:26:31');

-- 2024-09-17 00:27:26
