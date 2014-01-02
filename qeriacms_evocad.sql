-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2014 at 11:53 AM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qeriacms_evocad`
--

-- --------------------------------------------------------

--
-- Table structure for table `JobListings`
--

CREATE TABLE IF NOT EXISTS `JobListings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_relocation` tinyint(1) NOT NULL,
  `job_remotely` tinyint(1) NOT NULL,
  `job_apply_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_instruction` text COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name_status` tinyint(1) NOT NULL,
  `company_url` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `company_descripton` text COLLATE utf8_unicode_ci NOT NULL,
  `company_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `published` date NOT NULL,
  `term_and_conditions` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `JobListings`
--

INSERT INTO `JobListings` (`id`, `job_title`, `job_type`, `job_description`, `job_location`, `job_relocation`, `job_remotely`, `job_apply_by`, `job_instruction`, `company_name`, `company_name_status`, `company_url`, `company_descripton`, `company_logo`, `approved`, `published`, `term_and_conditions`, `created_at`, `updated_at`) VALUES
(1, 'Golang', 'remote', 'dsfsdf', 'lousiana', 1, 0, '0', 'dsfsdfsd', 'nexuss', 1, 'www.google.com', 'sdfsdf', 'change-5223-39212-1-zoom.jpg', 0, '0000-00-00', 1, '2013-12-26 13:10:59', '2013-12-26 13:10:59'),
(2, 'Django development', 'Internship', 'intern', 'pakistan', 1, 1, 'rooott@gmail.com', 'lsdkjfl', 'lose', 1, 'www.nexus.com', 'jsldkjf', 'Rung-Barsey-By-Nyla-Eid-Dresses-2013-002.jpg', 0, '0000-00-00', 1, '2013-12-26 13:58:26', '2013-12-26 13:58:26'),
(3, 'Laravel', 'Internship', 'sdfsdfsdf', 'pakistan', 1, 1, 'rooott@gmail.com', 'sdfds', 'jello corp', 1, 'www.nexus.comm', 'sdfsd', 'image6868250301388588257.jpg', 0, '0000-00-00', 1, '2014-01-01 09:57:37', '2014-01-01 09:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_06_20_040924_orchestra_story_make_contents_table', 1),
('2013_04_11_233631_orchestra_memory_create_options_table', 2),
('2013_04_12_000836_orchestra_auth_create_users_table', 3),
('2013_04_12_012833_orchestra_auth_create_user_meta_table', 3),
('2013_04_12_013023_orchestra_auth_create_roles_table', 3),
('2013_04_12_013201_orchestra_auth_create_user_role_table', 3),
('2013_04_23_132623_orchestra_auth_basic_roles', 3),
('2013_05_27_062915_orchestra_auth_create_password_reminders_table', 3),
('2013_06_22_042506_orchestra_story_seed_acl', 4),
('2013_05_24_091711_orchestra_control_seed_acls', 5),
('2013_11_17_160818_create_oauth_table', 6),
('2013_12_24_195659_create_joblistings_table', 6),
('2013_12_31_114837_add_column_approved_in_joblistings', 7),
('2014_01_01_180517_add_published_to_property_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `oauths`
--

CREATE TABLE IF NOT EXISTS `oauths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `oauths_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orchestra_options`
--

CREATE TABLE IF NOT EXISTS `orchestra_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orchestra_options_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orchestra_options`
--

INSERT INTO `orchestra_options` (`id`, `name`, `value`) VALUES
(1, 'site', 'a:2:{s:4:"name";s:18:"Orchestra Platform";s:5:"theme";a:2:{s:8:"frontend";s:7:"default";s:7:"backend";s:7:"default";}}'),
(2, 'email', 'a:9:{s:6:"driver";s:4:"mail";s:4:"host";s:16:"smtp.mailgun.org";s:4:"port";i:587;s:4:"from";a:2:{s:4:"name";s:18:"Orchestra Platform";s:7:"address";s:16:"rooott@gmail.com";}s:10:"encryption";s:3:"tls";s:8:"username";N;s:8:"password";N;s:8:"sendmail";s:22:"/usr/sbin/sendmail -bs";s:7:"pretend";b:0;}'),
(3, 'acl_orchestra', 'a:3:{s:7:"actions";a:2:{i:0;s:16:"manage-orchestra";i:1;s:12:"manage-users";}s:5:"roles";a:3:{i:0;s:5:"guest";i:1;s:13:"administrator";i:2;s:6:"member";}s:3:"acl";a:2:{s:3:"1:0";b:1;s:3:"1:1";b:1;}}'),
(4, 'extensions', 'a:1:{s:9:"available";a:3:{s:3:"app";a:10:{s:4:"path";s:5:"app::";s:11:"source-path";s:5:"app::";s:4:"name";s:9:"Kimosocci";s:11:"description";s:16:"Social Login App";s:6:"author";s:28:"Balasubramaniam Gnanakeethan";s:3:"url";s:20:"https://github.com//";s:7:"version";s:5:"1.0.0";s:6:"config";a:0:{}s:8:"autoload";a:0:{}s:7:"provide";a:0:{}}s:17:"orchestra/control";a:10:{s:4:"path";s:25:"vendor::orchestra/control";s:11:"source-path";s:25:"vendor::orchestra/control";s:4:"name";s:7:"Control";s:11:"description";s:36:"Orchestra Platform Control Extension";s:6:"author";s:18:"Mior Muhammad Zaki";s:3:"url";s:37:"https://github.com/orchestral/control";s:7:"version";s:6:"2.0.12";s:6:"config";a:0:{}s:8:"autoload";a:0:{}s:7:"provide";a:1:{i:0;s:40:"Orchestra\\Control\\ControlServiceProvider";}}s:15:"orchestra/story";a:10:{s:4:"path";s:23:"vendor::orchestra/story";s:11:"source-path";s:23:"vendor::orchestra/story";s:4:"name";s:9:"Story CMS";s:11:"description";s:19:"Story CMS Extension";s:6:"author";s:18:"Mior Muhammad Zaki";s:3:"url";s:35:"https://github.com/orchestral/story";s:7:"version";s:5:"2.0.5";s:6:"config";a:1:{s:7:"handles";s:3:"cms";}s:8:"autoload";a:0:{}s:7:"provide";a:1:{i:0;s:36:"Orchestra\\Story\\StoryServiceProvider";}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2013-12-23 05:30:24', '2013-12-23 05:30:24', NULL),
(2, 'Member', '2013-12-23 05:30:24', '2013-12-23 05:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `story_contents`
--

CREATE TABLE IF NOT EXISTS `story_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'markdown',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `story_contents_user_id_index` (`user_id`),
  KEY `story_contents_slug_index` (`slug`),
  KEY `story_contents_format_index` (`format`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'rooott@gmail.com', '$2y$08$fIeULEnZSZlxhckWmDJEgOc9yf4Sp2m6O2aQ40Ox8BcWBR.Z0RUD6', 'Muhammad Saqib', 1, '2013-12-23 05:30:40', '2013-12-23 05:30:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_meta_user_id_name_unique` (`user_id`,`name`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_role_user_id_role_id_index` (`user_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2013-12-23 05:30:40', '2013-12-23 05:30:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oauths`
--
ALTER TABLE `oauths`
  ADD CONSTRAINT `oauths_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
