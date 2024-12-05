<?php
// Include the database connection
require_once 'dbair.php';

$db = new Database();
$conn = $db->getConnect();

// Get the current date
$currentDate = date('Y-m-d');

// Query to get the total quantity of trees planted by date and calculate days since planting
$dateQuery = "SELECT DATE(plant_date) AS plant_date, 
              SUM(quantity) AS trees_planted, 
              DATEDIFF(:current_date, DATE(plant_date)) AS days_since 
              FROM history 
              GROUP BY DATE(plant_date) 
              ORDER BY plant_date";
$dateStmt = $conn->prepare($dateQuery);
$dateStmt->bindParam(':current_date', $currentDate, PDO::PARAM_STR);
$dateStmt->execute();
$dateData = $dateStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Planting Tracking</title>
    <link rel="stylesheet" href="Style/airtrack.css"> <!-- External CSS -->
</head>
<body>

<main>
    <div class="section-container">
        <button class="btn-home" onclick="window.location.href='useracc.php'">Home</button>
        <button class="btn-air-section" onclick="window.location.href='airsection.php'">Air Section</button>
        <button class="btn-view-table" onclick="window.location.href='aircity.php'">View Tree Table</button>
        <button class="btn-track-trees" onclick="window.location.href='airhistory.php'">View Planting History</button>
    </div>
</main>


<div class="container">
    <h1>Tree Planting Tracking</h1>

    <!-- Date Tracking with Days Since -->
    <section class="tracking-section">
        <h2>Planted Trees by Date (with Days Since Planting)</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Trees Planted</th>
                <th>Days Since Planted</th>
            </tr>
            <?php foreach ($dateData as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['plant_date']); ?></td>
                <td><?php echo htmlspecialchars($row['trees_planted']); ?></td>
                <td><?php echo htmlspecialchars($row['days_since']); ?> days</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</div>

</body>
</html>
