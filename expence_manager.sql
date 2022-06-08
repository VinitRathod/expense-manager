-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2022 at 12:18 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expence_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

CREATE TABLE `t_bank` (
  `c_id` int(11) NOT NULL,
  `c_bankname` varchar(255) NOT NULL,
  `c_ifsc` varchar(255) NOT NULL,
  `c_accountno` varchar(255) NOT NULL,
  `c_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is in weak relation with all payouts.';

-- --------------------------------------------------------

--
-- Table structure for table `t_employees`
--

CREATE TABLE `t_employees` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_employees',
  `c_fname` varchar(255) NOT NULL,
  `c_lname` varchar(255) NOT NULL,
  `c_panno` varchar(255) NOT NULL,
  `c_contactno` varchar(255) NOT NULL,
  `c_banks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold employee details';

-- --------------------------------------------------------

--
-- Table structure for table `t_emppayout`
--

CREATE TABLE `t_emppayout` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_empPayout',
  `c_empid` int(11) NOT NULL,
  `c_expcategory` int(11) NOT NULL,
  `c_amount` int(11) NOT NULL,
  `c_paymentmode` varchar(255) NOT NULL,
  `c_duedate` date NOT NULL,
  `c_scheduleddate` date NOT NULL,
  `c_status` varchar(100) NOT NULL,
  `c_approval` varchar(255) NOT NULL,
  `c_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold employee payouts.';

-- --------------------------------------------------------

--
-- Table structure for table `t_expcategories`
--

CREATE TABLE `t_expcategories` (
  `c_expid` int(11) NOT NULL COMMENT 'pk_t_expCategories',
  `c_category` varchar(255) NOT NULL,
  `c_type` varchar(255) NOT NULL,
  `c_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold expence type for all payouts';

-- --------------------------------------------------------

--
-- Table structure for table `t_vendorpayout`
--

CREATE TABLE `t_vendorpayout` (
  `c_invoiceno` int(11) NOT NULL COMMENT 'pk_t_vendorpayout',
  `c_venid` int(11) NOT NULL,
  `c_expcategory` int(11) NOT NULL,
  `c_amount` int(11) NOT NULL,
  `c_dueDate` date NOT NULL,
  `c_scheduledDate` date NOT NULL,
  `c_reference` varchar(255) NOT NULL,
  `c_document` varchar(255) NOT NULL,
  `c_status` varchar(255) NOT NULL,
  `c_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will store vendor payouts.';

-- --------------------------------------------------------

--
-- Table structure for table `t_vendors`
--

CREATE TABLE `t_vendors` (
  `c_id` int(11) NOT NULL COMMENT 'pk_t_vendors',
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
  `c_document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table will hold all vendor details.';

--
-- Indexes for dumped tables
--

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
  ADD KEY `fk_t_expcategories_t_emppayout` (`c_expcategory`);

--
-- Indexes for table `t_expcategories`
--
ALTER TABLE `t_expcategories`
  ADD PRIMARY KEY (`c_expid`);

--
-- Indexes for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  ADD PRIMARY KEY (`c_invoiceno`),
  ADD KEY `fk_t_vendors_t_vendorpayout` (`c_venid`),
  ADD KEY `fk_t_expcategories_t_vendorpayouts` (`c_expcategory`);

--
-- Indexes for table `t_vendors`
--
ALTER TABLE `t_vendors`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_employees`
--
ALTER TABLE `t_employees`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_employees';

--
-- AUTO_INCREMENT for table `t_emppayout`
--
ALTER TABLE `t_emppayout`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_empPayout';

--
-- AUTO_INCREMENT for table `t_expcategories`
--
ALTER TABLE `t_expcategories`
  MODIFY `c_expid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_expCategories';

--
-- AUTO_INCREMENT for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  MODIFY `c_invoiceno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_vendorpayout';

--
-- AUTO_INCREMENT for table `t_vendors`
--
ALTER TABLE `t_vendors`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk_t_vendors';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_emppayout`
--
ALTER TABLE `t_emppayout`
  ADD CONSTRAINT `fk_t_employee_t_emppayout` FOREIGN KEY (`c_empid`) REFERENCES `t_employees` (`c_id`),
  ADD CONSTRAINT `fk_t_expcategories_t_emppayout` FOREIGN KEY (`c_expcategory`) REFERENCES `t_expcategories` (`c_expid`);

--
-- Constraints for table `t_vendorpayout`
--
ALTER TABLE `t_vendorpayout`
  ADD CONSTRAINT `fk_t_expcategories_t_vendorpayouts` FOREIGN KEY (`c_expcategory`) REFERENCES `t_expcategories` (`c_expid`),
  ADD CONSTRAINT `fk_t_vendors_t_vendorpayout` FOREIGN KEY (`c_venid`) REFERENCES `t_vendors` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
