-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table edualfacendekia.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_carts_to_users` (`user_uuid`),
  CONSTRAINT `fk_carts_to_users` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.carts: ~0 rows (approximately)
INSERT INTO `carts` (`uuid`, `user_uuid`, `created_at`, `updated_at`) VALUES
	('9fa56e46-30eb-4327-b42a-696f164c8704', '9fa56e18-ed32-4b91-af37-da3cec79bb19', '2025-08-16 00:18:05', '2025-08-16 00:18:05');

-- Dumping structure for table edualfacendekia.cart_details
CREATE TABLE IF NOT EXISTS `cart_details` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_carts_to_users` (`cart_uuid`) USING BTREE,
  KEY `fk_cart_details_to_products` (`product_uuid`),
  CONSTRAINT `fk_cart_details_to_carts` FOREIGN KEY (`cart_uuid`) REFERENCES `carts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_details_to_products` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.cart_details: ~0 rows (approximately)

-- Dumping structure for table edualfacendekia.company_profile
CREATE TABLE IF NOT EXISTS `company_profile` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_one_image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_one_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_one_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_two_image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_two_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_two_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_three_image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_three_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_three_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.company_profile: ~0 rows (approximately)
INSERT INTO `company_profile` (`uuid`, `banner_image`, `title`, `description`, `section_one_image`, `section_one_title`, `section_one_description`, `section_two_image`, `section_two_title`, `section_two_description`, `section_three_image`, `section_three_title`, `section_three_description`, `created_at`, `updated_at`) VALUES
	('909db478-7abf-492c-a9b3-6cc6a7ed0c7e', '687b5a0d552f0.jpg', 'Coba edit judul di admin', '<p>Adipiscing lacus ut elementum, nec duis, tempor litora turpis dapibus. Imperdiet cursus odio tortor in elementum. Egestas nunc eleifend feugiat lectus laoreet, vel nunc taciti integer cras. Hac pede dis, praesent nibh ac dui mauris sit. Pellentesque mi, facilisi mauris, elit sociis leo sodales accumsan. Iaculis ac fringilla torquent lorem consectetuer, sociosqu phasellus risus urna aliquam, ornare.</p>', '1.jpg', 'What do we do?', '<ol><li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</li><li>adsad</li><li><a href="https://www.youtube.com/">dasd</a></li></ol>', '687b5ab292969.jpg', 'Our Mission', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</p>', '687b5ac4760d8.jpg', 'History Of Us', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</p>', '2025-07-19 08:13:10', '2025-08-09 07:58:54');

-- Dumping structure for table edualfacendekia.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('belum dibayar','sudah dibayar','dikemas','dikirim','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum dibayar',
  `total_payment` int NOT NULL,
  `invoice` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `receipt` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_orders_to_users` (`user_uuid`) USING BTREE,
  KEY `orders_to_stores` (`store_uuid`),
  CONSTRAINT `orders_to_stores` FOREIGN KEY (`store_uuid`) REFERENCES `stores` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_to_users` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.orders: ~0 rows (approximately)
INSERT INTO `orders` (`uuid`, `user_uuid`, `store_uuid`, `number`, `status`, `total_payment`, `invoice`, `receipt`, `created_at`, `updated_at`) VALUES
	('9fa56eff-9a62-42fb-b887-af9f5c77c7dd', '9fa56e18-ed32-4b91-af37-da3cec79bb19', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', 'INV/001/16/08/2025', 'belum dibayar', 45000, NULL, '', '2025-08-16 00:20:06', '2025-08-16 00:20:06');

-- Dumping structure for table edualfacendekia.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` int NOT NULL,
  `subtotal` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_order_details_to_orders` (`order_uuid`),
  KEY `fk_order_details_to_products` (`product_uuid`),
  CONSTRAINT `fk_order_details_to_orders` FOREIGN KEY (`order_uuid`) REFERENCES `orders` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_details_to_products` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.order_details: ~0 rows (approximately)
INSERT INTO `order_details` (`uuid`, `order_uuid`, `product_uuid`, `qty`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
	('9fa56eff-9d50-4cb7-acda-9305b3830e10', '9fa56eff-9a62-42fb-b887-af9f5c77c7dd', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', 1, 35000, 35000, '2025-08-16 00:20:06', '2025-08-16 00:20:06');

-- Dumping structure for table edualfacendekia.products
CREATE TABLE IF NOT EXISTS `products` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_products_to_stores` (`store_uuid`),
  KEY `fk_products_to_types` (`type_uuid`),
  CONSTRAINT `fk_products_to_stores` FOREIGN KEY (`store_uuid`) REFERENCES `stores` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_products_to_types` FOREIGN KEY (`type_uuid`) REFERENCES `types` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.products: ~2 rows (approximately)
INSERT INTO `products` (`uuid`, `store_uuid`, `type_uuid`, `name`, `description`, `stock`, `price`, `created_at`, `updated_at`) VALUES
	('9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '9f62b553-6325-4913-bc24-02de251c29e8', 'Nebula', 'Sansevieria ‘Nebula’ adalah varietas lidah mertua mini dengan bentuk daun meruncing, berpola garis hijau perak yang menawan. Tanaman ini sangat cocok untuk dekorasi ruangan, meja kerja, atau rak minimalis. Perawatannya sangat mudah dan tahan lama meskipun jarang disiram, menjadikannya favorit banyak pecinta tanaman pemula maupun profesional.', 10, 35000, '2025-07-13 20:22:02', '2025-07-13 20:22:02'),
	('f93fc645-6f4d-4b88-8998-026e748ab023', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '9f62b553-6325-4913-bc24-02de251c29e8', 'Gamora', 'Sansevieria \'Gamora\' merupakan varietas tanaman lidah mertua dengan tampilan eksotis dan kompak. Daunnya berdiri tegak dengan corak garis-garis hijau dan tepi kekuningan, cocok untuk pemanis ruangan atau meja kerja.', 10, 35000, '2025-07-13 20:33:17', '2025-07-13 20:33:17');

-- Dumping structure for table edualfacendekia.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE,
  KEY `fk_product_images_to_products` (`product_uuid`),
  CONSTRAINT `fk_product_images_to_products` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.product_images: ~8 rows (approximately)
INSERT INTO `product_images` (`uuid`, `product_uuid`, `name`, `created_at`, `updated_at`) VALUES
	('0c047923-2d85-4c63-a423-b2f05915411c', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '1752463323_Nebula1.jpg', '2025-07-13 20:22:03', '2025-07-13 20:22:03'),
	('3f4b536a-0f15-4a8f-8701-311bd8fc34ed', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '1752463322_Nebula.jpg', '2025-07-13 20:22:03', '2025-07-13 20:22:03'),
	('4c2dfe73-4bf4-408d-a5fd-db9ce6702bbe', 'f93fc645-6f4d-4b88-8998-026e748ab023', '1752463997_Gamora.jpg', '2025-07-13 20:33:17', '2025-07-13 20:33:17'),
	('5ecb1d9d-07cb-481f-bffd-1a41620b2a2c', '9f5fab4a-1bdf-43cb-a063-b79fe61d1157', '1752463323_Nebula4.jpg', '2025-07-13 20:22:03', '2025-07-13 20:22:03'),
	('6c6803fa-3f55-40a4-ab42-8d09dd2a2d9c', 'f93fc645-6f4d-4b88-8998-026e748ab023', '1752463997_Gamora 1.jpg', '2025-07-13 20:33:17', '2025-07-13 20:33:17');

-- Dumping structure for table edualfacendekia.stores
CREATE TABLE IF NOT EXISTS `stores` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.stores: ~1 rows (approximately)
INSERT INTO `stores` (`uuid`, `name`, `city`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	('9f5fab4a-1bdf-43cb-a063-b79fe61d1157', 'Florasan Sidoarjo', 'Sidoarjo', 'Sukodono adalah sebuah kecamatan di Kabupaten Sidoarjo, Provinsi Jawa Timur, Indonesia', '-7.4041', '112.6991', '2025-07-18 08:00:44', '2025-07-12 08:00:44');

-- Dumping structure for table edualfacendekia.types
CREATE TABLE IF NOT EXISTS `types` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edualfacendekia.types: ~7 rows (approximately)
INSERT INTO `types` (`uuid`, `name`, `created_at`, `updated_at`) VALUES
	('9f5fb810-3f95-4069-8ec9-8d58bc5110fa', 'Anthurium', '2025-07-12 08:36:27', '2025-07-12 08:36:27'),
	('9f5fb820-da69-4bd9-817e-64b777046889', 'Pachipodium', '2025-07-12 08:36:38', '2025-07-12 08:36:38'),
	('9f5fb8b6-d385-4b76-9519-3cab2244fd29', 'Pachipodium', '2025-07-12 08:38:16', '2025-07-12 08:38:16'),
	('9f62a958-3e7c-4977-b6b4-90201eebcde8', 'Pot', '2025-07-13 19:42:48', '2025-07-13 19:42:48'),
	('9f62a968-eaf8-4fdd-9b4c-47412f80fec1', 'Media Tanam', '2025-07-13 19:42:58', '2025-07-13 19:42:58'),
	('9f62a9c8-88a9-42b4-9de4-6b95f631bfd9', 'Pupuk', '2025-07-13 19:44:01', '2025-07-13 19:44:01'),
	('9f62b553-6325-4913-bc24-02de251c29e8', 'Sansevieria', '2025-07-13 20:16:17', '2025-07-13 20:16:17');

-- Dumping structure for table edualfacendekia.users
CREATE TABLE IF NOT EXISTS `users` (
  `uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_uuid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('superadmin','admin','customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_users_to_stores` (`store_uuid`),
  CONSTRAINT `fk_users_to_stores` FOREIGN KEY (`store_uuid`) REFERENCES `stores` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table edualfacendekia.users: ~2 rows (approximately)
INSERT INTO `users` (`uuid`, `store_uuid`, `role`, `name`, `address`, `email`, `phone`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
	('9f6ac9ae-1f33-440c-94f9-aa46a5a643c8', NULL, 'customer', 'Arya Rizky Tri Putra', 'Jl. Babatan UNESA Gg 5G No 3C RT 07 RW 01', 'aryarizkytriputra230304@gmail.com', '', '$2y$12$yS/kDleFstLWJDfzgir0WOKBR2icIMVdbNC7EHPFFuqWJcRnADY3G', NULL, '2025-07-17 20:39:50', '2025-07-17 20:52:49'),
	('9fa56e18-ed32-4b91-af37-da3cec79bb19', NULL, 'customer', 'Freya Enggrayni', 'Jl. Rungkut Industri IV No.18A, Kutisari, Kec. Tenggilis Mejoyo, Surabaya, Jawa Timur', 'freya@gmail.com', '081233446406', '$2y$12$758K6M/jky4YyTLP.x7OwuTTDbl/p0hrodhpB8D3Bv0hcQi.F5HtC', NULL, '2025-08-16 00:17:35', '2025-08-16 00:17:35'),
	('c8eca803-6073-11f0-b4bd-00090ffe0001', NULL, 'superadmin', 'Admin Edu Alfa Cendekia', '', 'superadmin@florasan.id', '', '$2y$12$oZfgVaOu0vFw0r9q5ua7/OcOUid8BkpuU8J00WNH7u.Sppq.uYpUi', NULL, '2025-07-14 05:31:25', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
