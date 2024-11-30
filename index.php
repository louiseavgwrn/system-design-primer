<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Guardians - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome to Green Guardians</h1>
        <p>Promoting Biodiversity and Sustainable Practices</p>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="about-us">
            <h2>About Us</h2>
            <p>Green Guardians is committed to protecting our planet by promoting sustainable practices. Join our community!</p>
        </section>

        <section id="featured">
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
