<?php
class UserHistory {
    private $conn;
    private $account_id;

    public function __construct($db, $account_id) {
        $this->conn = $db;
        $this->account_id = $account_id;
    }

    public function clearAllHistory() {
        try {
            $query = "DELETE FROM history WHERE account_id = :account_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':account_id' => $this->account_id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteSelectedHistory($selectedIds) {
        try {
            $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));
            $query = "DELETE FROM history WHERE id IN ($placeholders) AND account_id = ?";
            $stmt = $this->conn->prepare($query);
            $params = array_merge($selectedIds, [$this->account_id]);
            $stmt->execute($params);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

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
    