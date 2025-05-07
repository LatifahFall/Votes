<?php
include_once '../config.php';
include_once '../models/Vote.php';

class ResultController {
    private $db;
    private $vote;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->vote = new Vote($this->db);
    }

    public function getResults() {
        return $this->vote->getResults();
    }
}
?>

