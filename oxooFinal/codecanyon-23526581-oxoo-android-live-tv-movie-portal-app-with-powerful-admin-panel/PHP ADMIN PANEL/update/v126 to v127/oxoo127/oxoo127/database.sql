-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2020 at 10:56 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v120_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--
UPDATE `config` SET `value` = '1.2.7' WHERE `config`.`title` = 'version';

DROP TABLE IF EXISTS `temp_config`;
CREATE TABLE IF NOT EXISTS `temp_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `temp_config` (`config_id`, `title`, `value`) VALUES
(194, 'system_name', 'OXOO - Android Live TV & Movie Portal'),
(195, 'site_name', 'My Movie Site'),
(196, 'business_address', ''),
(197, 'business_phone', ''),
(198, 'contact_email', 'contact@mydomain.com'),
(199, 'system_email', ''),
(200, 'system_short_name', 'OXOO'),
(201, 'slider_type', 'movie'),
(202, 'slide_per_page', ''),
(203, 'protocol', 'mail'),
(204, 'mailpath', '/usr/bin/sendmail'),
(205, 'smtp_host', 'smtp.gmail.com'),
(206, 'smtp_user', 'email@gmail.com'),
(207, 'smtp_pass', ''),
(208, 'smtp_port', '465'),
(209, 'smtp_crypto', 'ssl'),
(210, 'comments_approval', '1'),
(211, 'movie_per_page', '72'),
(212, 'purchase_code', 'be5a1cd7-99e8-4a7a-974f-664695d9ac5d'),
(213, 'push_notification_enable', ''),
(214, 'onesignal_appid', 'one_signal_app_id_here'),
(215, 'onesignal_api_keys', 'one_signal_api_key_here'),
(216, 'mobile_apps_api_secret_key', '7544c259023b01a'),
(217, 'cron_key', '8ef93f7f477aa46'),
(218, 'db_backup', '1'),
(219, 'backup_schedule', '30'),
(220, 'version', '1.2.7'),
(221, 'terms', ''),
(222, 'total_movie_in_slider', '5'),
(223, 'preroll_ads_enable', '0'),
(224, 'preroll_ads_video', ''),
(225, 'admob_ads_enable', '1'),
(226, 'admob_publisher_id', ' pub-xxxxxxxxxxxxxx'),
(227, 'admob_app_id', 'ca-app-pub-xxxxxxxxxx~xxxxxxxxx'),
(228, 'admob_banner_ads_id', 'ca-app-pub-xxxxxxxxx/xxxxxxxxx'),
(229, 'admob_interstitial_ads_id', 'ca-app-pub-xxxxxxxxxxxxxxx/xxxxxxxxxx'),
(230, 'app_menu', 'vertical'),
(231, 'app_program_guide_enable', 'false'),
(232, 'app_mandatory_login', 'false'),
(233, 'genre_visible', 'true'),
(234, 'country_visible', 'false'),
(235, 'trial_enable', '1'),
(236, 'trial_period', '7'),
(237, 'paypal_email', 'paypal@yourwebsite.com'),
(238, 'currency_symbol', '$'),
(239, 'stripe_publishable_key', 'pk_test_fBUK0yZBlxsTrHoQudKGVD6s00EtEapeAl'),
(240, 'stripe_secret_key', 'sk_test_QgCvIIJGWMKwLeLrvROYIKAV00qsjPGf4n'),
(241, 'currency', 'USD'),
(256, 'program_guide_enable', '1'),
(242, 'mobile_ads_enable', '0'),
(243, 'mobile_ads_network', 'admob'),
(244, 'fan_native_ads_placement_id', 'xxxxxxxxxxxxx_xxxxxxxxxxxxx'),
(245, 'fan_banner_ads_placement_id', 'xxxxxxxxxx_xxxxxxxxxxxx'),
(246, 'fan_Interstitial_ads_placement_id', 'xxxxxxxxxxx_xxxxxxxxxxxxxx'),
(247, 'startapp_app_id', 'xxxxxxxxxxx'),
(248, 'paypal_client_id', 'xxxxxxxxxxxxxxxxxxxxxxxxxx'),
(249, 'exchange_rate_update_by_cron', '0'),
(250, 'enable_ribbon', '1'),
(251, 'apk_version_code', '15'),
(252, 'apk_version_name', 'v1.2.0'),
(253, 'apk_whats_new', 'New UI\r\nDownload option\r\nAdvanced Search\r\nSubscription'),
(254, 'latest_apk_url', 'http://oxoo.spagreen.net/demo/oxoo-v114.apk'),
(257, 'apk_update_is_skipable', '1'),
(258, 'season_order', 'DESC'),
(259, 'episode_order', 'DESC'),
(260, 'video_file_order', 'ASC'),
(261, 'video_source', 'video_source'),
(262, 'razorpay_key_id', 'xxxxxxxxxxx'),
(263, 'razorpay_key_secret', 'xxxxxxxxxxxx'),
(264, 'paypal_enable', 'true'),
(265, 'stripe_enable', 'true'),
(266, 'razorpay_enable', 'true'),
(267, 'razorpay_inr_exchange_rate', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
