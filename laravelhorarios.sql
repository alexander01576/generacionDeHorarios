-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-11-2024 a las 22:40:44
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravelhorarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

DROP TABLE IF EXISTS `asignaciones`;
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `materia_id` bigint UNSIGNED NOT NULL,
  `maestro_id` bigint UNSIGNED NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asignaciones_materia_id_foreign` (`materia_id`),
  KEY `asignaciones_maestro_id_foreign` (`maestro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `materia_id`, `maestro_id`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-11-25 04:07:04', '2024-11-25 04:28:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidad` int NOT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Carrera1', 1, '2024-11-25 04:05:51', '2024-11-25 04:05:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario_modificador` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evento` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `elemento_modificado` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `id_usuario_modificador`, `evento`, `elemento_modificado`, `created_at`, `updated_at`) VALUES
(1, '1', 'carreras.store', '{\"nombre\":\"Carrera1\"}', '2024-11-25 04:05:51', '2024-11-25 04:05:51'),
(2, '1', 'semestres.store', '{\"nombre\":\"semestre1\"}', '2024-11-25 04:05:59', '2024-11-25 04:05:59'),
(3, '1', 'maestros.store', '{\"nombre\":\"maestro1\",\"correo_electronico\":\"maestro@ma.com\",\"telefono\":\"123456789\"}', '2024-11-25 04:06:17', '2024-11-25 04:06:17'),
(4, '1', 'periodos.store', '{\"nombre\":\"periodo1\",\"fecha_inicio\":\"2024-11-24\",\"fecha_fin\":\"2024-11-25\"}', '2024-11-25 04:06:36', '2024-11-25 04:06:36'),
(5, '1', 'materias.store', '{\"nombre\":\"materia1\",\"carrera_id\":\"1\",\"semestre_id\":\"1\"}', '2024-11-25 04:06:49', '2024-11-25 04:06:49'),
(6, '1', 'asignaciones.store', '{\"materia_id\":\"1\",\"maestro_id\":\"1\"}', '2024-11-25 04:07:04', '2024-11-25 04:07:04'),
(7, '1', 'asignaciones.update', '{\"materia_id\":\"1\",\"maestro_id\":\"1\"}', '2024-11-25 04:28:12', '2024-11-25 04:28:12'),
(8, '1', 'asignaciones.destroy', '{\"id\":1,\"materia_id\":1,\"maestro_id\":1,\"estatus\":0,\"created_at\":\"2024-11-24T22:07:04.000000Z\",\"updated_at\":\"2024-11-24T22:28:18.000000Z\"}', '2024-11-25 04:28:18', '2024-11-25 04:28:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

DROP TABLE IF EXISTS `maestros`;
CREATE TABLE IF NOT EXISTS `maestros` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maestros_correo_electronico_unique` (`correo_electronico`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `nombre`, `correo_electronico`, `telefono`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'maestro1', 'maestro@ma.com', '123456789', 1, '2024-11-25 04:06:17', '2024-11-25 04:06:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` bigint UNSIGNED NOT NULL,
  `semestre_id` bigint UNSIGNED NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materias_carrera_id_foreign` (`carrera_id`),
  KEY `materias_semestre_id_foreign` (`semestre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `carrera_id`, `semestre_id`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'materia1', 1, 1, 1, '2024-11-25 04:06:49', '2024-11-25 04:06:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_07_030444_create_aulas_table', 1),
(6, '2024_11_07_030829_create_logs_table', 1),
(7, '2024_11_08_041608_create_carreras_table', 1),
(8, '2024_11_08_052951_create_semestres_table', 1),
(9, '2024_11_10_034917_create_maestros_table', 1),
(10, '2024_11_10_060521_create_periodos_academicos_table', 1),
(11, '2024_11_10_193652_create_materias_table', 1),
(12, '2024_11_22_055348_create_asignaciones_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos_academicos`
--

DROP TABLE IF EXISTS `periodos_academicos`;
CREATE TABLE IF NOT EXISTS `periodos_academicos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodos_academicos`
--

INSERT INTO `periodos_academicos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'periodo1', '2024-11-24', '2024-11-25', 1, '2024-11-25 04:06:36', '2024-11-25 04:06:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE IF NOT EXISTS `semestres` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'semestre1', 1, '2024-11-25 04:05:59', '2024-11-25 04:05:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `city`, `country`, `postal`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'Administrador', 'local', 'admin@argon.com', NULL, '$2y$12$aajQHoAX7VoQht/2q7uYwuHYFRD4taNFhZLHFPzpeoM7cIxsEYYaS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
