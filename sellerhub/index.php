<?php
session_start();
require "../db/DBController.php";
$db = new DBController();

$sql = "SELECT * FROM product WHERE user_id = {$_SESSION['id']}";
$result = $db->con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Bookhazana</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        <?php include_once "partials/_sidebar.php" ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
          <?php include_once "partials/_navbar.html" ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Selling History </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Navigation</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Selling History</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product Details</h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th> P Name </th>
                                            <th> P. Price </th>
                                            <th> P. Image </th>
                                            <th> P. Uploaded </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($result->num_rows > 0) {

                                            while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="p-2">
                                                <td>
                                                    <?php echo $row["item_name"] ;?>
                                                </td>
                                                <td> <?php echo $row["item_price"] ;?> </td>
                                                <td class="py-1">
                                                    <img src="<?php echo '../' . $row["item_image"] ;?>" style="height: 200px !important; width: 200px;" alt="image" />
                                                </td>
                                                <td> <?php echo $row["item_register"] ;?> </td>
                                            </tr>

                                        <?php }
                                        } else {
                                            echo "No Products";
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
            <?php include_once "partials/_footer.html" ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <script src="assets/js/misc.js"></script>
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>