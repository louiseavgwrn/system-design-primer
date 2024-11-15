<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Data</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <h2>Create Plant</h2>
    <form method="POST" action="plantdata.php">
        Name: <input type="text" name="name" required><br><br>
        Scientific Name: <input type="text" name="scientific_name" required><br><br>
        Region: <input type="text" name="region" required><br><br>
        Type: <input type="text" name="type" required><br><br>
        Latitude: <input type="number" name="latitude" required><br><br>
        Longitude: <input type="number" name="longitude" required><br><br>
        Description: <textarea name="description" required></textarea><br><br>
        <input type="submit" value="Create Plant">
    </form>

    <h2>Plants List</h2>
    <table id="plantTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Scientific Name</th>
                <th>Region</th>
                <th>Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
        require_once 'dbConnect.php';
        require_once 'plantcrud.php';

        $database = new Database();
        $db = $database->getConnect();

        $plant = new Plant($db);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $plant->name = $_POST['name'];
            $plant->scientific_name = $_POST['scientific_name'];
            $plant->region = $_POST['region'];
            $plant->type = $_POST['type'];
            $plant->latitude = $_POST['latitude'];
            $plant->longitude = $_POST['longitude'];
            $plant->description = $_POST['description'];

            if ($plant->create()) {
                echo "Plant created successfully!";
            } else {
                echo "Error creating plant.";
            }
        }

        if (isset($_GET['delete_id'])) {
            $plant->id = $_GET['delete_id'];
            if ($plant->delete()) {
                echo "Plant deleted successfully!";
            } else {
                echo "Error deleting plant.";
            }
        }
        ?>
            

            <?php
            $stmt = $plant->read();
            $num = $stmt->rowCount();

            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['scientific_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['region']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['latitude']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['longitude']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td><a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete?\");'>Delete</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#plantTable').DataTable();
        });
    </script>

</body>
</html>
