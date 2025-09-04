CREATE TABLE `coop_member_loan_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(50) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `OR_number` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `membership_id` (`membership_id`),
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `coop_member_loan_payments_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `coop_members` (`membership_id`) ON DELETE CASCADE,
  CONSTRAINT `coop_member_loan_payments_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `coop_member_loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  PRIMARY KEY (`id`),
  KEY `membership_id` (`membership_id`),
  CONSTRAINT `coop_member_loans_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `coop_members` (`membership_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
  PRIMARY KEY (`coop_id`),
  UNIQUE KEY `membership_id` (`membership_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('1','HFMDC58720','Cueto Patrick D.','09389496192','123456789','2025-02-02','092741','member','123456','100.00','100.00','Brgy. Binagbag Agdangan Quezon ','2025-02-02','25','Female','Single','IT','2','Catholic','25000.00','','Bachelor\'s degree','1','','2025-02-02 20:47:40');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `date_added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_id` (`membership_id`),
  CONSTRAINT `coop_members_shared_capital_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `coop_members` (`membership_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('2','HFMDC58720','Cueto Patrick C.','2025-02-02','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('1','admin','2025-02-02 21:03:25');
INSERT INTO login_activity VALUES ('2','admin','2025-02-05 11:09:30');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `date_paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_id` (`membership_id`),
  CONSTRAINT `shared_capital_amount_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `coop_members` (`membership_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('1','HFMDC58720','Cueto Patrick C.','200.00','123123','2025-02-02','');
INSERT INTO shared_capital_amount VALUES ('2','HFMDC58720','Cueto Patrick C.','200.00','123123','2025-02-02','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('1','9','Jessa','Added new member to coop_members','{\"membership_id\":\"HFMDC58720\",\"name_of_member\":\"Cueto Patrick C.\",\"created_at\":\"2025-02-02 13:47:40\"}','2025-02-02 20:47:40');
INSERT INTO system_logs VALUES ('2','9','Jessa','Added a member to shared capital','{\"Membership_ID\":\"HFMDC58720\",\"name_of_member\":\"Cueto Patrick C.\",\"Date_Added\":\"2025-02-02\"}','2025-02-02 20:48:25');
INSERT INTO system_logs VALUES ('3','9','Jessa','Contribution added successfully','{\"Membership_ID\":\"HFMDC58720\",\"Name\":\"Cueto Patrick C.\",\"Amount\":\"100\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-02-02\"}','2025-02-02 20:48:34');
INSERT INTO system_logs VALUES ('4','9','Jessa','Contribution updated successfully','{\"Contribution_ID\":\"1\",\"Amount\":\"200.00\",\"Date_Paid\":\"2025-02-02\"}','2025-02-02 20:51:44');
INSERT INTO system_logs VALUES ('5','9','Jessa','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC58720\"}','2025-02-02 20:51:53');
INSERT INTO system_logs VALUES ('6','1','admin','Added a member to shared capital','{\"Membership_ID\":\"HFMDC58720\",\"name_of_member\":\"Cueto Patrick C.\",\"Date_Added\":\"2025-02-02\"}','2025-02-02 21:04:25');
INSERT INTO system_logs VALUES ('7','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMDC58720\",\"Name\":\"Cueto Patrick C.\",\"Amount\":\"200\",\"OR_number\":\"123123\",\"Date_Paid\":\"2025-02-02\"}','2025-02-02 21:04:38');
INSERT INTO system_logs VALUES ('8','1','admin','Updated member details for Coop ID: 1','{\"coop_id\":\"1\",\"updated_data\":{\"name_of_member\":\"Cueto Patrick D.\",\"contact_number\":\"09389496192\",\"address\":\"Brgy. Binagbag Agdangan Quezon \"}}','2025-02-05 11:09:53');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES ('1','admin','admin@gmail.com','$2y$10$gMNxFuV3tGxQ511HfGTRd.g/MiZFjtRI127asPED3nwPgTHwNj9wO','1');

