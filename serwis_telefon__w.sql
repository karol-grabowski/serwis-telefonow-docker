-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Sty 2024, 22:07
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
-- Baza danych: `serwis_telefonów`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `imię` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8mb4_polish_ci NOT NULL,
  `email` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nr telefonu` int(11) NOT NULL,
  `kraj` text COLLATE utf8mb4_polish_ci NOT NULL,
  `miasto` text COLLATE utf8mb4_polish_ci NOT NULL,
  `kod pocztowy` text COLLATE utf8mb4_polish_ci NOT NULL,
  `ulica` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nr domu/mieszkania` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `imię`, `nazwisko`, `email`, `nr telefonu`, `kraj`, `miasto`, `kod pocztowy`, `ulica`, `nr domu/mieszkania`) VALUES
(1, 'Emil', 'Nowak', 'emnowak@gmail.com', 324543234, 'Polska', 'Warszawa', '12-345', 'Kwiatowa', '32'),
(2, 'Jan', 'Kowalski', 'jkowal@gmail.com', 343212321, 'Polska', 'Warszawa', '90-212', 'Nowa', '322'),
(3, 'Wiktoria', 'Kowal', 'wkow@gmail.com', 999212111, 'Polska', 'Kraków', '09-212', 'Opolska', '12'),
(4, 'Karol', 'Reguła', 'kregul@gmail.com', 987456321, 'Polska', 'Szczecin', '12-321', 'Konwaliowa', '212'),
(5, 'Marek', 'Lis', 'mli@gmail.com', 333444211, 'Polska', 'Warszawa', '07-765', 'Kalinowa', '98'),
(6, 'Marek', 'Kot', 'mli@gmail.com', 333444211, 'Polska', 'Kraków', '07-765', 'Kalinowa', '12'),
(7, 'Karol', 'Reguła', 'kregul@gmail.com', 987456321, 'Polska', 'Szczecin', '12-321', 'Konwaliowa', '212'),
(8, 'Ewa', 'Kowal', 'wkow@gmail.com', 999212111, 'Polska', 'Warszawa', '09-212', 'Opolska', '12'),
(9, 'Ewa', 'Kowalska', 'ekowal@gmail.com', 343212322, 'Polska', 'Warszawa', '90-212', 'Nowa', '321'),
(10, 'Emil', 'Nowak', 'emnowak@gmail.com', 324543234, 'Polska', 'Warszawa', '12-345', 'Kwiatowa', '32'),
(11, 'Emil', 'Nowak', 'emnowak@gmail.com', 324543234, 'Polska', 'Warszawa', '12-345', 'Kwiatowa', '32'),
(12, 'Kacper', 'Nowak', 'kacpnow@gmail.com', 324543123, 'Polska', 'Warszawa', '12-322', 'Kwiatowa', '87');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id`, `login`, `haslo`) VALUES
(1, 'admin', '$2y$10$yzkUs8hjHyPrSCKBvLgAae6hcvVvliPYttl8IfzHicz4y8IVEtJZW'),
(2, 'pracownik1', '$2y$10$wo0CsWXyqycIlFCvgJf.leFcClpV.ZgyQq03xcn/R2JhYpMEuCN/e'),
(3, 'pracownik2', '$2y$10$0LraEMc7wdBBjCnAP1.B6u6w.Zd1duEueaMIm4WxDlfDN3fSc07xG'),
(4, 'pracownik3', '$2y$10$v/B/gTztE79kTvoFmFTcGebYBBFToy9S9cWGRYkm2NFOo2IAWqDjy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazyn`
--

CREATE TABLE `magazyn` (
  `Numer` int(11) NOT NULL,
  `nazwa elementu` text COLLATE utf8mb4_polish_ci NOT NULL,
  `opis elementu` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Pobrany z` text COLLATE utf8mb4_polish_ci NOT NULL,
  `ilosc` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `magazyn`
--

INSERT INTO `magazyn` (`Numer`, `nazwa elementu`, `opis elementu`, `Pobrany z`, `ilosc`) VALUES
(1, 'Szkło hartowane ', 'pasuje do Huawei P10 LITE', 'zakup hurtowy', '145'),
(2, 'Szkło hartowane ', 'pasuje do Samsung S10 ', 'zakup', '15'),
(3, 'Moduł NFC', 'sprawny ', 'Samsung S10 ', '1'),
(4, 'Aparat DD211', 'Sprawny, z małymi rysami', 'Samsung A52', '3'),
(5, 'Głośnik', 'Sprawny ', 'Sony X12', '2'),
(6, 'Moduł Bluetooth', 'Sprawny, oczyszczony', 'Xiaomi redmi note 11', '3'),
(7, 'Ekran', 'stan dobry, zdatny do ponownego użycia', 'IPhone 13', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naprawy`
--

CREATE TABLE `naprawy` (
  `id` int(11) NOT NULL,
  `Producent` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Model` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Kod producenta` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Data przyjęcia` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Data odbioru` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Opis` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Dodany przez` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `naprawy`
--

INSERT INTO `naprawy` (`id`, `Producent`, `Model`, `Kod producenta`, `Data przyjęcia`, `Data odbioru`, `Opis`, `Dodany przez`) VALUES
(1, 'Samsung', 'S10', '12SA211', '2024-01-02', '2024-01-30', 'wymiana ekranu', 'pracownik3'),
(2, 'Sony', 'X12', '43R33', '2024-01-06', '2024-01-19', 'Regeneracja wizualna', 'pracownik3'),
(3, 'Samsung', 'A52', 'PPP09', '2024-01-30', '2024-01-30', 'Montaż szkła hartowanego', 'pracownik3'),
(4, 'Samsung', 'A52', 'PPP09', '2024-01-30', '2024-01-30', 'Montaż szkła hartowanego', 'pracownik3'),
(5, 'Motorola', 'G52', 'PI99', '2023-11-09', '2023-12-01', 'Naprawa modułu NFC', 'pracownik3'),
(6, 'IPhone', '13', 'IP121#2', '2024-01-18', '2024-01-29', 'Wymiana ekranu', 'pracownik3'),
(7, 'IPhone', '13', 'IP121#2', '2023-12-21', '2024-01-03', 'Wymiana aparatu', 'pracownik3'),
(8, 'Motorola', 'G72', 'PI99', '2023-11-10', '2023-12-03', 'Naprawa modułu NFC', 'pracownik3'),
(9, 'Samsung', 'A53S', 'PPP09', '2024-01-30', '2024-02-01', 'Wymiana głośnika', 'pracownik3'),
(10, 'Samsung', 'A53S', 'PPP09', '2024-01-30', '2024-02-01', 'Wymiana głośnika', 'pracownik3'),
(11, 'Sony', 'M2', '43R33', '2024-01-06', '2024-01-19', 'Wymiana ekranu', 'pracownik3'),
(12, 'Samsung', 'S20', '12SA211', '2024-01-02', '2024-01-30', 'wymiana ekranu', 'pracownik3'),
(13, 'Samsung', 'S21', '12SA211', '2024-01-02', '2024-01-30', 'wymiana aparatu', 'pracownik3'),
(14, 'Samsung', 'S8', '12SA211', '2024-01-02', '2024-01-30', 'wymiana aparatu', 'pracownik3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozliczenia`
--

CREATE TABLE `rozliczenia` (
  `id` int(11) NOT NULL,
  `cena części zamiennych` int(11) NOT NULL,
  `opłata za naprawę` int(11) NOT NULL,
  `do zapłaty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `rozliczenia`
--

INSERT INTO `rozliczenia` (`id`, `cena części zamiennych`, `opłata za naprawę`, `do zapłaty`) VALUES
(1, 120, 65, 185),
(2, 15, 40, 55),
(3, 20, 6, 26),
(4, 90, 75, 165),
(5, 300, 199, 499),
(6, 280, 170, 450),
(7, 121, 75, 196),
(8, 87, 140, 227),
(9, 15, 40, 55),
(10, 120, 65, 185),
(11, 321, 98, 419),
(12, 321, 98, 419);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  ADD PRIMARY KEY (`Numer`);

--
-- Indeksy dla tabeli `naprawy`
--
ALTER TABLE `naprawy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rozliczenia`
--
ALTER TABLE `rozliczenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  MODIFY `Numer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `naprawy`
--
ALTER TABLE `naprawy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `rozliczenia`
--
ALTER TABLE `rozliczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
