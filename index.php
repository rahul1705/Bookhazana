<?php
ob_start();
require "./includes/header.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<?php
//banner
include "./includes/_banner-area.php";
//banner ends

//on sale
include "./includes/_on-sale.php";
//on sale ends

//Reader's
include "./includes/_readers-choice.php";
//Reader's Choice ends

//Banner Ads
include "./includes/_banner-ads.php";
//Banner Ads End

//Recently Added
include "./includes/_recent.php";
//Recently Added Ends
?>
<!--Footer area-->
<?php include "./includes/footer.php"; ?>
