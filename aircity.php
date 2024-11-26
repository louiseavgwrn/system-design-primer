<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree CO₂ Absorption</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#plantInfoTable').DataTable();
        });
    </script>
</head>
<body>
    <h1>Tree Species CO₂ Absorption and Oxygen Production</h1>

    <table id="plantInfoTable" class="display">
        <thead>
            <tr>
                <th>Tree Species</th>
                <th>CO₂ Absorbed (kg/year)</th>
                <th>Oxygen Produced (kg/year)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Array and known trees only
            $trees = [
                ["Oak", 48.0, 24.0],
                ["Pine", 35.0, 17.5],
                ["Maple", 30.0, 15.0],
                ["Cedar", 25.0, 12.5],
                ["Birch", 28.0, 14.0],
                ["Willow", 22.0, 11.0],
                ["Spruce", 34.0, 17.0],
                ["Cherry", 20.0, 10.0],
                ["Apple", 18.0, 9.0],
                ["Ash", 40.0, 20.0],
                ["Elm", 38.0, 19.0],
                ["Douglas Fir", 42.0, 21.0],
                ["Redwood", 52.0, 26.0],
                ["Sequoia", 50.0, 25.0],
                ["Alder", 30.0, 15.0],
                ["Sycamore", 36.0, 18.0],
                ["Larch", 32.0, 16.0],
                ["Fir", 33.0, 16.5],
                ["Hickory", 45.0, 22.5],
                ["Poplar", 39.0, 19.5],
                ["Chestnut", 37.0, 18.5],
                ["Walnut", 41.0, 20.5],
                ["Cottonwood", 23.0, 11.5],
                ["Magnolia", 29.0, 14.5],
                ["Acacia", 24.0, 12.0],
                ["Balsa", 15.0, 7.5],
                ["Mahogany", 46.0, 23.0],
                ["Pecan", 44.0, 22.0],
                ["Cypress", 31.0, 15.5],
                ["Narra", 50.0, 25.0],
                ["Mango", 42.0, 21.0],
                ["Coconut", 18.0, 9.0],
                ["Tamarind", 28.0, 14.0],
                ["Banana", 10.0, 5.0],
                ["Lanzones", 15.0, 7.5],
                ["Langka (Jackfruit)", 22.0, 11.0],
                ["Rambutan", 18.0, 9.0],
                ["Durian", 35.0, 17.5]
            ];
            
            
            foreach ($trees as $tree) {
                echo "<tr>";
                echo "<td>{$tree[0]}</td>";
                echo "<td>{$tree[1]}</td>";
                echo "<td>{$tree[2]}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="form-container">
        <form action="airtrees.php" method="POST">
            <button type="submit">Let's Plant a Tree</button>
        </form>
    </div>
</body>
</html>
