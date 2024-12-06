<?php
// Start a new session or resume the existing session.
session_start();

// Include the database connection file.
require 'dbconnection.php';

// Initialize the database connection using the custom Database class.
$database = new Database();
$connect = $database->getConnect(); 

// Determine the redirect URL after login. Defaults to 'useracc.php' if not specified.
$redirectUrl = isset($_GET['redirect']) ? $_GET['redirect'] : 'useracc.php'; 

// Check if the request method is POST (indicating form submission).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input to prevent XSS attacks.
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    try {
        // Prepare a SQL query to fetch user data based on the provided username.
        $stmt = $connect->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username); // Bind the username parameter to prevent SQL injection.
        $stmt->execute(); // Execute the prepared statement.
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data as an associative array.

        // Verify the provided password against the hashed password stored in the database.
        if ($user && password_verify($password, $user['password'])) {
            // Store user information in the session to maintain login state.
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_id'] = $user['id']; 
            
            // Redirect the user to the specified URL or default page.
            header("Location: $redirectUrl");
            exit; // Terminate the script to ensure the redirect happens immediately.
        } else {
            // Set an error message if login credentials are invalid.
            $error = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        // Handle any database-related errors gracefully.
        $error = "Database error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata for the webpage -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green Guardians</title>
    <!-- Link to an external stylesheet for styling the login page -->
    <link rel="stylesheet" href="Style/login.css">
</head>
<body>
    <!-- Login form -->
    <form method="post" action="login.php">
        <h1>Login to Green Guardians</h1>

        <!-- Display an error message if one exists -->
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Username input field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <!-- Password input field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <!-- Submit button -->
        <button type="submit">Login</button>
        
        <!-- Link to the signup page -->
        <p>Don't have an account? <a href="signup.php" style="color: #2c5f2d;">Sign up here</a>.</p>
    </form>

    <!-- Footer section -->
    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>

