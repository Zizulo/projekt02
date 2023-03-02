-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Lut 2023, 12:15
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `strona_logowania`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pass` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`) VALUES
(1, 'czarek', '$2y$10$ldJFjxdDZgNs4.hWV9NHrOuPLCvyV65Wh2Wqe7t59C6XozXCLWSbO', 'czarek@gmail.com'),
(2, 'czarus123', '$2y$10$HmtrzRZ6T2ocyPOjXClsk.E3yhxcIznnrBkALuh2rwU0FF2nu71he', 'terra@gmail.com'),
(3, 'dodbr', '$2y$10$/B90fmsWE/06OCTSmT3Xiu6rC8V3U2.XtRm9PbkPoVdKZqRasmN3K', 'asdas@gmail.com'),
(4, 'shshshs12', '$2y$10$AP2YLq.Si2PkxZwl4.V6aeccxjZbhKJmPVSF164JVnJQHdui8ieaW', 'hdhdhd12@gmail.com'),
(5, 'sfsdfssf', '$2y$10$W/Csgf67nMtaYDwpBF89reSdBH.Ezj6axDJrOepjn929VyQ7hZ44u', 'sdfsdfdf@gmail.com'),
(6, 'fsfsdf', '$2y$10$oI3HqXqoRX3aEni.7Tcd2.Jz/mTwE0gqcLoNUfCGp4TFZJvYSxyQ6', 'sssssss@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
