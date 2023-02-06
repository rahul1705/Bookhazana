// home js
$(function () {
  // banner carousel
  $("#banner-area .owl-carousel").owlCarousel({
    dots: true,
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    animateOut: "animate__animated animate__fadeOut",
    animateIn: "animate__animated animate__zoomIn",
  });

  // On Sale Carousel
  $("#on-offer .owl-carousel").owlCarousel({
    loop: false,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 1,
        nav: false,
        dots: true,
      },
      600: {
        items: 3,
        nav: false,
        dots: true,
      },
      1000: {
        items: 5,
        nav: false,
        dots: true,
      },
    },
  });

  // isotope filter
  var $grid = $(".grid").isotope({
    itemSelector: ".grid-item",
    layoutMode: "fitRows",
  });

  // filter items on click
  $(".button-group").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");
    $grid.isotope({ filter: filterValue });
  });

  // Recently Added Carousel
  $("#recently-added .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });
});
// home js ends

// Product section Js
if ($("section").data("title") === "product_page_imgs") {
  var productImg = document.getElementById("productImg");
  var smallImg = document.getElementsByClassName("small-img");

  smallImg[0].onclick = function () {
    productImg.src = smallImg[0].src;
  };
  smallImg[1].onclick = function () {
    productImg.src = smallImg[1].src;
  };
  smallImg[2].onclick = function () {
    productImg.src = smallImg[2].src;
  };
  smallImg[3].onclick = function () {
    productImg.src = smallImg[3].src;
  };
}
