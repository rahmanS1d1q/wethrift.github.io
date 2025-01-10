-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2025 pada 21.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickcart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `addstocart`
--

CREATE TABLE `addstocart` (
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1 CHECK (`quantity` >= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`adminID`, `password`) VALUES
(1, 'admin1'),
(2, 'admin2'),
(3, 'admin3'),
(4, 'admin4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address_street` varchar(100) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_state` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) DEFAULT 0,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customerID`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `pincode`, `phone_no`, `email`, `password`, `dob`, `age`, `gender`) VALUES
(51, 'Rahman', 'Shiddiq', 'Wonomlati Rt06Rw03', 'Sidoarjo', 'Jawa Timur', 2004, 81913868745, 'admin@m.com', 'admin1', '2004-09-24', 20, 'Male'),
(56, 'awe', 'ss', 'wiyung', 'Surabaya', 'jawa timur', 2332, 81283453452, 'admin1@m.com', 'admin1', '2000-09-23', 24, 'Female'),
(58, 'Costumer', 'Tester', 'Web', 'Tester', 'Location', 2233, 812345232223, 'testc@m.com', 'admin1', '2001-02-03', 24, 'Male');

--
-- Trigger `customer`
--
DELIMITER $$
CREATE TRIGGER `before_insert_customer` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
        SET NEW.age = TIMESTAMPDIFF(YEAR, NEW.dob, CURDATE());
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveryagent`
--

CREATE TABLE `deliveryagent` (
  `agentID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `availabilityStatus` varchar(20) NOT NULL DEFAULT 'Offline',
  `phone_no` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `deliveryagent`
--

INSERT INTO `deliveryagent` (`agentID`, `first_name`, `last_name`, `availabilityStatus`, `phone_no`, `email`, `password`, `dob`, `age`) VALUES
(13, 'Shopee', 'Express', 'Busy', 82334234565, 'admin@m.com', 'admin1', '2000-08-04', 24),
(14, 'Delivery', 'Tester', 'Available', 81234567898, 'test@m.com', 'admin1', '2001-02-03', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveryreview`
--

CREATE TABLE `deliveryreview` (
  `deliveryReviewID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `agentID` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT 5 CHECK (`rating` >= 1 and `rating` <= 5),
  `tip` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `deliveryreview`
--

INSERT INTO `deliveryreview` (`deliveryReviewID`, `orderID`, `agentID`, `comment`, `rating`, `tip`) VALUES
(1, 1, 13, 'Ramah', 5, 80000.00),
(2, 2, 13, 'Bagus seperti biasanya', 5, 5000.00),
(3, 3, 13, 'Cepat', 5, 10000.00),
(4, 5, 14, 'Fasterrrr', 5, 100000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_agent_wallet`
--

CREATE TABLE `delivery_agent_wallet` (
  `agentID` int(11) NOT NULL,
  `earning_balance` decimal(10,2) NOT NULL DEFAULT 0.00 CHECK (`earning_balance` >= 0),
  `earning_paid` decimal(10,2) NOT NULL DEFAULT 0.00 CHECK (`earning_paid` >= 0),
  `earning_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Transaction_history` varchar(500) DEFAULT NULL,
  `upiID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `delivery_agent_wallet`
--

INSERT INTO `delivery_agent_wallet` (`agentID`, `earning_balance`, `earning_paid`, `earning_total`, `Transaction_history`, `upiID`) VALUES
(13, 385150.00, 50000.00, 435150.00, '08-01-2025^ You Created QuickCart Wallet Account!^ 0^ 0^ 0| 08-01-2025^ You earned Rp10050 for successfully delivering order 1^ 10,050.00^ 0.00^ 10,050.00| 08-01-2025^ You were tipped Rp80000 for delivering order 1^ 90,050.00^ 0.00^ 90,050.00| 08-01-2025^ You withdrew Rp30000 from your QuickCart Wallet Account^ 60,050.00^ 30,000.00^ 90050.00| 09-01-2025^ You withdrew Rp20,000.00 from your QuickCart Wallet Account^ 40,050.00^ 50,000.00^ 90,050.00| 09-01-2025^ You earned Rp300050 for successfully ', 'agent13@upi'),
(14, 200050.00, 100000.00, 300050.00, '09-01-2025^ You Created QuickCart Wallet Account!^ 0^ 0^ 0| 09-01-2025^ You earned Rp200050 for successfully delivering order 5^ 200,050.00^ 0.00^ 200,050.00| 09-01-2025^ You were tipped Rp.100000 for delivering order 5^ 300,050.00^ 0.00^ 300,050.00| 09-01-2025^ You withdrew Rp100,000.00 from your QuickCart Wallet Account^ 200,050.00^ 100,000.00^ 300,050.00', 'agent14@upi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Confirmed',
  `total_price` decimal(10,2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(255) NOT NULL,
  `agentPayment` int(11) NOT NULL DEFAULT 50,
  `customerID` int(11) NOT NULL,
  `agentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`orderID`, `status`, `total_price`, `time`, `location`, `agentPayment`, `customerID`, `agentID`) VALUES
(1, 'Delivered', 1200000.00, '2025-01-08 19:31:45', 'Wonomlati Rt06Rw03, Sidoarjo', 10050, 51, 13),
(2, 'Delivered', 670000.00, '2025-01-09 08:38:49', 'Wonomlati Rt06Rw03, Sidoarjo', 300050, 51, 13),
(3, 'Delivered', 1200000.00, '2025-01-09 08:49:36', 'wiyung, Surabaya', 30050, 56, 13),
(4, 'Packed and Shipped', 1200000.00, '2025-01-09 11:02:24', 'Wonomlati Rt06Rw03, Sidoarjo', 20050, 51, 13),
(5, 'Delivered', 4000000.00, '2025-01-09 19:04:17', 'Web, Tester', 200050, 58, 14);

--
-- Trigger `order`
--
DELIMITER $$
CREATE TRIGGER `after_insert_orders` AFTER INSERT ON `order` FOR EACH ROW BEGIN
        -- Update deliveryAgent availabilityStatus to 'Busy' for the agent assigned to the new order
        UPDATE deliveryAgent 
        SET availabilityStatus = 'Busy' 
        WHERE agentID = NEW.agentID; -- Used NEW.agentID to refer to the newly inserted order's agentID
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderconsistsproduct`
--

CREATE TABLE `orderconsistsproduct` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1 CHECK (`quantity` >= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orderconsistsproduct`
--

INSERT INTO `orderconsistsproduct` (`orderID`, `productID`, `quantity`) VALUES
(1, 15, 1),
(2, 20, 1),
(3, 15, 1),
(4, 15, 1),
(5, 27, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0 CHECK (`stock` >= 0),
  `brand` varchar(50) NOT NULL,
  `qty_bought` int(11) NOT NULL DEFAULT 0,
  `description` varchar(200) NOT NULL DEFAULT 'A high-quality product.',
  `prod_image` varchar(200) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`productID`, `name`, `price`, `stock`, `brand`, `qty_bought`, `description`, `prod_image`, `categoryID`) VALUES
(15, 'Samba Spezial BW', 1200000.00, 0, 'Adidas', 4, 'Uk 43', 'eb798ad9-722a-4470-8d13-0de23470662a.jpg', 1),
(16, 'Stone Island Black', 2000000.00, 2, 'Stone Island', 0, 'Uk XXL', '131e8e65-ef9b-4cc9-a47d-3cb34d20d1bd.jpg', 2),
(17, 'Adidas Bali', 2100000.00, 3, 'Adidas', 0, 'Uk 45', 'Adidas-Bali-Tactile-Steel-Dark-Marine-1.webp', 1),
(18, 'Stone Island White', 2500000.00, 1, 'Stone Island', 0, 'Uk M', 'shopping.webp', 2),
(19, 'Celana Joger', 400000.00, 4, 'Emba', 0, 'Uk 39', 'lgs-6164-8394432-2.jpg', 5),
(20, 'Topi TNF', 670000.00, 1, 'TNF', 1, 'Adult', 'Sd16ec486da99451187b361a37b6eb277S.jpg', 6),
(21, 'Giant UNO', 500000.00, 6, 'UNO', 0, 'Card Game', '665c663f073071212a40fec3-giant-uno-card-game-for-kids-adults-and.jpg', 11),
(22, 'Madilog', 120000.00, 4, 'Gramedia', 2, 'Buku Karya Tan Malaka', 'madilog.jpg', 10),
(23, 'Kaos Uniqlo', 400000.00, 3, 'Uniqlo', 0, 'Uk XL', 'fbdc4da8ceefd6f668b1cec79313b4ab.jpg', 4),
(24, 'Travis Scott x Air Jordan 1 Low OG ', 24000000.00, 1, 'Nike', 0, 'Uk 43', '14366145_20970720_1000.jpg', 1),
(25, 'Jordan 1 High Travis Scott', 28000000.00, 1, 'Nike', 0, 'Uk 43. Desain ini menggabungkan bahan kulit putih dengan lapisan suede Mocha dan Swoosh terbalik dari kulit hitam.', 'Jordan-1-High-Travis-Scott-1.webp', 1),
(26, 'adidas cp company manchester', 4500000.00, 3, 'Adidas', 0, 'Uk 42 1/2', 'images (2).jpg', 1),
(27, 'Nyfoil Google Jacket', 4000000.00, 0, 'C.P.Company', 1, 'Uk XL', 'download (7).jpg', 2);

--
-- Trigger `product`
--
DELIMITER $$
CREATE TRIGGER `after_delete_product` AFTER DELETE ON `product` FOR EACH ROW BEGIN
    -- Reducing the no of products in category table
    UPDATE productCategory 
    SET noOfProducts = noOfProducts - OLD.stock
    WHERE categoryID = OLD.categoryID; -- Used OLD to refer to the deleted product
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `productcategory`
--

CREATE TABLE `productcategory` (
  `categoryID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `noOfProducts` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `productcategory`
--

INSERT INTO `productcategory` (`categoryID`, `name`, `noOfProducts`) VALUES
(1, 'Sepatu', 8),
(2, 'Outfit', 3),
(4, 'Kaos', 3),
(5, 'Celana', 4),
(6, 'Aksesoris', 1),
(10, 'Books', 4),
(11, 'Toys and Games', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `productreview`
--

CREATE TABLE `productreview` (
  `productReviewID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT 5 CHECK (`rating` >= 1 and `rating` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `productreview`
--

INSERT INTO `productreview` (`productReviewID`, `orderID`, `customerID`, `comment`, `rating`) VALUES
(1, 1, 51, 'Bagus', 5),
(2, 2, 51, 'Barang Sesuai', 5),
(3, 3, 56, 'Bagus Barangnya', 4),
(4, 5, 58, 'Not Bad', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `store`
--

CREATE TABLE `store` (
  `storeID` int(11) NOT NULL,
  `address_street` varchar(100) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_state` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `store`
--

INSERT INTO `store` (`storeID`, `address_street`, `address_city`, `address_state`, `pincode`) VALUES
(1, 'Central Street 123', 'Ghaziabad', 'Uttar Pradesh', 201001),
(2, 'Main Avenue 456', 'New Delhi', 'Delhi', 110001),
(3, 'Downtown Boulevard 789', 'Gurgaon', 'Haryana', 122001),
(4, 'City Center 321', 'Noida', 'Uttar Pradesh', 201301);

-- --------------------------------------------------------

--
-- Struktur dari tabel `storecontainsproduct`
--

CREATE TABLE `storecontainsproduct` (
  `storeID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0 CHECK (`quantity` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wallet`
--

CREATE TABLE `wallet` (
  `customerID` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00 CHECK (`balance` >= 0),
  `upiID` varchar(100) NOT NULL,
  `rewardPoints` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wallet`
--

INSERT INTO `wallet` (`customerID`, `balance`, `upiID`, `rewardPoints`) VALUES
(51, 2625000.00, 'customer51@upi', 0),
(56, 2990000.00, 'customer56@upi', 0),
(58, 4900000.00, 'customer58@upi', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `addstocart`
--
ALTER TABLE `addstocart`
  ADD PRIMARY KEY (`customerID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `deliveryagent`
--
ALTER TABLE `deliveryagent`
  ADD PRIMARY KEY (`agentID`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `deliveryreview`
--
ALTER TABLE `deliveryreview`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `agentID` (`agentID`);

--
-- Indeks untuk tabel `delivery_agent_wallet`
--
ALTER TABLE `delivery_agent_wallet`
  ADD KEY `agentID` (`agentID`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `agentID` (`agentID`);

--
-- Indeks untuk tabel `orderconsistsproduct`
--
ALTER TABLE `orderconsistsproduct`
  ADD PRIMARY KEY (`orderID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indeks untuk tabel `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indeks untuk tabel `productreview`
--
ALTER TABLE `productreview`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indeks untuk tabel `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeID`);

--
-- Indeks untuk tabel `storecontainsproduct`
--
ALTER TABLE `storecontainsproduct`
  ADD PRIMARY KEY (`productID`,`storeID`),
  ADD KEY `storeID` (`storeID`);

--
-- Indeks untuk tabel `wallet`
--
ALTER TABLE `wallet`
  ADD KEY `customerID` (`customerID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `deliveryagent`
--
ALTER TABLE `deliveryagent`
  MODIFY `agentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `addstocart`
--
ALTER TABLE `addstocart`
  ADD CONSTRAINT `addstocart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `addstocart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `deliveryreview`
--
ALTER TABLE `deliveryreview`
  ADD CONSTRAINT `deliveryreview_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `deliveryreview_ibfk_2` FOREIGN KEY (`agentID`) REFERENCES `deliveryagent` (`agentID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `delivery_agent_wallet`
--
ALTER TABLE `delivery_agent_wallet`
  ADD CONSTRAINT `delivery_agent_wallet_ibfk_1` FOREIGN KEY (`agentID`) REFERENCES `deliveryagent` (`agentID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`agentID`) REFERENCES `deliveryagent` (`agentID`);

--
-- Ketidakleluasaan untuk tabel `orderconsistsproduct`
--
ALTER TABLE `orderconsistsproduct`
  ADD CONSTRAINT `orderconsistsproduct_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderconsistsproduct_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `productcategory` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `productreview`
--
ALTER TABLE `productreview`
  ADD CONSTRAINT `productreview_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `productreview_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `storecontainsproduct`
--
ALTER TABLE `storecontainsproduct`
  ADD CONSTRAINT `storecontainsproduct_ibfk_1` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `storecontainsproduct_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
