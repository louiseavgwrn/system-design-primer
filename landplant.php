<?php
// Start the session to access session variables (like user login status)
session_start();
require_once 'dbconnection.php'; // Includes the database connection script
require_once 'plantcrud.php'; // Includes the plant CRUD operations script

// Get the logged-in user's account_id from the session, if available
$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : null;

// If no account_id is found, redirect to login page
if (empty($account_id)) {
    header('Location: login.php'); 
    exit;
}

// Create a database connection
$database = new Database();
$db = $database->getConnect();

// Instantiate the Plant object to interact with the plant data in the database
$plant = new Plant($db);
$plant->account_id = $account_id; // Set the current user's account ID to filter their plants

// Call the read method to get plants associated with the current account
$stmt = $plant->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Data</title>
    <link rel="Stylesheet" href="Style/landplant.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="section-container">
        <button onclick="window.location.href='useracc.php'">Home</button>
        <button onclick="window.location.href='watersection.php'">Water Section</button>
        <button onclick="window.location.href='airsection.php'">Air Section</button>
        <button onclick="window.location.href='lifesection.php'">Living Section</button>
    </div>

    <section>
        <button class="toggle-button" onclick="toggleForm()">Create My Owned Plant</button>
        <div id="createPlantForm" style="display:none;">
            <h2>Create a New Plant</h2>
            <form method="POST" action="plantcreate.php">
                <label for="name">Plant Name:</label>
                <input type="text" name="name" required>

                <label for="scientific_name">Scientific Name:</label>
                <input type="text" name="scientific_name" required>

                <label for="region">Region:</label>
                <input type="text" name="region" required>

                <label for="type">Type:</label>
                <input type="text" name="type" required>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea>

                <input type="submit" value="Create Plant">
            </form>
        </div>
    </section>

    <section>
        <h2>My Owned Plants List</h2>
        <table id="plantTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Scientific Name</th>
                    <th>Region</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($stmt && $stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['scientific_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['region']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td class='actions'>
                                <form method='POST' action='plantdelete.php' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                    <input type='submit' value='Delete'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No plants found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script>
        $(document).ready(function() {
            $('#plantTable').DataTable();
        });

        function toggleForm() {
            const form = document.getElementById('createPlantForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>
