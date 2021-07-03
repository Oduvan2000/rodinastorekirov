<?php

header("Location: /order-complete.php");

$user = require "check_user.php";

if (empty($_POST)) {
    exit;
}

require "../connection.php";

$order_add = $db->prepare("INSERT INTO orders (`name`, phone, postal_code, `date`, city, street, house, apartment, `user_id`) VALUES (?,?,?,?,?,?,?,?,?)");
$order_add->execute([$_POST['name'], $_POST['phone'], $_POST['postal_code'], date('Y-m-d H:i'), $_POST['city'], $_POST['street'], $_POST['house'], $_POST['apartment'], $user['id']]);

$last_order_id = $db->lastInsertId();

$cart = $db->query("SELECT product_id, size, `count` FROM cart WHERE `user_id` = $user[id]");
$cart = $cart->fetchAll(PDO::FETCH_ASSOC);

foreach ($cart as $product) {
    $order_product_add = $db->prepare("INSERT INTO order_products (order_id, product, size, `count`) VALUES (?, ?, ?, ?)");
    $order_product_add->execute([$last_order_id, $product['product_id'], $product['size'], $product['count']]);
}
