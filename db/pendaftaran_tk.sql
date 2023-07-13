-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2023 pada 18.43
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `pendaftaran_tk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_administrasi`
--

CREATE TABLE `biaya_administrasi` (
  `pendaftaran` double NOT NULL DEFAULT 0,
  `seragam` double NOT NULL DEFAULT 0,
  `buku_pembelajaran` double NOT NULL DEFAULT 0,
  `alat_tulis` double NOT NULL DEFAULT 0,
  `tas_sekolah` double NOT NULL DEFAULT 0,
  `spp_pertama` double NOT NULL DEFAULT 0,
  `porseni_asuransi` double NOT NULL DEFAULT 0,
  `potongan` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biaya_administrasi`
--

INSERT INTO `biaya_administrasi` (`pendaftaran`, `seragam`, `buku_pembelajaran`, `alat_tulis`, `tas_sekolah`, `spp_pertama`, `porseni_asuransi`, `potongan`) VALUES
(100000, 750000, 250000, 370000, 75000, 200000, 50000, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `kelompok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kode`, `kelompok`) VALUES
(1, 'A', 'Laba - laba'),
(2, 'B', 'Kunang - Kunang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_spp`
--

CREATE TABLE `kode_spp` (
  `kode` char(5) NOT NULL,
  `bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kode_spp`
--

INSERT INTO `kode_spp` (`kode`, `bulan`) VALUES
('01', 'Januari'),
('02', 'Februari'),
('03', 'Maret'),
('04', 'April'),
('05', 'Mei'),
('06', 'Juni'),
('07', 'Juli'),
('08', 'Agustus'),
('09', 'September'),
('10', 'Oktober'),
('11', 'November'),
('12', 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran_murid`
--

CREATE TABLE `lampiran_murid` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `akta_kelahiran` text NOT NULL,
  `kartu_keluarga` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lampiran_murid`
--

INSERT INTO `lampiran_murid` (`id`, `nik`, `akta_kelahiran`, `kartu_keluarga`) VALUES
(7, '0120120120120120', 'userDefault4.jpg', 'userDefault5.jpg'),
(8, '3603123654002002', 'userDefault6.jpg', 'userDefault7.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `no_rek` char(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `no_rek`, `nama`, `keterangan`) VALUES
(1, '4584937365', 'BCA', ''),
(2, '92093019203', 'BNI', ''),
(3, '089754635626570', 'BRI', '\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `murid`
--

CREATE TABLE `murid` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `jenis_kel` varchar(50) NOT NULL,
  `nik` char(16) DEFAULT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` char(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `negara` varchar(30) DEFAULT NULL,
  `tinggal_bersama` varchar(30) DEFAULT NULL,
  `anak_ke` char(10) DEFAULT NULL,
  `usia` double NOT NULL DEFAULT 0,
  `email` varchar(120) NOT NULL,
  `password` varchar(160) NOT NULL,
  `status` int(1) DEFAULT 0,
  `kelas_id` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `murid`
--

INSERT INTO `murid` (`id`, `nama`, `jenis_kel`, `nik`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `alamat`, `negara`, `tinggal_bersama`, `anak_ke`, `usia`, `email`, `password`, `status`, `kelas_id`, `gambar`, `tgl_dibuat`) VALUES
(1, 'Yusuf Aryadilla', 'Laki-laki', '0120120120120120', 'Jakarta, Indonesia', '2023-07-11', '08122346789', 'Tangerang Banten\r\nIndonesia', 'Indonesia', 'Orang Tua', '1', 4, 'yy@gmail.com', '$2y$10$2T67sy8ip1i1OENpPOP4LOhR2nJWOLSzkHW3lz8jZMA/CgnGjVITG', 1, 1, 'userDefault1.jpg', '2023-06-14'),
(5, 'Rerere Re', 'Perempuan', '3603123456789020', 'Jakarta', '2023-07-03', '098908900099', 'Tangerang Banten', '', '', '', 0, 'rere@gmail.com', '$2y$10$NxjiPnpLDLuQxCcAKonCVel2gwzi/ltDCVurErCdxAhw4QpdMXLW2', 0, 0, 'user.jpg', '2023-06-27'),
(6, 'Muhamad Fadil', 'Laki-laki', '3603123654002002', 'Jakarta, Indonesia', '2023-07-12', '089089089009', 'Tangerang Banten', 'Indonesia', '', '1', 6, 'fadil@gmail.com', '$2y$10$azubm4OuqtXpx/WSO0rBC.B/w.tlde/LK06fwOASbGLwuOu8Nh.Si', 1, 2, 'userDefault2.jpg', '2023-07-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(20) NOT NULL,
  `murid_id` int(11) NOT NULL,
  `status_bayar` int(1) NOT NULL DEFAULT 0,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `murid_id`, `status_bayar`, `tanggal`) VALUES
(14306736, 1, 1, '2023-07-11'),
(23620705, 5, 0, '2023-07-03'),
(72861591, 6, 1, '2023-07-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `nomor` varchar(20) NOT NULL,
  `nik` char(16) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_spp` char(5) NOT NULL DEFAULT '0',
  `tahun` varchar(4) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`nomor`, `nik`, `tanggal`, `kode_spp`, `tahun`, `harga`, `keterangan`, `metode_bayar`, `gambar`) VALUES
('TRGS2023070001', '0120120120120120', '2023-07-11', '07', '2023', 0, NULL, '1', 'userDefault1.jpg'),
('TRGS2023070002', '3603123654002002', '2023-07-12', '07', '2023', 0, NULL, '3', 'struk_bri.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `jenis_kel` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` char(20) DEFAULT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(160) NOT NULL,
  `status` int(1) DEFAULT 0,
  `level_id` int(11) NOT NULL,
  `gambar` varchar(11) NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nip`, `jenis_kel`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `alamat`, `email`, `password`, `status`, `level_id`, `gambar`, `tgl_dibuat`) VALUES
(1, 'Admin', NULL, 'Laki-laki', '', NULL, '089098765400', 'Tangerang Banten', 'admin@gmail.com', '$2y$10$h30hWCtHlhmgPJsZww2KoePn16kRfbrC0b6qXOO/ci/NIS45c8euu', 1, 0, '', '2023-06-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_murid`
--

CREATE TABLE `wali_murid` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `jenis_kel` varchar(50) NOT NULL,
  `nik` char(16) DEFAULT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` char(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(120) NOT NULL,
  `negara` varchar(30) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `murid_id` int(11) NOT NULL,
  `gambar` varchar(11) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `flag` int(1) NOT NULL COMMENT '1 = ''Ayah'', 2 = ''Ibu'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wali_murid`
--

INSERT INTO `wali_murid` (`id`, `nama`, `jenis_kel`, `nik`, `tempat_lahir`, `tgl_lahir`, `no_telp`, `alamat`, `email`, `negara`, `status`, `murid_id`, `gambar`, `tgl_dibuat`, `flag`) VALUES
(3, 'Yy', 'Laki-laki', '3016000000808908', 'Tangerang', '2023-06-16', '0898768790000', 'Tangerang Banten\r\nIndonesia', 'aryaherby29nov2k@gmail.com', 'Indonesia', 0, 1, '', '0000-00-00', 0),
(4, '', '', '', '', '2023-06-27', '', '', '', '', 0, 5, '', '0000-00-00', 0),
(5, '', '', '', 'Jakarta', '2023-07-03', '', '', '', '', 0, 5, '', '0000-00-00', 0),
(6, '', '', '', 'Jakarta', '2023-07-03', '', '', '', '', 0, 5, '', '0000-00-00', 0),
(7, '', '', '', '', '2023-07-10', '', '', '', '', 0, 1, '', '0000-00-00', 0),
(8, 'Wali Y', 'Laki-laki', '3016000000808908', 'Jakarta, Indonesia', '1995-07-10', '0898768790000', 'Tangerang Banten\r\nIndonesia', 'aryaherby29nov2k@gmail.com', 'Indonesia', 0, 1, '', '0000-00-00', 0),
(10, '', '', '', '', '2023-07-12', '', '', '', '', 0, 6, '', '0000-00-00', 1),
(12, 'Wali Fadil', '', '', 'Jakarta, Indonesia', '2023-07-12', '', 'Tangerang Banten\r\nIndonesia', 'walifadil@gmail.com', 'Indonesia', 0, 6, '', '0000-00-00', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kode_spp`
--
ALTER TABLE `kode_spp`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `lampiran_murid`
--
ALTER TABLE `lampiran_murid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nomor`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wali_murid`
--
ALTER TABLE `wali_murid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lampiran_murid`
--
ALTER TABLE `lampiran_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `murid`
--
ALTER TABLE `murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wali_murid`
--
ALTER TABLE `wali_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;
