<?php
$animal_sounds = [
    'Loon.mp3',
    'Dove.mp3',
    'Bear.mp3',
    'Whale.mp3',
    'Moose.mp3',
    'Hyena.mp3',
    'Wolf.mp3',
    'Jaguar.mp3',
    'Owl.mp3',
    'Fox.mp3',
    'Alligator.mp3',
    'Eagle.mp3',
    'Elephant.mp3',
    'Lion.mp3'
];


$random_sound = $animal_sounds[array_rand($animal_sounds)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Style/animalsound.css">
    <title>Animal Sound Guessing Game</title>
</head>
<body>

<main>
    <div class="section-container">
        <button onclick="window.location.href='useracc.php'">Home</button>
        <button onclick="window.location.href='lifesection.php'">Life Section</button>
    </div>
</main>

    <h1>Animal Sound Guessing Game</h1>
    <p>Listen to the sound and guess which animal it belongs to!</p>

    <audio controls>
        <source src="Sound/<?php echo $random_sound; ?>" type="audio/mpeg">
    </audio>


    <form action="guessanimal.php" method="POST">
    <input type="hidden" name="sound" value="<?php echo $random_sound; ?>"> 
    <label for="guess">What animal made this sound?</label><br>
    <input type="text" id="guess" name="guess" placeholder="Enter your guess here..." required><br><br>
    <button type="submit">Submit Guess</button>
</form>


   
    <form action="" method="POST">
        <button type="submit">Hear their Voice</button>
    </form>
</body>
</html>
