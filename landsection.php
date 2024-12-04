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

<main>
    <div class="section-container">

        <button onclick="window.location.href='useracc.php'">Home</button>
        <button onclick="window.location.href='watersection.php'">Water Section</button>
        <button onclick="window.location.href='airsection.php'">Air Section</button>
        <button onclick="window.location.href='lifesection.php'">Living Section</button>

    </div>
</main>

 
    <header>
        <h1>🌱 Plant Data Management 🌱</h1>
        <p>Explore, create, and manage plant data. Learn more about different plant species and their vital role in the environment.</p>
    </header>



    <section class="info-section">
        <h3>🌿 Plant Care Tips 🌿</h3>
        <p>Taking care of plants requires dedication, but it's very rewarding. Here are some tips to keep your plants healthy:</p>
        <ul>
            <li>Water your plants regularly, but don't overwater. Most plants prefer slightly dry soil.</li>
            <li>Place your plants in a spot that receives the right amount of sunlight based on the plant's needs.</li>
            <li>Ensure your plants have good drainage to avoid root rot.</li>
            <li>Regularly prune dead or yellowing leaves to encourage new growth.</li>
        </ul>
    </section>

    <section class="info-section">
        <h3>🌱 Fun Plant Trivia 🌱</h3>
        <p>Plants are fascinating organisms. Here are some fun facts:</p>
        <ul>
            <li>The world's largest plant is a seagrass called Posidonia oceanica, covering over 15 kilometers in the Mediterranean.</li>
            <li>The oldest living tree is a bristlecone pine in California, which is over 5,000 years old!</li>
            <li>Some plants, like the Venus flytrap, have evolved to catch and digest insects.</li>
        </ul>
    </section>

    <section class="info-section">
        <h3>🌸 Suggestions for Choosing Plants 🌸</h3>
        <p>Here are some suggestions when choosing plants for your home or garden:</p>
        <ul>
            <li>Consider your climate zone before selecting outdoor plants.</li>
            <li>If you're a beginner, start with easy-to-care-for plants like succulents or pothos.</li>
            <li>Choose plants that fit the size and lighting of your space, whether indoors or outdoors.</li>
        </ul>
    </section>

    <section class="info-section">
        <h3>⚖️ Pros and Cons of Common Houseplants ⚖️</h3>
        <p>Here are some pros and cons of popular houseplants:</p>
        <ul>
            <li><strong>Spider Plant:</strong> 
                <ul>
                    <li><strong>Pros:</strong> Easy to care for, purifies the air.</li>
                    <li><strong>Cons:</strong> Can grow long, unsightly stems if not trimmed.</li>
                </ul>
            </li>
            <li><strong>Snake Plant:</strong>
                <ul>
                    <li><strong>Pros:</strong> Extremely low maintenance, good air purifier.</li>
                    <li><strong>Cons:</strong> Toxic to pets if ingested.</li>
                </ul>
            </li>
            <li><strong>Peace Lily:</strong>
                <ul>
                    <li><strong>Pros:</strong> Great for low-light conditions, beautiful white blooms.</li>
                    <li><strong>Cons:</strong> Requires consistent watering and can be toxic to pets.</li>
                </ul>
            </li>
        </ul>
    </section>


    
    <section>
        <button class="toggle-button" onclick="toggleForm()">Create My Owned Plant</button>
        <div id="createPlantForm">
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
                require_once 'plantdatabase.php';
                require_once 'plantcrud.php';

                $database = new Database();
                $db = $database->getConnect();

                $plant = new Plant($db);
                $stmt = $plant->read();
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
                        </td> ";
            
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No plants found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>


<section>
    <h2>Plant Information List</h2>
    <table id="plantInfoTable" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Scientific Name</th>
                <th>Region</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Spider Plant</td>
                <td>Chlorophytum comosum</td>
                <td>Tropical regions</td>
                <td>Houseplant</td>
                <td>A resilient and easy-to-care-for houseplant with air-purifying properties.</td>
            </tr>
            <tr>
                <td>Snake Plant</td>
                <td>Sansevieria trifasciata</td>
                <td>Africa, Asia</td>
                <td>Houseplant</td>
                <td>Known for its air-purifying abilities and low maintenance.</td>
            </tr>
            <tr>
                <td>Pothos</td>
                <td>Epipremnum aureum</td>
                <td>Asia, Oceania</td>
                <td>Houseplant</td>
                <td>A popular trailing vine plant, easy to grow in various lighting conditions.</td>
            </tr>
            <tr>
                <td>Aloe Vera</td>
                <td>Aloe barbadensis miller</td>
                <td>Arid regions of Africa</td>
                <td>Succulent</td>
                <td>Known for its medicinal properties, especially for skin healing.</td>
            </tr>
            <tr>
                <td>Peace Lily</td>
                <td>Spathiphyllum</td>
                <td>Tropical America</td>
                <td>Houseplant</td>
                <td>It is appreciated for its elegant white flowers and air-purifying abilities.</td>
            </tr>
            <tr>
                <td>English Ivy</td>
                <td>Hedera helix</td>
                <td>Europe, Western Asia</td>
                <td>Climber</td>
                <td>An evergreen climbing plant, commonly used as ground cover or a climbing vine.</td>
            </tr>
            <tr>
                <td>Fern</td>
                <td>Various species</td>
                <td>Worldwide</td>
                <td>Houseplant</td>
                <td>Ferns are known for their delicate fronds and thrive in humid, low-light conditions.</td>
            </tr>
            <tr>
                <td>Jade Plant</td>
                <td>Crassula ovata</td>
                <td>South Africa, Mozambique</td>
                <td>Succulent</td>
                <td>A low-maintenance succulent known for its thick, fleshy leaves and tree-like structure.</td>
            </tr>
            <tr>
                <td>Lavender</td>
                <td>Lavandula</td>
                <td>Mediterranean</td>
                <td>Herb</td>
                <td>Lavender is known for its fragrant flowers, often used in aromatherapy and cooking.</td>
            </tr>
            <tr>
                <td>Rosemary</td>
                <td>Rosmarinus officinalis</td>
                <td>Mediterranean</td>
                <td>Herb</td>
                <td>A fragrant herb used in cooking, as well as for medicinal purposes.</td>
            </tr>
            <tr>
                <td>Sunflower</td>
                <td>Helianthus annuus</td>
                <td>North America</td>
                <td>Flowering Plant</td>
                <td>Known for its large yellow flowers that turn towards the sun, a symbol of summer.</td>
            </tr>
            <tr>
                <td>Orchid</td>
                <td>Orchidaceae</td>
                <td>Tropical and subtropical regions</td>
                <td>Flowering Plant</td>
                <td>Orchids are admired for their unique and beautiful flowers, often found in a variety of colors.</td>
            </tr>
            <tr>
                <td>Geranium</td>
                <td>Pelargonium</td>
                <td>South Africa</td>
                <td>Flowering Plant</td>
                <td>Popular for its bright, colorful blooms and is often used in garden bedding.</td>
            </tr>
            <tr>
                <td>Begonia</td>
                <td>Begonia</td>
                <td>Tropical and subtropical regions</td>
                <td>Houseplant</td>
                <td>Begonias are popular for their attractive foliage and vibrant flowers.</td>
            </tr>
            <tr>
                <td>Cherry Blossom</td>
                <td>Prunus serrulata</td>
                <td>Asia</td>
                <td>Flowering Tree</td>
                <td>Known for its beautiful pink flowers that bloom in spring, symbolizing renewal.</td>
            </tr>
            <tr>
                <td>Magnolia</td>
                <td>Magnolia grandiflora</td>
                <td>North America, Asia</td>
                <td>Flowering Tree</td>
                <td>Admired for its large, fragrant white flowers and glossy green leaves.</td>
            </tr>
            <tr>
                <td>Tulip</td>
                <td>Tulipa</td>
                <td>Europe, Central Asia</td>
                <td>Flowering Plant</td>
                <td>Known for its colorful, cup-shaped flowers that bloom in spring.</td>
            </tr>
            <tr>
                <td>Cactus</td>
                <td>Cactaceae</td>
                <td>North America, South America</td>
                <td>Succulent</td>
                <td>Cacti are known for their spines and ability to thrive in arid conditions.</td>
            </tr>
            <tr>
                <td>Hibiscus</td>
                <td>Hibiscus rosa-sinensis</td>
                <td>Tropical and subtropical regions</td>
                <td>Flowering Plant</td>
                <td>Popular for its large, colorful blooms that are often used in ornamental gardens.</td>
            </tr>
            <tr>
                <td>Ficus</td>
                <td>Ficus elastica</td>
                <td>Southeast Asia</td>
                <td>Houseplant</td>
                <td>A large indoor plant with thick, glossy leaves, also known as the rubber tree.</td>
            </tr>
        </tbody>
    </table>
</section>

<script>
        $(document).ready(function() {
            $('#plantTable').DataTable();
        });

        $(document).ready(function() {
            $('#plantInfoTable').DataTable();
        });

        function toggleForm() {
            const form = document.getElementById('createPlantForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>

    <footer>
        <p>Protect and nurture our plants. Every leaf counts!</p>
    </footer>

</body>
</html>
