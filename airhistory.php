<?php
session_start(); // Start the session to access session variables

require 'dbconnection.php'; // Include the database connection file
require 'userhistory.php'; // Include the UserHistory class file

// Retrieve the account ID from the session
$account_id = $_SESSION['account_id'] ?? null;

// Check if the user is logged in
if (!$account_id) {
    die("Error: User is not logged in."); // Terminate script if no account ID is found
}

// Initialize the database connection
$db = new Database();
$conn = $db->getConnect();

// Instantiate the UserHistory class with the database connection and account ID
$userHistory = new UserHistory($conn, $account_id);

// Check if the request method is POST to handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the clear all history button was clicked
    if (isset($_POST['clear_all'])) {
        $userHistory->clearAllHistory(); // Clear all history for the user
    } 
    // Check if the delete selected button was clicked and selected IDs are provided
    elseif (isset($_POST['delete_selected']) && !empty($_POST['selected_ids'])) {
        $selectedIds = array_map('intval', $_POST['selected_ids']); // Sanitize selected IDs
        $userHistory->deleteSelectedHistory($selectedIds); // Delete the selected history records
    }
}

// Fetch the user's history data
$history_data = $userHistory->fetchHistory();
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

<h1>Planting History</h1>
<form method="POST">
    <div class="actions">
        <button type="submit" name="clear_all">Clear All History</button>
        <button type="submit" name="delete_selected">Delete Selected</button>
    </div>

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
