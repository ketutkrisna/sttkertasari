-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2020 pada 11.50
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sttkertasari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `foto_anggota` varchar(100) NOT NULL,
  `nama_anggota` varchar(30) NOT NULL,
  `lahir_anggota` date NOT NULL,
  `kelamin_anggota` enum('laki-laki','perempuan') NOT NULL,
  `nomer_anggota` varchar(15) NOT NULL,
  `alamat_anggota` varchar(50) NOT NULL,
  `jabatan_anggota` enum('ketua','wakil ketua','bendahara','humas','anggota') NOT NULL,
  `status_anggota` enum('aktif','non aktif','menikah','drop out') NOT NULL,
  `masuk_anggota` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `foto_anggota`, `nama_anggota`, `lahir_anggota`, `kelamin_anggota`, `nomer_anggota`, `alamat_anggota`, `jabatan_anggota`, `status_anggota`, `masuk_anggota`) VALUES
(1, 'unnamed.jpg', 'wayan handika yanas', '1996-11-10', 'laki-laki', '082222222', 'mulyasari', 'ketua', 'aktif', '2015-11-02'),
(2, 'unnamed11.jpg', 'wayan widastre', '1996-11-02', 'laki-laki', '082322123', 'mulyasari', 'wakil ketua', 'aktif', '2015-11-09'),
(3, 'unnamed1.jpg', 'ketut karteyase', '1992-11-02', 'laki-laki', '08232312', 'mulyasari', 'bendahara', 'aktif', '2012-11-10'),
(4, '347c9717fe785ebd05829fab3f27536d.jpg', 'ketut krisna', '2020-11-02', 'laki-laki', '08212323', 'mulyasari', 'humas', 'aktif', '2015-11-09'),
(5, 'b9fbaaf2706b523ee3d1967ddb0f1f27.jpg', 'wayan heri subagie', '1996-11-02', 'laki-laki', '0821', 'mulya agung', 'anggota', 'menikah', '2015-11-02'),
(6, 'spider-man-spider-bite.jpg', 'komang ardike', '1993-11-02', 'laki-laki', '082378645', 'mulyasari', 'anggota', 'aktif', '2013-11-02'),
(7, 'kosong.jpg', 'wayan rida', '1997-11-02', 'laki-laki', '', 'mulya agung', 'anggota', 'non aktif', '2014-11-02'),
(8, 'kosong.jpg', 'yogi plau', '2002-11-02', 'laki-laki', '08', 'mulyasari', 'humas', 'aktif', '2016-11-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `isi_kegiatan` varchar(500) NOT NULL,
  `tanggal_kegiatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `isi_kegiatan`, `tanggal_kegiatan`) VALUES
(1, 'Ngatok celeng guling', 'Use data attributes to easily control the position of the carousel. data-slide accepts the keywords prev or next, which alters the slide position relative to its current position. Alternatively, use data-slide-to to pass a raw slide index to the carousel data-slide-to=&quot;2&quot;, which shifts the slide position to a particular index beginning with 0.', '1604501838'),
(3, 'Berburu janda', 'kegiatan dilakukan pada hari kamis tanngal 15 februari 2020 harap semua anggota laki-laki datang semua, terima kasih', '1604564011');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_postkomen` int(20) NOT NULL,
  `foto_komentar` varchar(20) NOT NULL,
  `nama_komentar` varchar(30) NOT NULL,
  `isi_komentar` varchar(200) NOT NULL,
  `tanggal_komentar` varchar(30) NOT NULL,
  `ip_komentar` varchar(30) NOT NULL,
  `level_komentar` enum('admin','users') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_postkomen`, `foto_komentar`, `nama_komentar`, `isi_komentar`, `tanggal_komentar`, `ip_komentar`, `level_komentar`) VALUES
(23, 2, 'komenadmin.png', 'Admin', 'oke dah coba dlu', '1604500790', '::1', 'admin'),
(24, 3, 'komenadmin.png', 'Admin', 'Silahkan komentar yang sopan,,', '1604500838', '::1', 'admin'),
(29, 3, 'komenuser.jpg', 'Admin', 'apa', '1604503934', '::1', 'users'),
(37, 3, 'komenadmin.png', 'Admin', 'ok', '1604545392', '::1', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posting`
--

CREATE TABLE `posting` (
  `id_posting` int(11) NOT NULL,
  `foto_posting` varchar(100) NOT NULL,
  `judul_posting` varchar(50) NOT NULL,
  `isi_posting` longtext NOT NULL,
  `tanggal_posting` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `posting`
--

INSERT INTO `posting` (`id_posting`, `foto_posting`, `judul_posting`, `isi_posting`, `tanggal_posting`) VALUES
(1, '2.jpg', 'Laba-laba nakal', 'apa ajang boleh yang penting posting', '1604496605'),
(2, '3.jpg', 'Iron man', 'sip dah apa aja boleh ya', '1604497056'),
(3, '347c9717fe785ebd05829fab3f27536d.jpg', 'Spiderman ongol-ongol cok', 'Spiderman adalah hewan pembela kebenaran mari kita dukung spiderman untuk coli ditempat umum, MANTAP', '1604498056'),
(6, 'spidey-web-ft.jpg', 'Jarings', 'Kontolah anda ini', '1604548661');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username_user` varchar(20) NOT NULL,
  `password_user` varchar(30) NOT NULL,
  `level_user` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username_user`, `password_user`, `level_user`) VALUES
(1, 'admin', 'admin', '12345', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`id_posting`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `posting`
--
ALTER TABLE `posting`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
