<?php

//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

require "../connection.php";

$categories = $db->query("SELECT * FROM categories");
$categories = $categories->fetchall(PDO::FETCH_ASSOC);

$subcategories = $db->query("SELECT * FROM subcategories");
$subcategories = $subcategories->fetchall(PDO::FETCH_ASSOC);

?>

<div class="container-fluid w-50">
    <h2>Категории</h2>
    <select id="categories" name="category" multiple class="form-control">
        <?php
        foreach ($categories as $category) :
        ?>
            <option value="<?= $category['category'] ?>"><?= $category['category'] ?></option>
        <?php
        endforeach;
        ?>
    </select>
    <div class="text-right">
        <button id="category_remove" class="btn btn-danger mt-1">Удалить категорию</button>
    </div>

    <h2>Подкатегории</h2>
    <select id="subcategories" multiple class="form-control">
    </select>
    <div class="text-right">
        <button id="subcategory_remove" class="btn btn-danger mt-1">Удалить подкатегорию</button>
    </div>

    <hr class="my-4">

    <h4>Добавить категорию</h4>
    <input id="category_text" class="form-control mb-2" type="text" name="category" placeholder="Название категории">
    <button id="category_add" class="btn btn-primary mb-4">Добавить категорию</button>

    <h4>Добавить подкатегорию</h4>
    <input id="subcategory_text" class="form-control mb-2" type="text" name="subcategory" placeholder="Название подкатегории *Выберите категорию выше*">
    <button id="subcategory_add" class="btn btn-primary mb-4">Добавить подкатегорию</button>
    <p id="result" class="alert alert-info mb-5"></p>


    <script src="../js/jquery.min.js"></script>
    <script>
        var subcategories = '<?php echo json_encode($subcategories); ?>';
        subcategories = JSON.parse(subcategories);

        $(document).ready(function() {

            //Обновление подкатегорий
            $('#categories').change(function() {
                $("#subcategories").empty();
                subcategories.forEach(function(subcategory) {
                    if (subcategory['category'] == $("#categories").val()) {
                        $("#subcategories").append('<option value="' + subcategory['subcategory'] + '">' + subcategory['subcategory'] + '</option>');
                    }
                });
            })
            //Добавление категории
            $("#category_add").click(function() {
                $.ajax({
                    type: "POST",
                    url: "category_add.php",
                    data: {
                        category: $("#category_text").val()
                    },
                    dataType: "html",
                    success: function(result) {
                        $("#result").html(result);
                        $(document).scrollTop($(document).height());
                        if (!$('#categories > option[value=' + $("#category_text").val() + ']').length) {
                            $("#categories").append('<option value="' + $("#category_text").val() + '">' +
                                $("#category_text").val() + '</option>');
                        }
                    }
                });
            })
            //Добавление подкатегории
            $("#subcategory_add").click(function() {
                $.ajax({
                    type: "POST",
                    url: "subcategory_add.php",
                    data: {
                        category: $("#categories").val()[0],
                        subcategory: $("#subcategory_text").val(),
                    },
                    dataType: "html",
                    success: function(result) {
                        $("#result").html(result);
                        $(document).scrollTop($(document).height());
                        if (!$('#subcategories > option[value=' + $("#subcategory_text").val() + ']').length) {
                            $("#subcategories").append('<option value="' + $("#subcategory_text").val() + '">' +
                                $("#subcategory_text").val() + '</option>');
                        }
                    }
                });
            })
            //Удаление категории
            $("#category_remove").click(function() {
                $.ajax({
                    type: "POST",
                    url: "category_remove.php",
                    data: {
                        category: $("#categories").val()[0]
                    },
                    dataType: "html",
                    success: function(result) {
                        $("#result").html(result);
                        $(document).scrollTop($(document).height());
                        $('#categories option:selected').remove();
                        $("#subcategories").empty();
                    }
                });

            })

            $("#subcategory_remove").click(function() {
                $.ajax({
                    type: "POST",
                    url: "subcategory_remove.php",
                    data: {
                        category: $("#categories").val()[0],
                        subcategory: $("#subcategories").val()[0]
                    },
                    dataType: "html",
                    success: function(result) {
                        $("#result").html(result);
                        $('#subcategories option:selected').remove();
                    }
                });
            })
        });
    </script>