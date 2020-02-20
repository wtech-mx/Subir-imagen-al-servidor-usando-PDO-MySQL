-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2018 a las 00:12:48
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `php_imagenpdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagenes`
--

CREATE TABLE IF NOT EXISTS `tbl_imagenes` (
`imagen_ID` int(11) NOT NULL,
  `imagen_Marca` varchar(200) CHARACTER SET ucs2 NOT NULL,
  `imagen_Tipo` varchar(200) NOT NULL,
  `imagen_Img` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tabla de Imagenes';

--
-- Volcado de datos para la tabla `tbl_imagenes`
--

INSERT INTO `tbl_imagenes` (`imagen_ID`, `imagen_Marca`, `imagen_Tipo`, `imagen_Img`) VALUES
(1, 'Formateo', 'Datasa', '770585.jpg'),
(3, 'Cibertel', 'Amperio', '798786.jpg'),
(4, 'mantenimiento', 'Reparacion', '736043.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_imagenes`
--
ALTER TABLE `tbl_imagenes`
 ADD PRIMARY KEY (`imagen_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_imagenes`
--
ALTER TABLE `tbl_imagenes`
MODIFY `imagen_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
