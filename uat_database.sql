-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 07:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uat_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `appointment_type` varchar(20) NOT NULL,
  `appointment_date` varchar(20) NOT NULL,
  `optional_message` varchar(6000) DEFAULT NULL,
  `booked_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`Id`, `fullname`, `email`, `phone`, `appointment_type`, `appointment_date`, `optional_message`, `booked_date`) VALUES
(1, 'Mark Friday', 'davidmarkfriday16@gmail.com', '08072157818', 'Physical', '2023-07-15', 'Just testing it', '2023:07:15 19:30:54 PM');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `Id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `facebook_link` varchar(300) NOT NULL,
  `twitter_link` varchar(300) NOT NULL,
  `instagram_link` varchar(300) NOT NULL,
  `tiktok_link` varchar(300) NOT NULL,
  `linkedin_link` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`Id`, `address`, `phone_number`, `email`, `facebook_link`, `twitter_link`, `instagram_link`, `tiktok_link`, `linkedin_link`) VALUES
(1, '#29 Maxwell Street, Trademore Estate, Lugbe - Abuja, Nigeria.', '(+234) 812 1277 401', 'info@uat-wellness.com', 'https://web.facebook.com/profile.php?id=100085256945875', 'https://twitter.com/TherapiesUju', 'https://www.instagram.com/ujuat/', 'https://www.tiktok.com/@ujuat?lang=en', 'https://www.linkedin.com/in/uju-alternative-therapies-79ba53248/');

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribers`
--

CREATE TABLE `email_subscribers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `confirmation_code` varchar(100) NOT NULL,
  `subscription_date` varchar(30) DEFAULT NULL,
  `confirmation_status` varchar(30) DEFAULT NULL,
  `confirmation_time_lapse` varchar(30) DEFAULT NULL,
  `subscription_status` varchar(30) DEFAULT NULL,
  `date_unsubscribed` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_subscribers`
--

INSERT INTO `email_subscribers` (`id`, `first_name`, `email`, `confirmation_code`, `subscription_date`, `confirmation_status`, `confirmation_time_lapse`, `subscription_status`, `date_unsubscribed`) VALUES
(1, 'Mark', 'davidmarkfriday16@gmail.com', '6c151d95606b41de53ee79f4beaa9ddc', '2023-06-30 15:13:34 PM', 'Confirmed', '3d, 1h, 7m, 11s', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `Id` int(11) NOT NULL,
  `faq` varchar(100) NOT NULL,
  `answer` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`Id`, `faq`, `answer`) VALUES
(1, 'Is Uju Alternative Therapies a medical center?', '<p>No, Uju Alternative Therapies is not a medical center but a wellness center. Medical centers like hospital and clinics treat patients using synthetics medicines and surgeries, while wellness centers like UAT helps the sick get healed using natural and alternative remedies.</p>'),
(2, 'How is UAT different from other herbal or natural healthcare centers?', '<p>Most other alternative healthcare centers mainly specialize on one major healing modality to address diseases, while UAT uses combination of different healing modalities address the disease and ensure lasting and permanent healing.</p>'),
(3, 'What is RCD and how is it unique, compared to other forms of test?', '<p>In Traditional Chinese Medicine, it\'s believed that diseases are merely symptoms of certain underlying conditions, and that all diseases or symptoms are caused by imbalances in the body, and will go away once the imbalances are addressed.</p>\r\n\r\n<p>That is where RCD (Root Cause Diagnosis) Test comes in. Its aim is to identify imbalances in the body by analyzing certain parts of the body like hair lining, eyes, tongue, jaw line, fingers, toes, urine, including fecal matter and whole-body shape; because the body reveals imbalances in them long before symptoms are felt.</p>'),
(4, 'Do therapies offered in UAT work well for everybody and every case?', '<p>No, individuals are different and unique, so are expected to react to various therapies differently. A specific pattern of therapy that works for one person might have a slightly different effect on another. It is up to us to figure out and advise on the best healing path for each patient, and up to the client to accept.</p>'),
(5, 'Are all conditions accepted?', '<p>No, we currently don’t accept cases involving end stages of chronic diseases (like end stage cancer or diabetes), and cases where an organ has failed already.</p>'),
(6, 'Is there a money back policy?', '<p>Yes, if a case is rejected after RCD has been paid for and done, we will immediately refund the payment. If we can’t help you, we shouldn’t collect your money, simple.</p>'),
(7, 'Is UAT opposed to conventional medical treatments like drugs and surgery?', '<p>No, we are not. We believe they are necessary in certain situations.</p>'),
(8, 'Are remedies and therapies offered in UAT safe and effective?', '<p>Yes, the remedies and therapies we practice are natural and are applied by trained health professionals. So they are safe and effective.</p>'),
(9, 'How long do the healing programs last?', '<p>It depends on many factors especially the severity of the condition and how quick the patient’s body choose to respond. On average, 3-6 months. But mind you, there are conditions that take a much longer time to reverse, like liver cirrhosis.</p>'),
(10, 'What are involved in a complete healing program?', '<p>In most cases, Chinese herbs, toxic free supplements, diet & lifestyle habits modifications, detox and other alternative therapies like cupping, acupuncture, zapping, chromo-therapy, etc., are involved.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `uat_testimonials`
--

CREATE TABLE `uat_testimonials` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `testimony` varchar(5000) NOT NULL,
  `testimony_summary` varchar(1000) NOT NULL,
  `illness_tags` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uat_testimonials`
--

INSERT INTO `uat_testimonials` (`Id`, `name`, `avatar`, `location`, `testimony`, `testimony_summary`, `illness_tags`, `date_added`) VALUES
(1, 'Janet Gimba', 'resources/images/testimonials/janet.jpeg', 'Abuja, Nigeria', '<p>The past few years, I have been getting sick frequently and taking treatment. Last year it got worse, I started experiencing some intense and unusual symptoms like frequent headaches, right abdominal pains, dizziness and always running temperature. I was taking prescribed drugs but I wasn’t getting better, then a doctor in Garki Hospital, Abuja, told me to do some test and bring him the result.</p>\r\n\r\n<p>When I went back with the result, he told me that I have Hepatitis-B, I asked him how can it be cured, he said it has no cure but can only be managed. I was so distraught and sad. When I got back home, a friend of mine Ike was at the house to visit, he and the others at home asked me why I was so sad, I told them what the doctor said, then Ike told me that his brother who is a Naturopath in China is back to Nigeria, and that he is sure his brother can help, but that I should wait for him to inform his brother first.</p>\r\n\r\n<p>The next day, Ike called me that his Doctor brother said he can handle my case, that I should come to his office. I quickly went and met Dr. Peter, he told me that Hepatitis can be reversed, but first I need to do RCD test which will reveal what is causing the hepatitis and how the hepatitis will be treated. He then proceeded to take photos of my eye, tongue, head, fingers and toe nails; then he told me to go home and relax, that he will ask Ike to call me once my test report is ready, I was called back after 2 days, he explained my test report to me and told me to start therapy immediately which I did.</p>\r\n\r\n<p>I started feeling the symptoms reducing from day 3 of the therapies and healing program, gradually I kept getting better and better; the pain in my abdomen kept reducing, the dizziness stopped, the headaches stopped, basically by week 4, all the symptoms have completely stopped.</p>\r\n\r\n<p>Dr. Peter encouraged me to continue the therapies and healing program for 3 months before going for test to confirm that the hepatitis has been cured. It’s almost 3 months now, and it has been confirmed that I am 100% hepatitis free. I am very thankful to God. God bless you Dr. Peter. I am so so grateful.</p>', 'The past few years, I have been suffering from frequent headaches to abdominal pains, and was diagnosed with Hepatitis B of which I was told it has no cure. Luckily, a friend of mine called Ike, introduced me to Dr. Peter of Uju Alternative Therapies. He did an RCD Test on me and put me on a healing program. And within a month, I was completely healed. Thanks so much Dr. Peter.', 'Hepatitis B, Frequent headaches, Abdominal pains', '2023-04-30 19:40:53'),
(2, 'Mr. Zaphaniah Zakari', 'resources/images/testimonials/zaphania.jpeg', 'Abuja, Nigeria', '<p>I was diagnosed with High Blood Pressure and suffered severe frequent headaches for a long time and have been on BP medications, but they were not helping. I was just managing myself day by day.</p>\r\n\r\n<p>One day during DTS class program in Family Worship Center Church, Dr. Peter introduced himself as a TCM Naturopathic Doctor, so I waited and met him after the program. He invited me to his healing home, where I did his RCD test, after 2 days when the RCD Report was out, he explained the result to me and encouraged me to start the Healing Program recommended in the RCD Report, which I did.</p>\r\n\r\n<p>By just doing the in-house therapies and some simple diet modifications, I started getting better within a few days even without purchasing the recommended Chinese herbs and supplements, and by the next month, all the BP symptoms were gone, and no more frequent headaches. Dr. Peter is such a blessing, and I praise God for connecting me to him.</p>', 'Was diagnosed with High Blood Pressure and suffered severe frequent headaches for a long time. I took several BP medications, but they were not helping. One day, Dr. Peter introduced himself as a Naturopathic Doctor in the Church I attend. I met him afterwards and explained my health challenges to him. He placed me on a healing program, and within a Month, I was completely healed of the HBP, and no more frequent headaches.', 'High Blood Pressure, Migraine', '2023-05-01 14:02:27'),
(3, 'Mrs. Amara Dimple', 'resources/images/testimonials/amara.jpg', 'Abia State, Nigeria', '<p>I met Dr. Peter on Facebook over some like-minded group discussion, we became friends very quick. I got to know he is a practicing Naturopath, as we became closer, I opened up to him about my health struggles. He told me not to worry, that if there is no completely damaged organ, any disease is curable using the right therapies and medicine.</p>\r\n\r\n<p>He asked me to send him some photos for a test he called RCD, he said the test report will reveal the root cause of all my health problems, as well as all that is needed to heal completely. Wow, I did as I was told, when the report was ready, we video chatted and he explained everything to me and then gave me a healing program to follow.</p>\r\n\r\n<p>The program involved herbs, supplements, lifestyle modification, diet changes and some kind of therapies I am not familiar with. Wow, I don’t know how to explain, but to cut long story short, within 4 months all my health problems were gone completely. I am now Hepatis-B negative, no more menstrual pain at all, I now sleep well and all my liver problem symptoms have cleared.</p>\r\n\r\n<p>Even the dark circle around my eyes which Peter said is a sign of adrenal fatigue has almost completely cleared. I am so happy, please share my testimony anywhere, feel free to add my picture and even number, anyone who doubt can call me. Thank you my one and only doc.</p>', 'I met Dr. Peter in a Facebook group, during some like-minded discussion. We became friends, and I got to know he is a practicing Naturopath. I opened up to him about my health struggles. He carried out an RCD Test on me, after which He placed me on a healing program. Within 4 months, I was completely healed. I\'m now Hepatitis-B negative. Thank you my one and only doc.', 'Hepatitis B, Severe menstrual pain, Insomnia, Liver issues', '2023-05-01 13:36:50'),
(4, 'Mrs. Uche Nwachukwu', 'resources/images/testimonials/nwachukwu.jpeg', 'Kano State, Nigeria', '<p>I suffered from Arthritis, Knee Pain and Chest Pain due to Ulcer for more than 15 years. I spent money on all types of treatment. I only feel better for a few weeks, then the pain will return, so I have been relying on daily medication.</p>\r\n\r\n<p>I met Dr. Peter when he came to visit his parents in Kano. He told me to do RCD Test and he will tell me exactly what is wrong inside me and how to heal it. I did the test, got my result and he promised me that if I do up to half of his healing program suggestions, that healing is guaranteed in a few months.</p>\r\n\r\n<p>Honestly, I did less than half because I didn’t have enough money. I started seeing changes few days after I started the healing program. By the 4th day, the Ulcer pain stopped, and by the 8th day, the Knee pain and Waist pain stopped completely.</p>\r\n\r\n<p>7 months later and I’m still pain free. It’s like a miracle! I also noticed other good things: I lost many weights and I am feeling light like a normal human being, no more frequent headaches, I can now sleep before midnight and sleep well, and eye no longer turn me sometimes when walking. Me and my Husband, and entire household are very grateful.</p>', 'I suffered from Arthritis, Knee Pain and Chest Pain due to Ulcer for more than 15 years. I spent money on all types of treatment. I only felt better for a few weeks and the pain will return. Fortunately, I met Dr. Peter. He performed an RCD Test on me, placed me on a healing program and within a short while, I was completely healed. Me and my entire household are very grateful.', 'Ulcer, Arthritis, Chest pain, Knee pain', '2023-05-01 14:09:22'),
(5, 'Mrs. Anita Mamdu', 'resources/images/testimonials/anita.jpeg', 'Gombe State, Nigeria', '<p>All through my bachelor’s degree program, I suffered from constant infections and illness especially Typhoid and Malaria which I was experiencing almost every month. In 2017 I was also diagnosed of PID and Ovarian Cyst. I have been taking different medications for it since then, but the symptom keeps coming back from time to time.</p>\r\n\r\n<p>Sometimes I try herbal medicines, but also to no avail. I was posted to Abuja for my Youth Service, then I met Dr. Peter in an event in Church (Family Worship Center) while he was lecturing a few members outside about health. I picked interest, waited and met him when he was about leaving the Church.</p>\r\n\r\n<p>I told him of my health challenges and diagnoses, he said that all my diagnoses are most likely caused by the same root cause or imbalance, compromised immune system due to some others things. He told me if I can do RCD test, from the test report he will tell me exactly all it will take to heal completely.</p> \r\n\r\n<p>Later I agreed, we did the test, when the result was out, he explained all to me, then I got some of the recommended Chinese herbs and supplements, and I started the recommended healing program.</p>\r\n\r\n<p>After a few days of starting, I noticed all the PID and Ovarian Cyst were fading, I was so happy, but in my 3rd week, I had Malaria and Typhoid symptoms, Dr. Peter examined me and said that they were actually herxheimer reactions due to my body’s rapid detox and healing process. I continued with the program and it stopped 2 days later for good. That was the last Malaria and Typhoid I ever experienced.</p>\r\n\r\n<p>Now 8 months later, no more recurring Malaria and Typhoid, no more PID, no more Ovarian Cyst.</p>', 'It was during my Youth Service in Abuja that I met Dr. Peter in an event in Church where he was lecturing some members about health. I told him about how I have been suffering from constant Typhoid and Malaria, including PID and Ovarian Cyst. He did an RCD Test for me and placed me on a healing program. I got healed in a few weeks. It\'s been 8 months now and I have not experienced any of such symptoms.', 'Typhoid, Malaria, Ovarian Cyst and PID', '2023-05-01 17:40:38'),
(6, 'Mr. Abdul Baba', 'resources/images/testimonials/abdul.jpeg', 'Kano State, Nigeria', '<p>A friend connected me to Dr. Peter while he was still living in China. I told him about my sickness and how long I have been suffering from them and all I have done and spent to treat them. He told me he can help me but I should be patient for him to return to Nigeria in a few weeks’ time, so I can be visiting his place for therapies.</p>\r\n\r\n<p>I told him of my health challenges and diagnoses, he said they’re most likely caused by the same root cause or imbalance, compromised immune system due to some others things. He told me if I can do RCD Test, from the test report he will tell me exactly all it will take to heal completely.</p>\r\n\r\n<p>Later I agreed, we did the test, when the result was out, he explained all to me, then I got some of the recommended Chinese herbs and supplements, and started the recommended healing program.</p>\r\n\r\n<p>He returned, did a test on me and I commenced healing therapies which also involves supplements and herbs. Now my High Blood Pressure is completely cured, and my eyes has improved greatly. In a few weeks, I am sure it will be totally healed.</p>\r\n\r\n<p>I am very very thankful to Dr. Peter for this kindness.</p>', 'A friend connected me to Dr. Peter while he was still living in China. I told him about my illness and he said they\'re most likely caused by some imbalance and compromised immune system, and told me he will be back to Nigeria soon. When he came back, he did an RCD Test for me and gave me healing recommendations. Now my BP is back to normal and my eyes have improved greatly. I\'m very grateful to Dr. Peter.', 'High Blood Pressure, Glaucoma ', '2023-05-01 17:49:07'),
(7, 'Mr. Nate Emmanuel ', 'resources/images/testimonials/male-avatar.svg', 'Uyo, Nigeria', '<p>A Facebook friend gave me Dr. Peter’s number and told me the doctor guarantees cure for High Blood Pressure if there is no damaged organ yet. I wasn’t sure but decided to try.</p>\r\n\r\n<p>I called Doc, he told me if I do the RCD Test, my test report will show my real problems and what is needed to cure them permanently. I did as he advised. Long story short, after 3 months, I am now completely off my HBP medications and have no symptoms of HBP, and no headaches and migraines for almost 1 month now.</p>\r\n\r\n<p>My health has also improved significantly that I no longer need aphrodisiac to perform. Dr. Peter’s healing program really works, a little pricy but it is well worth it. Thank you.</p>', 'A friend gave me Dr. Peter\'s contact and told me he guarantees cure for High Blood Pressure, which I was suffering from, including Migraine and Erectile Dysfunction. I called Doc and explained my health challenges to him. He placed me on a healing program after an RCD Test. Now my Blood Pressure is back to normal, and I no longer need aphrodisiac to perform.', 'High Blood Pressure, Migraines, Erectile Dysfunction ', '2023-05-01 18:15:35'),
(8, 'Mrs. Nwachi', 'resources/images/testimonials/nwachi.jpeg', 'Abakiliki, Nigeria', '<p>I found Therapist Peter Emeka in a Facebook group where he gives free natural remedies to illnesses, I messaged him privately and told him how I’ve been suffering from liver problem, abdominal pain and the worst menstrual pain ever.</p>\r\n\r\n<p>He requested for some pictures and did an RCD Test, then he sent me a report containing my RCD Test diagnosis and healing recommendation.\r\nI was very skeptical but he kept encouraging me to follow the suggestions in the report.</p>\r\n\r\n<p>Once I started doing so, I started feeling better gradually. In the course of 2 weeks, the abdominal pain stopped completely. The real miracle was when my next period came without pain or heavy flow, just some bad smell, which also stopped by the next period.</p>\r\n\r\n<p>I feel so lucky to have been in Therapist Peter’s Facebook group.</p>', 'I found Therapist Peter Emeka in a Facebook group where he gives free natural remedies to illnesses. I messaged him and told him how I\'ve been suffering from liver problem, abdominal pain and painful menstruation. He requested for some pictures and did an RCD Test, after which he gave me healing recommendations. Within two weeks, I was completely healed of the abdominal pain and other symptoms.', 'Liver problem, Abdominal pain, Menstrual pain', '2023-05-01 17:41:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `email_subscribers`
--
ALTER TABLE `email_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uat_testimonials`
--
ALTER TABLE `uat_testimonials`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_subscribers`
--
ALTER TABLE `email_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uat_testimonials`
--
ALTER TABLE `uat_testimonials`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
