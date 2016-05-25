-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2015 at 04:37 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bctesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tesis_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tesis_id`),
  KEY `fk_alumno_tesis1_idx` (`tesis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `facultad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `facultad_id`) VALUES
(1, 'Derecho', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carrera_alumno`
--

CREATE TABLE IF NOT EXISTS `carrera_alumno` (
  `alumno_id` int(11) NOT NULL,
  `carrera_id` int(11) NOT NULL,
  PRIMARY KEY (`alumno_id`,`carrera_id`),
  KEY `fk_autor_has_carrera_carrera1_idx` (`carrera_id`),
  KEY `fk_autor_has_carrera_autor1_idx` (`alumno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facultad`
--

CREATE TABLE IF NOT EXISTS `facultad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `facultad`
--

INSERT INTO `facultad` (`id`, `nombre`) VALUES
(1, 'Derecho y Cs. Políticas'),
(3, 'Arquitectura');

-- --------------------------------------------------------

--
-- Table structure for table `modalidad`
--

CREATE TABLE IF NOT EXISTS `modalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `modalidad`
--

INSERT INTO `modalidad` (`id`, `nombre`) VALUES
(2, 'Tesis'),
(3, 'Proyecto de Grado');

-- --------------------------------------------------------

--
-- Table structure for table `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `tesis_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tesis_id`,`usuario_id`),
  KEY `fk_registro_login1_idx` (`usuario_id`),
  KEY `fk_registro_tesis1_idx` (`tesis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tesis`
--

CREATE TABLE IF NOT EXISTS `tesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `anio` year(4) NOT NULL,
  `paginas` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `carrera_id` int(11) NOT NULL,
  `facultad_id` int(11) NOT NULL,
  `modalidad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`carrera_id`,`facultad_id`,`modalidad_id`),
  KEY `fk_tesis_modalidad1_idx` (`modalidad_id`),
  KEY `fk_tesis_carrera1_idx` (`carrera_id`),
  KEY `fk_tesis_facultad1_idx` (`facultad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tesis_docente`
--

CREATE TABLE IF NOT EXISTS `tesis_docente` (
  `tesis_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  PRIMARY KEY (`tesis_id`,`docente_id`),
  KEY `fk_tesis_docente_tesis1_idx` (`tesis_id`),
  KEY `fk_tesis_docente_docente1_idx` (`docente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `login`, `password`, `salt`) VALUES
(1, 'Danny', 'Almanza', 'danny', 'almanza', 'almanza');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_tesis1` FOREIGN KEY (`tesis_id`) REFERENCES `tesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carrera_alumno`
--
ALTER TABLE `carrera_alumno`
  ADD CONSTRAINT `fk_autor_has_carrera_autor1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_autor_has_carrera_carrera1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_login1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registro_tesis1` FOREIGN KEY (`tesis_id`) REFERENCES `tesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tesis`
--
ALTER TABLE `tesis`
  ADD CONSTRAINT `fk_tesis_carrera1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tesis_facultad1` FOREIGN KEY (`facultad_id`) REFERENCES `facultad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tesis_modalidad1` FOREIGN KEY (`modalidad_id`) REFERENCES `modalidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tesis_docente`
--
ALTER TABLE `tesis_docente`
  ADD CONSTRAINT `fk_tesis_docente_docente1` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tesis_docente_tesis1` FOREIGN KEY (`tesis_id`) REFERENCES `tesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
