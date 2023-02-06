<?php
$item_id = $_GET['item_id']??1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['onProduct_submit'])) {
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}
foreach ($product->getData() as $item):
    if ($item['item_id'] == $item_id):

?>

<section
    id="product_details"
    class="py-lg-5 py-3"
    data-title="product_page_imgs"
>
    <div class="container single-product">
        <div class="row">
            <!-- product left -->
            <div class="column col-12 col-lg-6 text-center">
                <img
                    src="<?php echo $item['item_image'];?>"
                    alt="Product Image"
                    id="productImg"
                    class="w-50"
                />

                <!-- small images -->
                <div class="small-img-row d-flex justify-content-between my-3">
                    <div class="small-img-col">
                        <img
                            src="<?php echo $item['item_image'];?>"
                            alt="Product Small 1"
                            class="border p-2 small-img"
                        />
                    </div>
                    <div class="small-img-col">
                        <img
                            src="<?php echo $item['item_image'];?>"
                            alt="Product Small 2"
                            class="border p-2 small-img"
                        />
                    </div>
                    <div class="small-img-col">
                        <img
                            src="<?php echo $item['item_image'];?>"
                            alt="Product Small 3"
                            class="border p-2 small-img"
                        />
                    </div>
                    <div class="small-img-col">
                        <img
                            src="<?php echo $item['item_image'];?>"
                            alt="Product Small 4"
                            class="border p-2 small-img"
                        />
                    </div>
                </div>
                <!-- small images end -->
            </div>
            <!-- product left ends -->
            <!-- product right -->
            <div class="col-lg-6 col-12 font-ubuntu py-3">
                <h3 class="product_name"><?php echo $item['item_name'];?></h3>
                <small>
                    <strong>Author:</strong>
                    <span class="author_name font-rubik text-success"
                    ><?php echo $item['item_author'];?></span
                    >
                </small>
                <hr/>
                <table class="my-3">
                    <tr class="font-rubik font-size-16">
                        <td>M.R.P:</td>
                        <td class="text-danger"><s>&#x20B9;<?php echo $item['item_price'];?></s></td>
                    </tr>
                    <tr class="font-rubik font-size-14">
                        <td>Deal Price:</td>
                        <td class="text-muted">&#x20B9;<?php echo 300;?></td>
                    </tr>
                    <tr class="font-rubik font-size-14">
                        <td>You Save:</td>
                        <td class="text-muted">&#x20B9;<?php echo $item['item_price']-300;?></td>
                    </tr>
                </table>
                <hr/>
                <!-- order details -->
                <div
                    id="order-details"
                    class="font-rubik d-flex flex-column text-dark"
                >
                    <small>Delivery by: <span>10/08/2022 - 12/08/2022</span></small>
                    <small>Sold by: <a href="#">Rahul Books</a></small>
                    <small
                    ><i class="fas fa-map-marker-alt color-secondary"></i
                        >&nbsp;&nbsp;Deliver to Customer - 506001</small
                    >
                </div>
                <!-- order details ends -->

                <!-- add to cart and buy now -->
                <div class="d-lg-flex my-2">

                    <form class="mb-2 mb-lg-0 mx-lg-2 form-control">
                    <button
                        type="submit"
                        class="btn btn-warning form-control"
                    >
                        Buy Now
                    </button>
                    </form>

                    <form method="post" class="mx-lg-2 form-control">
                        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        <?php
                        if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart'))??[])) {
                            echo '<button type="submit" disabled class="btn btn-success form-control">
                                In Cart
                            </button>';
                        } else {
                            echo '<button type="submit" name="onProduct_submit" class="btn btn-dark form-control">
                                Add to Cart
                            </button>';
                        }
                        ?>
                    </form>
                </div>
                <!-- add to cart and buy now ends -->

                <!-- product description -->
                <div class="product-details my-3">
                    <h4 class="font-size-20 fw-bold">Product Details:</h4>
                    <p class="font-rubik text-black-50 font-size-14">
                        <?php echo $item['item_desc'];?>
                    </p>
                </div>
                <!-- product description ends -->
            </div>
            <!-- product right ends -->
        </div>
    </div>
</section>

<?php endif; endforeach; ?>