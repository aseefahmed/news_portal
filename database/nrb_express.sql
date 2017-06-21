-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2017 at 09:55 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nrb_express`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no_home` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no_work` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `dob_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maritial_status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id_number_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `address_verification_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `references` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `experiences` text COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `first_name`, `last_name`, `father_name`, `mother_name`, `contact_no_home`, `contact_no_work`, `contact_no_other`, `email`, `gender`, `dob`, `dob_doc`, `religion`, `maritial_status`, `nationality`, `national_id_number`, `national_id_number_doc`, `blood_group`, `address_verification_doc`, `picture`, `cv`, `references`, `experiences`, `comments`, `created_at`, `updated_at`, `present_address`, `permanent_address`) VALUES
(222, 'as', '', '', '', '', '', '', '', '?', '0000-00-00', '', '? undefined:undefined ?', '', '', '', '', '? un', '', '', '', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}', '', '', '2017-03-04 06:48:29', '2017-03-04 06:48:29', 'a:5:{s:6:"street";s:0:"";s:4:"town";s:0:"";s:8:"district";s:0:"";s:9:"post_code";s:0:"";s:7:"country";s:0:"";}', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}'),
(223, 'aseef', 'ahmed', 'xxx', 'yyy', '', '', '', 'aseefahmed@gmail.com', 'M', '2017-03-08', '', 'Cristian', '3', 'Bangladesh', '323232332332', '', 'B+', '', '', '', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}', '', '', '2017-03-04 06:49:23', '2017-03-04 06:49:23', 'a:5:{s:6:"street";s:0:"";s:4:"town";s:0:"";s:8:"district";s:0:"";s:9:"post_code";s:0:"";s:7:"country";s:0:"";}', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}'),
(224, 'aseef', 'ahmed', 'xxx', 'yyy', '', '', '', 'aseef', 'M', '0000-00-00', '', 'Cristian', '3', 'Bangladesh', '323232332332', '', 'B+', '', '', '', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}', '', '', '2017-03-04 06:49:24', '2017-03-04 06:49:24', 'a:5:{s:6:"street";s:0:"";s:4:"town";s:0:"";s:8:"district";s:0:"";s:9:"post_code";s:0:"";s:7:"country";s:0:"";}', 'a:4:{s:5:"thana";s:0:"";s:11:"post_office";s:0:"";s:7:"village";s:0:"";s:8:"district";s:0:"";}');

-- --------------------------------------------------------

--
-- Table structure for table `courier_locations`
--

CREATE TABLE `courier_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courier_locations`
--

INSERT INTO `courier_locations` (`id`, `location_id`, `courier_id`, `created_at`, `updated_at`) VALUES
(21, 2, 222, '2017-03-06 06:54:35', '2017-03-06 06:54:35'),
(22, 2, 223, '2017-03-06 06:54:39', '2017-03-06 06:54:39'),
(23, 3, 222, '2017-03-06 06:55:30', '2017-03-06 06:55:30'),
(24, 3, 223, '2017-03-06 06:55:45', '2017-03-06 06:55:45'),
(25, 3, 224, '2017-03-06 06:55:55', '2017-03-06 06:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_type`, `name`, `email`, `password`, `verification_code`, `remember_token`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(33, '3', 'aseef', 'asee11fahmed@gmail.com', '$2y$10$FN4J3B7pDnOAE/K3Gk5HZeP3TRZYEMpTROcwPvfex765ZEHV6meqS', '', '', '1', 0, '2017-03-01 04:33:18', '2017-03-01 04:33:18'),
(37, '2', 'Roni', 's3aeef1@gmail.com', '$2y$10$xKMyD84FglQ44DJ7sFaYZOc8u4wkW./PyrEMcWzNp2C5ZwDUox7za', '', '', '1', 0, '2017-03-04 02:40:26', '2017-03-04 02:40:26'),
(39, '1', 'tareq', 's13aeef11@gmail.com', '$2y$10$nXFEvvzXs.KQaR80DNTg8ePwaKrhaGMiInOHNU4UnSHFt65W3JMMy', '', '', '1', 0, '2017-03-04 03:04:14', '2017-03-04 03:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `cycles`
--

CREATE TABLE `cycles` (
  `id` int(10) UNSIGNED NOT NULL,
  `bicycle_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courier_id` int(11) NOT NULL,
  `given_date` date NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cycles`
--

INSERT INTO `cycles` (`id`, `bicycle_number`, `courier_id`, `given_date`, `comments`, `created_at`, `updated_at`) VALUES
(12, '1', 222, '0000-00-00', '', '2017-03-07 02:42:47', '2017-03-07 02:42:47'),
(13, '2', 223, '0000-00-00', '', '2017-03-07 02:42:52', '2017-03-07 02:42:52'),
(14, '4', 224, '0000-00-00', '', '2017-03-07 02:42:56', '2017-03-07 02:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', NULL, NULL),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', NULL, NULL),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', NULL, NULL),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', NULL, NULL),
(5, 3, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd', NULL, NULL),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', NULL, NULL),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd', NULL, NULL),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd', NULL, NULL),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd', NULL, NULL),
(10, 3, 'Mymensingh', 'ময়মনসিং', 0, 0, 'www.mymensingh.gov.bd', NULL, NULL),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', NULL, NULL),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd', NULL, NULL),
(13, 3, 'Netrokona', 'নেত্রকোনা', 24.870955, 90.727887, 'www.netrokona.gov.bd', NULL, NULL),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', NULL, NULL),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd', NULL, NULL),
(16, 3, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', NULL, NULL),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd', NULL, NULL),
(18, 5, 'Bogra', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd', NULL, NULL),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd', NULL, NULL),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd', NULL, NULL),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd', NULL, NULL),
(22, 5, 'Nawabganj', 'নবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', NULL, NULL),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd', NULL, NULL),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd', NULL, NULL),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', NULL, NULL),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', NULL, NULL),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd', NULL, NULL),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd', NULL, NULL),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd', NULL, NULL),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd', NULL, NULL),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', NULL, NULL),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd', NULL, NULL),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', NULL, NULL),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd', NULL, NULL),
(35, 1, 'Barisal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd', NULL, NULL),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd', NULL, NULL),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd', NULL, NULL),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', NULL, NULL),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd', NULL, NULL),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', NULL, NULL),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', NULL, NULL),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', NULL, NULL),
(43, 2, 'Chittagong', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd', NULL, NULL),
(44, 2, 'Comilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd', NULL, NULL),
(45, 2, 'Cox''s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd', NULL, NULL),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd', NULL, NULL),
(47, 2, 'Khagrachari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', NULL, NULL),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', NULL, NULL),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd', NULL, NULL),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd', NULL, NULL),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd', NULL, NULL),
(52, 7, 'Maulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', NULL, NULL),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', NULL, NULL),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', NULL, NULL),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd', NULL, NULL),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', NULL, NULL),
(57, 4, 'Jessore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd', NULL, NULL),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', NULL, NULL),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd', NULL, NULL),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd', NULL, NULL),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd', NULL, NULL),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd', NULL, NULL),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd', NULL, NULL),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 'Barisal', 'বরিশাল', NULL, NULL),
(2, 'Chittagong', 'চট্টগ্রাম', NULL, NULL),
(3, 'Dhaka', 'ঢাকা', NULL, NULL),
(4, 'Khulna', 'খুলনা', NULL, NULL),
(5, 'Rajshahi', 'রাজশাহী', NULL, NULL),
(6, 'Rangpur', 'রংপুর', NULL, NULL),
(7, 'Sylhet', 'সিলেট', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doc_types`
--

CREATE TABLE `doc_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `doc_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doc_types`
--

INSERT INTO `doc_types` (`id`, `doc_type`, `created_at`, `updated_at`) VALUES
(1, 'Accounting Documents ', NULL, NULL),
(2, 'Analysis Reports ', NULL, NULL),
(3, 'Applications (Completed) ', NULL, NULL),
(4, 'Bank Statements ', NULL, NULL),
(5, 'Bid Quotations ', NULL, NULL),
(6, 'Bills of Sale ', NULL, NULL),
(7, 'Birth Certificates ', NULL, NULL),
(8, 'Bonds ', NULL, NULL),
(9, 'Checks (Completed) ', NULL, NULL),
(10, 'Claim Files ', NULL, NULL),
(11, 'Closing Statements ', NULL, NULL),
(12, 'Conference Reports ', NULL, NULL),
(13, 'Contracts ', NULL, NULL),
(14, 'Cost Estimates ', NULL, NULL),
(15, 'Court Transcripts ', NULL, NULL),
(16, 'Credit Applications ', NULL, NULL),
(17, 'Data Sheets ', NULL, NULL),
(18, 'Deeds ', NULL, NULL),
(19, 'Employment Papers ', NULL, NULL),
(20, 'Escrow Instructions ', NULL, NULL),
(21, 'Export Papers ', NULL, NULL),
(22, 'Financial Statements ', NULL, NULL),
(23, 'Immigration Papers ', NULL, NULL),
(24, 'Income Statements ', NULL, NULL),
(25, 'Insurance Documents ', NULL, NULL),
(26, 'Interoffice Memos ', NULL, NULL),
(27, 'Inventory Reports ', NULL, NULL),
(28, 'Invoices (Completed) ', NULL, NULL),
(29, 'Leases ', NULL, NULL),
(30, 'Legal Documents ', NULL, NULL),
(31, 'Letter of Credit Packets ', NULL, NULL),
(32, 'Letters and Cards ', NULL, NULL),
(33, 'Loan Documents ', NULL, NULL),
(34, 'Marriage Certificates ', NULL, NULL),
(35, 'Medical Records ', NULL, NULL),
(36, 'Office Records ', NULL, NULL),
(37, 'Operating Agreements ', NULL, NULL),
(38, 'Patent Applications ', NULL, NULL),
(39, 'Permits ', NULL, NULL),
(40, 'Photocopies ', NULL, NULL),
(41, 'Proposals ', NULL, NULL),
(42, 'Prospectuses ', NULL, NULL),
(43, 'Purchase Orders ', NULL, NULL),
(44, 'Quotations ', NULL, NULL),
(45, 'Reservation Confirmation ', NULL, NULL),
(46, 'Resumes ', NULL, NULL),
(47, 'Sales Agreements ', NULL, NULL),
(48, 'Sales Reports ', NULL, NULL),
(49, 'Shipping Documents ', NULL, NULL),
(50, 'Statements/Reports ', NULL, NULL),
(51, 'Statistical Data ', NULL, NULL),
(52, 'Stock Information ', NULL, NULL),
(53, 'Tax Papers ', NULL, NULL),
(54, 'Trade Confirmation ', NULL, NULL),
(55, 'Transcripts ', NULL, NULL),
(56, 'Warranty Deeds ', NULL, NULL),
(58, 'Your document description', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flag` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '0=deleted, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `created_at`, `updated_at`, `address`, `contact_name`, `contact_number`, `flag`) VALUES
(1, 'dhaka', '2017-02-14 03:02:20', '2017-02-14 03:02:20', '', '', '', '0'),
(2, 'gulshan', '2017-02-26 02:44:54', '2017-02-26 02:44:54', '1', '2', '3', '1'),
(3, 'Hatirjhil', '2017-02-28 04:39:01', '2017-02-28 04:39:01', '', '', '', '1'),
(4, 'Banani', '2017-02-28 05:46:55', '2017-02-28 05:46:55', '', '', '', '0'),
(5, 'Mirpur', '2017-02-28 05:47:02', '2017-02-28 05:47:02', '', '', '', '1'),
(6, 'Dhanmondi', '2017-02-28 05:47:08', '2017-02-28 05:47:08', '', '', '', ''),
(7, 'xxx', '2017-03-04 03:28:44', '2017-03-04 03:28:44', '', '', '', ''),
(8, '111x', '2017-03-04 03:34:11', '2017-03-04 03:34:11', '111x', '333x', '4444x', ''),
(9, 'Banani', '2017-03-04 03:39:18', '2017-03-04 03:39:18', 'Banani', 'Tareq', '3532151', ''),
(10, '3232', '2017-03-04 03:39:54', '2017-03-04 03:39:54', '3232', '32', '3223', ''),
(11, 'xxx', '2017-03-06 07:10:36', '2017-03-06 07:10:36', 'xxx', '', '', '1'),
(12, '222', '2017-03-06 07:14:20', '2017-03-06 07:14:20', '222', '', '', '1'),
(13, '223323232', '2017-03-06 07:14:31', '2017-03-06 07:14:31', '223323232', '', '', '1'),
(14, '323', '2017-03-06 07:15:35', '2017-03-06 07:15:35', '323', '', '', '1'),
(15, '3233232', '2017-03-06 07:15:47', '2017-03-06 07:15:47', '3233232', '', '', '1'),
(16, '32', '2017-03-06 07:20:28', '2017-03-06 07:20:28', '32', '3232', '323223', '1'),
(17, 'b', '2017-03-06 07:20:37', '2017-03-06 07:20:37', 'b', 'b', 'b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_01_03_061435_create_table_countries', 2),
('2017_01_03_061457_create_table_cities', 2),
('2017_01_04_124450_entrust_setup_tables', 3),
('2017_01_18_043020_create_table_order', 4),
('2017_01_18_051125_alter_table_orders22', 5),
('2017_01_18_094139_alter_table_orders2222', 6),
('2017_01_23_070700_create_table_courier', 7),
('2017_01_23_071730_alter_table_orders_432', 8),
('2017_01_23_101335_alter_table_couriers_423', 9),
('2017_01_23_101642_alter_table_couriers_4231', 10),
('2017_01_24_083651_alter_table_orders_333', 11),
('2017_01_24_084232_alter_table_orders_333333213', 12),
('2017_01_24_084923_alter_table_orders_45', 13),
('2017_01_24_085134_alter_table_orders_145', 14),
('2017_01_24_085227_alter_table_orders_1451', 15),
('2017_01_24_085417_alter_table_orders_12451', 16),
('2017_01_31_095138_create_table_location', 17),
('2017_01_31_110716_create_table_courier_location', 17),
('2017_02_05_114532_alter_table_users_4342', 18),
('2017_02_05_114858_alter_table_users_43', 19),
('2017_02_06_101822_create_table_routes', 20),
('2017_02_06_104143_create_table_districts_11', 21),
('2017_02_06_104156_create_table_divisions_11', 21),
('2017_02_14_105851_create_table_price_charts', 22),
('2017_02_15_101157_alter_table_routes', 23),
('2017_02_15_101415_alter_table_routes21', 24),
('2017_02_16_064549_alter_table_orders', 25),
('2017_02_16_080955_create_table_customer', 26),
('2017_02_16_082150_alter_table_price_charts_32', 27),
('2017_02_19_111058_create_table_shipment_purposes', 28),
('2017_02_19_111206_create_table_doc_types', 28),
('2017_02_19_114032_alter_tables_orders_435', 29),
('2017_02_26_050208_alter_table_price_charts', 30),
('2017_02_26_053153_alter_table_orders_21432', 31),
('2017_02_26_111115_create_table_upazilla', 32),
('2017_02_28_091929_alter_table_orders_43554', 33),
('2017_02_28_092517_alter_table_orders_4123554', 34),
('2017_02_28_123952_alter_table_orders23_432', 35),
('2017_03_02_083434_alter_table_orders32', 36),
('2017_03_04_093001_alter_table_locations_344d', 37),
('2017_03_04_102130_alter_table_locations_32344d', 38),
('2017_03_05_083115_alter_table_orders_34221', 39),
('2017_03_06_130336_create_table_cycles', 40);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pickup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shipment_info` text COLLATE utf8_unicode_ci NOT NULL,
  `sender_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reciever_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL,
  `generated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sender_district` int(11) NOT NULL,
  `receiver_district` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `sender_upazilla` int(11) NOT NULL,
  `receiver_upazilla` int(11) NOT NULL,
  `assigned_courier` int(11) NOT NULL,
  `tracking_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipment_item_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `sender_phone`, `sender_address_1`, `sender_city`, `sender_state`, `sender_zipcode`, `sender_country`, `reciever_name`, `reciever_email`, `reciever_phone`, `reciever_address_1`, `reciever_city`, `reciever_state`, `reciever_zipcode`, `reciever_country`, `pickup_date`, `shipment_info`, `sender_street`, `reciever_street`, `flag`, `generated_by`, `created_at`, `updated_at`, `sender_district`, `receiver_district`, `payment_method`, `price`, `sender_upazilla`, `receiver_upazilla`, `assigned_courier`, `tracking_id`, `shipment_item_type`) VALUES
(179, 33, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:36:08', 'N;', 'Farmgate', '', 0, 0, '2017-03-06 05:31:53', '2017-03-06 05:31:53', 1, 8, 'Cash on Delivery', 40, 145, 197, 0, '148879991358bd48a9d46cd', 'document'),
(180, 33, '', '', '', '', '', '', 'Rabbi', '', '', '', '', '', '', '', '2017-03-06 11:59:13', 'a:1:{i:0;a:6:{i:0;s:21:"Accounting Documents ";i:1;s:21:"Accounting Documents ";i:2;s:1:"0";i:3;s:1:"1";i:4;s:21:"Accounting Documents ";i:5;s:21:"Accounting Documents ";}}', 'Banani', 'Bogra', 0, 0, '2017-03-06 05:32:28', '2017-03-06 05:32:28', 1, 2, 'Cash on Delivery', 20, 148, 151, 0, '148879994858bd48cc630a8', 'document'),
(181, 33, '', '', '', '', '', '', 'Rabbi', '', '', '', '', '', '', '', '2017-03-06 11:59:00', 'N;', 'gulshan', 'Chittagong', 0, 0, '2017-03-06 05:35:17', '2017-03-06 05:35:17', 3, 2, 'Cash on Delivery', 0, 161, 153, 0, '148880011758bd4975de45a', '0'),
(182, 33, '', '', '', '', '', '', 'Rabbi', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N;', 'Niketon', '', 0, 0, '2017-03-06 05:36:41', '2017-03-06 05:36:41', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880020158bd49c9d0a7a', '0'),
(183, 37, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:52', 'N;', 'Savar8', '', 0, 0, '2017-03-06 05:36:55', '2017-03-06 05:36:55', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880021558bd49d7910df', '0'),
(184, 37, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:49', 'N;', 'Savar7', '', 0, 0, '2017-03-06 05:36:56', '2017-03-06 05:36:56', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880021658bd49d86b98e', '0'),
(185, 39, '', '', '', '', '', '', 'Rabbi', '', '', '', '', '', '', '', '2017-03-06 11:49:37', 'N;', 'Savar6', '', 0, 0, '2017-03-06 05:37:08', '2017-03-06 05:37:08', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022858bd49e4558b9', '0'),
(186, 37, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:44', 'N;', 'Savar5', '', 0, 0, '2017-03-06 05:37:08', '2017-03-06 05:37:08', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022858bd49e47d72e', '0'),
(187, 37, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:42', 'N;', 'Savar4', '', 0, 0, '2017-03-06 05:37:08', '2017-03-06 05:37:08', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022858bd49e4a22e8', '0'),
(188, 33, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:41', 'N;', 'Savar3', '', 0, 0, '2017-03-06 05:37:08', '2017-03-06 05:37:08', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022858bd49e4cb643', '0'),
(189, 39, '', '', '', '', '', '', 'Rabbi', '', '', '', '', '', '', '', '2017-03-06 11:59:10', 'N;', 'Savar2', 'Rajshahi', 0, 0, '2017-03-06 05:37:09', '2017-03-06 05:37:09', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022958bd49e517b4d', '0'),
(190, 33, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-06 11:38:36', 'N;', 'Savar1', '', 0, 0, '2017-03-06 05:37:09', '2017-03-06 05:37:09', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880022958bd49e5456eb', '0'),
(191, 39, '', '', '', '', '', '', 'Saeef', '', '', '', '', '', '', '', '2017-03-06 12:00:20', 'N;', 'Savar6qqq', 'USA', 0, 0, '2017-03-06 05:39:19', '2017-03-06 05:39:19', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880035958bd4a67258d7', '0'),
(192, 0, '', '', '', '', '', '', 'Saeef', '', '', '', '', '', '', '', '2017-03-06 12:00:11', 'N;', 'Savar2', 'London', 0, 0, '2017-03-06 05:39:36', '2017-03-06 05:39:36', 0, 0, 'Cash on Delivery', 0, 0, 0, 0, '148880037658bd4a78b2318', '0');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'create_user', 'Create User', '', '2017-01-06 20:34:43', '2017-01-06 20:34:43'),
(11, 'delete_user', 'Delete User', '', '2017-01-06 20:35:01', '2017-01-06 20:35:01'),
(12, 'edit_user', 'Edit User', '', '2017-01-06 20:35:16', '2017-01-06 20:35:16'),
(13, 'create_post', 'Add Post', '', '2017-01-06 20:42:48', '2017-01-06 20:42:48'),
(14, 'make_comments', 'Make Comments', '', '2017-01-06 20:43:11', '2017-01-06 20:43:11'),
(15, 'Delete all', 'delelteall', 'df', '2017-02-05 05:58:20', '2017-02-05 05:58:20'),
(16, 'Change Order Status', 'change-order-status', '', '2017-03-02 04:38:52', '2017-03-02 04:38:52'),
(17, 'modify-order', 'Modify Order', '', '2017-03-02 04:39:35', '2017-03-02 04:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(17, 16);

-- --------------------------------------------------------

--
-- Table structure for table `price_charts`
--

CREATE TABLE `price_charts` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(11) NOT NULL,
  `delivery_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_details` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price_charts`
--

INSERT INTO `price_charts` (`id`, `route_id`, `delivery_type`, `price_details`, `created_at`, `updated_at`, `weight`) VALUES
(30, 12, 'regular', '{"route_id":"12","delivery_type":"regular","hr8":"","hr12":"","hr24":"10","hr48":"5","hr120":"2","weight":"6"}', '2017-02-19 01:03:31', '2017-02-19 01:03:31', 6),
(31, 12, 'regular', '{"route_id":"12","delivery_type":"regular","hr8":"","hr12":"","hr24":"20","hr48":"10","hr120":"9","weight":"2"}', '2017-02-19 02:08:21', '2017-02-19 02:08:21', 2),
(32, 12, 'regular', '{"route_id":"12","delivery_type":"regular","hr8":"","hr12":"","hr24":"30","hr48":"15","hr120":"13","weight":"3"}', '2017-02-19 02:08:37', '2017-02-19 02:08:37', 3),
(33, 12, 'express', '{"route_id":"12","delivery_type":"express","hr8":"90","hr12":"80","hr24":"","hr48":"","hr120":"","weight":"1"}', '2017-02-19 02:08:55', '2017-02-19 02:08:55', 1),
(34, 12, 'express', '{"route_id":"12","delivery_type":"express","hr8":"100","hr12":"90","hr24":"","hr48":"","hr120":"","weight":"2"}', '2017-02-19 02:09:09', '2017-02-19 02:09:09', 2),
(35, 12, 'express', '{"route_id":"12","delivery_type":"express","hr8":"400","hr12":"120","hr24":"","hr48":"","hr120":"","weight":"3"}', '2017-02-19 02:09:21', '2017-02-19 02:09:21', 3),
(36, 14, '', '{"_token":"HVgf472Lkyy0LdfNpkOV0iffThBOlnjupU1l3mHG","route_id":"14","delivery_type":"","hr8":"","hr12":"","hr24":"","hr48":"","hr120":"","weight":""}', '2017-02-26 03:00:38', '2017-02-26 03:00:38', 0),
(37, 14, 'regular', '{"_token":"HVgf472Lkyy0LdfNpkOV0iffThBOlnjupU1l3mHG","route_id":"14","delivery_type":"regular","hr8":"","hr12":"","hr24":"2","hr48":"2","hr120":"2","weight":"2"}', '2017-02-26 03:00:55', '2017-02-26 03:00:55', 0),
(38, 14, 'regular', '{"_token":"HVgf472Lkyy0LdfNpkOV0iffThBOlnjupU1l3mHG","route_id":"14","delivery_type":"regular","hr8":"","hr12":"","hr24":"1","hr48":"2","hr120":"3","weight":"21"}', '2017-02-26 03:01:09', '2017-02-26 03:01:09', 0),
(39, 12, 'regular', '{"_token":"ckkbbeXksohBCu1JwUoV50kmLArm5Q81UDPS5SJV","route_id":"12","delivery_type":"regular","hr8":"","hr12":"","hr24":"11","hr48":"","hr120":"","weight":""}', '2017-03-04 06:52:44', '2017-03-04 06:52:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'owner', NULL, NULL, '2017-01-06 20:00:09', '2017-01-06 20:00:09'),
(11, 'admin', NULL, NULL, NULL, NULL),
(12, 'accounts', NULL, NULL, NULL, NULL),
(13, '233', NULL, NULL, '2017-02-05 05:57:46', '2017-02-05 05:57:46'),
(14, 'customer', NULL, NULL, '2017-02-05 05:57:57', '2017-02-05 05:57:57'),
(15, 'Change Order Status', NULL, NULL, '2017-03-02 04:37:29', '2017-03-02 04:37:29'),
(16, 'Moderator', NULL, NULL, '2017-03-02 04:38:03', '2017-03-02 04:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `form` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `form`, `to`, `created_at`, `updated_at`, `from`) VALUES
(12, '', '1', '2017-02-19 01:02:58', '2017-02-19 01:02:58', '1'),
(13, '', '6', '2017-02-26 02:52:26', '2017-02-26 02:52:26', '1'),
(14, '', '15', '2017-02-26 02:52:42', '2017-02-26 02:52:42', '5'),
(15, '', '1', '2017-03-04 06:51:50', '2017-03-04 06:51:50', '1'),
(16, '', '17', '2017-03-04 06:52:02', '2017-03-04 06:52:02', '16');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_purposes`
--

CREATE TABLE `shipment_purposes` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipment_purposes`
--

INSERT INTO `shipment_purposes` (`id`, `purpose`, `created_at`, `updated_at`) VALUES
(1, 'Commercial', NULL, NULL),
(2, 'Government', NULL, NULL),
(3, 'Gift', NULL, NULL),
(4, 'Sample', NULL, NULL),
(5, 'Return and Repair', NULL, NULL),
(6, 'Personal Effects', NULL, NULL),
(7, 'Personal Use', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upazillas`
--

CREATE TABLE `upazillas` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bn_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upazillas`
--

INSERT INTO `upazillas` (`id`, `district_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 34, 'Amtali Upazila', 'আমতলী', NULL, NULL),
(2, 34, 'Bamna Upazila', 'বামনা', NULL, NULL),
(3, 34, 'Barguna Sadar Upazila', 'বরগুনা সদর', NULL, NULL),
(4, 34, 'Betagi Upazila', 'বেতাগি', NULL, NULL),
(5, 34, 'Patharghata Upazila', 'পাথরঘাটা', NULL, NULL),
(6, 34, 'Taltali Upazila', 'তালতলী', NULL, NULL),
(7, 35, 'Muladi Upazila', 'মুলাদি', NULL, NULL),
(8, 35, 'Babuganj Upazila', 'বাবুগঞ্জ', NULL, NULL),
(9, 35, 'Agailjhara Upazila', 'আগাইলঝরা', NULL, NULL),
(10, 35, 'Barisal Sadar Upazila', 'বরিশাল সদর', NULL, NULL),
(11, 35, 'Bakerganj Upazila', 'বাকেরগঞ্জ', NULL, NULL),
(12, 35, 'Banaripara Upazila', 'বানাড়িপারা', NULL, NULL),
(13, 35, 'Gaurnadi Upazila', 'গৌরনদী', NULL, NULL),
(14, 35, 'Hizla Upazila', 'হিজলা', NULL, NULL),
(15, 35, 'Mehendiganj Upazila', 'মেহেদিগঞ্জ ', NULL, NULL),
(16, 35, 'Wazirpur Upazila', 'ওয়াজিরপুর', NULL, NULL),
(17, 36, 'Bhola Sadar Upazila', 'ভোলা সদর', NULL, NULL),
(18, 36, 'Burhanuddin Upazila', 'বুরহানউদ্দিন', NULL, NULL),
(19, 36, 'Char Fasson Upazila', 'চর ফ্যাশন', NULL, NULL),
(20, 36, 'Daulatkhan Upazila', 'দৌলতখান', NULL, NULL),
(21, 36, 'Lalmohan Upazila', 'লালমোহন', NULL, NULL),
(22, 36, 'Manpura Upazila', 'মনপুরা', NULL, NULL),
(23, 36, 'Tazumuddin Upazila', 'তাজুমুদ্দিন', NULL, NULL),
(24, 37, 'Jhalokati Sadar Upazila', 'ঝালকাঠি সদর', NULL, NULL),
(25, 37, 'Kathalia Upazila', 'কাঁঠালিয়া', NULL, NULL),
(26, 37, 'Nalchity Upazila', 'নালচিতি', NULL, NULL),
(27, 37, 'Rajapur Upazila', 'রাজাপুর', NULL, NULL),
(28, 38, 'Bauphal Upazila', 'বাউফল', NULL, NULL),
(29, 38, 'Dashmina Upazila', 'দশমিনা', NULL, NULL),
(30, 38, 'Galachipa Upazila', 'গলাচিপা', NULL, NULL),
(31, 38, 'Kalapara Upazila', 'কালাপারা', NULL, NULL),
(32, 38, 'Mirzaganj Upazila', 'মির্জাগঞ্জ ', NULL, NULL),
(33, 38, 'Patuakhali Sadar Upazila', 'পটুয়াখালী সদর', NULL, NULL),
(34, 38, 'Dumki Upazila', 'ডুমকি', NULL, NULL),
(35, 38, 'Rangabali Upazila', 'রাঙ্গাবালি', NULL, NULL),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া', NULL, NULL),
(37, 39, 'Kaukhali', 'কাউখালি', NULL, NULL),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', NULL, NULL),
(39, 39, 'Nazirpur', 'নাজিরপুর', NULL, NULL),
(40, 39, 'Nesarabad', 'নেসারাবাদ', NULL, NULL),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', NULL, NULL),
(42, 39, 'Zianagar', 'জিয়ানগর', NULL, NULL),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', NULL, NULL),
(44, 40, 'Thanchi', 'থানচি', NULL, NULL),
(45, 40, 'Lama', 'লামা', NULL, NULL),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', NULL, NULL),
(47, 40, 'Ali kadam', 'আলী কদম', NULL, NULL),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', NULL, NULL),
(49, 40, 'Ruma', 'রুমা', NULL, NULL),
(50, 41, 'Brahmanbaria Sadar Upazila', 'ব্রাহ্মণবাড়িয়া সদর', NULL, NULL),
(51, 41, 'Ashuganj Upazila', 'আশুগঞ্জ', NULL, NULL),
(52, 41, 'Nasirnagar Upazila', 'নাসির নগর', NULL, NULL),
(53, 41, 'Nabinagar Upazila', 'নবীনগর', NULL, NULL),
(54, 41, 'Sarail Upazila', 'সরাইল', NULL, NULL),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', NULL, NULL),
(56, 41, 'Kasba Upazila', 'কসবা', NULL, NULL),
(57, 41, 'Akhaura Upazila', 'আখাউরা', NULL, NULL),
(58, 41, 'Bancharampur Upazila', 'বাঞ্ছারামপুর', NULL, NULL),
(59, 41, 'Bijoynagar Upazila', 'বিজয় নগর', NULL, NULL),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', NULL, NULL),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ', NULL, NULL),
(62, 42, 'Haimchar', 'হাইমচর', NULL, NULL),
(63, 42, 'Haziganj', 'হাজীগঞ্জ', NULL, NULL),
(64, 42, 'Kachua', 'কচুয়া', NULL, NULL),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর', NULL, NULL),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', NULL, NULL),
(67, 42, 'Shahrasti', 'শাহরাস্তি', NULL, NULL),
(68, 43, 'Anwara Upazila', 'আনোয়ারা', NULL, NULL),
(69, 43, 'Banshkhali Upazila', 'বাশখালি', NULL, NULL),
(70, 43, 'Boalkhali Upazila', 'বোয়ালখালি', NULL, NULL),
(71, 43, 'Chandanaish Upazila', 'চন্দনাইশ', NULL, NULL),
(72, 43, 'Fatikchhari Upazila', 'ফটিকছড়ি', NULL, NULL),
(73, 43, 'Hathazari Upazila', 'হাঠহাজারী', NULL, NULL),
(74, 43, 'Lohagara Upazila', 'লোহাগারা', NULL, NULL),
(75, 43, 'Mirsharai Upazila', 'মিরসরাই', NULL, NULL),
(76, 43, 'Patiya Upazila', 'পটিয়া', NULL, NULL),
(77, 43, 'Rangunia Upazila', 'রাঙ্গুনিয়া', NULL, NULL),
(78, 43, 'Raozan Upazila', 'রাউজান', NULL, NULL),
(79, 43, 'Sandwip Upazila', 'সন্দ্বীপ', NULL, NULL),
(80, 43, 'Satkania Upazila', 'সাতকানিয়া', NULL, NULL),
(81, 43, 'Sitakunda Upazila', 'সীতাকুণ্ড', NULL, NULL),
(82, 44, 'Barura Upazila', 'বড়ুরা', NULL, NULL),
(83, 44, 'Brahmanpara Upazila', 'ব্রাহ্মণপাড়া', NULL, NULL),
(84, 44, 'Burichong Upazila', 'বুড়িচং', NULL, NULL),
(85, 44, 'Chandina Upazila', 'চান্দিনা', NULL, NULL),
(86, 44, 'Chauddagram Upazila', 'চৌদ্দগ্রাম', NULL, NULL),
(87, 44, 'Daudkandi Upazila', 'দাউদকান্দি', NULL, NULL),
(88, 44, 'Debidwar Upazila', 'দেবীদ্বার', NULL, NULL),
(89, 44, 'Homna Upazila', 'হোমনা', NULL, NULL),
(90, 44, 'Comilla Sadar Upazila', 'কুমিল্লা সদর', NULL, NULL),
(91, 44, 'Laksam Upazila', 'লাকসাম', NULL, NULL),
(92, 44, 'Monohorgonj Upazila', 'মনোহরগঞ্জ', NULL, NULL),
(93, 44, 'Meghna Upazila', 'মেঘনা', NULL, NULL),
(94, 44, 'Muradnagar Upazila', 'মুরাদনগর', NULL, NULL),
(95, 44, 'Nangalkot Upazila', 'নাঙ্গালকোট', NULL, NULL),
(96, 44, 'Comilla Sadar South Upazila', 'কুমিল্লা সদর দক্ষিণ', NULL, NULL),
(97, 44, 'Titas Upazila', 'তিতাস', NULL, NULL),
(98, 45, 'Chakaria Upazila', 'চকরিয়া', NULL, NULL),
(99, 45, 'Chakaria Upazila', 'চকরিয়া', NULL, NULL),
(100, 45, 'Cox''s Bazar Sadar Upazila', 'কক্স বাজার সদর', NULL, NULL),
(101, 45, 'Kutubdia Upazila', 'কুতুবদিয়া', NULL, NULL),
(102, 45, 'Maheshkhali Upazila', 'মহেশখালী', NULL, NULL),
(103, 45, 'Ramu Upazila', 'রামু', NULL, NULL),
(104, 45, 'Teknaf Upazila', 'টেকনাফ', NULL, NULL),
(105, 45, 'Ukhia Upazila', 'উখিয়া', NULL, NULL),
(106, 45, 'Pekua Upazila', 'পেকুয়া', NULL, NULL),
(107, 46, 'Feni Sadar', 'ফেনী সদর', NULL, NULL),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', NULL, NULL),
(109, 46, 'Daganbhyan', 'দাগানভিয়া', NULL, NULL),
(110, 46, 'Parshuram', 'পরশুরাম', NULL, NULL),
(111, 46, 'Fhulgazi', 'ফুলগাজি', NULL, NULL),
(112, 46, 'Sonagazi', 'সোনাগাজি', NULL, NULL),
(113, 47, 'Dighinala Upazila', 'দিঘিনালা ', NULL, NULL),
(114, 47, 'Khagrachhari Upazila', 'খাগড়াছড়ি', NULL, NULL),
(115, 47, 'Lakshmichhari Upazila', 'লক্ষ্মীছড়ি', NULL, NULL),
(116, 47, 'Mahalchhari Upazila', 'মহলছড়ি', NULL, NULL),
(117, 47, 'Manikchhari Upazila', 'মানিকছড়ি', NULL, NULL),
(118, 47, 'Matiranga Upazila', 'মাটিরাঙ্গা', NULL, NULL),
(119, 47, 'Panchhari Upazila', 'পানছড়ি', NULL, NULL),
(120, 47, 'Ramgarh Upazila', 'রামগড়', NULL, NULL),
(121, 48, 'Lakshmipur Sadar Upazila', 'লক্ষ্মীপুর সদর', NULL, NULL),
(122, 48, 'Raipur Upazila', 'রায়পুর', NULL, NULL),
(123, 48, 'Ramganj Upazila', 'রামগঞ্জ', NULL, NULL),
(124, 48, 'Ramgati Upazila', 'রামগতি', NULL, NULL),
(125, 48, 'Komol Nagar Upazila', 'কমল নগর', NULL, NULL),
(126, 49, 'Noakhali Sadar Upazila', 'নোয়াখালী সদর', NULL, NULL),
(127, 49, 'Begumganj Upazila', 'বেগমগঞ্জ', NULL, NULL),
(128, 49, 'Chatkhil Upazila', 'চাটখিল', NULL, NULL),
(129, 49, 'Companyganj Upazila', 'কোম্পানীগঞ্জ', NULL, NULL),
(130, 49, 'Shenbag Upazila', 'শেনবাগ', NULL, NULL),
(131, 49, 'Hatia Upazila', 'হাতিয়া', NULL, NULL),
(132, 49, 'Kobirhat Upazila', 'কবিরহাট ', NULL, NULL),
(133, 49, 'Sonaimuri Upazila', 'সোনাইমুরি', NULL, NULL),
(134, 49, 'Suborno Char Upazila', 'সুবর্ণ চর ', NULL, NULL),
(135, 50, 'Rangamati Sadar Upazila', 'রাঙ্গামাটি সদর', NULL, NULL),
(136, 50, 'Belaichhari Upazila', 'বেলাইছড়ি', NULL, NULL),
(137, 50, 'Bagaichhari Upazila', 'বাঘাইছড়ি', NULL, NULL),
(138, 50, 'Barkal Upazila', 'বরকল', NULL, NULL),
(139, 50, 'Juraichhari Upazila', 'জুরাইছড়ি', NULL, NULL),
(140, 50, 'Rajasthali Upazila', 'রাজাস্থলি', NULL, NULL),
(141, 50, 'Kaptai Upazila', 'কাপ্তাই', NULL, NULL),
(142, 50, 'Langadu Upazila', 'লাঙ্গাডু', NULL, NULL),
(143, 50, 'Nannerchar Upazila', 'নান্নেরচর ', NULL, NULL),
(144, 50, 'Kaukhali Upazila', 'কাউখালি', NULL, NULL),
(145, 1, 'Dhamrai Upazila', 'ধামরাই', NULL, NULL),
(146, 1, 'Dohar Upazila', 'দোহার', NULL, NULL),
(147, 1, 'Keraniganj Upazila', 'কেরানীগঞ্জ', NULL, NULL),
(148, 1, 'Nawabganj Upazila', 'নবাবগঞ্জ', NULL, NULL),
(149, 1, 'Savar Upazila', 'সাভার', NULL, NULL),
(150, 2, 'Faridpur Sadar Upazila', 'ফরিদপুর সদর', NULL, NULL),
(151, 2, 'Boalmari Upazila', 'বোয়ালমারী', NULL, NULL),
(152, 2, 'Alfadanga Upazila', 'আলফাডাঙ্গা', NULL, NULL),
(153, 2, 'Madhukhali Upazila', 'মধুখালি', NULL, NULL),
(154, 2, 'Bhanga Upazila', 'ভাঙ্গা', NULL, NULL),
(155, 2, 'Nagarkanda Upazila', 'নগরকান্ড', NULL, NULL),
(156, 2, 'Charbhadrasan Upazila', 'চরভদ্রাসন ', NULL, NULL),
(157, 2, 'Sadarpur Upazila', 'সদরপুর', NULL, NULL),
(158, 2, 'Shaltha Upazila', 'শালথা', NULL, NULL),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', NULL, NULL),
(160, 3, 'Kaliakior', 'কালিয়াকৈর', NULL, NULL),
(161, 3, 'Kapasia', 'কাপাসিয়া', NULL, NULL),
(162, 3, 'Sripur', 'শ্রীপুর', NULL, NULL),
(163, 3, 'Kaliganj', 'কালীগঞ্জ', NULL, NULL),
(164, 3, 'Tongi', 'টঙ্গি', NULL, NULL),
(165, 4, 'Gopalganj Sadar Upazila', 'গোপালগঞ্জ সদর', NULL, NULL),
(166, 4, 'Kashiani Upazila', 'কাশিয়ানি', NULL, NULL),
(167, 4, 'Kotalipara Upazila', 'কোটালিপাড়া', NULL, NULL),
(168, 4, 'Muksudpur Upazila', 'মুকসুদপুর', NULL, NULL),
(169, 4, 'Tungipara Upazila', 'টুঙ্গিপাড়া', NULL, NULL),
(170, 5, 'Dewanganj Upazila', 'দেওয়ানগঞ্জ', NULL, NULL),
(171, 5, 'Baksiganj Upazila', 'বকসিগঞ্জ', NULL, NULL),
(172, 5, 'Islampur Upazila', 'ইসলামপুর', NULL, NULL),
(173, 5, 'Jamalpur Sadar Upazila', 'জামালপুর সদর', NULL, NULL),
(174, 5, 'Madarganj Upazila', 'মাদারগঞ্জ', NULL, NULL),
(175, 5, 'Melandaha Upazila', 'মেলানদাহা', NULL, NULL),
(176, 5, 'Sarishabari Upazila', 'সরিষাবাড়ি ', NULL, NULL),
(177, 5, 'Narundi Police I.C', 'নারুন্দি', NULL, NULL),
(178, 6, 'Astagram Upazila', 'অষ্টগ্রাম', NULL, NULL),
(179, 6, 'Bajitpur Upazila', 'বাজিতপুর', NULL, NULL),
(180, 6, 'Bhairab Upazila', 'ভৈরব', NULL, NULL),
(181, 6, 'Hossainpur Upazila', 'হোসেনপুর ', NULL, NULL),
(182, 6, 'Itna Upazila', 'ইটনা', NULL, NULL),
(183, 6, 'Karimganj Upazila', 'করিমগঞ্জ', NULL, NULL),
(184, 6, 'Katiadi Upazila', 'কতিয়াদি', NULL, NULL),
(185, 6, 'Kishoreganj Sadar Upazila', 'কিশোরগঞ্জ সদর', NULL, NULL),
(186, 6, 'Kuliarchar Upazila', 'কুলিয়ারচর', NULL, NULL),
(187, 6, 'Mithamain Upazila', 'মিঠামাইন', NULL, NULL),
(188, 6, 'Nikli Upazila', 'নিকলি', NULL, NULL),
(189, 6, 'Pakundia Upazila', 'পাকুন্ডা', NULL, NULL),
(190, 6, 'Tarail Upazila', 'তাড়াইল', NULL, NULL),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', NULL, NULL),
(192, 7, 'Kalkini', 'কালকিনি', NULL, NULL),
(193, 7, 'Rajoir', 'রাজইর', NULL, NULL),
(194, 7, 'Shibchar', 'শিবচর', NULL, NULL),
(195, 8, 'Manikganj Sadar Upazila', 'মানিকগঞ্জ সদর', NULL, NULL),
(196, 8, 'Singair Upazila', 'সিঙ্গাইর', NULL, NULL),
(197, 8, 'Shibalaya Upazila', 'শিবালয়', NULL, NULL),
(198, 8, 'Saturia Upazila', 'সাঠুরিয়া', NULL, NULL),
(199, 8, 'Harirampur Upazila', 'হরিরামপুর', NULL, NULL),
(200, 8, 'Ghior Upazila', 'ঘিওর', NULL, NULL),
(201, 8, 'Daulatpur Upazila', 'দৌলতপুর', NULL, NULL),
(202, 9, 'Lohajang Upazila', 'লোহাজং', NULL, NULL),
(203, 9, 'Sreenagar Upazila', 'শ্রীনগর', NULL, NULL),
(204, 9, 'Munshiganj Sadar Upazila', 'মুন্সিগঞ্জ সদর', NULL, NULL),
(205, 9, 'Sirajdikhan Upazila', 'সিরাজদিখান', NULL, NULL),
(206, 9, 'Tongibari Upazila', 'টঙ্গিবাড়ি', NULL, NULL),
(207, 9, 'Gazaria Upazila', 'গজারিয়া', NULL, NULL),
(208, 10, 'Bhaluka', 'ভালুকা', NULL, NULL),
(209, 10, 'Trishal', 'ত্রিশাল', NULL, NULL),
(210, 10, 'Haluaghat', 'হালুয়াঘাট', NULL, NULL),
(211, 10, 'Muktagachha', 'মুক্তাগাছা', NULL, NULL),
(212, 10, 'Dhobaura', 'ধবারুয়া', NULL, NULL),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া', NULL, NULL),
(214, 10, 'Gaffargaon', 'গফরগাঁও', NULL, NULL),
(215, 10, 'Gauripur', 'গৌরিপুর', NULL, NULL),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', NULL, NULL),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', NULL, NULL),
(218, 10, 'Nandail', 'নন্দাইল', NULL, NULL),
(219, 10, 'Phulpur', 'ফুলপুর', NULL, NULL),
(220, 11, 'Araihazar Upazila', 'আড়াইহাজার', NULL, NULL),
(221, 11, 'Sonargaon Upazila', 'সোনারগাঁও', NULL, NULL),
(222, 11, 'Bandar', 'বান্দার', NULL, NULL),
(223, 11, 'Naryanganj Sadar Upazila', 'নারায়ানগঞ্জ সদর', NULL, NULL),
(224, 11, 'Rupganj Upazila', 'রূপগঞ্জ', NULL, NULL),
(225, 11, 'Siddirgonj Upazila', 'সিদ্ধিরগঞ্জ', NULL, NULL),
(226, 12, 'Belabo Upazila', 'বেলাবো', NULL, NULL),
(227, 12, 'Monohardi Upazila', 'মনোহরদি', NULL, NULL),
(228, 12, 'Narsingdi Sadar Upazila', 'নরসিংদী সদর', NULL, NULL),
(229, 12, 'Palash Upazila', 'পলাশ', NULL, NULL),
(230, 12, 'Raipura Upazila, Narsingdi', 'রায়পুর', NULL, NULL),
(231, 12, 'Shibpur Upazila', 'শিবপুর', NULL, NULL),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া', NULL, NULL),
(233, 13, 'Atpara Upazilla', 'আটপাড়া', NULL, NULL),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা', NULL, NULL),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর', NULL, NULL),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', NULL, NULL),
(237, 13, 'Madan Upazilla', 'মদন', NULL, NULL),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', NULL, NULL),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', NULL, NULL),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা', NULL, NULL),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', NULL, NULL),
(242, 14, 'Baliakandi Upazila', 'বালিয়াকান্দি', NULL, NULL),
(243, 14, 'Goalandaghat Upazila', 'গোয়ালন্দ ঘাট', NULL, NULL),
(244, 14, 'Pangsha Upazila', 'পাংশা', NULL, NULL),
(245, 14, 'Kalukhali Upazila', 'কালুখালি', NULL, NULL),
(246, 14, 'Rajbari Sadar Upazila', 'রাজবাড়ি সদর', NULL, NULL),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', NULL, NULL),
(248, 15, 'Damudya Upazila', 'দামুদিয়া', NULL, NULL),
(249, 15, 'Naria Upazila', 'নড়িয়া', NULL, NULL),
(250, 15, 'Jajira Upazila', 'জাজিরা', NULL, NULL),
(251, 15, 'Bhedarganj Upazila', 'ভেদারগঞ্জ', NULL, NULL),
(252, 15, 'Gosairhat Upazila', 'গোসাইর হাট ', NULL, NULL),
(253, 16, 'Jhenaigati Upazila', 'ঝিনাইগাতি', NULL, NULL),
(254, 16, 'Nakla Upazila', 'নাকলা', NULL, NULL),
(255, 16, 'Nalitabari Upazila', 'নালিতাবাড়ি', NULL, NULL),
(256, 16, 'Sherpur Sadar Upazila', 'শেরপুর সদর', NULL, NULL),
(257, 16, 'Sreebardi Upazila', 'শ্রীবরদি', NULL, NULL),
(258, 17, 'Tangail Sadar Upazila', 'টাঙ্গাইল সদর', NULL, NULL),
(259, 17, 'Sakhipur Upazila', 'সখিপুর', NULL, NULL),
(260, 17, 'Basail Upazila', 'বসাইল', NULL, NULL),
(261, 17, 'Madhupur Upazila', 'মধুপুর', NULL, NULL),
(262, 17, 'Ghatail Upazila', 'ঘাটাইল', NULL, NULL),
(263, 17, 'Kalihati Upazila', 'কালিহাতি', NULL, NULL),
(264, 17, 'Nagarpur Upazila', 'নগরপুর', NULL, NULL),
(265, 17, 'Mirzapur Upazila', 'মির্জাপুর', NULL, NULL),
(266, 17, 'Gopalpur Upazila', 'গোপালপুর', NULL, NULL),
(267, 17, 'Delduar Upazila', 'দেলদুয়ার', NULL, NULL),
(268, 17, 'Bhuapur Upazila', 'ভুয়াপুর', NULL, NULL),
(269, 17, 'Dhanbari Upazila', 'ধানবাড়ি', NULL, NULL),
(270, 55, 'Bagerhat Sadar Upazila', 'বাগেরহাট সদর', NULL, NULL),
(271, 55, 'Chitalmari Upazila', 'চিতলমাড়ি', NULL, NULL),
(272, 55, 'Fakirhat Upazila', 'ফকিরহাট', NULL, NULL),
(273, 55, 'Kachua Upazila', 'কচুয়া', NULL, NULL),
(274, 55, 'Mollahat Upazila', 'মোল্লাহাট ', NULL, NULL),
(275, 55, 'Mongla Upazila', 'মংলা', NULL, NULL),
(276, 55, 'Morrelganj Upazila', 'মরেলগঞ্জ', NULL, NULL),
(277, 55, 'Rampal Upazila', 'রামপাল', NULL, NULL),
(278, 55, 'Sarankhola Upazila', 'স্মরণখোলা', NULL, NULL),
(279, 56, 'Damurhuda Upazila', 'দামুরহুদা', NULL, NULL),
(280, 56, 'Chuadanga-S Upazila', 'চুয়াডাঙ্গা সদর', NULL, NULL),
(281, 56, 'Jibannagar Upazila', 'জীবন নগর ', NULL, NULL),
(282, 56, 'Alamdanga Upazila', 'আলমডাঙ্গা', NULL, NULL),
(283, 57, 'Abhaynagar Upazila', 'অভয়নগর', NULL, NULL),
(284, 57, 'Keshabpur Upazila', 'কেশবপুর', NULL, NULL),
(285, 57, 'Bagherpara Upazila', 'বাঘের পাড়া ', NULL, NULL),
(286, 57, 'Jessore Sadar Upazila', 'যশোর সদর', NULL, NULL),
(287, 57, 'Chaugachha Upazila', 'চৌগাছা', NULL, NULL),
(288, 57, 'Manirampur Upazila', 'মনিরামপুর ', NULL, NULL),
(289, 57, 'Jhikargachha Upazila', 'ঝিকরগাছা', NULL, NULL),
(290, 57, 'Sharsha Upazila', 'সারশা', NULL, NULL),
(291, 58, 'Jhenaidah Sadar Upazila', 'ঝিনাইদহ সদর', NULL, NULL),
(292, 58, 'Maheshpur Upazila', 'মহেশপুর', NULL, NULL),
(293, 58, 'Kaliganj Upazila', 'কালীগঞ্জ', NULL, NULL),
(294, 58, 'Kotchandpur Upazila', 'কোট চাঁদপুর ', NULL, NULL),
(295, 58, 'Shailkupa Upazila', 'শৈলকুপা', NULL, NULL),
(296, 58, 'Harinakunda Upazila', 'হাড়িনাকুন্দা', NULL, NULL),
(297, 59, 'Terokhada Upazila', 'তেরোখাদা', NULL, NULL),
(298, 59, 'Batiaghata Upazila', 'বাটিয়াঘাটা ', NULL, NULL),
(299, 59, 'Dacope Upazila', 'ডাকপে', NULL, NULL),
(300, 59, 'Dumuria Upazila', 'ডুমুরিয়া', NULL, NULL),
(301, 59, 'Dighalia Upazila', 'দিঘলিয়া', NULL, NULL),
(302, 59, 'Koyra Upazila', 'কয়ড়া', NULL, NULL),
(303, 59, 'Paikgachha Upazila', 'পাইকগাছা', NULL, NULL),
(304, 59, 'Phultala Upazila', 'ফুলতলা', NULL, NULL),
(305, 59, 'Rupsa Upazila', 'রূপসা', NULL, NULL),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', NULL, NULL),
(307, 60, 'Kumarkhali', 'কুমারখালি', NULL, NULL),
(308, 60, 'Daulatpur', 'দৌলতপুর', NULL, NULL),
(309, 60, 'Mirpur', 'মিরপুর', NULL, NULL),
(310, 60, 'Bheramara', 'ভেরামারা', NULL, NULL),
(311, 60, 'Khoksa', 'খোকসা', NULL, NULL),
(312, 61, 'Magura Sadar Upazila', 'মাগুরা সদর', NULL, NULL),
(313, 61, 'Mohammadpur Upazila', 'মোহাম্মাদপুর', NULL, NULL),
(314, 61, 'Shalikha Upazila', 'শালিখা', NULL, NULL),
(315, 61, 'Sreepur Upazila', 'শ্রীপুর', NULL, NULL),
(316, 62, 'angni Upazila', 'আংনি', NULL, NULL),
(317, 62, 'Mujib Nagar Upazila', 'মুজিব নগর', NULL, NULL),
(318, 62, 'Meherpur-S Upazila', 'মেহেরপুর সদর', NULL, NULL),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর', NULL, NULL),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া', NULL, NULL),
(321, 63, 'Kalia Upazilla', 'কালিয়া', NULL, NULL),
(322, 64, 'Satkhira Sadar Upazila', 'সাতক্ষীরা সদর', NULL, NULL),
(323, 64, 'Assasuni Upazila', 'আসসাশুনি ', NULL, NULL),
(324, 64, 'Debhata Upazila', 'দেভাটা', NULL, NULL),
(325, 64, 'Tala Upazila', 'তালা', NULL, NULL),
(326, 64, 'Kalaroa Upazila', 'কলরোয়া', NULL, NULL),
(327, 64, 'Kaliganj Upazila', 'কালীগঞ্জ', NULL, NULL),
(328, 64, 'Shyamnagar Upazila', 'শ্যামনগর', NULL, NULL),
(329, 18, 'Adamdighi', 'আদমদিঘী', NULL, NULL),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর', NULL, NULL),
(331, 18, 'Sherpur', 'শেরপুর', NULL, NULL),
(332, 18, 'Dhunat', 'ধুনট', NULL, NULL),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া', NULL, NULL),
(334, 18, 'Gabtali', 'গাবতলি', NULL, NULL),
(335, 18, 'Kahaloo', 'কাহালু', NULL, NULL),
(336, 18, 'Nandigram', 'নন্দিগ্রাম', NULL, NULL),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর', NULL, NULL),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি', NULL, NULL),
(339, 18, 'Shibganj', 'শিবগঞ্জ', NULL, NULL),
(340, 18, 'Sonatala', 'সোনাতলা', NULL, NULL),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর', NULL, NULL),
(342, 19, 'Akkelpur', 'আক্কেলপুর', NULL, NULL),
(343, 19, 'Kalai', 'কালাই', NULL, NULL),
(344, 19, 'Khetlal', 'খেতলাল', NULL, NULL),
(345, 19, 'Panchbibi', 'পাঁচবিবি', NULL, NULL),
(346, 20, 'Naogaon Sadar Upazila', 'নওগাঁ সদর', NULL, NULL),
(347, 20, 'Mohadevpur Upazila', 'মহাদেবপুর', NULL, NULL),
(348, 20, 'Manda Upazila', 'মান্দা', NULL, NULL),
(349, 20, 'Niamatpur Upazila', 'নিয়ামতপুর', NULL, NULL),
(350, 20, 'Atrai Upazila', 'আত্রাই', NULL, NULL),
(351, 20, 'Raninagar Upazila', 'রাণীনগর', NULL, NULL),
(352, 20, 'Patnitala Upazila', 'পত্নীতলা', NULL, NULL),
(353, 20, 'Dhamoirhat Upazila', 'ধামইরহাট ', NULL, NULL),
(354, 20, 'Sapahar Upazila', 'সাপাহার', NULL, NULL),
(355, 20, 'Porsha Upazila', 'পোরশা', NULL, NULL),
(356, 20, 'Badalgachhi Upazila', 'বদলগাছি', NULL, NULL),
(357, 21, 'Natore Sadar Upazila', 'নাটোর সদর', NULL, NULL),
(358, 21, 'Baraigram Upazila', 'বড়াইগ্রাম', NULL, NULL),
(359, 21, 'Bagatipara Upazila', 'বাগাতিপাড়া', NULL, NULL),
(360, 21, 'Lalpur Upazila', 'লালপুর', NULL, NULL),
(361, 21, 'Natore Sadar Upazila', 'নাটোর সদর', NULL, NULL),
(362, 21, 'Baraigram Upazila', 'বড়াই গ্রাম', NULL, NULL),
(363, 22, 'Bholahat Upazila', 'ভোলাহাট', NULL, NULL),
(364, 22, 'Gomastapur Upazila', 'গোমস্তাপুর', NULL, NULL),
(365, 22, 'Nachole Upazila', 'নাচোল', NULL, NULL),
(366, 22, 'Nawabganj Sadar Upazila', 'নবাবগঞ্জ সদর', NULL, NULL),
(367, 22, 'Shibganj Upazila', 'শিবগঞ্জ', NULL, NULL),
(368, 23, 'Atgharia Upazila', 'আটঘরিয়া', NULL, NULL),
(369, 23, 'Bera Upazila', 'বেড়া', NULL, NULL),
(370, 23, 'Bhangura Upazila', 'ভাঙ্গুরা', NULL, NULL),
(371, 23, 'Chatmohar Upazila', 'চাটমোহর', NULL, NULL),
(372, 23, 'Faridpur Upazila', 'ফরিদপুর', NULL, NULL),
(373, 23, 'Ishwardi Upazila', 'ঈশ্বরদী', NULL, NULL),
(374, 23, 'Pabna Sadar Upazila', 'পাবনা সদর', NULL, NULL),
(375, 23, 'Santhia Upazila', 'সাথিয়া', NULL, NULL),
(376, 23, 'Sujanagar Upazila', 'সুজানগর', NULL, NULL),
(377, 24, 'Bagha', 'বাঘা', NULL, NULL),
(378, 24, 'Bagmara', 'বাগমারা', NULL, NULL),
(379, 24, 'Charghat', 'চারঘাট', NULL, NULL),
(380, 24, 'Durgapur', 'দুর্গাপুর', NULL, NULL),
(381, 24, 'Godagari', 'গোদাগারি', NULL, NULL),
(382, 24, 'Mohanpur', 'মোহনপুর', NULL, NULL),
(383, 24, 'Paba', 'পবা', NULL, NULL),
(384, 24, 'Puthia', 'পুঠিয়া', NULL, NULL),
(385, 24, 'Tanore', 'তানোর', NULL, NULL),
(386, 25, 'Sirajganj Sadar Upazila', 'সিরাজগঞ্জ সদর', NULL, NULL),
(387, 25, 'Belkuchi Upazila', 'বেলকুচি', NULL, NULL),
(388, 25, 'Chauhali Upazila', 'চৌহালি', NULL, NULL),
(389, 25, 'Kamarkhanda Upazila', 'কামারখান্দা', NULL, NULL),
(390, 25, 'Kazipur Upazila', 'কাজীপুর', NULL, NULL),
(391, 25, 'Raiganj Upazila', 'রায়গঞ্জ', NULL, NULL),
(392, 25, 'Shahjadpur Upazila', 'শাহজাদপুর', NULL, NULL),
(393, 25, 'Tarash Upazila', 'তারাশ', NULL, NULL),
(394, 25, 'Ullahpara Upazila', 'উল্লাপাড়া', NULL, NULL),
(395, 26, 'Birampur Upazila', 'বিরামপুর', NULL, NULL),
(396, 26, 'Birganj', 'বীরগঞ্জ', NULL, NULL),
(397, 26, 'Biral Upazila', 'বিড়াল', NULL, NULL),
(398, 26, 'Bochaganj Upazila', 'বোচাগঞ্জ', NULL, NULL),
(399, 26, 'Chirirbandar Upazila', 'চিরিরবন্দর', NULL, NULL),
(400, 26, 'Phulbari Upazila', 'ফুলবাড়ি', NULL, NULL),
(401, 26, 'Ghoraghat Upazila', 'ঘোড়াঘাট', NULL, NULL),
(402, 26, 'Hakimpur Upazila', 'হাকিমপুর', NULL, NULL),
(403, 26, 'Kaharole Upazila', 'কাহারোল', NULL, NULL),
(404, 26, 'Khansama Upazila', 'খানসামা', NULL, NULL),
(405, 26, 'Dinajpur Sadar Upazila', 'দিনাজপুর সদর', NULL, NULL),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ', NULL, NULL),
(407, 26, 'Parbatipur Upazila', 'পার্বতীপুর', NULL, NULL),
(408, 27, 'Fulchhari', 'ফুলছড়ি', NULL, NULL),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', NULL, NULL),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', NULL, NULL),
(411, 27, 'Palashbari', 'পলাশবাড়ী', NULL, NULL),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর', NULL, NULL),
(413, 27, 'Saghata', 'সাঘাটা', NULL, NULL),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ', NULL, NULL),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', NULL, NULL),
(416, 28, 'Nageshwari', 'নাগেশ্বরী', NULL, NULL),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', NULL, NULL),
(418, 28, 'Phulbari', 'ফুলবাড়ি', NULL, NULL),
(419, 28, 'Rajarhat', 'রাজারহাট', NULL, NULL),
(420, 28, 'Ulipur', 'উলিপুর', NULL, NULL),
(421, 28, 'Chilmari', 'চিলমারি', NULL, NULL),
(422, 28, 'Rowmari', 'রউমারি', NULL, NULL),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর', NULL, NULL),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', NULL, NULL),
(425, 29, 'Aditmari', 'আদিতমারি', NULL, NULL),
(426, 29, 'Kaliganj', 'কালীগঞ্জ', NULL, NULL),
(427, 29, 'Hatibandha', 'হাতিবান্ধা', NULL, NULL),
(428, 29, 'Patgram', 'পাটগ্রাম', NULL, NULL),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', NULL, NULL),
(430, 30, 'Saidpur', 'সৈয়দপুর', NULL, NULL),
(431, 30, 'Jaldhaka', 'জলঢাকা', NULL, NULL),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ', NULL, NULL),
(433, 30, 'Domar', 'ডোমার', NULL, NULL),
(434, 30, 'Dimla', 'ডিমলা', NULL, NULL),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', NULL, NULL),
(436, 31, 'Debiganj', 'দেবীগঞ্জ', NULL, NULL),
(437, 31, 'Boda', 'বোদা', NULL, NULL),
(438, 31, 'Atwari', 'আটোয়ারি', NULL, NULL),
(439, 31, 'Tetulia', 'তেতুলিয়া', NULL, NULL),
(440, 32, 'Badarganj', 'বদরগঞ্জ', NULL, NULL),
(441, 32, 'Mithapukur', 'মিঠাপুকুর', NULL, NULL),
(442, 32, 'Gangachara', 'গঙ্গাচরা', NULL, NULL),
(443, 32, 'Kaunia', 'কাউনিয়া', NULL, NULL),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর', NULL, NULL),
(445, 32, 'Pirgachha', 'পীরগাছা', NULL, NULL),
(446, 32, 'Pirganj', 'পীরগঞ্জ', NULL, NULL),
(447, 32, 'Taraganj', 'তারাগঞ্জ', NULL, NULL),
(448, 33, 'Thakurgaon Sadar Upazila', 'ঠাকুরগাঁও সদর', NULL, NULL),
(449, 33, 'Pirganj Upazila', 'পীরগঞ্জ', NULL, NULL),
(450, 33, 'Baliadangi Upazila', 'বালিয়াডাঙ্গি', NULL, NULL),
(451, 33, 'Haripur Upazila', 'হরিপুর', NULL, NULL),
(452, 33, 'Ranisankail Upazila', 'রাণীসংকইল', NULL, NULL),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', NULL, NULL),
(454, 51, 'Baniachang', 'বানিয়াচং', NULL, NULL),
(455, 51, 'Bahubal', 'বাহুবল', NULL, NULL),
(456, 51, 'Chunarughat', 'চুনারুঘাট', NULL, NULL),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', NULL, NULL),
(458, 51, 'Lakhai', 'লাক্ষাই', NULL, NULL),
(459, 51, 'Madhabpur', 'মাধবপুর', NULL, NULL),
(460, 51, 'Nabiganj', 'নবীগঞ্জ', NULL, NULL),
(461, 51, 'Shaistagonj Upazila', 'শায়েস্তাগঞ্জ', NULL, NULL),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', NULL, NULL),
(463, 52, 'Barlekha', 'বড়লেখা', NULL, NULL),
(464, 52, 'Juri', 'জুড়ি', NULL, NULL),
(465, 52, 'Kamalganj', 'কামালগঞ্জ', NULL, NULL),
(466, 52, 'Kulaura', 'কুলাউরা', NULL, NULL),
(467, 52, 'Rajnagar', 'রাজনগর', NULL, NULL),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল', NULL, NULL),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', NULL, NULL),
(470, 53, 'Chhatak', 'ছাতক', NULL, NULL),
(471, 53, 'Derai', 'দেড়াই', NULL, NULL),
(472, 53, 'Dharampasha', 'ধরমপাশা', NULL, NULL),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার', NULL, NULL),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর', NULL, NULL),
(475, 53, 'Jamalganj', 'জামালগঞ্জ', NULL, NULL),
(476, 53, 'Sulla', 'সুল্লা', NULL, NULL),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', NULL, NULL),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ', NULL, NULL),
(479, 53, 'Tahirpur', 'তাহিরপুর', NULL, NULL),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর', NULL, NULL),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার', NULL, NULL),
(482, 54, 'Bishwanath', 'বিশ্বনাথ', NULL, NULL),
(483, 54, 'Dakshin Surma Upazila', 'দক্ষিণ সুরমা', NULL, NULL),
(484, 54, 'Balaganj', 'বালাগঞ্জ', NULL, NULL),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ', NULL, NULL),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', NULL, NULL),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ', NULL, NULL),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট', NULL, NULL),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর', NULL, NULL),
(490, 54, 'Kanaighat', 'কানাইঘাট', NULL, NULL),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ', NULL, NULL),
(492, 54, 'Nobigonj', 'নবীগঞ্জ', NULL, NULL),
(494, 1, 'Adabor', '', NULL, NULL),
(495, 1, 'Badda', '', NULL, NULL),
(496, 1, 'Bangsal', '', NULL, NULL),
(497, 1, 'Bimanbandar', '', NULL, NULL),
(498, 1, 'Cantonment', '', NULL, NULL),
(499, 1, 'Chak Bazar', '', NULL, NULL),
(500, 1, 'Dakshinkhan', '', NULL, NULL),
(501, 1, 'Darus Salam', '', NULL, NULL),
(502, 1, 'Demra', '', NULL, NULL),
(503, 1, 'Dhanmondi', '', NULL, NULL),
(504, 1, 'Gendaria', '', NULL, NULL),
(505, 1, 'Gulshan', '', NULL, NULL),
(506, 1, 'Hazaribagh', '', NULL, NULL),
(507, 1, 'Jatrabari', '', NULL, NULL),
(508, 1, 'Kadamtali', '', NULL, NULL),
(509, 1, 'Kafrul', '', NULL, NULL),
(510, 1, 'Kalabagan', '', NULL, NULL),
(511, 1, 'Kamrangirchar', '', NULL, NULL),
(512, 1, 'Khilgaon', '', NULL, NULL),
(513, 1, 'Khilkhet', '', NULL, NULL),
(514, 1, 'Kotwali', '', NULL, NULL),
(515, 1, 'Lalbagh', '', NULL, NULL),
(516, 1, 'Mirpur', '', NULL, NULL),
(517, 1, 'Mohammadpur', '', NULL, NULL),
(518, 1, 'Mohakhali', '', NULL, NULL),
(519, 1, 'Motijheel', '', NULL, NULL),
(520, 1, 'Newmarket', '', NULL, NULL),
(521, 1, 'Pallabi', '', NULL, NULL),
(522, 1, 'Paltan', '', NULL, NULL),
(523, 1, 'Ramna', '', NULL, NULL),
(524, 1, 'Rampura', '', NULL, NULL),
(525, 1, 'Sabujbagh', '', NULL, NULL),
(526, 1, 'Shah Ali', '', NULL, NULL),
(527, 1, 'Shahbag', '', NULL, NULL),
(528, 1, 'Sher-e-Bangla Nagar', '', NULL, NULL),
(529, 1, 'Shyampur', '', NULL, NULL),
(530, 1, 'Sutrapur', '', NULL, NULL),
(531, 1, 'Tejgaon', '', NULL, NULL),
(532, 1, 'Tejgaon Industrial Area', '', NULL, NULL),
(533, 1, 'Turag', '', NULL, NULL),
(534, 1, 'Uttara', '', NULL, NULL),
(535, 1, 'Uttar Khan', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `work_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '0=inactive, 1=active, 2=suspend',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `account_type`, `email`, `password`, `address_line_1`, `address_line_2`, `city`, `district`, `post_code`, `division`, `company`, `work_phone`, `home_phone`, `other_phone`, `verification_code`, `status`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Aseef', 'Ahmed', '', 'aseefahmed@gmail.com', '$2y$10$0BzFJStq.Q9Kupa.XiX8UOHSaKItLwL7FXv7hZaR4MKMsk1XP5x.i', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 'jjN456xrs7WP3VxX3c4pqmVtgx57b4kS1tN32Ll4cBGAlrxnI2VIz7EI4Qp4', NULL, '2017-03-07 02:45:26', 1),
(111, '32', '', '3', '232233222@gmail.com', '$2y$10$cCIjjCJxzZpA3GzURjdrD.xhXpB9Ng4l2nA8F5ROHyjhqCWDvz0o.', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-05 05:29:32', '2017-02-05 05:29:32', 0),
(112, '32', '', '2', '2321233222@gmail.com', '$2y$10$SFcEO44GiVh.vOluvLGJ7OghxfYHoO5bv4eScc5ubt7DhDTS8.LZG', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-05 05:29:41', '2017-02-05 05:29:41', 0),
(113, '32', '', '1', '2111321233222@gmail.com', '$2y$10$C.iBDVa0NNQk6nggIxHBTOESzRwC4SZNc8ukrR333wKnipwsIekCm', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-05 05:29:49', '2017-02-05 05:29:49', 0),
(114, 'dfasd', '', '', '33333@gmail.com', '$2y$10$4Cdo4N5KMJZGPnySpbSTM.0YV/A8RdyMJvBrb6ykrSTVOhwbKvxti', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-05 05:42:07', '2017-02-05 05:42:07', 0),
(115, '444', '', '', '422@g.com', '$2y$10$3w1E6Z.EduHECFRrp2A9Hu5rJkge9wYDzDWyK99n8biJ.UHRgBsLC', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-05 05:52:00', '2017-02-05 05:52:00', 10),
(116, 'a', '', '2', 'd@gmail.com', '$2y$10$K/.mLU9LTXxupVyBPEIMJ.JjvHaLUk8pbHD4xWD.sTwgCEkOFnjp.', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-06 00:01:23', '2017-02-06 00:01:23', 0),
(117, 'rahul ahmed', '', '1', '1aseef@gmail.com', '$2y$10$fHXHWNQPlRkTbkpNKDpGKuH2Lr46c6uurcSS2qVYlif7pSX8NkTp6', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-06 03:35:55', '2017-02-06 03:35:55', 0),
(118, 'safa', '', '2', 'fsadf@gmail.com', '$2y$10$v9WxyiOYKxgZoy19iq4gk.gNJnAd5anBbMhaGBGW03C4.KsI3WkA2', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-14 02:51:23', '2017-02-14 02:51:23', 0),
(120, 'tare1', '', '', 'tar@gmail.com', '$2y$10$kHVaN179doX/7rjcQCAjBOc4Z7jq2hdevwtVP9NezywY7Hb8XxKW6', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-19 04:39:56', '2017-02-19 04:39:56', 11),
(122, '1', '2', '', 'roddd33dck@nnt.net', '$2y$10$t/WP03PsE6GCSheuruccje/NwubHYlqPOruThsi4qABLBWDVHLTtu', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:10:04', '2017-02-25 02:10:04', 0),
(123, '1', '2', '', 'ro2ddd33dck@nnt.net', '$2y$10$iuxcRF8EbjPyYuOY9V2nm.MVihpQqZZl1IQ0FmyrZ/I4LUFZgfG4m', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:10:19', '2017-02-25 02:10:19', 0),
(124, '888', '2', '', '88k@nnt.net', '$2y$10$P5JqVP7AiRZBz6DnBttj9OmWI5ddOdK14vbT./PsZdkXEk5fiB5Ue', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:10:27', '2017-02-25 02:10:27', 0),
(125, 'y', 'y', '', 'tyar@gmail.com', '$2y$10$cE2l4b6A1kCE/vTGEVyBAOnVCuwgTfaMJN27xDZpkEyn6O0GJ1WDW', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:15:32', '2017-02-25 02:15:32', 1),
(126, 'u', 'u', '', 'ratand@gmail.com', '$2y$10$FuUIB4gNHMRX4vhxru.FVOB1x7QClfEKRScnzFNTtLW.sT3Hq/kx6', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:18:10', '2017-02-25 02:18:10', 0),
(127, '7', '7', '', 'roto7n@gmail.com', '$2y$10$ZYO3u0tqCB3TX/18.wszeO5H9X0ScuRZ/7xRchFSZ8pj5z0LsxZjq', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-02-25 02:20:06', '2017-02-25 02:20:06', 11),
(128, 'saeef', 'ahmed', '', 'saeef1@gmail.com', '$2y$10$4JuIbhPgvwdu.Rl3kTmcSu3IPnvvYUczRsP4Syb9bLn/9casinyDS', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2017-03-02 05:10:34', '2017-03-02 05:10:34', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_locations`
--
ALTER TABLE `courier_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_types`
--
ALTER TABLE `doc_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `price_charts`
--
ALTER TABLE `price_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_purposes`
--
ALTER TABLE `shipment_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazillas`
--
ALTER TABLE `upazillas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `courier_locations`
--
ALTER TABLE `courier_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `cycles`
--
ALTER TABLE `cycles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `doc_types`
--
ALTER TABLE `doc_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `price_charts`
--
ALTER TABLE `price_charts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `shipment_purposes`
--
ALTER TABLE `shipment_purposes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `upazillas`
--
ALTER TABLE `upazillas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=536;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
