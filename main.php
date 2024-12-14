<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>
    <link rel="Stylesheet" href="Style/mains.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Green Guardians</h1>
                <img src="https://p7.hiclipart.com/preview/845/955/587/earth-ecology-illustration-cartoon-fresh-green-earth.jpg" alt="Logo">
            </div>

            <div class="nav-links">
                <button onclick="window.location.href='main.php'">Home</button>
                <button onclick="window.location.href='aboutus.php'">About Us</button>
                <button onclick="window.location.href='contacts.php'">Contact Us</button>
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
        </nav>
    </header>

    <main>
        <h2>Fall in Love with Biodiversity</h2>
        <p>Biodiversity refers to the variety of life forms on Earth, including plants, animals, and microorganisms, and their ecosystems. It is the foundation of life, supporting ecosystem health and stability. By preserving biodiversity, we ensure the survival of species, the health of our environment, and the resilience of ecosystems to challenges like climate change. Explore how you can contribute to the protection of this invaluable resource.</p>

        <section>
            <h3>1. Importance of Biodiversity</h3>
            <p>Biodiversity ensures the stability and health of ecosystems by providing essential services such as air and water purification, pollination, climate regulation, and soil fertility. It is crucial for human survival and well-being, as it supports food production, medicine, and livelihoods. Protecting biodiversity helps maintain a balance in nature, ensuring that ecosystems can withstand and adapt to changes.</p>
        </section>

        <section>
            <h3>2. Threats to Biodiversity</h3>
            <p>Human activities like deforestation, habitat destruction, pollution, overfishing, and climate change have caused significant biodiversity loss. These threats disrupt ecosystems and lead to the extinction of species. It is essential to address these issues through sustainable practices, conservation efforts, and education to mitigate the adverse effects and protect biodiversity.</p>
        </section>

        <section>
            <h3>3. How You Can Help</h3>
            <p>Everyone can contribute to biodiversity conservation. Planting trees, reducing waste, supporting sustainable products, and creating wildlife-friendly spaces are simple steps that make a difference. Participating in local conservation programs, spreading awareness, and advocating for policies that protect biodiversity are impactful ways to ensure a better future for all living beings.</p>
        </section>
    </main>
</body>
</html>
