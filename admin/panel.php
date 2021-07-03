<?php

//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <title>Панель администратора</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <a class="navbar-brand" href="#">Панель администратора</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="product_form" class="nav-link" href="#">Добавление товара</a>
                </li>
                <li class="nav-item">
                    <a id="categories_form" class="nav-link" href="#">Категории и подкатегории</a>
                </li>
                <li class="nav-item">
                    <a id="orders_form" class="nav-link" href="#">Заказы</a>
                </li>
                <li class="nav-item">
                    <a id="settings_form" class="nav-link" href="#">Настройки</a>
                </li>

            </ul>
        </div>
        <a class="pull-right" href="/">
            <button type="button" class="btn btn-primary mr-3">Вернуться на сайт магазина</button>
        </a>
        <a class="pull-right" href="../php/logout.php">
            <button type="button" class="btn btn-secondary">Выход</button>
        </a>
    </nav>

    <div id="content" class="content">

    </div>

    <script src="../js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: "orders_form.php",
                dataType: "html",
                success: function(response) {
                    $("#content").html(response);
                }
            });

            //Форма категорий
            $("#categories_form").click(function UpdateCategories() {
                $.ajax({
                    url: "categories_form.php",
                    dataType: "html",
                    success: function(response) {
                        $("#content").html(response);
                    }
                });
            })
            //Форма добавления товара
            $("#product_form").click(function UpdateCategories() {
                $.ajax({
                    url: "product_form_add.php",
                    dataType: "html",
                    success: function(response) {
                        $("#content").html(response);
                    }
                });
            })
            //Форма заказов
            $("#orders_form").click(function() {
                $.ajax({
                    url: "orders_form.php",
                    dataType: "html",
                    success: function(response) {
                        $("#content").html(response);
                    }
                });
            })

            $("#settings_form").click(function() {
                $.ajax({
                    url: "settings_form.php",
                    dataType: "html",
                    success: function(response) {
                        $("#content").html(response);
                    }
                });
            })

        });
    </script>

</body>


</html>