-- SQL script to create loan amortization schedule table for COOP system
-- This table will store detailed amortization schedules for each loan

CREATE TABLE `coop_loan_amortization_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `membership_id` varchar(50) NOT NULL,
  `period_number` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `amortization_amount` decimal(15,2) NOT NULL,
  `interest_amount` decimal(15,2) NOT NULL,
  `principal_amount` decimal(15,2) NOT NULL,
  `outstanding_balance` decimal(15,2) NOT NULL,
  `cumulative_interest` decimal(15,2) NOT NULL,
  `payment_status` enum('unpaid','partial','paid') DEFAULT 'unpaid',
  `amount_paid` decimal(15,2) DEFAULT 0.00,
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  KEY `membership_id` (`membership_id`),
  KEY `period_number` (`period_number`),
  KEY `payment_status` (`payment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Index for better performance on common queries
CREATE INDEX `idx_loan_period` ON `coop_loan_amortization_schedule` (`loan_id`, `period_number`);
CREATE INDEX `idx_member_status` ON `coop_loan_amortization_schedule` (`membership_id`, `payment_status`);

-- Add a trigger to update payment status when amount_paid changes
DELIMITER //
CREATE TRIGGER `update_payment_status` 
BEFORE UPDATE ON `coop_loan_amortization_schedule`
FOR EACH ROW
BEGIN
    IF NEW.amount_paid >= NEW.amortization_amount THEN
        SET NEW.payment_status = 'paid';
    ELSEIF NEW.amount_paid > 0 THEN
        SET NEW.payment_status = 'partial';
    ELSE
        SET NEW.payment_status = 'unpaid';
    END IF;
END//
DELIMITER ;