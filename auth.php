<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'controllers/AuthController.php';

$response_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = new AuthController();
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['register'])) {
        $response_message = $auth->register($username, $password);
    } elseif (isset($_POST['login'])) {
        $response_message = $auth->login($username, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include('partials/header.php'); ?>
    <div class="container">
        <h2>Authentification</h2>
        <?php if ($response_message): ?>
            <p class="message"><?= $response_message ?></p>
        <?php endif; ?>
    </div>
    <?php include('partials/footer.php'); ?>
</body>
</html>

