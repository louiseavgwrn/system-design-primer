<?php
// Start the session to access session variables
session_start();

// Include database connection file
require_once 'dbconnection.php';

// Retrieve the logged-in user's account ID from the session
$account_id = $_SESSION['account_id'] ?? null;

// If no account ID is found, terminate the script and show an error message
if (!$account_id) {
    die("Error: User is not logged in.");
}

// Create a new instance of the Database class and get the database connection
$db = new Database();
$conn = $db->getConnect();

// Get the current date in Y-m-d format
$currentDate = date('Y-m-d');

// Start the try block to catch any potential database exceptions
try {
    // Define the SQL query to fetch planting history for the user
    // It retrieves the planting date, total trees planted, and days since planting
    $dateQuery = "SELECT DATE(plant_date) AS plant_date, 
                  SUM(quantity) AS trees_planted, 
                  DATEDIFF(:current_date, DATE(plant_date)) AS days_since 
                  FROM history 
                  WHERE account_id = :account_id 
                  GROUP BY DATE(plant_date) 
                  ORDER BY plant_date";
    
    // Prepare the SQL query
    $dateStmt = $conn->prepare($dateQuery);
    
    // Bind the current date and account ID parameters to the SQL query
    $dateStmt->bindParam(':current_date', $currentDate, PDO::PARAM_STR);
    $dateStmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    
    // Execute the query
    $dateStmt->execute();

    // Fetch the query results as an associative array
    $dateData = $dateStmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if no data was returned (empty result)
    if (empty($dateData)) {
        // Inform the user that no planting data was found
        echo "No planting data found.";
    } else {
        // Loop through the result and display each record
        foreach ($dateData as $row) {
            echo "Date: " . $row['plant_date'] . "<br>"; // Display the planting date
            echo "Trees Planted: " . $row['trees_planted'] . "<br>"; // Display the number of trees planted on that day
            echo "Days Since Planting: " . $row['days_since'] . "<br><br>"; // Display the number of days since planting
        }
    }
} catch (PDOException $e) {
    // Catch any exceptions and display the error message
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Planting Tracking</title>
    <link rel="stylesheet" href="Style/airtracks.css">
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

    <section class="tracking-section">
        <h2>Planted Trees by Date (with Days Since Planting)</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Trees Planted</th>
                <th>Days Since Planted</th>
            </tr>
            <?php if (!empty($dateData)): ?>
                <?php foreach ($dateData as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['plant_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['trees_planted']); ?></td>
                    <td><?php echo htmlspecialchars($row['days_since']); ?> days</td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No data available for tracking.</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</div>

</body>
</html>
