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
            <div class="col-12 text-center text-lg-start text-center">
                <div class="row border-top py-3 mt-3 justify-content-center">
                    <div class="col-lg-2 mb-2">
                        <img src="./assets/products/empty_cart.jpg" alt="The Cart is Empty" class="img-fluid" style="height: 200px">
                        <p class="font-baloo font-size-16 text-black-50 text-center">Your Cart is Empty!</p>
                    </div>
                </div>

            </div>
            <!-- subtotal -->
            <div class="col-12">
                <div class="sub-total text-center mt-3 border">
                    <h6 class="font-size-12 font-rale text-success py-3">
                        <i class="fas fa-check"></i> Orders above &#x20B9;599 are eligible for FREE
                        Delivery
                    </h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">
                            Subtotal(<?php echo isset($subTotal)? count($subTotal):0; ?> items):&nbsp;<span class="text-danger font-rubik"
                            >&#x20B9;
                      <span class="text-danger" id="deal-price"
                      ><?php echo isset($subTotal)? $Cart->getSum($subTotal): 0; ?></span></span>
                        </h5>
                        <button class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- subtotal end -->
        </div>
        <!-- Shopping Cart items end -->
    </div>
</section>