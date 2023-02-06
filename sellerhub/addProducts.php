<?php
session_start();
require "../db/DBController.php";
$db = new DBController();

$book_name_error = $book_price_error = $book_image_error = $book_cat_error = $book_author_error = $book_desc_error = "";
$book_name = $book_price = $book_cat = $book_author = $book_desc = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $book_name = $_POST['item_name'];
  $book_price = $_POST['item_price'];
  $book_cat = $_POST['category'];
  $book_author = $_POST['author'];
  $book_desc = $_POST['desc'];
  $user_id = $_SESSION['id'];
  $book_image = $_FILES['item_image']['name'];

  $allowed_ext = array('png', 'jpg', 'jpeg');
  $file_ext = pathinfo($book_image, PATHINFO_EXTENSION);
  $path = "./assets/products/";

  $filename = $path . time() . '.' . $file_ext;

  if(!in_array($file_ext, $allowed_ext)) {
    echo "Please enter a valid image!";
  } else {
    $query = "INSERT INTO `product`(`user_id`, `item_cat`, `item_name`, `item_price`, `item_image`, `item_author`, `item_desc`) 
    VALUES ('$user_id','$book_cat','$book_name','$book_price','$filename','$book_author','$book_desc')";
    $query_run = $db->con->query($query);
    if($query_run) {
      move_uploaded_file($_FILES['item_image']['tmp_name'], $filename);
    } else {
      echo "Something went wrong!";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add Products - Bookhazana</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <!--    <link rel="shortcut icon" href="../assets/images/favicon.png" />-->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_sidebar.html -->
    <?php include_once "partials/_sidebar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->
      <?php include_once "partials/_navbar.html"; ?>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Add Products </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Navigation</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Products</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Books</h4>
                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Book Name</label>
                      <input type="text" class="form-control" id="item_name" name="item_name"
                        aria-describedby="emailHelp" placeholder="Enter book name" required>
                    </div>
                    <div class="form-group">
                      <label for="item_price">Price</label>
                      <input type="text" class="form-control" name="item_price" id="item_price" placeholder="Price"
                        required>
                    </div>
                    <div class="form-group">
                      <label for="item_image">Image</label>
                      <input type="file" class="form-control" name="item_image" id="item_image" required>
                    </div>
                    <div class="form-group">
                      <label for="category">Category</label>
                      <input type="text" class="form-control" name="category" id="category" placeholder="Category"
                        required>
                    </div>
                    <div class="form-group">
                      <label for="author">Author</label>
                      <input type="text" class="form-control" name="author" id="author" placeholder="Author" required>
                    </div>
                    <div class="form-group">
                      <label for="desc">Description</label>
                      <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                  <!-- <img src=".././assets/products/p1.jpg" alt=""> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include_once "partials/_footer.html"; ?>
      </div>

    </div>
  </div>
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/js/misc.js"></script>
</body>

</html>