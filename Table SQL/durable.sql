-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 10:18 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `durable`
--

CREATE TABLE `durable` (
  `id` int(6) NOT NULL,
  `du_id` varchar(20) NOT NULL,
  `cat_id` int(6) NOT NULL,
  `room_id` int(6) NOT NULL,
  `du_name` varchar(80) NOT NULL,
  `du_datein` date NOT NULL,
  `du_price` int(7) NOT NULL,
  `du_details` varchar(255) NOT NULL,
  `du_status` varchar(25) NOT NULL DEFAULT 'ปกติ',
  `du_bstatus` int(1) NOT NULL,
  `du_img` varchar(200) NOT NULL,
  `du_img_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `durable`
--

INSERT INTO `durable` (`id`, `du_id`, `cat_id`, `room_id`, `du_name`, `du_datein`, `du_price`, `du_details`, `du_status`, `du_bstatus`, `du_img`, `du_img_date`) VALUES
(1, '01.01.01', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703192032981453.png', '2017-04-11 20:16:52'),
(2, '01.01.02', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191635581604.png', '2017-04-11 20:16:52'),
(3, '01.01.03', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191698304697.png', '2017-04-11 20:16:52'),
(4, '01.01.04', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191189439837.png', '2017-04-11 20:16:52'),
(5, '01.01.05', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191258095449.png', '2017-04-11 20:16:52'),
(6, '01.01.06', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '20170319322325232.png', '2017-04-11 20:16:52'),
(7, '01.01.07', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703221717717822.png', '2017-04-11 20:16:52'),
(8, '01.01.08', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191077024934.png', '2017-04-11 20:16:52'),
(9, '01.01.09', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '201703191269350053.png', '2017-04-11 20:16:52'),
(10, '01.01.10', 2, 6, 'Lenovo IdeaPad', '2560-03-01', 17000, '- CPU Intel Core i5-5200U (2.20GHz Turbo Boost up to 2.70GHz) 3MB L3 Cache\r\n- การ์ดจอ AMD Radeon R5 M330 หน่วยความจำ 2 GB\r\n- Mobile Intel Express Chipset\r\n- 4 GB DDR3\r\n- HDD 1 TB 5400\r\n- DVD Writer (Dual Layer Support)\r\n- Battery 4 Cell Li-ion ใช้งานได้ต่', 'ปกติ', 0, '20170319632799843.png', '2017-04-11 20:16:52'),
(11, '02.02.01', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '201703191768458761.png', '2017-04-11 20:16:52'),
(12, '02.02.02', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '20170319850241183.png', '2017-04-11 20:16:52'),
(13, '02.02.03', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '201703191448412574.png', '2017-04-11 20:16:52'),
(14, '02.02.04', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '201703191800975219.png', '2017-04-11 20:16:52'),
(15, '02.02.05', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '201703191500381986.png', '2017-04-11 20:16:52'),
(16, '02.02.06', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '2017031983856422.png', '2017-04-11 20:16:52'),
(17, '02.02.07', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '20170319865953260.png', '2017-04-11 20:16:52'),
(18, '02.02.08', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '201703191015527278.png', '2017-04-11 20:16:52'),
(19, '02.02.09', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '20170319715859009.png', '2017-04-11 20:16:52'),
(20, '02.02.10', 3, 7, 'BenQ MW603 Projector', '2560-03-03', 21000, '- ความสว่าง : 3500 ANSI Lumens\r\n- ความละเอียด : 1280x800(WXGA) \r\n- ค่า Contrast : 13000:1 \r\n- ขนาดภาพ : 60-300 นิ้ว \r\n- ขนาดตัวเครื่อง : 311 x 104 x 244 มม.\r\n- การรับประกันตัวเครื่อง 2 ปี หลอดภาพ 1 ปีหรือ 1000 ชม.', 'ปกติ', 0, '20170319745030496.png', '2017-04-11 20:16:52'),
(21, '03.03.01', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319329665242.png', '2017-04-11 20:16:52'),
(22, '03.03.02', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319250328665.png', '2017-04-11 20:16:52'),
(23, '03.03.03', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '201703191377683692.png', '2017-04-11 20:16:52'),
(24, '03.03.04', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '201703191915492789.png', '2017-04-11 20:16:52'),
(25, '03.03.05', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319158042308.png', '2017-04-11 20:16:52'),
(26, '03.03.06', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319281784458.png', '2017-04-11 20:16:52'),
(27, '03.03.07', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '201703191664221645.png', '2017-04-11 20:16:52'),
(28, '03.03.08', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319243292675.png', '2017-04-11 20:16:52'),
(29, '03.03.09', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '2017031967728964.png', '2017-04-11 20:16:52'),
(30, '03.03.10', 5, 7, 'Brother BROTHER MFC-J200', '2560-03-03', 4490, 'ประเภทเครื่องพิมพ์ : InkJet\r\nPrint dpi : 1200 x 6000\r\nScan dpi : 1200 x 1200\r\nMemory : 64 MB', 'ปกติ', 0, '20170319851075521.png', '2017-04-11 20:16:52'),
(31, '04.04.01', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191910908184.png', '2017-04-11 20:16:52'),
(32, '04.04.02', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '20170319890088662.png', '2017-04-11 20:16:52'),
(33, '04.04.03', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191416429911.png', '2017-04-11 20:16:52'),
(34, '04.04.04', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '20170319504432191.png', '2017-04-11 20:16:52'),
(35, '04.04.05', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '20170319476830669.png', '2017-04-11 20:16:52'),
(36, '04.04.06', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191850043295.png', '2017-04-11 20:16:52'),
(37, '04.04.07', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191473695644.png', '2017-04-11 20:16:52'),
(38, '04.04.08', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191532241044.png', '2017-04-11 20:16:52'),
(39, '04.04.09', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '201703191500094893.png', '2017-04-11 20:16:52'),
(40, '04.04.10', 4, 7, 'ชุดไมโครโฟนไร้สาย', '2558-09-19', 25000, '- ตัวรับสัญญาณ\r\n- ไมโครโฟนไร้สายแบบถือ\r\n- ไมโครโฟนไร้สายแบบคลิบหนีบติดปกเสื้อ', 'ปกติ', 0, '20170319921105033.png', '2017-04-11 20:16:52'),
(41, '05.05.01', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '201703191752111675.png', '2017-04-11 20:16:52'),
(42, '05.05.02', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170409868618838.png', '2017-04-11 20:16:52'),
(43, '05.05.03', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170319286101553.png', '2017-04-11 20:16:52'),
(44, '05.05.04', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '201703192013564337.png', '2017-04-11 20:16:52'),
(45, '05.05.05', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170319354074364.png', '2017-04-11 20:16:52'),
(46, '05.05.06', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '201703191944856972.png', '2017-04-11 20:16:52'),
(47, '05.05.07', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '201703191571111265.png', '2017-04-11 20:16:52'),
(48, '05.05.08', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170319835051797.png', '2017-04-11 20:16:52'),
(49, '05.05.09', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170319383578354.png', '2017-04-11 20:16:52'),
(50, '05.05.10', 1, 9, 'คอมพิวเตอร์ตั้งโต๊ะ HP Pavition', '2557-05-03', 15000, 'P2-14132\r\n- CPU Core i3\r\n- RAM DDR3 6GB\r\n- HD 500GB 7200 RPM SATA\r\n- จอ LED 20 นิ้ว ยี่ห้อ HP\r\n- DVD-RW Super Multi\r\n- รับประกัน 1 ปี', 'ปกติ', 0, '20170319972407074.png', '2017-04-11 20:16:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `durable`
--
ALTER TABLE `durable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `durable`
--
ALTER TABLE `durable`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
