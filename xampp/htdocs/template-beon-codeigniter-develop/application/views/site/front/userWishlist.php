<section class="section" data-codepage="<?php echo $codepage ?>">
	<div class="container">
		<div class="row">
			<?php include('sidebar.php');?>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div
					class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h3 class="h2"><?= $page_title?></h3>
				</div>
				<div class="container">
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
                                $data_wishlist=' data-product='.$p['id'].' data-id='.$p['id_wishlist'].' data-wishlist=remove'." data-url=".base_url('Wishlist/action');
                            } else {
                                $class_wishlist="wishlist product-cta__wishempty";
                                $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
                                $data_wishlist=' data-product='.$p['id'].' data-wishlist=add'.' data-url='.base_url('Wishlist/action');
                            }	
                        } else {
                            $class_wishlist="wishlist product-cta__wishempty";
                            $class_wishlist_img = "front/img/icon-wishlist-empty.svg";
                            $data_wishlist=' data-product='.$p['id'].' data-wishlist=add'.' data-url='.base_url('Wishlist/action');
                        }

                        $now = strtotime('Y-m-d H:i:s');
                        $expire =  strtotime('Y-m-d H:i:s',strtotime('+24 hour',strtotime($p['created_at'])));?>
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
			</main>
		</div>
	</div>
	<section>