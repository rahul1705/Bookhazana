<?php
ob_start();
include "./includes/header.php";
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<?php
//  Shopping Cart
count($product->getData('cart'))? include "./includes/_shopping-cart.php": include "./includes/empty_files/_empty_cart.php";
//  Shopping Cart End

//  Wishlist
count($product->getData('wishlist'))? include "./includes/_wishlist.php": include "./includes/empty_files/_empty_wishlist.php";
//    include "./includes/_wishlist.php";
//  Wishlist Ends

//  Recently Added
include "./includes/_similar-books.php";
//  Recently Added Ends

?>

<?php include "./includes/footer.php"; ?>