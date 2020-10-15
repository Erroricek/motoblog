-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 05. led 2020, 13:33
-- Verze serveru: 10.4.6-MariaDB
-- Verze PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `motoblog`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `log` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `logs`
--

INSERT INTO `logs` (`id`, `log`, `date`) VALUES
(1, 'uživatel přihlášen', '2019-11-19 18:36:30'),
(2, 'uživatel přihlášen', '2019-11-19 18:36:34'),
(3, 'uživatel přihlášen', '2019-11-19 18:36:35'),
(4, 'uživatel přihlášen', '2019-11-19 18:36:36'),
(5, 'uživatel přihlášen', '2019-11-19 18:36:42'),
(6, 'Vytvořen nový post', '2019-11-19 18:36:42'),
(7, 'prihlasil se uzivatel', '2019-11-19 18:43:16'),
(8, 'Vytvořen nový post', '2019-11-19 18:43:42'),
(9, 'Vytvořen nový post', '2019-11-19 19:18:46'),
(10, 'obrazek ulozen', '2019-11-19 19:18:46'),
(11, 'obrazek ulozen', '2019-11-19 19:18:46'),
(12, 'obrazek ulozen', '2019-11-19 19:18:46'),
(13, 'obrazek ulozen', '2019-11-19 19:18:46'),
(14, 'Vytvořen nový post', '2019-11-21 12:46:05'),
(15, 'obrazek ulozen: targetFilePath', '2019-11-21 12:46:05'),
(16, 'prihlasil se uzivatel', '2019-11-21 12:47:03'),
(17, 'Vytvořen nový post', '2019-11-21 12:47:36'),
(18, 'obrazek ulozen: targetFilePath', '2019-11-21 12:47:36'),
(19, 'prihlasil se uzivatel', '2019-11-21 13:35:26'),
(20, 'Vytvořen nový post', '2019-11-21 13:35:48'),
(21, 'Vytvořen nový post', '2019-11-21 14:09:39'),
(22, 'Vytvořen nový post', '2019-11-21 14:11:27'),
(23, 'obrazek neulozen', '2019-11-21 14:11:28'),
(24, 'Vytvořen nový post', '2019-11-21 14:14:51'),
(25, 'obrazek ulozen: targetFilePath', '2019-11-21 14:14:51'),
(26, 'prihlasil se uzivatel', '2019-11-22 10:53:53'),
(27, 'Vytvořen nový post', '2019-11-22 10:54:22'),
(28, 'obrazek ulozen: targetFilePath', '2019-11-22 10:54:22'),
(29, 'prihlasil se uzivatel', '2019-11-24 15:56:19'),
(30, 'Vytvořen nový post', '2019-11-24 15:56:45'),
(31, 'obrazek ulozen: targetFilePath', '2019-11-24 15:56:45'),
(32, 'prihlasil se uzivatel', '2019-11-24 21:09:50'),
(33, 'prihlasil se uzivatel', '2019-11-27 19:38:36'),
(34, 'Vytvořen nový post', '2019-11-27 19:43:39'),
(35, 'obrazek ulozen: targetFilePath', '2019-11-27 19:43:39'),
(36, 'Vytvořen nový post', '2019-11-27 19:47:06'),
(37, 'obrazek ulozen: targetFilePath', '2019-11-27 19:47:06'),
(38, 'Vytvořen nový post', '2019-11-27 19:51:07'),
(39, 'obrazek ulozen: targetFilePath', '2019-11-27 19:51:07'),
(40, 'Vytvořen nový post', '2019-11-27 19:52:29'),
(41, 'obrazek ulozen: targetFilePath', '2019-11-27 19:52:29'),
(42, 'Vytvořen nový post', '2019-11-27 19:57:07'),
(43, 'obrazek ulozen: targetFilePath', '2019-11-27 19:57:07'),
(44, 'obrazek ulozen: targetFilePath', '2019-11-27 20:03:25'),
(45, 'obrazek ulozen: targetFilePath', '2019-11-27 20:06:48'),
(46, 'obrazek ulozen: targetFilePath', '2019-11-27 20:07:12'),
(47, 'obrazek ulozen: targetFilePath', '2019-11-27 20:07:46'),
(48, 'obrazek ulozen: targetFilePath', '2019-11-27 20:08:55'),
(49, 'obrazek ulozen: targetFilePath', '2019-11-27 20:08:55'),
(50, 'obrazek ulozen: targetFilePath', '2019-11-27 20:08:55'),
(51, 'obrazek ulozen: targetFilePath', '2019-11-27 20:08:55'),
(52, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(53, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(54, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(55, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(56, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(57, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(58, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(59, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(60, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(61, 'obrazek ulozen: targetFilePath', '2019-11-27 20:11:45'),
(62, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(63, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(64, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(65, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(66, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(67, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(68, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(69, 'obrazek ulozen: targetFilePath', '2019-11-27 20:53:41'),
(70, 'prihlasil se uzivatel', '2019-11-27 22:11:44'),
(71, 'obrazek ulozen: targetFilePath', '2019-11-27 22:12:51'),
(72, 'obrazek ulozen: targetFilePath', '2019-11-27 22:12:51'),
(73, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:06'),
(74, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:06'),
(75, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:25'),
(76, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:25'),
(77, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:25'),
(78, 'obrazek ulozen: targetFilePath', '2019-11-27 22:14:25'),
(79, 'prihlasil se uzivatel', '2019-11-27 22:17:34'),
(80, 'obrazek ulozen: targetFilePath', '2019-11-27 22:23:52'),
(81, 'prihlasil se uzivatel', '2019-12-02 20:15:23'),
(82, 'prihlasil se uzivatel', '2019-12-02 20:19:13'),
(83, 'prihlasil se uzivatel', '2019-12-03 14:53:58'),
(84, 'prihlasil se uzivatel', '2019-12-03 15:06:52'),
(85, 'prihlasil se uzivatel', '2019-12-03 15:17:51'),
(86, 'prihlasil se uzivatel', '2019-12-03 19:23:25'),
(87, 'prihlasil se uzivatel', '2019-12-03 19:33:18'),
(88, 'prihlasil se uzivatel', '2019-12-04 09:28:48'),
(89, 'prihlasil se uzivatel', '2019-12-17 12:32:06'),
(90, 'prihlasil se uzivatel', '2019-12-18 10:57:24'),
(91, 'prihlasil se uzivatel', '2019-12-24 16:09:37');

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `nazev` text COLLATE utf8_bin NOT NULL,
  `perex` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `nazev`, `perex`, `content`, `url`, `datum`) VALUES
(35, 'Lorem ipsum dolor sit amet, consectetuer.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Etiam commodo dui eget wisi. Et harum quidem rerum facilis est et expedita distinctio. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Duis condimentum augue id magna semper rutrum. Mauris metus. Fusce suscipit libero eget elit. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Praesent dapibus. Integer vulputate sem a nibh rutrum consequat. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Nullam eget nisl.\r\n\r\nAliquam erat volutpat. Integer tempor. In convallis. Duis viverra diam non justo. Aliquam id dolor. Integer in sapien. In convallis. Aenean id metus id velit ullamcorper pulvinar. Aliquam ornare wisi eu metus. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Maecenas aliquet accumsan leo. Aliquam erat volutpat. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Praesent vitae arcu tempor neque lacinia pretium. Nullam eget nisl. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Nulla non lectus sed nisl molestie malesuada. Nullam dapibus fermentum ipsum.\r\n\r\nCras pede libero, dapibus nec, pretium sit amet, tempor quis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur bibendum justo non orci. Nullam sit amet magna in magna gravida vehicula. Aliquam erat volutpat. Aliquam erat volutpat. Praesent vitae arcu tempor neque lacinia pretium. Aenean fermentum risus id tortor. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Integer vulputate sem a nibh rutrum consequat. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Pellentesque sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede.\r\n\r\nNulla non arcu lacinia neque faucibus fringilla. Nulla quis diam. Praesent vitae arcu tempor neque lacinia pretium. Nunc tincidunt ante vitae massa. Ut tempus purus at lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Pellentesque arcu. Fusce tellus. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. Fusce consectetuer risus a nunc.\r\n\r\nEtiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Fusce nibh. Proin in tellus sit amet nibh dignissim sagittis. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Aenean fermentum risus id tortor. Aliquam erat volutpat. Mauris dictum facilisis augue. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Maecenas libero. Etiam posuere lacus quis dolor. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Mauris elementum mauris vitae tortor. Et harum quidem rerum facilis est et expedita distinctio. Pellentesque sapien. Proin mattis lacinia justo. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Praesent dapibus. Quisque porta.', '35', '2019-11-27 22:23:52'),
(31, 's', 's', 's', '31', '2019-11-27 00:00:00'),
(32, 's', 's', 's', '32', '2019-11-27 00:00:00'),
(33, 's', 's', 's', '33', '2019-11-27 00:00:00'),
(34, 's', 's', 's', '34', '2019-11-27 20:53:41');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_czech_ci NOT NULL,
  `login` text COLLATE utf8_czech_ci NOT NULL,
  `heslo` text COLLATE utf8_czech_ci NOT NULL,
  `role` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `heslo`, `role`) VALUES
(1, 'admin', 'admin', '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `name`) VALUES
(1, 'Dominik Pavelka'),
(2, 'Nikola Pincova'),
(3, 'Filip Janko'),
(4, 'Eduard Havir');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
