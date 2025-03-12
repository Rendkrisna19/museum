-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 05:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu_undangan`
--

CREATE TABLE `tbl_tamu_undangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tamu_undangan`
--

INSERT INTO `tbl_tamu_undangan` (`id`, `nama`, `alamat`, `tanggal_kunjungan`, `instansi`, `created_at`) VALUES
(1, 'Rendy', 'kuala tanjung', '2025-03-12', 'Mahasiswa', '2025-03-12 15:41:15'),
(2, 'Randy', 'kuala tanjung', '2025-03-12', 'Mahasiswa', '2025-03-12 16:09:22'),
(3, 'Muhammad Rendy Krisna', 'kuala tanjung', '2025-03-12', 'Mahasiswa', '2025-03-12 16:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Muhammad Rendy Krisna', 'muhammadrendykrisna@gmail.com', 'rendy2005', '$2y$10$7MOoMN5J/97HPpQG5vTBGOpJ.l4Cn7OTa/sU13h7c9c.9bif5gR6a', 'user', '2025-03-12 15:14:29'),
(3, 'Admin Museum', 'admin@gmail.com', 'admin', '$2y$10$aLv3zsq2AiPxNOjGEcSNKu/79A5XbKTvrCgNVo1vSNwS18Vx9KSA.', 'admin', '2025-03-12 15:21:01'),
(4, 'Rahma Ariani', 'rendikrisna01@gmail.com', 'rahma', '$2y$10$/EAExvp6wyVr.2HOWVFqPOv5iF/.85zJeGhqHiBJW7u/5tPWBbjou', 'user', '2025-03-12 15:25:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_tamu_undangan`
--
ALTER TABLE `tbl_tamu_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_tamu_undangan`
--
ALTER TABLE `tbl_tamu_undangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
