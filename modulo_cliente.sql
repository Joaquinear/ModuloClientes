-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 05:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modulo_cliente`
--
CREATE DATABASE IF NOT EXISTS `modulo_cliente` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `modulo_cliente`;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--
-- Creation: Jun 25, 2021 at 03:57 AM
--

CREATE TABLE `cliente` (
  `Cliente_id` int(11) NOT NULL,
  `Fecha_Registro` date DEFAULT NULL,
  `Observacion` varchar(100) NOT NULL,
  `Ci_Persona` int(11) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `cliente`:
--   `Ci_Persona`
--       `persona` -> `Ci`
--

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`Cliente_id`, `Fecha_Registro`, `Observacion`, `Ci_Persona`, `Estado`) VALUES
(1, '2021-06-24', 'Cliente nuevo', 1826458, 1),
(2, '2021-06-24', 'Cliente nuevo', 5813149, 1),
(3, '2021-06-25', 'Cliente prueba', 581313, 1);

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--
-- Creation: Jun 25, 2021 at 03:35 AM
--

CREATE TABLE `empleado` (
  `Empleado_Id` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Contrasenha` varchar(30) NOT NULL,
  `Ci_Persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `empleado`:
--   `Ci_Persona`
--       `persona` -> `Ci`
--

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`Empleado_Id`, `Fecha_Registro`, `Descripcion`, `Usuario`, `Contrasenha`, `Ci_Persona`) VALUES
(1, '2021-06-24', 'Administrador', 'Jalcon', '123456789', 5813148);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--
-- Creation: Jun 25, 2021 at 04:03 AM
--

CREATE TABLE `persona` (
  `Ci` int(11) NOT NULL,
  `Nombres` varchar(70) NOT NULL,
  `Apellido_Paterno` varchar(40) NOT NULL,
  `Apellido_Materno` varchar(40) NOT NULL,
  `edad` int(11) NOT NULL,
  `Nacionalidad` varchar(50) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `Correo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `persona`:
--

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`Ci`, `Nombres`, `Apellido_Paterno`, `Apellido_Materno`, `edad`, `Nacionalidad`, `telefono`, `Correo`) VALUES
(581313, 'alber', 'laura', 'villagomez', 20, 'española', 123, 'alber@alber.com'),
(1826458, 'Edgar ', 'Alcon ', 'Baltazar', 55, 'Boliviano', 74621254, 'Ealcon@no'),
(5813144, 'Rolando', 'Alcon ', 'Aparicio', 746001225, '31', 0, 'roli@yacuiba.com'),
(5813148, 'Joaquin Edgar', 'Alcon', 'Ruiz', 26, 'Boliviano', 74600101, 'Joaquinear21@gmail.com'),
(5813149, 'Eva Maria', 'Espinoza', 'Bernal', 20, 'Argentina', 79400011, 'Evmaria@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Cliente_id`),
  ADD KEY `Ci_Persona` (`Ci_Persona`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Empleado_Id`),
  ADD KEY `Ci_Persona` (`Ci_Persona`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Ci`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `Empleado_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Ci_Persona`) REFERENCES `persona` (`Ci`);

--
-- Constraints for table `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`Ci_Persona`) REFERENCES `persona` (`Ci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
