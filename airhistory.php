<?php
// Start the session to manage user authentication
session_start();

// Include the database connection file
require 'dbconnection.php';

// Retrieve the account ID from the session, if set
$account_id = $_SESSION['account_id'] ?? null;

// If the user is not logged in, stop further execution and show an error
if (!$account_id) {
    die("Error: User is not logged in.");
}

// Initialize the Database object and establish a connection
$db = new Database();
$conn = $db->getConnect();

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "clear_all" button is clicked
    if (isset($_POST['clear_all'])) {
        try {
            // Prepare and execute a query to delete all history records for the current user
            $deleteQuery = "DELETE FROM history WHERE account_id = :account_id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->execute([':account_id' => $account_id]);
        } catch (PDOException $e) {
            // Display any error that occurs during the deletion process
            echo "Error: " . $e->getMessage();
        }
    // Check if the "delete_selected" button is clicked and there are selected IDs
    } elseif (isset($_POST['delete_selected']) && !empty($_POST['selected_ids'])) {
        try {
            // Sanitize the selected IDs by converting them into a comma-separated list of integers
            $selectedIds = implode(',', array_map('intval', $_POST['selected_ids']));
            // Prepare and execute a query to delete selected history records for the current user
            $deleteQuery = "DELETE FROM history WHERE id IN ($selectedIds) AND account_id = :account_id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->execute([':account_id' => $account_id]);
        } catch (PDOException $e) {
            // Display any error that occurs during the deletion process
            echo "Error: " . $e->getMessage();
        }
    }
}

try {
    // Prepare and execute a query to fetch all history records for the current user
    $query = "SELECT * FROM history WHERE account_id = :account_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':account_id' => $account_id]);
    // Fetch the history data as an associative array
    $history_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Display any error that occurs during the data retrieval process
    echo "Error: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/airhistories.css">
    <title>Planting History</title>
</head>
<body>

<main>
    <div class="section-container">
        <button class="btn-home" onclick="window.location.href='useracc.php'">Home</button>
        <button class="btn-air-section" onclick="window.location.href='airsection.php'">Air Section</button>
        <button class="btn-view-table" onclick="window.location.href='aircity.php'">View Tree Table</button>
        <button class="btn-view-table" onclick="window.location.href='airtrack.php'">View Tracking Table</button>
    </div>
</main>

<div class="actions">
        <button type="submit" name="clear_all">Clear All History</button>
        <button type="submit" name="delete_selected">Delete Selected</button>
    </div>

<h1>Planting History</h1>
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>Select</th>
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
                        <td><input type="checkbox" name="selected_ids[]" value="<?php echo htmlspecialchars($row['id']); ?>"></td>
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
                    <td colspan="11">No planting history available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

</body>
</html>
