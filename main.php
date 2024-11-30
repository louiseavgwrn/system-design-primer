<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit;
}
?>

=======
>>>>>>> 0bfec16eb8cea4cff387ba3ebb7cdd84b23681ba
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <title>Welcome Dashboard</title>

</head>
<body>

    <header>
        <h1>Welcome Our Beloved Partners</h1>
    </header>

    <main>
        <div class="main-container">
            <button onclick="window.location.href='spguide.php'">Sustainable Practices Guide</button>
            <button onclick="window.location.href='eventcalendar.php'">Event Calendar</button>
            <button onclick="window.location.href='landsection.php'">Land Section</button>
            <button onclick="window.location.href='watersection.php'">Water Section</button>
            <button onclick="window.location.href='airsection.php'">Air Section</button>
            <button onclick="window.location.href='lifesection.php'">Living Section</button>
        </div>
    </main>

    <footer>
        <p>The Guardians</p>
    </footer>

>>>>>>> 0bfec16eb8cea4cff387ba3ebb7cdd84b23681ba
</body>
</html>
