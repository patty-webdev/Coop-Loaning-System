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
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`coop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('1','HFMDC74476','Cueto Patrick AB.','09389496192','123123','2025-03-17','092741','Regular','1000','1000.00','1000.00','Brgy. Binagbag, Agdangan, Quezon','2025-03-17','25','Male','Single','IT','2','Catholic','300000.00','','Bachelor\'s degree','0','','2025-03-17 15:37:54');
INSERT INTO coop_members VALUES ('2','HFMDC40090','Medenilla, Charlie Karl A.','9389496192','9867945694847','2025-03-17','092741','Regular','1','1.00','1.00','Brgy. Binagbag, Agdangan, Quezon','2025-03-17','25','Male','Single','Teacher','12','Catholic','50000.00','','No formal education','1','Deleted','2025-03-17 15:53:26');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('1','admin','2025-03-20 13:44:40');
INSERT INTO login_activity VALUES ('2','admin','2025-03-27 14:24:17');
INSERT INTO login_activity VALUES ('3','admin','2025-03-28 08:53:37');
INSERT INTO login_activity VALUES ('4','admin','2025-03-28 12:25:24');
INSERT INTO login_activity VALUES ('5','admin','2025-06-02 10:55:02');
INSERT INTO login_activity VALUES ('6','admin','2025-06-02 15:20:53');
INSERT INTO login_activity VALUES ('7','admin','2025-06-02 18:03:49');
INSERT INTO login_activity VALUES ('8','admin','2025-06-02 18:08:20');
INSERT INTO login_activity VALUES ('9','admin','2025-06-02 22:28:26');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('1','0','Export CSV','Exported CSV file for membership information. Search query: \'\'. Records found: 2.','','2025-06-02 10:55:22');
INSERT INTO system_logs VALUES ('2','1','admin','Marked member and associated shared capital data as Deleted','{\"membership_id\":\"HFMDC40090\"}','2025-06-02 10:57:36');

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

