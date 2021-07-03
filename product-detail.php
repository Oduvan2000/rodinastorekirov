<?php
session_start();

require "connection.php";
$user = require "php/check_user.php";

if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
} else {
	$id = 1;
}

require 'connection.php';

//Запрос информации о товаре
$product = $db->prepare("SELECT * FROM `products` WHERE `id` = ?");
$product->execute([$id]);
$product = $product->fetch(PDO::FETCH_ASSOC);

$images = $db->prepare("SELECT `img` FROM `product_images` WHERE `product_id` = ?");
$images->execute([$id]);

$sizes = $db->prepare("SELECT size FROM `product_sizes` WHERE `product_id` = ?");
$sizes->execute([$id]);
$sizes_list = $sizes->fetchall(PDO::FETCH_ASSOC);

$sizes = [];

foreach ($sizes_list as $size) {
	array_push($sizes, $size['size']);
}

$is_cart = $db->prepare("SELECT id FROM cart WHERE `user_id` = ? AND `product_id` = ? LIMIT 1");
$is_cart->execute([$user['id'], $id]);
$is_cart = $is_cart->rowCount() == 1;

if ($user['admin'] == 1) {
	$cart_count = $db->prepare("SELECT COUNT(*) FROM `cart` WHERE `product_id` = ?");
	$cart_count->execute([$id]);
	$cart_count = $cart_count->fetchColumn();
}

$products_rand = $db->query("SELECT `id`, `title`, `img`, `price` FROM `products` ORDER BY RAND() LIMIT 4");
$products_rand = $products_rand->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $product['title'] ?></title>
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

	<!-- Slider -->
	<link rel="stylesheet" href="css/pgwslider.css" />

</head>

<body>
	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<?php
			require 'php/nav.php';
			?>
		</nav>
		<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/cover-img-1.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h1>О товаре</h1>
										<h2 class="bread"><span><a href="index.php">Магазин</a></span> <span>О товаре</span></h2>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>

		<div class="colorlib-shop">
			<?php
			if ($user['admin'] == 1) :
			?>
				<div class="container-fluid product-status">
					<div class="row">
						<span>Просмотров: <?= $product['views'] ?></span>
						<span>В корзине: <?= $cart_count ?></span>
						<a class="btn btn-danger pull-right" href="admin/product_remove.php?id=<?= $_GET['id'] ?>">Удалить</a>
						<a class="btn btn-warning pull-right" href="admin/product_form_update.php?id=<?= $_GET['id'] ?>">Изменить</a>
					</div>
				</div>
			<?php
			endif;
			?>
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 col-md-offset-1">
						<div class="product-detail-wrap">
							<div class="row">
								<div class="col-md-5">

									<ul class="pgwSlider">
										<?php
										while ($img = $images->fetch(PDO::FETCH_ASSOC)) :
										?>
											<li>
												<img src=" images/<?= $img['img'] ?>" />
											</li>
										<?php
										endwhile;
										?>
									</ul>

								</div>
								<div class="col-md-7">
									<div class="desc">
										<h3><?= $product['title'] ?></h3>

										<p class="price">
											<span><?= $product['price'] ?>₽</span>
										</p>
										<p><?= $product['description'] ?></p>

										<form action="php/addtocart.php" method="post">
											<input type="text" name="product_id" value="<?= $_GET['id'] ?>" hidden>
											<div class="size-wrap">
												<p class="size-desc">
													Размеры:
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("XS", $sizes) ? "" : "disabled" ?> hidden value="XS" required>
														<a class="size <?= in_array("XS", $sizes) ? "active" : "" ?>">XS</a>
													</label>
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("S", $sizes) ? "" : "disabled" ?> hidden value="S">
														<a class="size <?= in_array("S", $sizes) ? "active" : "" ?>">S</a>
													</label>
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("M", $sizes) ? "" : "disabled" ?> hidden value="M">
														<a class="size <?= in_array("M", $sizes) ? "active" : "" ?>">M</a>
													</label>
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("L", $sizes) ? "" : "disabled" ?> hidden value="L">
														<a class="size <?= in_array("L", $sizes) ? "active" : "" ?>">L</a>
													</label>
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("XL", $sizes) ? "" : "disabled" ?> hidden value="XL">
														<a class="size <?= in_array("XL", $sizes) ? "active" : "" ?>">XL</a>
													</label>
													<label>
														<input type="radio" class="size-radio" name="size" <?= in_array("XXL", $sizes) ? "" : "disabled" ?> hidden value="XXL">
														<a class="size <?= in_array("XXL", $sizes) ? "active" : "" ?>">XXL</a>
													</label>
												<p></p>
												</p>
											</div>
											<p id="error" class="alert alert-danger">*Выберите размер</p>
											<div class="row row-pb-sm">
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-btn">
															<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
																<i class="icon-minus2"></i>
															</button>
														</span>
														<input type="text" id="quantity" name="count" class="form-control input-number" value="1" min="1" max="10" readonly>
														<span class="input-group-btn">
															<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
																<i class="icon-plus2"></i>
															</button>
														</span>
													</div>
												</div>
											</div>
											<?php
											if (!empty($sizes)) :
												if (!$is_cart) :
											?>
													<label for="addtocart">
														<p><a class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i>Добавить в корзину</a></p>
													</label>
													<input type="submit" id="addtocart" hidden>
												<?php
												else :
												?>
													<p><a href="php/removefromcart.php?product_id=<?= $_GET['id'] ?>" class="btn btn-primary btn-removefromcart btn-remove"><i class=" icon-shopping-cart"></i>Удалить из корзины</a></p>
												<?php
												endif;
											else :
												?>
												<p id="error" class="alert alert-danger">Извините, товара нет в наличии</p>
											<?php
											endif;
											?>
										</form>
									</div>
								</div>
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
						<h2><span>Другие наши товары</span></h2>
						<p>Мы любим рассказывать о наших успехах далеко-далеко, за горами слов, вдали от стран Вокалии и Консонантии, там живут слепые тексты.</p>
					</div>
				</div>
				<div class="row">
					<?php
					foreach ($products_rand as $product_rand) :
					?>
						<div class="col-md-3 text-center">
							<div class="product-entry">
								<div class="product-img" style="background-image: url(images/<?= $product_rand['img'] ?>);">
									<div class="cart">
										<p>
											<span class="addtocart"><a href="php/addtocart.php?"><i class="icon-shopping-cart"></i></a></span>
											<span><a href="product-detail.php?id=<?= $product_rand['id'] ?>"><i class="icon-eye"></i></a></span>
											<span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
										</p>
									</div>
								</div>

								<div class="desc">
									<h3><a href="product-detail.php?id=<?= $product_rand['id'] ?>"><?= $product_rand['title'] ?></a></h3>
									<p class="price"><span><i><?= $product_rand['price'] ?>.00₽</i></span></p>
								</div>
							</div>
						</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
		</div>

		<?php

		require "php/footer.php";

		?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>

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
	<script src="js/pgwslider.js"></script>
	<script>
		$(document).ready(function() {
			$(".pgwSlider").pgwSlider();
		});
	</script>
	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined
				if (quantity < 10) {
					$('#quantity').val(quantity + 1);
				}
			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 1) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>
	<script>
		$(document).ready(function() {
			$("#error").hide();
			$("#addtocart").click(function() {
				var size = $('input[name="size"]:checked').val();
				if (!size) {
					$("#error").show();
					setTimeout(function() {
						$("#error").hide();
					}, 1000);
				}
			})

		});
	</script>
</body>

</html>

<?php

echo "<pre>";
var_dump($_SESSION);

if (($_SESSION['views'] == null || !in_array($product['id'], $_SESSION['views'])) && !$user['admin'] == 1) {
	$_SESSION['views'][] = $product['id'];
	$add_view = $db->prepare("UPDATE `products` SET `views` = `views` + 1 WHERE `id` = ?");
	$add_view->execute([$product['id']]);
}
?>