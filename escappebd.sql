-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2024 a las 15:32:25
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
  `plazasOcupadas` varchar(15) DEFAULT NULL,
  `maxPlazas` int(5) DEFAULT NULL,
  `minPlazas` int(5) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `tarifa` int(10) DEFAULT NULL,
  `materialNecesario` varchar(150) NOT NULL,
  `materialOfrecido` tinyint(1) DEFAULT NULL,
  `plusMaterial` int(10) DEFAULT NULL,
  `condicionFisica` tinyint(1) DEFAULT NULL,
  `transporte` tinyint(1) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `imagen` varchar(100) DEFAULT NULL,
  `fechaPublicada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechActualizada` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `idOfertante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `nombreActividad`, `categoria`, `localizacion`, `caracteristicas`, `detalles`, `fechasHora`, `plazasOcupadas`, `maxPlazas`, `minPlazas`, `duracion`, `tarifa`, `materialNecesario`, `materialOfrecido`, `plusMaterial`, `condicionFisica`, `transporte`, `disponible`, `imagen`, `fechaPublicada`, `fechActualizada`, `idOfertante`) VALUES
(1, 'Sevilla a Pie de Calle', 'Cultural', 'Sevilla', 'Conoce las calles más emblemáticas del centro de Sevilla', 'Su casco antiguo es el más extenso de España y uno de los tres más grandes de toda Europa junto a los de Venecia y Génova, con 3,94 kilómetros cuadrados, y su casco histórico uno de los más grandes de España...', '2024-06-08T10:00,2024-06-21T15:54,2024-06-15T19:13,', '0,2,0,', 15, 5, 2, 10, '', 0, NULL, 0, 0, 1, 'farola.jpg', '2024-04-05 09:20:30', '2024-06-02 10:23:26', 2),
(2, 'Ronda con Bici', 'BTT', 'Ronda, Málaga', '10 km con bicicleta', 'Hacer Rutas en bici en Ronda es una de las mejores formas de descubrir esta región, aunque no siempre es fácil saber adónde ir. Para ponértelo fácil, hemos seleccionado las mejores Rutas en bicicleta en Ronda. Encuentra tu favorita y sal a explorar.', '2024-05-31T10:00,2024-07-07T10:00,', '3,0,', 15, 5, 3, 20, 'Bicicleta de Montaña', 1, 20, 1, 1, 1, 'rondabtt.jpg', '2024-04-05 09:37:20', '2024-06-02 10:23:33', 3),
(3, 'Itálica', 'Cultural', 'Santiponce, Sevilla', 'Visita la ciudad romana de Itálica, próxima a las zonas de explotación minera de la Sierra Norte de Sevilla', 'Los orígenes del Conjunto Arqueológico de Itálica se remontan al año 206 a.C., cuando el general Publio Cornelio Escipión, en el contexto de la segunda Guerra Púnica, derrotó a los cartagineses en la Batalla de Ilipa y estableció un destacamento de legión', '2024-07-01T10:00,2024-07-01T11:00,', '0,0,', 10, 1, 2, 5, '', 0, 0, 0, 1, 1, 'italica.jpg', '2024-05-28 13:48:37', '2024-06-02 10:23:39', 5),
(4, 'Visita el Corazón Verdiblanco', 'Cultural', 'Sevilla', 'Realiza el Betis HiStory Tour', 'Disfrutarás de:\n- Los trofeos oficiales\n- Colección de piezas del archivo histórico del Club\n- Pantallas expositivas gran formato\n- Vídeo mapping\n- Sala Real Betis\n- Tótem fotográfico virtual\n- Espacios internacionales\n- Vestuario local\n- Túnel, banquillo y césped', '2024-06-01T20:00,', '2,', 22, 11, 2, 18, '', 1, 0, 0, 1, 1, 'tour.jpg', '2024-05-28 14:11:51', '2024-06-02 10:23:46', 2),
(5, 'Ronda en Parapente', 'Aventura', 'Ronda, Málaga', 'Visita Ronda desde el aire', 'Parapente sobre la localidad de Ronda (Málaga) un verdadero placer visual, situada en la Serrania de Ronda, cuyo elemento más característico sin duda es la imagen del Puente Nuevo que sortea el Tajo, impresionante hendidura del Rio Guadalevin.', '2024-07-06T10:00,2024-07-06T11:00,2024-07-06T12:00,', '0,0,0,', 2, 2, 3, 21, 'Como es lógico, un parapente', 1, 50, 0, 1, 1, 'ronda.jpg', '2024-05-28 14:21:56', '2024-06-02 10:23:51', 3),
(6, 'Circuito Provincial de Sevilla de Carretera', 'Ciclismo', 'El Viso del Alcor', 'Hasta la localidad de Bormujos se desplazarán los participantes para disputar su segundo encuentro, la Carrera Ciclista Bormujos, organizada por el C.C. Caracol. ', 'La Puebla de Los Infantes se reencuentra con su mítica cita de ciclismo de carretera celebrando una nueva edición del Trofeo Máster y Veteranos Memorial Pelegrín del C.D. Peña Ciclista Lora del Río, tercera prueba del circuito.', '2024-06-01T11:00,', '1,', 21, 3, 2, 5, '', 0, NULL, 1, 0, 1, 'ciclismo.jpg', '2024-05-29 08:48:11', '2024-06-02 10:23:58', 2),
(7, 'Torre del Oro', 'Cultural', 'Sevilla', 'Es una torre albarrana situada en el margen oriental del río Guadalquivir. Su origen es una construcción almohade del siglo XIII​.\n\nVisitas todos los fines de Semana | 10:00 - 13:00', 'Se sitúa en el Paseo de Colón en el casco histórico de la ciudad hispalense, en el barrio del Arenal, muy cercana a la plaza de toros de la Maestranza, la Torre de la Plata o las Atarazanas y en la orilla de enfrente se encuentra el Barrio de Triana.', '2024-06-06T10:00,2024-06-06T11:00,2024-06-06T12:00,', '2,0,2,', 2, 1, 1, 5, 'tu sonrisa', 0, NULL, 0, 1, 1, 'torre-oro.jpg', '2024-05-29 09:02:14', '2024-06-02 10:24:04', 5),
(8, 'Visita Catedral', 'Cultural', 'Sevilla', 'Evita las largas colas para acceder a uno de los monumentos más populares de Sevilla con un ticket de acceso rápido para la impresionante catedral y La Giralda.', 'Adéntrate en la Catedral de Sevilla con una entrada con la que evitarás las colas y explora los tesoros que alberga. Contempla obras de Goya y conoce la historia si seleccionas la opción con audioguía. Sube a La Giralda y contempla las increíbles vistas de toda Sevilla.\r\nEntra a la catedral y visita la tumba de Cristóbal Colón, frente a la Puerta del Príncipe. En el monumento se encuentran los restos del explorador, aunque el debate acerca de si los huesos son suyos sigue abierto.', '2024-06-08T12:00,2024-06-15T10:00,', '0,0,', 4, 8, 2, 12, '', 0, NULL, 0, 0, 1, 'catedral.jpg', '2024-06-01 20:05:56', '2024-06-02 10:24:10', 5),
(9, 'Entrada Reales Alcázares', 'Cultural', 'Sevilla', 'Disfruta de esta visita al Real Alcázar de Sevilla, un bonito palacio medieval que fue declarado patrimonio de la humanidad en 1987.\r\nDescubre la localización de la serie de televisión \"Juego de tronos\"', 'Disfruta de una entrada para el Real Alcázar de Sevilla y maravíllate con este impresionante palacio medieval islámico. Pasea y admira la impresionante arquitectura y los hermosos jardines.\r\nDiseñado originalmente como un fuerte para los gobernadores cordobeses de Sevilla en el año 913, el Real Alcázar de Sevilla es una increíble fusión de arquitectura cristiana y morisca.', '2024-06-08T22:08,', '0,', 10, 5, 0, 16, '', 0, NULL, 0, 0, 1, 'alcazar.jpg', '2024-06-01 20:12:47', '2024-06-02 10:24:16', 5),
(10, 'Reales Atarazanas', 'Cultural', 'Sevilla', 'En Sevilla, Alfonso X decide la edificación de las Reales Atarazanas en 1252 con el fin de construir galeras fuera del recinto amurallado y muy cerca del Guadalquivir.', 'En el barrio de El Arenal se levantan 17 enormes naves de fábrica de ladrillo en sentido perpendicular al Guadalquivir y delante de la cerca almohade de la ciudad, donde los carpinteros de ribera se esforzaban en la construcción de barcos y los pescadores y almacenistas se dedicaban a la salazón del pescado. Más adelante se destinaron a almacenes reales y aduana, sirviendo a partir del siglo XVIII como fábrica y depósito de artillería, siendo el ejército el último de los grandes inquilinos en la historia de', '2024-06-01T23:00,', '2,', 15, 5, 0, 6, '', 0, NULL, 0, 0, 1, 'atarazanas.jpg', '2024-06-01 21:06:09', '2024-06-02 12:48:20', 5),
(11, 'Sanlúcar la Mayor, el lugar del sol', 'Ocio', 'Sanlúcar la Mayor, Sevilla', 'Historia, naturaleza, buena mesa y tradiciones esperan en este rincón aljarafeño por el que han pasado diferentes civilizaciones.', 'Su origen como asentamiento de población se remonta a la edad del cobre y el bronce final, como demuestran los restos arqueológicos hallados. Más tarde existió un poblamiento turdetano como señalan sus nombres: Hesperi Arae y Lucifer Fanum, cambiados por los de Sous y Solis Lucos y, más tarde, por Solucar. En tiempos de los romanos existía un templo dedicado al culto del sol.\r\nLos árabes llamaron al pueblo Al-bayda (la Blanca) y Alpechin, por los residuos que arrojaban las prensas de aceite de la zona.', '2024-06-15T12:10,', '0,', 10, 6, 1, 10, '', 0, NULL, 0, 1, 1, 'sanlucar.jpeg', '2024-06-01 21:39:08', '2024-06-02 10:24:27', 2),
(12, 'Archivo de Indias Visita guiada', 'Cultural', 'Sevilla', 'En esta visita guiada al Archivo de Inidas descubriremos la apasionante historia de la ciudad de Sevilla y su relación con América.', 'La visita comenzará en la fachada principal del Archivo de Indias y antes de entrar daremos un breve paseo por el edificio para comprender la relación histórica de este edificio con los monumentos que lo rodean, la Catedral y el Alcázar de Sevilla.\r\n\r\nDespués visitaremos las dos plantas del Archivo de Indias, y seguiremos descubriendo los aspectos más importantes de este espacio Patrimonio de la Humanidad.', '2024-06-01T23:39,', '1,', 10, 5, 2, 15, '', 0, NULL, 0, 0, 1, 'indias.jpg', '2024-06-01 21:43:48', '2024-06-02 12:42:13', 2),
(13, 'Sevilla City Bus', 'Ocio', 'Sevilla', 'Súbete a uno de nuestros autobuses de color verde brillante para ver lo mejor de Sevilla, la capital artística, cultural y financiera del sur de España. ¡No te faltarán cosas para hacer en esta hermosa ciudad!', 'Según la mitología, Sevilla fue fundada por Hércules, durante una de sus muchas aventuras. No podemos jurar que sea cierto, pero si lo es, estamos seguros de que estaría orgulloso de la fantástica ciudad en la que se ha convertido Sevilla. Hace cuatrocientos años, Sevilla era posiblemente la ciudad más importante del mundo. Ahora, es simplemente una de las más bellas. Una arquitectura asombrosa, calles antiguas y sinuosas, plazas bañadas por el sol y una gastronomía increíble: esta ciudad lo tiene todo.', '2024-06-06T13:44,2024-06-08T13:44,2024-06-07T12:44,', '0,0,0,', 10, 1, 2, 23, '', 0, NULL, 0, 0, 1, 'bustour.jpg', '2024-06-01 21:50:54', '2024-06-02 10:24:37', 2),
(14, 'Plaza de España: 170 metros de diámetro', 'Cultural', 'Sevilla', 'La Plaza de España es un espectáculo de luz y majestuosidad. Encuadrada en el Parque de María Luisa, esta plaza fue diseñada por el gran arquitecto sevillano Aníbal González como espacio emblemático de la Exposición Iberoamericana de 1929', 'El resultado fue una plaza-palacio única en el mundo. Sus proporciones son fastuosas; cuenta con una superficie total de 50.000 metros cuadrados, convirtiéndose sin duda en la plaza más imponente de España.\r\n\r\nA lo largo de todo el perímetro de la plaza se extiende un canal de 515 metros de longitud, que puedes recorrer a bordo de una barca. Sin duda, una romántica experiencia.', '2024-06-02T00:02,', '0,', 15, 7, 1, 7, '', 0, NULL, 0, 0, 1, 'plaza.jpg', '2024-06-01 22:05:40', '2024-06-02 10:24:43', 2),
(15, 'Paseo en barco por Sevilla', 'Ocio', 'Río Guadalquivir, Sevilla', 'En este paseo en barco por Sevilla recorrerás el río Guadalquivir a su paso por la capital andaluza y contemplarás monumentos tan emblemáticos como la Torre del Oro o el Puente de Triana.', 'A la hora indicada, nos reuniremos en el embarcadero de la Torre del Oro y te daremos la bienvenida a bordo de la embarcación que nos llevará de travesía por el Guadalquivir. ¡Seguro que tenéis muchas ganas de navegar!\r\n\r\nA lo largo de la travesía, tendrás la oportunidad de ver lugares emblemáticos como el Palacio de San Telmo, la antigua fábrica de tabacos o el mítico Puente de Triana. Además, el barco dispone de cubiertas panorámicas que permiten disfrutar de los monumentos sevillanos situados a orillas ', '2024-06-12T00:22,2024-06-19T00:22,2024-06-11T00:22,', '0,0,0,', 21, 1, 1, 17, '', 0, NULL, 0, 0, 1, 'crucero.jpg', '2024-06-01 22:26:17', '2024-06-02 10:24:49', 11),
(16, 'Visita a la Nao Victoria', 'Cultural', 'Río Guadalquivir, Sevilla', 'La Nao Victoria 500 está amarrada en los muelles del Paseo Marqués de Contadero como principal reclamo y contenido del Espacio de la Primera Vuelta al Mundo.', 'El centro de interpretación sobre esta gesta marítima, promovido por la Fundación Nao Victoria en colaboración con el Ayuntamiento de Sevilla y la Junta de Andalucía, abrió sus puertas el verano pasado con motivo de los 500 años de la partida de la expedición de Fernando Magallanes y Juan Sebastián Elcano.', '2024-06-02T00:26,', '0,', 10, 1, 1, 0, '', 0, NULL, 0, 0, 1, 'barco.jpg', '2024-06-01 22:29:11', '2024-06-02 10:24:54', 11),
(17, 'Paddle surf en el Guadalquivir', 'Aventura', 'Río Guadalquivir, Sevilla', 'Antes de salir se realiza un curso donde se explican los materiales que vamos a utilizar, cómo navegar y cuáles son las normas que hay que seguir en el río.', 'El usuario va guiado por el monitor que supervisará y corregirá en todo momento la técnica.\r\nSe parte desde el club deportivo y se navegará en grupo por la orilla del río pasando por los monumentos más emblemáticos.\r\nIremos haciendo pequeñas paradas en el agua para explicar parte de la historia de Sevilla y su río y que los suppers se impregnen sin prisas de las vistas de esta maravillosa ciudad.', '2024-06-02T00:29,2024-06-21T00:37,', '0,0,', 7, 1, 0, 0, '', 1, 6, 1, 0, 1, 'body.jpg', '2024-06-01 22:33:15', '2024-06-02 10:25:00', 11),
(18, 'Yincana de Magallanes', 'Cultural', 'Sevilla Zona Río', 'Una yincana para conocer todos los avatares de esta expedición, que sin duda, supuso un antes y un después para el mundo. Jugaremos a conocer la Sevilla de principios del siglo XVI y entender la importancia de tan gloriosa aventura.', 'Nuestras yincanas cuentan con animadores y actores que proponen un reto a los participantes, sobre una temática concreta, a partir de una serie de divertidas pruebas de habilidad e ingenio.\r\nSi quieres organizar una yincana original, te ofrecemos el mejor servicio, un grupo de actores y animadores que te harán disfrutar de la ciudad al mismo tiempo que te enseñarán sus anécdotas y entresijos.', '2024-06-02T00:33,', '0,', 30, 2, 2, 12, 'Ganas de divertirte', 0, NULL, 0, 0, 1, 'magallanes.jpg', '2024-06-01 22:37:06', '2024-06-02 10:25:04', 11),
(19, 'Vía Ferrata Tajo de Ronda', 'Escalada', 'Ronda, Málaga', 'Embárcate en una aventura inolvidable al explorar la emocionante vía ferrata en el impresionante Tajo de Ronda.', 'Nuestra propuesta, que abarca las cautivadoras rutas Tajo I y II, está diseñada especialmente para principiantes en busca de una experiencia fácil pero emocionante, con una dificultad clasificada como K1 & K2\r\n\r\nEstas vías ferratas te guiarán a través de las imponentes paredes verticales del Tajo de Ronda, brindándote la oportunidad de sumergirte en un paisaje natural único.\r\nMientras escalas, la magnificencia de las vistas panorámicas te cautivará, transformando cada momento en una experiencia emblemática.', '2024-06-17T00:40,2024-06-20T00:40,', '0,0,', 10, 1, 3, 15, 'Herrajes, Casco y equipo de protección', 1, 15, 1, 1, 1, 'ferrata.jpg', '2024-06-01 22:45:33', '2024-06-02 11:14:55', 3),
(20, 'En Kayak por el Guadalquivir', 'Aventura', 'Río Guadalquivir, Sevilla', 'Contempla las vistas más bonitas de Sevilla: la Torre del Oro, el Puente de Triana, la calle Betis, la Maestranza… mientras navegas por el Guadalquivir.', 'Nos encanta navegar con vosotros, sobre todo cuando venís en grupo y podemos realizar actividades y juegos más dinámicos y divertidos entre todos, disfrutando de una experiencia mucho más completa.', '2024-06-21T00:46,', '0,', 10, 2, 0, 15, 'Un kayak desde luego...', 1, 20, 1, 0, 1, 'kayak.jpg', '2024-06-01 22:50:19', '2024-06-02 10:25:17', 11),
(21, 'Sierra Norte de Sevilla, la Comarca Secreta', 'Senderismo', 'La Puebla de los Infantes, Constantina, San Nicolás del Puerto...', 'El Parque Natural de la Sierra Norte de Sevilla no solo es un destino en si mismo, sino que es una joya secreta que merece ser descubierta a ritmo lento.', 'Hermosos cascos históricos de pueblos con encanto, fortalezas que todavía cuentan leyendas, deliciosa gastronomía y una diversidad paisajística insuperable (que le ha valido su inclusión en la red europea de geoparques) son los ingredientes de una de las comarcas que más tesoros esconde todavía al visitante. ', '2024-06-11T00:52,2024-06-26T00:52,', '0,0,', 10, 2, 3, 25, 'Tus pies', 0, NULL, 0, 1, 1, 'senderos.jpg', '2024-06-01 22:57:07', '2024-06-02 10:25:23', 9),
(22, 'Monitora Pilates', 'Fitness', 'Sevilla, parque María Luisa', 'El método Pilates cuenta, actualmente, con una popularidad enorme desde que sufriera un auge importante en la primera década del siglo XXI.', 'Fruto de esto, el Pilates ha dejado de ser una moda para convertirse en una actividad física común en el catálogo de muchos gimnasios y centros deportivos, además de existir gran cantidad de centros de Pilates dedicados exclusivamente a esta disciplina.', '2024-06-13T00:57,2024-06-12T00:57,', '0,0,', 7, 2, 1, 8, 'Alfombra de ejercicios', 0, NULL, 0, 0, 1, 'gym2.jpg', '2024-06-01 23:01:01', '2024-06-02 10:25:30', 6),
(23, 'Entrenadora Personal', 'Fitness', 'Gimnasio fullBody, Sevilla', 'Enseño y transmito las habilidades y técnicas de uno o varios deportes a muchas clases de personas, desde principiantes hasta expertos. Animo a sus deportistas a mejorar su rendimiento.', 'Preparo programas de entrenamiento adaptados a cada deportista para llevarlo a su rendimiento máximo en el momento adecuado. Cuando entreno a un equipo, trato de conseguir que sus miembros formen un conjunto de juego bien trabado. Utilizo material de entrenamiento de diferentes clases.\r\n\r\nMi primera prioridad es enseñar a entrenar de manera segura.', '2024-06-08T01:01,', '0,', 10, 1, 2, 6, 'Ganas de superarte', 0, NULL, 0, 0, 1, 'gym3.jpg', '2024-06-01 23:04:36', '2024-06-02 10:25:37', 6),
(24, 'Domyos Decathlon Academy', 'Fitness', 'Parque del Alamillo, Sevilla', 'Están en pleno crecimiento, pero su cuerpo y su respuesta fisiológica a las cargas no es igual que la nuestra. En este artículo te damos las claves para que tus niños estén en forma, más fuertes y con buena salud.', 'Los niños, a medida que van creciendo, van adquiriendo una serie de capacidades que van haciendo que éste madure poco a poco tanto a nivel nervioso como físico. Esta maduración está afectada por diferentes factores: aquellos intrínsecos, como los de carácter genético y los extrínsecos, que hacen referencia a aquellos que rodean al niño y que vienen determinados por su entorno como una alimentación adecuada o la presencia de actividad física en sus hábitos.', '2024-06-02T01:11,', '0,', 11, 7, 1, 0, '', 0, NULL, 0, 1, 1, 'gym4.jpg', '2024-06-01 23:13:49', '2024-06-02 10:25:43', 5),
(25, 'Athletic Center', 'Running', 'Sevilla', 'Entrenamiento en grupo reducido en Sevilla.', 'thletic Center es un gimnasio premium que nace de la mano de Ensa Sport, una de una de las empresas líderes en entrenamiento personal a nivel nacional, con el objetivo de ofrecer a nuestros socios un servicio más personalizado, controlado y adaptado a sus necesidades.\r\nBasados en más de 12 años de experiencia, hemos desarrollado un método de éxito con el que conseguirá sus objetivos en el menor tiempo posible, y con el máximo control sobre su salud.', '2024-06-02T01:50,', '0,', 10, 5, 2, 7, 'Ganas de sudar', 1, 0, 1, 0, 1, 'runner10.jpg', '2024-06-01 23:54:06', '2024-06-02 10:25:48', 7),
(26, 'Entrena! Home Running', 'Running', 'Sevilla', 'Hemos creado un verdadero centro de entrenamiento deportivo cuyo objetivo principal es mejorar y/o aumentar tu rendimiento físico.', 'Ponemos a tu disposición una instalación con gran selección de materiales diferentes y novedosos que te ayudarán, sin duda alguna, a conseguir tus objetivos de una forma mucho más rápida y eficaz.', '2024-06-02T01:55,2024-06-25T01:55,', '0,0,', 7, 2, 0, 12, 'Útiles de entrenamiento', 1, 0, 0, 0, 1, 'runner5.jpg', '2024-06-01 23:59:49', '2024-06-02 10:23:04', 10),
(27, 'Cádiz Runner Experience', 'Running', 'Cádiz y alrededores', 'Cádiz es una ciudad ideal para practicar deportes al aire libre gracias a sus condiciones climáticas.', 'Si hay que buscarle un punto débil es su limitado tamaño, pero esto puede salvarse fácilmente gracias a la cantidad de kilómetros accesibles para correr con los que cuenta en su línea limítrofe con el mar. Aquí te proponemos una ruta libre de semáforos, a la que le puedes sumar kilómetros a tu antojo y sin que ningún cruce de calles o carreteras te frene.', '2024-06-02T02:01,2024-06-18T02:18,2024-06-25T02:18,', '0,0,0,', 5, 2, 1, 0, '', 0, NULL, 0, 0, 1, 'runner2.jpg', '2024-06-02 00:04:48', '2024-06-02 10:22:56', 4),
(28, 'Guadalquivir Activo', 'Running', 'Río Guadalquivir, Sevilla', '¡Lo mejor: la brisa que proporciona el caudal del río!', 'De los únicos ríos navegables del mundo, esta ruta lleva años siendo una rutina en los corredores sevillanos, a la orilla del Guadalquivir puedes correr durante 11 km sin parar, en un tramo 100% plano.', '2024-06-02T02:20,', '0,', 4, 2, 1, 0, 'Zapatillas deportivas', 0, NULL, 0, 0, 1, 'runner0.jpg', '2024-06-02 00:22:34', '2024-06-02 10:22:46', 6),
(29, 'Monitor Deportivo Avanzado', 'Running', 'Sevilla', 'Experto runner se ofrece para ponerte en forma.', 'Conmigo descubrirás conceptos fundamentales del sistema locomotor del cuerpo humano, así como fisiología del músculo y del ejercicio, y profundizarás en el concepto de fuerza.\r\nAprenderás ejercicios destinados a cada músculo, además de diferentes tipos de movimientos musculares que podrás aplicar al entrenamiento a través de técnicas de musculación.', '2024-06-02T02:23,', '0,', 4, 2, 2, 10, '', 0, NULL, 1, 0, 1, 'runner1.jpg', '2024-06-02 00:29:13', '2024-06-02 11:27:54', 7),
(30, 'Nutrición y Dietética Deportiva', 'Fitness', 'Sevilla', 'Te preparo para trabajar en el mundo del Fitness', 'Fundamental para educar al cuerpo en una buena alimentación, que proporcione energía para el ejercicio físico y sobre todo te forme a la hora de instruir a los demás en hábitos alimenticios adecuados para la salud. Este curso es clave para conseguir mejores resultados por parte de quienes practican deporte o ejercicio físico.', '2024-06-02T02:30,', '0,', 3, 1, 1, 5, 'Buen humor', 0, NULL, 0, 0, 1, 'runner11.jpg', '2024-06-02 00:34:35', '2024-06-02 10:20:29', 8);

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
(1, 'mortadelo', '666444993', 'mortadelo@ibanez.es', 'user', '2024-04-05 07:40:30', NULL),
(2, 'filemon', '665443322', 'filemon@ibanez.es', 'user', '2024-05-03 10:54:54', NULL),
(3, 'vicente', '619283782', 'vicente@super.es', 'user', '2024-05-28 21:18:28', NULL),
(4, 'bacterio', '628329011', 'bacterio@profesor.es', 'user', '2024-05-28 21:19:40', NULL),
(5, 'rompetechos', '643728321', 'rompetechos@ibanez.es', 'user', '2024-05-28 21:10:09', NULL);

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
(1, 'Visita Casa Pilatos', 'Senderismo', 'Visita con grupo de ingleses', 'Sevilla', NULL, NULL, 10, 1, '2024-05-31 17:36:02', NULL, 2, 1),
(2, 'Visita al Barrio Santa Cruz', 'Senderismo', 'Visita en grupo con unos amigos', 'Sevilla', 'Guía turística', '2024-06-08T12:00', 4, 2, '2024-05-31 15:26:54', NULL, 5, 2),
(3, 'Visita a Triana', 'Cultural', 'Me gustaría saber si podrían guiarnos por este barrio tan famoso', 'Sevilla', 'Nada en especial', '2024-06-12T15:56', 5, 0, '2024-06-02 10:58:29', NULL, 5, 3),
(4, 'Sidecar', 'Ocio', 'Podría hacerse una visita por toda la Sierra de ronda en Sidecar?', 'Ronda', 'Moto con sidecar', '2024-06-02T13:21', 2, 1, '2024-06-02 11:22:35', NULL, 3, 5),
(5, 'Sobre Leyendas de Bécquer', 'Cultural', 'Podría hacerse una Yincana con la temática de los poemas de Bécquer ?', 'Sevilla', 'Disfraces, literatura sobre el autor...', '2024-06-20T16:23', 5, 1, '2024-06-02 11:25:06', NULL, 11, 4);

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
(5, 'romy', 'admin', 'Romy', 'Panther', '667776667', 'romy@fog.es', 'admin', 1, 'romy.png', 'Sevilla', '2024-05-28 14:42:56'),
(6, 'bully', 'admin', 'inspector', 'bully', '668983212', 'bully@80dias.son', 'admin', 1, 'bully.jpg', 'Sevilla', '2024-06-01 22:08:39'),
(7, 'dix', 'admin', NULL, NULL, '632112211', 'dix@80dias.son', 'admin', 1, 'dix.jpg', NULL, '2024-06-01 22:09:19'),
(8, 'mrsullivan', 'admin', NULL, NULL, '676567651', 'mrsullivan@80dias.son', 'admin', 1, 'mrsullivan.jpg', NULL, '2024-06-01 22:10:20'),
(9, 'ralph', 'admin', NULL, NULL, '652211771', 'ralph@80dias.son', 'admin', 1, 'ralph.jpg', NULL, '2024-06-01 22:11:09'),
(10, 'transfer', 'admin', NULL, NULL, '637819322', 'transfer@80dias.son', 'admin', 1, 'transfer.jpg', NULL, '2024-06-01 22:11:47'),
(11, 'brigadierCorn', 'admin', 'Brigadier', 'Corn', '626896121', 'brigadier@corn.es', 'admin', 1, 'brigadiercorn.jpg', 'Sevilla Zona Río', '2024-06-01 22:13:07');

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
(1, '2024-06-01T23:39', 1, 'Hola estaré uno o dos días en Sevilla. Me gustaría realizar esta visita. Gracias', '2024-06-02 10:55:50', '2024-06-02 12:42:13', 1, '', 12, 2, 3),
(2, '2024-06-02T02:30', 1, 'Hola me gustaría ampliar mis conocimientos sobre alimentación. Gracias', '2024-06-02 11:01:24', NULL, 0, '', 30, 8, 4),
(3, '2024-06-01T23:00', 2, 'Hola me gustaría disfrazarme y recorrer los escenarios de Juego de Tronos', '2024-06-02 11:03:41', '2024-06-02 12:48:20', 1, '', 10, 5, 1),
(4, '2024-06-12T00:57', 2, 'Hola tengo mucho stress y necesito despejarme de alguno forma. Saludo', '2024-06-02 11:05:16', NULL, 0, '', 22, 6, 2),
(5, '2024-07-06T11:00', 1, 'Hola, me gustaría darme un paseo en el trineo ese que se ve en la foto. No es peligroso ¿verdad? Gracias', '2024-06-02 11:11:24', '2024-06-02 12:49:51', 2, 'admin', 5, 3, 5),
(6, '2024-06-17T00:40', 1, 'Hola, ¿podría hacer un poco de \'puenting\' también? Saludo', '2024-06-02 11:20:20', NULL, 0, '', 19, 3, 5),
(7, '2024-06-12T00:22', 2, 'Hola! Si no encontramos flotadores homologados no nos montamos...', '2024-06-02 12:59:07', '2024-06-02 12:59:31', 2, 'usuario', 15, 11, 2);

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
  MODIFY `idActividad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `consumidor`
--
ALTER TABLE `consumidor`
  MODIFY `idConsumidor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `demanda`
--
ALTER TABLE `demanda`
  MODIFY `idDemanda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ofertante`
--
ALTER TABLE `ofertante`
  MODIFY `idOfertante` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
