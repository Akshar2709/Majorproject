-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 05:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notesmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countrycode` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `countrycode`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 'India', '+91', NULL, NULL, NULL, NULL, b'00000000000'),
(3, 'USA', '+1', NULL, NULL, NULL, NULL, b'00000000000'),
(4, 'Pakistan', '+92', '2021-04-07 18:02:02', 27, '2021-04-07 18:03:38', 27, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `downloader` int(11) NOT NULL,
  `issellerhasalloweddownload` bit(1) NOT NULL,
  `attachmentpath` varchar(255) DEFAULT NULL,
  `isattachmentdownloaded` bit(11) NOT NULL,
  `attachmentdownloadeddate` datetime DEFAULT NULL,
  `ispaid` text NOT NULL,
  `purchasedprice` decimal(10,0) DEFAULT NULL,
  `notetitle` varchar(100) NOT NULL,
  `notecategory` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `noteid`, `seller`, `downloader`, `issellerhasalloweddownload`, `attachmentpath`, `isattachmentdownloaded`, `attachmentdownloadeddate`, `ispaid`, `purchasedprice`, `notetitle`, `notecategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(38, 131, 11, 34, b'1', '../uploaded/11/131/Attachements/8_1617873656.pdf', b'00000000001', '2021-04-09 13:38:46', 'paid', '1500', 'Pokemon', '', '2021-04-09 12:06:01', 34, '2021-04-09 12:06:01', 34, b'00000000001'),
(41, 132, 34, 34, b'0', '../uploaded/34/132/Attachements/9_1617960589.pdf', b'00000000001', '2021-04-09 16:03:39', 'paid', '480', 'T Bagwell', 'boss', '2021-04-09 15:28:49', 34, '2021-04-09 15:28:49', 34, b'00000000001'),
(42, 132, 34, 11, b'1', '../uploaded/34/132/Attachements/9_1617960589.pdf', b'00000000001', '2021-04-09 15:31:22', 'paid', '480', 'T Bagwell', 'boss', '2021-04-09 15:29:54', 11, '2021-04-09 15:29:54', 11, b'00000000001'),
(44, 132, 34, 34, b'1', '../uploaded/34/132/Attachements/9_1617960589.pdf', b'00000000001', '2021-04-09 16:03:39', 'paid', '480', 'T Bagwell', 'boss', '2021-04-09 16:03:39', 34, '2021-04-09 16:03:39', 34, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descrption` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`id`, `name`, `descrption`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(14, 'Science', 'Science is best subject', '2021-04-10 12:28:09', 27, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descrption` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`id`, `name`, `descrption`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 'IT', 'IT is best profession', '2021-04-07 17:32:37', 27, '2021-04-10 12:28:46', 27, b'00000000000'),
(4, 'CE', 'CE is same as IT', '2021-04-07 17:48:07', 27, '2021-04-10 12:29:01', 27, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `datavalue` varchar(100) NOT NULL,
  `refcategory` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sellernotes`
--

CREATE TABLE `sellernotes` (
  `id` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `actionedby` int(11) NOT NULL,
  `adminremarks` varchar(255) NOT NULL,
  `publisheddate` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `displaypic` varchar(500) NOT NULL,
  `uploadnotes` varchar(500) NOT NULL,
  `notetype` varchar(255) NOT NULL,
  `noofpage` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `university` varchar(200) NOT NULL,
  `country` varchar(255) NOT NULL,
  `course` varchar(100) NOT NULL,
  `coursecode` varchar(100) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `ispaid` varchar(11) NOT NULL,
  `sellingprice` decimal(10,0) NOT NULL,
  `notespreview` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellernotes`
--

INSERT INTO `sellernotes` (`id`, `sellerid`, `status`, `actionedby`, `adminremarks`, `publisheddate`, `title`, `category`, `displaypic`, `uploadnotes`, `notetype`, `noofpage`, `description`, `university`, `country`, `course`, `coursecode`, `professor`, `ispaid`, `sellingprice`, `notespreview`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(38, 5, 1, 1, 'wow', '2021-03-05', 'john', 'category2', 'DSC_8487.JPG', '_DSC0186.JPG', 'type2', 0, '', '', 'india', '', '', '', '0', '0', '', NULL, NULL, NULL, NULL, b'0'),
(47, 5, 2, 1, 'wow', '2021-03-08', 'fish', 'category3', '20170929_175034_1509035378925.jpg', '2018_0328_155800_003_1522281813143.jpg', 'type1', 1000, 'Yeah fish you will be rich soon.', 'charusat', 'india', 'IT', 'IT1085', 'Jane', '0', '982', 'DSC_0046_1509035382522.jpg', NULL, NULL, NULL, NULL, b'0'),
(50, 11, 3, 1, 'wow', '2021-03-16', 'Breaking bad', 'Science', '../uploaded/11/50/17IT031-1.jpg', 'IMG_1329.JPG', 'IT', 250, 'The best series in the world...', 'harward', 'usa', 'CH', 'CH500', 'Maricruz', 'paid', '1250', '20170929_233910_1509035378890.jpg', NULL, NULL, '2021-04-11 10:54:21', 5, b'0'),
(51, 11, 4, 1, 'wow', '2021-03-22', 'spiderman', 'category2', 'IMG_1298.JPG', 'IMG_20180330_101705.jpg', 'type3', 875, 'hi spidey...', 'toronto', 'cananda', 'ME', 'ME875', 'Sara', 'paid', '5200', 'DSC_0046_1509035382522.jpg', NULL, NULL, NULL, 27, b'0'),
(53, 5, 4, 1, 'wow', '2021-03-23', 'habits', 'category1', 'WP_20140816_004.jpg', '2016-10-15_08.58.39.jpg', 'type2', 675, 'Your habits is very bad...', 'DDU', 'india', 'CH', 'CH758', 'Abruzzi', 'paid', '3000', 'DSC_0712.JPG', NULL, NULL, '2021-04-06 10:45:16', 27, b'0'),
(54, 5, 2, 1, 'wow', '2021-03-25', 'Vampire', 'category2', 'IMG20170521171154.jpg', 'DSC_0712.JPG', 'type1', 450, 'I came to you in dark for drinking your blood...', 'montreal', 'cananda', 'PY', 'PY512', 'Ghost layer', 'paid', '2950', 'DSC_0047.jpg', NULL, NULL, NULL, NULL, b'0'),
(65, 11, 1, 1, 'wow', '2021-03-31', 'Lucifer', 'category1', 'computer-science.png', 'customer-2.png', 'type2', 54, 'HELLO DECTECTIVE', 'charusat', 'india', 'CE', 'CE745', 'Detective', 'free', '0', 'search1.png', NULL, NULL, '2021-04-07 15:52:57', NULL, b'0'),
(131, 11, 3, 1, '', '2021-04-08', 'Pokemon', 'boss', '../uploaded/11/131/DP_1617873656.jpg', '../uploaded/11/131/Attachements/8_1617873656.pdf', 'CE', 500, 'This is very interesting.', 'GEC', 'USA', 'CE', 'CE745', 'Ash', 'paid', '1500', '../uploaded/11/131/Preview_1617873656.pdf', '2021-04-08 14:50:56', 11, '2021-04-08 14:50:56', NULL, b'1'),
(132, 34, 3, 1, '', '2021-04-09', 'T Bagwell', 'Science', '../uploaded/34/132/DP_1617960588.jpg', '../uploaded/34/132/Attachements/9_1617960589.pdf', 'IT', 250, 'He is very bad guy.', 'oxford', 'USA', 'IT', 'IT1085', 'Bellick', 'paid', '480', '../uploaded/34/132/Preview_1617960589.pdf', '2021-04-09 14:59:48', 34, '2021-04-09 14:59:48', NULL, b'1'),
(135, 11, 0, 1, '', '2021-04-10', 'Laws of Motion', 'Science', '../uploaded/11/135/DP_1618038127.jpg', '../uploaded/11/135/Attachements/10_1618038127.pdf', 'IT', 2250, 'The Laws of Motion is most useful in this world.', 'harward', 'USA', 'Physics', 'PY512', 'Newton', 'free', '0', '../uploaded/11/135/Preview_1618038127.pdf', '2021-04-10 12:32:07', 11, '2021-04-10 12:32:07', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesattachment`
--

CREATE TABLE `sellernotesattachment` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellernotesattachment`
--

INSERT INTO `sellernotesattachment` (`id`, `noteid`, `filename`, `filepath`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(8, 131, '8_1617873656pdf', '../uploaded/11/131/Attachements/8_1617873656.pdf', '2021-04-08 14:50:56', 11, NULL, NULL, b'00000000001'),
(9, 132, '9_1617960589pdf', '../uploaded/34/132/Attachements/9_1617960589.pdf', '2021-04-09 14:59:49', 34, NULL, NULL, b'00000000001'),
(10, 135, '10_1618038127pdf', '../uploaded/11/135/Attachements/10_1618038127.pdf', '2021-04-10 12:32:07', 11, NULL, NULL, b'00000000001'),
(11, 50, '11_1617873656.pdf', '../uploaded/11/50/Attachements/11_1617873656.pdf', '2021-04-10 13:50:51', NULL, NULL, NULL, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreport`
--

CREATE TABLE `sellernotesreport` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `reportedbyid` int(11) NOT NULL,
  `againstdownloadid` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `createddate` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` int(11) DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellernotesreport`
--

INSERT INTO `sellernotesreport` (`id`, `noteid`, `reportedbyid`, `againstdownloadid`, `remarks`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 38, 27, 0, 'Bad content', NULL, NULL, 0, NULL, b'00000000000');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesview`
--

CREATE TABLE `sellernotesview` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `reviewedbyid` int(11) NOT NULL,
  `againstdownloadid` int(11) NOT NULL,
  `ratings` decimal(10,0) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellernotesview`
--

INSERT INTO `sellernotesview` (`id`, `noteid`, `reviewedbyid`, `againstdownloadid`, `ratings`, `comments`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 0, 5, 0, '1', 'herer...', NULL, NULL, NULL, NULL, b'00000000000'),
(2, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(3, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(4, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(5, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(6, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(7, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(8, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(9, 0, 5, 0, '1', 'here...', NULL, NULL, NULL, NULL, b'00000000000'),
(10, 50, 11, 0, '1', 'hi frnds', NULL, NULL, NULL, NULL, b'00000000000'),
(11, 50, 11, 0, '1', 'hi', NULL, NULL, NULL, NULL, b'00000000000'),
(12, 50, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(13, 50, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(14, 50, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(15, 50, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(16, 50, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(17, 50, 11, 0, '1', 'hello', NULL, NULL, NULL, NULL, b'00000000000'),
(18, 65, 11, 0, '1', '', NULL, NULL, NULL, NULL, b'00000000000'),
(19, 65, 11, 0, '1', 'You do not update your profile.', NULL, NULL, NULL, NULL, b'00000000000'),
(20, 132, 11, 0, '2', 'great', '2021-04-12 10:26:48', 11, NULL, NULL, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfiguration`
--

CREATE TABLE `systemconfiguration` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `secemail` varchar(100) DEFAULT NULL,
  `phoncountry` int(11) NOT NULL,
  `phoneno` int(11) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `university` varchar(100) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `userid`, `dob`, `gender`, `secemail`, `phoncountry`, `phoneno`, `profilepic`, `address1`, `address2`, `city`, `state`, `zipcode`, `country`, `university`, `college`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(68, 5, '1998-01-01', 'male', 'johnwick@gmail.com', 1, 123456789, 'IMG_1222.JPG', 'asdfghjkl', 'zxcvbnm', 'Ahmedabad', 'Gujarat', 380001, 'India', 'Charusat', '', NULL, NULL, NULL, NULL, b'00000000000'),
(70, 27, '1200-01-01', 'male', 'akshargothi70@gmail.com', 92, 2147483647, 'DSC_8487.JPG', '12am', '', 'dark ', 'shadow', 0, 'hell', 'lucifer', '', NULL, NULL, NULL, NULL, b'00000000000'),
(72, 11, '0000-00-00', 'male', 'henry123@gmail.com', 91, 0, '../uploaded/11/PP_1617894415.jpg', '', '', '', '', 0, '', '', '', NULL, NULL, NULL, NULL, b'00000000000'),
(74, 36, '0000-00-00', '', NULL, 1, 2147483647, '', '', NULL, '', '', 0, '', NULL, NULL, '2021-04-08 10:08:45', 5, '2021-04-08 10:10:19', 5, b'00000000001');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`roleid`, `rolename`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, b'00000000000'),
(2, 'user', NULL, NULL, NULL, NULL, b'00000000000'),
(3, 'superadmin', NULL, NULL, NULL, NULL, b'00000000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `emailID` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isemailverified` bit(1) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleid`, `firstname`, `lastname`, `emailID`, `password`, `isemailverified`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(5, 1, 'John', 'Wick', 'johnwick@gmail.com', '$2y$10$iusesomecrazystrings2u2GTfhqG.HiJaARd/RK/LlWtccm2JOKy', b'0', NULL, NULL, NULL, NULL, b'00000000000'),
(11, 2, 'sara', 'tancredi', 'henry123@gmail.com', '$2y$10$iusesomecrazystrings2u2GTfhqG.HiJaARd/RK/LlWtccm2JOKy', b'0', NULL, NULL, NULL, NULL, b'00000000000'),
(27, 3, 'ronak', 'patel', 'akshargothi5678@gmail.com', '$2y$10$iusesomecrazystrings2u2GTfhqG.HiJaARd/RK/LlWtccm2JOKy', b'1', NULL, NULL, NULL, NULL, b'00000000000'),
(29, 3, 'dardevil', 'vampire', 'akshargothi70@gmail.com', '$2y$10$iusesomecrazystrings2ur1Po0z7KMYwNdnEcscfA4tx3PoIEsm2', b'1', NULL, NULL, '2021-04-08 09:42:02', 5, b'00000000000'),
(34, 2, 'Michael', 'Scofield', 'michealscofield198@gmail.com', '$2y$10$iusesomecrazystrings2u2GTfhqG.HiJaARd/RK/LlWtccm2JOKy', b'0', '2021-04-08 10:01:40', 5, NULL, NULL, b'00000000001'),
(36, 3, 'akshar', 'gothi', '111@gmail.com', '', b'0', '2021-04-08 10:08:45', 5, '2021-04-08 10:10:19', 5, b'00000000001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellernotesattachment`
--
ALTER TABLE `sellernotesattachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellernotesreport`
--
ALTER TABLE `sellernotesreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellernotesview`
--
ALTER TABLE `sellernotesview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `sellernotesattachment`
--
ALTER TABLE `sellernotesattachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellernotesreport`
--
ALTER TABLE `sellernotesreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellernotesview`
--
ALTER TABLE `sellernotesview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
