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
        <h5 class="font-baloo font-size-20">Wishlist</h5>
        <!-- Shopping Cart items -->
        <div class="row">
            <div class="col-12 text-center text-lg-start text-center">
                <div class="row border-top py-3 mt-3 justify-content-center">
                    <div class="col-lg-2 mb-2">
                        <img src="./assets/products/empty_wishlist.jpg" alt="The Wishlist is Empty" class="img-fluid" style="height: 200px">
                        <p class="font-baloo font-size-16 text-black-50 text-center">Your Wishlist is Empty!</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shopping Cart items end -->
    </div>
</section>