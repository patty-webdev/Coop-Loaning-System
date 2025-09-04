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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('9','HFMPC11966','Abadilla, Jennelyn E.','9298-834-463','133-632-781','2012-02-26','2012-001','Regualr','700.00','70000.00','57133.27','69 Hermana Fausta Street, Lucena City','1969-07-28','55','Female','Married','Faculty Staff','3','Roman Catholic','294218.00','','Bachelor\'s degree','1','','2025-06-04 11:01:45');
INSERT INTO coop_members VALUES ('10','HFMPC28599','Abalona, Mercedita','','911-271-255','2012-02-26','2012-001','Regualr','150.00','15000.00','10051.56','04B Osmeña St. Brgy. 1 Lucena City','1965-04-11','60','Female','Married','Security Guard','2','Roman Catholic','144000.00','','Vocational qualification','1','','2025-06-04 11:16:33');
INSERT INTO coop_members VALUES ('11','HFMPC09294','Abundabar, Filipinas G.','9215-677-840','174-074-216','2013-12-17','2013-005','Regualr','5200.00','520000.00','517066.32','Trinidad Ext. Brgy. 1 Lucena City','1971-06-07','54','Female','Married','Faculty Staff','2','Roman Catholic','268173.00','','Bachelor\'s degree','1','','2025-06-04 11:25:45');
INSERT INTO coop_members VALUES ('12','HFMPC10655','Africa, Beverly P.','','931-552-547','2018-09-13','2018-032','Regular','400.00','40000.00','33549.33','237 Dalahican Road, Lucena City','1981-06-23','43','Female','Married','Faculty Staff','1','Roman Catholic','260111.00','','Bachelor\'s degree','1','','2025-06-04 11:35:28');
INSERT INTO coop_members VALUES ('13','HFMPC91212','Ariola, May Anne B.','0995-450-0970','347-526-481','2024-10-03','2024-017','Regular','400.00','40000.00','24800.00','280 Libra St., Unson Subd., Zaballero, Brgy. Gulang-gulang, Lucena City','1981-04-07','44','Female','Married','Clinic/Salary','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 11:58:23');
INSERT INTO coop_members VALUES ('14','HFMPC04649','Arnisto, Ma. Jahziel O.','0949-904-3562','447-122-326','2024-04-04','2021-004','Regular','1000.00','100000.00','87072.25','Block 2, Lot 25, Rainbow St.,Red-V, Brgy. Ibabang Dupay, Lucena City','1993-10-14','32','Female','Single','Salary','0','Roman Catholic','200000.00','','Bachelor\'s degree','1','','2025-06-04 13:12:05');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('8','HFMPC11966','Abadilla, Jennelyn E.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('9','HFMPC28599','Abalona, Mercedita','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('10','HFMPC09294','Abundabar, Filipinas G.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('11','HFMPC10655','Africa, Beverly P.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('12','HFMPC91212','Ariola, May Anne B.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('13','HFMPC04649','Arnisto, Ma. Jahziel O.','2025-06-04','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('20','admin','2025-06-04 10:58:09');
INSERT INTO login_activity VALUES ('21','admin','2025-06-04 10:58:14');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('4','HFMPC11966','Abadilla, Jennelyn E.','57133.27','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('5','HFMPC28599','Abalona, Mercedita','10051.56','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('6','HFMPC09294','Abundabar, Filipinas G.','517066.32','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('7','HFMPC10655','Africa, Beverly P.','33549.33','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('8','HFMPC91212','Ariola, May Anne B.','24800.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('9','HFMPC04649','Arnisto, Ma. Jahziel O.','87072.25','0','2024-12-31','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO system_logs VALUES ('35','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC11966\",\"name_of_member\":\"Abadilla, Jennelyn E.\",\"created_at\":\"2025-06-04 05:01:45\"}','2025-06-04 11:01:45');
INSERT INTO system_logs VALUES ('36','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC11966\",\"Name\":\"Abadilla, Jennelyn E.\",\"Amount\":\"57133.27\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 11:12:00');
INSERT INTO system_logs VALUES ('37','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC28599\",\"name_of_member\":\"Abalona, Mercedita\",\"created_at\":\"2025-06-04 05:16:33\"}','2025-06-04 11:16:33');
INSERT INTO system_logs VALUES ('38','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC28599\",\"Name\":\"Abalona, Mercedita\",\"Amount\":\"10051.56\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 11:20:00');
INSERT INTO system_logs VALUES ('39','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC09294\",\"name_of_member\":\"Abundabar, Filipinas G.\",\"created_at\":\"2025-06-04 05:25:45\"}','2025-06-04 11:25:45');
INSERT INTO system_logs VALUES ('40','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC09294\",\"Name\":\"Abundabar, Filipinas G.\",\"Amount\":\"517066.32\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 11:26:22');
INSERT INTO system_logs VALUES ('41','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC10655\",\"name_of_member\":\"Africa, Beverly P.\",\"created_at\":\"2025-06-04 05:35:28\"}','2025-06-04 11:35:28');
INSERT INTO system_logs VALUES ('42','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC10655\",\"Name\":\"Africa, Beverly P.\",\"Amount\":\"33549.33\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 11:36:02');
INSERT INTO system_logs VALUES ('43','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC91212\",\"name_of_member\":\"Ariola, May Anne B.\",\"created_at\":\"2025-06-04 05:58:23\"}','2025-06-04 11:58:23');
INSERT INTO system_logs VALUES ('44','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC91212\",\"Name\":\"Ariola, May Anne B.\",\"Amount\":\"24800\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 11:58:58');
INSERT INTO system_logs VALUES ('45','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC04649\",\"name_of_member\":\"Arnisto, Ma. Jahziel O.\",\"created_at\":\"2025-06-04 07:12:05\"}','2025-06-04 13:12:05');
INSERT INTO system_logs VALUES ('46','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC04649\",\"Name\":\"Arnisto, Ma. Jahziel O.\",\"Amount\":\"87072.25\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:12:34');

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

