-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2011 at 01:47 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prode`
--

-- --------------------------------------------------------

--
-- Table structure for table `apuestas`
--

CREATE TABLE IF NOT EXISTS `apuestas` (
  `ap_id` int(11) NOT NULL AUTO_INCREMENT,
  `ap_par_id` int(2) NOT NULL,
  `ap_us_id` int(2) NOT NULL,
  `ap_ganador` varchar(11) NOT NULL,
  `ap_puntaje` int(2) DEFAULT '0',
  `ap_fecha_creacion` datetime NOT NULL,
  `ap_fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ap_id`),
  KEY `FK_PAR_ID` (`ap_par_id`),
  KEY `fk_us_id` (`ap_us_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `apuestas`
--

INSERT INTO `apuestas` (`ap_id`, `ap_par_id`, `ap_us_id`, `ap_ganador`, `ap_puntaje`, `ap_fecha_creacion`, `ap_fecha_actualizacion`) VALUES
(1, 1, 1, 'L', 1, '2010-12-30 21:24:00', NULL),
(2, 2, 1, 'L', 0, '2010-12-30 21:24:00', NULL),
(3, 3, 1, 'V', 0, '2010-12-30 21:24:00', NULL),
(4, 4, 1, 'E', 1, '2010-12-30 21:24:00', NULL),
(5, 5, 1, 'E', 0, '2010-12-30 21:24:00', NULL),
(65, 5, 2, 'V', 1, '0000-00-00 00:00:00', NULL),
(64, 4, 2, 'V', 1, '0000-00-00 00:00:00', NULL),
(63, 3, 2, 'V', 1, '0000-00-00 00:00:00', NULL),
(62, 2, 2, 'L', 1, '0000-00-00 00:00:00', NULL),
(61, 1, 2, 'L', 1, '0000-00-00 00:00:00', NULL),
(60, 10, 1, 'E', 1, '2010-12-31 08:20:34', NULL),
(59, 9, 1, 'V', 1, '2010-12-31 08:20:34', NULL),
(58, 8, 1, 'V', 1, '2010-12-31 08:20:34', NULL),
(57, 7, 1, 'E', 1, '2010-12-31 08:20:34', NULL),
(56, 6, 1, 'L', 1, '2010-12-31 08:20:34', NULL),
(66, 6, 2, 'L', 0, '2011-01-01 10:26:41', NULL),
(67, 7, 2, 'V', 0, '2011-01-01 10:26:41', NULL),
(68, 8, 2, 'V', 0, '2011-01-01 10:26:41', NULL),
(69, 9, 2, 'L', 0, '2011-01-01 10:26:41', NULL),
(70, 10, 2, 'L', 0, '2011-01-01 10:26:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `eq_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`eq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `equipos`
--

INSERT INTO `equipos` (`eq_id`, `eq_nombre`) VALUES
(1, 'River Plate'),
(2, 'Boca Juniors'),
(3, 'Estudiantes de La Plata'),
(4, 'Racing Club'),
(5, 'Independiente'),
(6, 'San Lorenzo'),
(7, 'Huracán'),
(8, 'Vélez'),
(9, 'Banfield'),
(10, 'Arsenal'),
(11, 'Gimnasia de La Plata'),
(12, 'Olimpo de Bahía Blanca'),
(13, 'All Boys'),
(14, 'Tigre'),
(15, 'Godoy Cruz'),
(16, 'Colón de Santa Fe'),
(17, 'Argentinos Juniors'),
(18, 'Lanús'),
(19, 'Quilmes A.C.'),
(20, 'Newell´s Old Boys');

-- --------------------------------------------------------

--
-- Table structure for table `fecha`
--

CREATE TABLE IF NOT EXISTS `fecha` (
  `fe_id` int(11) NOT NULL AUTO_INCREMENT,
  `fe_nombre` int(2) NOT NULL,
  `fe_to_id` int(11) NOT NULL,
  `fe_fecha_inicio` date NOT NULL,
  `fe_fecha_fin` date NOT NULL,
  `fe_estado` varchar(11) DEFAULT 'PENDIENTE',
  `fe_fecha_fin_apuesta` datetime NOT NULL,
  PRIMARY KEY (`fe_id`),
  KEY `FK_TO_ID` (`fe_to_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fecha`
--

INSERT INTO `fecha` (`fe_id`, `fe_nombre`, `fe_to_id`, `fe_fecha_inicio`, `fe_fecha_fin`, `fe_estado`, `fe_fecha_fin_apuesta`) VALUES
(1, 1, 1, '2011-01-01', '2011-01-03', 'FINALIZADA', '2011-01-01 18:00:00'),
(2, 2, 1, '2011-01-08', '2011-01-10', 'ACTIVA', '2011-08-01 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `partidos`
--

CREATE TABLE IF NOT EXISTS `partidos` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_local_eq_id` int(2) NOT NULL,
  `par_visitante_eq_id` int(2) NOT NULL,
  `par_local_goles` int(2) NOT NULL DEFAULT '0',
  `par_visitante_goles` int(2) NOT NULL DEFAULT '0',
  `par_fe_id` int(2) NOT NULL,
  `par_jugado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`par_id`),
  KEY `fk_fe_id` (`par_fe_id`),
  KEY `fk_local_id` (`par_local_eq_id`),
  KEY `fk_visitante_id` (`par_visitante_eq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `partidos`
--

INSERT INTO `partidos` (`par_id`, `par_local_eq_id`, `par_visitante_eq_id`, `par_local_goles`, `par_visitante_goles`, `par_fe_id`, `par_jugado`) VALUES
(1, 1, 2, 0, 0, 1, 0),
(2, 3, 4, 0, 0, 1, 0),
(3, 5, 6, 0, 0, 1, 0),
(4, 7, 8, 0, 0, 1, 0),
(5, 9, 10, 0, 0, 1, 0),
(6, 1, 6, 0, 0, 2, 0),
(7, 2, 7, 0, 0, 2, 0),
(8, 3, 8, 0, 0, 2, 0),
(9, 4, 9, 0, 0, 2, 0),
(10, 5, 10, 0, 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `torneo`
--

CREATE TABLE IF NOT EXISTS `torneo` (
  `to_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_nombre` varchar(45) NOT NULL,
  `to_fecha_inicio` date NOT NULL,
  `to_cantidad_fechas` int(2) NOT NULL,
  `to_estado` varchar(11) DEFAULT 'PROXIMO',
  PRIMARY KEY (`to_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `torneo`
--

INSERT INTO `torneo` (`to_id`, `to_nombre`, `to_fecha_inicio`, `to_cantidad_fechas`, `to_estado`) VALUES
(1, 'Preparacion', '2010-12-30', 3, 'ACTIVO'),
(2, 'Clausura 2011', '2010-02-08', 19, 'INACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_nombre` varchar(255) NOT NULL,
  `us_login` varchar(20) NOT NULL,
  `us_email` varchar(90) NOT NULL,
  `us_pass` varchar(10) NOT NULL,
  `us_fecha_alta` date NOT NULL,
  PRIMARY KEY (`us_id`),
  UNIQUE KEY `us_nombre_UNIQUE` (`us_nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`us_id`, `us_nombre`, `us_login`, `us_email`, `us_pass`, `us_fecha_alta`) VALUES
(1, 'Pablo Martelletti', 'pmartelletti', 'pmartelletti@gmail.com', '0220404', '2010-12-30'),
(2, 'Eduardo Coudet', 'chacho', 'pmartelletti@gmail.com', '0220404', '2010-12-30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
