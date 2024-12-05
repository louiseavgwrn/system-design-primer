<?php
include_once 'animalgame.php';

$game = new Game();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userGuess = strtolower(trim($_POST['guess']));
    $sound = $_POST['sound'];

    $animalInfo = $game->getAnimalInfo($sound);
    $correctAnswer = strtolower($animalInfo->getName());

    $isCorrect = $game->checkGuess($userGuess, $sound);

    echo "<div class='answer-box'>";
    if ($isCorrect) {
        echo "<h1>Correct!</h1>";
        echo "<p>You guessed it right. The sound belongs to a <strong>{$animalInfo->getName()}</strong>.</p>";
    } else {
        echo "<h1>Wrong Answer!</h1>";
        echo "<p>Sorry, that's incorrect. The correct answer is <strong>{$animalInfo->getName()}</strong>.</p>";
    }

    echo "<div class='fun-fact'>";
    echo "<h2>Fun Fact:</h2><p>{$animalInfo->getFact()}</p>";
    echo "</div>";

    echo "<div class='description'>";
    echo "<h3>Description:</h3><p>{$animalInfo->getDescription()}</p>";
    echo "<img src='images/{$animalInfo->getImage()}' alt='{$animalInfo->getName()}' width='300'>";
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
