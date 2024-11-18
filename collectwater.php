<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Usage and Savings Calculator</title>
</head>
<body>
    <h1>Water Usage and Savings Calculator</h1>

    <form action="waterprocess.php" method="POST">
        <label for="user_name">Your Name:</label>
        <input type="text" id="user_name" name="user_name" required>
        <br><br>

        <label for="daily_usage">Enter your daily water usage (in liters or gallons):</label>
        <input type="number" id="daily_usage" name="daily_usage" step="any" required>
        <br><br>

        <label for="usage_type">Type of usage (e.g., liters or gallons):</label>
        <select id="usage_type" name="usage_type">
            <option value="liters">Liters</option>
            <option value="gallons">Gallons</option>
        </select>
        <br><br>

        <input type="submit" value="Calculate Savings">
    </form>
</body>
</html>
