<?php
// Event data
$events = [
    ['date' => '2024-11-15', 'time' => '9 AM - 12 PM', 'title' => 'Tree Planting Day', 'description' => 'Join us for a community tree planting event at Green Park.'],
    ['date' => '2024-11-22', 'time' => '10 AM - 2 PM', 'title' => 'Beach Clean-Up', 'description' => 'Help us clean up the beach and protect marine biodiversity.'],
];

// Get current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Extract event days
$eventDays = array_map(function($event) {
    return date('j', strtotime($event['date']));
}, $events);

// Calculate previous and next month
function adjustMonth($month, $year, $direction) {
    if ($direction == 'prev') {
        return [$month == 1 ? 12 : $month - 1, $month == 1 ? $year - 1 : $year];
    } else {
        return [$month == 12 ? 1 : $month + 1, $month == 12 ? $year + 1 : $year];
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
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1; }
        .modal-content { background-color: white; margin: 20% auto; padding: 20px; width: 40%; }
    </style>
</head>
<body>

    <header><h1>Biodiversity Events Calendar</h1></header>

    <!-- Calendar Navigation -->
    <div class="calendar-nav">
        <a href="?month=<?php echo adjustMonth($month, $year, 'prev')[0]; ?>&year=<?php echo adjustMonth($month, $year, 'prev')[1]; ?>">&#9664; Previous</a>
        <span><?php echo date('F Y', strtotime("$year-$month-01")); ?></span>
        <a href="?month=<?php echo adjustMonth($month, $year, 'next')[0]; ?>&year=<?php echo adjustMonth($month, $year, 'next')[1]; ?>">Next &#9654;</a>
    </div>

    <!-- Calendar Table -->
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
                        echo "<td class='$class' onclick='showEvent($day)'>$day</td>";
                        $day++;
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Upcoming Events -->
    <section>
        <h2>Upcoming Events</h2>
        <?php foreach ($events as $event): ?>
            <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></p>
                <p><?php echo htmlspecialchars($event['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Modal for Event Details -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span onclick="closeModal()" style="cursor: pointer; font-size: 28px; font-weight: bold;">&times;</span>
            <h2>Event Details</h2>
            <p id="modalDetails"></p>
        </div>
    </div>

    <script>
        function showEvent(day) {
            alert("Event on " + day);
        }

        function closeModal() {
            document.getElementById('eventModal').style.display = "none";
        }
    </script>
</body>
</html>
