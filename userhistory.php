<?php
class UserHistory {
    private $conn;
    private $account_id;

    // Constructor accepts the database connection and account ID
    public function __construct($db, $account_id) {
        $this->conn = $db;
        $this->account_id = $account_id;
    }

    // Clear all history for the current user
    public function clearAllHistory() {
        try {
            $query = "DELETE FROM history WHERE account_id = :account_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':account_id' => $this->account_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete selected history records for the current user
    public function deleteSelectedHistory($selectedIds) {
        try {
            $selectedIds = implode(',', array_map('intval', $selectedIds));
            $query = "DELETE FROM history WHERE id IN ($selectedIds) AND account_id = :account_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':account_id' => $this->account_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Fetch all history records for the current user
    public function fetchHistory() {
        try {
            $query = "SELECT * FROM history WHERE account_id = :account_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':account_id' => $this->account_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
