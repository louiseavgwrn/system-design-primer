<?php

class Plant {
    private $connect;
    private $table_name = "plant"; 

    public $id;
    public $name;
    public $scientific_name;
    public $region;
    public $type;
    public $latitude;
    public $longitude;
    public $description;
    
    public function __construct($db) {
        $this->connect = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, scientific_name, region, type, latitude, longitude, description)
                  VALUES (:name, :scientific_name, :region, :type, :latitude, :longitude, :description)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':latitude', $this->latitude);
        $stmt->bindParam(':longitude', $this->longitude);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, name, scientific_name, region, type, latitude, longitude, description FROM " . $this->table_name;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
                  name = :name, 
                  scientific_name = :scientific_name,
                  region = :region,
                  type = :type,
                  latitude = :latitude,
                  longitude = :longitude,
                  description = :description 
                  WHERE id = :id";

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':scientific_name', $this->scientific_name);
        $stmt->bindParam(':region', $this->region);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':latitude', $this->latitude);
        $stmt->bindParam(':longitude', $this->longitude);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
