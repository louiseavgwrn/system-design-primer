<?php
class Plant {
    private $connect;
    private $table_name = "plant";  // Name of the table in the database

    // Public properties to store plant data
    public $id;
    public $name;
    public $scientific_name;
    public $region;
    public $type;
    public $description;
    public $account_id; // Linked to the logged-in user's account ID

    // Constructor accepts the database connection
    public function __construct($db) {
        $this->connect = $db;
    }

    // Create a new plant record in the database
    public function create() {
        // Get the account ID from the session
        $this->account_id = $_SESSION['account_id'];

        // Prepare SQL query for inserting a new plant record
        $query = "INSERT INTO " . $this->table_name . " (name, scientific_name, region, type, description, account_id)
                  VALUES (:name, :scientific_name, :region, :type, :description, :account_id)";
        $stmt = $this->connect->prepare($query);

        // Bind the properties to the query parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':account_id', $this->account_id);

        // Execute the query and return success or failure
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Retrieve plant records for the logged-in user
    public function read() {
        // Get the account ID from the session
        $this->account_id = $_SESSION['account_id'];

        // Prepare SQL query to fetch plants associated with the user's account ID
        $query = "SELECT id, name, scientific_name, region, type, description FROM " . $this->table_name . " WHERE account_id = :account_id";
        $stmt = $this->connect->prepare($query);

        // Bind the account ID to the query
        $stmt->bindParam(':account_id', $this->account_id);

        // Execute the query and return the result set
        $stmt->execute();
        return $stmt;
    }

    // Update an existing plant record
    public function update() {
        // Prepare SQL query for updating the plant record
        $query = "UPDATE " . $this->table_name . " SET 
                  name = :name, 
                  scientific_name = :scientific_name,
                  region = :region,
                  type = :type,
                  description = :description 
                  WHERE id = :id AND account_id = :account_id"; 

        $stmt = $this->connect->prepare($query);

        // Bind the properties to the query parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':account_id', $this->account_id);

        // Execute the query and return success or failure
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a plant record
    public function delete() {
        // Prepare SQL query for deleting the plant record
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND account_id = :account_id"; 
        $stmt = $this->connect->prepare($query);

        // Bind the plant ID and account ID to the query
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':account_id', $this->account_id);

        // Execute the query and return success or failure
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
