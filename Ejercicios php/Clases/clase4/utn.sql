-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2019 a las 02:24:48
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `utn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Legajo` int(5) NOT NULL,
  `Localidad` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Id`, `Nombre`, `Legajo`, `Localidad`) VALUES
(1, 'Juan', 111, 1),
(2, 'Maria', 112, 3),
(3, 'Lucia', 113, 2),
(4, 'Marcos', 114, 2),
(5, 'Marisa', 115, 1),
(6, 'Jose', 116, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `Id` int(11) NOT NULL,
  `Localidad` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`Id`, `Localidad`) VALUES
(1, 'Avellaneda'),
(2, 'Quilmes'),
(3, 'Lanus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia-alumno`
--

CREATE TABLE `materia-alumno` (
  `Id` int(11) NOT NULL,
  `Id_Materia` int(11) NOT NULL,
  `Id_Alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `materia-alumno`
--

INSERT INTO `materia-alumno` (`Id`, `Id_Materia`, `Id_Alumno`) VALUES
(1, 4, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 1, 5),
(6, 3, 6),
(7, 1, 2),
(8, 4, 5),
(9, 2, 1),
(10, 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`Id`, `Nombre`) VALUES
(1, 'Matematicas'),
(2, 'Programacion'),
(3, 'Sociedad y Estado'),
(4, 'Metodologia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `materia-alumno`
--
ALTER TABLE `materia-alumno`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `materia-alumno`
--
ALTER TABLE `materia-alumno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
