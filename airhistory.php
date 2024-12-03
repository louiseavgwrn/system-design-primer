<?php
require 'airdbconnect.php'; 

$db = new Database();
$conn = $db->getConnect();

try {
    $query = "SELECT * FROM history";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $history_data = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Style/airhistory.css">
    <title>Planting History</title>

</head>
<body>

<main>
    <div class="section-container">
        <button class="btn-home" onclick="window.location.href='useracc.php'">Home</button>
        <button class="btn-air-section" onclick="window.location.href='airsection.php'">Air Section</button>
        <button class="btn-view-table" onclick="window.location.href='aircity.php'">View Tree Table</button>
    </div>
</main>


    <h1>Planting History</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tree Name</th>
                <th>Quantity</th>
                <th>CO₂ Absorption (kg/year)</th>
                <th>Growth Rate (m/year)</th>
                <th>Climate</th>
                <th>Average Size (m)</th>
                <th>Pollutant Absorption (kg/year)</th>
                <th>Oxygen Production (kg/year)</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($history_data)): ?>
                <?php foreach ($history_data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['tree_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['carbon_absorption']); ?></td>
                        <td><?php echo htmlspecialchars($row['growth_rate']); ?></td>
                        <td><?php echo htmlspecialchars($row['climate']); ?></td>
                        <td><?php echo htmlspecialchars($row['average_size']); ?></td>
                        <td><?php echo htmlspecialchars($row['pollutant_absorption']); ?></td>
                        <td><?php echo htmlspecialchars($row['oxygen_production']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No planting history available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
