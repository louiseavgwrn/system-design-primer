<?php
// Start a session to manage user authentication status
session_start();

// Include the database connection file
require 'dbconnection.php';

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit; // Stop further script execution
}

// Determine the current username, either from the session or as the logged-in account
if (isset($_SESSION['current_account'])) {
    $current_username = $_SESSION['current_account']; // Use the current account username
} else {
    $current_username = $_SESSION['username']; // Use the default username if no current account set
}

// Initialize the Database object and establish a connection
$database = new Database();
$connect = $database->getConnect();

try {
    // Prepare a query to fetch user details based on the username
    $stmt = $connect->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $current_username, PDO::PARAM_STR); // Bind the username parameter
    $stmt->execute(); // Execute the query
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

    // Check if the user exists in the database
    if (!$user) {
        echo "User not found."; // Display error if user is not found
        exit; // Stop further execution
    }

    // If the phone number is empty, set it to 'N/A'
    if (empty($user['phone'])) {
        $user['phone'] = 'N/A'; // Set default phone value if not provided
    }
} catch (PDOException $e) {
    // Handle any database-related errors gracefully
    die("Database error: " . htmlspecialchars($e->getMessage())); // Display sanitized error message
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Green Guardians</title>
   
    <link rel="stylesheet" href="Style/view_profiles.css">
</head>
<body>
   
    <header>
        <button class="home-btn" onclick="window.location.href='useracc.php'">Home</button>
        <button class="profile-btn" onclick="toggleSidebar()">Profile Account</button>
    </header>

    <div id="sidebar" class="sidebar">
        <button onclick="window.location.href='profile.php'">View Profile</button>
        <button onclick="window.location.href='switchacc.php'">Switch Account</button>
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