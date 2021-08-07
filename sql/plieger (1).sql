-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2021 at 05:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plieger`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `password`, `status`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@test.com', '$2y$10$I/oNfa20FKdYHK8qmpp8ieUbfw1wt0xKIh.9Af0jR7onrbQMPiH7.', 1, 1, 'joakIuplN5NXAdvhiHu4hRT6fUAPBB11sLVJqAV8AfN1VS5iniXWvSLsCeDl', '2020-11-18 21:19:51', '2020-12-19 20:59:13'),
(62, 'qw', 'qw', 'q@q.com', '$2y$10$3jgewjAIq/CmL8O2JxBCJebUddT6b7oON8W18cXbVET9D/FhI/KVG', 1, 1, NULL, '2021-08-06 10:07:19', '2021-08-06 10:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined_date` date NOT NULL,
  `job_position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_name`, `flag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dasd', '0', '1', '2021-08-06 10:07:54', '2021-08-06 10:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_assigned_task` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_reviewed_task` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `name`, `image_name`, `image_type`, `image_size`, `email`, `password`, `mobile_no`, `role_id`, `role_title`, `team_id`, `total_assigned_task`, `total_reviewed_task`, `address`, `flag`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Admin', 'no_image', 'png', NULL, 'admin@test.com', '$2y$10$NGqZTnlo8k5BZn.dc4dZRelwXsol2aFZmSKhnyKdp7tDXcWfKrQya', '9841111111', '1', NULL, '0', NULL, NULL, 'FourSymmetrons', '0', '1', '2020-11-18 21:22:48', '2020-11-18 21:22:48'),
(62, '62', 'qw', 'no_image', 'png', NULL, 'q@q.com', '$2y$10$3yvXQFm1LyiRDzKw.FnVDOS1MPqQKeLEYNSyuYxCio6BJSn9BxmaK', '9845705337', '1', NULL, '1', NULL, NULL, 'asda', '0', '1', '2021-08-06 10:07:20', '2021-08-06 10:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_06_02_064621_create_banners_tbl', 1),
(5, '2019_06_02_102034_create_menus_table', 1),
(6, '2019_06_02_110523_create_pages_table', 1),
(7, '2019_06_04_113834_create_news_events_table', 1),
(8, '2019_06_05_061632_create_gallery_categories_table', 1),
(9, '2019_06_05_103543_create_gallery_category_images_table', 1),
(10, '2019_06_06_061029_create_careers_table', 1),
(11, '2019_06_10_051200_create_calendars_table', 1),
(12, '2019_06_11_050837_create_contacts_table', 1),
(13, '2019_06_11_110431_create_welcome_table', 1),
(107, '2014_10_12_000000_create_users_table', 2),
(108, '2014_10_12_100000_create_password_resets_table', 2),
(109, '2017_07_29_093147_create_admins_table', 2),
(110, '2020_05_28_111156_create_empolyees_tbl', 2),
(111, '2020_10_09_065320_create_roles_tbl', 2),
(112, '2020_10_19_132200_create_teams_tbl', 2),
(113, '2020_10_20_053510_create_members_table', 2),
(114, '2020_10_20_121917_create_tasks_tbl', 2),
(115, '2020_10_29_123716_create_reviews_tbl', 2),
(116, '2020_11_05_103511_create_timesheets_tbl', 2),
(117, '2020_11_08_030943_create_records_table', 2),
(118, '2020_11_09_093629_create_jobs_tbl', 2),
(119, '2020_11_18_075856_create_team_work_status_tbl', 2),
(120, '2020_12_18_061905_add_reviewed_task_to_team_work_status_table', 1),
(121, '2021_08_06_015108_create_projects_table', 3),
(123, '2021_08_06_105322_add_project_id_to_tasks_tbl', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pliegerfeedback`
--

CREATE TABLE `pliegerfeedback` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `queries` longtext DEFAULT NULL,
  `feedback` longtext DEFAULT NULL,
  `status` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orgid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assign` int(11) DEFAULT NULL,
  `assign_cmplt` int(11) DEFAULT NULL,
  `reassign` int(11) DEFAULT NULL,
  `review` int(11) DEFAULT NULL,
  `review_cmplt` int(11) DEFAULT NULL,
  `issue` int(11) DEFAULT NULL,
  `finish` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_record`
--

CREATE TABLE `report_record` (
  `id` int(99) NOT NULL,
  `assigned_files` int(99) NOT NULL,
  `assigned_completed` int(99) NOT NULL,
  `teamleaders_reviewed` int(99) NOT NULL,
  `supervisors_reviewed` int(99) NOT NULL,
  `send_plieger` int(99) NOT NULL,
  `plieger_reviewed` int(99) NOT NULL,
  `uploaded_files` int(99) NOT NULL,
  `issue_files` int(99) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_assigned_member` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_assigned_date` date NOT NULL,
  `review_assigned_time` time NOT NULL,
  `review_finished_time` time DEFAULT NULL,
  `review_finished_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_member` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_date` date NOT NULL,
  `review_assigned_member` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finished_date` date DEFAULT NULL,
  `time_taken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_feedback` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'adasd', '1', '2021-08-06 10:06:27', '2021-08-06 10:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `team_work_status`
--

CREATE TABLE `team_work_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_assigned_task` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_leader_reviewed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_supervisor_reviewed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewed_task` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_work_status`
--

INSERT INTO `team_work_status` (`id`, `team_id`, `member_id`, `role_id`, `name`, `total_assigned_task`, `team_leader_reviewed`, `team_supervisor_reviewed`, `status`, `created_at`, `updated_at`, `reviewed_task`) VALUES
(1, '1', '62', '1', 'qw', NULL, NULL, NULL, '1', '2021-08-06 10:07:20', '2021-08-06 10:07:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `time_taken` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pliegerfeedback`
--
ALTER TABLE `pliegerfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_record`
--
ALTER TABLE `report_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tasks_task_name_unique` (`task_name`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_team_name_unique` (`team_name`);

--
-- Indexes for table `team_work_status`
--
ALTER TABLE `team_work_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `pliegerfeedback`
--
ALTER TABLE `pliegerfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_work_status`
--
ALTER TABLE `team_work_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
