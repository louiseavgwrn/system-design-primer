<?php
class Database {
    private $host = "localhost";
    private $db_name = "tree_history"; 
    private $username = "root";
    private $password = "";
    public $connect;

    public function getConnect() {
        $this->connect = null;
        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection Error: " . $exception->getMessage();
        }
        return $this->connect;
    }
}
?>
