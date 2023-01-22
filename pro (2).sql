-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2022 at 11:37 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_22_092726_create_products_table', 1),
(6, '2022_09_27_134306_add_status_to_products_table', 2),
(7, '2022_09_28_074111_create_sliders_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 is hide and 1 is show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `barcode`, `price`, `details`, `created_at`, `updated_at`, `status`) VALUES
(25, 'برفاااااان', '16638399241249632c2eb4b8b1d.jpg', '11111', 4000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه\r\n                                ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا\r\n                                سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-28 11:58:25', 1),
(26, 'برفان رجالي', '1663839974108632c2ee67fe1b.jpg', '22222', 7000.00, ' الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه\n                                ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا\n                                سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(27, 'زجاجه برفان', '16641858828296331761aaf37e.jpg', '33333', 5000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(28, 'لابتوب ديل', '1664198717556331a83d65a8c.jpg', '44444', 5000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(29, 'لابتوب hp', '166420114111826331b1b5afba5.jpg', '55555', 6000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(30, 'لابتوب ماك', '16642039654846331bcbd895a5.jpg', '66666', 7000.00, 'لشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(31, 'برفاااان', '16638399241249632c2eb4b8b1d.jpg', '77777', 4000.00, ' الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه\n                                ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا\n                                سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(32, 'برفان رجالي', '1663839974108632c2ee67fe1b.jpg', '88888', 7000.00, ' الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه\n                                ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا\n                                سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(33, 'زجاجه برفان', '16641858828296331761aaf37e.jpg', '99999', 5000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(34, 'لابتوب ديل', '1664198717556331a83d65a8c.jpg', '1122', 5000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(35, 'لابتوب hp', '166420114111826331b1b5afba5.jpg', '2233', 6000.00, 'الشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-27 10:21:23', 1),
(36, 'لابتوب ماك', '16642039654846331bcbd895a5.jpg', '3344', 7000.00, 'لشركة نفسها هي شركة ناجحة للغاية. سوف آتي لأفعل ما يقدمونه ليهرب من اوجاع الضيق. يوفر رفض الخطأ المفترض المرونة هنا سأشرح أصغر فرق في الوقت.', '2022-09-27 10:21:23', '2022-09-28 08:57:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advertisement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 is hide and 1 is show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `advertisement`, `status`, `created_at`, `updated_at`) VALUES
(1, 'عندما تدخل إلى المتاجر أو المواقع الكبرى تلاحظ أنها تختار بعناية محتوياتها جملة بجملة، خصوصًا في الصفحة الرئيسية وصفحة الهبوط. وهو أمر طبيعي، فالمحتوى هو أحد الأدوات التسويقية الفعالة، الذي يقنع الزائر بالشراء أو ينفره.', 1, '2022-09-28 06:51:28', '2022-09-28 06:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin12345@gmail.com', NULL, '$2y$10$6VmZFdOd6.Ir9vxZdKWPkuZoqM8q7KkGDqQrbHb.pcG7BDxQs1X2y', NULL, '2022-09-22 10:45:40', '2022-09-22 10:45:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
