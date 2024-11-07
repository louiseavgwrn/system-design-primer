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
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e8f5e9; 
            color: #2e7d32; 
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        h1 {
            color: #4caf50;
            margin-bottom: 0.5em;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #c8e6c9;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #388e3c;
        }
        .message {
            margin: 10px 0;
            color: red;
        }
    </style>
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
