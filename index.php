<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Guardians - Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to Green Guardians</h1>
    <p>Promoting Biodiversity and Sustainable Practices</p>

    <nav>
        <ul>
            <?php if (isset($_SESSION['username'])): ?>
                <!-- If logged in -->
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <!-- If not logged in -->
                <li><a href="signup.php">Signup</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>
