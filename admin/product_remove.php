<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    exit;
}

require '../connection.php';

//Файл карточки товара
$title_image = $db->prepare("SELECT img FROM products WHERE id = ?");
$title_image->execute([$id]);
$title_image = $title_image->fetch(PDO::FETCH_ASSOC);

//файлы страницы товара
$images = $db->prepare("SELECT img FROM product_images WHERE product_id = ?");
$images->execute([$id]);

$files = array($title_image['img']);

while ($img = $images->fetch(PDO::FETCH_ASSOC)) {
    $files[] = $img['img'];
}

$delete = $db->prepare("DELETE FROM products WHERE id = ?");
$delete->execute([$id]);

foreach ($files as $file) {
    unlink("../images/" . $file);
}

header('Location: /');
