<?php
include_once '../controllers/ResultController.php';

$resultController = new ResultController();
$result_set = $resultController->getResults();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <?php include('../partials/header.php'); ?>
    <div class="container">
        <h2>Résultats des votes</h2>
        <div id="results" class="results">
            <?php
            while ($row = $result_set->fetch(PDO::FETCH_ASSOC)) {
                echo "<p>" . htmlspecialchars($row['name']) . ": " . htmlspecialchars($row['votes']) . " votes</p>";
            }
            ?>
        </div>
    </div>
    <?php include('../partials/footer.php'); ?>
</body>
</html>
