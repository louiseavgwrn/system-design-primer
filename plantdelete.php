<?php
session_start();
require_once 'dbconnection.php';
require_once 'plantcrud.php';

$account_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate if account_id is set
    if (empty($account_id)) {
        echo json_encode(['status' => 'error', 'message' => 'User is not logged in.']);
        exit;
    }

    // Get the plant ID to delete
    $plant_id = isset($_POST['id']) ? $_POST['id'] : null;

    if (empty($plant_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Plant ID is missing.']);
        exit;
    }

    // Establish the database connection
    $database = new Database();
    $db = $database->getConnect();

    // Create a Plant object
    $plant = new Plant($db);
    $plant->id = $plant_id;
    $plant->account_id = $account_id;

    if ($plant->delete()) {
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
                    title: 'Deleted!',
                    text: 'The plant has been deleted successfully.',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'landplant.php'; // Redirect to the plant list page
                    }
                });
            </script>
        </body>
        </html>";
    } else {
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
                    text: 'There was an error deleting the plant. Please try again later.',
                    icon: 'error'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'landplant.php'; // Redirect to the plant list page
                    }
                });
            </script>
        </body>
        </html>";
    }
}
?>
