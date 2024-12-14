<?php
// Start or resume a session to maintain user state.
session_start();

// Include the database connection file.
require 'dbconnection.php'; 

// Initialize the database connection using the custom Database class.
$database = new Database();
$connect = $database->getConnect(); 

// Check if the form is submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form inputs.
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];  
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Validate if the passwords match.
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password for secure storage.
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username or email already exists in the database.
        $stmt = $connect->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // If a match is found, return an error.
        if ($stmt->rowCount() > 0) {
            $error = "Username or Email already exists.";
        } else {
            // Try to insert the new user into the database.
            try {
                $stmt = $connect->prepare("INSERT INTO users (fullname, email, username, password, phone, date, gender, address) 
                                            VALUES (:fullname, :email, :username, :password, :phone, :date, :gender, :address)");
                // Bind parameters to the query to prevent SQL injection.
                $stmt->bindParam(':fullname', $fullname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password_hashed);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':address', $address);
                $stmt->execute();

                // Retrieve the ID of the newly created account.
                $account_id = $connect->lastInsertId(); 

                // Store user information in the session to maintain login state.
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['account_id'] = $account_id; 

                // Redirect to the login page after successful signup.
                header("Location: login.php");
                exit;
            } catch (PDOException $e) {
                // Handle database errors gracefully.
                $error = "Database error: " . $e->getMessage();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Green Guardians</title>
    <link rel="stylesheet" href="Style/signup.css">
</head>
<body>
    <div class="main-container">
        <!-- Back button for navigation -->
        <a href="javascript:history.back()" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
            </svg>
            Back
        </a>
        <div class="form-container">
        <h1>Sign up for Green Guardians</h1>
        <!-- Display error message if it exists -->
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="post" action="signup.php">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <label for="phone">Phone Number (Optional):</label>
                <input type="text" id="phone" name="phone">

                <label for="date">Date of Birth:</label>
                <input type="date" id="date" name="date" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>

                <button type="submit">Signup</button>
            </form>

            <!-- Link to login page -->
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>