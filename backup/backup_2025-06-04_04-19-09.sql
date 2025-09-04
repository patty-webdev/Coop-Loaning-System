CREATE TABLE `coop_member_loan_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `OR_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loan_payments VALUES ('1','1','HFMDC81070','1000.00','','2025-06-03','2025-06-03 09:17:57','');
INSERT INTO coop_member_loan_payments VALUES ('2','1','HFMDC81070','1000.00','','2025-06-04','2025-06-04 00:43:07','');
INSERT INTO coop_member_loan_payments VALUES ('3','1','HFMDC81070','1000.00','123123','2025-06-04','2025-06-04 00:46:34','');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loans VALUES ('1','HFMDC81070','Medenilla, Charlie Karl','Gadget Loan','100000.00','97000.00','12','123123','2025-06-03','2025-06-03','12.00','12','2025-06-03','12.00','2000.00','2025-06-03 03:17:31','');
INSERT INTO coop_member_loans VALUES ('2','HFMPC72328','Uzumaki, Naruto','Provident Loan','100000.00','100000.00','12','123132','2025-06-04','2025-06-04','123123.00','nan','2025-06-04','10.00','1000.00','2025-06-03 19:31:08','');

CREATE TABLE `coop_members` (
  `coop_id` int(50) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name_of_member` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `tin` varchar(15) NOT NULL,
  `date_accepted` date NOT NULL,
  `bod_resolution` varchar(50) NOT NULL,
  `type_of_membership` varchar(50) NOT NULL,
  `shares_subscribed` decimal(10,2) NOT NULL,
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

INSERT INTO coop_members VALUES ('1','HFMDC74476','Cueto Patrick AB.','09389496192','123123','2025-03-17','092741','Regular','1000.00','1000.00','1000.00','Brgy. Binagbag, Agdangan, Quezon','2025-03-17','25','Male','Single','IT','2','Catholic','300000.00','0000-00-00','Bachelor\'s degree','1','Deleted','2025-03-17 15:37:54');
INSERT INTO coop_members VALUES ('3','HFMDC81070','Medenilla, Charlie Karl','09389496192','934-820-934','2025-06-03','092741','Regular','12312.00','12312.00','12312312.00','Brgy. Binagbag, Agdangan, Quezon','2025-06-03','12','Male','Married','Teacher','123123','INC','10000.00','0000-00-00','Bachelor\'s degree','0','','2025-06-03 08:53:30');
INSERT INTO coop_members VALUES ('4','HFMDC69015','Orlanda, Mary Rose','9389-496-192','123123','2025-06-04','92741','Regular','1000.00','1000.00','1000.00','Brgy. Binagbag, Agdangan, Quezon','2025-06-04','25','Male','Single','IT','2','Catholic','300000.00','0000-00-00','0','1','','2025-06-03 09:42:18');
INSERT INTO coop_members VALUES ('5','HFMDC74923','Bustamante, Rosemarie A.','0938-949-6192','986-794-569','2025-06-04','123123','Regular','1000.00','1000.00','1000.00','Brgy. Binagbag, Agdangan, Quezon','2025-06-04','26','Female','Married','Teacher','12','Catholic','12000.00','0000-00-00','Bachelor\'s degree','1','','2025-06-04 00:17:13');
INSERT INTO coop_members VALUES ('6','HFMPC72328','Uzumaki, Naruto','0938-949-6192','123-456-879','2025-06-04','123132','regular','1000.00','1000.00','1000.00','Brgy. Salvacion Agdangan Quezon','2025-06-04','25','Two-Spirit','Single','Ninja','2','Catholic','12000.00','0000-00-00','Primary education','1','','2025-06-04 01:18:45');
INSERT INTO coop_members VALUES ('7','HFMPC12544','Uchiha, Sasuke','0934-762-3874','123-456-789','2025-06-04','092741','Regular','100.56','100.56','100.56','Brgy. Binagbag, Agdangan, Quezon','2025-06-04','26','Bigender','Single','12323','2','Catholic','100.00','','Master\'s degree','1','','2025-06-04 09:51:12');
INSERT INTO coop_members VALUES ('8','HFMPC25530','Namikaze, Minato','0938-932-4728','123-456-677','2025-06-19','092741','Regular','1200.59','1000.56','1000.56','Brgy. Binagbag, Agdangan, Quezon','2025-06-04','25','Female','Married','Teacher','2','Catholic','2200.56','','Primary education','1','','2025-06-04 10:08:33');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('1','HFMDC74476','Cueto Patrick AB.','2025-06-03','1','Deleted');
INSERT INTO coop_members_shared_capital VALUES ('2','HFMDC81070','Medenilla, Charlie Karl','2025-06-03','0','');
INSERT INTO coop_members_shared_capital VALUES ('3','HFMDC69015','Orlanda, Mary Rose','2025-06-03','1','');
INSERT INTO coop_members_shared_capital VALUES ('4','HFMDC74923','Bustamante, Rosemarie','2025-06-03','1','');
INSERT INTO coop_members_shared_capital VALUES ('5','HFMPC72328','Uzumaki, Naruto','2025-06-03','1','');
INSERT INTO coop_members_shared_capital VALUES ('6','HFMPC12544','Uchiha, Sasuke','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('7','HFMPC25530','Namikaze, Minato','2025-06-04','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('1','admin','2025-03-20 13:44:40');
INSERT INTO login_activity VALUES ('2','admin','2025-03-27 14:24:17');
INSERT INTO login_activity VALUES ('3','admin','2025-03-28 08:53:37');
INSERT INTO login_activity VALUES ('4','admin','2025-03-28 12:25:24');
INSERT INTO login_activity VALUES ('5','admin','2025-06-02 10:55:02');
INSERT INTO login_activity VALUES ('6','admin','2025-06-02 15:20:53');
INSERT INTO login_activity VALUES ('7','admin','2025-06-02 18:03:49');
INSERT INTO login_activity VALUES ('8','admin','2025-06-02 18:08:20');
INSERT INTO login_activity VALUES ('9','admin','2025-06-02 22:28:26');
INSERT INTO login_activity VALUES ('10','admin','2025-06-03 08:29:47');
INSERT INTO login_activity VALUES ('11','admin','2025-06-03 15:08:30');
INSERT INTO login_activity VALUES ('12','admin','2025-06-03 18:37:55');
INSERT INTO login_activity VALUES ('13','admin','2025-06-03 23:13:05');
INSERT INTO login_activity VALUES ('14','admin','2025-06-04 00:58:52');
INSERT INTO login_activity VALUES ('15','admin','2025-06-04 08:45:24');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('1','HFMDC74476','Cueto Patrick AB.','2000.00','123123','2025-06-03','');
INSERT INTO shared_capital_amount VALUES ('2','HFMDC81070','Medenilla, Charlie Karl','1000.00','123123','2025-06-03','');
INSERT INTO shared_capital_amount VALUES ('3','HFMDC69015','Orlanda, Mary Rose','1000.00','123123123','2025-06-04','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('1','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 2.','','2025-06-02 10:55:22');
INSERT INTO system_logs VALUES ('2','1','admin','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC40090\"}','2025-06-02 10:57:36');
INSERT INTO system_logs VALUES ('3','1','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC74476\",\"name_of_member\":\"Cueto Patrick AB.\",\"Date_Added\":\"2025-06-03\"}','2025-06-03 08:30:45');
INSERT INTO system_logs VALUES ('4','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC74476\",\"Name\":\"Cueto Patrick AB.\",\"Amount\":\"1000\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-06-03\"}','2025-06-03 08:31:28');
INSERT INTO system_logs VALUES ('5','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMDC81070\",\"name_of_member\":\"Medenilla, Charlie Karl\",\"created_at\":\"2025-06-03 02:53:30\"}','2025-06-03 08:53:30');
INSERT INTO system_logs VALUES ('6','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81070\",\"Name\":\"Medenilla, Charlie Karl\",\"Amount\":\"1000\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-06-03\"}','2025-06-03 08:54:32');
INSERT INTO system_logs VALUES ('7','1','admin','Created loan record successfully for Membership ID: HFMDC81070','{\"membership_id\":\"HFMDC81070\",\"name\":\"Medenilla, Charlie Karl\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-06-03\"}','2025-06-03 09:17:31');
INSERT INTO system_logs VALUES ('8','1','admin','Payment recorded for Loan ID: 1','{\"loan_id\":\"1\",\"membership_id\":\"HFMDC81070\",\"payment_amount\":\"1000\",\"OR_number\":null,\"payment_date\":\"2025-06-03\"}','2025-06-03 09:17:57');
INSERT INTO system_logs VALUES ('9','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 2.','','2025-06-03 09:39:40');
INSERT INTO system_logs VALUES ('10','1','admin','Imported CSV file for coop members','{\"file_name\":\"membership_information (21).csv\",\"total_skipped\":0,\"total_errors\":0}','2025-06-03 09:42:18');
INSERT INTO system_logs VALUES ('11','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 3.','','2025-06-03 10:25:16');
INSERT INTO system_logs VALUES ('12','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 3.','','2025-06-03 11:04:39');
INSERT INTO system_logs VALUES ('13','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 3.','','2025-06-03 11:07:55');
INSERT INTO system_logs VALUES ('14','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMDC74923\",\"name_of_member\":\"Bustamante, Rosemarie\",\"created_at\":\"2025-06-03 18:17:13\"}','2025-06-04 00:17:13');
INSERT INTO system_logs VALUES ('15','1','admin','Updated member details for Coop ID: 5','{\"coop_id\":\"5\",\"updated_data\":{\"name_of_member\":\"Bustamante, Rosemarie\",\"contact_number\":\"0938-949-6192\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 00:30:45');
INSERT INTO system_logs VALUES ('16','1','admin','Updated member details for Coop ID: 5','{\"coop_id\":\"5\",\"updated_data\":{\"name_of_member\":\"Bustamante, Rosemarie\",\"contact_number\":\"0938-949-6192\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 00:31:02');
INSERT INTO system_logs VALUES ('17','1','admin','Updated member details for Coop ID: 5','{\"coop_id\":\"5\",\"updated_data\":{\"name_of_member\":\"Bustamante, Rosemarie A.\",\"contact_number\":\"0938-949-6192\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 00:31:20');
INSERT INTO system_logs VALUES ('18','1','admin','Contribution updated successfully','{\"Contribution_ID\":\"2\",\"Amount\":\"1000000.00\",\"Date_Paid\":\"2025-06-03\"}','2025-06-04 00:38:27');
INSERT INTO system_logs VALUES ('19','1','admin','Contribution updated successfully','{\"Contribution_ID\":\"2\",\"Amount\":\"100000000000000000000000000000.00\",\"Date_Paid\":\"2025-06-03\"}','2025-06-04 00:38:35');
INSERT INTO system_logs VALUES ('20','1','admin','Contribution updated successfully','{\"Contribution_ID\":\"2\",\"Amount\":\"1000\",\"Date_Paid\":\"2025-06-03\"}','2025-06-04 00:39:17');
INSERT INTO system_logs VALUES ('21','1','admin','Payment recorded for Loan ID: 1','{\"loan_id\":\"1\",\"membership_id\":\"HFMDC81070\",\"payment_amount\":\"1000\",\"OR_number\":null,\"payment_date\":\"2025-06-04\"}','2025-06-04 00:43:07');
INSERT INTO system_logs VALUES ('22','1','admin','Failed to record payment due to missing fields','{\"loan_id\":\"1\",\"payment_amount\":\"1000\",\"payment_reference\":null,\"payment_date\":\"2025-06-04\"}','2025-06-04 00:45:55');
INSERT INTO system_logs VALUES ('23','1','admin','Failed to record payment due to missing fields','{\"loan_id\":\"1\",\"payment_amount\":\"1000\",\"payment_reference\":null,\"payment_date\":\"2025-06-04\"}','2025-06-04 00:46:06');
INSERT INTO system_logs VALUES ('24','1','admin','Payment recorded for Loan ID: 1','{\"loan_id\":\"1\",\"membership_id\":\"HFMDC81070\",\"payment_amount\":\"1000\",\"OR_number\":\"123123\",\"payment_date\":\"2025-06-04\"}','2025-06-04 00:46:34');
INSERT INTO system_logs VALUES ('25','1','admin','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC74476\"}','2025-06-04 01:02:33');
INSERT INTO system_logs VALUES ('26','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC69015\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"1000.00\",\"OR_number\":\"123123123\",\"Date_Paid\":\"2025-06-04\"}','2025-06-04 01:07:02');
INSERT INTO system_logs VALUES ('27','1','admin','Updated member details for Coop ID: 4','{\"coop_id\":\"4\",\"updated_data\":{\"name_of_member\":\"Orlanda, Mary Rose\",\"contact_number\":\"9389-496-192\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 01:10:37');
INSERT INTO system_logs VALUES ('28','1','admin','Updated member details for Coop ID: 3','{\"coop_id\":\"3\",\"updated_data\":{\"name_of_member\":\"Medenilla, Charlie Karl\",\"contact_number\":\"09389496192\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 01:11:21');
INSERT INTO system_logs VALUES ('29','1','admin','Contribution updated successfully','{\"Contribution_ID\":\"1\",\"Amount\":\"2000\",\"Date_Paid\":\"2025-06-03\"}','2025-06-04 01:11:53');
INSERT INTO system_logs VALUES ('30','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC72328\",\"name_of_member\":\"Uzumaki, Naruto\",\"created_at\":\"2025-06-03 19:18:45\"}','2025-06-04 01:18:45');
INSERT INTO system_logs VALUES ('31','1','admin','Created loan record successfully for Membership ID: HFMPC72328','{\"membership_id\":\"HFMPC72328\",\"name\":\"Uzumaki, Naruto\",\"loan_amount\":\"100000.00\",\"payment_date\":\"2025-06-04\"}','2025-06-04 01:31:08');
INSERT INTO system_logs VALUES ('32','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC12544\",\"name_of_member\":\"Uchiha, Sasuke\",\"created_at\":\"2025-06-04 03:51:12\"}','2025-06-04 09:51:12');
INSERT INTO system_logs VALUES ('33','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC25530\",\"name_of_member\":\"Namikaze, Minato\",\"created_at\":\"2025-06-04 04:08:33\"}','2025-06-04 10:08:33');
INSERT INTO system_logs VALUES ('34','1','admin','Updated member details for Coop ID: 8','{\"coop_id\":\"8\",\"updated_data\":{\"name_of_member\":\"Namikaze, Minato\",\"contact_number\":\"0938-932-4728\",\"address\":\"Brgy. Binagbag, Agdangan, Quezon\"}}','2025-06-04 10:17:36');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('1','admin','admin@gmail.com','$2y$10$eIllWCfD6vr.QmN2jLwoo.rWFKiCuO.XJuGFpgIlRMbgJgoGQ/Z5y','1');

