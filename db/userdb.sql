-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 03:00 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `last_login`, `is_deleted`) VALUES
(1, 'Ravidu', 'Dulaj', 'ravidu@gmail.com', 'e62abcf086d4cde359a73453d86cabb79a302b38', '0000-00-00 00:00:00', 0),
(2, 'Chanaka', 'Naveen', 'chanaka@gmail.com', 'e62abcf086d4cde359a73453d86cabb79a302b38', '0000-00-00 00:00:00', 1),
(4, 'Avishka', 'Shanuka', 'avishka@gmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', '2022-08-05 17:45:07', 0),
(5, 'Sadun', 'Ravidu', 'dasun@gmail.com', 'ea38d71715578cd666ce7d571722971a815760b7', '0000-00-00 00:00:00', 1),
(10, 'chanaka', 'Naveen', 'chana@gmail.com', '06ad9e1c7d528fbbbfed738e5794992ca3331490', '2022-08-05 17:32:15', 0),
(11, 'kasun', 'sampath', 'chana@gmail.com', '06ad9e1c7d528fbbbfed738e5794992ca3331490', '0000-00-00 00:00:00', 1),
(12, 'kasun', 'chamara', 'kasun@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00 00:00:00', 0),
(13, 'hasitha', 'kavinda', 'hasitha@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00 00:00:00', 1),
(14, 'dd', 'eff', 'e@f.k', '58e6b3a414a1e090dfc6029add0f3555ccba127f', '0000-00-00 00:00:00', 1),
(15, 'Kavishka', 'shehan', 'kk@g.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00 00:00:00', 0),
(16, 'Ashen', 'Udara', 'ashen@gmail.com', '8aefb06c426e07a0a671a1e2488b4858d694a730', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
