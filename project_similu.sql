-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Mar 2024 pada 02.53
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_similu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absens`
--

CREATE TABLE `absens` (
  `id_absen` int(11) NOT NULL,
  `warga_id` int(11) NOT NULL,
  `tps` varchar(10) NOT NULL,
  `kpps` varbinary(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatans`
--

CREATE TABLE `catatans` (
  `id_catatan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `kpps` varchar(10) NOT NULL,
  `tps` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_suaras`
--

CREATE TABLE `surat_suaras` (
  `id_surat_suara` int(11) NOT NULL,
  `tps` varchar(10) NOT NULL,
  `kpps` varchar(10) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `no` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_suaras`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` text NOT NULL,
  `tps` varchar(5) NOT NULL,
  `kpps` varchar(5) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `tps`, `kpps`, `nik`, `email`, `created_at`, `updated_at`) VALUES
(1, '-', '1', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(2, '-', '1', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(3, '-', '1', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(4, '-', '1', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(5, '-', '1', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(6, '-', '1', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(7, '-', '1', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(8, '-', '2', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(9, '-', '2', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(10, '-', '2', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(11, '-', '2', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(12, '-', '2', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(13, '-', '2', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(14, '-', '2', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(15, '-', '3', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(16, '-', '3', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(17, '-', '3', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(18, '-', '3', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(19, '-', '3', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(20, '-', '3', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(21, '-', '3', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(22, '-', '4', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(23, '-', '4', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(24, '-', '4', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(25, '-', '4', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(26, '-', '4', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(27, '-', '4', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(28, '-', '4', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(29, '-', '5', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(30, '-', '5', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(31, '-', '5', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(32, '-', '5', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(33, '-', '5', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(34, '-', '5', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(35, '-', '5', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(36, '-', '6', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(37, '-', '6', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(38, '-', '6', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(39, '-', '6', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(40, '-', '6', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(41, '-', '6', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(42, '-', '6', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(43, '-', '7', '1', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(44, '-', '7', '2', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(45, '-', '7', '3', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(46, '-', '7', '4', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(47, '-', '7', '5', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(48, '-', '7', '6', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(49, '-', '7', '7', '-', '-', '2024-02-13 10:58:22', '0000-00-00 00:00:00'),
(50, 'PPS', 'PPS', 'PPS', '-', '-', '2024-02-13 10:58:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wargas`
--

CREATE TABLE `wargas` (
  `id_warga` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_warga` text NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_urut` varchar(10) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tps` varchar(10) NOT NULL,
  `surat_suara` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wargas`
--

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `catatans`
--
ALTER TABLE `catatans`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indeks untuk tabel `surat_suaras`
--
ALTER TABLE `surat_suaras`
  ADD PRIMARY KEY (`id_surat_suara`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `wargas`
--
ALTER TABLE `wargas`
  ADD PRIMARY KEY (`id_warga`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absens`
--
ALTER TABLE `absens`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `catatans`
--
ALTER TABLE `catatans`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_suaras`
--
ALTER TABLE `surat_suaras`
  MODIFY `id_surat_suara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `wargas`
--
ALTER TABLE `wargas`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1787;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
