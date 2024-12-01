<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>
    <link rel="stylesheet" href="Style/main.css"> 
</head>
<body>

    <header>
        <h1>Welcome to the Sustainable Practices Dashboard</h1>
    </header>

    <main>
        <div class="main-container">
            
            <button onclick="slideOutAndRedirect('spguide.php')">Sustainable Practices Guide</button>
            <button onclick="slideOutAndRedirect('eventcalendar.php')">Event Calendar</button>
            <button onclick="slideOutAndRedirect('landsection.php')">Land Section</button>
            <button onclick="slideOutAndRedirect('watersection.php')">Water Section</button>
            <button onclick="slideOutAndRedirect('airsection.php')">Air Section</button>
            <button onclick="slideOutAndRedirect('lifesection.php')">Living Section</button>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 The Guardians. All rights reserved.</p>
    </footer>

    <script>
    <?php
    class SlideOutRedirect {
        private $targetUrl;
        private $animationClass;
        private $delay;

        public function __construct($animationClass = 'slide-out', $delay = 1000) {
            $this->animationClass = $animationClass;
            $this->delay = $delay;
        }
        public function renderScript() {
            echo "
            function slideOutAndRedirect(targetUrl) {
                document.body.classList.add('$this->animationClass');
                setTimeout(function() {
                    window.location.href = targetUrl;
                }, $this->delay); 
            }
            ";
        }
    }
    $slideOutInstance = new SlideOutRedirect('slide-out', 1000);
    $slideOutInstance->renderScript();
    ?>

    </script>
</body>
</html>