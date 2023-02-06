<?php
require("./db/DBController.php");

require("./db/Product.php");

require("./db/Cart.php");

$db = new DBController();

$product = new Product($db);
$product_shuffle = $product->getData();

$Cart = new Cart($db);