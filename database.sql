-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 09:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(120) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `image_path` varchar(120) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `image_path`, `created_at`) VALUES
(1, 'Bupati Bekasi dan Wakilnya Dilantik 6 Februari 2025', 'KBRN, Kabupaten Bekasi: Bupati Bekasi terpilih, Ade Kuswara Kunang dan wakilnya, Asep Surya Atmaja akan menjalani pelantikan 6 Februari 2025 mendatang. Pelantikan ini akan dilakukan serentak oleh Presiden Republik Indonesia, Prabowo Subianto.\r\n\r\nPenetapan kepala daerah terpilih pada 6 Februari 2025 berlaku untuk daerah yang Pilkadanya tidak bersengketa di Mahkamah Konstitusi. Keputusan tersebut merupakan kesepakatan antara pemerintah dan DPR dalam hal ini Komisi II. ', '/website_rri/upload/anggota-sistem-tata-surya-dan-ci-20220131101632.jpg', NULL),
(2, 'DPR akan Bahas Jadwal Tunda Pelantikan Kepala Daerah', 'KBRN, Jakarta: Anggota Komisi II DPR RI Aus Hidayat Nur mengatakan akan membahas soal jadwal pelantikan kepala daerah hasil Pilkada 2024 pekan depan. Komisi II DPR, kata dia, akan membahas soal tersebut bersama dengan Kemendagri, KPU RI, Bawaslu dan pihak terkait lainnya.\r\n\r\nAus mengatakan jalan tengah dari tertundanya jadwal pelantikan kepala daerah adalah pada Maret 2025. Pihaknya akan mendorong pelantikan dilakukan tidak nelewati Maret.', '/website_rri/upload/WhatsApp Image 2025-01-24 at 00.37.43.jpeg', NULL),
(3, 'KPU Tunggu Pemerintah Terkait Mundurnya Pelantikan Kepala Daerah', 'KBRN, Jakarta: Anggota Komisi Pemilihan Umum (KPU) RI Idham Kholik mengatakan, pihaknya menunggu kebijakan pemerintah terkait mundurnya pelantikan kepala daerah. Hal ini seiring dampak belum selesainya sengketa Pilkada di Mahkamah Konstitusi (MK) hingga, Senin (13/1/2025).\r\n\r\nTerkait hal ini, kata Idham, KPU RI akan diundang untuk mengikuti rapat dengar pendapat di Komisi II DPR RI. Rapat itu membahas jadwal pelantikan kepala daerah dan wakil kepala daerah terpilih.', '/website_rri/upload/WhatsApp Image 2025-01-07 at 11.29.18 (2).jpeg', NULL),
(4, 'KPU Tunggu Pemerintah Terkait Mundurnya Pelantikan Kepala Daerah', 'beritaa', '/website_rri/upload/WhatsApp Image 2025-01-24 at 00.37.43.jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_unggulan`
--

CREATE TABLE `program_unggulan` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_unggulan`
--

INSERT INTO `program_unggulan` (`id`, `title`, `description`, `image_path`) VALUES
(1, 'sayembara', 'sayembara ayam', 'C:/xampp/htdocs/website_rri/upload/kate2.png'),
(2, 'kdxslad', 'nkldas', 'C:/xampp/htdocs/website_rri/upload/kate2.png'),
(3, 'mcl;sad', 'ncla ', 'C:/xampp/htdocs/website_rri/upload/kate2.png'),
(5, 'Sidang PHPU 10 Kabupaten Kota se Sulut Bergulir di MK', 'KBRN, Jakarta : Bawaslu yang ada di 10 kabupaten/kota se-Sulut telah selesai menyampaikan keterangan dalam sidang Perselisihan Hasil Pemilihan Umum (PHPU) di Mahkamah Konstitusi.\r\n\r\nSidang PHPU Panel 3 yang di pimpin Hakim MK Prof Arif, terjadwal Bawaslu Manado, Minahasa, Tomohon, Bolmong,Boltim dan Bolsel menyampaikan keterangan, pada hari Kamis (23/1).\r\n\r\nSementara panel 1 yang di pimpin Ketua MK Suhartoyo, giliran Bawaslu Talaud, Minut dan Minsel.\r\n\r\nSedangkan di hari Jumat (24/1) di panel 2 yang di pimpin prof Saldi giliran Bawaslu Mitra. \r\n\r\nKetua Bawaslu Sulut Ardiles Mewoh mengatakan, berkat suporting sistem dari jajaran sekretariat yang luar biasa,mulai dari pengumpulan data hasil pengawasan, penyusunan keterangan, pengumpulan alat bukti sampai penyampaian keterangan dalam sidang di MK semuanyabtelah berjalan baik dan lancar.\r\n\r\nMenurut Ardiles, selanjutnya tinggal menunggu jadwal sidang berikut dari MK untuk mendengarkan putusan apakah akan dilanjutkan pada', 'C:/xampp/htdocs/website_rri/upload/https___rri-assets.s3.ap-southeast-3.amazonaws.com_berita_Manado_t_1737882556544-FB_I');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(0, 'admin', '', '123'),
(1, 'admin', '', '123\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_unggulan`
--
ALTER TABLE `program_unggulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_unggulan`
--
ALTER TABLE `program_unggulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
