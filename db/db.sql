-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jbp`
--
DROP DATABASE IF EXISTS jbp;
CREATE DATABASE jbp;
USE jbp;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
    `app_id` int(11) NOT NULL,
    `job_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `date_of_application` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
    `user_id` int(11) NOT NULL,
    `org_name` varchar(100) NOT NULL,
    `creation_date` date NOT NULL,
    `industry` varchar(50) DEFAULT NULL,
    `tag_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tag_ids`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_req`
--

CREATE TABLE `job_req` (
    `job_id` int(11) NOT NULL,
    `job_title` varchar(100) NOT NULL,
    `job_description` text NOT NULL,
    `user_id` int(11) NOT NULL,
    `responsibility` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsibility`)),
    `experience` varchar(100) DEFAULT NULL,
    `benefits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`benefits`)),
    `vacancy` int(11) DEFAULT NULL,
    `status` enum('Full-Time','Part-Time','Contract') NOT NULL,
    `job_location` varchar(255) DEFAULT NULL,
    `salary` decimal(10,2) DEFAULT NULL,
    `gender` enum('Male','Female','Other','Any') DEFAULT NULL,
    `application_deadline` date DEFAULT NULL,
    `published_on` datetime NOT NULL DEFAULT current_timestamp(),
    `featured_image` varchar(255) DEFAULT "./images/bm_office_chat.svg"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_seekers`
--

CREATE TABLE `job_seekers` (
    `user_id` int(11) NOT NULL,
    `fname` varchar(50) NOT NULL,
    `lname` varchar(50) NOT NULL,
    `date_of_birth` date NOT NULL,
    `occupation` varchar(50) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `cv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
    `tag_id` int(11) NOT NULL,
    `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `user_id` int(11) NOT NULL,
    `profile_pic` varchar(255) DEFAULT "./uploads/profile_pic/check-mark.png",
    `email` varchar(255) NOT NULL,
    `passwd` varchar(255) NOT NULL,
    `username` varchar(50) NOT NULL,
    `usertype` enum('JobSeeker','Employer','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
    ADD PRIMARY KEY (`app_id`),
    ADD KEY `job_id` (`job_id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
    ADD PRIMARY KEY (`user_id`),
    ADD UNIQUE KEY `org_name` (`org_name`);

--
-- Indexes for table `job_req`
--
ALTER TABLE `job_req`
    ADD PRIMARY KEY (`job_id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `job_seekers`
--
ALTER TABLE `job_seekers`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
    ADD PRIMARY KEY (`tag_id`),
    ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
    ADD UNIQUE KEY `email` (`email`),
    ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
    MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_req`
--
ALTER TABLE `job_req`
    MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
    MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
    ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_req` (`job_id`),
    ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seekers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
    ADD CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_req`
--
ALTER TABLE `job_req`
    ADD CONSTRAINT `job_req_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_seekers`
--
ALTER TABLE `job_seekers`
    ADD CONSTRAINT `job_seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `passwd`, `username`, `usertype`) VALUES
(1, 'facolyjaq@mailinator.com', '$2y$10$sYwC/i1wDSu64NgCib4epuaSn5Kv9vAvYWEk/eeM4dc4A5x3m7zlW', 'zyzozaqo', 'Employer'),
(2, 'zonihugyle@mailinator.com', '$2y$10$In.XsNGsJ5RWzoe/VHycguGQobeqxCNL2DAfLTyFwmgsd6qCMXwPW', 'xagyj', 'JobSeeker'),
(3, 'delali.nsiah@ashesi.edu.gh', '$2y$10$jrByyOfR4lBRMEzS9en6q.9tCBcTWKmjRYoMqIrzCvRzRkKoU/uDC', 'purpgem', 'JobSeeker'),
(4, 'delalinsiah.asare@gmail.com', '$2y$10$zVMdV0IjrJpLloeKvxPNa.tdgVZEMOTJGGVPJ23oSWgcTbLfIrszm', 'purpgem2', 'Employer');

--
-- Dumping data for table `job_seekers`
--

INSERT INTO `job_seekers` (`user_id`, `fname`, `lname`, `date_of_birth`, `occupation`, `description`, `cv`) VALUES
(2, 'Tatiana', 'Gordon', '1977-05-18', 'Voluptas illo ea quos mollit enim aliqua', 'Voluptate aliquid li', NULL),
(3, 'Kwesi', 'Kumi', '2003-11-09', 'Student', 'Ashesi Uni', NULL);

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_name`) VALUES
('Education'),
('Engineering'),
('Finance'),
('Healthcare'),
('Human Resources'),
('Marketing'),
('Research'),
('Technology');

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`user_id`, `org_name`, `creation_date`, `industry`, `tag_ids`) VALUES
(1, 'Y3-FAST', '2024-07-28', 'Web Technology', '[\"5\",\"8\"]'),
(4, 'dry pie', '2024-07-28', 'Web Technology', '[\"3\",\"6\",\"7\",\"8\"]');

--
-- Dumping data for table `job_req`
--

INSERT INTO `job_req` (`job_title`, `job_description`, `user_id`, `responsibility`, `experience`, `benefits`, `vacancy`, `status`, `job_location`, `salary`, `gender`, `application_deadline`, `published_on`) VALUES
('Product Designer', 'UI/UX Designer', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Back-End Developer', 'JS, PHP, SQL', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Back-End Developer', 'JS, PHP, SQL', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Product Designer', 'UI/UX Designer', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Back-End Developer', 'JS, PHP, SQL', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Product Designer', 'UI/UX Designer', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Back-End Developer', 'JS, PHP, SQL', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15'),
('Product Designer', 'UI/UX Designer', 4, '[\"res1\",\"res2\",\"res3\"]', '1', '[\"benefit1\",\"benefit2\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
