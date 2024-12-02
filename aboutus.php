<?php
$practices = [
    ['title' => 'Promote the Importance of Plants (Land)', 'description' => 'We advocate for planting and preserving trees and other plants, which are vital for maintaining ecological balance and biodiversity.'],
    ['title' => 'Encourage Water Conservation (Water)', 'description' => 'We educate communities on water-saving practices, such as using efficient appliances and fixing leaks, to conserve this precious resource.'],
    ['title' => 'Advocate for Clean Air (Air)', 'description' => 'We support efforts to improve air quality through the reduction of pollutants, promoting renewable energy, and planting trees to absorb CO2.'],
    ['title' => 'Protect and Conserve Wildlife (Living)', 'description' => 'We actively engage in protecting endangered species and preserving their habitats to maintain the diversity of life on Earth.']
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Promoting Sustainability</title>
    <link rel="stylesheet" href="Style/aboutus.css">
</head>
<body>

<header>
    <h1>About Us</h1>
</header>

<div class="nav-links">
                <button onclick="window.location.href='main.php'">Home</button>
                <button onclick="window.location.href='aboutus.php'">About Us</button>
                <button onclick="window.location.href='contactus.php'">Contact Us</button>
                <div class="dropdown">
                    <button class="dropdown-btn">Sections</button>
                    <div class="dropdown-content">
                        <a href="login.php?redirect_to=landsection.php">Land Section</a>
                        <a href="login.php?redirect_to=watersection.php">Water Section</a>
                        <a href="login.php?redirect_to=airsection.php">Air Section</a>
                        <a href="login.php?redirect_to=lifesection.php">Life Section</a>
                    </div>
                </div>
                <button onclick="window.location.href='login.php'">Login</button>
                <button onclick="window.location.href='signup.php'">Sign Up</button>
            </div>

<main>
    <section class="textbox who-we-are">
        <h2>Who We Are</h2>
        <p>We are a passionate team committed to promoting sustainability and protecting biodiversity. Our mission is to inspire and empower people to take actionable steps toward a greener, more sustainable future.</p>
    </section>

    <section class="textbox our-vision">
        <h2>Our Vision</h2>
        <p>We envision a world where humans and nature coexist in harmony, with thriving ecosystems, clean air and water, and a commitment to preserving life for future generations.</p>
    </section>

    <section class="textbox our-mission">
        <h2>Our Mission</h2>
        <p>To foster awareness and action toward sustainable practices that preserve biodiversity and combat climate change.</p>
    </section>

    <section class="textbox we-do">
        <h2>What We Do</h2>
        <ul>
            <?php foreach ($practices as $practice): ?>
                <li><strong><?php echo htmlspecialchars($practice['title']); ?>:</strong> <?php echo htmlspecialchars($practice['description']); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="image-gallery textbox">
        <h2>Meet Our Team</h2>
        <div class="gallery">
            <figure>
                <img src="Images/Kyle.jpg" alt="Mr. Libera, Kyle Gian S. - Contributor">
                <figcaption>Mr. Libera, Kyle Gian S.</figcaption>
            </figure>
            <figure>
                <img src="Images/Louise.jpg" alt="Ms. Gawaran, Louise Anne - Contributor">
                <figcaption>Ms. Gawaran, Louise Anne</figcaption>
            </figure>
            <figure>
                <img src="Images/Yancy.jpg" alt="Mr. Arligue, Yancy - Contributor">
                <figcaption>Mr. Arligue, Yancy</figcaption>
            </figure>
        </div>
    </section>
</main>

<footer>
    <p>Stay updated with the latest news and tips on sustainability!</p>
    <p>&copy; 2024 The Guardians | All Rights Reserved</p>
</footer>

</body>
</html>
