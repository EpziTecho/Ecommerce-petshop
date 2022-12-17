-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2022 a las 22:47:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petshop`
--

CREATE DATABASE PETSHOP;
USE PETSHOP;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `raiz` varchar(100) DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon`
--

CREATE TABLE `cupon` (
  `id_cupon` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `porcentaje_dscto` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO, U:USO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuario`
--

CREATE TABLE `grupo_usuario` (
  `id_grupo_usuario` int(11) NOT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_usuario`
--

CREATE TABLE `modulo_usuario` (
  `id_modulo_usuario` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` char(100) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cupon` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nro_pedido` char(18) NOT NULL,
  `monto_dscto` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE: PORCENTAJE DE CUPON EN DECIMAL * SUBTOTAL',
  `subtotal` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE: SUMA DEL IMPORTE',
  `total` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE: SUBTOTAL - MONTO DSCTO',
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO, P:DEVUELTO PARCIAL, T:DEVOLUCION TOTAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `id_pedido_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `importe` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE:CANTIDAD X PRECIO',
  `importe_dscto` decimal(11,2) DEFAULT NULL COMMENT 'OBETENER CAMPO PRECIO DE LA TABLA PROMOCION',
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO, D: DEVUELTO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

CREATE TABLE `permiso_usuario` (
  `id_permiso_usuario` int(11) NOT NULL,
  `id_grupo_usuario` int(11) NOT NULL COMMENT 'ROL USUARIO',
  `id_modulo_usuario` int(11) NOT NULL,
  `r` int(11) DEFAULT NULL,
  `w` int(11) DEFAULT NULL,
  `u` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `fecha_vencimiento` datetime DEFAULT NULL,
  `mascota` varchar(10) DEFAULT NULL COMMENT 'PERRO, GATO',
  `tamanio_mascota` varchar(10) DEFAULT NULL COMMENT 'PEQUENIO, MEDIANO, GRANDE',
  `ciclo_vida_mascota` varchar(10) DEFAULT NULL COMMENT 'CACHORRO, ADOLESCENTE, ADULTO, SENIOR',
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO, D:DESPERFECTO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_archivo`
--

CREATE TABLE `producto_archivo` (
  `id_producto_archivo` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_archivo` int(11) NOT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo_promocion` char(1) NOT NULL COMMENT 'O:OFERTA, P:PROMOCION, L:LIQUIDACION',
  `descripcion` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL COMMENT 'CANTIDAD PARA APLICAR PROMOCION',
  `precio` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE: PRECIO PRODUCTO - PORCENTAJE DSCTO',
  `monto_dscto` decimal(11,2) DEFAULT NULL COMMENT 'CALCULABLE: PORCENTAJE DSCTO DE PROMOCION EN DECIMAL * PRECIO DE PRODUCTO',
  `porcentaje_dscto` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `ruc` char(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(80) NOT NULL,
  `contrasenia` varchar(100) DEFAULT NULL,
  `id_grupo_usuario` int(11) DEFAULT NULL,
  `usuario_reg` varchar(80) DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `usuario_mod` varchar(80) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `estado` char(1) DEFAULT NULL COMMENT 'A:ACTIVO, I:INACTIVO, X:ANULADO',
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id_cupon`,`descripcion`);

--
-- Indices de la tabla `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD PRIMARY KEY (`id_grupo_usuario`);

--
-- Indices de la tabla `modulo_usuario`
--
ALTER TABLE `modulo_usuario`
  ADD PRIMARY KEY (`id_modulo_usuario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`,`nro_pedido`),
  ADD KEY `id_cupon` (`id_cupon`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id_pedido_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto1` (`id_producto`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`id_permiso_usuario`),
  ADD KEY `id_grupo_usuario` (`id_grupo_usuario`),
  ADD KEY `id_modulo_usuario` (`id_modulo_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `producto_archivo`
--
ALTER TABLE `producto_archivo`
  ADD PRIMARY KEY (`id_producto_archivo`),
  ADD KEY `id_archivo` (`id_archivo`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `id_producto2` (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`,`correo`),
  ADD KEY `id_grupo_usuario1` (`id_grupo_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cupon`) REFERENCES `cupon` (`id_cupon`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `pedido_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `permiso_usuario_ibfk_1` FOREIGN KEY (`id_grupo_usuario`) REFERENCES `grupo_usuario` (`id_grupo_usuario`),
  ADD CONSTRAINT `permiso_usuario_ibfk_2` FOREIGN KEY (`id_modulo_usuario`) REFERENCES `modulo_usuario` (`id_modulo_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `producto_archivo`
--
ALTER TABLE `producto_archivo`
  ADD CONSTRAINT `producto_archivo_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `producto_archivo_ibfk_2` FOREIGN KEY (`id_archivo`) REFERENCES `archivo` (`id_archivo`);

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_grupo_usuario`) REFERENCES `grupo_usuario` (`id_grupo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
