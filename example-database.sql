-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-01-2019 a las 17:26:45
-- Versión del servidor: 5.7.25
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `reachqa_eatri_sitio_qa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_postit`
--

CREATE TABLE `wp_postit` (
  `id` int(10) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `activa` int(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `wp_postit`
--
ALTER TABLE `wp_postit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `wp_postit`
--
ALTER TABLE `wp_postit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `wp_postit` (`nota`, `activa`, `created`) VALUES ('Nota', '1', CURRENT_TIMESTAMP);
('Corpus Christi Catholic School', '1', CURRENT_TIMESTAMP),
('Holy Spirit Episcopal School', '0', CURRENT_TIMESTAMP),
('Our Lady of Guadalupe Catholic School', '0', CURRENT_TIMESTAMP),
('Pilgrim Lutheran School', '0', CURRENT_TIMESTAMP),
('Saint Augustine Catholic School', '0', CURRENT_TIMESTAMP),
('Saint Anne Catholic School', '0', CURRENT_TIMESTAMP),
('Saint Christopher Catholic School', '0', CURRENT_TIMESTAMP),
('The Woodlands Christian Academy', '0', CURRENT_TIMESTAMP);
