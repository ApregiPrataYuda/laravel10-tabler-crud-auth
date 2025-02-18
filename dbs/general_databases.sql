-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Feb 2025 pada 12.45
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `general_databases`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_category`
--

CREATE TABLE `ms_category` (
  `id_category` int NOT NULL,
  `name_category` varchar(122) NOT NULL,
  `description_category` varchar(122) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `ms_category`
--

INSERT INTO `ms_category` (`id_category`, `name_category`, `description_category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electronics', 'Electronics', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(2, 'Clothing', 'Clothing', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(3, 'Furniture', 'Furniture', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(4, 'Appliances', 'Appliances', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(5, 'Toys', 'Toys', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(6, 'Food', 'Food', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(7, 'Drink', 'Drink', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(8, 'Electronics', 'Electronics', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(9, 'Clothing', 'Clothing', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL),
(10, 'Furniture', 'Furniture', '2025-02-15 17:22:18', '2025-02-15 17:22:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_prices`
--

CREATE TABLE `ms_prices` (
  `id_price` int NOT NULL,
  `price` int NOT NULL,
  `product_id` int NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `ms_prices`
--

INSERT INTO `ms_prices` (`id_price`, `price`, `product_id`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15000000, 1, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(2, 8000000, 2, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(3, 150000, 3, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(4, 300000, 4, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(5, 5000000, 5, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(6, 9000000, 6, '2025-02-18 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-17 20:48:32', NULL),
(7, 4500000, 7, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(8, 6000000, 8, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(9, 750000, 9, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(10, 500000, 10, '2025-01-01 00:00:00', NULL, '2025-02-15 17:26:05', '2025-02-15 17:26:05', NULL),
(11, 1000000, 24, '2025-02-17 00:00:00', NULL, '2025-02-17 07:48:48', '2025-02-17 07:48:48', NULL),
(12, 4000000, 25, '2025-02-17 00:00:00', '2025-02-28 00:00:00', '2025-02-17 07:51:02', '2025-02-17 21:55:50', '2025-02-17 21:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int NOT NULL,
  `id_category` int NOT NULL,
  `name_product` varchar(122) NOT NULL,
  `description_product` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `id_category`, `name_product`, `description_product`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Laptop', 'High-performance laptop', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(2, 1, 'Smartphone', 'Latest model smartphone', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(3, 2, 'T-Shirt', 'Cotton t-shirt', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(4, 2, 'Jeans', 'Denim jeans', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(5, 3, 'Sofa', 'Comfortable sofa', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(6, 3, 'Dining Table', 'Wooden dining table', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(7, 4, 'Refrigerator', 'Energy-efficient refrigerator', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(8, 4, 'Washing Machine', 'Automatic washing machine', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(9, 5, 'Lego Set', 'Creative Lego building set', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(10, 5, 'Action Figure', 'Collectible action figure', '2025-02-15 17:28:28', '2025-02-15 17:28:28', NULL),
(24, 9, 'sepatu kantor', 'sepatu kantor merah', '2025-02-17 06:52:04', '2025-02-17 06:52:04', NULL),
(25, 1, 'asus', 'asus', '2025-02-17 07:49:59', '2025-02-17 07:49:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ms_category`
--
ALTER TABLE `ms_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `ms_prices`
--
ALTER TABLE `ms_prices`
  ADD PRIMARY KEY (`id_price`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ms_category`
--
ALTER TABLE `ms_category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `ms_prices`
--
ALTER TABLE `ms_prices`
  MODIFY `id_price` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
