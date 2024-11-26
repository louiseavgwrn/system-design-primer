<?php
require 'airdbconnect.php'; 

$db = new Database();
$conn = $db->getConnect();

try {
    // Query to fetch all data from the history table
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
    <title>Planting History</title>
    <?php //Simple DESIGN to make it align?>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
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
