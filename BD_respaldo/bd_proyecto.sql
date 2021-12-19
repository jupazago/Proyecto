-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-08-2020 a las 03:17:01
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_cliente` int(11) NOT NULL,
  `direccion_cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_facturacion1` int(11) NOT NULL,
  `id_producto1` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_detalle` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_producto1` (`id_producto1`) USING BTREE,
  KEY `id_facturacion1` (`id_facturacion1`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_empleado` int(11) NOT NULL,
  `id_login1` int(11) NOT NULL,
  `direccion_empleado` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_empleado` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `id_login1` (`id_login1`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre_empleado`, `identificacion_empleado`, `id_login1`, `direccion_empleado`, `telefono_empleado`, `estado`) VALUES
(1, 'JUAN PABLO ZAPATA', 741852963, 1, 'San Luis', '123456789', 'ACTIVO'),
(2, 'OSNEIDER MONTOYA', 852963741, 4, 'Todo lado', '123456789', 'ACTIVO'),
(3, 'EDWARD GIRALDO', 963741852, 3, 'El Peñol', '123456789', 'ACTIVO'),
(7, 'PRUEBA', 555555, 11, 'nueva direcciÃ³n', '3154654545', 'ACTIVO'),
(8, 'NUEVO EMPLEADO', 456321, 12, 'nueva direcciÃ³n 2', '315447844', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

DROP TABLE IF EXISTS `facturacion`;
CREATE TABLE IF NOT EXISTS `facturacion` (
  `id_facturacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente1` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_modo_pago1` int(11) NOT NULL,
  `id_empleado1` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_facturacion`),
  UNIQUE KEY `id_cliente1` (`id_cliente1`) USING BTREE,
  UNIQUE KEY `id_empleado1` (`id_empleado1`) USING BTREE,
  UNIQUE KEY `id_modo_pago1` (`id_modo_pago1`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_usuario1` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_tipo_usuario1` (`id_tipo_usuario1`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `id_tipo_usuario1`, `estado`) VALUES
(1, 'jupazago', '123456789', 1, 'ACTIVO'),
(3, 'edwardG', '123456789', 1, 'ACTIVO'),
(4, 'osneiderM', '123456789', 1, 'ACTIVO'),
(11, 'nuevo', 'nuevoxd', 3, 'ACTIVO'),
(12, 'xdnuevo', '214545', 2, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modo_de_pago`
--

DROP TABLE IF EXISTS `modo_de_pago`;
CREATE TABLE IF NOT EXISTS `modo_de_pago` (
  `id_modo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `modo_de_pago` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_modo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_producto` bigint(20) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `id_proveedor1` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_proveedor1` (`id_proveedor1`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_producto`, `nombre_producto`, `descripcion`, `precio_producto`, `id_proveedor1`, `estado`) VALUES
(1, 6970301340065, 'bombillo luminoso', 'luminosito xd', 6000, 4, 'ACTIVO'),
(2, 47400097742, 'Desodorante 107g', 'Sport Triumph', 12500, 5, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `estado`) VALUES
(1, 'Colanta', 'Rionegro, calle inventada y casa inventada xd', 'llame prro', 'ACTIVO'),
(2, 'Auralac', 'otra vez Rionegro', '3125343 lo que sea', 'ACTIVO'),
(3, 'Colombina', 'por medellin', '521 2456 4845 (4)', 'ACTIVO'),
(4, 'AngelLight', 'ni idea', 'ni idea', 'ACTIVO'),
(5, 'Gillette', 'medellin crr fsdbfjksdbf', '34513254531 (6)', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_de_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_de_usuario`, `estado`) VALUES
(1, 'Administrador', 'ACTIVO'),
(2, 'Empleado_Entendido', 'ACTIVO'),
(3, 'Empleado', 'ACTIVO');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_facturacion1`) REFERENCES `facturacion` (`id_facturacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_producto1`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_login1`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`id_modo_pago1`) REFERENCES `modo_de_pago` (`id_modo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`id_cliente1`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_3` FOREIGN KEY (`id_empleado1`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_tipo_usuario1`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
