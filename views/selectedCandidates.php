<?php
session_start();
include_once '../config.php';
include_once '../models/Vote.php';
include_once '../models/Candidate.php';
include_once '../controllers/VoteController.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$voteHandler = new VoteController();
$user_id = $_SESSION['id'];
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif des Votes</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <script src="../js/ajax.js"></script>
</head>
<body>
    <?php include('../partials/header.php'); ?>
    <div class="container">
        <h2>Récapitulatif des Votes</h2>
        <?php if ($message): ?>
            <p class='message'><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <div class="candidates">
            <h3>Candidats votés :</h3>
            <?php
            $votedCandidates = $voteHandler->getVotedCandidates($user_id);

            while ($row = $votedCandidates->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='candidate-card'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="button-container">
            <a href="results.php" class="button" onmouseover="viewResults()">Consulter les résultats en temps réel</a>
            <a href="../pdf_generate.php" class="button" target="_blank">Reçu de vote</a>
        </div>
        <div id="results" class="results"></div>
    </div>
    <?php include('../partials/footer.php'); ?>
</body>
</html>
