<?php
include_once 'animalgame.php';

$game = new Game();
$randomAnimal = $game->getRandomAnimal();

$randomSound = $randomAnimal->getSound();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/animalsound.css">
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
    <source src="Sound/<?php echo $randomSound; ?>" type="audio/mpeg">
</audio>

<form action="guessanimal.php" method="POST">
    <input type="hidden" name="sound" value="<?php echo $randomSound; ?>">
    <label for="guess">What animal made this sound?</label><br>
    <input type="text" id="guess" name="guess" placeholder="Enter your guess here..." required><br><br>
    <button type="submit">Submit Guess</button>
</form>

</body>
</html>
