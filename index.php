<?php
$user = require "php/check_user.php";
require 'connection.php';

$categories = $db->query("SELECT * FROM categories ORDER BY `id`");
$categories = $categories->fetchall(PDO::FETCH_ASSOC);

$subcategories = $db->query("SELECT * FROM subcategories ORDER BY `id`");
$subcategories = $subcategories->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Родина | Магазин одежды | Киров</title>
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

	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

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
	<?php
	require 'php/nav.php';
	?>
	<div id="page">
		<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/cover-img-1.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h1>Товары</h1>
										<h2 class="bread"><span>Магазин</span></h2>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
	</div>
	<div class="colorlib-shop">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-2 filter-panel">
					<div class="sidebar">
						<div class="side">
							<h2>Категории</h2>
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading">
											<h4 class="panel-title noneplus">
												<a id="allcategories" class="collapsed all" href="#Все категории"><b>Все категории</b></a>
											</h4>
										</div>
									</div>
									<?php
									foreach ($categories as $category) :
									?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingTwo">
												<h4 class="panel-title">
													<a type="button" class="collapsed category-select" data-toggle="collapse" data-parent="#accordion" href="#<?= $category['id'] ?>" aria-expanded="false" aria-controls="<?= $category['category'] ?>"><?= $category['category'] ?></a>
												</h4>
											</div>
											<div id="<?= $category['id'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
												<div class="panel-body">
													<ul>
														<?php
														foreach ($subcategories as $subcategory) :
															if ($subcategory['category'] == $category['category']) :
														?>
																<li><a class="subcategory-select" href="<?= $subcategory['subcategory'] ?>"><?= $subcategory['subcategory'] ?></a></li>
														<?php
															endif;
														endforeach;
														?>
													</ul>
												</div>
											</div>
										</div>

									<?php
									endforeach;
									?>
								</div>
							</div>
						</div>
						<div class="side">
							<h2 id="asd">Цена</h2>
							<form method="post" class="colorlib-form-2">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="guests">От:</label>
											<div class="form-field">
												<i class="icon icon-arrow-down3"></i>
												<select name="people" id="price-min" class="form-control">
													<option value="0">-</option>
													<option value="200">200</option>
													<option value="500">500</option>
													<option value="1000">1000</option>
													<option value="2000">2000</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="guests">До:</label>
											<div class="form-field">
												<i class="icon icon-arrow-down3"></i>
												<select name="people" id="price-max" class="form-control">
													<option value="2147000000">-</option>
													<option value="2000">2000</option>
													<option value="4000">4000</option>
													<option value="6000">6000</option>
													<option value="8000">8000</option>
													<option value="10000">10000</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="side">
							<h2>Размеры</h2>
							<div class="size-wrap">
								<p class="size-desc row">
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="XS" required>
										<a class="size active">XS</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="S">
										<a class="size active">S</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="M">
										<a class="size active">M</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="L">
										<a class="size active">L</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="XL">
										<a class="size active">XL</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="XXL">
										<a class="size active">XXL</a>
									</label>
									<label>
										<input type="radio" class="size-radio" name="size" hidden value="" checked>
										<a class="size active" style="width: 134%;">Все размеры</a>
									</label>
								</p>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div id="cards" class="row row-pb-lg">
						<!-- Карточки -->
					</div>

				</div>
			</div>
		</div>
	</div>


	<p id=lastcard></p>
	<?php
	require 'php/footer.php';
	?>

</body>

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

<script>
	var price_min = $("#price-min").val();
	var price_max = $("#price-max").val();
	var size = $('input[name="size"]:checked').val();
	var category = "";
	var subcategory = "";
	var lastcategory = "";
	var page = 0;
	var product_end = false;

	function is_fully_shown(target) {
		var wt = $(window).scrollTop();
		var wh = $(window).height();
		var eh = $(target).height();
		var et = $(target).offset().top;

		if (et >= wt && et + eh <= wh + wt) {
			return true;
		} else {
			return false;
		}
	}

	function Clean() {
		page = 0;
		product_end = false;
		$("#cards").empty();
	}

	function Update() {
		price_min = $("#price-min").val();
		price_max = $("#price-max").val();
		size = $('input[name="size"]:checked').val();
		$.ajax({
			type: "POST",
			url: "php/update_card.php",
			data: {
				category: category,
				subcategory: subcategory,
				price_min: price_min,
				price_max: price_max,
				size: size,
				page: page
			},
			dataType: "HTML",
			success: function(response) {
				response = $.trim(response);
				if (response == "0") {
					product_end = true;
					if ($("#cards").html() == 0) {
						$("#cards").html("<h2>Нет товаров удовлетворяющих поиску<h2>");
					}
				} else {
					$("#cards").append(response);
				}
			}
		});
	}

	$(document).ready(function() {

		$("input[name = 'size']").change(function() {
			Clean();
			Update();
		});
		$("#price-min").change(function(e) {
			Clean();
			Update();
		});
		$("#price-max").change(function(e) {
			Clean();
			Update();
		});
		$(".subcategory-select").click(function(e) {
			$(".subcategory-select").prepend().css('color', 'black');
			$("#allcategories").css('color', 'black');
			$(this).css('color', '#ffc300');
			category = lastcategory;
			subcategory = $(this).text();
			e.preventDefault();
			Clean();
			Update();
		});

		$(".category-select").click(function(e) {
			$(".subcategory-select").prepend().css('color', 'black');
			$("#allcategories").css('color', 'black');
			category = $(this).text();
			subcategory = "";
			Clean();
			Update();
			e.preventDefault();
			lastcategory = $(this).text();
		});

		$(".subcategory-select.all").click(function(e) {
			$(".subcategory-select").prepend().css('color', 'black');
			$(this).css('color', '#ffc300');
			subcategory = "";
			e.preventDefault();
			Clean();
			Update();
		});
		$("#allcategories").click(function(e) {
			category = ""
			subcategory = "";
			$(".subcategory-select").prepend().css('color', 'black');
			$(this).css('color', '#ffc300');
			$(".collapse").collapse('hide');
			Clean();
			Update();
		});
		$(document).scroll(function() {
			if (is_fully_shown($("#lastcard")) && !product_end) {
				page += 1;
				Update();
			}
		});
		$("#asd").click(function(e) {
			console.log(product_end);
			e.preventDefault();
		});
		Update();
	})
</script>

</html>