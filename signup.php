<?php
session_start();
require 'userdatabase.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hashed = password_hash($password, PASSWORD_DEFAULT); 

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $error = "Username already exists.";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password_hashed);
        $stmt->execute();
        header("Location: login.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Green Guardians</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="form-container">
        <h1>Sign up for Green Guardians</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        
        <form method="post" action="signup.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Signup</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>
