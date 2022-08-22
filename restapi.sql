-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sie 2022, 20:58
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `restapi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`id`, `balance`, `owner`, `password`) VALUES
(1, '100.00', 'Marian Kowalski', 'ee77929e2e4ce4384874fadc7a76a1d1'),
(2, '36001.00', 'Jan Nowak', 'effde1470b0eda99445391c9e7092faa'),
(3, '10000.00', 'Monika Brodka', '224bc9660a00c4f038f6e98ec4abee1b'),
(4, '10.00', 'Wojtek Drwal', 'f34174640d7956e8233cc197cb94fd49'),
(7, '0.00', 'iwo', 'c56b5860af6a9ecd1713cc8fb36043fa'),
(8, '0.00', 'damian', 'c56b5860af6a9ecd1713cc8fb36043fa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` decimal(13,2) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `transactions`
--

INSERT INTO `transactions` (`id`, `date`, `value`, `owner_id`) VALUES
(1, '2022-08-19', '5000.00', 2),
(2, '2022-08-19', '5000.00', 2),
(3, '2022-08-19', '5000.00', 2),
(4, '2022-08-19', '5000.00', 2),
(5, '2022-08-19', '5000.00', 2),
(6, '2022-08-19', '-0.50', 2),
(7, '2022-08-19', '-0.50', 2),
(8, '2022-08-19', '50000.00', 2),
(9, '2022-08-19', '5000.00', 2),
(10, '2022-08-19', '-5000.00', 2),
(11, '2022-08-19', '-5000.00', 2),
(12, '2022-08-19', '5000.00', 2),
(13, '2022-08-19', '-5000.00', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
