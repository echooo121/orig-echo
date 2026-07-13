<?php
session_start();
require('db(be).php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header('Location: login.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);
    $newType = $_POST['new_type'];

    $allowedTypes = ['Admin', 'Buyer'];
    if (in_array($newType, $allowedTypes)) {
        $sql = "UPDATE users SET user_type = '$newType' WHERE user_id = '$userId'";
        mysqli_query($conn, $sql);
    }
}

header('Location: manage_users.php');
exit;
?>