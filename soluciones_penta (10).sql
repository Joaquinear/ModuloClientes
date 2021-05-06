-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2021 a las 08:23:05
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soluciones_penta`
--
CREATE DATABASE IF NOT EXISTS `soluciones_penta` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soluciones_penta`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Ver_Lotes_Disponibles` ()  SQL SECURITY INVOKER
SELECT lts.Id_Lotes,urb.Ciudad,urb.Nombre_Urbanizacion,lts.TamanhoMts2,lts.Precio,lts.Tipo_Moneda,
        case lts.Id_EstadoLote
        when  1 then 'Disponible'
        when  2	then 'Reservado'
        when  3 then 'vendido'
        END as estado
        from lotes lts inner join urbanizacion urb on lts.Id_Urbanizacion = urb.Id_Urbanizacion where lts.Id_EstadoLote = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Ver_Lotes_Disponibles1` ()  SQL SECURITY INVOKER
SELECT lts.Id_Lotes,urb.Ciudad,urb.Nombre_Urbanizacion,lts.TamanhoMts2,lts.Precio,lts.Tipo_Moneda,
        case lts.Id_EstadoLote
        when  1 then 'Disponible'
        when  2	then 'Reservado'
        when  3 then 'vendido'
        END as estado,concat(per2.Primer_Nombre,' ',per2.Apellido_Paterno) as trabajador,concat(per.Primer_Nombre,' ',per.Apellido_Paterno) as cliente
        from lotes lts inner join urbanizacion urb on lts.Id_Urbanizacion = urb.Id_Urbanizacion 
        INNER JOIN lote_vendido lvendido on lvendido.Id_Lotes = lts.Id_Lotes
        INNER JOIN cliente cli on cli.Id_Cliente = lvendido.Id_Cliente
        INNER JOIN persona per on per.Ci_Identidad = cli.Ci_Identidad
          INNER JOIN trabajador tra on tra.Id_Trabajador = lvendido.Id_Trabajador
          INNER JOIN persona per2 on per2.Ci_Identidad = tra.Ci_Identidad
        where lts.Id_EstadoLote in(2,3)
        group by lts.Id_Lotes$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  `Ci_Identidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Fecha_Registro`, `Comentario`, `Ci_Identidad`) VALUES
(5, '2021-02-19', 'Cliente potencial', 1823457),
(6, '0000-00-00', '', 0),
(7, '2021-02-20', 'Cliente potencial', 5813149),
(8, '2021-02-20', 'Cliente potencial', 581313),
(9, '2021-02-20', 'Cliente potencial', 111447),
(10, '2021-02-22', 'Cliente potencial', 1623547),
(11, '2021-02-22', 'Cliente potencial', 5813144);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `Id_Contrato` int(11) NOT NULL,
  `Id_Estado_Contrato` int(11) NOT NULL,
  `Id_Plan_Pago` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Fecha_Contrato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`Id_Contrato`, `Id_Estado_Contrato`, `Id_Plan_Pago`, `Id_Cliente`, `Fecha_Contrato`) VALUES
(11, 1, 13, 7, '2021-02-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE `cuota` (
  `Id_Cuota` int(11) NOT NULL,
  `Fecha_Cuota` date NOT NULL,
  `Id_Estadocuota` int(11) NOT NULL,
  `Monto_Cuota` double(10,2) NOT NULL,
  `Monto_Restante` double(10,2) NOT NULL,
  `Monto_Total_Pagar` double(10,2) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Id_Plan_Pago` int(11) NOT NULL,
  `Id_Trabajador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuota`
--

INSERT INTO `cuota` (`Id_Cuota`, `Fecha_Cuota`, `Id_Estadocuota`, `Monto_Cuota`, `Monto_Restante`, `Monto_Total_Pagar`, `Id_Cliente`, `Id_Plan_Pago`, `Id_Trabajador`) VALUES
(31, '2021-02-23', 1, 2000.00, 8000.00, 10000.00, 7, 13, 7),
(32, '2021-03-23', 1, 2000.00, 6000.00, 8000.00, 7, 13, 7),
(33, '2021-04-23', 1, 2000.00, 4000.00, 6000.00, 7, 13, 7),
(34, '2021-05-23', 1, 2000.00, 2000.00, 4000.00, 7, 13, 7),
(35, '2021-06-23', 1, 2000.00, 0.00, 2000.00, 7, 13, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocuota`
--

CREATE TABLE `estadocuota` (
  `Id_Estadocuota` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadocuota`
--

INSERT INTO `estadocuota` (`Id_Estadocuota`, `Nombre`) VALUES
(1, 'Vigente'),
(2, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadolote`
--

CREATE TABLE `estadolote` (
  `Id_EstadoLote` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadolote`
--

INSERT INTO `estadolote` (`Id_EstadoLote`, `Nombre`) VALUES
(1, 'Disponible'),
(2, 'Reservado'),
(3, 'Vendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoplandepago`
--

CREATE TABLE `estadoplandepago` (
  `Id_Estado_Plan_Pago` int(11) NOT NULL,
  `Nombre_estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoplandepago`
--

INSERT INTO `estadoplandepago` (`Id_Estado_Plan_Pago`, `Nombre_estado`) VALUES
(1, 'Activo '),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoreserva`
--

CREATE TABLE `estadoreserva` (
  `Id_EstadoReserva` int(11) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoreserva`
--

INSERT INTO `estadoreserva` (`Id_EstadoReserva`, `Nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_registro`
--

CREATE TABLE `log_registro` (
  `Id_Log_Registro` int(11) NOT NULL,
  `Id_trabajador` int(11) DEFAULT NULL,
  `Id_Lote` int(11) DEFAULT NULL,
  `Accion` varchar(30) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `log_registro`
--

INSERT INTO `log_registro` (`Id_Log_Registro`, `Id_trabajador`, `Id_Lote`, `Accion`, `Fecha`) VALUES
(1, 6, 14, 'Se inserto lote', '2021-02-21 01:25:20'),
(2, 6, 15, 'Se inserto lote', '2021-02-21 01:56:24'),
(3, 6, 16, 'Se inserto lote', '2021-02-22 00:06:18'),
(4, 7, 21, 'Se inserto lote', '2021-02-23 01:30:13'),
(5, 7, 22, 'Se inserto lote', '2021-02-23 01:31:37'),
(6, 7, 7, 'Se inserto lote', '2021-02-23 02:01:08'),
(7, 7, 8, 'Se inserto lote', '2021-02-23 02:22:29'),
(8, 7, 5, 'Se inserto lote', '2021-02-23 03:13:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `Id_Lotes` int(11) NOT NULL,
  `Id_EstadoLote` int(11) NOT NULL,
  `Latitud1` varchar(200) NOT NULL,
  `Latitud2` varchar(200) NOT NULL,
  `Latitud3` varchar(200) NOT NULL,
  `Latitud4` varchar(200) NOT NULL,
  `Longitud1` varchar(200) NOT NULL,
  `Longitud2` varchar(200) NOT NULL,
  `Longitud3` varchar(200) NOT NULL,
  `Longitud4` varchar(200) NOT NULL,
  `Numero_Lote` int(11) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `TamanhoMts2` double(10,2) NOT NULL,
  `Tipo_Moneda` varchar(20) NOT NULL,
  `Id_Urbanizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`Id_Lotes`, `Id_EstadoLote`, `Latitud1`, `Latitud2`, `Latitud3`, `Latitud4`, `Longitud1`, `Longitud2`, `Longitud3`, `Longitud4`, `Numero_Lote`, `Precio`, `TamanhoMts2`, `Tipo_Moneda`, `Id_Urbanizacion`) VALUES
(5, 2, '1111', '1111', '1111', '1111', '1111', '1111', '1111', '1111', 1, 10000.00, 300.00, 'dolares', 3),
(6, 3, '111111', '111111', '111111', '111111', '111111', '111111', '111111', '111111', 2, 10000.00, 300.00, 'Dolares', 3),
(7, 1, '111111', '111111', '111111', '111111', '111111', '111111', '-111111', '111111', 3, 15000.00, 300.00, 'dolares', 3),
(8, 1, '1111', '1111', '1111', '1111', '1111', '1111', '1111', '1111', 5, 15000.00, 300.00, 'Dolares', 3),
(9, 1, '1111', '1111', '1111', '1111', '1111', '1111', '1111', '1111', 6, 15000.00, 300.00, 'Dolares', 3),
(10, 1, '1111', '1111', '1111', '1111', '1111', '1111', '1111', '1111', 7, 15000.00, 300.00, 'Dolares', 3),
(12, 1, '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', 7, 10.00, 300.00, 'Dolares', 3),
(13, 1, '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', '1111111', 8, 15000.00, 300.00, 'Dolares', 3),
(14, 1, '-1111111111111111', '-1111111111111111', '-1111111111111111', '-1111111111111111', '-1111111111111111', '-1111111111111111', '-1111111111111111', '-1111111111111111', 9, 10000.00, 300.00, 'Dolares', 3),
(15, 1, '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', 15, 10000.00, 300.00, 'Dolares', 3),
(16, 1, '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', '11111111', 16, 15000.00, 300.00, 'dolares', 3),
(17, 1, '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', 6, 10000.00, 300.00, 'Dolares', 3),
(18, 1, '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', '111111111111111111111111111111', 18, 15000.00, 300.00, 'Dolares', 3),
(19, 1, '11111111111111111111111111', '11111111111111111111111111', '111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', 20, 15000.00, 350.00, 'Dolares', 3),
(20, 1, '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', '11111111111111111111111111', 21, 1000.00, 350.00, 'Dolares', 3),
(21, 1, '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', 22, 15000.00, 300.00, 'Dolares', 3),
(22, 1, '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', '1111111111', 23, 15000.00, 300.00, 'Dolares', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_vendido`
--

CREATE TABLE `lote_vendido` (
  `Id_Lote_Vendido` int(11) NOT NULL,
  `Fecha_Venta` date NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Id_Lotes` int(11) NOT NULL,
  `Id_Trabajador` int(11) NOT NULL,
  `Id_Estado_LoteVendido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lote_vendido`
--

INSERT INTO `lote_vendido` (`Id_Lote_Vendido`, `Fecha_Venta`, `Id_Cliente`, `Id_Lotes`, `Id_Trabajador`, `Id_Estado_LoteVendido`) VALUES
(15, '2021-02-23', 7, 6, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Ci_Identidad` int(11) NOT NULL,
  `Primer_Nombre` varchar(50) NOT NULL,
  `Segundo_Nombre` varchar(50) NOT NULL,
  `Apellido_Paterno` varchar(50) NOT NULL,
  `Apellido_Materno` varchar(50) NOT NULL,
  `Telefono_Celular` int(11) NOT NULL,
  `Telefono_Fijo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Ci_Identidad`, `Primer_Nombre`, `Segundo_Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Telefono_Celular`, `Telefono_Fijo`) VALUES
(0, '', '', '', '', 0, 0),
(111447, 'sangu', 'fernandez', 'Rodriguez', 'Ricalde', 1234566, 0),
(123447, 'Renzo', 'e', 'Alcon', 'Ruiz', 79400001, 0),
(581313, 'Eva', 'Maria', 'Espiniza', 'Bernal', 746001, 33499766),
(1623547, 'Adelma', '', 'Garay', 'Torrez', 7465550, 3499766),
(1823457, 'edgar', 'asd', 'asd', 'asd', 123123, 0),
(5813144, 'Joaquin', 'Mario', 'Cortez', 'Guardi', 74600202, 349644),
(5813148, 'Joaquin', 'Edgar', 'Alcon', 'Ruiz', 74600102, 0),
(5813149, 'Jose', 'Rolando', 'Alcon', 'Baltazar', 746123456, 0),
(18235476, 'Edgar', '', 'Alcon', 'Baltazar', 123456789, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_juridica`
--

CREATE TABLE `persona_juridica` (
  `Id_Persona_Juridica` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  `Ci_Identidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona_juridica`
--

INSERT INTO `persona_juridica` (`Id_Persona_Juridica`, `Fecha_Registro`, `Comentario`, `Ci_Identidad`) VALUES
(2, '2021-02-02', 'Represetante legal', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_de_pago`
--

CREATE TABLE `plan_de_pago` (
  `Id_Plan_Pago` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Gestion_Deuda` int(11) NOT NULL,
  `Monto_Total` double(10,2) NOT NULL,
  `Tipo_Moneda` varchar(20) NOT NULL,
  `Tipo_Plan_Pag` int(11) NOT NULL,
  `Id_Lote_Vendido` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Plazo` int(11) NOT NULL,
  `Id_Trabajador` int(11) NOT NULL,
  `Id_contrato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plan_de_pago`
--

INSERT INTO `plan_de_pago` (`Id_Plan_Pago`, `Fecha_Inicio`, `Fecha_Fin`, `Gestion_Deuda`, `Monto_Total`, `Tipo_Moneda`, `Tipo_Plan_Pag`, `Id_Lote_Vendido`, `Id_Cliente`, `Estado`, `Plazo`, `Id_Trabajador`, `Id_contrato`) VALUES
(13, '2021-02-23', '2021-07-22', 2021, 10000.00, 'Dolares', 2, 15, 7, 1, 5, 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `Id_Reserva` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Monto_Reserva` double(10,2) NOT NULL,
  `Tipo_Moneda` varchar(20) NOT NULL,
  `Id_Lotes` int(11) NOT NULL,
  `Id_Trabajador` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`Id_Reserva`, `Estado`, `Fecha_Inicio`, `Fecha_Fin`, `Monto_Reserva`, `Tipo_Moneda`, `Id_Lotes`, `Id_Trabajador`, `Id_Cliente`) VALUES
(20, 1, '2021-02-23', '2021-02-25', 100.00, 'Dolares', 5, 7, 7);

--
-- Disparadores `reserva`
--
DELIMITER $$
CREATE TRIGGER `LogRegistroReserva` AFTER INSERT ON `reserva` FOR EACH ROW BEGIN
    	INSERT INTO log_registro (Id_trabajador,Id_Lote,Accion,Fecha)
        VALUES (NEW.Id_trabajador,NEW.Id_Lotes,'Se inserto lote',NOW());
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_Role` int(11) NOT NULL,
  `Nombre_Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Role`, `Nombre_Role`) VALUES
(1, 'Cajero'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontrato`
--

CREATE TABLE `tipocontrato` (
  `Id_Estado_Contrato` int(11) NOT NULL,
  `Nombre_Estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocontrato`
--

INSERT INTO `tipocontrato` (`Id_Estado_Contrato`, `Nombre_Estado`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `Id_Tipo_Pago` int(11) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`Id_Tipo_Pago`, `Nombre`) VALUES
(1, 'Contado'),
(2, 'Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `Id_Trabajador` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Contraseha` varchar(100) NOT NULL,
  `Ci_Identidad` int(11) NOT NULL,
  `Id_Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`Id_Trabajador`, `Fecha_Inicio`, `Usuario`, `Contraseha`, `Ci_Identidad`, `Id_Role`) VALUES
(6, '2021-02-19', 'jalcon', '123', 5813148, 1),
(7, '2021-02-20', 'ealcon', '123', 18235476, 2),
(8, '2021-02-20', 're', '123', 123447, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urbanizacion`
--

CREATE TABLE `urbanizacion` (
  `Id_Urbanizacion` int(11) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `ExtensionMts2` double(10,2) NOT NULL,
  `Nombre_Urbanizacion` varchar(100) DEFAULT NULL,
  `Id_Persona_Juridica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `urbanizacion`
--

INSERT INTO `urbanizacion` (`Id_Urbanizacion`, `Ciudad`, `ExtensionMts2`, `Nombre_Urbanizacion`, `Id_Persona_Juridica`) VALUES
(3, 'Santa cruz de la sierra', 30000.00, 'SacaGuazu', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_Cliente`),
  ADD KEY `Ci_Identidad` (`Ci_Identidad`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`Id_Contrato`),
  ADD KEY `Id_Estado_Contrato` (`Id_Estado_Contrato`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Plan_Pago` (`Id_Plan_Pago`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`Id_Cuota`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Plan_Pago` (`Id_Plan_Pago`),
  ADD KEY `Id_Trabajador` (`Id_Trabajador`),
  ADD KEY `Id_Estadocuota` (`Id_Estadocuota`);

--
-- Indices de la tabla `estadocuota`
--
ALTER TABLE `estadocuota`
  ADD PRIMARY KEY (`Id_Estadocuota`);

--
-- Indices de la tabla `estadolote`
--
ALTER TABLE `estadolote`
  ADD PRIMARY KEY (`Id_EstadoLote`);

--
-- Indices de la tabla `estadoplandepago`
--
ALTER TABLE `estadoplandepago`
  ADD PRIMARY KEY (`Id_Estado_Plan_Pago`);

--
-- Indices de la tabla `estadoreserva`
--
ALTER TABLE `estadoreserva`
  ADD PRIMARY KEY (`Id_EstadoReserva`);

--
-- Indices de la tabla `log_registro`
--
ALTER TABLE `log_registro`
  ADD PRIMARY KEY (`Id_Log_Registro`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`Id_Lotes`),
  ADD KEY `Id_Urbanizacion` (`Id_Urbanizacion`),
  ADD KEY `Id_EstadoLote` (`Id_EstadoLote`);

--
-- Indices de la tabla `lote_vendido`
--
ALTER TABLE `lote_vendido`
  ADD PRIMARY KEY (`Id_Lote_Vendido`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Id_Lotes` (`Id_Lotes`),
  ADD KEY `Id_Estado_LoteVendido` (`Id_Estado_LoteVendido`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Ci_Identidad`);

--
-- Indices de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD PRIMARY KEY (`Id_Persona_Juridica`),
  ADD KEY `Ci_Identidad` (`Ci_Identidad`);

--
-- Indices de la tabla `plan_de_pago`
--
ALTER TABLE `plan_de_pago`
  ADD PRIMARY KEY (`Id_Plan_Pago`),
  ADD KEY `Id_Lote_Vendido` (`Id_Lote_Vendido`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Tipo_Plan_Pag` (`Tipo_Plan_Pag`),
  ADD KEY `Id_Trabajador` (`Id_Trabajador`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`Id_Reserva`),
  ADD KEY `Id_Lotes` (`Id_Lotes`),
  ADD KEY `Id_Trabajador` (`Id_Trabajador`),
  ADD KEY `Id_Cliente` (`Id_Cliente`),
  ADD KEY `Estado` (`Estado`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Role`);

--
-- Indices de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  ADD PRIMARY KEY (`Id_Estado_Contrato`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`Id_Tipo_Pago`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`Id_Trabajador`),
  ADD KEY `Ci_Identidad` (`Ci_Identidad`),
  ADD KEY `Id_Role` (`Id_Role`);

--
-- Indices de la tabla `urbanizacion`
--
ALTER TABLE `urbanizacion`
  ADD PRIMARY KEY (`Id_Urbanizacion`),
  ADD KEY `Id_Persona_Juridica` (`Id_Persona_Juridica`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `Id_Contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
  MODIFY `Id_Cuota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `estadocuota`
--
ALTER TABLE `estadocuota`
  MODIFY `Id_Estadocuota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadolote`
--
ALTER TABLE `estadolote`
  MODIFY `Id_EstadoLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadoplandepago`
--
ALTER TABLE `estadoplandepago`
  MODIFY `Id_Estado_Plan_Pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadoreserva`
--
ALTER TABLE `estadoreserva`
  MODIFY `Id_EstadoReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `log_registro`
--
ALTER TABLE `log_registro`
  MODIFY `Id_Log_Registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `Id_Lotes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `lote_vendido`
--
ALTER TABLE `lote_vendido`
  MODIFY `Id_Lote_Vendido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  MODIFY `Id_Persona_Juridica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `plan_de_pago`
--
ALTER TABLE `plan_de_pago`
  MODIFY `Id_Plan_Pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `Id_Reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  MODIFY `Id_Estado_Contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `Id_Tipo_Pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `Id_Trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `urbanizacion`
--
ALTER TABLE `urbanizacion`
  MODIFY `Id_Urbanizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Ci_Identidad`) REFERENCES `persona` (`Ci_Identidad`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`Id_Estado_Contrato`) REFERENCES `tipocontrato` (`Id_Estado_Contrato`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`Id_Plan_Pago`) REFERENCES `plan_de_pago` (`Id_Plan_Pago`);

--
-- Filtros para la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `cuota_ibfk_2` FOREIGN KEY (`Id_Plan_Pago`) REFERENCES `plan_de_pago` (`Id_Plan_Pago`),
  ADD CONSTRAINT `cuota_ibfk_3` FOREIGN KEY (`Id_Trabajador`) REFERENCES `trabajador` (`Id_Trabajador`),
  ADD CONSTRAINT `cuota_ibfk_4` FOREIGN KEY (`Id_Estadocuota`) REFERENCES `estadocuota` (`Id_Estadocuota`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`Id_Urbanizacion`) REFERENCES `urbanizacion` (`Id_Urbanizacion`),
  ADD CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`Id_EstadoLote`) REFERENCES `estadolote` (`Id_EstadoLote`);

--
-- Filtros para la tabla `lote_vendido`
--
ALTER TABLE `lote_vendido`
  ADD CONSTRAINT `lote_vendido_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `lote_vendido_ibfk_2` FOREIGN KEY (`Id_Lotes`) REFERENCES `lotes` (`Id_Lotes`),
  ADD CONSTRAINT `lote_vendido_ibfk_3` FOREIGN KEY (`Id_Estado_LoteVendido`) REFERENCES `estadolote` (`Id_EstadoLote`);

--
-- Filtros para la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD CONSTRAINT `persona_juridica_ibfk_1` FOREIGN KEY (`Ci_Identidad`) REFERENCES `persona` (`Ci_Identidad`);

--
-- Filtros para la tabla `plan_de_pago`
--
ALTER TABLE `plan_de_pago`
  ADD CONSTRAINT `plan_de_pago_ibfk_1` FOREIGN KEY (`Id_Lote_Vendido`) REFERENCES `lote_vendido` (`Id_Lote_Vendido`),
  ADD CONSTRAINT `plan_de_pago_ibfk_2` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `plan_de_pago_ibfk_3` FOREIGN KEY (`Tipo_Plan_Pag`) REFERENCES `tipo_pago` (`Id_Tipo_Pago`),
  ADD CONSTRAINT `plan_de_pago_ibfk_4` FOREIGN KEY (`Id_Trabajador`) REFERENCES `trabajador` (`Id_Trabajador`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`Id_Lotes`) REFERENCES `lotes` (`Id_Lotes`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`Id_Trabajador`) REFERENCES `trabajador` (`Id_Trabajador`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`Id_Trabajador`) REFERENCES `trabajador` (`Id_Trabajador`),
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `reserva_ibfk_5` FOREIGN KEY (`Estado`) REFERENCES `estadolote` (`Id_EstadoLote`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`Ci_Identidad`) REFERENCES `persona` (`Ci_Identidad`),
  ADD CONSTRAINT `trabajador_ibfk_2` FOREIGN KEY (`Id_Role`) REFERENCES `roles` (`Id_Role`),
  ADD CONSTRAINT `trabajador_ibfk_3` FOREIGN KEY (`Id_Role`) REFERENCES `roles` (`Id_Role`);

--
-- Filtros para la tabla `urbanizacion`
--
ALTER TABLE `urbanizacion`
  ADD CONSTRAINT `urbanizacion_ibfk_1` FOREIGN KEY (`Id_Persona_Juridica`) REFERENCES `persona_juridica` (`Id_Persona_Juridica`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
