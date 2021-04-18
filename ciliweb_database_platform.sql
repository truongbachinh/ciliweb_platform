-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 03:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciliweb_database_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(20) NOT NULL,
  `cart_user_id` int(20) NOT NULL,
  `cart_product_id` int(20) NOT NULL,
  `cart_quantity` int(20) NOT NULL,
  `cart_create_time` int(11) NOT NULL,
  `cart_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_quantity`, `cart_create_time`, `cart_update_time`) VALUES
(190, 17, 22, 1, 1618512509, 0),
(191, 2, 9, 2, 1618512970, 1618512982),
(192, 1, 19, 3, 1618537942, 1618543767),
(193, 1, 23, 2, 1618538014, 1618539281),
(194, 1, 11, 1, 1618538963, 0),
(195, 1, 9, 2, 1618539133, 1618539189),
(196, 1, 10, 1, 1618539322, 0),
(197, 1, 22, 1, 1618539326, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ctg_name` varchar(48) NOT NULL,
  `ctg_image` varchar(128) NOT NULL,
  `ctg_description` varchar(128) NOT NULL,
  `ctg_status` int(11) NOT NULL,
  `ctg_id` int(20) NOT NULL,
  `ctg_create_time` int(11) NOT NULL,
  `ctg_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ctg_name`, `ctg_image`, `ctg_description`, `ctg_status`, `ctg_id`, `ctg_create_time`, `ctg_update_time`) VALUES
('Cá', '8c9655c85d8a5c550826878048215358hai-san-bien-dong-vinhomes-riverside-the-harmony-long-bien-1-normal-797469437189.jpg', 'Cá ăn ngon lắm ', 1, 245, 1616951051, 0),
('Cua', '1b8f34d694d45a17992f7d37ea01926ehai-san-bien-dong-vinhomes-riverside-the-harmony-long-bien-1-normal-797469437189.jpg', 'Cua ăn ngon lắm ', 1, 246, 1616951061, 0),
('Ghẹ', 'aa12b205cc4db85238db7753fe56b51a127_lau_hai_san - Copy.jpg', 'Ghẹ ngon', 1, 247, 1616951072, 0),
('Mực', 'da9e60b047b5c2ba1329a5fbd8dec703615c98fd8a8b1ec9e63bde518a58cceb144531148_200303688502170_6189451453374423095_n.png', 'Mực ', 1, 249, 1617589704, 0),
('Ốc', 'c4af74784522b8beb33dfbd7e9beed84615c98fd8a8b1ec9e63bde518a58cceb158384890_147610643901366_5275522211667288605_n.png', 'Ốc ngon', 1, 250, 1617589884, 0),
('Tôm', '2b986efb97fa8cc2f2ce0634c9f1e304144531148_200303688502170_6189451453374423095_n.png', 'Tôm', 1, 251, 1617589949, 0),
('Bề Bề', 'ef5a1f242e24fd9db876c1cb113564bc615c98fd8a8b1ec9e63bde518a58cceb158384890_147610643901366_5275522211667288605_n.png', 'Bề Bề ngon', 1, 252, 1617590035, 1617593488);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `msg_id` int(20) NOT NULL,
  `msg_incoming_id` int(20) NOT NULL,
  `msg_outcoming_id` int(20) NOT NULL,
  `msg_message` varchar(1000) NOT NULL,
  `msg_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`msg_id`, `msg_incoming_id`, `msg_outcoming_id`, `msg_message`, `msg_time`) VALUES
(7678, 4, 1, 'Linh oi', 1618546081),
(7679, 4, 2, 'Hello Liinh', 1618546541),
(7682, 1, 4, 'ad', 1618560449),
(7683, 1, 4, 'fasfasfa', 1618560457),
(7684, 1, 4, 'chinh oi', 1618560700),
(7685, 4, 1, 'Sao thế', 1618560704),
(7686, 4, 1, 'À thế à', 1618560708),
(7687, 1, 4, 'Đi thôi b ơi', 1618560713),
(7688, 1, 4, 'Đi đâu thế', 1618560799),
(7689, 4, 1, 'ĐI chơi đê', 1618560804),
(7690, 4, 1, 'adadad', 1618560919),
(7691, 4, 1, 'adadad', 1618560941),
(7692, 20, 1, 'Hello shop', 1618574654),
(7693, 20, 1, 'I want to buy this product', 1618574662),
(7694, 1, 20, 'what would you want to buy ?', 1618574841);

-- --------------------------------------------------------

--
-- Table structure for table `image_library`
--

CREATE TABLE `image_library` (
  `img_id` int(20) NOT NULL,
  `img_p_id` int(20) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `img_create_time` int(11) NOT NULL,
  `img_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_library`
--

INSERT INTO `image_library` (`img_id`, `img_p_id`, `img_name`, `img_create_time`, `img_update_time`) VALUES
(21, 8, '59a0e295aed8496c1bd5190c865577204A76F959-31D9-4C49-BADD-BDF58593C379.jpg', 1617002085, 0),
(22, 8, '59a0e295aed8496c1bd5190c8655772045C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 1617002085, 0),
(23, 9, '3ae22af35b330feca97f0de5f5bf4cc445C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 1617002113, 0),
(24, 10, '43f5b33cc3735845716482adf97c18811532419553506_7509459 - Copy.jpg', 1617002145, 0),
(25, 10, '43f5b33cc3735845716482adf97c1881hai-san-bien-dong-vinhomes-riverside-the-harmony-long-bien-1-normal-797469437189.jpg', 1617002145, 0),
(26, 11, '82f35db00196ea1c623c406ce2cd2bbc1532419553506_7509459 - Copy.jpg', 1617002179, 0),
(27, 11, '82f35db00196ea1c623c406ce2cd2bbcd57e79b367954eb8a9a562d3e3efc7f6.jpg', 1617002179, 0),
(42, 17, '61d7e829ed0b1572fa68fe562438534cIMG_1373.jpg', 1617124625, 0),
(43, 18, '6e0b9acadb1b210374de9d29138fada0127_lau_hai_san - Copy.jpg', 1617124704, 0),
(44, 18, '6e0b9acadb1b210374de9d29138fada0127_lau_hai_san.jpg', 1617124704, 0),
(45, 18, '6e0b9acadb1b210374de9d29138fada01532419553506_7509459 - Copy.jpg', 1617124704, 0),
(46, 19, '16153073948e0fbd9f519a2e8ca6ed72127_lau_hai_san.jpg', 1617124775, 0),
(47, 19, '16153073948e0fbd9f519a2e8ca6ed721532419553506_7509459 - Copy.jpg', 1617124775, 0),
(54, 22, '2d9bac9bc2c1004fdf6ba76febbbbd6a4A76F959-31D9-4C49-BADD-BDF58593C379.jpg', 1617524740, 0),
(55, 22, '2d9bac9bc2c1004fdf6ba76febbbbd6a45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 1617524740, 0),
(56, 22, '2d9bac9bc2c1004fdf6ba76febbbbd6a97485493_2490671654577425_8179314827781472256_n.png', 1617524740, 0),
(57, 23, 'a50e461696046b4ef4c4b9b3841706bd4A76F959-31D9-4C49-BADD-BDF58593C379.jpg', 1617524762, 0),
(58, 23, 'a50e461696046b4ef4c4b9b3841706bd45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 1617524762, 0),
(59, 23, 'a50e461696046b4ef4c4b9b3841706bd97485493_2490671654577425_8179314827781472256_n.png', 1617524762, 0),
(63, 27, 'eb80a9a2233bea9ce092c83e1e33345fkeyv_1384186736.jpg', 1617846702, 0),
(64, 27, 'eb80a9a2233bea9ce092c83e1e33345fkeyv_1384187490.jpg', 1617846702, 0),
(65, 27, 'eb80a9a2233bea9ce092c83e1e33345fkeyv_1384188076.jpg', 1617846702, 0),
(66, 28, '05d3d4c9e128c131d24451b68f3887a4keyv_1384186619.jpg', 1617846729, 0),
(67, 28, '05d3d4c9e128c131d24451b68f3887a4keyv_1384186745.jpg', 1617846729, 0),
(68, 28, '05d3d4c9e128c131d24451b68f3887a4keyv_1384186755.jpg', 1617846729, 0),
(69, 29, '5ffce9f8005392acb013610a269d09eekeyv_1384446255.jpg', 1617846752, 0),
(70, 29, '5ffce9f8005392acb013610a269d09eekeyv_1384586260.jpg', 1617846752, 0),
(71, 29, '5ffce9f8005392acb013610a269d09eekeyv_1384655223.jpg', 1617846752, 0),
(72, 30, '4e57d275aec00894b95abd1c6677dda4keyv_1384186962.jpg', 1617846803, 0),
(73, 30, '4e57d275aec00894b95abd1c6677dda4keyv_1384187490.jpg', 1617846803, 0),
(74, 30, '4e57d275aec00894b95abd1c6677dda4keyv_1384188076.jpg', 1617846803, 0),
(75, 31, 'e0124b847752b31ae7c5dd47f59640aakeyv_1384186962.jpg', 1617846827, 0),
(76, 31, 'e0124b847752b31ae7c5dd47f59640aakeyv_1384187490.jpg', 1617846827, 0),
(77, 31, 'e0124b847752b31ae7c5dd47f59640aakeyv_1384188076.jpg', 1617846827, 0),
(78, 32, '5ac1e467392f6243def6b04e5ac20277keyv_1384186962.jpg', 1617846864, 0),
(79, 32, '5ac1e467392f6243def6b04e5ac20277keyv_1384187490.jpg', 1617846864, 0),
(80, 32, '5ac1e467392f6243def6b04e5ac20277keyv_1384188076.jpg', 1617846864, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `order_user_id` int(20) NOT NULL,
  `order_shop_id` int(20) NOT NULL,
  `order_total_cost` decimal(20,0) NOT NULL,
  `order_total_amount` int(11) NOT NULL,
  `order_create_time` int(11) NOT NULL,
  `payment_order_status` int(11) NOT NULL,
  `shipping_order_status` int(11) NOT NULL,
  `shipping_create_time` int(11) NOT NULL,
  `shipping_receive_time` int(11) NOT NULL,
  `shipping_cancle_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_user_id`, `order_shop_id`, `order_total_cost`, `order_total_amount`, `order_create_time`, `payment_order_status`, `shipping_order_status`, `shipping_create_time`, `shipping_receive_time`, `shipping_cancle_time`) VALUES
(127, 1, 5, '4005600', 3, 1618134091, 1, 3, 1618137753, 1618137803, 0),
(128, 1, 8, '12000', 1, 1618134091, 1, 3, 1618138216, 1618153698, 1618138406),
(129, 1, 11, '230000', 1, 1618134091, 1, 3, 0, 1618157940, 0),
(130, 1, 5, '2005600', 3, 1618139326, 2, 3, 0, 0, 0),
(131, 1, 8, '12000', 1, 1618139326, 2, 3, 1618153977, 1618155245, 0),
(132, 1, 11, '230000', 1, 1618139326, 2, 3, 0, 0, 0),
(133, 1, 5, '2029000', 5, 1618155067, 1, 3, 0, 1618155848, 0),
(134, 1, 8, '10000', 1, 1618155067, 1, 3, 0, 1618155225, 0),
(135, 1, 5, '2029000', 5, 1618155133, 2, 3, 0, 1618155838, 0),
(136, 1, 8, '10000', 1, 1618155133, 2, 3, 0, 1618155261, 0),
(137, 2, 5, '4014600', 6, 1618156200, 1, 3, 0, 1618156274, 0),
(138, 2, 8, '22000', 2, 1618156200, 1, 3, 0, 1618156423, 0),
(139, 2, 11, '230000', 1, 1618156200, 1, 3, 0, 1618158012, 1618157951),
(140, 2, 5, '4009000', 6, 1618156239, 2, 3, 0, 1618156284, 0),
(141, 2, 8, '22000', 2, 1618156239, 2, 3, 0, 1618156434, 0),
(142, 2, 11, '230000', 1, 1618156239, 2, 1, 0, 0, 0),
(143, 1, 5, '21000', 2, 1618502903, 2, 1, 0, 0, 0),
(144, 1, 8, '10000', 1, 1618502903, 2, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `oda_id` int(20) NOT NULL,
  `oda_order_id` int(20) NOT NULL,
  `oda_firstname` varchar(50) NOT NULL,
  `oda_lastname` varchar(50) NOT NULL,
  `oda_address` varchar(120) NOT NULL,
  `oda_address_2` varchar(120) NOT NULL,
  `oda_phone` varchar(20) NOT NULL,
  `oda_email` varchar(120) NOT NULL,
  `oda_city` varchar(50) NOT NULL,
  `oda_district` varchar(50) NOT NULL,
  `oda_zip` int(11) NOT NULL,
  `oda_note` text NOT NULL,
  `oda_create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`oda_id`, `oda_order_id`, `oda_firstname`, `oda_lastname`, `oda_address`, `oda_address_2`, `oda_phone`, `oda_email`, `oda_city`, `oda_district`, `oda_zip`, `oda_note`, `oda_create_time`) VALUES
(110, 127, ' le', 'Linh', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618134091),
(111, 128, ' le', 'Linh', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618134091),
(112, 129, ' le', 'Linh', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618134091),
(113, 130, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '+10574758886', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618139326),
(114, 131, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '+10574758886', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618139326),
(115, 132, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '+10574758886', 'truongbachinh1998@gmail.com', 'Đắk Lắk', 'Huyện Krông Bông', 0, '', 1618139326),
(116, 133, ' tran', 'nam', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Bạc Liêu', 'Huyện Giá Rai', 0, 'ad', 1618155067),
(117, 134, ' tran', 'nam', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Bạc Liêu', 'Huyện Giá Rai', 0, 'ad', 1618155067),
(118, 135, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Bạc Liêu', 'Huyện Hồng Dân', 0, 'ad', 1618155133),
(119, 136, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Bạc Liêu', 'Huyện Hồng Dân', 0, 'ad', 1618155133),
(120, 137, ' le', 'loan', 'FPT UNIVERSITY, 41', '41', '0574758886', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, 'ad', 1618156200),
(121, 138, ' le', 'loan', 'FPT UNIVERSITY, 41', '41', '0574758886', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, 'ad', 1618156200),
(122, 139, ' le', 'loan', 'FPT UNIVERSITY, 41', '41', '0574758886', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, 'ad', 1618156200),
(123, 140, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, '', 1618156239),
(124, 141, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, '', 1618156239),
(125, 142, ' chinh', 'truong', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Bà Rịa - Vũng Tàu', 'Huyện Côn Đảo', 0, '', 1618156239),
(126, 143, ' chinh', 'truong', 'FPT UNIVERSITY', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Đà Nẵng', 'Quận Hải Châu', 0, 'ad', 1618502903),
(127, 144, ' chinh', 'truong', 'FPT UNIVERSITY', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Đà Nẵng', 'Quận Hải Châu', 0, 'ad', 1618502903);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `order_product_id` int(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `order_product_id`, `quantity`, `price`, `create_time`) VALUES
(281, 127, 10, 1, '5600', 1618134091),
(282, 127, 17, 2, '2000000', 1618134091),
(283, 128, 23, 1, '12000', 1618134091),
(284, 129, 27, 1, '230000', 1618134091),
(285, 130, 10, 1, '5600', 1618139326),
(286, 130, 17, 2, '2000000', 1618139326),
(287, 131, 23, 1, '12000', 1618139326),
(288, 132, 27, 1, '230000', 1618139326),
(289, 133, 8, 1, '1000', 1618155067),
(290, 133, 9, 1, '2400', 1618155067),
(291, 133, 10, 1, '5600', 1618155067),
(292, 133, 11, 1, '20000', 1618155067),
(293, 133, 19, 1, '2000000', 1618155067),
(294, 134, 22, 1, '10000', 1618155067),
(295, 135, 8, 1, '1000', 1618155133),
(296, 135, 9, 1, '2400', 1618155133),
(297, 135, 10, 1, '5600', 1618155133),
(298, 135, 11, 1, '20000', 1618155133),
(299, 135, 19, 1, '2000000', 1618155133),
(300, 136, 22, 1, '10000', 1618155133),
(301, 137, 10, 2, '5600', 1618156200),
(302, 137, 17, 1, '2000000', 1618156200),
(303, 137, 9, 1, '2400', 1618156200),
(304, 137, 8, 1, '1000', 1618156200),
(305, 137, 19, 1, '2000000', 1618156200),
(306, 138, 22, 1, '10000', 1618156200),
(307, 138, 23, 1, '12000', 1618156200),
(308, 139, 27, 1, '230000', 1618156200),
(309, 140, 10, 2, '5600', 1618156239),
(310, 140, 17, 1, '2000000', 1618156239),
(311, 140, 9, 1, '2400', 1618156239),
(312, 140, 8, 1, '1000', 1618156239),
(313, 140, 19, 1, '2000000', 1618156239),
(314, 141, 22, 1, '10000', 1618156239),
(315, 141, 23, 1, '12000', 1618156239),
(316, 142, 27, 1, '230000', 1618156239),
(317, 143, 11, 1, '20000', 1618502903),
(318, 143, 8, 1, '1000', 1618502903),
(319, 144, 22, 1, '10000', 1618502903);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `payment_order_id` int(20) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_order` varchar(100) NOT NULL COMMENT 'thành viên thanh toán',
  `money` float NOT NULL COMMENT 'số tiền thanh toán',
  `note` varchar(255) DEFAULT NULL COMMENT 'ghi chú thanh toán',
  `vnp_response_code` varchar(255) NOT NULL COMMENT 'mã phản hồi',
  `code_vnpay` varchar(255) NOT NULL COMMENT 'mã giao dịch vnpay',
  `code_bank` varchar(255) NOT NULL COMMENT 'mã ngân hàng',
  `time` datetime NOT NULL COMMENT 'thời gian chuyển khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_order_id`, `order_id`, `user_order`, `money`, `note`, `vnp_response_code`, `code_vnpay`, `code_bank`, `time`) VALUES
(8, 128, '1618135848', 'user1', 12000, NULL, '', '', '', '2021-04-11 22:08:18'),
(12, 127, '1618137759', 'user1', 4005600, NULL, '', '', '', '2021-04-11 17:00:00'),
(13, 130, '20210411130722', 'user1', 4005600, 'Noi dung thanh toan', '00', '13488366', 'NCB', '2021-04-15 18:00:00'),
(14, 131, '20210411130722', 'user1', 12000, 'Noi dung thanh toan', '00', '13488366', 'NCB', '2021-04-11 18:00:00'),
(15, 132, '20210411130722', 'user1', 230000, 'Noi dung thanh toan', '00', '13488366', 'NCB', '2021-04-11 18:00:00'),
(16, 135, '20210411173124', 'user1', 2029000, 'Noi dung thanh toan', '00', '13488412', 'NCB', '2021-04-16 22:00:00'),
(17, 136, '20210411173124', 'user1', 10000, 'Noi dung thanh toan', '00', '13488412', 'NCB', '2021-04-13 22:00:00'),
(18, 134, '1618155225', 'user1', 10000, NULL, '', '', '', '2021-04-12 22:33:45'),
(19, 133, '1618155848', 'user1', 2029000, NULL, '', '', '', '2021-04-11 22:44:08'),
(20, 140, '20210411175007', 'user2', 4014600, 'Noi dung thanh toan', '00', '13488419', 'NCB', '2021-04-13 22:00:00'),
(21, 141, '20210411175007', 'user2', 22000, 'Noi dung thanh toan', '00', '13488419', 'NCB', '2021-04-13 22:00:00'),
(22, 142, '20210411175007', 'user2', 230000, 'Noi dung thanh toan', '00', '13488419', 'NCB', '2021-04-13 22:00:00'),
(23, 137, '1618156274', 'user2', 4014600, NULL, '', '', '', '2021-04-12 22:51:14'),
(24, 138, '1618156423', 'user2', 22000, NULL, '', '', '', '2021-04-12 22:53:43'),
(25, 129, '1618157940', 'user1', 230000, NULL, '', '', '', '2021-04-11 23:19:00'),
(26, 139, '1618158012', 'user2', 230000, NULL, '', '', '', '2021-04-11 23:20:12'),
(27, 143, '20210415180645', 'user1', 21000, 'Thanh toan hoa don mua  hang', '00', '13491180', 'NCB', '2021-04-15 23:00:00'),
(28, 144, '20210415180645', 'user1', 10000, 'Thanh toan hoa don mua  hang', '00', '13491180', 'NCB', '2021-04-15 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(20) NOT NULL,
  `p_category_id` int(20) NOT NULL,
  `p_shop_id` int(20) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_description` varchar(128) NOT NULL,
  `p_fresh` int(5) NOT NULL,
  `p_quantity` int(20) NOT NULL,
  `p_image` varchar(128) NOT NULL,
  `p_price` decimal(10,0) NOT NULL,
  `p_date_create` int(11) NOT NULL,
  `p_date_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_category_id`, `p_shop_id`, `p_name`, `p_description`, `p_fresh`, `p_quantity`, `p_image`, `p_price`, `p_date_create`, `p_date_update`) VALUES
(8, 245, 5, 'Cá khoai Linh', 'Cá khoai shop linh', 5, 4, '59a0e295aed8496c1bd5190c865577204A76F959-31D9-4C49-BADD-BDF58593C379.jpg', '1000', 1617002085, 0),
(9, 245, 5, 'Cá Lâm Linh', 'Cá lâm shop linh', 5, 20, '3ae22af35b330feca97f0de5f5bf4cc497485493_2490671654577425_8179314827781472256_n.png', '2400', 1617002113, 0),
(10, 246, 5, 'Cua shop Linh', 'Cua shop Linh', 10, 20, '43f5b33cc3735845716482adf97c1881cach-chon-hai-san.jpg', '5600', 1617002145, 0),
(11, 246, 5, 'Cua Lông shop Linh', 'Cua lông shop Linh', 50, 20, '82f35db00196ea1c623c406ce2cd2bbccach-chon-hai-san.jpg', '20000', 1617002179, 0),
(17, 245, 5, 'Cá Thu shop2', 'Cá thu loại 1', 10, 10, '61d7e829ed0b1572fa68fe562438534cIMG_1373.jpg', '2000000', 1617124625, 0),
(18, 246, 5, 'Cua đồng shop2', 'Cua đồng loại 1', 10, 20, '6e0b9acadb1b210374de9d29138fada0Nhung-nha-hang-hai-san-o-Thanh-Hóa-nen-ghe-1.jpg', '4000000', 1617124704, 0),
(19, 247, 5, 'Ghẹ biển shop 2', 'Ghẹ biển loại 1', 10, 20, '16153073948e0fbd9f519a2e8ca6ed721532419553506_7509459 - Copy.jpg', '2000000', 1617124775, 0),
(22, 245, 8, 'Cá khoai shop1', 'Hải sản 1 ', 10, 20, '2d9bac9bc2c1004fdf6ba76febbbbd6a97485493_2490671654577425_8179314827781472256_n.png', '10000', 1617524740, 0),
(23, 245, 8, 'Cá khoai 2 shop1', 'hai san', 10, 20, 'a50e461696046b4ef4c4b9b3841706bd45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', '12000', 1617524762, 0),
(27, 245, 11, 'Cá khoai shop 3', 'Cá khoai shop chinh', 10, 20, 'eb80a9a2233bea9ce092c83e1e33345fkeyv_1384186745.jpg', '230000', 1617846702, 0),
(28, 245, 11, 'cá tầm shop 3', 'Hải sản 1 ', 10, 20, '05d3d4c9e128c131d24451b68f3887a4keyv_1384186736.jpg', '21300', 1617846729, 0),
(29, 245, 11, 'Cá chép shop 3', 'Cá khoai shop chinh', 10, 20, '5ffce9f8005392acb013610a269d09eekeyv_1384835550.jpg', '2000', 1617846752, 0),
(30, 246, 11, 'Cua đồng shop 3', 'Cá khoai shop chinh', 10, 20, '4e57d275aec00894b95abd1c6677dda4keyv_1384840170.jpg', '200', 1617846803, 0),
(31, 246, 11, 'Cá Lâm shop 3', 'Cá khoai shop chinh', 10, 20, 'e0124b847752b31ae7c5dd47f59640aakeyv_1384835580.jpg', '2000', 1617846827, 0),
(32, 247, 11, 'Ghẹ shop 3', 'Ghẹ biển loại 1', 10, 20, '5ac1e467392f6243def6b04e5ac20277keyv_1384186962.jpg', '20000', 1617846864, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(20) NOT NULL,
  `review_user_id` int(20) NOT NULL,
  `review_shop_id` int(20) NOT NULL,
  `review_product_id` int(20) NOT NULL,
  `review_image` varchar(255) NOT NULL,
  `review_video` varchar(1000) NOT NULL,
  `rank` int(10) NOT NULL,
  `review_comment` varchar(255) NOT NULL,
  `review_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_user_id`, `review_shop_id`, `review_product_id`, `review_image`, `review_video`, `rank`, `review_comment`, `review_time`) VALUES
(18, 1, 5, 8, '97485493_2490671654577425_8179314827781472256_n.png', ' ', 5, 'Oke', 1618500542),
(19, 1, 5, 8, '4A76F959-31D9-4C49-BADD-BDF58593C379.jpg', ' ', 2, 'yêu chinh', 1618500553),
(20, 1, 5, 8, '158384890_147610643901366_5275522211667288605_n.png', ' ', 5, ' world', 1618500564),
(21, 1, 5, 9, '158384890_147610643901366_5275522211667288605_n.png', ' ', 2, 'Oke', 1618500575),
(22, 1, 5, 9, '4A76F959-31D9-4C49-BADD-BDF58593C379.jpg', ' ', 1, 'dâdadad', 1618500586),
(23, 1, 5, 8, '', ' ', 3, 'ad', 1618500620),
(24, 2, 5, 8, '158384890_147610643901366_5275522211667288605_n.png', ' ', 4, 'user 2', 1618507173);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(20) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `role_description` varchar(20) NOT NULL,
  `role_status` int(11) NOT NULL,
  `role_create_time` int(11) NOT NULL,
  `role_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`, `role_status`, `role_create_time`, `role_update_time`) VALUES
(1, 'Shoper', 'User sell product', 1, 1616873879, 0),
(2, 'User', 'User buy product', 1, 1616873933, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(20) NOT NULL,
  `shop_user_id` int(20) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_address` varchar(125) NOT NULL,
  `shop_description` varchar(218) NOT NULL,
  `shop_avatar` varchar(128) NOT NULL,
  `shop_status` int(11) NOT NULL,
  `shop_rank` int(5) NOT NULL,
  `shop_create_time` int(11) NOT NULL,
  `shop_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_user_id`, `shop_name`, `shop_address`, `shop_description`, `shop_avatar`, `shop_status`, `shop_rank`, `shop_create_time`, `shop_update_time`) VALUES
(5, 4, 'Shop cua Linh', 'Vinh phuc city', 'Shop Linh ban muc', '53e75f4556682ce5872b4c15f988cba14A76F959-31D9-4C49-BADD-BDF58593C379.jpg', 1, 4, 1616959481, 1617626811),
(8, 17, 'shop 1 của Chính', 'Thanh hoa city', 'Shop chinh ban ghe', '2b889d4f37220c9cca00731898138d2897485493_2490671654577425_8179314827781472256_n.png', 1, 1, 1617524702, 1617723562),
(11, 20, 'shop 3  hai san', 'Thanh hoa city', 'shop 3 hai san', 'a1ee5f351c8d8a5e3e2c016374c89c7cproduct_1383987794.png', 1, 1, 1617846675, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL,
  `session_status` varchar(30) NOT NULL,
  `user_role_id` int(20) NOT NULL,
  `user_create_time` int(20) NOT NULL,
  `user_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullname`, `user_status`, `session_status`, `user_role_id`, `user_create_time`, `user_update_time`) VALUES
(1, 'user1', '123456', 'truongbachinh1998@gmail.com', 'user chinh 1', 1, 'Offline now', 2, 0, 1617729784),
(2, 'user2', '123456', 'truongbachinh1998@gmail.com', 'user chinh 2', 1, 'Offline now', 2, 0, 0),
(4, 'shop2', '123456', 'truongbachinh@gmail.com', 'shop chinh 2', 1, 'Offline now', 1, 0, 0),
(17, 'shop1', '123456', 'truongbachinh1998@gmail.com', 'Trương Bá Chính', 1, 'Offline now', 1, 1617524677, 0),
(18, 'admin123123', '1231231', 'truongbachinh1998@gmail.com', 'chinh truong', 1, '', 1, 1617595926, 0),
(19, '123123', '123123', 'truongbachinh1998@gmail.com', 'chinh truong123', 1, '', 1, 1617595934, 0),
(20, 'shop3', '123456', 'truongbachinh1998@gmail.com', 'trinh trinh', 1, 'Active now', 1, 1617846456, 0),
(22, 'shop4', '123456', 'shop4@gmail.com', 'linh linh', 1, '', 1, 1617846525, 0),
(23, 'user3', '123456', 'truongbachinh1998@gmail.com', 'chinh chinh', 1, '', 2, 1617846541, 0),
(24, 'user4', '123456', 'admin1@gmail.com', 'tranLinh', 1, 'Offline now', 1, 1618176469, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_infor`
--

CREATE TABLE `user_infor` (
  `ui_id_infor` int(20) NOT NULL,
  `ui_avatar` varchar(125) NOT NULL,
  `ui_firstname` varchar(50) NOT NULL,
  `ui_lastname` varchar(50) NOT NULL,
  `ui_address` varchar(128) NOT NULL,
  `ui_DOB` date NOT NULL,
  `ui_phone` varchar(10) NOT NULL,
  `ui_create_time` int(11) NOT NULL,
  `ui_update_time` int(11) NOT NULL,
  `ui_user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_infor`
--

INSERT INTO `user_infor` (`ui_id_infor`, `ui_avatar`, `ui_firstname`, `ui_lastname`, `ui_address`, `ui_DOB`, `ui_phone`, `ui_create_time`, `ui_update_time`, `ui_user_id`) VALUES
(2, 'f48c6a7dc8965620d000616261ec903f97485493_2490671654577425_8179314827781472256_n.png', 'Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '1998-05-20', '0912012902', 1617202893, 0, 1),
(3, '9788d511302550759973ff015f3b26e845C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 'Trần ', 'Linh', 'Vĩnh phúc', '2021-04-14', '0332565795', 1617626549, 0, 2),
(4, 'ae27ea8e8b72b756db0ce91ada19a02097485493_2490671654577425_8179314827781472256_n.png', 'Lê', 'An', 'FPT UNIVERSITY', '1998-05-20', '0123456789', 1617846919, 0, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fogeign_key_cart_user` (`cart_user_id`),
  ADD KEY `fogeign_key_cart_product` (`cart_product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fogeign_key_chat_user_incomming` (`msg_incoming_id`),
  ADD KEY `fogeign_key_chat_user_outcomming` (`msg_outcoming_id`);

--
-- Indexes for table `image_library`
--
ALTER TABLE `image_library`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `fogeign_key_img_pro` (`img_p_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_order_user` (`order_user_id`),
  ADD KEY `fogeign_key_order_shop` (`order_shop_id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`oda_id`),
  ADD KEY `fogeign_key_address_order` (`oda_order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_order_product` (`order_product_id`),
  ADD KEY `fogeign_key_order_items` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_payment_order` (`payment_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fogeign_key_p_shop` (`p_shop_id`),
  ADD KEY `fogeign_key_p_ctg` (`p_category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fogeign_key_review_user` (`review_user_id`),
  ADD KEY `fogeign_key_review_shop` (`review_shop_id`),
  ADD KEY `fogeign_key_review_product` (`review_product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `shop_user_id` (`shop_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fogeign_key_user_role` (`user_role_id`);

--
-- Indexes for table `user_infor`
--
ALTER TABLE `user_infor`
  ADD PRIMARY KEY (`ui_id_infor`),
  ADD KEY `fogeign_key_user_user_infor` (`ui_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ctg_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `msg_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7695;

--
-- AUTO_INCREMENT for table `image_library`
--
ALTER TABLE `image_library`
  MODIFY `img_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `oda_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_infor`
--
ALTER TABLE `user_infor`
  MODIFY `ui_id_infor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fogeign_key_cart_product` FOREIGN KEY (`cart_product_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_cart_user` FOREIGN KEY (`cart_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `fogeign_key_chat_user_incomming` FOREIGN KEY (`msg_incoming_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_chat_user_outcomming` FOREIGN KEY (`msg_outcoming_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_library`
--
ALTER TABLE `image_library`
  ADD CONSTRAINT `fogeign_key_img_pro` FOREIGN KEY (`img_p_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fogeign_key_order_shop` FOREIGN KEY (`order_shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_order_user` FOREIGN KEY (`order_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `fogeign_key_address_order` FOREIGN KEY (`oda_order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fogeign_key_order_items` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_order_product` FOREIGN KEY (`order_product_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fogeign_key_payment_order` FOREIGN KEY (`payment_order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fogeign_key_p_ctg` FOREIGN KEY (`p_category_id`) REFERENCES `categories` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_p_shop` FOREIGN KEY (`p_shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fogeign_key_review_product` FOREIGN KEY (`review_product_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_review_shop` FOREIGN KEY (`review_shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_review_user` FOREIGN KEY (`review_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `fogeign_key_shop_user` FOREIGN KEY (`shop_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fogeign_key_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_infor`
--
ALTER TABLE `user_infor`
  ADD CONSTRAINT `fogeign_key_user_user_infor` FOREIGN KEY (`ui_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
