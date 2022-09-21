-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 02:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dash1`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ctime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servings` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingredients` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `ptime`, `ctime`, `servings`, `ingredients`, `instructions`, `cat`, `dt`, `created_at`, `updated_at`) VALUES
(4, 'kiwi lemon kooler', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl rhoncus mattis rhoncus urna. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Commodo ullamcorper a lacus vestibulum. Nibh praesent tristique magna sit amet purus gravida quis blandit.\n\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl rhoncus mattis rhoncus urna. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Commodo ullamcorper a lacus vestibulum. Nibh praesent tristique magna sit amet purus gravida quis blandit.', NULL, NULL, NULL, NULL, NULL, '', NULL, '2022-08-10 10:13:04', '2022-08-10 10:13:04'),
(5, 'kiwi lemon kooler', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl rhoncus mattis rhoncus urna. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Commodo ullamcorper a lacus vestibulum. Nibh praesent tristique magna sit amet purus gravida quis blandit.\n\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl rhoncus mattis rhoncus urna. Quam lacus suspendisse faucibus interdum posuere lorem ipsum. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Vitae proin sagittis nisl rhoncus mattis rhoncus. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Commodo ullamcorper a lacus vestibulum. Nibh praesent tristique magna sit amet purus gravida quis blandit.', NULL, NULL, NULL, NULL, NULL, '', NULL, '2022-08-10 10:13:07', '2022-08-10 10:13:07'),
(18, '1', 'message', '2', '22', NULL, 'Instructions', 'Instructions', '', NULL, '2022-09-13 12:32:18', '2022-09-13 12:32:18'),
(19, 'kiwi lemon kooler', '2', '2', '222', NULL, '2', '2', '', NULL, '2022-09-13 12:35:23', '2022-09-13 12:35:23'),
(20, 'Spicy Coconut Lentil Curry', 'I used a whole tablespoon but that was even less than intended. Thank Heavens I stopped there or that food would have not been edible by anyone in the household. But to reduce the heat from the meal, I added lemon juice. It neutralizes the pH levels of spicy food and reduce some of that flaming-hot flavor. If you haven’t tried before, it actually works! If you are not a chilli person, you can totally omit the chilli.\r\n\r\nThis badass Spicy Coconut Lentil Curry is super easy to make. I mean, 20 minute cook time!! You will leave that plate cleaner than how you got it form your cupboard. For those who don’t like cooking every meal time, make a big batch and save it for the next day. It tastes even better!', '10', '20', NULL, 'ee', 'ee', '', NULL, '2022-09-13 12:37:29', '2022-09-13 12:37:29'),
(21, 'apple slices with peanut butter', '<p><span style=\"background-color: rgb(229, 227, 215); color: rgb(0, 0, 0);\">Apple Slices with Peanut Butter is a combination that has always worked! Not only is it sweet, creamy and fresh, it works as a healthy snack! It is also totally customizable! Top with your preferred nuts, seeds or dried fruit. I like mine plain with smooth peanut butter, no toppings required. Sounds a bit boring but it hits the spot.</span></p><p><span style=\"background-color: rgb(229, 227, 215); color: rgb(0, 0, 0);\"><span class=\"ql-cursor\">﻿</span>You can totally change peanut butter with any other nut butter if peanut butter is not your thing. Can you imagine that I haven’t made peanut butter before? Actually I have but the consistency wasn’t what I wanted. I wanted extra smooth peanut butter like Skippy. I am sure most if not all of you know of that peanut butter. That peanut butter was lit! It actually still is but the price is rather steep for 500ml. I went shopping a few weeks ago since I had such a craving for that exact brand but after I saw the price, I went for another option which was pocket friendly.</span></p>', '2', '3', NULL, '<ul><li>2&nbsp;Apples</li><li>Peanut Butter</li></ul><p><br></p>', '<ol><li>Cut the apples into slices and spread peanut butter on each slice.</li></ol><p><br></p>', '', NULL, '2022-09-14 06:39:19', '2022-09-14 06:39:19'),
(22, 'kiwi lemon kooler', '<p>Desc</p>', '23', '5', NULL, '<p>Ingred</p>', '<p>Instruc</p>', 'Cat', '2022-09-07', '2022-09-20 13:33:30', '2022-09-20 13:33:30'),
(23, 'kiwi lemon kooler', '<p>Desc</p>', '23', '5', NULL, '<p>Ingred</p>', '<p>Instruc</p>', 'cat', '2022-09-07', '2022-09-20 13:34:56', '2022-09-20 13:34:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
