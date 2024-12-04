<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userGuess = strtolower(trim($_POST['guess']));
    $animal_sounds = [
        'Loon.mp3' => 'loon',
        'Dove.mp3' => 'dove',
        'Bear.mp3' => 'bear',
        'Whale.mp3' => 'whale',
        'Moose.mp3' => 'moose',
        'Hyena.mp3' => 'hyena',
        'Wolf.mp3' => 'wolf',
        'Jaguar.mp3' => 'jaguar',
        'Owl.mp3' => 'owl',
        'Fox.mp3' => 'fox',
        'Alligator.mp3' => 'alligator',
        'Eagle.mp3' => 'eagle',
        'Elephant.mp3' => 'elephant',
        'Lion.mp3' => 'lion'
    ];

    $random_sound = $_POST['sound'];  
    $correctAnswer = $animal_sounds[$random_sound];

    function getAnimalInfo($animal) {
        $info = [
            'loon' => [
                'fact' => 'The loon is known for its eerie, haunting calls which can be heard echoing across northern lakes.',
                'image' => 'loon.jpg',
                'description' => 'Loons are large water birds found in North America, famous for their diving abilities and unique calls.'
            ],
            'dove' => [
                'fact' => 'Doves are symbols of peace and love in many cultures worldwide.',
                'image' => 'dove.jpg',
                'description' => 'Doves are small to medium-sized birds, often associated with calm and peaceful symbolism.'
            ],
            'bear' => [
                'fact' => 'Bears are incredibly strong and can run at speeds up to 30 miles per hour!',
                'image' => 'bear.jpg',
                'description' => 'Bears are large mammals found in forests and other environments, known for their strength and intelligence.'
            ],
            'whale' => [
                'fact' => 'Whales are the largest animals on Earth, with the blue whale growing up to 100 feet long.',
                'image' => 'whale.jpg',
                'description' => 'Whales are marine mammals that are known for their size and intelligence, living in oceans around the world.'
            ],
            'moose' => [
                'fact' => 'Moose are the largest members of the deer family, with huge antlers that can span over six feet.',
                'image' => 'moose.jpg',
                'description' => 'Moose are large herbivores found in forests and cold regions, often spotted in Canada and Northern Europe.'
            ],
            'hyena' => [
                'fact' => 'Hyenas are known for their laugh-like calls, which they use to communicate with each other.',
                'image' => 'hyena.jpg',
                'description' => 'Hyenas are carnivores known for their scavenging habits, often found in Africa and parts of Asia.'
            ],
            'wolf' => [
                'fact' => 'Wolves live in packs and communicate through a variety of vocalizations, including howls.',
                'image' => 'wolf.jpg',
                'description' => 'Wolves are carnivorous mammals known for their social structures and wide distribution across the globe.'
            ],
            'jaguar' => [
                'fact' => 'Jaguars are the largest cats in the Americas and are known for their powerful jaws.',
                'image' => 'jaguar.jpg',
                'description' => 'Jaguars are native to Central and South America, known for their agility and strength.'
            ],
            'owl' => [
                'fact' => 'Owls are nocturnal hunters, with exceptional hearing and sight in low light.',
                'image' => 'owl.jpg',
                'description' => 'Owls are birds of prey, often associated with wisdom and found in forests, deserts, and even urban areas.'
            ],
            'fox' => [
                'fact' => 'Foxes are highly adaptable animals and can live in a variety of habitats, including urban areas.',
                'image' => 'fox.jpg',
                'description' => 'Foxes are small carnivorous mammals known for their cunning nature and bushy tails.'
            ],
            'alligator' => [
                'fact' => 'Alligators can live up to 35-50 years in the wild and are known for their powerful jaws.',
                'image' => 'alligator.jpg',
                'description' => 'Alligators are large reptiles found in freshwater habitats, especially in the southeastern United States.'
            ],
            'eagle' => [
                'fact' => 'Eagles have extraordinary eyesight and can spot prey from over two miles away.',
                'image' => 'eagle.jpg',
                'description' => 'Eagles are large birds of prey, admired for their strength and sharp eyesight.'
            ],
            'elephant' => [
                'fact' => 'Elephants are known for their intelligence and emotional depth, with a memory that is said to last a lifetime.',
                'image' => 'elephant.jpg',
                'description' => 'Elephants are the largest land mammals, found in Asia and Africa, famous for their trunks and tusks.'
            ],
            'lion' => [
                'fact' => 'Lions are the only cats that live in groups, known as prides.',
                'image' => 'lion.jpg',
                'description' => 'Lions are large carnivores native to Africa, often called the "king of the jungle" for their regal appearance.'
            ]
        ];
        
        return $info[$animal] ?? null;
    }

    $animalInfo = getAnimalInfo($correctAnswer);

    if ($userGuess === $correctAnswer) {
        echo "<div class = 'incorrect-answer-box'>";
        echo "<h1>Correct!</h1>";
        echo "<p>You guessed it right. The sound belongs to a <strong>$correctAnswer</strong>.</p>";
    } else {
        echo "<h1>Wrong Answer!</h1>";
        echo "<p>Sorry, that's incorrect. The correct answer is <strong>$correctAnswer</strong>.</p>";
    }

    echo "<div class='fun-fact'>";
    echo "<h2>Fun Fact:</h2><p>{$animalInfo['fact']}</p>";
    echo "</div>";

    echo "<div class='description'>";
    echo "<h3>Description:</h3><p>{$animalInfo['description']}</p>";
    echo "<img src='images/{$animalInfo['image']}' alt='$correctAnswer' width='300'>";
    echo "</div>";

    echo '<br><a href="animalsound.php">Try Again</a>';
} else {
    header('Location: animalsound.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/guessanimal.css">
    <title>Guessing Game</title>
</head>
<body>
    
<main>
        <div class="section-container">
            <button onclick="window.location.href='useracc.php'" class="nav-button">Home</button>
            <button onclick="window.location.href='lifesection.php'" class="nav-button">Life Section</button>
        </div>
    </main>


</body>
</html>
