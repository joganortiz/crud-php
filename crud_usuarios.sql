-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-09-2021 a las 21:18:41
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `sluck` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  `estado_usuario` enum('1','0') COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `imagen`, `nombre`, `sluck`, `telefono`, `email`, `status`, `estado_usuario`) VALUES
(1, '1624984111390.png', 'Producto 1', '0', '123', 'jogan@gmail.com', '1', '0'),
(2, 'descarga.jpeg', 'Producto 2', '0', '321', 'jogan@gmail.com', '1', '0'),
(3, 'descarga1.jpeg', 'Producto 1', 'Producto-1', '123', 'jogan@gmail.com', '1', '1'),
(4, '1624984111390.png', 'Producto 1', '0', '321', 'jogan@gmail.com', '1', '1'),
(5, 'descarga.jpeg', 'Producto 1', '0', '', '', '1', '0'),
(6, 'descarga.jpeg', 'Suscripción 1 Dia', '0', '3178704204', '', '1', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
