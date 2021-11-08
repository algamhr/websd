-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 09:09 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_websd`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nisn` int(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `akses_level` int(2) NOT NULL,
  `gambar` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_kelas`, `username`, `password`, `nisn`, `name`, `jenis_kelamin`, `agama`, `akses_level`, `gambar`, `date`) VALUES
(33, NULL, 'admin', '105459f89f5c27fdad09077ff33d74f176955291', 0, 'MASTERDATA', '', '', 21, 'Agung_Masker.png', '2020-08-25 12:00:12'),
(37, NULL, 'didit', '7c222fb2927d828af22f592134e8932480637c0d', 0, 'Aditya Ramadhinata', '', '', 2, NULL, '2021-10-24 10:13:25'),
(38, NULL, 'alena', '7c222fb2927d828af22f592134e8932480637c0d', 0, 'Alena Uperiati', '', '', 2, NULL, '2021-10-24 10:29:52'),
(72, 16, 'kelas-1-a~0', 'b7ba1a24b15d4972268d7d359d9a5bb4799ecb83', 0, 'user0', '', '', 1, NULL, '2021-10-26 07:31:15'),
(73, 16, 'kelas-1-a~1', '6e57eab9e560a16d0860b3e450615c24b846671c', 0, 'user1', '', '', 1, NULL, '2021-10-26 07:31:15'),
(74, 16, 'kelas-1-a~2', 'f3a520d95e32d18d1bbb287422cc4644f7cfd353', 3721802, 'user2', 'L', 'hindu', 1, NULL, '2021-10-26 07:31:15'),
(75, 16, 'kelas-1-a~3', 'f11c8ae1e1059e7589f282ecac2db0eb49bda45c', 0, 'user3', '', '', 1, NULL, '2021-10-26 07:31:15'),
(76, 16, 'kelas-1-a~4', 'a8f8d972480fa929014faa7c9def9032d3b7e1de', 0, 'user4', '', '', 1, NULL, '2021-10-26 07:31:15'),
(77, 16, 'kelas-1-a~5', '5fb315d503ad320bf741171c8058b14814979a75', 0, 'user5', '', '', 1, NULL, '2021-10-26 07:31:15'),
(78, 16, 'kelas-1-a~6', '8e6b0f103a3ff05aa98d0cd4ed6efb5e2f8c9e08', 0, 'user6', '', '', 1, NULL, '2021-10-26 07:31:15'),
(79, 16, 'kelas-1-a~7', '35556082676ed43a08f9a4862c51a53d28196ac8', 0, 'user7', '', '', 1, NULL, '2021-10-26 07:31:15'),
(80, 16, 'kelas-1-a~8', '13682724f70cb3812088ad32ba9d55cd4e3d0294', 0, 'user8', '', '', 1, NULL, '2021-10-26 07:31:15'),
(81, 16, 'kelas-1-a~9', '796381118063d86d9433f652d65b1b4c37e80904', 0, 'user9', '', '', 1, NULL, '2021-10-26 07:31:15'),
(82, 17, 'kelas-1-b~0', '0f1f756e38e7ea6b5da45cde6ece45fe4d8cd1a0', 0, 'user0', '', '', 1, NULL, '2021-10-26 09:25:52'),
(83, 17, 'kelas-1-b~1', 'd1c3998f05f6c722f357bbc8e6d74b7f2162cdf1', 0, 'user1', '', '', 1, NULL, '2021-10-26 09:25:52'),
(84, 17, 'kelas-1-b~2', 'ec76e60b468ff0142335c1f87ea00179128fd8bd', 0, 'user2', '', '', 1, NULL, '2021-10-26 09:25:52'),
(85, 17, 'kelas-1-b~3', '890372fc8db8ea5f7d030f8037e772c63f268927', 0, 'user3', '', '', 1, NULL, '2021-10-26 09:25:52'),
(86, 17, 'kelas-1-b~4', '21a04116a58ee4b9f46c0beda9a0bca50a9d6e32', 0, 'user4', '', '', 1, NULL, '2021-10-26 09:25:52'),
(87, 17, 'kelas-1-b~5', '637e0774644ed67ef9116526f7767e8bfe501144', 0, 'user5', '', '', 1, NULL, '2021-10-26 09:25:52'),
(88, 17, 'kelas-1-b~6', '7d35f97024136377892ff28c531538c2deeb2a46', 0, 'user6', '', '', 1, NULL, '2021-10-26 09:25:52'),
(89, 17, 'kelas-1-b~7', '8bc88cd2293694295ab384bc6787e3809f3568b6', 0, 'user7', '', '', 1, NULL, '2021-10-26 09:25:52'),
(90, 17, 'kelas-1-b~8', '203035b5e50e06ad1d3a274588ae9a26df6fb69a', 0, 'user8', '', '', 1, NULL, '2021-10-26 09:25:52'),
(91, 17, 'kelas-1-b~9', 'aec7cd1ef4a6db879f3156dfeab2650d5f058445', 0, 'user9', '', '', 1, NULL, '2021-10-26 09:25:52'),
(92, 18, 'kelas-1-c~0', 'ab883b6f8d613f7913579eed897388776915d9e6', 0, 'user0', '', '', 1, NULL, '2021-10-26 09:28:47'),
(93, 18, 'kelas-1-c~1', '9615ddde0a52f6849c2dd6ae5ebf6739d3e22aed', 0, 'user1', '', '', 1, NULL, '2021-10-26 09:28:47'),
(94, 18, 'kelas-1-c~2', '203cfae60324263a55350468660f799a217152a1', 0, 'user2', '', '', 1, NULL, '2021-10-26 09:28:47'),
(95, 18, 'kelas-1-c~3', '0cbcd3419a090417495db5fb62df7a7f6c8cf4b3', 0, 'user3', '', '', 1, NULL, '2021-10-26 09:28:47'),
(96, 18, 'kelas-1-c~4', '404f0008c4661f1e564ed33998117d38341efb3d', 0, 'user4', '', '', 1, NULL, '2021-10-26 09:28:47'),
(97, 18, 'kelas-1-c~5', '022ea3256d82956efb787b4173c6ee27718e85ca', 0, 'user5', '', '', 1, NULL, '2021-10-26 09:28:47'),
(98, 18, 'kelas-1-c~6', '930a09ea60cb20f8276bde0bc9cee332db79c43f', 0, 'user6', '', '', 1, NULL, '2021-10-26 09:28:47'),
(99, 18, 'kelas-1-c~7', 'ee0d6cb1968884f5bfc020241668caa8159adc4f', 0, 'user7', '', '', 1, NULL, '2021-10-26 09:28:47'),
(100, 18, 'kelas-1-c~8', '5f1a12e4b9eba0441f3bb5a8131dfad1d03520e8', 0, 'user8', '', '', 1, NULL, '2021-10-26 09:28:47'),
(101, 18, 'kelas-1-c~9', '8a91ff36bef73ff0805925d9c9dc8fab4b8571cc', 0, 'user9', '', '', 1, NULL, '2021-10-26 09:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
