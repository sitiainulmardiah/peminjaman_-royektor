<?php
session_start();

$valid_username = "admin";
$valid_password = "password123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = "Username atau password salah!";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }
}
?>
 