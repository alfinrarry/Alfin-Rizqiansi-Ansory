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
              <a href="<?= base_url('admin/Category/create');?>"><button type="button" class="btn btn-primary btn-rounded"><i class="mdi mdi-open-in-new"></i> Kategori Naru</button></a>
            </div>
            <table id="listCategory" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th width="85%">Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($category as $c):?>
                <tr>
                  <td>
                    <?= $no?> </td>
                  <td>
                    <?= $c['name_category']?><br>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/Category/detail/'.$c['id'])?>"><button type="button" class="btn btn-info btn-circle btn-sm"><i class="fas fa-search-plus"></i> </button></a>
                    <button class="btn btn-danger btn-circle btn-sm deleted_category" type="button" data-id="<?= $c['id']?>" data-dir="<?php echo base_url('admin/Category/deleted/'.$c['id'])?>"><i class="fas fa-trash-alt"></i></button>
                    <button class="btn btn-googleplus waves-effect btn-rounded waves-light btn-danger btn-sm deleted_category" type="button" data-id="<?= $c['id']?>" data-dir="<?php echo base_url('admin/Category/deleted/')?>"><i class="fas fa-trash-alt"></i></button>
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