<?php
session_start();

require(__DIR__ . "/../connection.php");

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$md_password = md5($password . "rodina");
$users = $db->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1");
$users->execute([$email, $md_password]);

$user = $users->fetch(PDO::FETCH_ASSOC);

return $user;
