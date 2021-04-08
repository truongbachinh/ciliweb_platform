-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 04:11 AM
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
(106, 1, 10, 1, 1617730613, 0),
(107, 1, 17, 1, 1617730615, 0),
(108, 1, 23, 1, 1617730617, 0);

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
  `shipping_receive_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_user_id`, `order_shop_id`, `order_total_cost`, `order_total_amount`, `order_create_time`, `payment_order_status`, `shipping_order_status`, `shipping_create_time`, `shipping_receive_time`) VALUES
(34, 1, 5, '5600', 1, 1617123887, 1, 1, 0, 0),
(37, 1, 5, '20000', 2, 1617125023, 1, 1, 0, 0),
(42, 1, 5, '2000000', 1, 1617258097, 1, 1, 0, 0),
(45, 2, 5, '25600', 3, 1617260491, 1, 1, 0, 0),
(47, 1, 5, '2008000', 133, 1617548290, 1, 1, 0, 0),
(48, 1, 8, '22000', 6, 1617548290, 1, 2, 1617783037, 0),
(49, 1, 5, '3400', 2, 1617553510, 1, 1, 0, 0),
(50, 1, 8, '22000', 2, 1617553510, 1, 2, 1617779334, 0),
(51, 1, 5, '28000', 3, 1617558437, 1, 1, 0, 0),
(52, 1, 8, '22000', 2, 1617558437, 1, 2, 1617787101, 0),
(53, 1, 5, '3400', 6, 1617558844, 1, 1, 0, 0),
(54, 1, 8, '22000', 3, 1617558844, 1, 1, 0, 0),
(55, 1, 5, '8029000', 12, 1617715641, 1, 1, 0, 0),
(56, 1, 8, '22000', 6, 1617715641, 1, 3, 0, 1617787168),
(57, 23, 5, '2006600', 988, 1617847128, 1, 1, 0, 0),
(58, 23, 8, '12000', 1, 1617847128, 1, 1, 0, 0),
(59, 23, 11, '234200', 4, 1617847128, 1, 3, 1617847159, 1617847226);

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
(31, 34, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Vietnam', 'Hanoi', 0, 'Ship hàng vào buổi sáng ', 1617123887),
(34, 37, ' Trần Thi', 'Mỹ Linh', 'Xuân hòa, Lập Thạch Vĩnh Phúc', 'Kí túc xá mĩ đình', '0332565795', 'linhttmgbh17474@fpt.edu.vn', 'Vietnam', 'Hanoi', 0, 'Mua hàng hải sản của 3 shop ', 1617125023),
(39, 42, ' Cô', 'DƯơng 2', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '', '0912012902', 'truongbachinh1998@gmail.com', 'Vietnam', 'Hanoi', 0, '123', 1617258097),
(42, 45, ' cô', 'dương order2', 'FPT UNIVERSITY, 41', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Vietnam', 'Hanoi', 0, 'ad', 1617260491),
(44, 47, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Hà Nội', 'Quận Bắc Từ Liêm', 0, 'Ship hang', 1617548290),
(45, 48, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Hà Nội', 'Quận Bắc Từ Liêm', 0, 'Ship hang', 1617548290),
(46, 49, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Hà Nội', 'Huyện Đan Phượng', 0, 'ad', 1617553510),
(47, 50, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Hà Nội', 'Huyện Đan Phượng', 0, 'ad', 1617553510),
(48, 51, ' chinh', 'truong', 'FPT UNIVERSITY', '41', '0123456789', 'truongbachinh1998@gmail.com', '', '', 0, 'ad', 1617558437),
(49, 52, ' chinh', 'truong', 'FPT UNIVERSITY', '41', '0123456789', 'truongbachinh1998@gmail.com', '', '', 0, 'ad', 1617558437),
(50, 53, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Điện Biên', 'Huyện Tủa Chùa', 0, 'S', 1617558844),
(51, 54, ' Trương', 'Chính', 'ktx mỹ đình 2 đường hàm nghi quận nam từ liêm hà nội', '41', '0912012902', 'truongbachinh1998@gmail.com', 'Điện Biên', 'Huyện Tủa Chùa', 0, 'S', 1617558844),
(52, 55, ' trAN', 'lINH', 'FPT UNIVERSITY', '41', '0123456789', 'truongbachinh1998@gmail.com', 'An Giang', 'Huyện An Phú', 0, 'AD', 1617715641),
(53, 56, ' trAN', 'lINH', 'FPT UNIVERSITY', '41', '0123456789', 'truongbachinh1998@gmail.com', 'An Giang', 'Huyện An Phú', 0, 'AD', 1617715641),
(54, 57, ' Le', 'An', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Vĩnh Phúc', 'Huyện Lập Thạch', 0, 'ship hang nhanh', 1617847128),
(55, 58, ' Le', 'An', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Vĩnh Phúc', 'Huyện Lập Thạch', 0, 'ship hang nhanh', 1617847128),
(56, 59, ' Le', 'An', 'FPT UNIVERSITY, 41', '41', '0123456789', 'truongbachinh1998@gmail.com', 'Vĩnh Phúc', 'Huyện Lập Thạch', 0, 'ship hang nhanh', 1617847128);

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
(139, 34, 10, 1, '5600', 1617123887),
(143, 37, 11, 2, '20000', 1617125023),
(152, 42, 19, 1, '2000000', 1617258097),
(155, 45, 10, 2, '5600', 1617260491),
(156, 45, 11, 1, '20000', 1617260491),
(158, 47, 10, 126, '5600', 1617548290),
(159, 47, 19, 5, '2000000', 1617548290),
(160, 47, 9, 2, '2400', 1617548290),
(161, 48, 22, 3, '10000', 1617548290),
(162, 48, 23, 3, '12000', 1617548290),
(163, 49, 8, 1, '1000', 1617553510),
(164, 49, 9, 1, '2400', 1617553510),
(165, 50, 22, 1, '10000', 1617553510),
(166, 50, 23, 1, '12000', 1617553510),
(167, 51, 9, 1, '2400', 1617558437),
(168, 51, 11, 1, '20000', 1617558437),
(169, 51, 10, 1, '5600', 1617558437),
(170, 52, 23, 1, '12000', 1617558437),
(171, 52, 22, 1, '10000', 1617558437),
(172, 53, 8, 5, '1000', 1617558844),
(173, 53, 9, 1, '2400', 1617558844),
(174, 54, 23, 2, '12000', 1617558844),
(175, 54, 22, 1, '10000', 1617558844),
(176, 55, 10, 3, '5600', 1617715641),
(177, 55, 8, 3, '1000', 1617715641),
(178, 55, 17, 2, '2000000', 1617715641),
(179, 55, 11, 1, '20000', 1617715641),
(180, 55, 9, 1, '2400', 1617715641),
(181, 55, 19, 1, '2000000', 1617715641),
(182, 55, 18, 1, '4000000', 1617715641),
(183, 56, 22, 3, '10000', 1617715641),
(184, 56, 23, 3, '12000', 1617715641),
(185, 57, 10, 986, '5600', 1617847128),
(186, 57, 8, 1, '1000', 1617847128),
(187, 57, 19, 1, '2000000', 1617847128),
(188, 58, 23, 1, '12000', 1617847128),
(189, 59, 27, 1, '230000', 1617847128),
(190, 59, 30, 1, '200', 1617847128),
(191, 59, 31, 1, '2000', 1617847128),
(192, 59, 29, 1, '2000', 1617847128);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `payment_order_id` bigint(20) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `member` varchar(100) NOT NULL COMMENT 'thành viên thanh toán',
  `money` float NOT NULL COMMENT 'số tiền thanh toán',
  `note` varchar(255) DEFAULT NULL COMMENT 'ghi chú thanh toán',
  `vnp_response_code` varchar(255) NOT NULL COMMENT 'mã phản hồi',
  `code_vnpay` varchar(255) NOT NULL COMMENT 'mã giao dịch vnpay',
  `code_bank` varchar(255) NOT NULL COMMENT 'mã ngân hàng',
  `time` datetime NOT NULL COMMENT 'thời gian chuyển khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 245, 5, 'Cá khoai Linh', 'Cá khoai shop linh', 5, 200, '59a0e295aed8496c1bd5190c865577204A76F959-31D9-4C49-BADD-BDF58593C379.jpg', '1000', 1617002085, 0),
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
  `user_role_id` int(20) NOT NULL,
  `user_create_time` int(20) NOT NULL,
  `user_update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullname`, `user_status`, `user_role_id`, `user_create_time`, `user_update_time`) VALUES
(1, 'user1', '123456', 'user1@gmail.com', 'user chinh 1', 1, 2, 0, 1617729784),
(2, 'user2', '123456', 'truongbachinh1998@gmail.com', 'user chinh 2', 1, 2, 0, 0),
(4, 'shop2', '123456', 'truongbachinh@gmail.com', 'shop chinh 2', 1, 1, 0, 0),
(17, 'shop1', '123456', 'truongbachinh1998@gmail.com', 'Trương Bá Chính', 1, 1, 1617524677, 0),
(18, 'admin123123', '1231231', 'truongbachinh1998@gmail.com', 'chinh truong', 1, 1, 1617595926, 0),
(19, '123123', '123123', 'truongbachinh1998@gmail.com', 'chinh truong123', 1, 1, 1617595934, 0),
(20, 'shop3', '123456', 'truongbachinh1998@gmail.com', 'trinh trinh', 1, 1, 1617846456, 0),
(22, 'shop4', '123456', 'shop4@gmail.com', 'linh linh', 1, 1, 1617846525, 0),
(23, 'user3', '123456', 'truongbachinh1998@gmail.com', 'chinh chinh', 1, 2, 1617846541, 0);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fogeign_key_p_shop` (`p_shop_id`),
  ADD KEY `fogeign_key_p_ctg` (`p_category_id`);

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
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ctg_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `image_library`
--
ALTER TABLE `image_library`
  MODIFY `img_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `oda_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fogeign_key_p_ctg` FOREIGN KEY (`p_category_id`) REFERENCES `categories` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_p_shop` FOREIGN KEY (`p_shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
