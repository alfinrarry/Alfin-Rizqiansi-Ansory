<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<!-- Column rendering -->
  <?php if ($page_title == 'Perbarui Kategori'):?>
	<div class="row">
		<div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Kategori</h4>
          <!-- <h6 class="card-subtitle">Untuk mengatur ongkos kirim.</h6> -->
        </div>
        <hr class="m-t-0">
        <?php echo form_open_multipart('admin/Category/detail/'.$category['id'], array("class" => "form-horizontal r-separator"));?>
          <div class="card-body">
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Judul Kategori</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Host" value="<?= $category['name_category']?>">
              </div>
            </div>
            <div class="form-group row p-b-15">
              <div class="offset-md-3 col-sm-9">
                <input type="file" id="input-file-disable-remove" name="img" class="dropify w-100" data-height="200" data-default-file="<?= img_url($category['img_path']); ?>" data-show-remove="false" />
              </div>              
            </div>
          </div>
          <hr>
          <div class="card-body">
            <div class="form-group m-b-0 text-right">
              <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
            </div>
          </div>
        </form>
      </div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
  <?php elseif($page_title == 'Kategori Baru'):?>
  <div class="row">
		<div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Kategori</h4>
          <!-- <h6 class="card-subtitle">Untuk mengatur ongkos kirim.</h6> -->
        </div>
        <hr class="m-t-0">
        <?php echo form_open_multipart('admin/Category/create', array("class" => "form-horizontal r-separator"));?>
          <div class="card-body">
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Judul Kategori</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Nama Kategori">
              </div>
            </div>
            <div class="form-group row p-b-15">
              <div class="offset-md-3 col-sm-9">
                <input type="file" id="input-file-disable-remove" name="img" class="dropify w-100" data-height="200" data-default-file="" data-show-remove="false" />
              </div>              
            </div>
          </div>
          <hr>
          <div class="card-body">
            <div class="form-group m-b-0 text-right">
              <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
            </div>
          </div>
        </form>
      </div>
		</div>
	</div>
  <?php endif;?>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->