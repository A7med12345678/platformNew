
INSERT INTO `dashboard_changes` (`id`, `description`, `content`, `created_at`, `updated_at`) VALUES
(1, 'dashboard_brief', 'Welcome to the English For All platform Presented by Mr. Mohamed El-Sherbiny with more than twenty years of experience in the secondary stage. He holds a Bachelor of Arts and Education in the English Language Department in 2002. He taught his students to love the language and how to deal with solving questions with ease and established a language and curriculum for the three secondary levels. This platform was designed specifically to solve most students’ difficulty with the English language smoothly, simply, and without complexity. Our goal is not to teach a curriculum only, but to establish a language and make the student able to solve any question without fears, how to solve the exam using the modern system, and training in a lot of solving exams and learning English language skills: listening speaking reading writing The solution is detailed for each part choose,Reading,Skills, Translation,Essay,Story .. etc)', NULL, '2023-10-31 10:05:06'),
(2, 'dashboard_image', 'Screenshot (1)_1698753882.png', NULL, '2023-10-31 10:04:42'),
(3, 'video_poster', 'Screenshot (1)_1698754425.png', NULL, '2023-10-31 10:13:45'),
(4, 'video_poster2', 'video_poster_1698499701.png', NULL, '2023-10-28 11:28:21'),
(5, 'video_poster3', 'video_poster_1698499715.png', NULL, '2023-10-28 11:28:35'),
(6, 'dashboard_video_youtube', '4gZFVrePKSU', NULL, '2023-10-31 10:14:23'),
(7, 'platFormName', 'English for All', NULL, '2023-10-31 10:36:29'),
(8, 'teacherName', 'Mr / Mohamed Al Sherbiny', NULL, NULL),
(9, 'teacherPhone', '+201015083660', NULL, NULL),
(10, 'teacherFaceBook', 'https://www.facebook.com/profile.php?id=61551139838443&mibextid=2JQ9oc', NULL, NULL),
(11, 'platFormDescription', 'Egyptian Secondary-Level English Education: Transforming Students into Proficient English Speakers', NULL, NULL),
(12, 'currentYear', '2023', NULL, NULL),
(13, 'teacherWhatsApp', '+201015083660', NULL, '2023-10-31 10:47:04');



INSERT INTO `selected_divs` (`id`, `selected_week`, `selected_section`, `grade`, `created_at`, `updated_at`) VALUES
(1, 1, 'sec4', '1', NULL, '2023-11-01 09:00:54'),
(2, 2, 'sec3', '2', NULL, NULL),
(3, 1, 'sec1', '3', NULL, '2023-10-31 06:31:13');


INSERT INTO `users` (`id`, `name`, `email`, `center_code`, `session_id`, `email_verified_at`, `password`, `start_from`, `student_end`, `role`, `phone`, `parent_phone`, `whatsapp`, `grade`, `avilable_grades`, `learn_type`, `force_stop`, `pay`, `develop_mode`, `exams_attemps`, `hw_attemps`, `remember_token`, `current_team_id`, `profile_photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
                     (1, 'test', 'test@test', '1000'         , NULL,             NULL,            '',          '[]',         '[]'    , 'studnt', '',           '',          '',        '1',      '[]',             'عام',          '0',      '0',       '0',           '[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]', '[]', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'youmna hossam ahmed', 'ahmedeldakhly668@gmail.com', '1001', NULL, NULL, '$2y$10$eg1KHA8ymFHosHRLdxfVZOEsiMB4Slyx4tLdjUlf.B.x0BAv4cARC', '[]', '[]', 'Sadmin', '01142333048', '01142333048', '01142333048', '1', '[\"1\"]', 'عام', '0', '0', '0', '[]', '[]', NULL, NULL, 'photo_2023-11-01_14-01-15_1699383819.jpg', '2023-11-07 17:03:04', '2023-11-07 17:03:39', NULL);

