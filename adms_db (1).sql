-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 08:45 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_group_permissions`
--

CREATE TABLE `auth_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_message`
--

CREATE TABLE `auth_message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `name`, `content_type_id`, `codename`) VALUES
(1, 'Can add session', 1, 'add_session'),
(2, 'Can change session', 1, 'change_session'),
(3, 'Can delete session', 1, 'delete_session'),
(4, 'Can add permission', 2, 'add_permission'),
(5, 'Can change permission', 2, 'change_permission'),
(6, 'Can delete permission', 2, 'delete_permission'),
(7, 'Can add group', 3, 'add_group'),
(8, 'Can change group', 3, 'change_group'),
(9, 'Can delete group', 3, 'delete_group'),
(10, 'Can add user', 4, 'add_user'),
(11, 'Can change user', 4, 'change_user'),
(12, 'Can delete user', 4, 'delete_user'),
(13, 'Can add message', 5, 'add_message'),
(14, 'Can change message', 5, 'change_message'),
(15, 'Can delete message', 5, 'delete_message'),
(16, 'Can add content type', 6, 'add_contenttype'),
(17, 'Can change content type', 6, 'change_contenttype'),
(18, 'Can delete content type', 6, 'delete_contenttype'),
(19, 'Can add log entry', 7, 'add_logentry'),
(20, 'Can change log entry', 7, 'change_logentry'),
(21, 'Can delete log entry', 7, 'delete_logentry'),
(22, 'Can add department', 8, 'add_department'),
(23, 'Can change department', 8, 'change_department'),
(24, 'Can delete department', 8, 'delete_department'),
(25, 'Can add device', 9, 'add_iclock'),
(26, 'Can change device', 9, 'change_iclock'),
(27, 'Can delete device', 9, 'delete_iclock'),
(28, 'Pause device', 9, 'pause_iclock'),
(29, 'Resume a resumed device', 9, 'resume_iclock'),
(30, 'Upgrade firmware', 9, 'upgradefw_iclock'),
(31, 'Copy data between device', 9, 'copyudata_iclock'),
(32, 'Upload data again', 9, 'reloaddata_iclock'),
(33, 'Upload transactions again', 9, 'reloadlogdata_iclock'),
(34, 'Refresh device information', 9, 'info_iclock'),
(35, 'Reboot device', 9, 'reboot_iclock'),
(36, 'Upload new data', 9, 'loaddata_iclock'),
(37, 'Clear data in device', 9, 'cleardata_iclock'),
(38, 'Clear transactions in device', 9, 'clearlog_iclock'),
(39, 'Set options of device', 9, 'devoption_iclock'),
(40, 'Reset Password in device', 9, 'resetPwd_iclock'),
(41, 'Restore employee to device', 9, 'restoreData_iclock'),
(42, 'Output unlock signal', 9, 'unlock_iclock'),
(43, 'Terminate alarm signal', 9, 'unalarm_iclock'),
(44, 'Clear all employee', 9, 'clear_all_employee'),
(45, 'Upgrade by u-pack', 9, 'upgrade_by_u-pack'),
(46, 'Can add admin granted department', 10, 'add_deptadmin'),
(47, 'Can change admin granted department', 10, 'change_deptadmin'),
(48, 'Can delete admin granted department', 10, 'delete_deptadmin'),
(49, 'Can add employee', 11, 'add_employee'),
(50, 'Can change employee', 11, 'change_employee'),
(51, 'Can delete employee', 11, 'delete_employee'),
(52, 'Transfer employee to the device', 11, 'toDev_employee'),
(53, 'Transfer to the device templately', 11, 'toDevWithin_employee'),
(54, 'Delete employee from the device', 11, 'delDev_employee'),
(55, 'Employee leave', 11, 'empLeave_employee'),
(56, 'Move employee to a new device', 11, 'mvToDev_employee'),
(57, 'Change employee\'s department', 11, 'toDepart_employee'),
(58, 'Enroll employee\'s fingerprint', 11, 'enroll_employee'),
(59, 'DataBase', 11, 'optionsDatabase_employee'),
(60, 'Can add fingerprint', 12, 'add_fptemp'),
(61, 'Can change fingerprint', 12, 'change_fptemp'),
(62, 'Can delete fingerprint', 12, 'delete_fptemp'),
(63, 'Can add transaction', 13, 'add_transaction'),
(64, 'Can change transaction', 13, 'change_transaction'),
(65, 'Can delete transaction', 13, 'delete_transaction'),
(66, 'Clear Obsolete Data', 13, 'clearObsoleteData_transaction'),
(67, 'Can add device operation log', 14, 'add_oplog'),
(68, 'Can change device operation log', 14, 'change_oplog'),
(69, 'Can delete device operation log', 14, 'delete_oplog'),
(70, 'Transaction Monitor', 14, 'monitor_oplog'),
(71, 'Can add data from device', 15, 'add_devlog'),
(72, 'Can change data from device', 15, 'change_devlog'),
(73, 'Can delete data from device', 15, 'delete_devlog'),
(74, 'Can add command to device', 16, 'add_devcmds'),
(75, 'Can change command to device', 16, 'change_devcmds'),
(76, 'Can delete command to device', 16, 'delete_devcmds'),
(77, 'Can add public information', 17, 'add_messages'),
(78, 'Can change public information', 17, 'change_messages'),
(79, 'Can delete public information', 17, 'delete_messages'),
(80, 'Can add information subscription', 18, 'add_iclockmsg'),
(81, 'Can change information subscription', 18, 'change_iclockmsg'),
(82, 'Can delete information subscription', 18, 'delete_iclockmsg'),
(83, 'Can add administration log', 19, 'add_adminlog'),
(84, 'Can change administration log', 19, 'change_adminlog'),
(85, 'Can delete administration log', 19, 'delete_adminlog'),
(86, 'Can browse ContentType', 6, 'browse_contenttype'),
(87, 'Can browse DeptAdmin', 10, 'browse_deptadmin'),
(88, 'Can browse Group', 3, 'browse_group'),
(89, 'Can browse IclockMsg', 18, 'browse_iclockmsg'),
(90, 'Can browse Permission', 2, 'browse_permission'),
(91, 'Can browse User', 4, 'browse_user'),
(92, 'Can browse adminLog', 19, 'browse_adminlog'),
(93, 'Can browse department', 8, 'browse_department'),
(94, 'Can browse devcmds', 16, 'browse_devcmds'),
(95, 'Can browse devlog', 15, 'browse_devlog'),
(96, 'Can browse employee', 11, 'browse_employee'),
(97, 'Can browse fptemp', 12, 'browse_fptemp'),
(98, 'Can browse iclock', 9, 'browse_iclock'),
(99, 'Can browse messages', 17, 'browse_messages'),
(100, 'Can browse oplog', 14, 'browse_oplog'),
(101, 'Can browse transaction', 13, 'browse_transaction'),
(102, 'Init database', 13, 'init_database');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `is_staff`, `is_active`, `is_superuser`, `last_login`, `date_joined`) VALUES
(1, 'admin', '', '', 'fae_service@zkteco.com', 'sha1$a4092$80f932d22eab14c0a15562cc71ca7d9f00ebc952', 1, 1, 1, '2021-08-10 20:46:24', '2021-07-25 00:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_groups`
--

CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_user_permissions`
--

CREATE TABLE `auth_user_user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) UNSIGNED NOT NULL,
  `bidang_name` varchar(255) DEFAULT NULL,
  `kepala_bidang` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `bulan_id` int(11) UNSIGNED NOT NULL,
  `number_date` varchar(10) NOT NULL,
  `name_bulan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`bulan_id`, `number_date`, `name_bulan`, `created_at`, `updated_at`) VALUES
(1, '01', 'Januari', '2021-07-25 22:51:57', '2021-07-25 22:51:57'),
(2, '02', 'Februari', '2021-07-25 22:53:34', '2021-07-25 22:53:34'),
(3, '03', 'Maret', '2021-07-25 22:53:42', '2021-07-25 22:53:42'),
(4, '04', 'April', '2021-07-25 22:54:09', '2021-07-25 22:54:09'),
(5, '05', 'Mei', '2021-07-25 22:54:19', '2021-07-25 22:54:19'),
(6, '06', 'Juni', '2021-07-25 22:54:27', '2021-07-25 22:54:27'),
(7, '07', 'Juli', '2021-07-25 22:54:35', '2021-07-25 22:54:35'),
(8, '08', 'Agustus', '2021-07-25 22:54:46', '2021-07-25 22:54:46'),
(9, '09', 'September', '2021-07-25 22:55:00', '2021-07-25 22:55:00'),
(10, '10', 'Oktober', '2021-07-25 22:55:09', '2021-07-25 22:55:09'),
(11, '11', 'November', '2021-07-25 22:55:44', '2021-07-25 22:55:44'),
(12, '12', 'Desember', '2021-07-25 22:55:58', '2021-07-25 22:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `checkinout`
--

CREATE TABLE `checkinout` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `checktime` datetime NOT NULL,
  `checktype` varchar(1) NOT NULL,
  `verifycode` int(11) NOT NULL,
  `SN` varchar(20) DEFAULT NULL,
  `sensorid` varchar(5) DEFAULT NULL,
  `WorkCode` varchar(20) DEFAULT NULL,
  `Reserved` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DeptID` int(11) NOT NULL,
  `DeptName` varchar(20) NOT NULL,
  `supdeptid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DeptID`, `DeptName`, `supdeptid`) VALUES
(1, 'Our Company', 0);

-- --------------------------------------------------------

--
-- Table structure for table `devcmds`
--

CREATE TABLE `devcmds` (
  `id` int(11) NOT NULL,
  `SN_id` varchar(20) NOT NULL,
  `CmdContent` longtext NOT NULL,
  `CmdCommitTime` datetime NOT NULL,
  `CmdTransTime` datetime DEFAULT NULL,
  `CmdOverTime` datetime DEFAULT NULL,
  `CmdReturn` int(11) DEFAULT NULL,
  `User_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devcmds`
--

INSERT INTO `devcmds` (`id`, `SN_id`, `CmdContent`, `CmdCommitTime`, `CmdTransTime`, `CmdOverTime`, `CmdReturn`, `User_id`) VALUES
(1, '6339160200267', 'INFO', '2021-07-25 00:09:01', '2021-07-25 00:09:03', '2021-07-25 00:09:06', 0, NULL),
(2, '6339160200267', 'CHECK', '2021-07-25 00:09:01', '2021-07-25 00:09:03', '2021-07-25 00:09:06', 0, NULL),
(3, '6339160200267', 'CHECK', '2021-07-25 00:09:31', '2021-07-25 00:09:33', '2021-07-25 00:09:33', 0, NULL),
(4, '6339160200267', 'CHECK', '2021-08-01 00:39:15', '2021-08-01 00:39:17', '2021-08-01 00:39:17', 0, NULL),
(5, '6339160200267', 'CHECK', '2021-08-10 21:14:38', '2021-08-10 21:14:40', '2021-08-10 21:14:40', 0, NULL),
(6, '6339160200267', 'DATA USER PIN=71196	Name=Chan	Pri=14			TZ=0000000000000000	Grp=1', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:28', 0, NULL),
(7, '6339160200267', 'DATA FP PIN=71196	FID=0	Size=2000	Valid=1	TMP=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', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:28', 0, NULL),
(8, '6339160200267', 'DATA USER PIN=110795	Name=bayu	Pri=0			TZ=0000000000000000	Grp=1', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:28', 0, NULL),
(9, '6339160200267', 'DATA FP PIN=110795	FID=0	Size=1576	Valid=1	TMP=TdtTUzIxAAAEmJ8ECAUHCc7QAAAcmWkBAAAAhEUor5hUAIoPmgCsAIGWSgBrAPQPvQBqmHkP7gBuAN0Ptph9ABEO+QBFAJyXpgCEAIcO3QCMmFgOmACQALwOvpiTAIcP+QBRACWXegCeAPkN0wChmEsOgACoAJoPgJizAGMP9gB2AC+XZwC0AE0PswCzmOUPOwC4AI8PF5i7AMsOngB5AGSXIgC9ANIOugDMmEQPngDYAOcP15jiAKIP6gArALSXaQD3ADgPuwAEmS8PowAAAd8PkJgIAR0PkQDLASaXdQAXAS0P+gAmmTMPJgAjAfQPMZgrAbcP0ADrAY+XXQAxAbQPGAAxmeUPUwBHAe4PUZ8zejsE2f/vAB7sk3/7n6//w/WKHyoAkYGe+iYL0RSgjg6MKXlUgSv14HhdERUCrBNrCWKK7fV2gCtoqeKUAn4RIYlj+BKStZ+1mtEWuIFl4/jzUP/Qa7x9yJ+QgM1uGgzelbcTPGgh8zLsVIAhAHSFrXq2gg8DuWB8gbaCsf+kQ5aENAililmLLGEBfv/oIcfy3V8K9W5qgkuKZRJehye/WA56DV8YqA7lYmAS0fzN+i/tvGZMBPXyNAaACv1uJAJKDAb1cX/JmmOAYXxNAp5+qB9ciNIGCahSc8NHHIpihK6J9Fhjrz7PJXr2d8f76UiUut8gQgHHlSVHBwCVFw/CBUMMmIgdDMDBUToJBOImBkrAwE7UAC+v7Cv+YFhKBf8WmCpB8UY2/phY+8IQADxG8P/u/0DO/v52CgCnlIxYWv7EhA4AopOJb1rAw8HAwcKbBwQ3Vw9TQBEAiGfpZipERsD+wv0GBA5phnjDEgCxbIRc/pLCcolRBAcE329pwoPBD8V8apvAPv87wEM6AwRqcRf/CQB0tHqNWsN8FQCte0nDXQvAw3PDwHS7CgQtegzA/ThW1wCV5oHAwsKJwwWBxObDBwC1gBYH/vnDFgD1gpdnomXGWcOLkGQRAFSDhFrBxXHDwcAEeHCJAauFEEDAOjI2Wf1aBgByjzH++t4VAJSQfZYHwpTgwcHDwWIRxWuR85PCwXJ3wQR7FpiVlv3+wPw6O8RlRcH7/P4DxfySusANAHefaQbAmVjDbsITAH9l+kVmKi5CHP4QxXyi88b/g29njM4AgD/7wPz//jU7/w+YhrD3/v3+9f1umwH6tSfAEMWEsvjDw8PAw2eywXKbAfW3K/8OxWS8y4Z/dsOPCcU6v9TAcWoFAHN+U5SSAZq8bcajB8J3nwESvkPBwTjD+5ABgsTc+/o6/jWdAXvKTMOLwwCFVEeWwgUAoBQgxfQEAKDbIsBUBQWc3TfAZgoACuGkWMPCxcmuCsXX47H8/vn6/fs7/Q2YZPo9wmrCBMIQiKYBHMLEwwzKxVvBwMLG0KAEpwKI6gJD/Pr8OwwUGgItwYHDjkkLFOQFMMJywsIFpAKImQsiwcLBBwYUDREki8QIEFURLQjArgYQchv1hMWfEXgbLcHBBJUHiPgjV/wEEO8mKdwEED4mOsMFwAeIQiY0wgUQ2CczWXsEECQnNJIDFK8vNMIAjwTFUpWX', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:32', 0, NULL),
(10, '6339160200267', 'DATA USER PIN=15030100		Pri=0	Passwd=12345		TZ=0000000000000000	Grp=1', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:32', 0, NULL),
(11, '6339160200267', 'DATA FP PIN=15030100	FID=0	Size=1512	Valid=1	TMP=TSVTUzIxAAAEZmUECAUHCc7QAAAcZ2kBAAAAhIsmbWYqAHQPtgD1AIVpZgA1APEPBgA8ZgoPzwBEAEwPjmZJAHIPoQCSAARpfgBbAGYPhgB4ZtgPRwB/AJYPo2aWAGQPhgBcAFFpmwCoAPQPngDTZkIPqQDrAPcP12bsACoPxAAxAC5pjgD5ADQPwwH4ZrUNAAH/AOINWGYCAUAPxQDBASppLgAJAUEPrwALZzgP7AAZAWIP3GYbAagPyQDZAbVpPwApATgNlQArZ8EOZwAyAX8PpmYyASYPvwD+AR5pmgA8ATIOrABEZ6oPeABEAW8P2GZEAZwPWgCMAZtomgBJAbQOkYcuYT4RFXge+JODXBmngrqPDYxQhN9qmICWCGuJoA4hEaeCGZP+nZOD9ZAXacZ3wIlSd7/hyX0X7z8DvHGedtpnRWIq8C7zbfcoosfHfgeyD1N1XAu6AG4GAACpmdv7lfxFACD7PmK7/8f1OI7vDl/rSXa2gMOAmAkGmb8DEQSNfuwHam87A2eB5flLgaIcWAG2gFb5kPjdZ3x/yQiJhtuYUR/7+VKDTYkACvVFABBN/ukScfetEGcM8vR2gPNoLGmRg8aJkfAkAEVqYAB58lIMt4SmkZfvzfS551DjiOGYklINdnqe8TFGQAECeyECxgCbfwH/BQCTG7/CP2MBoyJ9dQXFWicEZgQAricA9QkEAC1xk2nBBsWyKuCFwgUAujHFMxRmqTOAwv+IsHTEpsMJAGM4aQTCxKT+dwUAxzjM/sWZFQDLP4zCB2aApIFgw//BBMXTQWr+wAcAhkaywoinBACORvc7wgCCKnXBw3UJAGBT/lfANhIAnVeywcfnw8DAwmR7BAkEw1v9Nf/AUMIAeDpqwnfBGgA7X5cWwMGLwMCdB8DGDFNZCgCiesX/NKY/CgCge3G8wsTlBgBCgVNqtgoEIYJQwMDD/gXBxKcaARGLmlywccamnG/AfmLA2gEV85tid4CAkAdmdD7+xpgOAIlT6fqb/v04Pv7AywCn8WqewcHCaq8RBOeaXMRmwmQHwWLqEQCGnVeAB2Z2EsMbARCgngRqxeqBjMP+w1kFwfsJDQCbpOn9OShEAgoAnqnt/Dn++1hUBwCXrFdXwcVtAaK0U8SFB2bGfAAPu6DB/wTCavDCwZLAi8AH/Y9iAbLAPYcJxbfGRMH/U2sIAHLMIzLAfQcAWduMe19lAV7bQ8AbxBHZwcD+iXyPxATCxaTAwv/C/3YEDgTB5rf///v4Pf77pv/Awf8JAGLvM6TBd34JAK0qMMQTwcPABADUNSloYQHI9SnA/1EDBKX2LcEXAQMyrXKk/sLCwsbDA5DGOsDBwAUAjTg3xQ8IAJP9McC/cgF2WwdDwcDHwRBbYUF9BhDGCOiCxGARqw0tfMLBEG51O34SEQMVZ/5ZGMDIz8DEWAQDFH8pOsgEED3rN8GiBBBTMySHwBCiUybBggQQofIpgGIRwzwawsHCECY+B8JYwAAAAAAAAA==', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:32', 0, NULL),
(12, '6339160200267', 'DATA USER PIN=123341	Name=GATES	Pri=0	Passwd=12345		TZ=0	Grp=1', '2021-08-10 21:16:23', '2021-08-10 21:16:25', '2021-08-10 21:16:32', 0, NULL),
(13, '6339160200267', 'CHECK', '2021-08-10 21:27:01', '2021-08-10 21:27:05', '2021-08-10 21:27:05', 0, NULL),
(14, '6339160200267', 'DATA USER PIN=71196	Name=Chan	Pri=14		Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:25', 0, NULL),
(15, '6339160200267', 'DATA FP PIN=71196	FID=0	Size=2000	Valid=1	TMP=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', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(16, '6339160200267', 'DATA USER PIN=110795	Name=bayu	Pri=0		Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(17, '6339160200267', 'DATA FP PIN=110795	FID=0	Size=1576	Valid=1	TMP=TdtTUzIxAAAEmJ8ECAUHCc7QAAAcmWkBAAAAhEUor5hUAIoPmgCsAIGWSgBrAPQPvQBqmHkP7gBuAN0Ptph9ABEO+QBFAJyXpgCEAIcO3QCMmFgOmACQALwOvpiTAIcP+QBRACWXegCeAPkN0wChmEsOgACoAJoPgJizAGMP9gB2AC+XZwC0AE0PswCzmOUPOwC4AI8PF5i7AMsOngB5AGSXIgC9ANIOugDMmEQPngDYAOcP15jiAKIP6gArALSXaQD3ADgPuwAEmS8PowAAAd8PkJgIAR0PkQDLASaXdQAXAS0P+gAmmTMPJgAjAfQPMZgrAbcP0ADrAY+XXQAxAbQPGAAxmeUPUwBHAe4PUZ8zejsE2f/vAB7sk3/7n6//w/WKHyoAkYGe+iYL0RSgjg6MKXlUgSv14HhdERUCrBNrCWKK7fV2gCtoqeKUAn4RIYlj+BKStZ+1mtEWuIFl4/jzUP/Qa7x9yJ+QgM1uGgzelbcTPGgh8zLsVIAhAHSFrXq2gg8DuWB8gbaCsf+kQ5aENAililmLLGEBfv/oIcfy3V8K9W5qgkuKZRJehye/WA56DV8YqA7lYmAS0fzN+i/tvGZMBPXyNAaACv1uJAJKDAb1cX/JmmOAYXxNAp5+qB9ciNIGCahSc8NHHIpihK6J9Fhjrz7PJXr2d8f76UiUut8gQgHHlSVHBwCVFw/CBUMMmIgdDMDBUToJBOImBkrAwE7UAC+v7Cv+YFhKBf8WmCpB8UY2/phY+8IQADxG8P/u/0DO/v52CgCnlIxYWv7EhA4AopOJb1rAw8HAwcKbBwQ3Vw9TQBEAiGfpZipERsD+wv0GBA5phnjDEgCxbIRc/pLCcolRBAcE329pwoPBD8V8apvAPv87wEM6AwRqcRf/CQB0tHqNWsN8FQCte0nDXQvAw3PDwHS7CgQtegzA/ThW1wCV5oHAwsKJwwWBxObDBwC1gBYH/vnDFgD1gpdnomXGWcOLkGQRAFSDhFrBxXHDwcAEeHCJAauFEEDAOjI2Wf1aBgByjzH++t4VAJSQfZYHwpTgwcHDwWIRxWuR85PCwXJ3wQR7FpiVlv3+wPw6O8RlRcH7/P4DxfySusANAHefaQbAmVjDbsITAH9l+kVmKi5CHP4QxXyi88b/g29njM4AgD/7wPz//jU7/w+YhrD3/v3+9f1umwH6tSfAEMWEsvjDw8PAw2eywXKbAfW3K/8OxWS8y4Z/dsOPCcU6v9TAcWoFAHN+U5SSAZq8bcajB8J3nwESvkPBwTjD+5ABgsTc+/o6/jWdAXvKTMOLwwCFVEeWwgUAoBQgxfQEAKDbIsBUBQWc3TfAZgoACuGkWMPCxcmuCsXX47H8/vn6/fs7/Q2YZPo9wmrCBMIQiKYBHMLEwwzKxVvBwMLG0KAEpwKI6gJD/Pr8OwwUGgItwYHDjkkLFOQFMMJywsIFpAKImQsiwcLBBwYUDREki8QIEFURLQjArgYQchv1hMWfEXgbLcHBBJUHiPgjV/wEEO8mKdwEED4mOsMFwAeIQiY0wgUQ2CczWXsEECQnNJIDFK8vNMIAjwTFUpWX', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(18, '6339160200267', 'DATA USER PIN=15030100		Pri=0	Passwd=12345	Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(19, '6339160200267', 'DATA FP PIN=15030100	FID=0	Size=1512	Valid=1	TMP=TSVTUzIxAAAEZmUECAUHCc7QAAAcZ2kBAAAAhIsmbWYqAHQPtgD1AIVpZgA1APEPBgA8ZgoPzwBEAEwPjmZJAHIPoQCSAARpfgBbAGYPhgB4ZtgPRwB/AJYPo2aWAGQPhgBcAFFpmwCoAPQPngDTZkIPqQDrAPcP12bsACoPxAAxAC5pjgD5ADQPwwH4ZrUNAAH/AOINWGYCAUAPxQDBASppLgAJAUEPrwALZzgP7AAZAWIP3GYbAagPyQDZAbVpPwApATgNlQArZ8EOZwAyAX8PpmYyASYPvwD+AR5pmgA8ATIOrABEZ6oPeABEAW8P2GZEAZwPWgCMAZtomgBJAbQOkYcuYT4RFXge+JODXBmngrqPDYxQhN9qmICWCGuJoA4hEaeCGZP+nZOD9ZAXacZ3wIlSd7/hyX0X7z8DvHGedtpnRWIq8C7zbfcoosfHfgeyD1N1XAu6AG4GAACpmdv7lfxFACD7PmK7/8f1OI7vDl/rSXa2gMOAmAkGmb8DEQSNfuwHam87A2eB5flLgaIcWAG2gFb5kPjdZ3x/yQiJhtuYUR/7+VKDTYkACvVFABBN/ukScfetEGcM8vR2gPNoLGmRg8aJkfAkAEVqYAB58lIMt4SmkZfvzfS551DjiOGYklINdnqe8TFGQAECeyECxgCbfwH/BQCTG7/CP2MBoyJ9dQXFWicEZgQAricA9QkEAC1xk2nBBsWyKuCFwgUAujHFMxRmqTOAwv+IsHTEpsMJAGM4aQTCxKT+dwUAxzjM/sWZFQDLP4zCB2aApIFgw//BBMXTQWr+wAcAhkaywoinBACORvc7wgCCKnXBw3UJAGBT/lfANhIAnVeywcfnw8DAwmR7BAkEw1v9Nf/AUMIAeDpqwnfBGgA7X5cWwMGLwMCdB8DGDFNZCgCiesX/NKY/CgCge3G8wsTlBgBCgVNqtgoEIYJQwMDD/gXBxKcaARGLmlywccamnG/AfmLA2gEV85tid4CAkAdmdD7+xpgOAIlT6fqb/v04Pv7AywCn8WqewcHCaq8RBOeaXMRmwmQHwWLqEQCGnVeAB2Z2EsMbARCgngRqxeqBjMP+w1kFwfsJDQCbpOn9OShEAgoAnqnt/Dn++1hUBwCXrFdXwcVtAaK0U8SFB2bGfAAPu6DB/wTCavDCwZLAi8AH/Y9iAbLAPYcJxbfGRMH/U2sIAHLMIzLAfQcAWduMe19lAV7bQ8AbxBHZwcD+iXyPxATCxaTAwv/C/3YEDgTB5rf///v4Pf77pv/Awf8JAGLvM6TBd34JAK0qMMQTwcPABADUNSloYQHI9SnA/1EDBKX2LcEXAQMyrXKk/sLCwsbDA5DGOsDBwAUAjTg3xQ8IAJP9McC/cgF2WwdDwcDHwRBbYUF9BhDGCOiCxGARqw0tfMLBEG51O34SEQMVZ/5ZGMDIz8DEWAQDFH8pOsgEED3rN8GiBBBTMySHwBCiUybBggQQofIpgGIRwzwawsHCECY+B8JYwMHBBJUHiA==', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(20, '6339160200267', 'DATA USER PIN=123341	Name=GATES	Pri=0	Passwd=12345	Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(21, '6339160200267', 'DATA FP PIN=123341	FID=0	Size=1216	Valid=1	TMP=SstTUzIxAAADiIwECAUHCc7QAAAbiWkBAAAAg7UgnIh7AHgPRgBPAOaHXQCVAFkO3QCZiNUPaQCeAKAOlYjDAHIOhgABAPmGTwDJANQO/QDViEkOcADZAIIOsojcABMOYQAmANeGdADwADMOfADziB8PTADyAAEPV4j1AD8PqwAyACSGVAAEAb0PhAAGiT8PWQAMAfYOgIghASkPRgDmATGGnAAnASQPewApiSENxwAzAWUN04g3ASoM2gCEAaGEOwBDAbMNiABAibkO0wBDAeEMLIhEAacNtgCMAaCHchd7I08LdI6xCg4QQfS9draGoHjaj6t/tQx3gkDkiHgyYnovRIjpPNbIGY/WAAeOJv9jhVoKoXW0FhnEnPW57w6iUI0KHcSiBe7lYg/00nAQDQuvyIYsCRICzX6BhB1tjAgmn6YF8I6BgISBQgkYfk0O/HrA9tp+YAfr+A/56wAJfId86f9iBEODgwt4+q587HpFgwb15Y6MC3mIkYKC8HgGRA/N/VuBSo1HEIKIUIbR/wIN0ffa8LJ2fAfVCKuEzMEDsuU2AonnF/gJAF2AcJP2wAkAZEppBXfC7A4Ag059wgfCw0nAwVx1BQDvVF1MUA8Ai1R3v8F7SmdbCAAyV5l+/B0PAItcd35NwHfzCQCfZICLB3wTiJxrfcJ0fgZ4ws8QAKN1g5Gcw3v+NgYAm3t9B4sGiK6Ag8RNCMWyiwh2/5oLALxUgMP2w5PCBgBXUF7B8AQAW5pagMgAwROHecCMwsFCDgNHp4lvi8TAB8OCmwGrp3rAjUPEw0iRYsMDAFpsV8KMAbOpBv/9zQCkOYLDwcSMBMWvsosqEACgtnoExIpLw8LAw1rCwQCsPg1BCACKwD8w/LYMAILHXMS4w/4MhQMATc1DOgcDydFGa4EJAIPWQHfF///D/cLAADdRRzgEADrZg08EiJTdAPz+wTr/CIhu30/EwmoH/4iMAbTfE0oUxePcEsPAgsHDxgbCwkvBdoMJAJQhOsD7w1UKAKPk3z5kSP0JAI7mPVZywpoB3+aXwMK8w8VMwsHDwMDBvgcDE+wrW5QTABnumUmKxMXIlosFwH6MAbzxHEQJxUz1tcF7wqIIAGr4IUj/h/4IAKs+J2XWBBBBCD1ywBBWgELEbAQQWco0X40RhiQpwITBED6hNv/EAxCe7yLDjBEmLSdhCNUiW456ZwcAWduMew==', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(22, '6339160200267', 'DATA USER PIN=23131231	Name=Udin	Pri=2	Passwd=12345		TZ=0	Grp=1', '2021-08-10 21:35:22', '2021-08-10 21:35:24', '2021-08-10 21:35:33', 0, NULL),
(23, '6339160200267', 'CHECK', '2021-08-10 21:38:18', '2021-08-10 21:38:26', '2021-08-10 21:38:26', 0, NULL),
(24, '6339160200267', 'CHECK', '2021-08-10 21:42:02', '2021-08-10 21:42:50', '2021-08-10 21:42:51', 0, NULL),
(25, '6339160200267', 'CHECK', '2021-08-10 21:46:16', '2021-08-10 21:46:18', '2021-08-10 21:46:18', 0, NULL),
(26, '6339160200267', 'CLEAR LOG', '2021-08-10 21:50:02', '2021-08-10 21:50:04', '2021-08-10 21:50:05', 0, NULL),
(27, '6339160200267', 'CHECK', '2021-08-10 21:51:18', '2021-08-10 21:51:19', '2021-08-10 21:51:19', 0, NULL),
(28, '6339160200267', 'INFO', '2021-08-10 21:52:40', '2021-08-10 21:52:41', '2021-08-10 21:52:42', 0, NULL),
(29, '6339160200267', 'LOG', '2021-08-10 21:58:36', '2021-08-10 21:58:37', '2021-08-10 21:58:37', 0, NULL),
(30, '6339160200267', 'DATA USER PIN=71196	Name=Chan	Pri=14		Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 22:03:20', '2021-08-10 22:03:29', '2021-08-10 22:03:30', 0, NULL),
(31, '6339160200267', 'DATA FP PIN=71196	FID=0	Size=2000	Valid=1	TMP=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', '2021-08-10 22:03:20', '2021-08-10 22:03:29', '2021-08-10 22:03:34', 0, NULL),
(32, '6339160200267', 'DATA USER PIN=110795	Name=bayu	Pri=0		Card=[0000000000]	TZ=0000000000000000	Grp=1', '2021-08-10 22:03:20', '2021-08-10 22:03:29', '2021-08-10 22:03:34', 0, NULL),
(33, '6339160200267', 'DATA FP PIN=110795	FID=0	Size=1576	Valid=1	TMP=TdtTUzIxAAAEmJ8ECAUHCc7QAAAcmWkBAAAAhEUor5hUAIoPmgCsAIGWSgBrAPQPvQBqmHkP7gBuAN0Ptph9ABEO+QBFAJyXpgCEAIcO3QCMmFgOmACQALwOvpiTAIcP+QBRACWXegCeAPkN0wChmEsOgACoAJoPgJizAGMP9gB2AC+XZwC0AE0PswCzmOUPOwC4AI8PF5i7AMsOngB5AGSXIgC9ANIOugDMmEQPngDYAOcP15jiAKIP6gArALSXaQD3ADgPuwAEmS8PowAAAd8PkJgIAR0PkQDLASaXdQAXAS0P+gAmmTMPJgAjAfQPMZgrAbcP0ADrAY+XXQAxAbQPGAAxmeUPUwBHAe4PUZ8zejsE2f/vAB7sk3/7n6//w/WKHyoAkYGe+iYL0RSgjg6MKXlUgSv14HhdERUCrBNrCWKK7fV2gCtoqeKUAn4RIYlj+BKStZ+1mtEWuIFl4/jzUP/Qa7x9yJ+QgM1uGgzelbcTPGgh8zLsVIAhAHSFrXq2gg8DuWB8gbaCsf+kQ5aENAililmLLGEBfv/oIcfy3V8K9W5qgkuKZRJehye/WA56DV8YqA7lYmAS0fzN+i/tvGZMBPXyNAaACv1uJAJKDAb1cX/JmmOAYXxNAp5+qB9ciNIGCahSc8NHHIpihK6J9Fhjrz7PJXr2d8f76UiUut8gQgHHlSVHBwCVFw/CBUMMmIgdDMDBUToJBOImBkrAwE7UAC+v7Cv+YFhKBf8WmCpB8UY2/phY+8IQADxG8P/u/0DO/v52CgCnlIxYWv7EhA4AopOJb1rAw8HAwcKbBwQ3Vw9TQBEAiGfpZipERsD+wv0GBA5phnjDEgCxbIRc/pLCcolRBAcE329pwoPBD8V8apvAPv87wEM6AwRqcRf/CQB0tHqNWsN8FQCte0nDXQvAw3PDwHS7CgQtegzA/ThW1wCV5oHAwsKJwwWBxObDBwC1gBYH/vnDFgD1gpdnomXGWcOLkGQRAFSDhFrBxXHDwcAEeHCJAauFEEDAOjI2Wf1aBgByjzH++t4VAJSQfZYHwpTgwcHDwWIRxWuR85PCwXJ3wQR7FpiVlv3+wPw6O8RlRcH7/P4DxfySusANAHefaQbAmVjDbsITAH9l+kVmKi5CHP4QxXyi88b/g29njM4AgD/7wPz//jU7/w+YhrD3/v3+9f1umwH6tSfAEMWEsvjDw8PAw2eywXKbAfW3K/8OxWS8y4Z/dsOPCcU6v9TAcWoFAHN+U5SSAZq8bcajB8J3nwESvkPBwTjD+5ABgsTc+/o6/jWdAXvKTMOLwwCFVEeWwgUAoBQgxfQEAKDbIsBUBQWc3TfAZgoACuGkWMPCxcmuCsXX47H8/vn6/fs7/Q2YZPo9wmrCBMIQiKYBHMLEwwzKxVvBwMLG0KAEpwKI6gJD/Pr8OwwUGgItwYHDjkkLFOQFMMJywsIFpAKImQsiwcLBBwYUDREki8QIEFURLQjArgYQchv1hMWfEXgbLcHBBJUHiPgjV/wEEO8mKdwEED4mOsMFwAeIQiY0wgUQ2CczWXsEECQnNJIDFK8vNMIAjwTFUpWX', '2021-08-10 22:03:20', '2021-08-10 22:03:29', '2021-08-10 22:03:34', 0, NULL),
(34, '6339160200267', 'DATA USER PIN=150301004	Name=GATES	Pri=2	Passwd=12345	Card=[0000000000]	TZ=0	Grp=1', '2021-08-10 22:03:20', '2021-08-10 22:03:29', '2021-08-10 22:03:34', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `devlog`
--

CREATE TABLE `devlog` (
  `id` int(11) NOT NULL,
  `SN_id` varchar(20) NOT NULL,
  `OP` varchar(8) NOT NULL,
  `Object` varchar(20) DEFAULT NULL,
  `Cnt` int(11) NOT NULL,
  `ECnt` int(11) NOT NULL,
  `OpTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devlog`
--

INSERT INTO `devlog` (`id`, `SN_id`, `OP`, `Object`, `Cnt`, `ECnt`, `OpTime`) VALUES
(1, '6339160200267', 'USERDATA', '000110795 bayu', 4, 0, '2021-07-25 00:09:19'),
(2, '6339160200267', 'USERDATA', 'None', 3, 0, '2021-07-25 00:09:19'),
(3, '6339160200267', 'USERDATA', '000071196 Chan', 2, 0, '2021-07-25 00:09:39'),
(4, '6339160200267', 'USERDATA', '000110795 bayu', 2, 0, '2021-07-25 00:09:39'),
(5, '6339160200267', 'USERDATA', 'None', 3, 0, '2021-07-25 00:09:49'),
(6, '6339160200267', 'USERDATA', 'None', 5, 0, '2021-08-01 00:38:18'),
(7, '6339160200267', 'TRANSACT', '71196	2021-07-31 20:', 1, 0, '2021-08-01 00:38:48'),
(8, '6339160200267', 'USERDATA', 'None', 3, 0, '2021-08-01 00:39:28'),
(9, '6339160200267', 'TRANSACT', '110795	2021-08-01 00', 1, 0, '2021-08-01 00:39:48'),
(10, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-01 14:21:02'),
(11, '6339160200267', 'TRANSACT', '110795	2021-08-01 14', 1, 0, '2021-08-01 14:21:22'),
(12, '6339160200267', 'TRANSACT', '110795	2021-08-01 14', 1, 0, '2021-08-01 14:22:42'),
(13, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-04 01:42:12'),
(14, '6339160200267', 'TRANSACT', '110795	2021-08-04 01', 1, 0, '2021-08-04 01:42:42'),
(15, '6339160200267', 'TRANSACT', '110795	2021-08-04 01', 1, 0, '2021-08-04 01:43:44'),
(16, '6339160200267', 'USERDATA', 'None', 2, 0, '2021-08-10 20:46:32'),
(17, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-10 20:47:32'),
(18, '6339160200267', 'USERDATA', '015030100', 6, 0, '2021-08-10 20:49:42'),
(19, '6339160200267', 'USERDATA', '000110795 bayu', 4, 0, '2021-08-10 21:14:48'),
(20, '6339160200267', 'USERDATA', '015030100', 2, 0, '2021-08-10 21:14:48'),
(21, '6339160200267', 'TRANSACT', '71196	2021-07-31 20:', 3, 0, '2021-08-10 21:14:48'),
(22, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-10 21:15:58'),
(23, '6339160200267', 'TRANSACT', '15030100	2021-08-10 ', 1, 0, '2021-08-10 21:19:08'),
(24, '6339160200267', 'USERDATA', 'None', 8, 0, '2021-08-10 21:21:28'),
(25, '6339160200267', 'TRANSACT', '123341	2021-08-10 21', 1, 0, '2021-08-10 21:22:48'),
(26, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-10 21:25:06'),
(27, '6339160200267', 'USERDATA', '000071196 Chan', 2, 0, '2021-08-10 21:27:17'),
(28, '6339160200267', 'USERDATA', '000123341 GATES', 6, 0, '2021-08-10 21:27:17'),
(29, '6339160200267', 'TRANSACT', '71196	2021-07-31 20:', 8, 0, '2021-08-10 21:27:17'),
(30, '6339160200267', 'USERDATA', 'None', 10, 0, '2021-08-10 21:38:34'),
(31, '6339160200267', 'TRANSACT', '', 0, 0, '2021-08-10 21:38:34'),
(32, '6339160200267', 'TRANSACT', '23131231	2021-08-10 ', 1, 0, '2021-08-10 21:40:04'),
(33, '6339160200267', 'USERDATA', 'None', 19, 0, '2021-08-10 21:42:55'),
(34, '6339160200267', 'TRANSACT', '15030100	2021-08-10 ', 3, 0, '2021-08-10 21:44:22'),
(35, '6339160200267', 'USERDATA', '000110795 bayu', 4, 0, '2021-08-10 21:46:22'),
(36, '6339160200267', 'TRANSACT', '71196	2021-07-31 20:', 9, 0, '2021-08-10 21:46:22'),
(37, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-10 21:49:22'),
(38, '6339160200267', 'USERDATA', '000110795 bayu', 4, 0, '2021-08-10 21:51:22'),
(39, '6339160200267', 'USERDATA', 'None', 1, 0, '2021-08-10 22:00:25'),
(40, '6339160200267', 'USERDATA', 'None', 19, 0, '2021-08-10 22:03:35'),
(41, '6339160200267', 'USERDATA', 'None', 11, 0, '2021-08-10 22:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `django_admin_log`
--

CREATE TABLE `django_admin_log` (
  `id` int(11) NOT NULL,
  `action_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `object_id` longtext DEFAULT NULL,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) UNSIGNED NOT NULL,
  `change_message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `django_content_type`
--

CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `django_content_type`
--

INSERT INTO `django_content_type` (`id`, `name`, `app_label`, `model`) VALUES
(1, 'session', 'sessions', 'session'),
(2, 'permission', 'auth', 'permission'),
(3, 'group', 'auth', 'group'),
(4, 'user', 'auth', 'user'),
(5, 'message', 'auth', 'message'),
(6, 'content type', 'contenttypes', 'contenttype'),
(7, 'log entry', 'admin', 'logentry'),
(8, 'department', 'iclock', 'department'),
(9, 'device', 'iclock', 'iclock'),
(10, 'admin granted department', 'iclock', 'deptadmin'),
(11, 'employee', 'iclock', 'employee'),
(12, 'fingerprint', 'iclock', 'fptemp'),
(13, 'transaction', 'iclock', 'transaction'),
(14, 'device operation log', 'iclock', 'oplog'),
(15, 'data from device', 'iclock', 'devlog'),
(16, 'command to device', 'iclock', 'devcmds'),
(17, 'public information', 'iclock', 'messages'),
(18, 'information subscription', 'iclock', 'iclockmsg'),
(19, 'administration log', 'iclock', 'adminlog');

-- --------------------------------------------------------

--
-- Table structure for table `django_session`
--

CREATE TABLE `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `gaji` int(11) DEFAULT NULL,
  `tunjangan` int(11) DEFAULT NULL,
  `periode_awal` date DEFAULT NULL,
  `periode_akhir` date DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id_user_group` int(11) UNSIGNED NOT NULL,
  `userid_group` int(11) NOT NULL,
  `seksi_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id_user_group`, `userid_group`, `seksi_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2021-08-18 15:14:08', '2021-08-19 00:25:57'),
(2, 1, 3, '2021-08-18 15:25:43', '2021-08-18 15:27:55'),
(3, 2, 1, NULL, NULL),
(4, 5, 3, '2021-08-18 15:57:59', '2021-08-18 15:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `iclock`
--

CREATE TABLE `iclock` (
  `SN` varchar(20) NOT NULL,
  `State` int(11) NOT NULL,
  `LastActivity` datetime DEFAULT NULL,
  `TransTimes` varchar(50) DEFAULT NULL,
  `TransInterval` int(11) NOT NULL,
  `LogStamp` varchar(20) DEFAULT NULL,
  `OpLogStamp` varchar(20) DEFAULT NULL,
  `PhotoStamp` varchar(20) DEFAULT NULL,
  `Alias` varchar(20) NOT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `UpdateDB` varchar(10) NOT NULL,
  `Style` varchar(20) DEFAULT NULL,
  `FWVersion` varchar(30) DEFAULT NULL,
  `FPCount` int(11) DEFAULT NULL,
  `TransactionCount` int(11) DEFAULT NULL,
  `UserCount` int(11) DEFAULT NULL,
  `MainTime` varchar(20) DEFAULT NULL,
  `MaxFingerCount` int(11) DEFAULT NULL,
  `MaxAttLogCount` int(11) DEFAULT NULL,
  `DeviceName` varchar(30) DEFAULT NULL,
  `AlgVer` varchar(30) DEFAULT NULL,
  `FlashSize` varchar(10) DEFAULT NULL,
  `FreeFlashSize` varchar(10) DEFAULT NULL,
  `Language` varchar(30) DEFAULT NULL,
  `VOLUME` varchar(10) DEFAULT NULL,
  `DtFmt` varchar(10) DEFAULT NULL,
  `IPAddress` varchar(20) DEFAULT NULL,
  `IsTFT` varchar(5) DEFAULT NULL,
  `Platform` varchar(20) DEFAULT NULL,
  `Brightness` varchar(5) DEFAULT NULL,
  `BackupDev` varchar(30) DEFAULT NULL,
  `OEMVendor` varchar(30) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `AccFun` smallint(6) NOT NULL,
  `TZAdj` smallint(6) NOT NULL,
  `DelTag` smallint(6) NOT NULL,
  `FPVersion` varchar(10) DEFAULT NULL,
  `PushVersion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iclock`
--

INSERT INTO `iclock` (`SN`, `State`, `LastActivity`, `TransTimes`, `TransInterval`, `LogStamp`, `OpLogStamp`, `PhotoStamp`, `Alias`, `DeptID`, `UpdateDB`, `Style`, `FWVersion`, `FPCount`, `TransactionCount`, `UserCount`, `MainTime`, `MaxFingerCount`, `MaxAttLogCount`, `DeviceName`, `AlgVer`, `FlashSize`, `FreeFlashSize`, `Language`, `VOLUME`, `DtFmt`, `IPAddress`, `IsTFT`, `Platform`, `Brightness`, `BackupDev`, `OEMVendor`, `City`, `AccFun`, `TZAdj`, `DelTag`, `FPVersion`, `PushVersion`) VALUES
('6339160200267', 1, '2021-08-10 22:15:01', '00:00;14:05', 1, '0', '694563301', '', '192.168.1.201', 1, '1111111100', 'F7', 'Ver 6.5.4(build 155)', 2, 0, 3, '1970-01-01 00:00:08', 10000, 200000, 'X100-C', 'Finger VX', '105472', '74452', '73', '20', '0', '192.168.1.201', '1', 'ZEM560_TFT', '80', '', 'Solution', '', 0, 7, 0, '10', '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `iclock_adminlog`
--

CREATE TABLE `iclock_adminlog` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `model` varchar(40) DEFAULT NULL,
  `action` varchar(40) NOT NULL,
  `object` varchar(40) DEFAULT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iclock_adminlog`
--

INSERT INTO `iclock_adminlog` (`id`, `time`, `User_id`, `model`, `action`, `object`, `count`) VALUES
(1, '2021-07-25 00:09:14', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(2, '2021-07-25 00:09:31', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(3, '2021-07-25 01:25:10', 1, NULL, 'LOGOUT', '127.0.0.1', 1),
(4, '2021-08-01 00:38:26', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(5, '2021-08-01 00:39:15', 1, 'iclock', 'Modify', '6339160200267(192.168.1.201)', 1),
(6, '2021-08-01 01:14:49', 1, NULL, 'LOGOUT', '127.0.0.1', 1),
(7, '2021-08-01 14:21:07', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(8, '2021-08-01 14:40:38', 1, NULL, 'LOGOUT', '127.0.0.1', 1),
(9, '2021-08-02 23:14:52', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(10, '2021-08-02 23:15:34', 1, 'Group', 'Create', 'seksi', 1),
(11, '2021-08-02 23:16:33', 1, 'Group', 'Clear', 'All', 1),
(12, '2021-08-02 23:18:48', 1, NULL, 'LOGOUT', '127.0.0.1', 1),
(13, '2021-08-04 01:42:21', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(14, '2021-08-10 20:46:24', 1, 'None', 'LOGIN', '127.0.0.1', 1),
(15, '2021-08-10 21:13:25', 1, 'iclock', 'copyudata', '6339160200267', 1),
(16, '2021-08-10 21:14:38', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(17, '2021-08-10 21:16:23', 1, 'iclock', 'restoreData', '6339160200267', 1),
(18, '2021-08-10 21:26:35', 1, 'employee', 'Clear', 'All', 1),
(19, '2021-08-10 21:27:01', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(20, '2021-08-10 21:35:22', 1, 'iclock', 'restoreData', '6339160200267', 1),
(21, '2021-08-10 21:38:18', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(22, '2021-08-10 21:42:02', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(23, '2021-08-10 21:45:31', 1, 'employee', 'Clear', 'All', 1),
(24, '2021-08-10 21:46:16', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(25, '2021-08-10 21:50:02', 1, 'iclock', 'clearlog', '6339160200267', 1),
(26, '2021-08-10 21:51:18', 1, 'iclock', 'reloaddata', '6339160200267', 1),
(27, '2021-08-10 21:52:25', 1, 'transaction', 'Clear', 'All', 1),
(28, '2021-08-10 21:52:40', 1, 'iclock', 'info', '6339160200267', 1),
(29, '2021-08-10 21:58:36', 1, 'iclock', 'loaddata', '6339160200267', 1),
(30, '2021-08-10 22:01:13', 1, 'iclock', 'copyudata', '6339160200267', 1),
(31, '2021-08-10 22:03:20', 1, 'iclock', 'restoreData', '6339160200267', 1),
(32, '2021-08-10 22:15:17', 1, NULL, 'LOGOUT', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `iclock_deptadmin`
--

CREATE TABLE `iclock_deptadmin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iclock_iclockmsg`
--

CREATE TABLE `iclock_iclockmsg` (
  `id` int(11) NOT NULL,
  `SN_id` varchar(20) NOT NULL,
  `MsgType` int(11) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime DEFAULT NULL,
  `MsgParam` varchar(32) DEFAULT NULL,
  `MsgContent` varchar(200) DEFAULT NULL,
  `LastTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iclock_messages`
--

CREATE TABLE `iclock_messages` (
  `id` int(11) NOT NULL,
  `MsgType` int(11) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime DEFAULT NULL,
  `MsgContent` longtext DEFAULT NULL,
  `MsgImage` varchar(64) DEFAULT NULL,
  `DeptID_id` int(11) DEFAULT NULL,
  `MsgParam` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iclock_oplog`
--

CREATE TABLE `iclock_oplog` (
  `id` int(11) NOT NULL,
  `SN` varchar(20) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `OP` smallint(6) NOT NULL,
  `OPTime` datetime NOT NULL,
  `Object` int(11) DEFAULT NULL,
  `Param1` int(11) DEFAULT NULL,
  `Param2` int(11) DEFAULT NULL,
  `Param3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iclock_oplog`
--

INSERT INTO `iclock_oplog` (`id`, `SN`, `admin`, `OP`, `OPTime`, `Object`, `Param1`, `Param2`, `Param3`) VALUES
(1, '6339160200267', 0, 4, '2000-01-01 00:00:00', 0, 0, 0, 0),
(7, '6339160200267', 0, 4, '2021-07-24 23:22:47', 0, 0, 0, 0),
(8, '6339160200267', 0, 4, '2021-07-24 23:24:24', 0, 0, 0, 0),
(9, '6339160200267', 0, 23, '2021-07-24 23:24:32', 0, 0, 0, 0),
(10, '6339160200267', 0, 1, '2021-07-24 21:25:36', 0, 0, 0, 0),
(11, '6339160200267', 0, 0, '2021-07-24 21:30:15', 0, 0, 0, 0),
(15, '6339160200267', 0, 0, '2021-08-01 01:15:58', 0, 0, 0, 0),
(16, '6339160200267', 0, 0, '2021-08-01 15:17:04', 0, 0, 0, 0),
(17, '6339160200267', 0, 1, '2021-08-04 03:05:02', 0, 0, 0, 0),
(18, '6339160200267', 0, 0, '2021-08-04 03:07:16', 0, 0, 0, 0),
(19, '6339160200267', 0, 0, '2021-08-10 20:47:20', 0, 0, 0, 0),
(20, '6339160200267', 0, 4, '2021-08-10 20:48:10', 0, 0, 0, 0),
(21, '6339160200267', 0, 30, '2021-08-10 20:49:25', 15030100, 0, 0, 0),
(22, '6339160200267', 0, 6, '2021-08-10 20:49:26', 15030100, 0, 0, 1126),
(23, '6339160200267', 0, 4, '2021-08-10 21:15:39', 0, 0, 0, 0),
(24, '6339160200267', 0, 4, '2021-08-10 21:20:50', 0, 0, 0, 0),
(25, '6339160200267', 0, 6, '2021-08-10 21:21:14', 123341, 0, 0, 904),
(26, '6339160200267', 0, 9, '2021-08-10 21:21:15', 0, 65532, 0, 0),
(27, '6339160200267', 0, 9, '2021-08-10 21:21:16', 0, 65532, 0, 0),
(28, '6339160200267', 0, 9, '2021-08-10 21:21:17', 0, 65532, 0, 0),
(29, '6339160200267', 0, 9, '2021-08-10 21:21:18', 0, 65532, 0, 0),
(30, '6339160200267', 0, 4, '2021-08-10 21:23:34', 0, 0, 0, 0),
(31, '6339160200267', 0, 4, '2021-08-10 21:36:24', 0, 0, 0, 0),
(32, '6339160200267', 0, 9, '2021-08-10 21:36:55', 0, 65532, 0, 0),
(33, '6339160200267', 0, 9, '2021-08-10 21:36:56', 0, 65532, 0, 0),
(34, '6339160200267', 0, 9, '2021-08-10 21:36:57', 0, 65532, 0, 0),
(35, '6339160200267', 0, 6, '2021-08-10 21:37:19', 23131231, 0, 0, 1438),
(36, '6339160200267', 0, 9, '2021-08-10 21:37:20', 0, 65532, 0, 0),
(37, '6339160200267', 0, 9, '2021-08-10 21:37:21', 0, 65532, 0, 0),
(38, '6339160200267', 0, 9, '2021-08-10 21:37:22', 0, 65532, 0, 0),
(39, '6339160200267', 0, 4, '2021-08-10 21:41:13', 0, 0, 0, 0),
(40, '6339160200267', 0, 9, '2021-08-10 21:41:27', 3, 0, 0, 0),
(41, '6339160200267', 0, 9, '2021-08-10 21:41:28', 0, 0, 0, 0),
(42, '6339160200267', 0, 9, '2021-08-10 21:41:29', 0, 0, 0, 0),
(43, '6339160200267', 0, 9, '2021-08-10 21:41:30', 0, 0, 0, 0),
(44, '6339160200267', 0, 9, '2021-08-10 21:41:31', 0, 0, 0, 0),
(45, '6339160200267', 0, 9, '2021-08-10 21:41:36', 4, 0, 0, 0),
(46, '6339160200267', 0, 9, '2021-08-10 21:41:37', 0, 0, 0, 0),
(47, '6339160200267', 0, 9, '2021-08-10 21:41:38', 0, 0, 0, 0),
(48, '6339160200267', 0, 9, '2021-08-10 21:41:39', 0, 0, 0, 0),
(49, '6339160200267', 0, 9, '2021-08-10 21:41:40', 0, 0, 0, 0),
(50, '6339160200267', 0, 9, '2021-08-10 21:41:41', 0, 0, 0, 0),
(51, '6339160200267', 0, 9, '2021-08-10 21:41:42', 5, 0, 0, 0),
(52, '6339160200267', 0, 9, '2021-08-10 21:41:43', 0, 0, 0, 0),
(53, '6339160200267', 0, 9, '2021-08-10 21:41:44', 0, 0, 0, 0),
(54, '6339160200267', 0, 9, '2021-08-10 21:41:45', 0, 0, 0, 0),
(55, '6339160200267', 0, 9, '2021-08-10 21:41:46', 0, 0, 0, 0),
(56, '6339160200267', 0, 9, '2021-08-10 21:41:47', 0, 0, 0, 0),
(57, '6339160200267', 0, 9, '2021-08-10 21:41:48', 0, 0, 0, 0),
(58, '6339160200267', 0, 4, '2021-08-10 21:48:09', 0, 0, 0, 0),
(59, '6339160200267', 0, 4, '2021-08-10 21:59:41', 0, 0, 0, 0),
(60, '6339160200267', 0, 4, '2021-08-10 22:02:14', 0, 0, 0, 0),
(61, '6339160200267', 0, 9, '2021-08-10 22:02:37', 0, 0, 0, 0),
(62, '6339160200267', 0, 9, '2021-08-10 22:02:38', 0, 0, 0, 0),
(63, '6339160200267', 0, 9, '2021-08-10 22:02:39', 0, 0, 0, 0),
(64, '6339160200267', 0, 9, '2021-08-10 22:02:40', 0, 0, 0, 0),
(65, '6339160200267', 0, 9, '2021-08-10 22:02:41', 0, 0, 0, 0),
(66, '6339160200267', 0, 9, '2021-08-10 22:02:42', 0, 0, 0, 0),
(67, '6339160200267', 0, 9, '2021-08-10 22:02:47', 0, 0, 0, 0),
(68, '6339160200267', 0, 9, '2021-08-10 22:02:48', 0, 0, 0, 0),
(69, '6339160200267', 0, 9, '2021-08-10 22:02:49', 0, 0, 0, 0),
(70, '6339160200267', 0, 9, '2021-08-10 22:02:50', 0, 0, 0, 0),
(71, '6339160200267', 0, 9, '2021-08-10 22:02:51', 0, 0, 0, 0),
(72, '6339160200267', 0, 9, '2021-08-10 22:02:52', 0, 0, 0, 0),
(73, '6339160200267', 0, 9, '2021-08-10 22:02:53', 0, 0, 0, 0),
(74, '6339160200267', 0, 9, '2021-08-10 22:02:54', 0, 0, 0, 0),
(75, '6339160200267', 0, 9, '2021-08-10 22:02:55', 0, 0, 0, 0),
(76, '6339160200267', 0, 9, '2021-08-10 22:02:56', 0, 0, 0, 0),
(77, '6339160200267', 0, 9, '2021-08-10 22:02:57', 0, 0, 0, 0),
(78, '6339160200267', 0, 9, '2021-08-10 22:02:58', 0, 0, 0, 0),
(79, '6339160200267', 0, 4, '2021-08-10 22:14:43', 0, 0, 0, 0),
(80, '6339160200267', 0, 9, '2021-08-10 22:14:52', 0, 0, 0, 0),
(81, '6339160200267', 0, 9, '2021-08-10 22:14:53', 0, 0, 0, 0),
(82, '6339160200267', 0, 9, '2021-08-10 22:14:54', 0, 0, 0, 0),
(83, '6339160200267', 0, 9, '2021-08-10 22:14:55', 0, 0, 0, 0),
(84, '6339160200267', 0, 9, '2021-08-10 22:14:56', 0, 0, 0, 0),
(85, '6339160200267', 0, 9, '2021-08-10 22:14:57', 0, 0, 0, 0),
(86, '6339160200267', 0, 9, '2021-08-10 22:14:58', 0, 0, 0, 0),
(87, '6339160200267', 0, 9, '2021-08-10 22:14:59', 0, 0, 0, 0),
(88, '6339160200267', 0, 9, '2021-08-10 22:15:00', 0, 0, 0, 0),
(89, '6339160200267', 0, 9, '2021-08-10 22:15:01', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) UNSIGNED NOT NULL,
  `userid_image` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_image`, `userid_image`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, '1629217277_627da1cef606568e6ec4.jpeg', '2021-08-17 23:21:17', '2021-08-17 23:21:17'),
(3, 1, '1629269413_00866ede60db04e1d8a2.png', '2021-08-18 13:50:13', '2021-08-18 13:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_pulang` date DEFAULT NULL,
  `shift_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `userid`, `tanggal_masuk`, `tanggal_pulang`, `shift_id`, `created_at`, `updated_at`) VALUES
(5, 2, '2021-08-13', '2021-08-13', 2, '2021-08-15 22:13:45', '2021-08-15 22:13:45'),
(6, 2, '2021-08-14', '2021-08-14', 2, '2021-08-15 22:13:55', '2021-08-15 22:13:55'),
(8, 2, '2021-08-16', '2021-08-16', 1, '2021-08-18 22:43:34', '2021-08-18 22:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kegiatan_id` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `selesai` time DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bobot` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id_keterangan` int(11) UNSIGNED NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_keterangan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Alfa', '2021-08-02 14:02:23', '2021-08-02 14:53:24'),
(2, 'Izin', '2021-08-02 14:53:30', '2021-08-02 14:53:30'),
(3, 'Sakit', '2021-08-02 14:54:48', '2021-08-02 14:54:48'),
(4, 'Work From Home', '2021-08-02 14:55:09', '2021-08-02 14:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `latetime`
--

CREATE TABLE `latetime` (
  `latetime_id` int(11) UNSIGNED NOT NULL,
  `idlatetime` int(11) NOT NULL,
  `useridLatetime` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `checktype` int(11) NOT NULL,
  `interval` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-03-14-152329', 'App\\Database\\Migrations\\Kegiatan', 'default', 'App', 1627146063, 1),
(2, '2021-03-16-065709', 'App\\Database\\Migrations\\Bidang', 'default', 'App', 1627146063, 1),
(3, '2021-03-20-060841', 'App\\Database\\Migrations\\Shift', 'default', 'App', 1627146063, 1),
(4, '2021-04-01-021000', 'App\\Database\\Migrations\\Jadwal', 'default', 'App', 1627146249, 2),
(5, '2021-05-01-150540', 'App\\Database\\Migrations\\Gaji', 'default', 'App', 1627146249, 2),
(6, '2021-05-05-125059', 'App\\Database\\Migrations\\Bulan', 'default', 'App', 1627146249, 2),
(8, '2021-06-23-014713', 'App\\Database\\Migrations\\Keterangan', 'default', 'App', 1627146487, 4),
(9, '2021-07-24-055251', 'App\\Database\\Migrations\\Rolemanagement', 'default', 'App', 1627146487, 4),
(11, '2021-07-24-055439', 'App\\Database\\Migrations\\Peringatan', 'default', 'App', 1627146487, 4),
(14, '2021-07-26-145401', 'App\\Database\\Migrations\\Seksibagian', 'default', 'App', 1627311515, 5),
(15, '2021-07-26-155332', 'App\\Database\\Migrations\\Usermanagement', 'default', 'App', 1627311515, 5),
(16, '2021-06-15-151903', 'App\\Database\\Migrations\\Latetime', 'default', 'App', 1627753741, 6),
(18, '2021-08-09-162451', 'App\\Database\\Migrations\\GroupUser', 'default', 'App', 1628527307, 7),
(19, '2021-08-16-161515', 'App\\Database\\Migrations\\Image', 'default', 'App', 1629130727, 8),
(20, '2021-06-23-160709', 'App\\Database\\Migrations\\Perbaikanabsen', 'default', 'App', 1629301705, 9);

-- --------------------------------------------------------

--
-- Table structure for table `perbaikanabsen`
--

CREATE TABLE `perbaikanabsen` (
  `id_perbaikan` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `jadwal_id` int(11) UNSIGNED NOT NULL,
  `keterangan_id` int(11) UNSIGNED DEFAULT NULL,
  `pengajuanPerbaikan` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perbaikanabsen`
--

INSERT INTO `perbaikanabsen` (`id_perbaikan`, `userid`, `jadwal_id`, `keterangan_id`, `pengajuanPerbaikan`, `status`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 1, 'Sakit', 1, '1629305817_c659f0ae19de3a42cc33.png', '2021-08-18 23:05:13', '2021-08-19 01:36:29'),
(2, 2, 6, 1, NULL, NULL, NULL, '2021-08-18 23:05:14', '2021-08-18 23:05:14'),
(3, 2, 5, 1, NULL, NULL, NULL, '2021-08-18 23:05:14', '2021-08-18 23:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `peringatan`
--

CREATE TABLE `peringatan` (
  `id_peringatan` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pelanggaran` varchar(255) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rolemanagement`
--

CREATE TABLE `rolemanagement` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_role` int(11) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rolemanagement`
--

INSERT INTO `rolemanagement` (`id`, `id_role`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 0, 'Anggota', '2021-08-10 14:43:15', '2021-08-10 14:43:15'),
(2, 2, 'Kepala Seksi', '2021-08-10 14:52:14', '2021-08-10 14:52:14'),
(3, 12, 'Kepala Bidang', '2021-08-10 14:53:00', '2021-08-10 14:53:00'),
(5, 14, 'Admin', '2021-08-10 15:14:17', '2021-08-10 15:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `seksibagian`
--

CREATE TABLE `seksibagian` (
  `id_seksi` int(11) UNSIGNED NOT NULL,
  `seksi_bagian` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seksibagian`
--

INSERT INTO `seksibagian` (`id_seksi`, `seksi_bagian`, `created_at`, `updated_at`) VALUES
(1, 'Penegak Hukum', '2021-07-26 23:26:22', '2021-07-26 23:26:42'),
(2, 'Pengaturan Lalu Lintas', '2021-07-26 23:26:52', '2021-07-26 23:27:04'),
(3, 'All ', '2021-07-28 23:03:30', '2021-07-28 23:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id_shift` int(11) UNSIGNED NOT NULL,
  `shift_name` varchar(255) DEFAULT NULL,
  `shift_masuk` time DEFAULT NULL,
  `shift_pulang` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id_shift`, `shift_name`, `shift_masuk`, `shift_pulang`, `created_at`, `updated_at`) VALUES
(1, '06:00 - 14:00', '06:00:00', '14:00:00', '2021-08-02 22:58:46', '2021-08-02 23:03:30'),
(2, '08:00 - 15:30', '08:00:00', '15:30:00', '2021-08-02 23:05:07', '2021-08-02 23:05:07'),
(3, '06:00 - 06:00', '06:00:00', '06:00:00', '2021-08-02 23:05:44', '2021-08-02 23:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `templateid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `Template` longtext NOT NULL,
  `FingerID` smallint(6) NOT NULL,
  `Valid` smallint(6) NOT NULL,
  `DelTag` smallint(6) NOT NULL,
  `SN` varchar(20) DEFAULT NULL,
  `UTime` datetime DEFAULT NULL,
  `BITMAPPICTURE` longtext DEFAULT NULL,
  `BITMAPPICTURE2` longtext DEFAULT NULL,
  `BITMAPPICTURE3` longtext DEFAULT NULL,
  `BITMAPPICTURE4` longtext DEFAULT NULL,
  `USETYPE` smallint(6) DEFAULT NULL,
  `Template2` longtext DEFAULT NULL,
  `Template3` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`templateid`, `userid`, `Template`, `FingerID`, `Valid`, `DelTag`, `SN`, `UTime`, `BITMAPPICTURE`, `BITMAPPICTURE2`, `BITMAPPICTURE3`, `BITMAPPICTURE4`, `USETYPE`, `Template2`, `Template3`) VALUES
(12, 1, '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', 0, 1, 0, '6339160200267', '2021-08-10 21:51:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 2, 'TdtTUzIxAAAEmJ8ECAUHCc7QAAAcmWkBAAAAhEUor5hUAIoPmgCsAIGWSgBrAPQPvQBqmHkP7gBuAN0Ptph9ABEO+QBFAJyXpgCEAIcO3QCMmFgOmACQALwOvpiTAIcP+QBRACWXegCeAPkN0wChmEsOgACoAJoPgJizAGMP9gB2AC+XZwC0AE0PswCzmOUPOwC4AI8PF5i7AMsOngB5AGSXIgC9ANIOugDMmEQPngDYAOcP15jiAKIP6gArALSXaQD3ADgPuwAEmS8PowAAAd8PkJgIAR0PkQDLASaXdQAXAS0P+gAmmTMPJgAjAfQPMZgrAbcP0ADrAY+XXQAxAbQPGAAxmeUPUwBHAe4PUZ8zejsE2f/vAB7sk3/7n6//w/WKHyoAkYGe+iYL0RSgjg6MKXlUgSv14HhdERUCrBNrCWKK7fV2gCtoqeKUAn4RIYlj+BKStZ+1mtEWuIFl4/jzUP/Qa7x9yJ+QgM1uGgzelbcTPGgh8zLsVIAhAHSFrXq2gg8DuWB8gbaCsf+kQ5aENAililmLLGEBfv/oIcfy3V8K9W5qgkuKZRJehye/WA56DV8YqA7lYmAS0fzN+i/tvGZMBPXyNAaACv1uJAJKDAb1cX/JmmOAYXxNAp5+qB9ciNIGCahSc8NHHIpihK6J9Fhjrz7PJXr2d8f76UiUut8gQgHHlSVHBwCVFw/CBUMMmIgdDMDBUToJBOImBkrAwE7UAC+v7Cv+YFhKBf8WmCpB8UY2/phY+8IQADxG8P/u/0DO/v52CgCnlIxYWv7EhA4AopOJb1rAw8HAwcKbBwQ3Vw9TQBEAiGfpZipERsD+wv0GBA5phnjDEgCxbIRc/pLCcolRBAcE329pwoPBD8V8apvAPv87wEM6AwRqcRf/CQB0tHqNWsN8FQCte0nDXQvAw3PDwHS7CgQtegzA/ThW1wCV5oHAwsKJwwWBxObDBwC1gBYH/vnDFgD1gpdnomXGWcOLkGQRAFSDhFrBxXHDwcAEeHCJAauFEEDAOjI2Wf1aBgByjzH++t4VAJSQfZYHwpTgwcHDwWIRxWuR85PCwXJ3wQR7FpiVlv3+wPw6O8RlRcH7/P4DxfySusANAHefaQbAmVjDbsITAH9l+kVmKi5CHP4QxXyi88b/g29njM4AgD/7wPz//jU7/w+YhrD3/v3+9f1umwH6tSfAEMWEsvjDw8PAw2eywXKbAfW3K/8OxWS8y4Z/dsOPCcU6v9TAcWoFAHN+U5SSAZq8bcajB8J3nwESvkPBwTjD+5ABgsTc+/o6/jWdAXvKTMOLwwCFVEeWwgUAoBQgxfQEAKDbIsBUBQWc3TfAZgoACuGkWMPCxcmuCsXX47H8/vn6/fs7/Q2YZPo9wmrCBMIQiKYBHMLEwwzKxVvBwMLG0KAEpwKI6gJD/Pr8OwwUGgItwYHDjkkLFOQFMMJywsIFpAKImQsiwcLBBwYUDREki8QIEFURLQjArgYQchv1hMWfEXgbLcHBBJUHiPgjV/wEEO8mKdwEED4mOsMFwAeIQiY0wgUQ2CczWXsEECQnNJIDFK8vNMIAjwTFUpWX', 0, 1, 0, '6339160200267', '2021-08-10 21:51:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userid` int(11) NOT NULL,
  `badgenumber` varchar(20) NOT NULL,
  `defaultdeptid` int(11) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `Card` varchar(20) DEFAULT NULL,
  `Privilege` int(11) DEFAULT NULL,
  `AccGroup` int(11) DEFAULT NULL,
  `TimeZones` varchar(20) DEFAULT NULL,
  `Gender` varchar(2) DEFAULT NULL,
  `Birthday` datetime DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `ophone` varchar(20) DEFAULT NULL,
  `FPHONE` varchar(20) DEFAULT NULL,
  `pager` varchar(20) DEFAULT NULL,
  `minzu` varchar(8) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `SN` varchar(20) DEFAULT NULL,
  `SSN` varchar(20) DEFAULT NULL,
  `UTime` datetime DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `City` varchar(2) DEFAULT NULL,
  `SECURITYFLAGS` smallint(6) DEFAULT NULL,
  `DelTag` smallint(6) NOT NULL,
  `RegisterOT` int(11) DEFAULT NULL,
  `AutoSchPlan` int(11) DEFAULT NULL,
  `MinAutoSchInterval` int(11) DEFAULT NULL,
  `Image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userid`, `badgenumber`, `defaultdeptid`, `name`, `Password`, `Card`, `Privilege`, `AccGroup`, `TimeZones`, `Gender`, `Birthday`, `street`, `zip`, `ophone`, `FPHONE`, `pager`, `minzu`, `title`, `SN`, `SSN`, `UTime`, `State`, `City`, `SECURITYFLAGS`, `DelTag`, `RegisterOT`, `AutoSchPlan`, `MinAutoSchInterval`, `Image_id`) VALUES
(1, '000071196', 1, 'Admin', '12345', '0', 14, 1, '0000000000000000', 'L', '1998-04-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6339160200267', NULL, '2021-08-11 16:31:13', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL),
(2, '8012345', 1, 'Chan Chan Bayu Bahari ', '12345', '0', 0, 1, '0000000000000000', 'L', '2000-12-06 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6339160200267', NULL, '2021-08-10 21:51:22', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL),
(3, '150301004', 1, 'GATES', '12345', '0', 2, 1, '0', 'L', '1996-11-07 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6339160200267', NULL, '2021-08-11 16:20:16', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL),
(5, '150301007', 1, 'Chan Bayu', '12345', '0', 12, 1, '0', 'L', '2021-08-18 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6339160200267', NULL, '2021-08-11 16:30:12', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`permission_id`),
  ADD KEY `auth_group_permissions_group_id` (`group_id`),
  ADD KEY `auth_group_permissions_permission_id` (`permission_id`);

--
-- Indexes for table `auth_message`
--
ALTER TABLE `auth_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_message_user_id` (`user_id`);

--
-- Indexes for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_type_id` (`content_type_id`,`codename`),
  ADD KEY `auth_permission_content_type_id` (`content_type_id`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`group_id`),
  ADD KEY `auth_user_groups_user_id` (`user_id`),
  ADD KEY `auth_user_groups_group_id` (`group_id`);

--
-- Indexes for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`permission_id`),
  ADD KEY `auth_user_user_permissions_user_id` (`user_id`),
  ADD KEY `auth_user_user_permissions_permission_id` (`permission_id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`bulan_id`);

--
-- Indexes for table `checkinout`
--
ALTER TABLE `checkinout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`,`checktime`),
  ADD KEY `checkinout_userid` (`userid`),
  ADD KEY `checkinout_SN` (`SN`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DeptID`),
  ADD KEY `DEPTNAME` (`DeptName`);

--
-- Indexes for table `devcmds`
--
ALTER TABLE `devcmds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devcmds_SN_id` (`SN_id`),
  ADD KEY `devcmds_User_id` (`User_id`);

--
-- Indexes for table `devlog`
--
ALTER TABLE `devlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devlog_SN_id` (`SN_id`);

--
-- Indexes for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `django_admin_log_user_id` (`user_id`),
  ADD KEY `django_admin_log_content_type_id` (`content_type_id`);

--
-- Indexes for table `django_content_type`
--
ALTER TABLE `django_content_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_label` (`app_label`,`model`);

--
-- Indexes for table `django_session`
--
ALTER TABLE `django_session`
  ADD PRIMARY KEY (`session_key`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `gaji_userid_foreign` (`userid`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id_user_group`),
  ADD KEY `group_user_userid_foreign` (`userid_group`),
  ADD KEY `group_user_seksi_id_foreign` (`seksi_id`);

--
-- Indexes for table `iclock`
--
ALTER TABLE `iclock`
  ADD PRIMARY KEY (`SN`),
  ADD KEY `iclock_DeptID` (`DeptID`);

--
-- Indexes for table `iclock_adminlog`
--
ALTER TABLE `iclock_adminlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iclock_adminlog_User_id` (`User_id`);

--
-- Indexes for table `iclock_deptadmin`
--
ALTER TABLE `iclock_deptadmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iclock_deptadmin_user_id` (`user_id`),
  ADD KEY `iclock_deptadmin_dept_id` (`dept_id`);

--
-- Indexes for table `iclock_iclockmsg`
--
ALTER TABLE `iclock_iclockmsg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iclock_iclockmsg_SN_id` (`SN_id`);

--
-- Indexes for table `iclock_messages`
--
ALTER TABLE `iclock_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iclock_messages_DeptID_id` (`DeptID_id`);

--
-- Indexes for table `iclock_oplog`
--
ALTER TABLE `iclock_oplog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SN` (`SN`,`OPTime`),
  ADD KEY `iclock_oplog_SN` (`SN`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `image_userid_foreign` (`userid_image`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_userid_foreign` (`userid`),
  ADD KEY `shift_id_foreign` (`shift_id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kegiatan_id`),
  ADD KEY `kegiatan_userid_foreign` (`userid`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id_keterangan`);

--
-- Indexes for table `latetime`
--
ALTER TABLE `latetime`
  ADD PRIMARY KEY (`latetime_id`),
  ADD KEY `latetime_idlatetime_foreign` (`idlatetime`),
  ADD KEY `latetime_userid_foreign` (`useridLatetime`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbaikanabsen`
--
ALTER TABLE `perbaikanabsen`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `perbaikanabsen_userid_foreign` (`userid`),
  ADD KEY `perbaikanabsen_keterangan_id_foreign` (`keterangan_id`),
  ADD KEY `perbaikanabsen_jadwal_id_foreign` (`jadwal_id`);

--
-- Indexes for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD PRIMARY KEY (`id_peringatan`),
  ADD KEY `peringatan_userid_foreign` (`userid`);

--
-- Indexes for table `rolemanagement`
--
ALTER TABLE `rolemanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seksibagian`
--
ALTER TABLE `seksibagian`
  ADD PRIMARY KEY (`id_seksi`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`templateid`),
  ADD UNIQUE KEY `userid` (`userid`,`FingerID`),
  ADD UNIQUE KEY `USERFINGER` (`userid`,`FingerID`),
  ADD KEY `template_userid` (`userid`),
  ADD KEY `template_SN` (`SN`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userinfo_defaultdeptid` (`defaultdeptid`),
  ADD KEY `userinfo_SN` (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_message`
--
ALTER TABLE `auth_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `bulan_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checkinout`
--
ALTER TABLE `checkinout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devcmds`
--
ALTER TABLE `devcmds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `devlog`
--
ALTER TABLE `devlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `django_content_type`
--
ALTER TABLE `django_content_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id_user_group` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iclock_adminlog`
--
ALTER TABLE `iclock_adminlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `iclock_deptadmin`
--
ALTER TABLE `iclock_deptadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iclock_iclockmsg`
--
ALTER TABLE `iclock_iclockmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iclock_messages`
--
ALTER TABLE `iclock_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iclock_oplog`
--
ALTER TABLE `iclock_oplog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kegiatan_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id_keterangan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `latetime`
--
ALTER TABLE `latetime`
  MODIFY `latetime_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `perbaikanabsen`
--
ALTER TABLE `perbaikanabsen`
  MODIFY `id_perbaikan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peringatan`
--
ALTER TABLE `peringatan`
  MODIFY `id_peringatan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rolemanagement`
--
ALTER TABLE `rolemanagement`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seksibagian`
--
ALTER TABLE `seksibagian`
  MODIFY `id_seksi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id_shift` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `templateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD CONSTRAINT `group_id_refs_id_3cea63fe` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `permission_id_refs_id_5886d21f` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`);

--
-- Constraints for table `auth_message`
--
ALTER TABLE `auth_message`
  ADD CONSTRAINT `user_id_refs_id_650f49a6` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD CONSTRAINT `content_type_id_refs_id_728de91f` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`);

--
-- Constraints for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD CONSTRAINT `group_id_refs_id_f116770` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `user_id_refs_id_7ceef80f` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  ADD CONSTRAINT `permission_id_refs_id_67e79cb` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `user_id_refs_id_dfbab7d` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `checkinout`
--
ALTER TABLE `checkinout`
  ADD CONSTRAINT `SN_refs_SN_5f5eab5` FOREIGN KEY (`SN`) REFERENCES `iclock` (`SN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devcmds`
--
ALTER TABLE `devcmds`
  ADD CONSTRAINT `SN_id_refs_SN_2cf7b853` FOREIGN KEY (`SN_id`) REFERENCES `iclock` (`SN`),
  ADD CONSTRAINT `User_id_refs_id_21fb0645` FOREIGN KEY (`User_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `devlog`
--
ALTER TABLE `devlog`
  ADD CONSTRAINT `SN_id_refs_SN_9fc6243` FOREIGN KEY (`SN_id`) REFERENCES `iclock` (`SN`);

--
-- Constraints for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD CONSTRAINT `content_type_id_refs_id_288599e6` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`),
  ADD CONSTRAINT `user_id_refs_id_c8665aa` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_seksi_id_foreign` FOREIGN KEY (`seksi_id`) REFERENCES `seksibagian` (`id_seksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_user_userid_foreign` FOREIGN KEY (`userid_group`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iclock`
--
ALTER TABLE `iclock`
  ADD CONSTRAINT `DeptID_refs_DeptID_6c0f82f2` FOREIGN KEY (`DeptID`) REFERENCES `departments` (`DeptID`);

--
-- Constraints for table `iclock_adminlog`
--
ALTER TABLE `iclock_adminlog`
  ADD CONSTRAINT `User_id_refs_id_1917be56` FOREIGN KEY (`User_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `iclock_deptadmin`
--
ALTER TABLE `iclock_deptadmin`
  ADD CONSTRAINT `dept_id_refs_DeptID_301f0ebd` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`DeptID`),
  ADD CONSTRAINT `user_id_refs_id_47b0265e` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `iclock_iclockmsg`
--
ALTER TABLE `iclock_iclockmsg`
  ADD CONSTRAINT `SN_id_refs_SN_5974413e` FOREIGN KEY (`SN_id`) REFERENCES `iclock` (`SN`);

--
-- Constraints for table `iclock_messages`
--
ALTER TABLE `iclock_messages`
  ADD CONSTRAINT `DeptID_id_refs_DeptID_a1c008a` FOREIGN KEY (`DeptID_id`) REFERENCES `departments` (`DeptID`);

--
-- Constraints for table `iclock_oplog`
--
ALTER TABLE `iclock_oplog`
  ADD CONSTRAINT `SN_refs_SN_3b91645d` FOREIGN KEY (`SN`) REFERENCES `iclock` (`SN`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_userid_foreign` FOREIGN KEY (`userid_image`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id_shift`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `latetime`
--
ALTER TABLE `latetime`
  ADD CONSTRAINT `latetime_idlatetime_foreign` FOREIGN KEY (`idlatetime`) REFERENCES `checkinout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `latetime_userid_foreign` FOREIGN KEY (`useridLatetime`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perbaikanabsen`
--
ALTER TABLE `perbaikanabsen`
  ADD CONSTRAINT `perbaikanabsen_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perbaikanabsen_keterangan_id_foreign` FOREIGN KEY (`keterangan_id`) REFERENCES `keterangan` (`id_keterangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perbaikanabsen_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD CONSTRAINT `peringatan_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `SN_refs_SN_127ef830` FOREIGN KEY (`SN`) REFERENCES `iclock` (`SN`),
  ADD CONSTRAINT `userid_refs_userid_28d21be` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `SN_refs_SN_3dca41a1` FOREIGN KEY (`SN`) REFERENCES `iclock` (`SN`),
  ADD CONSTRAINT `defaultdeptid_refs_DeptID_17a2b9c0` FOREIGN KEY (`defaultdeptid`) REFERENCES `departments` (`DeptID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
