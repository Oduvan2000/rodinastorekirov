<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

if (empty($_FILES['title_img']['name'][0]) && empty($_FILES['images']['name'][0])) {
    echo "Данные не отправлены";
    exit;
}

$id = $_POST['id'];
require "../connection.php";

if (!empty($_FILES['title_img'])) {
    //Получение имени текущего изображения
    $title_img = $db->prepare("SELECT `img` FROM `products` WHERE `id` = ?");
    $title_img->execute([$id]);
    $title_img = $title_img->fetch(PDO::FETCH_ASSOC);
    $title_img = $title_img['img'];

    //Замена изображения
    move_uploaded_file($_FILES['title_img']['tmp_name'], "../images/" . $title_img);
}

if (!empty($_FILES['images'])) {
    //Получение имён файлов-изображений
    $images = $db->prepare("SELECT `img` FROM `product_images` WHERE `product_id` = ?");
    $images->execute([$id]);
    $images = $images->fetchall(PDO::FETCH_ASSOC);

    //Удаление изображений
    foreach ($images as $img) {
        unlink("../images/" . $img['img']);
    }
    //Удаление записей из БД
    $images_remove = $db->prepare("DELETE FROM `product_images` WHERE `product_id` = ?");
    $images_remove->execute([$id]);

    //Сохранение изображений товара со случайными именами
    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
        $file_name = $_FILES['images']['name'][$i];
        $tmp_name = $_FILES['images']['tmp_name'][$i];

        do {
            $file_name = uniqid() . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
        } while (file_exists("../images/" . $file_name));

        $add_images = $db->prepare("INSERT INTO product_images (`product_id`, `img`) VALUES (?, ?)");
        $add_images->execute([$id, $file_name]);
        move_uploaded_file($tmp_name, "../images/" . $file_name);
    }
}

echo "<pre>";
var_dump($_FILES);
echo "</pre>";
