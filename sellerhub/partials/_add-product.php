<?php

// Add Book Code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST['item_name'];
    $book_price = $_POST['item_price'];
    $book_cat = $_POST['category'];
    $book_author = $_POST['author'];
    $book_desc = $_POST['desc'];
    $user_id = $_SESSION['id'];
    $book_image = $_FILES['item_image']['name'];

    $allowed_ext = array('png', 'jpg', 'jpeg', 'svg');
    $file_ext = pathinfo($book_image, PATHINFO_EXTENSION);

    // Correct the path to the 'assets/products' folder
    $path = "../assets/products/";

    // Extract the filename without extension
    $filename = pathinfo($book_image, PATHINFO_FILENAME);

    // Create a unique filename using time() to avoid duplicates
    $unique_filename = $filename . '_' . time() . '.' . $file_ext;
    $upload_path = $path . $unique_filename;

    // Path to store in the database, relative to the application root
    $db_filename = "assets/products/" . $unique_filename;

    if (!in_array($file_ext, $allowed_ext)) {
        $_SESSION['message'] = "Please enter a valid image!";
        $_SESSION['message_type'] = "error";
    } else {
        // Step 1: Check if the seller exists
        $seller_query = "SELECT seller_id FROM seller WHERE user_id = '$user_id'";
        $seller_result = $db->con->query($seller_query);
        $seller_id = null;

        if ($seller_result && $seller_result->num_rows > 0) {
            // Seller exists, retrieve the seller ID
            $seller_row = $seller_result->fetch_assoc();
            $seller_id = $seller_row['seller_id'];
        } else {
            // Step 2: Insert the new seller into the seller table
            $insert_seller_query = "INSERT INTO seller (user_id) VALUES ('$user_id')";
            if ($db->con->query($insert_seller_query) === TRUE) {
                // Step 3: Retrieve the newly inserted seller ID
                $seller_id = $db->con->insert_id;
            } else {
                $_SESSION['message'] = "Error adding seller: " . $db->con->error;
                $_SESSION['message_type'] = "error";
                header("Location: index.php?page=add-product");
                exit;
            }
        }

        // Step 4: Insert the product into the database using the seller ID
        $query = "INSERT INTO products (seller_id, item_cat, item_name, item_price, item_image, item_author, item_desc) 
        VALUES ('$seller_id', '$book_cat', '$book_name', '$book_price', '$db_filename', '$book_author', '$book_desc')";
        $query_run = $db->con->query($query);

        if ($query_run) {
            // Move uploaded file to the specified directory
            if (move_uploaded_file($_FILES['item_image']['tmp_name'], $upload_path)) {
                $_SESSION['message'] = "Book added successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to move uploaded file.";
                $_SESSION['message_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "Something went wrong with the database query!";
            $_SESSION['message_type'] = "error";
        }
    }
    header("Location: index.php?page=profile");
    exit;
}

if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?= $_SESSION['message_type'] == 'success' ? 'success' : 'danger' ?> alert-dismissible"
  role="alert">
  <?= $_SESSION['message'] ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    // Clear the message after displaying it
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
    ?>
<?php endif; ?>


<div class="col-xxl">
  <div class="card mb-1">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Add Book Details</h5>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="item_name">Book Name</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i
                  class="ri-git-repository-commits-line"></i></span>
              <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Harry Potter"
                aria-label="Harry Potter" aria-describedby="basic-icon-default-fullname2" required />
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="item_name">Book Image</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <input type="file" class="form-control" name="item_image" id="item_image" placeholder="Harry Potter"
                aria-label="Harry Potter" accept="image/*" required />
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="item_price">Price</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i
                  class="ri-money-rupee-circle-line"></i></span>
              <input type="number" name="item_price" id="item_price" class="form-control" placeholder="199"
                aria-label="199" aria-describedby="basic-icon-default-company2" required />
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="category">Category</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ri-menu-search-line"></i></span>
              <input type="text" name="category" id="category" class="form-control" placeholder="Science"
                aria-label="Science" aria-describedby="basic-icon-default-email2" required />
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 form-label" for="author">Author</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-phone2" class="input-group-text"><i class="ri-user-star-line"></i></span>
              <input type="text" name="author" id="author" class="form-control phone-mask" placeholder="J. K. Rowling"
                aria-label="J. K. Rowling" aria-describedby="basic-icon-default-phone2" required />
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 form-label" for="desc">Description</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-message2" class="input-group-text"><i
                  class="ri-chat-4-line ri-20px"></i></span>
              <textarea id="desc" name="desc" class="form-control" placeholder="Please write something about the book."
                aria-label="Please write something about the book." aria-describedby="basic-icon-default-message2"
                required></textarea>
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>