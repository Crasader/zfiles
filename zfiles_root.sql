-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 31, 2017 lúc 09:20 PM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `zfiles_root`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `advertising`
--

CREATE TABLE `advertising` (
  `id` int(10) UNSIGNED NOT NULL,
  `adsPosition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adsPage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adsContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `advertising`
--

INSERT INTO `advertising` (`id`, `adsPosition`, `adsPage`, `adsContent`, `created_at`, `updated_at`) VALUES
(1, 'top', 'home', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'bottom', 'home', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'top', 'profile', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'bottom', 'profile', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'top', 'download', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'bottom', 'download', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `emailsettings`
--

CREATE TABLE `emailsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `emailFromName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailFromEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPHostAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPHostPort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMailEncryptionProtocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPServerUsername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SMTPServerPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `emailsettings`
--

INSERT INTO `emailsettings` (`id`, `emailFromName`, `emailFromEmail`, `SMTPHostAddress`, `SMTPHostPort`, `EMailEncryptionProtocol`, `SMTPServerUsername`, `SMTPServerPassword`, `created_at`, `updated_at`) VALUES
(1, 'Example', 'example@domain.com', '', '', '', '', '', '0000-00-00 00:00:00', '2015-06-29 22:00:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `emailSubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `emailType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `emailSubject`, `emailContent`, `emailType`, `created_at`, `updated_at`) VALUES
(1, 'You have Received new File/s! ', '', 'sendFilesTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Welcome to Zfiles Upload Center', '', 'welcomeTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Password Reset Request ', '', 'recoverPasswordTemplate', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `filePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileExt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `fileDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileSize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileStatus` int(11) NOT NULL,
  `fileDownloadCounter` int(11) NOT NULL,
  `userIp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`id`, `filePath`, `fileName`, `fileExt`, `userID`, `fileDesc`, `fileSize`, `fileStatus`, `fileDownloadCounter`, `userIp`, `created_at`, `updated_at`) VALUES
(4, 'http://localhost/zFiles/file/1498037477_ai_0', 'ai_0', 'jpg', 0, 'GHoXXcCM6S3Pba8qJb2PqFV9GF7Z2qMwwRBQ0dfO', '157387', 1, 1000, '::1', '2017-06-21 16:31:18', '2017-06-21 16:32:22'),
(7, 'http://localhost/zFiles/file/1498202608_keuqTK', 'tải xuống', 'jpg', 0, 'KESAR7v6jzTdJ5E04Iu4XKl3QiJZdhz1WdDzUrjK', '3857', 1, 1000, '::1', '2017-06-23 14:23:28', '2017-06-23 14:23:28'),
(9, 'http://localhost:8080/zFiles/file/1499658738_UKpxAv', 'tải xuống (1)', 'jpg', 0, 'AUqoqE1hBrEh7oH0w4PCqIltxx7HI3Tbpg17H4nV', '3857', 1, 0, '::1', '2017-07-09 20:52:18', '2017-07-09 20:52:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `pay_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lockedfiles`
--

CREATE TABLE `lockedfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `fileId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `filePassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lockedfiles`
--

INSERT INTO `lockedfiles` (`id`, `fileId`, `userID`, `filePassword`, `created_at`, `updated_at`) VALUES
(1, '4', 0, '$2y$10$ikYqFlK.R9HUk7VlKFr3RO9I8amsIxR3eQak3wf7TESGMMAFpAhq6', '2017-06-21 16:33:43', '2017-06-21 16:33:43'),
(4, '36', 1, '$2y$10$vvOrsM4dU0slzLwMmIWVaOitd1HcQyyIxMwQVbN0z6JJ1dyDXGF3W', '2017-08-10 03:17:04', '2017-08-10 03:22:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_06_01_155428_Create_Users_Table', 1),
('2015_06_01_175908_Create_Settings_Table', 1),
('2015_06_03_113914_Create_Uploaded_Files_Table', 1),
('2015_06_09_233030_Locked_Files_Table', 1),
('2015_06_20_203635_Create_Upload_Settings_Table', 1),
('2015_06_21_164952_Create_Social_Links_Table', 1),
('2015_06_24_201803_Create_Email_Settings_Table', 1),
('2015_06_25_182256_Create_Email_Templates_Table', 1),
('2015_06_25_222037_create_password_reminders_table', 1),
('2015_06_27_015842_Create_Template_Themes_Table', 1),
('2015_06_27_071847_Create_Advertising_Settings_Table', 1),
('2015_06_29_020432_Create_Theme_Customize_Table', 1),
('2015_06_30_011221_Create_Pages_Table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `pageOrder` int(11) NOT NULL,
  `pageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reminders`
--

CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `name`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal & Credit Card', 'company1996@gmail.com', 1, '2017-08-05 11:20:42', '2017-08-05 04:20:42'),
(2, 'Payoneer', 'vuquocthang63@gmail.com', 1, '2017-07-10 07:30:33', '2017-07-10 00:30:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `referral_profit` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `profit`, `referral_profit`, `created_at`, `updated_at`) VALUES
(1, 'GUEST', '0.00', '0.00', '0.00', '2017-07-10 02:38:32', '2017-06-23 01:00:02'),
(2, 'FREE ', '0.00', '0.01', '0.02', '2017-07-10 02:38:11', '2017-06-24 16:50:52'),
(3, 'Premium', '19.99', '0.99', '0.03', '2017-08-05 11:32:01', '2017-08-05 04:32:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `require_withdraw`
--

CREATE TABLE `require_withdraw` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `status` int(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `confirm_email` int(11) NOT NULL,
  `sitename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_status` int(11) NOT NULL,
  `site_favicon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `confirm_email`, `sitename`, `email`, `description`, `keywords`, `site_status`, `site_favicon`, `site_logo`, `created_at`, `updated_at`) VALUES
(1, 0, 'Z-Files Upload Center', 'user@zfiles.com', 'Website Description For SEO', 'Website,Keywords,For,SEO', 1, '', '', '0000-00-00 00:00:00', '2017-07-23 14:11:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social`
--

CREATE TABLE `social` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebookLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitterLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `googlePlusLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `social`
--

INSERT INTO `social` (`id`, `facebookLink`, `twitterLink`, `googlePlusLink`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '0000-00-00 00:00:00', '2015-06-23 01:13:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test_cronjob`
--

CREATE TABLE `test_cronjob` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `test_cronjob`
--

INSERT INTO `test_cronjob` (`id`, `value`, `created_at`, `updated_at`) VALUES
(1, '1234', '2017-08-29 04:59:12', '2017-08-29 04:59:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `themecustomize`
--

CREATE TABLE `themecustomize` (
  `id` int(10) UNSIGNED NOT NULL,
  `welcomeText` longtext COLLATE utf8_unicode_ci NOT NULL,
  `someHtml` longtext COLLATE utf8_unicode_ci NOT NULL,
  `someCss` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `themecustomize`
--

INSERT INTO `themecustomize` (`id`, `welcomeText`, `someHtml`, `someCss`, `created_at`, `updated_at`) VALUES
(1, '<h1>The easiest way to Upload & send large files fast ...</h1><p>You Can Upload Your Files Directly It\'s Free, Also You Can Signup and Get 5GB !</p>', '', '', '0000-00-00 00:00:00', '2015-06-29 00:44:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `themeStatus` int(11) NOT NULL,
  `themeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `themeFileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `themes`
--

INSERT INTO `themes` (`id`, `themeStatus`, `themeName`, `themeFileName`, `created_at`, `updated_at`) VALUES
(1, 0, 'Defualt', 'defualt', '0000-00-00 00:00:00', '2015-06-27 02:17:01'),
(2, 1, 'z-Responsive', 'z-Responsive', '0000-00-00 00:00:00', '2015-07-03 08:08:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `txnId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transactionDate` datetime NOT NULL,
  `pay_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `txnId`, `payment_method_id`, `content`, `transactionDate`, `pay_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 19, '0S4275594B857864X', 1, 'Pay for Premium Plan', '2017-08-28 10:05:07', 1, 0, '2017-08-28 10:07:20', '2017-08-28 03:07:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploadsettings`
--

CREATE TABLE `uploadsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(255) NOT NULL,
  `maxFileSize` bigint(20) UNSIGNED NOT NULL,
  `maxUploadsFiles` int(11) NOT NULL,
  `allowedFilesExt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userDiskSpace` bigint(20) UNSIGNED NOT NULL,
  `fileExpireLimit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `uploadsettings`
--

INSERT INTO `uploadsettings` (`id`, `plan_id`, `maxFileSize`, `maxUploadsFiles`, `allowedFilesExt`, `userDiskSpace`, `fileExpireLimit`, `created_at`, `updated_at`) VALUES
(1, 1, 536870912, 1, 'png,jpg,gif', 1073741824, '5', '0000-00-00 00:00:00', '2017-07-09 20:52:05'),
(2, 2, 10485760, 3, 'png,jpg,gif,mp4', 20971520, '500000000000000000000000000', '0000-00-00 00:00:00', '2017-08-11 10:26:56'),
(3, 3, 104857600, 5, 'jpg,mp4,rar,zip,png,exe\r\n\r\n', 10485760, '150000000000000000000000000', '0000-00-00 00:00:00', '2017-08-10 10:21:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirm_email_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirm_email_status` int(11) NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` int(255) NOT NULL,
  `number_of_referral` int(11) NOT NULL,
  `last_number_of_download` int(255) NOT NULL,
  `last_number_of_referral` int(255) NOT NULL,
  `pay_status` bit(1) NOT NULL,
  `status_id` int(11) NOT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `confirm_email_key`, `confirm_email_status`, `paypal_email`, `level`, `plan_id`, `number_of_referral`, `last_number_of_download`, `last_number_of_referral`, `pay_status`, `status_id`, `last_login`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '$2y$10$nTRA9mxny8vVGCd8QuIbueSDfdCP0fhhH2M6ai55puQvQwfz18DZS', 'admin@demo.com', '', 1, 'abc@gmail.com', 'admin', 3, 0, 0, 0, b'1', 5, '2017-08-24 04:26:24', '2015-06-17 12:15:15', '2017-08-23 21:26:24', 'MrjrGjhIQVl4Kdp1MDxWoEqZAToKgx7JWeX0NoyVftrHfWHT0WNGbsFHbENk'),
(19, 'user2', '$2y$10$xZo0qLk.69lLULZUn.dqB.IOP0fl./AAdlbKALg3xiVWT5LcWbuQq', 'user2@gmail.com', '', 1, '', 'user', 2, 2147483647, 0, 0, b'0', 4, '2017-08-28 09:57:54', '2017-07-09 20:19:48', '2017-08-28 03:07:20', 'nQ9ls8AHuS9RoZ8M8gMkq3KGpyo81sj3nkMSI9swTBRPfaS8nHsBgDcIF83X'),
(20, 'user3', '$2y$10$2PiVLDl5/bOYUvXhlyoUSO0FgHbKspmrExV1h8sC1lXo7VAcn4l/K', 'vuquocthang63@gmail.com', '8e7ed5381c7f8f09dd3653989e447301', 1, 'vuquocthang63@gmail.com', 'user', 3, 0, 0, 100000, b'0', 4, '2017-07-31 13:21:03', '2017-07-09 20:22:53', '2017-07-31 18:21:15', 'ilSeyROyIgSSo07KGy5ceflZKYRqVjObrvverKhHjpHHyPNe3OUVLNyiIjLF'),
(21, 'user4', '$2y$10$3tW.6zLMisiF6tLlrOOxn.De.rw.aTlPBa3RJm9UA4JFfSl2jGf0e', 'user4@gmail.com', '4b7c4b4cb9611e946adffe9b5f348292', 0, '', 'user', 2, 0, 0, 0, b'0', 1, 'null', '2017-07-12 03:54:20', '2017-07-12 03:54:20', NULL),
(22, 'bacvv', '$2y$10$w91Q0nayPNwzHOm3jX0tQOGenx9B2X3oiRFPvqy67goBh0bJAAjS2', 'bacvv@ymail.com', '8f152874710c5a05593670be6798c2b2', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-19 18:48:26', '2017-07-19 18:50:07', 'OwewFDMMLbW0vTmknU9vP59oV9ZNKXvkAeHYzWrBvBG8YwIjC2upIMNaajOv'),
(23, 'bacvv1', '$2y$10$QYKiqCeQxShrR0JAfP0SJu60Fe3EfpqVZrImfQcj33bY2Ucy2ulo2', 'bacvv1@gmail.com', '8aa9a05f0d0b15bbc348c0980ce10190', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:11:46', '2017-07-23 14:12:26', '1pAGhMIhZQRhlrD0wVX9LXL3OZH1hcD8oXgUu22wHyVI75zh2PVuaodUEMMJ'),
(24, 'bacvv2', '$2y$10$9qqXCsAbsH50ySPT/kQ.u.ONHDcw8yb.5kytiSg9FRGMyLcNcfHrq', 'bacvv2@gmail.com', '', 0, 'vuvanbac@ymail.com', 'user', 3, 0, 0, 0, b'0', 5, 'null', '2017-07-23 14:12:45', '2017-07-23 14:51:41', 'RM9WhzzdPDj8et6GFthAal8pjZgg78b51Qg5Y7YyVuOqFQJhU7OD3QItoXPG'),
(25, 'bacvv3', '$2y$10$EFMJ9gkzoGGqeVu2UQQH6.GC7QQ0ceXb2KRSLUWN57z8wLNypb2Xi', 'bacvv3@gmail.com', '', 0, '', 'user', 2, 0, 0, 0, b'0', 1, 'null', '2017-07-23 14:52:01', '2017-07-23 14:52:16', 'nbbG9EVAYrnkgGisaSxQmkye213EanUcVDavcbMHBTrEVVa7ZEQpCSAmhA35'),
(26, 'bacvv4', '$2y$10$nP1UnkuU2VI4aPFMqv7QhuQ0sbnaILmdAMskUJxrUCaHxpQHfIqK6', 'bacvv4@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 4, 'null', '2017-07-23 14:52:36', '2017-07-23 14:53:16', 'QjaGE19Yb5GETCtDhHr5HSPjK5CF3sKwC3uAbjaBAZCk7Wt66lLIuLllDQQu'),
(27, 'bacvv5', '$2y$10$zeRFqeUaBZG7ZZH.aYHjg.g.hc1bJ7JmJfbqZZFQHjj9fuoA.MpRu', 'bacvv5@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 5, 'null', '2017-07-23 14:53:48', '2017-07-23 14:54:32', 'OyEzrbjQKgQKthNCyphGXcBnhEmBVeC2TOA2mzWvM3f9AYKEfm9B9ae5tenb'),
(28, 'bacvv6', '$2y$10$Du7/bzTew9Baq9i9S2ExbeBEc1ovYh5ZRRTBtjToe/yMv7kL0/212', 'bacvv6@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 5, 'null', '2017-07-23 14:54:52', '2017-07-23 14:55:23', 'r2Ragcn6fj4Wzylt4ARhEqVz0v0Yax4feGZlwyEJ6TWlBDFzkj53u4ezSxKy'),
(29, 'bacvv7', '$2y$10$yDacCsBpoIISGNcTvRpv/ugk6JgLGfpgx9yhunt42nf2sQOKnK5HO', 'bacvv7@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 4, 'null', '2017-07-23 14:55:42', '2017-07-23 14:56:11', 'ATLX1LLC6sTKPFjnINxnRJxWbUfSz9r7ZZ1Mg9P2Rg9Ko3yeyZaSv3VHq3uW'),
(30, 'bacvv8', '$2y$10$1QvQO9iEyso1lIZgFGbEU.iFP9d13EvAex0xOAoXrFf62KWBT5wxK', 'bacvv8@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:56:36', '2017-07-23 14:56:51', 'jNNzdhwpI4BHLSN3Vv1h1ou38Lra5gNXH3X1GMC5JADzQ1p3lUmGFCBctkFG'),
(31, 'bacvv9', '$2y$10$EqlWBCbsZdxTq4xH7UPLmeoxNbCoMx/Z.YZf.UWFB7h46O8lQ.5tS', 'bacvv9@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:57:22', '2017-07-23 14:57:26', 'u2CLm0u12p4PGsdFd25sP2esH5rrctJ06POb4mFQHTVXB80JLNBNYSTQS5pV'),
(32, 'bacvv10', '$2y$10$wUIDPkR2fBIbsRq8iZRete5ZgYRWX5epk34lamuY0Q4wN86mugVLq', 'bacvv10@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:57:44', '2017-07-23 14:57:57', 'GLH7oc3pZL5qqLhDyz1T9ej1DlYeNkp11QErKkEbtfvZ2EUaL30j6Ly0wHbH'),
(33, 'bacvv11', '$2y$10$qIPINCLrSL6/c2CztGPk../s5haJv7O.6Vd3OFJtwFr/0qlGPCCi6', 'bacvv11@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:58:19', '2017-07-23 14:58:22', 'RZX0eOVviBdlVIoElREob5oSX8i2L0MN9dWTTbBWGnoJmw28r2PfQznC39YF'),
(34, 'bacvv12', '$2y$10$F1FXgDcvtm1iZeSoJoWqE.5hqEJ41L51eOVPNvIIuuT1FMMoz9TyK', 'bacvv12@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:58:42', '2017-07-23 14:59:09', 'CklwJ3RQV3r7YqXN5hHIEOIfhjoBJPNPWqYiicRd6XnoP0EEhTez1RIuDbzk'),
(35, 'bacvv13', '$2y$10$lby7vQQ.6l4VRBzNbr/Zx.ILpm9ipU0E.E9KQNOy/w5.UwkMqcyxq', 'bacvv13@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 14:59:40', '2017-07-23 14:59:43', 'mZp33KdpFwVbsJs52bGweYqBV6sWYVQbQsQvRCK81AEGfi2TPw0q1oBS3lYB'),
(36, 'bacvv14', '$2y$10$x05x..giFJ/ZIM/gKwqAK.vfAwtgaj9FVI4gQMKKBUTV636MosCzu', 'bacvv14@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 15:00:06', '2017-07-23 15:00:10', 'bCrDXhW1HecgOPAlAbySwxkuZfF2ekEaDOlOcDneiX5JUI8NEPBKDkOCp97S'),
(37, 'bacvv15', '$2y$10$YPCY2JNykrwj7fGE0m9B5epLg5/yJfyAM8u3yq4EZvI9V7O3458ga', 'bacvv15@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 15:00:29', '2017-07-23 15:00:36', 'ljrbEMxtkQYzG37kloexO9IzvvOy9kvpvYIvUx5dBLnJSRVNtGVDeyu1nWkk'),
(38, 'bacvv16', '$2y$10$4Sp/VIy6SYpyRBcCOAIlSO3cBhfXp0oFH8PeXCKYIgGNwMnQjjDni', 'bacvv16@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 15:00:54', '2017-07-23 15:01:16', '30ZTeMM82uKmLxQrcdeZD8VhZRawSpCLn5Y62sF913JIoMiNeroijLAiTT3V'),
(39, 'bacvv17', '$2y$10$fVDnkW4tZJUNH/P10XvueOYzH.Id66veIKN1Dc1Cf8lfFVwwVavEO', 'bacvv17@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 3, 'null', '2017-07-23 15:01:45', '2017-07-23 15:01:45', NULL),
(40, 'bacvv19', '$2y$10$aS6QeWRK084iJroxOZazP.QIzHg.zocE8LvFMCJy8JHnZ0hElWGMq', 'bacvv19@gmail.com', '', 0, '', 'user', 3, 0, 0, 0, b'0', 5, '2017-07-31 13:17:53', '2017-07-31 14:07:56', '2017-07-31 18:17:53', NULL),
(41, 'tructruc', '$2y$10$pU1Kw0VoWVAybAZ6ufTmvuu0NHZaYiJDIAq8S1RMEnaUB0/rqpB5G', 'tructruc@gmail.com', '', 0, '', 'user', 2, 1, 0, 0, b'0', 1, '2017-08-12 02:43:19', '2017-08-11 10:24:18', '2017-08-12 07:43:40', 'KNmj8ggA9BM5dv8jVEjMqWxhgDuygqAUi60iji8LG0Ob7nxVGbWH6H6Xl8e0'),
(42, 'tructruc2', '$2y$10$XyUHISOW4jaLAj/F7mSIUuG.TXo9v/gO2MO4labdnQ.SVIlxJiiFy', 'tructruc2@gmail.com', '', 0, '', 'user', 2, 0, 0, 0, b'0', 1, '2017-08-11 05:40:07', '2017-08-11 10:31:16', '2017-08-11 10:40:07', 'HrMlq2LZuHlcWnT6WxFBzBBngpz4MaEugY4EUrxU9LxRmuqYzzEn9I2y5r5Q');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_status`
--

INSERT INTO `user_status` (`id`, `note`, `setting_notes`) VALUES
(1, 'free', 'free plan setting'),
(2, 'free -> vip (pending)', 'free plan setting'),
(3, 'vip (unpaid)', 'free plan setting'),
(4, 'vip (pending)', 'free plan setting'),
(5, 'vip', 'vip plan setting');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `advertising`
--
ALTER TABLE `advertising`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `emailsettings`
--
ALTER TABLE `emailsettings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lockedfiles`
--
ALTER TABLE `lockedfiles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reminders`
--
ALTER TABLE `password_reminders`
  ADD KEY `password_reminders_email_index` (`email`),
  ADD KEY `password_reminders_token_index` (`token`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `require_withdraw`
--
ALTER TABLE `require_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `test_cronjob`
--
ALTER TABLE `test_cronjob`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `themecustomize`
--
ALTER TABLE `themecustomize`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `uploadsettings`
--
ALTER TABLE `uploadsettings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `advertising`
--
ALTER TABLE `advertising`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `emailsettings`
--
ALTER TABLE `emailsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `lockedfiles`
--
ALTER TABLE `lockedfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `require_withdraw`
--
ALTER TABLE `require_withdraw`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `social`
--
ALTER TABLE `social`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `test_cronjob`
--
ALTER TABLE `test_cronjob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `themecustomize`
--
ALTER TABLE `themecustomize`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `uploadsettings`
--
ALTER TABLE `uploadsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT cho bảng `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
