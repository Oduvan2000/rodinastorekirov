<?php
$user = require "php/check_user.php";

require "connection.php";

$products = $db->prepare("SELECT products.id, products.title, products.img, products.price, cart.count, cart.size FROM products, cart WHERE products.id = cart.product_id AND `user_id` = ?");
$products->execute([$user['id']]);
$products = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Корзина</title>
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
										<h1>Корзина</h1>
										<h2 class="bread"></span> <span><a href="index.php">Магазин</a></span> <span>Корзина</span></h2>
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

				<div class="row row-pb-md">
					<div class="col-md-10 col-md-offset-1">
						<div class="product-name">
							<div class="one-forth text-center">
								<span>О товаре</span>
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
							<div class="one-eight text-center">
								<span>Удалить</span>
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
								<div class="one-eight text-center">
									<div class="display-tc">
										<a href="php/removefromcart.php?product_id=<?= $product['id'] ?>" class="closed"></a>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="total-wrap">
							<div class="row">
								<div class="col-md-8">
									<form action="php/order_add.php" method="POST">
										<div class="row form-group">
											<div class="col-md-6">
												<span><b>Телефон</b></span>
												<input id="phone" type="tel" name="phone" class="form-control input-number" placeholder="Введите ваш телефон" required>
											</div>
											<div class="col-md-6">
												<span><b>Как к Вам обращаться?</b></span>
												<input type="text" name="name" class="form-control input-number" placeholder="Введите Ваше имя" required>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<p>
													<button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
														Добавить адрес доставки
													</button>
												</p>
												<div class="collapse" id="collapseExample">
													<div class="card card-block">
														<div class="row">
															<div class="col-md-4">
																<span><b>Почтовый индекс</b></span>
																<input type="text" name="postal_code" id="postal_code" class="form-control" maxlength="6">
															</div>
															<div class="col-md-6">
																<span><b>Город</b></span>
																<input type="text" name="city" id="city" class="form-control" maxlength="30">
															</div>
														</div>
														<div class="row">
															<div class="col-md-10">
																<span><b>Улица</b></span>
																<input type="text" name="street" id="street" class="form-control" maxlength="50">
															</div>
														</div>
														<div class="row">
															<div class="col-md-3">
																<span><b>Дом</b></span>
																<input type="text" name="house" id="house" class="form-control" maxlength="10">
															</div>
															<div class="col-md-3">
																<span><b>Квартира</b></span>
																<input type="text" name="apartment" id="apartment" class="form-control" maxlength="10">
															</div>
														</div>
														<br>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<input type="submit" value="Сделать заказ" class="btn btn-primary">
											</div>
										</div>

									</form>
								</div>
								<!-- <div class="col-md-3 col-md-push-1 text-center">
									<div class="total">
										<div class="sub">
											<p><span>Subtotal:</span> <span>$200.00</span></p>
											<p><span>Delivery:</span> <span>$0.00</span></p>
											<p><span>Discount:</span> <span>$45.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span>$450.00</span></p>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Recommended Products</span></h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(images/item-5.jpg);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
										<span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="shop.html">Floral Dress</a></h3>
								<p class="price"><span>$300.00</span></p>
							</div>
						</div>
					</div>

				</div>
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