<section class="section" data-codepage="<?php echo $codepage ?>">
<?php if ($codepage == "profile_order"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
          </div>
          
          <div class="table-responsive">
            <table id="listOrder" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th width="75%">Invoice</th>
                  <th width="15%">Pembeli</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($orders as $ods):?>
                <tr>
                  <td>
                    <?= $no?> </td>
                  <td>
                    <small class="date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 
                    <?php echo tgl_indo($ods['created_at'])." ".substr($ods['created_at'], 10, 6)?> WIB
                    </small><br>
                    <?= $ods['invoice_code']?><br>
                    <?php if ($ods['status'] == -1):?>
										    <span class="badge badge-danger">Expired</span>
										<?php elseif($ods['status'] == -2):?>
                        <span class="badge badge-danger">Failed</span>
										<?php elseif($ods['status'] == 0):?>
                        <span class="badge badge-warning">Unpaid</span>
										<?php elseif($ods['status'] == 1):?>
                        <span class="badge badge-info">Paid</span>
										<?php elseif($ods['status'] == 2):?>
                        <span class="badge badge-primary">Deliver</span>
										<?php elseif($ods['status'] == 3):?>
                        <span class="badge badge-success">Success</span>
										<?php endif;?>
                  </td>
                  <td>
                    <?= ucwords($ods['name'])?> </td>
                  <td>
                    <a href="<?= base_url('Transaction/getDetailByinvoice/'.$ods['invoice_code'])?>"><button type="button" class="btn btn-info btn-circle btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </button></a>
                  </td>
                </tr>
              <?php  $no++; endforeach;?>
                </tfoot>
            </table>
					</div>
        </main>
      </div>
    </div>
<?php elseif ($codepage == "profile_order_detail"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
          </div>
          
          <div class="col-md-12">
            <div class="row">
              <div class="col-6 pull-left">
                <address>
                <img src="<?php echo img_url(@$system['logo']) ?>" class="logo" alt="Pasarmbois">
                  <p class="text-muted m-l-5"><?php echo @$system['complete_address']?>,
                    <br /><?php echo @$system['zip_code']?>,
                    <br /> <?php echo @$system['subdistrict']?>,
                    <br /> <?php echo @$system['city']?>,
                    <br /> <?php echo @$system['province']?> - <?php echo @$system['phone']?></p>
                </address>
              </div>
              <div class="col-6 pull-right text-right">
                <address>
                  <h3>Kepada,</h3>
                  <h4 class="font-bold"><?php echo ucwords($transaction['name'])?></h4>
                  <p class="text-muted m-l-30"><?php echo $transaction['complete_address']?>
                    <br /><?php echo @$transaction['zip_code']?>,
                    <br /><?php echo @$transaction['subdistrict']?>
                    <br /> <?php echo @$transaction['city']?>,
                    <br /> <?php echo @$transaction['province']?> - <?php echo @$transaction['phone']?></p>
                  <p class="m-t-30"><b><?= @$transaction['courier']?> - <?= @$transaction['courirer_service']?></b></p>
                  <p class="m-t-30"><b>Waktu Pembelian :</b> <i class="fa fa-calendar"></i> <?php echo tgl_indo(@$transaction['created_at'])?></p>
                </address>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive m-t-40" style="clear: both;">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Description</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Cost</th>
                    <th class="text-right">Total</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach ($product as $p):?>
                  <tr>
                    <td class="text-center"><?php echo $no?></td>
                    <td><?php echo $p['title_product']?><br><?= $p['variation']?></td>
                    <td class="text-right"><?php echo $p['qty']?> </td>
                    <td class="text-right">Rp <?php echo rupiah($p['price'])?> </td>
                    <td class="text-right">Rp <?php echo rupiah($p['total_price'])?> </td>
                  </tr>
                <?php $no++; 
                endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <div class="pull-right m-t-30 text-right">
              <p>Sub - Total amount: Rp <?php echo rupiah($transaction['total_price'])?> </p>
              <p>Kode Unik Pengiriman : Rp <?php echo rupiah($transaction['price_unique'])?> </p>
              <p>Ongkos kirim : Rp <?php echo rupiah($transaction['delivery_fee'])?> </p>
              <hr>
              <h3><b>Total :</b>Rp <?php $total = $transaction['total_price']+$transaction['price_unique']+$transaction['delivery_fee']; echo rupiah($total)?></h3>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="row">
              <div class="col-6 pull-left">
                <input type="text" class="form-control" readonly name="receipt" value="<?php echo $transaction['receipt']?>" id="" aria-describedby="helpId" placeholder="Input Resi Disini">
                <?php if ($transaction['receipt'] == null):?>
                  <small id="name1" class="badge badge-default badge-info form-text text-white float-left">Resi Pengiriman Belum Tersedia</small>
                <?php else:?>
                  <small id="name1" class="badge badge-default badge-success form-text text-white float-left">Resi Pengiriman Tersedia</small>
                <?php endif;?>
               
              </div>
              <?php if ($transaction['status'] == 2):?>
              <div class="col-md-6 text-right">
                  <button name="submit" class="btn btn-outline-dark" type="submit"> <span><i class="fas fa-save"></i> Paket Diterima</span>
                  </button>
              </div>
              <?php endif;?>
            </div>
            <!-- add review -->
            <?php if ($transaction['receipt'] != null && sizeof($review) == 0):?>
            <hr>
            <div class="pull-right m-t-30 text-left">
              <h3><b>Ulasan Produk</h3>
            </div>
            <hr>
            <form id="formUlasan" action="#"  method="POST">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Product</label>                  
                  <input type="hidden" name="transaction" value="<?php echo $transaction['id']?>">
                  <select class="form-control select-province" name="product" required>
                  <?php foreach ($productR as $i): // 
                        if($i['exist'] == 0 ):?>
                        <option value="<?php echo $i['id_product']?>"> <?php echo $i['title_product']?></option>
                      <<?php endif; 
                    endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-12 mb-4">
                <label for="rating-filter">Rating</label>
                <div class="rating-filter" data-rating="3" id="rating-filter"></div>
              </div>
              <div class="col-md-12">
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
              </div>
              <div class="col-md-12 text-right mt-3">
                  <button class="btn btn-outline-dark" type="submit"> <span><i class="fas fa-save"></i> Tambah Ulasan</span>
                  </button>
              </div>
            </div>
            </form>
            <?php elseif(sizeof($review) > 0):?>
            <div class="col-12">
            <?php foreach(@$review as $rw):?>
              <div class="card mt-1">
                <div class="card-body">
                  <div class="media-body ml-3">
                    <a href="<?= base_url('Product/'.product($rw['id_product'])['slug_product'])?>"><h5><?php echo $rw['title_product']?></h5></a>
                    <span class="rating-product" id="rating-product" data-rating="<?php echo $rw['rating']?>"></span>
                    <small class="ml-2"><?php echo tgl_indo($rw['created_at'])?></small>
                    <p><?php echo $rw['description']?></p>
                  </div>
                </div>
              </div>
            <?php endforeach;?>
            <?php endif;?>
            <!-- End add review -->
            
          </div>


        </main>
      </div>
    </div>
<?php endif;?>
<section>