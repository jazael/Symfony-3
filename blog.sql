-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2017 a las 08:07:30
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'PHP 5.8.2', 'Desarrollo con symfony 3.0'),
(2, 'Java', 'Programacion orientada a servicios web'),
(4, 'PHP 5.7.2', 'Desarrollo con symfony 3.0'),
(5, 'PHP 7.2.3', 'Desarrollo con symfony 3.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entries`
--

DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `category_id`, `title`, `content`, `status`, `image`) VALUES
(7, 1, 5, 'Entrada 3 con multiples Tags editada', 'Contenido para entrada TRES con multiples Tags', 'private', '1490162981.png'),
(8, 1, 2, 'Entrada 4 con multiples Tags', 'Contenido para entrada cuatro con multiples Tags', 'public', '1490164303.png'),
(9, 1, 4, 'Entrada para Simfony', 'Contenido no disponible', 'public', '1490165169.jpeg'),
(10, 1, 1, 'Enrada para Vaadyn', 'Contenido disponible para usuarios de vaadyn', 'private', '1490165252.jpeg'),
(11, 1, 5, 'Entrada para laravle', 'Contenido solo para usuarios premiun de laravel', 'private', '1490165588.jpeg'),
(13, 1, 1, 'Struts', 'Contenido para strust', 'public', '1490165374.jpeg'),
(15, 1, 5, 'dwdwdw', 'ewewewew', 'private', '1490218191.png'),
(16, 1, 4, 'Entrada para PHP', 'Contenido para entradas de PHP', 'private', '1490225875.jpeg'),
(17, 1, 5, 'EJEMPLO', 'EJEMPLO', 'public', '1490226221.jpeg'),
(18, 1, 5, 'PHP VERSION 7', 'CONTENIDO PHP PARA VERSION 7', 'public', '1490226292.jpeg'),
(19, 1, 5, 'EJEMPLO PARA VAADYN JPA', 'CONTENIDO DE EJEMPLO PARA VAADYN', 'public', '1490226376.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrie_tag`
--

DROP TABLE IF EXISTS `entrie_tag`;
CREATE TABLE `entrie_tag` (
  `id` int(255) NOT NULL,
  `entry_id` int(255) NOT NULL,
  `tag_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrie_tag`
--

INSERT INTO `entrie_tag` (`id`, `entry_id`, `tag_id`) VALUES
(5, 7, 12),
(6, 7, 13),
(7, 7, 14),
(8, 7, 15),
(14, 7, 26),
(15, 7, 27),
(23, 8, 33),
(24, 8, 34),
(25, 8, 35),
(26, 9, 36),
(27, 9, 37),
(28, 10, 38),
(29, 10, 39),
(34, 13, 42),
(35, 13, 43),
(37, 11, 45),
(38, 11, 44),
(40, 15, 47),
(41, 15, 48),
(42, 16, 49),
(43, 16, 50),
(44, 17, 51),
(45, 17, 52),
(46, 18, 53),
(47, 18, 54),
(50, 19, 55),
(51, 19, 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`) VALUES
(9, 'PHP', 'PHP'),
(10, ' MVC', ' MVC'),
(11, ' VAADYN', ' VAADYN'),
(12, 'JAVA', 'JAVA'),
(13, ' STRUTS', ' STRUTS'),
(14, ' JDBC', ' JDBC'),
(15, ' HIBERNATE', ' HIBERNATE'),
(16, 'VAADYN7', 'VAADYN7'),
(17, ' PHP8', ' PHP8'),
(18, ' PHP2', ' PHP2'),
(19, ' PRIMERFACES', ' PRIMERFACES'),
(20, ' JSPMVC', ' JSPMVC'),
(21, 'qwewqeqewe', 'qwewqeqewe'),
(22, ' ssdssd', ' ssdssd'),
(23, ' sdsds', ' sdsds'),
(24, ' dsdsd', ' dsdsd'),
(25, 'sdsds', 'sdsds'),
(26, 'fdfdsfsdfsdf', 'fdfdsfsdfsdf'),
(27, 'fgdfgfdgfgd', 'fgdfgfdgfgd'),
(28, '  PHP8', '  PHP8'),
(29, '  PHP2', '  PHP2'),
(30, '  PRIMERFACES', '  PRIMERFACES'),
(31, '  JSPMVC', '  JSPMVC'),
(32, ' PHP', ' PHP'),
(33, 'APPVAADYN', 'APPVAADYN'),
(34, ' SLIM PHP', ' SLIM PHP'),
(35, ' JAVA 8.1', ' JAVA 8.1'),
(36, 'simfony 2.0', 'simfony 2.0'),
(37, ' simfony 3.5', ' simfony 3.5'),
(38, 'Vaddyn JPA', 'Vaddyn JPA'),
(39, ' STRUTS 2', ' STRUTS 2'),
(40, 'Laravel 5.3', 'Laravel 5.3'),
(41, ' Doctrine 2.', ' Doctrine 2.'),
(42, 'Struts 2', 'Struts 2'),
(43, ' Srtust 5.1', ' Srtust 5.1'),
(44, 'Etiqueta de prueba', 'Etiqueta de prueba'),
(45, 'Doctrine 2.', 'Doctrine 2.'),
(46, 'sddsd', 'sddsd'),
(47, 'qewew', 'qewew'),
(48, ' efef', ' efef'),
(49, 'PHP 7.8', 'PHP 7.8'),
(50, ' PHP SYMFONY', ' PHP SYMFONY'),
(51, 'EJEMPLO1', 'EJEMPLO1'),
(52, ' EJEMPLO2', ' EJEMPLO2'),
(53, 'LARAVEL', 'LARAVEL'),
(54, ' LARAVEL V.52', ' LARAVEL V.52'),
(55, 'VAADYN SPRING MVC', 'VAADYN SPRING MVC'),
(56, ' SPRIN 3', ' SPRIN 3'),
(57, 'Etiqueta Prueba', 'Descripcion culaquier cosa'),
(58, 'Etiqueta Prueba', 'Descripcion culaquier cosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `imagen`) VALUES
(1, 'ROLE_ADMIN', 'Miguel', 'Faubla', 'mfaubla1915@utm.edu.ec', '$2a$04$dov9uDtbeHkU/V45x8lOBuLC3tZQUogq3CZi5sKx.P.zAlb6rLfCe', '../src/modulo.gif'),
(2, 'ROLE_ADMIN', 'Miguel', 'Faubla', 'fanthonymiguel@hotmail.com', '$2a$04$Eum3oPrCGR6DojKu8floM.bxGmWqoLmDn91G6ITXnmP6xcqEI7gkq', NULL),
(3, 'ROLE_USER', 'Jazael', 'Faubla', 'jazaelfaubla@hotmail.com', '123456789', NULL),
(4, 'ROLE_USER', 'Jannina', 'Chavez', 'janny@hotmail.com', '78945', NULL),
(5, 'ROLE_USER', 'Janninac', 'Chavez', 'janny@hotmail.com', '$2y$04$/BqdwiqfcYir8m2cpMYxIueZv8pApIQBPmZI6wOOAhKW6KWOWaryG', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_users` (`user_id`),
  ADD KEY `fk_entries_categories` (`category_id`);

--
-- Indices de la tabla `entrie_tag`
--
ALTER TABLE `entrie_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrie_tag_entries` (`entry_id`),
  ADD KEY `fk_entrie_tag_tags` (`tag_id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `entrie_tag`
--
ALTER TABLE `entrie_tag`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `fk_entries_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_entries_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `entrie_tag`
--
ALTER TABLE `entrie_tag`
  ADD CONSTRAINT `fk_entrie_tag_entries` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`id`),
  ADD CONSTRAINT `fk_entrie_tag_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
