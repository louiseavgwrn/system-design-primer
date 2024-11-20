<?php
//Script and style are internet based - Kyle
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Usage & Savings Calculator</title>
  
</head>
<body>

    <header>
        <h1>💧 Water Usage & Savings Calculator 💧</h1>
        <p>Track your water consumption and discover ways to conserve water for a better tomorrow.</p>
    </header>

    <section>
        <form action="waterprocess.php" method="POST">
            <label for="user_name">Your Name:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="daily_usage">Enter your daily water usage:</label>
            <input type="number" id="daily_usage" name="daily_usage" step="any" required>

            <label for="usage_type">Type of usage (liters or gallons):</label>
            <select id="usage_type" name="usage_type">
                <option value="liters">Liters</option>
                <option value="gallons">Gallons</option>
            </select>

            <input type="submit" value="Calculate Savings">
        </form>
    </section>

    <section>
        <h2>Why Water Matters</h2>
        <p>Water is one of the most precious resources on Earth. Here’s why we need to protect it:</p>
        <ul>
            <li>Only 1% of Earth's water is available for human use.</li>
            <li>By 2025, half of the world’s population will face water shortages.</li>
            <li>Water scarcity already affects 1.1 billion people globally.</li>
        </ul>
    </section>

    <section>
        <h2>🌱 Smart Water-Saving Tips</h2>
        <p>Small actions can lead to significant water savings. Here are some tips:</p>
        <ul>
            <li>Turn off the tap while brushing your teeth – save up to 8 liters per minute!</li>
            <li>Switch to low-flow water fixtures to conserve water without compromising comfort.</li>
            <li>Use a bucket to wash your car instead of a hose to save up to 500 liters per wash.</li>
            <li>Check for leaks and repair them promptly to avoid wasting hundreds of liters a month.</li>
        </ul>
    </section>

    <section>
        <h2>⚠️ Global Water Challenges</h2>
        <p>Water scarcity is a pressing global issue. Here are some of the key challenges:</p>
        <ul>
            <li><strong>Pollution:</strong> Contamination of water bodies by industrial waste and chemicals.</li>
            <li><strong>Climate Change:</strong> Extreme weather events such as droughts and floods impact water availability.</li>
            <li><strong>Overuse:</strong> Unsustainable agricultural and industrial practices that deplete water resources.</li>
        </ul>
    </section>

    <section>
        <h2>🌊 Fun Water Facts</h2>
        <div class="fact-box">
            <p>Did you know? It takes 2,700 liters of water to produce just one cotton shirt!</p>
        </div>
        <ul>
            <li>Water regulates Earth's climate and supports all life.</li>
            <li>Only 0.007% of Earth's water is available for human use.</li>
        </ul>
    </section>

    <footer>
        <p>💧 Every drop counts. Together, we can make a difference. 💧</p>
    </footer>

</body>
</html>
