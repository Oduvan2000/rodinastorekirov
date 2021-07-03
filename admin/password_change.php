<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

// echo "<pre>";
// var_dump($_POST);

require "../connection.php";

if (!empty($_POST)) {
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);


    if ($password1 == $password2) {
        $password = md5($password1 . "rodina");
        $password_change = $db->prepare("UPDATE users SET `password` = ? WHERE id = ?");
        $password_change->execute([$password, $user['id']]);
    } else {
        echo "Введённые пароли не совпадают";
    }
    // header("Location: /admin");
}
