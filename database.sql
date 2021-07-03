-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.0.238:3306
-- Время создания: Июл 03 2021 г., 15:32
-- Версия сервера: 10.5.11-MariaDB-log
-- Версия PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `j3798298`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(3) NOT NULL,
  `count` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size`, `count`) VALUES
(32, 2, 37, 'S', 1),
(42, 5, 156, 'L', 1),
(43, 5, 150, 'L', 1),
(44, 6, 156, 'M', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Женское'),
(34, 'Летнее'),
(2, 'Мужское');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE `emails` (
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`email`, `date`) VALUES
('shumilov000@yandex.ru', '2017-06-20');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `postal_code` varchar(10) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house` varchar(10) DEFAULT NULL,
  `apartment` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `date`, `processed`, `completed`, `postal_code`, `city`, `street`, `house`, `apartment`, `user_id`) VALUES
(28, 'Анна', '8(919) 679-8714', '2021-06-18 12:17:00', 1, 0, '', '', '', '', '', 5),
(29, 'Екатерина', '8(919) 543-6632', '2021-06-18 14:19:00', 1, 1, '654343', 'Киров', 'Ленина', '43', '5', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `size` varchar(3) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product`, `size`, `count`) VALUES
(7, 28, 156, 'L', 1),
(8, 28, 150, 'L', 1),
(9, 29, 156, 'M', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(50) NOT NULL COMMENT 'Наименование',
  `description` varchar(300) DEFAULT NULL COMMENT 'Описание',
  `img` varchar(20) DEFAULT NULL COMMENT 'Имя превью картинки',
  `price` int(11) NOT NULL COMMENT 'Цена',
  `category` varchar(30) DEFAULT NULL COMMENT 'Категория',
  `subcategory` varchar(30) DEFAULT NULL COMMENT 'Подкатегория',
  `hide` tinyint(1) DEFAULT 0 COMMENT 'Скрыть из поиска',
  `views` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `img`, `price`, `category`, `subcategory`, `hide`, `views`) VALUES
(1, 'Футболка Провинция', 'Лёгкая футболка', 'photo1.jpg', 1450, 'Мужское', NULL, 0, 0),
(16, 'Футболка RAAW', 'Лёгкая футболка', '6087eb322715f.jpg', 1450, 'Мужское', 'Футболки', 0, 0),
(37, 'Футболка ARTEM OVER', 'Розовая футболка', '608864b13c249.jpg', 2500, 'Женское', 'Футболки', 0, 9),
(129, 'Футболка RAAW', 'Летняя футболка', '60cb9ebaa6819.jpg', 1590, 'Женская одежда', 'Футболки', 0, 0),
(134, 'Брюки стрейч Classic Fit Straight', 'Универсальные брюки стрейч в стиле \"5 карманов\"', '60cbe1b7503c7.jpg', 1490, 'Мужское', 'Брюки', 0, 0),
(135, 'Футболка поло', 'Незаменимая вещь на каждый день! Классическая мужская футболка поло от bpc представлена широкой цветовой гаммой, в которой есть самые популярные оттенки. Маленькая вышивка на груди, а также контрастные полоски по краю воротника и рукавов заслуживают особого внимания. \"Дышащий\" хлопчатобумажный матер', '60cbe29528af5.jpg', 1000, 'Мужское', 'Футболки', 0, 1),
(136, 'Футболка поло', 'Базовая футболка поло из \"дышащего\" трикотажа пике. Машинная стирка.', '60cbe2fe9a764.jpg', 900, 'Мужское', 'Футболки', 0, 1),
(138, 'Футболка хенли', '', '60cbe4659f065.jpg', 780, 'Мужское', 'Футболки', 0, 1),
(139, 'Футболка поло', '', '60cbe50f46134.jpg', 1100, 'Мужское', 'Футболки', 0, 2),
(140, 'Брюки без застёжки Classic Fit Straight', 'Хорошо выглядеть и прекрасно себя чувствовать - вот девиз этой повседневной модели! Мужские брюки из легкого денима лучше всего подготовят вас к лету. Помимо \"дышащей\" хлопчатобумажной ткани, они отличаются также спортивным кроем: застежка здесь не предусмотрена, в кулиску на эластичном поясе', '60cbe5e9ce611.jpg', 1690, 'Мужское', 'Брюки', 0, 1),
(141, 'Чиносы Regular Fit Straight', '', '60cbe67b5ca33.jpg', 1733, 'Мужское', 'Брюки', 0, 0),
(142, 'Стёганая куртка «4 кармана»', 'Ткань верха с водоотталкивающей пропиткой\r\n- Воротник-стойка\r\n- Застёжка на молнии и кнопках\r\n- Ветрозащитная планка\r\n- 4 внешних кармана и 2 внутренних кармана\r\n- Длина: 74 см', '60cbe94bd3ff6.jpg', 1900, 'Мужское', 'Куртки', 0, 0),
(143, 'Утеплённая куртка', 'Утеплённая куртка с контрастными деталями\r\n\r\n- Ткань верха с водоотталкивающей пропиткой\r\n- Несъёмный капюшон\r\n- Ветрозащитная планка\r\n- 4 внешних кармана\r\n- 1 внутренний карман\r\n- Центральная застёжка на молнию и велкро\r\n- Регулировка по линии низа и капюшону\r\n- Утеплитель в стане 120 гр/м2, рукава', '60cbebbb89528.jpg', 3000, 'Мужское', 'Куртки', 0, 2),
(144, 'Стёганая куртка-бомбер', 'Стёганая куртка-бомбер\r\n\r\n- Ткань верха с водоотталкивающей пропиткой\r\n- Трикотажный воротник-гольф\r\n- Ветрозащитная планка\r\n- 2 внешних кармана\r\n- 2 внутренних кармана\r\n- Центральная застёжка на молнию\r\n- Трикотажные манжеты и пояс\r\n- Утеплитель 100 гр/м2', '60cbec611c750.jpg', 1900, 'Мужское', 'Куртки', 0, 1),
(145, 'Футболка с вырезом каре', 'Футболка с вырезом каре\r\n\r\n- Квадратный вырез горловины\r\n- Короткие рукава\r\n- Полотно в рубчик\r\n- Прилегающий силуэт', '60cbed185b71d.jpg', 1700, 'Женское', 'Футболки', 0, 4),
(146, 'Футболка с морским принтом', 'Футболка с морским принтом\r\n\r\n- Круглый вырез горловины\r\n- Короткие рукава с отворотами\r\n- Принт в морском стиле спереди\r\n- Слегка свободный полуприлегающий силуэт', '60cbedbb7270d.jpg', 599, 'Женское', 'Футболки', 0, 1),
(147, 'Соломенная шляпа', 'Соломенная шляпа с контрастной вышивкой и завязками', '60cbee9bc921d.jpg', 540, 'Женское', 'Шапки', 0, 1),
(148, 'Кепка с патчем', 'Кепка из искусственной замши с патчем', '60cbef0756040.jpg', 410, 'Женское', 'Шапки', 0, 1),
(149, 'Кепка с принтом', 'Кепка из хлопка с принтом-напылением', '60cbef99ea551.jpg', 560, 'Женское', 'Шапки', 0, 3),
(150, 'Платье с планкой на пуговицах', 'Платье выполнено из хлопкового полотна\r\n- Платье А-силуэта\r\n- V-образная горловина\r\n- Съёмный пояс из основного полотна\r\n- Застёжка на пуговицах\r\n- Длина - средняя', '60cbf139a051b.jpg', 1890, 'Женское', 'Платья', 0, 4),
(151, 'Платье с открытыми плечами', 'Платье выполнено из мягкого вискозного полотна\r\n- Открытые плечи\r\n- Приталенный силуэт\r\n- Короткие рукава\r\n- Пояс на резинке\r\n- Длина средняя', '60cbf21065f89.jpg', 1100, 'Женское', 'Платья', 0, 1),
(152, 'Джинсы на завышенной талии', 'Джинсы выполнены из плотного хлопка\r\n- Джинсы Mom с пятью карманами\r\n- Свободного силуэта\r\n- Зауженные к низу штанины\r\n- Завышенная талия\r\n- Застёжка на пуговицу/молнию\r\n- Укороченная длина\r\n- Длина по внутреннему шву 70 см (для размера 27)', '60cbf2a980807.jpg', 1200, 'Женское', 'Джинсы', 0, 2),
(153, 'Джинсы Mom свободного силуэта', 'Джинсы выполнены из плотного хлопка\r\n- Джинсы Mom с пятью карманами\r\n- Свободный силуэт\r\n- Зауженные книзу штанины\r\n- Завышенная талия\r\n- Застёжка на пуговицу/молнию\r\n- Укороченная длина', '60cbf33b8e18a.jpg', 1190, 'Женское', 'Джинсы', 0, 3),
(154, 'Базовые джинсы Straight Fit ', 'Застёжка на молнию и пуговицу\r\n- 5 карманов\r\n- Деним со стиркой\r\n- Fit: Straight', '60cbf3b97f610.jpg', 1400, 'Женское', 'Джинсы', 0, 3),
(155, 'Легкая парка с капюшоном', 'Легкая парка с капюшоном\r\n\r\n- Парка с объемными рукавами\r\n- Кулиска по талии\r\n- Большие накладные карманы\r\n- Застежка на молнию с ветрозащитной планкой\r\n- 2 внешних кармана\r\n- Паты на рукавах', '60cbf47437d1c.jpg', 2000, 'Женское', 'Куртки', 0, 1),
(156, 'Утеплённая куртка с капюшоном', 'Утеплённая куртка с капюшоном и большими карманами\r\n\r\n- Объёмная куртка свободного силуэта из водоотталкивающей ткани\r\n- Объёмный капюшон\r\n- Ветрозащитная планка\r\n- Спущенные плечи\r\n- Широкие отстрочки\r\n- 2 больших накладных кармана\r\n- 2 внутренних кармана на кнопках\r\n- Пластиковые молнии\r\n- Пуллеры', '60cbf4f719436.jpg', 1800, 'Женское', 'Куртки', 0, 6),
(157, 'Лёгкая парка с кулиской по талии', 'Лёгкая парка с кулиской по талии\r\n\r\n- Лёгкая городская парка с капюшоном\r\n- Защитная ткань\r\n- Ветрозащитная планка\r\n- Сборка по спинке, подчёркивающая фигуру\r\n- Манжеты на кнопках\r\n- Регулируемый капюшон\r\n- Центральная металлическая молния\r\n- Боковые карманы с декоративными клапанами на металлически', '60cbf5708438d.jpg', 1690, 'Женское', 'Куртки', 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL COMMENT 'ID изображения',
  `product_id` int(11) NOT NULL COMMENT 'ID товара',
  `img` varchar(20) NOT NULL COMMENT 'Имя изображения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img`) VALUES
(1, 1, 'img10.jpg'),
(2, 1, 'item-7.jpg'),
(3, 1, 'item-10.jpg'),
(23, 16, '6087eb3227abb.jpg'),
(24, 16, '6087eb3228a29.jpeg'),
(69, 37, '608864b13d194.jpg'),
(70, 37, '608864b13d804.jpg'),
(110, 127, '60bd4e5690839.jpg'),
(111, 127, '60bd4e569110d.jpg'),
(112, 128, '60c9bd4fbcf3f.jpg'),
(113, 128, '60c9bd4fbd8b9.jpeg'),
(114, 129, '60cb9ebaa6b27.jpg'),
(115, 129, '60cb9ebaa6d77.jpg'),
(128, 134, '60cbe1b750a29.jpg'),
(129, 134, '60cbe1b750e7f.jpg'),
(130, 134, '60cbe1b751439.jpg'),
(131, 135, '60cbe29528d67.jpg'),
(132, 135, '60cbe29529134.jpg'),
(133, 135, '60cbe2952936a.jpg'),
(134, 136, '60cbe2fe9ae17.jpg'),
(135, 136, '60cbe2fe9b3f4.jpg'),
(136, 136, '60cbe2fe9b77a.jpg'),
(139, 138, '60cbe4659f59d.jpg'),
(140, 138, '60cbe4659f8c3.jpg'),
(141, 138, '60cbe4659fb80.jpg'),
(142, 139, '60cbe50f46734.jpg'),
(143, 139, '60cbe50f46b70.jpg'),
(144, 140, '60cbe5e9cec13.jpg'),
(145, 140, '60cbe5e9cf06f.jpg'),
(146, 140, '60cbe5e9cf35c.jpg'),
(147, 141, '60cbe67b5d17b.jpg'),
(148, 141, '60cbe67b5d56c.jpg'),
(149, 142, '60cbe94bd4407.jpg'),
(150, 142, '60cbe94bd492b.jpg'),
(151, 142, '60cbe94bd4e11.jpg'),
(152, 143, '60cbebbb899f5.jpg'),
(153, 143, '60cbebbb89c39.jpg'),
(154, 143, '60cbebbb89de5.jpg'),
(155, 144, '60cbec611cbd7.jpg'),
(156, 144, '60cbec611ce09.jpg'),
(157, 144, '60cbec611cfc3.jpg'),
(158, 144, '60cbec611d144.jpg'),
(159, 145, '60cbed185bb20.jpg'),
(160, 145, '60cbed185bd96.jpg'),
(161, 145, '60cbed185bf53.jpg'),
(162, 146, '60cbedbb72a84.jpg'),
(163, 146, '60cbedbb72c54.jpg'),
(164, 146, '60cbedbb72d6d.jpg'),
(165, 147, '60cbee9bc94c5.jpg'),
(166, 147, '60cbee9bc965a.jpg'),
(167, 147, '60cbee9bc977e.jpg'),
(168, 148, '60cbef0756499.jpg'),
(169, 148, '60cbef07566ac.jpg'),
(170, 148, '60cbef075681a.jpg'),
(171, 149, '60cbef99ea903.jpg'),
(172, 149, '60cbef99eabee.jpg'),
(173, 149, '60cbef99eada6.jpg'),
(174, 150, '60cbf139a090f.jpg'),
(175, 150, '60cbf139a0c5e.jpg'),
(176, 150, '60cbf139a0ef5.jpg'),
(177, 151, '60cbf210663db.jpg'),
(178, 151, '60cbf2106665e.jpg'),
(179, 151, '60cbf21066823.jpg'),
(180, 152, '60cbf2a980ba7.jpg'),
(181, 152, '60cbf2a980dd1.jpg'),
(182, 152, '60cbf2a980ff9.jpg'),
(183, 153, '60cbf33b8e51c.jpg'),
(184, 153, '60cbf33b8e718.jpg'),
(185, 153, '60cbf33b8e86e.jpg'),
(186, 153, '60cbf33b8eaad.jpg'),
(187, 154, '60cbf3b97fa1d.jpg'),
(188, 154, '60cbf3b97fd49.jpg'),
(189, 154, '60cbf3b97febc.jpg'),
(190, 155, '60cbf474380bf.jpg'),
(191, 155, '60cbf47438383.jpg'),
(192, 155, '60cbf474385d5.jpg'),
(193, 156, '60cbf4f719849.jpg'),
(194, 156, '60cbf4f719a0e.jpg'),
(195, 156, '60cbf4f719b4c.jpg'),
(196, 156, '60cbf4f719c9b.jpg'),
(197, 157, '60cbf570846b7.jpg'),
(198, 157, '60cbf57084896.jpg'),
(199, 157, '60cbf570849cd.jpg'),
(200, 157, '60cbf57084bbd.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`) VALUES
(63, 16, 'M'),
(64, 16, 'L'),
(65, 16, 'XL'),
(85, 1, 'S'),
(86, 1, 'M'),
(87, 1, 'XL'),
(91, 127, 'XS'),
(92, 127, 'M'),
(93, 127, 'L'),
(94, 37, 'S'),
(95, 37, 'XL'),
(96, 37, 'XXL'),
(100, 128, 'S'),
(101, 128, 'M'),
(102, 128, 'XL'),
(103, 129, 'S'),
(104, 129, 'M'),
(105, 129, 'L'),
(106, 129, 'XXL'),
(121, 134, 'XS'),
(122, 134, 'M'),
(123, 134, 'L'),
(124, 135, 'XS'),
(125, 135, 'S'),
(126, 135, 'M'),
(127, 135, 'L'),
(128, 135, 'XL'),
(129, 136, 'S'),
(130, 136, 'M'),
(131, 136, 'L'),
(132, 136, 'XL'),
(137, 138, 'S'),
(138, 138, 'M'),
(139, 138, 'L'),
(140, 138, 'XL'),
(141, 139, 'S'),
(142, 139, 'M'),
(143, 139, 'L'),
(144, 139, 'XL'),
(145, 140, 'S'),
(146, 140, 'M'),
(147, 140, 'L'),
(148, 141, 'S'),
(149, 141, 'M'),
(150, 141, 'L'),
(151, 141, 'XL'),
(152, 142, 'S'),
(153, 142, 'M'),
(154, 142, 'L'),
(155, 142, 'XL'),
(160, 144, 'S'),
(161, 144, 'M'),
(162, 144, 'L'),
(163, 144, 'XL'),
(164, 145, 'S'),
(165, 145, 'M'),
(166, 145, 'L'),
(167, 146, 'S'),
(168, 146, 'M'),
(169, 146, 'L'),
(170, 147, 'S'),
(171, 147, 'M'),
(172, 147, 'L'),
(173, 148, 'S'),
(174, 148, 'M'),
(175, 148, 'L'),
(176, 149, 'S'),
(177, 149, 'M'),
(178, 149, 'L'),
(179, 150, 'S'),
(180, 150, 'M'),
(181, 150, 'L'),
(182, 151, 'XS'),
(183, 151, 'S'),
(184, 151, 'M'),
(185, 151, 'L'),
(186, 152, 'M'),
(187, 152, 'L'),
(188, 152, 'XL'),
(189, 153, 'S'),
(190, 153, 'M'),
(191, 153, 'L'),
(192, 153, 'XL'),
(193, 154, 'M'),
(194, 154, 'L'),
(195, 154, 'XL'),
(196, 155, 'S'),
(197, 155, 'M'),
(198, 155, 'XXL'),
(202, 157, 'S'),
(203, 157, 'L'),
(204, 157, 'XXL'),
(208, 143, 'M'),
(209, 143, 'L'),
(210, 143, 'XL'),
(211, 143, 'XXL'),
(212, 156, 'XS'),
(213, 156, 'S'),
(214, 156, 'L');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `subcategory` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subcategories`
--

INSERT INTO `subcategories` (`id`, `category`, `subcategory`) VALUES
(44, 'Женское', 'Джинсы'),
(45, 'Женское', 'Куртки'),
(43, 'Женское', 'Платья'),
(3, 'Женское', 'Футболки'),
(4, 'Женское', 'Шапки'),
(46, 'Летнее', 'Шорты'),
(42, 'Мужское', 'Брюки'),
(18, 'Мужское', 'Джинсы'),
(10, 'Мужское', 'Куртки'),
(33, 'Мужское', 'Футболки'),
(19, 'Мужское', 'Шапки');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT 'Логин',
  `nickname` varchar(20) DEFAULT NULL COMMENT 'Ник',
  `password` varchar(32) NOT NULL COMMENT 'Пароль',
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `password`, `admin`) VALUES
(1, 'admin', 'administrator', 'd88c7cbeea562501a3fbd1d344dce313', 1),
(2, 'ivan@mail.ru', 'Иван', 'f9fc4343cf3c9b1632219869d0ccfb98', NULL),
(3, 'user', 'User', 'f9fc4343cf3c9b1632219869d0ccfb98', NULL),
(4, 'user@mail.ru', 'User', 'd88c7cbeea562501a3fbd1d344dce313', NULL),
(5, 'shumilov000@yandex.ru', 'Иван', '88eaae3cf1aac7749b50fa5484e81089', NULL),
(6, 'ivan1@mail.ru', 'Ivan', 'f9fc4343cf3c9b1632219869d0ccfb98', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Индексы таблицы `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product` (`product`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_ibfk_1` (`product_id`);

--
-- Индексы таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_2` (`category`,`subcategory`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT для таблицы `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID изображения', AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT для таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT для таблицы `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
