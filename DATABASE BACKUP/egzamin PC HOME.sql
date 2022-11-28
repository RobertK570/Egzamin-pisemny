-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Paź 2022, 19:47
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
(3, 'Technik fryzjerstwa', 'FRYZ.01', 3, 0),
(4, 'Technik fryzjerstwa', 'FRYZ.01', 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan`
--

CREATE TABLE `plan` (
  `ID` int(11) NOT NULL,
  `Egzamin_ID` int(11) NOT NULL,
  `Ilosc_uczniow` int(11) NOT NULL,
  `Kwalifikacja_KOD` varchar(30) NOT NULL,
  `Data_Poczatek` date NOT NULL,
  `Data_Koniec` date NOT NULL,
  `Done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `plan`
--

INSERT INTO `plan` (`ID`, `Egzamin_ID`, `Ilosc_uczniow`, `Kwalifikacja_KOD`, `Data_Poczatek`, `Data_Koniec`, `Done`) VALUES
(2, 1, 16, 'TKO.07', '2022-10-27', '2022-10-29', 0),
(3, 2, 22, 'FRK.01', '2022-10-27', '2022-10-23', 0),
(4, 3, 186, 'INF.02', '2022-10-17', '2022-10-13', 0),
(5, 1, 67, 'ELM.02', '2022-10-17', '0000-00-00', 0);

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
(1, 'K3', 16, 0),
(2, 'K4', 25, 1),
(3, 'K6', 14, 1),
(4, 'K7', 18, 1),
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
