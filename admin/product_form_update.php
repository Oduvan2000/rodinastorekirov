<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

require "../connection.php";

$categories = $db->prepare("SELECT * FROM categories");
$categories->execute();
$categories = $categories->fetchall(PDO::FETCH_ASSOC);

$subcategories = $db->prepare("SELECT * FROM subcategories");
$subcategories->execute();
$subcategories = $subcategories->fetchall(PDO::FETCH_ASSOC);


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    $id = 1;
}

$sizes = $db->prepare("SELECT size FROM `product_sizes` WHERE `product_id` = ?");
$sizes->execute([$id]);
$sizes_list = $sizes->fetchall(PDO::FETCH_ASSOC);

$sizes = [];

foreach ($sizes_list as $size) {
    array_push($sizes, $size['size']);
}

//Запрос информации о товаре
$product = $db->prepare("SELECT * FROM `products` WHERE `id` = ?");
$product->execute([$id]);
$product = $product->fetch(PDO::FETCH_ASSOC);

$images = $db->prepare("SELECT `img` FROM `product_images` WHERE `product_id` = ?");
$images->execute([$id]);
$images = $images->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Редактирование товара</title>
</head>

<div class="container w-75 my-5">

    <form class="wm-50" name="AddProduct" action="product_update.php" method="post" enctype="multipart/form-data">
        <h1>Редактирование товара</h1></br>
        <p class="form-text text-muted">id товара</p>
        <input type="text" name="id" class="form-control w-25 mb-3" value="<?= $id ?>" readonly>
        <input type="text" name="title_name" placeholder="Название товара" class="form-control" maxlength="50" required value="<?= $product['title'] ?>"></br>
        <textarea type="text-area" name="description" placeholder="Описание товара" class="form-control" maxlength="300"><?= $product['description'] ?></textarea></br>
        <input type="number" name="price" placeholder="Цена" class="form-control" min="1" max="2147483647" required value="<?= $product['price'] ?>">

        <p class="form-text text-muted mt-4">Категория</p>
        <select class="form-control" name="category" id="categories">

            <?php
            foreach ($categories as $category) :
            ?>
                <option value="<?= $category['category'] ?>"><?= $category['category'] ?></option>
            <?php
            endforeach;
            ?>
        </select> </br>
        <p class="form-text text-muted">Подкатегория</p>
        <select class="form-control mb-4" name="subcategory" id="subcategories" name="subcategory">
        </select>

        <h6 class="form-text text-muted">Размеры</h6>
        <fieldset class="form-group row">
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[XS]" <?= in_array("XS", $sizes) ? "checked" : "" ?>>
                    XS
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[S]" <?= in_array("S", $sizes) ? "checked" : "" ?>>
                    S
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[M]" <?= in_array("M", $sizes) ? "checked" : "" ?>>
                    M
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[L]" <?= in_array("L", $sizes) ? "checked" : "" ?>>
                    L
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[XL]" <?= in_array("XL", $sizes) ? "checked" : "" ?>>
                    XL
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[XXL]" <?= in_array("XXL", $sizes) ? "checked" : "" ?>>
                    XXL
                </label>
            </div>
        </fieldset>

        <div class="form-check my-3">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="hide" <?= ($product['hide'] == 1) ? "checked" : "" ?>>
                Скрыть товар из поиска
            </label>
        </div>

        <input type="submit" name="send" value="Сохранить изменения" class="btn btn-primary">
    </form>

    <form action="product_files_update.php" method="post" enctype="multipart/form-data" class="mt-5">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <p class="form-text text-muted">Изображение карточки товара</p>
        <?php
        echo '<a href="/images/' . $product['img'] . '" target="_blank" rel="noopener noreferrer">' . $product['img'] . '</a>';
        ?>
        <input id="title-img" type="file" name="title_img" class="form-control-file" accept=".jpg, .jpeg">
        <span class="text-danger"><small> *При выборе файла и сохранении изменений, предыдущее изображение будет удалено</small></span><br>
        <p class="form-text text-muted mt-4">Изображения товаров </> *Для выделения нескольких файлов нажмите Ctrl*</p>
        <?php
        foreach ($images as $img) :
        ?>
            <div class="w-25">
                <a href="/images/<?= $img['img'] ?>" target="_blank"><?= $img['img'] ?></a><br>
            </div>
        <?php
        endforeach;
        ?>
        <input type="file" name="images[]" class="form-control-file" accept=".jpg, .jpeg" multiple>
        <span class="text-danger"><small> *При выборе файлов и сохранении изменений, все предыдущие изображения будут удалены</small></span><br>
        <input type="submit" value="Сохранить изображения" class="btn btn-primary mt-3">
    </form>
</div>


<script src="../js/jquery.min.js"></script>
<script>
    var subcategories = '<?php echo json_encode($subcategories); ?>';
    subcategories = JSON.parse(subcategories);

    $(document).ready(function() {
        $("#subcategories").empty();
        subcategories.forEach(function(subcategory) {
            if (subcategory['category'] == $("#categories").val()) {
                $("#subcategories").append('<option value="' + subcategory['subcategory'] + '">' + subcategory['subcategory'] + '</option>');
            }
        });

        //Отметка категории товара
        $('#categories option[value=<?= $product['category'] ?>]').prop('selected', true);
        $('#subcategories option[value=<?= $product['subcategory'] ?>]').prop('selected', true);

        //Обновление подкатегорий
        $('#categories').change(function() {
            $("#subcategories").empty();
            subcategories.forEach(function(subcategory) {
                if (subcategory['category'] == $("#categories").val()) {
                    $("#subcategories").append('<option value="' + subcategory['subcategory'] + '">' + subcategory['subcategory'] + '</option>');
                }
            });
        })
    })
</script>