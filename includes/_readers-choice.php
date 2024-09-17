<?php
$cat = array_map(function ($pro){return $pro['item_cat'];}, $product_shuffle);
$unique_cat = array_unique($cat);
sort($unique_cat);
shuffle($product_shuffle);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['readers_choice_submit'])) {
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

$in_cart = $Cart->getCartId($product->getData('cart'));

?>

<section id="readers-choice">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h4 class="font-rubik font-size-20">Reader's Choice</h4>
            <div id="filters" class="button-group text-end py-1">
                <div class="dropdown">
                    <button
                        class="btn btn-secondary btn-sm dropdown-toggle"
                        type="button"
                        id="filter-menu"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filter-menu">
                        <li>
                            <button
                                class="dropdown-item btn-sm is-checked"
                                type="button"
                                data-filter="*"
                            >
                                All
                            </button>
                        </li>
                        <?php
                            array_map(function ($cat){
                                printf('<li>
                            <button
                                class="dropdown-item btn-sm"
                                type="button"
                                data-filter=".%s"
                            >
                                %s
                            </button>
                        </li>', $cat, $cat);
                            }, $unique_cat);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid">
            <?php array_map(function ($item) use ($in_cart){?>
            <div class="grid-item border text-center <?php echo $item['item_cat']?>">
                <div class="item py-2 px-1" style="width: 150px">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>"
                        ><img
                                src="<?php echo $item['item_image']; ?>"
                                alt="product"
                                class="img-fluid"
                                style="height: 200px;"
                            /></a>
                        <div class="text-center">
                            <h6 class="pt-2"><?php echo $item['item_name']; ?></h6>
                            <div class="price py-2">
                                <span class="font-rubik">&#x20B9; <?php echo $item['item_price'] - ($item['item_price'] * 0.05); ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                <?php
                                if (in_array($item['item_id'], $in_cart??[])) {
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">
                                In Cart
                            </button>';
                                } else {
                                    echo '<button type="submit" name="on_sale_submit" class="btn btn-warning font-size-12">
                                Add to Cart
                            </button>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }, $product_shuffle); ?>
        </div>
    </div>
</section>