-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 apr 2019 om 23:34
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
-- Tabelstructuur voor tabel `favorite`
--

CREATE TABLE `favorite` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `favorited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `favorite`
--

INSERT INTO `favorite` (`image_id`, `user_id`, `favorited_on`) VALUES
(30, 2, '2019-04-24 22:44:43'),
(0, 2, '2019-04-24 22:46:56'),
(0, 2, '2019-04-24 22:47:20'),
(15, 2, '2019-04-24 22:48:30'),
(15, 2, '2019-04-24 22:52:43'),
(30, 2, '2019-04-24 23:07:44'),
(30, 2, '2019-04-24 23:09:43'),
(28, 2, '2019-04-24 23:15:14'),
(32, 1, '2019-04-24 23:26:31');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `post_text` varchar(245) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `images`
--

INSERT INTO `images` (`id`, `file_name`, `uploaded_on`, `status`, `user_id`, `post_text`, `title`) VALUES
(32, '5cc0d47dd77d8.png', '2019-04-24 23:26:21', '1', 2, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `image_tags`
--

CREATE TABLE `image_tags` (
  `image_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `image_tags`
--

INSERT INTO `image_tags` (`image_id`, `tag_id`) VALUES
(32, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'doubt'),
(2, ' vlees'),
(3, ' vis'),
(4, 'test'),
(5, ' test2'),
(6, ' test3'),
(7, 'natuur'),
(8, ' woestijn'),
(10, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `verificatie_code` varchar(40) COLLATE utf8_bin NOT NULL,
  `user_pic` varchar(255) COLLATE utf8_bin NOT NULL,
  `bio` varchar(150) COLLATE utf8_bin NOT NULL,
  `website` varchar(120) COLLATE utf8_bin NOT NULL,
  `img1` varchar(255) COLLATE utf8_bin NOT NULL,
  `img2` varchar(255) COLLATE utf8_bin NOT NULL,
  `img3` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verificatie_code`, `user_pic`, `bio`, `website`, `img1`, `img2`, `img3`) VALUES
(1, 'imcrazydia', '$2y$10$GVXqyw3TY8cX7KU6.NiWK.ZBXXupSQLB7E345vtkc4HDfY1Khjf3u', 'diaqfort@gmail.com', '', 'prof_pic_uploads/prof.jpeg', 'Founder of this website.', 'https://www.wattpad.com/user/imcrazydia', '', '', ''),
(2, 'dia', '$2y$10$GVXqyw3TY8cX7KU6.NiWK.ZBXXupSQLB7E345vtkc4HDfY1Khjf3u', 'diaqfort+1@gmail.com', '', 'prof_pic_uploads/default.png', 'lol', '', '', '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `image_tags`
--
ALTER TABLE `image_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexen voor tabel `tags`
--
ALTER TABLE `tags`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT voor een tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
