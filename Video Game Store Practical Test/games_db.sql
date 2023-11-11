-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 01:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `games_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_games`
--

CREATE TABLE `tbl_games` (
  `gameId` int(11) NOT NULL,
  `gameTitle` varchar(30) NOT NULL,
  `Platform` varchar(25) NOT NULL,
  `developer` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `releaseDate` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_games`
--

INSERT INTO `tbl_games` (`gameId`, `gameTitle`, `Platform`, `developer`, `publisher`, `price`, `releaseDate`, `image`, `description`) VALUES
(9, 'Devil May Cry 3', 'PS2', 'Capcom', 'Capcom', 15, '2005-02-17', 'images/Devil_May_Cry_3_boxshot.jpg', 'Devil May Cry 3: Dante\'s Awakening[b] is a 2005 action-adventure game developed and published by Cap'),
(10, 'Sonic Adventure DX', 'Gamecube', 'Sonic Team', 'SEGA', 12, '1991-08-14', 'images/Sonic_adventure_dx.png', 'Sonic Adventure is a 3D platform game with action and role-playing elements.'),
(29, 'Metroid Fusion', 'GBA', 'R&D 2', 'Nintendo', 13, '2001-11-12', 'images/Metroid_Fusion_box_art.png', 'Metroid Fusion[a][b] is an action-adventure game developed and published by Nintendo for the Game Bo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchased`
--

CREATE TABLE `tbl_purchased` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `idGame` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_purchased`
--

INSERT INTO `tbl_purchased` (`id`, `userId`, `idGame`) VALUES
(27, 39, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `firstName`, `lastName`, `password`, `phoneNo`, `email`, `role`, `image`) VALUES
(11, 'Tom', 'Calleja', '$2y$10$Gd7PGdUcbYnPrTpbaY3HUOQ/Wa5BWV4TUzOUzB24hVh5efb9gJ.OO', '98123', 'Tom12@gmail.com', 1, ''),
(12, 'Tom', 'Jerry', '$2y$10$iY2iZHv/F.huJZuFdEzN0.AFbgT2b0vinp2kVRLSRPn9oB8jLP0Fu', '9834923', 'Tom13@gmail.com', 1, ''),
(16, 'Garfield', 'M', '$2y$10$a28Mj2e46xaoZ6Pk/sT8vOFWQeY1cEGRsG1jqPk6GN6oN/i/ffI2S', '982', 'Gar@gmail.com', 2, 'images/Sonic_Adventure_2_cover.png'),
(17, 'Sven', 'Mallia', '$2y$10$DQpBu.7kwmRitEGJ30Q09u/auwcChU2r2RsxnrOi2793K3HuawSJy', '912', 'sven@gmail.com', 1, 'images/Patriot Games.jpg'),
(18, 'Gar', 'Field', '$2y$10$BXNNVUs0am5ssoHZHEmimeNysPCMHVpU73KlMEYuPQN0.8ItiSyFy', '98', 'Gar2@gmail.com', 1, 'images/Devil_May_Cry_3_boxshot.jpg'),
(19, 'No', 'Please', '$2y$10$AtWloMPMxxRMlrWTMhEgnuQs.z4yjPChHNkfarVOuA3cVwDtOtdAG', '12', 'No@gmail.com', 1, 'images/Smetroidbox.jpg'),
(20, 'Mario', 'Luigi', '$2y$10$.6tq9/3DRQYxnKbnGrBoAeYVbkOOiwTpe/TtfWptiokPkKYqDvfmG', '76343', 'Mario1@gmail.com', 2, 'images/Patriot Games.jpg'),
(21, '12', '13', '$2y$10$Z5UvfHQSh8xja/TunZFwHeIbRbZ3LokvziOqSdyRTfgQVc0oPh8n6', '1298', 'M@gmail.com', 1, 'images/Patriot Games.jpg'),
(24, 'dfgdg', 'kjkjhjhj', '$2y$10$Zrsw2jZHLvbwItkp8l08EeGky88lg0tV163CKcdErRedsFC49kx.m', '2412346875', 'sfas@gmail.com', 1, 'images/'),
(26, 'gfngf', 'kjkjhjhj', '$2y$10$68WN4sDjWwfmRwJy4XE1Cuw/90uU1EnckVYIK84kZX/wLnPnzv52O', '2352341235', 'sga@gmail.com', 1, 'images/Patriot Games.jpg'),
(27, 'Jerry', 'kjkjhjhj', '$2y$10$9Jm.Nx03/iKvj8vW9sIBJezjoZ3cGp8tXgOSCXjaON7EHiN7RinYG', '1234567890', 'sn@gmail.com', 2, 'images/Patriot Games.jpg'),
(28, 's', 'F', '$2y$10$LY69NsHaLB6B4LjNVcNKD.LJnZ5amx0hDXRugIQhnH8Oc4IG84zFe', '12356788', 'SG@GMAIL.COM', 1, 'images/Sonic_Adventure_2_cover.png'),
(29, '123', 'kjkjhjhj', '$2y$10$dkQdj7FYx/3fBYR0pd.m2Or5hmJ3jl1EnPsLdnqxsOJ.Mp8uf8MPS', '32542543', 'sagds@gmail.com', 1, 'images/'),
(30, 'Sven', 'kjkjhjhj', '$2y$10$a4ue2rU56othEg.EpXTaf.FHBZ9/llB04/rJCABvLyVulZgvd7sOC', '9912345677', 'vbv@gmail.com', 1, 'images/Smetroidbox.jpg'),
(31, 'Sven', 'kjkjhjhj', '$2y$10$b/fNznELNU2X22AEgu7l9OXQHXZ8RnT5H/15Y/Csy6ZtTXyb9fJLu', '12345678', 'dgs@gmail.com', 1, 'images/Sonic_Adventure_2_cover.png'),
(32, 'Sven', 'kjkjhjhj', '$2y$10$vdnzP.qX3QElgamxYLqg0uBev9UgHf4daig45IvR/aptdqKNCHgDS', '76341765', 'somethingrandom@gmail.com', 1, 'images/Patriot Games.jpg'),
(33, 'Sr', 'kjkjhjhj', '$2y$10$ZLhbZTLL6SesoqQ0uezg5u8R/CLGH/ViIn0ysPLiUFAFI1BSEcHWq', '45334', 'fdg@gmail.com', 1, 'images/Sonic_adventure_dx.png'),
(34, 'Sven', 'kjkjhjhj', '$2y$10$nFjPMHcuUKy72/iH39dHmONiADxszT6Y4EiIQqQ1TOq.hIdIdNl/K', '5654756546', 'fhghgf@gmail.com', 1, 'images/Patriot Games.jpg'),
(35, 'Sven', 'Mallia', '$2y$10$LlxEasC52JMJxJadu7btoesBbxT/4shCF8wnhWur00azQuQkvWYmi', '9586894564', 'fgfh@gmail.com', 1, 'images/Sonic_Adventure_2_cover.png'),
(36, 'User', 'Name', '$2y$10$tgemWeVKw9qI.aa8OYSAduByJTD4mANdT8hXqO40uo9Ov3cuQNB8i', '8475384573', 'riddler@gmail.com', 2, 'images/Patriot Games.jpg'),
(37, 'Testing', 'Admin', '$2y$10$KL7JlOUb8.dd8fI.HM8uOObd.tQB9l2HsKIF30zH6yrlIULvVLmai', '45435345', 'testingthis@gmail.com', 1, 'images/Patriot Games.jpg'),
(38, 'MyMario', 'MyLuigi', '$2y$10$z9vYIQNHhYXjjdsB/V/84uI208gTXFUmrlSTVJQ0jKVpoAxb4LTKi', '9485493853', 'dsgcvcx@gmail.com', 1, 'images/e05a8201e209023.png'),
(39, 'TestingThis', 'NopeNotEver', '$2y$10$7GBkC7hEmYr4H2UCgXwAyO8MsfcHib6YDsTcj/WY.fLT5cmjQqcYW', '5867546845', 'passwordtest@gmail.com', 1, 'images/4th place lol.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_games`
--
ALTER TABLE `tbl_games`
  ADD PRIMARY KEY (`gameId`);

--
-- Indexes for table `tbl_purchased`
--
ALTER TABLE `tbl_purchased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userId` (`userId`),
  ADD KEY `fk_gameId` (`idGame`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`),
  ADD KEY `role` (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `ROLE_FK` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_games`
--
ALTER TABLE `tbl_games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_purchased`
--
ALTER TABLE `tbl_purchased`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_purchased`
--
ALTER TABLE `tbl_purchased`
  ADD CONSTRAINT `fk_gameId` FOREIGN KEY (`idGame`) REFERENCES `tbl_games` (`gameId`),
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `ROLE_FK` FOREIGN KEY (`role`) REFERENCES `tbl_roles` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
