<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_item'])) {
        $delRec = $Cart->deleteCartItem($_POST['item_id']);
    }

//    Save for later
    if (isset($_POST['wishlist_item'])) {
        $Cart->saveForLater($_POST['item_id']);
    }
}

?>

<section id="cart" class="py-3">
    <div class="container">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>
        <!-- Shopping Cart items -->
        <div class="row">
            <div class="col-lg-9 col-12 text-center text-lg-start">
                <?php

                foreach ($product->getData('cart') as $item):
                    $cart = $product->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item){
                        ?>
                <!-- cart item -->

                <div class="row border-top py-3 mt-3">
                    <div class="col-lg-2 mb-2">
                        <img
                            src="<?php echo $item['item_image']?>"
                            alt="cart1"
                            style="height: 120px"
                            class="img-fluid"
                        />
                    </div>
                    <div class="col-lg-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name']?></h5>
                        <small><strong>Author:</strong> <?php echo $item['item_author'];?></small>
                        <div class="d-lg-flex my-2">
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id']??0; ?>" name="item_id" >
                                <button
                                        type="submit"
                                        name="delete_item"
                                        class="btn font-baloo btn-outline-danger px-3 me-lg-1 btn-sm"
                                >
                                    Delete
                                </button>
                            </form>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id']??0; ?>" name="item_id" >
                                <button
                                        type="submit"
                                        name="wishlist_item"
                                        class="btn font-baloo btn-outline-primary btn-sm"
                                >
                                    Save for Later
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-2 text-lg-end">
                        <div class="font-size-20 text-danger font-rubik">
                            &#x20B9;<span class="product_price"><?php echo $item['item_price'] - ($item['item_price'] * 0.05); ?></span>
                        </div>
                    </div>
                </div>
                <!-- cart item end -->
                <?php
                        return $item['item_price'];
                    }, $cart);
                endforeach;
                ?>
            </div>
            <!-- subtotal -->
            <div class="col-lg-3 col-12">
                <div class="sub-total text-center mt-3 border">
                    <h6 class="font-size-12 font-rale text-success py-3">
                        <i class="fas fa-check"></i> Orders over &#x20B9;599 is eligible for FREE
                        Delivery
                    </h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">
                            Subtotal(<?php echo isset($subTotal)? count($subTotal):0; ?> items):&nbsp;<span class="text-danger font-rubik"
                            >&#x20B9;
                      <span class="text-danger" id="deal-price"
                      ><?php echo isset($subTotal)? $Cart->getSum($subTotal): 0; ?></span></span>
                        </h5>
                        <button class="btn btn-warning mt-3" name="proceed_buy">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- subtotal end -->
        </div>
        <!-- Shopping Cart items end -->
    </div>
</section>