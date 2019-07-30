-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2019 a las 20:32:09
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
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `item` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`item`, `precio`) VALUES
('asado', 580),
('Cerveza negra', 105),
('Cerveza roja', 110),
('Cerveza rubia', 110),
('Champagne', 150),
('Empanadas', 30),
('Lemon Pie', 90),
('Ravioles', 120),
('Vino Blanco', 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `mesa` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `mesa`) VALUES
(1, 'Roman', 'Gandolfi', '86q7r'),
(2, 'Alejandro', 'Rodriguez', 'kvscx'),
(3, 'Nahuel', 'Rojas', '1xdw6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `idMesa` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `mesa` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `mozo` int(11) NOT NULL,
  `cocinero` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `estado` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigo` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`estado`, `codigo`) VALUES
('Cerrada', '1xdw6'),
('cerrada', '86q7r'),
('Cerrada', 'kvscx'),
('Cerrada', 'lys09'),
('con clientes pagando', 'vhlac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `tipo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idMesa` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tiempo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `codigo` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `inicio` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`tipo`, `idMesa`, `estado`, `tiempo`, `cantidad`, `precio`, `codigo`, `inicio`) VALUES
('cervecero', 'kvscx', 'En espera', 'Calculando', 2, 220, '5pi72', '30.07.19 14:25:08'),
('cocinero', 'kvscx', 'En espera', 'Calculando', 5, 150, 'fydtq', '30.07.19 14:25:08'),
('bartender', 'kvscx', 'listo para servir', '20min', 2, 150, 'gu294', '30.07.19 14:25:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `clave`, `tipo`, `activo`) VALUES
('Juan', '1234', 'socio', 1),
('Manuel', '4212', 'cervecero', 1),
('Nicolas', '9177', 'bartender', 1),
('Norberto', '5234', 'mozo', 1),
('Ricardo', '5267', 'cocinero', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`item`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`idMesa`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
