<?php
session_start();
include_once '../config.php';
include_once '../models/Vote.php';
include_once '../models/Candidate.php';

class VoteController {
    private $db;
    private $vote;
    private $candidate;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->vote = new Vote($this->db);
        $this->candidate = new Candidate($this->db);
    }

    public function getAllCandidates() {
        return $this->candidate->getAll();
    }

    public function createVote($user_id, $candidate_ids) {
        $this->vote->user_id = $user_id;
        foreach ($candidate_ids as $candidate_id) {
            $this->vote->candidate_id = $candidate_id;
            $this->vote->create();
        }
        return "Vote enregistré avec succès.";
    }

    public function getVotedCandidates($user_id) {
        $query = "SELECT c.name, c.description FROM votes v LEFT JOIN candidates c ON v.candidate_id = c.id WHERE v.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt;
    }

    public function getResults() {
        return $this->vote->getResults();
    }
}
?>

