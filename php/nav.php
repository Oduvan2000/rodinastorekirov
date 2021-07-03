<?php

// require "../connection.php";

if (!$user['admin'] == 1) {
    $cart_count = $db->prepare("SELECT COUNT(*) FROM `cart` WHERE `user_id` = ?");
    $cart_count->execute([$user['id']]);
    $cart_count = $cart_count->fetchColumn();
}
?>

<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo">
                        <a href="../index.php"><img src="images/logo.svg" alt="Родина"></a>
                    </div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <!-- <li class="active"><a href="../index.php">Главная</a></li> -->
                        <li class="has-dropdown">
                            <a href="/">Магазин</a>
                        </li>
                        <!-- <li><a href="blog.html">Новости</a></li> -->


                        <li><a href="contact.php">Контакты</a></li>
                        <?php
                        if (!empty($user)) :
                        ?>
                            <li><a href="<?= ($user['admin'] == 1) ? "/admin" : 'cart.php' ?>"> <i class="<?= ($user['admin'] == 1) ? "" : "icon-shopping-cart" ?>"></i><?= ($user['admin'] == 1) ? "Панель администратора" : "Корзина [$cart_count]" ?></a></li>
                            <li><a href="orders.php">Заказы</a></li>
                            <li><a href=""><img src="images/person.svg"> <?= $user['nickname'] ?></a></li>
                            <li><a href="php/logout.php"><b>Выход</b></a> </li>
                        <?php
                        else :
                        ?>
                            <li><a href="php/login_form.php"><b>Вход</b></a> </li>
                            <li><a href="php/registration_form.php"><b>Регистрация</b></a></li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>