<?php

//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

if (!empty($_POST['category'] && !empty($_POST['subcategory']))) {
    $category = trim($_POST['category']);
    $subcategory = trim($_POST['subcategory']);
} else {
    exit;
}


require "../connection.php";

$subcategory_add = $db->prepare("INSERT INTO subcategories (category, subcategory) VALUES (?,?)");
$subcategory_add->execute([$category, $subcategory]);
echo "Подкатегория \"" . $_POST['subcategory'] . "\" добавлена в категорию \"" . $category . "\"";
