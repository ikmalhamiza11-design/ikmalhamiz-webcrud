-- Database: whishlist
DROP DATABASE IF EXISTS `whishlist`;
CREATE DATABASE `whishlist`;
USE `whishlist`;

-- ----------------------------
-- Table structure for whishlist
-- ----------------------------
CREATE TABLE `whishlist` (
  `id_wishlist` varchar(50) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_ditambahkan` date NOT NULL,
  `harga_estimasi` enum('Rp_50000','Rp_100000','Rp_500000','Rp_1000000') NOT NULL,
  `status` enum('Pending','Dibeli','Ditunda') NOT NULL,
  `catatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_wishlist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Dumping data for whishlist
-- ----------------------------
INSERT INTO `whishlist`
(`id_wishlist`, `nama_item`, `kategori`, `tanggal_ditambahkan`, `harga_estimasi`, `status`, `catatan`) VALUES
('WL001', 'Headphone Bluetooth', 'Elektronik', '2025-01-10', 'Rp_500000', 'Pending', 'Mau beli yang noise cancelling'),
('WL002', 'Sepatu Sneakers', 'Fashion', '2025-01-15', 'Rp_1000000', 'Ditunda', 'Nunggu diskon 11.11'),
('WL003', 'Keyboard Mechanical', 'Elektronik', '2025-01-20', 'Rp_500000', 'Dibeli', 'Sudah dapet di marketplace');

-- ----------------------------
-- Table structure for user
-- ----------------------------
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Dumping data for user
-- ----------------------------
INSERT INTO `user` (`username`, `password`)
VALUES ('Ikmal', 'kelompok');
