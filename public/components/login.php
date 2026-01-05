<?php

require_once 'connection.php';

session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $errorMessage = '';

    if ($user) {
        if ($password == $user['password']) {
            $_SESSION["username"] = $username;
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['errorMessage'] = "Password is wrong";
            header('Location: ../index.php');
            exit;
        }
    } else {
        $_SESSION['errorMessage'] = "Username does not exist";
        header('Location: ../index.php');
        exit;
    }

}
?>
