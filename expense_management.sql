-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 11:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_management`
--
CREATE DATABASE IF NOT EXISTS `expense_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `expense_management`;

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

DROP TABLE IF EXISTS `t_bank`;
CREATE TABLE `t_bank` (
  `c_id` int(11) NOT NULL,
  `c_bankname` varchar(255) NOT NULL,
  `c_ifsc` varchar(255) NOT NULL,
  `c_accountno` varchar(255) NOT NULL,
  `c_status` varchar(255) NOT NULL,
  `c_contactid` varchar(255) NOT NULL,
  `c_fundsid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is in weak relation with all payouts.';

--
-- Dumping data for table `t_bank`
--

INSERT INTO `t_bank` (`c_id`, `c_bankname`, `c_ifsc`, `c_accountno`, `c_status`, `c_contactid`, `c_fundsid`) VALUES
(11, 'Quin Ewing', 'Alias adipisci sed p', 'Quia qui sit officii', 'Et alias consequatur', '0', '0'),
(12, 'Vivian Hill', 'Voluptatem in anim r', 'Aut odit exercitatio', 'Reprehenderit quide', '0', '0'),
(13, 'Bethany Murray', 'Minima omnis dolorem', 'Et perspiciatis ea ', 'Perspiciatis in eni', '0', '0'),
(14, 'Galena Hamilton', 'Officiis neque dolor', 'Iste similique quisq', 'In unde qui omnis er', '0', '0'),
(16, 'SBI', 'SBIN0005943', '74125896325', 'Savings Account', 'cont_JgtE9wbvdBJ94i', 'fa_JgtEBBDl9R5aBN'),
(17, 'BOB', 'BKID0002751', '74125896325', 'Savings Account', 'cont_JgtE9wbvdBJ94i', 'fa_JgtM0cleU8T9IO'),
(18, 'Citibank', 'CITI0000015', '74859674859', 'Current Account', 'cont_JgtE9wbvdBJ94i', 'fa_JgtM3hXhfcTi1X'),
(22, 'Whilemina Hatfield', 'BKID0002751', '12345678901', 'Culpa incididunt in ', 'cont_JhFee8PesXvcc9', 'fa_JhFefJdBarInDI'),
(23, 'Lance Hurst', 'SBIN0000001', '14725836901', 'Cupiditate dolores o', 'cont_JhFhmjwMt3Oo9i', 'fa_JhFhoMe5rCdqNL'),
(24, 'Ariana Hatfield', 'SBIN0000001', '12345678901', 'Sed asperiores numqu', 'cont_JhKQq6lMhMJAxx', 'fa_JhKQrRoWfPuS9Q'),
(25, 'Hanna Mathews', 'SBIN0000001', '74185296301', 'Dignissimos quis in ', 'cont_JhKUOQYEupnO6T', 'fa_JhKUQ4qjhmLOCT'),
(26, 'Peter Sutton', 'BKID0002751', '78945612301', 'Quasi omnis eos ad ', 'cont_JhKUOQYEupnO6T', 'fa_JhKURN8lXasjsi'),
(27, 'Lars Mcneil', 'SBIN0000002', '70463771151', 'Sunt pariatur Sint', 'cont_JhKUOQYEupnO6T', 'fa_JhKUSc3lgQwQHw');

-- --------------------------------------------------------

--
-- Table structure for table `t_employees`
--

DROP TABLE IF EXISTS `t_employees`;
CREATE TABLE `t_employees` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_employees',
  `c_empid` int(11) DEFAULT NULL,
  `c_fname` varchar(255) NOT NULL,
  `c_lname` varchar(255) NOT NULL,
  `c_panno` varchar(255) NOT NULL,
  `c_contactno` varchar(255) NOT NULL,
  `c_banks` varchar(100) NOT NULL,
  `c_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold employee details';

--
-- Dumping data for table `t_employees`
--

INSERT INTO `t_employees` (`c_id`, `c_empid`, `c_fname`, `c_lname`, `c_panno`, `c_contactno`, `c_banks`, `c_email`) VALUES
(5, 501, 'Bethany', 'Mendoza', '233', '1234567890', '22', 'gyrynuleny@mailinator.com'),
(6, 502, 'Hayden', 'Casey', '176', '7894561230', '23', 'typol@mailinator.com'),
(7, 0, 'Deanna', 'Alford', '703', '1234569870', '25,26,27', 'jigoj@mailinator.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_emppayout`
--

DROP TABLE IF EXISTS `t_emppayout`;
CREATE TABLE `t_emppayout` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_empPayout',
  `c_empid` int(11) NOT NULL,
  `c_bank` int(11) NOT NULL,
  `c_expcategory` int(11) NOT NULL,
  `c_amount` int(11) NOT NULL,
  `c_paymentmode` varchar(255) NOT NULL,
  `c_duedate` date DEFAULT NULL,
  `c_scheduleddate` date DEFAULT NULL,
  `c_status` varchar(100) NOT NULL,
  `c_approval` varchar(255) DEFAULT NULL,
  `c_tags` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold employee payouts.';

--
-- Dumping data for table `t_emppayout`
--

INSERT INTO `t_emppayout` (`c_id`, `c_empid`, `c_bank`, `c_expcategory`, `c_amount`, `c_paymentmode`, `c_duedate`, `c_scheduleddate`, `c_status`, `c_approval`, `c_tags`, `created_at`, `modified_at`) VALUES
(14, 5, 22, 27, 50000, 'manual', '2022-06-15', NULL, 'Unpaid', NULL, 'Salary', NULL, NULL),
(15, 7, 25, 1, 75, 'schedule', '2022-03-13', '2022-06-15', 'Unpaid', 'DOC-62a9b6f952c7f3.48996030.pdf', 'Numquam repudiandae ', NULL, NULL),
(16, 5, 22, 27, 63, 'schedule', '1991-12-06', '2023-12-07', 'Unpaid', NULL, 'Ex quis ex omnis eum', NULL, NULL),
(17, 5, 22, 27, 63, 'schedule', '1991-12-06', '2023-12-07', 'Unpaid', NULL, 'Ex quis ex omnis eum', NULL, NULL),
(18, 5, 22, 27, 45000, 'manual', '2022-06-15', NULL, 'Unpaid', NULL, 'Salary', NULL, NULL),
(23, 6, 23, 27, 75000, 'manual', '2022-06-16', NULL, 'Unpaid', NULL, 'Salary', '2022-06-16 10:31:58', '2022-06-16 10:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `t_expcategories`
--

DROP TABLE IF EXISTS `t_expcategories`;
CREATE TABLE `t_expcategories` (
  `c_expid` int(11) NOT NULL COMMENT 'pk_t_expCategories',
  `c_expcode` varchar(255) NOT NULL,
  `c_category` varchar(255) NOT NULL,
  `c_type` varchar(255) NOT NULL,
  `c_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold expence type for all payouts';

--
-- Dumping data for table `t_expcategories`
--

INSERT INTO `t_expcategories` (`c_expid`, `c_expcode`, `c_category`, `c_type`, `c_description`) VALUES
(1, 'OTH', 'Other', 'employee', 'Other Categories'),
(3, 'EXP1', 'Advance Payment', 'vendor', 'This will be for payment to vendor in advance.'),
(26, 'EXP2', 'Faltu Kharcha', 'vendor', 'This is my faltu kharcha.            		'),
(27, 'EXP3', 'i dont know', 'employee', 'I do not know what is this for.            		');

-- --------------------------------------------------------

--
-- Table structure for table `t_paylogs`
--

DROP TABLE IF EXISTS `t_paylogs`;
CREATE TABLE `t_paylogs` (
  `c_id` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `fund_account_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `fees` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `utr` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

DROP TABLE IF EXISTS `t_users`;
CREATE TABLE `t_users` (
  `c_id` int(11) NOT NULL,
  `c_fname` varchar(255) NOT NULL,
  `c_lname` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `c_phoneno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`c_id`, `c_fname`, `c_lname`, `c_email`, `c_password`, `c_phoneno`) VALUES
(1, 'Admin', 'JemistryWala', 'admin@gmail.com', '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', '0123456789'),
(2, 'Meet', 'Shroff', 'meets@gmail.com', 'd0f92ce4754c21e8e1915abbda3f86db41d519f6', '1234657890');

-- --------------------------------------------------------

--
-- Table structure for table `t_vendorpayout`
--

DROP TABLE IF EXISTS `t_vendorpayout`;
CREATE TABLE `t_vendorpayout` (
  `c_id` int(11) NOT NULL,
  `c_invoiceno` int(11) NOT NULL,
  `c_venid` int(11) NOT NULL,
  `c_expcategory` int(11) NOT NULL,
  `c_amount` int(11) NOT NULL,
  `c_bankid` int(11) NOT NULL,
  `c_paymentmode` varchar(255) NOT NULL,
  `c_scheduledDate` date DEFAULT NULL,
  `c_reference` varchar(255) NOT NULL,
  `c_document` varchar(255) DEFAULT NULL,
  `c_status` varchar(255) NOT NULL,
  `c_tags` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will store vendor payouts.';

--
-- Dumping data for table `t_vendorpayout`
--

INSERT INTO `t_vendorpayout` (`c_id`, `c_invoiceno`, `c_venid`, `c_expcategory`, `c_amount`, `c_bankid`, `c_paymentmode`, `c_scheduledDate`, `c_reference`, `c_document`, `c_status`, `c_tags`, `created_at`, `modified_at`) VALUES
(1, 123456789, 3, 3, 500000, 11, 'manual', NULL, 'Hello', 'DOC-62aad71b7bd256.22067651.pdf', 'unpaid', 'hello', '2022-06-14 15:12:44', '2022-06-14 15:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `t_vendors`
--

DROP TABLE IF EXISTS `t_vendors`;
CREATE TABLE `t_vendors` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_vendors',
  `c_venid` int(11) NOT NULL,
  `c_fname` varchar(255) NOT NULL,
  `c_lname` varchar(255) NOT NULL,
  `c_nickname` varchar(100) NOT NULL,
  `c_tags` varchar(255) NOT NULL,
  `c_designation` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_contacts` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_gstno` varchar(255) NOT NULL,
  `c_banks` varchar(100) NOT NULL,
  `c_panno` varchar(255) NOT NULL,
  `c_document` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold all vendor details.';

--
-- Dumping data for table `t_vendors`
--

INSERT INTO `t_vendors` (`c_id`, `c_venid`, `c_fname`, `c_lname`, `c_nickname`, `c_tags`, `c_designation`, `c_address`, `c_contacts`, `c_email`, `c_gstno`, `c_banks`, `c_panno`, `c_document`) VALUES
(3, 0, 'Seth', 'Guerrero', 'Iola Green', 'Minima nisi irure mo', 'Et non quis amet be', 'Maxime beatae sint ', '9670676286, Delectus debitis it', 'subiqysose@mailinator.com', 'Quujhnbgbgbgbgbg', '11', 'Laborum In qui occa', NULL),
(4, 0, 'Abdul', 'Whitley', 'Blake Hebert', 'Nisi mollitia nihil ', 'Voluptatibus illo fu', 'Eius velit reiciendi', '5343937997, 85, 1', 'zipu@mailinator.com', 'Erfrfredcvgtbhyn', '12, 13', 'Eiusmod ut earum asp', 'DOC-62a45e2a490408.31248932.pdf'),
(5, 0, 'Lacey', 'Mcdowell', 'Halla Lambert', 'Veniam ab qui nemo ', 'Sunt est ea et conse', 'Ut soluta quidem eiu', '1622762144, 65', 'cycoly@mailinator.com', 'asdcsdwersfdxvfg', '14', 'Deserunt et assumend', 'DOC-62a4646184b246.56717532.pdf'),
(7, 0, 'Eliana', 'Velazquez', 'Bo Newton', 'Quibusdam lorem mini', 'Asperiores et qui in', 'Rerum dolores dolor ', '5185360970, 46', 'vedu@mailinator.com', 'ascderfvgtbhjklo', '16', 'Ut aut reiciendis vo', NULL),
(8, 0, 'Eliana', 'Velazquez', 'Bo Newton', 'Quibusdam lorem mini', 'Asperiores et qui in', 'Rerum dolores dolor ', '5185360970, 46', 'vedu@mailinator.com', 'ascderfvgtbhjklo', '17, 18', 'Ut aut reiciendis vo', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_bank`
--
ALTER TABLE `t_bank`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_employees`
--
ALTER TABLE `t_employees`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_emppayout`
--
ALTER TABLE `t_emppayout`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_t_employee_t_emppayout` (`c_empid`),
  ADD KEY `fk_t_expcategories_t_emppayout` (`c_expcategory`),
  ADD KEY `fk_t_bank_t_emppayout` (`c_bank`);

--
-- Indexes for table `t_expcategories`
--
ALTER TABLE `t_expcategories`
  ADD PRIMARY KEY (`c_expid`);

--
-- Indexes for table `t_paylogs`
--
ALTER TABLE `t_paylogs`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_t_vendors_t_vendorpayout` (`c_venid`),
  ADD KEY `fk_t_expcategories_t_vendorpayouts` (`c_expcategory`),
  ADD KEY `fk_t_bank_t_vendorpayout` (`c_bankid`);

--
-- Indexes for table `t_vendors`
--
ALTER TABLE `t_vendors`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_bank`
--
ALTER TABLE `t_bank`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_employees`
--
ALTER TABLE `t_employees`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_employees', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_emppayout`
--
ALTER TABLE `t_emppayout`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_empPayout', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_expcategories`
--
ALTER TABLE `t_expcategories`
  MODIFY `c_expid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_expCategories', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `t_paylogs`
--
ALTER TABLE `t_paylogs`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_vendors`
--
ALTER TABLE `t_vendors`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_vendors', AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_emppayout`
--
ALTER TABLE `t_emppayout`
  ADD CONSTRAINT `fk_t_bank_t_emppayout` FOREIGN KEY (`c_bank`) REFERENCES `t_bank` (`c_id`),
  ADD CONSTRAINT `fk_t_employee_t_emppayout` FOREIGN KEY (`c_empid`) REFERENCES `t_employees` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_expcategories_t_emppayout` FOREIGN KEY (`c_expcategory`) REFERENCES `t_expcategories` (`c_expid`);

--
-- Constraints for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  ADD CONSTRAINT `fk_t_bank_t_vendorpayout` FOREIGN KEY (`c_bankid`) REFERENCES `t_bank` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_expcategories_t_vendorpayouts` FOREIGN KEY (`c_expcategory`) REFERENCES `t_expcategories` (`c_expid`),
  ADD CONSTRAINT `fk_t_vendors_t_vendorpayout` FOREIGN KEY (`c_venid`) REFERENCES `t_vendors` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
