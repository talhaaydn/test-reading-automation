-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2019 at 02:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(7, '1. Sınıf'),
(1, '2. Sınıf'),
(3, '3.Sınıf'),
(4, '4. Sınıf'),
(5, '5. Sınıf'),
(6, '6.Sınıf');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `name`) VALUES
(1, 'YDB101', 'İngilizce I'),
(2, 'TBL103', 'Algoritma ve Programlama-I'),
(5, 'TBL331', 'Yazılım Geliştirme Laboratuvarı-I'),
(6, 'TKN104', 'Fizik II'),
(7, 'TKN102', 'Matematik II'),
(8, 'TBL206', 'Veritabanı Yönetim Sistemleri');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `faculty_id`) VALUES
(1, 'Bilişim Sistemleri Mühendisliği', 6),
(3, 'Biyomedikal Mühendisliği', 6),
(5, 'Otomotiv Mühendisliği', 6),
(6, 'Enerji Sistemleri Mühendisliği', 6);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `user_course_assign_id` int(11) NOT NULL,
  `exam_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `file`, `user_course_assign_id`, `exam_type_id`) VALUES
(7, '1574965374-2019-2020_Güz_Dönemi_Vize_İngilizce_I_Soru_Bazlı_Degerlendirme (1).xlsx', 3, 1),
(10, '1574974574-2019-2020_Güz_Dönemi_Vize_Yazılım_Geliştirme_Laboratuvarı-I_Soru_Bazlı_Degerlendirme.xlsx', 8, 1),
(11, '1574974622-2019-2020_Bahar_Dönemi_Vize_Matematik_II_Soru_Bazlı_Degerlendirme.xlsx', 11, 1),
(12, '1574974670-2019-2020_Bahar_Dönemi_Vize_Yazılım_Geliştirme_Laboratuvarı-I_Soru_Bazlı_Degerlendirme.xlsx', 12, 1),
(13, '1574974718-2019-2020_Bahar_Dönemi_Vize_Veritabanı_Yönetim_Sistemleri_Soru_Bazlı_Degerlendirme.xlsx', 9, 1),
(14, '1574974757-2019-2020_Bahar_Dönemi_Vize_Fizik_II_Soru_Bazlı_Degerlendirme.xlsx', 10, 1),
(15, '1575010926-2019-2020_Güz_Dönemi_Final_Yazılım_Geliştirme_Laboratuvarı-I_Soru_Bazlı_Degerlendirme.xlsx', 8, 2),
(16, '1575012795-2019-2020_Bahar_Dönemi_Vize_Fizik_II_Soru_Bazlı_Degerlendirme.xlsx', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`id`, `name`) VALUES
(3, 'Bütünleme'),
(2, 'Final'),
(1, 'Vize');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
(3, 'Fen ve Edebiyat Fakültesi'),
(9, 'Hukuk Fakültesi'),
(5, 'Mühendislik Fakültesi'),
(6, 'Teknoloji Fakültesi');

-- --------------------------------------------------------

--
-- Table structure for table `gains`
--

CREATE TABLE `gains` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `gains`
--

INSERT INTO `gains` (`id`, `name`, `course_id`) VALUES
(1, 'Kendisi ve çevresindekilerle ilgili basit tanıtma cümlelerini anlayabilir.', 1),
(2, 'Kendisini doğrudan ilgilendiren konularla ilişkili kalıpları ve çok sık kullanılan sözcükleri anlayabilir.', 1),
(3, 'Kısa, net, basit ileti ve duyurulardaki temel düşünceyi alabilir.', 1),
(4, 'Kısa ve tahmin edilebilir günlük konular hakkında kayıtlı kısa pasajları yavaş ve açık olduğunda anlayabilir.', 1),
(6, 'Fonksiyonlar, diziler ve işaretçilerin kullanımı açıklar.', 2),
(7, 'Bilgisayar programlama yapılarını kullanabilme.', 2),
(8, 'Değişkenleri, döngüleri kullanabilme', 2),
(9, 'Uygulama kodunu tasarlayabilme ve test edebilme.', 2),
(10, 'Veri tabanı yönetim sistemlerine ait kavramları tanır.', 8),
(11, 'Veri tabanı yönetim sistemlerini sınıflandırabilir.', 8),
(12, 'Veri tabanı üzerinde SQL komutlarını uygular.', 8),
(13, 'Çok değişkenli fonksiyon grafiklerini tanır ve fonksiyonlarda grafiksel analiz yapar', 7),
(14, 'Üç boyutlu uzayda düzlemler, doğrular ve vektörel işlemleri gerçekleştirir', 7),
(15, 'Çok değişkenli fonksiyonlarda limit, türev ve integral çözüm metotlarını mühendislik problemlerine uygular', 7),
(16, 'Tek ve çok değişkenli seri yakınsama ve ıraksama metotlarını mühendislik problemlerine uygular ve hata tahmini yapar', 7),
(17, 'asd', 1),
(18, 'asd', 1),
(19, 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `name`, `department_id`) VALUES
(7, 'Alanıyla ilgili konularda bilgi ve görüşlerini yazılı ve sözlü aktarabilmek.', 3),
(8, 'Alanında edindiği bilgi ve becerileri eleştirel bir anlayışla değerlendirebilmek.', 3),
(9, 'Bağımsız çalışabilmek ve sorumluluk alabilmek.', 3),
(23, 'Alanıyla ilgili konularda bilgi ve görüşlerini yazılı ve sözlü aktarabilmek.', 6),
(24, 'Alanında edindiği bilgi ve becerileri eleştirel bir anlayışla değerlendirebilmek.', 6),
(25, 'Bağımsız çalışabilmek ve sorumluluk alabilmek.', 6),
(26, 'Birlikte çalışmaya yatkın olabilmek.', 6),
(27, 'Öğrenmeyi öğrenebilmek ve yönetebilmek.', 6),
(28, 'Alanının gerektirdiği bilişim ve iletişim teknolojilerini kullanabilmek.', 6),
(29, 'Alanındaki temel bilgileri izleyebilecek ve meslek çevresiyle iletişim kurabilecek düzeyde bir yabancı dili kullanabilmek.', 6),
(30, 'Temel matematik bilgilerini kullanabilir', 1),
(31, 'Programlama yapabilir', 1),
(32, 'Algoritma tasarlayıp uygulayabilir', 1),
(33, 'Bilgisayar Mimari ve Organizasyon bilgisini kullanabilir', 1),
(34, 'İşletim Sistemleri bilgisini kullanabilir', 1),
(35, 'Yazılım Mühendisliği bilgilerini uygulayabilir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Öğretim Görevlisi');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `term` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term`) VALUES
(2, 'Bahar Dönemi'),
(1, 'Güz Dönemi'),
(3, 'Yaz Dönemi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `registration_number` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `registration_number`, `password`, `name`, `surname`, `role_id`) VALUES
(2, '171307054', '$2y$10$ZSD.qOKeQ.ZhS3hPUsLgme1YlQEYnrYGFg4tXFKW4H0hLLxLUMeUy', 'Talha', 'AYDIN', 1),
(3, '171307058', '$2y$10$fDJljXENu5VEt.z9jj.lI.gflaqLe0Oa8SQReEFU9tfBZFKwz.Pu6', 'Ömer Resul', 'ERTAN', 2),
(7, '171307059', '$2y$10$TBr26na2ia34nUZ5xarTKuEJN1NWl17j0tSVy2PrSV7RxqqOTUTfS', 'Ayşe', 'Büyükaslan', 2),
(8, '305698725', '$2y$10$UcRviGRLmCIVHQkxExkmPe8QYf1d.fO/YjjoP/EH/4h58rFIhbe5y', 'Meliha', 'Yıldırım', 2),
(9, '96325741', '$2y$10$TcsJFnHVyjw7.b9k.j7ceecw13q.LUbGbzsswEVS4URk6PUnwjemq', 'Mehmet', 'Yücedağ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_course_assign`
--

CREATE TABLE `user_course_assign` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `year_term_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `user_course_assign`
--

INSERT INTO `user_course_assign` (`id`, `department_id`, `class_id`, `year_term_id`, `course_id`, `user_id`) VALUES
(3, 1, 1, 2, 1, 8),
(7, 6, 7, 2, 8, 8),
(8, 1, 3, 2, 5, 9),
(9, 6, 4, 1, 8, 7),
(10, 3, 1, 1, 6, 7),
(11, 5, 1, 1, 7, 9),
(12, 5, 4, 1, 5, 3),
(13, 5, 1, 1, 1, 3),
(14, 1, 3, 2, 6, 7),
(15, 1, 3, 1, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `year` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`) VALUES
(1, '2019-2020'),
(2, '2020-2021');

-- --------------------------------------------------------

--
-- Table structure for table `year_term`
--

CREATE TABLE `year_term` (
  `id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `year_term`
--

INSERT INTO `year_term` (`id`, `year_id`, `term_id`) VALUES
(1, 1, 2),
(2, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `departments_ibfk_1` (`faculty_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file` (`file`),
  ADD KEY `exams_ibfk_1` (`user_course_assign_id`),
  ADD KEY `exams_ibfk_2` (`exam_type_id`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `gains`
--
ALTER TABLE `gains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gains_ibfk_1` (`course_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualifications_ibfk_1` (`department_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `term` (`term`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- Indexes for table `user_course_assign`
--
ALTER TABLE `user_course_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_course_assign_ibfk_1` (`department_id`),
  ADD KEY `user_course_assign_ibfk_2` (`course_id`),
  ADD KEY `user_course_assign_ibfk_3` (`user_id`),
  ADD KEY `user_course_assign_ibfk_4` (`year_term_id`),
  ADD KEY `user_course_assign_ibfk_5` (`class_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indexes for table `year_term`
--
ALTER TABLE `year_term`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_term_ibfk_1` (`term_id`),
  ADD KEY `year_term_ibfk_2` (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gains`
--
ALTER TABLE `gains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_course_assign`
--
ALTER TABLE `user_course_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `year_term`
--
ALTER TABLE `year_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`user_course_assign_id`) REFERENCES `user_course_assign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`exam_type_id`) REFERENCES `exam_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gains`
--
ALTER TABLE `gains`
  ADD CONSTRAINT `gains_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course_assign`
--
ALTER TABLE `user_course_assign`
  ADD CONSTRAINT `user_course_assign_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_assign_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_assign_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_assign_ibfk_4` FOREIGN KEY (`year_term_id`) REFERENCES `year_term` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_assign_ibfk_5` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `year_term`
--
ALTER TABLE `year_term`
  ADD CONSTRAINT `year_term_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `year_term_ibfk_2` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
