-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-11-2022 a las 10:59:59
-- Versión del servidor: 8.0.31-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Infojove`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamento`
--

CREATE TABLE `Departamento` (
  `ID_Departamento` int NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Departamento`
--

INSERT INTO `Departamento` (`ID_Departamento`, `Nombre`) VALUES
(1, 'Administración'),
(2, 'Automoción'),
(3, 'Electricidad'),
(4, 'Informática'),
(5, 'Sanitaria'),
(6, 'Dirección'),
(10, 'Secretaría'),
(11, 'LOSCOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estar`
--

CREATE TABLE `Estar` (
  `ID_Pantalla` int NOT NULL,
  `ID_Departamento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mostrar`
--

CREATE TABLE `Mostrar` (
  `ID_Pantalla` int NOT NULL,
  `ID_Publicacion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pantalla`
--

CREATE TABLE `Pantalla` (
  `ID_Pantalla` int NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Identificador` varchar(50) NOT NULL,
  `ID_Departamento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Pantalla`
--

INSERT INTO `Pantalla` (`ID_Pantalla`, `Nombre`, `Identificador`, `ID_Departamento`) VALUES
(17, 'PANTALLA1', '3e:12:3e:12:3e:13', 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Publicacion`
--

CREATE TABLE `Publicacion` (
  `ID_Publicacion` int NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `Descripcion` varchar(570) CHARACTER SET utf8mb4 NOT NULL,
  `Multimedia` blob,
  `Tipo_Publicacion` varchar(30) NOT NULL,
  `Estado` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `ID_Usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `ID_Rol` int NOT NULL,
  `Nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`ID_Rol`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Profesor'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tener`
--

CREATE TABLE `Tener` (
  `ID_Rol` int NOT NULL,
  `ID_Usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `ID_Usuario` int NOT NULL,
  `Nom_Usuario` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `Nombre_Completo` varchar(255) NOT NULL,
  `Pass_user` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `ID_Rol` int NOT NULL,
  `ID_Departamento` int NOT NULL,
  `Correo_Usuario` varchar(30) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`ID_Usuario`, `Nom_Usuario`, `Nombre_Completo`, `Pass_user`, `ID_Rol`, `ID_Departamento`, `Correo_Usuario`) VALUES
(28, 'Administrator', 'Sr. Admin', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1, 1, 'Correo_Usuario');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`ID_Departamento`);

--
-- Indices de la tabla `Estar`
--
ALTER TABLE `Estar`
  ADD PRIMARY KEY (`ID_Pantalla`,`ID_Departamento`),
  ADD KEY `ID_Pantalla` (`ID_Pantalla`),
  ADD KEY `FK_Pantalla_Departamento` (`ID_Departamento`);

--
-- Indices de la tabla `Mostrar`
--
ALTER TABLE `Mostrar`
  ADD PRIMARY KEY (`ID_Pantalla`,`ID_Publicacion`),
  ADD KEY `Mostrar_ibfk_2` (`ID_Publicacion`);

--
-- Indices de la tabla `Pantalla`
--
ALTER TABLE `Pantalla`
  ADD PRIMARY KEY (`ID_Pantalla`),
  ADD UNIQUE KEY `Identificador` (`Identificador`),
  ADD KEY `ID_Departamento` (`ID_Departamento`);

--
-- Indices de la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
  ADD PRIMARY KEY (`ID_Publicacion`),
  ADD KEY `Publicacion_ibfk_1` (`ID_Usuario`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `Tener`
--
ALTER TABLE `Tener`
  ADD PRIMARY KEY (`ID_Usuario`,`ID_Rol`),
  ADD KEY `Tener_ibfk_1` (`ID_Rol`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Nom_Usuario` (`Nom_Usuario`),
  ADD KEY `Usuario_ibfk_1` (`ID_Departamento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Departamento`
--
ALTER TABLE `Departamento`
  MODIFY `ID_Departamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Pantalla`
--
ALTER TABLE `Pantalla`
  MODIFY `ID_Pantalla` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
  MODIFY `ID_Publicacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `ID_Rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `ID_Usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Estar`
--
ALTER TABLE `Estar`
  ADD CONSTRAINT `FK_Departamento_Pantalla` FOREIGN KEY (`ID_Pantalla`) REFERENCES `Pantalla` (`ID_Pantalla`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pantalla_Departamento` FOREIGN KEY (`ID_Departamento`) REFERENCES `Departamento` (`ID_Departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Mostrar`
--
ALTER TABLE `Mostrar`
  ADD CONSTRAINT `Mostrar_ibfk_1` FOREIGN KEY (`ID_Pantalla`) REFERENCES `Pantalla` (`ID_Pantalla`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Mostrar_ibfk_2` FOREIGN KEY (`ID_Publicacion`) REFERENCES `Publicacion` (`ID_Publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Pantalla`
--
ALTER TABLE `Pantalla`
  ADD CONSTRAINT `Pantalla_ibfk_1` FOREIGN KEY (`ID_Departamento`) REFERENCES `Departamento` (`ID_Departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Publicacion`
--
ALTER TABLE `Publicacion`
  ADD CONSTRAINT `Publicacion_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Tener`
--
ALTER TABLE `Tener`
  ADD CONSTRAINT `Tener_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `Rol` (`ID_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Tener_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`ID_Departamento`) REFERENCES `Departamento` (`ID_Departamento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
