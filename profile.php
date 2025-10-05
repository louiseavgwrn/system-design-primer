<?php
// Start or resume the session to maintain user state.
session_start();

// Include the database connection script.
require 'dbconnection.php';

// Determine the current username. Use 'current_account' from the session if available, else fallback to 'username'.
if (isset($_SESSION['current_account'])) {
    $current_username = $_SESSION['current_account'];
} else {
    $current_username = $_SESSION['username'];
}

// Initialize the database connection.
$database = new Database();
$connect = $database->getConnect();

// Prepare and execute a query to fetch user information based on the username.
$stmt = $connect->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $current_username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle empty phone numbers by assigning a default value.
if (empty($user['phone'])) {
    $user['phone'] = 'N/A';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for responsive design and character encoding -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Green Guardians</title>
    <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="Style/view_profile.css">
</head>
<body>
    <!-- Header section with navigation buttons -->
    <header>
        <button class="home-btn" onclick="window.location.href='useracc.php'">Home</button>
        <button class="profile-btn" onclick="toggleSidebar()">Profile Account</button>
    </header>

    <!-- Sidebar for additional navigation options -->
    <div id="sidebar" class="sidebar">
        <button onclick="window.location.href='profile.php'">View Profile</button>
        <button onclick="window.location.href='switchacc.php'">Switch Account</button>
        <button onclick="window.location.href='signup.php'">Sign Up Another Account</button>
        <button onclick="window.location.href='logout.php'">Log Out</button>
        <button class="close-btn" onclick="toggleSidebar()">Close</button>
    </div>

    <!-- Main content area -->
    <main>
        <!-- Display a personalized welcome message -->
        <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>

        <!-- Profile information section -->
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

    <!-- JavaScript for toggling the sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>

    <!-- Footer section -->
    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>