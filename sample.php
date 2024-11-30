<?php
$currentYear = date("Y");

$tabs = [
    "home" => [
        "title" => "Home", 
        "content" => "Welcome to the home page!"
    ],
    "about" => [
        "title" => "About Biodiversity", 
        "content" => "Learn more about our biodiversity."
    ],
    "events_calendar" => [
        "title" => "Events Calendar", 
        "content" => ""
    ],
    "services" => [
        "title" => "My Actions", 
        "content" => "Looking out for distributions."
   
    ],
    "contact" => [
        "title" => "Contact Us", 
        "content" => "Feel free to reach out via our contact page."
    ]
];

$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'home';

$events = [
    [
        'date' => '2024-11-15',
        'time' => '9 AM - 12 PM',
        'title' => 'Tree Planting Day',
        'description' => 'Join us for a hands-on community tree planting event at Green Park. We’ll be planting native trees to help improve local air quality, provide habitat for wildlife, and enhance the park’s beauty. No prior gardening experience is necessary—just bring your enthusiasm and willingness to contribute to a greener future. All tools, gloves, and refreshments will be provided, but feel free to bring your own. Let’s make our community greener together!'
    ],
    [
        'date' => '2024-11-22',
        'time' => '10 AM - 2 PM',
        'title' => 'Beach Clean-Up',
        'description' => 'Help protect our beautiful coastline by joining us for a beach clean-up event at Oceanview Beach. We’ll be collecting litter, plastic waste, and other debris to prevent pollution from reaching our oceans and harming marine life. Volunteers of all ages are welcome! Bags and gloves will be provided, but feel free to bring your own reusable containers or gloves. Afterward, enjoy a free beachside picnic to celebrate our efforts in preserving marine biodiversity.'
    ],
    [
        'date' => '2024-12-05',
        'time' => '6 PM - 9 PM',
        'title' => 'Holiday Fundraiser Gala',
        'description' => 'Celebrate the holiday season while supporting local charities at our annual Holiday Fundraiser Gala. Enjoy an elegant evening of gourmet dining, live entertainment, and silent auctions featuring exclusive items and experiences. Proceeds from the event will go to support community projects, including food banks, shelters, and youth programs. This is a great opportunity to give back and make a positive impact in our community while celebrating the spirit of the season with friends and colleagues.'
    ],
    [
        'date' => '2024-12-10',
        'time' => '2 PM - 5 PM',
        'title' => 'Winter Clothing Drive',
        'description' => 'As the cold weather sets in, we are collecting gently used winter coats, hats, scarves, gloves, and other cold-weather clothing to distribute to individuals and families in need. Join us at the Winter Clothing Drive at the Community Center, where we will sort and organize donations. Your contributions will help those in our community who struggle to stay warm during the winter months. Donations can be dropped off throughout the event, and volunteers are welcome to help with collection and sorting. Together, we can make sure no one is left out in the cold this winter.'
    ],
    [
        'date' => '2024-12-20',
        'time' => '11 AM - 3 PM',
        'title' => 'Christmas Market',
        'description' => 'Get into the holiday spirit at our community Christmas Market, where you’ll find unique gifts from local artisans, handmade crafts, festive foods, and holiday decorations. In addition to shopping, enjoy live entertainment, a visit from Santa Claus, and a hot cocoa bar. This family-friendly event offers something for everyone, from holiday-themed games and activities for children to a cozy atmosphere perfect for getting into the holiday mood. Support small businesses and local makers while enjoying a fun and festive day with your loved ones.'
    ],
    [
        'date' => '2025-01-10',
        'time' => '9 AM - 4 PM',
        'title' => 'New Year Health Workshop',
        'description' => 'Kickstart the new year with our comprehensive health and wellness workshop designed to help you achieve your personal health goals. The day will feature expert speakers covering topics such as nutrition, fitness, mental wellness, and stress management. Join interactive sessions on meal planning, exercise routines, and mindfulness practices. Whether you’re looking to adopt healthier eating habits, improve your fitness, or learn how to manage stress, this workshop provides practical tips and resources to get you on the right track for a healthier, happier year ahead.'
    ]
];
$month = (int)($_GET['month'] ?? date('n'));
$year = (int)($_GET['year'] ?? date('Y'));
$dayClicked = (int)($_GET['day'] ?? null);
$view = $_GET['view'] ?? 'calendar';
$eventDays = [];
$filteredEvents = [];

foreach ($events as $event) {
    $eventDate = strtotime($event['date']);
    $eventMonth = (int)date('n', $eventDate);
    $eventYear = (int)date('Y', $eventDate);

    if ($eventMonth === $month && $eventYear === $year) {
        $eventDays[] = (int)date('j', $eventDate);
        $filteredEvents[] = $event;
    }
}

function adjustMonth($month, $year, $direction) {
    if ($direction == 'prev') {
        return [$month == 1 ? 12 : $month - 1, $month == 1 ? $year - 1 : $year];
    } else {
        return [$month == 12 ? 1 : $month + 1, $month == 12 ? $year + 1 : $year];
    }
}

$eventForDay = null;
if ($dayClicked) {
    foreach ($filteredEvents as $event) {
        $eventDay = (int)date('j', strtotime($event['date']));
        if ($eventDay === $dayClicked) {
            $eventForDay = $event;
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promote Sustainable Practices & Biodiversity</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px; text-align: center; cursor: pointer; }
        .event-day { background-color: #f0f0f0; }
        .calendar-nav { text-align: center; margin: 20px; }
        .event-details { margin-top: 20px; }
        .event-details h2 { color: #2d6a4f; }
        .event-details p { color: #555; }
        .tab { padding: 10px; cursor: pointer; display: inline-block; margin: 5px; }
        .active { background-color: #2d6a4f; color: white; }
    </style>
</head>
<body>

<h1>Welcome Green Guardians</h1>


<div class="tabs">
    <?php foreach ($tabs as $key => $data): ?>
        <a href="?tab=<?php echo $key; ?>" class="tab <?php echo $key === $activeTab ? 'active' : ''; ?>">
            <?php echo $data['title']; ?>
        </a>
    <?php endforeach; ?>
</div>


<div class="tab-content">
    <?php if ($activeTab === 'home') { ?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Promoting Sustainable Practices and Biodiversity Conservation">
    <title>Promote Sustainable Practices & Biodiversity</title>
</head>
<body>

<header>
    <h1>Promote Sustainable Practices & Biodiversity</h1>
</header>

<main>
    <div class="image-container">
        <img src="trees.jpg">
    </div>
    <div class="text-container">
        <h1>Green Guardians</h1>
        <p class="intro-paragraph">
                Imagine walking through a vibrant forest where the trees stretch high, their leaves shimmering in the breeze, while birds flit from branch to branch and the air smells fresh with the scent of pine. 
            Now, imagine this same forest, but this time the leaves are brown and withered, the birds are silent, and the ground beneath your feet feels dry and cracked. The animals that once thrived here have either fled or disappeared. 
            This stark transformation isn't a distant future—it's a potential reality we're already beginning to witness.
            Climate change is causing shifts in temperature, weather patterns, and seasons, pushing ecosystems out of balance. 
            Coastal wetlands are drowning under rising seas, coral reefs are bleaching and dying, and forests are succumbing to wildfires and pests. 
            These disruptions are not just threats to wildlife; they also have ripple effects that can impact human communities—through loss of biodiversity, changes in agriculture, and increased natural disasters.
        </p>

        <p class="spaced-paragraph">
                Understanding these changes can help us grasp the urgency of our role in conservation. 
            Every action we take to preserve natural habitats, reduce carbon emissions, and support sustainable practices is a step toward preventing the most catastrophic outcomes for the delicate web of life that sustains us all. 
            The choices we make today will determine what our ecosystems—and the future of life on Earth—look like tomorrow. The time to act is now.
        </p>
    </div>
</main>

    <h2>Why Sustainability and Biodiversity Matter</h2>
    <p> Our planet is home to a rich and intricate web of life, where every organism—whether plant, animal, or microorganism—plays a vital role in the stability and health of ecosystems. Biodiversity, which refers to the variety of life on Earth, encompasses much more than just the millions of different species we share the planet with. It includes the genetic variations within species, the different types of ecosystems (marine and terrestrial), and the interdependent relationships between all forms of life.
    From the diversity of crop varieties that provide our food, to the unique ecosystems such as forests, wetlands, coastal areas, and deserts that support life, biodiversity is essential for the stability of the natural world. These ecosystems are the foundation of the resources we rely on every day, such as clean water, air, and fertile land.</p>
    <p> Unfortunately, human activities are threatening this delicate balance. Deforestation, pollution, climate change, and overexploitation of natural resources are rapidly depleting biodiversity, putting entire ecosystems at risk. The loss of biodiversity doesn't just mean the extinction of species; it disrupts the very systems that sustain life on Earth. As species disappear, so do the genetic resources we depend on for agriculture, medicine, and environmental resilience.</p>
    <p> Embracing sustainability means recognizing that our actions today must not compromise the ability of future generations to meet their needs. By protecting biodiversity, we safeguard the stability of ecosystems that provide us with food, clean water, and air, as well as the ecological services that maintain our climate and natural balance. To ensure a sustainable future, we must strive to live in harmony with nature, preserving both the species and ecosystems that are essential for our survival and well-being.</p>
</section>

    <h2>Sustainable Practices You Can Adopt</h2>
    <ul>
        <li><strong>Reduce, Reuse, Recycle:</strong> Minimize waste by reusing items and recycling materials.</li>
        <li><strong>Support Sustainable Agriculture:</strong> Buy locally-grown, organic, and fair-trade products.</li>
        <li><strong>Save Water:</strong> Use water-efficient appliances and fix leaks to conserve this vital resource.</li>
        <li><strong>Use Renewable Energy:</strong> Opt for solar, wind, or other renewable sources of energy for your home or business.</li>
        <li><strong>Plant Trees and Green Spaces:</strong> Trees help to absorb CO2, provide habitats, and improve air quality.</li>
    </ul>
</section>

    <h2>The Benefits of Biodiversity</h2>
    <p>Biodiversity provides countless benefits to humans and the environment:</p>
    <ul>
        <li><strong>Healthy Ecosystems:</strong> Diverse ecosystems are more resilient to climate change, disease, and other disturbances.</li>
        <li><strong>Food Security:</strong> A variety of plants and animals supports a stable food supply.</li>
        <li><strong>Medicinal Resources:</strong> Many medicines are derived from natural sources found in biodiverse ecosystems.</li>
        <li><strong>Climate Regulation:</strong> Biodiversity helps regulate the climate by absorbing carbon dioxide and producing oxygen.</li>
    </ul>
</section>

    <h2>How You Can Help</h2>
    <p>Join the movement to protect biodiversity and promote sustainability. Here are a few simple ways to get started:</p>
    <ul>
        <li><strong>Educate Yourself:</strong> Stay informed about environmental issues and learn how your actions can make a difference.</li>
        <li><strong>Advocate for Policy Change:</strong> Support legislation that promotes sustainable practices and protects biodiversity.</li>
        <li><strong>Volunteer:</strong> Get involved with local environmental groups and conservation projects.</li>
        <li><strong>Share Knowledge:</strong> Spread the word about the importance of sustainability and biodiversity conservation.</li>
    </ul>
</section> 
    
    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>

<footer>
    <p>Stay updated with the latest news and tips on sustainability and biodiversity conservation!</p>
    <p>&copy; <?php echo $currentYear; ?> Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
</footer>

</body>
</html>

    <?php } elseif ($activeTab === 'events_calendar') { ?>

        <h2>Events Calendar</h2>
        <div class="calendar-nav">
            <?php 
                $prevMonth = adjustMonth($month, $year, 'prev');
                $nextMonth = adjustMonth($month, $year, 'next');
            ?>
            <a href="?tab=events_calendar&month=<?php echo $prevMonth[0]; ?>&year=<?php echo $prevMonth[1]; ?>">&#9664; Previous</a>
            <span><?php echo date('F Y', strtotime("$year-$month-01")); ?></span>
            <a href="?tab=events_calendar&month=<?php echo $nextMonth[0]; ?>&year=<?php echo $nextMonth[1]; ?>">Next &#9654;</a>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $firstDay = strtotime("$year-$month-01");
            $totalDays = date('t', $firstDay);
            $startingDay = date('w', $firstDay);
            $day = 1;

            for ($i = 0; $i < 6; $i++) {
                echo '<tr>';
                for ($j = 0; $j < 7; $j++) {
                    if ($i === 0 && $j < $startingDay || $day > $totalDays) {
                        echo '<td></td>';
                    } else {
                        echo "<td class='" . (in_array($day, $eventDays) ? 'event-day' : '') . "'><a href='?tab=events_calendar&month=$month&year=$year&day=$day'>$day</a></td>";
                        if (++$day > $totalDays) break;
                    }
                }
                echo '</tr>';
                if ($day > $totalDays) break;
            }
            ?>
            </tbody>
        </table>

        <?php if ($eventForDay) { ?>
            <div class="event-details">
                <h2>Event on <?php echo $eventForDay['date']; ?></h2>
                <p><strong>Title:</strong> <?php echo htmlspecialchars($eventForDay['title']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($eventForDay['time']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($eventForDay['description']); ?></p>
            </div>
        <?php } ?>

    <?php } else { ?>

        <h2><?php echo $tabs[$activeTab]['title']; ?></h2>
        <p><?php echo $tabs[$activeTab]['content']; ?></p>

    <?php } ?>
</div>

</body>
</html>
