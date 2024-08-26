-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Agu 2024 pada 11.22
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
-- Database: `ngetrash`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idAdmin` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`idAdmin`, `name`, `userName`, `password`) VALUES
(14, 'Admin', 'admin@gmail.com', '$2y$10$XPoJDaAVSOLtLJ044zkDHOjiAguu9ZB1dmPHXGs3za5R5RMDXP6QS'),
(17, 'Ibrahim', 'ibrahim@gmail.com', '$2y$10$ImcnMRytRFghGHvlLr1qJOe0AB5GhAtf92Nq1U192J.rAkGYTd4bm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_iuran_wajib`
--

CREATE TABLE `tbl_iuran_wajib` (
  `idIuran` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Sudah Bayar','Belum Bayar') NOT NULL,
  `paketBayar` enum('10000','30000','330000') NOT NULL,
  `idUser` int(5) DEFAULT NULL,
  `idPetugas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_iuran_wajib`
--

INSERT INTO `tbl_iuran_wajib` (`idIuran`, `tanggal`, `status`, `paketBayar`, `idUser`, `idPetugas`) VALUES
(89, '2024-07-01', 'Sudah Bayar', '330000', 14, 21),
(92, '2024-07-13', 'Sudah Bayar', '30000', 16, 21),
(93, '2024-07-13', 'Belum Bayar', '30000', 18, 21),
(94, '2024-07-13', 'Sudah Bayar', '30000', 19, 21),
(95, '2024-07-13', 'Sudah Bayar', '330000', 14, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `idPetugas` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `statusAktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`idPetugas`, `name`, `userName`, `password`, `statusAktif`) VALUES
(21, 'Ibrahim Aji', 'ibrahim@gmail.com', '$2y$10$6oAozlFvK4s1Gjm2ywOx9.7SKGDtHypGBEH.9xQTudOREb2mOYNhy', 'Y'),
(22, 'John Cena', 'john@gmail.com', '$2y$10$EI39AlNjRtDTLPkGKvOkO.qV2KnwcMjbwPHqS6QWChH7LiN6FypIW', 'Y'),
(23, 'Bahrudin', 'bahrudin@gmail.com', '$2y$10$AFyi.JykzQQR.ICphVq7LuaHUeunM3SjJwSsIx61xLA0UUK/qmTcy', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_pengambilan`
--

CREATE TABLE `tbl_status_pengambilan` (
  `idStatus` int(2) NOT NULL,
  `keterangan` enum('Belum Diambil','Sudah Diambil') NOT NULL,
  `tanggal` date NOT NULL,
  `idUser` int(5) NOT NULL,
  `idPetugas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_status_pengambilan`
--

INSERT INTO `tbl_status_pengambilan` (`idStatus`, `keterangan`, `tanggal`, `idUser`, `idPetugas`) VALUES
(68, 'Sudah Diambil', '2024-06-30', 14, 21),
(69, 'Sudah Diambil', '2024-07-01', 14, 22),
(71, 'Sudah Diambil', '2024-07-10', 14, 21),
(72, 'Sudah Diambil', '2024-07-24', 17, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `idUser` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `statusAktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`idUser`, `name`, `userName`, `password`, `alamat`, `statusAktif`) VALUES
(14, 'Lilik M', 'lilik@gmail.com', '$2y$10$e65HsZzvJrCpCgUvzbah3ei16sBSm2r25SFPI0kfpByeAaGhgGiWS', 'Jogja', 'Y'),
(15, 'Ibrahim Aji', 'ibrahim@gmail.com', '$2y$10$r6wq69hUrswI3to9cRD3YenWIGo2s/uxHTmDVMUED/f4yQE5FEFoC', 'Jogja', 'Y'),
(16, 'Rahmat', 'rahmat@gmail.com', '$2y$10$KKltnvC9EyNAbQzyA61KA.3/dHSwvrkzfSqFotmhggDkzGSTH5l/m', 'Jogja', 'N'),
(17, 'Bambang', 'bambang@gmail.com', '$2y$10$HOUZpcHBbbWCr3fULKowX.da78YgfDUiO4hBEAKnhKKyq.kJQE5Le', 'Jogja', 'Y'),
(18, 'Syafrudin', 'udin@gmail.com', '$2y$10$HiPfAywv0w4k42GOV19N6eOuTmj6ws.7Uygxq27Fvckm8hFZ4jOKC', 'Jogja', 'Y'),
(19, 'Suseno', 'suseno@gmail.com', '$2y$10$ufzdZHrkuZwvZ6zwm2Q2P.vlPWv6gSth7/BAi5hCdWBra5Gs84d76', 'Jogja', 'Y'),
(20, 'Yudi Aja', 'yudi@gmail.com', '$2y$10$ESPwMwoe7Rk2wcAz5I6raePQT7rJYkzZLnN6KTLLYgRjq.HeVhNa6', 'Jogja', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indeks untuk tabel `tbl_iuran_wajib`
--
ALTER TABLE `tbl_iuran_wajib`
  ADD PRIMARY KEY (`idIuran`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPetugas` (`idPetugas`);

--
-- Indeks untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`idPetugas`);

--
-- Indeks untuk tabel `tbl_status_pengambilan`
--
ALTER TABLE `tbl_status_pengambilan`
  ADD PRIMARY KEY (`idStatus`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPetugas` (`idPetugas`) USING BTREE;

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idAdmin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_iuran_wajib`
--
ALTER TABLE `tbl_iuran_wajib`
  MODIFY `idIuran` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `idPetugas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_status_pengambilan`
--
ALTER TABLE `tbl_status_pengambilan`
  MODIFY `idStatus` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `idUser` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_iuran_wajib`
--
ALTER TABLE `tbl_iuran_wajib`
  ADD CONSTRAINT `tbl_iuran_wajib_ibfk_1` FOREIGN KEY (`idPetugas`) REFERENCES `tbl_petugas` (`idPetugas`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_iuran_wajib_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `tbl_user` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_status_pengambilan`
--
ALTER TABLE `tbl_status_pengambilan`
  ADD CONSTRAINT `tbl_status_pengambilan_ibfk_1` FOREIGN KEY (`idPetugas`) REFERENCES `tbl_petugas` (`idPetugas`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_status_pengambilan_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `tbl_user` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
