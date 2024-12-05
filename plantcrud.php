<?php


class Plant {
    private $connect;
    private $table_name = "plant"; 

    public $id;
    public $name;
    public $scientific_name;
    public $region;
    public $type;
    public $description;
    public $account_id; // New property to associate the plant with an account

    public function __construct($db) {
        $this->connect = $db;
    }

    // Create a new plant
    public function create() {
        $this->account_id = $_SESSION['account_id'];

        $query = "INSERT INTO " . $this->table_name . " (name, scientific_name, region, type, description, account_id)
                  VALUES (:name, :scientific_name, :region, :type, :description, :account_id)";
        $stmt = $this->connect->prepare($query);
    
        // Bind the parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':account_id', $this->account_id); // Ensure account_id is bound

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all plants for a specific user
    public function read() {
        $this->account_id = $_SESSION['account_id'];  // Ensure account_id is set from session
        $query = "SELECT id, name, scientific_name, region, type, description FROM " . $this->table_name . " WHERE account_id = :account_id";
        $stmt = $this->connect->prepare($query);

        // Bind account_id to the query
        $stmt->bindParam(':account_id', $this->account_id);

        $stmt->execute();
        return $stmt;
    }

    // Update an existing plant
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
                  name = :name, 
                  scientific_name = :scientific_name,
                  region = :region,
                  type = :type,
                  description = :description 
                  WHERE id = :id AND account_id = :account_id"; 

        $stmt = $this->connect->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':account_id', $this->account_id); // Bind account_id to the query

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a plant by id and account_id
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND account_id = :account_id"; 
        $stmt = $this->connect->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':account_id', $this->account_id); 

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
