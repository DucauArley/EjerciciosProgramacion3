-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2019 a las 19:50:18
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `articulo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`articulo`, `fecha`, `precio`, `usuario`, `id`) VALUES
('Caramelos', '22/06/2019', '20', 'admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `usuario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `metodo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ruta` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`usuario`, `metodo`, `ruta`, `hora`, `id`) VALUES
('admin', 'post', '/usuario', '00:20:32', 1),
('admin', 'post', '/login', '19:38:21', 3),
('admin', 'post', '/login', '14:02:48', 4),
('admin', 'get', '/usuario', '14:03:14', 5),
('admin', 'get', '/usuario', '14:14:45', 6),
('admin', 'get', '/usuario', '14:29:17', 7),
('admin', 'get', '/usuario', '14:39:18', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `sexo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `perfil` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `clave`, `sexo`, `perfil`, `id`) VALUES
('admin', 'admin', 'femenino', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
