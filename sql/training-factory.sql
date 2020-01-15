-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 jan 2020 om 14:30
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training-factory`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_persons` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lesson`
--

INSERT INTO `lesson` (`id`, `time`, `date`, `location`, `max_persons`, `training_id`, `person_id`) VALUES
(4, '00:00:00', '2020-01-01', 'den haag', 100, 1, 1),
(5, '00:00:00', '2020-01-01', '213', 1000, 1, 1),
(6, '03:00:00', '2020-01-01', 'den haag', 23, 4, 4),
(7, '14:00:00', '2020-02-05', 'Den haag', 30, 1, 4),
(9, '04:10:00', '2020-05-05', 'Den Haag', 10, 3, 1),
(10, '00:05:00', '2020-02-01', 'Delft', 23, 1, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preprovision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiring_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `person`
--

INSERT INTO `person` (`id`, `password`, `firstname`, `preprovision`, `lastname`, `dateofbirth`, `gender`, `emailaddress`, `hiring_date`, `salary`, `street`, `postal_code`, `place`, `username`, `roles`) VALUES
(1, '$argon2id$v=19$m=65536,t=4,p=1$MDE1NnpnYkthVFg2bXZ6Ug$to62e4qxkMZ0CqwQS8zQgW2z5aYCm8wD10zuewh9LSM', 'Bart', 'van', 'Velder', '1999-10-31', 'man', 'bartmin@school.nl', '2019-12-11', '100.43', NULL, NULL, NULL, 'bartVelder', '[\"ROLE_INSTRUCTOR\"]'),
(2, '$argon2id$v=19$m=65536,t=4,p=1$QW9EcHduNjVBSEVnL3kwUA$4XYD21g2kMBDDFBd/ve0tgLxKJURa2A4mjZHes1rOiY', 'Klaas', NULL, 'Zelde', '1982-04-02', 'man', 'klaas24z@school.nl', NULL, NULL, 'klaasveld 4', '0231 A', 'Den haag', 'zeldaKlaas', '[\"ROLE_MEMBER\"]'),
(3, '$argon2id$v=19$m=65536,t=4,p=1$M1Z6ZXZ3UEg1eEVZRW1tTA$KfLgW/GJ+s3JjUixOy9YO3XPe7LyyzrIOttlmfZ0/HQ', 'Patricia', NULL, 'Potters', '1992-04-25', 'vrouw', 'patnl@outlook.nl', '2019-12-11', '2300.21', NULL, NULL, NULL, 'pattypotter', '[\"ROLE_ADMIN\"]'),
(4, '$argon2id$v=19$m=65536,t=4,p=1$WlJxaU81V05Pang4T2kvYQ$mGCwpwpqCXGcYulSOeTKDKsEJsflXXn+LsfyWFCg16E', 'Jeff', '', 'Jeff', '2015-01-01', 'jeff', 'jeffaseger@gmail.com', NULL, NULL, NULL, NULL, NULL, 'jeff', '[\"ROLE_INSTRUCTOR\"]'),
(5, '$argon2id$v=19$m=65536,t=4,p=1$Rm14Qm4zUjRucXI3MVEzMw$6oBS7ZmGYuhS2m7oBiNoh84jXrX/HTgZ+xNmv9wv/SI', 'Jeffrey W', NULL, 'Seger', '1998-10-31', 'Man', 'jeffaseger@gmail.com', NULL, NULL, NULL, NULL, NULL, 'EloquentRaccoon', '[\"ROLE_MEMBER\"]');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desciption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` time NOT NULL,
  `costs` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `naam`, `desciption`, `duration`, `costs`) VALUES
(1, 'Fitbike Ride', '15KM fietsen op een home trainer cross fiets', '01:10:00', '24.50'),
(2, 'Stootzakken', '30 minuten oefeningen op stootzakken', '00:30:00', '10.00'),
(3, 'MMA', 'Gemixde vormen van MMA sporten oefenen voor zelfverdediging', '01:00:00', '25.95'),
(4, 'Kickboksen', 'Kickboks training, gemixt voor beginner en gevorderden', '01:00:00', '14.95'),
(5, 'Hardlopen', '10KM hardlopen op de loopband', '01:30:00', '24.50'),
(6, 'pushups', '100 pushups', '00:00:00', '10.00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`),
  ADD KEY `IDX_F87474F3217BBB47` (`person_id`);

--
-- Indexen voor tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_34DCD176F85E0677` (`username`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`),
  ADD KEY `IDX_62A8A7A7217BBB47` (`person_id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);

--
-- Beperkingen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A7217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
