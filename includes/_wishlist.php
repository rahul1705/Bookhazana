<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_item_wishlist'])) {
        $delRec = $Cart->deleteCartItem($_POST['item_id']);
    }

    if (isset($_POST['addCart_item'])) {
        $Cart->saveForLater($_POST['item_id'], 'cart', 'wishlist');
    }
}
?>

<section id="wishlist" class="py-3">
    <div class="container">
        <h5 class="font-baloo font-size-20">Wishlist</h5>
        <!-- Shopping Wishlist items -->
        <div class="row">
            <div class="col-12 text-center text-lg-start">
                <?php

                foreach ($product->getData('wishlist') as $item):
                    $cart = $product->getProduct($item['item_id']);
                    array_map(function ($item){

                        ?>
                        <!-- wishlist item -->
                        <div class="row border-top py-3 mt-3">
                            <div class="col-lg-2 mb-2">
                                <img
                                    src="<?php echo $item['item_image']?>"
                                    alt="wishlist_items"
                                    style="height: 120px"
                                    class="img-fluid"
                                />
                            </div>
                            <div class="col-lg-8">
                                <h5 class="font-baloo font-size-20"><?php echo $item['item_name']?></h5>
                                <small>Author: Rahul Mandal</small>
                                <div class="d-lg-flex my-2">
                                    <form method="post">
                                        <input type="hidden" value="<?php echo $item['item_id']??0; ?>" name="item_id" >
                                        <button
                                            type="submit"
                                            name="delete_item_wishlist"
                                            class="btn font-baloo btn-outline-danger px-3 me-lg-1 btn-sm"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                    <form method="post">
                                        <input type="hidden" value="<?php echo $item['item_id']??0; ?>" name="item_id" >
                                        <button
                                                type="submit"
                                                name="addCart_item"
                                                class="btn font-baloo btn-outline-primary btn-sm"
                                        >
                                            Add To Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-2 text-lg-end">
                                <div class="font-size-20 text-danger font-rubik">
                                    &#x20B9;<span class="product_price"><?php echo $item['item_price']?></span>
                                </div>
                            </div>
                        </div>
                        <!-- wishlist item end -->
                        <?php
                        return $item['item_price'];
                    }, $cart);
                endforeach;
                ?>
            </div>
        </div>
        <!-- Shopping Wishlist items end -->
    </div>
</section>