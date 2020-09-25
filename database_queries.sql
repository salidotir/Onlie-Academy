CREATE DATABASE `online_academy`;

CREATE TABLE `class_once` (
 `class_code` int(11) NOT NULL,
 `teacher_id` varchar(20) NOT NULL,
 `start_time` time NOT NULL,
 `date` date NOT NULL,
 `class_name` varchar(20) NOT NULL,
 PRIMARY KEY (`class_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `class_repeat` (
 `class_code` int(11) NOT NULL,
 `teacher_id` varchar(20) NOT NULL,
 `start_time` time NOT NULL,
 `class_name` varchar(20) NOT NULL,
 PRIMARY KEY (`class_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `class_repeated_days` (
 `id` int(11) NOT NULL,
 `class_code` int(11) NOT NULL,
 `day` varchar(15) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `class_std_owner` (
 `id` int(11) NOT NULL,
 `class_code` int(11) NOT NULL,
 `std_number` varchar(20) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `class_code` (`class_code`,`std_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `student` (
 `first_name` varchar(20) NOT NULL,
 `last_name` varchar(20) NOT NULL,
 `student_number` varchar(20) NOT NULL,
 UNIQUE KEY `student_number` (`student_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teacher` (
 `first_name` varchar(20) NOT NULL,
 `last_name` varchar(20) NOT NULL,
 `email` varchar(20) NOT NULL,
 `teacher_id` varchar(10) NOT NULL,
 `password` varchar(20) NOT NULL,
 UNIQUE KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;