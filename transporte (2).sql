-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2018 a las 19:52:09
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transporte`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_cargues` (IN `variable_where` VARCHAR(100), IN `offset_where` INT, IN `per_page_where` INT)  begin
DECLARE id_factura_cargue varchar(100);
DECLARE cedula_conductor varchar(100);
DECLARE nombre_conductor varchar(100);
DECLARE apellido_conductor varchar(100);
DECLARE placa_vehiculo varchar(100);
DECLARE estado_cargue varchar(100);
DECLARE fecha_hora_cargue varchar(100);


DECLARE cursor_query cursor for 
SELECT car.id_factura_cargue, con.cedula_conductor, con.nombre_conductor, con.apellido_conductor, vehi.placa_vehiculo, est_car.estado_cargue, est_car.fecha_hora_cargue  
FROM cargues car 
join conductores_vehiculos con_vehi 
join vehiculos vehi 
join conductores con 
join estados_cargues est_car 
ON car.id_factura_cargue = est_car.id_factura_cargue 
AND con_vehi.id_conductor_vehiculo = car.id_conductor_vehiculo
AND vehi.placa_vehiculo = con_vehi.placa_vehiculo
AND con.cedula_conductor = con_vehi.cedula_conductor
WHERE car.id_factura_cargue LIKE '%variable_where%'
OR con.cedula_conductor LIKE '%variable_where%' 
OR concat(con.nombre_conductor, ' ', con.apellido_conductor) LIKE '%variable_where%'
OR vehi.placa_vehiculo LIKE '%variable_where%';

DECLARE CONTINUE HANDLER FOR NOT FOUND SET @fin = TRUE;
open cursor_query;
loop1:loop
fetch cursor_query into id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargue, fecha_hora_cargue;
IF @fin THEN
LEAVE loop1;
select id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargues, fecha_hora_cargue;
END IF;
end loop loop1;
close cursor_query;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_count_rows_cargues` (`variable_where` VARCHAR(100), `offset_where` INT, `per_page_where` INT)  begin
DECLARE id_factura_cargue varchar(100);
DECLARE cedula_conductor varchar(100);
DECLARE nombre_conductor varchar(100);
DECLARE apellido_conductor varchar(100);
DECLARE placa_vehiculo varchar(100);
DECLARE estado_cargues varchar(100);
DECLARE fecha_hora_cargue varchar(100);


DECLARE cursor_query cursor for 
SELECT COUNT(car.id_factura_cargue)
FROM cargues car 
join conductores_vehiculos con_vehi 
join vehiculos vehi 
join conductores con 
join estados_cargues est_car 
ON car.id_factura_cargue = est_car.id_factura_cargue 
AND con_vehi.id_conductor_vehiculo = car.id_conductor_vehiculo
AND vehi.placa_vehiculo = con_vehi.placa_vehiculo
AND con.cedula_conductor = con_vehi.cedula_conductor
WHERE car.id_factura_cargue LIKE '%variable_where%'
OR con.cedula_conductor LIKE '%variable_where%' 
OR concat(con.nombre_conductor, ' ', con.apellido_conductor) LIKE '%variable_where%'
OR vehi.placa_vehiculo LIKE '%variable_where%'
LIMIT offset_where, per_page_where;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET @fin = TRUE;
open cursor_query;
loop1:loop
fetch cursor_query into id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargues, fecha_hora_cargue;
IF @fin THEN
LEAVE loop1;
END IF;
select id_factura_cargue, cedula_conductor, nombre_conductor, apellido_conductor, placa_vehiculo, estado_cargues, fecha_hora_cargue;
end loop loop1;
close cursor_query;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_cargue_estado` (IN `id_factura_variable` VARCHAR(100), IN `id_conductor_vehiculo_variable` VARCHAR(100), IN `id_usuario_variable` VARCHAR(100))  BEGIN

START TRANSACTION;
  INSERT INTO 
cargues(id_factura_cargue, id_conductor_vehiculo, id_usuario_usuarios, fecha_hora_cargue) 
VALUES 
(id_factura_variable,id_conductor_vehiculo_variable,id_usuario_variable,now());

INSERT INTO 
estados_cargues(id_factura_cargue, estado_cargue, fecha_hora_cargue)
VALUES
(id_factura_variable, 'Registrado',id_usuario_variable, now());

COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calidad_inocuidad`
--

CREATE TABLE `calidad_inocuidad` (
  `consecutivo_cargue` int(11) NOT NULL,
  `aspecto_verificado_calidad_inocuidad` varchar(250) DEFAULT NULL,
  `estado_calidad_inocuidad` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calidad_inocuidad_puntos_susceptibles`
--

CREATE TABLE `calidad_inocuidad_puntos_susceptibles` (
  `consecutivo_cargue` int(11) NOT NULL,
  `aspecto_verificado` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargues`
--

CREATE TABLE `cargues` (
  `consecutivo_cargue` int(11) NOT NULL,
  `id_conductor_vehiculo` int(11) DEFAULT NULL,
  `id_usuario_usuarios` int(11) DEFAULT NULL,
  `fecha_hora_cargue` datetime DEFAULT NULL,
  `destino` varchar(230) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargues`
--

INSERT INTO `cargues` (`consecutivo_cargue`, `id_conductor_vehiculo`, `id_usuario_usuarios`, `fecha_hora_cargue`, `destino`) VALUES
(1, 1093777048, 0, '2018-02-02 08:23:07', 'CUCUTA-BUGARAMANGA-BOGOTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `cedula_conductor` bigint(12) NOT NULL,
  `id_razon_social` int(11) NOT NULL,
  `nombre_conductor` varchar(100) DEFAULT NULL,
  `apellido_conductor` varchar(100) DEFAULT NULL,
  `licencia_conductor` varchar(100) DEFAULT NULL,
  `fecha_ingreso_conductor` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`cedula_conductor`, `id_razon_social`, `nombre_conductor`, `apellido_conductor`, `licencia_conductor`, `fecha_ingreso_conductor`) VALUES
(60441117, 1, 'PEDRO ', 'BENITEZ', NULL, '2018-02-01'),
(1093777048, 1, 'SAMUEL ', 'SANCHEZ CASTILLO ', NULL, '2018-02-01'),
(1093793042, 1, 'JEFFERSON ALEJANDRO', 'IBARRA', NULL, '2018-02-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores_vehiculos`
--

CREATE TABLE `conductores_vehiculos` (
  `id_conductor_vehiculo` int(11) NOT NULL,
  `cedula_conductor` bigint(12) DEFAULT NULL,
  `placa_vehiculo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `declaracion_conductor`
--

CREATE TABLE `declaracion_conductor` (
  `consecutivo_cargue` int(11) NOT NULL,
  `id_conductor_vehiculo` varchar(20) DEFAULT NULL,
  `imagen_firma_declaracion_conductor` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `cedula_conductor_documento` bigint(12) DEFAULT NULL,
  `runt_documento` varchar(200) DEFAULT NULL,
  `procuraduria_documento` varchar(200) DEFAULT NULL,
  `contraloria_documento` varchar(200) DEFAULT NULL,
  `simit_documento` varchar(200) DEFAULT NULL,
  `fecha_hora_documento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_cargues`
--

CREATE TABLE `estados_cargues` (
  `consecutivo_cargue` int(11) DEFAULT NULL,
  `fecha_hora_cargue` datetime DEFAULT NULL,
  `estado_cargue` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_cargues`
--

INSERT INTO `estados_cargues` (`consecutivo_cargue`, `fecha_hora_cargue`, `estado_cargue`) VALUES
(1, '2018-02-02 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencias_fotograficas`
--

CREATE TABLE `evidencias_fotograficas` (
  `consecutivo_cargue` int(11) NOT NULL,
  `tiempo_evidencia_fotografica` varchar(250) DEFAULT NULL,
  `imagen_evidencia_fotografica` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_despacho`
--

CREATE TABLE `factura_despacho` (
  `consecutivo_cargue` int(11) NOT NULL,
  `id_factura_despacho` varchar(100) NOT NULL,
  `url_documento` varchar(240) DEFAULT NULL,
  `tipo_documento` varchar(240) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_despacho`
--

INSERT INTO `factura_despacho` (`consecutivo_cargue`, `id_factura_despacho`, `url_documento`, `tipo_documento`) VALUES
(1, '152556', 'https://coagrotrasnporte.com.co', 'Despacho'),
(1, '152557', 'https://coagrotrasnporte.com.co1', 'Despacho'),
(1, '152558', 'https://coagrotrasnporte.com.co2', 'Factura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_social`
--

CREATE TABLE `razon_social` (
  `id_razon_social` int(11) NOT NULL,
  `nombre_razon_social` varchar(255) NOT NULL,
  `correo_razon_social` varchar(150) NOT NULL DEFAULT 'No Aplica',
  `telefono_razon_social` varchar(40) NOT NULL DEFAULT 'No Aplica'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `razon_social`
--

INSERT INTO `razon_social` (`id_razon_social`, `nombre_razon_social`, `correo_razon_social`, `telefono_razon_social`) VALUES
(1, 'COAGRONORTE', 'Transporte@coagronorte.com.co', '3133942938'),
(2, 'ORTIZ CLARO ELFIDO', 'NO APLICA', '3165772532'),
(3, 'YAMIL ANTONIO GALEANO', 'YAMILGALEANO@HOTMAIL.COM', '3204604244'),
(5, 'LUIS EDUARDO GIL', 'LLANTASLOSANDES10@HOTMAIL.COM', '3153676697'),
(6, 'ELIBARDO MENDEZ QUINTERO', 'ELIBARDOMQ@LIVE.COM\r\n', '3168776848'),
(7, 'EDGAR URIBE LIZCANO', 'NO APLICA', '3116531993'),
(9, 'GUSTAVO ROZO PORTILLA', 'ANAYIBE222@HOTMAIL.COM', '3106808878'),
(10, 'ISMAEL NAVARRO PICON', 'NO APLICA', '3212086775'),
(11, 'ORTIZ ASCANIO LUDDY CECILIA', 'NO APLICA', '3155902300'),
(12, 'PEÃ‘ARANDA ORDOÃ‘EZ HUMBERTO', 'NO APLICA', '3102414396'),
(13, 'JOAQUIN ALONSO CARVAJAL RAMIREZ', 'NO APLICA', '3133128185'),
(14, 'ELISAIN PEÃ‘A PABON ', 'NO APLICA', '3114427861'),
(15, 'MARIELA REYES', 'NO APLICA', '3108183489');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(64) NOT NULL,
  `contrasena_usuario` varchar(255) NOT NULL,
  `tipo_usuario` enum('Administrador','Usuario') NOT NULL,
  `fecha_creacion_usuario` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena_usuario`, `tipo_usuario`, `fecha_creacion_usuario`) VALUES
(0, 'admin', '$2y$10$72z7qjLyMKsBJsb2CzcKruOY1orvnpPSvSCOZwsFzLaEKPyjL5w6C', 'Administrador', '2018-02-01 14:29:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `placa_vehiculo` varchar(20) NOT NULL,
  `placa_remolque` varchar(20) NOT NULL,
  `cantidad_vehiculo` varchar(50) NOT NULL,
  `soat_vehiculo` date DEFAULT NULL,
  `tecnicomecanico_vehiculo` date DEFAULT NULL,
  `observaciones_vehiculo` text,
  `fecha_creacion_vehiculo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`placa_vehiculo`, `placa_remolque`, `cantidad_vehiculo`, `soat_vehiculo`, `tecnicomecanico_vehiculo`, `observaciones_vehiculo`, `fecha_creacion_vehiculo`) VALUES
('AOF-09E', 'AOF-09E', '3000', '2018-02-01', '2018-02-01', '', '2018-02-01 11:42:54'),
('BAF-09', 'N/A', '3500', '2018-02-01', '2018-02-01', 'EXCELENTE', '2018-02-01 14:56:47'),
('JIB-90C', 'N/A', '500000', '2018-02-01', '2018-02-01', 'MALO', '2018-02-01 16:06:09'),
('XQJ-62', 'XQJ-62', '1000', '2018-02-01', '2018-02-01', 'BUEN ESTADO ', '2018-02-01 14:37:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calidad_inocuidad`
--
ALTER TABLE `calidad_inocuidad`
  ADD KEY `consecutivo_cargue` (`consecutivo_cargue`);

--
-- Indices de la tabla `calidad_inocuidad_puntos_susceptibles`
--
ALTER TABLE `calidad_inocuidad_puntos_susceptibles`
  ADD KEY `consecutivo_cargue` (`consecutivo_cargue`);

--
-- Indices de la tabla `cargues`
--
ALTER TABLE `cargues`
  ADD PRIMARY KEY (`consecutivo_cargue`),
  ADD KEY `id_conductor_vehiculo_pk` (`id_conductor_vehiculo`),
  ADD KEY `id_usuario_usuarios_pk` (`id_usuario_usuarios`);

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`cedula_conductor`),
  ADD KEY `fk_id_razon_social` (`id_razon_social`);

--
-- Indices de la tabla `conductores_vehiculos`
--
ALTER TABLE `conductores_vehiculos`
  ADD PRIMARY KEY (`id_conductor_vehiculo`),
  ADD KEY `cedula_conductor_fk_c` (`cedula_conductor`),
  ADD KEY `placa_vehiculo_fk_p` (`placa_vehiculo`);

--
-- Indices de la tabla `declaracion_conductor`
--
ALTER TABLE `declaracion_conductor`
  ADD KEY `consecutivo_cargue` (`consecutivo_cargue`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD KEY `cedula_conductor_doc_pk` (`cedula_conductor_documento`);

--
-- Indices de la tabla `estados_cargues`
--
ALTER TABLE `estados_cargues`
  ADD KEY `consecutivo_cargue_fk_estado` (`consecutivo_cargue`);

--
-- Indices de la tabla `evidencias_fotograficas`
--
ALTER TABLE `evidencias_fotograficas`
  ADD KEY `consecutivo_cargue` (`consecutivo_cargue`);

--
-- Indices de la tabla `factura_despacho`
--
ALTER TABLE `factura_despacho`
  ADD PRIMARY KEY (`id_factura_despacho`),
  ADD KEY `consecutivo_cargue_fk` (`consecutivo_cargue`);

--
-- Indices de la tabla `razon_social`
--
ALTER TABLE `razon_social`
  ADD PRIMARY KEY (`id_razon_social`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`placa_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargues`
--
ALTER TABLE `cargues`
  MODIFY `consecutivo_cargue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `conductores_vehiculos`
--
ALTER TABLE `conductores_vehiculos`
  MODIFY `id_conductor_vehiculo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `razon_social`
--
ALTER TABLE `razon_social`
  MODIFY `id_razon_social` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calidad_inocuidad`
--
ALTER TABLE `calidad_inocuidad`
  ADD CONSTRAINT `calidad_inocuidad_ibfk_1` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);

--
-- Filtros para la tabla `calidad_inocuidad_puntos_susceptibles`
--
ALTER TABLE `calidad_inocuidad_puntos_susceptibles`
  ADD CONSTRAINT `calidad_inocuidad_puntos_susceptibles_ibfk_1` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);

--
-- Filtros para la tabla `cargues`
--
ALTER TABLE `cargues`
  ADD CONSTRAINT `id_usuario_usuarios_pk` FOREIGN KEY (`id_usuario_usuarios`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `conductores_vehiculos`
--
ALTER TABLE `conductores_vehiculos`
  ADD CONSTRAINT `cedula_conductor_fk_c` FOREIGN KEY (`cedula_conductor`) REFERENCES `conductores` (`cedula_conductor`),
  ADD CONSTRAINT `placa_vehiculo_fk_p` FOREIGN KEY (`placa_vehiculo`) REFERENCES `vehiculos` (`placa_vehiculo`);

--
-- Filtros para la tabla `declaracion_conductor`
--
ALTER TABLE `declaracion_conductor`
  ADD CONSTRAINT `declaracion_conductor_ibfk_1` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `cedula_conductor_doc_pk` FOREIGN KEY (`cedula_conductor_documento`) REFERENCES `conductores` (`cedula_conductor`);

--
-- Filtros para la tabla `estados_cargues`
--
ALTER TABLE `estados_cargues`
  ADD CONSTRAINT `consecutivo_cargue_fk_estado` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);

--
-- Filtros para la tabla `evidencias_fotograficas`
--
ALTER TABLE `evidencias_fotograficas`
  ADD CONSTRAINT `evidencias_fotograficas_ibfk_1` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);

--
-- Filtros para la tabla `factura_despacho`
--
ALTER TABLE `factura_despacho`
  ADD CONSTRAINT `consecutivo_cargue_fk` FOREIGN KEY (`consecutivo_cargue`) REFERENCES `cargues` (`consecutivo_cargue`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
