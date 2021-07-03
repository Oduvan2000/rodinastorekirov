<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

if (empty($_POST)) {
    echo "Данные не отправлены";
    exit;
}

class Product
{
    public $id;
    public $title;
    public $description;
    public $title_img;
    public $images;
    public $price;
    public $category;
    public $subcategory;
    public $sizes;
    public $hide;
}

require '../connection.php';

$product = new Product();

$product->id = $_POST['id'];
$product->title = $_POST['title_name'];
$product->description = $_POST['description'];
$product->title_img = $_FILES['title_img'];
$product->price = $_POST['price'];
$product->category = $_POST['category'];
$product->subcategory = $_POST['subcategory'];
$product->sizes = $_POST['sizes'];
$product->hide = ($_POST['hide'] == "on") ? 1 : 0;

//Ограничение по названию товара
if (strlen($product->title) < 5) {
    echo "Название товара короче 5 символов";
    exit;
}

//Обновление данных в БД
$update_product = $db->prepare("UPDATE `products` SET `title` = ?, `description` = ?, `price` = ?, `category` = ?, `subcategory` = ?, `hide` = ? WHERE `id` = ?");
$update_product->execute([$product->title, $product->description, $product->price, $product->category, $product->subcategory, $product->hide, $product->id]);

//Удаление размеров
$remove_sizes = $db->prepare("DELETE FROM product_sizes WHERE `product_id` = ?");
$remove_sizes->execute([$product->id]);

foreach (array_keys($product->sizes) as $size) {
    $add_sizes = $db->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
    $add_sizes->execute([$product->id, $size]);
}
header("Location: /product-detail.php?id=$product->id");


exit;
