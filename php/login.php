<?php
session_start();
$user = require "../php/check_user.php";
if (!empty($user)) {
    header("Location: /");
    exit;
}

if (!empty($_POST)) {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
}

header("Location: login_form.php");
