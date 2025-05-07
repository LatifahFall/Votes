<?php
session_start();
include_once 'config.php';
include_once 'models/Vote.php';
include_once 'models/Candidate.php';
include_once 'controllers/VoteController.php';

if (!isset($_SESSION['id'])) {
    header("Location: views/login.html");
    exit();
}

$voteHandler = new VoteController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $candidate_ids = $_POST['candidate_ids'];
    if (count($candidate_ids) > 3) {
        $message = "Vous ne pouvez voter que pour un maximum de trois candidats.";
    } else {
        $message = $voteHandler->createVote($user_id, $candidate_ids);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif des Votes</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/ajax.js"></script>
</head>
<body>
    <?php include('partials/header.php'); ?>
    <div class="container">
        <h2>Récapitulatif des Votes</h2>
        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }
        ?>
        <div class="candidates">
            <h3>Candidats votés :</h3>
            <?php
            $votedCandidates = $voteHandler->getVotedCandidates($user_id);

            while ($row = $votedCandidates->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='candidate-card'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="button-container">
            <a href="results.php" class="button" onmouseover="viewResults()">Consulter les résultats en temps réel</a>
            <a href="pdf_generate.php" class="button" target="_blank">Reçu de vote</a>
        </div>
        <div id="results" class="results"></div>
    </div>
    <?php include('partials/footer.php'); ?>
</body>
</html>
