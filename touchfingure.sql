-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2024 at 09:59 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

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
  `timestamp` varchar(20) DEFAULT NULL,
  `admin_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `phone`, `address`, `email`, `password`, `orignal_password`, `role`, `timestamp`, `admin_status`) VALUES
(1, 'GAURANG GAMETI ', '', '', 'roopsinghtetarawal@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, '1', '1549100984', 'Active'),
(5, 'Jayesh', '1234567890', 'tets', 'jayesh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '3', '1550475820', 'Active'),
(6, 'GAURANG GAMETI ', '1234567890', '', 'roopsinghtetarawals@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '1', '1592485858', 'Active'),
(7, 'PARESH PATEL', '01234567890', '', 'patelparesh1990@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '1234567', '3', '1728374509', NULL);

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
('vaoott1htbn1e7hkl6abb30tq9njmifo', '::1', 1728380582, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732383338303432353b),
('qgrdoln046fhgj46lggbcdep8fm7vlhn', '::1', 1728381552, 0x5f5f63695f6c6173745f726567656e65726174657c693a313732383338313535313b6c6f67696e7c733a333a22796573223b61646d696e5f6c6f67696e7c733a333a22796573223b61646d696e5f69647c733a313a2231223b61646d696e5f6e616d657c733a31353a2247415552414e472047414d45544920223b7469746c657c733a353a2261646d696e223b70616e656c5f7469746c657c733a353a2261646d696e223b726f6c657c733a313a2231223b);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) DEFAULT NULL,
  `country_status` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_status`) VALUES
(1, 'AL. ALLOY', 'active');

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
  `general_settings_id` int NOT NULL,
  `type` longtext,
  `value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

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
(87, 'fav_ext', 'png'),
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
(87, 'fav_ext', 'png'),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logo_id`, `name`) VALUES
(2, '');

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
  PRIMARY KEY (`member_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`member_type_id`, `member_type_token`, `member_type_name`, `member_type_status`, `member_type_position`, `fees`) VALUES
(1, NULL, 'Color work', 'delete', NULL, NULL),
(2, NULL, 'NFM', 'active', NULL, NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=801 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`, `show`) VALUES
(1, 'dashboard', 'dashboard', 'parent', '', 'yes'),
(782, 'view', 'area_view', 'sub_parent', NULL, 'yes'),
(783, 'status', 'area_status', 'sub_parent', NULL, 'yes'),
(2, 'Material', 'master_management', 'parent', '', 'yes'),
(3, 'manage_country', 'country', 'sub_parent', '', 'yes'),
(4, 'add', 'country_add', 'sub_child', '', 'yes'),
(5, 'edit', 'country_edit', 'sub_child', '', 'yes'),
(6, 'delete', 'country_delete', 'sub_child', '', 'yes'),
(395, 'front setting', 'front_setting', 'parent', '', 'yes'),
(400, 'display setting', 'display_setting', 'sub_parent', '', 'yes'),
(415, 'slider', 'slider', 'sub_child', '', 'yes'),
(420, 'logo', 'logo', 'sub_child', '', 'yes'),
(425, 'favicon', 'favicon', 'sub_child', '', 'yes'),
(430, 'footer', 'footer', 'sub_child', '', 'yes'),
(435, 'setting', 'setting', 'sub_parent', '', 'yes'),
(440, 'site setting', 'site_setting', 'sub_child', '', 'yes'),
(797, 'process_master', 'process_master', 'sub_parent', '', 'yes'),
(500, 'staff', 'staff', 'parent', '', 'yes'),
(505, 'staff list', 'staff_list', 'sub_parent', '', 'yes'),
(510, 'staff add', 'staff_add', 'sub_child', '', 'yes'),
(515, 'staff edit', 'staff_edit', 'sub_child', '', 'yes'),
(520, 'staff delete', 'staff_delete', 'sub_child', '', 'yes'),
(525, 'staff role', 'staff_role', 'sub_parent', '', 'yes'),
(530, 'staff role add', 'staff_role_add', 'sub_child', '', 'yes'),
(535, 'staff role edit', 'staff_role_edit', 'sub_child', '', 'yes'),
(540, 'staff role delete', 'staff_role_delete', 'sub_child', '', 'yes'),
(640, 'notification', 'notification', 'parent', '', 'yes'),
(654, 'Application Setting', 'application_setting', 'parent', NULL, 'yes'),
(777, 'status', 'country_status', 'sub_parent', NULL, 'yes'),
(776, 'view', 'country_view', 'sub_parent', NULL, 'yes'),
(23, 'manage_material', 'manage_material', 'sub_parent', NULL, 'yes'),
(24, 'add', 'material_add', 'sub_child', NULL, 'yes'),
(25, 'edit', 'material_edit', 'sub_child', NULL, 'yes'),
(26, 'view', 'material_view', 'sub_child', NULL, 'yes'),
(27, 'delete', 'material_delete', 'sub_child', NULL, 'yes'),
(800, 'delete', 'pm_delete', 'sub_child', '', 'yes'),
(799, 'edit', 'pm_edit', 'sub_child', '', 'yes'),
(798, 'add', 'pm_add', 'sub_child', '', 'yes'),
(790, 'Users', 'users', 'parent', '', 'yes'),
(791, 'add', 'users_add', 'sub_parent', '', 'yes'),
(792, 'edit', 'users_edit', 'sub_parent', '', 'yes'),
(793, 'delete', 'users_delete', 'sub_parent', '', 'yes'),
(794, 'status', 'users_status', 'sub_parent', '', 'yes'),
(795, 'view', 'users_view', 'sub_parent', '', 'yes'),
(796, 'product', 'product', 'parent', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `process_master`
--

DROP TABLE IF EXISTS `process_master`;
CREATE TABLE IF NOT EXISTS `process_master` (
  `pm_id` int NOT NULL AUTO_INCREMENT,
  `pm_name` varchar(255) DEFAULT NULL,
  `pm_status` varchar(255) NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `process_master`
--

INSERT INTO `process_master` (`pm_id`, `pm_name`, `pm_status`) VALUES
(2, 'Created1', 'de-active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int NOT NULL,
  `products_token` varchar(255) DEFAULT NULL,
  `products_name` varchar(255) DEFAULT NULL,
  `products_status` varchar(255) DEFAULT NULL,
  `intrest_rate` varchar(255) NOT NULL,
  `days` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `products_token`, `products_name`, `products_status`, `intrest_rate`, `days`) VALUES
(9, 'FBKW4U006Q2B3B8CE2Z4RUCDCJCLE52769N98T81821A2S3256', 'mairaya', 'Active', '', 0),
(8, '52XLDA6938K92APN385HAM86545KHV65EMX0S517M3R694WSCK', 'ets', 'Active', '10', 120),
(10, 'P5064IDWP77JDCUR49Y097W1O1CA1MNP28H923U8MEH203I75X', 'hdfc', 'Active', '', 0),
(11, '52V8Z3ZN4O8Y6BE2G0NCHG0TUAAANWIVK5C6TEGK3008SUDTO7', 'test dddd', 'Active', '', 0),
(9, 'FBKW4U006Q2B3B8CE2Z4RUCDCJCLE52769N98T81821A2S3256', 'mairaya', 'Active', '', 0),
(8, '52XLDA6938K92APN385HAM86545KHV65EMX0S517M3R694WSCK', 'ets', 'Active', '10', 120),
(10, 'P5064IDWP77JDCUR49Y097W1O1CA1MNP28H923U8MEH203I75X', 'hdfc', 'Active', '', 0),
(11, '52V8Z3ZN4O8Y6BE2G0NCHG0TUAAANWIVK5C6TEGK3008SUDTO7', 'test dddd', 'Active', '', 0),
(9, 'FBKW4U006Q2B3B8CE2Z4RUCDCJCLE52769N98T81821A2S3256', 'mairaya', 'Active', '', 0),
(8, '52XLDA6938K92APN385HAM86545KHV65EMX0S517M3R694WSCK', 'ets', 'Active', '10', 120),
(10, 'P5064IDWP77JDCUR49Y097W1O1CA1MNP28H923U8MEH203I75X', 'hdfc', 'Active', '', 0),
(11, '52V8Z3ZN4O8Y6BE2G0NCHG0TUAAANWIVK5C6TEGK3008SUDTO7', 'test dddd', 'Active', '', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `name`, `permission`, `description`) VALUES
(3, 'Color Work', 'null', 'Color Work');

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
