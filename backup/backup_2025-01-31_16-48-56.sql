CREATE TABLE `coop_member_loan_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `OR_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loan_payments VALUES ('4','4','HFMDC51873','1000.00','','2025-01-31','2025-01-31 23:28:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loans VALUES ('4','HFMDC51873','Cueto Patrick A.','Provident Loan','100000.00','99000.00','12','123456','2025-01-31','2025-01-31','123.00','Mart','2025-01-31','100.00','100.00','2025-01-31 16:28:16','');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('8','HFMDC51873','Cueto Patrick A.','09389496192','123123123','2025-01-31','092741','member','123','123.00','123.00','Brgy. Binagbag Agdangan Quezon ','2025-01-31','25','male','Single','IT','2','Catholic','100000.00','','Bachelor\'s degree','1','','2025-01-31 21:40:20');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('31','HFMDC51873','Cueto Patrick A.','2025-01-31','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('28','Jessa','2025-01-31 13:50:19');
INSERT INTO login_activity VALUES ('29','Jessa','2025-01-31 15:43:11');
INSERT INTO login_activity VALUES ('30','Jessa','2025-01-31 16:11:30');
INSERT INTO login_activity VALUES ('31','Jessa','2025-01-31 21:19:28');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('58','HFMDC51873','Cueto Patrick A.','100.00','123123','2025-01-31','');
INSERT INTO shared_capital_amount VALUES ('59','HFMDC51873','Cueto Patrick A.','100.00','123123','2025-01-31','');
INSERT INTO shared_capital_amount VALUES ('60','HFMDC51873','Cueto Patrick A.','100.00','123123','2025-01-31','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('87','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC95230\",\"name_of_member\":\"Cueto Patrick A.\",\"created_at\":\"2025-01-31 06:55:59\"}','2025-01-31 13:55:59');
INSERT INTO system_logs VALUES ('88','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC69373\",\"name_of_member\":\"Orlanda, Mary Rose\",\"created_at\":\"2025-01-31 07:01:09\"}','2025-01-31 14:01:09');
INSERT INTO system_logs VALUES ('89','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC95230\",\"name_of_member\":\"Cueto Patrick A.\",\"Date_Added\":\"2025-01-31\"}','2025-01-31 14:01:29');
INSERT INTO system_logs VALUES ('90','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC69373\",\"name_of_member\":\"Orlanda, Mary Rose\",\"Date_Added\":\"2025-01-31\"}','2025-01-31 14:01:41');
INSERT INTO system_logs VALUES ('91','9','Jessa','Created loan record successfully for Membership ID: HFMDC95230','{\"membership_id\":\"HFMDC95230\",\"name\":\"Cueto Patrick A.\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-01-31\"}','2025-01-31 14:59:30');
INSERT INTO system_logs VALUES ('92','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 2.','','2025-01-31 15:13:31');
INSERT INTO system_logs VALUES ('93','9','Jessa','Updated member details for Coop ID: 6','{\"coop_id\":\"6\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick D.\",\"contact_number\":\"09389496192\",\"address\":\"Brgy. Binagbag Agdangan Quezon \"}}','2025-01-31 15:33:29');
INSERT INTO system_logs VALUES ('94','9','Jessa','Updated member details for Coop ID: 6','{\"coop_id\":\"6\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick D.\",\"contact_number\":\"09389496192\",\"address\":\"LUCENA CITY\"}}','2025-01-31 15:33:40');
INSERT INTO system_logs VALUES ('95','9','Jessa','Updated member details for Coop ID: 6','{\"coop_id\":\"6\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick C.\",\"contact_number\":\"09389496192\",\"address\":\"LUCENA CITY\"}}','2025-01-31 15:40:55');
INSERT INTO system_logs VALUES ('96','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC69373\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 15:55:54');
INSERT INTO system_logs VALUES ('97','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC69373\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 15:57:25');
INSERT INTO system_logs VALUES ('98','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC95230\",\"Name\":\"Cueto Patrick C.\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 16:04:59');
INSERT INTO system_logs VALUES ('99','9','Jessa','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC95230\"}','2025-01-31 16:18:21');
INSERT INTO system_logs VALUES ('100','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC51873\",\"name_of_member\":\"Cueto Patrick A.\",\"created_at\":\"2025-01-31 14:40:20\"}','2025-01-31 21:40:20');
INSERT INTO system_logs VALUES ('101','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC51873\",\"name_of_member\":\"Cueto Patrick A.\",\"Date_Added\":\"2025-01-31\"}','2025-01-31 22:03:28');
INSERT INTO system_logs VALUES ('102','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC51873\",\"Name\":\"Cueto Patrick A.\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 22:03:39');
INSERT INTO system_logs VALUES ('103','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC51873\",\"Name\":\"Cueto Patrick A.\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 22:07:45');
INSERT INTO system_logs VALUES ('104','9','Jessa','Created loan record successfully for Membership ID: HFMDC51873','{\"membership_id\":\"HFMDC51873\",\"name\":\"Cueto Patrick A.\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-01-31\"}','2025-01-31 23:28:16');
INSERT INTO system_logs VALUES ('105','9','Jessa','Payment recorded for Loan ID: 4','{\"loan_id\":\"4\",\"membership_id\":\"HFMDC51873\",\"payment_amount\":\"1000\",\"OR_number\":null,\"payment_date\":\"2025-01-31\"}','2025-01-31 23:28:32');
INSERT INTO system_logs VALUES ('106','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC51873\",\"Name\":\"Cueto Patrick A.\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-01-31\"}','2025-01-31 23:48:39');

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

