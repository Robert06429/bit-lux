<?php

require_once '../connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION["username"] = $username;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username =:username");
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$errorMessage = '';

if ($user) {
    if ($password === $user['password']) {
        header("Location: home.php");
        exit;
    } else {
        $errorMessage = "Password is wrong";
    }
} else {
    $errorMessage = "Username does not exist";
}

$_SESSION['errorMessage'] = $errorMessage;
header('index.php');

?>