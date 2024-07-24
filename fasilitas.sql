-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2024 pada 09.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fasilitas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `nama_aset` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `harga` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `kategori`, `tanggal_pembelian`, `harga`, `status`) VALUES
(1, 'Kursi', 'Kantor', '2024-07-15', 'Rp.1.000.000', 'Baru'),
(2, 'Meja', 'Kantor', '2024-07-16', 'Rp.500.000', 'Baru'),
(3, 'Laptop', 'Elektronik', '2024-07-17', 'Rp.10.000.000', 'Baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `Idkaryawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `notelepon` varchar(20) DEFAULT NULL,
  `jeniskel` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`Idkaryawan`, `nama`, `jabatan`, `alamat`, `notelepon`, `jeniskel`) VALUES
(1, 'Ribal', 'Admin', 'Jl.KUA', '081234567890', 'Pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggantian`
--

CREATE TABLE `penggantian` (
  `id_penggantian` int(11) NOT NULL,
  `id_aset_lama` int(11) NOT NULL,
  `id_aset_baru` int(11) NOT NULL,
  `tanggal_penggantian` date NOT NULL,
  `alasan_penggantian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penggantian`
--

INSERT INTO `penggantian` (`id_penggantian`, `id_aset_lama`, `id_aset_baru`, `tanggal_penggantian`, `alasan_penggantian`) VALUES
(1, 3, 1, '2024-07-17', 'Karena kantor sedang memerlukan kursi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perawatan`
--

CREATE TABLE `perawatan` (
  `id_perawatan` int(11) NOT NULL,
  `id_aset` int(11) NOT NULL,
  `tanggal_perawatan` date NOT NULL,
  `keterangan` text NOT NULL,
  `biaya` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perawatan`
--

INSERT INTO `perawatan` (`id_perawatan`, `id_aset`, `tanggal_perawatan`, `keterangan`, `biaya`) VALUES
(1, 2, '2024-07-22', 'Ganti Kaki - kaki meja yang rusak', 'Rp. 200.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `id_aset` int(11) NOT NULL,
  `tanggal_perbaikan` date NOT NULL,
  `keterangan` text NOT NULL,
  `biaya` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `Idpengguna` int(11) NOT NULL,
  `namapengguna` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `katasandi` varchar(255) NOT NULL,
  `peran` enum('User','Admin') NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`Idpengguna`, `namapengguna`, `email`, `katasandi`, `peran`, `role`) VALUES
(3, 'c0nsiglieri', 'csg@gmail.com', '$2y$10$Kat8L3q9gecotX7w0T0Ynebsnp5f9TsCKhMU1k1wZkeWPADsxnCme', 'Admin', 'admin'),
(9, 'ribal', 'rs@gmail.com', '$2y$10$jv41YNCgzIYW20JrcPaM0ek7mfup3vFdiPIQMiyBJJrX0ORQOdRfC', 'User', 'admin'),
(10, 'bian', 'bian@gmail.com', '$2y$10$8OQTl4UyJDiqfswUD2jGou9ewR2LffCpxzGn0RxkAXlO//BG3.Onm', 'Admin', 'admin'),
(11, 'Luve', 'luve12@gmail.com', '$2y$10$amgx1Uyz2y2CHh1n6zxx6ePRKAGBi3DX/if7E.vgveuAEa9XRlhoG', 'User', 'admin'),
(12, 'Kufra', 'kuf@gmail.com', '$2y$10$BefXZ8zc29w1SWLr6mDbCe.ntdCQzo7yJhCvqqrwLHnRdwlvBKjFC', 'User', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`Idkaryawan`);

--
-- Indeks untuk tabel `penggantian`
--
ALTER TABLE `penggantian`
  ADD PRIMARY KEY (`id_penggantian`),
  ADD KEY `id_aset_lama` (`id_aset_lama`),
  ADD KEY `id_aset_baru` (`id_aset_baru`);

--
-- Indeks untuk tabel `perawatan`
--
ALTER TABLE `perawatan`
  ADD PRIMARY KEY (`id_perawatan`),
  ADD KEY `id_aset` (`id_aset`);

--
-- Indeks untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `id_aset` (`id_aset`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Idpengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `Idkaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penggantian`
--
ALTER TABLE `penggantian`
  MODIFY `id_penggantian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `perawatan`
--
ALTER TABLE `perawatan`
  MODIFY `id_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `Idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penggantian`
--
ALTER TABLE `penggantian`
  ADD CONSTRAINT `penggantian_ibfk_1` FOREIGN KEY (`id_aset_lama`) REFERENCES `aset` (`id_aset`),
  ADD CONSTRAINT `penggantian_ibfk_2` FOREIGN KEY (`id_aset_baru`) REFERENCES `aset` (`id_aset`);

--
-- Ketidakleluasaan untuk tabel `perawatan`
--
ALTER TABLE `perawatan`
  ADD CONSTRAINT `perawatan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`);

--
-- Ketidakleluasaan untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
