-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 12:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Hope for the Holiday', 1, 1, 'assets/images/artwork/hope_for_the_holidays.jpg'),
(2, 'Claire De Lune', 2, 2, 'assets/images/artwork/claire_de_lune.jpg'),
(3, 'Classical Piano Relaxation', 3, 3, 'assets/images/artwork/classical_piano_meditation.jpg'),
(4, 'Happy Holy Days', 4, 4, 'assets/images/artwork/happy_holy_days.jpg'),
(5, 'Emmanuel', 5, 1, 'assets/images/artwork/emmanuel.jpg'),
(6, 'Deeper Still', 6, 5, 'assets/images/artwork/deeper_still.jpg'),
(7, 'Christmas', 1, 6, 'assets/images/artwork/christmas.jpg'),
(8, 'Silent Night', 7, 1, 'assets/images/artwork/silent_night.jpg'),
(9, 'Running Tracks', 8, 7, 'assets/images/artwork/running_track.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Mark Smelby'),
(2, 'Nicholas York'),
(3, 'Classical Meditation'),
(4, '11 Acorn Lane'),
(5, 'Fielder Church'),
(6, 'Kimberly & Roberto Reviera'),
(7, 'Kristen Chambers'),
(8, 'Caius Lear');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Holiday'),
(2, 'Hymn'),
(3, 'Classical'),
(4, 'Pop'),
(5, 'Gospel'),
(6, 'Country'),
(7, 'R&B');

-- --------------------------------------------------------

--
-- Table structure for table `listsongs`
--

CREATE TABLE `listsongs` (
  `id` int(11) NOT NULL,
  `songid` int(11) NOT NULL,
  `playlistid` int(11) NOT NULL,
  `songorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `listsongs`
--

INSERT INTO `listsongs` (`id`, `songid`, `playlistid`, `songorder`) VALUES
(2, 1, 7, 1),
(3, 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `listname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `username`, `listname`) VALUES
(7, 'theni26', 'Nice');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  `album_cover` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`, `album_cover`) VALUES
(1, 'kadhal-Sadugudu', 1, 5, 8, '2:37', 'assets/music/kadhal-Sadugudu.mp3', 1, 9, 'assets\\images\\song-images\\1.jpg'),
(2, 'vaseegara', 1, 5, 1, '2:35', 'assets/music/vaseegara.mp3', 2, 0, 'assets\\images\\song-images\\2.jpg'),
(3, 'nenjukkul-Peidhidum', 1, 5, 2, '2:33', 'assets/music/nenjukkul-Peidhidum-MassTamilan.com.mp3', 3, 1, 'assets\\images\\song-images\\3.jpg'),
(4, 'oru-Naalil', 1, 5, 3, '2:02', 'assets/music/oru-Naalil---It-All-Comes-Down-To-this!.mp3', 4, 3, 'assets\\images\\song-images\\4.jpg'),
(5, 'iragai-Pole', 1, 5, 4, '1:29', 'assets/music/iragai-Pole.mp3', 5, 0, 'assets\\images\\song-images\\5.jpg'),
(6, 'anandha-Yazhai', 2, 5, 1, '4:04', 'assets/music/anandha-Yazhai.mp3', 1, 2, 'assets\\images\\song-images\\6.jpg'),
(7, 'Funny Song', 2, 4, 2, '3:07', 'assets/music/bensound-funnysong.mp3', 2, 3, 'assets\\images\\song-images\\7.jpg'),
(8, 'Funky Element', 2, 1, 3, '3:08', 'assets/music/bensound-funkyelement.mp3', 2, 1, 'assets\\images\\song-images\\8.jpg'),
(9, 'Extreme Action', 2, 1, 4, '8:03', 'assets/music/bensound-extremeaction.mp3', 3, 0, 'assets\\images\\song-images\\9.jpg'),
(10, 'Epic', 2, 4, 5, '2:58', 'assets/music/bensound-epic.mp3', 3, 0, 'assets\\images\\song-images\\10.jpg'),
(11, 'Energy', 2, 1, 6, '2:59', 'assets/music/bensound-energy.mp3', 4, 0, 'assets\\images\\song-images\\11.jpg'),
(12, 'Dubstep', 2, 1, 7, '2:03', 'assets/music/bensound-dubstep.mp3', 5, 0, 'assets\\images\\song-images\\12.jpg'),
(13, 'Happiness', 3, 6, 8, '4:21', 'assets/music/bensound-happiness.mp3', 5, 0, 'assets\\images\\song-images\\13.jpg'),
(14, 'Happy Rock', 3, 6, 9, '1:45', 'assets/music/bensound-happyrock.mp3', 4, 0, 'assets\\images\\song-images\\14.jpg'),
(15, 'Jazzy Frenchy', 3, 6, 10, '1:44', 'assets/music/bensound-jazzyfrenchy.mp3', 3, 0, 'assets\\images\\song-images\\15.jpg'),
(16, 'Little Idea', 3, 6, 1, '2:49', 'assets/music/bensound-littleidea.mp3', 2, 0, 'assets\\images\\song-images\\16.jpg'),
(17, 'Memories', 3, 6, 2, '3:50', 'assets/music/bensound-memories.mp3', 1, 0, 'assets\\images\\song-images\\17.jpg'),
(18, 'Moose', 4, 7, 1, '2:43', 'assets/music/bensound-moose.mp3', 5, 0, 'assets\\images\\song-images\\18.jpg'),
(19, 'November', 4, 7, 2, '3:32', 'assets/music/bensound-november.mp3', 4, 0, 'assets\\images\\song-images\\19.jpg'),
(20, 'Of Elias Dream', 4, 7, 3, '4:58', 'assets/music/bensound-ofeliasdream.mp3', 3, 0, 'assets\\images\\song-images\\20.jpg'),
(21, 'Pop Dance', 4, 7, 2, '2:42', 'assets/music/bensound-popdance.mp3', 2, 0, 'assets\\images\\song-images\\21.jpg'),
(22, 'Retro Soul', 4, 7, 5, '3:36', 'assets/music/bensound-retrosoul.mp3', 1, 3, 'assets\\images\\song-images\\22.jpg'),
(23, 'Sad Day', 5, 2, 1, '2:28', 'assets/music/bensound-sadday.mp3', 1, 3, 'assets\\images\\song-images\\23.jpg'),
(24, 'Sci-fi', 5, 2, 2, '4:44', 'assets/music/bensound-scifi.mp3', 2, 0, 'assets\\images\\song-images\\24.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test1`) VALUES
('Hacker');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` text NOT NULL,
  `Lastname` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `Lastname`, `username`, `password`, `Email`) VALUES
('adarsh', 'arv', 'ad', '$2y$10$2I/FYKv0Kt2Z5UHC4.Y94.i2tKyXCVpQXEvhIRekhzbhOuvgH7Iii', 'adarsh@gmail.com'),
('asd', 'asdf', 'asdfg', '$2y$10$GLh8zQYAecUMW5y8xG/Ll.isO9m..7gyYhL0rIFWPqHrts7NJtPkC', 'asdf@gmail.com'),
('carl', 'roger', 'carl1', '$2y$10$8ZhjlLlhQPFZu1vIyggOpOKOQvcgJCAMkyoHCHxFEjDQhOSi/f37u', 'carl@gmail.com'),
('gda', 'gda', 'fds', '$2y$10$uExZ/8arDOlcYspVgjvXDetxq.GQy7fBCgXMS3c0V571yEEoUQlH.', '1@gmail.com'),
('nithya', 'kalai', 'mike', '$2y$10$Gxpx8xabZtIQJLtKlfbAYuE0yiZ695mHjkCN3/kk5r82DcO1RKvfe', 'nithya@gmail.com'),
('nith', 'ka', 'nithi', '$2y$10$HGW7vxvWVbJ1RO3I/2U1QOL7dIvnQw5uo7v2yS4BmRz2euZyJ7hoC', 'nith@gmail.com'),
('qw', 'qwe', 'qwerty', '$2y$10$woGehNOY6v/cEG/NG3Ntc.swJONjHV17legGzfg0VtrtO0y6Jg/6m', 'fad@gmail.com'),
('vinod', 'champ', 'qwertyuiop', '$2y$10$Cc.gLQIeK5ppfC6NGvkrK.2IrHA8UXmdqMwzl1iOCqlOKL26Bnq8W', 'iamvinod2001@gmail.com'),
('shreyaaas', 'kalaichelvan', 'sh', '$2y$10$QTIqIuZplHt2XSJFEN1WN.qxia5yPQuO5wEr1HQphM872ryYIoVfi', 'shreyaas21@gmail.com'),
('shreyaas', 'kalai', 'shrey', '$2y$10$5eV2/PpycH6ylR2EobhkbumTZEheB6qSZ64D/s1VlVu2UlU3gV/g6', 'shrey@gmail.com'),
('someshwar', 'ganu', 'somu', '$2y$10$ivjqilb9Qm9C0hLltYeGU.CjFERw5tlJs.xBQDpRaQFoW8XpciKSK', 'somesh@gmail.com'),
('Theninpan', 'R', 'theni26', '$2y$10$mUkPMCe2h/QNMSlzXok6ae3QlfBCGtDIlfxE9Vchsx2FxU6ikpFNq', 'theni@gmail.com'),
('hello', 'hi', 'vdipahef', '$2y$10$f.Tl/UrqH2IDEkktfgItt.2D5JMJc.TxPCMfQ7Uv/lzYTwmWxsJma', 't@gmail.com'),
('vinod', 'void', 'vinod', '$2y$10$Q6E49gj7nyLhWDM/KqSnsu6XcKywIf2oDJRyLpweAk46F2rNY855y', 'vinod@gmail.com'),
('hlo', 'k', 'voida', '$2y$10$/e2upzvuFQi3rd0xq.EBIeT6L16pXPhqkWJxlEthxcZ7Xp39k8zo.', 'tgram@gmail.com'),
('zx', 'zx', 'zxcv', '$2y$10$MZw87bKSFu0CrwHgHgWcp.nsWT7UTe0MTf0pP7E0ous6X6TTD13Fa', 'zxcv@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listsongs`
--
ALTER TABLE `listsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listsongs`
--
ALTER TABLE `listsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
