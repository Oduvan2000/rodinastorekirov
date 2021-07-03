<?php
$user = require "check_user.php";
require "../connection.php";

$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$price_min = $_POST['price_min'];
$price_max = $_POST['price_max'];
$size = $_POST['size'];
$page = $_POST['page'] * 15;

$query = "SELECT `id`, `title`, `img`, `price` FROM `products`
 WHERE `price` < $price_max AND `price` > $price_min";

if (!empty($category)) {
    $query .= " AND `category` = \"$category\"";
}

if (!empty($subcategory)) {
    $query .= " AND `subcategory` = \"$subcategory\"";
}

if (!empty($size)) {
    $query .= " AND  EXISTS(SELECT size FROM product_sizes WHERE product_id = products.id AND `size` = \"$size\")";
}
if ($user['admin'] != 1) {
    $query .= " AND `hide` <> 1";
}
$query .= " ORDER BY `id` DESC LIMIT $page,15";

$products = $db->query($query);
$products = $products->fetchall(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

if (count($products) == 0) {
    echo "0";
    exit;
}

foreach ($products as $product) :
?>
    <div class="col-md-4 text-center">
        <div class="product-entry">

            <div class="product-img" style="background-image: url(images/<?= $product['img'] ?>);">
                <div class="cart">
                    <p>
                        <span class="addtocart"><a href="php/addtocart.php?"><i class="icon-shopping-cart"></i></a></span>
                        <span><a href="product-detail.php?id=<?= $product['id'] ?>"><i class="icon-eye"></i></a></span>
                        <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                    </p>
                </div>
            </div>

            <div class="desc">
                <h3><a href="product-detail.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a></h3>
                <p class="price"><span><i><?= $product['price'] ?>.00₽</i></span></p>
            </div>
        </div>
    </div>
<?php
endforeach;
?>