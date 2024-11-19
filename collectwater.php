<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Usage & Savings Calculator</title>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #e0f7fa;
            color: #00796b;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header Section */
        header {
            background: linear-gradient(to bottom right, #00695c, #00897b);
            color: white;
            padding: 80px 0;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        header h1 {
            font-size: 3.5em;
            margin: 0;
        }
        header p {
            font-size: 1.2em;
            margin: 10px 0 0;
        }

        /* Section Styling */
        section {
            margin: 40px auto;
            padding: 30px;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        section h2 {
            font-size: 2.5em;
            color: #00796b;
            margin-bottom: 20px;
        }
        section p, section ul {
            font-size: 1.1em;
            line-height: 1.7;
            color: #004d40;
        }
        section ul {
            margin-left: 20px;
        }

        /* Calculator Form */
        form {
            display: flex;
            flex-direction: column;
            padding: 20px;
            background: #b2dfdb;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        form input[type="text"], form input[type="number"], form select {
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #00796b;
            border-radius: 5px;
            font-size: 1.1em;
        }
        form input[type="submit"] {
            background: #00796b;
            color: white;
            font-size: 1.2em;
            font-weight: bold;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background: #004d40;
        }

        /* Fact Box Styling */
        .fact-box {
            background: linear-gradient(to right, #00bcd4, #26c6da);
            border-left: 5px solid #00796b;
            padding: 20px;
            margin-top: 25px;
            font-style: italic;
            color: #004d40;
        }

        /* Fun Water Animation */
        body::after {
            content: "";
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('https://www.transparenttextures.com/patterns/waves.png'), linear-gradient(to top, #00796b, #00bcd4);
            animation: wave-animation 5s infinite linear;
            z-index: -1;
        }
        @keyframes wave-animation {
            from { background-position: 0 0; }
            to { background-position: 1000px 0; }
        }

        /* Footer Styling */
        footer {
            background: #004d40;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1.2em;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.5em;
            }
            section h2 {
                font-size: 2em;
            }
        }
    </style>
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
