-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2019 at 12:14 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myflixdb`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `accounts_v_members`
-- (See below for the actual view)
--
CREATE TABLE `accounts_v_members` (
`membership_number` int(11)
,`full_names` varchar(350)
,`gender` varchar(6)
);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `tglInput` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `remarks`, `tglInput`) VALUES
(1, 'Comedy', 'Movies with humour', '0000-00-00'),
(2, 'Romantic', 'Love stories', '0000-00-00'),
(3, 'Epic', 'Story acient movies', '0000-00-00'),
(4, 'Horror', NULL, '0000-00-00'),
(5, 'Science Fiction', NULL, '0000-00-00'),
(6, 'Thriller', NULL, '0000-00-00'),
(7, 'Action', NULL, '0000-00-00'),
(8, 'Romantic Comedy', NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `general_v_movie_rentals`
-- (See below for the actual view)
--
CREATE TABLE `general_v_movie_rentals` (
`membership_number` int(11)
,`full_names` varchar(350)
,`title` varchar(300)
,`transaction_date` date
,`return_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `membership_number` int(11) NOT NULL,
  `full_names` varchar(350) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(75) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`membership_number`, `full_names`, `gender`, `date_of_birth`, `physical_address`, `postal_address`, `contact_number`, `email`) VALUES
(1, 'Janet Jones', 'Female', '1980-07-21', 'First Street Plot No 4', 'Private Bag', '0759 253 542', 'janetjones@yagoo.cm'),
(2, 'Janet Smith Jones', 'Female', '1980-06-23', 'Melrose 123', NULL, NULL, 'jj@fstreet.com'),
(3, 'Robert Phil', 'Male', '1989-07-12', '3rd Street 34', NULL, '12345', 'rm@tstreet.com'),
(4, 'Gloria Williams', 'Female', '1984-02-14', '2nd Street 23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movierentals`
--

CREATE TABLE `movierentals` (
  `reference_number` int(11) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `membership_number` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `movie_returned` bit(1) DEFAULT b'0',
  `foto_KTP` varchar(50) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movierentals`
--

INSERT INTO `movierentals` (`reference_number`, `transaction_date`, `return_date`, `membership_number`, `movie_id`, `movie_returned`, `foto_KTP`, `harga_sewa`) VALUES
(11, '2012-06-20', NULL, 1, 1, b'0', '', 0),
(12, '2012-06-22', '2012-06-25', 1, 2, b'0', '', 0),
(13, '2012-06-22', '2012-06-25', 3, 2, b'0', '', 0),
(14, '2012-06-21', '2012-06-24', 2, 2, b'0', '', 0),
(15, '2012-06-23', NULL, 3, 3, b'0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `director` varchar(150) DEFAULT NULL,
  `year_released` year(4) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `remarks` varchar(50) NOT NULL,
  `tglInput` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `director`, `year_released`, `category_id`, `remarks`, `tglInput`) VALUES
(1, 'Pirates of the Caribean 4', ' Rob Marshall', 2011, 1, '', '0000-00-00'),
(2, 'Forgetting Sarah Marshal', 'Nicholas Stoller', 2008, 2, '', '0000-00-00'),
(3, 'X-Men', NULL, 2008, NULL, '', '0000-00-00'),
(4, 'Code Name Black', 'Edgar Jimz', 2010, NULL, '', '0000-00-00'),
(5, 'Daddy\'s Little Girls', NULL, 2007, 8, '', '0000-00-00'),
(6, 'Angels and Demons', NULL, 2007, 6, '', '0000-00-00'),
(7, 'Davinci Code', NULL, 2007, 6, '', '0000-00-00'),
(9, 'Honey mooners', 'John Schultz', 2005, 8, '', '0000-00-00'),
(16, '67% Guilty', NULL, 2012, NULL, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `membership_number` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `description` varchar(75) DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `external_reference_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `membership_number`, `payment_date`, `description`, `amount_paid`, `external_reference_number`) VALUES
(1, 1, '2012-07-23', 'Movie rental payment', 2500, 11),
(2, 1, '2012-07-25', 'Movie rental payment', 2000, 12),
(3, 3, '2012-07-30', 'Movie rental payment', 6000, NULL);

-- --------------------------------------------------------

--
-- Structure for view `accounts_v_members`
--
DROP TABLE IF EXISTS `accounts_v_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `accounts_v_members`  AS  select `members`.`membership_number` AS `membership_number`,`members`.`full_names` AS `full_names`,`members`.`gender` AS `gender` from `members` ;

-- --------------------------------------------------------

--
-- Structure for view `general_v_movie_rentals`
--
DROP TABLE IF EXISTS `general_v_movie_rentals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `general_v_movie_rentals`  AS  select `mb`.`membership_number` AS `membership_number`,`mb`.`full_names` AS `full_names`,`mo`.`title` AS `title`,`mr`.`transaction_date` AS `transaction_date`,`mr`.`return_date` AS `return_date` from ((`movierentals` `mr` join `members` `mb` on((`mr`.`membership_number` = `mb`.`membership_number`))) join `movies` `mo` on((`mr`.`movie_id` = `mo`.`movie_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`membership_number`);

--
-- Indexes for table `movierentals`
--
ALTER TABLE `movierentals`
  ADD PRIMARY KEY (`reference_number`),
  ADD KEY `fk_MovieRentals_Members1` (`membership_number`),
  ADD KEY `fk_MovieRentals_Movies1` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `fk_Movies_Categories1` (`category_id`),
  ADD KEY `title_index` (`title`),
  ADD KEY `qw` (`title`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_Payments_Members1` (`membership_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `membership_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movierentals`
--
ALTER TABLE `movierentals`
  MODIFY `reference_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movierentals`
--
ALTER TABLE `movierentals`
  ADD CONSTRAINT `fk_MovieRentals_Members1` FOREIGN KEY (`membership_number`) REFERENCES `members` (`membership_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MovieRentals_Movies1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_Movies_Categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_Payments_Members1` FOREIGN KEY (`membership_number`) REFERENCES `members` (`membership_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
