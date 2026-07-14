<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'Buyer') {
    header('Location: login.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity < 1) {
        $quantity = 1;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] += $quantity;
    } else {
        $_SESSION['cart'][$item_id] = $quantity;
    }
}

header('Location: item.php?id=' . urlencode($_POST['item_id']) . '&added=1');
exit;
?>