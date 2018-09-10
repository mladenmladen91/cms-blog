-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 09:35 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Java script'),
(3, 'PHP'),
(4, 'JAVA'),
(5, 'C#'),
(6, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(2555) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL,
  `author_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`, `author_image`) VALUES
(16, 47, 'ssagsag', 'jelovac@gmai.com', 'This is example of bootstrap and comment testing', 'approved', '2018-09-10', 'jasar.jpg'),
(17, 48, 'Mladen', 'jelovacmladen@gmail.com', 'Testiramo komentare', 'approved', '2018-09-10', '30715567_1798039386927498_3929360661649293312_n.jpg'),
(18, 50, 'JaÅ¡ar', 'jahmed@gmai.com', 'Java script je kompleksan jezik sa mnogo frameworka, koje se danas najviÅ¡e koriste. ', 'unapproved', '2018-09-10', 'jasar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `post_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`) VALUES
(2, 4, 13),
(4, 4, 35),
(5, 4, 34),
(10, 4, 44),
(11, 9, 3),
(12, 4, 3),
(13, 4, 46),
(14, 4, 48),
(15, 12, 48),
(16, 12, 50),
(17, 12, 49);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views`, `likes`) VALUES
(47, 1, 'Bootstrap', 'test', '', '2018-09-10', 'bootstrap.png', '<p>Bootstrap testin, testing. testing more</p>', 'bootstrap', 1, 'published', 12, 0),
(48, 4, 'Java', 'admin', '', '2018-09-10', 'java.jpg', '<p>java testing</p>', 'java', 1, 'published', 11, 2),
(49, 3, 'PHP', 'admin', '', '2018-09-10', 'php.png', '<p>PHP IS THE BEST PROGRAMMING LANGUAGE FOR WEB DEVELOPMENT</p>', 'PHP', 0, 'published', 3, 1),
(50, 2, 'Java script', 'admin', '', '2018-09-10', 'javascript.jpg', '<p>java script</p>', 'java script, test, testing', 1, 'published', 7, 1),
(51, 3, 'PHP', 'admin', '', '2018-09-10', 'php.png', '<p>php is a language for web</p>', 'PHP, programming', 0, 'published', 1, 0),
(52, 4, 'java', 'admin', '', '2018-09-10', 'java.jpg', '<p>jav,java,java</p>', 'java', 0, 'published', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_role`, `user_email`, `user_image`, `token`) VALUES
(4, 'admin', '$2y$12$TtG4qcb6FzJj37RUT9yEX.VQjN1QFHr1TnRdZu3WJ.DsUPaJsdW9C', 'Mladen', 'Jelovac', 'admin', 'jelovacmladen@gmail.com', '30715567_1798039386927498_3929360661649293312_n.jpg', ''),
(12, 'jaske', '$2y$12$kv4su1p6Iv07ClwGcvO9I.oHc7A52TO1L8fiNBVflSEVrl9apsI2C', 'JaÅ¡ar', 'JaÅ¡areviÄ‡', 'subscriber', 'jahmed@gmai.com', 'jasar.jpg', 'bc5def6240f22169546ba6c5e977a0db1a404871d12aa7dd136d22b5b20eeec03203cceb3752c0ddf4a03afab4f5a690e0dd');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(3) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'k1qakm1iqut86ddckrb7hak1an', 1534715840),
(2, '9fu7c3mtvg9tb2447so587jm1d', 1534691179),
(3, 'hefs9qmo5mr9viuiakq0385uml', 1534796505),
(4, 'a1us5l8s25gcf3ptj28ai5ht6d', 1534874799),
(5, 'fo7k5i3cgumm9nqplfok1c8hbr', 1534959341),
(6, '64fea1pf5270ar77irf9548daa', 1535140290),
(7, 'spts9dl79q2fcp7lpirnk0pvdf', 1535229230),
(8, 'biq316jofol4mvchr1m2f3kncl', 1535586047),
(9, '33lf0uj2f7ci3fvn4l3mbp3mh3', 1535628296),
(10, 's99mlk26hdkvomta04a422v604', 1535670831),
(11, 'hg25m0rb5vq0egi00739ht2vfh', 1535753318),
(12, '8o4o3qo9s23vuitnvqhkfcd925', 1536594305),
(13, '2b9kb8u09a6tjr1vj3erubfiqd', 1536596577),
(14, '3in4vfrrtkaj0j29ji4rha15cm', 1536598521),
(15, '2aqui2a13qdupjqtgvkv67iolf', 1536600070),
(16, 'nfdbsoa786ag0aa8mbaagd1ue4', 1536605904);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
