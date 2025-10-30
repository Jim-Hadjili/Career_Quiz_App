-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 02:12 PM
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
-- Database: `career_quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `career_path_tb`
--

CREATE TABLE `career_path_tb` (
  `id` int(11) NOT NULL,
  `career_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career_path_tb`
--

INSERT INTO `career_path_tb` (`id`, `career_type`) VALUES
(1, 'Engineering'),
(2, 'Architecture'),
(3, 'Information Technology'),
(4, 'Computer Science'),
(5, 'Computer Engineering'),
(6, 'Civil Engineering'),
(7, 'Mechanical Engineering'),
(8, 'Electrical Engineering'),
(9, 'Electronics Engineering'),
(10, 'Industrial Engineering'),
(11, 'Chemical Engineering'),
(12, 'Marine Engineering'),
(13, 'Aerospace Engineering'),
(14, 'Environmental Science'),
(15, 'Biology'),
(16, 'Chemistry'),
(17, 'Physics'),
(18, 'Mathematics'),
(19, 'Data Science'),
(20, 'Cybersecurity'),
(21, 'Nursing'),
(22, 'Medical Technology'),
(23, 'Pharmacy'),
(24, 'Physical Therapy'),
(25, 'Occupational Therapy'),
(26, 'Dentistry'),
(27, 'Medicine'),
(28, 'Public Health'),
(29, 'Radiologic Technology'),
(30, 'Nutrition and Dietetics'),
(31, 'Midwifery'),
(32, 'Respiratory Therapy'),
(33, 'Veterinary Medicine'),
(34, 'Health Care Services'),
(35, 'Biomedical Engineering'),
(36, 'Accountancy'),
(37, 'Business Administration'),
(38, 'Marketing Management'),
(39, 'Financial Management'),
(40, 'Entrepreneurship'),
(41, 'Human Resource Management'),
(42, 'Economics'),
(43, 'Real Estate Management'),
(44, 'Hospitality Management'),
(45, 'Tourism Management'),
(46, 'Customs Administration'),
(47, 'Office Administration'),
(48, 'Logistics and Supply Chain Management'),
(49, 'Psychology'),
(50, 'Political Science'),
(51, 'Sociology'),
(52, 'Philosophy'),
(53, 'Communication Arts'),
(54, 'Mass Communication'),
(55, 'Public Administration'),
(56, 'International Studies'),
(57, 'Criminology'),
(58, 'Social Work'),
(59, 'Education'),
(60, 'Linguistics'),
(61, 'History'),
(62, 'Literature'),
(63, 'Fine Arts'),
(64, 'Multimedia Arts'),
(65, 'Interior Design'),
(66, 'Fashion Design'),
(67, 'Graphic Design'),
(68, 'Film and Television'),
(69, 'Performing Arts'),
(70, 'Theater Arts'),
(71, 'Photography'),
(72, 'Animation'),
(73, 'Music'),
(74, 'Creative Writing'),
(75, 'Automotive Technology'),
(76, 'Electrical Installation and Maintenance'),
(77, 'Welding Technology'),
(78, 'Carpentry'),
(79, 'Plumbing'),
(80, 'Masonry'),
(81, 'Housekeeping'),
(82, 'Cookery'),
(83, 'Bread and Pastry Production'),
(84, 'Food and Beverage Services'),
(85, 'Tour Guiding Services'),
(86, 'Front Office Services'),
(87, 'Computer Systems Servicing'),
(88, 'Animation NCII'),
(89, 'Programming NCII'),
(90, 'Agriculture'),
(91, 'Forestry'),
(92, 'Fisheries'),
(93, 'Agroforestry'),
(94, 'Environmental Management'),
(95, 'Animal Science'),
(96, 'Crop Science'),
(97, 'Food Technology'),
(98, 'Law'),
(99, 'Legal Management'),
(100, 'Customs and Border Protection'),
(101, 'Public Safety Administration'),
(102, 'Community Development'),
(103, 'Military Science'),
(104, 'Forensic Science');

-- --------------------------------------------------------

--
-- Table structure for table `core_subject_tb`
--

CREATE TABLE `core_subject_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Statistics_and_Probability` varchar(255) NOT NULL,
  `Physical_Science` varchar(255) NOT NULL,
  `oral_comm_context` varchar(255) NOT NULL,
  `general_math` varchar(255) NOT NULL,
  `earth_life_sci` varchar(255) NOT NULL,
  `ucsp` varchar(255) NOT NULL,
  `reading_writing` varchar(255) NOT NULL,
  `lit21_ph_world` varchar(255) NOT NULL,
  `media_info_lit` varchar(255) NOT NULL,
  `mbti_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `core_subject_tb`
--

INSERT INTO `core_subject_tb` (`id`, `user_id`, `Statistics_and_Probability`, `Physical_Science`, `oral_comm_context`, `general_math`, `earth_life_sci`, `ucsp`, `reading_writing`, `lit21_ph_world`, `media_info_lit`, `mbti_type`) VALUES
(1, 1, '75', '77', '77', '77', '77', '77', '77', '77', '77', 'ESFJ'),
(2, 2, '88', '88', '88', '88', '88', '88', '88', '88', '88', 'ISTJ');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results_tb`
--

CREATE TABLE `quiz_results_tb` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `quiz_data` longtext NOT NULL,
  `recommended_careers` longtext NOT NULL,
  `completion_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_guest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results_tb`
--

INSERT INTO `quiz_results_tb` (`result_id`, `user_id`, `session_id`, `quiz_data`, `recommended_careers`, `completion_date`, `is_guest`) VALUES
(13, 1, NULL, '{\"answers\":{\"1\":7,\"2\":7,\"3\":7,\"4\":7,\"5\":7,\"6\":7,\"7\":7,\"8\":7,\"9\":7,\"10\":7,\"11\":6,\"12\":6,\"13\":7,\"14\":6,\"15\":7,\"16\":6,\"17\":7,\"18\":6,\"19\":7,\"20\":6,\"21\":7,\"22\":6,\"23\":7,\"24\":6,\"25\":7,\"26\":6,\"27\":7,\"28\":7,\"29\":5,\"30\":7,\"31\":5,\"32\":6,\"33\":4,\"34\":5,\"35\":4,\"36\":6,\"37\":6,\"38\":5,\"39\":6,\"40\":6},\"core_subjects\":{\"Statistics_and_Probability\":\"100\",\"Physical_Science\":\"77\",\"oral_comm_context\":\"77\",\"general_math\":\"77\",\"earth_life_sci\":\"77\",\"ucsp\":\"77\",\"reading_writing\":\"77\",\"lit21_ph_world\":\"77\",\"media_info_lit\":\"77\",\"mbti_type\":\"INTP\"}}', '{\"recommended_careers\":[{\"title\":\"Data Scientist\",\"match_percentage\":90,\"description\":\"As a Data Scientist, you\'ll transform raw data into actionable insights, building predictive models and uncovering patterns that drive business decisions. Your work environment could range from tech startups to corporate offices, with opportunities to work remotely. In the Philippines, data science is transforming industries from finance to healthcare, offering high-impact roles that shape the future. With continuous learning, you can advance to senior roles in AI and machine learning.\",\"why_good_fit\":\"Your INTP personality thrives on understanding complex systems, which aligns perfectly with data science\'s problem-solving nature. Your perfect score in Statistics and Probability shows you have the analytical foundation needed. With a high analytical thinking score (6.7\\/7), you\'re well-equipped to handle the logical challenges of this field. The Philippines\' growing tech sector offers excellent opportunities for your curious mind to explore.\",\"salary_range\":\"\\u20b135,000 - \\u20b1100,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Statistics, Computer Science, or related field with certifications in Python, SQL, and machine learning\",\"key_skills\":[\"Statistical Analysis\",\"Machine Learning\",\"Data Visualization\",\"Python Programming\",\"SQL\",\"Critical Thinking\"],\"work_environment\":\"Typically office-based or remote, with collaborative teams in tech companies, financial institutions, or research organizations\",\"career_progression\":\"Junior Data Analyst \\u2192 Data Scientist \\u2192 Senior Data Scientist \\u2192 Data Science Manager\"},{\"title\":\"Research Scientist (Physics\\/Astronomy)\",\"match_percentage\":88,\"description\":\"As a Research Scientist, you\'ll explore the fundamental laws of the universe, conducting experiments and theoretical work that expands human knowledge. Your work could be in universities, government research institutions, or private sector R&D labs. In the Philippines, you might contribute to space research through the PAGASA or work with international collaborations. This career offers intellectual freedom and the chance to make groundbreaking discoveries.\",\"why_good_fit\":\"Your INTP type\'s love for theoretical understanding makes you a natural fit for scientific research. Your strong performance in Physical Science (77\\/100) shows your aptitude for scientific concepts. With your high analytical thinking score, you\'ll excel at designing experiments and interpreting complex data. The Philippines\' growing interest in space science offers exciting opportunities for your curious mind.\",\"salary_range\":\"\\u20b130,000 - \\u20b185,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Physics, Astronomy, or related field with Master\'s\\/PhD for advanced roles\",\"key_skills\":[\"Experimental Design\",\"Data Analysis\",\"Theoretical Modeling\",\"Scientific Writing\",\"Mathematical Modeling\",\"Critical Thinking\"],\"work_environment\":\"University labs, government research institutions, or private sector R&D facilities with collaborative but independent work culture\",\"career_progression\":\"Junior Researcher \\u2192 Research Scientist \\u2192 Senior Research Scientist \\u2192 Research Director\"},{\"title\":\"Actuarial Scientist\",\"match_percentage\":85,\"description\":\"As an Actuarial Scientist, you\'ll use mathematics and statistics to assess financial risks for insurance companies and financial institutions. Your work helps create policies that protect people from financial uncertainties. In the Philippines, the growing insurance sector offers excellent opportunities. You\'ll work in offices, often with flexible hours, and have opportunities to specialize in different risk areas. This career combines your love for numbers with meaningful societal impact.\",\"why_good_fit\":\"Your perfect score in Statistics and Probability is exactly what actuarial science requires. Your INTP type\'s logical thinking will help you analyze complex financial risks. With your strong analytical skills (6.7\\/7), you\'ll excel at developing mathematical models. The Philippines\' expanding insurance industry needs professionals like you to create innovative financial solutions.\",\"salary_range\":\"\\u20b135,000 - \\u20b190,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Mathematics, Statistics, or Actuarial Science with professional certifications (e.g., SOA, CAS)\",\"key_skills\":[\"Statistical Modeling\",\"Risk Assessment\",\"Financial Analysis\",\"Mathematical Modeling\",\"Data Interpretation\",\"Problem-Solving\"],\"work_environment\":\"Insurance companies, banks, or consulting firms with structured but intellectually stimulating work environments\",\"career_progression\":\"Junior Actuary \\u2192 Actuarial Analyst \\u2192 Associate Actuary \\u2192 Fellow Actuary\"},{\"title\":\"Software Developer (Specializing in AI\\/ML)\",\"match_percentage\":87,\"description\":\"As a Software Developer specializing in AI\\/ML, you\'ll create intelligent systems that learn and adapt, from recommendation algorithms to autonomous systems. Your work could be in tech companies, startups, or even government digital transformation projects. The Philippines\' booming IT-BPO sector offers excellent opportunities. You\'ll work in modern offices or remotely, with continuous learning opportunities in cutting-edge technologies. This career combines your love for systems with creative problem-solving.\",\"why_good_fit\":\"Your INTP personality\'s system-building tendencies align perfectly with software development. Your strong mathematical foundation (77\\/100 in General Mathematics) provides the basis for programming. With your high analytical score, you\'ll excel at designing efficient algorithms. The Philippines\' growing AI ecosystem needs innovators like you to develop solutions for local and global markets.\",\"salary_range\":\"\\u20b130,000 - \\u20b1110,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Computer Science, Information Technology, or related field with certifications in AI\\/ML frameworks\",\"key_skills\":[\"Programming (Python, Java, C++)\",\"Machine Learning\",\"Algorithmic Thinking\",\"Software Design\",\"Data Structures\",\"Problem-Solving\"],\"work_environment\":\"Tech companies, startups, or remote work settings with collaborative but independent work culture\",\"career_progression\":\"Junior Developer \\u2192 Software Engineer \\u2192 Senior Software Engineer \\u2192 AI\\/ML Specialist\"},{\"title\":\"Economist\",\"match_percentage\":82,\"description\":\"As an Economist, you\'ll analyze economic trends, develop policies, and provide insights that shape national and global economies. Your work could be in government agencies, think tanks, or financial institutions. In the Philippines, you might contribute to economic planning for agencies like NEDA or work in international organizations. This career offers the chance to influence societal development through evidence-based decision making. You\'ll work in offices with opportunities for research and policy development.\",\"why_good_fit\":\"Your INTP type\'s love for understanding systems makes you a natural economist. Your strong performance in Statistics (100\\/100) is crucial for economic modeling. With your high analytical score, you\'ll excel at interpreting complex economic data. The Philippines\' need for economic development offers meaningful opportunities for your analytical skills. Your interest in society and politics (77\\/100) will help you understand the human impact of economic policies.\",\"salary_range\":\"\\u20b130,000 - \\u20b180,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Economics, Statistics, or related field with Master\'s for advanced roles\",\"key_skills\":[\"Economic Modeling\",\"Data Analysis\",\"Policy Analysis\",\"Statistical Methods\",\"Research\",\"Critical Thinking\"],\"work_environment\":\"Government agencies, financial institutions, or research organizations with structured but intellectually stimulating environments\",\"career_progression\":\"Junior Economist \\u2192 Economist \\u2192 Senior Economist \\u2192 Chief Economist\"}],\"personality_analysis\":{\"key_traits\":[\"Theoretical Problem-Solver\",\"Analytical Thinker\",\"Independent Learner\"],\"strengths\":[\"Exceptional statistical reasoning as shown by perfect score in Statistics and Probability\",\"Strong analytical skills demonstrated by 6.7\\/7 in analytical thinking quiz\"],\"areas_for_development\":[\"Could benefit from developing social interaction skills (5.7\\/7) for collaborative work environments\",\"Would gain from practical application of theoretical knowledge through internships or projects\"]},\"academic_analysis\":{\"strongest_subjects\":[\"Statistics and Probability\",\"General Mathematics\"],\"recommendations\":[\"Consider pursuing further studies or certifications in data science, computer science, or economics to leverage your statistical strengths\",\"Explore internships in tech or research fields to apply your analytical skills in real-world scenarios\"]}}', '2025-10-29 14:01:43', 0),
(14, 1, NULL, '{\"answers\":{\"1\":1,\"2\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":6,\"12\":6,\"13\":6,\"14\":6,\"15\":6,\"16\":6,\"17\":6,\"18\":6,\"19\":6,\"20\":6,\"21\":7,\"22\":6,\"23\":7,\"24\":6,\"25\":7,\"26\":6,\"27\":7,\"28\":6,\"29\":7,\"30\":6,\"31\":5,\"32\":7,\"33\":7,\"34\":5,\"35\":4,\"36\":3,\"37\":2,\"38\":3,\"39\":3,\"40\":3},\"core_subjects\":{\"Statistics_and_Probability\":\"100\",\"Physical_Science\":\"77\",\"oral_comm_context\":\"77\",\"general_math\":\"77\",\"earth_life_sci\":\"77\",\"ucsp\":\"77\",\"reading_writing\":\"77\",\"lit21_ph_world\":\"77\",\"media_info_lit\":\"77\",\"mbti_type\":\"INTP\"}}', '{\"recommended_careers\":[{\"title\":\"Data Scientist\",\"match_percentage\":90,\"description\":\"As a Data Scientist, you\'ll transform raw data into actionable insights, building predictive models and uncovering patterns that drive business decisions. Your work environment will be dynamic, often in tech companies or research institutions, where you\'ll collaborate with cross-functional teams. This career has immense societal impact, from improving healthcare outcomes to optimizing financial systems. With continuous advancements in AI and machine learning, growth opportunities are abundant.\",\"why_good_fit\":\"Your perfect score in Statistics and Probability shows you have the analytical foundation needed for data science. As an INTP, your love for understanding complex systems and theoretical frameworks aligns perfectly with building predictive models. Your analytical thinking score of 4.1\\/7 indicates you enjoy problem-solving, which is crucial for data interpretation. The Philippines\' growing tech industry offers exciting opportunities for data scientists, and your curiosity will thrive in this ever-evolving field.\",\"salary_range\":\"\\u20b140,000 - \\u20b1100,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Statistics, Computer Science, or Mathematics with data science specializations\",\"key_skills\":[\"Statistical Analysis\",\"Machine Learning\",\"Data Visualization\",\"Programming (Python\\/R)\",\"Data Mining\",\"Critical Thinking\"],\"work_environment\":\"Typically in tech offices, research institutions, or remote setups with collaborative teams\",\"career_progression\":\"Junior Data Analyst \\u2192 Data Scientist \\u2192 Senior Data Scientist \\u2192 Data Science Manager\"},{\"title\":\"Research Scientist (Physics\\/Mathematics)\",\"match_percentage\":88,\"description\":\"As a Research Scientist, you\'ll explore fundamental questions in physics or mathematics, conducting experiments and developing theoretical models. Your work environment could be in universities, government research labs, or private R&D centers. This career has profound societal impact, from advancing technology to solving global challenges. The Philippines has growing research institutions where your contributions can make a difference.\",\"why_good_fit\":\"Your strong performance in Physical Science and General Mathematics demonstrates your aptitude for scientific research. As an INTP, your theoretical mindset and love for understanding systems will excel in academic research. Your curiosity and analytical skills (4.1\\/7) are perfect for exploring complex scientific questions. The Philippines needs more researchers to drive innovation, and your profile shows you have the potential to make significant contributions.\",\"salary_range\":\"\\u20b135,000 - \\u20b185,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Master\'s or PhD in Physics, Mathematics, or related field\",\"key_skills\":[\"Theoretical Modeling\",\"Experimental Design\",\"Scientific Writing\",\"Data Analysis\",\"Problem-Solving\",\"Critical Thinking\"],\"work_environment\":\"Universities, government research labs, or private R&D centers with academic or collaborative cultures\",\"career_progression\":\"Junior Researcher \\u2192 Research Scientist \\u2192 Senior Research Scientist \\u2192 Research Director\"},{\"title\":\"Actuarial Scientist\",\"match_percentage\":85,\"description\":\"As an Actuarial Scientist, you\'ll assess financial risks and uncertainties, using mathematical models to help businesses make informed decisions. Your work environment will be in insurance companies, banks, or consulting firms, where you\'ll analyze data to develop pricing strategies. This career has significant societal impact by ensuring financial stability and security. The Philippines\' growing financial sector offers excellent opportunities for actuaries.\",\"why_good_fit\":\"Your perfect score in Statistics and Probability is the foundation for actuarial science. As an INTP, your logical thinking and love for understanding systems will excel in risk assessment. Your analytical skills (4.1\\/7) are crucial for developing complex financial models. The Philippines\' financial industry is expanding, and your profile shows you have the potential to become a valuable actuary in this high-demand field.\",\"salary_range\":\"\\u20b145,000 - \\u20b195,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Mathematics, Statistics, or Actuarial Science with professional certifications\",\"key_skills\":[\"Risk Assessment\",\"Mathematical Modeling\",\"Data Analysis\",\"Financial Forecasting\",\"Statistical Software\",\"Problem-Solving\"],\"work_environment\":\"Insurance companies, banks, or consulting firms with structured and analytical work cultures\",\"career_progression\":\"Junior Actuary \\u2192 Actuarial Analyst \\u2192 Senior Actuary \\u2192 Chief Actuary\"},{\"title\":\"Software Engineer (Specializing in AI\\/ML)\",\"match_percentage\":87,\"description\":\"As a Software Engineer specializing in AI\\/ML, you\'ll develop intelligent systems that learn and improve over time. Your work environment will be in tech companies, startups, or research labs, where you\'ll collaborate with data scientists and engineers. This career has transformative societal impact, from improving healthcare to revolutionizing industries. The Philippines\' tech industry is booming, offering exciting opportunities for AI\\/ML engineers.\",\"why_good_fit\":\"Your strong performance in Statistics and Probability is valuable for AI\\/ML development. As an INTP, your love for understanding complex systems and theoretical frameworks aligns perfectly with AI research. Your analytical skills (4.1\\/7) are crucial for developing machine learning algorithms. The Philippines\' growing tech industry needs more AI\\/ML engineers, and your profile shows you have the potential to excel in this cutting-edge field.\",\"salary_range\":\"\\u20b150,000 - \\u20b1110,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Computer Science, Information Technology, or related field with AI\\/ML specializations\",\"key_skills\":[\"Machine Learning\",\"Programming (Python\\/Java)\",\"Data Structures\",\"Algorithms\",\"Software Development\",\"Problem-Solving\"],\"work_environment\":\"Tech companies, startups, or research labs with collaborative and innovative cultures\",\"career_progression\":\"Junior Software Engineer \\u2192 AI\\/ML Engineer \\u2192 Senior AI\\/ML Engineer \\u2192 AI\\/ML Team Lead\"},{\"title\":\"Economist\",\"match_percentage\":82,\"description\":\"As an Economist, you\'ll analyze economic data to understand trends, forecast future conditions, and advise policymakers. Your work environment could be in government agencies, financial institutions, or research organizations. This career has significant societal impact by shaping economic policies and improving living standards. The Philippines\' dynamic economy offers diverse opportunities for economists.\",\"why_good_fit\":\"Your strong performance in Statistics and Probability is essential for economic analysis. As an INTP, your logical thinking and love for understanding systems will excel in economic modeling. Your analytical skills (4.1\\/7) are crucial for interpreting economic data. The Philippines\' economy is growing, and your profile shows you have the potential to make valuable contributions as an economist.\",\"salary_range\":\"\\u20b140,000 - \\u20b190,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Economics, Statistics, or related field with advanced degrees preferred\",\"key_skills\":[\"Economic Modeling\",\"Data Analysis\",\"Statistical Software\",\"Policy Analysis\",\"Research\",\"Critical Thinking\"],\"work_environment\":\"Government agencies, financial institutions, or research organizations with analytical and collaborative cultures\",\"career_progression\":\"Junior Economist \\u2192 Economist \\u2192 Senior Economist \\u2192 Chief Economist\"}],\"personality_analysis\":{\"key_traits\":[\"Theoretical Thinker\",\"Analytical Problem-Solver\",\"Independent Researcher\"],\"strengths\":[\"Excels in logical and systematic analysis\",\"Strong foundation in statistical and mathematical concepts\"],\"areas_for_development\":[\"Could benefit from developing social interaction skills for collaborative environments\",\"May need to work on practical application of theoretical knowledge\"]},\"academic_analysis\":{\"strongest_subjects\":[\"Statistics and Probability\",\"Physical Science\"],\"recommendations\":[\"Consider pursuing advanced studies in data science, mathematics, or economics to leverage your statistical strengths\",\"Explore internships in tech or research fields to gain practical experience\"]}}', '2025-10-29 14:12:58', 0),
(15, 1, NULL, '{\"answers\":{\"1\":7,\"2\":1,\"3\":7,\"4\":7,\"5\":7,\"6\":7,\"7\":7,\"8\":7,\"9\":7,\"10\":7,\"11\":1,\"12\":7,\"13\":7,\"14\":7,\"15\":7,\"16\":7,\"17\":1,\"18\":7,\"19\":1,\"20\":1,\"21\":7,\"22\":7,\"23\":7,\"24\":7,\"25\":7,\"26\":4,\"27\":7,\"28\":7,\"29\":7,\"30\":7,\"31\":7,\"32\":7,\"33\":7,\"34\":1,\"35\":1,\"36\":7,\"37\":1,\"38\":7,\"39\":7,\"40\":7},\"core_subjects\":{\"Statistics_and_Probability\":\"100\",\"Physical_Science\":\"77\",\"oral_comm_context\":\"77\",\"general_math\":\"77\",\"earth_life_sci\":\"77\",\"ucsp\":\"77\",\"reading_writing\":\"77\",\"lit21_ph_world\":\"77\",\"media_info_lit\":\"77\",\"mbti_type\":\"INTP\"}}', '{\"recommended_careers\":[{\"title\":\"Data Scientist\",\"match_percentage\":92,\"description\":\"As a Data Scientist, you\'ll transform raw data into actionable insights, building predictive models and uncovering patterns that drive business decisions. Your work environment will be dynamic, often in tech hubs or corporate offices, where you\'ll collaborate with cross-functional teams. This role has significant societal impact by optimizing systems in healthcare, finance, and government. With continuous learning opportunities in AI and machine learning, this career offers high growth potential.\",\"why_good_fit\":\"Your INTP personality thrives on understanding complex systems, which aligns perfectly with data science\'s problem-solving nature. Your perfect score in Statistics and Probability shows you have the analytical foundation needed. Your high analytical thinking score (5.8\\/7) and curiosity about theoretical systems make you an ideal candidate. The Philippines\' growing tech industry offers excellent opportunities for data scientists, with companies investing heavily in data-driven decision making.\",\"salary_range\":\"\\u20b135,000 - \\u20b190,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Statistics, Computer Science, or related field with data science specialization\",\"key_skills\":[\"Statistical Analysis\",\"Machine Learning\",\"Data Visualization\",\"Python\\/R Programming\",\"Big Data Tools\",\"Critical Thinking\"],\"work_environment\":\"Tech offices, corporate settings, or remote work with flexible hours common in Philippine startups and multinational companies\",\"career_progression\":\"Junior Data Analyst \\u2192 Data Scientist \\u2192 Senior Data Scientist \\u2192 Data Science Manager\"},{\"title\":\"Research Scientist (Physics\\/Mathematics)\",\"match_percentage\":88,\"description\":\"As a Research Scientist, you\'ll explore fundamental questions in physics or mathematics, conducting experiments and developing theoretical models. Your work could be in universities, research institutions, or private sector R&D labs, contributing to scientific advancements. This career offers the intellectual stimulation you crave, with opportunities to publish groundbreaking findings. The Philippines has growing research sectors in renewable energy and space technology.\",\"why_good_fit\":\"Your INTP type\'s love for theoretical understanding and curiosity perfectly matches research science. Your strong performance in Physical Science (77\\/100) and General Mathematics shows aptitude for scientific inquiry. Your analytical thinking (5.8\\/7) and preference for deep thinking over social interaction make you well-suited. The Philippines needs more researchers to drive innovation, and your profile aligns with this national need.\",\"salary_range\":\"\\u20b130,000 - \\u20b185,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s in Physics or Mathematics, with Master\'s\\/PhD for advanced roles\",\"key_skills\":[\"Theoretical Modeling\",\"Experimental Design\",\"Mathematical Analysis\",\"Scientific Writing\",\"Research Methodology\",\"Problem-Solving\"],\"work_environment\":\"University labs, government research institutions, or private sector R&D facilities with collaborative yet independent work culture\",\"career_progression\":\"Junior Researcher \\u2192 Research Scientist \\u2192 Senior Research Scientist \\u2192 Research Director\"},{\"title\":\"Actuarial Scientist\",\"match_percentage\":85,\"description\":\"Actuarial Scientists assess financial risks using mathematical models, helping insurance companies and financial institutions make informed decisions. Your work will involve analyzing data to predict future events and determine premiums. This career offers stability and intellectual challenge, with opportunities to work in both local and international firms. The growing insurance sector in the Philippines creates demand for skilled actuaries.\",\"why_good_fit\":\"Your perfect score in Statistics and Probability is exactly what actuaries need. Your INTP preference for logical systems and theoretical understanding aligns with actuarial science\'s mathematical foundation. Your analytical thinking (5.8\\/7) and ability to work independently are valuable traits. The Philippines\' expanding financial services industry offers excellent opportunities for actuaries, with competitive salaries and career growth.\",\"salary_range\":\"\\u20b140,000 - \\u20b1100,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s in Mathematics, Statistics, or Actuarial Science with professional certifications (e.g., SOA, CAS)\",\"key_skills\":[\"Statistical Modeling\",\"Risk Assessment\",\"Financial Mathematics\",\"Data Analysis\",\"Regulatory Compliance\",\"Problem-Solving\"],\"work_environment\":\"Insurance companies, banks, consulting firms, or government regulatory bodies with structured work environments\",\"career_progression\":\"Actuarial Analyst \\u2192 Actuary \\u2192 Senior Actuary \\u2192 Chief Actuary\"},{\"title\":\"Software Developer (Specializing in Data Systems)\",\"match_percentage\":87,\"description\":\"As a Software Developer specializing in data systems, you\'ll design and build software solutions that process and analyze large datasets. Your work will be at the intersection of technology and data, creating systems that automate complex processes. This career offers creative problem-solving opportunities in a fast-paced tech environment. The Philippines\' BPO and IT sectors provide ample opportunities for software developers.\",\"why_good_fit\":\"Your INTP personality\'s love for understanding systems and solving complex problems is ideal for software development. Your strong analytical skills (5.8\\/7) and performance in technical subjects show aptitude. Your curiosity about how things work translates well to software development. The Philippines\' growing tech industry offers excellent opportunities for developers, with many companies looking for data-focused specialists.\",\"salary_range\":\"\\u20b135,000 - \\u20b195,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s in Computer Science, Information Technology, or related field with data systems specialization\",\"key_skills\":[\"Programming (Python, Java, C++)\",\"Database Management\",\"Software Design\",\"Algorithms\",\"Data Structures\",\"Problem-Solving\"],\"work_environment\":\"Tech companies, startups, or corporate IT departments with flexible and collaborative work cultures\",\"career_progression\":\"Junior Developer \\u2192 Software Developer \\u2192 Senior Developer \\u2192 Technical Lead\"},{\"title\":\"Economist\",\"match_percentage\":82,\"description\":\"Economists analyze economic data to understand trends and make forecasts that inform policy decisions. Your work could involve government agencies, financial institutions, or research organizations, helping shape economic policies. This career offers intellectual stimulation and the chance to impact national development. The Philippines\' economic planning agencies and financial sector need skilled economists.\",\"why_good_fit\":\"Your INTP type\'s analytical nature and love for understanding systems aligns with economic analysis. Your strong performance in Statistics (100\\/100) and understanding of societal structures (77\\/100) are valuable. Your ability to think critically (5.8\\/7) is essential for economic modeling. The Philippines\' economic growth creates demand for economists in both public and private sectors.\",\"salary_range\":\"\\u20b135,000 - \\u20b185,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s in Economics, Statistics, or related field with Master\'s for advanced roles\",\"key_skills\":[\"Economic Modeling\",\"Data Analysis\",\"Policy Analysis\",\"Statistical Software\",\"Research\",\"Critical Thinking\"],\"work_environment\":\"Government economic agencies, banks, consulting firms, or research institutions with both independent and collaborative work\",\"career_progression\":\"Junior Economist \\u2192 Economist \\u2192 Senior Economist \\u2192 Chief Economist\"}],\"personality_analysis\":{\"key_traits\":[\"Theoretical Problem-Solver\",\"Independent Thinker\",\"Analytical Mind\"],\"strengths\":[\"Exceptional analytical skills demonstrated by perfect Statistics score\",\"Strong theoretical understanding and curiosity about systems\"],\"areas_for_development\":[\"Could benefit from developing social interaction skills for collaborative roles\",\"Should work on applying theoretical knowledge to practical problems\"]},\"academic_analysis\":{\"strongest_subjects\":[\"Statistics and Probability\",\"Physical Science\"],\"recommendations\":[\"Consider pursuing advanced studies in data science or mathematics to leverage your statistical strengths\",\"Explore interdisciplinary fields that combine your analytical skills with practical applications\"]}}', '2025-10-29 14:16:10', 0),
(16, 1, NULL, '{\"answers\":{\"1\":7,\"2\":1,\"3\":7,\"4\":7,\"5\":7,\"6\":7,\"7\":7,\"8\":7,\"9\":7,\"10\":7,\"11\":1,\"12\":1,\"13\":1,\"14\":7,\"15\":7,\"16\":7,\"17\":1,\"18\":7,\"19\":1,\"20\":7,\"21\":7,\"22\":7,\"23\":7,\"24\":7,\"25\":7,\"26\":7,\"27\":4,\"28\":7,\"29\":7,\"30\":7,\"31\":1,\"32\":7,\"33\":7,\"34\":7,\"35\":1,\"36\":7,\"37\":1,\"38\":7,\"39\":1,\"40\":7},\"core_subjects\":{\"Statistics_and_Probability\":\"75\",\"Physical_Science\":\"77\",\"oral_comm_context\":\"77\",\"general_math\":\"77\",\"earth_life_sci\":\"77\",\"ucsp\":\"77\",\"reading_writing\":\"77\",\"lit21_ph_world\":\"77\",\"media_info_lit\":\"77\",\"mbti_type\":\"ESFJ\"}}', '{\"recommended_careers\":[{\"title\":\"Human Resources (HR) Specialist\",\"match_percentage\":90,\"description\":\"As an HR Specialist, you\'ll be the heart of an organization, managing employee relations, recruitment, and workplace harmony. Your day will involve interviewing candidates, resolving conflicts, and implementing policies that foster a positive work environment. This role allows you to make a direct impact on people\'s lives and career growth, with opportunities to advance to HR management or organizational development.\",\"why_good_fit\":\"Your ESFJ personality shines in HR, where your warm-hearted and cooperative nature will help you build strong relationships with employees. Your consistent academic performance (76.8 average) shows your reliability, which is crucial for HR roles. Your high social interaction score (5.2\\/7) means you\'ll excel in communication-heavy tasks like recruitment and conflict resolution. This career aligns perfectly with your strengths in oral communication and understanding culture\\/society.\",\"salary_range\":\"\\u20b130,000 - \\u20b175,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Psychology, Business Administration, or HR Management. Certifications in HR practices are a plus.\",\"key_skills\":[\"Employee Relations\",\"Recruitment\",\"Conflict Resolution\",\"Policy Implementation\",\"Workplace Training\",\"Communication\"],\"work_environment\":\"Office settings in corporate, healthcare, or educational institutions with collaborative team cultures.\",\"career_progression\":\"HR Assistant \\u2192 HR Specialist \\u2192 HR Manager \\u2192 HR Director\"},{\"title\":\"Public Relations (PR) Officer\",\"match_percentage\":88,\"description\":\"As a PR Officer, you\'ll be the bridge between organizations and the public, crafting messages that build positive reputations. Your work will involve media relations, event planning, and crisis communication, all while maintaining a harmonious image. This role offers dynamic opportunities to work with diverse industries and make meaningful societal impacts through effective communication.\",\"why_good_fit\":\"Your ESFJ traits of conscientiousness and cooperation make you ideal for PR, where maintaining positive relationships is key. Your strong performance in oral communication (77\\/100) and media literacy (77\\/100) shows you have the communication skills needed. Your analytical thinking score (5.6\\/7) will help you craft strategic PR campaigns. This career leverages your strengths in understanding culture and society, allowing you to connect with diverse audiences.\",\"salary_range\":\"\\u20b128,000 - \\u20b170,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Communication, Journalism, or Marketing. Certifications in digital PR are beneficial.\",\"key_skills\":[\"Media Relations\",\"Crisis Communication\",\"Event Planning\",\"Brand Management\",\"Writing\",\"Public Speaking\"],\"work_environment\":\"Corporate offices, government agencies, or NGOs with fast-paced, collaborative environments.\",\"career_progression\":\"PR Assistant \\u2192 PR Officer \\u2192 PR Manager \\u2192 Director of Communications\"},{\"title\":\"Social Worker\",\"match_percentage\":85,\"description\":\"As a Social Worker, you\'ll advocate for vulnerable populations, providing support and resources to those in need. Your work will involve case management, counseling, and community outreach, making a tangible difference in people\'s lives. This career offers deep personal fulfillment and opportunities to work in diverse settings like hospitals, schools, or NGOs.\",\"why_good_fit\":\"Your ESFJ personality is perfect for social work, where your warm-hearted and harmonious nature will help you connect with clients. Your consistent academic performance (76.8 average) shows your dedication, which is crucial for this demanding field. Your high social interaction score (5.2\\/7) means you\'ll excel in client-facing roles. This career aligns with your strengths in understanding culture and society, allowing you to make a meaningful impact.\",\"salary_range\":\"\\u20b125,000 - \\u20b165,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Social Work. Licensure is required for advanced roles.\",\"key_skills\":[\"Case Management\",\"Counseling\",\"Community Outreach\",\"Advocacy\",\"Empathy\",\"Problem-Solving\"],\"work_environment\":\"Hospitals, schools, government agencies, or NGOs with mission-driven cultures.\",\"career_progression\":\"Social Work Assistant \\u2192 Social Worker \\u2192 Senior Social Worker \\u2192 Social Work Supervisor\"},{\"title\":\"Event Planner\",\"match_percentage\":87,\"description\":\"As an Event Planner, you\'ll bring people together by organizing memorable experiences, from corporate conferences to weddings. Your work will involve logistics, vendor coordination, and creative design, all while ensuring seamless execution. This career offers dynamic opportunities to work in diverse industries and create joy through special occasions.\",\"why_good_fit\":\"Your ESFJ traits of cooperation and harmony make you ideal for event planning, where creating positive experiences is key. Your strong performance in oral communication (77\\/100) and media literacy (77\\/100) shows you have the communication skills needed. Your analytical thinking score (5.6\\/7) will help you manage event logistics efficiently. This career leverages your strengths in understanding culture and society, allowing you to plan events that resonate with diverse audiences.\",\"salary_range\":\"\\u20b125,000 - \\u20b160,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Hospitality, Event Management, or related field. Certifications in event planning are beneficial.\",\"key_skills\":[\"Logistics Management\",\"Vendor Coordination\",\"Creative Design\",\"Budgeting\",\"Time Management\",\"Communication\"],\"work_environment\":\"Event planning agencies, hotels, or corporate settings with fast-paced, creative environments.\",\"career_progression\":\"Event Assistant \\u2192 Event Coordinator \\u2192 Event Manager \\u2192 Event Director\"},{\"title\":\"Customer Service Manager\",\"match_percentage\":89,\"description\":\"As a Customer Service Manager, you\'ll lead teams that ensure exceptional client experiences, resolving issues and implementing service improvements. Your work will involve training staff, analyzing customer feedback, and developing strategies to enhance satisfaction. This role offers opportunities to advance into operations or general management, with a direct impact on business success.\",\"why_good_fit\":\"Your ESFJ personality is perfect for customer service, where your warm-hearted and cooperative nature will help you build strong client relationships. Your consistent academic performance (76.8 average) shows your reliability, which is crucial for managing service teams. Your high social interaction score (5.2\\/7) means you\'ll excel in client-facing and team leadership roles. This career aligns with your strengths in oral communication and understanding culture, allowing you to connect with diverse customers.\",\"salary_range\":\"\\u20b135,000 - \\u20b180,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Business Administration, Marketing, or related field. Certifications in customer service are beneficial.\",\"key_skills\":[\"Team Leadership\",\"Conflict Resolution\",\"Customer Feedback Analysis\",\"Service Improvement\",\"Communication\",\"Problem-Solving\"],\"work_environment\":\"Corporate offices, call centers, or retail settings with customer-focused cultures.\",\"career_progression\":\"Customer Service Representative \\u2192 Customer Service Supervisor \\u2192 Customer Service Manager \\u2192 Director of Customer Experience\"}],\"personality_analysis\":{\"key_traits\":[\"Warm-hearted and cooperative (ESFJ)\",\"Strong social interaction (5.2\\/7)\",\"Conscientious and reliable (76.8 average)\"],\"strengths\":[\"Excellent interpersonal skills for client-facing roles\",\"Strong communication abilities from academic performance\",\"Natural ability to build harmonious work environments\"],\"areas_for_development\":[\"Could develop more analytical skills to complement social strengths\",\"Encouraged to explore technical skills for career diversification\"]},\"academic_analysis\":{\"strongest_subjects\":[\"Oral Communication (77\\/100)\",\"Understanding Culture, Society and Politics (77\\/100)\"],\"recommendations\":[\"Consider courses that build on communication and cultural understanding\",\"Explore certifications in HR, PR, or customer service to complement academic strengths\"]}}', '2025-10-30 10:52:05', 0),
(17, 1, NULL, '{\"answers\":{\"1\":7,\"2\":7,\"3\":7,\"4\":7,\"5\":7,\"6\":7,\"7\":7,\"8\":7,\"9\":7,\"10\":7,\"11\":7,\"12\":7,\"13\":7,\"14\":7,\"15\":7,\"16\":7,\"17\":7,\"18\":7,\"19\":7,\"20\":7,\"21\":7,\"22\":7,\"23\":7,\"24\":7,\"25\":7,\"26\":7,\"27\":7,\"28\":7,\"29\":7,\"30\":7,\"31\":7,\"32\":7,\"33\":7,\"34\":7,\"35\":7,\"36\":7,\"37\":7,\"38\":7,\"39\":7,\"40\":7},\"core_subjects\":{\"Statistics_and_Probability\":\"75\",\"Physical_Science\":\"77\",\"oral_comm_context\":\"77\",\"general_math\":\"77\",\"earth_life_sci\":\"77\",\"ucsp\":\"77\",\"reading_writing\":\"77\",\"lit21_ph_world\":\"77\",\"media_info_lit\":\"77\",\"mbti_type\":\"ESFJ\"}}', '{\"recommended_careers\":[{\"title\":\"Human Resources Specialist\",\"match_percentage\":90,\"description\":\"As a Human Resources Specialist, you\'ll be the heart of any organization, managing employee relations, recruitment, and workplace harmony. Your day will involve conducting interviews, resolving conflicts, and implementing policies that foster a positive work environment. This role allows you to make a direct impact on people\'s lives and career growth, with opportunities to advance to HR management or organizational development.\",\"why_good_fit\":\"Your ESFJ personality is perfectly suited for this role, as you naturally excel in social interactions (7\\/7) and thrive in cooperative environments. Your strong grades in communication subjects (77 in Oral Communication and Reading\\/Writing) show your ability to articulate policies clearly. Your conscientious nature will help you manage employee records and benefits with precision, while your warm-heartedness will create a supportive workplace culture.\",\"salary_range\":\"\\u20b130,000 - \\u20b175,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Psychology, Business Administration, or Human Resource Management\",\"key_skills\":[\"Conflict Resolution\",\"Recruitment\",\"Employee Relations\",\"Policy Implementation\",\"Benefits Administration\",\"Workplace Training\"],\"work_environment\":\"Office settings in corporate, government, or educational institutions, with opportunities for remote work in some companies\",\"career_progression\":\"HR Assistant \\u2192 HR Specialist \\u2192 HR Manager \\u2192 HR Director\"},{\"title\":\"Public Relations Officer\",\"match_percentage\":88,\"description\":\"As a Public Relations Officer, you\'ll be the bridge between organizations and the public, crafting compelling narratives and managing media relations. Your work will involve writing press releases, organizing events, and maintaining a positive public image. This dynamic role offers opportunities to work with diverse industries, from corporate to non-profits, and even government agencies.\",\"why_good_fit\":\"Your ESFJ traits of cooperation and harmony align perfectly with PR\'s need for relationship-building. Your strong performance in communication subjects (77 in Oral Communication and Media and Information Literacy) shows your ability to craft clear messages. Your analytical thinking (7\\/7) will help you assess public sentiment and adjust strategies accordingly. Your warm-hearted nature will make you excellent at crisis communication and reputation management.\",\"salary_range\":\"\\u20b128,000 - \\u20b170,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Communication, Journalism, or Marketing\",\"key_skills\":[\"Media Relations\",\"Crisis Communication\",\"Event Planning\",\"Public Speaking\",\"Content Creation\",\"Stakeholder Engagement\"],\"work_environment\":\"Fast-paced offices, often in corporate headquarters, government agencies, or PR firms, with frequent travel for events and press conferences\",\"career_progression\":\"PR Assistant \\u2192 PR Specialist \\u2192 PR Manager \\u2192 Director of Communications\"},{\"title\":\"Social Worker\",\"match_percentage\":87,\"description\":\"As a Social Worker, you\'ll empower individuals and communities by providing support and resources to those in need. Your work will involve case management, counseling, and advocacy for vulnerable populations. This meaningful career allows you to make a tangible difference in people\'s lives, with opportunities to specialize in areas like child welfare, healthcare, or community development.\",\"why_good_fit\":\"Your ESFJ personality is ideal for this caring profession, as you naturally want to help others and create harmonious environments. Your strong grades in social sciences (77 in Understanding Culture, Society and Politics) show your interest in societal issues. Your analytical thinking (7\\/7) will help you assess client needs and develop effective intervention plans. Your cooperative nature will make you excellent at collaborating with other professionals in multidisciplinary teams.\",\"salary_range\":\"\\u20b125,000 - \\u20b165,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Social Work, with licensure required for advanced roles\",\"key_skills\":[\"Case Management\",\"Counseling\",\"Advocacy\",\"Community Outreach\",\"Resource Coordination\",\"Empathy and Active Listening\"],\"work_environment\":\"Community centers, hospitals, government agencies, or non-profit organizations, often involving fieldwork and home visits\",\"career_progression\":\"Social Work Assistant \\u2192 Social Worker \\u2192 Senior Social Worker \\u2192 Social Work Supervisor\"},{\"title\":\"Event Planner\",\"match_percentage\":85,\"description\":\"As an Event Planner, you\'ll bring people together by organizing memorable experiences, from corporate conferences to weddings and cultural festivals. Your work will involve coordinating vendors, managing budgets, and ensuring every detail runs smoothly. This creative and social role offers opportunities to work with diverse clients and industries, with potential to specialize in areas like destination weddings or large-scale corporate events.\",\"why_good_fit\":\"Your ESFJ traits of cooperation and harmony make you naturally skilled at creating enjoyable experiences for others. Your strong performance in communication subjects (77 in Oral Communication and Media and Information Literacy) shows your ability to coordinate with multiple stakeholders. Your warm-hearted nature will help you understand client needs and create personalized events. Your analytical thinking (7\\/7) will help you manage logistics and budgets effectively.\",\"salary_range\":\"\\u20b125,000 - \\u20b160,000\",\"growth_outlook\":\"Medium\",\"education_required\":\"Bachelor\'s degree in Hospitality Management, Event Management, or related field\",\"key_skills\":[\"Vendor Coordination\",\"Budget Management\",\"Logistics Planning\",\"Creative Design\",\"Client Relations\",\"Problem-Solving\"],\"work_environment\":\"Event planning agencies, hotels, or as a freelance planner, with flexible hours and potential for remote work in some aspects\",\"career_progression\":\"Event Assistant \\u2192 Event Coordinator \\u2192 Event Manager \\u2192 Event Director\"},{\"title\":\"Customer Service Manager\",\"match_percentage\":89,\"description\":\"As a Customer Service Manager, you\'ll lead teams that provide exceptional service to clients, ensuring satisfaction and loyalty. Your work will involve training staff, resolving complaints, and implementing service improvements. This people-focused role offers opportunities to work in diverse industries, from retail to banking, with potential to advance to regional or national management roles.\",\"why_good_fit\":\"Your ESFJ personality is perfectly suited for this customer-facing role, as you naturally enjoy helping others and creating positive experiences. Your strong grades in communication subjects (77 in Oral Communication and Reading\\/Writing) show your ability to articulate service standards clearly. Your conscientious nature will help you maintain high service quality, while your cooperative spirit will make you excellent at team leadership. Your analytical thinking (7\\/7) will help you identify service trends and implement improvements.\",\"salary_range\":\"\\u20b135,000 - \\u20b180,000\",\"growth_outlook\":\"High\",\"education_required\":\"Bachelor\'s degree in Business Administration, Psychology, or related field\",\"key_skills\":[\"Team Leadership\",\"Conflict Resolution\",\"Customer Relations\",\"Quality Assurance\",\"Training and Development\",\"Data Analysis\"],\"work_environment\":\"Customer service departments in corporations, banks, or retail chains, with opportunities for remote management in some companies\",\"career_progression\":\"Customer Service Representative \\u2192 Customer Service Supervisor \\u2192 Customer Service Manager \\u2192 Director of Customer Experience\"}],\"personality_analysis\":{\"key_traits\":[\"Extroverted and People-Oriented (ESFJ)\",\"Strong Analytical Thinking (7\\/7)\",\"Cooperative and Harmonious\"],\"strengths\":[\"Excels in social interactions and teamwork\",\"Strong communication and interpersonal skills\",\"Conscientious and detail-oriented in tasks\"],\"areas_for_development\":[\"Could benefit from developing more independent problem-solving skills\",\"Might explore more technical or analytical subjects to complement strengths\"]},\"academic_analysis\":{\"strongest_subjects\":[\"Communication Subjects (Oral Communication, Reading\\/Writing, Media and Information Literacy)\",\"Social Sciences (Understanding Culture, Society and Politics)\"],\"recommendations\":[\"Consider taking additional courses in psychology or organizational behavior to enhance HR or social work skills\",\"Explore basic business or management courses to complement customer service or event planning interests\"]}}', '2025-10-30 11:09:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userRole` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `userName`, `userEmail`, `userRole`, `userPassword`) VALUES
(1, 'Jim Hadjili', 'jim.hadjili@gmail.com', NULL, '$2y$10$pbb.cll9uanmJD6nfmsXCeIQ212mGKbfnW/Ojo.y6TlLzZGeTEEwe'),
(2, 'dcsd', 'almujim.hadjili@gmail.com', NULL, '$2y$10$Gmrtkarxlthw3zfdZ4FMC.N5s0wCEkdkVeS7IQoUfDtvWG..UP4Eu'),
(3, 'cs', 'wwwww@gmail.com', NULL, '$2y$10$hzEFGyV8f/84jPA75qh3iOZ0TmGAoeMY1nlcXLDd44KNTMcxTWCtC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career_path_tb`
--
ALTER TABLE `career_path_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career_path_tb`
--
ALTER TABLE `career_path_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  ADD CONSTRAINT `quiz_results_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
