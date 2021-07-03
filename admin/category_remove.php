<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

if (!empty($_POST['category'])) {
    require "../connection.php";

    $category = $db->prepare("DELETE FROM categories WHERE category = ?");
    $category->execute([$_POST['category']]);
    echo "Категория \"" . $_POST['category'] . "\" удалена";
}
