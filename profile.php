<?php
session_start();
require 'userdatabase.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

try {

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }

    if (empty($user['phone'])) {
        $user['phone'] = 'N/A';
    }
    
} catch (PDOException $e) {
   
    die("Database error: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Green Guardians</title>
    <link rel="stylesheet" href="Style/view_profile.css">
    
</head>
<body>
    <header>
        <button class="home-btn" onclick="window.location.href='main.php'">Home</button>
        <button class="profile-btn" onclick="toggleSidebar()">Profile Account</button>
    </header>

    <div id="sidebar" class="sidebar">
        <button onclick="window.location.href='profile.php'">View Profile</button>
        <button onclick="window.location.href='switch.php'">Switch Account</button>
        <button onclick="window.location.href='signup.php'">Sign Up Another Account</button>
        <button onclick="window.location.href='logout.php'">Log Out</button>
        <button class="close-btn" onclick="toggleSidebar()">Close</button>
    </div>

    <main>
        <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>

        <div class="profile-container">
            <h2>Your Information:</h2>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['date']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($user['address'])); ?></p>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>