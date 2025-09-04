
<?php
include 'config/config.php';

2
// Check if the form is submitted with 'coop_id' (for editing an existing member)
if (isset($_POST['coop_id'])) {
    // Get the submitted values
    $coop_id = $_POST['coop_id'];
    $name_of_member = $_POST['name_of_member'];
    $contact_number = $_POST['contact_number'];
    $highest_education = $_POST['highest_education'];
    $tin = $_POST['tin'];
    $date_accepted = $_POST['date_accepted'];
    $bod_resolution = $_POST['bod_resolution'];
    $civil_status = $_POST['civil_status'];
    $occupation = $_POST['occupation'];
    $number_of_dependents = $_POST['number_of_dependents'];
    $type_of_membership = $_POST['type_of_membership'];
    $shares_subscribed = $_POST['shares_subscribed'];
    $amount_subscribed = $_POST['amount_subscribed'];
    $initial_paid_up = $_POST['initial_paid_up'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $religious = $_POST['religious'];
    $annual_income = $_POST['annual_income'];

    // Prepare SQL query to update member data
    $sql = "UPDATE coop_members 
            SET name_of_member = ?, 
                contact_number = ?, 
                highest_education = ?, 
                tin = ?, 
                date_accepted = ?, 
                bod_resolution = ?, 
                civil_status = ?, 
                occupation = ?, 
                number_of_dependents = ?, 
                type_of_membership = ?, 
                shares_subscribed = ?, 
                amount_subscribed = ?, 
                initial_paid_up = ?, 
                address = ?, 
                date_of_birth = ?, 
                age = ?, 
                gender = ?, 
                religious = ?, 
                annual_income = ? 
            WHERE coop_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param(
        "sssssssssssssssssssi", 
        $name_of_member, 
        $contact_number, 
        $highest_education, 
        $tin, 
        $date_accepted, 
        $bod_resolution, 
        $civil_status, 
        $occupation, 
        $number_of_dependents, 
        $type_of_membership, 
        $shares_subscribed, 
        $amount_subscribed, 
        $initial_paid_up, 
        $address, 
        $date_of_birth, 
        $age, 
        $gender, 
        $religious, 
        $annual_income, 
        $coop_id
    );

    // Execute the query
    if ($stmt->execute()) {
        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            echo "Member updated successfully.";
        } else {
            echo "No changes were made. Member data is already up-to-date.";
        }
    } else {
        echo "Error updating member: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
?>