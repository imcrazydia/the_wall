-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 apr 2019 om 10:17
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wall`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `images`
--

INSERT INTO `images` (`id`, `file_name`, `uploaded_on`, `status`) VALUES
(2, 'unknown.png', '2019-03-27 14:53:13', '1'),
(4, 'C2vechHWIAAh560.jpg', '2019-03-27 15:00:33', '1'),
(5, '20181107_091404.jpg', '2019-03-27 15:03:12', '1'),
(6, 'c7b6b97.jpg', '2019-03-28 08:32:41', '1'),
(7, 'dfcf881.jpg', '2019-03-28 08:37:39', '1'),
(8, '1992681.jpg', '2019-03-29 13:38:04', '1'),
(9, '1f7e3f9.jpg', '2019-03-29 13:39:05', '1'),
(10, 'fc51a83.jpg', '2019-03-29 13:40:03', '1'),
(11, 'DSCN2433-1920x800.jpg', '2019-03-29 13:40:39', '1'),
(12, 'gay.jpg', '2019-03-29 13:41:12', '1'),
(13, 'KERMITOHNO.png', '2019-03-29 13:41:50', '1'),
(14, 'hBA02P_7BmOpeLDbH6XN8SssY30QJ18GDzAjfKQBcUU.jpg', '2019-04-01 09:49:28', '1'),
(15, 'live-breaking-news-jesus-found-to-be-original-t-poser-jesus-32158001.png', '2019-04-01 09:50:04', '1'),
(16, 'banaan.png', '2019-04-01 09:54:21', '1'),
(17, 'e02e5ffb5f980cd8262cf7f0ae00a4a9_press-x-to-doubt-memes-memesuper-la-noire-doubt-meme_419-238.jpg', '2019-04-01 09:54:37', '1'),
(18, '494a6a7.jpg', '2019-04-01 10:03:20', '1'),
(19, '1527598482952.png', '2019-04-01 10:03:50', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `PASSWORD`, `created_at`) VALUES
(1, 'imcrazydia', '$2y$10$6Y8dDO9O./7PRp/FAHQpveWJHYcfmA.NaBu1wT6GOt3MOthLLiWIm', '2019-03-27 09:07:48'),
(2, 'Sample', '$2y$10$yvqVSKHEAVkwniDtUtVziO/i3Zjp2A0eoij1BqveOxfdAe4c0AFWS', '2019-03-29 13:23:20');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
