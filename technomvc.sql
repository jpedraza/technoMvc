-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2017 a las 15:11:34
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `technomvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(255) NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_producto` int(255) NOT NULL,
  `cantidad` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Consolas'),
(2, 'Reproductores'),
(3, 'Accesorios'),
(4, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_producto` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(255) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `precio` double NOT NULL,
  `cantidad` tinyint(3) NOT NULL DEFAULT '1',
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL DEFAULT '1',
  `id_subcategoria` int(255) NOT NULL,
  `marca` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `oferta` tinyint(1) NOT NULL DEFAULT '0',
  `precio_oferta` double NOT NULL,
  `foto1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `cantidad_vendida` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `cantidad`, `descripcion`, `condicion`, `id_categoria`, `id_subcategoria`, `marca`, `oferta`, `precio_oferta`, `foto1`, `foto2`, `foto3`, `estatus`, `cantidad_vendida`) VALUES
(1, 'PlayStation 2', 156500, 6, '<p style="text-align: center;"><span style="font-family: impact; font-size: x-large; color: #ff0000;">Playstation 2 Slim 9001</span></p>\r\n<p style="text-align: justify;">Modelo Slim que incluye sus componentes Originales que son los siguientes: </p>\r\n<div>\r\n<ol>\r\n<li style="text-align: justify;">Consola PS2. </li>\r\n<li style="text-align: justify;">Control Dualshock 2 (dos 2).</li>\r\n<li style="text-align: justify;">Cable Audio/Video. </li>\r\n<li style="text-align: justify;">Cable Corriente. </li>\r\n<li style="text-align: justify;">Caja. </li>\r\n<li style="text-align: justify;">Memory Card.</li>\r\n<li style="text-align: justify;">Juegos a elección (cinco 5).</li>\r\n</ol>\r\n</div>', 1, 1, 1, 'Sony', 0, 0, '2ps2.jpg', '3ps2.jpg', 'default.jpg', 1, 3),
(2, 'Kit de destornilladores partes electrónicas 31-1', 4950, 2, '<h2 style="text-align: center;"><span style="color: #ff0000;">KIT DE DESATORNILLADORES PARA PC Y DISPOSITIVOS ELECTRONICOS</span></h2>\r\n<p style="text-align: justify;">Juego completo de destornilladores para los dispositivos electrónicos, reparación de teléfonos celulares y mucho más.</p>\r\n<p style="text-align: justify;">Adecuado para la mayorí­a de los tornillos:</p>\r\n<ol>\r\n<li>T4</li>\r\n<li>T5</li>\r\n<li>T6</li>\r\n<li>T7</li>\r\n<li>T8</li>\r\n<li>T10</li>\r\n<li>T15</li>\r\n<li>Hex1.5</li>\r\n<li>Hex2.0</li>\r\n<li>Hex2.5</li>\r\n<li>Hex3.0</li>\r\n<li>Hex4.0</li>\r\n<li>PH00</li>\r\n<li>PH0</li>\r\n<li>PH1</li>\r\n<li>PH2</li>\r\n<li>Slot1.5</li>\r\n<li>Slot2.0</li>\r\n<li>Slot2.5</li>\r\n<li>Slot3.0</li>\r\n<li>Slot4.0</li>\r\n<li>Star2.3mm</li>\r\n<li>Tro1.5/2.0mm</li>\r\n<li>Spanner2.6mm</li>\r\n<li>Tro-Wing1mm</li>\r\n</ol>\r\n<p style="text-align: justify;"><strong>Especificaciones:</strong> 31-IN-1 Juego completo de destornilladores 2,5 mm 3,0 mm 3,5 mm 4,0 mm 4,5 mm 5,0 mm 5,5 mm T4 T5 T6 T7 T8 T10 T15 PH00 PH0 PH1 PH2 1.5 2.0 2.5 3.0 4.0 2.3 1.5 2.0 M2.6 1,0 mm.</p>\r\n<p style="text-align: justify;"><strong>Dimensiones: </strong>Largo: 10,5 cm x Ancho: 15,5 cm x Altura: 3 cm</p>\r\n<p style="text-align: justify;"><strong>Peso:</strong> 200 g</p>', 1, 4, 10, 'Generico', 0, 0, 'destornillador.jpg', 'destornillador1.jpg', 'default.jpg', 1, 0),
(3, 'Nintendo Wii | Chipeado', 62999, 2, '<h2 style="text-align: center;"><span style="color: #ff0000;">Nintendo Wii</span></h2>\r\n<p>El producto posee Todos sus componentes Originales que son los siguientes:</p>\r\n<ol>\r\n<li>Consola Nintendo Wii</li>\r\n<li>Control Wii Remote <strong>(1)</strong></li>\r\n<li>Control Nunchuk <strong>(1)</strong></li>\r\n<li>Cable Audio/Video</li>\r\n<li>Fuente de Poder</li>\r\n<li>Barra Sensora</li>\r\n<li>Manuales</li>\r\n</ol>\r\n<p>Garantía de 2 Meses por la tienda</p>', 1, 1, 2, 'Wii', 1, 61000, 'wii.jpg', 'default.jpg', 'default.jpg', 1, 0),
(4, 'Playstation 3 Slim | 160Gb', 162890, 1, '<h2 style="text-align: center;"><span style="color: #ff0000;">Playstation 3 Slim | 160Gb</span></h2>\r\n<p>Modelo Slim que incluye sus componentes Originales que son los siguientes:</p>\r\n<ol>\r\n<li>Consola Ps3.</li>\r\n<li>Control Dualshock  (1 uno).</li>\r\n<li>Cable USB para cargar el control.</li>\r\n<li>Cable HDMI 1.8m.</li>\r\n<li>Cable de Audio y Video.</li>\r\n<li>Caja.</li>\r\n<li>Manual de Instrucciones.</li>\r\n<li>Un Juego (El de su Preferencia)</li>\r\n</ol>', 1, 1, 1, 'Sony', 0, 0, 'ps3.jpg', 'default.jpg', 'default.jpg', 1, 0),
(5, 'Playstation 4 | 500Gb', 695999, 1, '<h2 style="text-align: center;"><span style="color: #ff0000;">Playstation 4 | 500Gb</span></h2>\r\n<p>Incluye sus componentes Originales que son los siguientes:</p>\r\n<ol>\r\n<li>Consola Ps4 de 500 Gb.</li>\r\n<li>Control Ps4 (1 uno).</li>\r\n<li>Audifono (1 uno).</li>\r\n<li>Cable HDMI 1.8m.</li>\r\n<li>Caja.</li>\r\n<li>Manual de Instrucciones.</li>\r\n<li>Un Juego </li>\r\n</ol>', 1, 1, 1, 'Sony', 0, 0, 'ps4.jpg', 'default.jpg', 'default.jpg', 1, 0),
(6, 'Playstation 1 PsOne | Chipeado y óptico nuevo', 32800, 6, '<h2 style="text-align: center;"><span style="color: #ff0000;">Playstation 1 PsOne | Chipeado</span></h2>\r\n<p>Modelo PsOne que incluye sus componentes originales que son los siguientes:</p>\r\n<ol>\r\n<li>Consola PsOne.</li>\r\n<li>Controles (2 dos).</li>\r\n<li>Cable de Audio y Video.</li>\r\n<li>Cable de Corriente 110V.</li>\r\n<li>Cinco Juegos (De su Preferencia).</li>\r\n</ol>\r\n<p>Garantía de siete (7) días por la tienda</p>', 2, 1, 1, 'Sony', 1, 31500, 'pso.jpg', 'default.jpg', 'default.jpg', 1, 0),
(7, 'Reproductor Pioneer Deh-x1750ub', 98500, 3, '<h2 id="mcetoc_1b6arbfl00" style="text-align: center;"><span style="color: #ff0000;">Reproductor Pioneer Deh-x1750ub</span></h2>\r\n<p><strong>Especificaciones.</strong></p>\r\n<ol>\r\n<li>Formatos de disco: CD/CD-R/CD-RW/MP3/WMA.</li>\r\n<li>Salidas: 50W x 4.</li>\r\n<li>Entrada USB y Auxiliar por el frontal.</li>\r\n<li>MIXTRAX.</li>\r\n<li>Soporte para Android.</li>\r\n<li>Pantalla (12 Caracteres).</li>\r\n<li>Ecualizador grafico de 5 Bandas.</li>\r\n<li>Control Remoto.</li>\r\n<li>Frontal Extraible.</li>\r\n<li>FM / AM</li>\r\n</ol>', 1, 2, 3, 'Pioneer', 0, 0, 'repro.jpg', 'reproPionner.jpg', 'default.jpg', 1, 0),
(8, 'Cable 3RCA Audio Y Video 1.5metros', 990, 15, '<h2 style="text-align: center;"><span style="color: #ff0000;">Cable 3RCA Audio Y Video 1.5metros</span></h2>\r\n<p style="text-align: justify;"> </p>\r\n<p style="text-align: justify;">Cable audio y vi­deo 3RCA 1.5 metros mejor calidad, resistente y duradero que le permitirá realizar cualquier tipo de conexión RCA de tus equipos de audio, DVD, juegos de vi­deo entre otros.</p>', 1, 3, 11, 'Generico', 0, 0, 'conector2.jpg', 'rca.jpg', 'default.jpg', 1, 8),
(9, 'Super Mario Bross Muñeco 12cm Coleccion Goldie', 7950, 12, '<h2 style="text-align: center;"><span style="color: #ff0000;">Super Mario Bross Muñeco 12cm Coleccion Goldie</span></h2>\r\n<p><strong>Caracteristicas: </strong></p>\r\n<p>Muñeco Mario Bross, mueve brazos y cabeza.</p>\r\n<p>Peso: 76g. Colección Goldie Internacional.</p>\r\n<p>Dimensión del Producto: 12cm de alto x 8cm de ancho.</p>', 1, 4, 9, 'Goldie', 0, 0, 'mario.jpg', 'default.jpg', 'default.jpg', 1, 0),
(10, 'Call Of Duty Ghost Ps3', 9000, 3, '<h2 style="text-align: center;"><span style="color: #ff0000;">Call Of Duty Ghost Ps3</span></h2>\r\n<p>Juego de Call Of Duty Ghost Original, para consola de Ps3.</p>', 1, 3, 15, 'Activision ', 0, 0, 'callghost.jpg', 'default.jpg', 'default.jpg', 1, 2),
(11, 'Linterna Recargable 3 Led', 4999, 12, '<h2 style="text-align: center;"><span style="color: #ff0000;">Linterna LED recargable de 3 bombillos.</span></h2>\r\n<p><strong>Características:</strong></p>\r\n<ol>\r\n<li>No Usa Baterías.</li>\r\n<li>Duración de hasta 30 Minutos.</li>\r\n<li>Luz Fría por lo que no corre el riesgo de quemarse.</li>\r\n</ol>', 1, 4, 12, 'Dinamo Wequp', 0, 0, 'linterna.jpg', 'linterna3.jpg', 'default.jpg', 1, 0),
(12, 'Forro Estuche Protector Con Teclado Para Tablet 7', 16900, 6, '<h2 style="text-align: center;"><span style="color: #ff0000;">Forro Estuche Protector Con Teclado Para Tablet 7"</span></h2>\r\n<p><strong>Especificaciones:</strong></p>\r\n<ol>\r\n<li>Forro Con Teclado Para Tablet 7 Pulgadas.</li>\r\n<li>Conexion USB.</li>\r\n<li>Colores Variados</li>\r\n</ol>', 1, 3, 13, 'Fierucci', 0, 0, 'forro1.jpg', 'default.jpg', 'default.jpg', 1, 0),
(13, 'Bateria Duracell AA | Paquete de 2', 3500, 24, '<h2 style="text-align: center;"><span style="color: #ff0000;">Bateria Duracell AA | Paquete de 2</span></h2>\r\n<p>Baterí­a duracell AA ideal para todos tus equipos electrónicos.</p>', 1, 4, 14, 'Duracell', 0, 0, 'bateriaAa.jpg', 'default.jpg', 'default.jpg', 1, 16),
(14, 'Control Wii Remote Y Nunchuk Original', 69000, 3, '<p><strong>Especificación del articulo:</strong></p>\r\n<p>Excelente control Wii Remote y nunchuk original para consolas nintendo wii, no compres imitaciones chinas que te duran una semana, compra original.</p>\r\n<p>Contenido:</p>\r\n<ol>\r\n<li>Un WII REMOTE</li>\r\n<li>Un NUNCHUK</li>\r\n</ol>', 1, 3, 16, 'Wii', 1, 64999, 'wii1.jpg', 'default.jpg', 'default.jpg', 1, 0),
(15, 'Call of Duty: Black Ops III | PsVita', 30990, 3, '<h2 style="text-align: center;"><span style="color: #ff0000;">Call of Duty: Black Ops III | PsVita</span></h2>\r\n<p> </p>\r\n<p><strong>Descripción Del Juego:</strong></p>\r\n<p style="text-align: justify;">Call of Duty: Black Ops III combina tres modos de juego únicos: campaña, multijugador y Zombis, y ofrece a los fans el juego más profundo y ambicioso de la historia de Call of Duty.</p>\r\n<p style="text-align: justify;">La campaña es una experiencia cooperativa en lí­nea para hasta cuatro jugadores, pero también una emocionante aventura cinemática en solitario. El multijugador será el más profundo y cautivador de la franquicia hasta la fecha, con nuevas formas de ascender de rango y personalizar y preparar la batalla. Y Zombis ofrece una nueva experiencia espectacular con su propia historia.</p>\r\n<p style="text-align: justify;">El tí­tulo alcanza un nivel de innovación sin precedentes, que incluye entornos espectaculares, armamento y habilidades nunca vistos y un nuevo sistema mejorado de movimiento fluido.</p>', 1, 3, 15, 'Activision', 0, 0, 'callBlack.jpg', 'default.jpg', 'default.jpg', 1, 0),
(16, 'Control de Directv Universal', 9990, 12, '<p style="text-align: justify;">Todo tu entretenimiento desde un solo control, Liberate de la complicación de múltiples controles.</p>\r\n<p style="text-align: justify;">Ahora puedes controlar todo tu sistema de entretenimiento, no sólo tu decodificador DIRECTV.</p>\r\n<p><strong>Funciones Especiales:</strong></p>\r\n<ol>\r\n<li>Arma tu propia guía.</li>\r\n<li>Graba, pausa y retrocede.</li>\r\n<li>Mira búsquedas recientess.</li>\r\n<li>Búsqueda Inteligente.</li>\r\n<li>Cambie el idioma.</li>\r\n</ol>', 1, 3, 16, 'Rca', 0, 0, 'directv.jpg', 'default.jpg', 'default.jpg', 1, 6),
(17, 'Killzone 3 | Ps3', 21000, 1, '<p style="text-align: justify;">La palabra Killzone se ha convertido en la Next-Gen en sinónimo de saga shooter de calidad y, sobre todo, de la principal cabeza de lanza de PlayStation 3 en el género.</p>\r\n<p style="text-align: justify;">La tercera entrega de la saga continúa rayando a gran altura, y consolida a las series como uno de los mejores ejemplos de shooter Next-Gen. ¿El motivo? Una forma de aunar tecnologí­a y jugabilidad como pocas veces se han visto.</p>\r\n<p style="text-align: justify;">Lejos de las polémicas que azotaron a la segunda entrega de Killzone con su famoso ví­deo del E3 y con la eterna controversia sobre si el videojuego de Sony lograrí­a alcanzar las cotas de calidad de lo mostrado en la por entonces célebre cinemática, Killzone 3 ha gozado de un desarrollo mucho más plácido. ¿Las causas? Varias, pero la principal es la de que se trata de un videojuego muy esperado, pero ya con la calidad de su predecesor alladíendole el camino, ventaja de la que no disfrutá su antecesor.</p>', 1, 3, 15, 'Activision', 0, 0, 'killzone.jpg', 'default.jpg', 'default.jpg', 1, 0),
(18, 'Resistance 3 | Ps3', 21000, 2, '<h2 style="text-align: center;"><span style="color: #ff0000;">Resistance 3 | Ps3</span></h2>\r\n<p> </p>\r\n<p style="text-align: justify;">Cuatro años después de la odisea de Nathan Hale nos llega la conclusión al épico conflicto entre la Humanidad y las Quimeras. Joseph Capelli, personaje presentado en Resistance 2, adquiere en esta tercera parte el protagonismo absoluto mientras lo acompañamos por un Estados Unidos muy, muy lejos de representar el ideal del Sueño Americano. Es la batalla final, en la que la última bala será disparada. Y solamente falta saber quién vencerá</p>', 1, 3, 15, 'Insomniac', 0, 0, 'resistance.jpg', 'default.jpg', 'default.jpg', 1, 0),
(19, 'Control de Nintendo Gamecube / Nintendo Wii', 65000, 6, '<p>Excelente control color Blanco original para consolas de Nintendo Gamecube y Wii.</p>\r\n<p><strong>Especificación del artí­culo:</strong></p>\r\n<p>Color Blanco original Nintendo Gamecube y compatible con consolas de Nintendo Wii. </p>', 1, 3, 16, 'Nintendo', 0, 0, 'controlGCube.jpg', 'default.jpg', 'default.jpg', 1, 0),
(20, 'Control de Ps3 Dualshock Original', 49000, 6, '<h2 style="text-align: center;"><span style="color: #ff0000;">Control de Ps3 Dualshock Original</span></h2>\r\n<p style="text-align: justify;"> </p>\r\n<p style="text-align: justify;">El nuevo control inalámbrico para el sistema PlayStation permite a los usuarios explotar todo el potencial de la consola más avanzada del mundo. Su desarrollo refiná el popular control original del PlayStation y lo combiná con la experiencia de juego que ha vendido millones alrededor del mundo.</p>\r\n<p style="text-align: justify;">El control inalámbrico, cuenta con tecnologí­a sensible para detectar movimientos naturales e intuitivos en tiempo real y alta precisión interactiva, actuando naturalmente como una extensión del cuerpo del jugador.</p>\r\n<p style="text-align: justify;">El control inalámbrico utiliza la tecnología Bluetooth para el juego inalámbrico y el cable USB del control para cargar el control automáticamente a través de la consola en cualquier momento. A diferencia de otros controles inalámbricos es fácil de programar y es compatible con monitores y televisores actuales.</p>\r\n<p style="text-align: justify;">Al integrar todas estas caracterí­sticas al control original de PlayStation, Sony Computer Entertainment junto con los desarrolladores de contenido planean llevar la experiencia de juego a la siguiente generación de videojuegos.</p>', 1, 3, 16, 'PlayStation', 0, 0, 'ps3control.png', 'default.jpg', 'default.jpg', 1, 0),
(21, 'Cable Hdmi 1.5 Mt Full Hd 1080px', 4900, 24, '<p style="text-align: justify;">HDMI permite el uso de ví­deo computarizado de alta definición, así­ como audio digital multicanal en un Único cable.</p>\r\n<p style="text-align: justify;">La especificación HDMI no define una longitud máxima del cable. Al igual que con todos los cables, la atenuación de la señal se hace demasiado alta a partir de una determinada longitud. En lugar de ello, HDMI especifica un mÃ­nimo nivel de potencia. Diferentes materiales y calidades de construcción permitirán cables de diferentes longitudes. Además, el mayor rendimiento de los requisitos debe cumplirse para soportar los formatos de ví­deo de mayor resolución y/o el marco de las tasas de los formatos del estándar HDTV. La atenuación de la señal y la interferencia causada por los cables pueden ser compensadas mediante la utilización de un ecualizador adaptativo.</p>', 1, 3, 11, 'Generico', 0, 0, 'hdmi.jpg', 'default.jpg', 'default.jpg', 1, 4),
(22, 'Cable Auxiliar Plus 3.5mm 1.5metros M/M', 2200, 12, '<h2 style="text-align: center;"><span style="color: #ff0000;">Cable auxiliar plus 3.5mm 1.5mts macho a macho</span></h2>\r\n<p> </p>\r\n<p>Cable auxiliar plus 3.5mm a 3.5mm, medida 1.5mts de largo punta dorada. Ideal para conectar su mp3, mp4, Ipod, celulares, equipos electrónicos al reproductor de su carro.</p>', 1, 3, 5, 'Generico', 0, 0, 'plusaudio.jpg', 'default.jpg', 'default.jpg', 1, 0),
(23, 'Conector De Audio 3.5 Mm Macho A 2 Rca Hembra', 1390, 15, '<p>Adaptador que de una salida mini jack 3.5mm hembra convierte en 2 salidas RCA</p>\r\n<p>Conexión Jack Stereo 3.5mm Macho a 2 RCA Hembras</p>', 1, 3, 5, 'Generico', 0, 0, '35-rca.jpg', 'default.jpg', 'default.jpg', 1, 0),
(24, 'Adaptador Mini Plug 2 Hembras', 1999, 12, '<p><strong>Caracterí­sticas:</strong></p>\r\n<p>Adaptador Jack Estereo 3.5mm Macho A 2 Jack 6.3mm Hembra. Ideal para conexiones musicales entre salidas de sonido de computadoras, laptop, mp3, mp4 desde o hacia equipos de sonido profesionales.</p>\r\n<p><strong>Especificaciones:</strong></p>\r\n<ol>\r\n<li>Producto: Nuevo.</li>\r\n<li>Color: Negro.</li>\r\n<li>Tipo: Estéreo.</li>\r\n<li>Peso: 8 gramos.</li>\r\n<li>Macho: 1 de 3.5mm.</li>\r\n<li>Hembra: 2 de 6.3mm.</li>\r\n<li>Material: Plástico moldeado.</li>\r\n</ol>', 1, 3, 5, 'Generico', 0, 0, '35-235.jpg', 'default.jpg', 'default.jpg', 1, 0),
(25, 'Kit De Destornilladores Para Celulares 21 Piezas', 4150, 12, '<p style="text-align: justify;">Kit de Destornilladores con 21 piezas, ideal para equipos electrónicos de tamaño pequeño a mediano.</p>', 1, 4, 10, 'Security', 0, 0, 'destornilladorSecur.jpg', 'default.jpg', 'default.jpg', 1, 0),
(26, 'Afeitadora Wahl Beard Battery Trimmer', 79000, 3, '<h2 style="text-align: center;"><span style="color: #ff0000;">Afeitadora Wahl Beard Battery Trimmer</span></h2>\r\n<p> </p>\r\n<p><strong>Acerca del producto:</strong></p>\r\n<ol>\r\n<li>Rasuradora con guí­a de cinco posiciones permite crear ajustes precisos y miradas.</li>\r\n<li>Acero de alto carbono mantiene la nitidez.</li>\r\n<li>Base de almacenamiento, para guardar las piezas organizadas y al alcance.</li>\r\n<li>Bono condensador de ajuste personal incluido para el oí­do, la nariz y la frente.</li>\r\n<li>Funciona con pilas, esta Rasuradora compacto es ideal para los viajes.</li>\r\n<li>Una guí­a peine de 6 posiciones permite dar forma a su vello facial a una longitud que más le convenga.</li>\r\n</ol>', 1, 4, 12, 'Whal', 1, 75800, 'wahl.jpg', 'wahl1.jpg', 'wahl3.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_categoria` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `id_categoria`) VALUES
(1, 'PlayStation', 1),
(2, 'Nintendo', 1),
(3, 'De Automovil', 2),
(4, 'Portatiles', 2),
(5, 'De Sonido', 3),
(6, 'De Videojuegos', 3),
(7, 'Microsoft', 1),
(8, 'De Computacion', 3),
(9, 'Munecos', 4),
(10, 'Herramientas', 4),
(11, 'De Tv', 3),
(12, 'Otros Productos', 4),
(13, 'De Tablets', 3),
(14, 'Pilas y Baterias', 4),
(15, 'Juegos', 3),
(16, 'Controles', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `user` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `permisos` int(1) NOT NULL DEFAULT '0',
  `activo` int(1) NOT NULL DEFAULT '0',
  `keyreg` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keypass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `new_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ultima_conexion` int(32) NOT NULL DEFAULT '0',
  `no_leidos` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `name`, `pass`, `email`, `permisos`, `activo`, `keyreg`, `keypass`, `new_pass`, `ultima_conexion`, `no_leidos`) VALUES
(1, 'luisknd', 'Luis', 'c0784027b45aa11e848a38e890f8416c', 'luiscandelario41@gmail.com', 2, 1, '', '', '', 0, ''),
(2, 'cande', 'Rafael', 'c0784027b45aa11e848a38e890f8416c', 'luis-knd@hotmail.com', 0, 1, '', '', '', 0, ''),
(3, 'prueba', 'Candelario', 'c0784027b45aa11e848a38e890f8416c', 'luiscandelario4@gmail.com', 1, 1, '', '', '', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
