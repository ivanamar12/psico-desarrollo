-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-01-2025 a las 10:32:31
-- Versión del servidor: 10.11.6-MariaDB-0+deb12u1
-- Versión de PHP: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedente_medicos`
--

CREATE TABLE `antecedente_medicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enfermedad_infecciosa` varchar(255) NOT NULL,
  `tipo_enfermedad_infecciosa` varchar(255) NOT NULL,
  `enfermedad_no_infecciosa` varchar(255) NOT NULL,
  `tipo_enfermedad_no_infecciosa` varchar(255) NOT NULL,
  `enfermedad_cronica` varchar(255) NOT NULL,
  `tipo_enfermedad_cronica` varchar(255) NOT NULL,
  `discapacidad` varchar(255) NOT NULL,
  `tipo_discapacidad` varchar(255) NOT NULL,
  `otros` varchar(600) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `antecedente_medicos`
--

INSERT INTO `antecedente_medicos` (`id`, `enfermedad_infecciosa`, `tipo_enfermedad_infecciosa`, `enfermedad_no_infecciosa`, `tipo_enfermedad_no_infecciosa`, `enfermedad_cronica`, `tipo_enfermedad_cronica`, `discapacidad`, `tipo_discapacidad`, `otros`, `created_at`, `updated_at`) VALUES
(1, 'no', 'no aplica', 'si', 'fiebre', 'no', 'no aplica', 'no', 'no aplica', 'no aplica', '2024-12-07 15:48:30', '2024-12-07 15:48:30'),
(2, 'si', 'malaria', 'si', 'virus', 'no', 'no aplica', 'si', 'visual', 'aun no camina', '2024-12-10 03:15:33', '2024-12-10 03:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_desarrollos`
--

CREATE TABLE `area_desarrollos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_desarrollo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `area_desarrollos`
--

INSERT INTO `area_desarrollos` (`id`, `area_desarrollo`, `created_at`, `updated_at`) VALUES
(1, 'Cognitiva', '2024-11-30 14:15:34', '2024-11-30 14:15:34'),
(2, 'Lenguaje', '2024-12-02 03:34:35', '2024-12-02 03:34:35'),
(3, 'Motricidad gruesa', '2024-12-04 23:53:29', '2024-12-04 23:53:29'),
(4, 'Psicomotricidad', '2025-01-19 11:33:51', '2025-01-19 11:33:51'),
(5, 'Desarrollo Verbal', '2025-01-19 11:34:33', '2025-01-19 11:34:33'),
(6, 'Desarrollo no Verbal', '2025-01-19 11:34:46', '2025-01-19 11:34:46'),
(7, 'Lenguaje Articulatorio', '2025-01-19 11:35:01', '2025-01-19 11:35:01'),
(8, 'Lenguaje Expresivo', '2025-01-19 11:35:43', '2025-01-19 11:35:43'),
(9, 'Lenguaje Comprensivo', '2025-01-19 11:36:02', '2025-01-19 11:36:02'),
(10, 'Estructuracion Espacial', '2025-01-19 11:36:32', '2025-01-19 11:36:32'),
(11, 'Visopercepcion', '2025-01-19 11:36:46', '2025-01-19 11:36:46'),
(12, 'Memoria Iconica', '2025-01-19 11:37:04', '2025-01-19 11:37:04'),
(13, 'Ritmo', '2025-01-19 11:37:18', '2025-01-19 11:37:18'),
(14, 'Fluidez Verbal', '2025-01-19 11:37:38', '2025-01-19 11:37:38'),
(15, 'Atencion', '2025-01-19 11:37:54', '2025-01-19 11:37:54'),
(16, 'Lectura', '2025-01-19 11:38:11', '2025-01-19 11:38:11'),
(17, 'Escritura', '2025-01-19 11:38:26', '2025-01-19 11:38:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencions`
--

CREATE TABLE `atencions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `atencions`
--

INSERT INTO `atencions` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(28, 12, '99', '19-20', '19-20', '19-20', '20', '20', 'NULL', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(29, 12, '98', '18', '18', '-', '19', '19', 'NULL', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(30, 12, '97', '17', '17', '18', '-', '-', '20', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(31, 12, '96', '16', '16', '-', '18', '-', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(32, 12, '95', '14-15', '13-15', '17', '-', '18', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(33, 12, '90', '11-13', '12', '15-16', '16-17', '17', '19', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(34, 12, '85', '10', '11', '14', '14-15', '16', '18', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(35, 12, '80', '9', '10', '13', '13', '15', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(36, 12, '75', '8', '9', '12', '-', '14', '17', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(37, 12, '70', '7', '-', '-', '12', '-', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(38, 12, '65', '6', '-', '11', '-', '13', '16', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(39, 12, '60', '5', '8', '10', '11', '-', '15', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(40, 12, '55', '-', '-', '-', '10', '12', '14', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(41, 12, '50', '4', '7', '9', '9', '-', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(42, 12, '45', '-', '-', '-', '-', '-', '13', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(43, 12, '40', '2-3', '6', '8', '8', '11', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(44, 12, '35', '1', '-', '-', '-', '10', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(45, 12, '30', '-', '5', '7', '-', '-', '12', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(46, 12, '25', '-', '-', '6', '7', '9', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(47, 12, '20', '-', '4', '-', '6', '8', '11', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(48, 12, '15', '0', '2-3', '5', '5', '7', '9-10', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(49, 12, '10', 'NULL', '1', '-', '4', '6', '8', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(50, 12, '5', 'NULL', '0', '4', '3', '5', '6-7', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(51, 12, '4', 'NULL', 'NULL', '3', '2', '3-4', '5', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(52, 12, '3', 'NULL', 'NULL', '2', '1', '2', '-', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(53, 12, '2', 'NULL', 'NULL', '-', '0', '1', '1-4', '2025-01-14 03:14:19', '2025-01-14 03:14:19'),
(54, 12, '1', 'NULL', 'NULL', '0', 'NULL', '0', '0', '2025-01-14 03:14:19', '2025-01-14 03:14:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `especialista_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_consulta` date NOT NULL,
  `hora` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `paciente_id`, `especialista_id`, `fecha_consulta`, `hora`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2024-12-11', '09:30', 'asistio', '2024-12-10 03:05:54', '2025-01-18 14:47:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_economicos`
--

CREATE TABLE `datos_economicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_vivienda` varchar(255) NOT NULL,
  `cantidad_habitaciones` varchar(255) NOT NULL,
  `cantidad_personas` varchar(255) NOT NULL,
  `servecio_agua_potable` varchar(255) NOT NULL,
  `servecio_gas` varchar(255) NOT NULL,
  `servecio_electricidad` varchar(255) NOT NULL,
  `servecio_drenaje` varchar(255) NOT NULL,
  `disponibilidad_internet` varchar(255) NOT NULL,
  `tipo_conexion_internet` varchar(255) NOT NULL,
  `acceso_servcios_publicos` varchar(255) NOT NULL,
  `fuente_ingreso_familiar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_economicos`
--

INSERT INTO `datos_economicos` (`id`, `tipo_vivienda`, `cantidad_habitaciones`, `cantidad_personas`, `servecio_agua_potable`, `servecio_gas`, `servecio_electricidad`, `servecio_drenaje`, `disponibilidad_internet`, `tipo_conexion_internet`, `acceso_servcios_publicos`, `fuente_ingreso_familiar`, `created_at`, `updated_at`) VALUES
(1, 'casa_unifamiliar', '3', '3', 'si', 'si', 'si', 'si', 'no', 'no', 'si', 'sector privado', '2024-12-07 15:43:25', '2024-12-07 15:43:25'),
(2, 'casa_unifamiliar', '3', '4', 'si', 'no', 'si', 'si', 'si', 'wi fi', 'si', '500', '2024-12-10 03:05:07', '2024-12-10 03:05:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollo_globals`
--

CREATE TABLE `desarrollo_globals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prueba` varchar(255) NOT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `desarrollo_globals`
--

INSERT INTO `desarrollo_globals` (`id`, `prueba`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'CUMANIN', '99', '48-86', '59-86', '66-86', '75-86', '76-86', '81-86', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:02', '2025-01-07 04:32:02'),
(2, 'CUMANIN', '98', '47', '55-58', '65', '74', '75', '80', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:02', '2025-01-07 04:32:02'),
(3, 'CUMANIN', '97', '43-46', '54', '64', '73', '74', '79', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:02', '2025-01-07 04:32:02'),
(4, 'CUMANIN', '96', '-', '53', '63', '72', '73', '78', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(5, 'CUMANIN', '95', '40-42', '50-52', '59-62', '69-71', '72', '77', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(6, 'CUMANIN', '90', '37-39', '46-49', '58', '65-68', '70-71', '75-76', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(7, 'CUMANIN', '85', '36', '44-45', '54-57', '62-64', '67-69', '73-74', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(8, 'CUMANIN', '80', '35', '44-43', '51-53', '60-61', '66', '72', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(9, 'CUMANIN', '75', '32-34', '40', '50', '59', '64-65', '71', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(10, 'CUMANIN', '70', '30-31', '38-39', '48-49', '57-58', '63', '69-70', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(11, 'CUMANIN', '65', '28-29', '36-37', '47', '55-56', '62', '68', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(12, 'CUMANIN', '60', '26-27', '34-35', '44-46', '53-54', '61', '67', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(13, 'CUMANIN', '55', '23-25', '32-33', '42-43', '52', '60', '65-66', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(14, 'CUMANIN', '50', '21-22', '30-31', '41', '49-51', '58-59', '64', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(15, 'CUMANIN', '45', '19-20', '29', '40', '47-48', '57', '-', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(16, 'CUMANIN', '40', '18', '28', '38-39', '45-46', '56', '61-62', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(17, 'CUMANIN', '35', '17', '27', '37', '43-44', '55', '63', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(18, 'CUMANIN', '30', '15-16', '26', '35-36', '40-42', '52-54', '60', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(19, 'CUMANIN', '25', '14', '24-25', '32-34', '37-39', '50-51', '58-59', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(20, 'CUMANIN', '20', '12-13', '22-23', '31', '34-36', '48-49', '56-57', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(21, 'CUMANIN', '15', '9-11', '18-21', '28-30', '32-33', '43-47', '54-55', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(22, 'CUMANIN', '10', '5-8', '16-17', '23-27', '27-31', '33-42', '48-53', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(23, 'CUMANIN', '5', '3-4', '11-15', '17-22', '22-26', '22-32', '44-47', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(24, 'CUMANIN', '4', '2', '10', '16', '19-21', '19-21', '40-43', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(25, 'CUMANIN', '3', '-', '8-9', '15', '18', '11-18', '38-39', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(26, 'CUMANIN', '2', '1', '1-7', '14', '16-17', '9-10', '37', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03'),
(27, 'CUMANIN', '1', '0', '0', '0-13', '0-15', '0-8', '0-36', 'Puntuacion de los 83 elementos', '2025-01-07 04:32:03', '2025-01-07 04:32:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollo_no_verbals`
--

CREATE TABLE `desarrollo_no_verbals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `desarrollo_no_verbals`
--

INSERT INTO `desarrollo_no_verbals` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 2, '99', '27-58', '35-58', '41-58', '46-58', '47-58', '49-58', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(2, 2, '98', '26', '34', '40', '44-45', '46', '48', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(3, 2, '97', '-', '-', '38-39', '43', '-', '-', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(4, 2, '96', '25', '33', '37', '42', '45', '-', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(5, 2, '95', '23-24', '31-32', '36', '41', '43-44', '47', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(6, 2, '90', '22', '29-30', '35', '40', '42', '45-46', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(7, 2, '85', '21', '27-28', '32-34', '38-39', '41', '44', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(8, 2, '80', '19-20', '26', '31', '36-37', '40', '43', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(9, 2, '75', '18', '25', '30', '34-35', '38-39', '42', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(10, 2, '70', '-', '23-24', '29', '33', '37', '-', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(11, 2, '65', '17', '22', '28', '32', '-', '41', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(12, 2, '60', '16', '-', '27', '-', '36', '40', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(13, 2, '55', '15', '21', '-', '30-31', '-', '-', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(14, 2, '50', '14', '20', '26', '29', '35', '39', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(15, 2, '45', '13', '19', '-', '28', '-', '38', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(16, 2, '40', '12', '18', '25', '27', '34', '37', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(17, 2, '35', '11', '17', '24', '26', '33', '36', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(18, 2, '30', '9-10', '16', '23', '25', '31-32', '35', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:26', '2025-01-07 16:23:26'),
(19, 2, '25', '8', '15', '21-22', '24', '29-30', '33-34', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(20, 2, '20', '8', '14', '20', '23', '28', '32', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(21, 2, '15', '-', '12-13', '19', '22', '27', '-', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(22, 2, '10', '6-7', '11', '18', '19-21', '24-26', '30-31', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(23, 2, '5', '3-5', '9-10', '14-17', '17-18', '19-23', '27-29', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(24, 2, '4', '2', '7-8', '-', '16', '15-18', '26', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(25, 2, '3', '-', '6', '13', '12-15', '14', '25', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(26, 2, '2', '0-1', '1-5', '-', '11', '11-13', '21-24', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27'),
(27, 2, '1', 'NULL', '0', '0-12', '0-10', '0-10', '0-20', 'Puntuacion en los elementos de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo', '2025-01-07 16:23:27', '2025-01-07 16:23:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollo_verbals`
--

CREATE TABLE `desarrollo_verbals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `desarrollo_verbals`
--

INSERT INTO `desarrollo_verbals` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, '99', '25-28', '24-28', '26-28', '27-28', '26-28', '28', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(2, 1, '98', '-', '-', '25', '-', '-', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(3, 1, '97', '24', '23', '-', '-', '-', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(4, 1, '96', '-', '-', '-', '26', '-', '27', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(5, 1, '95', '22-23', '22', '24', '25', '-', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(6, 1, '90', '21', '-', '23', '-', '25', '26', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(7, 1, '85', '19-20', '21', '-', '24', '24', '25', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(8, 1, '80', '18', '20', '22', '-', '-', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(9, 1, '75', '17', '-', '21', '23', '23', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(10, 1, '70', '15-16', '19', '-', '22', '-', '24', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(11, 1, '65', '14', '18', '20', '-', '22', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(12, 1, '60', '12-13', '17', '18-19', '21', '-', '23', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(13, 1, '55', '11', '16', '17', '20', '-', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(14, 1, '50', '10', '14-15', '16', '19', '21', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(15, 1, '45', '9', '13', '15', '18', '-', '22', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(16, 1, '40', '8', '12', '14', '17', '20', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(17, 1, '35', '7', '11', '12-13', '16', '-', '21', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(18, 1, '30', '4', '10', '-', '15', '18-19', '20', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(19, 1, '25', '14', '9', '11', '13-14', '17', '19', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(20, 1, '20', '2-3', '8', '9-10', '12', '15-16', '-', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(21, 1, '15', '1', '6-7', '7-8', '10-11', '13-14', '18', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(22, 1, '10', '-', '4-5', '5-6', '8-9', '10-12', '16-17', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(23, 1, '5', '0', '3', '4', '6-7', '3-9', '13-15', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(24, 1, '4', 'NULL', '-', '-', '-', '2', '11-12', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(25, 1, '3', 'NULL', '1-2', '3', '5', '1', '10', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(26, 1, '2', 'NULL', '0', '2', '2-4', '-', '8-9', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:33', '2025-01-07 14:52:33'),
(27, 1, '1', 'NULL', 'NULL', '0-1', '0-1', '0', '0-7', 'Puntuacion en los elementos de las 3 escalas de lenguaje: articulatorio, comprensivo y expresivo', '2025-01-07 14:52:34', '2025-01-07 14:52:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dibujo_figura_humanas`
--

CREATE TABLE `dibujo_figura_humanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `items` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `masculino_5_años` varchar(255) NOT NULL,
  `femenino_5_años` varchar(255) NOT NULL,
  `masculino_6_años` varchar(255) NOT NULL,
  `femenino_6_años` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dibujo_figura_humanas`
--

INSERT INTO `dibujo_figura_humanas` (`id`, `sub_escala_id`, `items`, `nivel`, `masculino_5_años`, `femenino_5_años`, `masculino_6_años`, `femenino_6_años`, `created_at`, `updated_at`) VALUES
(1, 15, 'Cabeza', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(2, 15, 'Ojos', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(3, 15, 'Nariz', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(4, 15, 'Boca', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(5, 15, 'Cuerpo', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(6, 15, 'Piernas', 'Esperado', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(7, 15, 'Brazos', 'Esperado', '-', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(8, 15, 'pies', 'Esperado', '-', '-', '-', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(9, 15, 'Rodilla', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(10, 15, 'Perfil', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(11, 15, 'Codo', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(12, 15, 'Dos Labios', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(13, 15, 'Fosas Nasales', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(14, 15, 'Proporciones', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(15, 15, 'Braz. u. Homb.', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(16, 15, 'Ropa: 4 prendas', 'Excepcional', 'X', 'X', 'X', 'X', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(17, 15, 'Pies 2', 'Excepcional', 'X', 'X', '-', '-', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(18, 15, 'Cinco dedos', 'Excepcional', 'X', '-', '-', '-', '2025-01-15 15:21:23', '2025-01-15 15:21:23'),
(19, 15, 'Pupilas', 'Excepcional', 'X', '-', '-', '-', '2025-01-15 15:21:23', '2025-01-15 15:21:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccions`
--

CREATE TABLE `direccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `municipio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parroquia_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sector` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direccions`
--

INSERT INTO `direccions` (`id`, `estado_id`, `municipio_id`, `parroquia_id`, `sector`, `created_at`, `updated_at`) VALUES
(2, 4, 37, 115, 'la curia', '2024-12-10 02:57:18', '2024-12-10 02:57:18'),
(3, 7, 79, 262, 'el mono', '2024-12-10 02:59:52', '2024-12-10 02:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escrituras`
--

CREATE TABLE `escrituras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-72 meses` varchar(255) NOT NULL,
  `73-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `escrituras`
--

INSERT INTO `escrituras` (`id`, `sub_escala_id`, `percentil`, `61-66 meses`, `67-72 meses`, `73-78 meses`, `created_at`, `updated_at`) VALUES
(1, 14, '99', '7-12', '12', '12', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(2, 14, '98', '6', '-', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(3, 14, '97', '5', '-', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(4, 14, '96', '4', '-', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(5, 14, '95', '3', '11', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(6, 14, '90', '2', '10', '11', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(7, 14, '85', '-', '9', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(8, 14, '80', '1', '7-8', '10', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(9, 14, '75', '-', '4-6', '9', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(10, 14, '70', '-', '1-3', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(11, 14, '65', '-', '1-2', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(12, 14, '60', '-', '-', '8', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(13, 14, '55', '0', '-', '7', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(14, 14, '50', '-', '-', '6', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(15, 14, '45', '-', '-', '5', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(16, 14, '40', '0', '-', '3-4', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(17, 14, '35', 'NULL', '0', '2', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(18, 14, '30', 'NULL', 'NULL', '1', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(19, 14, '25', 'NULL', 'NULL', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(20, 14, '20', 'NULL', 'NULL', '-', '2025-01-14 14:28:26', '2025-01-14 14:28:26'),
(21, 14, '15', 'NULL', 'NULL', '0', '2025-01-14 14:28:26', '2025-01-14 14:28:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidads`
--

CREATE TABLE `especialidads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `especialidad` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidads`
--

INSERT INTO `especialidads` (`id`, `especialidad`, `created_at`, `updated_at`) VALUES
(1, 'psicologia infantil', '2024-12-10 02:54:07', '2024-12-10 02:54:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialistas`
--

CREATE TABLE `especialistas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `ci` varchar(30) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialistas`
--

INSERT INTO `especialistas` (`id`, `nombre`, `apellido`, `ci`, `fecha_nac`, `telefono`, `email`, `especialidad_id`, `genero_id`, `direccion_id`, `created_at`, `updated_at`) VALUES
(1, 'juan', 'machado', '8741931', '1977-11-22', '04123591123', 'Jm@gmail.com', 1, 1, 2, '2024-12-10 02:57:18', '2024-12-10 02:57:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(30) NOT NULL,
  `iso_3166-2` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`, `iso_3166-2`, `created_at`, `updated_at`) VALUES
(1, 'Amazonas', 'VE-X', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(2, 'Anzoátegui', 'VE-B', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(3, 'Apure', 'VE-C', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(4, 'Aragua', 'VE-D', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(5, 'Barinas', 'VE-E', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(6, 'Bolívar', 'VE-F', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(7, 'Carabobo', 'VE-G', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(8, 'Cojedes', 'VE-H', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(9, 'Delta Amacuro', 'VE-Y', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(10, 'Falcón', 'VE-I', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(11, 'Guárico', 'VE-J', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(12, 'Lara', 'VE-K', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(13, 'Mérida', 'VE-L', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(14, 'Miranda', 'VE-M', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(15, 'Monagas', 'VE-N', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(16, 'Nueva Esparta', 'VE-O', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(17, 'Portuguesa', 'VE-P', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(18, 'Sucre', 'VE-R', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(19, 'Táchira', 'VE-S', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(20, 'Trujillo', 'VE-T', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(21, 'Vargas', 'VE-W', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(22, 'Yaracuy', 'VE-U', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(23, 'Zulia', 'VE-V', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(24, 'Distrito Capital', 'VE-A', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(25, 'Dependencias Federales', 'VE-Z', '2024-11-30 14:07:29', '2024-11-30 14:07:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estructuracion_esapacials`
--

CREATE TABLE `estructuracion_esapacials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estructuracion_esapacials`
--

INSERT INTO `estructuracion_esapacials` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 7, '99', '9-15', '11-15', '12-15', '12-15', '12-15', '13-15', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(2, 7, '98', '-', '-', '-', '-', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(3, 7, '97', '-', '10', '-', '-', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(4, 7, '96', '-', '-', '-', '-', '-', '12', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(5, 7, '95', '8', '-', '11', '11', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(6, 7, '90', '-', '9', '10', '-', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(7, 7, '85', '7', '-', '-', '-', '11', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(8, 7, '80', '-', '8', '9', '10', '-', '11', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(9, 7, '75', '-', '-', '-', '-', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(10, 7, '70', '6', '-', '-', '9', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(11, 7, '65', '-', '7', '8', '-', '10', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(12, 7, '60', '-', '-', '-', '8', '-', '10', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(13, 7, '55', '-', '-', '-', '-', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(14, 7, '50', '5', '6', '7', '-', '9', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(15, 7, '45', '-', '-', '-', '7', '-', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(16, 7, '40', '4', '-', '-', '-', '-', '9', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(17, 7, '35', '-', '-', '-', '-', '8', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(18, 7, '30', '3', '5', '6', '6', '-', '8', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(19, 7, '25', '-', '-', '-', '-', '7', '7', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(20, 7, '20', '2', '4', '5', '-', '6', '6', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(21, 7, '15', '1', '-', '-', '5', '5', '5', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(22, 7, '10', '-', '2-3', '4', '4', '4', '4', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(23, 7, '5', '0', '1', '-', '-', '3', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(24, 7, '4', 'NULL', '-', '3', '-', '2', '-', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(25, 7, '3', 'NULL', '0', '2', '3', '1', '3', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(26, 7, '2', 'NULL', 'NULL', '1', '1-2', '-', '1-2', '2025-01-10 21:56:25', '2025-01-10 21:56:25'),
(27, 7, '1', 'NULL', 'NULL', '0', '0', '0', '0', '2025-01-10 21:56:25', '2025-01-10 21:56:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fluidez_verbals`
--

CREATE TABLE `fluidez_verbals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fluidez_verbals`
--

INSERT INTO `fluidez_verbals` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 11, '99', '8-99', '31-99', '34-99', '43-99', '39-99', '48-99', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(2, 11, '98', '6-7', '24-30', '30-33', '41-42', '38', '45-47', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(3, 11, '97', '5', '21-23', '26-29', '38-40', '36-37', '40-44', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(4, 11, '96', '-', '18-20', '25', '35-37', '35', '38-39', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(5, 11, '95', '4', '16-17', '21-24', '32-34', '32-34', '34-37', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(6, 11, '90', '1-3', '12-15', '20', '27-31', '27-31', '32-33', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(7, 11, '85', '-', '11', '17-19', '25-26', '25-26', '29-31', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(8, 11, '80', '-', '9-10', '12-16', '20-24', '22-24', '27-28', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(9, 11, '75', '-', '6-8', '11', '17-19', '20-21', '25-26', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(10, 11, '70', '-', '5', '9-10', '14-16', '19', '24', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(11, 11, '65', '-', '1-4', '7-8', '12-13', '18', '23', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(12, 11, '60', '-', '-', '6', '9-11', '16-17', '22', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(13, 11, '55', '-', '-', '1-5', '5-8', '12-15', '21', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(14, 11, '50', '-', '-', '-', '4', '11', '20', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(15, 11, '45', '0', '-', '-', '1-3', '9-10', '19', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(16, 11, '40', 'NULL', '-', '-', '-', '8', '18', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(17, 11, '35', 'NULL', '0', '-', '-', '7', '16-17', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(18, 11, '30', 'NULL', 'NULL', '0', '-', '5-6', '12-15', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(19, 11, '25', 'NULL', 'NULL', 'NULL', '0', '1-4', '10-11', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(20, 11, '20', 'NULL', 'NULL', 'NULL', 'NULL', '-', '9', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(21, 11, '15', 'NULL', 'NULL', 'NULL', 'NULL', '-', '3-8', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(22, 11, '10', 'NULL', 'NULL', 'NULL', 'NULL', '0', '1-2', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(23, 11, '5', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(24, 11, '4', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(25, 11, '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(26, 11, '2', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(27, 11, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-13 22:19:25', '2025-01-13 22:19:25'),
(28, 11, '99', '8-99', '31-99', '34-99', '43-99', '39-99', '48-99', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(29, 11, '98', '6-7', '24-30', '30-33', '41-42', '38', '45-47', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(30, 11, '97', '5', '21-23', '26-29', '38-40', '36-37', '40-44', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(31, 11, '96', '-', '18-20', '25', '35-37', '35', '38-39', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(32, 11, '95', '4', '16-17', '21-24', '32-34', '32-34', '34-37', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(33, 11, '90', '1-3', '12-15', '20', '27-31', '27-31', '32-33', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(34, 11, '85', '-', '11', '17-19', '25-26', '25-26', '29-31', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(35, 11, '80', '-', '9-10', '12-16', '20-24', '22-24', '27-28', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(36, 11, '75', '-', '6-8', '11', '17-19', '20-21', '25-26', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(37, 11, '70', '-', '5', '9-10', '14-16', '19', '24', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(38, 11, '65', '-', '1-4', '7-8', '12-13', '18', '23', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(39, 11, '60', '-', '-', '6', '9-11', '16-17', '22', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(40, 11, '55', '-', '-', '1-5', '5-8', '12-15', '21', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(41, 11, '50', '-', '-', '-', '4', '11', '20', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(42, 11, '45', '0', '-', '-', '1-3', '9-10', '19', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(43, 11, '40', 'NULL', '-', '-', '-', '8', '18', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(44, 11, '35', 'NULL', '0', '-', '-', '7', '16-17', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(45, 11, '30', 'NULL', 'NULL', '0', '-', '5-6', '12-15', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(46, 11, '25', 'NULL', 'NULL', 'NULL', '0', '1-4', '10-11', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(47, 11, '20', 'NULL', 'NULL', 'NULL', 'NULL', '-', '9', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(48, 11, '15', 'NULL', 'NULL', 'NULL', 'NULL', '-', '3-8', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(49, 11, '10', 'NULL', 'NULL', 'NULL', 'NULL', '0', '1-2', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(50, 11, '5', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(51, 11, '4', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(52, 11, '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(53, 11, '2', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-14 02:41:40', '2025-01-14 02:41:40'),
(54, 11, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-14 02:41:40', '2025-01-14 02:41:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genero` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`, `created_at`, `updated_at`) VALUES
(1, 'Masculino', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(2, 'Femenino', '2024-11-30 14:07:56', '2024-11-30 14:07:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinicas`
--

CREATE TABLE `historia_clinicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `historia_desarrollo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `antecedente_medico_id` bigint(20) UNSIGNED DEFAULT NULL,
  `historia_escolar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `especialista_refirio` varchar(255) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historia_clinicas`
--

INSERT INTO `historia_clinicas` (`id`, `paciente_id`, `historia_desarrollo_id`, `antecedente_medico_id`, `historia_escolar_id`, `codigo`, `referencia`, `especialista_refirio`, `motivo`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 2, 2, 'HIS83975', 'pediatria', 'pediatra', 'alto riesgo biológco', '2024-12-10 03:15:33', '2024-12-10 03:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_desarrollos`
--

CREATE TABLE `historia_desarrollos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicamento_embarazo` varchar(255) NOT NULL,
  `tipo_medicamento` varchar(800) NOT NULL,
  `fumo_embarazo` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `alcohol_embarazo` varchar(255) NOT NULL,
  `tipo_alcohol` varchar(255) NOT NULL,
  `cantidad_consumia_alcohol` varchar(255) NOT NULL,
  `droga_embarazo` varchar(255) NOT NULL,
  `tipo_droga` varchar(255) NOT NULL,
  `forceps_parto` varchar(255) NOT NULL,
  `cesarea` varchar(255) NOT NULL,
  `razon_cesarea` varchar(900) NOT NULL,
  `niño_prematuro` varchar(255) NOT NULL,
  `meses_prematuro` varchar(255) NOT NULL,
  `peso_nacer_niño` varchar(255) NOT NULL,
  `complicaciones_nacer` varchar(255) NOT NULL,
  `tipo_complicacion` varchar(900) NOT NULL,
  `problema_alimentacion` varchar(255) NOT NULL,
  `tipo_problema_alimenticio` varchar(900) NOT NULL,
  `problema_dormir` varchar(255) NOT NULL,
  `tipo_problema_dormir` varchar(900) NOT NULL,
  `tranquilo_recien_nacido` varchar(255) NOT NULL,
  `gustaba_cargaran_recien_nacido` varchar(255) NOT NULL,
  `alerta_recien_nacido` varchar(255) NOT NULL,
  `problemas_desarrollo_primeros_años` varchar(255) NOT NULL,
  `cuales_problemas` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historia_desarrollos`
--

INSERT INTO `historia_desarrollos` (`id`, `medicamento_embarazo`, `tipo_medicamento`, `fumo_embarazo`, `cantidad`, `alcohol_embarazo`, `tipo_alcohol`, `cantidad_consumia_alcohol`, `droga_embarazo`, `tipo_droga`, `forceps_parto`, `cesarea`, `razon_cesarea`, `niño_prematuro`, `meses_prematuro`, `peso_nacer_niño`, `complicaciones_nacer`, `tipo_complicacion`, `problema_alimentacion`, `tipo_problema_alimenticio`, `problema_dormir`, `tipo_problema_dormir`, `tranquilo_recien_nacido`, `gustaba_cargaran_recien_nacido`, `alerta_recien_nacido`, `problemas_desarrollo_primeros_años`, `cuales_problemas`, `created_at`, `updated_at`) VALUES
(1, 'no', 'no aplica', 'no', 'no aplica', 'no', 'no', 'no', 'no', 'no aplica', 'no', 'si', 'se adelanto el parto', 'si', '7 meses', '2 kg', 'si', 'encuvadora 2 semanas', 'no', 'no', 'no', 'no aplica', 'si', 'si', 'no', 'no', 'no aplica', '2024-12-07 15:48:30', '2024-12-07 15:48:30'),
(2, 'si', 'cloroquina', 'si', 'media caja cada tres días', 'si', 'cerveza', '5 al mes', 'no', 'no aplica', 'no', 'no', 'no aplica', 'si', 'a termino', '2300', 'no', 'no aplica', 'si', 'no succionó', 'si', 'sueño invertido', 'no', 'si', 'si', 'si', 'disminución del peso', '2024-12-10 03:15:33', '2024-12-10 03:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_escolars`
--

CREATE TABLE `historia_escolars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `escolarizado` varchar(255) NOT NULL,
  `tipo_educaion` varchar(255) NOT NULL,
  `tutoria_terapias` varchar(255) NOT NULL,
  `tutoria_terapias_cuales` varchar(255) NOT NULL,
  `dificultad_lectura` varchar(255) NOT NULL,
  `dificultad_aritmetica` varchar(255) NOT NULL,
  `dificultad_escribir` varchar(255) NOT NULL,
  `agrada_escuela` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historia_escolars`
--

INSERT INTO `historia_escolars` (`id`, `escolarizado`, `tipo_educaion`, `tutoria_terapias`, `tutoria_terapias_cuales`, `dificultad_lectura`, `dificultad_aritmetica`, `dificultad_escribir`, `agrada_escuela`, `created_at`, `updated_at`) VALUES
(1, 'no', 'no aplica', 'no', 'no aplica', 'no', 'no', 'no', 'no', '2024-12-07 15:48:30', '2024-12-07 15:48:30'),
(2, 'no', 'no aplica', 'no', 'no aplica', 'no', 'no', 'no', 'no', '2024-12-10 03:15:33', '2024-12-10 03:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
--

CREATE TABLE `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `puntaje_dfh` varchar(255) NOT NULL,
  `nivel_capacidad_mental` varchar(255) NOT NULL,
  `CI` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
--

INSERT INTO `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s` (`id`, `puntaje_dfh`, `nivel_capacidad_mental`, `CI`, `created_at`, `updated_at`) VALUES
(1, '8-7', 'Normal alto a superior', '110 o mas', '2025-01-15 16:25:35', '2025-01-15 16:25:35'),
(2, '6', 'Normal a superior', '90-135', '2025-01-15 16:25:36', '2025-01-15 16:25:36'),
(3, '5', 'Normal  alto', '85-120', '2025-01-15 16:25:36', '2025-01-15 16:25:36'),
(4, '4', 'Normal bajo a normal', '80-110', '2025-01-15 16:25:36', '2025-01-15 16:25:36'),
(5, '3', 'Normal bajo', '70-90', '2025-01-15 16:25:36', '2025-01-15 16:25:36'),
(6, '2', 'Bordeline', '60-80', '2025-01-15 16:25:36', '2025-01-15 16:25:36'),
(7, '1-0', 'Deficiente o Funcionando en un nivel deficiente debido a problemas emocionales', '-', '2025-01-15 16:25:36', '2025-01-15 16:25:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_pruebas`
--

CREATE TABLE `item_pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) NOT NULL,
  `prueba_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `item_pruebas`
--

INSERT INTO `item_pruebas` (`id`, `item`, `prueba_id`, `created_at`, `updated_at`) VALUES
(1, 'Reacciona ante el sonido de la maraca y la retiene al colocársela en la mano', 1, '2024-11-30 14:53:09', '2024-11-30 14:53:09'),
(2, 'Observa el aro en línea media a aproximadamente 20 cms.', 1, '2024-11-30 14:53:09', '2024-11-30 14:53:09'),
(3, 'Busca la fuente sonora del sonido de la maraca', 2, '2024-11-30 14:57:29', '2024-11-30 14:57:29'),
(4, 'Sigue incompleto el movimiento horizontal y vertical del aro', 2, '2024-11-30 14:57:29', '2024-11-30 14:57:29'),
(5, 'Agarra la maraca al colocársela en la mano', 3, '2024-11-30 15:05:43', '2024-11-30 15:05:43'),
(6, 'Sigue el aro en forma circular', 3, '2024-11-30 15:05:43', '2024-11-30 15:05:43'),
(7, 'Reacciona ante la desaparición del rostro del cuidador', 3, '2024-11-30 15:05:43', '2024-11-30 15:05:43'),
(8, 'Agarra la maraca que está frente a él y se la lleva a la boca', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(9, 'Agarra el aro cuando se lo colocan cerca de las manos y lo lleva a la boca', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(10, 'Reacciona ante la desaparición del rostro del cuidador', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(11, 'En forma refleja, repite movimientos con la boca sin producir sonidos', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(12, 'Alcanza un taco con una mano cuando se le ofrece en línea media', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(13, 'Mira su imagen en el espejo y se ríe', 4, '2024-11-30 15:13:32', '2024-11-30 15:13:32'),
(14, 'Agita la maraca para producir el sonido momentáneamente', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(15, 'Alcanza el aro por sí mismo cuando se le coloca en línea media', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(16, 'Reacciona ante la desaparición del rostro del cuidador', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(17, 'Presta atención a objetos pequeños, por ejemplo una pastilla', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(18, 'En forma refleja, repite movimientos con la boca sin producir sonidos', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(19, 'Alcanza un segundo taco con la mano', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(20, 'Mira su imagen en el espejo y se ríe', 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(21, 'Se distrae por más tiempo agitando la maraca', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(22, 'Agarra el aro y lo pasa de una mano a otra', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(23, 'Sigue con la vista una cuchara que se cae de la mesa', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(24, 'Presta atención a objetos pequeños, por ejemplo una pastilla', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(25, 'Imita con intención un modelo. Por ejemplo abrir la boca, sacar la lengua', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(26, 'Sostiene un taco en cada mano y ve el tercero', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(27, 'Mira su imagen en el espejo y se ríe', 6, '2024-11-30 15:28:02', '2024-11-30 15:28:02'),
(28, 'Agita la maraca y la pasa de un lado a otro', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(29, 'Hala el cordón y manipula el aro para explorarlo', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(30, 'Se desentiende de un objeto si no lo ve', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(31, 'Se fija en la pastilla intenta agarrarla', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(32, 'Disfruta imitando acciones, ejemplo sonar una maraca , o en la noche prender y apagar la luz', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(33, 'Sostiene un taco en cada mano y suelta uno para agarrar el tercero', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(34, 'Juega con su imagen en el espejo', 7, '2024-11-30 15:31:36', '2024-11-30 15:31:36'),
(35, 'Busca la maraca cuando está afuera de su alcance para agitarla', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(36, 'Acciona el cordón de un juguete musical', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(37, 'Busca a su cuidador cuando se esconde al frente de él', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(38, 'Se fija en la pastilla intenta agarrarla', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(39, 'Imita la acción de adiós o aplaudir en presencia de un modelo', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(40, 'Sostienen dos tacos y los choca entre sí', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(41, 'Ante un tablero con tres figuras geométricas, agarra las figuras sin prestar atención al tablero', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(42, 'uega con su imagen en el espejo', 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(43, 'Intenta meter los aros en un cilindro', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(44, 'Busca activamente cuando desaparece el objeto ante sus ojos', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(45, 'Se fija en la pastilla intenta agarrarla', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(46, 'Imita sonidos silábicos del adulto', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(47, 'Puede sacar un taco de una taza por imitación', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(48, 'Ante un tablero con clavija, mete el dedo en los huecos sin prestar atención a las clavijas', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(49, 'Se interesa por las ilustraciones grandes del cuento', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(50, 'Juega con su imagen en el espejo', 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(51, 'Mete los aros en un cilindro', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(52, 'Busca un objeto que se ha escondido delante de él', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(53, 'Suelta las pastillas, una a una, en un envase', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(54, 'Reproduce varios gestos que ha aprendido por imitación como por ejemplo: dar besitos, hacer mímicas, o abrir y cerrar los ojos.', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(55, 'Busca un taco escondidos debajo de una taza', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(56, 'Intenta meter envases de igual forma y diferentes tamaños, uno dentro del otro. Ejemplo el juego de apilar', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(57, 'Disfruta voltear varias páginas juntas de un cuento de tela o plástico', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(58, 'Juega con su imagen en el espejo', 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(59, 'Balancea el aro por imitación', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(60, 'Aparta obstáculos para alcanzar un objeto que se ha escondido frente a él', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(61, 'Agarra la pastilla con precisión y en forma espontanea', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(62, 'Imita una acción como dar palmadas a una muñeca.', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(63, 'Mete más de tres tacos dentro de una taza', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(64, 'Coloca el circulo en el tablero excavado de tres figuras geométricas con ayuda', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(65, 'Voltea, de una en una, las páginas de un cuento de tela o plástico, imitando al observador', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(66, 'Se reconoce así mismo en el espejo, toca su imagen', 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(67, 'Balancea el aro agarrándolo por la punta del cordón y mantiene el ritmo', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(68, 'Abandona la búsqueda de un objeto si se se distrae con otra cosa', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(69, 'Introduce espontáneamente las pastillas en el envase boca ancha', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(70, 'Imita acciones de rutinas diarias sencillas como limpiar con un trapo', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(71, 'Coloca un taco sobre otro', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(72, 'Saca las piezas del tablero de clavijas', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(73, 'Pasa las páginas de un cuento de tela o plástico, e intenta agarrar las ilustraciones', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(74, 'Se reconoce así mismo en el espejo, toca su imagen', 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(75, 'Es constante en la búsqueda de un objeto que ya no ve: vuelva a buscarlo después de un rato.', 13, '2024-12-02 02:36:05', '2024-12-02 02:36:05'),
(76, 'Explora una pastilla dentro del envase con el dedo índice', 13, '2024-12-02 02:36:05', '2024-12-02 02:36:05'),
(77, 'Imita pasar las páginas de un cuento', 13, '2024-12-02 02:36:05', '2024-12-02 02:36:05'),
(78, 'Hace una torre de 2 o 3 tacos', 13, '2024-12-02 02:36:06', '2024-12-02 02:36:06'),
(79, 'Aparea dos pelotas entre varios juguetes', 13, '2024-12-02 02:36:06', '2024-12-02 02:36:06'),
(80, 'Espontáneamente, pasa las páginas de un cuento, de cartón con hojas gruesas de una en una', 13, '2024-12-02 02:36:06', '2024-12-02 02:36:06'),
(81, 'Señala sus ojos, boca, nariz cuando se le pide', 13, '2024-12-02 02:36:06', '2024-12-02 02:36:06'),
(82, 'Disfruta meter aros en un cono', 13, '2024-12-02 02:36:06', '2024-12-02 02:36:06'),
(83, 'Saca la pastilla volteando el frasco', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(84, 'Imita los sonidos de dos animales', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(85, 'Hace torres de 4 o 5 tacos', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(86, 'Aparea el circulo y el cuadrado en el tablero excavado de tres figuras por imitación', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(87, 'Pasa las páginas de un cuento de cartón con hojas gruesas de una en una y muestra interés en las ilustraciones', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(88, 'Inicia reconocimiento de arriba, debajo de sí mismo', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(89, 'Mete los aros de diferentes tamaños en desorden en un cono', 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(90, 'Saca la pastilla metiendo el dedo índice en un envase boca', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(91, 'Imita tareas cotidianas. Por ejemplo barrer, recoger juguetes', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(92, 'Imita un tren con tacos', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(93, 'Mete las clavijas espontáneamente', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(94, 'Es capaz de señalar las figuras del cuento cuando se le pide', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(95, 'Conoce 6 partes de su cuerpo: la cara completa y otras tres partes', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(96, 'Entrega el tetero vacío o coge uno lleno cuando se le pide', 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(97, 'Imita gestos y posturas de sus padres', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(98, 'Entrega los tacos a solicitud del observador', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(99, 'Coloca el circulo, el cuadrado, y el triángulo en el tablero excavado', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(100, 'Pasa varias páginas de un cuento de cartón con hojas delgadas y las arruga', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(101, 'Dibuja la figura humana: monigote con ojos', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(102, 'Con ayuda, mete y saca los aros siguiendo el orden de tamaño', 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(103, 'Imita acciones conocidas cuando juega espontáneamente', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(104, 'Construye una torre de 6 tacos', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(105, 'Reconoce conceptos espaciales en relación consigo mismo: arriba- abajo, adentro- afuera.', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(106, 'Usa un cuento con hojas gruesas sin deteriorarlo y se interesa por la secuencias de las ilustraciones', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(107, 'Señala diez partes de su cuerpo: ojos, boca, nariz, piernas, brazos, orejas, manos, pie, rodilla y barriga', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(108, 'Da uno, dos o tres objetos cuando se le pide', 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(109, 'Cuando juega, imita papeles de familiares adultos, tales', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(110, 'Imita el puente con 3 tacos', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(111, 'Reconoce los conceptos temporales de día y noche en relación consigo mismo', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(112, 'Es capaz de seguir las secuencias completa de un cuento corto con trama e ilustraciones y hace preguntas', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(113, 'Dibuja la figura humana con cabeza, brazos y piernas', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(114, 'Reconoce con objetos: todo, mucho, poco, ninguno', 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(115, 'Cuando juega, imita papeles de adultos no familiares, tales como vecinos', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(116, 'Clasifica las figuras geométricas por forma simple y color primario', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(117, 'Disfruta y solicita que le lean un cuento. Por ejemplo antes de dormir o en el centro educativo', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(118, 'Aparea laminas asociando ideas', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(119, 'Arma un rompecabezas de figura humana con apoyo de la lamina', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(120, 'Mete y saca los aros en forma espontánea siguiendo el orden de tamaño', 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(121, 'Imita los modelos de la televisión y propagandas', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(122, 'Coloca y nombra el circulo, el cuadrado, el triángulo y la cruz en el tablero excavado de seis figuras geométricas', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(123, 'Inventa un cuento siguiendo laminas en secuencia', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(124, 'Arma rompecabezas de 12 piezas con apoyo de la lamina', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(125, 'Añade tronco y extremidades a su dibujo de figura humana y lo ubica correctamente', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(126, 'Clasifica los objetos por un atributo: tamaño', 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(127, 'Participa en obras de teatro sencilla asumiendo en el papel del otro', 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(128, 'Clasifica figuras geométricas por formas simples, colores secundarios y tres tamaños', 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(129, 'Hojea un cuento, con textos cortos, letra grande e ilustraciones grandes, hasta el final y presta atención al texto', 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(130, 'Arma rompecabezas de 24 piezas', 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(131, 'Clasifica los objetos por dos atributos: tamaño y forma', 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(132, 'Imita espontáneamente gestos y postura de familiares y vecinos', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(133, 'Imita patrones con 2 figuras geométricas de dos colores', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(134, 'Hace comentarios relativos al cuento que esta hojeando', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(135, 'Resuelve juego de memorias con figuras conocidas', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(136, 'Dibuja cuello, hombros, figura proporcionada, dos piezas del vestido y expresión facial', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(137, 'Ordena una serie de casas por diferentes tamaños: de la más pequeña a la más grande señala cual es la primera y cuál es la ultima', 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(138, 'Reacciona ante sonidos y voces', 23, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(139, 'Mira cuando se le habla de frente', 23, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(140, 'Se calma cuando su madre lo acuna en sus brazos', 23, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(141, 'Comunica sus necesidades por medio del llanto', 23, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(142, 'Se expresa mediante el llanto para expresar que tiene hambre', 23, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(143, 'Mantiene su atención en la voz del cuidador', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(144, 'Mira cuando se le habla de frente', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(145, 'Se calma cuando su madre lo acuna en sus brazos', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(146, 'Se sonríe cuando su cuidador lo acuna', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(147, 'Llora de manera diferente si tiene hambre o dolor', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(148, 'Emite sonidos como a-u cuando está satisfecho', 24, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(149, 'Sigue con la mirada al cuidador cuando le habla', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(150, 'Mira cuando se le habla de frente', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(151, 'Se calma cuando su madre lo acuna en sus brazos', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(152, 'Comprende gestos y ademanes del cuidador', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(153, 'Guarea cuando está satisfecho', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(154, 'Vocaliza cuando el cuidador se le acerca ejemplo aach-eeh', 25, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(155, 'Intenta voltearse buscando el sonido', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(156, 'Busca con la mirada al que habla', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(157, 'Se calma cuando su madre lo acuna en sus brazos', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(158, 'Vocaliza o balbucea para demostrar irritación, rabia, alegría', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(159, 'Llora para demandar atención', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(160, 'Comienza a vocalizar consonantes. Ejemplo: k, g, p y b', 26, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(161, 'Empieza a variar la entonación de su voz con base en lo que desea expresar', 26, '2024-12-02 08:23:47', '2024-12-02 08:23:47'),
(162, 'Comprende entonaciones cuando le hablan', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(163, 'Busca con la mirada al que habla', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(164, 'Se calma cuando su madre lo acuna en sus brazos', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(165, 'Sonríe ante su imagen en el espejo', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(166, 'Vocaliza para llamar la atención', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(167, 'Edad pre- balbuceo. Se habla “a sí mismo”', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(168, 'Imita los sonidos que emite su cuidador', 27, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(169, 'Atiende la voz del cuidador, le sonríe y vocaliza', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(170, 'Busca con la mirada al que habla', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(171, 'Sigue la música y responde a ella emitiendo sonidos de arrullo', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(172, 'Repite sonidos como sílabas a repetición', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(173, 'Emite gorgoritos y griticos cuando manipula sus juguetes', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(174, 'Solicita sus deseos con vocalizaciones', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(175, 'Escucha atentamente los sonidos a su alrededor', 28, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(176, 'Reconoce su nombre cuando lo llaman', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(177, 'Espera intencionalmente la respuesta verbal del cuidador', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(178, 'Se voltea al oír su nombre', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(179, 'Imita movimientos rítmicos con las manos, ejemplo: arepita', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(180, 'Balbuceo auto estimulante repitiendo silabas como ma-da', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(181, 'Emite silabas para comunicarse- ejemplo: da- ta', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(182, 'Atiende a los ritmos musicales', 29, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(183, 'Reconoce la voz de la madre aun sin verla', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(184, 'Comprende ordenes que contiene palabras familiares', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(185, 'Responde a personas y juguetes vocalizando', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(186, 'Extiende los brazos para que lo carguen', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(187, 'Silabea cuando juega y hace trompetillas con la lengua', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(188, 'Emite sonidos al escuchar el ladrido de un perro', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(189, 'Construye largas melodías el solo', 30, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(190, 'Discrimina tres sonidos: ejemplo: campana, timbre y llave', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(191, 'Comprende órdenes sencillas: Ej. “toma”, “dame”', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(192, 'Responde a personas y juguetes vocalizando', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(193, 'Hace gestos de adiós y arepitas ante la orden verbal', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(194, 'Repite silabas con intención social', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(195, 'Repite silabas para expresar lo que quiere', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(196, 'Escucha hasta que se acabe su canción preferida', 31, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(197, 'Responde selectivamente a tres palabras familiares. Ejemplo: agua, tetero, galleta', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(198, 'Comprende el No y suspende lo que está haciendo', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(199, 'Responde a personas y juguetes vocalizando', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(200, 'Dice “Si” y “No” con movimientos en la cabeza', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(201, 'Emite silabas en repetición a lo que dice su cuidador. Ejemplo: ma-ma', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(202, 'Llama a su mamá con alguna expresión especial', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(203, 'Oye nuevas melodías con mucho interés', 32, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(204, 'Discrimina el tono de la frase. Ejemplo: fuerte, suave', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(205, 'Responde con gestos cuando el cuidador le pregunta algo. Ejemplo: “¿Vamos al parque?” responde si con la cabeza', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(206, 'Señala para pedir', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(207, 'Responde con jerga al tono fuerte o suave del cuidador', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(208, 'Hace palmaditas para expresar alegría', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(209, 'Expresa con acciones sus deseos como halar a su mamá para que le dé algo', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(210, 'Trata de imitar repitiendo palabras sencillas que le dice el cuidador', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(211, 'Presta atención a las conversaciones de sus cuidadores', 33, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(212, 'Comprende el significado de “no” pero aún no se consolida como respuesta', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(213, 'Comprende ordenes como “abre la boca”', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(214, 'Señala objetos conocidos al preguntar por ellos. Por ejemplo: muéstrame tur zapatos', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(215, 'Responde a ordenes sencillas como búscalo, dámelo', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(216, 'Comprende el gesto de dame del cuidador', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(217, 'Dice claramente su primera palabra', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(218, 'Dice claramente su primera palabra', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(219, 'Mira con atención los dibujos e ilustraciones de un libro', 34, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(220, 'Camina en busca de un objeto conocido que oye y está fuera de su vista', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(221, 'Sigue una orden simple. Ejemplo: acuesta la muñeca', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(222, 'Señala cuartas partes de su cara', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(223, 'Responde con gestos a órdenes sencillas. Ejemplo: te gusta el helado', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(224, 'Indica sus deseos con gestos más complejos como halar al cuidador como para llevarlo donde desea ir', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(225, 'Imita sonidos onomatopéyicos de animales con entonación adecuada como ejemplo: mauu- guauuu', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(226, 'Dice mamá, papá, agua cuando los ve', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(227, 'Oye atentamente ritmos musicales', 35, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(228, 'Discrimina nombre de familiares', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(229, 'Se consolida el “No” como una orden a seguir', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(230, 'Señala los dos objetos que son iguales en un grupo de juguetes de piñatas', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(231, 'Responde rápidamente a su nombre', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(232, 'Se hace entender por acciones. Ejemplo busca las llaves para salir', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(233, 'Además de papá y mamá dice dos o tres palabras aisladas relacionando el objeto con su nombre', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(234, 'Expresa palabras frase. Ejemplo: “agua” por “dame agua”', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(235, '“lee” libros ilustrados pasando las paginas, nombrando y señalando las figuras', 36, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(236, 'Discrimina nombre de objetos conocidos', 37, '2024-12-02 08:56:19', '2024-12-02 08:56:19'),
(237, 'Sigue una orden en dos pasos. Ejemplo: pon la muñeca en la silla y dale comida', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(238, 'señala el avión o el barco cuando pasan por el aire o por el mar', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(239, 'Escucha con atención lo que sucede a su alrededor', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(240, 'Señala para identificar cosas', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(241, 'Emplea más palabras para comunicar sus deseos como variedad de alimentos', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(242, 'Si se le pregunta ¿qué es esto? Responde con una frase', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(243, 'Reconoce las caras de los personajes en un cuento', 37, '2024-12-02 08:56:20', '2024-12-02 08:56:20'),
(244, 'Discrimina sonidos más complejos. Ejemplo: pitos o golpes sobre la mesa', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(245, 'Sigue una orden en tres pasos. Ejemplo: igual a 11. Agrega después acuéstala en la cama', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(246, 'Reconoce 3 de 5 figuras por su nombr', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(247, 'Responde con gestos o palabras a preguntas sencillas: ¿Cómo hace el perro?', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(248, 'Sustituye los gestos por palabras', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(249, 'Une dos palabras para formar frases', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(250, 'Consolida la combinación de dos palabras para formar frases más completas', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(251, 'Atiende a cuentos cortos', 38, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(252, 'Reconoce sonidos parecidos y los identifica. Ejemplo: dos pitos diferentes', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(253, 'Hace un mandado en la casa en ausencia del cuidador. Ejemplo: “Búscame los zapatos”', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(254, 'Reconoce 7 de 10 figuras por su nombre', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(255, 'Responde claramente a diferentes tonos de voz. Por ejemplo: bravo, contento', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(256, 'Sustituye los gestos por verbalizaciones que indican sentimientos. Por ejemplo estoy bravo', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(257, 'Empieza a utilizar el “mi”(propiedad) y lo acompaña con gestos', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(258, 'Combina hasta veinte palabras', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(259, 'Canta una pequeña parte de canciones sencillas, cortas. Ejemplo: los pollitos u otra canción', 39, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(260, 'Discrimina dos sonidos onomatopéyicos asociándolos al objeto que los produce. Ejemplo: tic-tac; run run; ring ring', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(261, 'Ejecuta una orden en dos etapas sin presencia del cuidador: “ve a la cocina me traes el pan y la mantequilla”', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(262, 'Señala cinco cosas conocidas en el parque', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(263, 'Dice su nombre si se le pregunta ¿quién?', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(264, 'Dice su edad con los dedos', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(265, 'Usa oraciones de tres palabras empleando un lenguaje más completo: artículos, pronombres, plurales, etc.', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(266, 'Inicia oraciones de tres palabras bien construidas', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(267, 'Canta una canción completa aprendida con anterioridad. Se deleita con ritmos y sonoridad', 40, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(268, 'Reconoce canciones', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(269, 'Repite una instrucción que se le ha dado. ¿Dónde tienes que poner los juguetes al terminar de jugar', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(270, 'Señala y sabe dónde están sus cosas y juguetes', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(271, 'Responde a la pregunta ¿Cómo?', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(272, 'Gesticula con la cara al hablar', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(273, 'Oraciones de cuatros palabras presentes. Incluye adjetivos y relata experiencias sencillas', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(274, 'Dice para que sirven los objetos conocidos', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(275, 'Presta hasta 5 minutos de atención a un cuento novedoso y disfruta si le improvisan algo de él', 41, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(276, 'Discrimina el nombre y dice la función de varios objetos', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(277, 'Ejecuta órdenes de tres pasos sin la presencia del cuidador: “ve a la mesa, sirves un refresco y se lo llevas a tu papá”', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(278, 'Señala en una lámina el objeto que es diferente', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(279, 'Ante la pregunta ¿por qué?, responde por qué si', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(280, 'Acompaña con gestos su lenguaje oral y facial', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(281, 'Emplea el futuro al hablar. Ejemplo: usa adverbios de tiempo y lugar', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(282, 'El lenguaje es espontaneo. Ejemplo: participa en la conversación usando oraciones', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(283, 'Atiende a un cuento novedoso y lo relata con énfasis en el desenlace final', 42, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(284, 'Discrimina palabras nuevas y trata y trata de utilizarlas en forma espontanea', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(285, 'Repite una instrucción más compleja. Por ejemplo: ¿Qué tienes que hacer con la ropa sucia después de bañarte?', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(286, 'Señala en láminas: mas, menos, pocos y muchos', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(287, 'Ante la pregunta ¿qué? Responde descriptivamente', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(288, 'Cuenta chistes y lo dramatiza con gestos', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(289, 'Dice su dirección y teléfono', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(290, 'Utiliza el tiempo pasado en los verbos', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(291, 'Repite poesías familiares o canta cinco versos de una canción completa', 43, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(292, 'Tararea y canta canciones espontáneamente', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(293, 'Repite las instrucciones que le ha dado su maestra para recoger el salón después de merendar', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(294, 'Responde a preguntas más complejas como: ¿qué es lo contrario de... ¿qué pasaría sí', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(295, 'Mantiene una conversación con un adulto y usa con precisión sus gestos', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(296, 'Relata experiencias del acontecer diario empleando “ayer” y “mañana”', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(297, 'Define por su uso las figuras que se le presentan en láminas. Ejemplo: una pelota o un carro, un peine, un cuchillo, una sombrilla.', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(298, 'Relata cuentos usando particulares de enlace (luego, después, etc) y sus ideas tienen un inicio, desarrollo y final', 44, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(299, 'Sostiene la cabeza cuando está en brazos del cuidador.', 45, '2024-12-04 23:57:01', '2024-12-04 23:57:01'),
(300, 'Despierto, intenta girar la cabeza de derecha a izquierda', 45, '2024-12-04 23:57:01', '2024-12-04 23:57:01'),
(301, 'Postura en flexión con la cabeza rotada no la alinea', 45, '2024-12-04 23:57:01', '2024-12-04 23:57:01'),
(302, 'Bambolea la cabeza, si se le deja sin apoyo.', 46, '2024-12-05 00:01:05', '2024-12-05 00:01:05'),
(303, 'Levanta la cabeza y hay mayor extensión del cuello', 46, '2024-12-05 00:01:05', '2024-12-05 00:01:05'),
(304, 'Comienza a alinear la cabeza y disminuye la posición en flexión', 46, '2024-12-05 00:01:05', '2024-12-05 00:01:05'),
(305, 'Alinea la cabeza y la mueve buscando los estímulos', 47, '2024-12-05 00:04:03', '2024-12-05 00:04:03'),
(306, 'Comienza a levantar la cabeza apoyado en el antebrazo', 47, '2024-12-05 00:04:03', '2024-12-05 00:04:03'),
(307, 'Logra una posición simétrica del cuerpo con movimientos armónicos', 47, '2024-12-05 00:04:03', '2024-12-05 00:04:03'),
(308, 'Alinea la cabeza cuando se le habla sobre el hombro', 47, '2024-12-05 00:04:03', '2024-12-05 00:04:03'),
(309, 'Controla la cabeza y voltea', 48, '2024-12-05 00:09:34', '2024-12-05 00:09:34'),
(310, 'Se apoya en un ante brazo para alcanzar un objeto con el otro brazo.', 48, '2024-12-05 00:09:34', '2024-12-05 00:09:34'),
(311, 'Une sus manos en línea media', 48, '2024-12-05 00:09:34', '2024-12-05 00:09:34'),
(312, 'Se mantiene sentado con apoyo en sus manos', 48, '2024-12-05 00:09:34', '2024-12-05 00:09:34'),
(313, 'Mantiene la cabeza erguida e inicia el control del tronco', 49, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(314, 'Se voltea estando boca abajo se pone boca arriba', 49, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(315, 'Levanta cabeza y hombros en un intento de agarrar sus pies', 49, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(316, 'Sostenido por las manos, los miembros inferiores cuelgan', 49, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(317, 'Repta rodándose o arrastrándose hacia atrás', 49, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(318, 'Sostiene la cabeza erguida apoyado en las manos', 50, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(319, 'Levanta la cabeza contra la gravedad, cuando es alzado por los brazos', 50, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(320, 'Sostenido por las manos, descarga su peso sobre los pies', 50, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(321, 'Se apoya en cuatro puntos: manos y rodillas', 50, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(322, 'Se consolida el equilibrio acostado boca abajo', 50, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(323, 'Boca abajo, dobla el tronco para alcanzar un juguete que esta fuera de su alcance.', 51, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(324, 'Lleva al pie a la boca y levanta la cabeza de la almohada', 51, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(325, 'Se mantiene sentado, hay control del tronco.', 51, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(326, 'Se para cuándo lo halan por las manos, desde la posición sentado', 51, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(327, 'Se desplaza lazándose hacia adelante', 51, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(328, 'Pasa a posición de sentado con apoyo en una mano', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(329, 'Pasa a la posición de sentado con ayuda de sus codos y manos', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(330, 'Se sienta desde la posición acostada boca abajo.', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(331, 'Intenta pararse en la cuna pero se cae', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(332, 'Gatea unos pocos pasos cuando lo llaman, apoyándose en sus manos y rodillas', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(333, 'Adquiere equilibrio apoyado en sus manos y rodillas', 52, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(334, 'Se sienta sin ayuda', 53, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(335, 'Pasa a la posición de sentado con ayuda de sus codos y manos', 53, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(336, 'Permanece parado con apoyo vertical', 53, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(337, 'Gatea con soltura y buena coordinación de manos y piernas', 53, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(338, 'Se consolida el equilibrio sentado', 53, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(339, 'Pasa a la posición de sentado con ayuda de sus codos y manos', 54, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(340, 'De sentado pasa a otras posiciones', 54, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(341, 'Se para con apoyo desde la posición de gateo', 54, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(342, 'Se pone de pie con apoyo', 54, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(343, 'Se consolida el equilibrio sentado', 54, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(344, 'Pasa a la posición sentado con apoyo de sus manos.', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(345, 'Se sienta y se para sosteniéndose de algo', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(346, 'Se para y se sienta con soltura, sostenido de algo', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(347, 'Gatea rápidamente y supera pequeños obstáculos', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(348, 'Da pasitos sostenido de ambas manos', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(349, 'Intenta subir un escalón gateando, pero no logra y se sienta', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(350, 'Se consolida el equilibrio sentado', 55, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(351, 'Es capaz de sentarse desde la posición de pies dejándose caer', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(352, 'Se mantiene parado solo por unos momentos (aprox. 10 seg)', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(353, 'Sube escaleras gateando', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(354, 'Intenta caminar por la habitación con apoyo y sin supervisión', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(355, 'Sube las escaleras gateando, con ayuda del adulto', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(356, 'Baja las escaleras acostado boca abajo o sentado, con el apoyo del cuidador', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(357, 'Se mantiene parado y sin apoyo', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(358, 'Preferencia manual intermitente', 56, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(359, 'Se sienta en diferentes tipos de muebles, muros, etc.', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(360, 'Se para sin apoyo', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(361, 'Camina sin ayuda levantando los brazos y ampliando su base de sustentación', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(362, 'Intenta caminar rápido, como si corriera, pero se cae', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(363, 'Sube las escaleras gateando, sin ayuda', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(364, 'Baja despacio, gateando hacia atrás al lado del cuidador', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(365, 'Se mantiene parado apoyándose en un columpio', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(366, 'Orece la pelota para que otro lo patee', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(367, 'Inicia lanzar la pelota grande con el estímulo del cuidador', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(368, 'Preferencia manual intermitente', 57, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(369, 'Se sube con esfuerzo a una silla alta y se sienta', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(370, 'Camina solo: se detiene a voluntad y mantiene el equilibrio', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(371, 'Camina rápido hacia adelante pero n cambia de dirección ni frena', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(372, 'Se sube y se baja de una silla con poca ayuda', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(373, 'Sube las escalones uno a uno, sin alternar los pies con apoyo de un adulto', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(374, 'Baja solo en posición de gateo', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(375, 'Camina y mantiene el equilibrio', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(376, 'Empuja la pelota con el pie', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(377, 'Utiliza todo el brazo para lanzar la pelota grande', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(378, 'Demuestra interés por la pelota grande, la sigue pero no puede agarrarla', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(379, 'Evidencia preferencia manual', 58, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(380, 'La pata coja', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(381, 'Tocar la nariz con el dedo', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(382, 'Estimulacion con los dedos, Derecha: 1-Corazon   2-Anular', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(383, 'Estimulacion con los dedos, Izquierda: 1-Pulgar   2-Anular', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(384, 'Estimulacion con los dedos, Derecha: 1-Meñique   2-Corazon  3-Pulgar', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(385, 'Estimulacion con los dedos, Izquierda: 1-Pulgar   2-Corazon  3-Meñique', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(386, 'Estimulacion con los dedos, Derecha: 1-Indice   2-Anular   3-Pulgar', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(387, 'Andar en equilibrio', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(388, 'Saltar con los pies juntos', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(389, 'En cunclillas con los brazon en cruz', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(390, 'Tocar con el pulgar todos los dedos de la mano', 59, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(391, 'Rosa', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(392, 'Espada', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(393, 'Escalera', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(394, 'Almeja', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(395, 'Pardo', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(396, 'Ermita', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(397, 'Prudente', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(398, 'Cromo', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(399, 'Gracioso', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(400, 'Transparente', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(401, 'Dragon', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(402, 'Esterilidad', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(403, 'Influencia', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(404, 'Pradera', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(405, 'Entrada', 60, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(406, 'En la fruteria venden peras verdes', 61, '2025-01-19 23:15:54', '2025-01-19 23:15:54'),
(407, 'El sol sale por detras de las montañas', 61, '2025-01-19 23:15:54', '2025-01-19 23:15:54'),
(408, 'La estufa da mucho calor en el invierno', 61, '2025-01-19 23:15:54', '2025-01-19 23:15:54'),
(409, 'El jardinero planto rosas blancas y amarillas', 61, '2025-01-19 23:15:54', '2025-01-19 23:15:54'),
(410, '¿Como se llamaba la niña?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(411, '¿Cuando fue al circo?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(412, '¿Donde estaba el circo?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(413, '¿Que llevaba el domador?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(414, '¿Como eran los payasos?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(415, '¿Que le paso a un trapecista?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(416, '¿Que le compro su papá?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(417, '¿Donde fue al terminar la función?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(418, '¿Que fue lo que mas le gusto?', 62, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(419, 'Pon el lapiz debajo de la mesa', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(420, 'Pon el lapiz encima del papel', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(421, 'Ponte delante de mi', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(422, 'Ponde detras de mi', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(423, 'Levanta la mano derecha', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(424, 'Levanta la mano izquierda', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(425, 'Con la mano derecha, tocate la oreja derecha', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(426, 'Con la mano izquierda, tapate el ojo izquierdo', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(427, 'Con la mano derecha, tocate la pierna izquierda', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(428, 'Con la mano izquierda, tocate la oreja derecha', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(429, 'Con tu mano derecha, tocame mi ojo izquierdo', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(430, 'Un cuadrado hacia la derecha (anexo 1)', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(431, 'Dos cuadrados hacia arriba (anexo 1)', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(432, 'Dos cuadrados hacia la izquierda (anexo 1)', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(433, 'Un cuadrado hacia abajo (anexo 1)', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(434, 'Mano usada', 63, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(435, '1', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(436, '2', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(437, '3', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(438, '4', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(439, '5', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(440, '6', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(441, '7', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(442, '8', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(443, '9', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(444, '10', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(445, '11', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(446, '12', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(447, '13', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(448, '14', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(449, '15', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(450, 'Mano usada', 64, '2025-01-20 01:25:17', '2025-01-20 01:25:17'),
(451, 'Luna', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(452, 'Globos', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(453, 'Television', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(454, 'Lapicero', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(455, 'Bebe', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(456, 'Paraguas', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(457, 'Balon', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(458, 'Bicicleta', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(459, 'Casa', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48'),
(460, 'Perro', 65, '2025-01-20 02:30:48', '2025-01-20 02:30:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-72 meses` varchar(255) NOT NULL,
  `73-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`id`, `sub_escala_id`, `percentil`, `61-66 meses`, `67-72 meses`, `73-78 meses`, `created_at`, `updated_at`) VALUES
(2, 13, '98', '12', 'NULL', 'NULL', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(3, 13, '97', '-', '20', 'NULL', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(4, 13, '96', '11', '-', 'NULL', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(5, 13, '95', '9-10', '12', '12', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(6, 13, '90', '3-8', '-', '-', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(7, 13, '85', '1-2', '-', '-', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(8, 13, '80', '-', '10-11', '-', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(9, 13, '75', '-', '6-9', '-', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(10, 13, '70', '-', '3-5', '11', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(11, 13, '65', '-', '1-2', '-', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(12, 13, '60', '-', '-', '10', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(13, 13, '55', '-', '-', '9', '2025-01-14 03:37:59', '2025-01-14 03:37:59'),
(14, 13, '50', '-', '-', '7-8', '2025-01-14 03:38:00', '2025-01-14 03:38:00'),
(15, 13, '45', '-', '-', '5-6', '2025-01-14 03:38:00', '2025-01-14 03:38:00'),
(16, 13, '40', '0', '-', '1-4', '2025-01-14 03:38:00', '2025-01-14 03:38:00'),
(17, 13, '35', 'NULL', '-', '-', '2025-01-14 03:38:00', '2025-01-14 03:38:00'),
(18, 13, '30', 'NULL', '0', '-', '2025-01-14 03:38:00', '2025-01-14 03:38:00'),
(19, 13, '25', 'NULL', 'NULL', '0', '2025-01-14 03:38:00', '2025-01-14 03:38:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguaje_articulatorios`
--

CREATE TABLE `lenguaje_articulatorios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lenguaje_articulatorios`
--

INSERT INTO `lenguaje_articulatorios` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 4, '99', '14-15', 'NULL', '15', 'NULL', '15', 'NULL', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(2, 4, '98', '-', 'NULL', '-', 'NULL', '-', 'NULL', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(3, 4, '97', '-', '15', '-', 'NULL', '-', 'NULL', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(4, 4, '96', '-', '-', '-', 'NULL', '-', 'NULL', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(5, 4, '95', '13', '-', '-', '15', '-', 'NULL', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(6, 4, '90', '12', '14', '14', '-', '-', '15', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(7, 4, '85', '11', '-', '-', '-', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(8, 4, '80', '10', '13', '13', '-', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(9, 4, '75', '-', '-', '-', '14', '14', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(10, 4, '70', '9', '-', '12', '-', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(11, 4, '65', '8', '12', '-', '-', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(12, 4, '60', '7', '-', '11', '13', '13', '14', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(13, 4, '55', '6', '11', '10', '-', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(14, 4, '50', '5', '10', '9', '12', '12', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(15, 4, '45', '4', '9', '8', '11', '-', '-', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(16, 4, '40', '3', '8', '7', '-', '11', '13', '2025-01-10 14:58:21', '2025-01-10 14:58:21'),
(17, 4, '35', '1-2', '6-7', '6', '10', '10', '-', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(18, 4, '30', '-', '5', '5', '9', '8-9', '-', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(19, 4, '25', '0', '-', '4', '8', '5-7', '12', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(20, 4, '20', 'NULL', '4', '3', '6-7', '2-4', '11', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(21, 4, '15', 'NULL', '3', '2', '5', '0-1', '8-10', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(22, 4, '10', 'NULL', '1-2', '1', '2-4', 'NULL', '0-7', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(23, 4, '5', 'NULL', '0', '0', '1', 'NULL', 'NULL', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(24, 4, '4', 'NULL', 'NULL', 'NULL', '0', 'NULL', 'NULL', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(25, 4, '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(26, 4, '2', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-10 14:58:22', '2025-01-10 14:58:22'),
(27, 4, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-10 14:58:22', '2025-01-10 14:58:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguaje_comprensivos`
--

CREATE TABLE `lenguaje_comprensivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lenguaje_comprensivos`
--

INSERT INTO `lenguaje_comprensivos` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 6, '99', '7-9', '8-9', '9', '9', '9', '9', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(2, 6, '98', '6', '7', '8', '-', '8', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(3, 6, '97', '-', '-', '-', '8', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(4, 6, '96', '5', '-', '-', '-', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(5, 6, '95', '-', '6', '-', '-', '7', '8', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(6, 6, '90', '4', '-', '7', '7', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(7, 6, '85', '-', '5', '-', '-', '-', '7', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(8, 6, '80', '3', '-', '6', '-', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(9, 6, '75', '-', '-', '-', '6', '6', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(10, 6, '70', '2', '4', '-', '-', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(11, 6, '65', '-', '-', '5', '-', '-', '6', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(12, 6, '60', '-', '3', '-', '5', '5', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(13, 6, '55', '-', '-', '-', '-', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(14, 6, '50', '1', '-', '4', '-', '-', '5', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(15, 6, '45', '-', '-', '-', '4', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(16, 6, '40', '-', '2', '3', '-', '4', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(17, 6, '35', '-', '-', '-', '-', '-', '4', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(18, 6, '30', '0', '-', '-', '3', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(19, 6, '25', 'NULL', '1', '2', '-', '3', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(20, 6, '20', 'NULL', '-', '-', '2', '-', '3', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(21, 6, '15', 'NULL', '-', '1', '-', '2', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(22, 6, '10', 'NULL', '0', '-', '1', '-', '2', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(23, 6, '5', 'NULL', 'NULL', '-', '-', '1', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(24, 6, '4', 'NULL', 'NULL', '0', '-', '-', '1', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(25, 6, '3', 'NULL', 'NULL', 'NULL', '0', '-', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(26, 6, '2', 'NULL', 'NULL', 'NULL', 'NULL', '0', '-', '2025-01-10 16:17:04', '2025-01-10 16:17:04'),
(27, 6, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', '2025-01-10 16:17:04', '2025-01-10 16:17:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguaje_expresivos`
--

CREATE TABLE `lenguaje_expresivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lenguaje_expresivos`
--

INSERT INTO `lenguaje_expresivos` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 5, '99', '1-4', 'NULL', 'NULL', 'NULL', '4', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(2, 5, '98', '-', 'NULL', 'NULL', 'NULL', '-', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(3, 5, '97', '-', 'NULL', 'NULL', 'NULL', '-', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(4, 5, '96', '-', 'NULL', 'NULL', 'NULL', '-', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(5, 5, '95', '-', '4', 'NULL', 'NULL', '-', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(6, 5, '90', '-', '-', '4', '4', '-', '4', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(7, 5, '85', '-', '-', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(8, 5, '80', '-', '-', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(9, 5, '75', '-', '-', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(10, 5, '70', '0', '3', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(11, 5, '65', 'NULL', '-', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(12, 5, '60', 'NULL', '-', '-', '3', '3', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(13, 5, '55', 'NULL', '-', '3', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(14, 5, '50', 'NULL', '-', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(15, 5, '45', 'NULL', '2', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(16, 5, '40', 'NULL', '-', '-', '-', '-', '3', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(17, 5, '35', 'NULL', '-', '-', '2', '2', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(18, 5, '30', 'NULL', '1', '2', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(19, 5, '25', 'NULL', '-', '-', '-', '1', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(20, 5, '20', 'NULL', '-', '1', '1', '-', '2', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(21, 5, '15', 'NULL', '0', '-', '-', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(22, 5, '10', 'NULL', 'NULL', '0', '-', '-', '1', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(23, 5, '5', 'NULL', 'NULL', 'NULL', '0', '-', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(24, 5, '4', 'NULL', 'NULL', 'NULL', 'NULL', '0', '-', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(25, 5, '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(26, 5, '2', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01'),
(27, 5, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-10 15:38:01', '2025-01-10 15:38:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_iconicas`
--

CREATE TABLE `memoria_iconicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `memoria_iconicas`
--

INSERT INTO `memoria_iconicas` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 9, '99', '6-10', '10', '9-10', '10', '9-10', '10', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(2, 9, '98', '-', '9', '-', '-', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(3, 9, '97', '-', '-', '-', '9', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(4, 9, '96', '-', '-', '-', '-', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(5, 9, '95', '5', '8', '-', '-', '-', '9', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(6, 9, '90', '-', '7', '8', '8', '8', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(7, 9, '85', '-', '-', '-', '-', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(8, 9, '80', '4', '6', '7', '-', '-', '8', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(9, 9, '75', '-', '-', '-', '7', '7', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(10, 9, '70', '-', '-', '-', '-', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(11, 9, '65', '3', '-', '6', '-', '-', '-', '2025-01-11 06:12:12', '2025-01-11 06:12:12'),
(12, 9, '60', '-', '5', '-', '6', '-', '7', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(13, 9, '55', '-', '-', '-', '-', '-', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(14, 9, '50', '2', '-', '-', '-', '6', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(15, 9, '45', '-', '4', '5', '-', '-', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(16, 9, '40', '1', '-', '-', '5', '-', '6', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(17, 9, '35', '-', '-', '-', '-', '-', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(18, 9, '30', '-', '-', '-', '-', '5', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(19, 9, '25', '0', '3', '4', '4', '-', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(20, 9, '20', 'NULL', '-', '-', '-', '-', '5', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(21, 9, '15', 'NULL', '2', '3', '-', '4', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(22, 9, '10', 'NULL', '1', '-', '3', '-', '4', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(23, 9, '5', 'NULL', '-', '2', '1-2', '3', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(24, 9, '4', 'NULL', '-', '-', '-', '2', '-', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(25, 9, '3', 'NULL', '0', '-', '-', '-', '3', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(26, 9, '2', 'NULL', 'NULL', '1', '0', '0-1', '2', '2025-01-11 06:12:13', '2025-01-11 06:12:13'),
(27, 9, '1', 'NULL', 'NULL', '0', 'NULL', 'NULL', '0-1', '2025-01-11 06:12:13', '2025-01-11 06:12:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(79, '2014_10_12_000000_create_users_table', 1),
(80, '2014_10_12_100000_create_password_resets_table', 1),
(81, '2019_08_19_000000_create_failed_jobs_table', 1),
(82, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(83, '2024_08_20_025345_create_especialidads_table', 1),
(84, '2024_08_22_212652_create_estados_table', 1),
(85, '2024_08_22_212728_create_municipios_table', 1),
(86, '2024_08_22_212905_create_parroquias_table', 1),
(87, '2024_08_22_212921_create_generos_table', 1),
(88, '2024_08_22_213818_create_direccions_table', 1),
(89, '2024_08_22_214121_create_especialistas_table', 1),
(90, '2024_10_11_033913_create_secretarias_table', 1),
(91, '2024_10_11_034040_create_datos_economicos_table', 1),
(92, '2024_10_11_034307_create_representantes_table', 1),
(93, '2024_10_11_034350_create_pacientes_table', 1),
(94, '2024_10_11_034459_create_parentescos_table', 1),
(95, '2024_10_11_065359_create_citas_table', 1),
(96, '2024_11_09_214845_create_historia_desarrollos_table', 1),
(97, '2024_11_09_215309_create_antecedente_medicos_table', 1),
(98, '2024_11_09_215403_create_historia_escolars_table', 1),
(99, '2024_11_09_215451_create_historia_clinicas_table', 1),
(100, '2024_11_24_114100_create_tipo_pruebas_table', 1),
(101, '2024_11_24_114209_create_area_desarrollos_table', 1),
(102, '2024_11_24_114226_create_rango_pruebas_table', 1),
(103, '2024_11_24_114244_create_pruebas_table', 1),
(104, '2024_11_24_114300_create_item_pruebas_table', 1),
(105, '2024_11_24_163119_create_valor_items_table', 1),
(106, '2025_01_06_204103_sub_escalas', 2),
(107, '2025_01_06_210850_create_desarrollo_globals_table', 3),
(108, '2025_01_07_095624_create_desarrollo_verbals_table', 4),
(109, '2025_01_07_101043_desarrollo_verbals', 5),
(110, '2025_01_07_111745_create_desarrollo_no_verbals_table', 6),
(111, '2025_01_08_234841_create_psicomotricidad_cumanins_table', 7),
(112, '2025_01_10_102455_create_lenguaje_articulatorios_table', 8),
(113, '2025_01_10_105954_create_lenguaje_expresivos_table', 9),
(114, '2025_01_10_113855_create_lenguaje_comprensivos_table', 10),
(115, '2025_01_10_133228_create_estructuracion_esapacials_table', 11),
(116, '2025_01_10_175940_create_visopercepcions_table', 12),
(117, '2025_01_11_011532_create_memoria_iconicas_table', 13),
(118, '2025_01_11_021819_create_ritmos_table', 14),
(119, '2025_01_13_173700_create_fluidez_verbals_table', 15),
(120, '2025_01_13_224159_create_atencions_table', 16),
(121, '2025_01_13_231509_create_lecturas_table', 17),
(122, '2025_01_14_101540_create_escrituras_table', 18),
(123, '2025_01_14_114337_create_dibujo_figura_humana_5años_table', 19),
(124, '2025_01_15_104515_create_dibujo_figura_humanas_table', 20),
(125, '2025_01_15_115557_create_interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s_table', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `municipio` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `estado_id`, `municipio`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alto Orinoco', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(2, 1, 'Atabapo', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(3, 1, 'Atures', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(4, 1, 'Autana', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(5, 1, 'Manapiare', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(6, 1, 'Maroa', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(7, 1, 'Río Negro', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(8, 2, 'Anaco', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(9, 2, 'Aragua', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(10, 2, 'Manuel Ezequiel Bruzual', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(11, 2, 'Diego Bautista Urbaneja', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(12, 2, 'Fernando Peñalver', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(13, 2, 'Francisco Del Carmen Carvajal', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(14, 2, 'General Sir Arthur McGregor', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(15, 2, 'Guanta', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(16, 2, 'Independencia', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(17, 2, 'José Gregorio Monagas', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(18, 2, 'Juan Antonio Sotillo', '2024-11-30 14:07:29', '2024-11-30 14:07:29'),
(19, 2, 'Juan Manuel Cajigal', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(20, 2, 'Libertad', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(21, 2, 'Francisco de Miranda', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(22, 2, 'Pedro María Freites', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(23, 2, 'Píritu', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(24, 2, 'San José de Guanipa', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(25, 2, 'San Juan de Capistrano', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(26, 2, 'Santa Ana', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(27, 2, 'Simón Bolívar', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(28, 2, 'Simón Rodríguez', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(29, 3, 'Achaguas', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(30, 3, 'Biruaca', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(31, 3, 'Muñóz', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(32, 3, 'Páez', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(33, 3, 'Pedro Camejo', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(34, 3, 'Rómulo Gallegos', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(35, 3, 'San Fernando', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(36, 4, 'Atanasio Girardot', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(37, 4, 'Bolívar', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(38, 4, 'Camatagua', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(39, 4, 'Francisco Linares Alcántara', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(40, 4, 'José Ángel Lamas', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(41, 4, 'José Félix Ribas', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(42, 4, 'José Rafael Revenga', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(43, 4, 'Libertador', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(44, 4, 'Mario Briceño Iragorry', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(45, 4, 'Ocumare de la Costa de Oro', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(46, 4, 'San Casimiro', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(47, 4, 'San Sebastián', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(48, 4, 'Santiago Mariño', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(49, 4, 'Santos Michelena', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(50, 4, 'Sucre', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(51, 4, 'Tovar', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(52, 4, 'Urdaneta', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(53, 4, 'Zamora', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(54, 5, 'Alberto Arvelo Torrealba', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(55, 5, 'Andrés Eloy Blanco', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(56, 5, 'Antonio José de Sucre', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(57, 5, 'Arismendi', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(58, 5, 'Barinas', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(59, 5, 'Bolívar', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(60, 5, 'Cruz Paredes', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(61, 5, 'Ezequiel Zamora', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(62, 5, 'Obispos', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(63, 5, 'Pedraza', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(64, 5, 'Rojas', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(65, 5, 'Sosa', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(66, 6, 'Caroní', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(67, 6, 'Cedeño', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(68, 6, 'El Callao', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(69, 6, 'Gran Sabana', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(70, 6, 'Heres', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(71, 6, 'Piar', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(72, 6, 'Angostura (Raúl Leoni)', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(73, 6, 'Roscio', '2024-11-30 14:07:30', '2024-11-30 14:07:30'),
(74, 6, 'Sifontes', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(75, 6, 'Sucre', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(76, 6, 'Padre Pedro Chien', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(77, 7, 'Bejuma', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(78, 7, 'Carlos Arvelo', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(79, 7, 'Diego Ibarra', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(80, 7, 'Guacara', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(81, 7, 'Juan José Mora', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(82, 7, 'Libertador', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(83, 7, 'Los Guayos', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(84, 7, 'Miranda', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(85, 7, 'Montalbán', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(86, 7, 'Naguanagua', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(87, 7, 'Puerto Cabello', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(88, 7, 'San Diego', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(89, 7, 'San Joaquín', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(90, 7, 'Valencia', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(91, 8, 'Anzoátegui', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(92, 8, 'Tinaquillo', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(93, 8, 'Girardot', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(94, 8, 'Lima Blanco', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(95, 8, 'Pao de San Juan Bautista', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(96, 8, 'Ricaurte', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(97, 8, 'Rómulo Gallegos', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(98, 8, 'San Carlos', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(99, 8, 'Tinaco', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(100, 9, 'Antonio Díaz', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(101, 9, 'Casacoima', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(102, 9, 'Pedernales', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(103, 9, 'Tucupita', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(104, 10, 'Acosta', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(105, 10, 'Bolívar', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(106, 10, 'Buchivacoa', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(107, 10, 'Cacique Manaure', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(108, 10, 'Carirubana', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(109, 10, 'Colina', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(110, 10, 'Dabajuro', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(111, 10, 'Democracia', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(112, 10, 'Falcón', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(113, 10, 'Federación', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(114, 10, 'Jacura', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(115, 10, 'José Laurencio Silva', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(116, 10, 'Los Taques', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(117, 10, 'Mauroa', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(118, 10, 'Miranda', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(119, 10, 'Monseñor Iturriza', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(120, 10, 'Palmasola', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(121, 10, 'Petit', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(122, 10, 'Píritu', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(123, 10, 'San Francisco', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(124, 10, 'Sucre', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(125, 10, 'Tocópero', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(126, 10, 'Unión', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(127, 10, 'Urumaco', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(128, 10, 'Zamora', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(129, 11, 'Camaguán', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(130, 11, 'Chaguaramas', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(131, 11, 'El Socorro', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(132, 11, 'José Félix Ribas', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(133, 11, 'José Tadeo Monagas', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(134, 11, 'Juan Germán Roscio', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(135, 11, 'Julián Mellado', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(136, 11, 'Las Mercedes', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(137, 11, 'Leonardo Infante', '2024-11-30 14:07:31', '2024-11-30 14:07:31'),
(138, 11, 'Pedro Zaraza', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(139, 11, 'Ortíz', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(140, 11, 'San Gerónimo de Guayabal', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(141, 11, 'San José de Guaribe', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(142, 11, 'Santa María de Ipire', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(143, 11, 'Sebastián Francisco de Miranda', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(144, 12, 'Andrés Eloy Blanco', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(145, 12, 'Crespo', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(146, 12, 'Iribarren', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(147, 12, 'Jiménez', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(148, 12, 'Morán', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(149, 12, 'Palavecino', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(150, 12, 'Simón Planas', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(151, 12, 'Torres', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(152, 12, 'Urdaneta', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(179, 13, 'Alberto Adriani', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(180, 13, 'Andrés Bello', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(181, 13, 'Antonio Pinto Salinas', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(182, 13, 'Aricagua', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(183, 13, 'Arzobispo Chacón', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(184, 13, 'Campo Elías', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(185, 13, 'Caracciolo Parra Olmedo', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(186, 13, 'Cardenal Quintero', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(187, 13, 'Guaraque', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(188, 13, 'Julio César Salas', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(189, 13, 'Justo Briceño', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(190, 13, 'Libertador', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(191, 13, 'Miranda', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(192, 13, 'Obispo Ramos de Lora', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(193, 13, 'Padre Noguera', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(194, 13, 'Pueblo Llano', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(195, 13, 'Rangel', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(196, 13, 'Rivas Dávila', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(197, 13, 'Santos Marquina', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(198, 13, 'Sucre', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(199, 13, 'Tovar', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(200, 13, 'Tulio Febres Cordero', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(201, 13, 'Zea', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(223, 14, 'Acevedo', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(224, 14, 'Andrés Bello', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(225, 14, 'Baruta', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(226, 14, 'Brión', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(227, 14, 'Buroz', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(228, 14, 'Carrizal', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(229, 14, 'Chacao', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(230, 14, 'Cristóbal Rojas', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(231, 14, 'El Hatillo', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(232, 14, 'Guaicaipuro', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(233, 14, 'Independencia', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(234, 14, 'Lander', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(235, 14, 'Los Salias', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(236, 14, 'Páez', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(237, 14, 'Paz Castillo', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(238, 14, 'Pedro Gual', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(239, 14, 'Plaza', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(240, 14, 'Simón Bolívar', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(241, 14, 'Sucre', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(242, 14, 'Urdaneta', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(243, 14, 'Zamora', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(258, 15, 'Acosta', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(259, 15, 'Aguasay', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(260, 15, 'Bolívar', '2024-11-30 14:07:32', '2024-11-30 14:07:32'),
(261, 15, 'Caripe', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(262, 15, 'Cedeño', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(263, 15, 'Ezequiel Zamora', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(264, 15, 'Libertador', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(265, 15, 'Maturín', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(266, 15, 'Piar', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(267, 15, 'Punceres', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(268, 15, 'Santa Bárbara', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(269, 15, 'Sotillo', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(270, 15, 'Uracoa', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(271, 16, 'Antolín del Campo', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(272, 16, 'Arismendi', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(273, 16, 'García', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(274, 16, 'Gómez', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(275, 16, 'Maneiro', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(276, 16, 'Marcano', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(277, 16, 'Mariño', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(278, 16, 'Península de Macanao', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(279, 16, 'Tubores', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(280, 16, 'Villalba', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(281, 16, 'Díaz', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(282, 17, 'Agua Blanca', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(283, 17, 'Araure', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(284, 17, 'Esteller', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(285, 17, 'Guanare', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(286, 17, 'Guanarito', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(287, 17, 'Monseñor José Vicente de Unda', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(288, 17, 'Ospino', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(289, 17, 'Páez', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(290, 17, 'Papelón', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(291, 17, 'San Genaro de Boconoíto', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(292, 17, 'San Rafael de Onoto', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(293, 17, 'Santa Rosalía', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(294, 17, 'Sucre', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(295, 17, 'Turén', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(296, 18, 'Andrés Eloy Blanco', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(297, 18, 'Andrés Mata', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(298, 18, 'Arismendi', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(299, 18, 'Benítez', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(300, 18, 'Bermúdez', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(301, 18, 'Bolívar', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(302, 18, 'Cajigal', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(303, 18, 'Cruz Salmerón Acosta', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(304, 18, 'Libertador', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(305, 18, 'Mariño', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(306, 18, 'Mejía', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(307, 18, 'Montes', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(308, 18, 'Ribero', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(309, 18, 'Sucre', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(310, 18, 'Valdéz', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(341, 19, 'Andrés Bello', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(342, 19, 'Antonio Rómulo Costa', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(343, 19, 'Ayacucho', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(344, 19, 'Bolívar', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(345, 19, 'Cárdenas', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(346, 19, 'Córdoba', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(347, 19, 'Fernández Feo', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(348, 19, 'Francisco de Miranda', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(349, 19, 'García de Hevia', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(350, 19, 'Guásimos', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(351, 19, 'Independencia', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(352, 19, 'Jáuregui', '2024-11-30 14:07:33', '2024-11-30 14:07:33'),
(353, 19, 'José María Vargas', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(354, 19, 'Junín', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(355, 19, 'Libertad', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(356, 19, 'Libertador', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(357, 19, 'Lobatera', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(358, 19, 'Michelena', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(359, 19, 'Panamericano', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(360, 19, 'Pedro María Ureña', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(361, 19, 'Rafael Urdaneta', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(362, 19, 'Samuel Darío Maldonado', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(363, 19, 'San Cristóbal', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(364, 19, 'Seboruco', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(365, 19, 'Simón Rodríguez', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(366, 19, 'Sucre', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(367, 19, 'Torbes', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(368, 19, 'Uribante', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(369, 19, 'San Judas Tadeo', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(370, 20, 'Andrés Bello', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(371, 20, 'Boconó', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(372, 20, 'Bolívar', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(373, 20, 'Candelaria', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(374, 20, 'Carache', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(375, 20, 'Escuque', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(376, 20, 'José Felipe Márquez Cañizalez', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(377, 20, 'Juan Vicente Campos Elías', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(378, 20, 'La Ceiba', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(379, 20, 'Miranda', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(380, 20, 'Monte Carmelo', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(381, 20, 'Motatán', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(382, 20, 'Pampán', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(383, 20, 'Pampanito', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(384, 20, 'Rafael Rangel', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(385, 20, 'San Rafael de Carvajal', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(386, 20, 'Sucre', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(387, 20, 'Trujillo', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(388, 20, 'Urdaneta', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(389, 20, 'Valera', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(390, 21, 'Vargas', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(391, 22, 'Arístides Bastidas', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(392, 22, 'Bolívar', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(407, 22, 'Bruzual', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(408, 22, 'Cocorote', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(409, 22, 'Independencia', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(410, 22, 'José Antonio Páez', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(411, 22, 'La Trinidad', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(412, 22, 'Manuel Monge', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(413, 22, 'Nirgua', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(414, 22, 'Peña', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(415, 22, 'San Felipe', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(416, 22, 'Sucre', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(417, 22, 'Urachiche', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(418, 22, 'José Joaquín Veroes', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(441, 23, 'Almirante Padilla', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(442, 23, 'Baralt', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(443, 23, 'Cabimas', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(444, 23, 'Catatumbo', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(445, 23, 'Colón', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(446, 23, 'Francisco Javier Pulgar', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(447, 23, 'Páez', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(448, 23, 'Jesús Enrique Losada', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(449, 23, 'Jesús María Semprún', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(450, 23, 'La Cañada de Urdaneta', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(451, 23, 'Lagunillas', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(452, 23, 'Machiques de Perijá', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(453, 23, 'Mara', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(454, 23, 'Maracaibo', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(455, 23, 'Miranda', '2024-11-30 14:07:34', '2024-11-30 14:07:34'),
(456, 23, 'Rosario de Perijá', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(457, 23, 'San Francisco', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(458, 23, 'Santa Rita', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(459, 23, 'Simón Bolívar', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(460, 23, 'Sucre', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(461, 23, 'Valmore Rodríguez', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(462, 24, 'Libertador', '2024-11-30 14:07:35', '2024-11-30 14:07:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `fecha_nac` date NOT NULL,
  `representante_id` bigint(20) UNSIGNED DEFAULT NULL,
  `datoseconomico_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `fecha_nac`, `representante_id`, `datoseconomico_id`, `genero_id`, `created_at`, `updated_at`) VALUES
(2, 'greisis', 'manoa', '2023-04-03', 2, 2, 2, '2024-12-10 03:05:07', '2024-12-10 03:05:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentescos`
--

CREATE TABLE `parentescos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `fecha_nac` date NOT NULL,
  `parentesco` varchar(120) NOT NULL,
  `discapacidad` varchar(120) NOT NULL,
  `tipo_discapacidad` varchar(120) NOT NULL,
  `enfermedad_cronica` varchar(120) NOT NULL,
  `tipo_enfermedad` varchar(120) NOT NULL,
  `genero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parentescos`
--

INSERT INTO `parentescos` (`id`, `paciente_id`, `nombre`, `apellido`, `fecha_nac`, `parentesco`, `discapacidad`, `tipo_discapacidad`, `enfermedad_cronica`, `tipo_enfermedad`, `genero_id`, `created_at`, `updated_at`) VALUES
(3, 2, 'juana', 'manoa', '1969-01-24', 'abuela materna', 'si', 'no aplica', 'si', 'no aplica', NULL, '2024-12-10 03:05:07', '2024-12-10 03:05:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `municipio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parroquia` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id`, `municipio_id`, `parroquia`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alto Orinoco', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(2, 1, 'Huachamacare Acanaña', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(3, 1, 'Marawaka Toky Shamanaña', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(4, 1, 'Mavaka Mavaka', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(5, 1, 'Sierra Parima Parimabé', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(6, 2, 'Ucata Laja Lisa', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(7, 2, 'Yapacana Macuruco', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(8, 2, 'Caname Guarinuma', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(9, 3, 'Fernando Girón Tovar', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(10, 3, 'Luis Alberto Gómez', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(11, 3, 'Pahueña Limón de Parhueña', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(12, 3, 'Platanillal Platanillal', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(13, 4, 'Samariapo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(14, 4, 'Sipapo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(15, 4, 'Munduapo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(16, 4, 'Guayapo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(17, 5, 'Alto Ventuari', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(18, 5, 'Medio Ventuari', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(19, 5, 'Bajo Ventuari', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(20, 6, 'Victorino', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(21, 6, 'Comunidad', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(22, 7, 'Casiquiare', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(23, 7, 'Cocuy', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(24, 7, 'San Carlos de Río Negro', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(25, 7, 'Solano', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(26, 8, 'Anaco', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(27, 8, 'San Joaquín', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(28, 9, 'Cachipo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(29, 9, 'Aragua de Barcelona', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(30, 11, 'Lechería', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(31, 11, 'El Morro', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(32, 12, 'Puerto Píritu', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(33, 12, 'San Miguel', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(34, 12, 'Sucre', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(35, 13, 'Valle de Guanape', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(36, 13, 'Santa Bárbara', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(37, 14, 'El Chaparro', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(38, 14, 'Tomás Alfaro', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(39, 14, 'Calatrava', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(40, 15, 'Guanta', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(41, 15, 'Chorrerón', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(42, 16, 'Mamo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(43, 16, 'Soledad', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(44, 17, 'Mapire', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(45, 17, 'Piar', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(46, 17, 'Santa Clara', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(47, 17, 'San Diego de Cabrutica', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(48, 17, 'Uverito', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(49, 17, 'Zuata', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(50, 18, 'Puerto La Cruz', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(51, 18, 'Pozuelos', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(52, 19, 'Onoto', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(53, 19, 'San Pablo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(54, 20, 'San Mateo', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(55, 20, 'El Carito', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(56, 20, 'Santa Inés', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(57, 20, 'La Romereña', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(58, 21, 'Atapirire', '2024-11-30 14:07:35', '2024-11-30 14:07:35'),
(59, 21, 'Boca del Pao', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(60, 21, 'El Pao', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(61, 21, 'Pariaguán', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(62, 22, 'Cantaura', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(63, 22, 'Libertador', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(64, 22, 'Santa Rosa', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(65, 22, 'Urica', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(66, 23, 'Píritu', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(67, 23, 'San Francisco', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(68, 24, 'San José de Guanipa', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(69, 25, 'Boca de Uchire', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(70, 25, 'Boca de Chávez', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(71, 26, 'Pueblo Nuevo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(72, 26, 'Santa Ana', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(73, 27, 'Bergatín', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(74, 27, 'Caigua', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(75, 27, 'El Carmen', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(76, 27, 'El Pilar', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(77, 27, 'Naricual', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(78, 27, 'San Crsitóbal', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(79, 28, 'Edmundo Barrios', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(80, 28, 'Miguel Otero Silva', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(81, 29, 'Achaguas', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(82, 29, 'Apurito', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(83, 29, 'El Yagual', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(84, 29, 'Guachara', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(85, 29, 'Mucuritas', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(86, 29, 'Queseras del medio', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(87, 30, 'Biruaca', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(88, 31, 'Bruzual', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(89, 31, 'Mantecal', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(90, 31, 'Quintero', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(91, 31, 'Rincón Hondo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(92, 31, 'San Vicente', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(93, 32, 'Guasdualito', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(94, 32, 'Aramendi', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(95, 32, 'El Amparo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(96, 32, 'San Camilo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(97, 32, 'Urdaneta', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(98, 33, 'San Juan de Payara', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(99, 33, 'Codazzi', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(100, 33, 'Cunaviche', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(101, 34, 'Elorza', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(102, 34, 'La Trinidad', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(103, 35, 'San Fernando', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(104, 35, 'El Recreo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(105, 35, 'Peñalver', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(106, 35, 'San Rafael de Atamaica', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(107, 36, 'Pedro José Ovalles', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(108, 36, 'Joaquín Crespo', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(109, 36, 'José Casanova Godoy', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(110, 36, 'Madre María de San José', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(111, 36, 'Andrés Eloy Blanco', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(112, 36, 'Los Tacarigua', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(113, 36, 'Las Delicias', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(114, 36, 'Choroní', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(115, 37, 'Bolívar', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(116, 38, 'Camatagua', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(117, 38, 'Carmen de Cura', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(118, 39, 'Santa Rita', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(119, 39, 'Francisco de Miranda', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(120, 39, 'Moseñor Feliciano González', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(121, 40, 'Santa Cruz', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(122, 41, 'José Félix Ribas', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(123, 41, 'Castor Nieves Ríos', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(124, 41, 'Las Guacamayas', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(125, 41, 'Pao de Zárate', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(126, 41, 'Zuata', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(127, 42, 'José Rafael Revenga', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(128, 43, 'Palo Negro', '2024-11-30 14:07:36', '2024-11-30 14:07:36'),
(129, 43, 'San Martín de Porres', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(130, 44, 'El Limón', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(131, 44, 'Caña de Azúcar', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(132, 45, 'Ocumare de la Costa', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(133, 46, 'San Casimiro', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(134, 46, 'Güiripa', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(135, 46, 'Ollas de Caramacate', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(136, 46, 'Valle Morín', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(137, 47, 'San Sebastían', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(138, 48, 'Turmero', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(139, 48, 'Arevalo Aponte', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(140, 48, 'Chuao', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(141, 48, 'Samán de Güere', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(142, 48, 'Alfredo Pacheco Miranda', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(143, 49, 'Santos Michelena', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(144, 49, 'Tiara', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(145, 50, 'Cagua', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(146, 50, 'Bella Vista', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(147, 51, 'Tovar', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(148, 52, 'Urdaneta', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(149, 52, 'Las Peñitas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(150, 52, 'San Francisco de Cara', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(151, 52, 'Taguay', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(152, 53, 'Zamora', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(153, 53, 'Magdaleno', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(154, 53, 'San Francisco de Asís', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(155, 53, 'Valles de Tucutunemo', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(156, 53, 'Augusto Mijares', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(157, 54, 'Sabaneta', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(158, 54, 'Juan Antonio Rodríguez Domínguez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(159, 55, 'El Cantón', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(160, 55, 'Santa Cruz de Guacas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(161, 55, 'Puerto Vivas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(162, 56, 'Ticoporo', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(163, 56, 'Nicolás Pulido', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(164, 56, 'Andrés Bello', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(165, 57, 'Arismendi', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(166, 57, 'Guadarrama', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(167, 57, 'La Unión', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(168, 57, 'San Antonio', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(169, 58, 'Barinas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(170, 58, 'Alberto Arvelo Larriva', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(171, 58, 'San Silvestre', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(172, 58, 'Santa Inés', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(173, 58, 'Santa Lucía', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(174, 58, 'Torumos', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(175, 58, 'El Carmen', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(176, 58, 'Rómulo Betancourt', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(177, 58, 'Corazón de Jesús', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(178, 58, 'Ramón Ignacio Méndez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(179, 58, 'Alto Barinas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(180, 58, 'Manuel Palacio Fajardo', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(181, 58, 'Juan Antonio Rodríguez Domínguez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(182, 58, 'Dominga Ortiz de Páez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(183, 59, 'Barinitas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(184, 59, 'Altamira de Cáceres', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(185, 59, 'Calderas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(186, 60, 'Barrancas', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(187, 60, 'El Socorro', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(188, 60, 'Mazparrito', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(189, 61, 'Santa Bárbara', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(190, 61, 'Pedro Briceño Méndez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(191, 61, 'Ramón Ignacio Méndez', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(192, 61, 'José Ignacio del Pumar', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(193, 62, 'Obispos', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(194, 62, 'Guasimitos', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(195, 62, 'El Real', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(196, 62, 'La Luz', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(197, 63, 'Ciudad Bolívia', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(198, 63, 'José Ignacio Briceño', '2024-11-30 14:07:37', '2024-11-30 14:07:37'),
(199, 63, 'José Félix Ribas', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(200, 63, 'Páez', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(201, 64, 'Libertad', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(202, 64, 'Dolores', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(203, 64, 'Santa Rosa', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(204, 64, 'Palacio Fajardo', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(205, 65, 'Ciudad de Nutrias', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(206, 65, 'El Regalo', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(207, 65, 'Puerto Nutrias', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(208, 65, 'Santa Catalina', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(209, 66, 'Cachamay', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(210, 66, 'Chirica', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(211, 66, 'Dalla Costa', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(212, 66, 'Once de Abril', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(213, 66, 'Simón Bolívar', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(214, 66, 'Unare', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(215, 66, 'Universidad', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(216, 66, 'Vista al Sol', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(217, 66, 'Pozo Verde', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(218, 66, 'Yocoima', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(219, 66, '5 de Julio', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(220, 67, 'Cedeño', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(221, 67, 'Altagracia', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(222, 67, 'Ascensión Farreras', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(223, 67, 'Guaniamo', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(224, 67, 'La Urbana', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(225, 67, 'Pijiguaos', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(226, 68, 'El Callao', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(227, 69, 'Gran Sabana', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(228, 69, 'Ikabarú', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(229, 70, 'Catedral', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(230, 70, 'Zea', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(231, 70, 'Orinoco', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(232, 70, 'José Antonio Páez', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(233, 70, 'Marhuanta', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(234, 70, 'Agua Salada', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(235, 70, 'Vista Hermosa', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(236, 70, 'La Sabanita', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(237, 70, 'Panapana', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(238, 71, 'Andrés Eloy Blanco', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(239, 71, 'Pedro Cova', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(240, 72, 'Raúl Leoni', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(241, 72, 'Barceloneta', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(242, 72, 'Santa Bárbara', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(243, 72, 'San Francisco', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(244, 73, 'Roscio', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(245, 73, 'Salóm', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(246, 74, 'Sifontes', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(247, 74, 'Dalla Costa', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(248, 74, 'San Isidro', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(249, 75, 'Sucre', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(250, 75, 'Aripao', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(251, 75, 'Guarataro', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(252, 75, 'Las Majadas', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(253, 75, 'Moitaco', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(254, 76, 'Padre Pedro Chien', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(255, 76, 'Río Grande', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(256, 77, 'Bejuma', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(257, 77, 'Canoabo', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(258, 77, 'Simón Bolívar', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(259, 78, 'Güigüe', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(260, 78, 'Carabobo', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(261, 78, 'Tacarigua', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(262, 79, 'Mariara', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(263, 79, 'Aguas Calientes', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(264, 80, 'Ciudad Alianza', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(265, 80, 'Guacara', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(266, 80, 'Yagua', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(267, 81, 'Morón', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(268, 81, 'Yagua', '2024-11-30 14:07:38', '2024-11-30 14:07:38'),
(269, 82, 'Tocuyito', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(270, 82, 'Independencia', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(271, 83, 'Los Guayos', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(272, 84, 'Miranda', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(273, 85, 'Montalbán', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(274, 86, 'Naguanagua', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(275, 87, 'Bartolomé Salóm', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(276, 87, 'Democracia', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(277, 87, 'Fraternidad', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(278, 87, 'Goaigoaza', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(279, 87, 'Juan José Flores', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(280, 87, 'Unión', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(281, 87, 'Borburata', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(282, 87, 'Patanemo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(283, 88, 'San Diego', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(284, 89, 'San Joaquín', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(285, 90, 'Candelaria', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(286, 90, 'Catedral', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(287, 90, 'El Socorro', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(288, 90, 'Miguel Peña', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(289, 90, 'Rafael Urdaneta', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(290, 90, 'San Blas', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(291, 90, 'San José', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(292, 90, 'Santa Rosa', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(293, 90, 'Negro Primero', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(294, 91, 'Cojedes', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(295, 91, 'Juan de Mata Suárez', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(296, 92, 'Tinaquillo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(297, 93, 'El Baúl', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(298, 93, 'Sucre', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(299, 94, 'La Aguadita', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(300, 94, 'Macapo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(301, 95, 'El Pao', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(302, 96, 'El Amparo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(303, 96, 'Libertad de Cojedes', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(304, 97, 'Rómulo Gallegos', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(305, 98, 'San Carlos de Austria', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(306, 98, 'Juan Ángel Bravo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(307, 98, 'Manuel Manrique', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(308, 99, 'General en Jefe José Laurencio Silva', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(309, 100, 'Curiapo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(310, 100, 'Almirante Luis Brión', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(311, 100, 'Francisco Aniceto Lugo', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(312, 100, 'Manuel Renaud', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(313, 100, 'Padre Barral', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(314, 100, 'Santos de Abelgas', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(315, 101, 'Imataca', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(316, 101, 'Cinco de Julio', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(317, 101, 'Juan Bautista Arismendi', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(318, 101, 'Manuel Piar', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(319, 101, 'Rómulo Gallegos', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(320, 102, 'Pedernales', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(321, 102, 'Luis Beltrán Prieto Figueroa', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(322, 103, 'San José (Delta Amacuro)', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(323, 103, 'José Vidal Marcano', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(324, 103, 'Juan Millán', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(325, 103, 'Leonardo Ruíz Pineda', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(326, 103, 'Mariscal Antonio José de Sucre', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(327, 103, 'Monseñor Argimiro García', '2024-11-30 14:07:39', '2024-11-30 14:07:39'),
(328, 103, 'San Rafael (Delta Amacuro)', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(329, 103, 'Virgen del Valle', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(330, 10, 'Clarines', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(331, 10, 'Guanape', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(332, 10, 'Sabana de Uchire', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(333, 104, 'Capadare', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(334, 104, 'La Pastora', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(335, 104, 'Libertador', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(336, 104, 'San Juan de los Cayos', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(337, 105, 'Aracua', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(338, 105, 'La Peña', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(339, 105, 'San Luis', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(340, 106, 'Bariro', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(341, 106, 'Borojó', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(342, 106, 'Capatárida', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(343, 106, 'Guajiro', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(344, 106, 'Seque', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(345, 106, 'Zazárida', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(346, 106, 'Valle de Eroa', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(347, 107, 'Cacique Manaure', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(348, 108, 'Norte', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(349, 108, 'Carirubana', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(350, 108, 'Santa Ana', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(351, 108, 'Urbana Punta Cardón', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(352, 109, 'La Vela de Coro', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(353, 109, 'Acurigua', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(354, 109, 'Guaibacoa', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(355, 109, 'Las Calderas', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(356, 109, 'Macoruca', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(357, 110, 'Dabajuro', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(358, 111, 'Agua Clara', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(359, 111, 'Avaria', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(360, 111, 'Pedregal', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(361, 111, 'Piedra Grande', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(362, 111, 'Purureche', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(363, 112, 'Adaure', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(364, 112, 'Adícora', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(365, 112, 'Baraived', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(366, 112, 'Buena Vista', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(367, 112, 'Jadacaquiva', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(368, 112, 'El Vínculo', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(369, 112, 'El Hato', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(370, 112, 'Moruy', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(371, 112, 'Pueblo Nuevo', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(372, 113, 'Agua Larga', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(373, 113, 'El Paují', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(374, 113, 'Independencia', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(375, 113, 'Mapararí', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(376, 114, 'Agua Linda', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(377, 114, 'Araurima', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(378, 114, 'Jacura', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(379, 115, 'Tucacas', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(380, 115, 'Boca de Aroa', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(381, 116, 'Los Taques', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(382, 116, 'Judibana', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(383, 117, 'Mene de Mauroa', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(384, 117, 'San Félix', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(385, 117, 'Casigua', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(386, 118, 'Guzmán Guillermo', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(387, 118, 'Mitare', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(388, 118, 'Río Seco', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(389, 118, 'Sabaneta', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(390, 118, 'San Antonio', '2024-11-30 14:07:40', '2024-11-30 14:07:40'),
(391, 118, 'San Gabriel', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(392, 118, 'Santa Ana', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(393, 119, 'Boca del Tocuyo', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(394, 119, 'Chichiriviche', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(395, 119, 'Tocuyo de la Costa', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(396, 120, 'Palmasola', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(397, 121, 'Cabure', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(398, 121, 'Colina', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(399, 121, 'Curimagua', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(400, 122, 'San José de la Costa', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(401, 122, 'Píritu', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(402, 123, 'San Francisco', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(403, 124, 'Sucre', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(404, 124, 'Pecaya', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(405, 125, 'Tocópero', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(406, 126, 'El Charal', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(407, 126, 'Las Vegas del Tuy', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(408, 126, 'Santa Cruz de Bucaral', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(409, 127, 'Bruzual', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(410, 127, 'Urumaco', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(411, 128, 'Puerto Cumarebo', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(412, 128, 'La Ciénaga', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(413, 128, 'La Soledad', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(414, 128, 'Pueblo Cumarebo', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(415, 128, 'Zazárida', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(416, 113, 'Churuguara', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(417, 129, 'Camaguán', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(418, 129, 'Puerto Miranda', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(419, 129, 'Uverito', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(420, 130, 'Chaguaramas', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(421, 131, 'El Socorro', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(422, 132, 'Tucupido', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(423, 132, 'San Rafael de Laya', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(424, 133, 'Altagracia de Orituco', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(425, 133, 'San Rafael de Orituco', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(426, 133, 'San Francisco Javier de Lezama', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(427, 133, 'Paso Real de Macaira', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(428, 133, 'Carlos Soublette', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(429, 133, 'San Francisco de Macaira', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(430, 133, 'Libertad de Orituco', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(431, 134, 'Cantaclaro', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(432, 134, 'San Juan de los Morros', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(433, 134, 'Parapara', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(434, 135, 'El Sombrero', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(435, 135, 'Sosa', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(436, 136, 'Las Mercedes', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(437, 136, 'Cabruta', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(438, 136, 'Santa Rita de Manapire', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(439, 137, 'Valle de la Pascua', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(440, 137, 'Espino', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(441, 138, 'San José de Unare', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(442, 138, 'Zaraza', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(443, 139, 'San José de Tiznados', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(444, 139, 'San Francisco de Tiznados', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(445, 139, 'San Lorenzo de Tiznados', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(446, 139, 'Ortiz', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(447, 140, 'Guayabal', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(448, 140, 'Cazorla', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(449, 141, 'San José de Guaribe', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(450, 141, 'Uveral', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(451, 142, 'Santa María de Ipire', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(452, 142, 'Altamira', '2024-11-30 14:07:41', '2024-11-30 14:07:41'),
(453, 143, 'El Calvario', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(454, 143, 'El Rastro', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(455, 143, 'Guardatinajas', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(456, 143, 'Capital Urbana Calabozo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(457, 144, 'Quebrada Honda de Guache', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(458, 144, 'Pío Tamayo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(459, 144, 'Yacambú', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(460, 145, 'Fréitez', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(461, 145, 'José María Blanco', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(462, 146, 'Catedral', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(463, 146, 'Concepción', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(464, 146, 'El Cují', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(465, 146, 'Juan de Villegas', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(466, 146, 'Santa Rosa', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(467, 146, 'Tamaca', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(468, 146, 'Unión', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(469, 146, 'Aguedo Felipe Alvarado', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(470, 146, 'Buena Vista', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(471, 146, 'Juárez', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(472, 147, 'Juan Bautista Rodríguez', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(473, 147, 'Cuara', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(474, 147, 'Diego de Lozada', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(475, 147, 'Paraíso de San José', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(476, 147, 'San Miguel', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(477, 147, 'Tintorero', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(478, 147, 'José Bernardo Dorante', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(479, 147, 'Coronel Mariano Peraza ', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(480, 148, 'Bolívar', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(481, 148, 'Anzoátegui', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(482, 148, 'Guarico', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(483, 148, 'Hilario Luna y Luna', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(484, 148, 'Humocaro Alto', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(485, 148, 'Humocaro Bajo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(486, 148, 'La Candelaria', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(487, 148, 'Morán', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(488, 149, 'Cabudare', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(489, 149, 'José Gregorio Bastidas', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(490, 149, 'Agua Viva', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(491, 150, 'Sarare', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(492, 150, 'Buría', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(493, 150, 'Gustavo Vegas León', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(494, 151, 'Trinidad Samuel', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(495, 151, 'Antonio Díaz', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(496, 151, 'Camacaro', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(497, 151, 'Castañeda', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(498, 151, 'Cecilio Zubillaga', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(499, 151, 'Chiquinquirá', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(500, 151, 'El Blanco', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(501, 151, 'Espinoza de los Monteros', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(502, 151, 'Lara', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(503, 151, 'Las Mercedes', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(504, 151, 'Manuel Morillo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(505, 151, 'Montaña Verde', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(506, 151, 'Montes de Oca', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(507, 151, 'Torres', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(508, 151, 'Heriberto Arroyo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(509, 151, 'Reyes Vargas', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(510, 151, 'Altagracia', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(511, 152, 'Siquisique', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(512, 152, 'Moroturo', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(513, 152, 'San Miguel', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(514, 152, 'Xaguas', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(515, 179, 'Presidente Betancourt', '2024-11-30 14:07:42', '2024-11-30 14:07:42'),
(516, 179, 'Presidente Páez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(517, 179, 'Presidente Rómulo Gallegos', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(518, 179, 'Gabriel Picón González', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(519, 179, 'Héctor Amable Mora', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(520, 179, 'José Nucete Sardi', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(521, 179, 'Pulido Méndez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(522, 180, 'La Azulita', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(523, 181, 'Santa Cruz de Mora', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(524, 181, 'Mesa Bolívar', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(525, 181, 'Mesa de Las Palmas', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(526, 182, 'Aricagua', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(527, 182, 'San Antonio', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(528, 183, 'Canagua', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(529, 183, 'Capurí', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(530, 183, 'Chacantá', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(531, 183, 'El Molino', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(532, 183, 'Guaimaral', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(533, 183, 'Mucutuy', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(534, 183, 'Mucuchachí', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(535, 184, 'Fernández Peña', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(536, 184, 'Matriz', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(537, 184, 'Montalbán', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(538, 184, 'Acequias', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(539, 184, 'Jají', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(540, 184, 'La Mesa', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(541, 184, 'San José del Sur', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(542, 185, 'Tucaní', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(543, 185, 'Florencio Ramírez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(544, 186, 'Santo Domingo', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(545, 186, 'Las Piedras', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(546, 187, 'Guaraque', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(547, 187, 'Mesa de Quintero', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(548, 187, 'Río Negro', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(549, 188, 'Arapuey', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(550, 188, 'Palmira', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(551, 189, 'San Cristóbal de Torondoy', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(552, 189, 'Torondoy', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(553, 190, 'Antonio Spinetti Dini', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(554, 190, 'Arias', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(555, 190, 'Caracciolo Parra Pérez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(556, 190, 'Domingo Peña', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(557, 190, 'El Llano', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(558, 190, 'Gonzalo Picón Febres', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(559, 190, 'Jacinto Plaza', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(560, 190, 'Juan Rodríguez Suárez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(561, 190, 'Lasso de la Vega', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(562, 190, 'Mariano Picón Salas', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(563, 190, 'Milla', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(564, 190, 'Osuna Rodríguez', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(565, 190, 'Sagrario', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(566, 190, 'El Morro', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(567, 190, 'Los Nevados', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(568, 191, 'Andrés Eloy Blanco', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(569, 191, 'La Venta', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(570, 191, 'Piñango', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(571, 191, 'Timotes', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(572, 192, 'Eloy Paredes', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(573, 192, 'San Rafael de Alcázar', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(574, 192, 'Santa Elena de Arenales', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(575, 193, 'Santa María de Caparo', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(576, 194, 'Pueblo Llano', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(577, 195, 'Cacute', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(578, 195, 'La Toma', '2024-11-30 14:07:43', '2024-11-30 14:07:43'),
(579, 195, 'Mucuchíes', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(580, 195, 'Mucurubá', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(581, 195, 'San Rafael', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(582, 196, 'Gerónimo Maldonado', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(583, 196, 'Bailadores', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(584, 197, 'Tabay', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(585, 198, 'Chiguará', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(586, 198, 'Estánquez', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(587, 198, 'Lagunillas', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(588, 198, 'La Trampa', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(589, 198, 'Pueblo Nuevo del Sur', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(590, 198, 'San Juan', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(591, 199, 'El Amparo', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(592, 199, 'El Llano', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(593, 199, 'San Francisco', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(594, 199, 'Tovar', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(595, 200, 'Independencia', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(596, 200, 'María de la Concepción Palacios Blanco', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(597, 200, 'Nueva Bolivia', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(598, 200, 'Santa Apolonia', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(599, 201, 'Caño El Tigre', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(600, 201, 'Zea', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(601, 223, 'Aragüita', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(602, 223, 'Arévalo González', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(603, 223, 'Capaya', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(604, 223, 'Caucagua', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(605, 223, 'Panaquire', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(606, 223, 'Ribas', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(607, 223, 'El Café', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(608, 223, 'Marizapa', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(609, 224, 'Cumbo', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(610, 224, 'San José de Barlovento', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(611, 225, 'El Cafetal', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(612, 225, 'Las Minas', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(613, 225, 'Nuestra Señora del Rosario', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(614, 226, 'Higuerote', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(615, 226, 'Curiepe', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(616, 226, 'Tacarigua de Brión', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(617, 227, 'Mamporal', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(618, 228, 'Carrizal', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(619, 229, 'Chacao', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(620, 230, 'Charallave', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(621, 230, 'Las Brisas', '2024-11-30 14:07:44', '2024-11-30 14:07:44'),
(622, 231, 'El Hatillo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(623, 232, 'Altagracia de la Montaña', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(624, 232, 'Cecilio Acosta', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(625, 232, 'Los Teques', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(626, 232, 'El Jarillo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(627, 232, 'San Pedro', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(628, 232, 'Tácata', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(629, 232, 'Paracotos', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(630, 233, 'Cartanal', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(631, 233, 'Santa Teresa del Tuy', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(632, 234, 'La Democracia', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(633, 234, 'Ocumare del Tuy', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(634, 234, 'Santa Bárbara', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(635, 235, 'San Antonio de los Altos', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(636, 236, 'Río Chico', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(637, 236, 'El Guapo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(638, 236, 'Tacarigua de la Laguna', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(639, 236, 'Paparo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(640, 236, 'San Fernando del Guapo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(641, 237, 'Santa Lucía del Tuy', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(642, 238, 'Cúpira', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(643, 238, 'Machurucuto', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(644, 239, 'Guarenas', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(645, 240, 'San Antonio de Yare', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(646, 240, 'San Francisco de Yare', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(647, 241, 'Leoncio Martínez', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(648, 241, 'Petare', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(649, 241, 'Caucagüita', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(650, 241, 'Filas de Mariche', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(651, 241, 'La Dolorita', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(652, 242, 'Cúa', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(653, 242, 'Nueva Cúa', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(654, 243, 'Guatire', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(655, 243, 'Bolívar', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(656, 258, 'San Antonio de Maturín', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(657, 258, 'San Francisco de Maturín', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(658, 259, 'Aguasay', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(659, 260, 'Caripito', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(660, 261, 'El Guácharo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(661, 261, 'La Guanota', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(662, 261, 'Sabana de Piedra', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(663, 261, 'San Agustín', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(664, 261, 'Teresen', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(665, 261, 'Caripe', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(666, 262, 'Areo', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(667, 262, 'Capital Cedeño', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(668, 262, 'San Félix de Cantalicio', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(669, 262, 'Viento Fresco', '2024-11-30 14:07:45', '2024-11-30 14:07:45'),
(670, 263, 'El Tejero', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(671, 263, 'Punta de Mata', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(672, 264, 'Chaguaramas', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(673, 264, 'Las Alhuacas', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(674, 264, 'Tabasca', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(675, 264, 'Temblador', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(676, 265, 'Alto de los Godos', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(677, 265, 'Boquerón', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(678, 265, 'Las Cocuizas', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(679, 265, 'La Cruz', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(680, 265, 'San Simón', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(681, 265, 'El Corozo', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(682, 265, 'El Furrial', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(683, 265, 'Jusepín', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(684, 265, 'La Pica', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(685, 265, 'San Vicente', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(686, 266, 'Aparicio', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(687, 266, 'Aragua de Maturín', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(688, 266, 'Chaguamal', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(689, 266, 'El Pinto', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(690, 266, 'Guanaguana', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(691, 266, 'La Toscana', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(692, 266, 'Taguaya', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(693, 267, 'Cachipo', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(694, 267, 'Quiriquire', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(695, 268, 'Santa Bárbara', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(696, 269, 'Barrancas', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(697, 269, 'Los Barrancos de Fajardo', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(698, 270, 'Uracoa', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(699, 271, 'Antolín del Campo', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(700, 272, 'Arismendi', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(701, 273, 'García', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(702, 273, 'Francisco Fajardo', '2024-11-30 14:07:46', '2024-11-30 14:07:46');
INSERT INTO `parroquias` (`id`, `municipio_id`, `parroquia`, `created_at`, `updated_at`) VALUES
(703, 274, 'Bolívar', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(704, 274, 'Guevara', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(705, 274, 'Matasiete', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(706, 274, 'Santa Ana', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(707, 274, 'Sucre', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(708, 275, 'Aguirre', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(709, 275, 'Maneiro', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(710, 276, 'Adrián', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(711, 276, 'Juan Griego', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(712, 276, 'Yaguaraparo', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(713, 277, 'Porlamar', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(714, 278, 'San Francisco de Macanao', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(715, 278, 'Boca de Río', '2024-11-30 14:07:46', '2024-11-30 14:07:46'),
(716, 279, 'Tubores', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(717, 279, 'Los Baleales', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(718, 280, 'Vicente Fuentes', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(719, 280, 'Villalba', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(720, 281, 'San Juan Bautista', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(721, 281, 'Zabala', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(722, 283, 'Capital Araure', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(723, 283, 'Río Acarigua', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(724, 284, 'Capital Esteller', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(725, 284, 'Uveral', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(726, 285, 'Guanare', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(727, 285, 'Córdoba', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(728, 285, 'San José de la Montaña', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(729, 285, 'San Juan de Guanaguanare', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(730, 285, 'Virgen de la Coromoto', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(731, 286, 'Guanarito', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(732, 286, 'Trinidad de la Capilla', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(733, 286, 'Divina Pastora', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(734, 287, 'Monseñor José Vicente de Unda', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(735, 287, 'Peña Blanca', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(736, 288, 'Capital Ospino', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(737, 288, 'Aparición', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(738, 288, 'La Estación', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(739, 289, 'Páez', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(740, 289, 'Payara', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(741, 289, 'Pimpinela', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(742, 289, 'Ramón Peraza', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(743, 290, 'Papelón', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(744, 290, 'Caño Delgadito', '2024-11-30 14:07:47', '2024-11-30 14:07:47'),
(745, 291, 'San Genaro de Boconoito', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(746, 291, 'Antolín Tovar', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(747, 292, 'San Rafael de Onoto', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(748, 292, 'Santa Fe', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(749, 292, 'Thermo Morles', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(750, 293, 'Santa Rosalía', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(751, 293, 'Florida', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(752, 294, 'Sucre', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(753, 294, 'Concepción', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(754, 294, 'San Rafael de Palo Alzado', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(755, 294, 'Uvencio Antonio Velásquez', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(756, 294, 'San José de Saguaz', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(757, 294, 'Villa Rosa', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(758, 295, 'Turén', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(759, 295, 'Canelones', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(760, 295, 'Santa Cruz', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(761, 295, 'San Isidro Labrador', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(762, 296, 'Mariño', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(763, 296, 'Rómulo Gallegos', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(764, 297, 'San José de Aerocuar', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(765, 297, 'Tavera Acosta', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(766, 298, 'Río Caribe', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(767, 298, 'Antonio José de Sucre', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(768, 298, 'El Morro de Puerto Santo', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(769, 298, 'Puerto Santo', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(770, 298, 'San Juan de las Galdonas', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(771, 299, 'El Pilar', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(772, 299, 'El Rincón', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(773, 299, 'General Francisco Antonio Váquez', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(774, 299, 'Guaraúnos', '2024-11-30 14:07:48', '2024-11-30 14:07:48'),
(775, 299, 'Tunapuicito', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(776, 299, 'Unión', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(777, 300, 'Santa Catalina', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(778, 300, 'Santa Rosa', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(779, 300, 'Santa Teresa', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(780, 300, 'Bolívar', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(781, 300, 'Maracapana', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(782, 302, 'Libertad', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(783, 302, 'El Paujil', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(784, 302, 'Yaguaraparo', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(785, 303, 'Cruz Salmerón Acosta', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(786, 303, 'Chacopata', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(787, 303, 'Manicuare', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(788, 304, 'Tunapuy', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(789, 304, 'Campo Elías', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(790, 305, 'Irapa', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(791, 305, 'Campo Claro', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(792, 305, 'Maraval', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(793, 305, 'San Antonio de Irapa', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(794, 305, 'Soro', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(795, 306, 'Mejía', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(796, 307, 'Cumanacoa', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(797, 307, 'Arenas', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(798, 307, 'Aricagua', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(799, 307, 'Cogollar', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(800, 307, 'San Fernando', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(801, 307, 'San Lorenzo', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(802, 308, 'Villa Frontado (Muelle de Cariaco)', '2024-11-30 14:07:49', '2024-11-30 14:07:49'),
(803, 308, 'Catuaro', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(804, 308, 'Rendón', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(805, 308, 'San Cruz', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(806, 308, 'Santa María', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(807, 309, 'Altagracia', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(808, 309, 'Santa Inés', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(809, 309, 'Valentín Valiente', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(810, 309, 'Ayacucho', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(811, 309, 'San Juan', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(812, 309, 'Raúl Leoni', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(813, 309, 'Gran Mariscal', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(814, 310, 'Cristóbal Colón', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(815, 310, 'Bideau', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(816, 310, 'Punta de Piedras', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(817, 310, 'Güiria', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(818, 341, 'Andrés Bello', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(819, 342, 'Antonio Rómulo Costa', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(820, 343, 'Ayacucho', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(821, 343, 'Rivas Berti', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(822, 343, 'San Pedro del Río', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(823, 344, 'Bolívar', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(824, 344, 'Palotal', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(825, 344, 'General Juan Vicente Gómez', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(826, 344, 'Isaías Medina Angarita', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(827, 345, 'Cárdenas', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(828, 345, 'Amenodoro Ángel Lamus', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(829, 345, 'La Florida', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(830, 346, 'Córdoba', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(831, 347, 'Fernández Feo', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(832, 347, 'Alberto Adriani', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(833, 347, 'Santo Domingo', '2024-11-30 14:07:50', '2024-11-30 14:07:50'),
(834, 348, 'Francisco de Miranda', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(835, 349, 'García de Hevia', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(836, 349, 'Boca de Grita', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(837, 349, 'José Antonio Páez', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(838, 350, 'Guásimos', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(839, 351, 'Independencia', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(840, 351, 'Juan Germán Roscio', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(841, 351, 'Román Cárdenas', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(842, 352, 'Jáuregui', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(843, 352, 'Emilio Constantino Guerrero', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(844, 352, 'Monseñor Miguel Antonio Salas', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(845, 353, 'José María Vargas', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(846, 354, 'Junín', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(847, 354, 'La Petrólea', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(848, 354, 'Quinimarí', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(849, 354, 'Bramón', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(850, 355, 'Libertad', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(851, 355, 'Cipriano Castro', '2024-11-30 14:07:51', '2024-11-30 14:07:51'),
(852, 355, 'Manuel Felipe Rugeles', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(853, 356, 'Libertador', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(854, 356, 'Doradas', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(855, 356, 'Emeterio Ochoa', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(856, 356, 'San Joaquín de Navay', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(857, 357, 'Lobatera', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(858, 357, 'Constitución', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(859, 358, 'Michelena', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(860, 359, 'Panamericano', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(861, 359, 'La Palmita', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(862, 360, 'Pedro María Ureña', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(863, 360, 'Nueva Arcadia', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(864, 361, 'Delicias', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(865, 361, 'Pecaya', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(866, 362, 'Samuel Darío Maldonado', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(867, 362, 'Boconó', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(868, 362, 'Hernández', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(869, 363, 'La Concordia', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(870, 363, 'San Juan Bautista', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(871, 363, 'Pedro María Morantes', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(872, 363, 'San Sebastián', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(873, 363, 'Dr. Francisco Romero Lobo', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(874, 364, 'Seboruco', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(875, 365, 'Simón Rodríguez', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(876, 366, 'Sucre', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(877, 366, 'Eleazar López Contreras', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(878, 366, 'San Pablo', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(879, 367, 'Torbes', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(880, 368, 'Uribante', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(881, 368, 'Cárdenas', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(882, 368, 'Juan Pablo Peñalosa', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(883, 368, 'Potosí', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(884, 369, 'San Judas Tadeo', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(885, 370, 'Araguaney', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(886, 370, 'El Jaguito', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(887, 370, 'La Esperanza', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(888, 370, 'Santa Isabel', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(889, 371, 'Boconó', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(890, 371, 'El Carmen', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(891, 371, 'Mosquey', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(892, 371, 'Ayacucho', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(893, 371, 'Burbusay', '2024-11-30 14:07:52', '2024-11-30 14:07:52'),
(894, 371, 'General Ribas', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(895, 371, 'Guaramacal', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(896, 371, 'Vega de Guaramacal', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(897, 371, 'Monseñor Jáuregui', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(898, 371, 'Rafael Rangel', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(899, 371, 'San Miguel', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(900, 371, 'San José', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(901, 372, 'Sabana Grande', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(902, 372, 'Cheregüé', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(903, 372, 'Granados', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(904, 373, 'Arnoldo Gabaldón', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(905, 373, 'Bolivia', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(906, 373, 'Carrillo', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(907, 373, 'Cegarra', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(908, 373, 'Chejendé', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(909, 373, 'Manuel Salvador Ulloa', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(910, 373, 'San José', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(911, 374, 'Carache', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(912, 374, 'La Concepción', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(913, 374, 'Cuicas', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(914, 374, 'Panamericana', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(915, 374, 'Santa Cruz', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(916, 375, 'Escuque', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(917, 375, 'La Unión', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(918, 375, 'Santa Rita', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(919, 375, 'Sabana Libre', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(920, 376, 'El Socorro', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(921, 376, 'Los Caprichos', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(922, 376, 'Antonio José de Sucre', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(923, 377, 'Campo Elías', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(924, 377, 'Arnoldo Gabaldón', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(925, 378, 'Santa Apolonia', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(926, 378, 'El Progreso', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(927, 378, 'La Ceiba', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(928, 378, 'Tres de Febrero', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(929, 379, 'El Dividive', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(930, 379, 'Agua Santa', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(931, 379, 'Agua Caliente', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(932, 379, 'El Cenizo', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(933, 379, 'Valerita', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(934, 380, 'Monte Carmelo', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(935, 380, 'Buena Vista', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(936, 380, 'Santa María del Horcón', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(937, 381, 'Motatán', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(938, 381, 'El Baño', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(939, 381, 'Jalisco', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(940, 382, 'Pampán', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(941, 382, 'Flor de Patria', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(942, 382, 'La Paz', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(943, 382, 'Santa Ana', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(944, 383, 'Pampanito', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(945, 383, 'La Concepción', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(946, 383, 'Pampanito II', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(947, 384, 'Betijoque', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(948, 384, 'José Gregorio Hernández', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(949, 384, 'La Pueblita', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(950, 384, 'Los Cedros', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(951, 385, 'Carvajal', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(952, 385, 'Campo Alegre', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(953, 385, 'Antonio Nicolás Briceño', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(954, 385, 'José Leonardo Suárez', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(955, 386, 'Sabana de Mendoza', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(956, 386, 'Junín', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(957, 386, 'Valmore Rodríguez', '2024-11-30 14:07:53', '2024-11-30 14:07:53'),
(958, 386, 'El Paraíso', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(959, 387, 'Andrés Linares', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(960, 387, 'Chiquinquirá', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(961, 387, 'Cristóbal Mendoza', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(962, 387, 'Cruz Carrillo', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(963, 387, 'Matriz', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(964, 387, 'Monseñor Carrillo', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(965, 387, 'Tres Esquinas', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(966, 388, 'Cabimbú', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(967, 388, 'Jajó', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(968, 388, 'La Mesa de Esnujaque', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(969, 388, 'Santiago', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(970, 388, 'Tuñame', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(971, 388, 'La Quebrada', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(972, 389, 'Juan Ignacio Montilla', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(973, 389, 'La Beatriz', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(974, 389, 'La Puerta', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(975, 389, 'Mendoza del Valle de Momboy', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(976, 389, 'Mercedes Díaz', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(977, 389, 'San Luis', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(978, 390, 'Caraballeda', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(979, 390, 'Carayaca', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(980, 390, 'Carlos Soublette', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(981, 390, 'Caruao Chuspa', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(982, 390, 'Catia La Mar', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(983, 390, 'El Junko', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(984, 390, 'La Guaira', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(985, 390, 'Macuto', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(986, 390, 'Maiquetía', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(987, 390, 'Naiguatá', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(988, 390, 'Urimare', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(989, 391, 'Arístides Bastidas', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(990, 392, 'Bolívar', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(991, 407, 'Chivacoa', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(992, 407, 'Campo Elías', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(993, 408, 'Cocorote', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(994, 409, 'Independencia', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(995, 410, 'José Antonio Páez', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(996, 411, 'La Trinidad', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(997, 412, 'Manuel Monge', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(998, 413, 'Salóm', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(999, 413, 'Temerla', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1000, 413, 'Nirgua', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1001, 414, 'San Andrés', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1002, 414, 'Yaritagua', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1003, 415, 'San Javier', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1004, 415, 'Albarico', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1005, 415, 'San Felipe', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1006, 416, 'Sucre', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1007, 417, 'Urachiche', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1008, 418, 'El Guayabo', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1009, 418, 'Farriar', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1010, 441, 'Isla de Toas', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1011, 441, 'Monagas', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1012, 442, 'San Timoteo', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1013, 442, 'General Urdaneta', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1014, 442, 'Libertador', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1015, 442, 'Marcelino Briceño', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1016, 442, 'Pueblo Nuevo', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1017, 442, 'Manuel Guanipa Matos', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1018, 443, 'Ambrosio', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1019, 443, 'Carmen Herrera', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1020, 443, 'La Rosa', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1021, 443, 'Germán Ríos Linares', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1022, 443, 'San Benito', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1023, 443, 'Rómulo Betancourt', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1024, 443, 'Jorge Hernández', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1025, 443, 'Punta Gorda', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1026, 443, 'Arístides Calvani', '2024-11-30 14:07:54', '2024-11-30 14:07:54'),
(1027, 444, 'Encontrados', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1028, 444, 'Udón Pérez', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1029, 445, 'Moralito', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1030, 445, 'San Carlos del Zulia', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1031, 445, 'Santa Cruz del Zulia', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1032, 445, 'Santa Bárbara', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1033, 445, 'Urribarrí', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1034, 446, 'Carlos Quevedo', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1035, 446, 'Francisco Javier Pulgar', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1036, 446, 'Simón Rodríguez', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1037, 446, 'Guamo-Gavilanes', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1038, 448, 'La Concepción', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1039, 448, 'San José', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1040, 448, 'Mariano Parra León', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1041, 448, 'José Ramón Yépez', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1042, 449, 'Jesús María Semprún', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1043, 449, 'Barí', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1044, 450, 'Concepción', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1045, 450, 'Andrés Bello', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1046, 450, 'Chiquinquirá', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1047, 450, 'El Carmelo', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1048, 450, 'Potreritos', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1049, 451, 'Libertad', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1050, 451, 'Alonso de Ojeda', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1051, 451, 'Venezuela', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1052, 451, 'Eleazar López Contreras', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1053, 451, 'Campo Lara', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1054, 452, 'Bartolomé de las Casas', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1055, 452, 'Libertad', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1056, 452, 'Río Negro', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1057, 452, 'San José de Perijá', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1058, 453, 'San Rafael', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1059, 453, 'La Sierrita', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1060, 453, 'Las Parcelas', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1061, 453, 'Luis de Vicente', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1062, 453, 'Monseñor Marcos Sergio Godoy', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1063, 453, 'Ricaurte', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1064, 453, 'Tamare', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1065, 454, 'Antonio Borjas Romero', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1066, 454, 'Bolívar', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1067, 454, 'Cacique Mara', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1068, 454, 'Carracciolo Parra Pérez', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1069, 454, 'Cecilio Acosta', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1070, 454, 'Cristo de Aranza', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1071, 454, 'Coquivacoa', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1072, 454, 'Chiquinquirá', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1073, 454, 'Francisco Eugenio Bustamante', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1074, 454, 'Idelfonzo Vásquez', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1075, 454, 'Juana de Ávila', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1076, 454, 'Luis Hurtado Higuera', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1077, 454, 'Manuel Dagnino', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1078, 454, 'Olegario Villalobos', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1079, 454, 'Raúl Leoni', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1080, 454, 'Santa Lucía', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1081, 454, 'Venancio Pulgar', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1082, 454, 'San Isidro', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1083, 455, 'Altagracia', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1084, 455, 'Faría', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1085, 455, 'Ana María Campos', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1086, 455, 'San Antonio', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1087, 455, 'San José', '2024-11-30 14:07:55', '2024-11-30 14:07:55'),
(1088, 456, 'Donaldo García', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1089, 456, 'El Rosario', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1090, 456, 'Sixto Zambrano', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1091, 457, 'San Francisco', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1092, 457, 'El Bajo', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1093, 457, 'Domitila Flores', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1094, 457, 'Francisco Ochoa', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1095, 457, 'Los Cortijos', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1096, 457, 'Marcial Hernández', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1097, 458, 'Santa Rita', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1098, 458, 'El Mene', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1099, 458, 'Pedro Lucas Urribarrí', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1100, 458, 'José Cenobio Urribarrí', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1101, 459, 'Rafael Maria Baralt', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1102, 459, 'Manuel Manrique', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1103, 459, 'Rafael Urdaneta', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1104, 460, 'Bobures', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1105, 460, 'Gibraltar', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1106, 460, 'Heras', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1107, 460, 'Monseñor Arturo Álvarez', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1108, 460, 'Rómulo Gallegos', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1109, 460, 'El Batey', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1110, 461, 'Rafael Urdaneta', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1111, 461, 'La Victoria', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1112, 461, 'Raúl Cuenca', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1113, 447, 'Sinamaica', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1114, 447, 'Alta Guajira', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1115, 447, 'Elías Sánchez Rubio', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1116, 447, 'Guajira', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1117, 462, 'Altagracia', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1118, 462, 'Antímano', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1119, 462, 'Caricuao', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1120, 462, 'Catedral', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1121, 462, 'Coche', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1122, 462, 'El Junquito', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1123, 462, 'El Paraíso', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1124, 462, 'El Recreo', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1125, 462, 'El Valle', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1126, 462, 'La Candelaria', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1127, 462, 'La Pastora', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1128, 462, 'La Vega', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1129, 462, 'Macarao', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1130, 462, 'San Agustín', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1131, 462, 'San Bernardino', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1132, 462, 'San José', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1133, 462, 'San Juan', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1134, 462, 'San Pedro', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1135, 462, 'Santa Rosalía', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1136, 462, 'Santa Teresa', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1137, 462, 'Sucre (Catia)', '2024-11-30 14:07:56', '2024-11-30 14:07:56'),
(1138, 462, '23 de enero', '2024-11-30 14:07:56', '2024-11-30 14:07:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tipo_prueba_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_desarrollo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rango_prueba_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `nombre`, `descripcion`, `status`, `tipo_prueba_id`, `area_desarrollo_id`, `rango_prueba_id`, `created_at`, `updated_at`) VALUES
(1, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'inactiva', 1, 1, 1, '2024-11-30 14:53:09', '2024-12-03 22:44:11'),
(2, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'activa', 1, 1, 2, '2024-11-30 14:57:29', '2024-11-30 14:57:29'),
(3, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'inactiva', 1, 1, 3, '2024-11-30 15:05:43', '2024-12-04 01:08:35'),
(4, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'inactiva', 1, 1, 4, '2024-11-30 15:13:32', '2024-12-04 01:21:10'),
(5, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'activa', 1, 1, 5, '2024-11-30 15:17:59', '2024-11-30 15:17:59'),
(6, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'inactiva', 1, 1, 6, '2024-11-30 15:28:02', '2024-12-04 01:22:18'),
(7, 'Descubre su entorno', 'Se le estaran presnetando distintos estimolos al niño para observar su reaccion', 'inactiva', 1, 1, 7, '2024-11-30 15:31:36', '2024-12-04 01:20:50'),
(8, 'Descubre su entorno', 'Se le estaran presentando distintos estimolos al niño para observar su reaccion', 'activa', 1, 1, 8, '2024-12-02 01:44:08', '2024-12-02 01:44:08'),
(9, 'Descubre su entorno', 'Se le estaran presentando distintos estimolos al niño para observar su reaccion', 'activa', 1, 1, 9, '2024-12-02 02:06:34', '2024-12-02 02:06:34'),
(10, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 10, '2024-12-02 02:12:21', '2024-12-02 02:12:21'),
(11, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 11, '2024-12-02 02:19:46', '2024-12-02 02:19:46'),
(12, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 12, '2024-12-02 02:31:11', '2024-12-02 02:31:11'),
(13, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 13, '2024-12-02 02:36:05', '2024-12-02 02:36:05'),
(14, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 14, '2024-12-02 02:49:56', '2024-12-02 02:49:56'),
(15, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 15, '2024-12-02 02:53:47', '2024-12-02 02:53:47'),
(16, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 16, '2024-12-02 02:57:47', '2024-12-02 02:57:47'),
(17, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su raccion', 'activa', 1, 1, 17, '2024-12-02 03:12:55', '2024-12-02 03:12:55'),
(18, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 18, '2024-12-02 03:16:58', '2024-12-02 03:16:58'),
(19, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 19, '2024-12-02 03:20:14', '2024-12-02 03:20:14'),
(20, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 20, '2024-12-02 03:24:35', '2024-12-02 03:24:35'),
(21, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 21, '2024-12-02 03:28:05', '2024-12-02 03:28:05'),
(22, 'Descubre su entorno', 'Se le estaran presentando distintos estimulos al niño para observar su reaccion', 'activa', 1, 1, 22, '2024-12-02 03:32:05', '2024-12-02 03:32:05'),
(23, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 1, '2024-12-02 03:37:48', '2024-12-02 03:37:48'),
(24, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 2, '2024-12-02 08:16:02', '2024-12-02 08:16:02'),
(25, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 3, '2024-12-02 08:20:05', '2024-12-02 08:20:05'),
(26, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 4, '2024-12-02 08:23:46', '2024-12-02 08:23:46'),
(27, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 5, '2024-12-02 08:26:39', '2024-12-02 08:26:39'),
(28, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 6, '2024-12-02 08:29:29', '2024-12-02 08:29:29'),
(29, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 7, '2024-12-02 08:32:24', '2024-12-02 08:32:24'),
(30, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 8, '2024-12-02 08:35:27', '2024-12-02 08:35:27'),
(31, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 9, '2024-12-02 08:38:20', '2024-12-02 08:38:20'),
(32, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 10, '2024-12-02 08:40:34', '2024-12-02 08:40:34'),
(33, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 11, '2024-12-02 08:44:44', '2024-12-02 08:44:44'),
(34, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 12, '2024-12-02 08:47:16', '2024-12-02 08:47:16'),
(35, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 13, '2024-12-02 08:50:14', '2024-12-02 08:50:14'),
(36, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 14, '2024-12-02 08:53:08', '2024-12-02 08:53:08'),
(37, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 15, '2024-12-02 08:56:19', '2024-12-02 08:56:19'),
(38, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 16, '2024-12-02 08:59:45', '2024-12-02 08:59:45'),
(39, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 17, '2024-12-02 09:02:49', '2024-12-02 09:02:49'),
(40, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 18, '2024-12-02 09:06:02', '2024-12-02 09:06:02'),
(41, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 19, '2024-12-02 09:08:41', '2024-12-02 09:08:41'),
(42, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 20, '2024-12-02 09:11:31', '2024-12-02 09:11:31'),
(43, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 21, '2024-12-02 09:14:11', '2024-12-02 09:14:11'),
(44, 'Area del lenguaje', 'Al niño se le estaran presentando distintos estimulos para observar su reaccion', 'activa', 1, 2, 22, '2024-12-02 09:16:51', '2024-12-02 09:16:51'),
(45, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 1, '2024-12-04 23:57:01', '2024-12-04 23:57:01'),
(46, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 2, '2024-12-05 00:01:05', '2024-12-05 00:01:05'),
(47, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 3, '2024-12-05 00:04:03', '2024-12-05 00:04:03'),
(48, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 4, '2024-12-05 00:09:34', '2024-12-05 00:09:34'),
(49, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 5, '2024-12-05 00:13:19', '2024-12-05 00:13:19'),
(50, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 6, '2024-12-05 00:17:49', '2024-12-05 00:17:49'),
(51, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 7, '2024-12-05 00:21:44', '2024-12-05 00:21:44'),
(52, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 8, '2024-12-05 00:24:45', '2024-12-05 00:24:45'),
(53, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 9, '2024-12-05 00:27:38', '2024-12-05 00:27:38'),
(54, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 10, '2024-12-05 00:31:35', '2024-12-05 00:31:35'),
(55, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 11, '2024-12-05 00:35:47', '2024-12-05 00:35:47'),
(56, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 12, '2024-12-05 00:51:04', '2024-12-05 00:51:04'),
(57, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 13, '2024-12-05 00:56:02', '2024-12-05 00:56:02'),
(58, 'Motricidad gruesa', 'Al niño se le observara en distintas sircunstancias para ver su desarrollo motor', 'activa', 1, 3, 14, '2024-12-05 01:00:59', '2024-12-05 01:00:59'),
(59, 'CUMANIN', 'El niño debera seguir las intrucciones del especialista, esto con el fin de definir su lateralidad', 'activa', 2, 4, 24, '2025-01-19 11:59:11', '2025-01-19 11:59:11'),
(60, 'CUMANIN', 'El especialista debe pronunciar cada palabra articulando con claridad y el niño debe repetirlas', 'activa', 2, 7, 24, '2025-01-19 23:09:54', '2025-01-19 23:09:54'),
(61, 'CUMANIN', 'El especialista pronunciara despacio cada frase y el niño las repetira a continuacion, cada frase pronuciada  bien se valorara en 1 punto', 'activa', 2, 8, 23, '2025-01-19 23:15:54', '2025-01-19 23:15:54'),
(62, 'CUMANIN', 'A continuación el especialista le leerá un breve cuento al niño y el deberá responder las preguntas que se le realicen al final de la lectura. \"Raquel fue al circo el domingo por la tarde. El circo estaba en la plaza. Su papá le compro palomitas. Actuó un domador de leones, que llevaba una capa, y también payasos muy divertidos. Uno de los trapecistas se cayo sobre la red, y la gente se asusto mucho. Al terminar la función la niña se marcho a casa de sus abuelos y le contó que lo que mas le había gustado fue la función de las focas\"', 'activa', 2, 9, 24, '2025-01-19 23:45:11', '2025-01-19 23:45:11'),
(63, 'CUMANIN', 'El especialista se situara frente al niño y deberá realizar las ordenes que se le indiquen. Para la ultima tarea se usara el anexo numero uno de la prueba, en caso de que el niño no cumpla todos los objetivos de la prueba, se le pedirá que trace los puntos de la figura del anexo y se marcara con que mano lo hizo, de lo contrario si los completa deberá, seguir estas instrucciones realizando los dibujos en la parte inferior de la hoja, tomando en cuenta el punto del medio \"Dibuja dos cuadrados hacia abajo, dos cuadrados hacia la derecha, un cuadrado hacia arriba y un cuadrado hacia la izquierda\"', 'activa', 2, 10, 24, '2025-01-20 01:02:59', '2025-01-20 01:02:59'),
(64, 'CUMANIN', 'El niño reproducirá, con un lapicero las figuras que se le representan en las tres paginas del anexo dos, no se usara borra y si se equivoca se le recomendara hacer mejor la próxima figura, se acabara la prueba cuando se reproduzcan mal cuatro imágenes seguidas. Al niño se le indicara lo siguiente \"Copia estos dibujos lo mejor que puedas\"', 'activa', 2, 11, 24, '2025-01-20 01:25:16', '2025-01-20 01:25:16'),
(65, 'CUMANIN', 'El especialista presenta al niño una lamina con unas imagenes durante un minuto, despues se le preguntara al niño durante 90 segundos cuales eran las imagenes y el niño debe responder las que se acuerde. Al niño se le daran las siguientes instrucciones \"Te voy a enseñar una lamina con unos dibujos durante un rato, presta mucha antencion y despues me responderas los dibujjos que recuerdes\"', 'activa', 2, 12, 24, '2025-01-20 02:30:48', '2025-01-20 02:30:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `psicomotricidad_cumanins`
--

CREATE TABLE `psicomotricidad_cumanins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `psicomotricidad_cumanins`
--

INSERT INTO `psicomotricidad_cumanins` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 3, '99', '11', '10-11', '11', '11', '11', 'NULL', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(2, 3, '98', '10', '-', '-', '-', '-', 'NULL', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(3, 3, '97', '-', '-', '-', '-', '-', 'NULL', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(4, 3, '96', '9', '9', '-', '-', '-', '11', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(5, 3, '95', '8', '-', '10', '10', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(6, 3, '90', '-', '-', '-', '-', '10', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(7, 3, '85', '7', '8', '9', '-', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(8, 3, '80', '-', '-', '-', '9', '-', '10', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(9, 3, '75', '6', '-', '8', '-', '9', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(10, 3, '70', '-', '7', '-', '-', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(11, 3, '65', '-', '-', '-', '8', '-', '9', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(12, 3, '60', '-', '-', '-', '-', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(13, 3, '55', '5', '6', '-', '-', '8', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(14, 3, '50', '-', '-', '7', '-', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(15, 3, '45', '-', '-', '-', '-', '-', '8', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(16, 3, '40', '-', '-', '-', '7', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(17, 3, '35', '4', '5', '-', '-', '-', '-', '2025-01-09 04:24:00', '2025-01-09 04:24:00'),
(18, 3, '30', '-', '-', '6', '-', '7', '-', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(19, 3, '25', '3', '-', '-', '-', '-', '-', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(20, 3, '20', '-', '4', '-', '6', '-', '7', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(21, 3, '15', '2', '-', '5', '-', '6', '-', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(22, 3, '10', '-', '-', '-', '5', '-', '6', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(23, 3, '5', '1', '3', '4', '4', '4-5', '-', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(24, 3, '4', '-', '-', '-', '3', '-', '5', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(25, 3, '3', '0', '2', '-', '2', '3', '-', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(26, 3, '2', 'NULL', '1', '3', '1', '2', '4', '2025-01-09 04:24:01', '2025-01-09 04:24:01'),
(27, 3, '1', 'NULL', '0', '0-2', '0', '0-1', '0-3', '2025-01-09 04:24:01', '2025-01-09 04:24:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_pruebas`
--

CREATE TABLE `rango_pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rango_edad` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rango_pruebas`
--

INSERT INTO `rango_pruebas` (`id`, `rango_edad`, `created_at`, `updated_at`) VALUES
(1, '0-1 mes', '2024-11-30 14:17:09', '2024-11-30 14:17:09'),
(2, '1-2 meses', '2024-11-30 14:55:30', '2024-11-30 14:55:30'),
(3, '2-3 meses', '2024-11-30 14:55:54', '2024-11-30 14:55:54'),
(4, '3-4 meses', '2024-11-30 15:06:11', '2024-11-30 15:06:11'),
(5, '4-5 meses', '2024-11-30 15:07:31', '2024-11-30 15:07:31'),
(6, '5-6 meses', '2024-11-30 15:08:04', '2024-11-30 15:08:04'),
(7, '6-7 meses', '2024-11-30 15:08:19', '2024-11-30 15:08:19'),
(8, '7-8 meses', '2024-11-30 15:08:40', '2024-11-30 15:08:40'),
(9, '8-9 meses', '2024-12-02 01:45:16', '2024-12-02 01:45:16'),
(10, '9-10 meses', '2024-12-02 01:45:52', '2024-12-02 01:45:52'),
(11, '10-11 meses', '2024-12-02 01:46:14', '2024-12-02 01:46:14'),
(12, '11-12 meses', '2024-12-02 01:46:52', '2024-12-02 01:46:52'),
(13, '13-15 meses', '2024-12-02 01:47:14', '2024-12-02 01:47:14'),
(14, '16-18 meses', '2024-12-02 01:48:15', '2024-12-02 01:48:15'),
(15, '19-21 meses', '2024-12-02 01:48:30', '2024-12-02 01:48:30'),
(16, '22-24 meses', '2024-12-02 01:48:45', '2024-12-02 01:48:45'),
(17, '25-30 meses', '2024-12-02 01:49:02', '2024-12-02 01:49:02'),
(18, '31-36 meses', '2024-12-02 01:49:17', '2024-12-02 01:49:17'),
(19, '37-42 meses', '2024-12-02 01:49:42', '2024-12-02 01:49:42'),
(20, '43-48 meses', '2024-12-02 01:50:00', '2024-12-02 01:50:00'),
(21, '49-60 meses', '2024-12-02 01:50:13', '2024-12-02 01:50:13'),
(22, '61-72 meses', '2024-12-02 01:50:31', '2024-12-02 01:50:31'),
(23, '36-86 meses', '2025-01-19 11:29:01', '2025-01-19 11:29:01'),
(24, '36-78 meses', '2025-01-19 12:01:16', '2025-01-19 12:01:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `ci` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `genero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `nombre`, `apellido`, `ci`, `telefono`, `email`, `genero_id`, `direccion_id`, `created_at`, `updated_at`) VALUES
(2, 'herlin', 'casas', '23214569', '0412639874', 'hc@yahoo.com', 2, 3, '2024-12-10 02:59:52', '2024-12-10 02:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ritmos`
--

CREATE TABLE `ritmos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ritmos`
--

INSERT INTO `ritmos` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(28, 10, '99', '4-7', '6-7', '5-7', '6-7', '7', '7', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(29, 10, '98', '-', '5', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(30, 10, '97', '3', '-', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(31, 10, '96', '-', '4', '-', '-', '6', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(32, 10, '95', '-', '-', '4', '5', '-', '6', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(33, 10, '90', '2', '3', '-', '-', '5', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(34, 10, '85', '-', '-', '3', '4', '-', '5', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(35, 10, '80', '-', '-', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(36, 10, '75', '-', '2', '-', '-', '4', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(37, 10, '70', '1', '-', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(38, 10, '65', '-', '-', '2', '3', '-', '4', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(39, 10, '60', '-', '1', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(40, 10, '55', '-', '-', '-', '-', '3', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(41, 10, '50', '-', '-', '-', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(42, 10, '45', '-', '-', '-', '2', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(43, 10, '40', '-', '-', '1', '-', '-', '-', '2025-01-13 21:49:05', '2025-01-13 21:49:05'),
(44, 10, '35', '-', '-', '-', '-', '-', '3', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(45, 10, '30', '0', '-', '-', '-', '2', '-', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(46, 10, '25', 'NULL', '0', '-', '1', '-', '-', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(47, 10, '20', 'NULL', 'NULL', '-', '-', '-', '2', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(48, 10, '15', 'NULL', 'NULL', '0', '-', '1', '-', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(49, 10, '10', 'NULL', 'NULL', 'NULL', '0', '-', '', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(50, 10, '5', 'NULL', 'NULL', 'NULL', 'NULL', '-', '1', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(51, 10, '4', 'NULL', 'NULL', 'NULL', 'NULL', '0', '-', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(52, 10, '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '-', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(53, 10, '2', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0', '2025-01-13 21:49:06', '2025-01-13 21:49:06'),
(54, 10, '1', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2025-01-13 21:49:06', '2025-01-13 21:49:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `ci` varchar(30) NOT NULL,
  `fecha_nac` date NOT NULL,
  `grado` varchar(120) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `genero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direccion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_escalas`
--

CREATE TABLE `sub_escalas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prueba` varchar(255) NOT NULL,
  `escala` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sub_escalas`
--

INSERT INTO `sub_escalas` (`id`, `prueba`, `escala`, `created_at`, `updated_at`) VALUES
(1, 'CUMANIN', 'Desarrollo Verbal', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(2, 'CUMANIN', 'Desarrollo no Verbal', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(3, 'CUMANIN', 'Psicomotricidad', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(4, 'CUMANIN', 'Lenguaje Articulatorio', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(5, 'CUMANIN', 'Lenguaje Expresivo', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(6, 'CUMANIN', 'Lenguaje Comprensivo', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(7, 'CUMANIN', 'Estructuracion Espacial', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(8, 'CUMANIN', 'Visopercepcion', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(9, 'CUMANIN', 'Memoria Iconica', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(10, 'CUMANIN', 'Ritmo', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(11, 'CUMANIN', 'Fluidez Verbal', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(12, 'CUMANIN', 'Atencion', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(13, 'CUMANIN', 'Lectura', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(14, 'CUMANIN', 'Escritura', '2025-01-07 01:07:28', '2025-01-07 01:07:28'),
(15, 'KOPPITZ', 'Dibujo Figura Humana', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pruebas`
--

CREATE TABLE `tipo_pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_pruebas`
--

INSERT INTO `tipo_pruebas` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'guia observacion', '2024-11-30 14:15:41', '2024-11-30 14:15:41'),
(2, 'Estandarizada', '2025-01-19 11:40:18', '2025-01-19 11:40:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ivana', 'galenoivana9@gmail.com', NULL, '$2y$10$Rgtu.nlYvkYYLUIdXthBsOvl.9NiuKHbBpaXgvWXc6Kv2GeffwDxu', NULL, '2024-11-30 14:09:17', '2024-11-30 14:09:17'),
(2, 'marta juanchez', 'mjj@gmail.com', NULL, '$2y$10$.Q8s/jI70yejl0n4WufOoeuUgbeAJBb1xM4wLn7V.f3EiePkLoCKS', NULL, '2024-12-10 02:53:22', '2024-12-10 02:53:22'),
(3, 'maria', 'maria@gmail.com', NULL, '$2y$10$CzaBdhq5aBMX/chAaN1E.uTZCuuMzUTsBu7g0TsKHLCANLRIR6/Dm', NULL, '2025-01-06 15:35:02', '2025-01-06 15:35:02'),
(4, 'maria', 'ffff@gmail.com', NULL, '$2y$10$AAPHiFTCowk4676BVn9mDOhcVtn2ZYnCvPB6Djm/warCEEfolyb.a', NULL, '2025-01-06 15:44:20', '2025-01-06 15:44:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_items`
--

CREATE TABLE `valor_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `valor` varchar(255) NOT NULL,
  `interpretacion` varchar(255) NOT NULL,
  `item_prueba_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visopercepcions`
--

CREATE TABLE `visopercepcions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_escala_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentil` varchar(255) NOT NULL,
  `36-42 meses` varchar(255) NOT NULL,
  `43-48 meses` varchar(255) NOT NULL,
  `49-54 meses` varchar(255) NOT NULL,
  `55-60 meses` varchar(255) NOT NULL,
  `61-66 meses` varchar(255) NOT NULL,
  `67-78 meses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `visopercepcions`
--

INSERT INTO `visopercepcions` (`id`, `sub_escala_id`, `percentil`, `36-42 meses`, `43-48 meses`, `49-54 meses`, `55-60 meses`, `61-66 meses`, `67-78 meses`, `created_at`, `updated_at`) VALUES
(1, 8, '99', '3-15', '9-15', '14-15', '15', '15', 'NULL', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(2, 8, '98', '-', '-', '13', '14', '-', 'NULL', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(3, 8, '97', '-', '8', '12', '-', '-', '15', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(4, 8, '96', '-', '-', '-', '13', '14', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(5, 8, '95', '2', '7', '10-11', '12', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(6, 8, '90', '-', '6', '9', '11', '13', '14', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(7, 8, '85', '-', '5', '-', '10', '12', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(8, 8, '80', '1', '-', '8', '-', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(9, 8, '75', '-', '-', '7', '9', '11', '13', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(10, 8, '70', '-', '4', '6', '-', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(11, 8, '65', '-', '-', '-', '8', '10', '12', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(12, 8, '60', '-', '3', '-', '-', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(13, 8, '55', '-', '-', '5', '7', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(14, 8, '50', '-', '-', '-', '-', '9', '11', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(15, 8, '45', '0', '2', '-', '6', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(16, 8, '40', 'NULL', '-', '4', '-', '8', '10', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(17, 8, '35', 'NULL', '1', '-', '5', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(18, 8, '30', 'NULL', '-', '-', '-', '7', '9', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(19, 8, '25', 'NULL', '-', '3', '-', '-', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(20, 8, '20', 'NULL', '-', '-', '4', '6', '-', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(21, 8, '15', 'NULL', '0', '2', '3', '5', '8', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(22, 8, '10', 'NULL', 'NULL', '1', '2', '4', '7', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(23, 8, '5', 'NULL', 'NULL', '-', '1', '2-3', '6', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(24, 8, '4', 'NULL', 'NULL', '-', '-', '1', '5', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(25, 8, '3', 'NULL', 'NULL', '0', '-', '-', '4', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(26, 8, '2', 'NULL', 'NULL', 'NULL', '0', '-', '2-3', '2025-01-11 04:55:57', '2025-01-11 04:55:57'),
(27, 8, '1', 'NULL', 'NULL', 'NULL', 'NULL', '0', '0', '2025-01-11 04:55:57', '2025-01-11 04:55:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedente_medicos`
--
ALTER TABLE `antecedente_medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `area_desarrollos`
--
ALTER TABLE `area_desarrollos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `atencions`
--
ALTER TABLE `atencions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atencions_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_paciente_id_foreign` (`paciente_id`),
  ADD KEY `citas_especialista_id_foreign` (`especialista_id`);

--
-- Indices de la tabla `datos_economicos`
--
ALTER TABLE `datos_economicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desarrollo_globals`
--
ALTER TABLE `desarrollo_globals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desarrollo_no_verbals`
--
ALTER TABLE `desarrollo_no_verbals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desarrollo_no_verbals_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `desarrollo_verbals`
--
ALTER TABLE `desarrollo_verbals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desarrollo_verbals_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `dibujo_figura_humanas`
--
ALTER TABLE `dibujo_figura_humanas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dibujo_figura_humanas_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `direccions`
--
ALTER TABLE `direccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccions_estado_id_foreign` (`estado_id`),
  ADD KEY `direccions_municipio_id_foreign` (`municipio_id`),
  ADD KEY `direccions_parroquia_id_foreign` (`parroquia_id`);

--
-- Indices de la tabla `escrituras`
--
ALTER TABLE `escrituras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escrituras_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especialistas_especialidad_id_foreign` (`especialidad_id`),
  ADD KEY `especialistas_genero_id_foreign` (`genero_id`),
  ADD KEY `especialistas_direccion_id_foreign` (`direccion_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estructuracion_esapacials`
--
ALTER TABLE `estructuracion_esapacials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estructuracion_esapacials_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fluidez_verbals`
--
ALTER TABLE `fluidez_verbals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fluidez_verbals_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historia_clinicas_paciente_id_foreign` (`paciente_id`),
  ADD KEY `historia_clinicas_historia_desarrollo_id_foreign` (`historia_desarrollo_id`),
  ADD KEY `historia_clinicas_antecedente_medico_id_foreign` (`antecedente_medico_id`),
  ADD KEY `historia_clinicas_historia_escolar_id_foreign` (`historia_escolar_id`);

--
-- Indices de la tabla `historia_desarrollos`
--
ALTER TABLE `historia_desarrollos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historia_escolars`
--
ALTER TABLE `historia_escolars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
--
ALTER TABLE `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `item_pruebas`
--
ALTER TABLE `item_pruebas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_pruebas_prueba_id_foreign` (`prueba_id`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturas_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `lenguaje_articulatorios`
--
ALTER TABLE `lenguaje_articulatorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lenguaje_articulatorios_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `lenguaje_comprensivos`
--
ALTER TABLE `lenguaje_comprensivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lenguaje_comprensivos_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `lenguaje_expresivos`
--
ALTER TABLE `lenguaje_expresivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lenguaje_expresivos_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `memoria_iconicas`
--
ALTER TABLE `memoria_iconicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memoria_iconicas_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacientes_representante_id_foreign` (`representante_id`),
  ADD KEY `pacientes_datoseconomico_id_foreign` (`datoseconomico_id`),
  ADD KEY `pacientes_genero_id_foreign` (`genero_id`);

--
-- Indices de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentescos_paciente_id_foreign` (`paciente_id`),
  ADD KEY `parentescos_genero_id_foreign` (`genero_id`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parroquias_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pruebas_tipo_prueba_id_foreign` (`tipo_prueba_id`),
  ADD KEY `pruebas_area_desarrollo_id_foreign` (`area_desarrollo_id`),
  ADD KEY `pruebas_rango_prueba_id_foreign` (`rango_prueba_id`);

--
-- Indices de la tabla `psicomotricidad_cumanins`
--
ALTER TABLE `psicomotricidad_cumanins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `psicomotricidad_cumanins_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `rango_pruebas`
--
ALTER TABLE `rango_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `representantes_genero_id_foreign` (`genero_id`),
  ADD KEY `representantes_direccion_id_foreign` (`direccion_id`);

--
-- Indices de la tabla `ritmos`
--
ALTER TABLE `ritmos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ritmos_sub_escala_id_foreign` (`sub_escala_id`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `secretarias_genero_id_foreign` (`genero_id`),
  ADD KEY `secretarias_direccion_id_foreign` (`direccion_id`);

--
-- Indices de la tabla `sub_escalas`
--
ALTER TABLE `sub_escalas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pruebas`
--
ALTER TABLE `tipo_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `valor_items`
--
ALTER TABLE `valor_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valor_items_item_prueba_id_foreign` (`item_prueba_id`);

--
-- Indices de la tabla `visopercepcions`
--
ALTER TABLE `visopercepcions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visopercepcions_sub_escala_id_foreign` (`sub_escala_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedente_medicos`
--
ALTER TABLE `antecedente_medicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `area_desarrollos`
--
ALTER TABLE `area_desarrollos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `atencions`
--
ALTER TABLE `atencions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `datos_economicos`
--
ALTER TABLE `datos_economicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `desarrollo_globals`
--
ALTER TABLE `desarrollo_globals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `desarrollo_no_verbals`
--
ALTER TABLE `desarrollo_no_verbals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `desarrollo_verbals`
--
ALTER TABLE `desarrollo_verbals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `dibujo_figura_humanas`
--
ALTER TABLE `dibujo_figura_humanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `direccions`
--
ALTER TABLE `direccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `escrituras`
--
ALTER TABLE `escrituras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `especialidads`
--
ALTER TABLE `especialidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `estructuracion_esapacials`
--
ALTER TABLE `estructuracion_esapacials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fluidez_verbals`
--
ALTER TABLE `fluidez_verbals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historia_desarrollos`
--
ALTER TABLE `historia_desarrollos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historia_escolars`
--
ALTER TABLE `historia_escolars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
--
ALTER TABLE `interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `item_pruebas`
--
ALTER TABLE `item_pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `lenguaje_articulatorios`
--
ALTER TABLE `lenguaje_articulatorios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `lenguaje_comprensivos`
--
ALTER TABLE `lenguaje_comprensivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `lenguaje_expresivos`
--
ALTER TABLE `lenguaje_expresivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `memoria_iconicas`
--
ALTER TABLE `memoria_iconicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `psicomotricidad_cumanins`
--
ALTER TABLE `psicomotricidad_cumanins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `rango_pruebas`
--
ALTER TABLE `rango_pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ritmos`
--
ALTER TABLE `ritmos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_escalas`
--
ALTER TABLE `sub_escalas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipo_pruebas`
--
ALTER TABLE `tipo_pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `valor_items`
--
ALTER TABLE `valor_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `visopercepcions`
--
ALTER TABLE `visopercepcions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atencions`
--
ALTER TABLE `atencions`
  ADD CONSTRAINT `atencions_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_especialista_id_foreign` FOREIGN KEY (`especialista_id`) REFERENCES `especialistas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `desarrollo_no_verbals`
--
ALTER TABLE `desarrollo_no_verbals`
  ADD CONSTRAINT `desarrollo_no_verbals_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `desarrollo_verbals`
--
ALTER TABLE `desarrollo_verbals`
  ADD CONSTRAINT `desarrollo_verbals_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dibujo_figura_humanas`
--
ALTER TABLE `dibujo_figura_humanas`
  ADD CONSTRAINT `dibujo_figura_humanas_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccions`
--
ALTER TABLE `direccions`
  ADD CONSTRAINT `direccions_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `direccions_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `direccions_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `escrituras`
--
ALTER TABLE `escrituras`
  ADD CONSTRAINT `escrituras_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD CONSTRAINT `especialistas_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direccions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `especialistas_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `especialistas_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estructuracion_esapacials`
--
ALTER TABLE `estructuracion_esapacials`
  ADD CONSTRAINT `estructuracion_esapacials_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fluidez_verbals`
--
ALTER TABLE `fluidez_verbals`
  ADD CONSTRAINT `fluidez_verbals_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  ADD CONSTRAINT `historia_clinicas_antecedente_medico_id_foreign` FOREIGN KEY (`antecedente_medico_id`) REFERENCES `antecedente_medicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historia_clinicas_historia_desarrollo_id_foreign` FOREIGN KEY (`historia_desarrollo_id`) REFERENCES `historia_desarrollos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historia_clinicas_historia_escolar_id_foreign` FOREIGN KEY (`historia_escolar_id`) REFERENCES `historia_escolars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historia_clinicas_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `item_pruebas`
--
ALTER TABLE `item_pruebas`
  ADD CONSTRAINT `item_pruebas_prueba_id_foreign` FOREIGN KEY (`prueba_id`) REFERENCES `pruebas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lenguaje_articulatorios`
--
ALTER TABLE `lenguaje_articulatorios`
  ADD CONSTRAINT `lenguaje_articulatorios_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lenguaje_comprensivos`
--
ALTER TABLE `lenguaje_comprensivos`
  ADD CONSTRAINT `lenguaje_comprensivos_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lenguaje_expresivos`
--
ALTER TABLE `lenguaje_expresivos`
  ADD CONSTRAINT `lenguaje_expresivos_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `memoria_iconicas`
--
ALTER TABLE `memoria_iconicas`
  ADD CONSTRAINT `memoria_iconicas_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_datoseconomico_id_foreign` FOREIGN KEY (`datoseconomico_id`) REFERENCES `datos_economicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pacientes_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pacientes_representante_id_foreign` FOREIGN KEY (`representante_id`) REFERENCES `representantes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `parentescos`
--
ALTER TABLE `parentescos`
  ADD CONSTRAINT `parentescos_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parentescos_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD CONSTRAINT `pruebas_area_desarrollo_id_foreign` FOREIGN KEY (`area_desarrollo_id`) REFERENCES `area_desarrollos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pruebas_rango_prueba_id_foreign` FOREIGN KEY (`rango_prueba_id`) REFERENCES `rango_pruebas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pruebas_tipo_prueba_id_foreign` FOREIGN KEY (`tipo_prueba_id`) REFERENCES `tipo_pruebas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `psicomotricidad_cumanins`
--
ALTER TABLE `psicomotricidad_cumanins`
  ADD CONSTRAINT `psicomotricidad_cumanins_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direccions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `representantes_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ritmos`
--
ALTER TABLE `ritmos`
  ADD CONSTRAINT `ritmos_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD CONSTRAINT `secretarias_direccion_id_foreign` FOREIGN KEY (`direccion_id`) REFERENCES `direccions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secretarias_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valor_items`
--
ALTER TABLE `valor_items`
  ADD CONSTRAINT `valor_items_item_prueba_id_foreign` FOREIGN KEY (`item_prueba_id`) REFERENCES `item_pruebas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `visopercepcions`
--
ALTER TABLE `visopercepcions`
  ADD CONSTRAINT `visopercepcions_sub_escala_id_foreign` FOREIGN KEY (`sub_escala_id`) REFERENCES `sub_escalas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
