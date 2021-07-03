<?php
//Проверка доступа
$user = require "../php/check_user.php";
if ($user['admin'] != 1) {
    header("Location: /admin");
    exit;
}

$id = $_POST['id'];

if (empty($id)) {
    header("Location: /admin");
    exit;
}

require "../connection.php";

$order_details = $db->prepare("SELECT * FROM orders WHERE id = ?");
$order_details->execute([$id]);
$order_details = $order_details->fetch(PDO::FETCH_ASSOC);

$products = $db->prepare("SELECT products.id, products.title, products.img, products.price, order_products.count, order_products.size FROM products, order_products WHERE products.id = order_products.product AND order_products.order_id = ?");
$products->execute([$id]);
$products = $products->fetchAll(PDO::FETCH_ASSOC);

// echo "<.pre>";
// var_dump($products);
// echo "</pre>";
// var_dump($order_products);

?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h5><b>Номер заказа:</b> <?= $order_details['id'] ?></h5>
        </div>

        <div class="col-md-3">
            <button type="button" class="btn btn-dark btn-lg" id="back_to_orders">Назад к заказам</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Телефон:</b> <?= $order_details['phone'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Имя:</b> <?= $order_details['name'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Дата и время:</b> <?= date("d.m.Y H:i", strtotime($order_details['date'])) ?></h5>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <h5><b>Почтовый индекс:</b> <?= $order_details['postal_code'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Город:</b> <?= $order_details['city'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Улица:</b> <?= $order_details['street'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Дом:</b> <?= $order_details['house'] ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h5><b>Квартира:</b> <?= $order_details['apartment'] ?></h5>
        </div>
    </div>

    <table class="table table-striped table-bordered mt-5">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Товар</th>
                <th>Цена</th>
                <th>Размер</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($products as $product) :
            ?>
                <tr>
                    <th scope="row" class="w-25">
                        <img src="../images/<?= $product['img'] ?>" alt="" class="img-fluid mx-auto">
                    </th>
                    <td><a style="color: black" href="../product-detail.php?id=<?= $product['id'] ?>"><b><?= $product['title'] ?></b></a></td>
                    <td><?= $product['price'] ?>₽</td>
                    <td><?= $product['size'] ?></td>
                    <td><?= $product['count'] ?></td>

                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        //Форма заказов
        $("#back_to_orders").click(function() {
            $.ajax({
                url: "orders_form.php",
                dataType: "html",
                success: function(response) {
                    $("#content").html(response);
                }
            });
        })
    })
</script>