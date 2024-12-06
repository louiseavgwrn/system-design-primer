<?php
session_start();
require_once 'dbconnection.php';
require_once 'plantcrud.php';

$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : null;

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate if account_id is set
    if (empty($account_id)) {
        echo json_encode(['status' => 'error', 'message' => 'User is not logged in.']);
        exit;
    }

    // Establish the database connection
    $database = new Database();
    $db = $database->getConnect();

    // Create a Plant object
    $plant = new Plant($db);

    // Clean input data to avoid SQL injection and ensure data safety
    $plant->name = htmlspecialchars(trim($_POST['name']));
    $plant->scientific_name = htmlspecialchars(trim($_POST['scientific_name']));
    $plant->region = htmlspecialchars(trim($_POST['region']));
    $plant->type = isset($_POST['type']) ? htmlspecialchars(trim($_POST['type'])) : '';  // Ensure 'type' is set if available
    $plant->description = htmlspecialchars(trim($_POST['description']));
    $plant->account_id = $account_id;// Associate the plant with the logged-in user's account

    // Try to insert the plant into the database
    if ($plant->create()) {
        // Success: SweetAlert notification for success
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success Notification</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Your plant was successfully created!',
                icon: 'success'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'landplant.php'; // Redirect to the plant section after success
                }
            });
        </script>
        </body>
        </html>";
    } else {
        // Error: Show error message if the plant creation failed
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error Notification</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'There was an error creating the plant. Please try again later.',
                icon: 'error'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'landplant.php'; // Redirect back to the section if error occurs
                }
            });
        </script>
        </body>
        </html>";
    }
}
?>
