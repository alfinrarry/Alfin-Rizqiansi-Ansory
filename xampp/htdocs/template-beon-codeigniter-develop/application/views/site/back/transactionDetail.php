<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-12">
			<div class="card card-body printableArea">
				<h3><b>INVOICE</b> <span class="pull-right">#<?php echo $transaction['invoice_code']?></span></h3>
				<hr>
				<div class="row">
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
						<form action="<?php echo base_url('admin/Transaction/updateReceipt')?>" method="POST">
						<div class="row">
							<div class="col-6 pull-left">
							<?php if ($transaction['status'] >= 1 && $transaction['status'] <= 3) :?>
							<input type="hidden" name="invoice" value="<?php echo $transaction['invoice_code']?>">
								<input type="text"
									class="form-control is-invalid" name="receipt" value="<?php echo $transaction['receipt']?>" id="" aria-describedby="helpId" placeholder="Input Resi Disini">
								<?php if ($transaction['receipt'] != null):?>
                  <small id="name1" class="badge badge-default badge-success form-text text-white float-left">Resi Pengiriman Tersedia</small>
                <?php else:?>
                  <small id="name1" class="badge badge-default badge-info form-text text-white float-left">Masukan Resi Pengiriman</small>
                <?php endif;?>
							<?php endif;?>
							</div>
							<div class="col-6 text-right">
							<?php if($transaction['status']!= -2 && $transaction['receipt'] == null): ?>
								<button id="transaction-failed"  data-id="<?= $transaction['id'] ?>" data-url="<?= base_url('process/transaction_status'); ?>" class="btn btn-danger btn-outline" type="button"> <span><i class="fa fa-times"></i> Batalkan Transaksi</span>
								</button>
							<?php endif; ?>
								<?php if ($transaction['status'] >= 1 && $transaction['status'] <= 3) :?>
                  <?php if ($transaction['receipt'] == null):?>
                    <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-check"></i> Simpan Resi</button>
                  <?php else:?>
                    <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-check"></i> Perbarui Resi</button>
                  <?php endif;?>
								</form>
								<?php elseif ($transaction['status'] >= -1 || $transaction['status'] == 0):?>
								<button class="btn btn-danger approve" data-id="<?= $transaction['id']?>" type="button"> Approve</button>
								<?php endif;?>
								<button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span>
								</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
</div>