<?php

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
    <title>Biodiversity Events Calendar</title>
    <link rel="stylesheet" href="Style/calendar.css">
</head>
<body>

<header><h1>Biodiversity Events Calendar</h1></header>

<div class="home-button">
    <a href="main.php">
        <button>Home</button>
    </a>
</div>

<div class="calendar-nav">
    <?php 
        $prevMonth = adjustMonth($month, $year, 'prev');
        $nextMonth = adjustMonth($month, $year, 'next');
    ?>
    <a href="?view=calendar&month=<?php echo $prevMonth[0]; ?>&year=<?php echo $prevMonth[1]; ?>">&#9664; Previous</a>
    <span><?php echo date('F Y', strtotime("$year-$month-01")); ?></span>
    <a href="?view=calendar&month=<?php echo $nextMonth[0]; ?>&year=<?php echo $nextMonth[1]; ?>">Next &#9654;</a>
</div>

<div>
    <a href="?view=calendar&month=<?php echo $month; ?>&year=<?php echo $year; ?>" class="tab <?php echo $view === 'calendar' ? 'active' : ''; ?>">Calendar</a>
    <a href="?view=list" class="tab <?php echo $view === 'list' ? 'active' : ''; ?>">All Events</a>
</div>

<?php if ($view === 'calendar') { ?>
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
                    echo "<td class='" . (in_array($day, $eventDays) ? 'event-day' : '') . "'><a href='?view=calendar&month=$month&year=$year&day=$day'>$day</a></td>";
                    if (++$day > $totalDays) break;
                }
            }
            echo '</tr>';
            if ($day > $totalDays) break;
        }
        ?>
        </tbody>
    </table>

<?php } elseif ($view === 'list') { ?>
    <h2>All Events</h2>
    <?php if (count($events) > 0) { ?>
        <ul>
        <?php foreach ($events as $event) { ?>
            <li>
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?> <br>
                   <strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
            </li>
        <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No events available.</p>
    <?php } ?>

<?php } ?>

<?php if ($eventForDay) { ?>
    <div class="event-details">
        <h2>Event on <?php echo $eventForDay['date']; ?></h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($eventForDay['title']); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($eventForDay['time']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($eventForDay['description']); ?></p>
    </div>
<?php } elseif ($dayClicked) { ?>
    <p>No event scheduled for this day.</p>
<?php } ?>

</body>
</html>

