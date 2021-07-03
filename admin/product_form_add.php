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

?>

<div class="container w-75 mb-5">
    <form class="wm-50" name="AddProduct" action="product_add.php" method="post" enctype="multipart/form-data">
        <h1>Добавить товар</h1></br>
        <input type="text" name="title_name" placeholder="Название товара" class="form-control" maxlength="50" required></br>
        <textarea type="text-area" name="description" placeholder="Описание товара" class="form-control" maxlength="300"></textarea></br>
        <input type="number" name="price" placeholder="Цена" class="form-control" min="1" max="2147483647" required></br>
        <p class="form-text text-muted">Изображение карточки товара</p>
        <input type="file" name="title_img" class="form-control-file" accept=".jpg, .jpeg" required></br>
        <p class="form-text text-muted">Изображения товаров </br> *Для выделения нескольких файлов нажмите Ctrl*
        </p>
        <input type="file" name="images[]" class="form-control-file" accept=".jpg, .jpeg" multiple required></br>
        <p class="form-text text-muted">Категория</p>
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
                    <input type="checkbox" class="form-check-input" name="sizes[XS]">
                    XS
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[S]">
                    S
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[M]">
                    M
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[L]">
                    L
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[XL]">
                    XL
                </label>
            </div>
            <div class="form-check mx-2">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="sizes[XXL]">
                    XXL
                </label>
            </div>
        </fieldset>

        <div class="form-check my-3">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="hide">
                Скрыть товар из поиска
            </label>
        </div>

        <input type="submit" name="send" value="Добавить товар" class="btn btn-primary">
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