<?php
$oxygen_conversion_factor = 1.3;
$tree_data = [
    "Oak" => [
        "co2_absorption" => 48.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 30.0, // this is in meters
        "pollutant_absorption" => 12.0  // Estimate in kg per year
    ],
    "Pine" => [
        "co2_absorption" => 35.0, 
        "growth_rate" => 0.4,
        "climate" => "Cold", 
        "average_size" => 25.0,
        "pollutant_absorption" => 8.0
    ],
    "Maple" => [
        "co2_absorption" => 30.0, 
        "growth_rate" => 0.3,
        "climate" => "Temperate", 
        "average_size" => 20.0,
        "pollutant_absorption" => 10.0
    ],
    "Cedar" => [
        "co2_absorption" => 25.0, 
        "growth_rate" => 0.6,
        "climate" => "Temperate", 
        "average_size" => 20.0,
        "pollutant_absorption" => 7.0
    ],
    "Birch" => [
        "co2_absorption" => 28.0, 
        "growth_rate" => 0.4,
        "climate" => "Cold", 
        "average_size" => 15.0,
        "pollutant_absorption" => 6.0
    ],
    "Willow" => [
        "co2_absorption" => 22.0, 
        "growth_rate" => 0.7,
        "climate" => "Temperate", 
        "average_size" => 12.0,
        "pollutant_absorption" => 5.0
    ],
    "Spruce" => [
        "co2_absorption" => 34.0, 
        "growth_rate" => 0.5,
        "climate" => "Cold", 
        "average_size" => 25.0,
        "pollutant_absorption" => 9.0
    ],
    "Cherry" => [
        "co2_absorption" => 20.0, 
        "growth_rate" => 0.4,
        "climate" => "Temperate", 
        "average_size" => 10.0,
        "pollutant_absorption" => 4.0
    ],
    "Apple" => [
        "co2_absorption" => 18.0, 
        "growth_rate" => 0.3,
        "climate" => "Temperate", 
        "average_size" => 8.0,
        "pollutant_absorption" => 3.0
    ],
    "Ash" => [
        "co2_absorption" => 40.0, 
        "growth_rate" => 0.6,
        "climate" => "Temperate", 
        "average_size" => 25.0,
        "pollutant_absorption" => 11.0
    ],
    "Elm" => [
        "co2_absorption" => 38.0, 
        "growth_rate" => 0.4,
        "climate" => "Temperate", 
        "average_size" => 20.0,
        "pollutant_absorption" => 10.0
    ],
    "Douglas Fir" => [
        "co2_absorption" => 42.0, 
        "growth_rate" => 0.5,
        "climate" => "Cold", 
        "average_size" => 30.0,
        "pollutant_absorption" => 8.0
    ],
    "Redwood" => [
        "co2_absorption" => 52.0, 
        "growth_rate" => 1.0,
        "climate" => "Temperate", 
        "average_size" => 100.0, 
        "pollutant_absorption" => 15.0
    ],
    "Sequoia" => [
        "co2_absorption" => 50.0, 
        "growth_rate" => 0.9,
        "climate" => "Temperate", 
        "average_size" => 90.0,
        "pollutant_absorption" => 14.0
    ],
    "Alder" => [
        "co2_absorption" => 30.0, 
        "growth_rate" => 0.4,
        "climate" => "Temperate", 
        "average_size" => 20.0,
        "pollutant_absorption" => 8.0
    ],
    "Sycamore" => [
        "co2_absorption" => 36.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 25.0,
        "pollutant_absorption" => 9.0
    ],
    "Larch" => [
        "co2_absorption" => 32.0, 
        "growth_rate" => 0.5,
        "climate" => "Cold", 
        "average_size" => 30.0,
        "pollutant_absorption" => 7.0
    ],
    "Fir" => [
        "co2_absorption" => 33.0, 
        "growth_rate" => 0.4,
        "climate" => "Cold", 
        "average_size" => 30.0,
        "pollutant_absorption" => 6.0
    ],
    "Hickory" => [
        "co2_absorption" => 45.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 30.0,
        "pollutant_absorption" => 12.0
    ],
    "Poplar" => [
        "co2_absorption" => 39.0, 
        "growth_rate" => 0.7,
        "climate" => "Temperate", 
        "average_size" => 20.0,
        "pollutant_absorption" => 10.0
    ],
    "Chestnut" => [
        "co2_absorption" => 37.0, 
        "growth_rate" => 0.6,
        "climate" => "Temperate", 
        "average_size" => 25.0,
        "pollutant_absorption" => 11.0
    ],
    "Walnut" => [
        "co2_absorption" => 41.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 25.0,
        "pollutant_absorption" => 13.0
    ],
    "Cottonwood" => [
        "co2_absorption" => 23.0, 
        "growth_rate" => 0.8,
        "climate" => "Temperate", 
        "average_size" => 15.0,
        "pollutant_absorption" => 6.0
    ],
    "Magnolia" => [
        "co2_absorption" => 29.0, 
        "growth_rate" => 0.5,
        "climate" => "Tropical", 
        "average_size" => 25.0,
        "pollutant_absorption" => 9.0
    ],
    "Acacia" => [
        "co2_absorption" => 24.0, 
        "growth_rate" => 0.6,
        "climate" => "Tropical", 
        "average_size" => 10.0,
        "pollutant_absorption" => 5.0
    ],
    "Balsa" => [
        "co2_absorption" => 15.0, 
        "growth_rate" => 0.9,
        "climate" => "Tropical", 
        "average_size" => 15.0,
        "pollutant_absorption" => 3.0
    ],
    "Mahogany" => [
        "co2_absorption" => 46.0, 
        "growth_rate" => 0.4,
        "climate" => "Tropical", 
        "average_size" => 25.0,
        "pollutant_absorption" => 13.0
    ],
    "Pecan" => [
        "co2_absorption" => 44.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 30.0,
        "pollutant_absorption" => 10.0
    ],
    "Cypress" => [
        "co2_absorption" => 31.0, 
        "growth_rate" => 0.5,
        "climate" => "Temperate", 
        "average_size" => 25.0,
        "pollutant_absorption" => 7.0
    ],
    "Narra" => [
        "co2_absorption" => 50.0, 
        "growth_rate" => 0.6,
        "climate" => "Tropical", 
        "average_size" => 35.0,
        "pollutant_absorption" => 14.0
    ],
    "Mango" => [
        "co2_absorption" => 42.0, 
        "growth_rate" => 0.5,
        "climate" => "Tropical", 
        "average_size" => 12.0,
        "pollutant_absorption" => 10.0
    ],
    "Coconut" => [
        "co2_absorption" => 18.0, 
        "growth_rate" => 0.3,
        "climate" => "Tropical", 
        "average_size" => 8.0,
        "pollutant_absorption" => 4.0
    ],
    "Tamarind" => [
        "co2_absorption" => 28.0, 
        "growth_rate" => 0.5,
        "climate" => "Tropical", 
        "average_size" => 15.0,
        "pollutant_absorption" => 7.0
    ],
    "Banana" => [
        "co2_absorption" => 10.0, 
        "growth_rate" => 1.2,
        "climate" => "Tropical", 
        "average_size" => 4.0,
        "pollutant_absorption" => 2.0
    ],
    "Lanzones" => [
        "co2_absorption" => 15.0, 
        "growth_rate" => 0.3,
        "climate" => "Tropical", 
        "average_size" => 6.0,
        "pollutant_absorption" => 3.0
    ],
    "Langka (Jackfruit)" => [
        "co2_absorption" => 22.0, 
        "growth_rate" => 0.4,
        "climate" => "Tropical", 
        "average_size" => 20.0,
        "pollutant_absorption" => 6.0
    ],
    "Rambutan" => [
        "co2_absorption" => 18.0, 
        "growth_rate" => 0.5,
        "climate" => "Tropical", 
        "average_size" => 12.0,
        "pollutant_absorption" => 5.0
    ],
    "Durian" => [
        "co2_absorption" => 35.0, 
        "growth_rate" => 0.7,
        "climate" => "Tropical", 
        "average_size" => 15.0,
        "pollutant_absorption" => 8.0
    ]
];


require_once 'airdbconnect.php';

$co2_absorption = $growth = $oxygen_production = $space_required = $pollutant_absorption = null;
$weather_condition = $filtered_trees = [];
$number_of_trees = 1; // Default to 1 tree

$db = new Database();
$conn = $db->getConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $species = $_POST['species'] ?? null;
    $years = $_POST['years'] ?? null;
    $weather_condition = $_POST['weather_condition'] ?? null;
    $number_of_trees = $_POST['number_of_trees'] ?? 1; 

  
    if ($weather_condition) {
        $filtered_trees = array_filter($tree_data, function($tree) use ($weather_condition) {
            return $tree['climate'] === $weather_condition;
        });
    }

    if ($species && $years !== null) {
        
        if (array_key_exists($species, $tree_data)) {
            $tree = $tree_data[$species];
            $co2_absorption = $tree['co2_absorption'] * $number_of_trees;  
            $oxygen_production = $co2_absorption * $oxygen_conversion_factor;

        
            $growth_in_meters = $tree['growth_rate'] * $years;  

           
            $growth = $growth_in_meters * 3.28084;  

        
            $size_in_feet = $tree['average_size'] * 3.28084; 
            $space_required = $size_in_feet * $number_of_trees; 

         
            $pollutant_absorption = $tree['pollutant_absorption'] * $number_of_trees; 

            
            $query = "INSERT INTO history (tree_name, quantity, carbon_absorption, growth_rate, climate, average_size, pollutant_absorption, oxygen_production) 
                      VALUES (:tree_name, :quantity, :carbon_absorption, :growth_rate, :climate, :average_size, :pollutant_absorption, :oxygen_production)";
            $stmt = $conn->prepare($query);

            $stmt->execute([
                ':tree_name' => $species,
                ':quantity' => $number_of_trees, 
                ':carbon_absorption' => $co2_absorption,
                ':growth_rate' => $tree['growth_rate'],
                ':climate' => $tree['climate'],
                ':average_size' => $tree['average_size'],
                ':pollutant_absorption' => $pollutant_absorption,
                ':oxygen_production' => $oxygen_production
            ]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant a Tree</title>
    <link rel="Stylesheet" href="Style/airtrees.css">
   
</head>
<body>

<main>
    <div class="section-container">
        <button class="btn-home" onclick="window.location.href='useracc.php'">Home</button>
        <button class="btn-air-section" onclick="window.location.href='airsection.php'">Air Section</button>
        <button class="btn-view-table" onclick="window.location.href='aircity.php'">View Tree Table</button>
    </div>
</main>


    <h1>Plant a Tree</h1>

    <form method="POST">
        <label for="weather_condition">Choose the weather condition:</label>
        <select name="weather_condition" id="weather_condition" required onchange="this.form.submit()">
            <option value="" disabled selected>Select a weather condition</option>
            <option value="Tropical" <?php echo isset($weather_condition) && $weather_condition == 'Tropical' ? 'selected' : ''; ?>>Tropical</option>
            <option value="Temperate" <?php echo isset($weather_condition) && $weather_condition == 'Temperate' ? 'selected' : ''; ?>>Temperate</option>
            <option value="Cold" <?php echo isset($weather_condition) && $weather_condition == 'Cold' ? 'selected' : ''; ?>>Cold</option>
        </select>
        <br><br>

        <label for="species">Choose a tree species:</label>
        <select name="species" id="species" required>
            <option value="" disabled selected>Select a tree</option>
            <?php 
            foreach ($filtered_trees as $species_name => $data) {
                echo '<option value="' . htmlspecialchars($species_name) . '" ' . (isset($species) && $species == $species_name ? 'selected' : '') . '>';
                echo htmlspecialchars($species_name) . ' (' . htmlspecialchars($data['co2_absorption']) . ' kg CO₂/year, ' . htmlspecialchars($data['pollutant_absorption']) . ' kg pollutants/year)';
                echo '</option>';
            }
            ?>
        </select>
        <br><br>

        <label for="years">Simulate growth for how many years?</label>
        <?php //I put required min to make sure user have input?>
        <input type="number" name="years" id="years" required min="1" step="1" value="<?php echo htmlspecialchars($years ?? ''); ?>">
        <br><br>

        <label for="number_of_trees">How many trees do you want to plant?</label>
        <input type="number" name="number_of_trees" id="number_of_trees" required min="1" step="1" value="<?php echo htmlspecialchars($number_of_trees); ?>">
        <br><br>

        <button type="submit">Plant Tree</button>
    </form>

    <?php 
    if (isset($species)) {
        echo '<h2>Tree Planted</h2>';
        echo '<p>You planted ' . htmlspecialchars($number_of_trees) . ' ' . htmlspecialchars($species) . ' trees.</p>';
        echo '<p>These trees absorb ' . htmlspecialchars($co2_absorption) . ' kg of CO₂ per year and produce ' . round($oxygen_production, 2) . ' kg of oxygen per year.</p>';
        echo '<p>After ' . htmlspecialchars($years) . ' years, your tree will have grown by ' . round($growth, 2) . ' feet.</p>';
        echo '<p>You will need a space of ' . round($space_required, 2) . ' square feet to plant these trees.</p>';
        echo '<p>Your trees will also absorb approximately ' . round($pollutant_absorption, 2) . ' kg of pollutants (like NO₂ and PM) per year, helping to improve air quality.</p>';
    }
    ?>

<br><br>
<a href="airhistory.php" class="button-link">View Planting History</a>

</body>
</html>