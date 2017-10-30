-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 30 2017 г., 20:56
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_mirafox`
--

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `tr_uuid` varchar(40) NOT NULL,
  `tr_session` varchar(40) NOT NULL,
  `tr_date` int(11) UNSIGNED NOT NULL,
  `coin` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tr_uuid` (`tr_uuid`),
  KEY `trFkTouser` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `tr_uuid`, `tr_session`, `tr_date`, `coin`) VALUES
(3, 20, 'd4db08c7-fd5e-485d-bc8a-e0e86f25d84c', '0a64454c4f58a1b814a13ef5d8d65cc2', 0, '10000.00'),
(4, 21, '2ccf0133-a20e-4cf0-8983-3922f918cf89', '905aeafd72a980b77a5df19b39e69115', 1509308055, '10000.00'),
(5, 22, '9b1f224e-15a6-4701-9aea-4484da268d2a', '3afbdc0ca7dbc8ba6b7294e4d7337eba', 1509308124, '10000.00'),
(6, 23, 'cf9f90d4-ef34-4737-be5a-62b7070003f0', '5cb1597fc699a60f2345800691239a22', 1509308520, '10000.00'),
(7, 24, '7aea8f62-eb99-421f-871d-64769e3081e9', 'unnqk3lbsh96e7cdkeh4t5is75', 1509313050, '10000.00'),
(8, 22, 'dsfdf', 'sdf', 34534535, '-500.00'),
(9, 22, 'dsfdsf', 'ssdf', 34534535, '-800.00'),
(10, 22, 'dsfddsf', 'ssddf', 34534535, '-1300.00'),
(11, 25, '25528e23-42ea-4708-935e-f85fbac21664', 's7kr9l7q56an5j5u30cbrof312', 1509382141, '10000.00'),
(13, 25, '3657f0d1-e5a5-4835-8c42-6e4b5c5a7bc8', 's7kr9l7q56an5j5u30cbrof312', 1509384342, '-1000.00'),
(14, 25, '6223f59e-cb78-477b-99fc-b068e1053a92', 's7kr9l7q56an5j5u30cbrof312', 1509384354, '-1000.00'),
(15, 25, '388acd5c-4aab-462d-8cba-46f98cd26d63', 's7kr9l7q56an5j5u30cbrof312', 1509384363, '-1000.00'),
(16, 25, '449b9eb1-c041-46fc-a5a7-17f9a0a31d30', 's7kr9l7q56an5j5u30cbrof312', 1509384386, '-1000.00'),
(17, 25, 'f141c74d-0284-40eb-b5da-a10519d8500a', 's7kr9l7q56an5j5u30cbrof312', 1509384512, '1.00'),
(18, 25, '303233b5-0652-46ee-baf2-56c5648a5509', 's7kr9l7q56an5j5u30cbrof312', 1509384538, '-5.00'),
(19, 25, '0c859199-1728-4d0b-9322-3df9d698d856', 's7kr9l7q56an5j5u30cbrof312', 1509384546, '-0.25'),
(20, 25, 'abd54856-c510-4a5b-aaf8-ac8a45477168', 's7kr9l7q56an5j5u30cbrof312', 1509384555, '-5995.75'),
(23, 25, '751039eb-f5b2-43a7-ac44-80090569bfa8', 's7kr9l7q56an5j5u30cbrof312', 1509384575, '0.00'),
(24, 25, '4799f371-374e-4bf9-b5ef-e68cf4ecfc62', 's7kr9l7q56an5j5u30cbrof312', 1509384580, '0.00'),
(25, 25, 'a7eef609-ef76-42f1-a84a-84b2cf45ac5c', 's7kr9l7q56an5j5u30cbrof312', 1509384584, '0.00'),
(26, 26, 'c340aec0-aef9-4b8a-a54c-0cbabca5d2fc', 'es091ioukujsedbpvol1iopvn3', 1509384637, '10000.00'),
(27, 26, '357d8201-5603-4017-ad4c-63de458c419a', 'es091ioukujsedbpvol1iopvn3', 1509384645, '-10000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `email`, `created_at`, `updated_at`) VALUES
(20, 'hbhbhbh', '', 'b59c67bf196a4758191e42f76670ceba', 'hbhbhbh', 1509307572, 1509307572),
(21, 'dsfsdfsdfsdfs', '', 'ec02c59dee6faaca3189bace969c22d3', 'dsfsdfsdfsdfs', 1509308047, 1509308047),
(22, 'dsfsdcdfgdgfsdfsdfs', '', 'ec02c59dee6faaca3189bace969c22d3', 'dsfsdcdfgdgfsdfsdfs', 1509308120, 1509308120),
(23, 'qqqq', '', '3bad6af0fa4b8b330d162e19938ee981', 'qqqq', 1509308515, 1509308515),
(24, 'aaaa', '', '74b87337454200d4d33f80c4663dc5e5', 'aaaa', 1509313045, 1509313045),
(25, 'cccc', '', '41fcba09f2bdcdf315ba4119dc7978dd', 'cccc', 1509382130, 1509382130),
(26, 'rrrr', '', 'eb9279982226a42afdf2860dbdc29b45', 'rrrr', 1509384637, 1509384637);

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `coin` decimal(20,2) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `coin`, `created_at`, `updated_at`) VALUES
(5, 18, '10000.00', 1509307344, 1509307344),
(6, 20, '10000.00', 1509307590, 1509307590),
(7, 21, '10000.00', 1509308055, 1509308055),
(8, 22, '10000.00', 1509308124, 1509308124),
(9, 23, '10000.00', 1509308520, 1509308520),
(10, 24, '10000.00', 1509313050, 1509313050),
(11, 25, '0.00', 1509382141, 1509384584),
(12, 26, '0.00', 1509384637, 1509384645);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `trFkTouser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `userFK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
