-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 09:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(1, 'Python', 'Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation.', '2021-04-22 16:19:53'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-or', '2021-04-22 16:21:03'),
(3, 'Django', 'Django is a Python-based free and open-source web framework that follows the model-template-views architectural pattern.', '2021-05-05 12:17:39'),
(4, 'Flask', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries. ', '2021-05-05 12:19:25'),
(5, 'C', 'C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system.', '2021-05-07 20:20:23'),
(6, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\".', '2021-05-07 20:32:35'),
(7, 'Java', 'Java is a class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.', '2021-05-07 20:33:38'),
(8, 'PHP', 'PHP is a general-purpose scripting language especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group.', '2021-05-07 20:35:25'),
(9, 'Kotlin', 'Kotlin is a cross-platform, statically typed, general-purpose programming language with type inference. Kotlin is designed to interoperate fully with Java, and the JVM version of Kotlin\'s standard library depends on the Java Class Library, but type infere', '2021-05-07 20:37:10'),
(10, 'Swift', 'Swift is a general-purpose, multi-paradigm, compiled programming language developed by Apple Inc. and the open-source community, first released in 2014.', '2021-05-07 20:38:04'),
(11, 'C#', 'C# is a general-purpose, multi-paradigm programming language encompassing static typing, strong typing, lexically scoped, imperative, declarative, functional, generic, object-oriented, and component-oriented programming disciplines.', '2021-05-07 20:40:28'),
(12, 'React', 'React is an open-source, front end, JavaScript library for building user interfaces or UI components. It is maintained by Facebook and a community of individual developers and companies. ', '2021-05-07 20:43:38'),
(13, 'Angular', 'Angular is a TypeScript-based open-source web application framework led by the Angular Team at Google and by a community of individuals and corporations.', '2021-05-07 20:43:50'),
(14, 'MySQL', 'MySQL is a relational database management system based on SQL – Structured Query Language. The application is used for a wide range of purposes, including data warehousing, e-commerce, and logging applications. ', '2021-05-07 20:49:07'),
(15, 'Node.js', 'Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that runs on the V8 engine and executes JavaScript code outside a web browser.', '2021-05-07 20:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` int(8) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(1, 'This is the first ever comment...', 1, 1, '2021-05-06 13:24:30'),
(2, 'Need a fix asap', 1, 2, '2021-05-06 13:38:46'),
(3, 'Need a fix asap', 1, 3, '2021-05-06 13:42:54'),
(5, 'Check out the documentation mate.', 2, 4, '2021-05-06 16:17:08'),
(6, 'Check the documentation', 7, 5, '2021-05-06 23:36:54'),
(7, 'What is the problem now ??', 7, 2, '2021-05-06 23:40:32'),
(8, 'Well it should work now buddy', 7, 4, '2021-05-06 23:41:16'),
(9, 'Read the documentation properly.', 1, 5, '2021-05-07 13:17:17'),
(11, 'There is a really simple fix', 1, 4, '2021-05-07 13:29:32'),
(12, 'There is a really simple fix', 1, 4, '2021-05-07 13:30:42'),
(13, 'Youtube tutorials are the best.', 5, 4, '2021-05-07 13:35:33'),
(14, 'Go for YouTube.', 10, 4, '2021-05-07 13:39:38'),
(15, 'Please somebody give an answer.', 11, 6, '2021-05-07 14:59:30'),
(16, 'Anybody here?', 11, 6, '2021-05-07 23:05:47'),
(17, 'Check the documentation.', 12, 6, '2021-05-08 09:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `t_id` int(7) NOT NULL,
  `t_title` varchar(255) NOT NULL,
  `t_desc` text NOT NULL,
  `t_cat_id` int(7) NOT NULL,
  `t_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`t_id`, `t_title`, `t_desc`, `t_cat_id`, `t_user_id`, `timestamp`) VALUES
(1, 'Unable to install Pyaudio', 'I am unable to install the pyaudio module in my system.', 1, 1, '2021-05-05 16:19:08'),
(2, 'Fetch API ', 'fdfngdnfgdfngdfgkfrig', 2, 2, '2021-05-06 12:02:12'),
(3, 'Fetch API ', 'erefefrer', 1, 3, '2021-05-06 12:08:20'),
(5, 'Learn Django', 'Learning django', 3, 4, '2021-05-06 12:09:55'),
(6, 'Python seekhna h', 'Kon bhadwa sikhayega humko .. koi h ', 1, 5, '2021-05-06 12:11:49'),
(7, 'callback', 'Async callback not responding', 2, 4, '2021-05-06 15:08:56'),
(10, 'Django Time', 'Need to learn django.', 3, 4, '2021-05-07 13:34:27'),
(11, 'Should python be learned in 2021?', 'Is it worthy to learn python.', 1, 6, '2021-05-07 14:58:40'),
(12, 'Async function', 'Call back not responding.', 2, 6, '2021-05-08 09:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(8) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `user_email`, `user_pass`, `timestamp`) VALUES
(1, 'akshay@google.com', 'akshay2', '2021-05-06 15:37:53'),
(2, 'a@a.com', '$2y$10$8Bmrw92B7csikQidxn/Ky.G6Ax3VPTsSh2hGFulCFQTSUJDaJPnH6', '2021-05-06 21:59:36'),
(3, 'ak@ak.com', '$2y$10$lS1avXv2oawianljmP7sNOhH41f0sEJZ6DTaVhHMsRnocHs6uwZKy', '2021-05-06 23:06:29'),
(4, 'ap@a.com', '$2y$10$r20pyBEzyFmUZT4SJH.UHejZcpMdQ2eXi94.3TE.lbtLgb4/XzdQ2', '2021-05-07 11:35:26'),
(5, 'hel@h.com', '$2y$10$0OsQC742pB1JDXyKD.D8Hu5zGlQTGM7pT4uaJz7coz.T7QH/pmfQK', '2021-05-07 11:42:24'),
(6, 'Akshay', '$2y$10$3rKgn7du.1hPpAggk6xSauH51veosPAgQlkBZpFDZ02piiU3GW4MK', '2021-05-07 14:56:38'),
(7, '', '$2y$10$iwIIviZvo.sgJei5gIgYguB2FaTndw3/Eaf6LlBoLC0fwqR52s2OW', '2021-05-08 16:21:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`t_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `t_title` (`t_title`,`t_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `t_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
