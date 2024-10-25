-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2024 at 05:39 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `touchfingure`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext,
  `phone` longtext,
  `address` longtext,
  `email` longtext,
  `password` longtext,
  `orignal_password` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `pm_id` varchar(255) DEFAULT NULL,
  `timestamp` varchar(20) DEFAULT NULL,
  `admin_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `phone`, `address`, `email`, `password`, `orignal_password`, `role`, `pm_id`, `timestamp`, `admin_status`) VALUES
(1, 'Precise', '', '', 'admin@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, '1', NULL, '1549100984', 'Active'),
(5, 'Jayesh', '1234567890', 'tets', 'jayesh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '4', '2', '1550475820', 'Active'),
(10, 'Paresh', '1234567899', '', 'paresh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '4', '3', '1728548754', NULL),
(11, 'krina', '1245678900', '', 'krina@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '4', '2', '1728816396', NULL),
(12, 'prashant', '12456789', 'ahm', 'prashant@gmail.com', 'f53d69356677036daec7ea1e25bf13a2780c094c', '124567', '4', '9', '1729607110', NULL),
(13, 'parag', '12456789', '', 'parag@gmail.com', 'fe291da6ccb1481acddabf5ea402fd11c2021b10', 'parag', '4', '10', '1729610041', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('kaqpe4um6k69uuj4n0hor8ltckkkjh8i', '::1', 1729696855, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393639363636373b6c6f67696e7c733a333a22796573223b61646d696e5f6c6f67696e7c733a333a22796573223b61646d696e5f69647c733a313a2231223b61646d696e5f6e616d657c733a373a2250726563697365223b7469746c657c733a353a2261646d696e223b70616e656c5f7469746c657c733a353a2261646d696e223b726f6c657c733a313a2231223b),
('dgos188us34afedgu84mc3br35uutlu8', '::1', 1729697194, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393639373137393b),
('kv5sfc73ug6i64qmqrhjgkjkv40t3e58', '::1', 1729705162, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393730353132393b6c6f67696e7c733a333a22796573223b61646d696e5f6c6f67696e7c733a333a22796573223b61646d696e5f69647c733a323a223132223b61646d696e5f6e616d657c733a383a227072617368616e74223b7469746c657c733a353a2261646d696e223b70616e656c5f7469746c657c733a353a2261646d696e223b726f6c657c733a313a2234223b),
('i7qldf1chuphdhvkl8au96fko0adefpc', '::1', 1729705166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732393730353135343b6c6f67696e7c733a333a22796573223b61646d696e5f6c6f67696e7c733a333a22796573223b61646d696e5f69647c733a313a2231223b61646d696e5f6e616d657c733a373a2250726563697365223b7469746c657c733a353a2261646d696e223b70616e656c5f7469746c657c733a353a2261646d696e223b726f6c657c733a313a2231223b);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) DEFAULT NULL,
  `country_status` varchar(255) NOT NULL,
  `length` varchar(200) DEFAULT NULL,
  `width` varchar(200) DEFAULT NULL,
  `thickness` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_status`, `length`, `width`, `thickness`) VALUES
(1, 'AL. ALLOY', 'active', NULL, NULL, NULL),
(2, 'demo', 'delete', NULL, NULL, NULL),
(3, 'AL. ALLOY9', 'delete', NULL, NULL, NULL),
(4, 'Created1', 'delete', NULL, NULL, NULL),
(5, 'sadsaddsa', 'delete', NULL, NULL, NULL),
(7, 'Aluminium-p', 'active', '251mm', '252mm', '253mm');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `subject` longtext NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`email_template_id`, `title`, `subject`, `body`) VALUES
(1, 'Email Verification', 'CricLottery Email Varification OTP', '<p>Hi {{to}},</p><p>Email Varification OTP is <b>{{otp}}</b> . Please Do Not Share with anyone</p><br/><p><b>Regards, Team Demeanor11</b></p></p>'),
(2, 'Account Approval Email', 'Account Approval Status', '<p><span [removed]=\"font-weight: bold;\">Hi [[to]],</span></p><p><span [removed]=\"font-weight: bold;\">Your account type is : [[account_type]]</span></p><p><span [removed]=\"font-weight: bold;\">Email : [[email]]</span></p><p><span [removed]=\"font-weight: bold;\">Thank you for registering at our site. Your registration must be approved by the administrator and your account has been [[status]]. Please contact with the </span>administration team if you have any further question. Best wishes.</p><p><span [removed]=\"font-weight: bold;\"><br></span></p><p><span [removed]=\"font-weight: bold;\">Thanks,</span></p><p><span [removed]=\"\" bold;\"=\"\">[[from]]</span></p>'),
(3, 'Membership Upgrade Email', 'Membership Upgraded', '<p><span [removed]=\"font-weight: bold;\">Hi [[to]],</span></p><p><span [removed]=\"font-weight: bold;\">Your account type is : [[account_type]]</span></p><p><span [removed]=\"font-weight: bold;\">Email : [[email]]</span></p><p><span [removed]=\"font-weight: bold;\">Your Membership Type is [[package]]. </span></p><p><span [removed]=\"font-weight: bold;\">Please contact with the </span>administrator team if you have any further question. Best wishes.</p><p><span [removed]=\"font-weight: bold;\"><br></span></p><p><span [removed]=\"font-weight: bold;\">Thanks,</span></p><p><span [removed]=\"\" bold;\"=\"\">[[from]]</span></p>'),
(4, 'Vendors Account Opening', 'Account Opening', '<p><span [removed]=\"font-weight: bold;\">Hi [[to]],</span></p><p><span [removed]=\"font-weight: bold;\">Thank you for registering at our site </span>[[sitename]]<span [removed]=\"font-weight: bold;\">. </span></p><p><span [removed]=\"font-weight: bold;\">Your account type is : [[account_type]]</span></p><p><span [removed]=\"font-weight: bold;\">Email is : [[email]]</span></p><p><span [removed]=\"font-weight: bold;\"></span></p><p><span [removed]=\"font-weight: bold;\">Password is : [[password]]</span></p><p><span [removed]=\"font-weight: bold;\">Your account is now being reviewed by </span>administration team. Please wait for Admin approval. You will get a  confirmation email soon and after that you will be able to login from here : [[url]]</p><p><span [removed]=\"font-weight: bold;\">Please contact with the </span>administration team if you have any further question. Best wishes.<br></p><p><span [removed]=\"font-weight: bold;\"><br></span></p><p><span [removed]=\"font-weight: bold;\">Thanks,</span></p><p><span [removed]=\"\" bold;\"=\"\">[[from]]</span></p>'),
(5, 'Users Account Opening', 'Account Opening', '<p><span [removed]=\"font-weight: bold;\">Hi [[to]],</span></p><p><span [removed]=\"font-weight: bold;\">Thank you for registering at our site&nbsp;</span>[[sitename]]<span [removed]=\"font-weight: bold;\">.</span></p><p><span [removed]=\"font-weight: bold;\">Your account type is : [[account_type]]</span></p><p><span [removed]=\"font-weight: bold;\">Email is : [[email]]</span></p><p><span [removed]=\"font-weight: bold;\"></span></p><p><span [removed]=\"font-weight: bold;\">Password is : [[password]]</span></p><p>Login from here : [[url]]</p><p><span [removed]=\"font-weight: bold;\">Please contact with the&nbsp;</span>administration&nbsp;team if you have any further question. Best wishes.<br></p><p><span [removed]=\"font-weight: bold;\"><br></span></p><p><span [removed]=\"font-weight: bold;\">Thanks,</span></p><p><span [removed]=\"\" bold;\"=\"\">[[from]]</span></p>'),
(6, 'Admins Account Opening', 'Account Opening', '<p><span [removed]=\"font-weight: bold;\">Hi [[to]],</span></p><p><span [removed]=\"font-weight: bold;\">Thank you for joining at our site </span>[[sitename]]<span [removed]=\"font-weight: bold;\">.</span></p><p><span [removed]=\"font-weight: bold;\">Your account type is : [[account_type]]</span></p><p><span [removed]=\"font-weight: bold;\">Email is : [[email]]</span></p><p><span [removed]=\"font-weight: bold;\"></span></p><p><span [removed]=\"font-weight: bold;\">Password is : [[password]]</span></p><p>Login from here : [[url]]</p><p> Best wishes.</p><p><br></p><p><span [removed]=\"font-weight: bold;\">Thanks,</span></p><p><span [removed]=\"\" bold;\"=\"\">[[from]]</span></p>'),
(7, 'Password reset send otp', 'Forgot password OTP', '<p><span style=\"font-weight: bold;\">Hi {{to}},</span></p><p><span style=\"font-weight: bold;\">Your Forget password OTP is </span>{{otp}} . Please do not share your otp for any where</p><p><span style=\"font-weight: bold;\">Thanks,</span></p><p><span style=\"font-weight:bold;\">GroVegies</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `footer_setting`
--

DROP TABLE IF EXISTS `footer_setting`;
CREATE TABLE IF NOT EXISTS `footer_setting` (
  `footer_id` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` longtext,
  `contact_one` varchar(255) DEFAULT NULL,
  `contact_two` varchar(255) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `footer_map` longtext,
  `description_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_message` text,
  PRIMARY KEY (`footer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer_setting`
--

INSERT INTO `footer_setting` (`footer_id`, `logo`, `content`, `address`, `contact_one`, `contact_two`, `email`, `footer_map`, `description_title`, `menu_title`, `address_title`, `whatsapp_message`) VALUES
(1, '743386_footer_logo.png', 'અખંડ ભારત દૈનિક ન્યૂઝ પેપર  \r\nસંચાલક TOUCHFINGER SERVICES LLP', 'FF-125, Shri Rang Plaza 95, Gift City Road, Randesan, Gandhinagar, Gujarat - 382007 | M - 9909441697', '+91 9106282092', '+91 9106282092', 'roopsinghtetarawal@gmail.com', 'https://maps.app.goo.gl/WFjgJw2NsvC5TcRK8?g_st=ac', 'Highlights', 'Menu Title', 'Contact Info', '');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `general_settings_id` int NOT NULL AUTO_INCREMENT,
  `type` longtext,
  `value` longtext,
  PRIMARY KEY (`general_settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`general_settings_id`, `type`, `value`) VALUES
(1, 'system_name', 'Precise'),
(2, 'system_email', 'precise@gmail.com'),
(3, 'system_title', 'Precise'),
(4, 'address', ''),
(5, 'phone', ''),
(6, 'language', 'english'),
(42, 'footer_text', '<p>Your Footer Text</p>'),
(67, 'google_api_key', 'AIzaSyCRs-35czYHQyXHCdvZ9rnEYkVkmWbBAlA'),
(72, 'smtp_host', ''),
(73, 'smtp_port', ''),
(74, 'smtp_user', ''),
(75, 'smtp_pass', ''),
(76, 'mail_status', 'mail'),
(83, 'admin_login_logo', '2'),
(84, 'admin_nav_logo', '18'),
(85, 'home_top_logo', '2'),
(86, 'home_bottom_logo', '2'),
(87, 'fav_ext', 'png');

-- --------------------------------------------------------

--
-- Table structure for table `header_setting`
--

DROP TABLE IF EXISTS `header_setting`;
CREATE TABLE IF NOT EXISTS `header_setting` (
  `header_id` int NOT NULL AUTO_INCREMENT,
  `news` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_one` varchar(255) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `location` text,
  PRIMARY KEY (`header_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_setting`
--

INSERT INTO `header_setting` (`header_id`, `news`, `contact_one`, `email`, `location`) VALUES
(1, 'અખંડ ભારત દૈનિક સમાચાર એ અખંડિતતા અને રજૂઆતની નૈતિકતા વાળી પ્રથાઓ પર આધારિત, સચોટ અને વિશ્વસનીય સમાચાર સંપાદિત કરીને પ્રદાન કરવા માટે સમર્પિત છે. અખંડ ભારતના લોકોની, સેવા કરવાના જુસ્સા સાથેના દૂરંદેશી નેતાઓ દ્વારા સ્થાપિત, અમારું આ પગલું લોકશાહી, અભિવ્યક્તિની સ્વતંત્રતા અને સામાજિક ન્યાયના સિદ્ધાંતોને જાળવી રાખવાના પ્રયત્નોને સમર્પિત છે.', '+91 99094 41697', 'roopsinghtetarawal@gmail.com', '1121212121212121');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `logo_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext,
  PRIMARY KEY (`logo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logo_id`, `name`) VALUES
(2, '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `notification_id` int NOT NULL AUTO_INCREMENT,
  `notification_user_id` varchar(255) DEFAULT NULL,
  `notification_content` longtext,
  `notification_read` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`notification_id`, `notification_user_id`, `notification_content`, `notification_read`, `created_by`, `created_date`, `order_id`) VALUES
(1, '1', 'Precise has created new order - 2', '1', '1', '2024-10-22 19:11:08', 2),
(2, '1', 'Precise has created new order - 3', '1', '1', '2024-10-22 19:11:08', 3),
(3, '1', 'Precise has created new order - 4', '1', '1', '2024-10-22 19:11:08', 4),
(4, '1', 'Precise has created new order - 5', '1', '1', '2024-10-22 19:11:08', 5),
(5, '5', 'you have been assigned a new order number 5 by Precise', '0', '1', '2024-10-22 19:12:07', 5),
(6, '1', 'Precise has edit permission for Employee', '1', '1', '2024-10-22 19:12:44', NULL),
(7, '1', 'Precise has update permission for Employee', '1', '1', '2024-10-22 19:13:04', NULL),
(8, '1', 'Precise has edit permission for Employee', '1', '1', '2024-10-22 19:14:09', NULL),
(9, '1', 'Precise has update permission for Employee', '1', '1', '2024-10-22 19:14:17', NULL),
(10, '11', 'you have been assigned a new order number 4 by Precise', '0', '1', '2024-10-22 19:15:12', 4),
(11, '11', 'you have been assigned a new order number 3 by Precise', '0', '1', '2024-10-22 19:17:18', 3),
(12, '1', 'krina has started working on order number 4', '0', '11', '2024-10-22 19:23:53', 4),
(13, '1', 'Precise has added new process Machine BMG', '1', '1', '2024-10-22 19:52:12', 9),
(14, '1', 'Precise has updated process Machine DMG', '1', '1', '2024-10-22 19:52:22', NULL),
(15, '1', 'Precise has added user Profile prashant', '1', '1', '2024-10-22 19:55:10', NULL),
(16, '1', 'Precise has created new order - 2', '1', '1', '2024-10-22 20:06:32', 2),
(17, '1', 'Precise has created new order - 3', '1', '1', '2024-10-22 20:06:32', 3),
(18, '1', 'Precise has created new order - 4', '1', '1', '2024-10-22 20:06:32', 4),
(19, '1', 'Precise has created new order - 5', '1', '1', '2024-10-22 20:06:32', 5),
(20, '12', 'you have been assigned a new order number 2 by Precise', '0', '1', '2024-10-22 20:14:33', 2),
(21, '1', 'prashant has started working on order number 2', '0', '12', '2024-10-22 20:19:48', 2),
(22, '12', 'you have been assigned a new order number 3 by Precise', '0', '1', '2024-10-22 20:21:37', 3),
(23, '12', 'you have been assigned a new order number 4 by Precise', '0', '1', '2024-10-22 20:23:17', 4),
(24, '1', 'prashant has started working on order number 2', '0', '12', '2024-10-22 20:34:50', 2),
(25, '5', 'you have been assigned a new order number 2 by prashant', '0', '12', '2024-10-22 20:36:57', 2),
(26, '1', 'prashant has completed order number 2', '0', '12', '2024-10-22 20:40:26', 2),
(27, '1', 'Precise has added new process Machine DMG1', '1', '1', '2024-10-22 20:43:32', 10),
(28, '1', 'Precise has added user Profile parag', '1', '1', '2024-10-22 20:44:01', NULL),
(29, '13', 'you have been assigned a new order number 2 by Precise', '0', '1', '2024-10-22 20:45:02', 2),
(30, '1', 'parag has started working on order number 2', '0', '13', '2024-10-22 20:46:11', 2),
(31, '1', 'Precise has edit user Profile parag', '1', '1', '2024-10-23 20:22:59', NULL),
(32, '1', 'Precise has edit user Profile parag', '1', '1', '2024-10-23 20:24:46', NULL),
(33, '1', 'Precise has added new process test', '1', '1', '2024-10-23 20:26:00', 11),
(34, '1', 'Precise has delete process test', '1', '1', '2024-10-23 20:26:11', NULL),
(35, '1', 'Precise has added new process Created1', '1', '1', '2024-10-23 20:28:44', 12),
(36, '1', 'Precise has delete process Created1', '1', '1', '2024-10-23 20:28:48', NULL),
(37, '1', 'Precise has added new process demo', '1', '1', '2024-10-23 20:29:40', 13),
(38, '1', 'Precise has delete process demo', '1', '1', '2024-10-23 20:29:47', NULL),
(39, '1', 'Precise has updated process Machine DMG1', '1', '1', '2024-10-23 20:29:57', NULL),
(40, '1', 'Precise has added new process AL. ALLOY', '1', '1', '2024-10-23 20:30:03', 14),
(41, '1', 'Precise has delete process AL. ALLOY', '1', '1', '2024-10-23 20:30:09', NULL),
(42, '1', 'Precise has added updated Models NFM', '1', '1', '2024-10-23 20:30:12', NULL),
(43, '1', 'Precise has updated Material name Aluminium-p', '1', '1', '2024-10-23 20:40:39', 7),
(44, '1', 'Precise has updated Material name Aluminium-p', '1', '1', '2024-10-23 20:40:49', 7),
(45, '1', 'Precise has added updated Models NFM', '1', '1', '2024-10-23 21:04:43', NULL),
(46, '1', 'Precise has added updated Models NFM', '1', '1', '2024-10-23 21:05:20', NULL),
(47, '1', 'Precise has added updated Models NFM', '1', '1', '2024-10-23 21:05:53', NULL),
(48, '1', 'Precise has added updated Models NFM', '1', '1', '2024-10-23 21:07:20', NULL),
(49, '1', 'Precise has added new Models demi', '1', '1', '2024-10-23 21:07:29', 7),
(50, '1', 'Precise has added updated Models demi', '1', '1', '2024-10-23 21:07:38', NULL),
(51, '1', 'Precise has deleted models demi', '1', '1', '2024-10-23 21:07:43', 7),
(52, '1', 'Precise has created new order - 7', '1', '1', '2024-10-23 21:11:07', 7),
(53, '1', 'Precise has created new order - 8', '1', '1', '2024-10-23 21:11:07', 8),
(54, '1', 'Precise has created new order - 9', '1', '1', '2024-10-23 21:11:07', 9),
(55, '1', 'Precise has created new order - 10', '1', '1', '2024-10-23 21:11:07', 10),
(56, '5', 'you have been assigned a new order number 10 by Precise', '0', '1', '2024-10-23 21:27:30', 10),
(57, '12', 'you have been assigned a new order number 7 by Precise', '0', '1', '2024-10-23 22:29:34', 7),
(58, '13', 'you have been assigned a new order number 7 by Precise', '0', '1', '2024-10-23 22:30:29', 7),
(59, '1', 'parag has started working on order number 7', '0', '13', '2024-10-23 22:30:36', 7),
(60, '1', 'parag has completed order number 7', '0', '13', '2024-10-23 22:41:22', 7),
(61, '12', 'you have been assigned a new order number 7 by Precise', '0', '1', '2024-10-23 22:42:21', 7),
(62, '1', 'prashant has started working on order number 7', '0', '12', '2024-10-23 22:58:32', 7),
(63, '1', 'prashant has started working on order number 7', '0', '12', '2024-10-23 23:00:53', 7),
(64, '1', 'prashant has started working on order number 7', '0', '12', '2024-10-23 23:03:21', 7),
(65, '1', 'prashant has started working on order number 7', '0', '12', '2024-10-23 23:09:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

DROP TABLE IF EXISTS `member_type`;
CREATE TABLE IF NOT EXISTS `member_type` (
  `member_type_id` int NOT NULL AUTO_INCREMENT,
  `member_type_token` varchar(255) DEFAULT NULL,
  `member_type_name` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `member_type_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `member_type_position` int DEFAULT NULL,
  `fees` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`member_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`member_type_id`, `member_type_token`, `member_type_name`, `member_type_status`, `member_type_position`, `fees`, `profile_image`) VALUES
(1, NULL, 'Color work', 'delete', NULL, NULL, NULL),
(2, NULL, 'NFM', 'active', NULL, NULL, '_profile_main_images.jpg'),
(3, NULL, 'RD', NULL, NULL, NULL, NULL),
(4, NULL, 'sdsddsaswewew', 'delete', NULL, NULL, NULL),
(5, NULL, 'NPP', 'delete', NULL, NULL, NULL),
(6, NULL, 'NFMP', 'delete', NULL, NULL, NULL),
(7, NULL, 'demi', 'delete', NULL, NULL, '_profile_main_images.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int NOT NULL AUTO_INCREMENT,
  `notification_user_id` varchar(255) DEFAULT NULL,
  `notification_content` longtext,
  `notification_read` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `notification_type` varchar(255) DEFAULT NULL,
  `notification_type_id` int DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `order_token` varchar(255) DEFAULT NULL,
  `table_date` date DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `notification_user_id`, `notification_content`, `notification_read`, `user_type`, `notification_type`, `notification_type_id`, `created_by`, `created_date`, `order_id`, `order_token`, `table_date`) VALUES
(1, '12', 'you have been assigned a new order number 2 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-22 20:14:33', 2, NULL, NULL),
(2, '1', 'prashant has started working on order number 2', '1', NULL, NULL, NULL, '12', '2024-10-22 20:19:48', 2, NULL, NULL),
(3, '12', 'you have been assigned a new order number 3 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-22 20:21:37', 3, NULL, NULL),
(4, '12', 'you have been assigned a new order number 4 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-22 20:23:17', 4, NULL, NULL),
(5, '1', 'prashant has started working on order number 2', '1', NULL, NULL, NULL, '12', '2024-10-22 20:34:50', 2, NULL, NULL),
(6, '5', 'you have been assigned a new order number 2 by prashant', '1', NULL, NULL, NULL, '12', '2024-10-22 20:36:57', 2, NULL, NULL),
(7, '1', 'prashant has completed order number 2', '1', NULL, NULL, NULL, '12', '2024-10-22 20:40:26', 2, NULL, NULL),
(8, '13', 'you have been assigned a new order number 2 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-22 20:45:02', 2, NULL, NULL),
(9, '1', 'parag has started working on order number 2', '1', NULL, NULL, NULL, '13', '2024-10-22 20:46:11', 2, NULL, NULL),
(10, '5', 'you have been assigned a new order number 10 by Precise', '0', NULL, NULL, NULL, '1', '2024-10-23 21:27:30', 10, NULL, NULL),
(11, '12', 'you have been assigned a new order number 7 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-23 22:29:34', 7, NULL, NULL),
(12, '13', 'you have been assigned a new order number 7 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-23 22:30:29', 7, NULL, NULL),
(13, '1', 'parag has started working on order number 7', '0', NULL, NULL, NULL, '13', '2024-10-23 22:30:36', 7, NULL, NULL),
(14, '1', 'parag has completed order number 7', '0', NULL, NULL, NULL, '13', '2024-10-23 22:41:22', 7, NULL, NULL),
(15, '12', 'you have been assigned a new order number 7 by Precise', '1', NULL, NULL, NULL, '1', '2024-10-23 22:42:21', 7, NULL, NULL),
(16, '1', 'prashant has started working on order number 7', '0', NULL, NULL, NULL, '12', '2024-10-23 22:58:32', 7, NULL, NULL),
(17, '1', 'prashant has started working on order number 7', '0', NULL, NULL, NULL, '12', '2024-10-23 23:00:53', 7, NULL, NULL),
(18, '1', 'prashant has started working on order number 7', '0', NULL, NULL, NULL, '12', '2024-10-23 23:03:21', 7, NULL, NULL),
(19, '1', 'prashant has started working on order number 7', '0', NULL, NULL, NULL, '12', '2024-10-23 23:09:00', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `orderno` int NOT NULL AUTO_INCREMENT,
  `parentid` int DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `indent_no` varchar(100) DEFAULT NULL,
  `hsn_code` varchar(50) DEFAULT NULL,
  `sr_no` int DEFAULT NULL,
  `job_description` text,
  `drawing_no` varchar(100) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `proposed_raw_material_size` varchar(255) DEFAULT NULL,
  `approx_fim_cost` decimal(10,2) DEFAULT NULL,
  `id_no_from` varchar(100) DEFAULT NULL,
  `id_no_to` varchar(255) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `gst_rate` decimal(5,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `materialname` varchar(200) DEFAULT NULL,
  `modelname` varchar(200) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderno`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderno`, `parentid`, `filename`, `indent_no`, `hsn_code`, `sr_no`, `job_description`, `drawing_no`, `qty`, `material`, `proposed_raw_material_size`, `approx_fim_cost`, `id_no_from`, `id_no_to`, `project`, `model`, `gst_rate`, `status`, `materialname`, `modelname`, `order_status`, `created_date`, `updated_date`) VALUES
(6, NULL, '2024001194_Annexure_1_with_FIM_cost_(1)3.xlsx', 'SAC/APUR/MESA/2024 00 1194', 'Machining of Components-HSN code 88039000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-23 21:11:07', '2024-10-23 21:11:07'),
(7, 6, '', 'SAC/APUR/MESA/2024 00 1194', NULL, 1, 'X-BAND WAVEGUIDE-PATCH ARRAY ANTENNA BASE PLATE', 'GEN-AMDD-AMDD-1156, SH 1/4', 4, '1', 'BY VENDOR', '0.00', 'GEN16768-01-01', 'GEN16768-01-04', 'RD', '2', '5.00', '1', 'AL. ALLOY', 'NFM', 'inprogress', '2024-10-23 21:11:07', '2024-10-23 22:58:32'),
(8, 6, '', 'SAC/APUR/MESA/2024 00 1194', NULL, 2, 'X-BAND WAVEGUIDE-PATCH ARRAY ANTENNA COVER', 'GEN-AMDD-AMDD-1156, SH 2/4', 4, '1', 'BY VENDOR', '0.00', 'GEN16768-02-01', 'GEN16768-02-04', 'RD', '2', '5.00', '1', 'AL. ALLOY', 'NFM', 'new', '2024-10-23 21:11:07', '2024-10-23 21:11:07'),
(9, 6, '', 'SAC/APUR/MESA/2024 00 1194', NULL, 3, 'X-BAND WAVEGUIDE-PATCH ARRAY ANTENNA INNER PART', 'GEN-AMDD-AMDD-1156, SH 3/4', 76, '1', 'BY VENDOR', '0.00', 'GEN16768-03-01', 'GEN16768-03-76', 'RD', '2', '5.00', '1', 'AL. ALLOY', 'NFM', 'new', '2024-10-23 21:11:07', '2024-10-23 21:11:07'),
(10, 6, '', 'SAC/APUR/MESA/2024 00 1194', NULL, 4, 'X-BAND WAVEGUIDE-PATCH ARRAY ANTENNA OUTRER PART', 'GEN-AMDD-AMDD-1156, SH 4/4', 5, '1', 'BY VENDOR', '0.00', 'GEN16768-04-01', 'GEN16768-04-05', 'RD', '2', '5.00', '1', 'AL. ALLOY', 'NFM', 'assigned', '2024-10-23 21:11:07', '2024-10-23 21:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `ordertimelog`
--

DROP TABLE IF EXISTS `ordertimelog`;
CREATE TABLE IF NOT EXISTS `ordertimelog` (
  `otid` int NOT NULL AUTO_INCREMENT,
  `orderno` int DEFAULT NULL,
  `as_id` int DEFAULT NULL,
  `assignby` varchar(255) DEFAULT NULL,
  `assignto` varchar(255) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`otid`),
  KEY `orderno` (`orderno`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ordertimelog`
--

INSERT INTO `ordertimelog` (`otid`, `orderno`, `as_id`, `assignby`, `assignto`, `starttime`, `endtime`, `notes`) VALUES
(1, 7, 1, '1', '13', '2024-10-23 22:30:36', '2024-10-23 22:38:50', NULL),
(5, 7, 2, '1', '12', '2024-10-23 23:09:00', '2024-10-23 23:09:21', NULL),
(4, 7, 2, '1', '12', '2024-10-23 23:03:21', '2024-10-23 23:04:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_assign`
--

DROP TABLE IF EXISTS `order_assign`;
CREATE TABLE IF NOT EXISTS `order_assign` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderid` int DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `assign_by` int DEFAULT NULL,
  `assign_to` int DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_assign`
--

INSERT INTO `order_assign` (`id`, `orderid`, `assign_date`, `assign_by`, `assign_to`, `status`) VALUES
(1, 7, '2024-10-23', 1, 13, 'done'),
(2, 7, '2024-10-23', 1, 12, 'inprogress');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `codename` varchar(100) DEFAULT NULL,
  `parent_status` varchar(30) DEFAULT NULL,
  `description` longtext,
  `show` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`, `show`) VALUES
(1, 'name', 'codename', 'parent_status', 'description', 'show'),
(2, 'dashboard', 'dashboard', 'parent', '', 'yes'),
(3, 'Material', 'master_management', 'parent', '', 'yes'),
(4, 'manage_material', 'manage_material', 'sub_parent', NULL, 'yes'),
(5, 'add', 'material_add', 'sub_child', NULL, 'yes'),
(6, 'edit', 'material_edit', 'sub_child', NULL, 'yes'),
(7, 'view', 'material_view', 'sub_child', NULL, 'yes'),
(8, 'delete', 'material_delete', 'sub_child', NULL, 'yes'),
(9, 'manage_country', 'country', 'sub_parent', '', 'yes'),
(10, 'add', 'country_add', 'sub_child', '', 'yes'),
(11, 'edit', 'country_edit', 'sub_child', '', 'yes'),
(12, 'delete', 'country_delete', 'sub_child', '', 'yes'),
(13, 'process_master', 'process_master', 'sub_parent', '', 'yes'),
(14, 'delete', 'pm_delete', 'sub_child', '', 'yes'),
(15, 'edit', 'pm_edit', 'sub_child', '', 'yes'),
(16, 'add', 'pm_add', 'sub_child', '', 'yes'),
(17, 'Application Setting', 'application_setting', 'parent', NULL, 'yes'),
(18, 'front setting', 'front_setting', 'parent', '', 'yes'),
(19, 'display setting', 'display_setting', 'sub_parent', '', 'yes'),
(20, 'logo', 'logo', 'sub_child', '', 'yes'),
(21, 'favicon', 'favicon', 'sub_child', '', 'yes'),
(22, 'Order Master', 'orm', 'parent', '', 'yes'),
(23, 'edit', 'orm_edit', 'sub_child', NULL, 'yes'),
(24, 'add', 'orm_add', 'sub_child', NULL, 'yes'),
(25, 'view', 'orm_view', 'sub_child', NULL, 'yes'),
(26, 'delete', 'orm_delete', 'sub_child', NULL, 'yes'),
(27, 'staff', 'staff', 'parent', '', 'yes'),
(28, 'staff list', 'staff_list', 'sub_parent', '', 'yes'),
(29, 'staff add', 'staff_add', 'sub_child', '', 'yes'),
(30, 'staff edit', 'staff_edit', 'sub_child', '', 'yes'),
(31, 'staff delete', 'staff_delete', 'sub_child', '', 'yes'),
(32, 'staff role', 'staff_role', 'sub_parent', '', 'yes'),
(33, 'staff role add', 'staff_role_add', 'sub_child', '', 'yes'),
(34, 'staff role edit', 'staff_role_edit', 'sub_child', '', 'yes'),
(35, 'staff role delete', 'staff_role_delete', 'sub_child', '', 'yes'),
(36, 'notification', 'notification', 'parent', '', 'yes'),
(37, 'Order Action', 'orma', 'parent', '', 'yes'),
(38, 'status', 'orma_delete', 'sub_child', NULL, 'yes'),
(39, 'Track Time', 'orma_track', 'sub_child', NULL, 'yes'),
(40, 'Assign', 'orma_add', 'sub_child', NULL, 'yes'),
(41, 'Report', 'report', 'sub_child', NULL, 'yes'),
(42, 'Orders', 'Orders', 'parent', '', 'yes'),
(43, 'add', 'or_add', 'sub_child', NULL, 'yes'),
(44, 'view', 'or_view', 'sub_child', NULL, 'yes'),
(45, 'Employee Order', 'or_assign', 'sub_child', NULL, 'yes'),
(46, 'delete', 'or_delete', 'sub_child', NULL, 'yes'),
(47, 'Users', 'users', 'parent', '', 'yes'),
(48, 'add', 'users_add', 'sub_parent', '', 'yes'),
(49, 'edit', 'users_edit', 'sub_parent', '', 'yes'),
(50, 'delete', 'users_delete', 'sub_parent', '', 'yes'),
(51, 'status', 'users_status', 'sub_parent', '', 'yes'),
(52, 'view', 'users_view', 'sub_parent', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `process_master`
--

DROP TABLE IF EXISTS `process_master`;
CREATE TABLE IF NOT EXISTS `process_master` (
  `process_master_id` int NOT NULL AUTO_INCREMENT,
  `pm_name` varchar(255) DEFAULT NULL,
  `pm_status` varchar(255) NOT NULL,
  PRIMARY KEY (`process_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `process_master`
--

INSERT INTO `process_master` (`process_master_id`, `pm_name`, `pm_status`) VALUES
(2, 'Colouring', 'active'),
(3, 'cutting', 'active'),
(4, 'welding', 'active'),
(9, 'Machine DMG', 'active'),
(10, 'Machine DMG1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `permission` longtext,
  `description` longtext,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `name`, `permission`, `description`) VALUES
(4, 'Employee', '[\"2\",\"37\",\"38\",\"39\",\"40\",\"41\",\"45\"]', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `member_type_id` int NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `member_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adharcard` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pancard` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adharcard_image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pancard_image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('active','deactive','block','delete') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `update_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birth_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `division` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `district_m` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taluka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taluka_m` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gram_panchayat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `police_station_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `area` int DEFAULT NULL,
  `payment_mode` int DEFAULT NULL,
  `payment_proof_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `blood_group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fees` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
