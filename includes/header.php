<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Book Khazana</title>

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="assets/plugins/bootstrap-5.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/plugins/OwlCarousel2/owl.carousel.min.css"/>
    <link
            rel="stylesheet"
            href="assets/plugins/OwlCarousel2/owl.theme.default.min.css"
    />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/colors.css"/>
    <link rel="stylesheet" href="assets/plugins/animate/animate.min.css"/>
    <!--    Connect DB-->
    <?php require "includes/functions.php";?>
</head>

<body>
<header id="header" class="sticky-top">
    <!-- <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
      <p>Hello</p>
      <div class="font-rale font-size-14">
          <a href="#" class="px-3 border-right border-left text-dark">Login</a>
          <a href="#" class="px-3 border-right border-left text-dark">Login</a>
      </div>
    </div> -->

    <!-- Primary navbar -->
    <nav class="navbar navbar-expand-lg bg-light text-dark font-size-14 p-2">
        <div class="container-fluid font-rubik">
            <a class="navbar-brand" href="index.php">BooKhazana</a>
            <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"
                        ><i class="fa-solid fa-house"></i> <span>Home</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sellerhub/index.php"
                        ><i class="fa-solid fa-book"></i> <span>Sell Books</span></a
                        >
                    </li>

                    <li class="nav-item dropdown">
                        <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                        ><i class="fa-solid fa-hashtag"></i>
                            Categories
                        </a>
                       <ul
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdownMenuLink"
                       >
                           <li><a class="dropdown-item" href="#">Cat 1</a></li>
                           <li><a class="dropdown-item" href="#">Cat 2</a></li>
                           <li><a class="dropdown-item" href="#">Cat 3</a></li>
                       </ul>
                    </li>

                    <?php
                    session_start();

                    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            <span>Logout</span></a
                        >
                        </li>';
                    } else {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="login.php"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            <span>Login</span></a
                        >
                        </li>';
                    }
                    ?>
                </ul>
                <form action="#" class="py-2">
                    <a
                            href="cart.php"
                            class="fa-solid fa-bag-shopping font-size-20 text-dark px-2"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="My Wishlist"
                    >
                        <span class="badge"><?php echo count($product->getData('wishlist')); ?></span>
                    </a>
                    <a
                            href="cart.php"
                            class="fa-solid fa-cart-shopping font-size-20 text-dark pe-2"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="My Cart"
                    >
                        <span class="badge"><?php echo count($product->getData('cart')); ?></span>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</header>

<main id="main-content">