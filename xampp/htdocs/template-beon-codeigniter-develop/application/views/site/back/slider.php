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
            <div class="mb-4 text-right">
              <a href="<?= base_url('admin/Slider/create');?>"><button type="button" class="btn btn-primary btn-rounded"><i class="mdi mdi-open-in-new"></i> Slider Baru</button></a>
            </div>
            <table id="listSlider" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th width="85%">Nama Slider</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($slider as $s):?>
                <tr>
                  <td>
                    <?= $no?> </td>
                  <td>
                    <?= $s['title']?><br>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/Slider/detail/'.$s['id'])?>"><button type="button" class="btn btn-info btn-circle btn-sm"><i class="fas fa-search-plus"></i> </button></a>
                    <button type="button" class="btn btn-danger btn-circle btn-sm deleted_slider" type="button" data-id="<?= $s['id']?>"><i class="fas fa-trash-alt"></i> </button>
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