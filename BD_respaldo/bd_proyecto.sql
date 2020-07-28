-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-07-2020 a las 04:21:07
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
-- Estructura de tabla para la tabla `categoria_productos`
--

DROP TABLE IF EXISTS `categoria_productos`;
CREATE TABLE IF NOT EXISTS `categoria_productos` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `id_facturacion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_detalle` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_detalle`),
  UNIQUE KEY `id_facturacion` (`id_facturacion`),
  UNIQUE KEY `id_producto` (`id_producto`)
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
  `id_login` int(11) NOT NULL,
  `direccion_empleado` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_empleado` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `id_login` (`id_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

DROP TABLE IF EXISTS `facturacion`;
CREATE TABLE IF NOT EXISTS `facturacion` (
  `id_facturacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_modo_pago` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_facturacion`),
  UNIQUE KEY `id_cliente` (`id_cliente`),
  UNIQUE KEY `id_modo_pago` (`id_modo_pago`),
  UNIQUE KEY `id_empleado` (`id_empleado`)
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
  `id_tipo_usuario` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_login`),
  UNIQUE KEY `id_tipo_usuario` (`id_tipo_usuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `id_categoria` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `id_categoria` (`id_categoria`),
  UNIQUE KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_facturacion`) REFERENCES `facturacion` (`id_facturacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`id_modo_pago`) REFERENCES `modo_de_pago` (`id_modo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacion_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_productos` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
