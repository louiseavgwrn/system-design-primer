<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Guardians - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Your Green Guardians Dashboard</p>
        <nav>
            <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="index.php">Homepage</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="dashboard-info">
            <h2>Your Green Journey</h2>
            <p>Welcome to your personalized dashboard. Explore resources, events, and contribute to the community!</p>
        </section>

        <section id="features">
            <h2>Explore Our Sections</h2>
            <ul>
                <li><a href="sustainable-practices.php">Sustainable Practices Guide</a></li>
                <li><a href="event-calendar.php">Event Calendar</a></li>
                <li><a href="land-section.php">Land Section</a></li>
                <li><a href="water-section.php">Water Section</a></li>
                <li><a href="living-section.php">Living Section</a></li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>
