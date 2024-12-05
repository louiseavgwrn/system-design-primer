<?php
session_start();
require 'dbswitch.php';

$db = new Database();
$conn = $db->getConnect();

// Initialize session variables if not already set
if (!isset($_SESSION['logged_in_accounts'])) {
    $_SESSION['logged_in_accounts'] = [];
    $_SESSION['current_account'] = null;
    $_SESSION['account_id'] = null;  // Initialize account_id
}

function fetchAccount($username)
{
    global $conn;

    // Fetch account ID from the users table based on the username
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addAccount($username)
{
    $account = fetchAccount($username);

    if ($account) {
        // If the account exists and is not already in the logged-in accounts list
        if (!in_array($account['username'], $_SESSION['logged_in_accounts'])) {
            $_SESSION['logged_in_accounts'][] = $account['username'];
        }
        // Set the current account and update account_id in the session
        $_SESSION['current_account'] = $account['username'];
        $_SESSION['account_id'] = $account['id'];
        return "Account added and set as current: $account[username]";
    } else {
        return "Account not found: $username";
    }
}

function switchAccount($username)
{
    if (in_array($username, $_SESSION['logged_in_accounts'])) {
        // Fetch account details to update session with the correct account ID
        $account = fetchAccount($username);
        $_SESSION['current_account'] = $account['username'];
        $_SESSION['account_id'] = $account['id'];
        return "Switched to account: $username";
    } else {
        return "Account not logged in: $username";
    }
}

$status_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_account'])) {
        $username = trim($_POST['username'] ?? '');
        if ($username) {
            $status_message = addAccount($username);
        } else {
            $status_message = "Please enter a username.";
        }
    } elseif (isset($_POST['switch_account'])) {
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
    <link rel="stylesheet" href="Style/switchacc.css">
</head>
<body>
    <div class="container">
        <h1>Switch Accounts</h1>

        <?php if ($status_message): ?>
            <div class="status-message">
                <p><?php echo htmlspecialchars($status_message); ?></p>
            </div>
        <?php endif; ?>

        <div class="form-box">
            <h2>Add Existing Account</h2>
            <form method="POST" action="switchacc.php">
                <label for="username">Select Account:</label>
                <input type="text" name="username" id="username" required placeholder="Enter username">
                <button type="submit" name="add_account">Add Account</button>
            </form>
        </div>

        <div class="form-box">
            <h2>Switch Account</h2>
            <form method="POST" action="switchacc.php">
                <label for="switch_account">Switch to Account:</label>
                <select name="switch_account" id="switch_account" required>
                    <?php if (count($_SESSION['logged_in_accounts']) > 0): ?>
                        <?php foreach ($_SESSION['logged_in_accounts'] as $account): ?>
                            <option value="<?php echo htmlspecialchars($account); ?>" <?php echo ($_SESSION['current_account'] === $account) ? 'selected' : ''; ?>>
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

        <div class="current-account-box">
            <h2>Current Account:</h2>
            <p><?php echo htmlspecialchars($_SESSION['current_account'] ?? 'None'); ?></p>
        </div>

        <div class="back-button">
            <a href="useracc.php">Back to Main</a>
        </div>
    </div>
</body>
</html>
