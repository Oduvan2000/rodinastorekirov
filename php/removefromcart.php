<?php
$user = require "check_user.php";
if (!empty($user)) {
    require '../connection.php';

    $product_id = $_GET['product_id'];

    $addtocart = $db->prepare("DELETE FROM cart WHERE product_id = ? AND `user_id` = ?");
    $addtocart->execute([$product_id, $user['id']]);
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
