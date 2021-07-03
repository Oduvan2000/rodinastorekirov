<?php
header("Location: /orders.php");

$user = require "check_user.php";

$id = $_GET['id'];

if (empty($id) || empty($user)) {
    exit;
}

require "../connection.php";

$order_delete = $db->prepare("DELETE FROM orders WHERE id = ? AND `user_id` = ?");
$order_delete->execute([$id, $user['id']]);
