-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 01 2017 г., 22:35
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
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `coin` bigint(20) UNSIGNED NOT NULL,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `userFK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
