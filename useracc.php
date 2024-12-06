<?php
// Start or resume the session to maintain user state.
session_start();

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Retrieve the current user's account ID from the session.
$current_account_id = $_SESSION['account_id'] ?? null;

// Validate that the account ID exists in the session.
if (!$current_account_id) {
    die("Error: Account ID not found in session.");
}

// Include the database connection file.
require 'dbconnection.php';
$database = new Database();
$connect = $database->getConnect();

try {
    // Fetch the username of the logged-in user from the database.
    $stmt = $connect->prepare("SELECT username FROM users WHERE id = :account_id");
    $stmt->bindParam(':account_id', $current_account_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user record is not found, terminate the script.
    if (!$user) {
        die("User not found.");
    }

    // Store the username for display purposes.
    $username = $user['username'];  

    // Fetch additional data associated with the user's account.
    $stmt = $connect->prepare("SELECT data_field, created_at FROM user_data WHERE account_id = :account_id");
    $stmt->bindParam(':account_id', $current_account_id, PDO::PARAM_INT);
    $stmt->execute();
    $account_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any database errors and terminate the script.
    die("Database error: " . htmlspecialchars($e->getMessage()));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set up the page metadata and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>
    <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="Style/useracc.css">
</head>
<body>
<header>
    <!-- Navigation bar for the dashboard -->
    <nav>
        <!-- Logo section -->
        <div class="logo">
            <h1>Green Guardians</h1>
            <img src="https://p7.hiclipart.com/preview/845/955/587/earth-ecology-illustration-cartoon-fresh-green-earth.jpg" alt="Logo">
        </div>

        <!-- Navigation links -->
        <div class="nav-links">
            <button onclick="window.location.href='useracc.php'">Home</button>
            <button onclick="window.location.href='useraboutus.php'">About Us</button>
            <button onclick="window.location.href='usercontactus.php'">Contact Us</button>
            
            <!-- Dropdown menu for additional sections -->
            <div class="dropdown">
                <button class="dropdown-btn">Sections</button>
                <div class="dropdown-content">
                    <a href="landsection.php">Land Section</a>
                    <a href="watersection.php">Water Section</a>
                    <a href="airsection.php">Air Section</a>
                    <a href="lifesection.php">Life Section</a>
                </div>
            </div>
            
            <!-- Profile account button -->
            <button class="profile-btn" onclick="toggleSidebar()">Profile Account</button>
        </div>
    </nav>
</header>

<!-- Sidebar for user profile and account actions -->
<div id="sidebar" class="sidebar">
    <button onclick="window.location.href='profile.php'">View Profile</button>
    <button onclick="window.location.href='switchacc.php'">Switch Account</button>
    <button onclick="window.location.href='signup.php'">Sign Up Another Account</button>
    <button onclick="window.location.href='logout.php'">Log Out</button>
    <button class="close-btn" onclick="toggleSidebar()">Close</button>
</div>

<main>
    <!-- Welcome message for the logged-in user -->
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>  
    <h2>Fall in Love with Biodiversity</h2>
    <p>
        Biodiversity refers to the variety of life forms on Earth, including plants, animals, and microorganisms, and their ecosystems. 
        It is the foundation of life, supporting ecosystem health and stability. By preserving biodiversity, we ensure the survival of 
        species, the health of our environment, and the resilience of ecosystems to challenges like climate change. Explore how you 
        can contribute to the protection of this invaluable resource.
    </p>

    <!-- Display user-specific data if available -->
    <?php if (!empty($account_data)): ?>
        <h3>Your Data:</h3>
        <ul>
            <?php foreach ($account_data as $data): ?>
                <li>
                    <strong><?php echo htmlspecialchars($data['data_field']); ?></strong> 
                    (Added on: <?php echo htmlspecialchars($data['created_at']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No data available for this account.</p>
    <?php endif; ?>
</main>

<!-- JavaScript for sidebar toggle functionality -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("active");
    }
</script>

</body>
</html>