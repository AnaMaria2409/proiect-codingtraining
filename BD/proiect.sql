-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2019 at 10:28 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proiect`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarii`
--

CREATE TABLE `comentarii` (
  `id` int(11) NOT NULL,
  `id_live` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `continut` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentarii`
--

INSERT INTO `comentarii` (`id`, `id_live`, `id_user`, `continut`) VALUES
(1, 1, 6, 'Foarte interesant!'),
(2, 1, 4, 'Imi place');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_raspuns` int(11) NOT NULL,
  `continut` varchar(200) DEFAULT NULL,
  `validitate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `id_user`, `id_raspuns`, `continut`, `validitate`) VALUES
(1, 4, 1, 'Very good', 'correct'),
(2, 5, 2, '', 'correct');

-- --------------------------------------------------------

--
-- Table structure for table `intrebari`
--

CREATE TABLE `intrebari` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `dificultate` varchar(30) NOT NULL,
  `vizualizare` int(11) DEFAULT NULL,
  `scor` int(11) DEFAULT NULL,
  `continut` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intrebari`
--

INSERT INTO `intrebari` (`id`, `id_user`, `categorie`, `dificultate`, `vizualizare`, `scor`, `continut`) VALUES
(1, 4, 'HTML', 'easy', NULL, NULL, 'Ce semnifica <br\\> ?'),
(2, 5, 'CSS', 'intermediate', 3, 5, 'Ce semnifica flex?');

-- --------------------------------------------------------

--
-- Table structure for table `livestream`
--

CREATE TABLE `livestream` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livestream`
--

INSERT INTO `livestream` (`id`, `id_user`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `raspunsuri`
--

CREATE TABLE `raspunsuri` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_intrebare` int(11) NOT NULL,
  `continut` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raspunsuri`
--

INSERT INTO `raspunsuri` (`id`, `id_user`, `id_intrebare`, `continut`) VALUES
(1, 6, 1, 'new line'),
(2, 6, 2, 'The flex property sets the flexible length on flexible items.');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `continut` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `id_user`, `continut`) VALUES
(1, 2, 'dfgfsg45hetdhnfgfdghng76trgv'),
(2, 4, 'bndgnbdb4763w');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(35) NOT NULL,
  `tip` varchar(15) NOT NULL,
  `parola` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `username`, `email`, `tip`, `parola`) VALUES
(1, 'denis', 'denis.alexandru@yahoo.com', 'administrator', '1dsfbgngh'),
(2, 'ana', 'ana.maria@gmail.com', 'administrator', 'weffgfgd'),
(3, 'george', 'george.todireanu@yahoo.com', 'administrator', 'sdfghkkjhg'),
(4, 'andrei.rusu', 'rusuu234@gmail.com', 'normal', 'gfghfgb'),
(5, 'alina.p', 'ali.alina@gmail.com', 'privilegiat', 'grhwrstg'),
(6, 'lucia', 'tlucia@yahoo.com', 'normal', 'tgrhsgzs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarii`
--
ALTER TABLE `comentarii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_live` (`id_live`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_raspuns` (`id_raspuns`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `intrebari`
--
ALTER TABLE `intrebari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `livestream`
--
ALTER TABLE `livestream`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `raspunsuri`
--
ALTER TABLE `raspunsuri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_intrebare` (`id_intrebare`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarii`
--
ALTER TABLE `comentarii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intrebari`
--
ALTER TABLE `intrebari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `livestream`
--
ALTER TABLE `livestream`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raspunsuri`
--
ALTER TABLE `raspunsuri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarii`
--
ALTER TABLE `comentarii`
  ADD CONSTRAINT `comentarii_ibfk_1` FOREIGN KEY (`id_live`) REFERENCES `livestream` (`id`),
  ADD CONSTRAINT `comentarii_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_raspuns`) REFERENCES `raspunsuri` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);

--
-- Constraints for table `intrebari`
--
ALTER TABLE `intrebari`
  ADD CONSTRAINT `intrebari_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);

--
-- Constraints for table `livestream`
--
ALTER TABLE `livestream`
  ADD CONSTRAINT `livestream_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);

--
-- Constraints for table `raspunsuri`
--
ALTER TABLE `raspunsuri`
  ADD CONSTRAINT `raspunsuri_ibfk_1` FOREIGN KEY (`id_intrebare`) REFERENCES `intrebari` (`id`),
  ADD CONSTRAINT `raspunsuri_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizatori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
