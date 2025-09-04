CREATE TABLE `coop_member_loan_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `OR_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_member_loan_payments VALUES ('1','1','HFMDC81724','1000.00','123456','2025-01-23','2025-01-23 17:20:16');

CREATE TABLE `coop_member_loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type_of_loan` varchar(100) NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `balance_amount` decimal(15,2) NOT NULL,
  `term` varchar(50) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
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

INSERT INTO coop_member_loans VALUES ('1','HFMDC81724','Orlanda, Mary Rose','Gadget Loan','20000.00','19000.00','12','123123','2025-01-23','2025-01-23','123456.00','Orlanda, Mary Rose','2025-01-23','0.00','1000.00','2025-01-23 09:43:08','Deleted');
INSERT INTO coop_member_loans VALUES ('2','HFMDC81724','Orlanda, Mary Rose','Provident Loan','100000.00','100000.00','12','121212','2025-01-30','2025-01-30','21.00','21','2025-01-30','21.00','12.00','2025-01-30 11:08:40','');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('1','HFMDC34932','Cueto Patrick A.','09389496192','612135665','2025-01-19','123456','Members','100','100.00','100.00','Brgy. Binagbag Agdangan Quezon ','1999-07-29','25','male','Single','IT','3','Catholic','20000.00','','Bachelor\'s degree','1','Deleted','2025-01-30 17:54:35');
INSERT INTO coop_members VALUES ('2','HFMDC81724','Orlanda, Mary Rose','9389496192','612135665','0000-00-00','123456','Members','100','100.00','100.00','Brgy. Binagbag Agdangan Quezon ','0000-00-00','25','male','Single','IT','3','Catholic','20000.00','','0','1','','2025-01-30 17:54:35');
INSERT INTO coop_members VALUES ('3','HFMDC85737','Salazar, Paul Ivan Mapaye','9389496192','612135665','0000-00-00','123457','Members','100','100.00','100.00','Brgy. Binagbag Agdangan Quezon ','0000-00-00','26','male','Single','IT','4','Catholic','20001.00','','0','1','','2025-01-30 17:54:35');
INSERT INTO coop_members VALUES ('5','HFMDC23356','Barizo, Jowena','09389496192','986794569484','2025-01-30','092741','Regular','12','12.00','12.00','Brgy. Binagbag Agdangan Quezon ','2025-01-30','29','genderqueer','Widowed','Teacher','2','Catholic','12.00','','Primary education','1','','2025-01-30 18:04:29');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('23','HFMDC34932','Cueto Patrick A.','2025-01-30','1','Deleted');
INSERT INTO coop_members_shared_capital VALUES ('25','HFMDC85737','Salazar, Paul Ivan Mapaye','2025-01-30','1','');
INSERT INTO coop_members_shared_capital VALUES ('27','HFMDC23356','Barizo, Jowena','2025-01-30','1','');
INSERT INTO coop_members_shared_capital VALUES ('28','HFMDC81724','Orlanda, Mary Rose','2025-01-30','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('1','admin','2025-01-19 16:02:36');
INSERT INTO login_activity VALUES ('2','Jessa','2025-01-19 16:02:52');
INSERT INTO login_activity VALUES ('3','admin','2025-01-19 16:09:52');
INSERT INTO login_activity VALUES ('4','admin','2025-01-19 17:12:01');
INSERT INTO login_activity VALUES ('5','admin','2025-01-19 18:46:17');
INSERT INTO login_activity VALUES ('6','admin','2025-01-19 21:08:02');
INSERT INTO login_activity VALUES ('7','Jessa','2025-01-19 21:09:43');
INSERT INTO login_activity VALUES ('8','admin','2025-01-19 23:41:38');
INSERT INTO login_activity VALUES ('9','admin','2025-01-20 00:39:10');
INSERT INTO login_activity VALUES ('10','admin','2025-01-20 00:40:34');
INSERT INTO login_activity VALUES ('11','admin','2025-01-20 08:47:07');
INSERT INTO login_activity VALUES ('12','admin','2025-01-20 09:02:49');
INSERT INTO login_activity VALUES ('13','admin','2025-01-20 12:40:53');
INSERT INTO login_activity VALUES ('14','admin','2025-01-20 12:56:36');
INSERT INTO login_activity VALUES ('15','admin','2025-01-20 16:09:21');
INSERT INTO login_activity VALUES ('16','admin','2025-01-21 22:04:51');
INSERT INTO login_activity VALUES ('17','admin','2025-01-22 08:46:57');
INSERT INTO login_activity VALUES ('18','admin','2025-01-23 09:52:56');
INSERT INTO login_activity VALUES ('19','admin','2025-01-26 18:11:39');
INSERT INTO login_activity VALUES ('20','admin','2025-01-27 13:23:44');
INSERT INTO login_activity VALUES ('21','admin','2025-01-30 09:33:12');
INSERT INTO login_activity VALUES ('22','admin','2025-01-30 11:26:54');
INSERT INTO login_activity VALUES ('23','admin','2025-01-30 13:50:55');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('51','HFMDC85737','Salazar, Paul Ivan Mapaye','100.00','0','2025-01-30','Deleted');
INSERT INTO shared_capital_amount VALUES ('52','HFMDC81724','Orlanda, Mary Rose','100.00','0','2025-01-30','Deleted');
INSERT INTO shared_capital_amount VALUES ('53','HFMDC81724','Orlanda, Mary Rose','100.00','123456','2025-01-30','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('20','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 0.','','2025-01-19 23:15:34');
INSERT INTO system_logs VALUES ('21','7','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC34932\",\"name_of_member\":\"Cueto Patrick A.\"}','2025-01-19 23:18:32');
INSERT INTO system_logs VALUES ('22','7','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC34932\",\"name_of_member\":\"Cueto Patrick A.\",\"Date_Added\":\"2025-01-19\"}','2025-01-19 23:19:13');
INSERT INTO system_logs VALUES ('23','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 1.','','2025-01-19 23:19:30');
INSERT INTO system_logs VALUES ('24','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 1.','','2025-01-19 23:20:40');
INSERT INTO system_logs VALUES ('25','7','Jessa','Imported CSV file for coop members','{\"file_name\":\"membership_information (20).csv\",\"total_skipped\":0,\"total_errors\":0}','2025-01-19 23:33:30');
INSERT INTO system_logs VALUES ('26','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC34932\",\"Name\":\"Cueto Patrick A.\",\"Amount\":\"100\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 00:27:42');
INSERT INTO system_logs VALUES ('27','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC34932\",\"Name\":\"Cueto Patrick A.\",\"Amount\":\"200\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 00:27:53');
INSERT INTO system_logs VALUES ('28','6','admin','Created loan record successfully for Membership ID: HFMDC34932','{\"membership_id\":\"HFMDC34932\",\"name\":\"Cueto Patrick A.\",\"loan_amount\":\"20000\",\"payment_date\":\"2025-01-20\"}','2025-01-20 00:29:00');
INSERT INTO system_logs VALUES ('29','6','admin','Contribution updated successfully','{\"Contribution_ID\":\"42\",\"Amount\":\"300.00\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 08:48:53');
INSERT INTO system_logs VALUES ('30','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 3.','','2025-01-20 12:44:15');
INSERT INTO system_logs VALUES ('31','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC81724\",\"name_of_member\":\"Orlanda, Mary Rose\",\"Date_Added\":\"2025-01-20\"}','2025-01-20 12:53:34');
INSERT INTO system_logs VALUES ('32','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"5000\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 12:54:01');
INSERT INTO system_logs VALUES ('33','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"5000\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 12:54:28');
INSERT INTO system_logs VALUES ('34','6','admin','Deleted a shared capital member','{\"membership_id\":\"HFMDC34932\",\"name_of_member\":\"Cueto Patrick A.\",\"date_added\":\"2025-01-19\"}','2025-01-20 12:59:23');
INSERT INTO system_logs VALUES ('35','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 3.','','2025-01-20 13:00:23');
INSERT INTO system_logs VALUES ('36','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"10000\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 16:10:08');
INSERT INTO system_logs VALUES ('37','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"10000\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 16:12:56');
INSERT INTO system_logs VALUES ('38','6','admin','Deleted shared capital entry for Membership ID: 46','{\"membership_id\":\"46\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"10000.00\"}','2025-01-20 16:13:16');
INSERT INTO system_logs VALUES ('39','6','admin','Contribution updated successfully','{\"Contribution_ID\":\"43\",\"Amount\":\"2000.00\",\"Date_Paid\":\"2025-01-20\"}','2025-01-20 16:13:47');
INSERT INTO system_logs VALUES ('40','6','admin','Failed to create loan record - Membership ID not found.','{\"membership_id\":\"HFMDC00001\",\"message\":\"Membership ID not found in the system.\"}','2025-01-21 23:21:10');
INSERT INTO system_logs VALUES ('41','6','admin','Created loan record successfully for Membership ID: HFMDC85737','{\"membership_id\":\"HFMDC85737\",\"name\":\"Salazar, Paul Ivan Mapaye\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-01-21\"}','2025-01-21 23:27:16');
INSERT INTO system_logs VALUES ('42','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC85737\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"Date_Added\":\"2025-01-21\"}','2025-01-21 23:27:50');
INSERT INTO system_logs VALUES ('43','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC85737\",\"Name\":\"Salazar, Paul Ivan Mapaye\",\"Amount\":\"1000\",\"Date_Paid\":\"2025-01-21\"}','2025-01-21 23:28:11');
INSERT INTO system_logs VALUES ('44','6','admin','Payment recorded for Loan ID: 11','{\"loan_id\":\"11\",\"membership_id\":\"HFMDC85737\",\"payment_amount\":\"9000\",\"payment_reference\":\"123456\",\"payment_date\":\"2025-01-21\"}','2025-01-21 23:36:21');
INSERT INTO system_logs VALUES ('45','6','admin','Payment recorded for Loan ID: 11','{\"loan_id\":\"11\",\"membership_id\":\"HFMDC85737\",\"payment_amount\":\"1000\",\"payment_reference\":\"123456\",\"payment_date\":\"2025-01-22\"}','2025-01-22 08:47:38');
INSERT INTO system_logs VALUES ('46','6','admin','Created loan record successfully for Membership ID: HFMDC81724','{\"membership_id\":\"HFMDC81724\",\"name\":\"Orlanda, Mary Rose\",\"loan_amount\":\"10000\",\"payment_date\":\"2025-01-22\"}','2025-01-22 09:25:24');
INSERT INTO system_logs VALUES ('47','6','admin','Payment recorded for Loan ID: 12','{\"loan_id\":\"12\",\"membership_id\":\"HFMDC81724\",\"payment_amount\":\"1000\",\"payment_reference\":\"123456\",\"payment_date\":\"2025-01-22\"}','2025-01-22 10:37:50');
INSERT INTO system_logs VALUES ('48','6','admin','Deleted a shared capital member','{\"membership_id\":\"HFMDC81724\",\"name_of_member\":\"Orlanda, Mary Rose\",\"date_added\":\"2025-01-20\"}','2025-01-22 10:55:48');
INSERT INTO system_logs VALUES ('49','6','admin','Deleted shared capital entry for Membership ID: 41','{\"membership_id\":\"41\",\"name_of_member\":\"Cueto Patrick A.\",\"amount\":\"100.00\"}','2025-01-23 09:54:10');
INSERT INTO system_logs VALUES ('50','6','admin','Deleted shared capital entry for Membership ID: 42','{\"membership_id\":\"42\",\"name_of_member\":\"Cueto Patrick A.\",\"amount\":\"300.00\"}','2025-01-23 09:54:12');
INSERT INTO system_logs VALUES ('51','6','admin','Deleted shared capital entry for Membership ID: 43','{\"membership_id\":\"43\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"2000.00\"}','2025-01-23 09:54:14');
INSERT INTO system_logs VALUES ('52','6','admin','Deleted shared capital entry for Membership ID: 44','{\"membership_id\":\"44\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"5000.00\"}','2025-01-23 09:54:16');
INSERT INTO system_logs VALUES ('53','6','admin','Deleted shared capital entry for Membership ID: 45','{\"membership_id\":\"45\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"10000.00\"}','2025-01-23 09:54:17');
INSERT INTO system_logs VALUES ('54','6','admin','Deleted shared capital entry for Membership ID: 47','{\"membership_id\":\"47\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"amount\":\"1000.00\"}','2025-01-23 09:54:18');
INSERT INTO system_logs VALUES ('55','6','admin','Deleted a shared capital member','{\"membership_id\":\"HFMDC85737\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"date_added\":\"2025-01-21\"}','2025-01-23 09:54:28');
INSERT INTO system_logs VALUES ('56','6','admin','Created loan record successfully for Membership ID: HFMDC81724','{\"membership_id\":\"HFMDC81724\",\"name\":\"Orlanda, Mary Rose\",\"loan_amount\":\"20000\",\"payment_date\":\"2025-01-23\"}','2025-01-23 16:43:08');
INSERT INTO system_logs VALUES ('57','6','admin','Payment recorded for Loan ID: 1','{\"loan_id\":\"1\",\"membership_id\":\"HFMDC81724\",\"payment_amount\":\"1000\",\"payment_reference\":\"123456\",\"payment_date\":\"2025-01-23\"}','2025-01-23 17:20:16');
INSERT INTO system_logs VALUES ('58','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC34932\",\"name_of_member\":\"Cueto Patrick A.\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 09:37:01');
INSERT INTO system_logs VALUES ('59','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC81724\",\"name_of_member\":\"Orlanda, Mary Rose\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 09:38:26');
INSERT INTO system_logs VALUES ('60','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC85737\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 09:39:44');
INSERT INTO system_logs VALUES ('61','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"500\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 14:16:04');
INSERT INTO system_logs VALUES ('62','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"500\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 14:16:12');
INSERT INTO system_logs VALUES ('63','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC85737\",\"Name\":\"Salazar, Paul Ivan Mapaye\",\"Amount\":\"100\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 14:16:24');
INSERT INTO system_logs VALUES ('64','6','admin','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC34932\"}','2025-01-30 16:50:16');
INSERT INTO system_logs VALUES ('65','6','admin','Marked a shared capital member as Deleted','{\"membership_id\":\"HFMDC81724\",\"name_of_member\":\"Orlanda, Mary Rose\",\"date_added\":\"2025-01-30\",\"remarks\":\"Deleted\"}','2025-01-30 17:30:19');
INSERT INTO system_logs VALUES ('66','6','admin','Marked a loan record as Deleted','{\"loan_id\":\"1\",\"membership_id\":\"HFMDC81724\",\"name\":\"Orlanda, Mary Rose\",\"loan_amount\":\"20000.00\",\"date_of_loan\":\"2025-01-23\",\"remarks\":\"Deleted\"}','2025-01-30 17:36:01');
INSERT INTO system_logs VALUES ('67','6','admin','Deleted shared capital entry for Membership ID: 48','{\"membership_id\":\"48\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"500.00\"}','2025-01-30 17:44:55');
INSERT INTO system_logs VALUES ('68','6','admin','Deleted shared capital entry for Membership ID: 49','{\"membership_id\":\"49\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"500.00\"}','2025-01-30 17:44:59');
INSERT INTO system_logs VALUES ('69','6','admin','Deleted shared capital entry for Membership ID: 50','{\"membership_id\":\"50\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"amount\":\"100.00\"}','2025-01-30 17:45:02');
INSERT INTO system_logs VALUES ('70','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC85737\",\"Name\":\"Salazar, Paul Ivan Mapaye\",\"Amount\":\"100\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 17:45:49');
INSERT INTO system_logs VALUES ('71','6','admin','Marked shared capital entry as Deleted for Membership ID: 51','{\"membership_id\":\"51\",\"name_of_member\":\"Salazar, Paul Ivan Mapaye\",\"amount\":\"100.00\",\"remarks\":\"Deleted\"}','2025-01-30 17:51:45');
INSERT INTO system_logs VALUES ('72','6','admin','Added new member to coop_members','{\"membership_id\":\"HFMDC53393\",\"name_of_member\":\"Capistrano, Angelika\",\"created_at\":\"2025-01-30 11:01:52\"}','2025-01-30 18:01:52');
INSERT INTO system_logs VALUES ('73','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC53393\",\"name_of_member\":\"Capistrano, Angelika\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 18:02:04');
INSERT INTO system_logs VALUES ('74','6','admin','Marked a shared capital member as Deleted','{\"membership_id\":\"HFMDC53393\",\"name_of_member\":\"Capistrano, Angelika\",\"date_added\":\"2025-01-30\",\"remarks\":\"Deleted\"}','2025-01-30 18:03:11');
INSERT INTO system_logs VALUES ('75','6','admin','Added new member to coop_members','{\"membership_id\":\"HFMDC23356\",\"name_of_member\":\"Barizo, Jowena\",\"created_at\":\"2025-01-30 11:04:29\"}','2025-01-30 18:04:29');
INSERT INTO system_logs VALUES ('76','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC23356\",\"name_of_member\":\"Barizo, Jowena\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 18:04:43');
INSERT INTO system_logs VALUES ('77','6','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC81724\",\"name_of_member\":\"Orlanda, Mary Rose\",\"Date_Added\":\"2025-01-30\"}','2025-01-30 18:07:13');
INSERT INTO system_logs VALUES ('78','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"100\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 18:07:37');
INSERT INTO system_logs VALUES ('79','6','admin','Created loan record successfully for Membership ID: HFMDC81724','{\"membership_id\":\"HFMDC81724\",\"name\":\"Orlanda, Mary Rose\",\"loan_amount\":\"100000\",\"payment_date\":\"2025-01-30\"}','2025-01-30 18:08:40');
INSERT INTO system_logs VALUES ('80','6','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC81724\",\"Name\":\"Orlanda, Mary Rose\",\"Amount\":\"100\",\"OR_number\":\"123456\",\"Date_Paid\":\"2025-01-30\"}','2025-01-30 18:22:59');
INSERT INTO system_logs VALUES ('81','6','admin','Marked shared capital entry as Deleted for Membership ID: 52','{\"membership_id\":\"52\",\"name_of_member\":\"Orlanda, Mary Rose\",\"amount\":\"100.00\",\"remarks\":\"Deleted\"}','2025-01-30 18:24:07');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('6','admin','admin@coop.com','$2y$10$VzufsaIX7wPSHar1KNWate1Kqb.AJmhdIWwSMP625CcWUrftZpLW6','1');
INSERT INTO users VALUES ('7','Jessa','jessa@coop.com','$2y$10$z/d4.JDZ0Kp90ml2pPr0Hu4xO8x60/Da5w44Sn6vP/K7O0bx4LaR6','0');

