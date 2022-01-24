-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Sty 2022, 11:51
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `clocker`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `client`
--

INSERT INTO `client` (`id`, `userId`, `name`) VALUES
(7, 1, 'Zachodniopomorski Uniwersytet Technologiczny  ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `ownerId`, `name`) VALUES
(4, 1, 'Frontend Team'),
(5, 1, 'Backend Team');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `project`
--

INSERT INTO `project` (`id`, `ownerId`, `groupId`, `clientId`, `name`) VALUES
(3, 1, 4, 7, 'Clocker frontend'),
(4, 1, 5, 7, 'Clocker backend');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `start` datetime DEFAULT NULL,
  `stop` datetime DEFAULT NULL,
  `startSession` int(11) DEFAULT NULL,
  `totalTime` int(11) DEFAULT 0,
  `description` varchar(256) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`id`, `userId`, `projectId`, `name`, `start`, `stop`, `startSession`, `totalTime`, `description`) VALUES
(13, 5, 3, 'Dashboard views', NULL, NULL, NULL, 0, 'Create dashboard views for admin and user with action buttons and list of projects'),
(14, 4, 3, 'Management views', NULL, NULL, NULL, 0, 'Create views for managing group/client/project'),
(15, 2, 4, 'Seed database', NULL, NULL, NULL, 0, 'Seed database with sample data'),
(16, 2, 4, 'Add user management system', NULL, NULL, NULL, 0, 'Add user management with ability to change user privileges'),
(17, 1, 4, 'Add group management system', NULL, NULL, NULL, 0, 'Add group management system with ability to add new group and add users to existing group');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `hash` varchar(2048) COLLATE utf8_polish_ci NOT NULL,
  `role` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `hash`, `role`) VALUES
(1, 'Konrad', 'Byczynski', 'konrad@zut.pl', '$2y$10$B/i1eV8CCZaNL1QTKZPvOeKiRzA2uJ32DrlxEcRJKUY09pq3ZoPkO', 'admin'),
(2, 'Pawel', 'Drozgowski', 'pawel@zut.pl', '$2y$10$8xVc.oVBAiAJ9s/CfqA84O1ghbCoXe54n.WII0jD2umW2Hbevrvom', 'user'),
(4, 'maks', 'wiese', 'maks@zut.pl', '$2y$10$XZMpgUq2WDeLADmGY3D4ketQaDWHN.YdW3R3NwGVqAwSSz4ALKlC2', 'user'),
(5, 'Paweł', 'Durczak', 'pawel2@zut.pl', '$2y$10$UovgfTtO55a/tIPrCw9INuGeq.2bkGY3Dd5NzjGoaPtHyWIARKbqy', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usersgroups`
--

CREATE TABLE `usersgroups` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `usersgroups`
--

INSERT INTO `usersgroups` (`id`, `groupId`, `userId`) VALUES
(12, 4, 1),
(13, 5, 1),
(14, 4, 5),
(15, 4, 4),
(16, 5, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `usersgroups`
--
ALTER TABLE `usersgroups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `usersgroups`
--
ALTER TABLE `usersgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
