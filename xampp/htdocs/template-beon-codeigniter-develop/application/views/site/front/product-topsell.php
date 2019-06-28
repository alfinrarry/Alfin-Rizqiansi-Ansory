  <!-- Page title -->
  <section class="pagetitle">
    <div class="container">
      <div class="pagetitle__img" style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>');">
        <h3 class="pagetitle__title">Produk Terbaik</h3>
        <h6 class="pagetitle__breadcrumb"><a href="<?= base_url('bestseller')?>">Home</a> / Produk Terbaik</h6>
      </div>
    </div>
  </section>
  <!-- End Page title -->


  <!-- Content -->
  <section class="section" data-codepage="<?php echo $codepage ?>">
    <div class="container">
      <div class="row pt-3 pb-5 align-items-center">
        <div class="col-md-6">
        </div>
      </div>
      <div class="row">
        <?php foreach($product as $p):?>
        <!-- product list -->
        <div class="col-md-3 product-item">
          <div class="product-cta">
          <?php
          if (isset($p['id_wishlist'] )) {
              if ($p['id_wishlist']!=0) {
                  $class_wishlist="wishlist product-cta__wishfull";
                  $class_wishlist_img = "front/img/icon-wishlist-full.svg";
                  $data_wishlist=' data-product='.$p['id'].' data-id='.$p['id_wishlist'].' data-wishlist=remove';
              } else {
                  $class_wishlist="wishlist product-cta__wishempty";
                  $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
                  $data_wishlist=' data-product='.$p['id'].' data-id="" data-wishlist=add';
              }	
          } else {
              $class_wishlist="wishlist product-cta__wishempty";
              $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
              $data_wishlist=' data-product='.$p['id'].' data-id="" data-wishlist=add';
          }

          $now = strtotime('Y-m-d H:i:s');
          $expire =  strtotime('Y-m-d H:i:s',strtotime('+24 hour',strtotime($p['created_at'])));?>
          <?php if(count_variant_product($p['id'])>0 and @$_SESSION['status']!="admin"):?>
            <a href="#" class="product-cta__cart cart" data-id=<?=$p['id']?>><img src="<?php echo vendor_url('front/img/icon-cart.svg'); ?>" class="img-fluid" /></a>
          <?php endif; ?>
          <?php if(@$_SESSION['status']!="admin"): ?>
            <a href="#" class="<?= $class_wishlist?>" <?= $data_wishlist?>><img src="<?php echo vendor_url($class_wishlist_img); ?>" class="img-fluid" /></a>  
          <?php endif; ?>
          </div>
          <a href="<?= base_url('Product/'.$p['slug_product'])?>"><img src="<?= img_product(thumbImgProduct($p['id'])) ?>" alt="Product" class="product-item__img img-fluid" /></a>
          <h5 class="product-item__title">
            <a href="<?= base_url('Product/'.$p['slug_product'])?>"><?php echo $p['title_product']?></a>
          </h5>
          <h5 class="product-item__price">Rp <?php echo rupiah($p['price'])?></h5>
        </div>
        <!-- end product list -->
        <?php endforeach;?>
      </div>
    </div>
  </section>
  <!-- End Content -->