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
//Ограничение по типу файла карточки товара

if ($_FILES['title_img']['type'] != "image/jpeg") {
    echo "Файл изображения карточки товара не является картинкой
     или тип файла не поддерживается. </br> Загруженный тип файла: " . $_FILES['title_img']['type'];
    exit;
}
//Ограничение по типу файлов изображений товара
foreach ($_FILES['images']['type'] as $type) {
    if ($type != "image/jpeg") {
        echo "Один или несколько файлов не являются изображениями
         или их тип не поддерживается. </br> Загруженный тип файла: " . $type['type'];
        exit;
    }
}


//Сохранение изображения карточки товара со случайным именем
$img = $_FILES['title_img'];
do {
    $product->title_img['name'] = uniqid() . '.' . pathinfo($img['name'], PATHINFO_EXTENSION);
} while (file_exists("../images/" . $product->title_img['name']));

//Добавление данных в БД
$add_product = $db->prepare("INSERT INTO `products` (`title`, `description`, `price`, `img`, `category`, `subcategory`, `hide`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$add_product->execute([$product->title, $product->description, $product->price, $product->title_img['name'], $product->category, $product->subcategory, $product->hide]);

move_uploaded_file($product->title_img['tmp_name'], "../images/" . $product->title_img['name']);
$lastid = $db->lastInsertId();

//Сохранение изображений товара со случайными именами
for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
    $file_name = $_FILES['images']['name'][$i];
    $tmp_name = $_FILES['images']['tmp_name'][$i];

    do {
        $file_name = uniqid() . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
    } while (file_exists("../images/" . $file_name));

    $add_images = $db->prepare("INSERT INTO product_images (`product_id`, `img`) VALUES (?, ?)");
    $add_images->execute([$lastid, $file_name]);
    move_uploaded_file($tmp_name, "../images/" . $file_name);
}

foreach (array_keys($product->sizes) as $size) {
    $add_sizes = $db->prepare("INSERT INTO product_sizes (product_id, size) VALUES (?, ?)");
    $add_sizes->execute([$lastid, $size]);
}
header("Location: /");
