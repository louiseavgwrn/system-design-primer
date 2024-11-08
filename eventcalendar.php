<?php
// Code still under development - Kyle
// Note: The style I use for design are internet base - Kyle 
// If you are viewing this feel free to consult me with your concern - Kyle


$events = [
    ['date' => '2024-11-15', 'time' => '9 AM - 12 PM', 'title' => 'Tree Planting Day', 'description' => 'Join us for a community tree planting event at Green Park.'],
    ['date' => '2024-11-22', 'time' => '10 AM - 2 PM', 'title' => 'Beach Clean-Up', 'description' => 'Help us clean up the beach and protect marine biodiversity.'],
];

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$dayClicked = isset($_GET['day']) ? (int)$_GET['day'] : null;

$eventDays = array_map(function($event) {
    return date('j', strtotime($event['date']));
}, $events);

function adjustMonth($month, $year, $direction) {
    if ($direction == 'prev') {
        return [$month == 1 ? 12 : $month - 1, $month == 1 ? $year - 1 : $year];
    } else {
        return [$month == 12 ? 1 : $month + 1, $month == 12 ? $year + 1 : $year];
    }
}

$eventForDay = null;
if ($dayClicked) {
    // Find the event for the clicked day
    foreach ($events as $event) {
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
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px; text-align: center; cursor: pointer; }
        .event-day { background-color: #f0f0f0; }
        .calendar-nav { text-align: center; margin: 20px; }
        .event-details { margin-top: 20px; }
        .event-details h2 { color: #2d6a4f; }
        .event-details p { color: #555; }
    </style>
</head>
<body>

<header><h1>Biodiversity Events Calendar</h1></header>

<div class="calendar-nav">
    <a href="?month=<?php echo adjustMonth($month, $year, 'prev')[0]; ?>&year=<?php echo adjustMonth($month, $year, 'prev')[1]; ?>">&#9664; Previous</a>
    <span><?php echo date('F Y', strtotime("$year-$month-01")); ?></span>
    <a href="?month=<?php echo adjustMonth($month, $year, 'next')[0]; ?>&year=<?php echo adjustMonth($month, $year, 'next')[1]; ?>">Next &#9654;</a>
</div>

<table border="1">
    <thead>
        <tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
    </thead>
    <tbody>
        <?php
        $firstDay = strtotime("$year-$month-01");
        $totalDays = date('t', $firstDay);
        $startingDay = date('w', $firstDay);
        $day = 1;

        for ($row = 0; $row < 6; $row++) {
            echo '<tr>';
            for ($col = 0; $col < 7; $col++) {
                if ($row === 0 && $col < $startingDay || $day > $totalDays) {
                    echo '<td></td>';
                } else {
                    $class = in_array($day, $eventDays) ? 'event-day' : '';
                    echo "<td class='$class'>
                            <a href='?month=$month&year=$year&day=$day'>$day</a>
                          </td>";
                    $day++;
                }
            }
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<?php 
if ($eventForDay): ?>
    <div class="event-details">
        <h2>Event on <?php echo $eventForDay['date']; ?></h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($eventForDay['title']); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($eventForDay['time']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($eventForDay['description']); 
        ?></p>
    </div>

<?php 
elseif 
($dayClicked): 
?>
 <p>No event scheduled for this day.</p>
<?php 
endif; 
?>

</body>
</html>
