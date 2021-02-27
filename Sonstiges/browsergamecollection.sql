-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Feb 2021 um 13:45
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `browsergamecollection`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `game_id`, `comment`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 'Gutes Spiel!', '2021-02-23 18:21:59', '2021-02-23 18:21:59'),
(3, 4, 3, 'Viel zu schwer.', '2021-02-23 18:22:12', '2021-02-23 18:22:12'),
(4, 4, 4, 'Lustig!', '2021-02-23 18:22:28', '2021-02-23 18:22:28'),
(5, 5, 3, 'Sehr gut!', '2021-02-23 18:22:53', '2021-02-23 18:22:53'),
(6, 5, 7, 'Nette Idee!', '2021-02-23 18:23:10', '2021-02-23 18:23:10'),
(7, 5, 2, 'Gefällt mir! :)', '2021-02-23 18:23:35', '2021-02-23 18:23:35'),
(8, 6, 1, 'Cool!', '2021-02-23 18:24:15', '2021-02-23 18:24:15'),
(9, 6, 2, 'Nicht einfach', '2021-02-23 18:24:32', '2021-02-23 18:24:32'),
(10, 6, 7, 'Spaßig!', '2021-02-23 18:24:49', '2021-02-23 18:24:49'),
(11, 7, 4, 'Die armen Vögel! :(', '2021-02-23 18:25:25', '2021-02-23 18:25:25'),
(12, 7, 3, 'Sehr kniffelig!', '2021-02-23 18:25:44', '2021-02-23 18:25:44'),
(13, 7, 2, 'Die Schlange ist ganz schön schnell!', '2021-02-23 18:25:57', '2021-02-23 18:25:57'),
(14, 8, 1, 'Test', '2021-02-24 10:32:41', '2021-02-24 10:32:41');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `developer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realGame` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `games`
--

INSERT INTO `games` (`id`, `title`, `developer`, `description`, `image`, `realGame`, `created_at`, `updated_at`) VALUES
(1, 'example', 'Phaser', 'Sammle möglichst viele Sterne! Lass dich nicht von den Bomben treffen!\r\n\r\nSteuerung:\r\n- Bewegen: Pfeiltasten', 'games/BFsEMtWH8dNAMm5iI52VJRaaj8o2o2IUqTFlDdHY.png', 'true', '2021-01-25 12:49:48', '2021-01-30 13:51:02'),
(2, 'Snake', 'BrowserGameCollection', 'Sammle möglichst viel Futter ein! Berühr dich dabei nicht selbst!\r\n\r\nSteuerung:\r\n- Bewegen: Pfeiltasten', 'games/v4aWYXvZjHjH806eZIJg05X0jJnf1G7kCkTAV6Q6.png', 'true', '2021-01-25 12:50:50', '2021-01-30 13:51:15'),
(3, 'Tap Jumper', 'BrowserGameCollection', 'Fliege durch die Röhren ohne sie zu berühren!\r\n\r\nSteuerung:\r\n- Fliegen: Leertaste', 'games/c3Lcp3e4QRQ4HppTlT6uMhunwNAA8fHAWybBZ7D6.png', 'true', '2021-01-25 12:51:33', '2021-01-30 13:51:32'),
(4, 'Moorhuhn', 'BrowserGameCollection', 'Schieße die Vögel ab, ohne die Bomben zu treffen. Treffe Sanduhren für Extra Zeit.\r\n\r\nGrau = 1 Punkt\r\nBlau = 2 Punkte\r\nRot = 5 Punkte\r\n\r\nSteuerung:\r\n- Zielen:  Maus\r\n- Schießen: Rechtsklick\r\n- Nachladen: R\r\n- Ton stummschalten: M', 'games/orc2b9Gor0l2RGlcUpCqLkZWeLCpliU2RUwrommi.png', 'true', '2021-01-25 12:53:29', '2021-01-30 13:51:43'),
(7, 'Canon', 'BrowserGameCollection', 'Schieße alle Sterne ab.\r\n\r\nSteuerung:\r\n- Zielen: Maus\r\n- Schießen: Linksklick', 'games/GZwDJm4lQ91djVD27Ppedn85JKF2ty5F2rr4gz4c.png', 'true', '2021-01-28 20:03:31', '2021-01-30 13:53:04'),
(10, 'Fishers Boat', 'Dev', '...', 'games/yfpZxYOrZWlxd1Xz28SmOX9agYhVWUTzBmI8iuUV.jpg', 'false', '2021-02-23 10:26:37', '2021-02-23 10:26:37'),
(11, '2D Templer', 'Dev', '...', 'games/HDov3HQSxr9hpBrtI9QgoAcPJMtM54WGEgKY97vI.png', 'false', '2021-02-23 10:27:26', '2021-02-23 10:27:26'),
(12, 'Balanced Biker', 'Dev', '...', 'games/nIzH9yMCB8yXfvAmL30zNmTTYViVjIJ9MBviHknB.png', 'false', '2021-02-23 10:28:07', '2021-02-23 10:28:07'),
(13, 'Pong', 'Dev', '...', 'games/YWmUJYizwxYH39s3VCHXv0TP1VsPkvjiVYV8I03z.jpg', 'false', '2021-02-23 10:28:43', '2021-02-23 10:28:43'),
(14, 'Breakout', 'Dev', '...', 'games/MEOf9XKkJC8R1SsFfpdM4F15KWSNdVb19bCWAQlD.jpg', 'false', '2021-02-23 10:29:28', '2021-02-23 10:29:28'),
(15, 'Ynvada', 'Dev', '...', 'games/BK8B4RN7N2VB6jHV3PfaxszrdW6j4QYsLSv4InAB.jpg', 'false', '2021-02-23 10:29:54', '2021-02-23 10:29:54'),
(16, 'Fruit Dog', 'Dev', '...', 'games/GR52nTIulCLvpRU0WQdZMpR3jUn5WskM0dAAbTTA.jpg', 'false', '2021-02-23 10:30:18', '2021-02-23 10:30:18'),
(17, 'Tanks', 'Dev', '...', 'games/DsO4H3xJIYopKxvxODkHJ5aFQPSvTfc3OSmJ1gkv.jpg', 'false', '2021-02-23 10:30:41', '2021-02-23 10:30:41'),
(18, 'Eraserhead', 'Dev', '...', 'games/pEefRrnmUaRDBh05lLqh7C341HVEYnGqUYdhO7Jk.png', 'false', '2021-02-23 10:31:10', '2021-02-23 10:31:10'),
(19, 'Cybertank', 'Dev', '...', 'games/EVKFb01GQNbllP2oTZadGRzHEFSE9XUg3YzlhiVj.png', 'false', '2021-02-23 10:31:37', '2021-02-23 10:31:37'),
(20, 'Speed Typer', 'Dev', '...', 'games/Qq8ZimqzANlP4z2rZzV5G6nCfWgWzsDTTJpTh3Q5.png', 'false', '2021-02-23 10:32:01', '2021-02-23 10:32:01'),
(21, 'Quickcheck', 'Dev', '...', 'games/1nUiZf1tPfFYTatGlahO0vL6l9qicvtIb01czH0w.png', 'false', '2021-02-23 10:32:29', '2021-02-23 10:32:29'),
(22, 'Adventurer', 'Dev', '...', 'games/O2MP0MBbumuLYLZzZnTDv9sWks28rzty97umu3SG.jpg', 'false', '2021-02-23 10:33:03', '2021-02-23 10:33:03'),
(23, 'Bumpy Road', 'Dev', '...', 'games/mT3BS1c0Fc8BWQ4ow0aJiArli6kAuoJ7M6g3G18i.jpg', 'false', '2021-02-23 10:33:29', '2021-02-23 10:33:29'),
(24, 'Survival', 'Dev', '...', 'games/fYZIR4juwEPq1ZcGf2lUSeECbhL6WPbkTMtIeeKv.jpg', 'false', '2021-02-23 10:33:51', '2021-02-23 10:33:51');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `highscores`
--

CREATE TABLE `highscores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `highscores`
--

INSERT INTO `highscores` (`id`, `user_id`, `game_id`, `score`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 330, '2021-02-23 17:19:47', '2021-02-23 17:19:47'),
(3, 4, 2, 13, '2021-02-23 17:20:37', '2021-02-23 17:20:37'),
(4, 4, 3, 6, '2021-02-23 17:21:01', '2021-02-23 17:21:01'),
(5, 4, 4, 44, '2021-02-23 17:21:55', '2021-02-23 17:21:55'),
(6, 4, 7, 4, '2021-02-23 17:22:09', '2021-02-23 17:22:09'),
(7, 5, 1, 250, '2021-02-23 17:23:00', '2021-02-23 17:23:00'),
(8, 5, 2, 10, '2021-02-23 17:23:41', '2021-02-23 17:23:41'),
(9, 5, 3, 14, '2021-02-23 17:23:58', '2021-02-23 17:24:37'),
(10, 5, 4, 48, '2021-02-23 17:25:43', '2021-02-23 17:25:43'),
(11, 5, 7, 6, '2021-02-23 17:25:55', '2021-02-23 17:25:55'),
(12, 6, 1, 280, '2021-02-23 17:26:43', '2021-02-23 17:26:43'),
(13, 6, 2, 7, '2021-02-23 17:27:12', '2021-02-23 17:27:12'),
(14, 6, 3, 9, '2021-02-23 17:27:34', '2021-02-23 17:28:02'),
(15, 6, 4, 38, '2021-02-23 17:28:43', '2021-02-23 17:28:43'),
(16, 6, 7, 5, '2021-02-23 17:28:59', '2021-02-23 17:28:59'),
(17, 7, 1, 150, '2021-02-23 17:29:57', '2021-02-23 17:29:57'),
(18, 7, 2, 11, '2021-02-23 17:30:37', '2021-02-23 17:30:37'),
(19, 7, 3, 7, '2021-02-23 17:31:09', '2021-02-23 17:31:09'),
(20, 7, 4, 52, '2021-02-23 17:32:15', '2021-02-23 17:32:15'),
(21, 7, 7, 3, '2021-02-23 17:32:30', '2021-02-23 17:32:30'),
(22, 8, 1, 180, '2021-02-24 10:32:20', '2021-02-24 10:32:20'),
(23, 8, 2, 7, '2021-02-24 10:34:30', '2021-02-24 10:34:30'),
(24, 8, 7, 7, '2021-02-24 10:34:57', '2021-02-24 10:34:57'),
(25, 8, 3, 10, '2021-02-24 10:35:47', '2021-02-24 10:35:47'),
(26, 8, 4, 27, '2021-02-24 10:37:20', '2021-02-24 10:37:20');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 4, 17, '2021-02-23 17:35:43', '2021-02-23 17:35:43'),
(2, 4, 3, '2021-02-23 17:35:50', '2021-02-23 17:35:50'),
(3, 4, 15, '2021-02-23 17:35:56', '2021-02-23 17:35:56'),
(4, 4, 11, '2021-02-23 17:36:00', '2021-02-23 17:36:00'),
(5, 4, 22, '2021-02-23 17:36:03', '2021-02-23 17:36:03'),
(6, 4, 12, '2021-02-23 17:36:06', '2021-02-23 17:36:06'),
(7, 4, 14, '2021-02-23 17:36:09', '2021-02-23 17:36:09'),
(8, 4, 23, '2021-02-23 17:36:12', '2021-02-23 17:36:12'),
(9, 4, 7, '2021-02-23 17:36:15', '2021-02-23 17:36:15'),
(10, 4, 19, '2021-02-23 17:36:21', '2021-02-23 17:36:21'),
(11, 4, 18, '2021-02-23 17:36:29', '2021-02-23 17:36:29'),
(12, 4, 1, '2021-02-23 17:36:34', '2021-02-23 17:36:34'),
(13, 4, 10, '2021-02-23 17:36:41', '2021-02-23 17:36:41'),
(14, 4, 16, '2021-02-23 17:36:48', '2021-02-23 17:36:48'),
(15, 4, 4, '2021-02-23 17:36:54', '2021-02-23 17:36:54'),
(16, 4, 13, '2021-02-23 17:36:59', '2021-02-23 17:36:59'),
(17, 4, 21, '2021-02-23 17:37:04', '2021-02-23 17:37:04'),
(18, 4, 2, '2021-02-23 17:37:08', '2021-02-23 17:37:08'),
(19, 4, 20, '2021-02-23 17:37:14', '2021-02-23 17:37:14'),
(20, 4, 24, '2021-02-23 17:37:19', '2021-02-23 17:37:19'),
(21, 5, 3, '2021-02-23 17:47:11', '2021-02-23 17:47:11'),
(22, 5, 4, '2021-02-23 17:47:17', '2021-02-23 17:47:17'),
(23, 5, 7, '2021-02-23 17:47:21', '2021-02-23 17:47:21'),
(24, 5, 23, '2021-02-23 17:47:35', '2021-02-23 17:47:35'),
(25, 5, 19, '2021-02-23 17:47:44', '2021-02-23 17:47:44'),
(26, 5, 16, '2021-02-23 17:47:57', '2021-02-23 17:47:57'),
(27, 5, 24, '2021-02-23 17:48:09', '2021-02-23 17:48:09'),
(28, 5, 15, '2021-02-23 17:48:15', '2021-02-23 17:48:15'),
(29, 5, 18, '2021-02-23 17:48:20', '2021-02-23 17:48:20'),
(30, 6, 1, '2021-02-23 17:48:36', '2021-02-23 17:48:36'),
(31, 6, 7, '2021-02-23 17:48:57', '2021-02-23 17:48:57'),
(32, 6, 11, '2021-02-23 17:49:05', '2021-02-23 17:49:05'),
(33, 6, 22, '2021-02-23 17:49:28', '2021-02-23 17:49:28'),
(34, 6, 21, '2021-02-23 17:49:47', '2021-02-23 17:49:47'),
(35, 6, 20, '2021-02-23 17:49:52', '2021-02-23 17:49:52'),
(36, 6, 17, '2021-02-23 17:49:59', '2021-02-23 17:49:59'),
(37, 7, 2, '2021-02-23 17:50:53', '2021-02-23 17:50:53'),
(38, 7, 4, '2021-02-23 17:51:02', '2021-02-23 17:51:02'),
(39, 7, 23, '2021-02-23 17:51:29', '2021-02-23 17:51:29'),
(40, 7, 19, '2021-02-23 17:51:35', '2021-02-23 17:51:35'),
(41, 7, 7, '2021-02-23 17:51:39', '2021-02-23 17:51:39'),
(42, 7, 21, '2021-02-23 17:51:46', '2021-02-23 17:51:46'),
(43, 7, 20, '2021-02-23 17:51:53', '2021-02-23 17:51:53'),
(45, 8, 1, '2021-02-24 10:31:10', '2021-02-24 10:31:10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_27_112633_add_username_to_users_table', 1),
(5, '2020_12_28_100331_create_profiles_table', 1),
(6, '2020_12_28_220018_create_games_table', 1),
(7, '2021_01_01_120344_create_highscores_table', 1),
(8, '2021_01_14_152800_create_likes_table', 1),
(9, '2021_01_14_165143_create_ratings_table', 1),
(10, '2021_01_20_133844_create_tag_tables', 1),
(11, '2021_01_29_122633_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 4, 'Keine Beschreibung vorhanden...', 'profile/XbBKTRyvPz6AyB6Nmf13hZPO3iEr7RwLwQew2TWK.jpg', '2021-02-23 13:33:09', '2021-02-23 16:47:00'),
(3, 5, 'Keine Beschreibung vorhanden...', 'profile/90DqwRYdz4IkCo9GP4HIJ44r3SFuKKqQK6Vvk6Ei.png', '2021-02-23 16:41:18', '2021-02-23 16:49:19'),
(4, 6, 'Keine Beschreibung vorhanden...', 'profile/zHSuEktYN7I8BRgsy7yk6YXvPFLNm44lQWU80Mmd.jpg', '2021-02-23 16:41:44', '2021-02-23 16:49:42'),
(5, 7, 'Keine Beschreibung vorhanden...', 'profile/sC8H5MjrRftJ2gZ1KBTeTMIu5RufXzT3JShixKPC.jpg', '2021-02-23 16:42:50', '2021-02-23 16:50:02'),
(6, 8, 'Keine Beschreibung vorhanden...', 'default', '2021-02-24 10:29:48', '2021-02-24 10:29:48');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `ratings`
--

INSERT INTO `ratings` (`id`, `created_at`, `updated_at`, `rating`, `rateable_type`, `rateable_id`, `user_id`) VALUES
(1, '2021-02-23 17:33:32', '2021-02-23 17:33:32', 5, 'App\\Models\\Game', 1, 4),
(2, '2021-02-23 17:33:36', '2021-02-23 17:33:36', 5, 'App\\Models\\Game', 2, 4),
(3, '2021-02-23 17:33:41', '2021-02-23 17:33:41', 1, 'App\\Models\\Game', 3, 4),
(4, '2021-02-23 17:33:46', '2021-02-23 17:33:46', 3, 'App\\Models\\Game', 4, 4),
(5, '2021-02-23 17:33:52', '2021-02-23 17:33:52', 2, 'App\\Models\\Game', 7, 4),
(6, '2021-02-23 17:33:59', '2021-02-23 17:33:59', 3, 'App\\Models\\Game', 11, 4),
(7, '2021-02-23 17:34:03', '2021-02-23 17:34:03', 4, 'App\\Models\\Game', 22, 4),
(8, '2021-02-23 17:34:06', '2021-02-23 17:34:06', 2, 'App\\Models\\Game', 12, 4),
(9, '2021-02-23 17:34:14', '2021-02-23 17:34:14', 1, 'App\\Models\\Game', 14, 4),
(10, '2021-02-23 17:34:17', '2021-02-23 17:34:17', 2, 'App\\Models\\Game', 23, 4),
(11, '2021-02-23 17:34:24', '2021-02-23 17:34:24', 5, 'App\\Models\\Game', 19, 4),
(12, '2021-02-23 17:34:32', '2021-02-23 17:34:32', 3, 'App\\Models\\Game', 18, 4),
(13, '2021-02-23 17:34:44', '2021-02-23 17:34:44', 1, 'App\\Models\\Game', 10, 4),
(14, '2021-02-23 17:34:49', '2021-02-23 17:34:49', 2, 'App\\Models\\Game', 16, 4),
(15, '2021-02-23 17:35:01', '2021-02-23 17:35:01', 4, 'App\\Models\\Game', 13, 4),
(16, '2021-02-23 17:35:12', '2021-02-23 17:35:12', 3, 'App\\Models\\Game', 21, 4),
(17, '2021-02-23 17:35:25', '2021-02-23 17:35:25', 5, 'App\\Models\\Game', 20, 4),
(18, '2021-02-23 17:35:32', '2021-02-23 17:35:32', 4, 'App\\Models\\Game', 24, 4),
(19, '2021-02-23 17:35:42', '2021-02-23 17:35:42', 2, 'App\\Models\\Game', 17, 4),
(20, '2021-02-23 17:35:55', '2021-02-23 17:35:55', 4, 'App\\Models\\Game', 15, 4),
(21, '2021-02-23 17:46:57', '2021-02-23 17:46:57', 2, 'App\\Models\\Game', 1, 5),
(22, '2021-02-23 17:47:06', '2021-02-23 17:47:06', 2, 'App\\Models\\Game', 2, 5),
(23, '2021-02-23 17:47:10', '2021-02-23 17:47:10', 5, 'App\\Models\\Game', 3, 5),
(24, '2021-02-23 17:47:16', '2021-02-23 17:47:16', 4, 'App\\Models\\Game', 4, 5),
(25, '2021-02-23 17:47:20', '2021-02-23 17:47:20', 5, 'App\\Models\\Game', 7, 5),
(26, '2021-02-23 17:47:31', '2021-02-23 17:47:31', 5, 'App\\Models\\Game', 11, 5),
(27, '2021-02-23 17:47:34', '2021-02-23 17:47:34', 2, 'App\\Models\\Game', 23, 5),
(28, '2021-02-23 17:47:38', '2021-02-23 17:47:38', 4, 'App\\Models\\Game', 12, 5),
(29, '2021-02-23 17:47:43', '2021-02-23 17:47:43', 1, 'App\\Models\\Game', 19, 5),
(30, '2021-02-23 17:47:49', '2021-02-23 17:47:49', 4, 'App\\Models\\Game', 10, 5),
(31, '2021-02-23 17:47:55', '2021-02-23 17:47:55', 4, 'App\\Models\\Game', 16, 5),
(32, '2021-02-23 17:48:02', '2021-02-23 17:48:02', 4, 'App\\Models\\Game', 21, 5),
(33, '2021-02-23 17:48:14', '2021-02-23 17:48:14', 4, 'App\\Models\\Game', 15, 5),
(34, '2021-02-23 17:48:35', '2021-02-23 17:48:35', 4, 'App\\Models\\Game', 1, 6),
(35, '2021-02-23 17:48:41', '2021-02-23 17:48:41', 1, 'App\\Models\\Game', 2, 6),
(36, '2021-02-23 17:48:46', '2021-02-23 17:48:46', 4, 'App\\Models\\Game', 3, 6),
(37, '2021-02-23 17:48:52', '2021-02-23 17:48:52', 2, 'App\\Models\\Game', 4, 6),
(38, '2021-02-23 17:48:56', '2021-02-23 17:48:56', 4, 'App\\Models\\Game', 7, 6),
(39, '2021-02-23 17:49:03', '2021-02-23 17:49:03', 3, 'App\\Models\\Game', 11, 6),
(40, '2021-02-23 17:49:12', '2021-02-23 17:49:12', 1, 'App\\Models\\Game', 22, 6),
(41, '2021-02-23 17:49:16', '2021-02-23 17:49:16', 4, 'App\\Models\\Game', 14, 6),
(42, '2021-02-23 17:49:23', '2021-02-23 17:49:23', 2, 'App\\Models\\Game', 16, 6),
(43, '2021-02-23 17:49:51', '2021-02-23 17:49:51', 4, 'App\\Models\\Game', 20, 6),
(44, '2021-02-23 17:49:58', '2021-02-23 17:49:58', 4, 'App\\Models\\Game', 17, 6),
(45, '2021-02-23 17:50:11', '2021-02-23 17:50:11', 1, 'App\\Models\\Game', 13, 6),
(46, '2021-02-23 17:50:48', '2021-02-23 17:50:48', 1, 'App\\Models\\Game', 1, 7),
(47, '2021-02-23 17:50:52', '2021-02-23 17:50:52', 4, 'App\\Models\\Game', 2, 7),
(48, '2021-02-23 17:50:58', '2021-02-23 17:50:58', 3, 'App\\Models\\Game', 3, 7),
(49, '2021-02-23 17:51:02', '2021-02-23 17:51:02', 5, 'App\\Models\\Game', 4, 7),
(50, '2021-02-23 17:51:06', '2021-02-23 17:51:09', 2, 'App\\Models\\Game', 7, 7),
(51, '2021-02-23 17:51:18', '2021-02-23 17:51:22', 2, 'App\\Models\\Game', 11, 7),
(52, '2021-02-23 17:52:06', '2021-02-23 17:52:08', 5, 'App\\Models\\Game', 13, 7),
(53, '2021-02-23 17:52:26', '2021-02-23 17:52:26', 1, 'App\\Models\\Game', 16, 7),
(54, '2021-02-24 10:31:05', '2021-02-24 10:31:05', 3, 'App\\Models\\Game', 1, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_type`, `taggable_id`) VALUES
(8, 'App\\Models\\Game', 1),
(8, 'App\\Models\\Game', 5),
(8, 'App\\Models\\Game', 6),
(8, 'App\\Models\\Game', 8),
(8, 'App\\Models\\Game', 11),
(8, 'App\\Models\\Game', 16),
(8, 'App\\Models\\Game', 18),
(9, 'App\\Models\\Game', 1),
(9, 'App\\Models\\Game', 2),
(9, 'App\\Models\\Game', 3),
(9, 'App\\Models\\Game', 4),
(9, 'App\\Models\\Game', 7),
(9, 'App\\Models\\Game', 10),
(9, 'App\\Models\\Game', 12),
(9, 'App\\Models\\Game', 13),
(9, 'App\\Models\\Game', 14),
(9, 'App\\Models\\Game', 15),
(9, 'App\\Models\\Game', 19),
(10, 'App\\Models\\Game', 4),
(10, 'App\\Models\\Game', 7),
(10, 'App\\Models\\Game', 14),
(10, 'App\\Models\\Game', 17),
(11, 'App\\Models\\Game', 1),
(11, 'App\\Models\\Game', 2),
(11, 'App\\Models\\Game', 3),
(11, 'App\\Models\\Game', 10),
(11, 'App\\Models\\Game', 11),
(11, 'App\\Models\\Game', 12),
(11, 'App\\Models\\Game', 13),
(11, 'App\\Models\\Game', 14),
(11, 'App\\Models\\Game', 15),
(11, 'App\\Models\\Game', 16),
(11, 'App\\Models\\Game', 18),
(11, 'App\\Models\\Game', 19),
(11, 'App\\Models\\Game', 20),
(11, 'App\\Models\\Game', 23),
(12, 'App\\Models\\Game', 6),
(12, 'App\\Models\\Game', 7),
(12, 'App\\Models\\Game', 21),
(12, 'App\\Models\\Game', 24),
(13, 'App\\Models\\Game', 1),
(13, 'App\\Models\\Game', 2),
(13, 'App\\Models\\Game', 3),
(13, 'App\\Models\\Game', 8),
(13, 'App\\Models\\Game', 11),
(13, 'App\\Models\\Game', 14),
(13, 'App\\Models\\Game', 15),
(13, 'App\\Models\\Game', 16),
(13, 'App\\Models\\Game', 19),
(13, 'App\\Models\\Game', 22),
(13, 'App\\Models\\Game', 24),
(14, 'App\\Models\\Game', 4),
(14, 'App\\Models\\Game', 6),
(14, 'App\\Models\\Game', 7),
(14, 'App\\Models\\Game', 9),
(14, 'App\\Models\\Game', 10),
(14, 'App\\Models\\Game', 12),
(14, 'App\\Models\\Game', 13),
(14, 'App\\Models\\Game', 17),
(14, 'App\\Models\\Game', 18),
(14, 'App\\Models\\Game', 20),
(14, 'App\\Models\\Game', 21),
(14, 'App\\Models\\Game', 23),
(22, 'App\\Models\\Game', 4),
(22, 'App\\Models\\Game', 8),
(22, 'App\\Models\\Game', 9),
(22, 'App\\Models\\Game', 17),
(22, 'App\\Models\\Game', 22),
(23, 'App\\Models\\Game', 9),
(23, 'App\\Models\\Game', 12),
(23, 'App\\Models\\Game', 23),
(25, 'App\\Models\\Game', 20),
(25, 'App\\Models\\Game', 21),
(25, 'App\\Models\\Game', 24),
(26, 'App\\Models\\Game', 9),
(26, 'App\\Models\\Game', 22);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `order_column`, `created_at`, `updated_at`) VALUES
(8, '{\"de\":\"Jump&Run\"}', '{\"de\":\"jumprun\"}', 'genre', 1, '2021-01-25 18:20:50', '2021-01-25 18:20:50'),
(9, '{\"de\":\"Arcade\"}', '{\"de\":\"arcade\"}', 'genre', 2, '2021-01-25 18:21:15', '2021-01-25 18:21:15'),
(10, '{\"de\":\"Shooter\"}', '{\"de\":\"shooter\"}', 'genre', 3, '2021-01-25 18:21:27', '2021-01-25 18:21:27'),
(11, '{\"de\":\"Tastatur\"}', '{\"de\":\"tastatur\"}', 'control', 4, '2021-01-25 18:21:39', '2021-01-25 18:21:39'),
(12, '{\"de\":\"Maus\"}', '{\"de\":\"maus\"}', 'control', 5, '2021-01-25 18:21:47', '2021-01-25 18:21:47'),
(13, '{\"de\":\"Endlos\"}', '{\"de\":\"endlos\"}', 'type', 6, '2021-01-25 18:22:04', '2021-01-25 18:22:04'),
(14, '{\"de\":\"Zeitbegrenzt\"}', '{\"de\":\"zeitbegrenzt\"}', 'type', 7, '2021-01-25 18:22:12', '2021-01-25 18:22:12'),
(22, '{\"de\":\"Maus&Tastatur\"}', '{\"de\":\"maustastatur\"}', 'control', 8, '2021-02-23 09:11:03', '2021-02-23 09:11:03'),
(23, '{\"de\":\"Racing\"}', '{\"de\":\"racing\"}', 'genre', 9, '2021-02-23 09:27:36', '2021-02-23 09:27:36'),
(25, '{\"de\":\"Geschick\"}', '{\"de\":\"geschick\"}', 'genre', 11, '2021-02-23 09:27:36', '2021-02-23 09:27:36'),
(26, '{\"de\":\"Abenteuer\"}', '{\"de\":\"abenteuer\"}', 'genre', 12, '2021-02-23 09:32:00', '2021-02-23 09:32:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`) VALUES
(4, 'Marcel Sippel', 'Marcel@test.de', NULL, '$2y$10$LC.DV76h/toSh15eeHLrh.jJqrfNFT4Ol85YwyDF3MIzL7tki4Mdy', NULL, '2021-02-23 13:33:09', '2021-02-23 17:53:12', 'Marcel'),
(5, 'Maik Stawinoga', 'Maik@test.de', NULL, '$2y$10$vYflUQm1PcWyoA0WdLn3D.drKf6YxbABGeNPepT9N3D87QllAe5pu', NULL, '2021-02-23 16:41:17', '2021-02-23 16:41:17', 'Maik'),
(6, 'Max Mustermann', 'Max@test.de', NULL, '$2y$10$hxpfksmwPAPH6o8jLRe2xew1gtvTbXl9k7M7EigI1E6ekZMervPru', NULL, '2021-02-23 16:41:44', '2021-02-23 16:41:44', 'Max'),
(7, 'Erika Musterfrau', 'Erika@test.de', NULL, '$2y$10$Rrt3gQDoI/TYVn6njgvGxemsSuroKxx8j7vj70PyKGZTEkJzMcKD2', NULL, '2021-02-23 16:42:50', '2021-02-23 16:42:50', 'Erika'),
(8, 'Test', 'test@test.de', NULL, '$2y$10$nCRfpevpTSySkK4CPsILUuMLrjlByzR3GuZCFo0FWB4jZHKqA9y/S', NULL, '2021-02-24 10:29:48', '2021-02-24 10:29:48', 'Test');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_game_id_foreign` (`game_id`);

--
-- Indizes für die Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indizes für die Tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `games_title_unique` (`title`);

--
-- Indizes für die Tabelle `highscores`
--
ALTER TABLE `highscores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `highscores_user_id_index` (`user_id`),
  ADD KEY `highscores_game_id_index` (`game_id`);

--
-- Indizes für die Tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_game_id_foreign` (`game_id`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indizes für die Tabelle `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indizes für die Tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_rateable_id_index` (`rateable_id`),
  ADD KEY `ratings_rateable_type_index` (`rateable_type`);

--
-- Indizes für die Tabelle `taggables`
--
ALTER TABLE `taggables`
  ADD UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `highscores`
--
ALTER TABLE `highscores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `highscores`
--
ALTER TABLE `highscores`
  ADD CONSTRAINT `highscores_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `highscores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
