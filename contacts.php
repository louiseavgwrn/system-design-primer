<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/contacts.css">
    <title>Contacts</title>
</head>
<body>
    <div class="navbar">
        <button class="nav-button" onclick="window.location.href='main.php'">Home</button>
        <button class="nav-button" onclick="window.location.href='aboutus.php'">About Us</button>
        <button class="nav-button" onclick="window.location.href='contacts.php'">Contact Us</button>
        <div class="dropdown">
            <button class="dropdown-button">Sections</button>
            <div class="dropdown-content">
                <a class="dropdown-link" href="login.php?redirect_to=landsection.php">Land Section</a>
                <a class="dropdown-link" href="login.php?redirect_to=watersection.php">Water Section</a>
                <a class="dropdown-link" href="login.php?redirect_to=airsection.php">Air Section</a>
                <a class="dropdown-link" href="login.php?redirect_to=lifesection.php">Life Section</a>
            </div>
        </div>
        <button class="nav-button" onclick="window.location.href='login.php'">Login</button>
        <button class="nav-button" onclick="window.location.href='signup.php'">Sign Up</button>
    </div>

    <section class="contact-section">
        <h1 class="section-title">Contact Information</h1>
        <div class="contact-item">
            <h2 class="contact-title">Address</h2>
            <p class="contact-detail">Ibaan, Batangas<br>Pusil, Lipa Batangas<br>Tiquiwan Rosario Batangas</p>
        </div>
        <div class="contact-item">
            <h2 class="contact-title">Email</h2>
            <p class="contact-detail">
                <a class="contact-link" href="mailto:liberakylegian@example.com">liberakylegian@example.com</a><br>
                <a class="contact-link" href="mailto:gawaranlouiseanne@example.com">gawaranlouiseanne@example.com</a><br>
                <a class="contact-link" href="mailto:arligueyancy@example.com">arligueyancy@example.com</a>
            </p>
        </div>
        <div class="contact-item">
            <h2 class="contact-title">Phone</h2>
            <p class="contact-detail">
                <a class="contact-link" href="tel:+63">+63 304433556</a><br>
                <a class="contact-link" href="tel:+63">+63 334544565</a><br>
                <a class="contact-link" href="tel:+63">+63 216986766</a>
            </p>
        </div>
    </section>
</body>
</html>
