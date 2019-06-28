<!-- Page title -->
<section class="pagetitle">
		<div class="container">
			<div class="pagetitle__img" style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>');">
				<h3 class="pagetitle__title">Checkout</h3>
				<h6 class="pagetitle__breadcrumb">
					<a href="<?= base_url();?>">Home</a> / <a href="#"> Cart</a> / Checkout
				</h6>
			</div>
		</div>
	</section>
	<!-- End Page title -->

	<!-- Content -->
	<section class="mt-5 section" data-codepage="<?php echo $codepage ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						<div class="col-md-8">						
							<h5>Ringkasan Pembelian</h5>
						</div>
						<div class="col-md-4 text-right">
							<button class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#list-address" type="button"><span class="btn-label"><i class="fa as fas fa-location-arrow"></i></span> Pilih Alamat</button>
						</div>
					</div>
					<!-- <form id="formCheckout" action="#" data-url="<?= base_url('cart/checkout_process'); ?>" class="bg-light p-3 border shadow-sm"> -->
					<form id="formCheckout" action="#">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="front-name">Nama Penerima*</label>
								<input type="text" class="form-control" name="name" id="front-name" <?php if ($prmAddress['name']) {echo 'value="'.$prmAddress['name'].'"'; echo 'readonly ';}?> />
							</div>
							<div class="form-group col-md-6">
								<label for="phone">Telepon*</label>
								<input type="text" class="form-control" name="phone" pattern="[0]{1}[0-9]{9,12}" id="phone" <?php if ($prmAddress['phone']) {echo 'value="'.$prmAddress['phone'].'"'; echo 'readonly';}?> />
							</div>
							<div class="form-group col-md-6">
								<label for="city">Provinsi</label>
								<input name="province_name"  <?php if ($prmAddress['province']) {echo 'value="'.$prmAddress['province'].'"';}else{ echo 'value=""';}?> type="hidden">
								<select class="form-control select-province" name="id_province" >
									<?php if ($prmAddress['id_province']):?>
										<option value="<?= $prmAddress['id_province'];?>" selected><?= $prmAddress['province'];?></option>										
									<?php else: ?>									
										<option selected>Pilih...</option>
										<?php foreach(@$province as $pr):?>
										<option value="<?php echo $pr->province_id;?>"><?php echo $pr->province?></option>
										<?php endforeach;
									endif;?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="kecamatan">Kota</label>
								<input name="city"  <?php if ($prmAddress['city']) {echo 'value="'.$prmAddress['city'].'"';}else{ echo 'value=""';}?> type="hidden">
								<select class="form-control  select-city" data-url="<?= base_url('Address/getSubdistrict') ?>" name="id_city" >
									<?php if ($prmAddress['id_city']):?>
										<option value="<?= $prmAddress['id_city'];?>" selected><?= $prmAddress['city'];?></option>										
									<?php else: ?>
									<option >Pilih...</option> 
									<?php endif;?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="province">Kecamatan</label>
								<input name="subdistrict" <?php if ($prmAddress['subdistrict']) {echo 'value="'.$prmAddress['subdistrict'].'"';}else{ echo 'value=""';}?> type="hidden">
								<input type="hidden" name="id_subdistrict" class="id_subdistrict" value="<?= $prmAddress['id_subdistrict'];?>" >
								<select class="form-control select-district" name="id_subdistrict" >
								<?php if ($prmAddress['id_city']):?>
										<option value="<?= $prmAddress['id_subdistrict'];?>" selected><?= $prmAddress['subdistrict'];?></option>										
									<?php else: ?>
									<option >Pilih...</option> 
									<?php endif;?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="postal">Kode Pos</label>
								<input type="text" class="form-control" name="zip_code" <?php if ($prmAddress['zip_code']) {echo 'value="'.$prmAddress['zip_code'].'"'; echo 'readonly';}else{ echo 'value=""';}?> id="postal" />
							</div>
							
							<div class="form-group col-md-12">
								<label for="address">Alamat*</label>
								<textarea class="form-control" id="address" name="complete_address"  <?php if ($prmAddress['complete_address']) {echo 'readonly';}?>><?php if ($prmAddress['complete_address']) {echo $prmAddress['complete_address'];}?></textarea>
							</div>
						</div>
						<hr />
						<div class="row">
							<?php $weight=0; $subtotal=0; 
							foreach($cart as $c): 
								if ($c['qty'] >= $c['qty_cart']) {		
								$weight+=$c['weight']*$c['qty_cart'];
								$subtotal+=$c['price']*$c['qty_cart'];
								}
							endforeach; ?>
							<input type="hidden" name="weight" value=<?= $weight; ?>>
							<input type="hidden" name="price_unique" value=<?= $unique_payment; ?>>
							<input type="hidden" name="delivery_fee" value=0 >
							<input type="hidden" name="total_price" value=<?= $subtotal; ?>>
							<div class="form-group col-md-12 bank">
								<label for="bank">Pilih Bank</label>
								<select class="form-control" name="payment">
								<?php foreach ($payment as $pm):?>
									<option value="<?= $pm['id']?>"><?= $pm['name']?></option>
								<?php endforeach;?>
								</select>
							</div>
							<div class="form-group col-md-12 choseshipping">
								<label>Pilih Kurir</label>
								<div class="courier-box">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="courier" id="courier1" value="jne" checked required>
										<label class="form-check-label" for="courier1"><img src="<?php echo vendor_url('front/img/courier-jne.jpg'); ?>" alt="JNE" class="img-fluid courier-box__img"></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="courier" id="courier2" value="pos" required>
										<label class="form-check-label" for="courier2"><img src="<?php echo vendor_url('front/img/courier-pos.jpg'); ?>" alt="POS Indonesia"
											 class="img-fluid courier-box__img"></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="courier" id="courier3" value="wahana" required>
										<label class="form-check-label" for="courier3"><img src="<?php echo vendor_url('front/img/courier-tiki.jpg'); ?>" alt="Tiki" class="img-fluid courier-box__img"></label>
									</div>
								</div>
								<div class="form-group courier-type">
								</div>
								<div class="col-md-12">
									<div class="loader"></div>
								</div>
							</div>
						</div>
				</div>
				<div class="col-lg-4">
					<div class="sticky-top card-sticky">
						<div class="card">
							<div class="card-header">
								<h5>Ringkasan Pembelian</h5>
							</div>
							<div class="card-body">
							<?php $subtotal=0; 
							foreach($cart as $c): 
								if ($c['qty'] >= $c['qty_cart']): ?>
								<div class="row cart-item summary-item align-items-center">
									<div class="col-3">
										<img src="<?= img_product(thumbImgProduct($c['id_product'])) ?>" alt="" class="cart-item__img img-fluid" />
									</div>
									<div class="col-6">
										<h6 class="cart-item__title"><?= substr($c['title_product'],0,25)?>..</h6>
										<h6 class="cart-item__price">Rp <?= rupiah($c['price'])?></h6>
									</div>
									<div class="col-3 text-right">
										<h6 class="mb-0">X<?= rupiah($c['qty_cart'])?></h6>
									</div>
								</div>
								
							<?php $subtotal+=$c['price']*$c['qty_cart']; endif;  endforeach;?>
								<!-- <div class="row cart-item summary-item align-items-center">
									<div class="col-3">
										<img src="<?php echo vendor_url('front/img/product.jpg'); ?>" alt="" class="cart-item__img img-fluid" />
									</div>
									<div class="col-6">
										<h6 class="cart-item__title">Jas Setelan Slimfit</h6>
										<h6 class="cart-item__price">Rp 850.000</h6>
									</div>
									<div class="col-3 text-right">
										<h6 class="mb-0">X2</h6>
									</div>
								</div> -->
								<table class="table summary-table-price text-right">
									<tr>
										<td>Subtotal</td>
										<td>Rp</td>
										<td><?= rupiah($subtotal); ?></td>
									</tr>
									<tr>
										<td>Shipping</td>
										<td>Rp</td>
										<td id="shipping_price">0</td>
									</tr>
									<tr>
										<td>Kode Unik</td>
										<td>Rp</td>
										<td><?= rupiah($unique_payment); ?></td>
									</tr>
									<tr>
										<td>Total</td>
										<td>Rp</td>
										<td id="total_price" data-totalprice="<?= $unique_payment+$subtotal;?>"><?= rupiah($unique_payment+$subtotal);?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="text-center mt-4">
						<?php $address_counter= 1;?>
							<button type="submit" class="btn btn-primary">Bayar Sekarang</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</section>
	<!-- End Content -->
	<!-- sample modal content -->
<div id="list-address" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Daftar Alamat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form id="formAddress" action="<?= base_url('Cart/change_address'); ?>" method="POST">
			<div class="modal-body custom-scroll changeAdress" >
				<?php foreach ($address as $a) :  ?>
					<div class="courier-box">
						<div class="form-check padding-box">
							<input class="form-check-input addr" type="radio" name="addr" id="addr<?= $a['id']?>" <?php if ($a['primary']==1) {echo "checked";}?> value="<?= $a['id']?>" required>
							<label class="form-check-label" for="addr<?= $a['id']?>">
							<div class="card-body ">
								<table class="table addr-table">
									<tr>
										<td>Nama Alamat</td>
										<td><?= $a['title_address'] ?></td>
									</tr>
									<tr>
										<td>Penerima</td>
										<td><?= $a['name']?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td><?= $a['complete_address'].', '.$a['subdistrict'].', '.$a['city'].', '.$a['province'] ?></td>
									</tr>
									<tr>
										<td>Kode Pos</td>
										<td><?= $a['zip_code'] ?></td>
									</tr>
									<tr>
										<td>Telephone</td>
										<td><?= $a['phone']?></td>
									</tr>
								</table>
							</div>
							
							</label>
						</div>
					</div>
				<br>
				<?php endforeach; ?>
			</div>
			<div class="modal-footer">
			<!-- <button type="submit" name="submit" class="btn btn-danger waves-effect waves-light">Save changes</button> -->
				<button type="submit" name="submit" id="submit" class="btn btn-danger waves-effect waves-light save">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->
