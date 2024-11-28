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

    if ($userGuess === $correctAnswer) {
        echo "<h1>Correct!</h1>";
        echo "<p>You guessed it right. The sound belongs to a <strong>$correctAnswer</strong>.</p>";
    } else {
        echo "<h1>Wrong Answer!</h1>";
        echo "<p>Sorry, that's incorrect. The correct answer is <strong>$correctAnswer</strong>.</p>";
    }

    echo '<br><a href="animalsound.php">Try Again</a>';
} else {
    header('Location: animalsound.php');
    exit();
}
?>
