<?php
require 'database.php';

$db = new Database();
$conn = $db->getConnect();

$query = "SELECT * FROM history ORDER BY date_added DESC";
$stmt = $conn->query($query);

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Tree Name</th>
            <th>Quantity</th>
            <th>CO2 Absorption</th>
            <th>Growth Rate</th>
            <th>Climate</th>
            <th>Average Size</th>
            <th>Pollutant Absorption</th>
            <th>Oxygen Production</th>
            <th>Date Added</th>
        </tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['tree_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['co2_absorption']}</td>
            <td>{$row['growth_rate']}</td>
            <td>{$row['climate']}</td>
            <td>{$row['average_size']}</td>
            <td>{$row['pollutant_absorption']}</td>
            <td>{$row['oxygen_production']}</td>
            <td>{$row['date_added']}</td>
          </tr>";
}
echo "</table>";
?>
