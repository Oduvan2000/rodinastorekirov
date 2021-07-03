<?php
$servername = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "rodinastore";

// $servername = "localhost";
// $db_username = "admin_root";
// $db_password = "admin_root";
// $db_name = "admin_rodinastore";

$dsn = "mysql:host=$servername;dbname=$db_name;charset=UTF8";
$db = new PDO($dsn, $db_username, $db_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
