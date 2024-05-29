-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 20:40:58
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escappebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `idActividad` int(10) NOT NULL,
  `nombreActividad` varchar(200) NOT NULL,
  `categoria` varchar(150) NOT NULL,
  `localizacion` varchar(100) DEFAULT NULL,
  `caracteristicas` varchar(255) DEFAULT NULL,
  `detalles` varchar(512) DEFAULT NULL,
  `fechasHora` varchar(200) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `tarifa` int(10) DEFAULT NULL,
  `materialNecesario` varchar(150) NOT NULL,
  `materialOfrecido` tinyint(1) DEFAULT NULL,
  `plusMaterial` int(10) DEFAULT NULL,
  `condicionFisica` tinyint(1) DEFAULT NULL,
  `transporte` tinyint(1) DEFAULT NULL,
  `maxPlazas` int(5) DEFAULT NULL,
  `minPlazas` int(5) DEFAULT NULL,
  `plazasOcupadas` varchar(15) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `imagen` varchar(100) DEFAULT NULL,
  `fechaPublicada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechActualizada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `idOfertante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `nombreActividad`, `categoria`, `localizacion`, `caracteristicas`, `detalles`, `fechasHora`, `duracion`, `tarifa`, `materialNecesario`, `materialOfrecido`, `plusMaterial`, `condicionFisica`, `transporte`, `maxPlazas`, `minPlazas`, `plazasOcupadas`, `disponible`, `imagen`, `fechaPublicada`, `fechActualizada`, `idOfertante`) VALUES
(1, 'Sevilla a Pie de Calle', 'Senderismo', 'Sevilla', 'Conoce las calles más emblemáticas del centro de Sevilla', 'Su casco antiguo es el más extenso de España y uno de los tres más grandes de toda Europa junto a los de Venecia y Génova, con 3,94 kilómetros cuadrados, y su casco histórico uno de los más grandes de España...', '2024-06-05T01:00,2024-06-21T06:00,', 2, 10, '', 0, NULL, 0, 0, 15, 5, '0', 1, 'actividad/farola.jpg', '2024-04-05 09:20:30', '2024-05-29 13:11:24', 2),
(2, 'Ronda con Bici', 'BTT', 'Ronda, Málaga', '10 km con bicicleta', 'Hacer Rutas en bici en Ronda es una de las mejores formas de descubrir esta región, aunque no siempre es fácil saber adónde ir. Para ponértelo fácil, hemos seleccionado las mejores Rutas en bicicleta en Ronda. Encuentra tu favorita y sal a explorar.', '2024-05-31T10:00,2024-07-07T10:00,', 3, 20, 'Bicicleta de Montaña', 1, 20, 1, 1, 15, 5, '3,0,', 1, 'actividad/rondabtt.jpg', '2024-04-05 09:37:20', '2024-05-29 14:24:35', 3),
(3, 'Itálica', 'Senderismo', 'Santiponce, Sevilla', 'Visita la ciudad romana de Itálica, próxima a las zonas de explotación minera de la Sierra Norte de Sevilla', 'Los orígenes del Conjunto Arqueológico de Itálica se remontan al año 206 a.C., cuando el general Publio Cornelio Escipión, en el contexto de la segunda Guerra Púnica, derrotó a los cartagineses en la Batalla de Ilipa y estableció un destacamento de legión', '2024-07-01T10:00,2024-07-01T11:00,', 2, 5, '', 0, 0, 0, 1, 10, 1, '0', 1, 'actividad/italica.jpg', '2024-05-28 13:48:37', NULL, 5),
(4, 'Visita el Corazón Verdiblanco', 'Fútbol', 'Sevilla', 'Realiza el Betis HiStory Tour', 'Disfrutarás de:\r\n- Los trofeos oficiales\r\n- Colección de piezas del archivo histórico del Club\r\n- Pantallas expositivas gran formato\r\n- Vídeo mapping\r\n- Sala Real Betis\r\n- Tótem fotográfico virtual\r\n- Espacios internacionales\r\n- Vestuario local\r\n- Túnel, baquillo y césped', '2024-06-01T20:00,', 2, 18, '', 1, 0, 0, 1, 22, 11, '2,', 1, 'actividad/tour.jpg', '2024-05-28 14:11:51', '2024-05-29 13:13:31', 2),
(5, 'Ronda en Parapente', 'Parapente', 'Ronda, Málaga', 'Visita Ronda desde el aire', 'Parapente sobre la localidad de Ronda (Málaga) un verdadero placer visual, situada en la Serrania de Ronda, cuyo elemento más característico sin duda es la imagen del Puente Nuevo que sortea el Tajo, impresionante hendidura del Rio Guadalevin.', '2024-07-06T10:00,2024-07-06T11:00,2024-07-06T12:00,', 3, 21, 'Como es lógico, un parapente', 1, 50, 0, 1, 2, 2, '0', 1, 'actividad/ronda.jpg', '2024-05-28 14:21:56', NULL, 3),
(6, 'Circuito Provincial de Sevilla de Carretera', 'Ciclismo', 'El Viso del Alcor', 'Hasta la localidad de Bormujos se desplazarán los participantes para disputar su segundo encuentro, la Carrera Ciclista Bormujos, organizada por el C.C. Caracol. ', 'La Puebla de Los Infantes se reencuentra con su mítica cita de ciclismo de carretera celebrando una nueva edición del Trofeo Máster y Veteranos Memorial Pelegrín del C.D. Peña Ciclista Lora del Río, tercera prueba del circuito.', '2024-06-01T11:00,', 2, 5, '', 0, NULL, 1, 0, 21, 3, '3', 1, 'actividad/ciclismo.jpg', '2024-05-29 08:48:11', '2024-05-29 08:53:13', 2),
(7, 'Torre del Oro', 'Cultura', 'Sevilla', 'Es una torre albarrana situada en el margen oriental del río Guadalquivir. Su origen es una construcción almohade del siglo XIII​.\r\n\r\nVisitas todos los fines de Semana | 10:00 - 13:00', 'Se sitúa en el Paseo de Colón en el casco histórico de la ciudad hispalense, en el barrio del Arenal, muy cercana a la plaza de toros de la Maestranza, la Torre de la Plata o las Atarazanas y en la orilla de enfrente se encuentra el Barrio de Triana.', '2024-06-06T10:00,2024-06-06T11:00,2024-06-06T12:00,', 1, 5, 'tu sonrisa', 0, NULL, 0, 1, 2, 1, '0', 1, 'actividad/torre-oro.jpg', '2024-05-29 09:02:14', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumidor`
--

CREATE TABLE `consumidor` (
  `idConsumidor` int(10) NOT NULL,
  `apenom` varchar(100) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `emailConsumidor` varchar(50) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `fechaRegistro` timestamp NULL DEFAULT current_timestamp(),
  `fechActualizado` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `consumidor`
--

INSERT INTO `consumidor` (`idConsumidor`, `apenom`, `telefono`, `emailConsumidor`, `password`, `fechaRegistro`, `fechActualizado`) VALUES
(1, 'mortadelo', '666444993', 'mortadelo@ibanez.es', 'user', '2024-04-05 09:40:30', '2024-05-28 23:15:20'),
(2, 'filemon', '665443322', 'filemon@ibanez.es', 'user', '2024-05-03 12:54:54', NULL),
(3, 'vicente', '619283782', 'vicente@super.es', 'user', '2024-05-28 23:18:28', NULL),
(4, 'bacterio', '628329011', 'bacterio@profesor.es', 'user', '2024-05-28 23:19:40', NULL),
(5, 'rompetechos', '643728321', 'rompetechos@ibanez.es', 'user', '2024-05-28 23:10:09', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demanda`
--

CREATE TABLE `demanda` (
  `idDemanda` int(10) NOT NULL,
  `nombreActividad` varchar(200) DEFAULT NULL,
  `categoria` varchar(150) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `materialNecesario` varchar(150) DEFAULT NULL,
  `fechaHora` varchar(100) DEFAULT NULL,
  `nroPlazas` int(15) NOT NULL,
  `duracion` int(11) DEFAULT NULL,
  `fechaRealizada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechActualizada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `idOfertante` int(10) DEFAULT NULL,
  `idConsumidor` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `demanda`
--

INSERT INTO `demanda` (`idDemanda`, `nombreActividad`, `categoria`, `descripcion`, `ubicacion`, `materialNecesario`, `fechaHora`, `nroPlazas`, `duracion`, `fechaRealizada`, `fechActualizada`, `idOfertante`, `idConsumidor`) VALUES
(1, 'VOLEYBALL', 'pelota', 'mucho', 'pista', NULL, '2024-06-10 15:00', 0, 0, '2024-04-14 11:13:45', '2024-05-20 12:12:04', NULL, 1),
(2, 'lalalaalalal', 'BTT', 'lalalalalal', 'alalallalala', 'allalaallaalla', '2024-06-01T14:34', 4, 2, '2024-05-29 12:35:34', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertante`
--

CREATE TABLE `ofertante` (
  `idOfertante` int(10) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `perfil` varchar(50) NOT NULL DEFAULT 'admin',
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `emailOfertante` varchar(200) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `enActivo` int(10) NOT NULL DEFAULT 1,
  `foto` varchar(255) NOT NULL DEFAULT 'nobody.jpg',
  `ubicacion` varchar(120) DEFAULT NULL,
  `fechaRegistro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertante`
--

INSERT INTO `ofertante` (`idOfertante`, `nombreUsuario`, `perfil`, `nombre`, `apellidos`, `telefono`, `emailOfertante`, `password`, `enActivo`, `foto`, `ubicacion`, `fechaRegistro`) VALUES
(1, 'developer', 'sadmin', 'Super', 'Admin', '661234561', 'super@admin.es', 'sadmin', 1, 'slopez.jpg', 'Sevilla', NULL),
(2, 'willyfog', 'admin', 'Willy', 'Fog', '611223344', 'willy@fog.es', 'admin', 1, 'willyfog.png', 'Sevilla', '2024-04-05 09:49:47'),
(3, 'rigodon', 'admin', 'Rigodón', 'Gato', '622334455', 'rigodon@80dias.son', 'admin', 1, 'rigodon.png', 'Málaga', '2024-04-05 10:34:28'),
(4, 'tico', 'admin', 'Tico', 'Hámster', '654543213', 'tico@80dias.son', 'admin', 1, 'tico.png', 'Grazalema, Cádiz', '2024-04-28 14:11:50'),
(5, 'romy', 'admin', 'Romy', 'Panther', '667776667', 'romy@fog.es', 'admin', 1, 'romy.png', 'Sevilla', '2024-05-28 14:42:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(10) NOT NULL,
  `fechaHora` varchar(100) NOT NULL,
  `nroPlazas` int(15) NOT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `fechaRealizada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechActualizada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `estado` int(10) DEFAULT 0,
  `canceladaPor` varchar(20) NOT NULL,
  `idActividad` int(10) NOT NULL,
  `idOfertante` int(10) DEFAULT NULL,
  `idConsumidor` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `fechaHora`, `nroPlazas`, `comentarios`, `fechaRealizada`, `fechActualizada`, `estado`, `canceladaPor`, `idActividad`, `idOfertante`, `idConsumidor`) VALUES
(1, '2024-04-20T20:21', 2, 'nada en particular', '2024-04-20 13:28:30', '2024-05-28 13:19:59', 0, '', 2, 3, 1),
(2, '2024-06-01T20:00', 2, '', '2024-05-29 12:28:06', '2024-05-29 12:29:10', 1, '', 4, 2, 1),
(3, '2024-05-31T10:00', 3, '', '2024-05-29 13:36:20', '2024-05-29 13:37:17', 1, '', 2, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idActividad`,`idOfertante`) USING BTREE,
  ADD KEY `idOfertante` (`idOfertante`);

--
-- Indices de la tabla `consumidor`
--
ALTER TABLE `consumidor`
  ADD PRIMARY KEY (`idConsumidor`);

--
-- Indices de la tabla `demanda`
--
ALTER TABLE `demanda`
  ADD PRIMARY KEY (`idDemanda`),
  ADD KEY `idOfertante` (`idOfertante`),
  ADD KEY `idConsumidor` (`idConsumidor`);

--
-- Indices de la tabla `ofertante`
--
ALTER TABLE `ofertante`
  ADD PRIMARY KEY (`idOfertante`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idActividad` (`idActividad`),
  ADD KEY `idOfertante` (`idOfertante`),
  ADD KEY `idConsumidor` (`idConsumidor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idActividad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `consumidor`
--
ALTER TABLE `consumidor`
  MODIFY `idConsumidor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `demanda`
--
ALTER TABLE `demanda`
  MODIFY `idDemanda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ofertante`
--
ALTER TABLE `ofertante`
  MODIFY `idOfertante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ofertante_fk` FOREIGN KEY (`idOfertante`) REFERENCES `ofertante` (`idOfertante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `demanda`
--
ALTER TABLE `demanda`
  ADD CONSTRAINT `demanda_consumidor_fk` FOREIGN KEY (`idConsumidor`) REFERENCES `consumidor` (`idConsumidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demanda_ofertante_fk` FOREIGN KEY (`idOfertante`) REFERENCES `ofertante` (`idOfertante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_actividad_fk` FOREIGN KEY (`idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_consumidor_fk` FOREIGN KEY (`idConsumidor`) REFERENCES `consumidor` (`idConsumidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ofertante_fk` FOREIGN KEY (`idOfertante`) REFERENCES `ofertante` (`idOfertante`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
