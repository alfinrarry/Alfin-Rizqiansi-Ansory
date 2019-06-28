<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<!-- Column rendering -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<?php if(!empty($_SESSION['success_msg'])):?>
						<div class="alert alert-success" role="alert">
							<?php echo $_SESSION['success_msg']?>
						</div>
					<?php elseif(!empty($_SESSION['fail_msg'])):?>
					<div class="alert alert-danger" role="alert">
						<?php echo $_SESSION['fail_msg']?>
					</div>
					<?php endif;?>
					<div class="table-responsive">
						<table id="listProduct" class="table table-striped" style="width:100%">
							<thead>
								<tr>
									<th></th>
									<th width="65%" >Nama Produk</th>
									<th>Dilihat</th>
									<th>Qty</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
              <?php
              $no = 1;
              foreach ($product as $p):?>
                <tr>
                    <td><?= $no?></td>
                    <td><?= $p['title_product']?></td>
                    <td><?= count_view_product($p['id'])?></td>
                    <td><?= count_variant_product($p['id'])?></td>
                    <td>
                      <button class="btn btn-twitter waves-effect btn-rounded waves-light btn-info btn-sm edit-product " type="button" onclick="location.href='<?php echo base_url('admin/product/edit/'.$p['slug_product'])?>" ><i class="fas fa-pencil-alt"></i></button>
                      <a href="<?php echo base_url('admin/product/editProduct/'.$p['id'])?>"><button class="btn btn-facebook waves-effect btn-rounded waves-light btn-info btn-sm edit-product " type="button"><i class="fas fa-pencil-alt"></i></button></a>
                      <button class="btn btn-googleplus waves-effect btn-rounded waves-light btn-danger btn-sm del-product" type="button" data-id="<?= $p['id']?>" data-dir="<?php echo base_url('admin/Product/del_product/')?>"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>                
              <?php
              $no++; 
              endforeach?>
								</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->