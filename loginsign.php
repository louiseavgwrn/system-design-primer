<?php
session_start();

// Sample user data (typically, you'd use a database, but we're using an array for simplicity)
$users = [
    'user@example.com' => ['username' => 'SampleUser', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
];

// Message variable to hold any status messages for the user
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registration process
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if the email is already registered
        if (isset($users[$email])) {
            $message = "Email already registered!";
        } else {
            // Add new user to the array
            $users[$email] = ['username' => $username, 'password' => $password];
            $message = "Registration successful! You can now log in.";
        }
    }

    // Login process
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user exists and password is correct
        if (isset($users[$email]) && password_verify($password, $users[$email]['password'])) {
            $_SESSION['user'] = $users[$email]['username'];
            $message = "Login successful! Welcome, " . htmlspecialchars($users[$email]['username']) . "!";
        } else {
            $message = "Invalid email or password!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href ="Style/login_signup.css">

</head>
<body>
    <div class="form-container">
        <h1>Login & Register</h1>

        <!-- Display message from PHP -->
        <div class="message">
            <?php if ($message) echo "<p>$message</p>"; ?>
        </div>

        <!-- Login Form -->
        <div>
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="login" value="Login">
            </form>
        </div>

        <!-- Registration Form -->
        <div>
            <h2>Register</h2>
            <form action="index.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
