-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Июн 21 2024 г., 18:51
-- Версия сервера: 8.2.0
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `BarShik2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id_shopcart` int NOT NULL,
  `id_user` int NOT NULL,
  `content_shopcart` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id_shopcart`, `id_user`, `content_shopcart`) VALUES
(17, 13, '{\"3\": 2, \"4\": 1}'),
(22, 11, '{\"4\": 12, \"5\": 3, \"6\": 4}'),
(35, 14, '{\"3\": 2, \"4\": 2, \"5\": 2, \"7\": 2, \"9\": 4}'),
(36, 17, '{\"3\": 4, \"4\": 2, \"7\": 5}');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name_category` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name_category`, `status`) VALUES
(2, 'Напитки', 'активен'),
(3, 'Кофе', 'активен'),
(4, 'Вода', 'активен'),
(5, 'Газировка', 'активен'),
(6, 'Соки', 'активен');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `id_user` int NOT NULL,
  `date_order` datetime NOT NULL,
  `status` varchar(85) NOT NULL,
  `price_all` decimal(10,0) NOT NULL,
  `used_bonuses` decimal(10,0) DEFAULT NULL,
  `get_bonuses` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `date_order`, `status`, `price_all`, `used_bonuses`, `get_bonuses`) VALUES
(1, 13, '2024-06-15 13:03:02', 'New', 10650, NULL, NULL),
(2, 13, '2024-06-15 13:03:15', 'New', 10650, NULL, NULL),
(3, 13, '2024-06-15 13:09:16', 'New', 10650, NULL, NULL),
(4, 13, '2024-06-15 13:10:40', 'New', 900, NULL, NULL),
(5, 13, '2024-06-15 13:12:02', 'New', 900, NULL, NULL),
(6, 13, '2024-06-15 13:12:48', 'New', 900, NULL, NULL),
(7, 11, '2024-06-16 14:55:04', 'New', 6050, NULL, NULL),
(8, 11, '2024-06-16 14:57:10', 'New', 6050, NULL, NULL),
(9, 11, '2024-06-16 14:57:59', 'New', 6050, NULL, NULL),
(10, 11, '2024-06-16 14:58:27', 'New', 6050, NULL, NULL),
(11, 11, '2024-06-16 14:59:58', 'New', 6050, NULL, NULL),
(20, 14, '2024-06-16 15:56:56', 'New', 5350, NULL, 1),
(21, 14, '2024-06-16 15:58:26', 'New', 5350, NULL, 1),
(22, 14, '2024-06-21 17:29:13', 'New', 4000, NULL, 1),
(23, 17, '2024-06-21 18:50:51', 'New', 3550, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(85) NOT NULL,
  `description` text NOT NULL,
  `category_id` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` varchar(150) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `img`, `status`) VALUES
(3, 'Стакан Воды', 'Вкусная, прохладная, бодрящая водичка', 4, 300, 'Стакан Воды.jpg', 'активен'),
(4, 'CoolCola Zero', 'Кола Зеро без сахара', 5, 300, 'CoolCola Zero.jpg', 'активен'),
(5, 'Латте', 'Кофейный напиток на основе молока, представляющий собой трёхслойную смесь из молочной пены, молока (латте) и кофе эспрессо.', 3, 350, 'Латте.jpg', 'активен'),
(7, 'Кофе \"Глясе\"', 'Это нежное сочетание кофе, мороженого и взбитых сливок.', 3, 350, 'Кофе Глясе.jpeg', 'активен'),
(8, 'Латте', 'Кофейный напиток на основе молока, представляющий собой трёхслойную смесь из молочной пены, молока (латте) и кофе эспрессо.', 3, 350, 'Латте.jfif', 'активен'),
(9, 'Яблочный Сок', 'Вкусный, яблочный сок из домашних яблок', 6, 350, 'Яблочный Сок.jpeg', 'активен');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `cash_password` varchar(100) NOT NULL,
  `bonus_balls` decimal(10,0) NOT NULL,
  `role` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email`, `cash_password`, `bonus_balls`, `role`, `status`) VALUES
(8, 'lakos208@gmail.com', 'Den4ik', 1, 'user', 'активен'),
(9, 'admin@gmail.com', 'admin', 1, 'admin', 'Активен'),
(11, 'honorxpremium75@gmail.com', '1111', 1, 'user', 'Активен'),
(13, 'programmad000@gmail.com', '1111', 1, 'user', 'активен'),
(14, 'den4ik200518@mail.ru', '1111', 3, 'user', 'активен'),
(17, 'email1@gmail.com', 'Password1', 2, 'user', 'активен'),
(18, 'email2@gmail.com', 'Password2', 1, 'user', 'активен');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_shopcart`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_shopcart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
