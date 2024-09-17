<?php
// Fetch the seller_id based on the user_id
$seller_query = "SELECT seller_id FROM seller WHERE user_id = '$user_id'";
$seller_result = $db->con->query($seller_query);

$seller_id = null;
if ($seller_result && $seller_result->num_rows > 0) {
    $seller_row = $seller_result->fetch_assoc();
    $seller_id = $seller_row['seller_id'];
}

// Fetch products for the seller_id
$product_query = "SELECT * FROM products WHERE seller_id = '$seller_id'";
$product_result = $db->con->query($product_query);
?>

<div class="card overflow-hidden">
  <div class="table-responsive">
    <table class="table table-sm">
      <thead>
        <tr>
          <th class="text-truncate">Sl.No.</th>
          <th class="text-truncate">Book Name</th>
          <th class="text-truncate">Category</th>
          <th class="text-truncate">Price</th>
          <th class="text-truncate">Image</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($product_result->num_rows > 0) {
          $sl_no = 1;
          while ($row = $product_result->fetch_assoc()) {
        ?>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div>
                <h6 class="mb-0 text-truncate">
                  <?php echo $sl_no++; ?>
                </h6>
              </div>
            </div>
          </td>
          <td class="text-truncate">
            <?php echo htmlspecialchars($row["item_name"]); ?>
          </td>
          <td class="text-truncate">
            <?php echo htmlspecialchars($row["item_cat"]); ?>
          </td>
          <td class="text-truncate">
            <?php echo htmlspecialchars($row["item_price"]); ?>
          </td>
          <td>
            <div class="avatar avatar-m me-4">
              <img src="<?php echo '../' . htmlspecialchars($row["item_image"]); ?>" alt="Book Image" />
            </div>
          </td>
        </tr>
        <?php }
            } else {
              echo "<tr><td colspan='4'>No Products</td></tr>";
          } ?>
      </tbody>
    </table>
  </div>
</div>
</div>