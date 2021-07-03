<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

$category = trim($_POST['category']);

if (!empty($category)) {
    require "../connection.php";

    $category_add = $db->prepare("INSERT INTO categories (category) VALUES (?)");
    $category_add->execute([$category]);
    echo "Категория \"" . $category . "\" успешно добавлена";
}
