<?php
$host = 'localhost'; // Database host
$dbname = 'green_guardians'; // Database name
$user = 'root'; // Your MySQL username
$pass = ''; // Your MySQL password

try {
    // Establish connection to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
