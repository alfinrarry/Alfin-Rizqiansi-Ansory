<!-- Page title -->
<section class="pagetitle">
    <div class="container">
      <div class="pagetitle__img" style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>">
        <h3 class="pagetitle__title"><?php echo $ct['name_category']?></h3>
        <h6 class="pagetitle__breadcrumb">
          <a href="<?= base_url()?>">Home</a> / <a href="<?= base_url('Category/'.$ct['slug_category'])?>"><?php echo $ct['name_category']?></a> / <?= substr($product['title_product'],0,30)?>
        </h6>
      </div>
    </div>
  </section>
  <!-- End Page title -->
  <?php
    if (isset($product['id_wishlist'] )) {
      if ($product['id_wishlist']!=0) {
          $class_wishlist="wishlist product-cta__wishfull";
          $class_wishlist_img = "front/img/icon-wishlist-full.svg";
          $data_wishlist=' data-product='.$product['id'].' data-id='.$product['id_wishlist'].' data-wishlist=remove';
      } else {
          $class_wishlist="wishlist product-cta__wishempty";
          $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
          $data_wishlist=' data-product='.$product['id'].' data-id="" data-wishlist=add';
      }	
  } else {
      $class_wishlist="wishlist product-cta__wishempty";
      $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
      $data_wishlist=' data-product='.$product['id'].' data-id="" data-wishlist=add';
  }

  ?>

  <!-- Content -->
  <section class="py-4 section" data-codepage="<?php echo $codepage ?>">
    <div class="container">
      <div class="row pt-3 pb-5 align-items-center">
        <div class="col-md-6">
          <div class="row">
            <div class="col-3 col-md-2">
              <ul id="product__thumbs" class="product__thumbs list-inline">
              <?php
              if ($img_product == null):?>                
                <li>
                  <a href="<?= img_product()?>">
                    <img
                      src="<?= img_product()?>"
                      alt="<?= $product['title_product']?>"
                      class="img-fluid" />
                  </a>
                </li>
              <?php else:
              foreach ($img_product as $imgs):?>
                <li>
                  <a href="<?= img_product($imgs['img_path'])?>">
                    <img
                      src="<?= img_product($imgs['img_path'])?>"
                      alt="<?= $product['title_product']?>"
                      class="img-fluid" />
                  </a>
                </li>
              <?php endforeach; endif;?>
              </ul>
            </div>
            <div class="col-9 col-md-10">
              <div id="product__main"></div>
              <div class="product-cta">
                <a href="#" class="<?= $class_wishlist?>" <?= $data_wishlist?>><img src="<?php echo vendor_url($class_wishlist_img); ?>" class="img-fluid" /></a>  
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h4 class="product-item__title product-item__title--detail">
            <?= $product['title_product']?>
          </h4>
          <h5 class="product-item__price product-item__price--detail">
            Rp <?= rupiah($product['price'])?>
          </h5>
          <div class="rating-product" id="rating-product" data-rating=" <?php if ($rating['rating'] == null) {echo "0";} else { echo $rating['rating'];}?>"></div>
          <a href="#">(<?= $total_rating?> Review)</a>
          <p>
            <?= substr($product['simple_description'],0,200)?>
          </p>
          <?php if ($variant != null):?>
          <p>
            Tersedia:
            <?php foreach ($variant as $vr):?>
              <span class="badge badge-pill badge-info"><?php echo  $vr['variation']?></span>
            <?php endforeach;?>
          </p>
          <?php endif;?>
          <form action="<?= base_url('Cart/addCart')?>" method="POST" id="cart" class="form-group">
          <input type="hidden" name="product" id="product" value="<?= $product['id']?>">
          <div class="my-4">
            <div class="product__stock">
              <p>stok</p>
              <h5><?php if (count_variant_product($product['id']) == null) {echo "0";} else { echo  count_variant_product($product['id']);}?></h5>
            </div>
            <?php if (count_variant_product($product['id']) != null):?>  
            <div class="product__count">
              <input type="number" value="1" min="0" name="qty" id="qty" max="<?php if (count_variant_product($product['id']) == null) {echo "0";} else { echo  count_variant_product($product['id']);}?>" step="1" />
            </div>
            <?php if ($variant > 1):?>
            <div class="product_variant">
              <select class="custom-select" id="variation" name="variation">
                <?php foreach ($variant as $vr):?>
                <option value="<?php echo  $vr['id']?>"><?php echo  $vr['variation']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <?php endif;?>
          </div>
          <?php endif;?>          
          <?php if (count_variant_product($product['id']) != null):?>
          <div class="product__button">
            <!-- <a href="" class="btn btn-primary btn--long mb-3 mb-lg-0">Masukkan ke keranjang</a>
            <a href="" class="btn btn-outline-primary btn--long">Beli Sekarang</a> -->
            <button class="btn btn-primary btn--long mb-3 mb-lg-0" id="submit-p" type="submit">Masukkan ke keranjang</button>          
            <button class="btn btn-outline-primary btn--long">Beli Sekarang</button>
          </div>   
          <?php endif;?>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <ul
            class="nav nav-pills nav-pills--custom justify-content-center mb-4"
            id="pills-tab"
            role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="pills-description-tab"
                data-toggle="pill"
                href="#pills-description"
                role="tab"
                aria-controls="pills-description"
                aria-selected="true">Deskripsi</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-comment-tab"
                data-toggle="pill"
                href="#pills-comment"
                role="tab"
                aria-controls="pills-comment"
                aria-selected="false">Diskusi</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="pills-review-tab"
                data-toggle="pill"
                href="#pills-review"
                role="tab"
                aria-controls="pills-review"
                aria-selected="false">Review</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="pills-description"
              role="tabpanel"
              aria-labelledby="pills-description-tab">
              <div class="row">
                <div class="col-md-4 col-6">
                  <a
                    class="popup-youtube"
                    href="http://www.youtube.com/watch?v=b73BI9eUkjM"><img
                      src="https://img.youtube.com/vi/b73BI9eUkjM/maxresdefault.jpg"
                      alt="Video"
                      class="img-fluid w-100" /></a>
                </div>
              </div>
              <br />
              <p>
                <?= $product['description']?> 
              </p>
            </div>
            <div
              class="tab-pane fade"
              id="pills-comment"
              role="tabpanel"
              aria-labelledby="pills-comment-tab">
              <form action="<?= base_url('Comment/addComment')?>" method="POST" class="mb-4">
              <input type="hidden" name="product" value="<?php echo $product['id']?>">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Tuliskan diskusi/pertanyaan anda</label>
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3" name="content" ></textarea>
                </div>
                <div class="form-group text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                </div>
              </form>

              <?php foreach($comment_product as $cp):?>
              <!-- LIST COMMENT -->
              <div class="media media-custom">
                <img
                  src="<?= img_profile(getUser($cp['id_user'])['img_path'])?>"
                  class="mr-3 media__img"
                  alt="User" />
                <div class="media-body">
                  <h6 class="mt-0 media__name"><?= $cp['fullname']?></h6>
                  <p><?= $cp['content']?></p>
                  <?php if ($cp['id_user'] == $_SESSION['id'] || $_SESSION['status'] = "admin"):?>
                  <!-- <form action="<?= base_url('Comment/addComment')?>" method="POST">
                  <input type="hidden" name="product" value="<?php echo $product['id']?>">
                  <input type="hidden" name="parent" value="<?= $cp['id']?>">
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      name="content"
                      class="form-control"
                      placeholder="Tulis pesan"
                      aria-describedby="button-addon2" />
                    <div class="input-group-append">
                      <button
                        class="btn btn-outline-secondary"
                        type="submit" name="submit"
                        id="button-addon2">
                        Balas Pesan
                      </button>
                    </div>
                  </div>
                  </form> -->
                  <!-- <?php endif; 
                  foreach($comment_reply as $re):
                  if ($re['parent'] == $cp['id'] && $re['parent'] != 0):?>
                  <div class="media media-custom__nest mt-1">
                    <img
                      src="<?= img_profile(getUser($re['id_user'])['img_path'])?>"
                      class="mr-3 media__img"
                      alt="User" />
                    <div class="media-body">
                      <h6 class="mt-0 media__name"><?= $re['fullname']?></h6>
                      <p><?= $re['content']?></p>
                    </div>
                  </div>	
                  <?php endif;endforeach;?> -->
                </div>
              </div>
              <!-- END LIST COMMENT -->
              <?php endforeach;?>
            </div>
            <div
              class="tab-pane fade"
              id="pills-review"
              role="tabpanel"
              aria-labelledby="pills-review-tab">
              <?php foreach ($review_product as $rp):?>
              <!-- LIST COMMENT -->
              <div class="media media-custom">
                <img
                  src="<?= img_profile(getUser($rp['id_user'])['img_path'])?>"
                  class="mr-3 media__img"
                  alt="User" />
                <div class="media-body">
                  <h6 class="mt-0 media__name"><?= $rp['fullname']?></h6>
                  <div class="rating-review" id="rating-review" data-rating="<?= $rp['rating']?>"></div>
                  <p>
                    <?= $rp['description']?>
                  </p>
                </div>
              </div>
              <!-- END LIST COMMENT -->
              <?php endforeach;?>
              <!-- END PAGINATION COMMENT -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Content -->

  <!-- RELATED PRODUCT -->
  <section>
    <div class="container">
      <h4 class="mb-4">Produk Terkait</h4>
      <div class="row">
        <?php foreach($recent_product as $p):?>
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
            }?>
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
  <!-- END RELATED PRODUCT -->