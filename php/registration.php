<?php

if (empty($_POST)) {
    echo "Ошибка: Данные не получены";
    exit;
}

$email = $_POST['email'];
$name = $_POST['name'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if (empty($email)) {
    echo "Введите Email";
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email некоректен";
    exit;
}
if (empty($name)) {
    echo "Введите имя";
    exit;
}
if (empty($password1)) {
    echo "Введите пароль";
    exit;
}
if (empty($password2)) {
    echo "Введите повторите пароль";
    exit;
}
if ($password1 != $password2) {
    echo "Введённые пароли не совпадают";
    exit;
}

require("../connection.php");

$check_email = $db->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
$check_email->execute([$email]);
$count = $check_email->rowCount();

if ($count == 0) {
    $user_add = $db->prepare("INSERT INTO `users` (`email`, `nickname`, `password`) VALUES (?, ?, ?)");
    $user_add->execute([$email, $name, md5($password1 . "rodina")]);
    echo 'Успешная регистрация! Перейдите в окно <a href= "login_form.php"><b>Авторизация</b></a>';
} else {
    echo "Аккаунт с таким Email уже существует";
}
