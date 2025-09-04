CREATE TABLE `coop_member_loan_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `OR_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `coop_member_loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type_of_loan` varchar(100) NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `balance_amount` decimal(15,2) NOT NULL,
  `term` varchar(50) NOT NULL,
  `OR_number` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  `date_of_loan` date NOT NULL,
  `insurance_premium` decimal(15,2) NOT NULL,
  `co_makers` varchar(100) DEFAULT NULL,
  `birthday_of_member` date NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loans VALUES ('3','HFMDC95230','Cueto Patrick A.','Productive Loan','100000.00','100000.00','12','123123','2025-01-31','2025-01-31','12.00','Orlanda, Mary Rose','2025-01-31','12.00','12000.00','2025-01-31 07:59:30','');

CREATE TABLE `coop_members` (
  `coop_id` int(50) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name_of_member` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `tin` varchar(15) NOT NULL,
  `date_accepted` date NOT NULL,
  `bod_resolution` varchar(50) NOT NULL,
  `type_of_membership` varchar(50) NOT NULL,
  `shares_subscribed` int(11) NOT NULL,
  `amount_subscribed` decimal(10,2) NOT NULL,
  `initial_paid_up` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `number_of_dependents` int(11) NOT NULL,
  `religious` varchar(100) NOT NULL,
  `annual_income` decimal(10,2) NOT NULL,
  `date_terminated` date DEFAULT NULL,
  `educational_attainment` varchar(50) NOT NULL,
  `status` int(5) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`coop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('6','HFMDC95230','Cueto Patrick D.','09389496192','612135665','2025-01-31','123456','member','100','100.00','100.00','LUCENA CITY','2025-01-31','25','Male','Single','IT','2','Catholic','50000.00','','Bachelor\'s degree','0','','2025-01-31 13:55:59');
INSERT INTO coop_members VALUES ('7','HFMDC69373','Orlanda, Mary Rose','09389496192','7343454','2025-01-31','123123','member','100','100.00','100.00','LUCENA CITY','2025-01-31','25','female','Single','Teacher','2','Catholic','50000.00','','Bachelor\'s degree','1','','2025-01-31 14:01:09');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('29','HFMDC95230','Cueto Patrick A.','2025-01-31','0','');
INSERT INTO coop_members_shared_capital VALUES ('30','HFMDC69373','Orlanda, Mary Rose','2025-01-31','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('28','Jessa','2025-01-31 13:50:19');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('87','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC95230\",\"name_of_member\":\"Cueto Patrick A.\",\"created_at\":\"2025-01-31 06:55:59\"}','2025-01-31 13:55:59');
INSERT INTO system_logs VALUES ('88','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC69373\",\"name_of_member\":\"Orlanda, Mary Rose\",\"created_at\":\"2025-01-31 07:01:09\"}','2025-01-31 14:01:09');
INSERT INTO system_logs VALUES ('89','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC95230\",\"name_of_member\":\"Cueto Patrick A.\",\"Date_Added\":\"2025-01-31\"}','2025-01-31 14:01:29');
INSERT INTO system_logs VALUES ('90','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC69373\",\"name_of_member\":\"Orlanda, Mary Rose\",\"Date_Added\":\"2025-01-31\"}','2025-01-31 14:01:41');
INSERT INTO system_logs VALUES ('91','9','Jessa','Created loan record successfully for Membership ID: HFMDC95230','{\"membership_id\":\"HFMDC95230\",\"name\":\"Cueto Patrick A.\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-01-31\"}','2025-01-31 14:59:30');
INSERT INTO system_logs VALUES ('92','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 2.','','2025-01-31 15:13:31');
INSERT INTO system_logs VALUES ('93','9','Jessa','Updated member details for Coop ID: 6','{\"coop_id\":\"6\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick D.\",\"contact_number\":\"09389496192\",\"address\":\"Brgy. Binagbag Agdangan Quezon \"}}','2025-01-31 15:33:29');
INSERT INTO system_logs VALUES ('94','9','Jessa','Updated member details for Coop ID: 6','{\"coop_id\":\"6\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick D.\",\"contact_number\":\"09389496192\",\"address\":\"LUCENA CITY\"}}','2025-01-31 15:33:40');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('9','Jessa','jessa@coop.com','$2y$10$d7TEkU3KbX.CKkaTRMFGbuGZQvdS1aQZ8dKNH0ZBl45Myp9NGO8Te','1');

