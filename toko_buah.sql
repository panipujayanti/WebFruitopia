-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2024 pada 06.43
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
-- Database: `toko_buah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`) VALUES
(2, 'NINDA NURA\'ISYAH', 'ninda@gmail.com', '456'),
(3, 'PANI PUJA YANTI', 'pani@gamil.com', '789'),
(7, 'GILANG SUBAGIO', 'gilang@gmail.com', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(225) NOT NULL,
  `nama_buah` varchar(225) NOT NULL,
  `harga` varchar(225) NOT NULL,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_buah`, `harga`, `img`) VALUES
(29, 'Apel', '15.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_apple.png'),
(30, 'Alpukat', '17.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_avocado.png'),
(31, 'Pisang', '10.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_banana.png'),
(32, 'Jambu Biji', '12.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_guava.png'),
(33, 'Lemon', '11.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_lemon.png'),
(34, 'Jeruk', '10.500', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_orange.png'),
(35, 'Pepaya', '7.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_papaya.png'),
(36, 'Nanas', '25.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_pineapple.png'),
(37, 'Jambu Merah', '14.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_red_guava.png'),
(38, 'Stroberi', '35.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_strawberry.png'),
(39, 'Semangka', '40.000', 'https://raw.githubusercontent.com/NindaNuraisyah/AssetFruitopia/master/app/src/main/res/drawable/img_watermelon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_buah` varchar(100) NOT NULL,
  `price_per_item` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `jumlah_barang` varchar(100) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_buah`, `price_per_item`, `harga`, `jumlah_barang`, `nama_penerima`, `alamat`, `tanggal`) VALUES
(1, 'Jambu Merah', '14000', 'Rp 28.000', '2', 'Ninda Nuraisyah ', 'Desa Ciwiru ', '01-07-2024'),
(2, 'Stroberi', '35000', 'Rp 105.000', '3', 'Pani Puja Yanti ', 'Desa Cijoho ', '01-07-2024'),
(3, 'Apel', '15000', 'Rp 15.000', '1', 'Amelia Al Khansa', 'Desa Cidahu ', '01-07-2024'),
(8, 'Jambu Merah', '14000', 'Rp 42.000', '3', 'Ervina Shanum', 'Desa Sumber', '01-07-2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `nama`, `password`) VALUES
(3, 'panipujayanti@gmail.com', 'Pani Puja', 'panipuja123'),
(4, 'ninda@gmail.com', 'Ninda', 'ninda123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
