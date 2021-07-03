<?php
$user = require "../php/check_user.php";
if (!empty($user)) {
    header("Location: /");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Авторизация</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <img src="/images/logo.svg" class="rounded mx-auto d-block w-100 my-5">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Введите свой Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Введите пароль">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" class="form-control" value="Войти">
                        <a href="/" class=" btn btn-dark float-right">Назад</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>