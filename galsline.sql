-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 03:06 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galsline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `username` varchar(100) NOT NULL,
  `image` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `no_ktp`, `alamat`, `no_telp`, `username`, `image`, `date_created`) VALUES
(2, 'Muhammad Iqbal', '12341234223424242', 'Lima langkah dari rumah klo rindu bertemu tinggal nonggol depan pintu.                ', '081233242121', 'iqbal', 'image1557346451.jpeg', 1557043884),
(6, 'Arfifa Rahman', '3173218721842319', 'Jl. Rawa Lumbu No.123 Bekasi', '081923428941', 'rahmanwu', 'image1557872697.jpg', 1557043884),
(7, 'krisnanda', '12344234242323523523', 'pondok hijau permai                ', '0867767676767', 'razorbeats', 'default.png', 1557983777),
(8, 'Rahman WU', '883294827492321', 'Jl. Prambanan Raya                ', '08192381928', 'Afifa', 'image1559900841.png', 1559900508);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(8) NOT NULL,
  `kd_supplier` varchar(6) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_jual` double NOT NULL,
  `harga_beli` double NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `kd_supplier`, `nama_barang`, `satuan`, `harga_jual`, `harga_beli`, `image`) VALUES
('BRG15', 'SPL001', 'Aqua 1500ml', 'Kardus', 62000, 52000, 'image1558016468.jpg'),
('BRG25', 'SPL001', 'Aqua 600ml', 'Kardus', 35000, 30000, 'image1558016699.jpg'),
('BRG28', 'SPL001', 'Aqua Galon', 'Galon', 14500, 11000, 'image1557487000.jpg'),
('BRG34', 'SPL77', 'Gas 5,5 kg', 'Tabung', 35000, 30000, 'image1557596626.jpg'),
('BRG42', 'SPL13', 'Indomie Soto', 'Kardus', 65000, 52500, 'image1557487377.jpg'),
('BRG59', 'SPL385', 'Beras Slyp Pulen 20kg', 'Karung', 210000, 200000, 'image1557586119.jpg'),
('BRG60', 'SPL001', 'Ades botol 600ml', 'Kardus', 40000, 30000, 'image1558016615.jpg'),
('BRG67', 'SPL13', 'Indomie Goreng ', 'Kardus', 70000, 60000, 'image1557487392.jpg'),
('BRG83', 'SPL13', 'Indomie Goreng Geprek', 'Kardus', 150000, 130000, 'image1557585860.jpeg'),
('BRG86', 'SPL13', 'Indomie Ayam Bawang', 'Kardus', 136000, 125000, 'image1557585767.jpg'),
('BRG87', 'SPL001', 'Aqua gelas', 'Kardus', 20500, 17500, 'image1557487415.png'),
('BRG92', 'SPL77', 'Gas 3 kg', 'Tabung', 18000, 15000, 'image1557596583.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `no_pemesanan` varchar(9) NOT NULL,
  `id_member` int(11) NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `harga_barang` double NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`no_pemesanan`, `id_member`, `kd_barang`, `nama_barang`, `harga_barang`, `jumlah`) VALUES
('P1906001', 19, 'BRG42', 'Indomie Soto', 65000, 2),
('P1906001', 19, 'BRG28', 'Aqua Galon', 14500, 1),
('P1906002', 19, 'BRG28', 'Aqua Galon', 14500, 1),
('P1906003', 19, 'BRG28', 'Aqua Galon', 14500, 2),
('P1906004', 19, 'BRG15', 'Aqua 1500ml', 62000, 1),
('P1906005', 22, 'BRG28', 'Aqua Galon', 14500, 1),
('P1906005', 22, 'BRG15', 'Aqua 1500ml', 62000, 1),
('P1906006', 23, 'BRG28', 'Aqua Galon', 14500, 4),
('P1906006', 23, 'BRG92', 'Gas 3 kg', 18000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kd_barang` varchar(6) NOT NULL,
  `id_member` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `harga_barang` double NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `nama_retail` varchar(35) NOT NULL,
  `alamat_retail` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(256) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `no_ktp`, `alamat`, `nama_retail`, `alamat_retail`, `no_telp`, `email`, `image`, `date_created`) VALUES
(19, 'Alif Hidayatullah', '12344234242323523523', 'Jl. Cut Mutia No.99 Bekasi Kota', 'Toko Kakak Alif', ' Jl. Pelabuhan Ratu No 18 Kota Bekasi Jawa Barat', '081234242424', 'arfifarahman@gmail.com', 'image1559735474.png', 1556886491),
(20, 'Muhammad Bobby', '12344234242323523523', 'Jl. Reliana nasty No.69 Bekasi kota', 'Toko bobmey sembako', ' Jl. Reliana nasty No.69 Bekasi kota', '0812342424242', 'arfifarahman1@gmail.com', 'image1557872697.jpg', 1556887310),
(21, 'krisnanda dellspiro', '123123123123123123', 'jl.cemara 3 blok e4', 'RazorTail', ' Pondok Hijau Permai', '021636267', 'razorbeats@gmail.com', 'default.png', 1558614562),
(22, 'arfifarahman', '12342437897867575768', 'Bekasi rawa lumbu', 'Toko Bungkus Rokok', ' Jl.Prambanan Raya', '02163626', 'arfifarahman2@gmail.com', 'image1559203343.png', 1559203271),
(23, 'arfifa rahman', '12343428742842423343', 'Jl. Rawa Lumbu Bekasi', 'toko bu joko', 'Jl. Rawa Lumbu Bekasi', '08128992458', 'bobbyrakan@gmail.com', 'default.png', 1561682449);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_pembayaran` varchar(255) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `no_pemesanan` varchar(8) NOT NULL,
  `tgl_bayar` int(11) NOT NULL,
  `jumlah_tranfer` double NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `nama_bank` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `no_pembayaran`, `id_pemesanan`, `no_pemesanan`, `tgl_bayar`, `jumlah_tranfer`, `id_admin`, `nama_admin`, `nama_bank`) VALUES
(4, 'PB19-1906005', 0, 'P1906001', 1561655113, 145500, 6, 'Arfifa Rahman', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `no_pemesanan` varchar(9) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `id_member` int(11) NOT NULL,
  `nama_pemesan` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `kode_pos` varchar(6) NOT NULL,
  `total_bayar` double NOT NULL,
  `status_pembayaran` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `no_pemesanan`, `tgl_pemesanan`, `id_member`, `nama_pemesan`, `alamat`, `no_telp`, `kode_pos`, `total_bayar`, `status_pembayaran`) VALUES
(0, 'P1906001', '2019-06-03', 19, 'Alif Hidayatullah', 'Jl. Cut Mutia No.99 Bekasi Kota', '081234242424', '12346', 144500, 1),
(25, 'P1906002', '2019-06-03', 19, 'Alif Hidayatullah', 'Jl. Cut Mutia No.99 Bekasi Kota', '081234242424', '12233', 14500, 0),
(26, 'P1906003', '2019-06-04', 19, 'Alif Hidayatullah', 'Jl. Cut Mutia No.99 Bekasi Kota', '081234242424', '68798', 29000, 0),
(27, 'P1906004', '2019-06-04', 19, 'Kevin', 'Jl. Cut Mutia No.99 Bekasi Kota', '081234242424', '12342', 62000, 0),
(28, 'P1906005', '2019-06-06', 22, 'arfifarahman', 'Bekasi rawa lumbu', '081932191321', '15117', 76500, 0),
(29, 'P1906006', '2019-06-28', 23, 'arfifa rahman', 'Jl. Rawa Lumbu Bekasi', '08128992458', '12345', 76000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `stok` int(5) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`kd_barang`, `nama_barang`, `stok`, `status`) VALUES
('BRG15', 'Aqua 1500ml', 2, '1'),
('BRG25', 'Aqua 600ml', 0, '0'),
('BRG28', 'Aqua Galon', 51, '1'),
('BRG34', 'Gas 5,5 kg', 0, '0'),
('BRG42', 'Indomie Soto', 50, '1'),
('BRG59', 'Beras Slyp Pulen 20kg', 0, '0'),
('BRG60', 'Ades botol 600ml', 0, '0'),
('BRG67', 'Indomie Goreng ', 0, '0'),
('BRG83', 'Indomie Goreng Geprek', 0, '0'),
('BRG86', 'Indomie Ayam Bawang', 0, '0'),
('BRG87', 'Aqua gelas', 0, '0'),
('BRG92', 'Gas 3 kg', 50, '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supplier` varchar(6) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nama`, `alamat`, `no_telp`) VALUES
('SPL001', 'PT. Aqua Indonesia', 'Jl. Gunung Gede Bogor ', '081239234212'),
('SPL36', 'PT. VIT Indonesia', 'Jl. Gunung Kembar Sejahtera', '081233242121'),
('SPL98', 'PT. Nestle Indonesia', 'Jl. Pelabuhan Ratu No.19', '081233248941'),
('SPL77', 'PT. Pertamina', 'Jl. Berkarya No.1', '081233242788'),
('SPL13', 'PT. Indofood Indonesia', 'Jl. Angkasa raya no.18', '081233242129'),
('SPL385', 'PT. Slyp Beras ', 'Jln. yang sulit ditempuh untuk meminang pak ogah                ', '081923242422');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(2) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(13, 'Alif Hidayatullah', 'arfifarahman@gmail.com', '$2y$10$uneVXslIh8rYEY4asNJGiuvNcVbb1in5mlIB32gLe7CVSMFccte4q', 1, 1, 1556886491),
(14, 'Muhammad Bobby', 'arfifarahman1@gmail.com', '$2y$10$rufIST9qKiz/RIUok8Uuf.zpwLCnZBiPpzeZElaqrngwzyTypfLNi', 1, 1, 1556887310),
(16, 'Muhammad Iqbal', 'iqbal', '$2y$10$k8SQGExmIUR67U0m607CBuJscp/.58jGG8oVpOSQQSNbD6Be7iSMG', 2, 1, 1557043884),
(18, 'Arfifa', 'rahmanwu', '$2y$10$oTCPWSyPQVBOh909Auv8Qezpx8U7sO4xN8pT5GV0LYNZYCmbW41JG', 3, 1, 1557591445),
(19, 'krisnanda', 'razorbeats', '$2y$10$7dHClACnuA25ZXf4KqRjF.TOLYUjioTLnIdWAiDEMoFsfiXeWhjAG', 2, 1, 1557983777),
(20, 'krisnanda dellspiro', 'razorbeats@gmail.com', '$2y$10$68EUuy75qw/4R1JgBo2OXOwsrJ.ZUC7v2hYFz0vCl954RHuu4r21G', 1, 1, 1558614562),
(21, 'arfifarahman', 'arfifarahman2@gmail.com', '$2y$10$gsne3QEVLL9/O.BAUHoAPO41QPaTzRMNyYEifyaVKy04jZWTF1Jx6', 1, 1, 1559203271),
(22, 'Rahman WU', 'Afifa', '$2y$10$B00a7RAsCU3b.8y9emCnjuV1znuOlGtnHpr3MnEgPbhWKbvdKIAka', 3, 1, 1559900508),
(23, 'arfifa rahman', 'bobbyrakan@gmail.com', '$2y$10$ZX6n/NdDwYV/qtJaUlGFOeJxlUgEwUEZ7ZwNNSAK09c4KKfVv74Ai', 1, 1, 1561682449);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 2, 1),
(3, 1, 2),
(7, 2, 5),
(9, 1, 4),
(10, 2, 7),
(11, 3, 6),
(12, 3, 7),
(13, 3, 3),
(14, 1, 8),
(15, 3, 1),
(16, 3, 5),
(17, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Member'),
(3, 'Manajer'),
(4, 'Pengaturan Profile'),
(5, 'Pengaturan Profile Admin'),
(6, 'Master Manajer'),
(7, 'Master'),
(8, 'Member Menu'),
(9, 'Menu ');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Member'),
(2, 'Administrator'),
(3, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'Admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 4, 'Profile Saya', 'Member/myProfileMember', 'fas fa-fw fa-user', 1),
(4, 5, 'Profile Saya', 'Admin/myProfileAdmin', 'fas fa-fw fa-user', 1),
(8, 4, 'Ganti Password', 'Member/gantiPassword', 'fas fa-fw fa-key', 1),
(9, 2, 'Dasboard Pemesanan', 'Member', 'fas fa-fw fa-tachometer-alt', 1),
(11, 5, 'Ganti Password', 'Admin/gantiPassword', 'fas fa-fw fa-key', 1),
(13, 7, 'Stok Barang', 'Admin/stokBarang', 'fas fa-fw fa-boxes', 1),
(14, 7, 'Daftar Supplier', 'Admin/supplier', 'fas fa-fw fa-people-carry', 1),
(16, 3, 'Pendaftaran Admin', 'Admin/pendaftaranAdmin', 'fas fa-fw fa-user-plus\r\n', 1),
(17, 8, 'Daftar Belanja', 'Member/keranjangPesanan', 'fas fa-fw fa-shopping-cart', 1),
(18, 9, 'Menu Manajemen', 'Menu/index', 'fas fa-fw fa-folder', 1),
(19, 9, 'Submenu Manajemen', 'Menu/subMenu', 'fas fa-fw fa-folder-open', 1),
(26, 6, 'Daftar Barang', 'Admin/daftarBarang', 'fas fa-fw fa-box', 1),
(27, 3, 'Role', 'Admin/role', 'fas fa-fw fa-user-tie', 1),
(28, 8, 'Daftar Pemesanan', 'member/daftarPemesanan', 'fas fa-fw fa-shipping-fast', 1),
(29, 7, 'Daftar Pemesanan', 'Admin/pemesanan', 'fas fa-fw fa-cart-arrow-down', 1),
(30, 7, 'Daftar Pembayaran', 'Admin/daftarPembayaran', 'fas fa-fw fa-hand-holding-usd', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
