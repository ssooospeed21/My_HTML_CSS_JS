-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2024 г., 19:09
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `podcasts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

CREATE TABLE `content` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file` text COLLATE utf8mb4_general_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `name`, `img`, `description`, `file`, `tag`) VALUES
(1, 'First podcast for wwe', '../img/Framemixer.png', 'Hello everyone! This is the first podcast for this site!', '../aud/gazz  - contaminated city (side a) tape rip.mp3', 'music'),
(3, 'Second podcast for waw', '../img/Framemixer.png', 'Hello everyone! This is the first podcast for this site!', '../aud/gazz  - contaminated city (side a) tape rip.mp3', 'tech'),
(5, 'первый русский', '', 'лорем испум ёпта', '../aud/', 'music'),
(6, 'fgh', '../img/pdcsts/image_2023-10-31_11-06-42.png', 'muslo', '../aud/RVMZES, Maladoy Prince - G6.mp3', 'music');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `pswrd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `favs` text COLLATE utf8mb4_general_ci,
  `adm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `pswrd`, `favs`, `adm`) VALUES
(2, 'suomi', 'artemyand05@gmail.com', '$2y$10$9ffODKFEVnbgDeNkc4O73.Ta2WAu68RjyC2SbXFw3dVpW9n.0JzW6', '[\"3\",\"3\",\"1\",\"1\",\"1\",\"1\",\"1\",\"3\",\"5\",\"5\"]', 1),
(21, 'huh', '1234qqq@mail.ty', '$2y$10$y6nTs6EjL730iCytHWouR.Q7oDfAyhFONNlryOKtwzAIJ7WHfUGIq', '[\"1\",\"3\",\"1\"]', 0),
(22, 'dad', 'ilfjljiyn@fjknf.tt', '$2y$10$emUQRsHFPGmSIp2KdMjkreXn5Gv5SjFy5ml7S4RhMtkh8EAtr8bAq', '[\"1\"]', 1),
(23, 'errr', 'methuen13@gmail.com', '$2y$10$nCNvjtjc6VepPy0oSyN2r.MlTx774AhcnkRJIQgIH13UHJ4DOm1ny', '[\"1\"]', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `content`
--
ALTER TABLE `content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
