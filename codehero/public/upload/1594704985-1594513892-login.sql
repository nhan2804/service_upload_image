-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 15, 2020 lúc 08:13 PM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `login`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `access_rights` int(11) NOT NULL,
  `cookie` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `date_created`, `date_end`, `access_rights`, `cookie`, `token`) VALUES
(1, 'admin', 'admin', '2020-04-06 00:00:00', '2020-04-06 10:18:10', 0, 'cookie', 'token'),
(19, 'ngocnhan', '3oihC1KO', '2020-04-12 20:45:04', '2020-04-12 20:45:04', 1, 'm', 'nnnnnn'),
(20, 'test0001', 'VInVzrtQ', '2020-04-12 20:45:32', '2020-04-12 20:45:32', 1, '', ''),
(21, 'bacxemnhe', '6VGfIyW2', '2020-04-12 21:38:32', '2020-04-12 21:38:32', 1, '', ''),
(22, 'tes0002', 'uVWdU1Sb', '2020-04-12 21:39:35', '2020-04-12 21:39:35', 1, '', ''),
(23, 'tes0003', '4G9UlXoT', '2020-04-12 21:39:41', '2020-04-12 21:39:41', 1, '', ''),
(24, 'aloalo', 'ShT28sAP', '2020-04-12 21:42:33', '2020-04-12 21:42:33', 1, '', ''),
(25, 'testlann', 'NRkHbXc6', '2020-04-12 22:26:45', '2020-04-12 22:26:45', 1, '', ''),
(26, 'givaynhi', 'jaUeowQT', '2020-04-14 11:38:06', '2020-04-14 11:38:06', 1, '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notify`
--

CREATE TABLE `notify` (
  `thongbao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `notify`
--

INSERT INTO `notify` (`thongbao`) VALUES
('© 2020 PANDA SOFTWARE TEAM. ALL RIGHTS RESERVED. Design by NNN'),
('© 2020 PANDA SOFTWARE TEAM. ALL RIGHTS RESERVED. Design by NNN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tools`
--

CREATE TABLE `tools` (
  `stt` int(11) NOT NULL,
  `fitle_friend` int(11) NOT NULL,
  `interactive` int(11) NOT NULL,
  `feed_acc` int(11) NOT NULL,
  `reg_auto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tool_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tools`
--

INSERT INTO `tools` (`stt`, `fitle_friend`, `interactive`, `feed_acc`, `reg_auto`, `id_user`, `tool_name`) VALUES
(3, 0, 0, 0, 1, 19, ''),
(4, 0, 1, 0, 0, 20, ''),
(5, 0, 0, 1, 0, 21, ''),
(6, 0, 0, 1, 0, 22, ''),
(7, 1, 0, 0, 0, 23, ''),
(8, 0, 1, 0, 0, 24, ''),
(9, 0, 0, 0, 0, 25, ''),
(10, 0, 0, 0, 0, 26, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`stt`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tools`
--
ALTER TABLE `tools`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
