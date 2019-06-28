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
					<div class="table-responsive">
            <table id="listTransaction" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th width="65%">Invoice</th>
                  <th width="15%">Pembeli</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($transaction as $tr):?>
                <tr>
                  <td>
                    <?= $no?> </td>
                  <td>
                    <small class="date">
                      <span class="far fa-clock"></span> <?php echo tgl_indo($tr['created_at'])." ".substr($tr['created_at'], 10, 6)?> WIB
                    </small><br>
                    <?= $tr['invoice_code']?><br>
                    <?php if ($tr['status'] == -1):?>
										    <span class="label label-danger">Expired</span>
										<?php elseif($tr['status'] == -2):?>
                        <span class="label label-danger">Failed</span>
										<?php elseif($tr['status'] == 0):?>
                        <span class="label label-warning">Unpaid</span>
										<?php elseif($tr['status'] == 1):?>
                        <span class="label label-info">Paid</span>
										<?php elseif($tr['status'] == 2):?>
                        <span class="label label-primary">Deliver</span>
										<?php elseif($tr['status'] == 3):?>
                        <span class="label label-success">Success</span>
										<?php endif;?>
                  </td>
                  <td>
                    <?= ucwords($tr['fullname'])?> </td>
                  <td>
                    <a href="<?php echo base_url('admin/Transaction/detail/'.$tr['invoice_code'])?>"><button type="button" class="btn btn-info btn-circle btn-sm"><i class="fas fa-search-plus"></i> </button></a>
                    <?php if ($tr['status'] < 1):?>
                      <button type="button" class="btn btn-success btn-circle btn-sm approve-trans" type="button" data-id="<?= $tr['id']?>" data-dir="<?php echo base_url('admin/Transaction/approve/')?>"><i class="fa fa-check"></i> </button>
                    <?php elseif($tr['status'] = 1):?>
                      <button type="button" class="btn btn-danger btn-circle btn-sm doapprove-trans" type="button" data-id="<?= $tr['id']?>" data-dir="<?php echo base_url('admin/Transaction/doApprove/')?>"><i class="fa fa-times"></i> </button>
                    <?php endif;?>
                    <button type="button" class="btn btn-danger btn-circle btn-sm del-trans" type="button" data-id="<?= $tr['id']?>" data-dir="<?php echo base_url('admin/Transaction/del_transaction/')?>"><i class="fas fa-trash-alt"></i> </button>
                  </td>
                </tr>
              <?php  $no++; endforeach;?>
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