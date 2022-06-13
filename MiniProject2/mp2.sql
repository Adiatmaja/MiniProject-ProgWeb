-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 01:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `IdAdmin` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IdAdmin`, `Username`, `Password`) VALUES
(1, 'Ryan', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `IdImage` int(11) NOT NULL,
  `ImagePath` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`IdImage`, `ImagePath`) VALUES
(1, 'assets/JumpingJacks.jpg'),
(2, 'assets/ChairPose.jpg'),
(3, 'assets/TreePose.jpg'),
(4, 'assets/JumpRope.jpg'),
(5, 'assets/SquatJump.jpg'),
(6, 'assets/SidePlank.jpg'),
(7, 'assets/MountainClimber.jpg'),
(8, 'assets/BoatPose.png'),
(9, 'assets/Burpees.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `instruktur`
--

CREATE TABLE `instruktur` (
  `IdInstruktur` int(11) NOT NULL,
  `NamaInstruktur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instruktur`
--

INSERT INTO `instruktur` (`IdInstruktur`, `NamaInstruktur`) VALUES
(1, 'Jason Charchan'),
(2, 'Adriene Mishler'),
(3, 'Zen Dude'),
(4, 'Sashah Handal'),
(5, 'Charlee Atkens'),
(6, 'Briohny Smyth');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `IdLevel` int(11) NOT NULL,
  `NamaLevel` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`IdLevel`, `NamaLevel`) VALUES
(1, 'Beginner'),
(2, 'Intermediate'),
(3, 'Advanced');

-- --------------------------------------------------------

--
-- Table structure for table `olahraga`
--

CREATE TABLE `olahraga` (
  `IdOlahraga` int(11) NOT NULL,
  `NamaOlahraga` varchar(55) NOT NULL,
  `IdTipe` int(11) NOT NULL,
  `IdLevel` int(11) NOT NULL,
  `IdInstruktur` int(11) NOT NULL,
  `Deskripsi` varchar(555) NOT NULL,
  `Peralatan` varchar(255) NOT NULL,
  `IdVideo` int(11) NOT NULL,
  `IdImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `olahraga`
--

INSERT INTO `olahraga` (`IdOlahraga`, `NamaOlahraga`, `IdTipe`, `IdLevel`, `IdInstruktur`, `Deskripsi`, `Peralatan`, `IdVideo`, `IdImage`) VALUES
(1, 'Jumping Jacks', 2, 1, 1, 'Jumping jack merupakan latihan pliometrik, yakni jenis olahraga yang mengharuskan Anda untuk melompat dan bergerak aktif. Gerakan dalam olahraga ini bisa Anda lakukan tanpa atau dengan alat bantu, seperti burpees, squat jump, jump rope, atau box jump.', '', 1, 1),
(2, 'Chair Pose', 1, 1, 2, 'Chair pose termasuk pose yoga yang membutuhkan banyak stabilitas otot inti sekaligus kekuatan kaki. Selagi menahan pose duduk, detak jantung dan sistem aliran darah pun cenderung meningkat. Begitu pun ketika pose ini dilakukan dengan benar dan rutin, postur tubuh yang kurang sempurna dapat diperbaiki dari waktu ke waktu. Secara keseluruhan, chair pose merupakan pose yoga yang baik dalam melatih stabilitas otot inti, memperkuat tubuh bagian bawah, dan memperbaiki postur tubuh.', '', 2, 2),
(3, 'Tree Pose', 1, 1, 2, 'Gerakan yoga tree pose adalah pose dasar untuk melatih keseimbangan dan juga meningkatkan kelenturan tubuh. Caranya cukup mudah, pertama mulailah dengan berdiri tegak. Kemudian, letakan kedua telapak tangan di depan dada. Untuk bagian kaki, tekuk lutut ke arah luar menjauhi tubuh dan tempelkan telapak kaki di bagian paha seperti gambar di atas. Tahan gerakan ini selama 30 detik. Setelah 30 detik, ganti kaki sebelahnya dan ulangi gerakan yang sama.', '', 3, 3),
(4, 'Jump Rope', 3, 2, 3, 'Jump Rope atau yang kerap disebut Lompat Tali ialah salah satu cabang olahraga yang diyakini efektif untuk menambah tinggi badan dan menurunkan berat badan. Skipping merupakan suatu aktivitas penggunaan tali yang dipegang dengan kedua tangan lalu diayunkan melewati kepala hingga kaki sambil melompatinya. Olahraga yang satu ini dapat menjaga kesehatan sekaligus menambah kekuatan pada tubuh.', 'Tali Skipping', 4, 4),
(5, 'Squat Jump', 3, 2, 4, 'Squat jump adalah salah satu latihan untuk memperkuat otot bagian bawah tubuh serta meningkatkan keseimbangan dan kelincahan tubuh.Squat jump termasuk jenis latihan sederhana yang bisa dilakukan di rumah tanpa memerlukan peralatan khusus. Latihan ini lebih banyak melibatkan otot bagian bawah yang meliputi perut, bokong, panggul, tungkai, kaki, dan paha.', '', 5, 5),
(6, 'Side Plank', 2, 2, 5, 'Side plank adalah latihan yang bagus untuk memperkuat otot perut \r\n            side plank menuntut Anda untuk mampu menahan tubuh dalam posisi lurus, \r\n            tapi hanya didukung oleh satu lengan dan satu sisi kaki. Side Plank adalah latihan \r\n            isometrik yang gerakannya dilakukan dengan mempertahankan posisi dalam jangka waktu tertentu.', '', 6, 6),
(7, 'Mountain Climber', 3, 3, 5, 'Mountain climbers adalah latihan gabungan yang melatih beberapa \r\n                sendi dan otot secara bersamaan, dari leher hingga kaki. Secara khusus, \r\n                ini menargetkan trisep, deltoid, perut, punggung, fleksor pinggul, paha depan, \r\n                paha belakang, dan bokong.', '', 7, 7),
(8, 'Boat Pose', 1, 3, 6, 'Boat Pose atau Pose ini disebut juga pose perahu. Gerakan yoga ini \r\n                bermanfaat untuk meluruhkan lemak di perut serta membuat otot-otot di bagian perut semakin kencang.\r\n                Gerakan yoga Navasana membutuhkan keseimbangan tubuh dan konsentrasi. Sehingga pikiran kita akan lebih \r\n                fokus dengan melakukan gerakan yoga tersebut.', 'Matras', 8, 8),
(9, 'Burpees', 3, 3, 5, 'Burpee adalah olahraga seluruh tubuh yang intens dimana \r\n                dapat membakar banyak kalori. Burpee secara instan meningkatkan \r\n                detak jantung sehingga dapat membakar lemak. Selain itu, olahraga \r\n                tanpa alat ini juga dapat membentuk otot dan menguatkan melalui gerakan \r\n                seperti squat dan push up.', '', 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `Idtipe` int(11) NOT NULL,
  `NamaTipe` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`Idtipe`, `NamaTipe`) VALUES
(1, 'Yoga'),
(2, 'HIIT'),
(3, 'Cardio');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `IdVideo` int(11) NOT NULL,
  `LinkVideo` varchar(555) NOT NULL,
  `Durasi` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`IdVideo`, `LinkVideo`, `Durasi`) VALUES
(1, '<iframe src=\"https://www.youtube.com/embed/iSSAk4XCsRA\" title=\"YouTube video player\" \r\n        frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(2, '<iframe src=\"https://www.youtube.com/embed/ySafTekJ3Ls\" title=\"YouTube video player\" frameborder=\"0\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 8),
(3, '<iframe src=\"https://www.youtube.com/embed/yVE4XXFFO70\" title=\"YouTube video player\" frameborder=\"0\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 12),
(4, '<iframe src=\"https://www.youtube.com/embed/FJmRQ5iTXKE\" title=\"YouTube video player\" \r\n        frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; \r\n        picture-in-picture\" allowfullscreen></iframe>', 5),
(5, '<iframe src=\"https://www.youtube.com/embed/A-cFYWvaHr0\" frameborder=\"0\" allow=\"accelerometer; autoplay;\r\n        clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(6, '<iframe src=\"https://www.youtube.com/embed/XeN4pEZZJNI\" title=\"YouTube video player\"\r\n         frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; \r\n         picture-in-picture\" allowfullscreen></iframe>', 3),
(7, '<iframe src=\"https://www.youtube.com/embed/cnyTQDSE884\" \r\n        frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; \r\n        encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(8, '<iframe src=\"https://www.youtube.com/embed/QVEINjrYUPU\" \r\n        frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; \r\n        gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(9, '<iframe src=\"https://www.youtube.com/embed/qLBImHhCXSw\" frameborder=\"0\" \r\n        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; \r\n        picture-in-picture\" allowfullscreen></iframe>', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IdAdmin`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`IdImage`);

--
-- Indexes for table `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`IdInstruktur`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`IdLevel`);

--
-- Indexes for table `olahraga`
--
ALTER TABLE `olahraga`
  ADD PRIMARY KEY (`IdOlahraga`),
  ADD KEY `FK_video` (`IdVideo`),
  ADD KEY `FK_tipe` (`IdTipe`),
  ADD KEY `FK_level` (`IdLevel`),
  ADD KEY `FK_image` (`IdImage`),
  ADD KEY `FK_instruktur` (`IdInstruktur`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`Idtipe`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`IdVideo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `IdAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `IdImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `IdInstruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `IdLevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `olahraga`
--
ALTER TABLE `olahraga`
  MODIFY `IdOlahraga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `Idtipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `IdVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `olahraga`
--
ALTER TABLE `olahraga`
  ADD CONSTRAINT `FK_image` FOREIGN KEY (`IdImage`) REFERENCES `image` (`IdImage`),
  ADD CONSTRAINT `FK_instruktur` FOREIGN KEY (`IdInstruktur`) REFERENCES `instruktur` (`IdInstruktur`),
  ADD CONSTRAINT `FK_level` FOREIGN KEY (`IdLevel`) REFERENCES `level` (`IdLevel`),
  ADD CONSTRAINT `FK_tipe` FOREIGN KEY (`IdTipe`) REFERENCES `tipe` (`Idtipe`),
  ADD CONSTRAINT `FK_video` FOREIGN KEY (`IdVideo`) REFERENCES `video` (`IdVideo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
