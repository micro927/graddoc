-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2019 at 10:24 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graddoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `dear_to`
--

CREATE TABLE `dear_to` (
  `dear_to_id` tinyint(1) NOT NULL DEFAULT '0',
  `dear_to_title` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dear_to`
--

INSERT INTO `dear_to` (`dear_to_id`, `dear_to_title`) VALUES
(1, 'ผู้อำนวยการสำนักทะเบียนและประมวลผล'),
(2, 'หัวหน้าฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา'),
(3, 'รองผู้อำนวยการสำนักทะเบียนและประมวลผล'),
(4, 'บุคลากรในฝ่าย');

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `reg_num` smallint(5) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000',
  `gra_num` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `date` date NOT NULL,
  `fac_id` smallint(3) NOT NULL DEFAULT '0',
  `from_sub_num` varchar(15) NOT NULL,
  `from_run_num` varchar(15) DEFAULT NULL,
  `dear_to_id` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL,
  `staff_id` tinyint(1) NOT NULL,
  `status` bit(1) DEFAULT b'1' COMMENT '0 = คืน',
  `year_show` smallint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`reg_num`, `gra_num`, `date`, `fac_id`, `from_sub_num`, `from_run_num`, `dear_to_id`, `title`, `staff_id`, `status`, `year_show`) VALUES
(01555, 00908, '2019-02-18', 6, '', '742', 1, 'ขอลงทะเบียนเพื่อใช้บริการของมหาวิทยาลัยหลังกำหนดเป็นกรณีพิเศษ ภาค2/2561', 4, b'1', 2562),
(01552, 00905, '2019-02-18', 9, '.7.4.1', 'บศ.154', 1, 'ขอแก้ I - 1/61 - 600931001', 5, b'1', 2562),
(01553, 00906, '2019-02-18', 3, '', '344', 1, 'ขอแก้ I - 1/61 - 610331006', 5, b'1', 2562),
(01554, 00907, '2019-02-18', 2, '13', '54', 1, 'ขอลงทะเบียนเพื่อใช้บริการของมหาวิทยาลัยหลังกำหนดเป็นกรณีพิเศษ ภาค2/2561', 4, b'1', 2562),
(01514, 00902, '2019-02-18', 4, '', '355', 1, 'ขอลงทะเบียนเพื่อใช้บริการของมหาวิทยาลัยหลังกำหนดเป็นกรณีพิเศษ ภาค2/2561', 4, b'1', 2562),
(01515, 00903, '2019-02-18', 19, '', '0389', 1, 'ขอลงทะเบียนเพื่อใช้บริการของมหาวิทยาลัยหลังกำหนดเป็นกรณีพิเศษ ภาค2/2561', 4, b'1', 2562),
(01551, 00904, '2019-02-18', 21, '', '0403', 1, 'CMR54 - 4 ราย', 5, b'1', 2562);

-- --------------------------------------------------------

--
-- Table structure for table `fac`
--

CREATE TABLE `fac` (
  `fac_id` smallint(3) UNSIGNED ZEROFILL NOT NULL,
  `fac_name` varchar(70) NOT NULL,
  `fac_name_eng` varchar(255) DEFAULT '',
  `fac_doc_code` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='0=คณะ,1=หน่วยงานในมอ,2=นอกม,3=อื่นๆ';

--
-- Dumping data for table `fac`
--

INSERT INTO `fac` (`fac_id`, `fac_name`, `fac_name_eng`, `fac_doc_code`) VALUES
(002, 'คณะศึกษาศาสตร์', 'Education', '6593(15)'),
(003, 'คณะวิจิตรศิลป์', 'Fine Arts', '6593(12)'),
(004, 'คณะสังคมศาสตร์', 'Social Sciences', '6593(18)'),
(005, 'คณะวิทยาศาสตร์', 'Science', '6593(13)'),
(006, 'คณะวิศวกรรมศาสตร์', 'Engineering', '6593(14)'),
(007, 'คณะแพทยศาสตร์', 'Medicine', '6593(8)'),
(008, 'คณะเกษตรศาสตร์', 'Agriculture', '6593(2)'),
(009, 'คณะทันตแพทยศาสตร์', 'Dentistry', '6593(3)'),
(010, 'คณะเภสัชศาสตร์', 'Pharmacy', '6593(9)'),
(011, 'คณะเทคนิคการแพทย์', 'Associated Medical Sciences', '6593(4)'),
(012, 'คณะพยาบาลศาสตร์', 'Nursing', '6593(7)'),
(013, 'คณะอุตสาหกรรมเกษตร', 'Agro-Industry', '6593(20)'),
(014, 'คณะสัตวแพทยศาสตร์', 'Veterinary Medicine', '6593(19)'),
(015, 'คณะบริหารธุรกิจ', 'Business Administration', '6593(6)'),
(016, 'คณะเศรษฐศาสตร์', 'Economics', '6593(16)'),
(017, 'คณะสถาปัตยกรรมศาสตร์', 'Architecture', '6593(17)'),
(018, 'คณะการสื่อสารมวลชน', 'Mass Communication', '6593(1)'),
(019, 'คณะรัฐศาสตร์และรัฐประศาสนศาสตร์', 'Political Science and Public Administration', '6593(11)'),
(020, 'คณะนิติศาสตร์', 'Law', '6593(5)'),
(021, 'วิทยาลัยศิลปะ สื่อ และเทคโนโลยี', 'Arts, Media and Technology', '6593(21)'),
(099, 'บัณฑิตวิทยาลัย', 'Graduate School', '6593(23)'),
(025, 'สถาบันนโยบายสาธารณะ', 'School of Public Policy', '6593(-)'),
(026, 'สถาบันวิศวกรรมชีวการแพทย์', 'Biomedical Engineering Institute', '6593(-)'),
(022, 'คณะสาธารณสุขศาสตร์', 'Public Health', '6593(36)'),
(023, 'วิทยาลัยการศึกษาและการจัดการทางทะเล', 'College of Maritime Studies and Management', '6593(-)'),
(024, 'วิทยาลัยนานาชาตินวัตกรรมดิจิทัล', 'International College of Digital Innovation', '6593(22)'),
(101, 'กองคลัง', 'Financial Division', '6592(3)'),
(102, 'ธนาคารไทยพาณิชย์', 'Siam Commercial Bank', '----(-)'),
(001, 'คณะมนุษยศาสตร์', 'Humaninities', '6593(10)'),
(999, 'อื่นๆ', 'Others', '');

-- --------------------------------------------------------

--
-- Table structure for table `others_fac`
--

CREATE TABLE `others_fac` (
  `reg_num` smallint(5) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000',
  `year_show` smallint(4) NOT NULL DEFAULT '0',
  `fac_name` varchar(70) NOT NULL,
  `fac_code_full` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` tinyint(1) UNSIGNED NOT NULL,
  `staff_name` varchar(20) NOT NULL,
  `staff_surname` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_surname`) VALUES
(1, 'เสาวลักษณ์', 'สมบูรณ์ผล'),
(2, 'อรรถกร', 'คุณพันธ์'),
(3, 'ปราณี', 'อริยพฤกษ์'),
(4, 'ธิดาวรรณ', 'คุณพันธ์'),
(5, 'สิทธิพล', 'สกุลพรรณ์');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `reg_num` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `tips` varchar(250) NOT NULL,
  `year_show` smallint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dear_to`
--
ALTER TABLE `dear_to`
  ADD PRIMARY KEY (`dear_to_id`);

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`reg_num`,`year_show`);

--
-- Indexes for table `fac`
--
ALTER TABLE `fac`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `others_fac`
--
ALTER TABLE `others_fac`
  ADD PRIMARY KEY (`reg_num`,`year_show`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`reg_num`,`year_show`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
