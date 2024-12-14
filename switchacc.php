<?php
// Start a session to manage user account data
session_start();

// Include the database connection file
require 'dbconnection.php';

// Initialize the Database object and establish a connection
$db = new Database();
$conn = $db->getConnect();

// Check and initialize session variables for managing logged-in accounts
if (!isset($_SESSION['logged_in_accounts'])) {
    $_SESSION['logged_in_accounts'] = []; // Stores usernames of logged-in accounts
    $_SESSION['current_account'] = null; // Tracks the current active account
    $_SESSION['account_id'] = null; // Tracks the ID of the current account
}

// Function to fetch account details based on the username
function fetchAccount($username)
{
    global $conn; // Use the global database connection
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = :username"); // Prepare the query
    $stmt->execute(['username' => $username]); // Execute with the provided username
    return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch and return the result as an associative array
}

// Function to add a new account to the logged-in accounts list
function addAccount($username)
{
    $account = fetchAccount($username); // Fetch account details

    if ($account) {
        // If the account is not already logged in, add it to the session list
        if (!in_array($account['username'], $_SESSION['logged_in_accounts'])) {
            $_SESSION['logged_in_accounts'][] = $account['username'];
        }
        // Set the account as the current active account
        $_SESSION['current_account'] = $account['username'];
        $_SESSION['account_id'] = $account['id'];
        return "Account added and set as current: $account[username]"; // Return success message
    } else {
        return "Account not found: $username"; // Return error if account is not found
    }
}

// Function to switch between logged-in accounts
function switchAccount($username)
{
    // Check if the specified username is already logged in
    if (in_array($username, $_SESSION['logged_in_accounts'])) {
        $account = fetchAccount($username); // Fetch account details
        $_SESSION['current_account'] = $account['username']; // Update the current active account
        $_SESSION['account_id'] = $account['id']; // Update the current account ID
        return "Switched to account: $username"; // Return success message
    } else {
        return "Account not logged in: $username"; // Return error if account is not logged in
    }
}

// Initialize a status message to provide feedback on user actions
$status_message = "";

// Handle form submissions based on the request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_account'])) {
        // Handle the addition of a new account
        $username = trim($_POST['username'] ?? ''); // Retrieve and trim the username
        if ($username) {
            $status_message = addAccount($username); // Add the account and set status message
        } else {
            $status_message = "Please enter a username."; // Prompt for missing username
        }
    } elseif (isset($_POST['switch_account'])) {
        // Handle switching to another account
        $username = $_POST['switch_account']; // Retrieve the username to switch to
        if ($username) {
            $status_message = switchAccount($username); // Switch the account and set status message
        } else {
            $status_message = "Please select an account to switch to."; // Prompt for missing username
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch Accounts</title>
    <!-- Link to external CSS for styling -->
    <link rel="stylesheet" href="Style/switchacc.css">
</head>
<body>
    <div class="container">
        <!-- Page title -->
        <h1>Switch Accounts</h1>

        <!-- Display status messages if any -->
        <?php if ($status_message): ?>
            <div class="status-message">
                <p><?php echo htmlspecialchars($status_message); ?></p>
            </div>
        <?php endif; ?>

        <!-- Form for adding an existing account -->
        <div class="form-box">
            <h2>Add Existing Account</h2>
            <form method="POST" action="switchacc.php">
                <label for="username">Select Account:</label>
                <input type="text" name="username" id="username" required placeholder="Enter username">
                <button type="submit" name="add_account">Add Account</button>
            </form>
        </div>

        <!-- Form for switching to an existing account -->
        <div class="form-box">
            <h2>Switch Account</h2>
            <form method="POST" action="switchacc.php">
                <label for="switch_account">Switch to Account:</label>
                <select name="switch_account" id="switch_account" required>
                    <?php if (count($_SESSION['logged_in_accounts']) > 0): ?>
                        <?php foreach ($_SESSION['logged_in_accounts'] as $account): ?>
                            <option value="<?php echo htmlspecialchars($account); ?>" 
                                    <?php echo ($_SESSION['current_account'] === $account) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($account); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No accounts available</option>
                    <?php endif; ?>
                </select>
                <button type="submit">Switch Account</button>
            </form>
        </div>

        <!-- Display the current account -->
        <div class="current-account-box">
            <h2>Current Account:</h2>
            <p><?php echo htmlspecialchars($_SESSION['current_account'] ?? 'None'); ?></p>
        </div>

        <!-- Link to go back to the main dashboard -->
        <div class="back-button">
            <a href="useracc.php">Back to Main</a>
        </div>
    </div>
</body>
</html>