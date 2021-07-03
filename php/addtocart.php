<?php
$user = require "check_user.php";
if (!empty($user)) {
    require '../connection.php';

    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $count = $_POST['count'];

    $addtocart = $db->prepare("INSERT INTO cart (`user_id`, product_id, size, `count`) VALUES (?, ?, ?, ?)");
    $addtocart->execute([$user['id'], $product_id, $size, $count]);
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
