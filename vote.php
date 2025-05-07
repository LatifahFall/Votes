<?php
session_start();
include_once '../config.php';
include_once '../models/Vote.php';
include_once '../models/Candidate.php';
include_once '../controllers/VoteController.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

class VoteHandler {
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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vote</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <script src="../js/ajax.js"></script>
</head>
<body>
    <?php include('../partials/header.php'); ?>
    <div class="container">
        <h2>Vote pour vos candidats préférés</h2>
        <form action="../selectedCandidates.php" method="post" class="vote-form">
            <div class="candidates">
                <?php
                $voteHandler = new VoteHandler();
                $candidates = $voteHandler->getAllCandidates();

                while ($row = $candidates->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <div class='candidate-card'>
                        <label>
                            <input type='checkbox' name='candidate_ids[]' value='" . $row['id'] . "'>
                            <div class='candidate-info'>
                                <h3>" . $row['name'] . "</h3>
                                <p>" . $row['description'] . "</p>
                            </div>
                        </label>
                    </div>";
                }
                ?>
            </div>
            <input type="submit" name="vote" value="Voter" class="button">
        </form>
    </div>
    <?php include('../partials/footer.php'); ?>
</body>
</html>
