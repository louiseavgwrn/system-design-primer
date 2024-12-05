<?php
session_start();
require 'dbswitch.php';


$db = new Database();
$conn = $db->getConnect();


if (!isset($_SESSION['logged_in_accounts'])) {
    $_SESSION['logged_in_accounts'] = [];
    $_SESSION['current_account'] = null;
}

function fetchAccount($username)
{
    global $conn;

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetchColumn();
}


function addAccount($username)
{
    $account = fetchAccount($username);

    if ($account) {
        if (!in_array($account, $_SESSION['logged_in_accounts'])) {
            $_SESSION['logged_in_accounts'][] = $account;
        }
        $_SESSION['current_account'] = $account; 
        return "Account added and set as current: $account";
    } else {
        return "Account not found: $username";
    }
}


function switchAccount($username)
{
    if (in_array($username, $_SESSION['logged_in_accounts'])) {
        $_SESSION['current_account'] = $username;
        return "Switched to account: $username";
    } else {
        return "Account not logged in: $username";
    }
}


$status_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_account'])) {
        $username = trim($_POST['username'] ?? '');
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
                    <?php foreach ($_SESSION['logged_in_accounts'] as $account): ?>
                        <option value="<?php echo htmlspecialchars($account); ?>" <?php echo ($_SESSION['current_account'] === $account) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($account); ?>
                        </option>
                    <?php endforeach; ?>
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
