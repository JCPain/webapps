-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 01:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

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
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(10, 'Bootstrap'),
(15, 'MySql'),
(16, 'HTML5'),
(32, 'MySqli'),
(39, 'OOP'),
(42, 'Javascript'),
(44, 'SQL');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(26, 26, 'Janie', 'janie@gmail.com', 'This is a comment, have a good night.', 'unapproved', '2020-03-21'),
(30, 26, 'Sandra', 'sandra2345@gmail.com', 'Just a test comment.', 'approved', '2020-03-29'),
(31, 28, 'Jane', 'jane@gmail.com', 'Hi, keep going', 'approved', '2020-04-03'),
(32, 28, 'Juan', 'juan234@gmail.com', 'the test comment is sent.', 'approved', '2020-04-03'),
(33, 28, 'peter', 'peter345@gmail.com', 'peter comment', 'unapproved', '2020-04-03'),
(34, 71, 'John Doe', 'johndoe@gmail.com', 'Test comment, test comment', 'unapproved', '2020-04-03'),
(35, 69, 'Cindy', 'cindy@gmail.com', 'Hi, please hang on, youre near', 'unapproved', '2020-04-03'),
(36, 69, 'Petet', 'pet@gmail.com', 'peteepeteepet.', 'unapproved', '2020-04-03'),
(42, 71, 'Andria', 'andria@gmail.com', 'Hi JC, Im chuckie', 'approved', '2020-04-05');

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
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(26, 10, 'Bootstrap1', 'JC Llaguno', '', '2020-04-01', 'image_3.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada diam tellus, et tempor odio pellentesque non. Ut eleifend dignissim augue. Phasellus ornare et ante sit amet auctor. Quisque dictum id massa eget auctor. In non orci eget diam faucibus fermentum sit amet ut nulla. Nunc dapibus nisl id quam elementum, id dapibus orci commodo. Aliquam ut lorem id nunc pretium venenatis vel ut enim. Nunc ante leo, vulputate a pulvinar vitae, vulputate et massa. Ut mollis risus sapien, nec lacinia nisi lacinia vitae. Fusce non dolor nec erat sagittis convallis vel vitae odio. Mauris egestas ante in ante molestie, in malesuada mi imperdiet. Sed erat arcu, pharetra in tincidunt et, aliquam id purus. Maecenas et commodo felis. Cras urna mi, blandit eget erat at, blandit egestas urna. Morbi id enim varius, efficitur est consequat, pulvinar augue. Integer sollicitudin nisl eget sagittis consequat.</p>', 'bootstrap, course, class, great', 5, 'published', 2),
(28, 42, 'Javascript', 'John Doe', '', '2020-03-28', 'image_5.jpg', '<p><strong>This is a test post.</strong></p>', 'javascript, course, class, great', 2, 'published', 1),
(30, 10, 'OOP', 'Jane Doe', '', '2020-03-29', 'image_4.png', '<p>This is a random post for testing purposes only.</p>', 'OOP, course, class, great', 0, 'published', 0),
(63, 10, 'OOP', 'Jane Doe', '', '2020-03-31', 'image_4.png', '<p>This is a random post for testing purposes only.</p>', 'OOP, course, class, great', 0, 'published', 1),
(64, 10, 'Javascript1', 'John Doe', '', '2020-04-01', 'image_5.jpg', '<p><strong>This is a test post.</strong></p>', 'javascript, course, class, great', 0, 'published', 0),
(65, 10, 'Bootstrap2', 'JC Llaguno', '', '2020-04-01', 'image_3.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada diam tellus, et tempor odio pellentesque non. Ut eleifend dignissim augue. Phasellus ornare et ante sit amet auctor. Quisque dictum id massa eget auctor. In non orci eget diam faucibus fermentum sit amet ut nulla. Nunc dapibus nisl id quam elementum, id dapibus orci commodo. Aliquam ut lorem id nunc pretium venenatis vel ut enim. Nunc ante leo, vulputate a pulvinar vitae, vulputate et massa. Ut mollis risus sapien, nec lacinia nisi lacinia vitae. Fusce non dolor nec erat sagittis convallis vel vitae odio. Mauris egestas ante in ante molestie, in malesuada mi imperdiet. Sed erat arcu, pharetra in tincidunt et, aliquam id purus. Maecenas et commodo felis. Cras urna mi, blandit eget erat at, blandit egestas urna. Morbi id enim varius, efficitur est consequat, pulvinar augue. Integer sollicitudin nisl eget sagittis consequat.</p>', 'bootstrap, course, class, great', 0, 'published', 1),
(66, 10, 'Bootstrap', 'JC Llaguno', '', '2020-04-01', 'image_3.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada diam tellus, et tempor odio pellentesque non. Ut eleifend dignissim augue. Phasellus ornare et ante sit amet auctor. Quisque dictum id massa eget auctor. In non orci eget diam faucibus fermentum sit amet ut nulla. Nunc dapibus nisl id quam elementum, id dapibus orci commodo. Aliquam ut lorem id nunc pretium venenatis vel ut enim. Nunc ante leo, vulputate a pulvinar vitae, vulputate et massa. Ut mollis risus sapien, nec lacinia nisi lacinia vitae. Fusce non dolor nec erat sagittis convallis vel vitae odio. Mauris egestas ante in ante molestie, in malesuada mi imperdiet. Sed erat arcu, pharetra in tincidunt et, aliquam id purus. Maecenas et commodo felis. Cras urna mi, blandit eget erat at, blandit egestas urna. Morbi id enim varius, efficitur est consequat, pulvinar augue. Integer sollicitudin nisl eget sagittis consequat.</p>', 'bootstrap, course, class, great', 0, 'published', 0),
(67, 42, 'Javascript', 'John Doe', '', '2020-04-01', 'image_5.jpg', '<p><strong>This is a test post.</strong></p>', 'javascript, course, class, great', 0, 'published', 0),
(68, 10, 'OOP', 'Jane Doe', '', '2020-04-01', 'image_4.png', '<p>This is a random post for testing purposes only.</p>', 'OOP, course, class, great', 0, 'published', 0),
(69, 10, 'OOP2', 'Jane Doe', '', '2020-04-01', 'image_4.png', '<p>This is a random post for testing purposes only.</p>', 'OOP, course, class, great', 0, 'published', 0),
(70, 42, 'Javascript', 'John Doe', '', '2020-04-01', 'image_5.jpg', '<p><strong>This is a test post.</strong></p>', 'javascript, course, class, great', 0, 'published', 0),
(71, 10, 'Bootstrap3', '', 'william', '2020-04-05', 'image_3.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada diam tellus, et tempor odio pellentesque non. Ut eleifend dignissim augue. Phasellus ornare et ante sit amet auctor. Quisque dictum id massa eget auctor. In non orci eget diam faucibus fermentum sit amet ut nulla. Nunc dapibus nisl id quam elementum, id dapibus orci commodo. Aliquam ut lorem id nunc pretium venenatis vel ut enim. Nunc ante leo, vulputate a pulvinar vitae, vulputate et massa. Ut mollis risus sapien, nec lacinia nisi lacinia vitae. Fusce non dolor nec erat sagittis convallis vel vitae odio. Mauris egestas ante in ante molestie, in malesuada mi imperdiet. Sed erat arcu, pharetra in tincidunt et, aliquam id purus. Maecenas et commodo felis. Cras urna mi, blandit eget erat at, blandit egestas urna. Morbi id enim varius, efficitur est consequat, pulvinar augue. Integer sollicitudin nisl eget sagittis consequat.</p>', 'bootstrap, course, class, great', 0, 'published', 2),
(75, 10, 'Test1', '', 'rico', '2020-04-05', 'image_4.png', '<p>This is just a test.</p>', 'OOP, course, class, great', 0, 'published', 0);

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
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(49, 'alex', '$2y$12$bADALZmg3/ruuo1LF/to9.RIpoPOV04fyw3q8ejbZ.VL1mFr42h4S', 'Alex', 'Peterson', 'alexcute@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(52, 'john', '$2y$12$HKHhQXCmC/G.vDpg9.glwuQld38F09aOYhvUACUz3uEQmM2uQsBLi', 'John', 'Juan', 'john@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(53, 'rico', '$2y$10$x44QGYnC7KwodcxnFiWD1.01CQGS4PB81snrfvgtd0.U7/u/23fOG', '', '', 'rico@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(54, 'william', '$2y$10$uwKh/QGvxQS/M9uqZfYfZuGBKjHnUhETG/ik4/JdZUgNCF0/RogNu', 'William', 'Doe', 'william@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '4mv8b1u7lko3vk4l2g7h7q2hgp', 1585787070),
(2, '1qpue737e986nggk5adetho91q', 1585786981),
(3, 'ho0l69i6gru4betdaf79t8nfgk', 1585791119),
(4, '7ua50rbcvjmad5b2s644g7nhlh', 1585789071),
(5, 'ih9pf6ael9u3m28fbcv0ogn4h0', 1585791115),
(6, '3kni9q6hed7ctmmrdqlilg0v2v', 1585829987),
(7, 'i8ekmitbovhefh6iup3s7sbrqv', 1585828878),
(8, '3s7lj0cv0od66b2ekdo5rli3nm', 1585842188),
(9, 's694558imuq5vldra8um1g5lq9', 1585837349),
(10, 'ocqu306pclvg40a61q37o7tjq4', 1585851213),
(11, 'om91s1b267p3ve83f7n7s4cq7a', 1585850842),
(12, 'lrrjk1mdbsbje9guh3nrcalbtt', 1585885472),
(13, 't0oq2ackui7g76hn3pd0pnf6hq', 1585883808),
(14, 'ugul3ic1fdevd325lsio52prm2', 1585910530),
(15, 'pflhless9qjnogta83k75204m9', 1585923415),
(16, 'hagk56e7c8b69vb1tk54v6gmdu', 1585935911),
(17, 'rlq964glnkvevnt5c9go6jgh4g', 1585964251),
(18, 'nu89cll64lpbh5dkmuiiejgg4v', 1585978076),
(19, 'u93ljl8ki685gv2s0bntsn6plj', 1586019150),
(20, 'bskpv63ivnj170j8jsbitgq5mu', 1586048135),
(21, 'm68dhkb0qpln79ieakrfcdhq67', 1586092156),
(22, 'sahiri9tvagso92bhi8jtg7s6j', 1586101217),
(23, 'nhav07h4d8dboaeni431usa7tt', 1586101576),
(24, '3if6s8qfq9b4vbmca6dhm8cbsb', 1586103983);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
