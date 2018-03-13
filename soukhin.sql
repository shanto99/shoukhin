-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 05:43 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soukhin`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, NULL, NULL, 'Pets'),
(2, NULL, NULL, 'Plants');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `created_at`, `updated_at`, `body`, `post_id`, `user_id`) VALUES
(1, '2017-11-08 06:50:03', '2017-11-08 06:50:03', 'khgg', 1, 5),
(2, '2017-11-08 06:50:17', '2017-11-08 06:50:17', 'jhgg', 2, 5),
(7, '2017-11-08 07:48:40', '2017-11-08 07:48:40', 'last', 1, 5),
(9, '2017-11-08 08:00:15', '2017-11-08 08:00:15', 'hello shanto', 2, 5),
(10, '2017-11-09 00:16:05', '2017-11-09 00:16:05', 'fgf', 1, 5),
(11, '2017-12-19 03:31:55', '2017-12-19 03:31:55', 'jt7j7ujyh', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `start_price` int(11) NOT NULL,
  `commit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `created_at`, `updated_at`, `comment_id`, `user_id`) VALUES
(1, '2017-12-18 01:09:19', '2017-12-18 01:09:19', 7, 5),
(2, '2017-12-19 03:30:24', '2017-12-19 03:30:24', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `FAQ_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gen_categories`
--

CREATE TABLE `gen_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gen_categories`
--

INSERT INTO `gen_categories` (`id`, `created_at`, `updated_at`, `name`, `category_id`) VALUES
(1, NULL, NULL, 'Cat', 1),
(2, NULL, NULL, 'Dog', 1),
(3, NULL, NULL, 'Aloe Vera', 2);

-- --------------------------------------------------------

--
-- Table structure for table `grabed_users`
--

CREATE TABLE `grabed_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grabed_users`
--

INSERT INTO `grabed_users` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `price`, `quantity`) VALUES
(1, '2017-12-16 12:12:39', '2017-12-16 12:12:39', 5, 1, 250, 1),
(2, NULL, NULL, 5, 1, 250, 9),
(3, NULL, NULL, 5, 1, 250, 1),
(4, '2017-12-18 05:06:31', '2017-12-18 05:06:31', 5, 1, 250, 1),
(5, NULL, NULL, 5, 1, 250, 9),
(6, NULL, NULL, 5, 1, 250, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grabs`
--

CREATE TABLE `grabs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `p_id` int(11) NOT NULL,
  `ft_qty` int(11) NOT NULL,
  `ft_price` int(11) NOT NULL,
  `st_qty` int(11) NOT NULL,
  `st_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grabs`
--

INSERT INTO `grabs` (`id`, `created_at`, `updated_at`, `p_id`, `ft_qty`, `ft_price`, `st_qty`, `st_price`) VALUES
(12, '2017-12-16 07:23:05', '2017-12-16 07:23:05', 1, 10, 250, 20, 200),
(13, '2017-12-16 08:04:52', '2017-12-16 08:04:52', 2, 10, 250, 20, 200);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image`, `product_id`, `updated_at`, `created_at`) VALUES
(5, '8521493704817.jpg', 14, '2017-05-01 18:00:17', '2017-05-02 06:00:17'),
(6, '5831493704907.jpg', 15, '2017-05-01 18:01:47', '2017-05-02 06:01:47'),
(8, '50841493705280.jpg', 15, NULL, NULL),
(11, '52981493873803.jpg', 17, NULL, NULL),
(12, '29621493873803.jpg', 17, NULL, NULL),
(13, '70391493887533.png', 18, NULL, NULL),
(14, '/product_image/35211513605654.jpg', 4, NULL, NULL),
(15, '/product_image/64471513605654.jpg', 4, NULL, NULL),
(16, '/product_image/79821513605944.jpg', 7, NULL, NULL),
(17, '/product_image/57471513606071.jpg', 8, NULL, NULL),
(18, '/product_image/27471513606071.jpg', 8, NULL, NULL),
(19, '/product_image/22921513675679.jpg', 9, NULL, NULL),
(20, '/product_image/75971513675679.jpg', 9, NULL, NULL),
(21, '/product_image/94301513682944.jpg', 10, NULL, NULL),
(22, '/product_image/67631513691948.jpg', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `joined`
--

CREATE TABLE `joined` (
  `join_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `like_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `is_like` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('2017_05_03_061515_create_orders_table', 1),
('2017_11_05_182333_create_records_table', 2),
('2017_11_06_180733_create_posts_table', 3),
('2017_11_07_034016_create_comments_table', 4),
('2017_11_09_032316_create_likes_table', 5),
('2017_11_28_163206_create_dislikes_table', 6),
('2017_12_06_054534_create_subscribes_table', 6),
('2017_12_14_083740_create_grabs_table', 7),
('2017_12_14_124436_create_usergrabs_table', 8),
('2017_12_16_174014_create_grabed_users_table', 9),
('2017_12_17_101801_create_categories_table', 10),
('2017_12_17_101912_create_gen_categories_table', 10),
('2017_12_17_101931_create_sub_categories_table', 10),
('2017_12_17_145930_create_offers_table', 11),
('2017_12_18_030903_create_ratings_table', 12),
('2017_12_18_030935_create_reviews_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `start_at` date NOT NULL,
  `ends_at` date NOT NULL,
  `regular_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `created_at`, `updated_at`, `product_id`, `start_at`, `ends_at`, `regular_price`) VALUES
(1, '2017-12-17 22:05:41', '2017-12-17 22:05:41', 3, '2017-12-18', '2017-12-20', 800),
(2, '2017-12-19 10:29:54', '2017-12-19 10:29:54', 4, '2017-12-19', '2017-12-22', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `sell_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `cart` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `user_id`, `cart`, `address`, `name`, `payment_id`) VALUES
(1, '2017-12-17 12:38:49', '2017-12-17 12:38:49', 5, 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:2:{i:1;a:4:{s:3:\"qty\";i:1;s:5:\"price\";d:300;s:4:\"item\";O:11:\"App\\Product\":24:{s:8:\"\0*\0table\";s:7:\"product\";s:13:\"\0*\0connection\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:10:\"\0*\0perPage\";i:15;s:12:\"incrementing\";b:1;s:10:\"timestamps\";b:1;s:13:\"\0*\0attributes\";a:17:{s:10:\"product_id\";i:1;s:7:\"user_id\";i:5;s:5:\"title\";s:3:\"cat\";s:11:\"description\";s:51:\"this is a cat. This image is downloaded from google\";s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";s:5:\"video\";N;s:5:\"price\";d:300;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.461643599999999;s:3:\"lan\";d:91.1774202;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 06:33:50\";s:10:\"created_at\";s:19:\"2017-12-14 06:33:50\";}s:11:\"\0*\0original\";a:17:{s:10:\"product_id\";i:1;s:7:\"user_id\";i:5;s:5:\"title\";s:3:\"cat\";s:11:\"description\";s:51:\"this is a cat. This image is downloaded from google\";s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";s:5:\"video\";N;s:5:\"price\";d:300;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.461643599999999;s:3:\"lan\";d:91.1774202;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 06:33:50\";s:10:\"created_at\";s:19:\"2017-12-14 06:33:50\";}s:12:\"\0*\0relations\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0appends\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:8:\"\0*\0casts\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:7:\"\0*\0with\";a:0:{}s:13:\"\0*\0morphClass\";N;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;}s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";}i:2;a:4:{s:3:\"qty\";i:1;s:5:\"price\";d:500;s:4:\"item\";O:11:\"App\\Product\":24:{s:8:\"\0*\0table\";s:7:\"product\";s:13:\"\0*\0connection\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:10:\"\0*\0perPage\";i:15;s:12:\"incrementing\";b:1;s:10:\"timestamps\";b:1;s:13:\"\0*\0attributes\";a:17:{s:10:\"product_id\";i:2;s:7:\"user_id\";i:5;s:5:\"title\";s:11:\"another cat\";s:11:\"description\";s:35:\"this is another cat from google ...\";s:5:\"image\";s:33:\"/product_image/86101513254111.jpg\";s:5:\"video\";N;s:5:\"price\";d:500;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:2;s:3:\"lat\";d:23.810331999999999;s:3:\"lan\";d:90.4125181;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 12:21:51\";s:10:\"created_at\";s:19:\"2017-12-14 12:21:51\";}s:11:\"\0*\0original\";a:17:{s:10:\"product_id\";i:2;s:7:\"user_id\";i:5;s:5:\"title\";s:11:\"another cat\";s:11:\"description\";s:35:\"this is another cat from google ...\";s:5:\"image\";s:33:\"/product_image/86101513254111.jpg\";s:5:\"video\";N;s:5:\"price\";d:500;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:2;s:3:\"lat\";d:23.810331999999999;s:3:\"lan\";d:90.4125181;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 12:21:51\";s:10:\"created_at\";s:19:\"2017-12-14 12:21:51\";}s:12:\"\0*\0relations\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0appends\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:8:\"\0*\0casts\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:7:\"\0*\0with\";a:0:{}s:13:\"\0*\0morphClass\";N;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;}s:5:\"image\";s:33:\"/product_image/86101513254111.jpg\";}}s:8:\"quantity\";i:2;s:10:\"totalPrice\";d:800;}', 'comilla', 'shanto', 'ch_1Ba72NI1HQtvpX2ylNQLsAq2'),
(2, '2017-12-18 05:05:45', '2017-12-18 05:05:45', 5, 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:1;a:4:{s:3:\"qty\";i:1;s:5:\"price\";d:300;s:4:\"item\";O:11:\"App\\Product\":24:{s:8:\"\0*\0table\";s:7:\"product\";s:13:\"\0*\0connection\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:10:\"\0*\0perPage\";i:15;s:12:\"incrementing\";b:1;s:10:\"timestamps\";b:1;s:13:\"\0*\0attributes\";a:17:{s:10:\"product_id\";i:1;s:7:\"user_id\";i:5;s:5:\"title\";s:3:\"cat\";s:11:\"description\";s:51:\"this is a cat. This image is downloaded from google\";s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";s:5:\"video\";N;s:5:\"price\";d:300;s:8:\"quantity\";i:4;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.461643599999999;s:3:\"lan\";d:91.1774202;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 06:33:50\";s:10:\"created_at\";s:19:\"2017-12-14 06:33:50\";}s:11:\"\0*\0original\";a:17:{s:10:\"product_id\";i:1;s:7:\"user_id\";i:5;s:5:\"title\";s:3:\"cat\";s:11:\"description\";s:51:\"this is a cat. This image is downloaded from google\";s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";s:5:\"video\";N;s:5:\"price\";d:300;s:8:\"quantity\";i:4;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:1;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.461643599999999;s:3:\"lan\";d:91.1774202;s:5:\"offer\";i:1;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-14 06:33:50\";s:10:\"created_at\";s:19:\"2017-12-14 06:33:50\";}s:12:\"\0*\0relations\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0appends\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:8:\"\0*\0casts\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:7:\"\0*\0with\";a:0:{}s:13:\"\0*\0morphClass\";N;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;}s:5:\"image\";s:33:\"/product_image/17591513233230.jpg\";}}s:8:\"quantity\";i:1;s:10:\"totalPrice\";d:300;}', 'comilla', 'shanto', 'ch_1BaMRSI1HQtvpX2yB06D0UOm'),
(3, '2017-12-18 09:30:26', '2017-12-18 09:30:26', 7, 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:5;a:4:{s:3:\"qty\";i:1;s:5:\"price\";d:6000;s:4:\"item\";O:11:\"App\\Product\":24:{s:8:\"\0*\0table\";s:7:\"product\";s:13:\"\0*\0connection\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:10:\"\0*\0perPage\";i:15;s:12:\"incrementing\";b:1;s:10:\"timestamps\";b:1;s:13:\"\0*\0attributes\";a:17:{s:10:\"product_id\";i:5;s:7:\"user_id\";i:7;s:5:\"title\";s:20:\"Original Persian cat\";s:11:\"description\";s:34:\"r yrtye rtyertye yerty erty ertyer\";s:5:\"image\";s:33:\"/product_image/17541513605691.jpg\";s:5:\"video\";N;s:5:\"price\";d:6000;s:8:\"quantity\";i:5;s:13:\"main_category\";i:0;s:16:\"generic_category\";i:0;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.756814199999997;s:3:\"lan\";d:90.3969568;s:5:\"offer\";i:0;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-18 14:01:31\";s:10:\"created_at\";s:19:\"2017-12-18 14:01:31\";}s:11:\"\0*\0original\";a:17:{s:10:\"product_id\";i:5;s:7:\"user_id\";i:7;s:5:\"title\";s:20:\"Original Persian cat\";s:11:\"description\";s:34:\"r yrtye rtyertye yerty erty ertyer\";s:5:\"image\";s:33:\"/product_image/17541513605691.jpg\";s:5:\"video\";N;s:5:\"price\";d:6000;s:8:\"quantity\";i:5;s:13:\"main_category\";i:0;s:16:\"generic_category\";i:0;s:14:\"subcatagory_id\";i:1;s:3:\"lat\";d:23.756814199999997;s:3:\"lan\";d:90.3969568;s:5:\"offer\";i:0;s:8:\"discount\";i:0;s:10:\"updated_at\";s:19:\"2017-12-18 14:01:31\";s:10:\"created_at\";s:19:\"2017-12-18 14:01:31\";}s:12:\"\0*\0relations\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0appends\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:8:\"\0*\0casts\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:7:\"\0*\0with\";a:0:{}s:13:\"\0*\0morphClass\";N;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;}s:5:\"image\";s:33:\"/product_image/17541513605691.jpg\";}}s:8:\"quantity\";i:1;s:10:\"totalPrice\";d:6000;}', 'Comilla', 'SHANTO', 'ch_1BaQaOI1HQtvpX2yqxSLLuLL'),
(4, '2017-12-19 10:41:54', '2017-12-19 10:41:54', 7, 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:3;a:4:{s:3:\"qty\";i:2;s:5:\"price\";d:1120;s:4:\"item\";O:11:\"App\\Product\":24:{s:8:\"\0*\0table\";s:7:\"product\";s:13:\"\0*\0connection\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:10:\"\0*\0perPage\";i:15;s:12:\"incrementing\";b:1;s:10:\"timestamps\";b:1;s:13:\"\0*\0attributes\";a:17:{s:10:\"product_id\";i:3;s:7:\"user_id\";i:5;s:5:\"title\";s:8:\"Third Ad\";s:11:\"description\";s:34:\"This is a doG but looks like a cat\";s:5:\"image\";s:33:\"/product_image/28291513502370.jpg\";s:5:\"video\";N;s:5:\"price\";d:560;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:2;s:14:\"subcatagory_id\";i:2;s:3:\"lat\";d:23.7703317;s:3:\"lan\";d:90.3959557;s:5:\"offer\";i:0;s:8:\"discount\";i:1;s:10:\"updated_at\";s:19:\"2017-12-18 04:05:41\";s:10:\"created_at\";s:19:\"2017-12-17 09:19:30\";}s:11:\"\0*\0original\";a:17:{s:10:\"product_id\";i:3;s:7:\"user_id\";i:5;s:5:\"title\";s:8:\"Third Ad\";s:11:\"description\";s:34:\"This is a doG but looks like a cat\";s:5:\"image\";s:33:\"/product_image/28291513502370.jpg\";s:5:\"video\";N;s:5:\"price\";d:560;s:8:\"quantity\";i:5;s:13:\"main_category\";i:1;s:16:\"generic_category\";i:2;s:14:\"subcatagory_id\";i:2;s:3:\"lat\";d:23.7703317;s:3:\"lan\";d:90.3959557;s:5:\"offer\";i:0;s:8:\"discount\";i:1;s:10:\"updated_at\";s:19:\"2017-12-18 04:05:41\";s:10:\"created_at\";s:19:\"2017-12-17 09:19:30\";}s:12:\"\0*\0relations\";a:0:{}s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0appends\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:8:\"\0*\0casts\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:7:\"\0*\0with\";a:0:{}s:13:\"\0*\0morphClass\";N;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;}s:5:\"image\";s:33:\"/product_image/28291513502370.jpg\";}}s:8:\"quantity\";i:2;s:10:\"totalPrice\";d:1120;}', 'jadgaf', 'SHANTO', 'ch_1BaoB6I1HQtvpX2ytZSDAI7t');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `card_name` varchar(30) NOT NULL,
  `card_number` varchar(30) NOT NULL,
  `expiry_date` date NOT NULL,
  `security_code` int(8) NOT NULL,
  `join_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `body`, `user_id`) VALUES
(1, '2017-11-06 12:43:41', '2017-11-06 12:43:41', 'This is first Post', 6),
(2, '2017-11-06 21:28:46', '2017-11-06 21:28:46', 'This is second Post', 5),
(3, '2017-12-19 03:31:41', '2017-12-19 03:31:41', 'mjunjyfjny  r7tu7b yu', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `main_category` int(11) NOT NULL,
  `generic_category` int(11) NOT NULL,
  `subcatagory_id` int(11) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lan` double DEFAULT NULL,
  `offer` int(11) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `user_id`, `title`, `description`, `image`, `video`, `price`, `quantity`, `main_category`, `generic_category`, `subcatagory_id`, `lat`, `lan`, `offer`, `discount`, `updated_at`, `created_at`) VALUES
(1, 5, 'cat', 'this is a cat. This image is downloaded from google', '/product_image/17591513233230.jpg', NULL, 300, 3, 1, 1, 1, 23.4616436, 91.1774202, 1, 0, '2017-12-14 00:33:50', '2017-12-14 00:33:50'),
(2, 5, 'another cat', 'this is another cat from google ...', '/product_image/86101513254111.jpg', NULL, 500, 4, 1, 1, 2, 23.810332, 90.4125181, 1, 0, '2017-12-14 06:21:51', '2017-12-14 06:21:51'),
(3, 5, 'Third Ad', 'This is a doG but looks like a cat', '/product_image/28291513502370.jpg', NULL, 560, 3, 1, 2, 2, 23.7703317, 90.3959557, 0, 1, '2017-12-17 22:05:41', '2017-12-17 03:19:30'),
(4, 7, 'Original Persian cat', 'fluffy persian cat from peris ......... Now in Bangladesh', '/product_image/93761513605654.jpg', NULL, 4800, 5, 1, 1, 1, 23.756814199999997, 90.3969568, 0, 1, '2017-12-19 10:29:54', '2017-12-18 08:00:54'),
(5, 7, 'Original Persian cat', 'r yrtye rtyertye yerty erty ertyer', '/product_image/17541513605691.jpg', NULL, 6000, 4, 1, 2, 1, 23.756814199999997, 90.3969568, 0, 0, '2017-12-18 08:01:31', '2017-12-18 08:01:31'),
(6, 7, 'Original Persian cat', 'yuytu tyurty ertyerty ertyertyerty', '/product_image/78291513605753.jpg', NULL, 6000, 5, 2, 1, 1, 23.756814199999997, 90.3969568, 0, 0, '2017-12-18 08:02:33', '2017-12-18 08:02:33'),
(7, 7, 'boxer dog', 'rtwertwert retwretret wret retwret', '/product_image/78401513605944.jpg', NULL, 20000, 5, 1, 1, 2, 23.756814199999997, 90.3969568, 0, 0, '2017-12-18 08:05:44', '2017-12-18 08:05:44'),
(8, 7, 'chuawa', 'tyurtyu tyurtyue tyurtyurty tyuryturt', '/product_image/43391513606071.jpg', NULL, 40000, 5, 1, 2, 2, 23.756814199999997, 90.3969568, 0, 0, '2017-12-18 08:07:51', '2017-12-18 08:07:51'),
(9, 7, 'Boxer', 'Boxer dogs, tough and cute.', '/product_image/44181513675679.jpg', NULL, 20000, 3, 1, 1, 3, 23.7568143, 90.39692, 0, 0, '2017-12-19 03:27:59', '2017-12-19 03:27:59'),
(10, 7, 'Thai cat', 'gdfs sdfgsdfg sdgsdgsd fdsgssgfs', '/product_image/89151513682944.jpg', NULL, 40000, 5, 1, 1, 2, 23.7568153, 90.3964968, 0, 0, '2017-12-19 05:29:04', '2017-12-19 05:29:04'),
(11, 7, 'Bull dog', 'rt rtyerty ertyertyertr truryt tr', '/product_image/79881513691948.jpg', NULL, 6000, 5, 1, 2, 3, 23.7568143, 90.39692, 0, 0, '2017-12-19 07:59:08', '2017-12-19 07:59:08'),
(12, 7, 'German shepard', 'sdsg hdfhdfgh rtyetr rtyrtyrth', '/product_image/52891513692055.jpg', NULL, 50000, 5, 1, 2, 3, 23.7568143, 90.39692, 0, 0, '2017-12-19 08:00:55', '2017-12-19 08:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `rate`) VALUES
(6, '2017-12-18 03:42:33', '2017-12-18 04:59:25', 5, 1, 2),
(7, '2017-12-18 03:43:02', '2017-12-18 03:43:02', 5, 2, 2),
(9, '2017-12-18 03:46:50', '2017-12-18 03:50:26', 5, 3, 3),
(10, '2017-12-18 09:40:55', '2017-12-18 10:55:50', 7, 4, 3),
(11, '2017-12-19 03:29:36', '2017-12-19 08:43:10', 7, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `created_at`, `updated_at`, `product_id`, `quantity`) VALUES
(4, '2017-11-06 07:22:05', '2017-11-06 07:22:05', 1, 10),
(5, '2017-11-03 07:22:05', '2017-11-06 07:22:05', 1, 6),
(6, '2017-11-05 07:45:34', '2017-11-06 07:45:34', 1, 3),
(7, '2017-11-04 07:45:35', '2017-11-06 07:45:35', 1, 1),
(8, '2017-12-17 12:38:50', '2017-12-17 12:38:50', 1, 1),
(9, '2017-12-17 12:38:50', '2017-12-17 12:38:50', 2, 1),
(10, '2017-12-18 05:05:45', '2017-12-18 05:05:45', 1, 1),
(11, '2017-12-18 09:30:26', '2017-12-18 09:30:26', 5, 1),
(12, '2017-12-19 10:41:54', '2017-12-19 10:41:54', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `FAQ_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requested_item`
--

CREATE TABLE `requested_item` (
  `requested_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `created_at`, `updated_at`, `user_id`, `product`) VALUES
(1, '2017-12-07 05:02:18', '2017-12-07 05:02:18', 7, 'persian cat'),
(2, '2017-12-19 04:32:53', '2017-12-19 04:32:53', 7, 'boxer'),
(3, '2017-12-19 06:33:01', '2017-12-19 06:33:01', 7, 'parsian');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `gen_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `created_at`, `updated_at`, `name`, `gen_category_id`) VALUES
(1, NULL, NULL, 'persian cat', 1),
(2, NULL, NULL, 'other', 1),
(3, NULL, NULL, 'Boxer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usergrabs`
--

CREATE TABLE `usergrabs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `grab_id` int(11) DEFAULT NULL,
  `dealing_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usergrabs`
--

INSERT INTO `usergrabs` (`id`, `created_at`, `updated_at`, `user_id`, `p_id`, `quantity`, `grab_id`, `dealing_amount`) VALUES
(4, '2017-12-16 07:28:45', '2017-12-16 07:28:45', 5, 1, 9, 12, 250),
(17, '2017-12-16 23:46:41', '2017-12-16 23:46:41', 5, 1, 1, 12, 250),
(18, '2017-12-18 05:08:08', '2017-12-18 05:08:08', 5, 1, 1, 12, 200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_pro` int(11) NOT NULL DEFAULT '0',
  `is_verified` int(11) DEFAULT '0',
  `accessToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `image`, `email`, `password`, `is_pro`, `is_verified`, `accessToken`, `remember_token`, `verification_code`, `address`, `contact_no`, `created_at`, `updated_at`) VALUES
(5, 1353353624746528, 'shanto', '1513689420.jpg', 'shantoshepon@yahoo.com', NULL, 0, 1, NULL, 'laKoq20BMOMTdkCI6DTybML7bBAF9Mrm7x8XLYUjAzfgynuUEG0CWLtVkQ3U', NULL, 'Comilla', '01914445832', '2017-05-13 21:54:03', '2017-12-19 07:35:31'),
(6, 0, 'shuvo', '1513691222.jpg', 'shuvo@shanto.com', '$2y$10$hKv.fI3E.7kf/Bz71QXfhOjREwtMQirVTaSrKzj.95Rw951rbbHoG', 0, 0, NULL, 'hsTxpphoRx5sRdbbayk9k9xp8CjilDIKW9jqIgqtWppXRvL9BaYjvefYOS2I', 73, '', '', '2017-11-05 12:17:47', '2017-12-19 07:52:24'),
(7, NULL, 'Touhidul Islam', '1513674550.jpg', 'islamakmtouhidul@gmail.com', '$2y$10$hKv.fI3E.7kf/Bz71QXfhOjREwtMQirVTaSrKzj.95Rw951rbbHoG', 0, 1, NULL, 'we5t0bcsPw7KRpd5eZrnOjFJqs4x4Kt83jABJfN5OI1NwJ3dk1Xsjbvgsaed', 26, 'Comilla', '0191444583', '2017-12-07 05:00:23', '2017-12-19 10:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`category_id`, `user_id`) VALUES
(1, 3),
(1, 5),
(1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`deal_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`FAQ_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gen_categories`
--
ALTER TABLE `gen_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grabed_users`
--
ALTER TABLE `grabed_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grabs`
--
ALTER TABLE `grabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`);

--
-- Indexes for table `joined`
--
ALTER TABLE `joined`
  ADD PRIMARY KEY (`join_id`),
  ADD KEY `drop_id` (`deal_id`),
  ADD KEY `deal_id` (`deal_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `reply_id` (`reply_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `join_id` (`join_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subcatagory_id` (`subcatagory_id`),
  ADD KEY `subcatagory_id_2` (`subcatagory_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `FAQ_id` (`FAQ_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `requested_item`
--
ALTER TABLE `requested_item`
  ADD PRIMARY KEY (`requested_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usergrabs`
--
ALTER TABLE `usergrabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_facebook_id_unique` (`facebook_id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `FAQ_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gen_categories`
--
ALTER TABLE `gen_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grabed_users`
--
ALTER TABLE `grabed_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `grabs`
--
ALTER TABLE `grabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `joined`
--
ALTER TABLE `joined`
  MODIFY `join_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `requested_item`
--
ALTER TABLE `requested_item`
  MODIFY `requested_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usergrabs`
--
ALTER TABLE `usergrabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `deal_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
