 <!-- Content -->
 <section>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="hero-slider">
            <div class="owl-carousel owl-theme owl-home">
              <div class="item">
                <img src="<?php echo vendor_url('front/img/img1.jpg'); ?>" alt="">
              </div>
              <div class="item">
                <img src="<?php echo vendor_url('front/img/img1.jpg'); ?>" alt="">
              </div>
              <div class="item">
                <img src="<?php echo vendor_url('front/img/img1.jpg'); ?>" alt="">
              </div>
            </div>
            <a><img src="<?php echo vendor_url('front/img/icon-prev.png'); ?>" class="custom-nav-slider slide-prev"></a>
            <a><img src="<?php echo vendor_url('front/img/icon-next.png'); ?>" class="custom-nav-slider slide-next"></a>
          </div>
          <div class="hero-horizontal">
            <div class="overlay overlay-black"></div>
            <div class="hero-text">
              <h5><?= $set['cb_title']?></h5>
              <p><?= $set['cb_desc']?></p>
              <a href="products.html" class="btn btn-primary">Belanja Sekarang</a>
            </div>
            <img src="<?= img_url($set['cb_img_path']); ?>" alt="" class="img-fluid w-100">
          </div>
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-12">
              <div class="hero-square">
                <div class="overlay overlay-black"></div>
                <div class="hero-text">
                  <h5><?= $set['bs_title']?></h5>
                  <p><?= $set['bs_desc']?></p>
                  <a href="<?= base_url('bestseller')?>" class="btn btn-primary">Belanja Sekarang</a>
                </div>
                <img src="<?= img_url($set['bs_img_path']); ?>" alt="" class="img-fluid w-100">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="hero-vertical">
                <div class="overlay overlay-black"></div>
                <div class="hero-text">
                  <h5><?= $set['cc_title']?></h5>
                  <p><?= $set['cc_desc']?></p>
                  <a href="products.html" class="btn btn-primary">Belanja Sekarang</a>
                </div>
                <img src="<?= img_url($set['cc_img_path']); ?>" alt="" class="img-fluid w-100">
              </div>
            </div>
            <div class="col-6">
              <div class="hero-vertical">
                <div class="overlay overlay-black"></div>
                <div class="hero-text">
                  <h5><?= $set['cr_title']?></h5>
                  <p><?= $set['cr_desc']?></p>
                  <a href="<?= base_url('Category/');?>" class="btn btn-primary">Belanja Sekarang</a>
                </div>
                <img src="<?= img_url($set['cr_img_path']); ?>" alt="" class="img-fluid w-100">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Content -->