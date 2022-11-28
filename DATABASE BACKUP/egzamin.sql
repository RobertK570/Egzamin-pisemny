-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Paź 2022, 10:13
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `egzamin`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzaminy`
--

CREATE TABLE `egzaminy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `kod` varchar(30) NOT NULL,
  `id_zawodu` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `egzaminy`
--

INSERT INTO `egzaminy` (`id`, `nazwa`, `kod`, `id_zawodu`, `disabled`) VALUES
(1, 'Technik Informatyk', 'INF.02', 1, 0),
(2, 'Technik elektronik', 'INF.03', 2, 0),
(3, 'Technik fryzjerstwa', 'FRYZ.01', 3, 1),
(4, 'Technik fryzjerstwa', 'FRYZ.01', 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan`
--

CREATE TABLE `plan` (
  `ID` int(11) NOT NULL,
  `Egzamin_ID` int(11) NOT NULL,
  `Egzamin_Dni` int(11) NOT NULL,
  `Ilosc_uczniow` int(11) NOT NULL,
  `Sale` text NOT NULL,
  `Kwalifikacja_KOD` varchar(30) NOT NULL,
  `Data_Poczatek` date NOT NULL,
  `Data_Koniec` date NOT NULL,
  `Godz8` text NOT NULL,
  `Godz10` text NOT NULL,
  `Godz12` text NOT NULL,
  `Godz14` text NOT NULL,
  `Godz16` text NOT NULL,
  `Done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `plan`
--

INSERT INTO `plan` (`ID`, `Egzamin_ID`, `Egzamin_Dni`, `Ilosc_uczniow`, `Sale`, `Kwalifikacja_KOD`, `Data_Poczatek`, `Data_Koniec`, `Godz8`, `Godz10`, `Godz12`, `Godz14`, `Godz16`, `Done`) VALUES
(2, 1, 2, 30, '', 'INF.02', '2022-10-27', '2022-10-29', '', '', '', '', '', 0),
(3, 2, 3, 100, '', 'INF.03', '2022-10-20', '2022-10-23', '', '', '', '', '', 0),
(4, 3, 1, 10, '', 'FRYZ', '2022-10-12', '2022-10-13', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `nr_sali` varchar(30) NOT NULL,
  `ilosc_stanowisk` int(11) NOT NULL,
  `disabled` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `sale`
--

INSERT INTO `sale` (`id`, `nr_sali`, `ilosc_stanowisk`, `disabled`) VALUES
(1, 'K3', 16, 1),
(2, 'K4', 25, 0),
(3, 'K6', 14, 0),
(4, 'K7', 18, 0),
(5, '18', 15, 0),
(6, '19', 15, 0),
(7, '20', 20, 0),
(8, '21', 15, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `egzaminy`
--
ALTER TABLE `egzaminy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `egzaminy`
--
ALTER TABLE `egzaminy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `plan`
--
ALTER TABLE `plan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
