<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

require "../connection.php";


$orders = $db->query("SELECT id, `name`, phone, `date`, processed, completed FROM orders ORDER BY processed ASC , completed ASC, `date` DESC");
$orders = $orders->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>№</th>
                <th>Телефон</th>
                <th>Имя</th>
                <th>Дата</th>
                <th>Обработано</th>
                <th>Завершён</th>
                <th>Подробнее</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orders as $order) :
            ?>
                <tr id="<?= $order['id'] ?>">
                    <th scope="row"><?= $order['id'] ?></th>
                    <td><?= $order['phone'] ?></td>
                    <td><?= $order['name'] ?></td>
                    <td><?= date("d.m.Y H:i", strtotime($order['date'])) ?></td>
                    <td><input type="checkbox" name="processed" id="<?= $order['id'] ?>" class="form-check mx-auto processed" <?= ($order['processed'] == 1) ? "checked" : "" ?>></td>
                    <td><input type="checkbox" name="completed" id="<?= $order['id'] ?>" class="form-check mx-auto completed" <?= ($order['completed'] == 1) ? "checked" : "" ?>></td>
                    <td><button type="button" id="<?= $order['id'] ?>" class="btn btn-primary btn-sm mx-auto order_details">Подробнее</button></td>
                    <td><button type="button" id="<?= $order['id'] ?>" class="btn btn-danger btn-sm mx-auto order_remove">Удалить</button></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>

<script src="../js/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(".processed").change(function() {
            var id = $(this).attr('id');
            var val = $(this).is(":checked");
            $.ajax({
                type: "POST",
                url: "orders_update.php",
                data: {
                    id: id,
                    param: "processed",
                    val: val
                },
                dataType: "html",
                success: function(response) {}
            });
        })

        $(".completed").change(function() {
            var id = $(this).attr('id');
            var val = $(this).is(":checked");
            $.ajax({
                type: "POST",
                url: "orders_update.php",
                data: {
                    id: id,
                    param: "completed",
                    val: val
                },
                dataType: "html",
                success: function(response) {

                }
            });
        })

        $(".order_remove").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "order_remove.php",
                data: {
                    id: id
                },
                dataType: "html",
                success: function(response) {
                    $("#" + id).remove();
                },
            });
        })

        //Форма заказов
        $(".order_details").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "order_details.php",
                data: {
                    id: id
                },
                dataType: "html",
                success: function(response) {
                    $("#content").html(response);
                }
            });
        })

    })
</script>