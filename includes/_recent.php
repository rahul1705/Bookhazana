<?php
shuffle($product_shuffle);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['recent_submit'])) {
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

?>

<section id="recently-added">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Recently Added</h4>
        <hr/>
        <!-- carousel start -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2 px-1 bg-light" style="width: 150px;">
                <div class="product font-rale">
                    <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>"
                    ><img
                            src="<?php echo $item['item_image']?>"
                            alt="product"
                            class="img-fluid"
                            style="height: 200px;"
                        /></a>
                    <div class="text-center">
                        <h6 class="mt-2"><?php echo $item['item_name']?></h6>
                        <div class="price py-2">
                            <span class="font-rubik">&#x20B9;<?php echo $item['item_price'] - ($item['item_price'] * 0.05); ?></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <?php
                            if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart'))??[])) {
                                echo '<button type="submit" disabled class="btn btn-success font-size-12 mb-4">
                                In Cart
                            </button>';
                            } else {
                                echo '<button type="submit" name="on_sale_submit" class="btn btn-warning font-size-12 mb-4">
                                Add to Cart
                            </button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- carousel end -->
    </div>
</section>