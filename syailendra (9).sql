-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 05:33 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `syailendra`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `kode_brg_keluar` varchar(12) NOT NULL,
  `kode_brg_servis` varchar(12) NOT NULL,
  `kode_pengerjaan` varchar(12) NOT NULL,
  `grand_total` int(12) NOT NULL,
  `potongan` int(12) NOT NULL,
  `total_bayar` int(12) NOT NULL,
  PRIMARY KEY (`kode_brg_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`kode_brg_keluar`, `kode_brg_servis`, `kode_pengerjaan`, `grand_total`, `potongan`, `total_bayar`) VALUES
('KCSMDP1', 'CSMDP1', 'PCSMDP1', 107000, 0, 107000),
('KCSMDP2', 'CSMDP2', 'PCSMDP2', 52000, 0, 52000),
('KCSMDP3', 'CSMDP3', 'PCSMDP3', 30000, 30000, 0),
('KCSMDP4', 'CSMDP4', 'PCSMDP4', 85000, 30000, 55000),
('KCSMKA1', 'CSMKA1', 'PCSMKA1', 35000, 35000, 0),
('KCSMKA2', 'CSMKA2', 'PCSMKA2', 133000, 35000, 98000),
('KCSMKA3', 'CSMKA3', 'PCSMKA3', 42500, 42500, 0),
('KCSMKA4', 'CSMKA4', 'PCSMKA4', 133000, 35000, 98000),
('KCSMKA5', 'CSMKA5', 'PCSMKA5', 62500, 0, 62500),
('KCSMKA6', 'CSMKA6', 'PCSMKA6', 133000, 35000, 98000),
('KCSMKA7', 'CSMKA7', 'PCSMKA7', 133000, 133000, 0),
('KCSMKA8', 'CSMKA8', 'PCSMKA8', 62500, 55000, 7500),
('KCSMKG1', 'CSMKG1', 'PCSMKG1', 100000, 50000, 50000),
('KCSMKG2', 'CSMKG2', 'PCSMKG2', 75000, 0, 75000),
('KCSMKG3', 'CSMKG3', 'PCSMKG3', 50000, 0, 50000),
('KCSMMC1', 'CSMMC1', 'PCSMMC1', 59000, 25000, 34000),
('KCSMMC3', 'CSMMC3', 'PCSMMC3', 40000, 25000, 15000),
('KCSMMC4', 'CSMMC4', 'PCSMMC4', 32000, 32000, 0),
('KGREAC1', 'GREAC1', 'PGREAC1', 275000, 0, 275000),
('KGREDP1', 'GREDP1', 'PGREDP1', 40000, 40000, 0),
('KGREDP2', 'GREDP2', 'PGREDP2', 40000, 0, 40000),
('KGREFR1', 'GREFR1', 'PGREFR1', 107000, 107000, 0),
('KGREKG1', 'GREKG1', 'PGREKG1', 58000, 58000, 0),
('KLGEAC1', 'LGEAC1', 'PLGEAC1', 353000, 0, 353000),
('KLGEAC2', 'LGEAC2', 'PLGEAC2', 123000, 123000, 0),
('KLGEAC3', 'LGEAC3', 'PLGEAC3', 90000, 0, 90000),
('KLGEFR1', 'LGEFR1', 'PLGEFR1', 107000, 80000, 27000),
('KPLPDP1', 'PLPDP1', 'PPLPDP1', 60000, 30000, 30000),
('KPLPMC1', 'PLPMC1', 'PPLPMC1', 32000, 32000, 0),
('KPLPMC2', 'PLPMC2', 'PPLPMC2', 40000, 40000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_servis`
--

CREATE TABLE IF NOT EXISTS `barang_servis` (
  `kode_brg_servis` varchar(12) NOT NULL,
  `kode_produk` varchar(2) NOT NULL,
  `id_perusahaan` varchar(3) NOT NULL,
  `type_brg` varchar(15) NOT NULL,
  `no_seri_brg` varchar(20) NOT NULL,
  `kode_statusgaransi` varchar(2) NOT NULL,
  `keluhan_brg` varchar(50) NOT NULL,
  `kelengkapan_brg` varchar(50) NOT NULL,
  `id_konsumen` varchar(5) NOT NULL,
  PRIMARY KEY (`kode_brg_servis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_servis`
--

INSERT INTO `barang_servis` (`kode_brg_servis`, `kode_produk`, `id_perusahaan`, `type_brg`, `no_seri_brg`, `kode_statusgaransi`, `keluhan_brg`, `kelengkapan_brg`, `id_konsumen`) VALUES
('CSMDP1', 'DP', 'CSM', 'CWD 1138 P', 'CWD151611D798989899', 'NG', 'Kurang Panas', 'Lengkap', 'K1'),
('CSMDP2', 'DP', 'CSM', 'CWD 1150 P', 'CWD151611D79898007', 'NG', 'Mati', 'Tanpa Dos', 'K6'),
('CSMDP3', 'DP', 'CSM', 'CWD 1310', 'CWD11209I000767865', 'FG', 'Bocor', 'Hanya Unit', 'K14'),
('CSMDP4', 'DP', 'CSM', 'CWD 1180', 'CWD078957H0000726276', 'GS', 'Mati', 'Tanpa Dos', 'K22'),
('CSMDP5', 'DP', 'CSM', 'CWD 1180', 'CWD000564H00086776', 'GP', 'Bocor', 'Lengkap', 'K35'),
('CSMKA1', 'KA', 'CSM', '16 SDB', 'CFA12345g00007896', 'FG', 'Motor mati', 'Lengkap', 'K2'),
('CSMKA2', 'KA', 'CSM', '16 SKM', 'CFA12345g00007896', 'GS', 'Mesin Mati', 'Lengkap', 'K7'),
('CSMKA3', 'KA', 'CSM', '12 DAR N', 'CFA008977F0006787', 'FG', 'Mati', 'Hanya Mesin', 'K13'),
('CSMKA4', 'KA', 'CSM', '16 DHC', 'CFA1157K65765775', 'GS', 'Mati', 'Lengkap', 'K15'),
('CSMKA5', 'KA', 'CSM', '16 SDB', 'CFA00234354H0007887', 'NG', 'Kipas Tidak Bisa Cepat', 'Hanya Unit', 'K17'),
('CSMKA6', 'KA', 'CSM', '16-SDB', 'CFA008686H0007987887', 'GS', 'Mati', 'Lengkpa', 'K19'),
('CSMKA7', 'KA', 'CSM', '12 DSE', 'CFA008797I000087976', 'FG', 'Mati', 'Hanya Mesin', 'K23'),
('CSMKA8', 'KA', 'CSM', '16 SKM', 'CFA00897H000768766', 'GS', 'Neck Pecah', 'Unit mesin', 'K33'),
('CSMKA9', 'KA', 'CSM', '12 CWF', 'CFA02445I00089877', 'FG', 'Mesin Mati', 'Unit Mesin', 'K34'),
('CSMKG1', 'KG', 'CSM', 'CGC 3000', 'CGC123883G00003131', 'GS', 'Api berwarna merah/ tidak bisa biru', 'Tanpa Dos', 'K3'),
('CSMKG2', 'KG', 'CSM', 'CGC 121 P', 'CG0121222K00012222', 'NG', 'Api berwarna merah/ tidak bisa biru', 'Lengkap', 'K9'),
('CSMKG3', 'KG', 'CSM', 'CG 3500', 'Cgc0012356H000026257', 'NG', 'Tungku kanan tidak bisa', 'Hanya Unit', 'K24'),
('CSMMC1', 'MC', 'CSM', 'CRJ-624 ', 'CRj078978K700008877', 'GS', 'Nasi Tidak Matang', 'Unit dan Kabel', 'K8'),
('CSMMC2', 'MC', 'CSM', 'CRJ 107', 'CRC00789777H00088887', 'NG', 'Nasi Bau', 'Hanya Panci dan kabel, TC', 'K27'),
('CSMMC3', 'MC', 'CSM', 'CRJ 101 TS', 'CRC0089813K00002221', 'GS', 'Nasi gosong', 'Lengkap', 'K28'),
('CSMMC4', 'MC', 'CSM', 'CRJ 602', 'CRC000787H0005665', 'FG', 'Nasi Kering', 'Kabel', 'K32'),
('GREAC1', 'AC', 'GRE', 'G Ac224 K', 'G0098977778', 'NG', 'Tidak bisa dingin', 'Lengkap', 'K18'),
('GREDP1', 'DP', 'GRE', 'DP G222', 'GDP00898776547', 'GS', 'Air Kurang Panas', 'Hanya Unit', 'K12'),
('GREDP2', 'DP', 'GRE', 'GDP 20K', 'GDP098777687', 'NG', 'Mati', 'Lengkap', 'K21'),
('GREFR1', 'FR', 'GRE', 'G-F12 G', 'GF15467G000002182', 'FG', 'Tidak Bisa Dingin', 'Lengkap', 'K4'),
('GREKG1', 'KG', 'GRE', 'G KG-00234', 'GKG', 'FG', 'Tidak bisa nyala', 'Tanpa Dos', 'K20'),
('LGEAC1', 'AC', 'LGE', 'LG AC022 F', 'LGAC00089876', 'NG', 'Remot Tidak Bisa', 'Indoor', 'K16'),
('LGEAC2', 'AC', 'LGE', 'LG AC022 F', 'LGAC000892333', 'FG', 'Tidak Dingin', 'Lengkap', 'K29'),
('LGEAC3', 'AC', 'LGE', 'LG AC021 F', 'LGAC000890012', 'NG', 'mati', 'Lengkap', 'K30'),
('LGEFR1', 'FR', 'LGE', 'FLG 122K', 'FL0000002344', 'GS', 'Kurang dingin', 'Lengkap', 'K10'),
('LGEFR2', 'FR', 'LGE', 'LG F-0012H', 'LGF006777751', 'FG', 'Tidak Bisa Dingin', 'Lengkap', 'K31'),
('PLPDP1', 'DP', 'PLP', 'P217 K', 'PD09888', 'GS', 'Tidak Panas', 'Lengkap, Tanpa Dos', 'K5'),
('PLPKG1', 'KG', 'PLP', 'P KG0089 B', 'PKG000898998', 'GP', 'Knop Rusak', 'Lengkap', 'K26'),
('PLPMC1', 'MC', 'PLP', 'PMC 989 H', 'PMC00087778', 'FG', 'Nasi Benyek', 'Lengkap', 'K11'),
('PLPMC2', 'MC', 'PLP', 'P MC 223 H', 'PMC00007776', 'FG', 'Mati', 'Lengkap', 'K25');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_jasa`
--

CREATE TABLE IF NOT EXISTS `biaya_jasa` (
  `kode_jasa` varchar(4) COLLATE latin1_bin NOT NULL,
  `kode_produk` varchar(3) COLLATE latin1_bin NOT NULL,
  `kategori_jasa` text COLLATE latin1_bin NOT NULL,
  `biaya_jasa` int(9) NOT NULL,
  `status_delete` int(1) NOT NULL,
  `user_delete` int(3) NOT NULL,
  `tgl_update` date NOT NULL,
  PRIMARY KEY (`kode_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `biaya_jasa`
--

INSERT INTO `biaya_jasa` (`kode_jasa`, `kode_produk`, `kategori_jasa`, `biaya_jasa`, `status_delete`, `user_delete`, `tgl_update`) VALUES
('JS1', 'DP', 0x5365727669732052696e67616e, 30000, 0, 0, '2017-07-19'),
('JS2', 'DP', 0x536572766973204b6f6d706c656b73, 40000, 0, 0, '2017-07-19'),
('JS3', 'AC', 0x436c65616e696e67203120706b, 45000, 0, 0, '2017-07-19'),
('JS4', 'KA', 0x5365727669732052696e67616e, 35000, 0, 0, '2017-07-19'),
('JS5', 'KA', 0x536572766973204b6f6d706c656b73, 55000, 0, 0, '2017-07-31'),
('JS6', 'MC', 0x5365727669732052696e67616e, 25000, 0, 0, '2017-07-31'),
('JS7', 'PA', 0x5365727669732052696e67616e, 50000, 0, 0, '2017-07-31'),
('JS8', 'FR', 0x5365727669732052696e67616e, 80000, 0, 0, '2017-07-31'),
('JS9', 'KG', 0x5365727669732052696e67616e, 50000, 0, 0, '2017-08-01'),
('JT0', 'TV', 0x5365727669732052696e67616e, 55000, 0, 0, '2017-08-04'),
('JT1', 'TV', 0x536572766973204b6f6d706c656b73, 90000, 0, 0, '2017-08-04'),
('JT2', 'AC', 0x426f6e676b617220506173616e67203c203220504b, 275000, 0, 0, '2017-08-04'),
('JT3', 'AC', 0x426f6e676b617220506173616e67203e3d3220504b, 350000, 0, 0, '2017-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengerjaan`
--

CREATE TABLE IF NOT EXISTS `detail_pengerjaan` (
  `kode_dtl_pengerjaan` int(12) NOT NULL AUTO_INCREMENT,
  `kode_pengerjaan` varchar(12) NOT NULL,
  `kode_brg_servis` varchar(12) NOT NULL,
  `kode_part` varchar(6) NOT NULL,
  `jml_pakai` int(2) NOT NULL,
  PRIMARY KEY (`kode_dtl_pengerjaan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `detail_pengerjaan`
--

INSERT INTO `detail_pengerjaan` (`kode_dtl_pengerjaan`, `kode_pengerjaan`, `kode_brg_servis`, `kode_part`, `jml_pakai`) VALUES
(1, 'PCSMDP1', 'CSMDP1', 'DP1', 1),
(2, 'PCSMDP1', 'CSMDP1', 'DP2', 1),
(6, 'PCSMKG1', 'CSMKG1', 'KG1', 2),
(7, 'PGREFR1', 'GREFR1', 'FR1', 1),
(8, 'PCSMKA2', 'CSMKA2', 'KA1', 1),
(10, 'PCSMMC1', 'CSMMC1', 'MC1', 1),
(11, 'PCSMMC1', 'CSMMC1', 'MC2', 1),
(12, 'PPLPDP1', 'PLPDP1', 'DP3', 2),
(13, 'PCSMDP2', 'CSMDP2', 'DP1', 1),
(14, 'PLGeAc1', 'LGeAc1', 'AC1', 1),
(15, 'PLGEFR1', 'LGEFR1', 'FR1', 1),
(16, 'PCSMKA4', 'CSMKA4', 'KA1', 1),
(17, 'PCSMKA3', 'CSMKA3', 'KA2', 1),
(18, 'PPLPMC1', 'PLPMC1', 'MC2', 1),
(19, 'PCSMKA5', 'CSMKA5', 'KA2', 1),
(20, 'Pcsmkg2', 'csmkg2', 'KG1', 1),
(21, 'Pgreac1', 'greac1', 'AC1', 1),
(22, 'PCSmka6', 'CSmka6', 'KA1', 1),
(23, 'Pgrekg1', 'grekg1', 'KG2', 2),
(24, 'PCSMDP4', 'CSMDP4', 'DP2', 1),
(25, 'Pcsmka7', 'csmka7', 'KA1', 1),
(26, 'PPLPMC2', 'PLPMC2', 'MC3', 1),
(27, 'PLGEAC2', 'LGEAC2', 'AC1', 1),
(28, 'PLGEAC3', 'LGEAC3', 'AC2', 1),
(29, 'PLGEFR2', 'LGEFR2', 'FR1', 1),
(30, 'PCSMKA8', 'CSMKA8', 'KA2', 1),
(31, 'PCSMMC4', 'CSMMC4', 'MC2', 1),
(32, 'PCSMMC3', 'CSMMC3', 'MC3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE IF NOT EXISTS `jenis_produk` (
  `kode_produk` varchar(2) NOT NULL,
  `nama_produk` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`kode_produk`, `nama_produk`) VALUES
('AC', 'Air Conditoner'),
('DP', 'Dispenser'),
('FR', 'Freezer/Kulkas'),
('KA', 'Kipas Angin'),
('KG', 'Kompor Gas'),
('MC', 'Majicom'),
('PA', 'Pompa Air'),
('TV', 'Televisi');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE IF NOT EXISTS `konsumen` (
  `id_konsumen` varchar(5) NOT NULL,
  `nama_konsumen` varchar(25) NOT NULL,
  `alamat_konsumen` varchar(50) NOT NULL,
  `no_telp_konsumen` varchar(13) NOT NULL,
  PRIMARY KEY (`id_konsumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `alamat_konsumen`, `no_telp_konsumen`) VALUES
('K1', 'Tri Budi Harto', 'Jl. Gemah Raya No. 24', '0897665876546'),
('K10', 'Pak Abar', 'Jl Plamongan Raya No 56', '0896778766667'),
('K11', 'Melati', 'Jl. Blambangan 5 ', '0888888456456'),
('K12', 'Bambang', 'Jl. Rawasari 1 No. 54', '088777565656'),
('K13', 'Kusnadi', 'Ananda', '0816787678767'),
('K14', 'Amanda', 'Jl. Plewan 8', '0818882678768'),
('K15', 'Ibu Surati', 'Jl Penggaron Lor RT 4 RW IV', '0896678566746'),
('K16', 'Bu Zainap', 'Jl. Jamus Raya No 77', '081889889889'),
('K17', 'Arif', 'Jl. Morodadi 18', '0245656545'),
('K18', 'Yayan', 'Jl Genuk Indah no 18', '0887676575575'),
('K19', 'Hisyam', 'Jl. Merapi', '0897775755654'),
('K2', 'Ahmad Lubabul', 'Jl Dempel Raya 48', '081999888666'),
('K20', 'Kusna', 'Jl. Bangetayu wetan', '0887676667665'),
('K21', 'Aris', 'Jl. Gemah Raya', '0897778688886'),
('K22', 'Jaelani', 'Jl Penggaron kidul 15', '081222787688'),
('K23', 'Akbar', 'Jl Jamus raya No 20', '08788898889'),
('K24', 'Bu Dewi', 'Jl. Melati 5 No 222 ', '088812228888'),
('K25', 'Solekha', 'Jl Ganginsari G4 No 60', '088867868777'),
('K26', 'Puji Lestari', 'Jl Tlogosari Kulon  No 129', '081888822222'),
('K27', 'Ririn', 'Jl Giwangan', '088878788887'),
('K28', 'Pak Sanijo', 'Jl. Gemah Raya', '0888123123123'),
('K29', 'Pak joko', 'Jl. Plewan No 87', '0892228899899'),
('K3', 'Ibu Lin', 'Jl Gangen sari 5', '89677567456'),
('K30', 'Bpk Atmoko', 'Jl. kwaron 7 no 88', '0889899899898'),
('K31', 'Ida D', 'Jl Woltermonginsidi 118', '088898777626'),
('K32', 'Ananda N', 'Jl. blambangan 6', '089667588882'),
('K33', 'Bambang', 'Jl. Ganginsari 5 No 67', '088823457772'),
('K34', 'Arman', 'Jl. Kudan Raya No 244', '088876766666'),
('K35', 'Ninik', 'Jl. Bangetayu Wetan Rt4 Rw5', '088898666657'),
('K4', 'Tiki Kristianto', 'JL. Kali Langse 5', '089123444888'),
('K5', 'Andi M', 'Jl Trenggiling 5 no 15', '083838566567'),
('K6', 'Silvi ', 'Jl Bangetayu Kulon RT4 RW 5', '089776776776'),
('K7', 'Armand', 'Jl Melati', '089766876876'),
('K8', 'Bu Siti M', 'Jl. Jamus Raya no. 254', '0896778566756'),
('K9', 'Bu Ririn', 'Jl. Malangsari 8 no 24', '081222345345');

-- --------------------------------------------------------

--
-- Table structure for table `pengerjaan`
--

CREATE TABLE IF NOT EXISTS `pengerjaan` (
  `kode_pengerjaan` varchar(12) NOT NULL,
  `kode_brg_servis` varchar(12) NOT NULL,
  `id_teknisi` varchar(3) NOT NULL,
  `kode_jasa` varchar(4) NOT NULL,
  PRIMARY KEY (`kode_pengerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengerjaan`
--

INSERT INTO `pengerjaan` (`kode_pengerjaan`, `kode_brg_servis`, `id_teknisi`, `kode_jasa`) VALUES
('PCSMDP1', 'CSMDP1', 'T3', 'JS2'),
('PCSMDP2', 'CSMDP2', 'T2', 'JS2'),
('PCSMDP3', 'CSMDP3', 'T4', 'JS1'),
('PCSMDP4', 'CSMDP4', 'T2', 'JS1'),
('PCSMKA1', 'CSMKA1', 'T2', 'JS4'),
('PCSMKA2', 'CSMKA2', 'T1', 'JS4'),
('PCSMKA3', 'CSMKA3', 'T4', 'JS4'),
('PCSMKA4', 'CSMKA4', 'T3', 'JS4'),
('PCSMKA5', 'CSMKA5', 'T4', 'JS5'),
('PCSMKA6', 'CSMKA6', 'T4', 'JS4'),
('PCSMKA7', 'CSMKA7', 'T1', 'JS4'),
('PCSMKA8', 'CSMKA8', 'T2', 'JS5'),
('PCSMKG1', 'CSMKG1', 'T2', 'JS9'),
('PCSMKG2', 'CSMKG2', 'T1', 'JS9'),
('PCSMKG3', 'CSMKG3', 'T1', 'JS9'),
('PCSMMC1', 'CSMMC1', 'T1', 'JS6'),
('PCSMMC3', 'CSMMC3', 'T3', 'JS6'),
('PCSMMC4', 'CSMMC4', 'T2', 'JS6'),
('PGREAC1', 'GREAC1', 'T3', 'JT2'),
('PGREDP1', 'GREDP1', 'T4', 'JS2'),
('PGREDP2', 'GREDP2', 'T2', 'JS2'),
('PGREFR1', 'GREFR1', 'T1', 'JS8'),
('PGREKG1', 'GREKG1', 'T2', 'JS9'),
('PLGEAC1', 'LGEAC1', 'T1', 'JT2'),
('PLGEAC2', 'LGEAC2', 'T4', 'JS3'),
('PLGEAC3', 'LGEAC3', 'T1', 'JS3'),
('PLGEFR1', 'LGEFR1', 'T2', 'JS8'),
('PLGEFR2', 'LGEFR2', 'T4', 'JS8'),
('PPLPDP1', 'PLPDP1', 'T1', 'JS1'),
('PPLPKG1', 'PLPKG1', 'T1', 'JS9'),
('PPLPMC1', 'PLPMC1', 'T1', 'JS6'),
('PPLPMC2', 'PLPMC2', 'T3', 'JS6');

-- --------------------------------------------------------

--
-- Table structure for table `rekanan_perusahaan`
--

CREATE TABLE IF NOT EXISTS `rekanan_perusahaan` (
  `id_perusahaan` varchar(5) COLLATE latin1_bin NOT NULL,
  `nama_perusahaan` varchar(20) COLLATE latin1_bin NOT NULL,
  `merek` varchar(15) COLLATE latin1_bin NOT NULL,
  `alamat_perusahaan` varchar(25) COLLATE latin1_bin NOT NULL,
  `no_telp_perusahaan` varchar(13) COLLATE latin1_bin NOT NULL,
  `email_perusahaan` varchar(30) COLLATE latin1_bin NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `lama_garansi` int(1) NOT NULL,
  `syarat_garansi` varchar(50) COLLATE latin1_bin NOT NULL,
  `status_delete` int(1) NOT NULL,
  `user_delete` int(3) NOT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `rekanan_perusahaan`
--

INSERT INTO `rekanan_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `merek`, `alamat_perusahaan`, `no_telp_perusahaan`, `email_perusahaan`, `tgl_bergabung`, `lama_garansi`, `syarat_garansi`, `status_delete`, `user_delete`) VALUES
('CSM', 'PT. Star Cosmos Grou', 'Cosmos', 'Jl. Gatot Subroto Blok E ', '024666678', 'sales@starcosmosgroup.com', '2016-11-08', 2, 'Foto Copy KTP, Kartu Garansi, Kwitansi Pembelian', 0, 0),
('GRE', 'PT. Gree Elektronik', 'Gree', 'JL puspogiwang 15 pamular', '081245345345', 'gree@greegroup.com', '2015-04-07', 1, 'kartu garansi, kwitansi pembelian', 0, 0),
('LGE', 'PT. LG Elektronik', 'LG', 'Jl. Puspogiwang 55', '081344344333', 'gree@greegroup.com', '2014-12-07', 1, 'Kartu Garansi', 0, 0),
('PLP', 'PT. PHILIPS ', 'Philips', 'Jl. MT Haryono No 565', '02468667865', 'philips@philipsgroup.com', '2016-05-12', 1, 'kartu garansi, kwitansi pembelian', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE IF NOT EXISTS `sparepart` (
  `kode_part` varchar(6) COLLATE latin1_bin NOT NULL,
  `nama_part` varchar(20) COLLATE latin1_bin NOT NULL,
  `harga_part` int(9) NOT NULL,
  `kode_produk` varchar(3) COLLATE latin1_bin NOT NULL,
  `jml_stok` int(3) NOT NULL,
  `status_delete` int(1) NOT NULL,
  `user_delete` int(3) NOT NULL,
  PRIMARY KEY (`kode_part`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`kode_part`, `nama_part`, `harga_part`, `kode_produk`, `jml_stok`, `status_delete`, `user_delete`) VALUES
('AC1', 'Modul AC', 78000, 'AC', 3, 0, 0),
('AC2', 'Remot AC LG', 45000, 'AC', 7, 0, 0),
('DP1', 'TRC 85', 12000, 'DP', 16, 0, 0),
('DP2', 'Hot Tank', 55000, 'DP', 11, 0, 0),
('DP3', 'TRC 90', 15000, 'DP', 0, 0, 0),
('FR1', 'Relay (TOR) 6A ', 27000, 'FR', 7, 0, 0),
('KA1', 'Motor HD 16"', 98000, 'KA', 2, 0, 0),
('KA2', 'Neck WF Grey', 7500, 'KA', 8, 0, 0),
('KG1', 'burner', 25000, 'KG', 4, 0, 0),
('KG2', 'Knop Cosmos', 4000, 'KG', 0, 0, 0),
('MC1', 'Side heater plat', 27000, 'MC', 19, 0, 0),
('MC2', 'TRC 80', 7000, 'MC', 27, 0, 0),
('MC3', 'center thermostat', 15000, 'MC', 23, 0, 0),
('MC4', 'Top Heater', 23500, 'MC', 14, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `statusbrg_update`
--

CREATE TABLE IF NOT EXISTS `statusbrg_update` (
  `kode_statusbrg_update` int(11) NOT NULL AUTO_INCREMENT,
  `kode_brg_servis` varchar(12) NOT NULL,
  `statusbrg_update` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_pengerjaan` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`kode_statusbrg_update`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `statusbrg_update`
--

INSERT INTO `statusbrg_update` (`kode_statusbrg_update`, `kode_brg_servis`, `statusbrg_update`, `tgl_masuk`, `tgl_pengerjaan`, `tgl_keluar`, `id_user`) VALUES
(1, 'CSMDP1', 'Keluar', '2017-07-31', '2017-08-03', '2017-08-04', 1),
(2, 'CSMKA1', 'Keluar', '2017-07-31', '2017-08-04', '2017-08-04', 1),
(3, 'CSMKG1', 'Keluar', '2017-08-01', '2017-08-01', '2017-08-04', 1),
(4, 'GREFR1', 'Keluar', '2017-08-02', '2017-08-03', '2017-08-04', 1),
(5, 'PLPDP1', 'Keluar', '2017-08-03', '2017-08-04', '2017-08-04', 1),
(6, 'CSMDP2', 'Keluar', '2017-08-03', '2017-08-04', '2017-08-05', 1),
(7, 'CSMKA2', 'Keluar', '2017-08-03', '2017-08-03', '2017-08-04', 1),
(8, 'CSMMC1', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-04', 1),
(9, 'CSMKG2', 'Keluar', '2017-08-04', '2017-08-05', '2017-08-05', 1),
(10, 'LGEFR1', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-04', 1),
(11, 'PLPMC1', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-05', 1),
(12, 'GREDP1', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-05', 1),
(13, 'CSMKA3', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-04', 1),
(14, 'CSMDP3', 'Keluar', '2017-08-04', '2017-08-05', '2017-08-05', 1),
(15, 'CSMKA4', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-05', 1),
(16, 'LGEAC1', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-05', 1),
(17, 'CSMKA5', 'Keluar', '2017-08-04', '2017-08-04', '2017-08-04', 1),
(18, 'GREAC1', 'Keluar', '2017-08-04', '2017-08-05', '2017-08-08', 1),
(19, 'CSMKA6', 'Keluar', '2017-08-05', '2017-08-05', '2017-08-08', 1),
(20, 'GREKG1', 'Keluar', '2017-08-05', '2017-08-05', '2017-08-08', 1),
(21, 'GREDP2', 'Keluar', '2017-08-07', '2017-08-07', '2017-08-08', 1),
(22, 'CSMDP4', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(23, 'CSMKA7', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(24, 'CSMKG3', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(25, 'PLPMC2', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(26, 'PLPKG1', 'Dikerjakan', '2017-08-09', '2017-08-09', '0000-00-00', 1),
(27, 'CSMMC2', 'Masuk', '2017-08-09', '0000-00-00', '0000-00-00', 1),
(28, 'CSMMC3', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(29, 'LGEAC2', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(30, 'LGEAC3', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(31, 'LGEFR2', 'Dikerjakan', '2017-08-09', '2017-08-09', '0000-00-00', 1),
(32, 'CSMMC4', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(33, 'CSMKA8', 'Keluar', '2017-08-09', '2017-08-09', '2017-08-09', 1),
(34, 'CSMKA9', 'Masuk', '2017-08-09', '0000-00-00', '0000-00-00', 1),
(35, 'CSMDP5', 'Masuk', '2017-08-09', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_garansi`
--

CREATE TABLE IF NOT EXISTS `status_garansi` (
  `kode_statusgaransi` varchar(3) NOT NULL,
  `keterangan` varchar(26) NOT NULL,
  PRIMARY KEY (`kode_statusgaransi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_garansi`
--

INSERT INTO `status_garansi` (`kode_statusgaransi`, `keterangan`) VALUES
('FG', 'Garansi Servis & Sparepart'),
('GP', 'Garansi Sparepart'),
('GS', 'Garansi Servis'),
('NG', 'Tanpa Garansi');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE IF NOT EXISTS `teknisi` (
  `id_teknisi` varchar(3) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` char(12) NOT NULL,
  `status_delete` int(1) NOT NULL,
  `user_delete` int(3) NOT NULL,
  PRIMARY KEY (`id_teknisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id_teknisi`, `nama_teknisi`, `alamat`, `no_telp`, `status_delete`, `user_delete`) VALUES
('T1', 'Tri Budi', 'Jl. Kwaron 5 no 6', '089677543654', 0, 0),
('T2', 'Ahmad Royani', 'Jl. Bangetayu Wetan RT 4 RW 4', '089776598899', 0, 0),
('T3', 'Arman Mulyono', 'Jl kanguru selatan No 20', '089677564564', 0, 0),
('T4', 'M Ulin Nuha', 'Jl Bangetayu Wetan RT 4 RW 4', '081334245246', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE latin1_bin NOT NULL,
  `password` varchar(50) COLLATE latin1_bin NOT NULL,
  `nama` varchar(50) COLLATE latin1_bin NOT NULL,
  `level` int(2) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'ferry', 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Susanto', 2),
(3, 'ferry s', '46171b077997b166bb30cf5494eff2f8', 'FerrySusanto', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
