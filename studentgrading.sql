-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2014 at 04:18 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studentgrading`
--

-- --------------------------------------------------------

--
-- Table structure for table `acadmic_details`
--

CREATE TABLE IF NOT EXISTS `acadmic_details` (
  `username` varchar(10) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `year` year(4) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `grade` varchar(2) NOT NULL,
  PRIMARY KEY (`username`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acadmic_details`
--

INSERT INTO `acadmic_details` (`username`, `course_id`, `year`, `semester`, `grade`) VALUES
('y09uc089', 'CN-LAB', 2014, '8', 'B'),
('y10pg045', 'CN-LAB', 2014, '4', 'B'),
('y11uc208', 'ECE101', 2014, '6', 'B'),
('y11uc231', 'CN-LAB', 2014, '6', 'B'),
('y11uc231', 'ECE101', 2014, '5', 'AB'),
('y11uc233', 'ECE101', 2014, '8', 'B'),
('y13uc045', 'CN', 2014, '2', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(40) NOT NULL,
  `credits` int(5) NOT NULL,
  `wtgquiz1` int(11) DEFAULT NULL,
  `wtgquiz2` int(11) DEFAULT NULL,
  `wtgquiz3` int(11) DEFAULT NULL,
  `wtgquiz4` int(11) DEFAULT NULL,
  `wtgquiz5` int(11) DEFAULT NULL,
  `wtgquiz6` int(11) DEFAULT NULL,
  `wtgquiz7` int(11) DEFAULT NULL,
  `wtgquiz8` int(11) DEFAULT NULL,
  `wtgmid_term1` int(11) DEFAULT NULL,
  `wtgmid_term2` int(11) DEFAULT NULL,
  `wtgend_term` int(11) DEFAULT NULL,
  `marksquiz1` int(11) DEFAULT NULL,
  `marksquiz2` int(11) DEFAULT NULL,
  `marksquiz3` int(11) DEFAULT NULL,
  `marksquiz4` int(11) DEFAULT NULL,
  `marksquiz5` int(11) DEFAULT NULL,
  `marksquiz6` int(11) DEFAULT NULL,
  `marksquiz7` int(11) DEFAULT NULL,
  `marksquiz8` int(11) DEFAULT NULL,
  `marksmid_term1` int(11) DEFAULT NULL,
  `marksmid_term2` int(11) DEFAULT NULL,
  `marksend_term` int(11) DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `credits`, `wtgquiz1`, `wtgquiz2`, `wtgquiz3`, `wtgquiz4`, `wtgquiz5`, `wtgquiz6`, `wtgquiz7`, `wtgquiz8`, `wtgmid_term1`, `wtgmid_term2`, `wtgend_term`, `marksquiz1`, `marksquiz2`, `marksquiz3`, `marksquiz4`, `marksquiz5`, `marksquiz6`, `marksquiz7`, `marksquiz8`, `marksmid_term1`, `marksmid_term2`, `marksend_term`) VALUES
('AI', 'Artificial Intelligence', 5, 5, 5, 5, 5, 5, 0, 0, 0, 15, 20, 40, 10, 10, 10, 10, 10, 0, 0, 0, 30, 40, 80),
('CN', 'Computer Networks', 4, 10, 10, 0, 0, 0, 0, 0, 0, 20, 20, 40, 20, 20, 0, 0, 0, 0, 0, 0, 40, 40, 80),
('CN-LAB', 'Computer Networks Lab', 4, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20, 60, 0, 0, 0, 0, 0, 0, 0, 0, 20, 20, 60),
('CP', 'Computer Programming', 4, 5, 5, 5, 5, 5, 5, 5, 5, 10, 10, 40, 10, 10, 10, 10, 10, 10, 10, 10, 40, 40, 90),
('dcs', 'Digital Circuits and System', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('DIP', 'Digital Image Processing', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('DSA', 'Data Structures', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('ECE101', 'Control System and Engineering', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('french', 'French Basic', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('maw', 'Malware Ananlysis', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('SEPM', 'Software Engineering', 6, 25, 0, 0, 0, 0, 0, 0, 0, 15, 20, 40, 25, 0, 0, 0, 0, 0, 0, 0, 70, 40, 80),
('TOC', 'Theory Of Computation', 5, 5, 5, 5, 5, 0, 0, 0, 0, 20, 20, 40, 10, 10, 10, 10, 10, 10, 10, 0, 20, 20, 80);

-- --------------------------------------------------------

--
-- Table structure for table `currently_courses`
--

CREATE TABLE IF NOT EXISTS `currently_courses` (
  `username` varchar(10) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `quiz1` int(11) DEFAULT NULL,
  `quiz2` int(11) DEFAULT NULL,
  `quiz3` int(11) DEFAULT NULL,
  `quiz4` int(11) DEFAULT NULL,
  `quiz5` int(11) DEFAULT NULL,
  `quiz6` int(11) DEFAULT NULL,
  `quiz7` int(11) DEFAULT NULL,
  `quiz8` int(11) DEFAULT NULL,
  `mid_term1` int(11) DEFAULT NULL,
  `mid_term2` int(11) DEFAULT NULL,
  `end_term` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `grade` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`username`,`course_id`),
  KEY `username` (`username`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currently_courses`
--

INSERT INTO `currently_courses` (`username`, `course_id`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `quiz6`, `quiz7`, `quiz8`, `mid_term1`, `mid_term2`, `end_term`, `total_marks`, `grade`) VALUES
('y09uc089', 'AI', 7, 10, 8, 5, 4, 0, NULL, NULL, 18, 11, 60, 62, 'BC'),
('y09uc089', 'CN', 7, 8, 9, 8, NULL, NULL, NULL, NULL, 30, 25, 60, 65, 'A'),
('y10pg045', 'AI', 6, 0, 8, 3, 5, 0, NULL, NULL, 19, 12, 55, 54, 'C'),
('y10uc186', 'AI', 8, 10, 7, 6, 6, NULL, NULL, NULL, 22, 14, 55, 64, 'BC'),
('y11pg147', 'AI', 5, 5, 9, 7, 3, NULL, NULL, NULL, 25, 15, 65, 67, 'B'),
('y11uc020', 'CN', 8, 9, 5, 6, NULL, NULL, NULL, NULL, 20, 25, 50, 56, 'AB'),
('y11uc020', 'TOC', 8, 4, 8, 5, NULL, NULL, NULL, NULL, 13, 8, 67, 67, 'BC'),
('y11uc022', 'AI', 4, 4, 4, 9, 2, NULL, NULL, NULL, 15, 12, 56, 53, 'C'),
('y11uc022', 'CN', 3, 4, 6, 7, NULL, NULL, NULL, NULL, 15, 18, 40, 40, 'C'),
('y11uc022', 'TOC', 7, 5, 6, 4, NULL, NULL, NULL, NULL, 12, 9, 61, 63, 'C'),
('y11uc023', 'TOC', 9, 3, 4, 2, NULL, NULL, NULL, NULL, 15, 5, 56, 57, 'D'),
('y11uc034', 'AI', 10, 2, 8, 5, 7, NULL, NULL, NULL, 13, 7, 64, 58, 'BC'),
('y11uc034', 'CN', 5, 7, 8, 9, NULL, NULL, NULL, NULL, 20, 30, 50, 56, 'AB'),
('y11uc034', 'TOC', 2, 0, 5, 4, NULL, NULL, NULL, NULL, 16, 13, 74, 72, 'B'),
('y11uc038', 'AI', 9, 9, 9, 7, 6, NULL, NULL, NULL, 26, 17, 70, 77, 'A'),
('y11uc038', 'CN', 4, 5, 6, 7, NULL, NULL, NULL, NULL, 30, 25, 40, 52, 'B'),
('y11uc038', 'SEPM', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, 32, NULL, 54, 'B'),
('y11uc038', 'TOC', 3, 6, 7, 3, NULL, NULL, NULL, NULL, 11, 10, 71, 66, 'BC'),
('y11uc045', 'CN', 3, 5, 7, 9, NULL, NULL, NULL, NULL, 30, 25, 50, 57, 'AB'),
('y11uc055', 'AI', 8, 8, 4, 7, 8, NULL, NULL, NULL, 11, 8, 75, 65, 'BC'),
('y11uc055', 'CN', 8, 9, 7, 9, NULL, NULL, NULL, NULL, 15, 10, 30, 36, 'CD'),
('y11uc055', 'SEPM', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 29, NULL, 54, 'B'),
('y11uc055', 'TOC', 7, 5, 9, 5, NULL, NULL, NULL, NULL, 9, 7, 56, 57, 'D'),
('y11uc070', 'AI', 2, 4, 6, 9, 4, NULL, NULL, NULL, 7, 18, 56, 53, 'C'),
('y11uc070', 'SEPM', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, 31, NULL, 48, 'CD'),
('y11uc088', 'AI', 4, 2, 8, 5, 4, NULL, NULL, NULL, 5, 3, 60, 46, 'D'),
('y11uc089', 'AI', 5, 5, 1, 8, 7, NULL, NULL, NULL, 15, 10, 34, 43, 'E'),
('y11uc208', 'AI', 10, 9, 3, 7, 8, NULL, NULL, NULL, 22, 14, 69, 71, 'AB'),
('y11uc208', 'CN', 7, 8, 6, 8, NULL, NULL, NULL, NULL, 10, 15, 35, 38, 'C'),
('y11uc208', 'SEPM', 32, 0, 0, NULL, NULL, NULL, NULL, NULL, 32, 35, 0, 56, 'B'),
('y11uc208', 'TOC', 10, 8, 6, 3, NULL, NULL, NULL, NULL, 17, 14, 69, 79, 'A'),
('y11uc231', 'AI', 0, 10, 10, 10, 10, NULL, NULL, NULL, 27, 11, 68, 73, 'AB'),
('y11uc231', 'CN', 5, 6, 7, 8, NULL, NULL, NULL, NULL, 15, 20, 20, 33, 'CD'),
('y11uc231', 'DSA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('y11uc231', 'SEPM', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, 32, NULL, 57, 'B'),
('y11uc231', 'TOC', 9, 6, 9, 2, NULL, NULL, NULL, NULL, 18, 13, 65, 77, 'A'),
('y11uc233', 'AI', 10, 1, 9, 6, 5, NULL, NULL, NULL, 14, 19, 71, 68, 'B'),
('y11uc233', 'SEPM', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, 26, NULL, 54, 'B'),
('y11uc250', 'SEPM', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, 43, NULL, 64, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL DEFAULT 'NOT NULL',
  `name` varchar(40) NOT NULL,
  `room_no` varchar(5) NOT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `updates` varchar(100) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`username`, `password`, `name`, `room_no`, `phone_no`, `mobile_no`, `email_id`, `updates`, `timestamp`) VALUES
('fc012', 'fc012', 'Sudhir Kumar Gupta', '2079', '06412302710', '9876543311', 'skg@gmail.com', '', '0000-00-00'),
('poonam', 'poonam', 'Poonam Gera', '78', '8976', '987654534', 'hbbfsdhbjh@ymail.com', 'Quiz 2 Updated', '2014-04-02'),
('preety', 'preety', 'Preety SIngh', '', '943127244', '', 'preetysingh@gmail.com', 'Dip Marks Updated', '2014-04-16'),
('rpg', 'rpg', 'Ravi Prakash Gorthi', '2451', '9461219803', '06412302710', 'rpg@gmail.com', 'Garde Submitted', '2014-04-17'),
('sagar', 'sagar', 'Dayanand Sharma', '', '9461219803', '', 'vidyasagar@gmail.com', 'Frech Marks Updated', '2014-04-16'),
('sandeep', 'sandeep', 'Sandeep Saini', '4568', '9412567809', '06412302710', 'sandeep@gmail.com', 'Mid Term Marks Update', '2014-04-12'),
('sunil', 'sunil', 'Sunil Kumar', '100', '98787', '09087654543', 'sunil@gmail.com', 'Quiz 5 Marks Updated', '2014-04-13'),
('surendar', 'surendar', 'Surendar Sharma', '23432', '43095845', '458925', 'fdvgsd@gmail.com', 'Quiz 4 Marks Updated', '2014-04-11'),
('vikas', 'vikas', 'Vikas Bajpayee', '', '9461219803', '', 'vikas@gmail.com', 'Students Can collect Their Certificates for C lab TA', '2014-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `isalloted`
--

CREATE TABLE IF NOT EXISTS `isalloted` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `course_id` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`,`course_id`),
  KEY `course_id` (`course_id`),
  KEY `faculty_id` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isalloted`
--

INSERT INTO `isalloted` (`username`, `course_id`) VALUES
('rpg', 'AI'),
('sunil', 'CN'),
('poonam', 'CN-LAB'),
('sunil', 'CN-LAB'),
('sandeep', 'ECE101'),
('sagar', 'french'),
('fc012', 'maw'),
('rpg', 'SEPM'),
('poonam', 'TOC');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `fathers_name` varchar(40) NOT NULL,
  `mothers_name` varchar(40) NOT NULL,
  `d_o_b` date NOT NULL,
  `nationality` varchar(15) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `caste` varchar(15) NOT NULL,
  `category` varchar(10) NOT NULL,
  `religion` varchar(10) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `alt_email_id` varchar(25) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `local_add` varchar(150) NOT NULL,
  `fathers_number` varchar(15) NOT NULL,
  `landline_no` varchar(15) DEFAULT NULL,
  `degree` varchar(20) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `date_of_joining` date NOT NULL,
  `batch` varchar(4) NOT NULL,
  `hostel` varchar(5) NOT NULL,
  `room_no` varchar(6) NOT NULL,
  `medical_history` varchar(150) DEFAULT NULL,
  `blood_gp` varchar(2) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `bmi_index` int(11) DEFAULT NULL,
  `current_condition` varchar(10) DEFAULT NULL,
  `name_of_sport` varchar(30) DEFAULT NULL,
  `level_in_sport` int(11) DEFAULT NULL,
  `achievement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`username`, `password`, `name`, `fathers_name`, `mothers_name`, `d_o_b`, `nationality`, `gender`, `caste`, `category`, `religion`, `email_id`, `alt_email_id`, `contact_no`, `local_add`, `fathers_number`, `landline_no`, `degree`, `branch`, `semester`, `date_of_joining`, `batch`, `hostel`, `room_no`, `medical_history`, `blood_gp`, `weight`, `height`, `bmi_index`, `current_condition`, `name_of_sport`, `level_in_sport`, `achievement`) VALUES
('y09uc089', 'aman@89', 'Aman Garg', 'Mr.Suman Garg', 'Mrs.Sumedhi Garg', '1991-09-09', 'indian', 'm', 'hindu', 'gen', 'hindu', 'aman.garg@gmail.com', 'null', '987865434', 'kota,rajasthan', '9897867565', '346-8765644', 'btech', 'cse', 8, '2009-07-07', 'y09', 'bh1', 'b-09', 'null', 'o+', 67, 6, 16, 'normal', 'chess', 4, 'national level champion'),
('y10pg045', 'vasu@45', 'Vasudev Gupta', 'Mr.Brijlal Gupta', 'Mrs.Sumedha Gupta ', '1991-12-06', 'indian', 'm', 'hindu', 'gen', 'hindu', 'vasu.lnmiit@gmail.com', 'null', '0987654324', 'delhi', '9087656454', '9898-6545767', 'mtech', 'cse', 4, '2010-08-09', 'y10', 'bh3', 'a-11', 'null', 'b+', 50, 6, 14, 'normal', 'badminton', 2, 'null'),
('y10uc086', 'shivani@86', 'Shivani Shah', 'Mr.M.L.Shah', 'Dr.S.L.Shah', '1992-08-03', 'indian', 'f', 'hindu', 'gen', 'hindu', 'sh.shah@ymail.com', 'null', '098786654', 'bikaner,rajasthan', '09876545966', '4567-8767564', 'btech hons.', 'mme', 8, '2010-09-03', 'y10', 'gh2', 'd-4', 'null', 'b+', 56, 5, 21, 'normal', 'cricket', 4, 'null'),
('y10uc117', 'ak.117', 'Ankit Kamboj', 'Mr.Anil Kamboj', 'Dr.Anita Kamboj', '1992-05-03', 'indian', 'm', 'hindu', 'gen', 'hindu', 'ak.1992@gmail.com', 'null', '89765434568', 'jaipur', '0987654578', '9845-098738', 'btech', 'ece', 8, '2010-07-19', 'y10', 'bh1', 'a-10', 'null', 'a+', 65, 5, 15, 'normal', 'chess', 3, 'null'),
('y10uc186', 'ag.186', 'Anshul Garg', 'Mr.S.K.Garg', 'Er.M.K.Garg', '1993-05-07', 'indian', 'm', 'hindu', 'obc', 'hindu', 'anshul.garg@yahoo.com', 'null', '09876754990', 'vidyut nagar,patna', '09876548876', '34598978', 'mtech', 'mme', 8, '2010-09-03', 'y10', 'bh1', 'a-12', 'null', 'a+', 56, 5, 17, 'normal', 'chess', 4, 'national level champion'),
('y11pg147', 'rh.147', 'Rohit Sarkar', 'Mr.Deepak Sarkar', 'Dr.D.S.Sarkar', '1992-06-06', 'indian', 'm', 'hindu', 'gen', 'hindu', 'rh1991@gmail.com', 'null', '0987654356', 'kota', '098765467890', '8976-99876', 'mtech', 'cce', 4, '2011-07-09', 'y11', 'gh1', 'b-78', 'null', 'a-', 45, 5, 14, 'normal', 'karate', 2, 'null'),
('y11uc020', 'mk.13', 'Manish Kumar', 'Mr.Vijay Kumar', 'Mrs.anjali kumar', '1991-07-09', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'manish@yahoo.com', 'null', '09893765789', 'alwar,rajasthan', '09878654432', '988-7632882', 'btech hons.', 'cse', 6, '2011-07-10', 'y11', 'bh1', 'c-213', 'null', 'o+', 65, 5, 17, 'normal', 'cricket', 2, 'null'),
('y11uc022', 'aman@91', 'Aman Mathur', 'Mr.Anil Mathur', 'Mrs.anjali mathur', '1991-09-08', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'aman.mathur@gmail.com', 'null', '09827816253', 'patna,bihar', '09876251670', '0141-2334877', 'btech', 'ece', 6, '2011-07-20', 'y11', 'bh1', 'd-211', 'null', 'a+', 56, 5, 18, 'normal', 'cricket', 2, 'state level champion'),
('y11uc023', 'srt.154', 'Sachin Tendulkar', 'Mr.Ramesh Tendulkar', 'Mrs.Beena Tendulkar', '1991-12-06', 'indian', 'm', 'hindu', 'gen', 'hindu', 'srt@gmail.com', 'null', '90876579800', 'indore', '0987656890', '34367-547890', 'btech hons.', 'ece', 6, '2011-07-23', 'y11', 'bh1', 'c-14', 'null', 'b+', 65, 5, 17, 'normal', 'table tennis', 2, 'null'),
('y11uc034', 'kanl.34', 'Kunal Gupta', 'Mr.Anil Gupta', 'Mrs.Jaya Gupta', '1993-05-07', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'kunal@yahoo.com', 'null', '09038765432', 'bikaner,rajasthan', '09876215436', NULL, 'btech', 'cce', 6, '2011-09-04', 'y11', 'bh1', 'd-111', 'null', 'a-', 65, 5, 18, 'normal', 'football', 2, 'null'),
('y11uc038', 'y11uc038', 'Ankit Chaudhary', 'Rajpal Chaudhary', 'Sumitra Chaudhary', '1992-11-27', 'India', 'ma', 'Jat', 'OBC', 'Hindu', 'ankit.lnmiit@gmail.com', '', '8764428699', '', '9876543210', '', 'B.Tech', 'CSE', 1, '0000-00-00', '', '', '', '', 'A+', 0, 0, 0, '', 'Cricket', 5, 'Ranji Trophy'),
('y11uc045', 'anj@19', 'Anjali Sharma', 'Mr.Hari Sharma', 'Mrs.Beena Sharma', '1991-09-09', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'anjali@gmail.com', 'nul', '09878654323', 'bikaner,rajasthan', '09876341678', '345- 9883738', 'btech', 'cse', 4, '2011-07-05', 'y11', 'gh1', 'a-10', 'null', 'a+', 45, 5, 21, 'normal', 'badminton', 2, 'null'),
('y11uc055', 'anurag', 'anurag kanodia', 'vk kanodia', 'anita kanodia', '1992-08-06', 'indian', 'm', 'hindu', 'gen', 'hindu', 'anuragkanodia@ymail.com', 'null', '9982798450', 'sector-3,vidyadhar nagar,jaipur', '9828055660', '2336161', 'btech', 'cse', 6, '2011-07-23', 'y11', 'bh1', 'd-112', 'null', 'a+', 65, 6, 18, 'null', 'cricket', 3, 'null'),
('y11uc070', 'ay@70', 'Ayush Sharma ', 'Mr.Anil Sharma', 'Mrs.Jaya Sharma', '1992-09-04', 'indian', 'm', 'hindu', 'gen', 'hindu', 'ayush@ymail.com', 'null', '987433989', 'noida', '9876543226', '0765- 876543', 'mtech', 'ece', 6, '2011-08-01', 'y11', 'bh1', 'b-21', 'null', 'a+', 56, 5, 22, 'normal', 'null', 0, 'null'),
('y11uc078', 'geeta@31', 'Geeta Jain', 'Mr.Hari Jain', 'Mrs.Ankita Jain', '1991-12-05', 'Indian', 'f', 'hindu', 'gen', 'hindu', 'geeta@ymail.com', 'null', '09038765478', 'patna,bihar', '09821726788', '097675690', 'btech', 'f', 6, '2012-07-25', 'y11', 'gh1', 'a-112', 'null', 'b+', 45, 5, 17, 'normal', 'chess', 2, 'null'),
('y11uc088', 'mehul.15', 'mehul jain', 'Mr.Hari Jain', 'Dr.D.S.Jain', '1991-12-04', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'mehul.jain@yahoo.com', 'null', '09038765479', 'bikaner,rajasthan', '09873652433', '0141-2334878', 'btech', 'ece', 6, '2012-07-25', 'y11', 'bh2', 'b-101', 'null', 'b+', 56, 5, 18, 'normal', 'chess', 1, 'null'),
('y11uc089', 'ank.89', 'Ankur Gupta', 'Mr.M.L.Gupta', 'Mrs.Ankita Gupta', '1991-12-06', 'Indian', 'm', 'hindu', 'gen', 'hindu', 'ankur.gupta@gmail.com', 'null', '09827816251', 'jaipur,rajasthan', '09876251678', '0141-2334879', 'btech', 'ece', 6, '2011-07-10', 'y11', 'bh1', 'd-008', 'null', 'b+', 67, 6, 20, 'normal', 'chess', 2, 'null'),
('y11uc157', 'y11uc157', 'Nitesh Chaudhary', 'Mr. Chaudhary', 'Mrs. Chaudhary', '1992-12-25', 'Indian', 'ma', '', 'General', 'Hindu', 'chaudhary@gmail.com', '', '9431272444', 'Forbesganj, forbesGanj - 812001, Bihar', '9931090697', '', 'B.Tech', 'CSE', 1, '0000-00-00', '', '', '', '', 'A+', 0, 0, 0, '', '', 1, ''),
('y11uc208', 'y11uc208', 'shivam prakash', 'Mr.Sharan prakash', 'Mrs.geeta prakash', '1993-05-07', 'indian', 'm', 'hindu', 'gen', 'hindu', 'sp@gmail.com', 'null', '0989786655', 'patna', '897865645', '4567-8767564', 'btech', 'cse', 6, '2011-07-23', 'y11', 'bh1', 'd-215', 'null', 'b+', 56, 6, 20, 'normal', 'karate', 4, 'national level champion'),
('y11uc230', 'y11uc230', 'Subodh Rawani', 'Mr. Rawani', 'Mrs. Rawani', '1991-08-09', 'Indian', 'ma', '', 'General', 'Hindu', 'rawani@gmail.com', '', '94612190803', 'Dhanbad\r\n, Dhanbad - 812001, Jharkhand', '9931090697', '', 'B.Tech', 'CSE', 1, '0000-00-00', '', '', '', '', 'A+', 0, 0, 0, '', '', 1, ''),
('y11uc231', 'y11uc231', 'suman saurabh', 'Mr.deepak saurabh', 'Mrs.anjali saurabh', '1992-08-07', 'indian', 'ma', 'hindu', 'gen', 'hindu', 'sumanrocs@gmail.com', 'sumanrocs@gmail.com', '09876756453', '', '09087867564', '09767564', 'B.Tech', 'CSE', 6, '2011-07-23', 'y11', 'bh1', 'd217', '', 'A+', 70, 6, 21, 'normal', 'chess', 5, ''),
('y11uc233', 'y11uc233', 'Sunil Agarwal', 'Mr.Anil Agrawal', 'Mrs.Jaya Agrawal', '1992-03-04', 'indian', 'm', 'hindu', 'gen', 'hindu', 'sunil@gmail.com', 'null', '9856745678', 'vidyut nagar,patna,bihar', '9843989089', '0567-3344564', 'btech', 'ece', 8, '2011-07-19', 'y11', 'bh2', 'd-11', 'null', 'b+', 67, 5, 17, 'normal', 'chess', 4, 'national level champion'),
('y11uc234', 'vin@13', 'Vineeta Choudhary', 'Mr.Vijay Choudhary', 'Mrs.Ankita Choudhary', '1991-04-05', 'indian', 'f', 'hindu', 'gen', 'hindu', 'vin.ch@ymail.com', 'null', '09087365267', 'sikar,rajasthan', '09873652432', '098-8276322', 'btech hons.', 'ece', 4, '2011-09-03', 'y11', 'gh1', 'b-10', 'null', 'b+', 78, 6, 24, 'normal', 'table tennis', 3, 'state level champion'),
('y11uc250', 'y11uc250', 'Vibhuti Pratap Singh', 'Mr Pratap', 'Mrs. Pratap', '1991-05-21', 'Indian', 'ma', 'Rajput', 'General', 'Hindu', 'vps@gmail.com', 'vps@gmail.com', '9931090697', 'BH-1 D 216\r\n\r\n, Jaipur - 812010, Rajasthan', '9931090697', '', 'B.Tech', 'CSE', 1, '0000-00-00', '', '', '', '', 'A+', 0, 0, 0, '', '', 1, ''),
('y12pg093', 'apsh@93', 'Apoorv Sharma', 'Mr.Vimal Sharma', 'Dr.D.S.Sharma', '1993-07-14', 'indian', 'm', 'hindu', 'gen', 'hindu', 'apporv@gmail.com', 'null', '9876543221', 'jaipur,rajasthan', '09876543221', '8786-232434', 'mtech', 'ece', 4, '2012-07-25', 'y12', 'bh1', 'a-14', 'null', 'o-', 75, 6, 16, 'normal', 'chess', 2, 'null'),
('y12uc090', 'anu@90', 'Anurag Sharma', 'Mr.Deepak Sharma', 'Mrs.geeta sharma', '1992-09-17', 'indian', 'm', 'hindu', 'gen', 'hindu', 'anurag@ymail.com', 'null', '0987654325', 'patna', '0987654325', '98976-87654', 'btech', 'ece', 4, '2012-07-25', 'y12', 'bh2', 'c-11', 'null', 'b+', 56, 6, 15, 'normal', 'volleyball', 3, 'national level champion'),
('y13uc045', 'shs@45', 'shubham sahu', 'Mr.Suman Sahu', 'Mrs.anjali sahu', '1990-02-09', 'indian', 'm', 'hindu', 'gen', 'hindu', 'shubham@gmail.com', 'null', '98765434578', 'patna', '98765643335', '2134567', 'btech', 'mme', 2, '2013-07-19', 'y13', 'bh1', 'd-11', 'null', 'b+', 45, 5, 18, 'normal', 'chess', 4, 'null'),
('y13uc067', 'chandani@14', 'Chandani Jain', 'Mr.Hari Jain', 'Dr.D.S.Jain', '1992-03-04', 'Indian', 'f', 'hindu', 'gen', 'hindu', 'chandia@ymail.com', 'null', '09876348080', 'patna,bihar', '09821726789', '654-7627879', 'btech', 'cse', 4, '2013-07-05', 'y13', 'gh1', 'b-112', 'null', 'b+', 40, 5, 20, 'normal', 'chess', 1, 'null');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `updates` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `updates`) VALUES
('admin001', 'admin001', 'Grade Submission deadline 10th May');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acadmic_details`
--
ALTER TABLE `acadmic_details`
  ADD CONSTRAINT `acadmic_details_ibfk_1` FOREIGN KEY (`username`) REFERENCES `student` (`username`),
  ADD CONSTRAINT `acadmic_details_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `currently_courses`
--
ALTER TABLE `currently_courses`
  ADD CONSTRAINT `currently_courses_ibfk_1` FOREIGN KEY (`username`) REFERENCES `student` (`username`),
  ADD CONSTRAINT `currently_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `isalloted`
--
ALTER TABLE `isalloted`
  ADD CONSTRAINT `isalloted_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `isalloted_ibfk_2` FOREIGN KEY (`username`) REFERENCES `faculty` (`username`),
  ADD CONSTRAINT `isalloted_ibfk_3` FOREIGN KEY (`username`) REFERENCES `faculty` (`username`),
  ADD CONSTRAINT `isalloted_ibfk_4` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
