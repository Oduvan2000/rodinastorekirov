<?php

header("Location: /");

require  "../connection.php";

$add_email = $db->prepare("INSERT INTO emails (email, `date`) VALUES (?,?)");
$add_email->execute([$_GET['email'], date('d.m.Y')]);
