<?php

require "../connection.php";

echo "<pre>";
var_dump($_POST);

if (!empty($_POST['param'])) {
    if ($_POST['param'] == "processed") {
        $processed_change = $db->prepare("UPDATE orders SET processed = ? WHERE id = ?");
        $processed_change->execute([($_POST['val'] == "true" ? 1 : 0), $_POST['id']]);
        exit;
    }
    if ($_POST['param'] == "completed") {
        $processed_change = $db->prepare("UPDATE orders SET completed = ? WHERE id = ?");
        $processed_change->execute([($_POST['val'] == "true" ? 1 : 0), $_POST['id']]);
        exit;
    }
}
