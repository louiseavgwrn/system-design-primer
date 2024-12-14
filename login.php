<?php
// Start the session to manage user authentication
session_start();

// Include the database connection file
require 'dbconnection.php';

// Initialize the Database object and establish a connection
$database = new Database();
$connect = $database->getConnect();

// Set the redirect URL, defaulting to 'useracc.php' if not provided in the URL
$redirectUrl = isset($_GET['redirect']) ? $_GET['redirect'] : 'useracc.php';

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the username and password from the form
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    try {
        // Prepare the query to select the user based on the provided username
        $stmt = $connect->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username); // Bind the username parameter
        $stmt->execute(); // Execute the query
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // If successful, set session variables for the logged-in user
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_id'] = $user['id'];

            // Redirect to the specified page (or default page)
            header("Location: $redirectUrl");
            exit; // Stop further execution after redirect
        } else {
            // Display an error message if username or password is invalid
            $error = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        // Handle any database-related errors and display an error message
        $error = "Database error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green Guardians</title>
    <link rel="stylesheet" href="Style/logins.css">
</head>
<body>
<a href="javascript:history.back()" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        Back
    </a>
    <form method="post" action="login.php">
        <h1>Login to Green Guardians</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        
        <p>Don't have an account? <a href="signup.php" style="color: #2c5f2d;">Sign up here</a>.</p>
    </form>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>


