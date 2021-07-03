<?php
$user = require "php/check_user.php";

require "connection.php";

$order_details = $db->prepare("SELECT id, `date`, phone FROM orders WHERE `user_id` = ?");
$order_details->execute([$user['id']]);
$order_details = $order_details->fetchall(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($order_details);
// echo "</pre>";
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Заказы</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

    <div class="colorlib-loader"></div>

    <div id="page">
        <?php
        require 'php/nav.php';
        ?>

        <aside id="colorlib-hero" class="breadcrumbs">
            <div class="flexslider">
                <ul class="slides">
                    <li style="background-image: url(images/cover-img-1.jpg);">
                        <div class="overlay"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                                    <div class="slider-text-inner text-center">
                                        <h1>Заказы</h1>
                                        <h2 class="bread"></span> <span><a href="index.php">Магазин</a></span> <span>Заказы</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="colorlib-shop">
            <div class="container">
                <?php

                if (!empty($order_details)) :

                    foreach ($order_details as $order) :

                        $products = $db->prepare("SELECT products.id, products.title, products.img, products.price, order_products.count, order_products.size FROM products, order_products WHERE products.id = order_products.product AND order_products.order_id = ?");
                        $products->execute([$order['id']]);
                        $products = $products->fetchAll(PDO::FETCH_ASSOC);

                ?>
                        <div class="row col-md-offset-1">
                            <h5 class="col-md-2"><b>Номер заказа:</b> <?= $order['id'] ?></h5>
                            <h5 class="col-md-3"><b>Дата заказа:</b> <?= date("d.m.Y H:i", strtotime($order['date'])) ?></h5>
                            <h5 class="col-md-4"><b>Указанный телефон:</b> <?= $order['phone'] ?></h5>
                            <div class="col-md-2">
                                <a href="php/order_cancel.php?id=<?= $order['id'] ?>" class="btn btn-warning" style="margin-left: -3vw; margin-top: -2vh;">Отменить заказ</a>
                            </div>
                        </div>
                        <div class="row row-pb-md">

                            <div class="col-md-10 col-md-offset-1">
                                <div class="product-name">
                                    <div class="one-forth text-center">
                                        <span>О товаре</span>
                                    </div>
                                    <div class="one-eight text-center">
                                        <span>.</span>
                                    </div>
                                    <div class="one-eight text-center">
                                        <span>Цена</span>
                                    </div>
                                    <div class="one-eight text-center">
                                        <span>Количество</span>
                                    </div>
                                    <div class="one-eight text-center">
                                        <span>Размер</span>
                                    </div>

                                </div>

                                <?php
                                foreach ($products as $product) :
                                ?>
                                    <div class="product-cart">
                                        <div class="one-forth">
                                            <div class="product-img" style="background-image: url(images/<?= $product['img'] ?>);">
                                            </div>
                                            <div class="display-tc">
                                                <h3><a style="color: black;" href="product-detail.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a></h3>
                                            </div>
                                        </div>

                                        <div class="one-eight text-center">
                                            <div class="display-tc">
                                            </div>
                                        </div>

                                        <div class="one-eight text-center">
                                            <div class="display-tc">
                                                <span class="price"><?= $product['price'] ?>₽</span>
                                            </div>
                                        </div>
                                        <div class="one-eight text-center">
                                            <div class="display-tc">
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="<?= $product['count'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="one-eight text-center">
                                            <div class="display-tc">
                                                <span class="price"><?= $product['size'] ?></span>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else :
                    ?>
                    <h2>У Вас нет заказов</h2>
                <?php
                endif;
                ?>
            </div>
        </div>

        <?php
        require 'php/footer.php';
        ?>


        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- jQuery Easing -->
        <script src="js/jquery.easing.1.3.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Waypoints -->
        <script src="js/jquery.waypoints.min.js"></script>
        <!-- Flexslider -->
        <script src="js/jquery.flexslider-min.js"></script>
        <!-- Owl carousel -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- Magnific Popup -->
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <!-- Date Picker -->
        <script src="js/bootstrap-datepicker.js"></script>
        <!-- Stellar Parallax -->
        <script src="js/jquery.stellar.min.js"></script>
        <!-- Main -->
        <script src="js/main.js"></script>
        <script src="js/jquery.maskedinput.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#phone").mask("8(999) 999-9999");
                $("#postal_code").mask("999999");
            })
        </script>

</body>

</html>