<script src="<?php echo vendor_url('front/js/jquery.min.js'); ?>"></script>
<script src="<?php echo vendor_url('front/js/popper.min.js'); ?>"></script>
<script src="<?php echo vendor_url('front/js/bootstrap.min.js'); ?>"></script>
<?php if ($codepage == "home"):?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script>
  var owlHero = $('.owl-home');
  owlHero.owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    items: 1,
    dots: false
  })
  owlHero.owlCarousel();
  // Go to the next item
  $('.slide-prev').click(function () {
    owlHero.trigger('next.owl.carousel');
  })
  // Go to the previous item
  $('.slide-next').click(function () {
    owlHero.trigger('prev.owl.carousel', [300]);
  })
</script>
<?php elseif($codepage == "category"||
              $codepage == "profile_order_detail"):?>
<script src="<?php echo vendor_url('front/js/jquery.star-rating-svg.js'); ?>"></script>
<script src="<?php echo vendor_url('front/js/ion.rangeSlider.js'); ?>"></script>
<script src="<?php echo vendor_url('front/js/bootstrap-input-spinner.js'); ?>"></script>
  <script>
   $(".rating-product").starRating({
      starSize: 23,
      readOnly: true,
      initialRating: 5,
      useGradient: false,
      activeColor: "#F9EF3C",
      strokeColor: "#F9EF3C"
    });
    $(".rating-filter").starRating({
      starSize: 23,
      useGradient: false
    });
    $("#price-filter").ionRangeSlider({
      type: "double",
      hide_min_max: "hide",
      min: 0
    });
    $(".modal-cart__count").InputSpinner({
      buttonsWidth: "1.5em"
    });
  </script>
<?php elseif($codepage == "cart" ||
    @$codepage == "checkout"):?>
<script src="<?php echo vendor_url('front/js/bootstrap-input-spinner.js'); ?>"></script>
<script src="<?php echo vendor_url('plugins/sweetalert/sweetalert.min.js')?>"></script>
<!-- script for product page -->
<script>
  $(".cart-item__count").InputSpinner({
    buttonsWidth: "1.5em"
  });
</script>
<?php elseif($codepage == "product-detail"):?>
<script src="<?php echo vendor_url('front/js/jquery.star-rating-svg.js'); ?>"></script>
  <script src="<?php echo vendor_url('front/js/bootstrap-input-spinner.js'); ?>"></script>
  <script src="<?php echo vendor_url('front/js/jquery.desoslide.min.js'); ?>"></script>
  <script src="<?php echo vendor_url('front/js/jquery.magnific-popup.js'); ?>"></script>
  <script>
    $(".rating-product").starRating({
      starSize: 23,
      readOnly: true,
      initialRating: 5,
      useGradient: false,
      activeColor: "#F9EF3C",
      strokeColor: "#F9EF3C"
    });
    $(".rating-review").starRating({
      starSize: 16,
      readOnly: true,
      initialRating: 4.5,
      useGradient: false,
      activeColor: "#F9EF3C",
      strokeColor: "#F9EF3C"
    });
    $(".product__count input").InputSpinner({
      buttonsWidth: "1em"
    });
    $("#product__main").desoSlide({
      thumbs: $("#product__thumbs li > a"),
      imageClass: "img-fluid",
      effect: {
        provider: "animate",
        name: "fade"
      },
      controls: {
        show: false,
        keys: false
      },
      overlay: "none"
    });

    $('.popup-youtube').magnificPopup({
      // disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false
    });
  </script>
  <?php elseif($codepage == "profile_order" ||
    $codepage == "profile_ticket" ||
    $codepage == "profile_address"):?>
    <script src="<?php echo vendor_url('plugins/datatables/datatables.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/dataTables.responsive.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/sweetalert/sweetalert.min.js')?>"></script>
<?php endif;?>
<script src="<?php echo assets_url('js','custom.front.js'); ?>"></script>