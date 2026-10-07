-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 01:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpesanan`
--

CREATE TABLE `detailpesanan` (
  `id_pesanan` int(4) NOT NULL,
  `id_produk` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpesanan`
--

INSERT INTO `detailpesanan` (`id_pesanan`, `id_produk`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 4),
(4, 5),
(5, 6),
(6, 4),
(17, 2),
(17, 3),
(17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(4) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `usia` int(3) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `usia`, `alamat`, `no_telp`) VALUES
(1, 'Rifqy', 18, 'Jl. Sekaran', '081234567890'),
(2, 'Ammar', 19, 'Jl. Tembalang', '085678901234'),
(3, 'Bunga', 19, 'Jl. Patemon', '081112223344'),
(4, 'Abdul', 28, 'Jl. Jalan', '081234567890'),
(5, 'Asep', 35, 'Jl. Bareng', '085678901234'),
(6, 'Boim', 29, 'Jl. In Dulu', '081112223344'),
(12, 'Afif', 19, 'Jl. Patemon', '0812831831212');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(4) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `metode` varchar(100) DEFAULT NULL,
  `id_pesanan` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `total_harga`, `metode`, `id_pesanan`) VALUES
(1, 1500000.00, 'Credit Card', 1),
(2, 750000.00, 'PayPal', 2),
(3, 3000000.00, 'Bank Transfer', 3),
(4, 2150000.00, 'ShopeePay', 4),
(5, 1650000.00, 'PayPal', 5),
(6, 3750000.00, 'Bank Transfer', 6),
(17, 5300000.00, 'Credit Card', 17);

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` int(4) NOT NULL,
  `nama_penjual` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `nama_penjual`, `deskripsi`) VALUES
(1, 'Nike Store', 'Nike is a corporation that designs, markets, and sells athletic footwear, apparel, accessories, equi'),
(2, 'Adidas Store', 'Adidas is a German athletic apparel and footwear company that sells products through its e-commerce '),
(3, 'New Balance Store', 'New Balance is a run specialty brand, but their products span a variety of sport and lifestyle space'),
(4, 'Stussy Store', 'Stussy is a California-based streetwear brand that was founded in 1980 by Shawn Stussy. The brand wa'),
(23, 'AJM', 'Toko Peralatan');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(4) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `tanggal_pesanan` datetime DEFAULT NULL,
  `id_pelanggan` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `total_harga`, `tanggal_pesanan`, `id_pelanggan`) VALUES
(1, 1500000.00, '2023-11-26 08:00:00', 1),
(2, 750000.00, '2023-11-27 09:30:00', 2),
(3, 3000000.00, '2023-11-28 10:45:00', 3),
(4, 2150000.00, '2023-11-29 08:30:00', 4),
(5, 1650000.00, '2023-11-30 11:15:00', 5),
(6, 3750000.00, '2023-12-01 14:00:00', 6),
(17, 5300000.00, '2023-12-11 19:04:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(4) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(1000) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `id_penjual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `id_penjual`) VALUES
(1, 'Nike Air Force 1 Low \'07 Triple White', 'The Nike Air Force 1 Low is a modern take on the iconic white on white low top Air Force 1. Released in honor of the classic shoe\'s 25th anniversary in 2007, the sneaker features an upgraded, crispier 10A full grain leather white upper with a matching white Air-cushioned rubber sole.', 1250000.00, 1),
(2, 'New Balance 530 White Silver Navy', 'The New Balance 530 White Silver Navy features a white mesh upper with metallic silver and white leather overlays. On the quarter panel, a grey New Balance logo outlined in navy adds contrast. From there, a white and grey ABZORB sole adds the finishing touch.', 1650000.00, 3),
(3, 'Adidas Samba OG Cloud White Core Black', 'Born on the soccer field, the Samba is a timeless icon of street style. These shoes stay true to their legacy with a soft leather upper and suede overlays.', 2150000.00, 2),
(4, 'Nike Giannis Immortality 3 Oreo', 'How do you want your game to be remembered? Preserve your place among the greats, like Giannis, in the Giannis Immortality 3. Mindfully made for today\'s high-paced, position-less game, it\'s softer than the previous iteration with a specific traction pattern that\'s perfect for pulling off the perfect Euro step en route to glory.', 1500000.00, 1),
(5, 'New Balance 550 White Green', 'In-line efforts from the Boston-based brand have brought a handful of primary color and collegiate styles to the 32-year-old design. Premium perforated leather and soft suede construction across New Balance\'s vintage foray into basketball heavily favor an understated white and light grey color palette, but they haven\'t minded sharing the spotlight with a cast of tones. Soon enough, a rich green will animate the plump \"N\" logos at the mid-foot, branding on the tongue and heel, and a number of functional and aesthetic components across the New Balance shoes.', 1500000.00, 3),
(32, 'Stussy World Tour Tee White', 'Paying homage to the style capitals of the world, the chest print of this Stüssy World Tour tee features New York, Los Angeles, Tokyo, London and Paris lettering printed to the front – finished with all the thriving streetwear capitals printed to the back.', 800000.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produkpenjual`
--

CREATE TABLE `produkpenjual` (
  `id_produk` int(4) NOT NULL,
  `id_penjual` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkpenjual`
--

INSERT INTO `produkpenjual` (`id_produk`, `id_penjual`) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 1),
(5, 3),
(32, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpesanan`
--
ALTER TABLE `detailpesanan`
  ADD PRIMARY KEY (`id_pesanan`,`id_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_penjual` (`id_penjual`);

--
-- Indexes for table `produkpenjual`
--
ALTER TABLE `produkpenjual`
  ADD PRIMARY KEY (`id_produk`,`id_penjual`),
  ADD KEY `id_penjual` (`id_penjual`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_penjual` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_penjual`) REFERENCES `penjual` (`id_penjual`);

--
-- Constraints for table `produkpenjual`
--
ALTER TABLE `produkpenjual`
  ADD CONSTRAINT `produkpenjual_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `produkpenjual_ibfk_2` FOREIGN KEY (`id_penjual`) REFERENCES `penjual` (`id_penjual`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
detailpesanan