-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-07-2024 a las 19:22:06
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id22402896_catalogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre`) VALUES
(1, 'Ciencia Ficción'),
(2, 'Acción'),
(3, 'Drama'),
(4, 'Romance'),
(5, 'Crimen'),
(6, 'Aventura'),
(7, 'Biografía'),
(8, 'Comedia'),
(9, 'Terror'),
(10, 'Suspenso'),
(11, 'Historia'),
(12, 'Familia'),
(13, 'Guerra'),
(14, 'Western');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(10) UNSIGNED NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `director` varchar(120) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `anio` date DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `id_genero`, `titulo`, `director`, `sinopsis`, `duracion`, `anio`, `imagen`) VALUES
(1, 1, 'Inception', 'Christopher Nolan', 'Un ladrón que roba secretos corporativos a través del uso de la tecnología de compartición de sueños se le da la tarea inversa de plantar una idea en la mente de un CEO.', 148, '2010-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg'),
(2, 3, 'Titanic', 'James Cameron', 'Una historia de amor condenada entre una mujer joven de la alta sociedad y un artista pobre a bordo del lujoso e ill-fated R.M.S. Titanic.', 195, '1997-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg'),
(3, 3, 'Pulp Fiction', 'Quentin Tarantino', 'Las vidas de dos matones, un boxeador, la esposa de un gángster y un par de bandidos se entrelazan en cuatro historias de violencia y redención.', 154, '1994-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg'),
(4, 1, 'Jurassic Park', 'Steven Spielberg', 'Un parque temático de dinosaurios sufre una gran caída cuando un fallo en el sistema de seguridad permite a los dinosaurios escapar y aterrorizar a los visitantes.', 127, '1993-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/oU7Oq2kFAAlGqbU4VoAE36g4hoI.jpg'),
(5, 3, 'The Departed', 'Martin Scorsese', 'Un joven policía encubierto y un topo en la policía intentan identificarse mutuamente mientras se infiltran en una organización de la mafia en Boston.', 151, '2006-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/nT97ifVT2J1yMQmeq20Qblg61T.jpg'),
(6, 7, 'The Wolf of Wall Street', 'Martin Scorsese', 'Basada en la historia real de Jordan Belfort, desde su ascenso a un rico corredor de valores que lleva una vida de corrupción y exceso en Wall Street hasta su caída.', 180, '2013-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/34m2tygAYBGqA9MXKhRDtzYd4MR.jpg'),
(7, 1, 'Interstellar', 'Christopher Nolan', 'Un equipo de exploradores viaja a través de un agujero de gusano en el espacio en un intento por asegurar el futuro de la humanidad.', 169, '2014-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg'),
(8, 1, 'Avatar', 'James Cameron', 'Un marine parapléjico es enviado a la luna Pandora en una misión única pero se debate entre seguir sus órdenes y proteger el mundo que siente que es su hogar.', 162, '2009-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/kyeqWdyUXW608qlYkRqosgbbJyK.jpg'),
(9, 9, 'The Shining', 'Stanley Kubrick', 'Un hombre se vuelve loco mientras trabaja como cuidador de invierno en un hotel aislado con su familia, que experimenta fenómenos sobrenaturales.', 146, '1980-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/9PtPnOJSH6pewElRlJPGqC5Gd3W.jpg'),
(10, 3, 'Goodfellas', 'Martin Scorsese', 'La historia real de Henry Hill, un joven que crece en el entorno del crimen organizado y sueña con convertirse en un gángster.', 146, '1990-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/aKuFiU82s5ISJpGZp7YkIr3kCUd.jpg'),
(11, 3, 'Fight Club', 'David Fincher', 'Un oficinista insomne y un vendedor de jabón forman un club de pelea clandestino que se convierte en algo mucho más.', 139, '1999-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg'),
(12, 3, 'Forrest Gump', 'Robert Zemeckis', 'La presidencia de Kennedy y Johnson, Vietnam, Watergate y otros eventos históricos se desarrollan desde la perspectiva de un hombre de Alabama con un IQ bajo pero buenas intenciones.', 142, '1994-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg'),
(13, 3, 'The Godfather', 'Francis Ford Coppola', 'El envejecido patriarca de una dinastía criminal en la Nueva York de los años 40 transfiere el control de su imperio clandestino a su hijo reacio.', 175, '1972-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/3bhkrj58Vtu7enYsRolD1fZdja1.jpg'),
(14, 3, 'Schindler\'s List', 'Steven Spielberg', 'En la Polonia ocupada por los nazis durante la Segunda Guerra Mundial, Oskar Schindler se convierte gradualmente en un empresario preocupado por salvar a sus empleados judíos.', 195, '1993-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/sF1U4EUQS8YHUYjNl3pMGNIQyr0.jpg'),
(15, 1, 'E.T. the Extra-Terrestrial', 'Steven Spielberg', 'Un niño se hace amigo de un extraterrestre que está varado en la Tierra y lo ayuda a regresar a su hogar mientras intenta mantenerlo en secreto del gobierno.', 115, '1982-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/an0nD6uq6byfxXCfk6lQBzdL2J1.jpg'),
(16, 2, 'The Dark Knight', 'Christopher Nolan', 'Batman se enfrenta a su mayor desafío cuando el Joker aparece y amenaza con sumir a Gotham en el caos.', 152, '2008-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qJ2tW6WMUDux911r6m7haRef0WH.jpg'),
(17, 3, 'Inglourious Basterds', 'Quentin Tarantino', 'En la Francia ocupada por los nazis durante la Segunda Guerra Mundial, un grupo de soldados judíos aliados conocido como \"The Basterds\" planea asesinar a líderes nazis.', 153, '2009-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7sfbEnaARXDDhKm0CZ7D7uc2sbo.jpg'),
(18, 7, 'Catch Me If You Can', 'Steven Spielberg', 'La historia real de Frank Abagnale Jr., quien antes de cumplir 19 años se hizo pasar por piloto de avión, médico y abogado mientras realizaba estafas millonarias.', 141, '2002-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ctjEj2xM32OvBXCq8zAdK3ZrsAj.jpg'),
(19, 1, 'The Matrix', '', 'Un programador descubre la verdad inquietante sobre su realidad y su papel en la guerra contra sus controladores.', 136, '1999-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg'),
(20, 14, 'Django Unchained', '', 'Con la ayuda de un cazarrecompensas alemán, un esclavo liberado se propone rescatar a su esposa de un brutal dueño de plantación en Mississippi.', 165, '2012-01-01', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/bV0rWoiRo7pHUTQkh6Oio6irlXO.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`),
  ADD KEY `id_genero` (`id_genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
