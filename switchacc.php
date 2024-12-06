<?php
// Start or resume the session to track user state.
session_start();

// Include database connection file.
require 'dbconnection.php';

// Create a new Database instance and get the connection.
$db = new Database();
$conn = $db->getConnect();

// Initialize session variables for managing accounts if not already set.
if (!isset($_SESSION['logged_in_accounts'])) {
    $_SESSION['logged_in_accounts'] = []; // Array to store logged-in accounts.
    $_SESSION['current_account'] = null; // Currently active account username.
    $_SESSION['account_id'] = null;      // Currently active account ID.
}

// Function to fetch account details based on username.
function fetchAccount($username)
{
    global $conn; // Use the global database connection.

    // Prepare and execute the SQL query.
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Return the fetched result as an associative array.
}

// Function to add an account to the session and set it as the current account.
function addAccount($username)
{
    $account = fetchAccount($username); // Fetch account details.

    if ($account) {
        // Check if the account is not already logged in.
        if (!in_array($account['username'], $_SESSION['logged_in_accounts'])) {
            $_SESSION['logged_in_accounts'][] = $account['username']; // Add to logged-in accounts list.
        }
        // Set as the current account.
        $_SESSION['current_account'] = $account['username'];
        $_SESSION['account_id'] = $account['id'];
        return "Account added and set as current: $account[username]";
    } else {
        return "Account not found: $username";
    }
}

// Function to switch to a different logged-in account.
function switchAccount($username)
{
    // Check if the account is already logged in.
    if (in_array($username, $_SESSION['logged_in_accounts'])) {
        $account = fetchAccount($username); // Fetch account details.
        $_SESSION['current_account'] = $account['username']; // Set as current account.
        $_SESSION['account_id'] = $account['id'];
        return "Switched to account: $username";
    } else {
        return "Account not logged in: $username";
    }
}

// Handle form submissions.
$status_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_account'])) {
        // Handle adding a new account.
        $username = trim($_POST['username'] ?? '');
        if ($username) {
            $status_message = addAccount($username);
        } else {
            $status_message = "Please enter a username.";
        }
    } elseif (isset($_POST['switch_account'])) {
        // Handle switching accounts.
        $username = $_POST['switch_account'];
        if ($username) {
            $status_message = switchAccount($username);
        } else {
            $status_message = "Please select an account to switch to.";
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