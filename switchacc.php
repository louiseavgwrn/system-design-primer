<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'green_guardians';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize session variables
if (!isset($_SESSION['logged_in_accounts'])) {
    $_SESSION['logged_in_accounts'] = [];
    $_SESSION['current_account'] = null;
}

// Fetch an account from the database
function fetchAccount($username)
{
    global $conn;

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetchColumn();
}

// Add an existing account to the session
function addAccount($username)
{
    $account = fetchAccount($username);

    if ($account) {
        if (!in_array($account, $_SESSION['logged_in_accounts'])) {
            $_SESSION['logged_in_accounts'][] = $account;
        }
        $_SESSION['current_account'] = $account; // Set as current account
        return "Account added and set as current: $account";
    } else {
        return "Account not found: $username";
    }
}

// Switch to an account already in the session
function switchAccount($username)
{
    if (in_array($username, $_SESSION['logged_in_accounts'])) {
        $_SESSION['current_account'] = $username;
        return "Switched to account: $username";
    } else {
        return "Account not logged in: $username";
    }
}

// Handle POST requests
$status_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_account'])) {
        $username = $_POST['username'] ?? '';
        $status_message = addAccount($username);
    } elseif (isset($_POST['switch_account'])) {
        $username = $_POST['switch_account'];
        $status_message = switchAccount($username);
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

        <!-- Status Message -->
        <?php if ($status_message): ?>
            <div class="status-message">
                <p><?php echo $status_message; ?></p>
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
                    <?php foreach ($_SESSION['logged_in_accounts'] as $account): ?>
                        <option value="<?php echo $account; ?>" <?php echo ($_SESSION['current_account'] === $account) ? 'selected' : ''; ?>>
                            <?php echo $account; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Switch Account</button>
            </form>
        </div>

        <div class="current-account-box">
            <h2>Current Account:</h2>
            <p><?php echo $_SESSION['current_account'] ?? 'None'; ?></p>
        </div>

        <!-- Back Button -->
        <div class="back-button">
            <a href="useracc.php">Back to Main</a>
        </div>
    </div>
</body>
</html>
