  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700" rel="stylesheet">
  <link href="<?php echo vendor_url('front/css/fontawesome-all.min.css'); ?>" rel="stylesheet">
  <?php if ($codepage == "home"):?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <?php elseif($codepage == "category" ||
              $codepage == "profile_order_detail"):?>
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/star-rating-svg.css'); ?>" />
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/ion.rangeSlider.css'); ?>" />
    
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/star-rating-svg.css'); ?>" />
  <?php elseif($codepage == "product-detail"):?>
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/star-rating-svg.css'); ?>" />
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/ion.rangeSlider.css'); ?>" />
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/animate.css'); ?>" />
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/jquery.desoslide.css'); ?>" />
    <link rel="stylesheet" href="<?php echo vendor_url('front/css/magnific-popup.min.css'); ?>" />
  <?php elseif($codepage == "profile_order" ||
    @$codepage == "profile_ticket" ||
    @$codepage == "profile_address" ):?>
    <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/responsive.dataTables.css') ?>">
    <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/buttons.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo vendor_url('plugins/sweetalert/sweetalert.css') ?>">
  <?php elseif($codepage == "cart" ||
    @$codepage == "checkout"):?>
    <link rel="stylesheet" href="<?php echo vendor_url('plugins/sweetalert/sweetalert.css') ?>">
  <?php endif;?>
  <link rel="stylesheet" href="<?php echo vendor_url('front/css/style.css'); ?>">
  <link href="<?php echo assets_url('css','custom.front.css'); ?>" rel="stylesheet">