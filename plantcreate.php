<?php
// Start the session to track user information
session_start();

// Include the database connection and plant CRUD operations files
require_once 'dbconnection.php';
require_once 'plantcrud.php';

// Retrieve the account ID from the session, if set
$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : null;

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the user is not logged in, return an error response
    if (empty($account_id)) {
        echo json_encode(['status' => 'error', 'message' => 'User is not logged in.']); // Return error message
        exit; // Stop further execution
    }

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnect();

    // Create a new Plant object for CRUD operations
    $plant = new Plant($db);

    // Sanitize and assign form data to the Plant object properties
    $plant->name = htmlspecialchars(trim($_POST['name'])); // Sanitize and trim the plant name
    $plant->scientific_name = htmlspecialchars(trim($_POST['scientific_name'])); // Sanitize and trim scientific name
    $plant->region = htmlspecialchars(trim($_POST['region'])); // Sanitize and trim the region
    $plant->type = isset($_POST['type']) ? htmlspecialchars(trim($_POST['type'])) : ''; // Sanitize and trim plant type
    $plant->description = htmlspecialchars(trim($_POST['description'])); // Sanitize and trim the description
    $plant->account_id = $account_id; // Set the account ID for the plant

    // Try to insert the plant into the database
    if ($plant->create()) {
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
