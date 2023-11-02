-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2023 a las 03:45:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pagos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `idbanco` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`idbanco`, `idusuario`, `titulo`, `descripcion`, `fecha_hora`, `estado`, `eliminado`) VALUES
(1, 1, 'banco Interbank', 'Banco de confianza', '2023-09-18 15:53:58', 'activado', 0),
(2, 1, 'banco de crédito BCP', 'Banco de confianza', '2023-09-18 15:54:43', 'activado', 0),
(11, 4, 'interbank', 'Banco de confianza', '2023-10-08 17:46:04', 'activado', 0),
(14, 15, 'banco jorge', 'asawdawdawsd', '2023-11-01 11:33:15', 'activado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversaciones`
--

CREATE TABLE `conversaciones` (
  `idconversacion` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `asunto` varchar(40) NOT NULL,
  `mensaje` longtext NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `conversaciones`
--

INSERT INTO `conversaciones` (`idconversacion`, `idusuario`, `receptor`, `asunto`, `mensaje`, `fecha_hora`) VALUES
(2, 3, 2, 'Comunicado', 'El día 12 de octubre el sistema estará en mantenimiento.', '2023-11-01 12:25:07'),
(3, 2, 1, 'Comunicado2', 'El día 12 de octubre el sistema estará en mantenimiento.', '2023-11-01 19:00:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `idlocal` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `local_ruc` varchar(15) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`idlocal`, `idusuario`, `titulo`, `local_ruc`, `descripcion`, `fecha_hora`, `estado`, `eliminado`) VALUES
(1, 1, 'Local de Chorrillos, Lima', '48596631120', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-18 15:56:56', 'activado', 0),
(2, 2, 'Local de Los Olivos, Lima', '44569002934', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-18 15:56:56', 'activado', 0),
(3, 3, 'Local de Ate Vitarte, Lima', '04122934501', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-18 15:56:56', 'activado', 0),
(4, 4, 'Local de Comas, Lima', '49577549913', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-18 15:56:56', 'activado', 0),
(6, 5, 'Local de Ventanilla, Lima', '44448564548', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-18 15:56:56', 'activado', 0),
(8, 5, 'Local de Ate Vitarte, Lima', '34234234234', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-25 10:48:54', 'activado', 0),
(9, 15, 'Local de Cieneguilla, Lima', '39203486095', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-09-25 23:56:09', 'activado', 0),
(25, 0, 'Local de San Miguel, Lima', '34985348795', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-10-01 22:31:54', 'activado', 0),
(30, 4, 'Local de SJM, Lima', '99956756761', 'un local donde se almacenará productos, listo para ser comercializados en el mercado.', '2023-10-08 23:14:57', 'activado', 0),
(32, 0, 'asdasdasd', '23423423432', 'assadsdaasd', '2023-10-29 23:15:11', 'activado', 0),
(35, 1, 'asdasdasdasdasdasdsdaasdsadsa', '48596631120', 'asdasdasddas', '2023-10-31 11:55:50', 'activado', 0),
(36, 1, 'dassdaasdawe12', '48596631120', 'asdasdawdawd', '2023-10-31 11:56:05', 'activado', 0),
(37, 2, 'asdasdasdas', '48596631122', 'asddasadsd', '2023-10-31 11:56:28', 'activado', 0),
(38, 2, '4234dasda3eaw', '12342445353', 'asdasdsad', '2023-10-31 11:56:51', 'activado', 0),
(39, 1, 'asddasasdasd', '48596631120', 'asdasda', '2023-10-31 12:10:30', 'activado', 0),
(40, 0, 'asdasdasdasdsda', '23324324234', 'sadasddasdsa', '2023-11-01 11:06:48', 'activado', 0),
(41, 0, 'local nuevo', '12334124234', 'asdsasdad', '2023-11-01 11:08:48', 'activado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `idoperacion` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`idoperacion`, `idusuario`, `titulo`, `descripcion`, `fecha_hora`, `estado`, `eliminado`) VALUES
(1, 1, 'Transferencia', 'Se hace la transferencia que hará llegada al cliente.', '2023-09-18 17:11:49', 'activado', 0),
(2, 1, 'Préstamo', 'Se hace el préstamo que es de parte del cliente.', '2023-09-18 17:11:49', 'activado', 0),
(3, 1, 'Pago', 'Se hace el pago que es de parte del cliente.', '2023-09-18 17:11:49', 'activado', 0),
(13, 15, 'operacion jorge', 'asdadwd', '2023-11-01 11:33:20', 'activado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Acceso'),
(3, 'Perfil usuario'),
(4, 'Ticket'),
(5, 'Reporte Pagos'),
(6, 'Reporte Comisiones'),
(7, 'Conversaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `idticket` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idbanco` int(11) NOT NULL,
  `idoperacion` int(11) NOT NULL,
  `idlocal` int(11) NOT NULL,
  `num_ticket` varchar(15) NOT NULL,
  `num_ope` varchar(10) NOT NULL,
  `tipo_letra` varchar(30) NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `comision` decimal(11,2) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`idticket`, `idusuario`, `idbanco`, `idoperacion`, `idlocal`, `num_ticket`, `num_ope`, `tipo_letra`, `importe`, `comision`, `descripcion`, `fecha_hora`, `estado`) VALUES
(1, 1, 1, 1, 1, '1800583952', '0008454903', 'hypermarket', 78.60, 45.60, 'Titular: PEREZ CHAPULIN LUIS ALEXANDER\r\n\r\nFecha y hora: 16/06/2023 12:05\r\nNúmero de operación: 00052462\r\nCuenta de origen: Ahorro Soles 220-99851954-0-59\r\nNombre del beneficiario: MEDINA MARIA YANETH\r\nDocumento del beneficiario: DNI, 47012219\r\nMonto a pagar al beneficiario: S/ 100.00\r\nComisión orden de pago: S/ 5.00\r\nMonto total: S/ 105.00', '2023-09-25 12:18:39', 'activado'),
(2, 3, 11, 3, 2, '1800583953', '3433424232', 'hypermarket', 15400.00, 3400.00, 'Titular: PEREZ CHAPULIN LUIS ALEXANDER\r\n\r\nFecha y hora: 16/06/2023 12:05\r\nNúmero de operación: 00052462\r\nCuenta de origen: Ahorro Soles 220-99851954-0-59\r\nNombre del beneficiario: MEDINA MARIA YANETH\r\nDocumento del beneficiario: DNI, 47012219\r\nMonto a pagar al beneficiario: S/ 100.00\r\nComisión orden de pago: S/ 5.00\r\nMonto total: S/ 105.00', '2023-10-08 19:23:03', 'activado'),
(23, 1, 1, 1, 1, '000055453', '2424324', 'hypermarket', 234324.00, 3244.00, 'asdsad', '2023-10-15 15:52:44', 'activado'),
(24, 2, 1, 1, 1, '134', '123123', 'hypermarket', 24324.00, 234324.00, 'adasdd', '2023-10-15 15:56:17', 'activado'),
(25, 2, 1, 1, 1, '135', '1232313', 'courier', 146.00, 146.00, 'asdsdasad', '2023-10-25 22:52:33', 'activado'),
(26, 3, 2, 3, 4, '136', '123213', 'courier', 23213.00, 12213.00, 'asdsadsdsad', '2023-10-25 23:39:05', 'activado'),
(28, 1, 1, 2, 1, '137', '21343223', 'courier', 999999999.99, 999999999.99, 'asdasdasdasdasdasdasd kashsadgjkjkhs ahjkasd hjkasd jhkasd hjkasd jkhasd', '2023-11-01 11:19:17', 'activado'),
(29, 15, 14, 13, 9, '138', '1234232342', 'courier', 150.00, 180.00, 'qwdqddadawd', '2023-11-01 11:33:46', 'activado'),
(30, 15, 14, 13, 9, '139', '1231232132', 'courier', 999.00, 888.00, 'awdadawdasd', '2023-11-01 11:34:28', 'activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idlocal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idlocal`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`, `eliminado`) VALUES
(1, 1, 'Christopher PS', 'DNI', '32434234', 'Lima, la molina', '944853484', 'admin@admin.com', 'superadmin', 'admin', 'admin', '1694997199.jpg', 1, 0),
(2, 2, 'Luis Gomez', 'DNI', '12345678', 'Lima la molina', '944853484', 'admin2@admin.com', 'admin', 'admin2', 'admin2', '1694993074.jpg', 1, 0),
(3, 3, 'Rodrigo Campos', 'RUC', '55603297664', 'Lima la molina', '944853484', 'email1@email.com', 'vendedor_total', 'admin3', 'admin3', '1694993155.jpg', 1, 0),
(4, 30, 'Javier Poma', 'RUC', '68439948231', 'Lima la molina', '944853484', 'email2@email.com', 'vendedor_impresion', 'javier', 'javier', '1694993101.jpg', 1, 0),
(5, 6, 'Miguel Lopez', 'DNI', '23423423', 'Lima la molina', '123123123', 'asdasd@asdasd.com', 'vendedor_total', 'miguel', 'miguel', '1694993101.jpg', 1, 0),
(15, 9, 'jorgito', 'RUC', '12312321323', 'Lima', '973182294', 'cris_antonio2001@hotmail.com', 'vendedor_impresion', 'jorgito', 'jorgito', 'default.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(121, 6, 1),
(122, 6, 3),
(123, 6, 4),
(124, 6, 5),
(125, 6, 6),
(126, 7, 1),
(127, 7, 3),
(128, 7, 4),
(129, 7, 5),
(130, 7, 6),
(131, 8, 1),
(132, 8, 3),
(133, 8, 4),
(134, 8, 5),
(135, 8, 6),
(136, 9, 1),
(137, 9, 3),
(138, 9, 4),
(139, 9, 5),
(140, 9, 6),
(141, 10, 1),
(142, 10, 2),
(143, 10, 3),
(144, 10, 4),
(145, 10, 5),
(146, 10, 6),
(147, 11, 1),
(148, 11, 2),
(149, 11, 3),
(150, 11, 4),
(151, 11, 5),
(152, 11, 6),
(153, 12, 1),
(154, 12, 2),
(155, 12, 3),
(156, 12, 4),
(157, 12, 5),
(158, 12, 6),
(159, 13, 1),
(160, 13, 2),
(161, 13, 3),
(162, 13, 4),
(163, 13, 5),
(164, 13, 6),
(165, 14, 1),
(166, 14, 2),
(190, 5, 1),
(191, 5, 3),
(192, 5, 4),
(193, 5, 5),
(194, 5, 6),
(195, 5, 7),
(196, 4, 1),
(197, 4, 3),
(198, 4, 4),
(199, 4, 5),
(200, 4, 6),
(201, 4, 7),
(202, 3, 1),
(203, 3, 2),
(204, 3, 3),
(205, 3, 4),
(206, 3, 5),
(207, 3, 6),
(208, 3, 7),
(209, 2, 1),
(210, 2, 2),
(211, 2, 3),
(212, 2, 4),
(213, 2, 5),
(214, 2, 6),
(215, 2, 7),
(216, 1, 1),
(217, 1, 2),
(218, 1, 3),
(219, 1, 4),
(220, 1, 5),
(221, 1, 6),
(222, 1, 7),
(223, 15, 1),
(224, 15, 2),
(225, 15, 3),
(226, 15, 4),
(227, 15, 5),
(228, 15, 6),
(229, 15, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`idbanco`);

--
-- Indices de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD PRIMARY KEY (`idconversacion`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`idlocal`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`idoperacion`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idticket`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idbanco` (`idbanco`),
  ADD KEY `idoperacion` (`idoperacion`),
  ADD KEY `idlocal` (`idlocal`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idlocal` (`idlocal`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `idbanco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  MODIFY `idconversacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `idlocal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `idoperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
