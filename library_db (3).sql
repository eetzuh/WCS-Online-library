-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2023 at 02:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(2, 'Branislav Nušić'),
(3, 'Fjodor Mihailovič Dostojevski'),
(4, 'Gabrijel Garsija Markes'),
(1, 'Lav Tolstoj');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number_of_pages` smallint(11) NOT NULL,
  `publication_date` date NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `number_of_pages`, `publication_date`, `quantity`, `description`) VALUES
(1, 'Rat i mir', 897, '2009-02-14', 2, 'Rat i mir je neprevaziđeni klasik u kojem Tolstoj daje sliku ruskog društva u Napoleonovo doba i prati živote tri glavna junaka: Pjera Bezuhova, nezakonitog sina seoskog kneza, koji neočekivano dobija pozamašno nasledstvo i titulu; kneza Andreja Bolkonskog, koji napušta porodicu da bi se borio u ratu protiv Napoleona; i Nataše Rostove, prelepe i čarobne devojke koja za Tolstoja oličenje savršene žene.'),
(2, 'Hajduci', 185, '2020-03-11', 3, 'Grupa gimnazijalaca, ne baš sjajnih đaka (od kojih je svaki, zbog nekog svog nestašluka obilježen karakterističnim nadimkom), pod vođstvom pekarskog šegrta Brbe Arambaše, odlučuje da se odmetne u hajduke. Njihovi školski dani i neslavno hajdukovanje predmet su ovog romana, prepunog šala i humora. Komika dostiže vrhunac kada se odmetnicima pridruži jedno odbjeglo magare.'),
(3, 'Braća Karamazovi', 796, '2011-06-03', 0, 'Kapitalno delo velikog ruskog klasika\r\n\r\nRoman Braća Karamazovi Fjodora Dostojevskog po mišljenju mnogih kritičara i proučavalaca njegovog dela smatra se krunom autorove spisateljske karijere. Priča o porodici Karamazov Dostojevskom je poslužila kao okosnica za izuzetan filozofski roman koji istražuje hrišćansku etiku, slobodnu volju, otuđenost, suparništvo i moral.\r\n\r\nVečita borba dobra i zla svevremeno je otelotvorena u likovima Fjodora Pavloviča i njegovih sinova Mitje, Ivana, Aljoše i vanbračnog sina Smerdjakova. Nakon više od jednog veka od objavljivanja ovog romana, autentičnost i psihološka rafiniranost njihovih karaktera ne prestaju da nas intrigiraju i fasciniraju.\r\n\r\n„Porodica Karamazov predočava se kao jedan mikrokosmos, u kojem se reflektuju najvažnije protivrečnosti čovekovog bića.“ Maksimilijan Braun'),
(4, 'Sto godina samoće', 332, '2002-09-07', 0, 'Ovaj roman, već legendaran u analizama svjetske književnosti, jedna od najzanimljivijih književnih avantura našeg veka. Milioni kopija Sto godina samoće na svim jezicima i Nobelova nagrada za književnost krunisali su rad koji se probio prenoseći se s usta na usta – i kako voli da kaže pisac – najopipljiviji su dokaz da avantura fenomenalne porodice Buendija-Iguaran, sa njihovim čudima, fantazijama, opsesijama, tragedijama, incestima, preljubama, pobunama, otkrićima i uverenjima, predstavlja, u isto vreme, mit i istoriju, tragediju i svetsku ljubav.'),
(5, 'Zapisi iz podzemlja', 194, '2019-12-13', 3, 'Jedan od prvih egzistencijalističkih romana u istoriji svetske književnosti, Zapisi iz podzemlja predstavljaju zabeleške gorkog, izolovanog i nepouzdanog pripovedača. Zasnovan na jedinstvu dva suprotstavljena kompleksa, kompleksa inferiornosti i kompleksa superiornosti, čovek iz podzemlja je u socijalnom smislu neprihvaćen, neostvaren, siromašan, ali je, kako se njemu čini, u duhovnom i intelektualnom pogledu superioran u odnosu na ostale. Istovremeno labilan i osion, on spada u red najomiljenijih antijunaka među svim likovima Fjodora Dostojevskog.');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `author_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `book_id`, `author_id`) VALUES
(49, 1, 1),
(51, 3, 3),
(52, 4, 4),
(53, 5, 3),
(57, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`) VALUES
(3, 2, 2),
(4, 3, 2),
(7, 5, 3),
(8, 5, 2),
(24, 3, 3),
(35, 4, 2),
(42, 1, 1),
(45, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_user`
--

CREATE TABLE `book_user` (
  `id` int(11) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'filozofski roman'),
(1, 'ratni'),
(2, 'roman');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `author` (`author`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_author_ibfk_1` (`author_id`),
  ADD KEY `book_author_ibfk_2` (`book_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_category_ibfk_1` (`category_id`),
  ADD KEY `book_category_ibfk_2` (`book_id`);

--
-- Indexes for table `book_user`
--
ALTER TABLE `book_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_id` (`book_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `book_user`
--
ALTER TABLE `book_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_user`
--
ALTER TABLE `book_user`
  ADD CONSTRAINT `book_user_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
