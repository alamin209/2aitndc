-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2019 at 01:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ndc`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjunic_teachers`
--

CREATE TABLE `adjunic_teachers` (
  `id` int(11) NOT NULL,
  `degree_id` int(10) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sem_id` varchar(10) NOT NULL,
  `batch_id` varchar(120) NOT NULL,
  `session_id` varchar(120) NOT NULL,
  `course_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `lecture_no` int(120) NOT NULL,
  `current_position` varchar(255) DEFAULT NULL,
  `lecture_duration` varchar(120) NOT NULL,
  `total_payment` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adjunic_teachers`
--

INSERT INTO `adjunic_teachers` (`id`, `degree_id`, `sub_id`, `sem_id`, `batch_id`, `session_id`, `course_id`, `emp_id`, `lecture_no`, `current_position`, `lecture_duration`, `total_payment`, `created_at`, `updated_at`) VALUES
(1, 3, 21, '1st', '01', '2015-2016', 10, 7, 4, 'test course', '1.30', '300', '2019-09-23 09:20:52', '2019-09-23 09:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `admission_payments`
--

CREATE TABLE `admission_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sl_no` varchar(50) NOT NULL,
  `slip_date` date NOT NULL,
  `name_of_applicant` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `sessions` varchar(50) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `subjects` text NOT NULL,
  `amount_type` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `inco_cat` varchar(102) NOT NULL,
  `inco_type` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `s_bank` int(11) NOT NULL,
  `s_bank_branch` int(11) NOT NULL,
  `s_bank_act` int(11) DEFAULT NULL,
  `t_bank` int(11) NOT NULL,
  `t_bank_branch` int(11) NOT NULL,
  `t_bank_act` int(11) DEFAULT NULL,
  `amount` varchar(50) NOT NULL,
  `cheque` text,
  `note` text,
  `trnsferdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_transfers`
--

INSERT INTO `balance_transfers` (`id`, `payment_type`, `s_bank`, `s_bank_branch`, `s_bank_act`, `t_bank`, `t_bank_branch`, `t_bank_act`, `amount`, `cheque`, `note`, `trnsferdate`) VALUES
(10, 3, 38, 37, 14, 37, 36, 6, '250000', NULL, 'Fund Transfer', '2019-07-02'),
(11, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary, month of July 2019 . Cheque no-9165731 on Janata Bank Limited', '2019-07-01'),
(12, 3, 38, 37, 15, 38, 37, 2, '1144500', NULL, 'Fund Transfer for Festival Allowances (Eid ul Adha 2019). Cheque no-9165732 on Janata Bank Limited', '2019-07-01'),
(13, 3, 37, 36, 1, 37, 36, 1, '1200', NULL, 'test trasfer', '2019-09-11'),
(14, 3, 37, 36, 1, 37, 36, 1, '1200', NULL, 'test trasfer', '2019-09-11'),
(15, 3, 37, 36, 1, 37, 36, 1, '1200', NULL, 'test trasfer', '2019-09-11'),
(16, 5, 37, 36, 6, 0, 0, 0, '8605', NULL, 'Impreset Money- Amount Drawn by cheque (no-1868557) on PBL', '2019-07-02'),
(17, 6, 0, 0, 0, 37, 36, 6, '5429', NULL, 'Cash for Telephone bill-Amount withdraw by Cheuqe (no-1868562) on PBL', '2019-07-14'),
(18, 5, 37, 36, 6, 0, 0, 0, '5429', NULL, 'Cash for Telephone bill -Amount withdraw by cheque (no-1868562) on PBL', '2019-07-14'),
(19, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary. Amount transfer from SOD Account. Cheque no-1965731 on JBL', '2019-08-01'),
(20, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary. Amount transfer from SOD Account. Cheque no-1965731 on JBL', '2019-08-01'),
(21, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary. Amount transfer from SOD Account. Cheque no-1965731 on JBL', '2019-08-01'),
(22, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary. Amount transfer from SOD Account. Cheque no-1965731 on JBL', '2019-08-01'),
(23, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary. Amount transfer from SOD Account. Cheque no-1965731 on JBL', '2019-08-01'),
(24, 3, 38, 37, 15, 37, 36, 6, '1000', NULL, 'sod2 to rpl3 1000', '2019-09-04'),
(25, 3, 38, 37, 15, 38, 37, 2, '1997000', NULL, 'Fund Transfer for Salary . Month of July 2019. Amount transfer from cheque (no-9165731) on JBL', '2019-08-01'),
(26, 3, 38, 37, 15, 38, 37, 2, '1144500', NULL, 'Fund Transfer for Festival Allowances (Eid ul Adha 2019) - Amount transfer to cheque no- 9165732 on JBL', '2019-08-01'),
(27, 3, 38, 37, 14, 38, 37, 2, '2062000', NULL, 'Fund Transfer', '2019-09-01'),
(28, 5, 37, 36, 6, 0, 0, 0, '8605', NULL, 'Impreset Money-', '2019-07-02'),
(29, 5, 37, 36, 6, 0, 0, 0, '5429', NULL, 'Cash for Telephone Bill', '2019-07-14'),
(30, 4, 37, 36, 6, 37, 36, 9, '8605', NULL, 'Impreset Money', '2019-07-02'),
(31, 4, 37, 36, 6, 37, 36, 9, '5429', NULL, 'Cash for Telephone Bill', '2019-07-14'),
(32, 4, 37, 36, 6, 37, 36, 9, '9070', NULL, 'Impreset Money', '2019-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(191) CHARACTER SET utf8 NOT NULL,
  `bank_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_code`, `status`, `created_at`, `updated_at`) VALUES
(37, 'Pubali Bank Ltd.', NULL, 1, '2019-06-18 10:52:25', '2019-06-18 10:52:25'),
(38, 'Janata Bank', NULL, 1, '2019-06-30 11:52:07', '2019-06-30 11:52:07'),
(40, 'Southest Bank', NULL, 1, '2019-09-07 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_details_id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `acc_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(1) NOT NULL COMMENT '3 for cash, 2 for money withdrow from that account  for expense  ,1 for  uodate balance from that bank',
  `acc_code` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `acc_details` varchar(191) CHARACTER SET utf8 NOT NULL,
  `open_balance` int(11) NOT NULL,
  `update_balance` int(11) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_details_id`, `bank_id`, `branch_id`, `acc_no`, `type`, `acc_code`, `acc_details`, `open_balance`, `update_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 37, 36, 'Account-1', 1, '34590', 'deposite Acount', 185, 185, 1, '2019-06-26 06:14:49', '2019-09-14 05:57:46'),
(2, 38, 37, 'Account-1', 1, 'Ab-3450', 'zxc', 3064, 3064, 1, '2019-06-30 11:54:53', '2019-09-17 07:24:06'),
(3, 38, 37, 'Janata bank Cash( Account-1 )', 2, NULL, '', 0, 0, 1, NULL, '2019-08-24 10:20:50'),
(4, 37, 36, ' Pubali Bank Cash( Account-1 )', 2, NULL, '', 0, 0, 1, NULL, '2019-09-02 12:53:48'),
(5, 0, 0, ' Cash', 3, NULL, '', 0, 0, 1, NULL, '2019-09-17 09:57:36'),
(6, 37, 36, 'Account-3', 1, '34590', 'Acount', 35000, 609732, 1, '2019-06-26 06:14:49', '2019-09-22 11:34:27'),
(7, 38, 37, 'Account-2', 1, 'Ab-3450', 'zxc', 6487, 6487, 1, '2019-06-30 11:54:53', '2019-09-06 06:57:12'),
(8, 38, 37, 'Janata bank Cash( Account-2 )', 2, NULL, '', 0, 0, 1, NULL, '2019-08-24 10:20:50'),
(9, 37, 36, ' Pubali Bank Cash( Account-3 )', 2, NULL, '', 1395, 10000, 1, NULL, '2019-09-22 11:34:27'),
(11, 38, 37, 'FDR-1', 1, 'FDR', 'FDR Acount', 163528853, 163528853, 1, NULL, NULL),
(12, 38, 37, 'FDR-2', 1, 'FDR', 'FDR Acount', 108166052, 108166052, 1, '2019-09-07 18:00:00', NULL),
(13, 40, 39, 'FDR-3', 1, 'FDR', 'FDR Acount', 2663750, 2663750, 1, '2019-06-26 06:14:49', '2019-09-03 05:15:20'),
(14, 38, 37, 'SOD-1', 1, 'SOD', 'SOD Acount', 147988905, 147988905, 1, NULL, '2019-09-17 07:52:51'),
(15, 38, 37, 'SOD-2', 1, 'SOD', 'SOD Acount', 79414208, 79414208, 1, '2019-09-07 18:00:00', '2019-09-17 06:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `bank_opn__blances`
--

CREATE TABLE `bank_opn__blances` (
  `open_bal_id` int(10) UNSIGNED NOT NULL,
  `bank_details_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `branch_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `bank_id`, `branch_name`, `status`, `created_at`, `updated_at`) VALUES
(36, 37, 'Moghbazar', 1, '2019-06-24 12:40:13', '2019-06-24 12:40:13'),
(37, 38, 'Banglamotor', 1, '2019-06-30 11:52:40', '2019-06-30 11:52:40'),
(39, 40, 'Agargaon', 1, '2019-09-07 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `bidget_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `upangsho_id` int(11) NOT NULL,
  `inout_id` int(11) NOT NULL,
  `khattype_id` int(11) DEFAULT NULL,
  `khtattypetype_id` int(11) NOT NULL DEFAULT '0',
  `khat_id` int(11) NOT NULL,
  `budget_amo` int(11) NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`bidget_id`, `user_id`, `upangsho_id`, `inout_id`, `khattype_id`, `khtattypetype_id`, `khat_id`, `budget_amo`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, 0, 187, 100000, '2018-19', 1, '2019-05-29 09:14:26', '2019-05-29 09:14:26'),
(2, 4, 1, 1, 1, 0, 188, 150000, '2018-19', 1, '2019-05-29 09:16:33', '2019-05-29 09:16:33'),
(3, 4, 1, 1, 1, 0, 189, 2500000, '2018-19', 1, '2019-05-29 09:25:51', '2019-05-30 07:27:11'),
(4, 4, 1, 1, 1, 0, 190, 2500000, '2018-19', 1, '2019-05-29 09:28:46', '2019-05-29 09:28:46'),
(5, 4, 1, 2, 6, 0, 241, 2500000, '2018-19', 1, '2019-05-30 07:28:15', '2019-05-30 07:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `budget_logs`
--

CREATE TABLE `budget_logs` (
  `bdgtlog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `khat_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `year` varchar(30) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `apprby` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_logs`
--

INSERT INTO `budget_logs` (`bdgtlog_id`, `user_id`, `budget_id`, `khat_id`, `status`, `year`, `amount`, `apprby`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 189, 1, '2018-19', '500000', 4, '2019-05-29 15:39:03', '2019-05-30 13:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prodct_id` int(11) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`id`, `cat_id`, `prodct_id`, `sub_cat`, `remark`, `qty`) VALUES
(1, 3, 7, 7, 'Mr Asad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 'Masters ', NULL, NULL),
(3, 'Bachelor ', NULL, NULL),
(4, 'Post Graduate Diploma ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `instutite_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `instutite_id`, `department_name`, `created_at`, `updated_at`) VALUES
(17, '1', 'test', '2019-10-09 05:29:42', '2019-10-09 05:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `depreciations`
--

CREATE TABLE `depreciations` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `depreciation` varchar(30) NOT NULL,
  `fdate` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depreciations`
--

INSERT INTO `depreciations` (`id`, `type_id`, `cost`, `depreciation`, `fdate`, `created_at`, `updated_at`) VALUES
(1, 37, '2674444', '860606', '2019-07-01', '2019-09-02 00:00:00', '2019-09-03 00:00:00'),
(3, 40, '2747595', '1734721', '2019-07-01', '2019-09-04 09:56:11', '2019-09-04 09:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `instutite_id` int(12) NOT NULL,
  `dep_id` int(10) UNSIGNED NOT NULL,
  `degin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `instutite_id`, `dep_id`, `degin_name`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 17, 'tets', NULL, '2019-10-09 05:30:56', '2019-10-09 05:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `std_id` int(10) NOT NULL,
  `degre` int(11) NOT NULL,
  `inst` varchar(255) NOT NULL,
  `board` varchar(255) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `passing_year` varchar(255) NOT NULL,
  `classdivision` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `std_id`, `degre`, `inst`, `board`, `groups`, `passing_year`, `classdivision`) VALUES
(1, 5, 0, 'West End High School', 'Dhaka', 'Business Studies', '2006', '3.88'),
(2, 6, 0, 'Holy Cross School', 'Dhaka', 'Science', '2012', '5.00'),
(3, 6, 0, 'Holy Cross School', 'Dhaka', 'Science', '2014', '5.00'),
(4, 6, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2019', '3.36'),
(5, 7, 0, 'Pirojpur Govt. Girls\' High School', 'Barishal', 'Science', '2012', '5.00'),
(6, 7, 0, 'Holy Cross College', 'Dhaka', 'Science', '2014', '5.00'),
(7, 7, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2019', '3.49'),
(8, 8, 0, 'Cantonment Public School & College, Parbatipur, Dinajpur', 'Dinajpur', 'Science', '2011', '5.00'),
(9, 8, 0, 'Cantonment Public School & College, Parbatipur, Dinajpur', 'Dinajpur', 'Science', '2013', '5.00'),
(10, 8, 0, 'Rajshahi University of Engineering & Tecnology (BUET)', 'RUET', 'URP', '2017', '3.53'),
(11, 9, 0, 'Cox\'s Bazar Pre-Cadet High School', 'Chittagong', 'Science', '2009', '5.00'),
(12, 9, 0, 'Cox\'s Bazar Govt. College', 'Chittagong', 'Science', '2011', '5.00'),
(13, 9, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2017', '2.90'),
(14, 10, 0, 'Ramgonj High School', 'Comilla', 'Science', '2009', '5.00'),
(15, 10, 0, 'Ramgonj Govt. College', 'Comilla', 'Science', '2011', '5.00'),
(16, 10, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2017', '3.01'),
(17, 11, 0, 'Ashugonj Tap Bidyut Kendra High School', 'Comilla', 'Science', '2010', '5.00'),
(18, 11, 0, 'Brahmanbaria Govt. College', 'Comilla', 'Science', '2012', '5.00'),
(19, 11, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2017', '3.72'),
(20, 12, 0, 'Chittagong Collegiate School', 'Chittagong', 'Science', '2007', '5.00'),
(21, 12, 0, 'Chittagong College', 'Chittagong', 'Science', '2009', '5.00'),
(22, 12, 0, 'Faculty of Civil Engineering', 'BUET', 'Civil Engineering', '2015', '3.22'),
(23, 12, 0, 'Department of Environmental Science', 'Jahangirnagar University', 'Env. Science & Management', '2019', '3.90'),
(24, 13, 0, 'Wills Little Flower School', 'Dhaka', 'Science', '2010', '5.00'),
(25, 13, 0, 'Birshreshta Noor Mohammad Pablic College', 'Dhaka', 'Science', '2012', '5.00'),
(26, 13, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2017', '2.85'),
(27, 14, 0, 'Dakhin Banasree Model High School', 'Dhaka', 'Business Studies', '2010', '3.71/5'),
(28, 14, 0, 'Dakhin Banasree Model High School', 'Dhaka', 'Business Studies', '2013', '4.13/5'),
(29, 14, 0, 'Dhaka Eastern College', 'Dhaka', 'Business Studies', '2015', '3.67/5'),
(30, 15, 0, 'Savar Cantonment public School', 'Dhaka', 'Business Studies', '2010', '3.86/5'),
(31, 15, 0, 'Savar Cantonment public School', 'Dhaka', 'Business Studies', '2013', '4.31/5'),
(32, 15, 0, 'Savar Cantonment public School & College', 'Dhaka', 'Business Studies', '2015', '4.25/5'),
(33, 16, 0, 'Tongirpar Hatila High School', 'Comilla', 'Science', '2013', 'GPA-5/5'),
(34, 17, 0, 'Mohammadpur Model School & College', 'Dhaka', 'Business Studies', '2013', 'GPA-4.44/5'),
(35, 17, 0, 'Mohammadpur Model School & College', 'Dhaka', 'Business Studies', '2015', 'GPA-4.33/5'),
(36, 18, 0, 'NAWAB HABIBULLAH ADARSHA HIGH SCHOOL', 'DHAKA', 'Business studies', '2013', 'GPA-4.81/5'),
(37, 18, 0, 'DHAKA COMMERCE COLLEGE', 'DHAKA', 'Business studies', '2015', 'GPA-4.33/5'),
(38, 19, 0, 'Monipur High School & College', 'DHAKA', 'Science', '2012', 'GPA-5./5'),
(39, 19, 0, 'Shaheed Bir Uttam lt Anwar Girls College', 'DHAKA', 'Science', '2014', 'GPA-4.90/5'),
(40, 1, 1, 'Economics Administrative', 'Middle East Technical University', 'Administrative Science', '2015', 'CGPA-3.35/4'),
(41, 1, 1, 'Rajshahi Cadet College', 'Rajshahi Board', 'Science', '2009', 'GPA-5/5'),
(42, 1, 1, 'Rajshahi Cadet College', 'Rajshahi Board', 'Science', '2009', 'GPA-5/5'),
(43, 20, 0, 'Viqarunnisa Noon School & College', 'DHAKA', 'Business studies', '2013', 'GPA-5./5'),
(44, 20, 0, 'Viqarunnisa Noon School & College', 'DHAKA', 'Business studies', '2015', 'GPA-4.17/5'),
(45, 21, 0, 'Khurushia Dwarikope ltigh School', 'Chittagong', 'Science', '2013', 'GPA-4.81/5'),
(46, 21, 0, 'Bandarban Govt Mohila College', 'Chittagong', 'Science', '2015', 'GPA-4.0/5'),
(47, 22, 0, 'Viqarunnisa Noon School & College', 'DHAKA', 'Science', '2013', 'GPA-5./5'),
(48, 22, 0, 'Viqarunnisa Noon School & College', 'DHAKA', 'Science', '2015', 'GPA-5./5'),
(49, 23, 0, 'Wills Little Flower High School', 'DHAKA', 'Science', '2013', 'GPA-5./5'),
(50, 23, 0, 'Dhaka City College', 'DHAKA', 'Science', '2015', 'GPA-5./5'),
(51, 24, 0, 'Khilgaon Govt High School', 'DHAKA', 'Science', '2010', 'GPA-4.0/5'),
(52, 24, 0, 'Khilgaon Govt High School', 'DHAKA', 'Science', '2013', 'GPA-4.31/5'),
(53, 24, 0, 'Rajapara Police line School & College', 'DHAKA', 'Science', '2015', 'GPA-4.17/5'),
(54, 25, 0, 'Badda Alatunnesa High School', 'DHAKA', 'Science', '2012', 'GPA-4.81/5'),
(55, 25, 0, 'B.N College', 'DHAKA', 'Science', '2014', 'GPA-5./5'),
(56, 26, 0, 'Municipal Model High School', 'Chittagong', 'Science', '2012', 'GPA-4.81/5'),
(57, 26, 0, 'Islamia Degree College', 'Chittagong', 'Science', '2014', 'GPA-3.30/5'),
(58, 27, 0, 'Sher-E- Bangla Nagar Govt Girls High School', 'DHAKA', 'Science', '2013', 'GPA-4.94/5'),
(59, 27, 0, 'Mohammadpur Preparatory College', 'DHAKA', 'Science', '2015', 'GPA-4.67/5'),
(60, 28, 0, 'Hatibandha SS High School', 'Dinajpur', 'Science', '2012', 'GPA-5./5'),
(61, 28, 0, 'Alimuddin College', 'Dinajpur', 'Humanitics', '2014', 'GPA-5./5'),
(62, 29, 0, 'Mrige High School (6555)', 'DHAKA', 'Science', '2012', 'GPA-4.13/5'),
(63, 29, 0, 'Pangsha College(6575)', 'DHAKA', 'Humanitics', '2015', 'GPA-3.80/5'),
(64, 30, 0, 'Bangkadesh Gas Fields School & Collage', 'Comilla', 'Science', '2014', 'GPA-4.75/5'),
(65, 30, 0, 'Bangkadesh Gas Fields School & Collage', 'Comilla', 'Science', '2016', 'GPA-4.83/5'),
(66, 31, 0, 'Dighulia Shahid Mizanur Rahman Hight School', 'Dhaka', 'Science', '2014', 'GPA - 4.74/5.00'),
(67, 31, 0, 'Dhaka Commerce College', 'Dhaka', 'Buiness Studies', '2016', 'GPA - 4.17/5.00'),
(68, 32, 0, 'Savar Cantonment Public School & College', 'DHAKA', 'Science', '2013', 'GPA-5.00/5.00'),
(69, 32, 0, 'Savar Cantonment Public School & College', 'DHAKA', 'Science', '2015', 'GPA-4.42/5.00'),
(70, 33, 0, 'Mohammadpur  preparatory School & College', 'DHAKA', 'Business studies', '2014', 'GPA-5.00/5.00'),
(71, 33, 0, 'Residential Model College', 'DHAKA', 'Business studies', '2016', 'GPA-4.33/5.00'),
(72, 34, 0, 'Bangldesh Gas Fields School Of College.', 'Comilla', 'Science', '2014', 'GPA - 5.00/5.00'),
(73, 34, 0, 'Bangldesh Gas Fields School Of College.', 'Comilla', 'Science', '2016', 'GPA - 4.17/5.00'),
(74, 35, 0, 'Chittagong Cantonment Public College', 'Chittagong', 'Business studies', '2014', 'GPA-4.75/5.00'),
(75, 35, 0, 'Chittagong Cantonment Public College', 'Chittagong', 'Business studies', '2016', 'GPA-4.58/5.00'),
(76, 36, 0, 'Comilla Modern High School', 'Comilla', 'Business studies', '2013', 'GPA-5.00/5.00'),
(77, 36, 0, 'Comilla Victoria Govt College', 'Comilla', 'Business studies', '2015', 'GPA-3.42/5.00'),
(78, 37, 0, 'Keshabpur Secondary School', 'Jessore', 'Science', '2014', 'GPA - 5.00/5.00'),
(79, 37, 0, 'Keshabpur College', 'Jessore', 'Science', '2016', 'GPA - 4.67/5.00'),
(80, 38, 0, 'Fulgazi Pilot Girls High School', 'Comilla', 'Science', '2014', 'GPA-4.75/5.00'),
(81, 38, 0, 'Govt. Zia Mohila College', 'Comilla', 'Business studies', '2016', 'GPA-3.58/5.00'),
(85, 40, 0, 'Kuti Girls High School', 'Comilla', 'Science', '2014', 'GPA-5.00/5.00'),
(86, 40, 0, 'Brahmanbaria Govt. College', 'Comilla', 'Science', '2016', 'GPA-4.00/5.00'),
(87, 41, 0, 'Savar Cantonment Board High School.', 'Dhaka', 'Buiness Studies', '2014', 'GPA - 4.56/5.00'),
(88, 41, 0, 'Dhaka Commerce College', 'Dhaka', 'Buiness Studies', '2016', 'GPA - 4.42/5.00'),
(89, 42, 0, 'Agrabad Govt. Colony High School', 'Chittagong', 'Science', '2014', 'GPA-4.88/5.00'),
(90, 42, 0, 'Chattagram Biggan College', 'Chittagong', 'Science', '2016', 'GPA-4.08/5.00'),
(91, 43, 0, 'Agargaon Taltola Govt.Colony High School', 'DHAKA', 'Science', '2013', 'GPA-4.81/5.00'),
(92, 43, 0, 'Sher-E- Bangla Nagar Govt Boys High School', 'DHAKA', 'Science', '2016', 'GPA-4.33/5.00'),
(93, 44, 0, 'Border Guard Publice Sccondary School Kusthia', 'Jessore', 'Business studies', '2013', 'GPA-5.00/5.00'),
(94, 44, 0, 'Queen,s School & College', 'DHAKA', 'Business studies', '2015', 'GPA-4.25/5.00'),
(95, 45, 0, 'Bakolia Govt. High School', 'Chittagong', 'Business studies', '2014', 'GPA-4.69/5.00'),
(96, 45, 0, 'Chittagong Govt. Collegiate School', 'Chittagong', 'Business studies', '2016', 'GPA-3.58/5.00'),
(97, 2, 1, 'Jahangirnagar University', 'Jahangirnagar University', 'History', '2006', 'Second Class'),
(98, 2, 1, 'Jahangirnagar University', 'Jahangirnagar University', 'History', '2005', 'Second Class'),
(99, 2, 1, 'Dasharia Degree College', 'Rajshahi Board', 'Humanities', '2000', '1st Divition'),
(100, 2, 1, 'S.M High School', 'Rajshahi Board', 'Humanities', '1998', '1st Divition'),
(101, 3, 4, 'wer', 'wer', 'wewer', 'wer', 'wer'),
(102, 46, 0, 'Khilgaon Govt.High School', 'DHAKA', 'Science', '2010', 'GPA-5.00/5.00'),
(103, 46, 0, 'Khilgaon Govt.High School', 'DHAKA', 'Science', '2013', 'GPA-5.00/5.00'),
(104, 46, 0, 'Dhaka City College', 'DHAKA', 'Science', '2015', 'GPA-5.00/5.00'),
(105, 47, 0, 'B.A.F Shaheen College', 'DHAKA', 'Business studies', '2012', 'GPA-5.00/5.00'),
(106, 47, 0, 'Adamjee Cantt. College', 'DHAKA', 'Business studies', '2014', 'GPA-4.67/5.00'),
(107, 48, 0, 'Homna Govt. High School', 'Comilla', 'Science', '2013', 'GPA-5.00/5.00'),
(108, 48, 0, 'Dhaka College', 'DHAKA', 'Science', '2015', 'GPA-5.00/5.00'),
(109, 49, 0, 'BCIC College', 'Dhaka', 'Science', '2010', '5.00'),
(110, 49, 0, 'BCIC College', 'Dhaka', 'Science', '2012', '5.00'),
(111, 49, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2018', '2.63'),
(112, 50, 0, 'Kakali High School', 'DHAKA', 'Science', '2011', 'GPA-4.21/5.00'),
(113, 50, 0, 'Kakali High School', 'DHAKA', 'Science', '2014', 'GPA-4.88/5.00'),
(114, 50, 0, 'Mohammadpur  Model School & College', 'DHAKA', 'Science', '2016', 'GPA-4.17/5.00'),
(115, 51, 0, 'Sher-E- Bangla  High School', 'DHAKA', 'Science', '2014', 'GPA-4.00/5.00'),
(116, 51, 0, 'Rajarbag Police Line School & College', 'DHAKA', 'Humanitics', '2016', 'GPA-3.67/5.00'),
(117, 52, 0, 'Jessore Zilla School', 'Jessore', 'Science', '2011', '5.00'),
(118, 52, 0, 'Govt. M. M. College', 'Jessore', 'Science', '2013', '5.00'),
(119, 52, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2018', '3.78'),
(120, 53, 0, 'S.M Model Govt. High School,Gopalganj', 'DHAKA', 'Science', '2015', 'GPA-5.00/5.00'),
(121, 53, 0, 'Govt. Bongobandhu University College,Gopalgonj', 'DHAKA', 'Science', '2017', 'GPA-4.58/5.00'),
(122, 54, 0, 'Rangpur CAdet College', 'Dinajpur', 'Science', '2015', 'GPA-5.00/5.00'),
(123, 54, 0, 'Notre Dame College, Dhaka', 'DHAKA', 'Science', '2017', 'GPA-4.75/5.00'),
(124, 55, 0, 'Rangpur Zilla School', 'Dinajpur', 'Science', '2010', 'GPA-3.63/5.00'),
(125, 55, 0, 'Rangpur Govt. College', 'Dinajpur', 'Humanitics', '2016', 'GPA-4.00/5.00'),
(126, 56, 0, 'Uttara High School', 'Dhaka', 'Science', '2012', '5.00'),
(127, 56, 0, 'Holy Cross College', 'Dhaka', 'Science', '2014', '5.00'),
(128, 56, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2019', '3.79'),
(129, 57, 0, 'Wills Little Flower High School', 'DHAKA', 'Business studies', '2014', 'GPA-4.50/5.00'),
(130, 57, 0, 'Wills Little Flower Uchcha Madyamic Bidyaloya', 'DHAKA', 'Business studies', '2017', 'GPA-4.80/5.00'),
(131, 58, 0, 'Sos Hermann Gmeiner School Khulna', 'Jessore', 'Science', '2015', 'GPA-4.72/5.00'),
(132, 58, 0, 'Govt. Sundarban Adarsha College', 'Jessore', 'Science', '2017', 'GPA-3.83/5'),
(133, 59, 0, 'Govt. P.N. Girls\' High School, Rajshahi', 'Rajshahi Board', 'Science', '2010', '5.00'),
(134, 59, 0, 'Rajshahi College', 'Rajshahi Board', 'Science', '2012', '5.00'),
(135, 59, 0, 'Bangladesh University of Engineering & Tecnology (BUET)', 'BUET', 'URP', '2017', '3.73'),
(136, 4, 1, 'A C Law Pilot high School', 'Jessore Board', 'Science', '1992', '1st Divition'),
(137, 4, 1, 'Govt. Suhrawardi College Pirojpur', 'Jessore Board', 'Science', '1994', '2nd Divition'),
(138, 4, 1, 'Dhaka College', 'National University', 'Social Science', '1997', '2nd Divition'),
(139, 4, 1, 'International Islamic University Chittagong', 'International Islamic University Chittagong', 'Business Administration', '2005', 'CGPA:3.25/4'),
(140, 60, 0, 'Nabinagar Ichchhamoyee Pilot Girls High School', 'Comilla', 'Science', '2015', 'GPA-4.44/5.00'),
(141, 60, 0, 'Holy Cross College', 'DHAKA', 'Business studies', '2017', 'GPA-4.83/5.00'),
(142, 61, 0, 'Cambrian School And College', 'DHAKA', 'Science', '2012', 'GPA-5.00/5.00'),
(143, 61, 0, 'Cambrian School And College', 'DHAKA', 'Science', '2015', 'GPA-5.00/5.00'),
(144, 61, 0, 'Cambrian School And College', 'DHAKA', 'Science', '2017', 'GPA-5.00/5.00'),
(145, 62, 0, 'Keshabpur Secondary School', 'Jessore', 'Science', '2015', 'GPA-4.94/5.00'),
(146, 62, 0, 'Tejgaon College', 'DHAKA', 'Science', '2017', 'GPA-3.92/5.00'),
(147, 63, 0, 'Feni Govt. Girls School', 'Comilla', 'Business studies', '2014', 'GPA-4.81/5.00'),
(148, 63, 0, 'Birsreshtha Noor Mohammad Rifles Public College', 'DHAKA', 'Business studies', '2016', 'GPA-4.58/5.00'),
(149, 64, 0, 'College Of Development Alternative', 'DHAKA', 'Business studies', '2015', 'GPA-3.67/5.00'),
(150, 64, 0, 'College Of Development Alternative', 'DHAKA', 'Business studies', '2017', 'GPA-3.67/5.00'),
(151, 65, 0, 'Adarsha Biddyanikafon', 'DHAKA', 'Science', '2014', 'GPA-4.50/5.00'),
(152, 65, 0, 'Dhaka Canttonment Girls Public School & College', 'DHAKA', 'Science', '2016', 'GPA-4.50/5.00'),
(153, 66, 0, 'Dhakhin Bishivra High School', 'DHAKA', 'Science', '2014', 'GPA-4.94/5.00'),
(154, 66, 0, 'Gobt. Netrokona College', 'DHAKA', 'Science', '2016', 'GPA-4.17/5.00'),
(155, 67, 0, 'Bogra Zilla School', 'Rajshahi', 'Science', '2014', 'GPA-5.00/5.00'),
(156, 67, 0, 'Govt. Azizul Haque College Bogra', 'Rajshahi', 'Science', '2016', 'GPA-5.00/5.00'),
(157, 68, 0, 'asd', 'sdsadsa', 'asd', 'asda', 'dsad'),
(158, 69, 0, 'asd', 'asds', 'asds', 'dasd', 'asd'),
(159, 70, 0, 's', 's', 's', 's', 's'),
(160, 71, 0, 'a', 'a', 'a', 'a', 'a'),
(161, 1, 0, 's', 's', 's', '34', '43'),
(162, 2, 0, 'd', 'd', 'd', 'd', 'd'),
(163, 3, 0, 'ss', 's', 's', 's', 's'),
(164, 4, 0, 's', 's', 's', 's', 's');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol_id` int(11) NOT NULL,
  `add_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date_birth` date NOT NULL,
  `dep_id` int(11) NOT NULL,
  `dig_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_user_id` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `emp_type` int(11) NOT NULL,
  `gross_salary` int(11) DEFAULT NULL,
  `reporting_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` date NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `add_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emrgemcy_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `hrent` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `medcal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `convence` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `allownce` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lninstall` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `incometax` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sign_upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointed_date` date NOT NULL,
  `probition_date` date DEFAULT NULL,
  `probition_confor_date` date DEFAULT NULL,
  `permenet_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_religin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abs_duduct_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `rol_id`, `add_full_name`, `emp_id`, `date_birth`, `dep_id`, `dig_id`, `user_id`, `login_user_id`, `update_user_id`, `emp_type`, `gross_salary`, `reporting_to`, `joining_date`, `marital_status`, `add_mobile`, `father_name`, `mother_name`, `emrgemcy_contact`, `gender`, `hrent`, `medcal`, `convence`, `allownce`, `lninstall`, `incometax`, `sign_upload`, `appointed_date`, `probition_date`, `probition_confor_date`, `permenet_address`, `present_address`, `add_email`, `add_religin`, `photo_upload`, `cv_upload`, `account_no`, `repay`, `abs_duduct_amount`, `created_at`, `updated_at`) VALUES
(2, 2, 'A.T.M Muntasir Hasan', 120013010, '1970-01-01', 10, 2, 24, 0, NULL, 1, NULL, 'Head of Admin', '2012-12-12', 1, '0181247076', 'Md. Shahid Hasan', 'Most.Rekha Hasan', '0181247076', 1, '0', '0', '0', '0', '0', '0', 'Muntasir-Signature.jpg', '0012-12-12', NULL, NULL, 'Dhaka', 'Vill:Ghuakhola Post:Noapara P.S:Abhoynagar,District:Jessor', 'muntasir.hasan@dsce.edu.bd', '1', 'Muntasir-Photo.jpg', 'Muntasir-CV.pdf', NULL, NULL, NULL, '2019-09-08 10:34:41', '2019-09-22 07:40:53'),
(3, 2, 'Shahinoor Khanam', 120014009, '2005-01-01', 11, 3, 25, 0, NULL, 1, NULL, 'Head of Admin', '2012-03-15', 0, '01712864284', 'Md. Nurul Islam', 'Jahanara Begum', '01712864284', 0, '0', '0', '0', '0', '0', '0', 'Shahinoor Khanam-Signature.jpg', '2012-03-15', NULL, NULL, 'Maya Medical Store, Boro Bazar, Meherpur. P.S: Meherpur, Dist: Meherpur', 'Dhaka', 'shahinoor.khanam@dsce.edu.bd', '1', 'Shahinoor Khanam-Photo.jpg', 'Shahinoor Khanam-CV.pdf', NULL, NULL, NULL, '2019-09-08 10:35:15', '2019-09-22 08:31:55'),
(4, 2, 'Muhammad Selim', 100011004, '1970-01-01', 12, 4, 27, 0, NULL, 1, NULL, 'Director', '2010-11-14', 0, '01672944004', 'Motahar Uddin Ahmed', 'Nurunnahar Begum', '01672944004Mo', 1, '0', '0', '0', '0', '0', '0', 'Signature.jpg', '2010-11-14', NULL, NULL, 'C/o Prof. Mahatab Uddin Ahmed, Abdul Hamid Akhand Road, Madaripur.', '80,80/B Indira Road, Dhaka-1205', 'dsce.bd@gmail.com', '1', 'Photo.jpg', 'Muhammad Selim-CV.pdf', NULL, NULL, NULL, '2019-09-09 07:51:12', '2019-09-22 07:38:43'),
(5, 2, 'syeeda Sultana Asha', 100011011, '1970-01-01', 12, 5, 32, 0, NULL, 1, 1, 'Head of Admin', '2010-10-18', 0, '01778411476', 'Md. Sabed Ali', 'Ms. Suriya Sultana', '8116972', 0, '2', '22', '233', '334', '555', '444', 'Signature.jpg', '2010-10-18', NULL, NULL, 'Village#Gafuriabad, Post#Sanirdear. P.S. Pabna, District#Pabna.', 'C/o Md. Sabed Ali. Admin Officer. HUman Development Research Centre (HDRC).H#5, Rd#8, Mohammadia Housing Society.', 'sultana.asha@dscebd.org', '1', 'Photo.jpg', 'Syeeda Sultana Asha-CV.pdf', NULL, NULL, NULL, '2019-09-11 04:03:27', '2019-09-22 07:36:03'),
(6, 2, 'Mahbuba Momen Chowdhury', 130011012, '1970-01-01', 13, 6, 33, 0, NULL, 1, NULL, 'Head of Admin', '2013-03-12', 1, '01731270349', 'Dr. Abdul Momen Khan Chowdhury', 'Rebeca Banu', '01552312130', 0, '0', '0', '0', '0', '0', '0', 'Signature.jpg', '2013-03-12', NULL, NULL, 'Vil#Godaghata, Mallickpara, P.O#Agardari, Thana#Sathkhira, Dist#Sathkhira.', '49, Green Road, Flat#A5, Dhaka-1205.', 'mahbuba.chowdhury@dsce.edu.bd', '1', 'Photo.jpg', 'Mahbuba Momen Chowdhury-CV.pdf', NULL, NULL, NULL, '2019-09-11 04:43:53', '2019-09-22 07:39:29'),
(14, 2, 'asd', 71894, '1970-01-01', 12, 12, 102, 0, NULL, 0, NULL, 'wer', '2019-09-02', 0, '21332434', '234324', '234324', '23432', 0, '0', '0', '0', '0', '0', '0', 'Dhaka_School_of_Economics.jpg', '2019-09-23', NULL, NULL, 'qwewe', 'qwe', 'qwewqewewe@gmail.com', '1', 'Dhaka_School_of_Economics.jpg', 'Application.pdf', NULL, NULL, NULL, '2019-09-23 04:07:49', '2019-09-23 04:07:49'),
(17, 2, 'a', 38784, '2019-10-07', 17, 3, 118, 0, NULL, 1, NULL, 'a', '2019-10-07', 0, 'a', 'a', 'a', 'a', 0, '0', '0', '0', '0', '0', '0', 'photo_5d9dc52b78efaLHF5K6sYEc.jpg', '2019-09-30', NULL, NULL, 'a', 'a', 'a@gmail.com', '1', 'photo_5d9dc52b7df52c5yTz082MP.jpg', 'photo_5d9dc52b7e672M4tCsnAKWM.png', NULL, NULL, NULL, '2019-10-09 05:31:55', '2019-10-09 05:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `id` int(11) NOT NULL,
  `inco_cat` int(11) NOT NULL,
  `inco_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `leave_type` varchar(255) NOT NULL,
  `not_pay_from_date` date DEFAULT NULL,
  `not_pay` int(11) DEFAULT NULL,
  `not_pay_to_date` date DEFAULT NULL,
  `pay` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '1' COMMENT '1 for not approve ,2 appoved',
  `abs_duduct_amount` varchar(255) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`id`, `inco_cat`, `inco_type`, `user_id`, `update_user_id`, `employee_id`, `from_date`, `to_date`, `leave_type`, `not_pay_from_date`, `not_pay`, `not_pay_to_date`, `pay`, `reason`, `status`, `abs_duduct_amount`, `date`) VALUES
(9, 6, 7, 5, NULL, 13, '2019-09-22', '2019-09-24', 'Advancedleave', '2019-09-25', 2, '2019-09-27', 1, 'leave with 4 days ,3 days', 1, NULL, '2019-09-24'),
(10, 6, 7, 5, NULL, 13, '2019-09-16', '2019-09-17', 'Special', '2019-09-18', 2, '2019-09-19', 1, 'this remark for lalmoti', 1, NULL, '2019-09-24');

-- --------------------------------------------------------

--
-- Table structure for table `employeloans`
--

CREATE TABLE `employeloans` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `desig_id` int(11) NOT NULL,
  `employ_id` int(11) NOT NULL,
  `loan_type` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `mon_inst` varchar(255) NOT NULL,
  `bankact` int(11) NOT NULL,
  `loan_repay` varchar(255) DEFAULT NULL,
  `loan_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `depriciation` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `category`, `type`, `depriciation`, `created_at`, `updated_at`) VALUES
(1, 1, 'Salary & Allowances ( Faculty + Admin)', NULL, '2019-08-31', '2019-08-31 04:55:20'),
(2, 1, 'Salary & Allowances( Guest )', NULL, '2019-08-31', '2019-08-31 04:56:01'),
(3, 2, 'Office Rent', NULL, '2019-08-31', '2019-08-31 04:57:04'),
(4, 2, 'Telephone', NULL, '2019-08-31', '2019-08-31 04:57:22'),
(5, 2, 'Consumable Store / Stationary', NULL, '2019-08-31', '2019-08-31 04:57:45'),
(6, 2, 'Entertainment', NULL, '2019-08-31', '2019-08-31 04:58:04'),
(7, 2, 'Internet & Website', NULL, '2019-08-31', '2019-08-31 04:58:20'),
(8, 2, 'Bank Charges', NULL, '2019-08-31', '2019-08-31 04:58:36'),
(9, 2, 'Postage & Courier', NULL, '2019-08-31', '2019-08-31 04:59:04'),
(10, 2, 'Micellaneous', NULL, '2019-08-31', '2019-08-31 05:00:05'),
(11, 2, 'Periodicals purches', NULL, '2019-08-31', '2019-08-31 05:00:40'),
(12, 3, 'Exam Exense', NULL, '2019-08-31', '2019-08-31 05:01:58'),
(13, 3, 'Registration Fee', NULL, '2019-08-31', '2019-08-31 05:02:08'),
(14, 3, 'Advertisement', NULL, '2019-08-31', '2019-08-31 05:02:24'),
(15, 3, 'Admission Expenses', NULL, '2019-08-31', '2019-08-31 05:02:46'),
(16, 3, 'Caution Money', NULL, '2019-08-31', '2019-08-31 05:03:05'),
(17, 4, 'Repairs & Maintenance (Computer & Office equipment', NULL, '2019-08-31', '2019-08-31 05:20:21'),
(18, 4, 'Repairs & Maintenance (machinery & equipment)', NULL, '2019-08-31', '2019-08-31 05:21:10'),
(19, 4, 'Repairs & Maintenance  (motor vehicle)', NULL, '2019-08-31', '2019-08-31 05:21:31'),
(20, 4, 'Repairs & Maintenance  (others)', NULL, '2019-08-31', '2019-08-31 05:21:48'),
(21, 5, 'Printing & binding', NULL, '2019-08-31', '2019-08-31 05:24:04'),
(22, 5, 'Publication', NULL, '2019-08-31', '2019-08-31 05:24:15'),
(23, 6, 'Water bill', NULL, '2019-08-31', '2019-08-31 05:25:00'),
(24, 6, 'Petrol & Lubricant', NULL, '2019-08-31', '2019-08-31 05:25:16'),
(25, 6, 'Electric bill', NULL, '2019-08-31', '2019-08-31 05:25:29'),
(26, 7, 'Training seminar & conference', NULL, '2019-08-31', '2019-08-31 07:00:18'),
(27, 8, 'Depreciation', NULL, '2019-08-31', '2019-08-31 07:01:26'),
(28, 9, 'Interest on loan for land purchase', NULL, '2019-08-31', '2019-08-31 07:02:17'),
(29, 10, 'Audit Fee', NULL, '2019-08-31', '2019-08-31 07:02:34'),
(30, 11, 'Research', NULL, '2019-08-31', '2019-08-31 07:02:58'),
(31, 12, 'Tax Deducted at Source (TDS)', NULL, '2019-08-31', '2019-08-31 07:03:38'),
(32, 13, 'Other taxes', NULL, '2019-08-31', '2019-08-31 07:03:55'),
(33, 14, 'Conveyance & Travelling', NULL, '2019-08-31', '2019-08-31 07:04:39'),
(34, 1, 'Honarium', NULL, '2019-08-31', '2019-08-31 04:55:20'),
(35, 2, 'Stationary', NULL, '2019-09-01', '2019-09-01 07:26:28'),
(37, 15, 'Furniture', '10', '2019-09-03', '2019-09-03 05:10:12'),
(40, 15, 'Electronic Equipments', '20', '2019-09-04', '2019-09-04 03:56:11'),
(41, 1, 'Festival Allowances', NULL, '2019-09-08', '2019-09-08 10:37:48'),
(42, 1, 'Provident Fund', NULL, '2019-09-08', '2019-09-08 10:39:13'),
(43, 17, 'Loan Adjusted', NULL, '2019-09-17', '2019-09-17 06:15:38'),
(44, 18, 'Software Expenses', NULL, '2019-09-17', '2019-09-17 07:51:14'),
(45, 2, 'Conveyance', NULL, '2019-09-22', '2019-09-22 11:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `experince`
--

CREATE TABLE `experince` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `degree_id` int(11) DEFAULT NULL,
  `empl_feild` varchar(255) NOT NULL,
  `org_add` varchar(255) NOT NULL,
  `res` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experince`
--

INSERT INTO `experince` (`id`, `std_id`, `degree_id`, `empl_feild`, `org_add`, `res`, `start_date`, `end_date`) VALUES
(1, 6, 0, 'Research Assistant', 'Disester Management Watch', 'Research', '2019-01-07', NULL),
(2, 8, 0, 'Research Assistant', 'Disester Management Watch', 'Plan research study', '2019-05-05', '2019-03-11'),
(3, 9, 0, 'Urban Plnner', 'Design Development Consultant', 'Preparation of DAP project', '2018-08-05', NULL),
(4, 11, 0, 'Junior Urban Planner', 'Development Design Consultant Ltd.', 'Detailed Area Planing Preparation Dhaka', '2018-08-04', NULL),
(5, 12, 0, 'Assistant Enquiree', 'DODC', 'Distribution Planning', '2016-12-15', NULL),
(6, 1, 1, 'Product Executive ', 'ACI Formulations', 'Planning and implementing Product and Branding strategices', '2017-11-22', NULL),
(7, 1, 1, '', 'RFL', 'Planning and implementing Product and Branding strategices', '2017-01-02', '2017-01-02'),
(10, 56, NULL, 'Internship', 'Development Design Consultant Ltd.', 'Master Plan Preparation', '2019-05-12', '2019-05-30'),
(11, 59, NULL, 'Research Assistant', 'Forum for Physical Development of Bangladesh', 'Research, Publication, Organizar, Monitor', '2017-09-02', NULL),
(12, 4, 1, 'Sales and Marketing in Paints Industry', 'ACI Group', 'Sales Manager', '2016-09-01', NULL),
(13, 4, 1, 'Sales and Marketing in Paints Industry', 'Asian Paints Bangladesh Ltd.', 'Regional Manager', '2002-02-02', '2016-08-31'),
(14, 4, 1, 'Consumer Products', 'Aci Limited', 'Sales Officer', '2000-01-01', '1987-01-31'),
(15, 68, NULL, 'asd', 'sadasd', 'sadsa', '2019-09-24', '2019-10-01'),
(16, 69, NULL, 'asdsa', 'dsadsa', 'dasds', '2019-09-16', '2019-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `incoexpenses`
--

CREATE TABLE `incoexpenses` (
  `incoexpenses_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `upangsho_id` int(11) NOT NULL,
  `inout_id` int(11) NOT NULL,
  `khattype_id` int(11) NOT NULL,
  `khtattypetype_id` int(11) DEFAULT '0',
  `khat_id` int(11) NOT NULL,
  `khat_des` text CHARACTER SET utf8,
  `year` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `acc_no` varchar(256) NOT NULL,
  `vourcher_no` varchar(255) NOT NULL,
  `chalan_no` varchar(200) NOT NULL,
  `check_no` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(256) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `vat_tax_status` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `receiver_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `receive_datwe` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `pay_type` int(11) NOT NULL,
  `inco_cat` int(11) NOT NULL,
  `inco_type` int(11) NOT NULL,
  `vcher` int(11) NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `paydate` date NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `bank_id`, `branch_id`, `accountid`, `pay_type`, `inco_cat`, `inco_type`, `vcher`, `amount`, `note`, `paydate`, `date`, `created_at`, `updated_at`) VALUES
(1, 37, 36, 9, 4, 0, 0, 0, 8605, 'Impreset Money', '2019-07-02', '2019-09-22', '2019-09-22 10:29:27', '2019-09-22 10:29:27'),
(2, 37, 36, 6, 1, 3, 2, 1, 58200, 'Students Collection-', '2019-07-02', '2019-09-22', '2019-09-22 10:51:33', '2019-09-22 10:51:33'),
(3, 37, 36, 6, 1, 3, 2, 2, 122400, 'Students Collection', '2019-07-02', '2019-09-22', '2019-09-22 11:32:36', '2019-09-22 11:32:36'),
(4, 37, 36, 6, 1, 3, 2, 3, 14550, 'Students Collection', '2019-07-02', '2019-09-22', '2019-09-22 11:34:01', '2019-09-22 11:34:01'),
(5, 37, 36, 6, 1, 3, 2, 4, 168300, 'Students Collection', '2019-07-07', '2019-09-22', '2019-09-22 11:37:13', '2019-09-22 11:37:13'),
(6, 37, 36, 6, 1, 3, 2, 5, 87300, 'Students Collection', '2019-07-07', '2019-09-22', '2019-09-22 11:38:04', '2019-09-22 11:38:04'),
(7, 37, 36, 6, 1, 3, 2, 6, 145500, 'Students Collection', '2019-07-07', '2019-09-22', '2019-09-22 11:39:07', '2019-09-22 11:39:07'),
(8, 37, 36, 6, 1, 3, 2, 7, 29100, 'Students Collection', '2019-07-08', '2019-09-22', '2019-09-22 11:40:09', '2019-09-22 11:40:09'),
(9, 37, 36, 6, 1, 3, 2, 8, 30600, 'Students Collection', '2019-07-08', '2019-09-22', '2019-09-22 11:41:39', '2019-09-22 11:41:39'),
(10, 37, 36, 6, 1, 3, 2, 9, 29100, 'Students Collection', '2019-07-08', '2019-09-22', '2019-09-22 11:43:38', '2019-09-22 11:43:38'),
(11, 37, 36, 6, 1, 3, 2, 10, 15300, 'Students Collection', '2019-07-09', '2019-09-22', '2019-09-22 11:45:00', '2019-09-22 11:45:00'),
(12, 37, 36, 6, 1, 3, 2, 11, 14550, 'Students Collection', '2019-07-09', '2019-09-22', '2019-09-22 11:47:05', '2019-09-22 11:47:05'),
(13, 37, 36, 6, 1, 3, 2, 12, 29100, 'Students Collection', '2019-07-15', '2019-09-22', '2019-09-22 11:48:18', '2019-09-22 11:48:18'),
(16, 37, 36, 6, 1, 3, 2, 13, 14550, 'Students Collection', '2019-07-15', '2019-09-22', '2019-09-22 12:04:33', '2019-09-22 12:04:33'),
(17, 37, 36, 6, 1, 4, 4, 14, 1100, 'Others Income', '2019-07-16', '2019-09-22', '2019-09-22 13:04:10', '2019-09-22 13:04:10'),
(18, 37, 36, 9, 4, 0, 0, 0, 5429, 'Cash for Telephone Bill', '2019-07-14', '2019-09-22', '2019-09-22 13:11:57', '2019-09-22 13:11:57'),
(19, 37, 36, 9, 4, 0, 0, 0, 9070, 'Impreset Money', '2019-07-16', '2019-09-22', '2019-09-22 17:34:27', '2019-09-22 17:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `income_cats`
--

CREATE TABLE `income_cats` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `note` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_cats`
--

INSERT INTO `income_cats` (`id`, `category`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Grant from Ministry of Education', '10.01', '2019-09-01', '2019-09-01 07:21:16'),
(2, 'Interest income', '14.0', '2019-09-01', '2019-09-01 07:21:16'),
(3, 'Transfer from Student Collection', '15.0', '2019-09-01', '2019-09-01 07:24:03'),
(4, 'Other Income', '', '2019-09-01', '2019-09-01 07:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `income_types`
--

CREATE TABLE `income_types` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `note` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_types`
--

INSERT INTO `income_types` (`id`, `category`, `type`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Grant from Ministry of Education', '10.01', '2019-09-01', '2019-09-01 07:23:39'),
(2, 3, 'Student Collection', '14.0', '2019-09-01', '2019-09-01 07:27:22'),
(3, 3, 'Admission Form Sale', '14.0', '2019-09-01', '2019-09-01 07:30:18'),
(4, 4, 'Other Income', NULL, '2019-09-02', '2019-09-02 10:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `indirect_expenses`
--

CREATE TABLE `indirect_expenses` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `pay_type` int(11) NOT NULL,
  `exp_cat` int(11) NOT NULL,
  `exp_type` int(11) NOT NULL,
  `voucher` int(11) NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `paydate` date NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indirect_expenses`
--

INSERT INTO `indirect_expenses` (`id`, `bank_id`, `branch_id`, `accountid`, `pay_type`, `exp_cat`, `exp_type`, `voucher`, `amount`, `note`, `paydate`, `date`, `created_at`, `updated_at`) VALUES
(1, 37, 36, 6, 4, 0, 0, 1, 8605, 'Impreset Money', '2019-07-02', '2019-09-22', '2019-09-22 10:29:27', '2019-09-22 10:29:27'),
(2, 37, 36, 6, 1, 13, 32, 2, 5802, 'Others Tax', '2019-07-07', '2019-09-22', '2019-09-22 11:35:22', '2019-09-22 11:35:22'),
(3, 37, 36, 6, 1, 3, 12, 3, 139512, 'Exam Expenses', '2019-07-08', '2019-09-22', '2019-09-22 13:07:00', '2019-09-22 13:07:00'),
(4, 37, 36, 6, 1, 2, 7, 4, 14500, 'Internet Bill', '2019-07-14', '2019-09-22', '2019-09-22 13:08:35', '2019-09-22 13:08:35'),
(5, 37, 36, 6, 4, 0, 0, 5, 5429, 'Cash for Telephone Bill', '2019-07-14', '2019-09-22', '2019-09-22 13:11:57', '2019-09-22 13:11:57'),
(6, 37, 36, 9, 2, 2, 4, 6, 5429, 'Telephone bill', '2019-07-14', '2019-09-22', '2019-09-22 13:17:17', '2019-09-22 13:17:17'),
(7, 37, 36, 6, 1, 1, 34, 7, 2000, 'Honorarium', '2019-07-14', '2019-09-22', '2019-09-22 14:13:43', '2019-09-22 14:13:43'),
(8, 37, 36, 9, 2, 2, 9, 8, 1010, 'Curier & Postage', '2019-07-16', '2019-09-22', '2019-09-22 17:08:43', '2019-09-22 17:08:43'),
(9, 37, 36, 9, 2, 2, 45, 9, 1030, 'Conveyance', '2019-07-16', '2019-09-22', '2019-09-22 17:30:15', '2019-09-22 17:30:15'),
(10, 37, 36, 9, 2, 5, 21, 10, 120, 'Printing & Binding', '2019-07-16', '2019-09-22', '2019-09-22 17:31:16', '2019-09-22 17:31:16'),
(11, 37, 36, 9, 2, 2, 10, 11, 1700, 'Miscellaneous Expenses', '2019-07-16', '2019-09-22', '2019-09-22 17:32:15', '2019-09-22 17:32:15'),
(12, 37, 36, 9, 2, 2, 6, 12, 5210, 'Entertainment', '2019-07-16', '2019-09-22', '2019-09-22 17:32:57', '2019-09-22 17:32:57'),
(13, 37, 36, 6, 4, 0, 0, 8, 9070, 'Impreset Money', '2019-07-16', '2019-09-22', '2019-09-22 17:34:27', '2019-09-22 17:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `indirect_expense_types`
--

CREATE TABLE `indirect_expense_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `note` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indirect_expense_types`
--

INSERT INTO `indirect_expense_types` (`id`, `type`, `note`, `created_at`) VALUES
(1, 'Salary & Allowances', '16.0', '2019-08-31'),
(2, 'Office Expense\'s', '17.0', '2019-08-31'),
(3, 'Exam & Registration Expense\'s', '18.0', '2019-08-31'),
(4, 'Repairs & Maintenance Expense\'s', '19.0', '2019-08-31'),
(5, 'Printing & binding', '20.0', '2019-08-31'),
(6, 'Utility', '21.0', '2019-08-31'),
(7, 'Training seminar & conference', NULL, '2019-08-31'),
(8, 'Depreciation', NULL, '2019-08-31'),
(9, 'Interest on loan for land purchase', NULL, '2019-08-31'),
(10, 'Audit Fee', NULL, '2019-08-31'),
(11, 'Research', NULL, '2019-08-31'),
(12, 'Tax Deducted at Source (TDS)', NULL, '2019-08-31'),
(13, 'Other taxes', NULL, '2019-08-31'),
(14, 'Conveyance & Travelling', NULL, '2019-08-31'),
(15, 'Property Plant & Equipment', '4.0', '2019-09-03'),
(16, 'Grant from ministry of Education', NULL, '2019-09-17'),
(17, 'Grant from ministry of Education', NULL, '2019-09-17'),
(18, 'Liabilities', NULL, '2019-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(11) NOT NULL,
  `institute_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `inco_cat` int(11) NOT NULL,
  `inco_type` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_qty` varchar(255) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `bankact` int(11) DEFAULT NULL,
  `purchase_cost` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `sup_id`, `update_user_id`, `user_id`, `inco_cat`, `inco_type`, `cat_id`, `sub_cat`, `doc_name`, `product_name`, `quantity`, `total_qty`, `branch_id`, `bankact`, `purchase_cost`, `purchase_date`) VALUES
(12, 2, NULL, NULL, 0, 0, 4, 8, 'alamin.jpg', 'alamin product with image', 18, '', NULL, NULL, '12000', '2019-12-31'),
(13, 1, NULL, NULL, 0, 0, 1, 1, '6-Item-Brand.jpg', 'alamin assit less', 20, '', NULL, NULL, '1200', '2019-09-17'),
(14, 1, NULL, NULL, 0, 0, 2, 6, 'Logo.png', 'sdfd', 23, '23', NULL, NULL, '1244', '2019-09-03'),
(15, 1, NULL, 5, 9, 10, 2, 3, '6-Item-Brand.jpg', '120', 120, '120', NULL, NULL, '120', '2019-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `inventorycatagories`
--

CREATE TABLE `inventorycatagories` (
  `id` int(11) NOT NULL,
  `catgeory_name` varchar(255) NOT NULL,
  `depricit` varchar(30) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorycatagories`
--

INSERT INTO `inventorycatagories` (`id`, `catgeory_name`, `depricit`, `status`) VALUES
(1, 'Non- Current Assets', '10', 1),
(2, 'Current Assets', '15', 1),
(3, 'Assosories', '0', 1),
(4, 'alamin category', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventorysucategories`
--

CREATE TABLE `inventorysucategories` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cate_name` varchar(255) NOT NULL,
  `note` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorysucategories`
--

INSERT INTO `inventorysucategories` (`id`, `cat_id`, `sub_cate_name`, `note`) VALUES
(1, 1, 'Property, Plant & Equipment', '4.0'),
(2, 1, 'Intangible Assets', '5.0'),
(3, 2, 'Advance, Deposits and Prepayments', '6.0'),
(4, 2, 'Fixed Deposit Receipt', '7.0'),
(5, 2, 'Cash and cash Equivalent', '8.0'),
(6, 2, 'Advance income tax', '9.0'),
(7, 3, 'Stationary', '0.0'),
(8, 4, 'alamin sub category', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khats`
--

CREATE TABLE `khats` (
  `khat_id` int(10) UNSIGNED NOT NULL,
  `khattype` int(11) NOT NULL,
  `upangsho_id` int(11) NOT NULL,
  `tax_type_id` int(11) DEFAULT NULL,
  `tax_type_type_id` int(11) DEFAULT '0',
  `serilas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khat_name` varchar(191) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khats`
--

INSERT INTO `khats` (`khat_id`, `khattype`, `upangsho_id`, `tax_type_id`, `tax_type_type_id`, `serilas`, `khat_name`, `status`, `created_at`, `updated_at`) VALUES
(135, 2, 1, 9, 0, '', 'কর আদায় খরচ ( বিভিন্ন রেজিস্টার, ফরম, রশিদ বই ইত্যাদি মুদ্রন )', 1, '2019-05-14 00:43:26', '2019-05-14 00:43:26'),
(136, 2, 1, 10, 0, '', 'বৃক্ষরোপণ ও রক্ষনাবেক্ষন', 1, '2019-05-14 00:45:36', '2019-05-14 00:45:36'),
(137, 2, 1, 15, 0, '', 'ভূমি উন্নয়ন কর', 1, '2019-05-14 00:56:03', '2019-05-14 00:56:03'),
(138, 2, 1, 16, 0, '', 'আডিট ব্যয়', 1, '2019-05-14 00:56:27', '2019-05-14 00:56:27'),
(139, 2, 1, 17, 0, '', 'মামলা খরচ', 1, '2019-05-14 00:56:55', '2019-05-14 00:56:55'),
(140, 2, 1, 18, 0, '', 'জাতীয় দিবস উদযাপন', 1, '2019-05-14 00:57:31', '2019-05-14 00:57:31'),
(141, 2, 1, 19, 0, '', 'খেলাধুলা ও সংস্কতি', 1, '2019-05-14 00:58:13', '2019-05-14 00:58:13'),
(142, 2, 1, 20, 0, '', 'জরুরী ত্রান', 1, '2019-05-14 00:58:38', '2019-05-14 00:58:38'),
(143, 2, 1, 21, 0, '', 'সম্মানী ব্যক্তি / কৃতি ছাত্র-ছাত্রীদের সংবর্ধনা', 1, '2019-05-14 01:02:45', '2019-05-14 01:02:45'),
(144, 2, 1, 22, 0, '', 'বি,এম,ডি,এফ ঋণ কিস্তি পরিশোধ বাবদ', 1, '2019-05-14 01:03:48', '2019-05-14 01:03:48'),
(145, 2, 1, 24, 0, '', 'স্থানান্তর (ফেরত)', 1, '2019-05-14 01:08:32', '2019-05-14 01:08:32'),
(146, 2, 1, 26, 0, '', 'অবচয় হিসাবে স্থানান্তর', 1, '2019-05-14 01:13:32', '2019-05-14 01:13:32'),
(147, 2, 1, 27, 0, '', 'রাজস্ব উ‍‌দ্ধত্ত উন্নয়ন হিসাবে স্থানান্তর', 1, '2019-05-14 01:15:17', '2019-05-14 01:15:17'),
(148, 2, 1, 28, 0, '', 'সামাপ্তি জের (১নং উপ-খাতের মোট ব্যয়ের এক দ্বাদশাংশের কম নহে)', 1, '2019-05-14 01:16:48', '2019-05-14 01:16:48'),
(149, 1, 2, 30, 0, '', 'পানি কর (চলতি)', 1, '2019-05-14 01:27:42', '2019-05-14 01:27:42'),
(150, 1, 2, 31, 0, '', 'সংযোগ ফিস', 1, '2019-05-14 01:48:28', '2019-05-14 01:48:28'),
(151, 1, 2, 32, 0, '', 'পুনঃ সংযোগ ফিস', 1, '2019-05-14 01:49:46', '2019-05-14 01:49:46'),
(152, 1, 2, 33, 0, '', 'সারচার্জ', 1, '2019-05-14 01:51:58', '2019-05-14 01:51:58'),
(153, 1, 2, 34, 0, '', 'ফরম বিক্রয়', 1, '2019-05-14 01:52:18', '2019-05-14 01:52:18'),
(154, 2, 2, 36, 0, '', 'পানি সরবরাহ শাখার কর্মকর্তা / কর্মচারীদের বেতন', 1, '2019-05-14 01:59:36', '2019-05-14 01:59:36'),
(155, 2, 2, 37, 0, '', 'বিদ্যুৎ বিল (পানি সরবরাহ সংক্রান্ত)', 1, '2019-05-14 02:00:58', '2019-05-14 02:00:58'),
(156, 2, 2, 38, 0, '', 'পানির লাইনের সংযোজন ব্যয়', 1, '2019-05-14 02:01:25', '2019-05-14 02:01:25'),
(157, 2, 2, 39, 0, '', 'পাম্প হাউজ মেরামত ও সংরক্ষণ', 1, '2019-05-14 02:02:24', '2019-05-14 02:02:24'),
(158, 2, 2, 40, 0, '', 'উৎপাদক নলকূপ মেরামত / সংস্কার', 1, '2019-05-14 02:03:04', '2019-05-14 02:03:04'),
(159, 2, 2, 41, 0, '', 'পানি সরবরাহ শাখার মনোহরী দ্রব্যাদি রেজিস্টার ইত্যাদি', 1, '2019-05-14 02:05:00', '2019-05-14 02:05:00'),
(160, 2, 2, 42, 0, '', 'ডাক ও তার', 1, '2019-05-14 02:05:17', '2019-05-14 02:05:17'),
(161, 2, 2, 43, 0, '', 'টেলিফোন', 1, '2019-05-14 02:05:39', '2019-05-14 02:05:39'),
(162, 2, 2, 44, 0, '', 'অবচয় হিসাবে স্থানান্তর', 1, '2019-05-14 02:06:25', '2019-05-14 02:06:25'),
(163, 2, 2, 45, 0, '', 'নলকূপের যন্ত্রাংশ ক্রয়', 1, '2019-05-14 02:08:21', '2019-05-14 02:08:21'),
(164, 2, 2, 46, 0, '', 'পানির লাইন মেরামত', 1, '2019-05-14 02:09:34', '2019-05-14 02:09:34'),
(165, 2, 2, 47, 0, '', 'অন্যান্য ব্যয় ( কম্পিঃ মেরামত ,কম্পিঃ বিল ফরম,ব্যাংক চার্জ ইত্যাদি )', 1, '2019-05-14 02:10:32', '2019-05-14 02:10:32'),
(166, 2, 2, 48, 0, '', 'স্থানান্তর ( বিবিধ হিসাবে ফেরত )', 1, '2019-05-14 02:42:03', '2019-05-14 02:42:03'),
(167, 2, 2, 49, 0, '', 'উন্নয়ন হিসাবে স্থানান্তরিত উদ্বৃত্ত', 1, '2019-05-14 02:59:04', '2019-05-14 02:59:04'),
(168, 2, 2, 50, 0, '', 'পানির মিটার ক্রয় ও স্থাপন ব্যয়', 1, '2019-05-14 03:05:39', '2019-05-14 03:05:39'),
(169, 2, 2, 51, 0, '', 'সমাপ্তি জের ( ১নং উপখাতে প্রয়োজনীয় এক মাসের ব্যয়ের কম নহে)', 1, '2019-05-14 03:08:30', '2019-05-14 03:08:30'),
(170, 1, 3, 52, 0, '', 'সরকার প্রদত্ত উন্নয়ন সহায়তা মঞ্জুরী', 1, '2019-05-14 03:35:54', '2019-05-14 03:35:54'),
(171, 1, 3, 55, 0, '', 'সেচ্ছা অনুদান', 1, '2019-05-14 03:43:55', '2019-05-14 03:43:55'),
(172, 1, 3, 57, 0, '', 'প্রারাম্ভিক স্থিতি', 1, '2019-05-14 04:10:48', '2019-05-14 04:10:48'),
(173, 2, 3, 59, 0, '', 'হাট / বাজার উন্নয়ন', 1, '2019-05-14 04:12:27', '2019-05-14 04:12:27'),
(174, 2, 3, 60, 0, '', 'বাস টার্মিনাল / মাইক্রো ষ্ট্যান্ড বাবদ ব্যয় ( নতুন )', 1, '2019-05-14 04:15:58', '2019-05-14 04:15:58'),
(175, 2, 3, 61, 0, '', 'মার্কেট নির্মাণ / সংস্কার', 1, '2019-05-14 04:22:01', '2019-05-14 04:22:01'),
(181, 2, 3, 69, 0, '', 'পার্ক নির্মাণ / সংস্কার', 1, '2019-05-14 05:26:23', '2019-05-14 05:26:23'),
(182, 2, 3, 71, 0, '', 'আধুনিক কমিউনিটি সেন্টার', 1, '2019-05-14 05:27:10', '2019-05-14 05:27:10'),
(183, 2, 3, 72, 0, '', 'সৌন্দর্য বর্ধন', 1, '2019-05-14 05:27:47', '2019-05-14 05:27:47'),
(184, 2, 3, 73, 0, '', 'মেয়র ভবন নির্মাণ', 1, '2019-05-14 05:28:08', '2019-05-14 05:28:08'),
(185, 2, 3, 74, 0, '', 'কর্মকর্তা কর্মচারীদের বাসভবন নির্মাণ ও মেরামত', 1, '2019-05-14 05:28:26', '2019-05-14 05:28:26'),
(186, 2, 3, 75, 0, '', 'স্থানান্তর ( প্রদান )', 1, '2019-05-14 05:29:02', '2019-05-14 05:29:02'),
(187, 1, 1, 1, 0, 'ক)', 'গৃহ ও ভূমির উপর কর চলতি', 1, '2019-05-14 23:39:44', '2019-05-14 23:39:44'),
(188, 1, 1, 1, 0, 'খ)', 'স্বাবর সম্পত্তি হস্তান্তর কর', 1, '2019-05-14 23:43:09', '2019-05-14 23:43:09'),
(189, 1, 1, 1, 0, 'গ)', 'ইমারত নির্মাণ/পুনঃ নির্মাণ', 1, '2019-05-14 23:44:46', '2019-05-14 23:44:46'),
(190, 1, 1, 1, 0, 'ঘ)', 'পেশাঃ ব্যবসা ও কলিং', 1, '2019-05-14 23:46:05', '2019-05-14 23:46:05'),
(191, 1, 1, 1, 0, 'ঙ)', 'জন্ম বিবাহ দত্তক গ্রহণ', 1, '2019-05-14 23:47:25', '2019-05-14 23:47:25'),
(192, 1, 1, 1, 0, 'চ)', 'বিজ্ঞাপন', 1, '2019-05-14 23:48:15', '2019-05-14 23:48:15'),
(193, 1, 1, 1, 0, 'ছ)', 'পোষা প্রাণী (গৃহপালিত)', 1, '2019-05-14 23:48:45', '2019-05-14 23:48:45'),
(194, 1, 1, 1, 0, 'জ)', 'সিনেমা, থিয়েটার, অডিও নিউ সিনেমা থিয়েটার অডিও ভিজুয়াল ও ডিস ব্যাবসা', 1, '2019-05-14 23:49:48', '2019-05-14 23:49:48'),
(195, 1, 1, 1, 0, 'ঝ)', 'যানবাহন (যান্ত্রিক জান ও নৌকা ব্যতীত)', 1, '2019-05-14 23:50:15', '2019-05-14 23:50:15'),
(196, 1, 1, 2, 0, 'ক)', 'লাইটিং চলতি', 1, '2019-05-14 23:51:18', '2019-05-14 23:51:18'),
(197, 1, 1, 2, 0, 'খ)', 'কঞ্জারভেসি চলতি', 1, '2019-05-14 23:52:03', '2019-05-14 23:52:03'),
(198, 1, 1, 2, 0, 'গ)', 'জনসেবামুলক পূর্ত কাজ', 1, '2019-05-14 23:52:57', '2019-05-14 23:52:57'),
(199, 1, 1, 3, 0, 'ক)', 'লাইসেন্স ( ঠিকাদারি )', 1, '2019-05-14 23:54:19', '2019-05-14 23:54:19'),
(200, 1, 1, 3, 0, 'খ)', 'পশু জবাই', 1, '2019-05-14 23:54:42', '2019-05-14 23:54:42'),
(201, 1, 1, 3, 0, 'গ)', 'মার্কেট ভাড়া (দোকান ভাড়া)', 1, '2019-05-14 23:55:19', '2019-05-14 23:55:19'),
(202, 1, 1, 3, 0, 'ঘ)', 'পৌর মার্কেট বাবদ সেলামী', 1, '2019-05-14 23:56:11', '2019-05-14 23:56:11'),
(203, 1, 1, 3, 0, 'ঙ)', 'মেলা , কৃষি প্রদর্শনী', 1, '2019-05-14 23:57:16', '2019-05-14 23:57:16'),
(204, 1, 1, 3, 0, 'চ)', 'অন্যান্য ফিস ( হোলডিং এর নাম পরিবর্তন , সীমানা নিরধারন সহ ইত্যাদি )', 1, '2019-05-14 23:58:46', '2019-05-14 23:58:46'),
(205, 1, 1, 4, 0, 'ক)', 'হাট বাজার ইজারা', 1, '2019-05-15 00:23:10', '2019-05-15 00:23:10'),
(206, 1, 1, 4, 0, 'খ)', 'বাস স্ট্যান্ড ইজারা', 1, '2019-05-15 00:23:37', '2019-05-15 00:23:37'),
(207, 1, 1, 4, 0, 'গ)', 'পুকুর এইজারা / ফেরিঘাট', 1, '2019-05-15 00:24:32', '2019-05-15 00:24:32'),
(208, 1, 1, 4, 0, 'ঘ)', 'কবরস্তান / শ্মাশান ঘাট', 1, '2019-05-15 00:25:07', '2019-05-15 00:25:07'),
(209, 1, 1, 4, 0, 'ঙ)', 'রোড রোলারসহ অনন্য যানবাহন ভাড়া', 1, '2019-05-15 00:25:50', '2019-05-15 00:25:50'),
(210, 1, 1, 4, 0, 'চ)', 'পৌর সাম্পতি ভাড়া ( জায়গা)', 1, '2019-05-15 00:26:28', '2019-05-15 00:26:28'),
(211, 1, 1, 4, 0, 'ছ)', 'বিভিন্ন সংস্থা / ব্যাক্তি কর্তৃক রাস্তা কর্তনের জন্য ক্ষতিপুরন', 1, '2019-05-15 00:29:35', '2019-05-15 00:29:35'),
(212, 1, 1, 4, 0, 'জ)', 'বিভিন্ন সার্টিফিকেট', 1, '2019-05-15 00:30:11', '2019-05-15 00:30:11'),
(213, 1, 1, 4, 0, 'ঝ)', 'বিভিন্ন ফরম', 1, '2019-05-15 00:33:38', '2019-05-15 00:33:38'),
(214, 1, 1, 4, 0, 'ঞ)', 'দরপত্র', 1, '2019-05-15 00:34:12', '2019-05-15 00:34:12'),
(215, 1, 1, 4, 0, 'ট)', 'জরিমানা /সারচারজ/ক্রকি পরওয়ানা', 1, '2019-05-15 00:34:53', '2019-05-15 00:34:53'),
(216, 1, 1, 4, 0, 'ঠ)', 'সংরক্ষন সেবা ও অন্যান্য সেফটিক ট্যাংক পরিস্কার ফি সহ', 1, '2019-05-15 00:36:50', '2019-05-15 00:36:50'),
(217, 1, 1, 4, 0, 'ড)', 'ব্যাংকে জমাকৃত টাকার লভ্যাংশ', 1, '2019-05-15 00:37:54', '2019-05-15 00:37:54'),
(218, 1, 1, 4, 0, 'ঢ)', 'ইপিআই', 1, '2019-05-15 00:38:26', '2019-05-15 00:38:26'),
(219, 1, 1, 4, 0, 'ণ)', 'হল ভাড়া', 1, '2019-05-15 00:39:02', '2019-05-15 00:39:02'),
(220, 1, 1, 4, 0, 'ত)', 'পুরাতন ভবন/পুরাতন মালামাল নিলামে বিক্রয়', 1, '2019-05-15 00:39:30', '2019-05-15 00:39:30'),
(221, 1, 1, 4, 0, 'থ)', 'স্তানান্তর(গ্রহন)', 1, '2019-05-15 00:40:07', '2019-05-15 00:40:07'),
(222, 1, 1, 4, 0, 'দ)', 'টয়লেট ইজারা', 1, '2019-05-15 00:40:38', '2019-05-15 00:40:38'),
(223, 1, 1, 4, 0, 'ধ)', 'টোল আদায়/ ইজারা', 1, '2019-05-15 00:41:01', '2019-05-15 00:41:01'),
(224, 1, 1, 4, 0, 'ন)', 'ডিজিএফ পরিবহন খরচ বাবদ আয়', 1, '2019-05-15 00:41:49', '2019-05-15 00:41:49'),
(225, 1, 1, 4, 0, 'প)', 'শিশু পার্কের ভাড়া', 1, '2019-05-15 00:42:15', '2019-05-15 00:42:15'),
(226, 1, 1, 5, 0, 'ক)', 'নগর শুল্কের পরিবর্তে সহায়তা', 1, '2019-05-15 00:45:34', '2019-05-15 00:45:34'),
(227, 1, 1, 5, 0, 'খ)', 'কর্মকর্তা / কর্মচারিদের বেতন-ভাতা সহায়তা', 1, '2019-05-15 00:47:22', '2019-05-15 00:47:22'),
(228, 1, 1, 5, 0, 'গ)', 'শিক্ষক / শিক্ষিকাদের বেনিফিটের টাকা', 1, '2019-05-15 00:48:49', '2019-05-15 00:48:49'),
(229, 1, 1, 5, 0, 'ঘ)', 'ছাত্রী বেতন', 1, '2019-05-15 00:50:07', '2019-05-15 00:50:07'),
(230, 1, 1, 5, 0, 'ঙ)', 'জলাতংকে ভাকসিন / এআরভি বাবদ প্রাপ্ত', 1, '2019-05-15 00:50:59', '2019-05-15 00:50:59'),
(231, 1, 1, 5, 0, 'চ)', 'বেওয়ারিশ লাশ দাফন', 1, '2019-05-15 00:52:52', '2019-05-15 00:52:52'),
(232, 1, 2, 35, 0, 'ক)', 'পানি সরবরাহ বিল ( ট্যারিফ ) চলতি', 1, '2019-05-15 02:45:46', '2019-05-15 02:45:46'),
(233, 1, 2, 35, 0, 'খ)', 'পানির মিটার বাবদ', 1, '2019-05-15 02:47:01', '2019-05-15 02:47:01'),
(234, 1, 2, 35, 0, 'গ)', 'ব্যাংকে জমাকৃত টাকার লভ্যাংশ', 1, '2019-05-15 02:50:00', '2019-05-15 02:50:00'),
(235, 1, 2, 35, 0, 'ঘ)', 'স্তানান্তর (বিবিদ খাত থেকে)', 1, '2019-05-15 02:50:55', '2019-05-15 02:50:55'),
(236, 1, 3, 53, 0, 'ক)', 'উপাংশ-১ হইতে', 1, '2019-05-15 03:22:42', '2019-05-15 03:22:42'),
(237, 1, 3, 53, 0, 'খ)', 'উপাংশ-২ হইতে', 1, '2019-05-15 03:23:53', '2019-05-15 03:23:53'),
(238, 1, 3, 56, 0, 'ক)', 'বিশেষ বরাদ্দ', 1, '2019-05-15 03:25:45', '2019-05-15 03:25:45'),
(239, 1, 3, 56, 0, 'খ)', 'ব্যাংক লভ্যাংশ', 1, '2019-05-15 03:27:14', '2019-05-15 03:27:14'),
(240, 1, 3, 56, 0, 'গ)', 'স্থানান্তর ( গ্রহন )', 1, '2019-05-15 03:28:09', '2019-05-15 03:28:09'),
(241, 2, 1, 6, 0, 'ক)', 'পৌর মেয়র / কাউন্সিলরগনের সম্মানী ভাতা', 1, '2019-05-15 03:32:25', '2019-05-15 03:32:25'),
(242, 2, 1, 6, 0, 'খ)', '(১) পানি সরবরাহ শাখা ব্যাতিত অনন্য শাখার কর্মকর্তা / কর্মচারিদের বেতন ভাতা', 1, '2019-05-15 03:33:03', '2019-05-15 03:33:03'),
(243, 2, 1, 6, 0, 'গ)', 'আনুতোষিক তহবিল স্থানান্তর', 1, '2019-05-15 03:35:20', '2019-05-15 03:35:20'),
(244, 2, 1, 6, 1, '১)', 'যানবাহন মেতামত /ক্রয়', 1, '2019-05-15 03:36:58', '2019-05-15 03:36:58'),
(245, 2, 1, 6, 1, '২)', 'জ্বালানি (বর্জ ব্যাবস্তাপনা ব্যাতিত)', 1, '2019-05-15 03:43:36', '2019-05-15 03:43:36'),
(246, 2, 1, 6, 1, '৩)', 'জ্বালানি (বর্জ ব্যাবস্তাপনা)', 1, '2019-05-15 03:44:03', '2019-05-15 03:44:03'),
(247, 2, 1, 6, 0, 'ঙ)', 'টেলিফোন ও ইন্টারনেট', 1, '2019-05-15 03:44:32', '2019-05-15 03:44:32'),
(248, 2, 1, 6, 0, 'চ)', 'বিদ্যুৎ বিল', 1, '2019-05-15 03:45:10', '2019-05-15 03:45:10'),
(249, 2, 1, 6, NULL, 'ছ)', 'আনুষাঙ্গিক ব্যয়', 1, '2019-05-15 03:53:07', '2019-05-15 03:53:07'),
(250, 2, 1, 6, 0, 'জ)', 'বৈদ্যুতিক মালামাল ক্রয়( সড়ক বাতি )', 1, '2019-05-15 03:54:39', '2019-05-15 03:54:39'),
(251, 2, 1, 6, 0, 'ঝ)', 'আপ্যায়ন ব্যয়', 1, '2019-05-15 03:55:06', '2019-05-15 03:55:06'),
(252, 2, 1, 6, 0, 'ঞ)', 'বিবিধ প্রশিক্ষণ ( দেশের অভ্যান্তরে / বাহিরে )', 1, '2019-05-15 03:56:52', '2019-05-15 03:56:52'),
(253, 2, 1, 6, 0, 'ট)', 'বিজ্ঞাপন ও প্রচার বিল', 1, '2019-05-15 03:58:45', '2019-05-15 03:58:45'),
(254, 2, 1, 6, 0, 'ঠ)', 'ষ্টেশনারি দ্রবাদি ক্রয় বিল', 1, '2019-05-15 03:59:36', '2019-05-15 03:59:36'),
(255, 2, 1, 6, 0, 'ড)', 'চুক্তিভিত্তিক কর্মচারিদের বেতন', 1, '2019-05-15 04:01:52', '2019-05-15 04:01:52'),
(256, 2, 1, 7, 0, 'ক)', 'পৌরসভাচালিত শিক্ষা প্রতিষ্ঠানের শিক্ষক / কমরচারিদের বেতন ভাতা', 1, '2019-05-15 04:04:24', '2019-05-15 04:04:24'),
(257, 2, 1, 7, 0, 'খ)', 'পাঠাগারের বই পুস্তক ক্রয়', 1, '2019-05-15 04:05:22', '2019-05-15 04:05:22'),
(258, 2, 1, 7, 0, 'গ)', 'অনন্য', 1, '2019-05-15 04:06:23', '2019-05-15 04:06:23'),
(259, 2, 1, 8, 0, 'ক)', 'ঔষধ ও চিকিৎসা ( এ আরভি সহ )', 1, '2019-05-15 04:29:01', '2019-05-15 04:29:01'),
(260, 2, 1, 8, 0, 'খ)', 'ইপিআই', 1, '2019-05-15 04:29:55', '2019-05-15 04:29:55'),
(261, 2, 1, 8, 0, 'গ)', 'নর্দমা ( ড্রেন / খাল ) পরিষ্কার', 1, '2019-05-15 04:31:02', '2019-05-15 04:31:02'),
(262, 2, 1, 8, 0, 'ঘ)', 'ময়লা আবর্জনা পরিষ্কার', 1, '2019-05-15 04:31:34', '2019-05-15 04:31:34'),
(263, 2, 1, 8, 0, 'ঙ)', 'ময়লা আবর্জনা পরিস্কারের উপকরণ ক্রয়', 1, '2019-05-15 04:32:38', '2019-05-15 04:32:38'),
(265, 2, 1, 8, 0, 'চ)', 'জলাতংক রোগ প্রতিরোধ (কুকুর নিধন)', 1, '2019-05-15 04:53:17', '2019-05-15 04:53:17'),
(266, 2, 1, 8, 0, 'ছ)', 'কবরস্থান / শ্মাশান ঘাটের জন্য ভুমি ক্রয়', 1, '2019-05-15 04:54:35', '2019-05-15 04:54:35'),
(267, 2, 1, 8, 0, 'জ)', 'জরুরি জনস্বাস্থ্য ( জলাবন্ধতা নিষ্কাশন/ অপসারন সহ অন্যান্য )', 1, '2019-05-15 04:56:47', '2019-05-15 04:56:47'),
(268, 2, 1, 8, 0, 'ঝ)', 'মৃত দেহ অপসারণ', 1, '2019-05-15 04:57:35', '2019-05-15 04:57:35'),
(269, 2, 1, 8, 0, 'ঞ)', 'মশক নিধন', 1, '2019-05-15 04:58:56', '2019-05-15 04:58:56'),
(270, 2, 1, 8, 0, 'ট)', 'বর্জ্য বিষয়ক সচেতনতা কার্যক্রম', 1, '2019-05-15 04:59:51', '2019-05-15 04:59:51'),
(271, 2, 1, 8, 0, 'ঠ)', 'চুক্তিভিত্তিক পরিছন্নতা কর্মীদের পারিশ্রমিক', 1, '2019-05-15 05:07:48', '2019-05-15 05:07:48'),
(272, 2, 1, 23, 0, '১)', 'GAP বাস্তবায়ন ব্যয়', 1, '2019-05-19 23:10:35', '2019-05-19 23:10:35'),
(273, 2, 1, 23, 0, '২)', 'PRAP বাস্তবায়ন ব্যয়', 1, '2019-05-19 23:11:10', '2019-05-19 23:11:10'),
(274, 2, 1, 23, 0, '৩)', 'TLCC, WC, SC সভার আপ্যায়ন সহ বিবিধ ব্যায়', 1, '2019-05-19 23:12:48', '2019-05-19 23:12:48'),
(275, 2, 1, 25, 0, 'ক)', 'হাট বাজার ইজারা্র মূসক ও আয়কর সরকারী তহবিলে জমা প্রদান', 1, '2019-05-19 23:15:49', '2019-05-19 23:15:49'),
(276, 2, 1, 25, 0, 'খ)', 'হাট বাজার ইজারা্র ৪% মুক্তিযোদ্ধা কল্যান তহবিলে জমা', 1, '2019-05-19 23:20:00', '2019-05-19 23:20:00'),
(277, 2, 1, 25, 0, 'গ)', 'হাট বাজার ইজারা্র ৫% অর্থ ভূমি রাজস্ব খাতে জমা প্রদান', 1, '2019-05-19 23:24:45', '2019-05-19 23:24:45'),
(278, 2, 1, 25, 0, 'ঘ)', 'সিডিউল বিক্রয় এর অর্থ সরকারি কোষাগারে জমা', 1, '2019-05-19 23:26:05', '2019-05-19 23:26:05'),
(279, 2, 1, 25, 0, 'ঙ)', 'ম্যাব এর বার্ষিক ফি', 1, '2019-05-19 23:27:07', '2019-05-19 23:27:07'),
(280, 2, 1, 25, 0, 'চ)', 'ব্যাংক চার্জ', 1, '2019-05-19 23:27:47', '2019-05-19 23:27:47'),
(281, 2, 1, 25, 0, 'ছ)', 'আসবাব পত্র ও যন্ত্রপাতি ক্রয়', 1, '2019-05-19 23:28:49', '2019-05-19 23:28:49'),
(282, 2, 1, 25, 0, 'জ)', 'জন্ম ও মৃত্যু নিবন্ধন সংক্রান্ত ব্যয়', 1, '2019-05-19 23:30:21', '2019-05-19 23:30:21'),
(283, 2, 1, 25, 0, 'ঝ)', 'গৃহ নির্মান / পুনঃ নির্মান', 1, '2019-05-19 23:31:08', '2019-05-19 23:31:08'),
(284, 2, 1, 25, 0, 'ঞ)', 'উন্নত তথ্য প্রযুক্তির ব্যবহার ও তথ্য হাল নাগাদ করন', 1, '2019-05-19 23:34:07', '2019-05-19 23:34:07'),
(285, 2, 3, 58, 0, 'ক)', 'রাস্তা নির্মাণ', 1, '2019-05-19 23:50:25', '2019-05-19 23:50:25'),
(286, 2, 3, 58, 2, 'i)', 'রাস্তা মেরামত / সংস্কার', 1, '2019-05-19 23:37:22', '2019-05-19 23:37:22'),
(287, 2, 3, 58, 2, 'ii)', 'ব্রিজ / কাল্ভাট মেরামত / সংস্কার', 1, '2019-05-19 23:38:32', '2019-05-19 23:38:32'),
(288, 2, 3, 58, 2, 'iii)', 'ড্রেন মেরামত', 1, '2019-05-19 23:39:02', '2019-05-19 23:39:02'),
(289, 2, 3, 58, 2, 'iv)', 'ফুটপাত মেরামত ও সংস্কার', 1, '2019-05-19 23:39:45', '2019-05-19 23:39:45'),
(290, 2, 3, 58, 2, 'v)', 'রাস্তা আলোকিত করণ', 1, '2019-05-19 23:41:38', '2019-05-19 23:41:38'),
(291, 2, 3, 58, 2, 'vi)', 'বাস টার্মিনাল সংস্কার', 1, '2019-05-19 23:46:47', '2019-05-19 23:46:47'),
(292, 2, 3, 58, 2, 'vii)', 'টয়লেট নির্মাণ', 1, '2019-05-19 23:48:57', '2019-05-19 23:48:57'),
(293, 2, 3, 58, 2, 'viii)', 'ছোট ছোট মেরামতসহ অন্যনা (MMT)', 1, '2019-05-19 23:50:25', '2019-05-19 23:50:25'),
(294, 2, 3, 58, 0, 'গ)', 'ব্রিজ /কালভার্ট নির্মাণ', 1, '2019-05-20 00:32:13', '2019-05-20 00:32:13'),
(295, 2, 3, 58, 0, 'ঘ)', 'ড্রেন নির্মাণ', 1, '2019-05-20 00:32:31', '2019-05-20 00:32:31'),
(296, 2, 3, 58, 0, 'ঙ)', 'পানির লাইন স্থাপন / সম্প্রসারণ', 1, '2019-05-20 00:33:11', '2019-05-20 00:33:11'),
(297, 2, 3, 58, 0, 'চ)', 'পৌর ভবন সম্প্রসারন ও সংস্কার', 1, '2019-05-20 00:33:59', '2019-05-20 00:33:59'),
(298, 2, 3, 58, 0, 'ছ)', 'ব্যাংক চার্জ', 1, '2019-05-20 00:35:26', '2019-05-20 00:35:26'),
(299, 2, 3, 70, 0, 'ক)', 'ঘাটলা নির্মাণ', 1, '2019-05-20 00:37:10', '2019-05-20 00:37:10'),
(300, 2, 3, 70, 0, 'খ)', 'সীমানা প্রাচীর', 1, '2019-05-20 00:37:41', '2019-05-20 00:37:41'),
(301, 2, 3, 70, 0, 'গ)', 'ওজুখানা ও সেচ নির্মাণ', 1, '2019-05-20 00:42:02', '2019-05-20 00:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `khattypes`
--

CREATE TABLE `khattypes` (
  `khat_id` int(11) NOT NULL,
  `khat` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `khattypes`
--

INSERT INTO `khattypes` (`khat_id`, `khat`, `created_at`, `updated_at`) VALUES
(0, '0', '2019-03-01 00:00:00', '2019-03-02 00:00:00'),
(1, 'আয়', '2019-02-26 08:24:24', '2019-02-26 13:36:41'),
(2, 'ব্যয়', '2019-02-26 08:24:24', '2019-02-26 11:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `id` int(11) NOT NULL,
  `loan_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `loan_name`) VALUES
(1, 'PF Loan'),
(2, 'House Rent'),
(3, 'dsfdf'),
(4, 'PF Loan');

-- --------------------------------------------------------

--
-- Table structure for table `master_billings`
--

CREATE TABLE `master_billings` (
  `id` int(11) NOT NULL,
  `nonduereg` varchar(255) DEFAULT '0',
  `mignondue` varchar(255) DEFAULT '0',
  `examfee` varchar(255) NOT NULL,
  `transcript` varchar(255) NOT NULL,
  `examentry` varchar(255) NOT NULL,
  `admission` varchar(255) NOT NULL,
  `whole_tuition` varchar(255) NOT NULL,
  `com_lab_fee` varchar(255) NOT NULL,
  `exam_center_fee` varchar(255) NOT NULL,
  `library_fee` varchar(255) NOT NULL,
  `std_type` int(11) DEFAULT NULL COMMENT '1 for du ,2 for non du,3 for bacheloere ,4 for diploma',
  `idcard` varchar(255) NOT NULL,
  `misc` varchar(255) NOT NULL,
  `session_charge` varchar(120) DEFAULT NULL,
  `libarycosion_money` varchar(255) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_billings`
--

INSERT INTO `master_billings` (`id`, `nonduereg`, `mignondue`, `examfee`, `transcript`, `examentry`, `admission`, `whole_tuition`, `com_lab_fee`, `exam_center_fee`, `library_fee`, `std_type`, `idcard`, `misc`, `session_charge`, `libarycosion_money`, `degree_id`, `sub_id`) VALUES
(8, '2000', NULL, '2000', '450', '100', '10000', '32000', '2500', '100', '2000', 3, '130', '0', '3500', '0', 3, 17),
(9, '100', '0', '200', '300', '400', '500', '600', '700', '800', '900', 4, '1000', '1100', NULL, '1200', 4, 19),
(10, '0', '0', '0', '0', '0', '0', '300', '0', '300', '0', 1, '0', '0', NULL, '466', 1, 18),
(11, '5000', '1000', '2000', '450', '100', '3000', '8000', '1500', '1500', '750', 2, '130', '1000', NULL, '1000', 1, 18),
(12, '0', '0', '100', '100', '10000', '100', '100', '100', '200', '100', 1, '100', '100', NULL, '100', 1, 20),
(13, '5000', '1000', '8000', '1800', '400', '3000', '32000', '6000', '6000', '3000', 2, '3000', '3000', NULL, '2000', 1, 20),
(14, '200000', NULL, '2000', '450', '100', '10000', '32000', '2500', '1000', '2000', 3, '130', '1000', '3500', '2000', 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_29_103539_create_munus_table', 1),
(4, '2019_01_03_112826_permission_table', 1),
(5, '2019_01_03_120147_sub_menus_table', 1),
(6, '2019_01_03_120839_user_roles_table', 1),
(7, '2019_01_15_055542_create_upangshos_table', 1),
(8, '2019_01_15_055705_create_tax_types_table', 1),
(9, '2019_01_15_055912_create_expence_khats_table', 1),
(10, '2019_01_15_060017_create_income_khats_table', 1),
(11, '2019_01_15_060144_create_budgets_table', 1),
(12, '2019_01_15_060248_create_banks_table', 1),
(13, '2019_01_15_060419_create_bank_opn__blances_table', 1),
(14, '2019_01_15_060710_create_bank_details_table', 1),
(15, '2019_01_15_062839_create_incomes_table', 1),
(16, '2019_01_15_062913_create_expenses_table', 1),
(17, '2019_06_01_131413_create_degree_table', 2),
(18, '2019_06_01_144308_create_courses_table', 3),
(19, '2019_06_02_113612_create_admissions_table', 4),
(20, '2019_06_10_153442_create_departments_table', 5),
(21, '2019_06_10_153629_create_designations_table', 5),
(22, '2019_06_13_123306_create_employees_table', 6),
(23, '2019_06_15_115105_create_salaryprogresses_table', 7),
(24, '2019_06_17_132506_create_billingconfigurations_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_distributions`
--

CREATE TABLE `product_distributions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `distibuted_qty` varchar(255) NOT NULL,
  `date_ofdistribution` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_distributions`
--

INSERT INTO `product_distributions` (`id`, `product_id`, `empl_id`, `user_id`, `remark`, `distibuted_qty`, `date_ofdistribution`, `created_at`, `updated_at`) VALUES
(5, 12, 2, 5, 'tedst', '12', '2019-09-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salaryprogresses`
--

CREATE TABLE `salaryprogresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `deg_id` int(11) DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `salary_add` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_deduct` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrent` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medcal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convence` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allownce` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abs_duduct_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `lninstall` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `incometax` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bsce_contri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empl_contri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_month` date NOT NULL,
  `process_date` date NOT NULL,
  `echeck_number` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_bills`
--

CREATE TABLE `std_bills` (
  `id` int(11) NOT NULL,
  `billing_details` varchar(11) NOT NULL,
  `billing_type_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `bill_type_date` date NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_bills`
--

INSERT INTO `std_bills` (`id`, `billing_details`, `billing_type_id`, `amount`, `bill_type_date`, `remark`) VALUES
(1, 'ddd', 1, '100', '2019-07-29', 'dddd');

-- --------------------------------------------------------

--
-- Table structure for table `std_bill_types`
--

CREATE TABLE `std_bill_types` (
  `id` int(11) NOT NULL,
  `bill_type_name` varchar(255) NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_bill_types`
--

INSERT INTO `std_bill_types` (`id`, `bill_type_name`, `status`) VALUES
(1, 'Photocopy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `std_pay_ins`
--

CREATE TABLE `std_pay_ins` (
  `id` int(11) NOT NULL,
  `config_bill_id` int(11) NOT NULL,
  `pay_amount` varchar(100) NOT NULL,
  `due` varchar(100) NOT NULL,
  `total_pay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `sub_menu_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `sub_menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `companey_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `companey_name`, `address`) VALUES
(1, 'alamin', 'test company', 'asd'),
(2, 'drt', 'trete', 'tregffdgfdsdfdsfdsfdsfdsfdsd cvb');

-- --------------------------------------------------------

--
-- Table structure for table `table_relation`
--

CREATE TABLE `table_relation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_relation`
--

INSERT INTO `table_relation` (`id`, `name`, `type`) VALUES
(1, 'salaryprogresses', 'Salary Process'),
(2, 'billingconfigurations', 'Student payment '),
(3, 'indirect_income', 'Indirect Income'),
(4, 'project_payment', 'Project Payment Receive'),
(5, 'broker_payment', 'Supplier Payment'),
(6, 'employee_expense', 'Project Expense'),
(7, 'project_expense', 'Project Wise Expense'),
(8, 'employeloans', 'Salary Loan'),
(9, 'std_bill_types', 'std bill types'),
(11, 'yearly_expense', 'Yearly Expense'),
(12, 'inventory', 'inventroy payment'),
(13, 'balance_transfer', 'Balance Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE `tax_types` (
  `tax_id` int(10) UNSIGNED NOT NULL,
  `upangsho_id` int(11) DEFAULT NULL,
  `khat_id` int(11) DEFAULT NULL,
  `subormain` int(11) DEFAULT '0',
  `tax_name` varchar(191) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`tax_id`, `upangsho_id`, `khat_id`, `subormain`, `tax_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'ট্যাক্সেস', 1, '2019-05-14 00:23:02', '2019-05-14 00:23:02'),
(2, 1, 1, NULL, 'রেট', 1, '2019-05-14 00:23:52', '2019-05-14 00:23:52'),
(3, 1, 1, NULL, 'ফিস', 1, '2019-05-14 00:24:23', '2019-05-14 00:24:23'),
(4, 1, 1, NULL, 'অন্যান্য', 1, '2019-05-14 00:25:15', '2019-05-14 00:25:15'),
(5, 1, 1, NULL, 'উন্নয়ন খাত বাতিত সরকারী অনুদান', 1, '2019-05-14 00:26:27', '2019-05-14 00:26:27'),
(6, 1, 2, NULL, 'সাধারণ সংস্থাপন', 1, '2019-05-14 00:34:59', '2019-05-14 00:34:59'),
(7, 1, 2, NULL, 'শিক্ষা ব্যয়', 1, '2019-05-14 00:40:39', '2019-05-14 00:40:39'),
(8, 1, 2, NULL, 'স্বাস্থ্য ও পয়ঃনিস্কাশন', 1, '2019-05-14 00:41:56', '2019-05-14 00:41:56'),
(9, 1, 2, 1, 'কর আদায় খরচ ( বিভিন্ন রেজিস্টার, ফরম, রশিদ বই ইত্যাদি মুদ্রন )', 1, '2019-05-14 00:43:26', '2019-05-14 00:43:26'),
(10, 1, 2, 1, 'বৃক্ষরোপণ ও রক্ষনাবেক্ষন', 1, '2019-05-14 00:45:36', '2019-05-14 00:45:36'),
(11, 1, 2, NULL, 'আর্থিক অনুদান ও সহায়তা', 1, '2019-05-14 00:47:34', '2019-05-14 00:47:34'),
(15, 1, 2, 1, 'ভূমি উন্নয়ন কর', 1, '2019-05-14 00:56:03', '2019-05-14 00:56:03'),
(16, 1, 2, 1, 'আডিট ব্যয়', 1, '2019-05-14 00:56:27', '2019-05-14 00:56:27'),
(17, 1, 2, 1, 'মামলা খরচ', 1, '2019-05-14 00:56:55', '2019-05-14 00:56:55'),
(18, 1, 2, 1, 'জাতীয় দিবস উদযাপন', 1, '2019-05-14 00:57:31', '2019-05-14 00:57:31'),
(19, 1, 2, 1, 'খেলাধুলা ও সংস্কৃতি', 1, '2019-05-14 00:58:13', '2019-05-14 00:58:13'),
(20, 1, 2, 1, 'জরুরী ত্রান', 1, '2019-05-14 00:58:38', '2019-05-14 00:58:38'),
(21, 1, 2, 1, 'সম্মানী ব্যক্তি / কৃতি ছাত্র-ছাত্রীদের সংবর্ধনা', 1, '2019-05-14 01:02:45', '2019-05-14 01:02:45'),
(22, 1, 2, 1, 'বি,এম,ডি,এফ ঋণ কিস্তি পরিশোধ বাবদ', 1, '2019-05-14 01:03:48', '2019-05-14 01:03:48'),
(23, 1, 2, NULL, 'UGIIP-3 এর বিবিধ ব্যয়', 1, '2019-05-14 01:04:28', '2019-05-14 01:04:28'),
(24, 1, 2, 1, 'স্থানান্তর (ফেরত)', 1, '2019-05-14 01:08:32', '2019-05-14 01:08:32'),
(25, 1, 2, NULL, 'অন্যান্য ব্যয়', 1, '2019-05-14 01:12:43', '2019-05-14 01:12:43'),
(26, 1, 2, 1, 'অবচয় হিসাবে স্থানান্তর', 1, '2019-05-14 01:13:32', '2019-05-14 01:13:32'),
(27, 1, 2, 1, 'রাজস্ব উ‍‌দ্ধত্ত উন্নয়ন হিসাবে স্থানান্তর', 1, '2019-05-14 01:15:17', '2019-05-14 01:15:17'),
(28, 1, 2, 1, 'সামাপ্তি জের (১নং উপ-খাতের মোট ব্যয়ের এক দ্বাদশাংশের কম নহে)', 1, '2019-05-14 01:16:48', '2019-05-14 01:16:48'),
(30, 2, 1, 1, 'পানি কর (চলতি)', 1, '2019-05-14 01:27:42', '2019-05-14 01:27:42'),
(31, 2, 1, 1, 'সংযোগ ফিস', 1, '2019-05-14 01:48:28', '2019-05-14 01:48:28'),
(32, 2, 1, 1, 'পুনঃ সংযোগ ফিস', 1, '2019-05-14 01:49:46', '2019-05-14 01:49:46'),
(33, 2, 1, 1, 'সারচার্জ', 1, '2019-05-14 01:51:58', '2019-05-14 01:51:58'),
(34, 2, 1, 1, 'ফরম বিক্রয়', 1, '2019-05-14 01:52:18', '2019-05-14 01:52:18'),
(35, 2, 1, NULL, 'অন্যান্য', 1, '2019-05-14 01:57:50', '2019-05-14 01:57:50'),
(36, 2, 2, 1, 'পানি সরবরাহ শাখার কর্মকর্তা / কর্মচারীদের বেতন', 1, '2019-05-14 01:59:36', '2019-05-14 01:59:36'),
(37, 2, 2, 1, 'বিদ্যুৎ বিল (পানি সরবরাহ সংক্রান্ত)', 1, '2019-05-14 02:00:58', '2019-05-14 02:00:58'),
(38, 2, 2, 1, 'পানির লাইনের সংযোজন ব্যয়', 1, '2019-05-14 02:01:25', '2019-05-14 02:01:25'),
(39, 2, 2, 1, 'পাম্প হাউজ মেরামত ও সংরক্ষণ', 1, '2019-05-14 02:02:24', '2019-05-14 02:02:24'),
(40, 2, 2, 1, 'উৎপাদক নলকূপ মেরামত / সংস্কার', 1, '2019-05-14 02:03:04', '2019-05-14 02:03:04'),
(41, 2, 2, 1, 'পানি সরবরাহ শাখার মনোহরী দ্রব্যাদি রেজিস্টার ইত্যাদি', 1, '2019-05-14 02:05:00', '2019-05-14 02:05:00'),
(42, 2, 2, 1, 'ডাক ও তার', 1, '2019-05-14 02:05:17', '2019-05-14 02:05:17'),
(43, 2, 2, 1, 'টেলিফোন', 1, '2019-05-14 02:05:39', '2019-05-14 02:05:39'),
(44, 2, 2, 1, 'অবচয় হিসাবে স্থানান্তর', 1, '2019-05-14 02:06:25', '2019-05-14 02:06:25'),
(45, 2, 2, 1, 'নলকূপের যন্ত্রাংশ ক্রয়', 1, '2019-05-14 02:08:21', '2019-05-14 02:08:21'),
(46, 2, 2, 1, 'পানির লাইন মেরামত', 1, '2019-05-14 02:09:34', '2019-05-14 02:09:34'),
(47, 2, 2, 1, 'অন্যান্য ব্যয় ( কম্পিঃ মেরামত ,কম্পিঃ বিল ফরম,ব্যাংক চার্জ ইত্যাদি )', 1, '2019-05-14 02:10:32', '2019-05-14 02:10:32'),
(48, 2, 2, 1, 'স্থানান্তর ( বিবিধ হিসাবে ফেরত )', 1, '2019-05-14 02:42:03', '2019-05-14 02:42:03'),
(49, 2, 2, 1, 'উন্নয়ন হিসাবে স্থানান্তরিত উদ্বৃত্ত', 1, '2019-05-14 02:59:04', '2019-05-14 02:59:04'),
(50, 2, 2, 1, 'পানির মিটার ক্রয় ও স্থাপন ব্যয়', 1, '2019-05-14 03:05:39', '2019-05-14 03:05:39'),
(51, 2, 2, 1, 'সমাপ্তি জের ( ১নং উপখাতে প্রয়োজনীয় এক মাসের ব্যয়ের কম নহে)', 1, '2019-05-14 03:08:30', '2019-05-14 03:08:30'),
(52, 3, 1, 1, 'সরকার প্রদত্ত উন্নয়ন সহায়তা মঞ্জুরী', 1, '2019-05-14 03:35:54', '2019-05-14 03:35:54'),
(53, 3, 1, NULL, 'রাজস্ব উ‍‌দ্ধৃত', 1, '2019-05-14 03:38:58', '2019-05-14 03:38:58'),
(55, 3, 1, 1, 'সেচ্ছা অনুদান', 1, '2019-05-14 03:43:55', '2019-05-14 03:43:55'),
(56, 3, 1, NULL, 'অন্যান্য', 1, '2019-05-14 04:10:40', '2019-05-14 04:10:40'),
(57, 3, 1, 1, 'প্রারাম্ভিক স্থিতি', 1, '2019-05-14 04:10:48', '2019-05-14 04:10:48'),
(58, 3, 2, NULL, 'অবকাঠামো', 1, '2019-05-14 04:11:45', '2019-05-14 04:11:45'),
(59, 3, 2, 1, 'হাট / বাজার উন্নয়ন', 1, '2019-05-14 04:12:27', '2019-05-14 04:12:27'),
(60, 3, 2, 1, 'বাস টার্মিনাল / মাইক্রো ষ্ট্যান্ড বাবদ ব্যয় ( নতুন )', 1, '2019-05-14 04:15:58', '2019-05-14 04:15:58'),
(61, 3, 2, 1, 'মার্কেট নির্মাণ / সংস্কার', 1, '2019-05-14 04:22:01', '2019-05-14 04:22:01'),
(69, 3, 2, 1, 'পার্ক নির্মাণ / সংস্কার', 1, '2019-05-14 05:26:23', '2019-05-14 05:26:23'),
(70, 3, 2, NULL, 'অন্যান্য', 1, '2019-05-14 05:26:32', '2019-05-14 05:26:32'),
(71, 3, 2, 1, 'আধুনিক কমিউনিটি সেন্টার', 1, '2019-05-14 05:27:10', '2019-05-14 05:27:10'),
(72, 3, 2, 1, 'সৌন্দর্য বর্ধন', 1, '2019-05-14 05:27:47', '2019-05-14 05:27:47'),
(73, 3, 2, 1, 'মেয়র ভবন নির্মাণ', 1, '2019-05-14 05:28:08', '2019-05-14 05:28:08'),
(74, 3, 2, 1, 'কর্মকর্তা কর্মচারীদের বাসভবন নির্মাণ ও মেরামত', 1, '2019-05-14 05:28:26', '2019-05-14 05:28:26'),
(75, 3, 2, 1, 'স্থানান্তর ( প্রদান )', 1, '2019-05-14 05:29:02', '2019-05-14 05:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `tax_type_types`
--

CREATE TABLE `tax_type_types` (
  `tax_id` int(10) UNSIGNED NOT NULL,
  `upangsho_id` int(11) DEFAULT NULL,
  `khat_id` int(11) DEFAULT NULL,
  `khtattype_id` int(11) NOT NULL DEFAULT '0',
  `serialise` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_name2` varchar(191) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_type_types`
--

INSERT INTO `tax_type_types` (`tax_id`, `upangsho_id`, `khat_id`, `khtattype_id`, `serialise`, `tax_name2`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 6, 'ঘ)', 'যানবাহন সংক্রান্ত ব্যায়', 1, '2019-05-14 00:39:31', '2019-05-14 00:39:31'),
(2, 3, 2, 58, NULL, 'খ) O & M', 1, '2019-05-14 05:03:38', '2019-05-14 05:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `trx_records`
--

CREATE TABLE `trx_records` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `acount_details_id` int(11) NOT NULL,
  `table_incrment_id` int(11) NOT NULL,
  `pay_type` int(11) NOT NULL COMMENT '1 for bank to bank ,2 for bank to cash ,3 for cash',
  `amount_type` int(11) NOT NULL,
  `branchid` int(11) DEFAULT '0',
  `amount` int(11) NOT NULL,
  `salary_month` varchar(100) DEFAULT NULL,
  `trx_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_records`
--

INSERT INTO `trx_records` (`id`, `table_id`, `acount_details_id`, `table_incrment_id`, `pay_type`, `amount_type`, `branchid`, `amount`, `salary_month`, `trx_date`, `created_at`, `updated_at`) VALUES
(1, 13, 6, 30, 1, 2, 36, 8605, NULL, '2019-07-02', '2019-09-22', '2019-09-22 10:29:27'),
(2, 13, 9, 30, 1, 1, 36, 8605, NULL, '2019-07-02', '2019-09-22', '2019-09-22 10:29:27'),
(3, 3, 6, 2, 1, 2, 36, 58200, NULL, '2019-07-02', '2019-09-22', '2019-09-22 10:51:33'),
(4, 3, 6, 3, 1, 2, 36, 122400, NULL, '2019-07-02', '2019-09-22', '2019-09-22 11:32:36'),
(5, 3, 6, 4, 1, 2, 36, 14550, NULL, '2019-07-02', '2019-09-22', '2019-09-22 11:34:01'),
(6, 9, 6, 2, 1, 2, 36, 5802, NULL, '2019-07-07', '2019-09-22', '2019-09-22 11:35:22'),
(7, 3, 6, 5, 1, 2, 36, 168300, NULL, '2019-07-07', '2019-09-22', '2019-09-22 11:37:13'),
(8, 3, 6, 6, 1, 2, 36, 87300, NULL, '2019-07-07', '2019-09-22', '2019-09-22 11:38:04'),
(9, 3, 6, 7, 1, 2, 36, 145500, NULL, '2019-07-07', '2019-09-22', '2019-09-22 11:39:07'),
(10, 3, 6, 8, 1, 2, 36, 29100, NULL, '2019-07-08', '2019-09-22', '2019-09-22 11:40:09'),
(11, 3, 6, 9, 1, 2, 36, 30600, NULL, '2019-07-08', '2019-09-22', '2019-09-22 11:41:39'),
(12, 3, 6, 10, 1, 2, 36, 29100, NULL, '2019-07-08', '2019-09-22', '2019-09-22 11:43:39'),
(13, 3, 6, 11, 1, 2, 36, 15300, NULL, '2019-07-09', '2019-09-22', '2019-09-22 11:45:00'),
(14, 3, 6, 12, 1, 2, 36, 14550, NULL, '2019-07-09', '2019-09-22', '2019-09-22 11:47:05'),
(15, 3, 6, 13, 1, 2, 36, 29100, NULL, '2019-09-15', '2019-09-22', '2019-09-22 11:48:18'),
(16, 3, 6, 14, 1, 2, 36, 29100, NULL, '2019-09-15', '2019-09-22', '2019-09-22 11:51:42'),
(17, 3, 6, 15, 1, 2, 36, 29100, NULL, '2019-09-15', '2019-09-22', '2019-09-22 11:54:14'),
(18, 3, 6, 16, 1, 2, 36, 14550, NULL, '2019-07-15', '2019-09-22', '2019-09-22 12:04:33'),
(19, 3, 6, 17, 1, 2, 36, 1100, NULL, '2019-07-16', '2019-09-22', '2019-09-22 13:04:10'),
(20, 9, 6, 3, 1, 2, 36, 139512, NULL, '2019-07-08', '2019-09-22', '2019-09-22 13:07:00'),
(21, 9, 6, 4, 1, 2, 36, 14500, NULL, '2019-07-14', '2019-09-22', '2019-09-22 13:08:36'),
(22, 13, 6, 31, 1, 2, 36, 5429, NULL, '2019-07-14', '2019-09-22', '2019-09-22 13:11:57'),
(23, 13, 9, 31, 1, 1, 36, 5429, NULL, '2019-07-14', '2019-09-22', '2019-09-22 13:11:57'),
(24, 9, 9, 6, 2, 2, 36, 5429, NULL, '2019-07-14', '2019-09-22', '2019-09-22 13:17:17'),
(25, 9, 6, 7, 1, 2, 36, 2000, NULL, '2019-07-14', '2019-09-22', '2019-09-22 14:13:43'),
(26, 9, 9, 8, 2, 2, 36, 1010, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:08:43'),
(27, 9, 9, 9, 2, 2, 36, 1030, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:30:15'),
(28, 9, 9, 10, 2, 2, 36, 120, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:31:17'),
(29, 9, 9, 11, 2, 2, 36, 1700, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:32:15'),
(30, 9, 9, 12, 2, 2, 36, 5210, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:32:57'),
(31, 13, 6, 32, 1, 2, 36, 9070, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:34:27'),
(32, 13, 9, 32, 1, 1, 36, 9070, NULL, '2019-07-16', '2019-09-22', '2019-09-22 17:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `user_name`, `email`, `phone`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'reza', 'admin@gmail.com', '01723735371', '2019-01-28 19:25:33', '$2y$10$Mp0SRG0q8aUPME4H66KREuzwTTh.OCvI.BbGotu9LisC4P2hNdwxO', NULL, 'yBWDuVuHtJXcvO6zKO66zAR9Pi35NmsRwczB7oUwMEBBxMQvRh1uFTfHamKm', '2019-01-21 22:30:37', '2019-01-27 01:00:35'),
(2, 2, 'Academic', 'user2', 'academic@gmail.com', '01723735371', '2019-01-28 19:25:33', '$2y$10$Mp0SRG0q8aUPME4H66KREuzwTTh.OCvI.BbGotu9LisC4P2hNdwxO', NULL, 'CzcMoB9zczA9TrNvpNMuDR1naCsNUIkXdOYKzG28UvOSfpYpckpfrJxF9OaX', '2019-01-21 22:30:37', '2019-01-27 01:00:35'),
(3, 3, 'Inventory', 'user3', 'inventory@gmail.com', '01723735371', '2019-01-28 19:25:33', '$2y$10$Mp0SRG0q8aUPME4H66KREuzwTTh.OCvI.BbGotu9LisC4P2hNdwxO', NULL, 'P6hKiVZVU7QcRaAe6sM3RmCYVpsjZG769p7oDLwr8A3wAvN7a8HsSOmQdz7U', '2019-01-21 22:30:37', '2019-01-27 01:00:35'),
(4, 4, 'Accounts', '2aite', 'accounts@gmail.com', NULL, NULL, '$2y$10$2yt5uMmiSsgsv2f3jNvomOprlffbfaH6GvwSKuhZ.Hl4QqalfO83i', NULL, 'uxorLIummTF5ZktvIDzK60HHsxlTgFyFxbqanLhmiGUid5HUNNy7U9yRJ1h9', NULL, NULL),
(5, 5, '2aitown', '2ait', '2aitown@gmail.com', '01723735371', '2019-01-28 19:25:33', '$2y$10$Mp0SRG0q8aUPME4H66KREuzwTTh.OCvI.BbGotu9LisC4P2hNdwxO', NULL, 'IQBicPa2K5GlZg6FOfDzucHzTI9H3qyFpLziImTUYTceAe4HcULkweJr8K1K', '2019-01-21 22:30:37', '2019-01-27 01:00:35'),
(6, 2, '', 'alaminsdfd', 'alamin11@email.com', NULL, NULL, '$2y$10$dvpuwnqc86KKmwbQ8kc3/uMt4Gh0KghX.H0gJTCAYedsRuarCgh0m', NULL, NULL, NULL, NULL),
(8, 2, '', 'email@email.com', 'razu@gamil.com', NULL, NULL, '$2y$10$G5DetxBXpl12ScTCisfZfOpLypeoUI3yrvn/n5DHxbjNtcQ3iYhL2', NULL, NULL, NULL, NULL),
(9, 2, '', 'e@gmail.com', '2ait@gmail.com', NULL, NULL, '$2y$10$WaEcVYMQXThktjzur.YFpOGLzX2N2bkdDxhhficsKJ2Ee0rroybFq', NULL, 'wQ6ELqj2UKs1pBB2JAeZwjKkhsoZP0mhQ6iYXeMToKUiODoS5WBlbOgNARVx', NULL, NULL),
(16, 3, '', '2ait@gmail.com', 'alamin1sd@gmail.com', NULL, NULL, '$2y$10$gO.C1hz5uG/CLkyK5Ye63e9ZWB0OWaRA4ealKoYAAzi06Z0oRvHWW', NULL, NULL, NULL, NULL),
(18, 3, '', 'proma ', 'promasha@gmail.com', NULL, NULL, '$2y$10$K35UJoVWR4hypgN8Og/d6eFmhFxcPfe/TVgqgEgNpB/zS4eNaX5Oi', NULL, NULL, NULL, NULL),
(20, 3, '', '2ait@gmail.com', 'mohammad.sharif08@gmail.com', NULL, NULL, '$2y$10$rSGx7bmAhbX1iHo1Uukiu.bUwt8cp1jfygZts2MJheiAlM.ohC9G.', NULL, NULL, NULL, NULL),
(21, 3, '', '2ait@gmail.com', 'rupita.tahsin96@gmail.com', NULL, NULL, '$2y$10$PpSnmK9jn8LDidxWZGpPleYVsnmWKl/1J/T.832M3wna0DzIP0kHa', NULL, NULL, NULL, NULL),
(24, 2, '', 'a.t.m.muntasiir@gmail.com', 'muntasir', NULL, NULL, '$2y$10$nRdczFPYFAyZAN/EPtEFmu7dyUsf/gqxWfjCVDk37vY.I7.KwaItC', NULL, NULL, NULL, NULL),
(25, 2, '', 'shahinoor.khanam@dsce.edu.bd', 'shahinoor@gmail.com', NULL, NULL, '$2y$10$fmb.SCByDGY405eDZdUW3.vPzWhtU8Zl3QvoK7DbQclttLLs3I1IK', NULL, NULL, NULL, NULL),
(26, 3, '', '2ait@gmail.com', 'iveebaral.buet@gmail.com', NULL, NULL, '$2y$10$n5I2B5bxMTFR5KgBQGmyTuJ3uiqpB0R.4JznJrIeUPMuHlBfAkWei', NULL, NULL, NULL, NULL),
(27, 2, '', 'dsce.bd@gmail.com', 'Selim@gmail.com', NULL, NULL, '$2y$10$t6yjvjdFC1m2Gz7SHIC4Y.zry7q73gbXCo8uuZ8Q7lbQ0HC5TnSvO', NULL, NULL, NULL, NULL),
(28, 3, '', '2ait@gmail.com', 'shuvo.urp.ruet@gmail.com', NULL, NULL, '$2y$10$OcB30RRjfOwz1tHJAdzqBeUbm6Zv3RwPzAH02cUtPTgT4myBnbQgW', NULL, NULL, NULL, NULL),
(29, 3, '', '2ait@gmail.com', 'tanviremon1115009@gmail.com', NULL, NULL, '$2y$10$Kwheo9ydRgMBApK8aClbVONJRMPcRoqCtagq6gEtRGFIecM11TKvq', NULL, NULL, NULL, NULL),
(30, 3, '', '2ait@gmail.com', 'N/A', NULL, NULL, '$2y$10$JJcnDr3tBgVdrNSM/U7NLuBjbK34TShiwD.okf.Xy3t41xiqvsR9O', NULL, NULL, NULL, NULL),
(31, 3, '', '2ait@gmail.com', 'tamanna.buet12@gmail.xom', NULL, NULL, '$2y$10$io5Sw9UUcSAvNrgVlVJImO0FdkFR5Q8zexsDbA3eRvKTAVhEBk06.', NULL, NULL, NULL, NULL),
(32, 2, '', 'sultana.asha@dscebd.org', 'Sayeeda@gmail.com', NULL, NULL, '$2y$10$bmqqEWkF7Tv6sd044g59auowqiRQ76WDYKS7/8rZzSn5R/ytpAWIK', NULL, NULL, NULL, NULL),
(33, 2, '', 'mahbuba.chowdhury@dsce.edu.bd', 'mahbuba@gmail.com', NULL, NULL, '$2y$10$mg1n1EvpiwAjrtNQnTHGZui6XKV0Ta.3lG9EF710JsxUpWUwAuqdW', NULL, NULL, NULL, NULL),
(34, 2, '', 'ekramul.kabir@dsce.edu.bd', 'Ekramul@gmail.com', NULL, NULL, '$2y$10$nklM3.CAnvaw3PD4VVj0HO2tf5CtkbEdFCht/WsqRp.abNhKLQzj2', NULL, NULL, NULL, NULL),
(35, 3, '', '2ait@gmail.com', 'ahmed.hrid@gmail.com', NULL, NULL, '$2y$10$Pmk6nq69Lumd7AgXChP0teKcRgBJqW6tkNiJZPHBf8mYdhdgg0nUu', NULL, NULL, NULL, NULL),
(36, 3, '', '2ait@gmail.com', 'NA', NULL, NULL, '$2y$10$u9ioV8SjWQyYJRY40884KuGxr56L0mSQ.f2qwVltnC4PsbdMFoz1W', NULL, NULL, NULL, NULL),
(37, 3, '', 'Student', 'ishakmahmudhero@gmail.com', NULL, NULL, '$2y$10$fij4eiAAmnthADF7InL./.0Hw.iaUHvC1bTghDwfyR0Qb6HRfGqxu', NULL, NULL, NULL, NULL),
(38, 3, '', 'dsce', 'gmailney@gmail.com', NULL, NULL, '$2y$10$TJTERRVtUeKNnZn.GoI.te9pdJT1tYk0HV5u4kFWra3MkYoozg3t6', NULL, NULL, NULL, NULL),
(40, 3, '', 'DSCE', 'gmailney1@gmail.com', NULL, NULL, '$2y$10$/qttCld6SJlEEPEWaWD8AezutfLZDAwYtMoDCK.vHUonHM15ILuKK', NULL, NULL, NULL, NULL),
(41, 3, '', 'dsce', 'dlilff007@gmail.com', NULL, NULL, '$2y$10$HkdsESkXu7W.NMKnTG8naux4.UzzuZ8g24hKvqdoZNUaxkfSePBrm', NULL, NULL, NULL, NULL),
(42, 3, '', 'dsce', 'nseam06@gmail.com', NULL, NULL, '$2y$10$EEfalZcJ.MF7kNSda/JABu1vdqIrJPLZJGulNXtHhZfQkJ08OF9ei', NULL, NULL, NULL, NULL),
(43, 3, '', 'dsce', 'rifahsk@gmail.com', NULL, NULL, '$2y$10$xyxU3a2x8X8qgbSpCApMKO9TsFTPxfHSiPdpEVwiJTucpoPv2xdhC', NULL, NULL, NULL, NULL),
(44, 3, '', 'dsce', 'rahmansumaiya222@gmail.com', NULL, NULL, '$2y$10$urELzO7vBMfI8gdpWz0AO.OhmlRn8XVM7tI85hUta0n7gwkPYpXvi', NULL, NULL, NULL, NULL),
(45, 3, '', 'dsce', 'sumohbcct@gmail.com', NULL, NULL, '$2y$10$I7gtiaM2qZbTMkJK1xREKeU8v0UkGhfX0b2GCOHm7capm77eX6gvC', NULL, NULL, NULL, NULL),
(46, 3, '', 'dsce', 'mahbubtoma17@gmail.com', NULL, NULL, '$2y$10$Xns.1qmOgvQA8cgwhkIlQOGSb6xveiOG0jmdBkA04wBulaKhBF5Du', NULL, NULL, NULL, NULL),
(47, 3, '', 'dsce', 'eahmed0420@gmail.com', NULL, NULL, '$2y$10$7GPjRcr8RsgW9lwx/hjHq.kNvdKoHcKwiuwuwDUMTgs9F9Hyo68IW', NULL, NULL, NULL, NULL),
(48, 3, '', 'dsce', 'sifathossain45@gmail.com', NULL, NULL, '$2y$10$IQeb9OM1NEXxzpBAaXyR2O2Aqnm832gyn/VncDe11spqsfdr2g.Kq', NULL, NULL, NULL, NULL),
(49, 3, '', 'dsce', 'shantomr9@yahoo.com', NULL, NULL, '$2y$10$e5Yg1mDkvu2ufJKnhRhIeeTPQzuKVa3m9q1EunR4gwCEYUvQJiZK.', NULL, NULL, NULL, NULL),
(50, 3, '', 'dsce', 'rokibul.raty@gmail.com', NULL, NULL, '$2y$10$25oW.v8sb00ZNry.PCpaiOvkpOyUzTVKSk2POImzlOhWbVGNpT8Ii', NULL, NULL, NULL, NULL),
(51, 3, '', 'dsce', 'gmailnai2@gmail.com', NULL, NULL, '$2y$10$ntwm7UndgerHtP8EtZlnPO17gUmx4f4jbaZdwR/GN57/kKGHTyyEW', NULL, NULL, NULL, NULL),
(52, 3, '', 'dsce', 'sajubabu.ss@gmail.com', NULL, NULL, '$2y$10$3mzkTJV8.pl9agwR5zspQePCnNsO9az1xwqoZA.UAFg7.l57R74ba', NULL, NULL, NULL, NULL),
(53, 3, '', 'dsce', 'imranjnu3951@yahoo.com', NULL, NULL, '$2y$10$Mb4rIcr5RUP2KfzcqXGX2.hF7LleDzpl6R79.ZTYzIsoVPiAdauCK', NULL, NULL, NULL, NULL),
(54, 3, '', 'dsce', 'sarajmashiat99@gmail.com', NULL, NULL, '$2y$10$XhcifOJ1Q0xF6I08i7w47O6zvv/HbIOw859uAA3leIGtOvPxjNbYW', NULL, NULL, NULL, NULL),
(55, 3, '', 'Imtiaz', 'imtiazahmedemon551@gmail.com', NULL, NULL, '$2y$10$z7RXNjI09jTznJDswp8ewuhoZ.NA5V9VSyMGzISxvMY17sIyt4HDa', NULL, NULL, NULL, NULL),
(56, 3, '', 'TAFIZA', 'gmailnai3@gmail.com', NULL, NULL, '$2y$10$ptqCK79Kv0oolj3U5GVTlexC2F0cDpHeykaZwIPsRc1LP6EqoLy4S', NULL, NULL, NULL, NULL),
(57, 3, '', 'RAFIUL', 'sheikh14254@gmail.com', NULL, NULL, '$2y$10$dzv5T.Whqg0hn5Wp0oNhsedaI3sIdcT54HhxLboQC/.TBCHEemLm.', NULL, NULL, NULL, NULL),
(58, 3, '', 'kashif', 'mk.elahi33@gmail.com', NULL, NULL, '$2y$10$YX6coPUssyuG.ULqW9o9aeGv4EKQtZGRRmq1rVZ2dc6vBVkeTvpYe', NULL, NULL, NULL, NULL),
(59, 3, '', 'MIRAJ', 'gmc-babu@yahoo.com', NULL, NULL, '$2y$10$A.YO10V6VUuiVwkOORmZCuEalBhoG8/QOW4PXXOS63RY6DaaKGtXy', NULL, NULL, NULL, NULL),
(61, 3, '', 'Nusrat', 'gmailnai4@gmail.com', NULL, NULL, '$2y$10$lBQ4Xqf0kOwBKlDYWS92h.zmBnfW4ljdnnSSJZpAz.H4ZG4rOiOwi', NULL, NULL, NULL, NULL),
(62, 3, '', 'morshed', 'morshedrifath26@gmail.com', NULL, NULL, '$2y$10$dp4zPhXXre36.S.qzOqWfuzwSJqZ6c3baW3yBa.qHFi2goDxdiIOi', NULL, NULL, NULL, NULL),
(63, 3, '', 'Ayasha', 'gmailnai5@gmail.com', NULL, NULL, '$2y$10$uYyEQVb/KSDvztQpu466i.JzLtXG.M8AF4gXJStXrcDagHQpS3cNK', NULL, NULL, NULL, NULL),
(64, 3, '', 'academic@gmail.com', 'pial@aci-bd.com', NULL, NULL, '$2y$10$MaHFcVzIL1HMbpTV3EDK1.OiU3uShjlCW5GD7yWwkI.VB8DBKF.Ji', NULL, NULL, NULL, NULL),
(65, 3, '', 'Ripa', 'gmailnai6@gmail.com', NULL, NULL, '$2y$10$7rDg8OCtSaMbQFhB8Sspp.lX/dKYDMJIohwH.Js3Pfe10tFD1WXZi', NULL, NULL, NULL, NULL),
(66, 3, '', 'Toha', 'shafiquibrahim74@gmail.com', NULL, NULL, '$2y$10$O3OvXHE1oa3tt7EuWI6kluLFfC8LMGzVbV4uWrO.W7JGKaOn9gLeW', NULL, NULL, NULL, NULL),
(67, 3, '', 'Mahdi', 'gmailnai7@gmail.com', NULL, NULL, '$2y$10$r474oX/s847QEHCpSVeRmOMpgYhT50BBpiHEYt5decqt/7.UfuCdq', NULL, NULL, NULL, NULL),
(68, 3, '', 'saleh', 'salehu363@gmail.com', NULL, NULL, '$2y$10$7m4g8x6CRQXK9o1LT1ERqO828SMkvTv.cWMhDC4g49N0Kcznku8VO', NULL, NULL, NULL, NULL),
(69, 3, '', 'Sharmin', 'gmailnai8@gmail.com', NULL, NULL, '$2y$10$Uh.mn8OHtf4dnJhuRilgPuTGP00XDSiT0TNskEgW6opL.amB5Ar4S', NULL, NULL, NULL, NULL),
(70, 3, '', 'Junayed', 'js.jasson.junu@gmail.com', NULL, NULL, '$2y$10$pRxDemmaPCVc3s1cAXr2Wuc5FcwXsN2OIHzzqdopMhBpAH.11siUm', NULL, NULL, NULL, NULL),
(71, 3, '', 'Sadique', 'gmailnai9@gmail.com', NULL, NULL, '$2y$10$eKtkRG1nGOMTWCkVrtpOZuYWdAOLMX0blcgEGkoa7Y8Zw48xgrRyy', NULL, NULL, NULL, NULL),
(72, 3, '', 'ali', 'gmailnai10@gmail.com', NULL, NULL, '$2y$10$oA9RAxtaPbvs.oa8kfc/Oez/hT9eUyYwGhtf.4PX1DkdjJ8.NEm4G', NULL, NULL, NULL, NULL),
(73, 3, '', 'iqbal', 'iqbal2903@gmail.com', NULL, NULL, '$2y$10$VCJQ87BS.dEOxjcnuCHZZ.ZozkGvoA3PQ8rw6IPUR9v0j.l9RuyWK', NULL, NULL, NULL, NULL),
(74, 3, '', '2ait@gmail.com', 'pkdpronoy93@gmail.com', NULL, NULL, '$2y$10$t3LcOpWExJvK2uUHDWSKrO1zWyBlv6agFkdoui28lylURNJSn4BO2', NULL, NULL, NULL, NULL),
(76, 3, '', 'biplob', 'biplob032@jahoo.com', NULL, NULL, '$2y$10$pBIw6eh41yyAkj0vLj8UnujMn7tQNWNtCRxBKzesyIpqOv.3mUUwq', NULL, NULL, NULL, NULL),
(77, 3, '', 'swapon', 'scswapon1000@gmail.com', NULL, NULL, '$2y$10$btp3Qntj9DbgRl9bSnbe5.U9bNz6XEJu1Zay0hltyO81ry.D9BHwq', NULL, NULL, NULL, NULL),
(78, 2, '', 'manikuddin1980@gmail.com', 'manik@gmail.com', NULL, NULL, '$2y$10$t6XLHz3DYuo1vfJvgtO8leTFZjat0woRrBUlm0Yf/tmjk/.byXQEi', NULL, NULL, NULL, NULL),
(79, 3, '', '2ait@gmail.com', 'touhidur002@gmail.com', NULL, NULL, '$2y$10$z3JS6uN4UPW222PPOcuRyunRGf/Ri9TaZiWpzQ8EmJ6u3PvsKdeYu', NULL, NULL, NULL, NULL),
(80, 3, '', 'sahidul', 'hossain.anowar@brac.net', NULL, NULL, '$2y$10$byyzYfxPZScORvyozuDoB.G5jxzbnAhhIX7XPGv31R9r5w.XgZuC6', NULL, NULL, NULL, NULL),
(81, 2, '', 'anandamohan@gmail.com', 'ananda@gmail.com', NULL, NULL, '$2y$10$tzndGHKTQHHr/XQ6gVKAh.n2C9yqWTvhw2aFj8j5mjRLOjClEK0TS', NULL, NULL, NULL, NULL),
(82, 3, '', 'atiqur', 'gmailnai11@gmail.com', NULL, NULL, '$2y$10$BM3dYb4xNJzoAswxl3LUYuFWTkDDOHIDvbVB0cuBWHrDOo.M8cdW2', NULL, NULL, NULL, NULL),
(83, 2, '', 'abu.obaida@dscebd.org', 'obida@gmail.com', NULL, NULL, '$2y$10$hAKjQQm6b2PQkjIAi4tzbuxmuT2i81RYhf0MQMOob0H/Rh14UBSQK', NULL, NULL, NULL, NULL),
(84, 3, '', 'akhter', 'cep.org.149@gmail.com', NULL, NULL, '$2y$10$gkeI3Sa.TXVsTxJSYpWHFu.JCyRIiUMS3/Ixf7d338EyYtlfjH/.e', NULL, NULL, NULL, NULL),
(85, 3, '', '2ait@gmail.com', '‍sumitaroy.urp@gmail.com', NULL, NULL, '$2y$10$DRnWtGDt2prbqkDOlLBv8Ob60DCG35yOx4x6T8fqMVotufb1HWhju', NULL, NULL, NULL, NULL),
(86, 2, '', 'fatema.khanam@dscebd.org', 'fatema@gmail.com', NULL, NULL, '$2y$10$ZMRVpSxehuxwsTl/Giomc.M2f7HpvvHvxYAklYHC4lqJvCw1cPku.', NULL, NULL, NULL, NULL),
(87, 3, '', 'sanchoy', 'sanchoy.ranchi@gmail.com', NULL, NULL, '$2y$10$g5BH40FrDCiTI3cd27an0uC.fMCrQN7003Nt4a1MGg1FI/XMFb4pS', NULL, NULL, NULL, NULL),
(88, 2, '', 'dsce.bd@gmail.com', 'lalmoti@gmail.com', NULL, NULL, '$2y$10$j3JPZ/Qx8mxBp1WIUrIqZunxg0Dt3mWLQwzTeDRYFCf0xm0LhhvFK', NULL, NULL, NULL, NULL),
(89, 3, '', 'shah', 'rr.prolal@gmail.com', NULL, NULL, '$2y$10$LBDquYnZQ75BEWmh52..d.WcMrBPN/./UkAUmQpwOa1PPJAr36HF2', NULL, NULL, NULL, NULL),
(90, 3, '', '2ait@gmail.com', 'tasnim.59301@gmail.com', NULL, NULL, '$2y$10$ALRb11.yaLonPv7d4NHlye3OCkkG95cOzfiTuDFckpcaTb/i3ag2W', NULL, NULL, NULL, NULL),
(91, 2, '', 'dsce.bd@gmail.com', 'lalmoti', NULL, NULL, '$2y$10$Hn909PMrsXO4E5g5zOhWYOgxT0fI3sGB.9HXpSJZtxujey3707w1u', NULL, NULL, NULL, NULL),
(92, 2, '', 'dsce.bd@gmail.com', 'omor@gmail.com', NULL, NULL, '$2y$10$e2W6f4snL8gyHn9NXGXwJ.DCclAfNo6TDCWdVCPAElmeIAUQjuRqy', NULL, NULL, NULL, NULL),
(93, 3, '', 'fahmida', 'gmailnai12@gmail.com', NULL, NULL, '$2y$10$sCJT.prxVivp7ppjOxMle.c6RdnVY0uwR9ryPkI5WJ5blo//oHGDi', NULL, NULL, NULL, NULL),
(94, 3, '', 'rama', 'rama.saha88827@gmail.com', NULL, NULL, '$2y$10$qr2h.tbi.Pn/572tPXOjmOaOhXje/d7/vqRsyEoh/tXjKhHNRlEhq', NULL, NULL, NULL, NULL),
(95, 3, '', 'anindya', 'anindya.adhikary98@gmail.com', NULL, NULL, '$2y$10$krS/7HFGIDtn1COrTuqMUefWht1bYaQe4Z1QVFa4JnoOWrsz2kAEu', NULL, NULL, NULL, NULL),
(96, 3, '', 'maleeha', 'advzia@icloud.com', NULL, NULL, '$2y$10$PiYsd/rExOMmCGaetmXaTurdlTXfU25eGX.Xabgc.2mBPd05WtPVG', NULL, NULL, NULL, NULL),
(97, 3, '', 'sadaf', 'sikandar.ali.work@gmail.com', NULL, NULL, '$2y$10$j0WKncg88JUBgG70S/dlZOI.qRntQ4HZ9R13tW1/S1sB8WWISEaje', NULL, NULL, NULL, NULL),
(98, 3, '', 'Alfa', 'gmailnai13@gmail.com', NULL, NULL, '$2y$10$qy1EO85p3mlgbeWCDwroGeuPo7gy/uE4NHWU0fjjQfLKYmHLxZ8/G', NULL, NULL, NULL, NULL),
(99, 3, '', 'Farhana', 'gmailnai14@gmail.com', NULL, NULL, '$2y$10$oscHDVB0NLblvHq1dpoT5.THRiN8HKJqL1MJuoUxXnL0DfHjrXZO.', NULL, NULL, NULL, NULL),
(100, 3, '', 'atiqur', 'atiqur.mdrahman96@gmail.com', NULL, NULL, '$2y$10$ZC0j/HBAp0Z9R66u.eASjuyGHI6XbQPgPblXrnt9VleNCXoybwNyC', NULL, NULL, NULL, NULL),
(101, 2, '', 'suki.kabir@dsecbd.org', 'sdf', NULL, NULL, '$2y$10$4UCWLubc8El3DPcb3rng8.bLd9W9HARLk5K/xDnIW/ZJbeb0z6Z3O', NULL, NULL, NULL, NULL),
(102, 2, '', 'qwewqewewe@gmail.com', 'wwerewr', NULL, NULL, '$2y$10$acv.Yps8ARinKf8HiMs0quQmMGUaX7w7vmWC.aqy99HoOoBqqGcy.', NULL, NULL, NULL, NULL),
(103, 2, '', 'sti', 'sa@gmail.com', NULL, NULL, '$2y$10$7sO2Zw7P1xLwnHzP3cyYe.Q6M/QYXlA6gvEhynvAX70G.H91kPYH6', NULL, NULL, NULL, NULL),
(107, 2, '', '2abilling@gmail.com', 's@gmail.com', NULL, NULL, '$2y$10$8iNju44xIIBRMXvlEHJml.hnsLyYHQeT1yJwMl7mGm1FjoR8MBuPy', NULL, NULL, NULL, NULL),
(108, 3, '', 'asdsadsadsa', 'fakrul@gmail.com', NULL, NULL, '$2y$10$5C6jAMPlfVa.jAgs.ZjmpeYsQ3HX7.2BovSKOz3lZOS7NKgNuhnle', NULL, NULL, NULL, NULL),
(109, 3, '', 'asdsa', 'lalmoasdsadti@gmail.com', NULL, NULL, '$2y$10$unLdMC3oEUFlNmEYonhgveMa.l8vNoubWgfWzHcMQ43QZL8/uvg.W', NULL, NULL, NULL, NULL),
(110, 3, '', 'ssss', 'gmail@gmail.com', NULL, NULL, '$2y$10$.fckK1Xo.HzEMNHOP0jQkOsWT2r6oMgWIBv0I4FuK4M3U9EwVbDw2', NULL, NULL, NULL, NULL),
(111, 3, '', 'superuser@gmail.com', 'alamin-hossina@gmail.com', NULL, NULL, '$2y$10$JflvHEdjLsbqPZ67fND.aeWA4GsNK8CZE172M27fkQcTo2sNZzjQG', NULL, NULL, NULL, NULL),
(112, 3, '', 'ss', 'ssa@gmail.com', NULL, NULL, '$2y$10$j8yanRGLOhmWr8.vB3VTIubC/gLNMkYwj6Z1dWKd9VPj1MsHQdSru', NULL, NULL, NULL, NULL),
(113, 3, '', 'ddd', 'zxcxzcdf@gmail.com', NULL, NULL, '$2y$10$fwhER.zL3XkOzZBH0pbqsO6v4Y6ZBWYCQVV/KBCET.7FDkWUcJFZu', NULL, NULL, NULL, NULL),
(114, 3, '', 'ssdsdd', 'asds@gmail.com', NULL, NULL, '$2y$10$aEYLp54aHzUXBkP1Vg2n0ukKeGsD7YHvMYRwBNcGkruAHtTk3h3iS', NULL, NULL, NULL, NULL),
(116, 3, '', 'sdfds', 'dsfds@gmail.com', NULL, NULL, '$2y$10$lA0m/9CZIRornDpeoriEQuDf9IYXdPMbauc8vVPAp.PQDNVzTqplu', NULL, NULL, NULL, NULL),
(117, 2, '', 'qwe', '2aitoqqqqqqqqqqqwn@gmail.com', NULL, NULL, '$2y$10$BPG5u.COlbrP8rL6/kQV..fqUUJfkvgmxojhldLf587kyLWEpJ4Iy', NULL, NULL, NULL, NULL),
(118, 2, '', 'a', 'a@gmail.com', NULL, NULL, '$2y$10$iaQqbBzCE0OWuGQFLWmlZurumrg2HVVaAT7lEPIBGtGlK8NRPqdCa', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, NULL, NULL, NULL),
(2, 'Employee', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yearly_expenses`
--

CREATE TABLE `yearly_expenses` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `bank_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `pay_type` int(11) NOT NULL,
  `expense_type` int(11) NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `year_exp_types`
--

CREATE TABLE `year_exp_types` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjunic_teachers`
--
ALTER TABLE `adjunic_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_payments`
--
ALTER TABLE `admission_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_details_id`);

--
-- Indexes for table `bank_opn__blances`
--
ALTER TABLE `bank_opn__blances`
  ADD PRIMARY KEY (`open_bal_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`bidget_id`);

--
-- Indexes for table `budget_logs`
--
ALTER TABLE `budget_logs`
  ADD PRIMARY KEY (`bdgtlog_id`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depreciations`
--
ALTER TABLE `depreciations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_dep_id_foreign` (`dep_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeloans`
--
ALTER TABLE `employeloans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experince`
--
ALTER TABLE `experince`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoexpenses`
--
ALTER TABLE `incoexpenses`
  ADD PRIMARY KEY (`incoexpenses_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_cats`
--
ALTER TABLE `income_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_types`
--
ALTER TABLE `income_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indirect_expenses`
--
ALTER TABLE `indirect_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indirect_expense_types`
--
ALTER TABLE `indirect_expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorycatagories`
--
ALTER TABLE `inventorycatagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorysucategories`
--
ALTER TABLE `inventorysucategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khats`
--
ALTER TABLE `khats`
  ADD PRIMARY KEY (`khat_id`);

--
-- Indexes for table `khattypes`
--
ALTER TABLE `khattypes`
  ADD PRIMARY KEY (`khat_id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_billings`
--
ALTER TABLE `master_billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `product_distributions`
--
ALTER TABLE `product_distributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaryprogresses`
--
ALTER TABLE `salaryprogresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_bills`
--
ALTER TABLE `std_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_bill_types`
--
ALTER TABLE `std_bill_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_pay_ins`
--
ALTER TABLE `std_pay_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`sub_menu_id`),
  ADD KEY `sub_menus_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_relation`
--
ALTER TABLE `table_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_types`
--
ALTER TABLE `tax_types`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tax_type_types`
--
ALTER TABLE `tax_type_types`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `trx_records`
--
ALTER TABLE `trx_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `yearly_expenses`
--
ALTER TABLE `yearly_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year_exp_types`
--
ALTER TABLE `year_exp_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjunic_teachers`
--
ALTER TABLE `adjunic_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_payments`
--
ALTER TABLE `admission_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_details_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bank_opn__blances`
--
ALTER TABLE `bank_opn__blances`
  MODIFY `open_bal_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `bidget_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `budget_logs`
--
ALTER TABLE `budget_logs`
  MODIFY `bdgtlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `depreciations`
--
ALTER TABLE `depreciations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employeloans`
--
ALTER TABLE `employeloans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `experince`
--
ALTER TABLE `experince`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `incoexpenses`
--
ALTER TABLE `incoexpenses`
  MODIFY `incoexpenses_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `income_cats`
--
ALTER TABLE `income_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `income_types`
--
ALTER TABLE `income_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `indirect_expenses`
--
ALTER TABLE `indirect_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `indirect_expense_types`
--
ALTER TABLE `indirect_expense_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inventorycatagories`
--
ALTER TABLE `inventorycatagories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventorysucategories`
--
ALTER TABLE `inventorysucategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `khats`
--
ALTER TABLE `khats`
  MODIFY `khat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `khattypes`
--
ALTER TABLE `khattypes`
  MODIFY `khat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_billings`
--
ALTER TABLE `master_billings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_distributions`
--
ALTER TABLE `product_distributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salaryprogresses`
--
ALTER TABLE `salaryprogresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_bills`
--
ALTER TABLE `std_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_bill_types`
--
ALTER TABLE `std_bill_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_pay_ins`
--
ALTER TABLE `std_pay_ins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sub_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_relation`
--
ALTER TABLE `table_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tax_types`
--
ALTER TABLE `tax_types`
  MODIFY `tax_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tax_type_types`
--
ALTER TABLE `tax_type_types`
  MODIFY `tax_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trx_records`
--
ALTER TABLE `trx_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yearly_expenses`
--
ALTER TABLE `yearly_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `year_exp_types`
--
ALTER TABLE `year_exp_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_dep_id_foreign` FOREIGN KEY (`dep_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
