<?php
// Sample array of events with additional details including time
$events = [
    [
        'date' => '2024-11-15',
        'time' => '9 AM - 12 PM',
        'title' => 'Tree Planting Day',
        'description' => 'Join us for a community tree planting event at Green Park.',
        'details' => 'Location: Green Park<br>Bring gloves and water.',
    ],
    [
        'date' => '2024-11-22',
        'time' => '10 AM - 2 PM',
        'title' => 'Beach Clean-Up',
        'description' => 'Help us clean up the beach and protect marine biodiversity.',
        'details' => 'Location: Sunny Beach<br>Supplies provided.',
    ],
    // More events... saka na natin dagdagan
];

// Get current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Create an array of event dates for easy checking
$eventDates = array_map(function($event) {
    return date('j', strtotime($event['date']));
}, $events);

// Navigation functions
function getPreviousMonth($month, $year) {
    return $month == 1 ? [12, $year - 1] : [$month - 1, $year];
}

function getNextMonth($month, $year) {
    return $month == 12 ? [1, $year + 1] : [$month + 1, $year];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodiversity Events Calendar</title>
</head>
<body>
    <header>
        <h1>Biodiversity Events Calendar</h1>
    </header>
    <main>
        <div>
            <h2 style="text-align: center;">Calendar</h2>
            <div class="calendar-controls" style="text-align: center; margin: 20px;">
                <a href="?month=<?php echo getPreviousMonth($month, $year)[0]; ?>&year=<?php echo getPreviousMonth($month, $year)[1]; ?>">&#9664; Previous</a>
                <span><?php echo date('F Y', strtotime("$year-$month-01")); ?></span>
                <a href="?month=<?php echo getNextMonth($month, $year)[0]; ?>&year=<?php echo getNextMonth($month, $year)[1]; ?>">Next &#9654;</a>
            </div>
            <table border="1" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $firstDay = strtotime("first day of this month", strtotime("$year-$month-01"));
                    $totalDays = date('t', $firstDay);
                    $startingDay = date('w', $firstDay);
                    $day = 1;

                    for ($row = 0; $row < 6; $row++):
                        echo '<tr>';
                        for ($col = 0; $col < 7; $col++):
                            if ($row === 0 && $col < $startingDay) {
                                echo '<td></td>'; // Empty cell before first day
                            } elseif ($day > $totalDays) {
                                echo '<td></td>'; // Empty cell after last day
                            } else {
                                $class = in_array($day, $eventDates) ? 'event-day' : '';
                                echo "<td class='$class' onclick='alert(\"Event on $year-$month-$day\")'>$day</td>";
                                $day++;
                            }
                        endfor;
                        echo '</tr>';
                    endfor;
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="event-table">
            <h2 style="text-align: center;">Upcoming Events</h2>
            <?php foreach ($events as $event): ?>
                <div class="event-card" style="border: 1px solid #ccc; margin: 10px; padding: 15px;">
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                    <p><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></p>
                    <p><?php echo htmlspecialchars($event['description']); ?></p>
                    <div id="countdown-<?php echo date('Ymd', strtotime($event['date'])); ?>"></div>
                    <script>
                        const eventDate = new Date("<?php echo $event['date']; ?>").getTime();
                        const countdownElement = document.getElementById("countdown-<?php echo date('Ymd', strtotime($event['date'])); ?>");
                        setInterval(function() {
                            const now = new Date().getTime();
                            const distance = eventDate - now;
                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                        }, 1000);
                    </script>
                    <button onclick="openModal('<?php echo htmlspecialchars($event['details']); ?>')">More Details</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal for Event Details -->
    <div id="eventModal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
        <div style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%;">
            <span onclick="closeModal()" style="float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            <h2>Event Details</h2>
            <p id="modalDetails"></p>
        </div>
    </div>

    <script>
        function openModal(details) {
            document.getElementById('modalDetails').innerHTML = details;
            document.getElementById('eventModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('eventModal').style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById('eventModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
