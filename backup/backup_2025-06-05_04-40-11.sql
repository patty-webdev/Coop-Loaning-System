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
  `gender` varchar(20) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `number_of_dependents` int(11) NOT NULL,
  `religious` varchar(100) NOT NULL,
  `annual_income` decimal(10,2) NOT NULL,
  `date_terminated` date DEFAULT NULL,
  `educational_attainment` varchar(50) DEFAULT NULL,
  `status` int(5) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`coop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members VALUES ('9','HFMPC11966','Abadilla, Jennelyn E.','9298-834-463','133-632-781','2012-02-26','2012-001','Regualr','700.00','70000.00','57133.27','69 Hermana Fausta Street, Lucena City','1969-07-28','55','Female','Married','Faculty Staff','3','Roman Catholic','294218.00','','Bachelor\'s degree','1','','2025-06-04 11:01:45');
INSERT INTO coop_members VALUES ('10','HFMPC28599','Abalona, Mercedita','','911-271-255','2012-02-26','2012-001','Regualr','150.00','15000.00','10051.56','04B Osmeña St. Brgy. 1 Lucena City','1965-04-11','60','Female','Married','Security Guard','2','Roman Catholic','144000.00','','Vocational qualification','1','','2025-06-04 11:16:33');
INSERT INTO coop_members VALUES ('11','HFMPC09294','Abundabar, Filipinas G.','9215-677-840','174-074-216','2013-12-17','2013-005','Regualr','5200.00','520000.00','517066.32','Trinidad Ext. Brgy. 1 Lucena City','1971-06-07','54','Female','Married','Faculty Staff','2','Roman Catholic','268173.00','','Bachelor\'s degree','1','','2025-06-04 11:25:45');
INSERT INTO coop_members VALUES ('12','HFMPC10655','Africa, Beverly P.','','931-552-547','2018-09-13','2018-032','Regular','400.00','40000.00','33549.33','237 Dalahican Road, Lucena City','1981-06-23','43','Female','Married','Faculty Staff','1','Roman Catholic','260111.00','','Bachelor\'s degree','1','','2025-06-04 11:35:28');
INSERT INTO coop_members VALUES ('13','HFMPC91212','Ariola, May Anne B.','0995-450-0970','347-526-481','2024-10-03','2024-017','Regular','400.00','40000.00','24800.00','280 Libra St., Unson Subd., Zaballero, Brgy. Gulang-gulang, Lucena City','1981-04-07','44','Female','Married','Clinic/Salary','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 11:58:23');
INSERT INTO coop_members VALUES ('14','HFMPC04649','Arnisto, Ma. Jahziel O.','0949-904-3562','447-122-326','2024-04-04','2021-004','Regular','1000.00','100000.00','87072.25','Block 2, Lot 25, Rainbow St.,Red-V, Brgy. Ibabang Dupay, Lucena City','1993-10-14','32','Female','Single','Salary','0','Roman Catholic','200000.00','','Bachelor\'s degree','1','','2025-06-04 13:12:05');
INSERT INTO coop_members VALUES ('15','HFMPC76176','Aguedan, Rina Abigail B.','','437-679-800','0000-00-00','','Regular','300.00','30000.00','22082.72','','0000-00-00','0','Female','Single','','0','','0.00','','Bachelor\'s degree','1','','2025-06-04 13:22:11');
INSERT INTO coop_members VALUES ('16','HFMPC96954','Aguilan, Alvin S.','','333-277-989','0000-00-00','','Regular','350.00','35000.00','30500.71','','0000-00-00','0','Male','Single','','0','','0.00','','Bachelor\'s degree','1','','2025-06-04 13:33:29');
INSERT INTO coop_members VALUES ('17','HFMPC52704','Angeles, Eugene P. Jr.','','434-835-348','0000-00-00','','Regular','200.00','20000.00','16004.86','','0000-00-00','0','Male','','','0','','0.00','','','1','','2025-06-04 13:36:34');
INSERT INTO coop_members VALUES ('18','HFMPC99738','Arnisto, Maria Carmen O.','','133-632-346','2012-02-26','2012-001','Regular','6500.00','650000.00','615152.16','Rainbow St., Red-V, Lucena City','1956-06-17','68','Female','Married','Faculty Staff','4','Roman Catholic','140000.00','','Bachelor\'s degree','1','','2025-06-04 13:48:00');
INSERT INTO coop_members VALUES ('19','HFMPC59219','Arobo, Josephine H. ','','912-982-972','2018-08-28','2018-029','Regular','30.00','3000.00','1577.70','Green Hills Street Ph. 2 Market View Lucena City','1958-12-30','66','Female','Widowed','HouseKeeper','4','Roman Catholic','192000.00','','Secondary education','1','','2025-06-04 13:56:58');
INSERT INTO coop_members VALUES ('20','HFMPC78457','Asia, Marieta A.','9208-952-169','133-632-292','2012-02-26','2012-001','Regular','2200.00','220000.00','208493.80','Solcomville Mayao, Lucena City','1963-11-16','61','Female','Married','HR Executive Director','1','Roman Catholic','513454.00','','Master\'s degree','1','','2025-06-04 14:03:30');
INSERT INTO coop_members VALUES ('21','HFMPC69123','Asia, Matusalem A.','9192-016-395','148-867-058','2024-11-13','2024-011','Regular','200.00','20000.00','10000.00','Blk. 11, Lot 10, Hillsview Subd., Brgy. Mayao Crossing, Lucena City','1965-04-28','60','Female','Married','Alumni','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 14:24:17');
INSERT INTO coop_members VALUES ('22','HFMPC31652','Ayala, Christinne Marianne','9778-010-096','234-712-870','2020-02-13','2020-002','Regular','150.00','15000.00','9178.21','Golden Meadows Pagbilao, Quezon','1981-11-11','43','Female','Married','School Dentist','0','Roman Catholic','200000.00','','Bachelor\'s degree','1','','2025-06-04 14:31:14');
INSERT INTO coop_members VALUES ('23','HFMPC84938','Ayala, Noel S.','9274-579-178','928-331-663','2020-02-13','2020-002','Regular','150.00','15000.00','9178.24','Golden Meadows Pagbilao, Quezon','1981-12-02','43','Male','Married','Clinical Instructor','0','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 14:36:48');
INSERT INTO coop_members VALUES ('24','HFMPC71883','Balanak, Christina S.','9175-940-445','938-634-254','2024-11-13','2024-011','Regular','250.00','25000.00','15800.00','Pearl St., West Employees Village, Gulang-gulang, Lucena City','1980-04-04','45','Female','Married','Clinic/Salary','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 14:43:03');
INSERT INTO coop_members VALUES ('25','HFMPC25448','Banog, Myrna','','133-632-397','2012-02-26','2012-001','Regula','300.00','30000.00','19813.74','Red-V, Lucena City','0000-00-00','0','Female','','Faculty Staff','1','Roman Catholic','0.00','','Bachelor\'s degree','1','','2025-06-04 14:50:00');
INSERT INTO coop_members VALUES ('26','HFMPC83214','Baronia, Vilma T.','9228-906-275','133-632-427','2012-02-26','2012-001','Regular','500.00','50000.00','43684.33','40 Geneva St. University Village Lucena City','1952-09-27','72','Female','Married','Retired','0','Roman Catholic','120000.00','','Doctorate or higher','1','','2025-06-04 15:05:14');
INSERT INTO coop_members VALUES ('27','HFMPC74117','Baroro, Maria, Lucila M.','9323-072-422','013-562-895','2012-02-26','2012-001','Regular','2550.00','255000.00','244967.55','Brgy. Lutucan Sariaya Quezon','1969-10-31','55','Female','Married','Faculty Staff','3','Roman Catholic','560356.00','','Master\'s degree','1','','2025-06-04 15:40:23');
INSERT INTO coop_members VALUES ('28','HFMPC95312','Betita, Gemma G.','','176-534-753','2012-02-26','2012-001','Regular','300.00','30000.00','25048.83','Brgy. Talipan, Pagbilao, Quezon','1969-12-15','55','Female','','NA','0','Roman Catholic','214565.00','','No formal education','1','','2025-06-04 15:48:12');
INSERT INTO coop_members VALUES ('29','HFMPC25168','Biglete, Felicitacion M.','9053-369-836','133-632-442','2012-02-26','2012-001','Associate','900.00','90000.00','85226.11','Hermana Fausta Village, Isabang Lucena City','1946-11-22','78','Female','Married','Retired','2','Roman Catholic','252000.00','','Bachelor\'s degree','1','','2025-06-04 15:58:55');
INSERT INTO coop_members VALUES ('30','HFMPC08811','Avellano, John Kent Phillip','','323-980-796','0000-00-00','2023','Regular','100.00','10000.00','6181.13','','0000-00-00','0','Male','Single','Faculty Staff','0','Roman Catholic','0.00','','Bachelor\'s degree','1','','2025-06-04 16:15:57');
INSERT INTO coop_members VALUES ('31','HFMPC17360','Bisa, Shiela Rose S.','','328-835-613','0000-00-00','','Regular','600.00','60000.00','54790.78','','0000-00-00','0','Female','Married','Faculty Staff','1','Roman Catholic','0.00','','Master\'s degree','1','','2025-06-04 16:18:38');
INSERT INTO coop_members VALUES ('32','HFMPC00121','Bonita, Ma. Josie C.','','','0000-00-00','2023','Regular','80.00','8000.00','5320.00','','0000-00-00','0','Female','','','0','Roman Catholic','0.00','','Bachelor\'s degree','1','','2025-06-04 16:22:00');
INSERT INTO coop_members VALUES ('33','HFMPC60425','Boston, Melvin','','283-863-532','0000-00-00','2023','Regular','20.00','2000.00','200.00','','0000-00-00','0','Male','','','0','Roman Catholic','0.00','','','1','','2025-06-04 16:23:40');
INSERT INTO coop_members VALUES ('34','HFMPC98580','Bugarin, Anna Liza M.','','253-193-554','2018-10-19','2018-035','Regular','60.00','6000.00','5164.80','Purok Sampaguita Silangang Mayao, Lucena City','1983-07-29','41','Female','Married','Faculty/Part-Time','2','Roman Catholic','140000.00','','','1','','2025-06-04 16:27:57');
INSERT INTO coop_members VALUES ('35','HFMPC54216','Cabanela, Azela M.','','261-439-747','2013-02-28','2013-001','Regular','1200.00','120000.00','111543.48','Purok Talabis, Ibabang Iyam Lucena City','1986-04-09','39','Female','Single','Library','0','Roman Catholic','221264.00','','Bachelor\'s degree','1','','2025-06-04 16:34:29');
INSERT INTO coop_members VALUES ('36','HFMPC92398','Cabangal, Nerico C.','9281-919-699','935-290-997','2016-09-16','2016-0011','Regular','600.00','60000.00','54371.93','Blk-11 Lot-34 Benco Village, Pagbilao Quezon','1975-07-06','49','Male','Married','Eco Park Staff','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-04 16:40:09');
INSERT INTO coop_members VALUES ('37','HFMPC98636','Cabile, Priscila R.','9087-209-695','133-632-514','2012-02-26','2012-001','Regular','50.00','5000.00','1000.00','Trinidad Ext. Brgy. 1 Lucena City','1967-11-16','57','Female','Single','Faculty Staff','1','Roman Catholic','361218.00','','Bachelor\'s degree','1','','2025-06-04 16:45:15');
INSERT INTO coop_members VALUES ('38','HFMPC31345','Cabula, Maria Karen J.','9228-250-581','926-507-440','2013-02-28','2013-001','Regular','1400.00','140000.00','134869.37','Avocado cor. Cacao Drive Sta Isabel Village, Tayabas Quezon','1981-08-04','43','Female','Married','Guidance Counselor','3','Roman Catholic','211856.00','','Bachelor\'s degree','1','','2025-06-04 16:56:37');
INSERT INTO coop_members VALUES ('39','HFMPC64750','Cagape, Cirilo A.','0916-703-2718','921-862-358','2018-07-17','2018-028','Regular','400.00','40000.00','32539.78','Purok Sariling Atin, Gulang-Gulang, Lucena City','1975-10-02','49','Male','Married','Maintenance','1','Roman Catholic','200000.00','','Bachelor\'s degree','1','','2025-06-05 08:26:31');
INSERT INTO coop_members VALUES ('40','HFMPC93035','Calzado, Luzviminda G.','9178-614-335','133-632-563','2012-02-26','2012-001','Regular','3000.00','300000.00','293525.52','2247 Cadium St. St. Peter II, Gulang-Gulang Lucena City','1957-04-09','68','Female','Widowed','Dean/Director','3','Roman Catholic','717443.00','','','1','','2025-06-05 08:30:57');
INSERT INTO coop_members VALUES ('41','HFMPC50773','Carillo, Mellisa L.','0998-950-5419','210-671-531','2016-11-18','2016-0015','Regular','1650.00','165000.00','153033.17','23 Sta. Ana Street Intertown Homes, Tayabas Quezon','1977-02-19','48','Female','Married','BED Principal','1','Roman Catholic','300000.00','','Master\'s degree','1','','2025-06-05 08:36:44');
INSERT INTO coop_members VALUES ('42','HFMPC70472','Clemente, Mercedes R.','0923-183-4177','133-633-531','2012-02-26','2012-001','Regular','1150.00','115000.00','106046.47','Phase V-C Macopa St. Calmar Subd., Kanlurang Mayao Lucena City','1966-04-07','59','Female','Married','Faculty Staff','3','Roman Catholic','300000.00','','Bachelor\'s degree','1','','2025-06-05 08:41:15');
INSERT INTO coop_members VALUES ('43','HFMPC90032','Cruz, Rizza Mae T.','0923-085-4385','291-630-046','2024-10-03','2024','Regular','20.00','2000.00','700.00','Earth cor. Venus St., CRDC Subd., Brgy. Bukal, Pagbilao, Quezon','1987-01-25','38','Female','Married','Registrar/Salary','4','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 08:45:49');
INSERT INTO coop_members VALUES ('44','HFMPC94129','Cruzat, Narciso G.','','169-443-150','2012-02-26','2012-001','Regular','3500.00','350000.00','335905.10','2424 Purok Sariling Atin Brgy. Gulang-Gulang Lucena City','1972-11-03','52','Male','Married','Director','0','Roman Catholic','542982.00','','Master\'s degree','1','','2025-06-05 08:49:38');
INSERT INTO coop_members VALUES ('45','HFMPC05830','Dadios, Ramon Paolo C.','','253-268-068','2019-07-17','2019-031','Regular','800.00','80000.00','73923.33','Blk. 1 Lot 14 Crown Asia Aventine, P. Cayetano Ave. Brgy. Ususan, Taguig City','1985-08-31','39','Male','Married','Mechanical Engineer','2','Roman Catholic','360000.00','','Bachelor\'s degree','1','','2025-06-05 08:58:39');
INSERT INTO coop_members VALUES ('46','HFMPC65936','Dalut, Maria Victoria T.','','185-609-926','0000-00-00','','Regular','850.00','85000.00','77401.17','','0000-00-00','0','Female','','','0','Roman Catholic','0.00','','','1','','2025-06-05 09:04:13');
INSERT INTO coop_members VALUES ('47','HFMPC57086','De Chavez, Isabel D.','0998-302-7680','903-032-767','2025-01-28','2025','Regular','50.00','5000.00','1000.00','Valdeavilla Apt., Merchan St., Brgy. 11, Lucena City','1970-11-19','54','Female','Married','Registrar','3','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 09:08:13');
INSERT INTO coop_members VALUES ('48','HFMPC02504','De Chavez, Jr., Estelito G.','','206-765-486','2019-02-12','2019-001','Regular','600.00','60000.00','47028.07','Jumawan St. Doña Concha Subd. Brgy Mamala 2 Sariaya, Quezon','1974-01-20','51','Male','Married','Electrician','2','Roman Catholic','286000.00','','Vocational qualification','1','','2025-06-05 09:11:54');
INSERT INTO coop_members VALUES ('49','HFMPC91615','De la Cruz, Sherwin C.','0943-485-7361','263-584-379','2012-02-26','2012-001','Regular','1250.00','125000.00','115845.89','Pantoc District Brgy. 9, Lucena City','1983-08-06','41','Male','Single','Faculty Staff','0','Roman Catholic','247925.00','','Bachelor\'s degree','1','','2025-06-05 09:18:38');
INSERT INTO coop_members VALUES ('50','HFMPC19740','De La Merced-Josol, Gloria P.','0939-930-7059','121-820-491','2025-01-28','2025','Regular','100.00','10000.00','2000.00','N-1 1202 MRRM Bldg., Ravanzo St., Brgy. 11, Lucena City','1959-06-24','65','Female','Married','HED Part-Time','1','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 09:22:06');
INSERT INTO coop_members VALUES ('51','HFMPC03004','De La Merced, Lilian P.','0939-930-7061','109-911-063','2025-01-28','2025','Regular','100.00','10000.00','2000.00','37-a San Antonio St.SFDM, Quezon City','1953-11-11','71','Female','Single','HED Part-Time','1','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 09:25:27');
INSERT INTO coop_members VALUES ('52','HFMPC76272','De la Torre, Aljer M.','','416-734-812','2018-02-02','2018-002','Regular','800.00','80000.00','73894.04','686 B Purok Pagkakaisa Brgy. Cotta Lucena City','1990-08-19','34','Male','Single','Faculty Staff','0','Roman Catholic','190000.00','','','1','','2025-06-05 09:32:20');
INSERT INTO coop_members VALUES ('53','HFMPC72857','Deapera, Renita D.','','133-632-677','2013-02-28','2013-001','Regular','650.00','65000.00','61661.46','Blk. 15 Lot 17 Mabulo St. Sta. Isabel Village, Tayabas Quezon','0000-00-00','0','Female','Married','Faculty Staff','0','Roman Catholic','278246.00','','','1','','2025-06-05 09:35:47');
INSERT INTO coop_members VALUES ('54','HFMPC18419','Del Pilar, Analiza P.','','169-443-055','2013-02-28','2013-001','Regular','1800.00','180000.00','169442.95','Octan Street Riville subd. Red-V Lucena City','1971-08-07','53','Female','Married','Librarian','1','Roman Catholic','240000.00','','Bachelor\'s degree','1','','2025-06-05 10:04:17');
INSERT INTO coop_members VALUES ('55','HFMPC99901','Dela Cruz, Ysabel Ane C.','0968-719-5617','653-822-383','2024-10-03','2024','Regular','20.00','2000.00','700.00','24 Blue St., Greenheights Subd., Brgy. Lalo, Tayabas, Quezon','2002-03-12','23','Female','Single','Guidance/Salary','2','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 10:10:04');
INSERT INTO coop_members VALUES ('56','HFMPC31548','Diaz, Sheila B.','0908-369-4619','926-502-794','2014-07-23','2014-005','Regular','1650.00','165000.00','156291.02','Caraballo St. Phase 8 Calmar Homes, Lucena City','1972-03-11','53','Female','Married','Faculty Staff','4','Roman Catholic','276489.00','','Bachelor\'s degree','1','','2025-06-05 10:15:06');
INSERT INTO coop_members VALUES ('57','HFMPC47974','Edora, Jhoy B.','','245-365-118','0000-00-00','2023','Regular','50.00','5000.00','3626.08','','0000-00-00','0','Female','','','0','Roman Catholic','0.00','','','1','','2025-06-05 10:19:51');
INSERT INTO coop_members VALUES ('58','HFMPC98030','Empeo, Gabriel D. ','0995-029-2397','450-342-278','2018-08-28','2018-029','Regular','450.00','45000.00','35277.98','Ladiana Apartment, Merchan Street Brgy. 11 Lucena City','1987-08-16','37','Male','Single','Office Staff','0','Roman Catholic','138000.00','','Bachelor\'s degree','1','','2025-06-05 10:25:33');
INSERT INTO coop_members VALUES ('59','HFMPC64690','Entrata, Catherine Mae R.','','348-398-448','2019-07-17','2019-031','Regular','100.00','10000.00','4409.30','Apt. #4 131 Arcadia St. Capitol Homesite Subd. Brgy. Cotta Lucena City Quezon','1998-02-17','27','Female','Single','Faculty Staff','0','Roman Catholic','180000.00','','Bachelor\'s degree','1','','2025-06-05 10:30:13');
INSERT INTO coop_members VALUES ('60','HFMPC75045','Eroa, Jeric P.','0999-913-6138','457-683-211','2016-06-06','2016-008','Regular','900.00','90000.00','82659.07','Blk. 7 Lot 12 Silver Creek Estate, Brgy. Bocohan Lucena City','1993-12-07','31','Male','Single','Faculty Staff','0','Roman Catholic','192000.00','','Bachelor\'s degree','1','','2025-06-05 10:35:30');
INSERT INTO coop_members VALUES ('61','HFMPC38199','Escobiñas, Ednalyn R.','0943-062-8274','973-032-688','2016-11-18','2016-0015','Regular','700.00','70000.00','63813.70','Bindweed St. Lovely Meadows Subd. Brgy. Wakas, Tayabas City','1973-11-26','51','Female','Married','Social Worker','3','Roman Catholic','192000.00','','Bachelor\'s degree','1','','2025-06-05 10:39:25');

CREATE TABLE `coop_members_shared_capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `name_of_member` varchar(50) NOT NULL,
  `Date_Added` date NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO coop_members_shared_capital VALUES ('8','HFMPC11966','Abadilla, Jennelyn E.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('9','HFMPC28599','Abalona, Mercedita','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('10','HFMPC09294','Abundabar, Filipinas G.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('11','HFMPC10655','Africa, Beverly P.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('12','HFMPC91212','Ariola, May Anne B.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('13','HFMPC04649','Arnisto, Ma. Jahziel O.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('14','HFMPC76176','Aguedan, Rina Abigail B.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('15','HFMPC96954','Aguilan, Alvin S.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('16','HFMPC52704','Angeles, Eugene P. Jr.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('17','HFMPC99738','Arnisto, Maria Carmen O.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('18','HFMPC59219','Arobo, Josephine H. ','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('19','HFMPC78457','Asia, Marieta A.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('20','HFMPC69123','Asia, Matusalem A.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('21','HFMPC31652','Ayala, Christinne Marianne','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('22','HFMPC84938','Ayala, Noel S.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('23','HFMPC71883','Balanak, Christina S.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('24','HFMPC25448','Banog, Myrna','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('25','HFMPC83214','Baronia, Vilma T.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('26','HFMPC74117','Baroro, Maria, Lucila M.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('27','HFMPC95312','Betita, Gemma G.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('28','HFMPC25168','Biglete, Felicitacion M.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('29','HFMPC08811','Avellano, John Kent Phillip','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('30','HFMPC17360','Bisa, Shiela Rose S.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('31','HFMPC00121','Bonita, Ma. Josie C.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('32','HFMPC60425','Boston, Melvin','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('33','HFMPC98580','Bugarin, Anna Liza M.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('34','HFMPC54216','Cabanela, Azela M.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('35','HFMPC92398','Cabangal, Nerico C.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('36','HFMPC98636','Cabile, Priscila R.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('37','HFMPC31345','Cabula, Maria Karen J.','2025-06-04','1','');
INSERT INTO coop_members_shared_capital VALUES ('38','HFMPC64750','Cagape, Cirilo A.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('39','HFMPC93035','Calzado, Luzviminda G.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('40','HFMPC50773','Carillo, Mellisa L.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('41','HFMPC70472','Clemente, Mercedes R.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('42','HFMPC90032','Cruz, Rizza Mae T.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('43','HFMPC94129','Cruzat, Narciso G.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('44','HFMPC05830','Dadios, Ramon Paolo C.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('45','HFMPC65936','Dalut, Maria Victoria T.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('46','HFMPC57086','De Chavez, Isabel D.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('47','HFMPC02504','De Chavez, Jr., Estelito G.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('48','HFMPC91615','De la Cruz, Sherwin C.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('49','HFMPC19740','De La Merced-Josol, Gloria P.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('50','HFMPC03004','De La Merced, Lilian P.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('51','HFMPC76272','De la Torre, Aljer M.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('52','HFMPC72857','Deapera, Renita D.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('53','HFMPC18419','Del Pilar, Analiza P.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('54','HFMPC99901','Dela Cruz, Ysabel Ane C.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('55','HFMPC31548','Diaz, Sheila B.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('56','HFMPC47974','Edora, Jhoy B.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('57','HFMPC98030','Empeo, Gabriel D. ','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('58','HFMPC64690','Entrata, Catherine Mae R.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('59','HFMPC75045','Eroa, Jeric P.','2025-06-05','1','');
INSERT INTO coop_members_shared_capital VALUES ('60','HFMPC38199','Escobiñas, Ednalyn R.','2025-06-05','1','');

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO login_activity VALUES ('20','admin','2025-06-04 10:58:09');
INSERT INTO login_activity VALUES ('21','admin','2025-06-04 10:58:14');
INSERT INTO login_activity VALUES ('22','admin','2025-06-04 17:03:18');

CREATE TABLE `shared_capital_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Membership_ID` varchar(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `OR_number` int(50) NOT NULL,
  `Date_Paid` date NOT NULL,
  `remarks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO shared_capital_amount VALUES ('4','HFMPC11966','Abadilla, Jennelyn E.','57133.27','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('5','HFMPC28599','Abalona, Mercedita','10051.56','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('6','HFMPC09294','Abundabar, Filipinas G.','517066.32','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('7','HFMPC10655','Africa, Beverly P.','33549.33','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('8','HFMPC91212','Ariola, May Anne B.','24800.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('9','HFMPC04649','Arnisto, Ma. Jahziel O.','87072.25','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('10','HFMPC76176','Aguedan, Rina Abigail B.','22082.72','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('11','HFMPC96954','Aguilan, Alvin S.','30500.71','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('12','HFMPC52704','Angeles, Eugene P. Jr.','16004.86','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('13','HFMPC99738','Arnisto, Maria Carmen O.','615152.16','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('14','HFMPC59219','Arobo, Josephine H. ','1577.70','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('15','HFMPC78457','Asia, Marieta A.','208493.80','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('16','HFMPC69123','Asia, Matusalem A.','10000.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('17','HFMPC31652','Ayala, Christinne Marianne','9178.21','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('18','HFMPC84938','Ayala, Noel S.','9178.24','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('19','HFMPC71883','Balanak, Christina S.','15800.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('20','HFMPC25448','Banog, Myrna','19813.74','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('21','HFMPC83214','Baronia, Vilma T.','43684.33','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('22','HFMPC74117','Baroro, Maria, Lucila M.','244967.55','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('23','HFMPC95312','Betita, Gemma G.','25048.83','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('24','HFMPC25168','Biglete, Felicitacion M.','85226.11','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('25','HFMPC08811','Avellano, John Kent Phillip','6181.13','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('26','HFMPC17360','Bisa, Shiela Rose S.','54790.78','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('27','HFMPC00121','Bonita, Ma. Josie C.','5320.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('28','HFMPC60425','Boston, Melvin','200.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('29','HFMPC98580','Bugarin, Anna Liza M.','5164.80','0','0004-12-31','');
INSERT INTO shared_capital_amount VALUES ('30','HFMPC54216','Cabanela, Azela M.','111543.48','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('31','HFMPC92398','Cabangal, Nerico C.','54371.93','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('32','HFMPC98636','Cabile, Priscila R.','1000.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('33','HFMPC31345','Cabula, Maria Karen J.','134869.37','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('34','HFMPC64750','Cagape, Cirilo A.','32539.78','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('35','HFMPC93035','Calzado, Luzviminda G.','293525.52','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('36','HFMPC50773','Carillo, Mellisa L.','153033.17','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('37','HFMPC70472','Clemente, Mercedes R.','106046.47','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('38','HFMPC90032','Cruz, Rizza Mae T.','700.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('39','HFMPC94129','Cruzat, Narciso G.','335905.10','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('40','HFMPC05830','Dadios, Ramon Paolo C.','73923.33','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('41','HFMPC65936','Dalut, Maria Victoria T.','77401.17','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('42','HFMPC57086','De Chavez, Isabel D.','1000.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('43','HFMPC02504','De Chavez, Jr., Estelito G.','47028.07','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('44','HFMPC91615','De la Cruz, Sherwin C.','115845.89','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('45','HFMPC19740','De La Merced-Josol, Gloria P.','0.00','0','2024-12-31','Deleted');
INSERT INTO shared_capital_amount VALUES ('46','HFMPC19740','De La Merced-Josol, Gloria P.','2000.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('47','HFMPC03004','De La Merced, Lilian P.','2000.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('48','HFMPC76272','De la Torre, Aljer M.','73894.04','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('49','HFMPC72857','Deapera, Renita D.','61661.46','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('50','HFMPC18419','Del Pilar, Analiza P.','169442.95','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('51','HFMPC99901','Dela Cruz, Ysabel Ane C.','700.00','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('52','HFMPC31548','Diaz, Sheila B.','156291.02','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('53','HFMPC47974','Edora, Jhoy B.','3626.08','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('54','HFMPC98030','Empeo, Gabriel D. ','35277.98','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('55','HFMPC64690','Entrata, Catherine Mae R.','4409.30','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('56','HFMPC75045','Eroa, Jeric P.','82659.07','0','2024-12-31','');
INSERT INTO shared_capital_amount VALUES ('57','HFMPC38199','Escobiñas, Ednalyn R.','63813.70','0','2024-12-31','');

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
INSERT INTO system_logs VALUES ('47','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC76176\",\"name_of_member\":\"Aguedan, Rina Abigail B.\",\"created_at\":\"2025-06-04 07:22:11\"}','2025-06-04 13:22:11');
INSERT INTO system_logs VALUES ('48','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC76176\",\"Name\":\"Aguedan, Rina Abigail B.\",\"Amount\":\"22082.72\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:29:03');
INSERT INTO system_logs VALUES ('49','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC96954\",\"name_of_member\":\"Aguilan, Alvin S.\",\"created_at\":\"2025-06-04 07:33:29\"}','2025-06-04 13:33:29');
INSERT INTO system_logs VALUES ('50','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC96954\",\"Name\":\"Aguilan, Alvin S.\",\"Amount\":\"30500.71\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:35:02');
INSERT INTO system_logs VALUES ('51','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC52704\",\"name_of_member\":\"Angeles, Eugene P. Jr.\",\"created_at\":\"2025-06-04 07:36:34\"}','2025-06-04 13:36:34');
INSERT INTO system_logs VALUES ('52','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC52704\",\"Name\":\"Angeles, Eugene P. Jr.\",\"Amount\":\"16004.86\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:37:33');
INSERT INTO system_logs VALUES ('53','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC99738\",\"name_of_member\":\"Arnisto, Maria Carmen O.\",\"created_at\":\"2025-06-04 07:48:00\"}','2025-06-04 13:48:00');
INSERT INTO system_logs VALUES ('54','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC99738\",\"Name\":\"Arnisto, Maria Carmen O.\",\"Amount\":\"615152.16\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:48:32');
INSERT INTO system_logs VALUES ('55','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC59219\",\"name_of_member\":\"Arobo, Josephine H. \",\"created_at\":\"2025-06-04 07:56:58\"}','2025-06-04 13:56:58');
INSERT INTO system_logs VALUES ('56','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC59219\",\"Name\":\"Arobo, Josephine H. \",\"Amount\":\"1577.7\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 13:57:11');
INSERT INTO system_logs VALUES ('57','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC78457\",\"name_of_member\":\"Asia, Marieta A.\",\"created_at\":\"2025-06-04 08:03:30\"}','2025-06-04 14:03:30');
INSERT INTO system_logs VALUES ('58','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC78457\",\"Name\":\"Asia, Marieta A.\",\"Amount\":\"208493.8\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:04:04');
INSERT INTO system_logs VALUES ('59','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC69123\",\"name_of_member\":\"Asia, Matusalem A.\",\"created_at\":\"2025-06-04 08:24:17\"}','2025-06-04 14:24:17');
INSERT INTO system_logs VALUES ('60','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC69123\",\"Name\":\"Asia, Matusalem A.\",\"Amount\":\"10000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:24:40');
INSERT INTO system_logs VALUES ('61','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC31652\",\"name_of_member\":\"Ayala, Christinne Marianne\",\"created_at\":\"2025-06-04 08:31:14\"}','2025-06-04 14:31:14');
INSERT INTO system_logs VALUES ('62','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC31652\",\"Name\":\"Ayala, Christinne Marianne\",\"Amount\":\"9178.21\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:31:45');
INSERT INTO system_logs VALUES ('63','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC84938\",\"name_of_member\":\"Ayala, Noel S.\",\"created_at\":\"2025-06-04 08:36:48\"}','2025-06-04 14:36:48');
INSERT INTO system_logs VALUES ('64','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC84938\",\"Name\":\"Ayala, Noel S.\",\"Amount\":\"9178.24\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:37:09');
INSERT INTO system_logs VALUES ('65','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC71883\",\"name_of_member\":\"Balanak, Christina S.\",\"created_at\":\"2025-06-04 08:43:03\"}','2025-06-04 14:43:03');
INSERT INTO system_logs VALUES ('66','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC71883\",\"Name\":\"Balanak, Christina S.\",\"Amount\":\"15800\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:43:33');
INSERT INTO system_logs VALUES ('67','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC25448\",\"name_of_member\":\"Banog, Myrna\",\"created_at\":\"2025-06-04 08:50:00\"}','2025-06-04 14:50:00');
INSERT INTO system_logs VALUES ('68','1','admin','Updated member details for Coop ID: 25','{\"coop_id\":\"25\",\"updated_data\":{\"name_of_member\":\"Banog, Myrna\",\"contact_number\":\"\",\"address\":\"Red-V, Lucena City\"}}','2025-06-04 14:57:17');
INSERT INTO system_logs VALUES ('69','1','admin','Updated member details for Coop ID: 25','{\"coop_id\":\"25\",\"updated_data\":{\"name_of_member\":\"Banog, Myrna\",\"contact_number\":\"\",\"address\":\"Red-V, Lucena City\"}}','2025-06-04 14:57:56');
INSERT INTO system_logs VALUES ('70','1','admin','Updated member details for Coop ID: 25','{\"coop_id\":\"25\",\"updated_data\":{\"name_of_member\":\"Banog, Myrna\",\"contact_number\":\"\",\"address\":\"Red-V, Lucena City\"}}','2025-06-04 14:58:58');
INSERT INTO system_logs VALUES ('71','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC25448\",\"Name\":\"Banog, Myrna\",\"Amount\":\"19813.74\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 14:59:19');
INSERT INTO system_logs VALUES ('72','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC83214\",\"name_of_member\":\"Baronia, Vilma T.\",\"created_at\":\"2025-06-04 09:05:14\"}','2025-06-04 15:05:14');
INSERT INTO system_logs VALUES ('73','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC83214\",\"Name\":\"Baronia, Vilma T.\",\"Amount\":\"43684.33\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 15:05:38');
INSERT INTO system_logs VALUES ('74','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC74117\",\"name_of_member\":\"Baroro, Maria, Lucila M.\",\"created_at\":\"2025-06-04 09:40:23\"}','2025-06-04 15:40:23');
INSERT INTO system_logs VALUES ('75','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC74117\",\"Name\":\"Baroro, Maria, Lucila M.\",\"Amount\":\"244967.55\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 15:40:36');
INSERT INTO system_logs VALUES ('76','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC95312\",\"name_of_member\":\"Betita, Gemma G.\",\"created_at\":\"2025-06-04 09:48:12\"}','2025-06-04 15:48:12');
INSERT INTO system_logs VALUES ('77','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC95312\",\"Name\":\"Betita, Gemma G.\",\"Amount\":\"25048.83\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 15:48:24');
INSERT INTO system_logs VALUES ('78','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC25168\",\"name_of_member\":\"Biglete, Felicitacion M.\",\"created_at\":\"2025-06-04 09:58:55\"}','2025-06-04 15:58:55');
INSERT INTO system_logs VALUES ('79','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC25168\",\"Name\":\"Biglete, Felicitacion M.\",\"Amount\":\"85226.11\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 15:59:11');
INSERT INTO system_logs VALUES ('80','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC08811\",\"name_of_member\":\"Avellano, John Kent Phillip\",\"created_at\":\"2025-06-04 10:15:57\"}','2025-06-04 16:15:57');
INSERT INTO system_logs VALUES ('81','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC08811\",\"Name\":\"Avellano, John Kent Phillip\",\"Amount\":\"6181.13\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:16:32');
INSERT INTO system_logs VALUES ('82','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC17360\",\"name_of_member\":\"Bisa, Shiela Rose S.\",\"created_at\":\"2025-06-04 10:18:38\"}','2025-06-04 16:18:38');
INSERT INTO system_logs VALUES ('83','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC17360\",\"Name\":\"Bisa, Shiela Rose S.\",\"Amount\":\"54790.78\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:18:56');
INSERT INTO system_logs VALUES ('84','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC00121\",\"name_of_member\":\"Bonita, Ma. Josie C.\",\"created_at\":\"2025-06-04 10:22:00\"}','2025-06-04 16:22:00');
INSERT INTO system_logs VALUES ('85','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC00121\",\"Name\":\"Bonita, Ma. Josie C.\",\"Amount\":\"5320\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:22:14');
INSERT INTO system_logs VALUES ('86','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC60425\",\"name_of_member\":\"Boston, Melvin\",\"created_at\":\"2025-06-04 10:23:40\"}','2025-06-04 16:23:40');
INSERT INTO system_logs VALUES ('87','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC60425\",\"Name\":\"Boston, Melvin\",\"Amount\":\"200\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:23:55');
INSERT INTO system_logs VALUES ('88','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC98580\",\"name_of_member\":\"Bugarin, Anna Liza M.\",\"created_at\":\"2025-06-04 10:27:57\"}','2025-06-04 16:27:57');
INSERT INTO system_logs VALUES ('89','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC98580\",\"Name\":\"Bugarin, Anna Liza M.\",\"Amount\":\"5164.8\",\"OR_number\":\"00000\",\"Date_Paid\":\"0004-12-31\"}','2025-06-04 16:28:15');
INSERT INTO system_logs VALUES ('90','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC54216\",\"name_of_member\":\"Cabanela, Azela M.\",\"created_at\":\"2025-06-04 10:34:29\"}','2025-06-04 16:34:29');
INSERT INTO system_logs VALUES ('91','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC54216\",\"Name\":\"Cabanela, Azela M.\",\"Amount\":\"111543.48\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:34:44');
INSERT INTO system_logs VALUES ('92','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC92398\",\"name_of_member\":\"Cabangal, Nerico C.\",\"created_at\":\"2025-06-04 10:40:09\"}','2025-06-04 16:40:09');
INSERT INTO system_logs VALUES ('93','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC92398\",\"Name\":\"Cabangal, Nerico C.\",\"Amount\":\"54371.93\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:40:46');
INSERT INTO system_logs VALUES ('94','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC98636\",\"name_of_member\":\"Cabile, Priscila R.\",\"created_at\":\"2025-06-04 10:45:15\"}','2025-06-04 16:45:15');
INSERT INTO system_logs VALUES ('95','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC98636\",\"Name\":\"Cabile, Priscila R.\",\"Amount\":\"1000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:45:34');
INSERT INTO system_logs VALUES ('96','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC31345\",\"name_of_member\":\"Cabula, Maria Karen J.\",\"created_at\":\"2025-06-04 10:56:37\"}','2025-06-04 16:56:37');
INSERT INTO system_logs VALUES ('97','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC31345\",\"Name\":\"Cabula, Maria Karen J.\",\"Amount\":\"134869.37\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-04 16:57:43');
INSERT INTO system_logs VALUES ('98','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC64750\",\"name_of_member\":\"Cagape, Cirilo A.\",\"created_at\":\"2025-06-05 02:26:31\"}','2025-06-05 08:26:31');
INSERT INTO system_logs VALUES ('99','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC64750\",\"Name\":\"Cagape, Cirilo A.\",\"Amount\":\"32539.78\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:26:57');
INSERT INTO system_logs VALUES ('100','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC93035\",\"name_of_member\":\"Calzado, Luzviminda G.\",\"created_at\":\"2025-06-05 02:30:57\"}','2025-06-05 08:30:57');
INSERT INTO system_logs VALUES ('101','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC93035\",\"Name\":\"Calzado, Luzviminda G.\",\"Amount\":\"293525.52\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:31:24');
INSERT INTO system_logs VALUES ('102','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC50773\",\"name_of_member\":\"Carillo, Mellisa L.\",\"created_at\":\"2025-06-05 02:36:44\"}','2025-06-05 08:36:44');
INSERT INTO system_logs VALUES ('103','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC50773\",\"Name\":\"Carillo, Mellisa L.\",\"Amount\":\"153033.17\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:37:31');
INSERT INTO system_logs VALUES ('104','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC70472\",\"name_of_member\":\"Clemente, Mercedes R.\",\"created_at\":\"2025-06-05 02:41:15\"}','2025-06-05 08:41:15');
INSERT INTO system_logs VALUES ('105','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC70472\",\"Name\":\"Clemente, Mercedes R.\",\"Amount\":\"106046.47\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:41:42');
INSERT INTO system_logs VALUES ('106','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC90032\",\"name_of_member\":\"Cruz, Rizza Mae T.\",\"created_at\":\"2025-06-05 02:45:49\"}','2025-06-05 08:45:49');
INSERT INTO system_logs VALUES ('107','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC90032\",\"Name\":\"Cruz, Rizza Mae T.\",\"Amount\":\"700\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:46:03');
INSERT INTO system_logs VALUES ('108','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC94129\",\"name_of_member\":\"Cruzat, Narciso G.\",\"created_at\":\"2025-06-05 02:49:38\"}','2025-06-05 08:49:38');
INSERT INTO system_logs VALUES ('109','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC94129\",\"Name\":\"Cruzat, Narciso G.\",\"Amount\":\"335905.1\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:50:00');
INSERT INTO system_logs VALUES ('110','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC05830\",\"name_of_member\":\"Dadios, Ramon Paolo C.\",\"created_at\":\"2025-06-05 02:58:39\"}','2025-06-05 08:58:39');
INSERT INTO system_logs VALUES ('111','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC05830\",\"Name\":\"Dadios, Ramon Paolo C.\",\"Amount\":\"73923.33\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 08:59:05');
INSERT INTO system_logs VALUES ('112','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC65936\",\"name_of_member\":\"Dalut, Maria Victoria T.\",\"created_at\":\"2025-06-05 03:04:13\"}','2025-06-05 09:04:13');
INSERT INTO system_logs VALUES ('113','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC65936\",\"Name\":\"Dalut, Maria Victoria T.\",\"Amount\":\"77401.17\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:04:27');
INSERT INTO system_logs VALUES ('114','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC57086\",\"name_of_member\":\"De Chavez, Isabel D.\",\"created_at\":\"2025-06-05 03:08:13\"}','2025-06-05 09:08:13');
INSERT INTO system_logs VALUES ('115','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC57086\",\"Name\":\"De Chavez, Isabel D.\",\"Amount\":\"1000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:08:31');
INSERT INTO system_logs VALUES ('116','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC02504\",\"name_of_member\":\"De Chavez, Jr., Estelito G.\",\"created_at\":\"2025-06-05 03:11:54\"}','2025-06-05 09:11:54');
INSERT INTO system_logs VALUES ('117','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC02504\",\"Name\":\"De Chavez, Jr., Estelito G.\",\"Amount\":\"47028.07\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:12:33');
INSERT INTO system_logs VALUES ('118','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC91615\",\"name_of_member\":\"De la Cruz, Sherwin C.\",\"created_at\":\"2025-06-05 03:18:38\"}','2025-06-05 09:18:38');
INSERT INTO system_logs VALUES ('119','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC91615\",\"Name\":\"De la Cruz, Sherwin C.\",\"Amount\":\"115845.89\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:18:52');
INSERT INTO system_logs VALUES ('120','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC19740\",\"name_of_member\":\"De La Merced-Josol, Gloria P.\",\"created_at\":\"2025-06-05 03:22:06\"}','2025-06-05 09:22:06');
INSERT INTO system_logs VALUES ('121','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC19740\",\"Name\":\"De La Merced-Josol, Gloria P.\",\"Amount\":\"2000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:22:19');
INSERT INTO system_logs VALUES ('122','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC03004\",\"name_of_member\":\"De La Merced, Lilian P.\",\"created_at\":\"2025-06-05 03:25:27\"}','2025-06-05 09:25:27');
INSERT INTO system_logs VALUES ('123','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC19740\",\"Name\":\"De La Merced-Josol, Gloria P.\",\"Amount\":\"2000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:25:43');
INSERT INTO system_logs VALUES ('124','1','admin','Contribution updated successfully','{\"Contribution_ID\":\"45\",\"Amount\":\"0\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:27:29');
INSERT INTO system_logs VALUES ('125','1','admin','Marked shared capital entry as Deleted for Membership ID: 45','{\"membership_id\":\"45\",\"name_of_member\":\"De La Merced-Josol, Gloria P.\",\"amount\":\"0.00\",\"remarks\":\"Deleted\"}','2025-06-05 09:27:49');
INSERT INTO system_logs VALUES ('126','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC03004\",\"Name\":\"De La Merced, Lilian P.\",\"Amount\":\"2000\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:28:14');
INSERT INTO system_logs VALUES ('127','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC76272\",\"name_of_member\":\"De la Torre, Aljer M.\",\"created_at\":\"2025-06-05 03:32:20\"}','2025-06-05 09:32:20');
INSERT INTO system_logs VALUES ('128','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC76272\",\"Name\":\"De la Torre, Aljer M.\",\"Amount\":\"73894.04\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:32:38');
INSERT INTO system_logs VALUES ('129','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC72857\",\"name_of_member\":\"Deapera, Renita D.\",\"created_at\":\"2025-06-05 03:35:47\"}','2025-06-05 09:35:47');
INSERT INTO system_logs VALUES ('130','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC72857\",\"Name\":\"Deapera, Renita D.\",\"Amount\":\"61661.46\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 09:36:01');
INSERT INTO system_logs VALUES ('131','1','admin','Updated member details for Coop ID: 53','{\"coop_id\":\"53\",\"updated_data\":{\"name_of_member\":\"Deapera, Renita D.\",\"contact_number\":\"\",\"address\":\"Blk. 15 Lot 17 Mabulo St. Sta. Isabel Village, Tayabas Quezon\"}}','2025-06-05 09:39:55');
INSERT INTO system_logs VALUES ('132','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC18419\",\"name_of_member\":\"Del Pilar, Analiza P.\",\"created_at\":\"2025-06-05 04:04:17\"}','2025-06-05 10:04:17');
INSERT INTO system_logs VALUES ('133','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC18419\",\"Name\":\"Del Pilar, Analiza P.\",\"Amount\":\"169442.95\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:04:44');
INSERT INTO system_logs VALUES ('134','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC99901\",\"name_of_member\":\"Dela Cruz, Ysabel Ane C.\",\"created_at\":\"2025-06-05 04:10:04\"}','2025-06-05 10:10:04');
INSERT INTO system_logs VALUES ('135','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC99901\",\"Name\":\"Dela Cruz, Ysabel Ane C.\",\"Amount\":\"700\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:10:24');
INSERT INTO system_logs VALUES ('136','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC31548\",\"name_of_member\":\"Diaz, Sheila B.\",\"created_at\":\"2025-06-05 04:15:06\"}','2025-06-05 10:15:06');
INSERT INTO system_logs VALUES ('137','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC31548\",\"Name\":\"Diaz, Sheila B.\",\"Amount\":\"156291.02\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:15:24');
INSERT INTO system_logs VALUES ('138','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC47974\",\"name_of_member\":\"Edora, Jhoy B.\",\"created_at\":\"2025-06-05 04:19:51\"}','2025-06-05 10:19:51');
INSERT INTO system_logs VALUES ('139','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC47974\",\"Name\":\"Edora, Jhoy B.\",\"Amount\":\"3626.08\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:20:37');
INSERT INTO system_logs VALUES ('140','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC98030\",\"name_of_member\":\"Empeo, Gabriel D. \",\"created_at\":\"2025-06-05 04:25:33\"}','2025-06-05 10:25:33');
INSERT INTO system_logs VALUES ('141','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC98030\",\"Name\":\"Empeo, Gabriel D. \",\"Amount\":\"35277.98\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:26:02');
INSERT INTO system_logs VALUES ('142','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC64690\",\"name_of_member\":\"Entrata, Catherine Mae R.\",\"created_at\":\"2025-06-05 04:30:13\"}','2025-06-05 10:30:13');
INSERT INTO system_logs VALUES ('143','1','admin','Updated member details for Coop ID: 59','{\"coop_id\":\"59\",\"updated_data\":{\"name_of_member\":\"Entrata, Catherine Mae R.\",\"contact_number\":\"\",\"address\":\"Apt. #4 131 Arcadia St. Capitol Homesite Subd. Brgy. Cotta Lucena City Quezon\"}}','2025-06-05 10:31:19');
INSERT INTO system_logs VALUES ('144','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC64690\",\"Name\":\"Entrata, Catherine Mae R.\",\"Amount\":\"4409.3\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:31:45');
INSERT INTO system_logs VALUES ('145','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC75045\",\"name_of_member\":\"Eroa, Jeric P.\",\"created_at\":\"2025-06-05 04:35:30\"}','2025-06-05 10:35:30');
INSERT INTO system_logs VALUES ('146','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC75045\",\"Name\":\"Eroa, Jeric P.\",\"Amount\":\"82659.07\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:36:00');
INSERT INTO system_logs VALUES ('147','1','admin','Added new member to coop_members','{\"membership_id\":\"HFMPC38199\",\"name_of_member\":\"Escobi\\u00f1as, Ednalyn R.\",\"created_at\":\"2025-06-05 04:39:25\"}','2025-06-05 10:39:25');
INSERT INTO system_logs VALUES ('148','1','admin','Contribution added successfully','{\"Membership_ID\":\"HFMPC38199\",\"Name\":\"Escobi\\u00f1as, Ednalyn R.\",\"Amount\":\"63813.7\",\"OR_number\":\"00000\",\"Date_Paid\":\"2024-12-31\"}','2025-06-05 10:39:48');

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

