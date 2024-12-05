<?php
session_start();
require 'userdatabase.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];  
    $gender = $_POST['gender'];
    $address = $_POST['address'];


    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
    
        if ($stmt->rowCount() > 0) {
            $error = "Username or Email already exists.";
        } else {
    
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password, phone, date, gender, address) 
                                    VALUES (:fullname, :email, :username, :password, :phone, :date, :gender, :address)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password_hashed);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':address', $address);
            $stmt->execute();

            header("Location: login.php");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Green Guardians</title>
    <link rel="stylesheet" href="Style/signup.css">
</head>
<body>
    <div class="form-container">
        <h1>Sign up for Green Guardians</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="post" action="signup.php">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="phone">Phone Number (Optional):</label>
            <input type="text" id="phone" name="phone">

            <label for="date">Date of Birth:</label>
            <input type="date" id="date" name="date" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <button type="submit">Signup</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <footer>
        <p>&copy; 2024 Green Guardians | Promoting Biodiversity and Sustainable Practices</p>
    </footer>
</body>
</html>
