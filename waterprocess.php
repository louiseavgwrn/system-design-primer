<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $user_name = $_POST['user_name'];
    $daily_usage = $_POST['daily_usage'];
    $usage_type = $_POST['usage_type'];


    $threshold_liters = 300; 
    $threshold_gallons = 79; 

    if ($usage_type == "gallons") {
        $daily_usage_in_liters = $daily_usage * 3.785; // 1 gallon = 3.785 liters
    } else {
        $daily_usage_in_liters = $daily_usage;
    }

    
    if ($daily_usage_in_liters > $threshold_liters) {
       
        header("Location: waterresult.php?user_name=" . urlencode($user_name));
        exit(); 
    } else {
        echo "Thank you for your submission, $user_name. Your water usage is within the normal range.";
    }
}
?>
