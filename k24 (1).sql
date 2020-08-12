-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 12, 2020 at 12:46 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k24`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `description` text NOT NULL,
  `call_link` text DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `recurring` int(11) DEFAULT NULL,
  `dow` varchar(255) DEFAULT NULL,
  `pretest_id` int(11) DEFAULT NULL,
  `posttest_id` int(11) DEFAULT NULL,
  `class_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `description`, `call_link`, `start_time`, `end_time`, `start_date`, `end_date`, `recurring`, `dow`, `pretest_id`, `posttest_id`, `class_status`) VALUES
(4, 'edited', 'bb', 'https://meet.google.com/pxx-cqow-ztd', '16:45:00', '19:45:00', '2020-07-31', '2020-07-31', 1, '123', 28, 29, 2),
(5, 'bb', 'bb', 'https://codeigniter.com/user_guide/libraries/sessions.html', '16:45:00', '19:45:00', '2020-07-23', '2020-07-30', 2, '123', 30, 31, 2),
(6, 'aaa', 'aaa', 'https://codeigniter.com/user_guide/libraries/sessions.html', '16:52:00', '19:52:00', '2020-07-24', '2020-07-31', 1, '135', 32, 33, 2),
(7, 'aaa', 'aaa', 'https://codeigniter.com/user_guide/libraries/sessions.html', '16:54:00', '18:54:00', '2020-07-22', '2020-07-29', 1, '147', NULL, NULL, 2),
(8, 'expired Test', 'check if it\'s valid tomorrow', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '19:05:00', '20:05:00', '2020-07-22', '2020-07-22', 1, '3', NULL, NULL, 2),
(11, 'New test', 'hello ', 'https://www.google.com/search?safe=strict&rlz=1C5CHFA_enUS815US820&q=insert+query+in+codeigniter+example&sa=X&ved=2ahUKEwi3udzK_-TqAhVKdCsKHXnpB1EQ1QIoBHoECA0QBQ&biw=1366&bih=657', '13:00:00', '14:00:00', '2020-07-29', '2020-07-29', 1, '3', NULL, NULL, 2),
(12, 'class2', 'bla', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '16:24:00', '18:24:00', '2020-07-30', '2020-08-05', 1, 'NULL', NULL, NULL, 2),
(13, 'class1', 'aaa', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '17:00:00', '18:00:00', '2020-07-30', '2020-07-30', 1, NULL, NULL, NULL, 2),
(18, 'test', 'test', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '12:04:00', '13:04:00', '2020-08-07', '2020-08-07', 1, NULL, 34, 35, 2),
(19, 'another test', 'my first test', 'https://codeigniter.com/user_guide/libraries/sessions.html', '12:06:00', '13:06:00', '2020-08-08', '2020-08-08', 1, NULL, 36, 37, 2),
(20, 'abc', 'abc', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '10:34:00', '11:34:00', '2020-08-08', '2020-08-08', 1, NULL, 38, 39, 2),
(21, 'abcdef', 'abcdef', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '10:36:00', '11:00:00', '2020-08-09', '2020-08-15', 2, '25', 40, 41, 1),
(22, 'Math101 ', 'algebra', 'https://codeigniter.com/userguide3/libraries/form_validation.html#the-form', '10:56:00', '11:57:00', '2020-08-10', '2020-08-10', 1, NULL, 42, 43, 2),
(23, 'Science', 'cs1', 'https://codeigniter4.github.io/userguide/models/model.html', '19:00:00', '19:30:00', '2020-08-12', '2020-08-12', 1, NULL, 44, 45, 0),
(24, 'English 1', 'grammar', 'https://codeigniter4.github.io/userguide/models/model.html', '11:50:00', '12:50:00', '2020-08-13', '2020-08-20', 2, '15', 46, 47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hostRequest`
--

CREATE TABLE `hostRequest` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `request_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostRequest`
--

INSERT INTO `hostRequest` (`request_id`, `user_id`, `class_id`, `request_status`) VALUES
(1, 63, 0, 0),
(2, 4, 0, 0),
(3, 4, 0, 0),
(4, 4, 0, 0),
(5, 4, 0, 0),
(6, 4, 0, 0),
(7, 4, 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `note_name` text NOT NULL,
  `note_doc` blob NOT NULL,
  `note_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `class_id`, `note_name`, `note_doc`, `note_path`) VALUES
(5, 4, 'Note1', 0x746573742e706e67, '20200728/1595929447_d8a376190317501f9f90.png'),
(6, 4, 'Note2', 0x746573742e706e67, 'public/assets/test.png'),
(9, 4, 'THIS ONE', 0x746573742e706e67, '/opt/lampp/htdocs/k24/writable/uploads/20200729/'),
(10, 19, 'Note1', 0x313539363738373630375f30646637313337633065393363613632366261342e637376, '1596787607_0df7137c0e93ca626ba4.csv'),
(11, 19, 'pic', 0x313539363738373635385f39313333663038383235306635646266613533382e706e67, '1596787658_9133f088250f5dbfa538.png'),
(12, 21, 'note 1', 0x313539363836303239345f38346137623964643465393636376634643862632e706e67, '1596860294_84a7b9dd4e9667f4d8bc.png'),
(13, 21, 'note 3', 0x313539363838333333375f37613066306561336634646134613033623066612e706e67, '1596883337_7a0f0ea3f4da4a03b0fa.png'),
(15, 22, 'note 1', 0x313539363935343135325f39633534353037653236333137323962333338612e70707478, '1596954152_9c54507e2631729b338a.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `option_desc` text NOT NULL,
  `ans` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_desc`, `ans`) VALUES
(1, 1, 'a', 1),
(3, 1, 'b', 0),
(4, 1, 'c', 0),
(5, 1, 'd', 0),
(37, 6, '1', 0),
(38, 6, '2', 1),
(47, 38, 'e', 0),
(48, 38, 'a', 0),
(49, 38, 'bbb', 1),
(50, 38, 'd', 0),
(98, 6, '3', 0),
(99, 7, 'salmon', 1),
(100, 7, 'cow', 0),
(101, 7, 'chicken', 0),
(102, 7, 'cat', 0),
(103, 31, 'yes', 1),
(104, 31, 'no', 0),
(105, 37, 'rachael', 1),
(106, 37, 'matt', 0),
(107, 44, 'a', 1),
(108, 44, 'b', 0),
(109, 44, 'c', 0),
(111, 53, 'hello', 0),
(112, 54, 'hi', 1),
(113, 56, 'yes', 1),
(114, 57, '17 aug', 1),
(115, 57, '20 aug', 0),
(116, 57, '12', 0),
(117, 58, 'trump', 1),
(118, 58, 'obama', 0),
(119, 58, 'biden', 0),
(120, 59, 'yes', 1),
(121, 59, 'no', 0),
(122, 60, 'hello!', 1),
(123, 60, 'hi hi ', 0),
(124, 61, 'php', 1),
(125, 61, 'java', 0),
(126, 61, 'python', 0),
(127, 62, 'a', 1),
(128, 62, 'link', 0),
(129, 62, 'action', 0);

-- --------------------------------------------------------

--
-- Table structure for table `perms`
--

CREATE TABLE `perms` (
  `perm_id` int(11) NOT NULL,
  `perm_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perms`
--

INSERT INTO `perms` (`perm_id`, `perm_name`) VALUES
(1, 'View all reports'),
(2, 'Manage Role'),
(3, 'Membuat class'),
(4, 'Mengundang peserta masuk class'),
(6, 'Request host'),
(7, 'Create note'),
(8, 'Edit note'),
(9, 'View note'),
(10, 'Delete note'),
(11, 'Create test'),
(12, 'Edit test'),
(13, 'Take test'),
(14, 'View test score'),
(15, 'Join class'),
(16, 'Remove class'),
(17, 'Edit Class'),
(18, 'Approve Host Request'),
(19, 'Remove Peserta from class');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(255) NOT NULL,
  `test_id` int(255) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `test_id`, `question`) VALUES
(1, 28, 'What is first letter of alphabet? '),
(6, 28, 'which is even'),
(7, 28, 'name of fish'),
(31, 29, 'is this fixed'),
(37, 29, 'whats your name'),
(38, 29, 'odd one out?'),
(44, 34, 'What is first letter of alphabet? '),
(53, 36, 'hello?'),
(54, 36, 'hi'),
(56, 37, 'is this fixed'),
(57, 42, 'independence day? '),
(58, 42, 'president of usa'),
(59, 43, 'is this fixed'),
(60, 40, 'hello? '),
(61, 44, 'this website made with? '),
(62, 44, 'tag for links? ');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_desc`) VALUES
(1, 'Admin'),
(2, 'Host'),
(3, 'Peserta');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE `role_perm` (
  `role_perm_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` (`role_perm_id`, `role_id`, `perm_id`) VALUES
(119, 3, 9),
(120, 3, 13),
(121, 3, 14),
(122, 3, 15),
(276, 1, 1),
(277, 1, 2),
(278, 1, 3),
(279, 1, 4),
(280, 1, 6),
(281, 1, 7),
(282, 1, 8),
(283, 1, 9),
(284, 1, 10),
(285, 1, 11),
(286, 1, 12),
(287, 1, 14),
(288, 1, 15),
(289, 1, 16),
(290, 1, 17),
(291, 1, 18),
(292, 1, 19),
(293, 2, 3),
(294, 2, 4),
(295, 2, 6),
(296, 2, 7),
(297, 2, 8),
(298, 2, 9),
(299, 2, 10),
(300, 2, 11),
(301, 2, 12),
(302, 2, 14),
(303, 2, 15),
(304, 2, 17),
(305, 2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `total_score` int(255) DEFAULT 0,
  `test_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `test_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `class_id`, `total_score`, `test_date`, `start_time`, `end_time`, `duration`, `test_status`) VALUES
(28, 4, 3, '2020-07-29', '18:41:00', '18:45:00', 4, 1),
(29, 4, 3, '2020-07-28', '12:36:00', '12:47:00', 26598587, 3),
(30, 5, 0, NULL, NULL, NULL, 15, 1),
(31, 5, 0, '2020-07-30', '12:15:00', '12:45:00', 30, 2),
(32, 6, 0, NULL, NULL, NULL, 5, 1),
(33, 6, 0, '2020-07-31', '13:34:00', '13:25:00', 9, 2),
(34, 18, 1, '2020-08-05', '14:27:00', '15:27:00', 60, 1),
(35, 18, 0, NULL, NULL, NULL, 0, 2),
(36, 19, 2, NULL, NULL, NULL, 5, 3),
(37, 19, 1, '2020-08-05', '16:17:00', '16:21:00', 4, 3),
(38, 20, 0, NULL, NULL, NULL, 0, 3),
(39, 20, 0, NULL, NULL, NULL, 0, 3),
(40, 21, 0, NULL, NULL, NULL, 3, 1),
(41, 21, 0, NULL, NULL, NULL, 0, 2),
(42, 22, 2, NULL, NULL, NULL, 5, 3),
(43, 22, 1, '2020-08-11', '11:30:00', '11:40:00', 10, 3),
(44, 23, 2, NULL, NULL, NULL, 2, 3),
(45, 23, 0, NULL, NULL, NULL, 0, 3),
(46, 24, 0, NULL, NULL, NULL, 0, 1),
(47, 24, 0, NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(128) NOT NULL,
  `lname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT 3,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `user_status`) VALUES
(4, 'Peserta', 'Peserta', 'aks@gmail.com', '$2y$10$28eQouGcrr7Xg98dCQCO9O3rZy4KVdA2vo/6ra6qvppUJ8IkVHmyq', 3, '2020-07-17 14:29:25', '2020-07-17 14:29:25', 1),
(62, 'Rachael', 'Soh', 'rsoh@g.hmc.edu', '$2y$10$hWLRo1MYCCEoER5QC9HAx.NqAPL7gmh28kFiQSVW7kgMcjt2LkgNS', 1, '2020-07-18 09:13:00', '2020-07-18 09:13:00', 1),
(63, 'Host', 'Host', 'host@gmail.com', '$2y$10$TMhQTtC8l57D/wciKPvlDetpKS5zbeoAcnlt7zHM8jv47ydI3OzT2', 2, '2020-07-19 10:29:18', '2020-07-19 10:29:18', 1),
(64, 'ruddy', 'ruddy', 'RUDDY@GMAIL.COM', '$2y$10$.72FW8KNVLIY1A1w/HRpH.7g2Q5twy0KrNaIbKaF686pcOvkapDxe', 3, '2020-07-23 06:59:50', '2020-07-23 06:59:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_classes`
--

CREATE TABLE `user_classes` (
  `uc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `host` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_classes`
--

INSERT INTO `user_classes` (`uc_id`, `user_id`, `class_id`, `host`) VALUES
(1, 62, 4, 0),
(4, 4, 4, 0),
(5, 64, 4, 0),
(6, 63, 4, 0),
(8, 4, 18, 0),
(9, 4, 19, 1),
(10, 62, 19, 0),
(11, 62, 21, 1),
(12, 62, 22, 1),
(13, 63, 23, 1),
(15, 62, 24, 1),
(16, 4, 23, 0),
(17, 4, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE `user_scores` (
  `us_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `test_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_scores`
--

INSERT INTO `user_scores` (`us_id`, `user_id`, `class_id`, `test_id`, `score`, `test_status`) VALUES
(1, 4, 4, 28, 67, 1),
(2, 4, 4, 29, 100, 2),
(3, 4, 18, 34, 100, 1),
(4, 4, 18, 35, 0, 2),
(5, 4, 19, 36, 0, 1),
(6, 4, 19, 37, 0, 2),
(7, 62, 19, 36, 0, 1),
(8, 62, 19, 37, 50, 2),
(9, 62, 21, 40, NULL, 1),
(10, 62, 21, 41, NULL, 2),
(11, 4, 23, 44, 100, 1),
(12, 4, 23, 45, 0, 2),
(13, 4, 23, 44, NULL, 1),
(14, 4, 23, 45, NULL, 2),
(15, 4, 24, 46, NULL, 1),
(16, 4, 24, 47, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_test_answer`
--

CREATE TABLE `user_test_answer` (
  `uta_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_test_answer`
--

INSERT INTO `user_test_answer` (`uta_id`, `user_id`, `test_id`, `question_id`, `marks`) VALUES
(24, 4, 28, 1, 1),
(25, 4, 28, 6, 0),
(26, 4, 28, 7, 1),
(27, 4, 29, 31, 1),
(28, 4, 29, 37, 1),
(29, 4, 29, 38, 1),
(30, 4, 34, 44, 1),
(31, 4, 44, 61, 0),
(32, 4, 44, 62, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `hostRequest`
--
ALTER TABLE `hostRequest`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `perms`
--
ALTER TABLE `perms`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD PRIMARY KEY (`role_perm_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_classes`
--
ALTER TABLE `user_classes`
  ADD PRIMARY KEY (`uc_id`);

--
-- Indexes for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`us_id`);

--
-- Indexes for table `user_test_answer`
--
ALTER TABLE `user_test_answer`
  ADD PRIMARY KEY (`uta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hostRequest`
--
ALTER TABLE `hostRequest`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `perms`
--
ALTER TABLE `perms`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_perm`
--
ALTER TABLE `role_perm`
  MODIFY `role_perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user_classes`
--
ALTER TABLE `user_classes`
  MODIFY `uc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_test_answer`
--
ALTER TABLE `user_test_answer`
  MODIFY `uta_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
