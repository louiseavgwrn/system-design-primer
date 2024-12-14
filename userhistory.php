<?php
class UserHistory {
    private $conn; // Database connection
    private $account_id; // Account ID associated with the user

    // Constructor to initialize the database connection and account ID
    public function __construct($db, $account_id) {
        $this->conn = $db;
        $this->account_id = $account_id;
    }

    // Method to clear all history for the given account
    public function clearAllHistory() {
        try {
            $query = "DELETE FROM history WHERE account_id = :account_id"; // SQL query to delete all history for the account
            $stmt = $this->conn->prepare($query); // Prepare the SQL statement
            $stmt->execute([':account_id' => $this->account_id]); // Execute with the account ID parameter
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display error message if exception occurs
        }
    }

    // Method to delete selected history records based on IDs
    public function deleteSelectedHistory($selectedIds) {
        try {
            // Create placeholders for the selected IDs
            $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));
            $query = "DELETE FROM history WHERE id IN ($placeholders) AND account_id = ?"; // SQL query to delete specific records
            $stmt = $this->conn->prepare($query); // Prepare the SQL statement
            $params = array_merge($selectedIds, [$this->account_id]); // Combine IDs and account ID for parameters
            $stmt->execute($params); // Execute with parameters
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display error message if exception occurs
        }
    }

    // Method to fetch all history for the given account
    public function fetchHistory() {
        try {
            $query = "SELECT * FROM history WHERE account_id = :account_id"; // SQL query to fetch history
            $stmt = $this->conn->prepare($query); // Prepare the SQL statement
            $stmt->execute([':account_id' => $this->account_id]); // Execute with the account ID parameter
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch and return results as an associative array
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display error message if exception occurs
        }
    }
}
?>
