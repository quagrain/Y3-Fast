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
    `date_of_application` datetime NOT NULL DEFAULT current_timestamp(),
    `status` enum('Accepted', 'Rejected', 'Pending') NOT NULL DEFAULT 'Pending'
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
(3, 'delali.nsiah@ashesi.edu.gh', '$2y$10$zVMdV0IjrJpLloeKvxPNa.tdgVZEMOTJGGVPJ23oSWgcTbLfIrszm', 'purpgem', 'JobSeeker'),
(4, 'delalinsiah.asare@gmail.com', '$2y$10$zVMdV0IjrJpLloeKvxPNa.tdgVZEMOTJGGVPJ23oSWgcTbLfIrszm', 'purpgem2', 'Employer');

--
-- Dumping data for table `job_seekers`
--

INSERT INTO `job_seekers` (`user_id`, `fname`, `lname`, `date_of_birth`, `occupation`, `description`, `cv`) VALUES
(2, 'Tatiana', 'Gordon', '1977-05-18', 'Voluptas illo ea quos mollit enim aliqua', 'Voluptate aliquid li', NULL),
(3, 'Kwesi', 'Kumi', '2003-11-09', 'Student', 'Ashesi Uni', './uploads/cv/Delali_Nsiah-Asare_Official_Resume.pdf');

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

INSERT INTO `job_req` (`job_id`, `job_title`, `job_description`, `user_id`, `responsibility`, `experience`, `benefits`, `vacancy`, `status`, `job_location`, `salary`, `gender`, `application_deadline`, `published_on`, `featured_image`) VALUES
(1, 'Senior UX/UI Designer', 'Lead the design of intuitive and visually appealing user interfaces for web and mobile applications', 4, '[\"Create user-centered designs by understanding business requirements\",\"Develop wireframes and prototypes\",\"Conduct user research and usability testing\"]', '5', '[\"Health insurance\",\"401(k) matching\",\"Professional development budget\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(2, 'Senior Back-End Developer', 'Design and implement scalable server-side applications using Node.js, Python, and SQL databases', 4, '[\"Develop RESTful APIs\",\"Optimize database queries for performance\",\"Implement security best practices\"]', '5', '[\"Flexible working hours\",\"Remote work options\",\"Stock options\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(3, 'Full Stack Developer', 'Build and maintain web applications using React, Node.js, and PostgreSQL', 4, '[\"Develop front-end using React and modern JavaScript\",\"Create server-side logic with Node.js\",\"Design and implement database schemas\"]', '3', '[\"Paid time off\",\"Health and wellness programs\",\"Continuing education stipend\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(4, 'Product Design Manager', 'Lead a team of designers in creating innovative product experiences', 4, '[\"Manage and mentor a team of designers\",\"Collaborate with cross-functional teams\",\"Define and implement design processes\"]', '7', '[\"Leadership training programs\",\"Generous parental leave\",\"Annual company retreat\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(5, 'DevOps Engineer', 'Implement and maintain CI/CD pipelines, cloud infrastructure, and monitoring systems', 4, '[\"Automate deployment processes\",\"Manage cloud infrastructure on AWS or Azure\",\"Implement monitoring and alerting systems\"]', '4', '[\"On-site gym membership\",\"Flexible work schedule\",\"Professional certification reimbursement\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(6, 'Mobile App Designer', 'Create engaging and intuitive mobile app interfaces for iOS and Android platforms', 4, '[\"Design user-friendly mobile interfaces\",\"Create prototypes and wireframes\",\"Collaborate with developers to ensure design feasibility\"]', '3', '[\"Gym membership reimbursement\",\"Unlimited PTO\",\"Home office stipend\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(7, 'Senior Python Developer', 'Develop and maintain complex Python applications for data processing and analysis', 4, '[\"Write efficient, testable, and reusable Python code\",\"Design and implement data processing pipelines\",\"Contribute to open-source Python projects\"]', '6', '[\"4-day work week\",\"Annual learning budget\",\"Company-sponsored hackathons\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(8, 'UX Researcher', 'Conduct user research to inform product design decisions and improve user experience', 4, '[\"Plan and conduct user research studies\",\"Analyze and report on research findings\",\"Work with designers to implement research insights\"]', '2', '[\"Flexible work hours\",\"Remote work options\",\"Conference attendance budget\"]', 3, 'Full-Time', 'Tema', 100.00, 'Any', '2024-08-11', '2024-08-04 03:27:15', './images/bm_office_chat.svg'),
(9, 'Database Administrator', 'Lead the design, implementation, and maintenance of company-wide database systems', 4, '[\"Optimize database performance and structure\",\"Implement backup and recovery procedures\",\"Ensure data security and compliance\"]', '8', '[\"Competitive salary\",\"Performance bonuses\",\"Comprehensive health coverage\"]', 3, 'Contract', 'Tema', 1230.00, 'Any', '2024-08-25', '2024-08-07 21:27:33', "./uploads/featured_img/delete.png"),
(10, 'Senior Full Stack Developer', 'Lead development of complex web applications using modern technologies', 4, '[\"Architect scalable web applications\",\"Mentor junior developers\",\"Implement best practices in code quality and testing\"]', '6', '[\"Stock options\",\"Flexible work arrangements\",\"Professional development opportunities\"]', 1, 'Contract', 'Airport Ridge', 1111.00, 'Male', '2024-09-01', '2024-08-07 21:44:37', './images/bm_office_chat.svg'),
(11, 'Senior Java Developer', 'Design and develop enterprise-level Java applications', 4, '[\"Develop high-performance Java applications\",\"Design and implement RESTful APIs\",\"Optimize application performance\"]', '5', '[\"Competitive salary\",\"Remote work options\",\"Health and dental insurance\"]', 3, 'Contract', 'Remote', 243.15, 'Male', '2024-08-28', '2024-08-07 21:52:31', './images/bm_office_chat.svg'),
(12, 'Senior Developer', 'WHAT PAYMENT? YOU WORK FOR FREE BRO!', 4, '[\"responsibility1\"]', '0', '[\"benefit1\"]', 1, 'Contract', 'Tema', 1.00, 'Any', '2024-08-25', '2024-08-07 23:25:09', './images/bm_office_chat.svg');

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`job_id`, `user_id`, `date_of_application`, `status`) VALUES
(12, 3, '2024-08-08 00:34:10', 'Accepted'),
(12, 2, '2024-08-08 01:34:10', 'Rejected'),
(9, 3, '2024-08-08 02:34:10', 'Pending');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
