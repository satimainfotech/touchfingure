-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2024 at 11:55 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=815 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`, `description`, `show`) VALUES
(1, 'dashboard', 'dashboard', 'parent', '', 'yes'),
(808, 'edit', 'orm_edit', 'sub_child', NULL, 'yes'),
(807, 'add', 'orm_add', 'sub_child', NULL, 'yes'),
(2, 'Material', 'master_management', 'parent', '', 'yes'),
(3, 'manage_country', 'country', 'sub_parent', '', 'yes'),
(4, 'add', 'country_add', 'sub_child', '', 'yes'),
(5, 'edit', 'country_edit', 'sub_child', '', 'yes'),
(6, 'delete', 'country_delete', 'sub_child', '', 'yes'),
(395, 'front setting', 'front_setting', 'parent', '', 'yes'),
(400, 'display setting', 'display_setting', 'sub_parent', '', 'yes'),
(806, 'Order Master', 'orm', 'parent', '', 'yes'),
(420, 'logo', 'logo', 'sub_child', '', 'yes'),
(425, 'favicon', 'favicon', 'sub_child', '', 'yes'),
(805, 'view', 'or_view', 'sub_child', NULL, 'yes'),
(803, 'Assigned', 'or_assign', 'sub_child', NULL, 'yes'),
(804, 'delete', 'or_delete', 'sub_child', NULL, 'yes'),
(7, 'process_master', 'process_master', 'sub_parent', '', 'yes'),
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
(814, 'status', 'orma_delete', 'sub_child', NULL, 'yes'),
(813, 'Track Time', 'orma_track', 'sub_child', NULL, 'yes'),
(812, 'Assign', 'orma_add', 'sub_child', NULL, 'yes'),
(811, 'Order Action', 'orma', 'parent', '', 'yes'),
(810, 'view', 'orm_view', 'sub_child', NULL, 'yes'),
(777, 'status', 'country_status', 'sub_parent', NULL, 'yes'),
(776, 'view', 'country_view', 'sub_parent', NULL, 'yes'),
(23, 'manage_material', 'manage_material', 'sub_parent', NULL, 'yes'),
(24, 'add', 'material_add', 'sub_child', NULL, 'yes'),
(25, 'edit', 'material_edit', 'sub_child', NULL, 'yes'),
(26, 'view', 'material_view', 'sub_child', NULL, 'yes'),
(27, 'delete', 'material_delete', 'sub_child', NULL, 'yes'),
(809, 'delete', 'orm_delete', 'sub_child', NULL, 'yes'),
(801, 'Orders', 'Orders', 'parent', '', 'yes'),
(800, 'delete', 'pm_delete', 'sub_child', '', 'yes'),
(799, 'edit', 'pm_edit', 'sub_child', '', 'yes'),
(798, 'add', 'pm_add', 'sub_child', '', 'yes'),
(790, 'Users', 'users', 'parent', '', 'yes'),
(791, 'add', 'users_add', 'sub_parent', '', 'yes'),
(792, 'edit', 'users_edit', 'sub_parent', '', 'yes'),
(793, 'delete', 'users_delete', 'sub_parent', '', 'yes'),
(794, 'status', 'users_status', 'sub_parent', '', 'yes'),
(795, 'view', 'users_view', 'sub_parent', '', 'yes'),
(802, 'add', 'or_add', 'sub_child', NULL, 'yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
