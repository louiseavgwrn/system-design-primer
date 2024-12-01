<?php
session_start();

if (!isset($_SESSION['questions_pool'])) {
    $_SESSION['questions_pool'] = [
        ["question" => "What is the largest contributor to air pollution?", "answers" => ["Cars", "Plants", "Factories", "Clouds"], "correct" => "Cars"],
        ["question" => "Which gas is primarily responsible for the greenhouse effect?", "answers" => ["Oxygen", "Carbon Dioxide", "Nitrogen", "Methane"], "correct" => "Carbon Dioxide"],
        ["question" => "What is a natural air purifier?", "answers" => ["Plastic", "Paper", "Trees", "Cars"], "correct" => "Trees"],
        ["question" => "What does an air filter primarily remove from the air?", "answers" => ["Dust", "Light", "Humidity", "Temperature"], "correct" => "Dust"],
        ["question" => "Which of these can reduce indoor air quality?", "answers" => ["Natural plants", "Scented candles", "Air purifiers", "Window ventilation"], "correct" => "Scented candles"],
    ];
}

$botScores = [
    ["name" => "Doraemon", "score" => 4],
    ["name" => "Nobita", "score" => 3],
    ["name" => "Guko", "score" => 5],
    ["name" => "Majin Buu", "score" => 2],
    ["name" => "Awit", "score" => 1],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_quiz'])) {
    shuffle($_SESSION['questions_pool']);
    $_SESSION['quiz_questions'] = array_slice($_SESSION['questions_pool'], 0, 5);
    header('Location: airquiz.php');
    exit();
}

$score = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_quiz'])) {
    $selected_answers = $_POST['answers'];
    $quiz_questions = $_SESSION['quiz_questions'];

    foreach ($quiz_questions as $index => $question) {
        if (isset($selected_answers[$index]) && $selected_answers[$index] === $question['correct']) {
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Purification Quiz</title>
</head>
<body>
    <header>
        <h1>Air Pollution Quiz</h1>
    </header>

    <?php if (!isset($_SESSION['quiz_questions'])) { ?>
        <form method="POST">
            <button type="submit" name="start_quiz">Start Quiz</button>
        </form>
    <?php } else { ?>
        <form method="POST">
            <h2>Answer the following questions:</h2>
            <?php foreach ($_SESSION['quiz_questions'] as $index => $question) { ?>
                <div>
                    <p><?php echo ($index + 1) . ". " . $question['question']; ?></p>
                    <?php foreach ($question['answers'] as $answer) { ?>
                        <label>
                            <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo $answer; ?>" required>
                            <?php echo $answer; ?>
                        </label><br>
                    <?php } ?>
                </div>
            <?php } ?>
            <button type="submit" name="submit_quiz">Submit Quiz</button>
        </form>
    <?php } ?>

    <?php if (isset($_POST['submit_quiz'])) { ?>
        <h2>Your Score: <?php echo $score; ?> out of <?php echo count($_SESSION['quiz_questions']); ?></h2>
        <h3>Top Bot Scores:</h3>
        <ol>
            <?php foreach ($botScores as $bot) { ?>
                <li><?php echo $bot['name'] . ": " . $bot['score'] . " points"; ?></li>
            <?php } ?>
        </ol>
        <h3>Did You Beat Any Bots?</h3>
        <ul>
            <?php foreach ($botScores as $bot) { ?>
                <?php if ($score > $bot['score']) { ?>
                    <li>Congratulations! You beat <?php echo $bot['name']; ?>!</li>
                <?php } ?>
            <?php } ?>
        </ul>
        <a href="airquiz.php">Try Again</a>
    <?php } ?>
</body>
</html>
