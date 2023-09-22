-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Okt 2020 pada 02.35
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14037207_db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(12) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '5136850b6c8f3ebc66122188347efda0'),
(99, 'admin', 'ef27149daf9134b646cea2dce6583421');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` int(12) NOT NULL,
  `nama` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `username`, `password`, `time_add`) VALUES
(1, 'AgungRSD', 'agung', 'e59cd3ce33a68f536c19fedb82a7936f', '2020-06-18 13:41:43'),
(99, 'Dosen informatika', 'dosen', 'da532bf806defa26fdbeee5dd2e0d68f', '2020-06-19 17:33:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen_masuk`
--

CREATE TABLE `dosen_masuk` (
  `id_masuk` int(12) NOT NULL,
  `id_matkul` int(12) NOT NULL,
  `waktu_masuk` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `dosen_masuk`
--

INSERT INTO `dosen_masuk` (`id_masuk`, `id_matkul`, `waktu_masuk`, `status`, `deskripsi`, `latitude`, `longitude`, `mode`, `time_add`) VALUES
(29, 2, '2020-06-26', 'masuk', 'null', 'gda', 'gada', 'tatapmuka', '2020-06-26 09:12:02'),
(30, 1, '2020-06-26', 'masuk', 'null', 'gda', 'gada', 'daring', '2020-06-26 14:50:21'),
(31, 1, '2020-06-27', 'masuk', 'null', 'gda', 'gada', 'tatapmuka', '2020-06-26 17:26:12'),
(32, 2, '2020-06-27', 'masuk', 'null', 'gda', 'gada', 'daring', '2020-06-26 22:13:13'),
(36, 1, '2020-06-30', 'masuk', 'null', 'gda', 'gada', 'tatapmuka', '2020-06-30 05:31:02'),
(37, 6, '2020-07-02', 'masuk', 'null', 'gda', 'gada', 'daring', '2020-07-02 09:59:37'),
(48, 6, '2020-07-03', 'izin', 'dada', 'gada', 'gada', '0', '2020-07-03 16:56:34'),
(49, 1, '2020-07-04', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-07-03 22:34:26'),
(50, 85, '2020-07-06', 'izin', 'Ggg', 'gada', 'gada', '0', '2020-07-06 01:41:56'),
(51, 3, '2020-10-03', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-10-03 04:04:46'),
(52, 26, '2020-10-07', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-10-07 05:01:00'),
(53, 123351, '2020-10-07', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-10-07 11:55:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(12) NOT NULL,
  `nim` int(12) NOT NULL,
  `id_matkul` int(12) NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`id_krs`, `nim`, `id_matkul`, `time_add`) VALUES
(1, 180602035, 1, '2020-06-19 01:51:49'),
(2, 180602035, 2, '2020-06-25 01:34:19'),
(3, 180000000, 1, '2020-06-25 16:13:36'),
(4, 180000000, 6, '2020-07-02 10:14:18'),
(5, 180000000, 3, '2020-07-03 17:02:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(12) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `username` varchar(500) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `username`, `password`, `jurusan`, `time_add`) VALUES
(180000000, 'mahasiswa informatika', 'mahasiswa', '0357a7592c4734a8b1e12bc48e29e9e9', 'Teknik Informatika', '2020-06-19 17:32:43'),
(180473728, 'Gilang', 'Ichsan', 'c20ad4d76fe97759aa27a0c99bff6710', 'Teknik Informatika', '2020-06-22 03:46:45'),
(180602035, 'Abdul Aziz Zam Zami', 'zami', '7fc8aa00cf7a2c5bf24a004f300a0539', 'Teknik Informatika', '2020-06-18 02:48:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa_masuk`
--

CREATE TABLE `mahasiswa_masuk` (
  `id_masuk` int(12) NOT NULL,
  `id_matkul` int(12) NOT NULL,
  `nim` int(12) NOT NULL,
  `waktu_masuk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `mahasiswa_masuk`
--

INSERT INTO `mahasiswa_masuk` (`id_masuk`, `id_matkul`, `nim`, `waktu_masuk`, `status`, `deskripsi`, `latitude`, `longitude`, `mode`, `time_add`) VALUES
(14, 1, 180602035, '2020-06-26', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-06-26 14:53:28'),
(15, 2, 180602035, '2020-06-27', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-06-26 22:14:48'),
(16, 6, 180000000, '2020-07-02', 'masuk', 'null', 'gada', 'gada', 'daring', '2020-07-02 10:14:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(12) NOT NULL,
  `nama_matkul` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hari` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `mulai_jam` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `akhir_jam` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `jurusan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nip` int(12) NOT NULL,
  `jumlah_pertemuan` int(11) NOT NULL,
  `time_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`, `hari`, `mulai_jam`, `akhir_jam`, `jurusan`, `nip`, `jumlah_pertemuan`, `time_add`) VALUES
(1, 'Pemrograman Web', 'Sabtu', '05:30', '06:30', 'Teknik Informatika', 1, 3, '2020-06-19 06:48:19'),
(2, 'Jaringan Komputer', 'Selasa', '10:00', '23:30', 'Teknik Informatika', 1, 6, '2020-06-22 12:45:51'),
(3, 'Pweb', 'Sabtu', '04:00', '12:00', 'Teknik Informatika', 99, 11, '2020-07-03 17:00:52'),
(6, 'Jarkom', 'Jumat', '09:57', '23:57', 'Teknik Informatika', 99, 2, '2020-07-02 09:58:14'),
(26, 'masak', 'Rabu', '11:59', '12:59', 'Teknik Informatika', 99, 0, '2020-10-07 05:00:22'),
(85, 'G', 'Senin', '08:40', '09:40', 'Teknik Informatika', 99, 3, '2020-07-06 01:41:09'),
(556, 'M', 'Sabtu', '08:38', '09:38', 'Teknik Perkapalan', 1, 3, '2020-07-06 01:39:15'),
(123351, 'gak lapo lapo', 'Rabu', '18:52', '21:00', 'Teknik Informatika', 99, 11, '2020-10-07 11:53:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `dosen_masuk`
--
ALTER TABLE `dosen_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `FK_Krsnim` (`nim`),
  ADD KEY `FK_Krsidmatkul` (`id_matkul`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `mahasiswa_masuk`
--
ALTER TABLE `mahasiswa_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD UNIQUE KEY `id_matkul` (`id_matkul`),
  ADD KEY `FK_matkulnip` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `dosen_masuk`
--
ALTER TABLE `dosen_masuk`
  MODIFY `id_masuk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa_masuk`
--
ALTER TABLE `mahasiswa_masuk`
  MODIFY `id_masuk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `FK_Krsidmatkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`),
  ADD CONSTRAINT `FK_Krsnim` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Ketidakleluasaan untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `FK_matkulnip` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
