<?php

session_start();

$user = require "../php/check_user.php";
if ($user['admin'] == 1) {
  header("Location: /admin/panel.php");
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <title>Авторизация администратора</title>
</head>

<body>

  <style>
    .form_admin {
      max-width: 500px;
      margin: auto;
      margin-top: 30px;
    }
  </style>

  <form action="login.php" class="form_admin" method="POST">
    <div class="form-group">
      <label>Логин</label>
      <input type="text" class="form-control" name="email" placeholder="Введите логин">
    </div>
    <div class="form-group">
      <label>Пароль</label>
      <input type="password" class="form-control" name="password" placeholder="Введите пароль">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
  </form>

  <?php



  ?>

</body>

</html>