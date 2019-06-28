<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Sales chart -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="mdi mdi-emoticon font-20 text-info"></i>
						</div>
						<div class="col-10">
							<h1 class="font-light text-right mb-0 btn-dahsboard-font"><?php echo rupiah($totProfit);?></h1>
						</div>
						<p class="font-16 m-b-5">Total Profit</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="mdi mdi-image font-20 text-success"></i>
						</div>
						<div class="col-10">
							<h1 class="font-light text-right mb-0 btn-dahsboard-font"><?php echo $qty_sell['qty'];?></h1>
						</div>
						<p class="font-16 m-b-5">Jumlah Produk</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="mdi mdi-currency-eur font-20 text-purple"></i>
						</div>
						<div class="col-10">
							<h1 class="font-light text-right mb-0 btn-dahsboard-font"><?php echo rupiah($countTrx['total_price']);?></h1>
						</div>
						<p class="font-16 m-b-5">Total Pemasukan</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-2">
							<i class="mdi mdi-poll font-20 text-danger"></i>
						</div>
						<div class="col-10">
							<h1 class="font-light text-right mb-0 btn-dahsboard-font"><?php echo $countMember;?></h1>
						</div>
						<p class="font-16 m-b-5">Pengguna Aktif</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Sales chart -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Email campaign chart -->
	<!-- ============================================================== -->
	<?php if ($transaction != null):?>
	<div class="row">
		<div class="col-12">
			<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h4 class="card-title">Traansaksi Baru</h4>
							</div>
						</div>
						<div class="table-responsive">
							<table id="listTransaction" class="table table-striped" style="width:100%">
								<thead>
									<tr>
										<th width="45%">Invoice</th>
										<th width="25%">Pembeli</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach (@$transaction as $c ):?>
									<tr>
										<td>
										<small class="date">
											<span class="far fa-clock"></span> <?php echo tgl_indo($c['created_at'])." ".substr($c['created_at'], 10, 6)?> WIB
										</small><br>
											<?php echo ucwords($c['code_order']);?><br>
											<?php if ($c['status'] == -1):?>
													<span class="label label-danger">Expired</span>
											<?php elseif($c['status'] == -2):?>
													<span class="label label-danger">Failed</span>
											<?php elseif($c['status'] == 0):?>
													<span class="label label-warning">Unpaid</span>
											<?php elseif($c['status'] == 1):?>
													<span class="label label-info">Paid</span>
											<?php elseif($c['status'] == 2):?>
													<span class="label label-primary">Deliver</span>
											<?php elseif($c['status'] == 3):?>
													<span class="label label-success">Success</span>
											<?php endif;?>
										</td>
										<td>
											<?php echo ucwords($c['firstname']).' '.ucwords($c['lastname']);?>
										</td>
										<td>
											<a href="<?php echo base_url('Dashboard/transaction/order/order_user/'.$c['code_order'])?>" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>	 									
											<button class="btn btn-success btn-sm waves-effect waves-light approve-trans" type="button" data-id="<?php echo $c['id_invoice']?>"
											data-dir="<?php echo base_url('Process/approve_trans/')?>"><span class="btn-label"><i class="icon icon-check"></i></span>
												Approve</button>
											<button class="btn btn-danger btn-sm waves-effect waves-light del-trans" type="button" data-id="<?php echo $c['id_invoice']?>"
											data-dir="<?php echo base_url('Process/del_trans/')?>"><span class="btn-label"><i class="mdi mdi-delete-forever"></i></span>
												Hapus</button>
										</td>
									</tr>
									<?php endforeach;?>
									</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h4 class="card-title">Grafik Transaksi Dan kunjungan Web</h4>
						</div>
					</div>
					<?php
						$first  = strtotime('first day this month');
						$months = array();

						for ($i = 6; $i >= 1; $i--) {
						array_push($months, date('F Y', strtotime("-$i month", $first)));
						};
						unset($months);
						$months = array();

						for ($i = 6; $i >= 0; $i--) {
						array_push($months, date('F', strtotime("-$i month", $first)));
						}

						$graph = array();
						$total = $accumulate = $current = 0;
						$totalt = $accumu = $current_t = 0;
						$top_increase = $current_increase = array('value' => 0 ,
																		'month' => '0' );
						foreach ($months as $row) {
								@$produk_bulan_ini = 0;
								foreach ($chartTrx as $value) {
										if ($row == $value->month) {
												if ($accumulate < $value->accumulate) {
														$accumulate =  $value->accumulate;
												}
												$produk_bulan_ini = $value->count;
												if ($produk_bulan_ini > $top_increase['value']) {
														$top_increase['value'] = $produk_bulan_ini;
														$top_increase['month'] = $value->month;
												}
										}
										$current = $row;
										$current_increase['value'] = $value->count;
								}
								// transaksi
								$guest = 0;
								foreach (@$chartGuest as $cg) {
										if ($row == $cg->month) {
												if ($accumu < $cg->accumulate) {
														$accumu =  $cg->accumulate;
										}
										$guest = $cg->count;
										if ($guest > $top_increase['value']) {
												$top_increase['cg'] = $guest;
												$top_increase['month'] = $cg->month;
												}
												}
												$current_t = $row;
												$top_increase['cg'] = $cg->count;
										}
								array_push($graph, array($current, $produk_bulan_ini, $guest ) );
						}?>
					<ul class="nav nav-pills m-t-30 m-b-30">
							<li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Pengunjung</a> </li>
							<li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Pembelian</a> </li>
					</ul>
					<div class="tab-content br-n pn">
							<div id="navpills-1" class="tab-pane active">
								<div class="visitor ct-charts m-grafik"></div>
								
							</div>
							<div id="navpills-2" class="tab-pane">
								<div class="sales5 ct-charts m-grafik"></div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Statistik Transaksi</h4>
					<div class="status m-t-30" style="height:280px; width:100%"></div>

					<div class="row">
						<div class="col-4 border-right">
							<i class="fa fa-circle text-primary"></i>
							<h4 class="mb-0 font-medium"><?= $chartStatus[0]['success'] ?></h4>
							<span>Success</span>
						</div>
						<div class="col-4 border-right p-l-20">
							<i class="fa fa-circle text-info"></i>
							<h4 class="mb-0 font-medium"><?= $chartStatus[0]['pending'] ?></h4>
							<span>Pending</span>
						</div>
						<div class="col-4 p-l-20">
							<i class="fa fa-circle text-success"></i>
							<h4 class="mb-0 font-medium"><?= $chartStatus[0]['failed'] ?></h4>
							<span>Failed</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Email campaign chart -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Ravenue - page-view-bounce rate -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-sm-12 col-lg-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Recent Comments</h4>
				</div>
				<div class="comment-widgets scrollable" style="height:430px;">
					<!-- Comment Row -->
					<?php 
					foreach($comment as $cm):?>
					<div class="d-flex flex-row comment-row">
						<div class="p-2">
							<img src="<?= img_profile(getUser($cm['id_user'])['img_path'])?>" alt="<?php echo ucwords($cm['fullname']);?>" width="50" class="rounded-circle">
						</div>
						<div class="comment-text w-100">
							<h6 class="font-medium"><?php echo ucwords($cm['fullname']);?></h6>
							<span class="m-b-15 d-block"><?php echo $cm['content']?></span>
							<div class="comment-footer">
								<span class="text-muted float-right"><?php echo tgl_indo($cm['created_at'])?></span>
								<a href="<?php echo base_url("p/".$cm['slug_product'])?>"target= _blank><span class="label label-rounded label-danger">Check Post</span></a>
							</div>
						</div>
					</div>
							<?php
							foreach($reply as $re):
							if ($cm['id_comment'] == $re['parent']) :?>
								<div class="d-flex flex-row comment-row ml-5">
									<div class="p-2">
									<?php if (@$re['img_path'] == null):?>
										<img src="<?php echo img_url(@$system['img_user_default']) ?>" alt="<?php echo ucwords($re['firstname']).' '. ucwords($re['lastname']);?>" width="50" class="rounded-circle">
									<?php else:?>
										<img src="<?php echo img_url($re['img_path'])?>" alt="<?php echo ucwords($re['firstname']).' '. ucwords($re['lastname']);?>" width="50" class="rounded-circle">
									<?php endif;?>
									</div>
									<div class="comment-text w-100">
										<h6 class="font-medium"><?php echo ucwords($re['firstname']).' '. ucwords($re['lastname']);?></h6>
										<span class="m-b-15 d-block"><?php echo $re['content']?></span>
										<div class="comment-footer">
											<span class="text-muted float-right"><?php echo tgl_indo($re['created_at'])?></span>
										</div>
									</div>
								</div>
							<?php
							endif; 
							endforeach;?>
					<?php endforeach;?>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h4 class="card-title">Daftar Produk Minim Stock barang</h4>
						</div>
					</div>
					<div class="table-responsive">
						<table id="listProductDash" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th width="60%">Nama Produk</th>
									<th>Stok</th>
									<th>Terjual</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($product as $p ):?>
								<tr>
									<td>
										<?php echo $p['title_product']?>
									</td>
									<td>
										<?php echo $p['qty']?>
									</td>
									<td>
										<?php echo $p['sell']?>
									</td>
								</tr>
								<?php endforeach;?>
								</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script type="text/javascript">var graph =<?php echo json_encode($graph); ?>; </script>
<script type="text/javascript">var chartstatus =<?php echo json_encode($chartStatus); ?>; </script>