<?php

//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

if (!empty($_POST['category'] && !empty($_POST['subcategory']))) {
    require "../connection.php";

    $category = $db->prepare("DELETE FROM subcategories WHERE category = ? AND subcategory = ?");
    $category->execute([$_POST['category'], $_POST['subcategory']]);
    echo "Подкатегория \"" . $_POST['subcategory'] . "\" в категории \"" . $_POST['category'] . "\" была успешно удалена";
}
