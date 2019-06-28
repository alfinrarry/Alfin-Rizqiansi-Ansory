<!-- Page title -->
<section class="pagetitle">
    <div class="container">
      <div class="pagetitle__img" style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>');">
        <h3 class="pagetitle__title">Cart</h3>
        <h6 class="pagetitle__breadcrumb"><a href="#">Home</a> / Cart</h6>
      </div>
    </div>
  </section>
  <!-- End Page title -->

  <!-- Content -->
  <section>
    <div class="container section" data-codepage="<?php echo $codepage ?>">
    <?php $subtotal=0;
     foreach ($cart as $crt):
      if (@$_SESSION['id']):?>
      <div class="row cart-item">
        <div class="col-1 text-center">
          <a href="#">
            <img src="<?php echo vendor_url('front/img/icon-delete.svg'); ?>" class="cart-item__delete del_item" data-id="<?php echo $crt['id']?>" data-dir="<?php echo base_url('Cart/delItem/')?>" />
          </a>
        </div>
        <div class="col-3 col-md-1">
          <img src="<?php echo vendor_url('front/img/product.jpg'); ?>" alt="" class="cart-item__img img-fluid" />
        </div>
        <div class="col-md-5 col-8">
          <h5 class="cart-item__title"><?= substr(product($crt['id_product'])['title_product'],0,30)?></h5>
          <h6 class="cart-item__variant">[<?= variant($crt['id_product'])['variation']?>][<?= variant($crt['id_product'])['size']?>]</h6>
          <h6 class="cart-item__price ">Rp <?= rupiah(product($crt['id_product'])['price'])?></h6>
        </div>
        <div class="col-6 col-md-3 mt-md-0 mt-3">
          <input class="cart-item__count" type="number" name="qty" value="<?= $crt['qty']?>" min="0" max="<?= variant($crt['id_variation'])['qty']?>" step="1" data-id="<?= $crt['id']?>" data-price="<?= product($crt['id_product'])['price']?>" data-url="<?= base_url('Cart/update') ?>">
        </div>
        <div class="col-6 col-md-2 text-right">
          <h5 class="cart-item__price product_price" data-subprice="<?= product($crt['id_product'])['price']*$crt['qty']?>" id="price_<?= $crt['id']?>">Rp <?= rupiah(product($crt['id_product'])['price']*$crt['qty'])?></h5>
        </div>
      </div>
    <?php else:?>
      <div class="row cart-item">
        <div class="col-1 text-center">
          <a href="#">
            <img src="<?php echo vendor_url('front/img/icon-delete.svg'); ?>" class="cart-item__delete" />
          </a>
        </div>
        <div class="col-3 col-md-1">
          <img src="<?php echo vendor_url('front/img/product.jpg'); ?>" alt="" class="cart-item__img img-fluid" />
        </div>
        <div class="col-md-5 col-8">
          <h5 class="cart-item__title">Jas Setelan Slimfit</h5>
          <h6 class="cart-item__title">Jas Setelan Slimfit</h6>
          <h6 class="cart-item__price">Rp 850.000</h6>
        </div>
        <div class="col-6 col-md-3 mt-md-0 mt-3">
          <input class="cart-item__count" type="number" value="1" min="0" max="100" step="1">
        </div>
        <div class="col-6 col-md-2 text-right">
          <h5 class="cart-item__price">Rp 850.000</h5>
        </div>
      </div>
    <?php endif;
    $subtotal+=product($crt['id_product'])['price']*$crt['qty']; 
    endforeach;?>
      
      <div class="row box-total">
        <div class="col-md-2 col-6 offset-md-8 text-right">
          <h5 class="mb-0">Subtotal</h5>
        </div>
        <div class="col-md-2 col-6 text-right">
          <h5 class="cart-item__price mb-0 price" id="subtotal">Rp <?= rupiah($subtotal)?></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right mt-3">
          <a href="<?= base_url('Cart/checkout')?>" class="btn btn-danger">Bayar Sekarang</a>
        </div>
      </div>
    </div>
  </section>
  <!-- End Content -->