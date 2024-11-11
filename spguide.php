<?php
//Code still under development - Kyle
//Note: Script are internet base, please dm me for your concern - Kyle


$practices = [
    "Composting" => [
        "description" => "Reduces waste and creates nutrient-rich soil by breaking down organic materials.",
        "benefits" => "Reduces landfill waste, lowers greenhouse gases, enriches soil.",
        "tips" => [
            "Start with a compost bin or pile.",
            "Mix greens (fruit/vegetable scraps) and browns (leaves, cardboard).",
            "Turn the compost regularly.",
            "Avoid adding meat, dairy, or oily foods.",
            "Keep compost moist but not soggy."
        ],
        "resources" => [
            "EPA Composting Guidelines" => "https://www.epa.gov/recycle/composting-home"
        ],
        "image" => "https://media.istockphoto.com/id/479440915/photo/compost-with-composted-earth.jpg?s=612x612&w=0&k=20&c=P5u2ACtdpVOZETebKudOz7RFL3b6EqY-2uQOrQ2_bdA="
    ],
    "Native Planting" => [
        "description" => "Native plants support local wildlife and reduce maintenance by being well-suited to the local climate.",
        "benefits" => "Requires less water and no pesticides, preserving local biodiversity.",
        "tips" => [
            "Research native plants for your region.",
            "Group plants with similar needs together.",
            "Avoid pesticides to protect beneficial insects."
        ],
        "resources" => [
            "National Wildlife Federation" => "https://www.nwf.org/Garden-for-Wildlife"
        ],
        "image" => "https://ncwildflower.org/wp-content/uploads/2020/02/IMG_0476-819x1024.jpg"
    ],
    "Water Conservation" => [
        "description" => "Efficient water use conserves resources and reduces environmental impact.",
        "benefits" => "Reduces water consumption and lowers energy costs.",
        "tips" => [
            "Install low-flow fixtures.",
            "Collect rainwater for gardening.",
            "Water early or late to reduce evaporation."
        ],
        "resources" => [
            "Water Conservation Tips" => "https://www.wateruseitwisely.com/"
        ],
        "image" => "https://s3.us-west-2.amazonaws.com/thurstoncountywa.gov.if-us-west-2/s3fs-public/styles/max_width_800/public/2023-03/EH_WQ_water-conservation-image.jpeg?itok=adMua2-D"
    ],
    "Urban Gardening" => [
        "description" => "Urban gardening enables city dwellers to grow food and create green spaces.",
        "benefits" => "Improves air quality, provides fresh produce, and enhances community bonding.",
        "tips" => [
            "Use containers or vertical gardening for limited space.",
            "Join a community garden.",
            "Plan garden layout for sunlight exposure."
        ],
        "resources" => [
            "Urban Gardening Guide" => "https://www.urbanag.org/"
        ],
        "image" => "https://containergardening.wordpress.com/wp-content/uploads/2015/02/riser2-jojo-rom-285968_2051946656569_1181604134_31935796_8041270_o.jpg"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainable Practices Guide</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        button { margin: 5px; padding: 10px; cursor: pointer; }
        .practice-content { display: none; margin-top: 10px; }
    </style>
</head>
<body>

    <header>
        <h1>Sustainable Practices Guide</h1>
    </header>

    <main>
        <div>
            <?php 
            foreach ($practices as $title => $practice) {
            ?>
                <button class="toggle-button" data-practice-id="<?php echo strtolower(str_replace(' ', '-', $title)); ?>">
                    <?php echo $title; ?>
                </button>
            <?php 
            }
            ?>
        </div>

        <div id="practice-details">
            <?php 
            foreach ($practices as $title => $practice) {
            ?>
                <div id="<?php echo strtolower(str_replace(' ', '-', $title)); ?>" class="practice-content">
                    <h3><?php echo $title; ?></h3>
                    <img src="<?php echo $practice['image']; ?>" alt="<?php echo $title . ' practice'; ?>" width="300">
                    <p><strong>Description:</strong> <?php echo $practice['description']; ?></p>
                    <p><strong>Benefits:</strong> <?php echo $practice['benefits']; ?></p>
                    <p><strong>Tips:</strong></p>
                    <ul>
                        <?php 
                        foreach ($practice['tips'] as $tip) {
                        ?>
                            <li><?php echo $tip; ?></li>
                        <?php 
                        }
                        ?>
                    </ul>
                    
                    <p><strong>Resources:</strong></p>
                    <ul>
                        <?php 
                        foreach ($practice['resources'] as $name => $link) {
                        ?>
                            <li><a href="<?php echo $link; ?>" target="_blank"><?php echo $name; ?></a></li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            <?php 
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Sustainable Practices Guide</p>
    </footer>

    <script>
        document.querySelectorAll('.toggle-button').forEach(button => {
            button.addEventListener('click', function() {
                const practiceId = this.getAttribute('data-practice-id');
                const content = document.getElementById(practiceId);
                
                const allContent = document.querySelectorAll('.practice-content');
                allContent.forEach(item => item.style.display = 'none');
                
                if (content.style.display === "none" || content.style.display === "") {
                    content.style.display = "block";
                } else {
                    content.style.display = "none";
                }
            });
        });
    </script>

</body>
</html>
