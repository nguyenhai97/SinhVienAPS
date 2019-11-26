-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 26, 2019 lúc 10:59 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `SinhVienAPS`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Course`
--

CREATE TABLE `Course` (
  `id` int(11) NOT NULL,
  `lecturers` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Course`
--

INSERT INTO `Course` (`id`, `lecturers`, `start_date`, `end_date`, `subject_id`) VALUES
(1, 'Trần Văn A', '2019-11-05', '2019-11-08', 1),
(2, 'Trần Văn B', '2019-11-07', '2019-11-08', 2),
(3, 'Trần Văn C', '2019-11-05', '2019-11-22', 3),
(4, 'Trần Văn D', '2019-11-05', '2019-11-21', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `JoinDetails`
--

CREATE TABLE `JoinDetails` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `JoinDetails`
--

INSERT INTO `JoinDetails` (`id`, `student_id`, `course_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 2),
(7, 1, 2),
(8, 2, 2),
(9, 3, 2),
(10, 1, 3),
(11, 2, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Student`
--

CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `course` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Student`
--

INSERT INTO `Student` (`id`, `fullname`, `email`, `address`, `phone`, `image`, `dob`, `course`, `bio`) VALUES
(1, 'Nguyễn Văn A', 'nva@gmail.com', 'Thái Nguyên', '0987471645', 'fallback.png', '2019-11-21', 'CNTT_K14C', 1),
(2, 'Nguyễn Văn B', 'nvb@gmail.cm', 'Hà Nội', '0987471645', 'fallback.png', '2019-11-14', 'CNTT_K15C', 0),
(3, 'Nguyễn Văn C', 'nvc@gmail.com', 'Yên Bái', '0987471645', 'fallback.png', '2019-11-15', 'CNTT_K13C', 1),
(4, 'Nguyễn Văn D', 'nvd@gmail.com', 'Lào Cai', '0987471645', 'fallback.png', '2019-11-15', 'CNTT_K12C', 0),
(5, 'Nguyễn Văn E', 'nve@gmail.com', 'Bắc Giang', '0987471645', 'fallback.png', '2019-11-29', 'CNTT_K11C', 1),
(7, 'Nguyễn Văn DB', 'db@gmail.com', 'Ô Chợ Dừa', '0987654321', 'a114.jpg', '2019-11-13', 'KHMT_K12D', 1),
(8, 'Văn Hoàng', 'vanhoang@gmail.com', 'Ô Chợ Dừa 2', '0987654321', 'a116.jpg', '2019-11-21', 'KTPM', 1),
(9, 'Nguyễn Thị B', 'thib@gmail.com', 'Hoàng Hoa Thám', '0987654321', 'a118.jpg', '2019-11-20', 'KTPM_K18A', 0),
(10, 'Nguyễn Văn BCD', 'bc@gmail.com', 'Khánh Hoà', '0987654321', 'a120.jpg', '2019-11-20', 'KTMT_16A', 0),
(14, 'Hoàng Văn Hùng', 'hvh2@gmail.com', 'Thanh Hóa', '0987654321', 'a33.jpg', '2019-11-13', 'KTMT_12B', 1),
(17, 'Nguyễn Văn An', 'vanan@gmail.com', 'Lào Cai', '0987654321', 'a310.jpg', '2019-11-13', 'CNTT_K18D', 1),
(21, 'Ma Văn Hoàng', 'mvhoang@gmail.com', 'Thái Nguyên', '0987654321', 'a311.jpg', '2019-11-04', 'CNTT_K14C', 1),
(34, 'Lê Văn An', 'lva@gmail.com', 'Hoàng Hoa Thám', '0987471675', 'a129.jpg', '2019-11-04', 'KTPM_K15C', 1),
(36, 'admin', '1237654@gmail.com', '123123', '1231231231', 'a223.jpg', '2019-11-12', '123124', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Subjects`
--

CREATE TABLE `Subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Subjects`
--

INSERT INTO `Subjects` (`id`, `name`) VALUES
(1, 'Tư tưởng HCM'),
(2, 'Toán cao cấp 1'),
(3, 'Thể chất'),
(4, 'An ninh mạng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_faculty` (`subject_id`);

--
-- Chỉ mục cho bảng `JoinDetails`
--
ALTER TABLE `JoinDetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `Subjects`
--
ALTER TABLE `Subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `Course`
--
ALTER TABLE `Course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `JoinDetails`
--
ALTER TABLE `JoinDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `Subjects`
--
ALTER TABLE `Subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `Subjects` (`id`);

--
-- Các ràng buộc cho bảng `JoinDetails`
--
ALTER TABLE `JoinDetails`
  ADD CONSTRAINT `JoinDetails_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Student` (`id`),
  ADD CONSTRAINT `JoinDetails_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
