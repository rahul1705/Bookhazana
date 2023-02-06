<?php
ob_start();
include "./includes/header.php";
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
    <!-- product details -->
<?php include "./includes/_product-details.php"; ?>
    <!-- product details end -->

    <!-- Similar books -->
<?php include "./includes/_similar-books.php"; ?>

    <!-- Similar books Ends -->
<?php
include "./includes/footer.php";
?>