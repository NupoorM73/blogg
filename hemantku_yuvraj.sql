-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 05:46 PM
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
-- Database: `hemantku_yuvraj`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_download`
--

CREATE TABLE `tbl_download` (
  `download_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `course` text NOT NULL,
  `pdf` varchar(500) NOT NULL,
  `img` varchar(500) NOT NULL,
  `ppt` varchar(500) NOT NULL,
  `video_link` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_download`
--

INSERT INTO `tbl_download` (`download_id`, `title`, `course`, `pdf`, `img`, `ppt`, `video_link`, `created`, `status`) VALUES
(1, 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2021-02-23 12:26:56', 1),
(2, 'Test2', 'Test2', 'Assignment 1- SWOT Analysis _Self Introduction Part A_ - BCSL.pdf', 'M H K.png', 'Introduce Yourself.pptx', 'http://test.html', '2021-02-23 17:41:55', 1),
(3, 'Test3', 'Test3', '', 'f37a7b79bd64dafb534f3307d2ea8132112b3cb9-HemantKumbhar.jpg', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test.html', '2021-02-23 18:12:27', 1),
(4, 'Test3', 'Test3', '', 'f37a7b79bd64dafb534f3307d2ea8132112b3cb9-HemantKumbhar.jpg', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test.html', '2021-02-23 18:13:56', 1),
(5, 'Test4', 'Test4', '', 'f37a7b79bd64dafb534f3307d2ea8132112b3cb9-HemantKumbhar.jpg', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test.html', '2021-02-23 18:22:57', 1),
(6, 'Test4', 'Test4', '', 'cb3a5a950b1f3a1f9c72dcd47b62f5f6b0a88a92-Blooms level.png', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test.html', '2021-02-23 18:23:24', 1),
(7, 'Test5', 'Test5', '', '079c00693a8c4fef16b0a60dd4d965af76670dc3-SVPMLOGO.png', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test.html', '2021-02-23 18:26:31', 1),
(8, 'Test6', 'Test6', 'fe67d10481a55b5ed51b579e4939f2501179c96f-Assignment 1- SWOT Analysis Part B_ - BCSL.pdf', '69cd9eb0a686adfaf69b23d4773bd1be79eb3bec-fdp PBL-II.png', '', 'http://test6.html', '2021-02-23 18:39:09', 1),
(9, 'Test6', 'Test6', 'fe67d10481a55b5ed51b579e4939f2501179c96f-Assignment 1- SWOT Analysis Part B_ - BCSL.pdf', '69cd9eb0a686adfaf69b23d4773bd1be79eb3bec-fdp PBL-II.png', 'bff17d2f2588b315605ec09ffe59e471f8a49160-SWOT-Analysis.pptx', 'http://test6.html', '2021-02-23 18:39:35', 1),
(10, 'Test7', 'Test7', 'c44cc48e3c769b7b34c9c958902133ba3bca9dd3-BCSL - syllabus_for_SE Computer_Engg_Curriculum 2019_Course.pdf', '7890b7e43ad08b059359417f23e073e5997ca1b9-1611152109.jpg', '0f8d0dc5da516c8da2ab2edce153e1134c57a2db-Introduce Yourself.pptx', 'http://test7.html', '2021-02-23 18:45:00', 1),
(11, 'Test10', 'AI', '9ba48fb6214a9dc17f9b52112da9d4209c3f978d-6298_4.pdf', 'cb3a5a950b1f3a1f9c72dcd47b62f5f6b0a88a92-Blooms level.png', 'bff17d2f2588b315605ec09ffe59e471f8a49160-SWOT-Analysis.pptx', 'http://test6.html', '2021-02-25 11:53:52', 1),
(12, 'New Test 1', 'New', 'e66b776c5763f08bf26f6272bb6125f6a1c3585a-AI ML and Learning over secure data.pdf', '26c859c36dcbd00bed603148b049a3e58777be5b-praposed system.png', 'ab5005204797e76f5d0f25724ab0068c5a31b837-idea_ResearchPresentation.ppt', 'http://newtest7.html', '2021-03-21 13:02:29', 0),
(13, 'New Test 2', 'Successfully Edited ', 'e66b776c5763f08bf26f6272bb6125f6a1c3585a-AI ML and Learning over secure data.pdf', '1aa687b8d226b017de3b7e36038579ddc46ceed8-homomorphic-encryption-in-cloud-computing-final-15-638.jpg', 'ab5005204797e76f5d0f25724ab0068c5a31b837-idea_ResearchPresentation.ppt', 'http://newtest10.html', '2021-03-21 13:33:33', 1),
(14, 'New Test 2', 'New Test 2', '', '', '', 'http://newtest10.html', '2021-03-21 13:42:49', 0),
(15, 'Final Test', 'Final', '', '', '', 'http://testFinal.html', '2021-03-21 13:44:51', 0),
(16, 'National Series of Technical Webinar 2020', 'New Test 2222222222222fADAF', '', '', '', 'http://testFinal.html', '2021-03-21 13:46:56', 0),
(17, 'Final test 2', 'Final test 2asfadfdfad', '', '', '', 'Final test 2', '2021-03-21 13:50:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `access_level`, `access_code`, `status`) VALUES
(1, 'yuvrajparkale@gmail.com', 'admin', 'Admin', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_download`
--
ALTER TABLE `tbl_download`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_download`
--
ALTER TABLE `tbl_download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
