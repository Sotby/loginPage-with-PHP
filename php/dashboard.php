<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

echo "Bem-vindo, " . $_SESSION['username'];
?>

<a href="logout.php">Logout</a>
