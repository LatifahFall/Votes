<?php
class Vote {
    private $conn;
    private $table_name = "votes";

    public $id;
    public $user_id;
    public $candidate_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, candidate_id) VALUES (:user_id, :candidate_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":candidate_id", $this->candidate_id);

        return $stmt->execute();
    }

    public function getResults() {
        $query = "SELECT c.name, COUNT(v.id) as votes FROM " . $this->table_name . " v LEFT JOIN candidates c ON v.candidate_id = c.id GROUP BY v.candidate_id ORDER BY votes DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>

