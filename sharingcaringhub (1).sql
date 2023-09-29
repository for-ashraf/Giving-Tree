-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2023 at 07:43 PM
-- Server version: 8.0.27
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharingcaringhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `theme` varchar(50) DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','completed','deactivated') DEFAULT 'active',
  `views_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `category_description`, `category_image`, `parent_category_id`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', NULL, '1.jpg', NULL, '2023-09-28 01:41:56', '2023-09-29 14:42:53'),
(3, 'data', 'my data', '3.jpg', 1, '2023-09-29 13:18:53', '2023-09-29 14:31:41'),
(5, 'adf', 'adf', '5.jpg', 1, '2023-09-29 13:37:35', '2023-09-29 14:30:43'),
(6, 'asdf', 'sadf', '6.png', 1, '2023-09-29 14:32:24', '2023-09-29 14:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `donation_id` int DEFAULT NULL,
  `campaign_id` int DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `donation_id` (`donation_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` bigint UNSIGNED DEFAULT NULL,
  `recipient_id` bigint UNSIGNED DEFAULT NULL,
  `donation_id` int DEFAULT NULL,
  `campaign_id` int DEFAULT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `donation_id` (`donation_id`),
  KEY `campaign_id` (`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `item_condition` varchar(50) DEFAULT NULL,
  `item_category` varchar(50) DEFAULT NULL,
  `sub_category` varchar(50) DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `likes_count` int DEFAULT '0',
  `status` enum('active','completed','deactivated') DEFAULT 'active',
  `views_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_category_id` bigint UNSIGNED DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_category_id` (`item_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_05_16_192727_create_categories_table', 1),
(4, '2020_05_18_195452_create_posts_table', 1),
(5, '2023_01_19_090309_create_tags_table', 1),
(6, '2023_01_19_091914_create_comments_table', 1),
(7, '2023_01_19_092403_create_post_tag_table', 1),
(8, '2023_01_24_102922_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(2, 'user_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(3, 'user_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(4, 'user_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(5, 'role_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(6, 'role_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(7, 'role_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(8, 'role_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(9, 'permission_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(10, 'permission_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(11, 'permission_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(12, 'permission_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(13, 'post_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(14, 'post_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(15, 'post_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(16, 'post_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(17, 'category_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(18, 'category_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(19, 'category_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(20, 'category_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(21, 'tag_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(22, 'tag_create', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(23, 'tag_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(24, 'tag_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(25, 'comment_access', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(26, 'comment_edit', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55'),
(27, 'comment_delete', 'web', '2023-09-28 01:41:55', '2023-09-28 01:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `read_count` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category_id`, `body`, `thumbnail`, `created_by`, `is_published`, `read_count`, `created_at`, `updated_at`) VALUES
(1, 'Quo libero fugit ut laudantium.', 1, 'Tempore sit sunt laboriosam ad repudiandae atque. Et et voluptas voluptas eum deleniti optio. Et placeat enim et rerum.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(2, 'Perferendis error itaque quis et officiis soluta nemo.', 1, 'Corrupti animi autem illum. Non amet magni et voluptatem ad. Accusantium aspernatur odio mollitia molestiae. Maiores placeat adipisci voluptatibus ut.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(3, 'Deleniti rerum necessitatibus ut earum est magnam fuga.', 1, 'Enim omnis in voluptas est. Accusamus soluta quis doloremque totam consectetur fuga. Nulla impedit ducimus et repellendus excepturi eaque aperiam.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(4, 'Neque voluptatem dicta sunt voluptas a adipisci.', 1, 'Qui assumenda sunt magni consectetur. Molestiae quaerat porro iure vel beatae repellendus officiis. Corporis nisi nihil dolore sequi minima sed soluta nihil.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(5, 'Et aut itaque doloremque veritatis.', 1, 'Unde fuga commodi alias aut. Et porro eius ut perspiciatis sequi quia. Officiis impedit ex necessitatibus nostrum sunt vel sed.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(6, 'Suscipit omnis perferendis quaerat eum et error.', 1, 'Dolor qui nam consequatur autem. Fugiat nostrum qui aspernatur ipsum debitis. Laboriosam omnis non unde quod. Dolore eum molestiae reprehenderit.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(7, 'Labore eius qui ut delectus quos suscipit accusantium.', 1, 'Nihil quia est dolore provident cumque. Ullam voluptatem corporis expedita quo eum aut. Quibusdam neque distinctio quod et et et ipsam. Voluptatem nemo temporibus et nihil magnam.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(8, 'Ducimus sunt minima voluptatem dolorem dolores.', 1, 'Deleniti autem id distinctio eius repudiandae iste. Dolorem natus placeat eligendi. Qui dolorem in pariatur ipsa necessitatibus. Ipsam deleniti et et saepe dolores.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(9, 'Est sapiente asperiores dicta.', 1, 'Voluptatem rerum inventore natus non. Nobis reiciendis autem ut harum. Omnis quaerat at odit rerum explicabo.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(10, 'Accusamus sequi et libero reiciendis eligendi accusantium sunt.', 1, 'Deleniti voluptatem temporibus consequatur possimus dolorem ab. Molestiae ut et a laudantium. Porro explicabo voluptas minus.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(11, 'Maxime eligendi rerum molestias quis unde.', 1, 'Voluptas iure maiores dolores totam perspiciatis et est est. Molestiae doloribus dolor quas repudiandae eius. Fuga vel reprehenderit dolores quibusdam quae. Vero eos sit cupiditate porro.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(12, 'Corrupti dolorum illum rem quos consectetur.', 1, 'Sit fugiat ut quo sit voluptatem dolorem nisi. Quia soluta unde officiis impedit. Provident id ex aut error autem commodi et.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(13, 'Aliquam quibusdam omnis eligendi pariatur reiciendis.', 1, 'Voluptas et aut qui qui quisquam facere. Repellendus ut reprehenderit vel autem. Dolore a est cumque quod aperiam eos nostrum. Omnis deleniti sed itaque laboriosam error aliquam. Neque sint ab voluptatibus recusandae sint nulla dicta.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(14, 'Eos hic est aliquam ipsum et.', 1, 'Explicabo iusto consequatur odio excepturi atque placeat. Eum et libero quam voluptatem enim. Placeat voluptas minus dicta cupiditate.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(15, 'Veritatis repellat minus illum sunt nihil.', 1, 'Quia laudantium dolorem reprehenderit totam sint veritatis quos. Praesentium sapiente eos rem et. Voluptatem dolor facilis eligendi dolorem alias molestiae. Et nemo sint autem distinctio nulla quam tempora laborum.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(16, 'Ex esse recusandae dolores aut et dicta.', 1, 'Omnis ullam delectus est dolorem. Porro qui dolores nostrum. Est cupiditate quo assumenda provident. Neque ab cum soluta id. Nesciunt esse pariatur voluptates.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(17, 'Eos dignissimos aut unde.', 1, 'Porro earum vel sint rerum accusamus. Sint quo alias tenetur temporibus tempore. Reiciendis consequatur facere aut reiciendis itaque architecto quia fugit. Non nesciunt commodi qui ut cum possimus tempore.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(18, 'Nisi delectus accusamus accusamus autem.', 1, 'Qui officia consequatur ex deleniti nisi voluptatibus commodi veniam. Quis ut optio dolorem et omnis nemo. Saepe veniam commodi et earum harum molestiae quaerat. At praesentium consequatur magni excepturi.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(19, 'Nam modi aut veniam dolor sit necessitatibus et.', 1, 'Nobis voluptatem fuga velit a voluptatibus. Provident est minus tenetur itaque provident. Molestiae soluta modi accusamus doloremque.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(20, 'Esse eum cum incidunt sit fuga vero dicta.', 1, 'In omnis quos inventore vitae. Velit officiis cum officiis quo ut autem consequatur. Optio architecto adipisci hic sunt doloribus. Doloribus natus dolore laboriosam laudantium eos quae.', NULL, 1, 1, 0, '2023-09-28 01:41:56', '2023-09-28 01:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(2, 'Author', 'web', '2023-09-28 01:41:56', '2023-09-28 01:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Admin', 'admin@demo.com', NULL, '$2y$10$11Xo8oVLJ92aWqNl/i1Fj.c//2pPIoMRX/eBNj7/TFkLUZKQ2x9ce', 1, NULL, '2023-09-28 01:41:56', '2023-09-28 01:41:56'),
(2, 'Muhammad Ashraf', 'forashraf@gmail.com', NULL, '$2y$10$11Xo8oVLJ92aWqNl/i1Fj.c//2pPIoMRX/eBNj7/TFkLUZKQ2x9ce', 1, NULL, '2023-09-28 01:42:58', '2023-09-28 01:42:58');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `conversations_ibfk_3` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`),
  ADD CONSTRAINT `conversations_ibfk_4` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
