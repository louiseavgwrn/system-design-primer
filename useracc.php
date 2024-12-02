<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>
    <link rel="Stylesheet" href="Style/useracc.css">
</head>
<body>
<header>
        <nav>
            <div class="logo">
                <h1>Green Guardians</h1>
                <img src="https://p7.hiclipart.com/preview/845/955/587/earth-ecology-illustration-cartoon-fresh-green-earth.jpg" alt="Logo">
            </div>

            <div class="nav-links">
                <button onclick="window.location.href='useracc.php'">Home</button>
                <button onclick="window.location.href='useraboutus.php'">About Us</button>
                <button onclick="window.location.href='usercontactus.php'">Contact Us</button>
                <div class="dropdown">
                    <button class="dropdown-btn">Sections</button>
                    <div class="dropdown-content">
                        <a href="landsection.php">Land Section</a>
                        <a href="watersection.php">Water Section</a>
                        <a href="airsection.php">Air Section</a>
                        <a href="lifesection.php">Life Section</a>
                    </div>
                </div>

                
                <button class="profile-btn" onclick="toggleSidebar()">Profile Account</button>
            </div>
        </nav>
    </header>


    <div id="sidebar" class="sidebar">
        <button onclick="window.location.href='profile.php'">View Profile</button>
        <button onclick="window.location.href='switch.php'">Switch account</button>
        <button onclick="window.location.href='signup.php'">Sign up another account</button>
        <button onclick="window.location.href='logout.php'">Log out</button>
        <button class="close-btn" onclick="toggleSidebar()">Close</button>
    </div>

    <main>
        <h2>Fall in Love with Biodiversity</h2>
        <p>Biodiversity refers to the variety of life forms on Earth, including plants, animals, and microorganisms, and their ecosystems. It is the foundation of life, supporting ecosystem health and stability. By preserving biodiversity, we ensure the survival of species, the health of our environment, and the resilience of ecosystems to challenges like climate change. Explore how you can contribute to the protection of this invaluable resource.</p>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>

</body>
</html>
