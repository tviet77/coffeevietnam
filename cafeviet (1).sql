-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 02:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeviet`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `slide_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_subheading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide_desc` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `created_at`, `updated_at`) VALUES
(68, 2, '2024-04-24 08:01:17', '2024-04-24 08:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_entry_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `product_entry_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(37, 68, 1, 1, 15000, '2024-04-24 08:01:17', '2024-04-24 08:01:17'),
(38, 68, 2, 1, 15000, '2024-04-24 08:01:20', '2024-04-24 08:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `total` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_cat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `user_id`, `firstname`, `lastname`, `address`, `phone`, `email`, `notes`, `status`, `total`, `create_at`, `update_cat`) VALUES
(21, 69, 1, 'Tran', 'Viet', 'Canh Vinh, Vân Canh, Bình Định', '0123456789', 'vietvipkai@gmail.com', 'xx', 0, 15000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 71, 1, 'Tran', 'Viet', 'Canh Vinh, Vân Canh, Bình Định', '0123456789', 'vietvipkai@gmail.com', 'ô', 2, 75000, '2024-04-27 03:28:57', '2024-04-27 03:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `productpe_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `productpe_id`, `quantity`, `price`) VALUES
(15, 21, 11, 1, 15000),
(17, 23, 1, 3, 15000),
(18, 23, 4, 2, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `description`, `product_detail`, `img1`, `img2`, `img3`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trà Sữa Vị Dâu (Chân Châu, Pudding)', 'Trà Sữa Vị Dâu (Chân Châu, Pudding)  loại thức uống quen thuộc ngon đậm đà...', 'Với sự ngọt ngào được chiết xuất từ những trái <strong>dâu tây</strong> thơm ngon đã cho ra đời một loại<strong> trà sữa</strong> hấp dẫn với trẻ nhỏ bởi màu sắc được hòa quyện một cách dễ chịu. Màu hồng và vị ngọt luôn là những điểm ưu tiên hàng đầu mà mọi người thích nhất, cộng vào đó là hương thơm của loại quả kỳ diệu này đã làm mê mẩn không chỉ riêng với các em nhỏ mà ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Trà sữa vị dâu thơm vị trà, vị sữa beo béo..kèm thạch giòn giòn, pudding, chân châu nhai mềm dai hấp dẫn.<br />  <br />  Đặt hàng ngay quán mình hỗ trợ free ship trong bán kính 5km và hỗ trợ tận tình cũng như có nhiều ưu đãi cho các khách hàng thân thiết ạ.<br />  <br />  Các bạn nhớ tạo 1 tài khoản và đặt hàng để lưu đơn hàng thật nhiều, quán mình sẽ có nhiều ưu đãi cho khách hàng thân thiết nhé! Cảm ơn các bạn.<br />  <br />  <strong>HDSD</strong>: Dùng ngay<br />  <br />  <strong>Bảo quản</strong>: Tránh ánh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An Toàn Thực Phẩm.<br />  <br />  Quý khách có thể tùy chọn nhiều thạch hoặc nhiều chân châu( Khi đặt hàng quý khách nhớ ghi lời nhắn lại nhé ', 'photo_2021-06-02_11-52-26.jpg', '', '', 'tra-sua-vi-dau', '2024-04-15 15:19:11', '2024-04-15 15:19:11'),
(2, 4, 'Nước chanh', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-1.jpg', NULL, NULL, 'nuoc-chanh', '2024-04-16 03:34:05', '2024-04-16 03:34:05'),
(4, 4, 'Rượu 2', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-3.jpg', NULL, NULL, 'ruou-2', '2024-04-16 03:35:32', '2024-04-16 03:35:32'),
(5, 4, 'Bia', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-4.jpg', NULL, NULL, 'bia', '2024-04-16 03:36:10', '2024-04-16 03:36:10'),
(6, 4, 'Rượu trái cây', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-5.jpg', NULL, NULL, 'ruou-trai-cay', '2024-04-16 03:36:39', '2024-04-16 03:36:39'),
(7, 4, 'Nước trái cây', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-6.jpg', NULL, NULL, 'nuoc-trai-cay', '2024-04-16 03:37:15', '2024-04-16 03:37:15'),
(8, 4, 'Cocktail', 'Thức uống có cồn là một loại thức uống có chứa ethanol, một loại rượu được sản xuất bằng cách lên men ngũ cốc, trái cây hoặc các nguồn đường khác.', 'Với sự ngọt ng&agrave;o được chiết xuất từ những tr&aacute;i&nbsp;<strong>d&acirc;u t&acirc;y</strong>&nbsp;thơm ngon đ&atilde; cho ra đời một loại<strong>&nbsp;tr&agrave; sữa</strong>&nbsp;hấp dẫn với trẻ nhỏ bởi m&agrave;u sắc được h&ograve;a quyện một c&aacute;ch dễ chịu. M&agrave;u hồng v&agrave; vị ngọt lu&ocirc;n l&agrave; những điểm ưu ti&ecirc;n h&agrave;ng đầu m&agrave; mọi người th&iacute;ch nhất, cộng v&agrave;o đ&oacute; l&agrave; hương thơm của loại quả kỳ diệu n&agrave;y đ&atilde; l&agrave;m m&ecirc; mẩn kh&ocirc;ng chỉ ri&ecirc;ng với c&aacute;c em nhỏ m&agrave; ngay đối với người lớn cũng bị ảnh hưởng theo.<br />  <br />  Tr&agrave; sữa vị d&acirc;u thơm vị tr&agrave;, vị sữa beo b&eacute;o..k&egrave;m thạch gi&ograve;n gi&ograve;n, pudding, ch&acirc;n ch&acirc;u nhai mềm dai hấp dẫn.<br />  <br />  Đặt h&agrave;ng ngay qu&aacute;n m&igrave;nh hỗ trợ free ship trong b&aacute;n k&iacute;nh 5km v&agrave; hỗ trợ tận t&igrave;nh cũng như c&oacute; nhiều ưu đ&atilde;i cho c&aacute;c kh&aacute;ch h&agrave;ng th&acirc;n thiết ạ.<br />  <br />  C&aacute;c bạn nhớ tạo 1 t&agrave;i khoản v&agrave; đặt h&agrave;ng để lưu đơn h&agrave;ng thật nhiều, qu&aacute;n m&igrave;nh sẽ c&oacute; nhiều ưu đ&atilde;i cho kh&aacute;ch h&agrave;ng th&acirc;n thiết nh&eacute;! Cảm ơn c&aacute;c bạn.<br />  <br />  <strong>HDSD</strong>: D&ugrave;ng ngay<br />  <br />  <strong>Bảo quản</strong>: Tr&aacute;nh &aacute;nh nắng trực tiếp<br />  <br />  Cam Kết Vệ Sinh An To&agrave;n Thực Phẩm.<br />  <br />  Qu&yacute; kh&aacute;ch c&oacute; thể t&ugrave;y chọn nhiều thạch hoặc nhiều ch&acirc;n ch&acirc;u( Khi đặt h&agrave;ng qu&yacute; kh&aacute;ch nhớ ghi lời nhắn lại nh&eacute;&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)', 'drink-7.jpg', NULL, NULL, 'cocktail', '2024-04-16 03:39:24', '2024-04-16 03:39:24'),
(11, 1, 'Trà sữa Trân Chân đường đen', 'a', 'a', 'photo_2021-06-02_11-52-26.jpg', '', '', 'tra-sua-tran-chan-duong-den', '2024-04-26 11:15:48', '2024-04-26 11:15:48'),
(12, 2, 'Trà sữa Thái Xanh', 'a', 'a', 'photo_2021-06-02_11-52-26.jpg', 'wallpaperflare.com_wallpaper.jpg', 'photo_2024-04-08_23-33-38.jpg', 'tra-sua-thai-xanh', '2024-04-26 11:18:54', '2024-04-26 11:18:54'),
(13, 1, 'Trà sữa Trân Chân đường đen 1', '1', '1', '', '', '', 'tra-sua-tran-chan-duong-den-1', '2024-04-26 11:35:40', '2024-04-26 11:35:40'),
(14, 1, 'Trà sữa Thái Xanh xc', 'x', 'x', '', '', '', 'tra-sua-thai-xanh-xc', '2024-04-26 11:36:57', '2024-04-26 11:36:57'),
(15, 1, 'Trà sữa kem dâu', 'a', 'a', '', '', '', 'tra-sua-kem-dau', '2024-04-26 11:47:48', '2024-04-26 11:47:48'),
(16, 3, 'Cafe sữa', 'a', 'a', '', '', '', 'cafe-sua', '2024-04-26 11:48:35', '2024-04-26 11:48:35'),
(17, 1, 'Trà sữa Thái Xanh s', 'a', 'a', 'photo_2021-06-02_11-52-26.jpg', 'wallpaperflare.com_wallpaper.jpg', 'pxfuel.jpg', 'tra-sua-thai-xanh-s', '2024-04-26 11:53:15', '2024-04-26 11:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Trà sữa Hồng Kông', 'tra-sua-hong-kong', 'Trà sữa ngon tuyệt vời', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Nước trái cây', 'nuoc-trai-cay', 'Nước trái cây', '2024-04-16 03:33:21', '2024-04-16 10:33:21'),
(3, 'Cafe', 'cafe', 'Cafe', '2024-04-16 03:33:33', '2024-04-16 10:33:33'),
(4, 'Rượu', 'ruou', 'Rượu', '2024-04-16 03:34:45', '2024-04-16 10:34:45'),
(8, 'a', 'a', 'a', '2024-04-24 17:27:47', '2024-04-25 00:27:47'),
(9, 'aa', 'aa', 'aaaaa', '2024-04-24 17:28:06', '2024-04-25 00:28:06'),
(12, 's', 's', 's', '2024-04-27 04:59:44', '2024-04-27 11:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `comment_text` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_entry`
--

CREATE TABLE `product_entry` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_entry`
--

INSERT INTO `product_entry` (`id`, `product_id`, `size_id`, `price`) VALUES
(1, 1, 1, 15000),
(2, 1, 2, 20000),
(3, 2, 1, 15000),
(4, 2, 2, 20000),
(5, 2, 3, 25000),
(9, 4, 1, 15000),
(10, 4, 2, 20000),
(11, 4, 3, 22000),
(12, 5, 1, 15000),
(13, 5, 2, 20000),
(14, 5, 3, 25000),
(18, 6, 1, 15000),
(19, 6, 2, 20000),
(20, 6, 3, 25000),
(21, 7, 1, 15000),
(22, 7, 2, 20000),
(23, 7, 3, 25000),
(24, 8, 1, 15000),
(25, 8, 2, 20000),
(26, 8, 3, 25000),
(27, 11, 1, 20000),
(28, 11, 2, 25000),
(29, 11, 3, 30000),
(30, 12, 1, 20000),
(31, 12, 2, 20000),
(32, 12, 3, 20000),
(33, 13, 1, 20000),
(34, 13, 2, 25000),
(35, 13, 3, 30000),
(36, 14, 1, 20000),
(37, 14, 2, 20000),
(38, 14, 3, 30000),
(39, 15, 1, 20000),
(40, 15, 2, 20000),
(41, 15, 3, 30000),
(42, 16, 1, 20000),
(43, 16, 2, 25000),
(44, 16, 3, 30000),
(45, 17, 1, 20000),
(46, 17, 2, 20000),
(47, 17, 3, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2024-04-17 04:16:42', NULL),
(2, 'user', 'user', '2024-04-17 04:16:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `name_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name_size`) VALUES
(1, 'Nhỏ'),
(2, 'Vừa'),
(3, 'Lớn');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `full_name`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'nam', '123', 'nam@gmail.com', 'Trần Quốc Nam', '01234567890', '2024-04-08 17:00:00', '2024-04-08 17:00:00'),
(2, 1, 'viet', '123', 'vietvipkai@gmail.com', 'Trần Quốc Việt', '01234567', NULL, NULL),
(3, 2, 'bin', '$2y$10$Mejc2.tSxwmoIHxiuhxs0eH0VTb5YzcvnlDHF8DmsYwVQYDtvvs.S', 'badao1thoj@gmail.com', 'Bin Trần', '0123456780', NULL, NULL),
(4, 2, 'den', '$2y$10$TezOcEbmRcEGW9zvdx/nTOU1e.Qwx5Bun3igE629xThxRi5pCBUTC', 'demo@minimals.cc', 'Den Tran', '0123456790', '2024-04-15 14:36:35', '2024-04-15 14:36:35'),
(10, 1, 'vietcute', '202cb962ac59075b964b07152d234b70', 'viet@gmail.com', 'Tran Quoc Viet', '01234567890', '2024-04-27 06:04:37', '2024-04-27 06:04:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_entry_id` (`product_entry_id`),
  ADD KEY `cart_details_ibfk_1` (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_ibfk_1` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_entry`
--
ALTER TABLE `product_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_entry_ibfk_1` (`product_id`),
  ADD KEY `product_entry_ibfk_2` (`size_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_entry`
--
ALTER TABLE `product_entry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_entry`
--
ALTER TABLE `product_entry`
  ADD CONSTRAINT `product_entry_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_entry_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
