<?php

$user = require "../php/check_user.php";
if ($user['admin'] != 1 || empty($_POST['id'])) {
    header("Location: /admin");
}

require "../connection.php";

$order_delete = $db->prepare("DELETE FROM orders WHERE id=?");
$order_delete->execute([$_POST['id']]);
