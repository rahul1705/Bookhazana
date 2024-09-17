<?php
ob_start();
require('../db/Users.php');
$users = new Users($db);

// Fetch user data
$user_data = $users->getUserData($user_id);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    'fullname' => $_POST['fullName'],
    'email' => $_POST['email'],
    'mobile' => $_POST['phoneNumber'],
    'address' => $_POST['address']
  ];

  // Process file upload
  if (!empty($_FILES['user_img']['name'])) {
    $target_dir = "../assets/users/";
    $file_extension = pathinfo($_FILES["user_img"]["name"], PATHINFO_EXTENSION);
    $new_file_name = "user_" . $user_id . "." . $file_extension; // Use user ID in the file name
    $target_file = $target_dir . $new_file_name;
    $db_img_path = "assets/users/" . $new_file_name;

    // Check if there is an existing image and delete it
    if (!empty($user_data['user_img']) && file_exists("../" . $user_data['user_img'])) {
      unlink("../" . $user_data['user_img']);
    }

    if (move_uploaded_file($_FILES["user_img"]["tmp_name"], $target_file)) {
      $data['user_img'] = $db_img_path; // Save the path to store in the database
    } else {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Failed to upload image. Please try again.'
      ];
      header("Location: index.php?page=profile");
      exit;
    }
  } else {
    // Retain the old image if no new image is uploaded
    $data['user_img'] = $user_data['user_img'];
  }


  if ($users->updateUserData($user_id, $data)) {
    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Profile updated successfully!'
    ];
  } else {
    $_SESSION['alert'] = [
      'type' => 'danger',
      'message' => 'Failed to update profile. Please try again.'
    ];
  }

  // Redirect to avoid form resubmission
  header("Location: index.php?page=profile");
  exit;
}
ob_end_flush();
?>

<?php
// Display the alert if set
if (isset($_SESSION['alert'])) {
  $alert = $_SESSION['alert'];
  echo "<div class='alert alert-{$alert['type']} alert-dismissible' role='alert'>
          {$alert['message']}
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  unset($_SESSION['alert']);
}
?>
<div class="col-md-12">
  <div class="card mb-6">
    <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-6">
          <img src="<?= !empty($user_data["user_img"]) ? '../' . htmlspecialchars($user_data["user_img"]) : './assets/img/avatars/1.png'; ?>"
            alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="user_img" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-sm btn-primary me-3 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="ri-upload-2-line d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" name="user_img" hidden
                accept="image/png, image/jpeg" />
            </label>
            <div>Allowed JPG, PNG or SVG.</div>
          </div>
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="row mt-1 g-5">
          <div class="col-md-6">
            <div class="form-floating form-floating-outline">
              <input class="form-control" type="text" id="fullName" name="fullName"
                value="<?php echo $user_data['fullname']; ?>" placeholder="Full Name" />
              <label for="fullName">Full Name</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline">
              <input class="form-control" type="text" id="email" name="email" value="<?php echo $user_data['email']; ?>"
                placeholder="E-mail" />
              <label for="email">E-mail</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline">
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                  value="<?php echo $user_data['mobile']; ?>" placeholder="Phone Number" />
                <label for="phoneNumber">Phone Number</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating form-floating-outline">
              <input type="text" class="form-control" id="address" name="address"
                value="<?php echo $user_data['address']; ?>" placeholder="Address" />
              <label for="address">Full Address</label>
            </div>
          </div>
        </div>
        <div class="mt-6">
          <button type="submit" class="btn btn-primary me-3">Save changes</button>
        </div>
    </form>
  </div>
</div>
</div>