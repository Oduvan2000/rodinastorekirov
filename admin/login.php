<?php

$user = require "../php/check_user.php";
if ($user['admin'] == 1) {
    header("Location: /admin");
    exit;
}

if (!empty($_POST)) {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
}

header("Location: /admin");
