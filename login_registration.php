<?php include 'config/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #4cae4c;
        }
        .switch-form {
            text-align: center;
            margin-top: 10px;
        }
        .switch-form a {
            color: #007bff;
            text-decoration: none;
        }
        .switch-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">

        
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="logo.png" alt="Coop Logo" style="max-width: 200px; height: auto;">
        </div>

        <?php
        $is_login_form = isset($_GET['action']) && $_GET['action'] === 'register' ? false : true;
        ?>

        <h2><?php echo $is_login_form ? 'Login' : 'Register'; ?></h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <?php if (!$is_login_form): ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="action" value="<?php echo $is_login_form ? 'login' : 'register'; ?>">
                    <?php echo $is_login_form ? 'Login' : 'Register'; ?>
                </button>
            </div>
        </form>

        <div class="switch-form">
            <?php if ($is_login_form): ?>
                <p>Don’t have an account? <a href="?action=register">Register here</a>.</p>
            <?php else: ?>
                <p>Already have an account? <a href="?action=login">Login here</a>.</p>
            <?php endif; ?>
        </div>

        <div class="copyright" style="text-align: center;">
            <p>All Rights Reserved &copy; 2025</p>
        </div>
    </div>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if ($_POST['action'] === 'register') {
        $username = $conn->real_escape_string($_POST['username']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful. You can now log in.');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } elseif ($_POST['action'] === 'login') {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['password'])) {
                // Start a session
                session_start();
    
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Save login activity
                $stmt = $conn->prepare("INSERT INTO login_activity (username) VALUES (?)");
                $stmt->bind_param("s", $user['username']);
                $stmt->execute();

                // Redirect to the dashboard or any page
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Incorrect password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Email not found. Please register first.');</script>";
        }
    }
}


    $conn->close();
    ?>
</body>
</html>