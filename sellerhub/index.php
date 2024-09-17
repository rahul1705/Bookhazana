<?php
ob_start();
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../login.php");
  exit;
}
require "../db/DBController.php";
$db = new DBController();
$user_id = $_SESSION['id'];
// Determine which page to show based on URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'sell-history';

?>

<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
  data-style="light">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Seller Dashboard</title>

  <meta name="description" content="" />


  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="./assets/vendor/fonts/remixicon/remixicon.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="./assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="./assets/css/demo.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="./assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="./assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Seller Hub</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="menu-toggle-icon d-xl-block align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboards -->
          <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ri-home-smile-line"></i>
              <div data-i18n="Dashboards">Dashboard</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item <?= ($page == 'sell-history') ? 'active' : '' ?>">
                <a href="index.php" class="menu-link">
                  <div data-i18n="Selling-History">My Inventory</div>
                </a>
              </li>
              <li class="menu-item <?= ($page == 'add-product') ? 'active' : '' ?>">
                <a href="index.php?page=add-product" class="menu-link">
                  <div data-i18n="Selling-History">Add Books</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Account -->
          <li class="menu-header mt-7"><span class="menu-header-text">Account</span></li>
          <!-- Pages -->
          <li class="menu-item <?= ($page == 'profile') ? 'active' : '' ?>">
            <a href="index.php?page=profile" class="menu-link">
              <div class="avatar avatar-sm me-4">
                <img src="./assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
              </div>
              <div data-i18n="Account Settings">My Profile</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../" class="menu-link">
              <i class="ri-store-3-fill me-4"></i>
              <div data-i18n="Account Settings">Buyer Portal</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
              <i class="ri-menu-fill ri-24px"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center fw-medium fs-4">
                <strong class="">Bookhazana</strong>
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">

            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row gy-4">

              <?php
              // Include the corresponding PHP file
              switch ($page) {
                case 'add-product':
                  include_once "partials/_add-product.php";
                  break;
                case 'profile':
                  include_once "partials/_my-profile.php";
                  break;
                case 'sell-history':
                default:
                  include_once "partials/_sell-history.php";
                  break;
              }
              ?>

            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div
                class="footer-container d-flex align-items-center justify-content-center py-4 flex-md-row flex-column">
                <div class="text-body mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by <strong>Bookhazana</strong>
                </div>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="./assets/vendor/libs/jquery/jquery.js"></script>
  <script src="./assets/vendor/libs/popper/popper.js"></script>
  <script src="./assets/vendor/js/bootstrap.js"></script>
  <script src="./assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="./assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Main JS -->
  <script src="./assets/js/main.js"></script>

</body>

</html>

<?php
// End output buffering
ob_end_flush();
?>