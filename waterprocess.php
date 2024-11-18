<?php
include('db2connect.php');

$database = new Database();
$conn = $database->getConnect();

$user_name = $_POST['user_name'];
$daily_usage = $_POST['daily_usage'];
$usage_type = $_POST['usage_type'];

$potential_savings = 0;

if ($usage_type == "liters" || $usage_type == "gallons") {
    $potential_savings = $daily_usage * 0.10;
}

try {
    $query = "INSERT INTO usage_data (user_name, daily_usage, potential_savings) VALUES (:user_name, :daily_usage, :potential_savings)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':daily_usage', $daily_usage);
    $stmt->bindParam(':potential_savings', $potential_savings);

    $stmt->execute();

    echo "Data saved successfully. Your potential savings are: " . $potential_savings . " " . $usage_type . ".";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
