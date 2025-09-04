<?php
// Database connection
include 'config/config.php';
session_start(); // Start session to access user information

// Function to generate membership ID
function generateMembershipID($conn) {
    $prefix = 'HFMPC';
    $numbers = '0123456789';

    do {
        $last_five = '';
        for ($i = 0; $i < 5; $i++) {
            $last_five .= $numbers[rand(0, strlen($numbers) - 1)];
        }

        $membership_id = $prefix . $last_five;

        $sql_check = "SELECT COUNT(*) as count FROM coop_members WHERE membership_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $membership_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            break;
        }
    } while (true);

    return $membership_id;
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        header("Location: coop_members.php?error=1&message=" . urlencode("Error: User not logged in."));
        exit();
    }

    // Get the username and user ID from the session
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Generate a unique membership ID
    $membership_id = generateMembershipID($conn);

    // Collect form data
    $name_of_member = $_POST['name_of_member'];
    $contact_number = $_POST['contact_number'];
    $tin = $_POST['tin'];
    $date_accepted = $_POST['date_accepted'];
    $type_of_membership = $_POST['type_of_membership'];
    $shares_subscribed = $_POST['shares_subscribed'];
    $amount_subscribed = $_POST['amount_subscribed'];
    $initial_paid_up = $_POST['initial_paid_up'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $occupation = $_POST['occupation'];
    $number_of_dependents = $_POST['number_of_dependents'];
    $religious = $_POST['religious'];
    $annual_income = $_POST['annual_income'];
    $educational_attainment  = $_POST['educational_attainment'];
    $bod_resolution = $_POST['bod_resolution'];

    // Prepare SQL insert statement with timestamp
    $sql = "INSERT INTO coop_members (
                membership_id, name_of_member, contact_number, tin, date_accepted, 
                type_of_membership, shares_subscribed, amount_subscribed, initial_paid_up, 
                address, date_of_birth, age, gender, civil_status, occupation, 
                number_of_dependents, religious, annual_income, educational_attainment, 
                bod_resolution, status, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdddssisssssdss", 
        $membership_id, 
        $name_of_member, 
        $contact_number, 
        $tin, 
        $date_accepted, 
        $type_of_membership, 
        $shares_subscribed, 
        $amount_subscribed, 
        $initial_paid_up, 
        $address, 
        $date_of_birth, 
        $age, 
        $gender, 
        $civil_status, 
        $occupation, 
        $number_of_dependents, 
        $religious, 
        $annual_income, 
        $educational_attainment, 
        $bod_resolution
    );

    // Execute the statement
    if ($stmt->execute()) {
        // Log the action
        $action = "Added new member to coop_members";
        $details = json_encode([
            'membership_id' => $membership_id,
            'name_of_member' => $name_of_member,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        logAction($conn, $userId, $username, $action, $details);

        // --- Add this block to also insert into coop_members_shared_capital ---
        $date_added = date('Y-m-d');
        $sql_sc = "INSERT INTO coop_members_shared_capital (Membership_ID, name_of_member, Date_Added, status) VALUES (?, ?, ?, 1)";
        $stmt_sc = $conn->prepare($sql_sc);
        $stmt_sc->bind_param("sss", $membership_id, $name_of_member, $date_added);
        $stmt_sc->execute();
        $stmt_sc->close();
        // --- End of new block ---

        // Redirect to the members page
        header("Location: coop_members.php?success=1&message=" . urlencode("New Member Successfully Added"));
        exit();
    } else {
        // Error message if insertion fails
        header("Location: coop_members.php?error=1&message=" . urlencode("Error: Could not add new member."));
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
