<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<!-- Column rendering -->
  <?php if ($page_title == 'Perbarui Slider'):?>
	<div class="row">
		<div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Slider</h4>
          <!-- <h6 class="card-subtitle">Untuk mengatur ongkos kirim.</h6> -->
        </div>
        <hr class="m-t-0">
        <?php echo form_open_multipart('admin/Slider/detail/'.$slider['id'], array("class" => "form-horizontal r-separator"));?>
        <div class="card-body">
            <div class="form-group row p-b-15">
            <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Judul Slider</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="title" id="inputEmail3" value="<?= $slider['title']?>" placeholder="Judul Slider">
            </div>
            </div>
            <div class="form-group row p-b-15">
            <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">URL slider</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="url" id="inputEmail3" value="<?= $slider['url']?>" placeholder="URL slider">
            </div>
            </div>
            <div class="form-group row p-b-15">
            <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Urutan Tampil</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="sort" value="<?= $slider['sort']?>" id="inputEmail3">
            </div>
            </div>
            <div class="form-group row p-b-15">
            <div class="offset-md-3 col-sm-9">
                <input type="file" id="input-file-disable-remove" name="img" class="dropify w-100" data-height="200" data-default-file="<?= img_url($slider['img_path']); ?>" data-show-remove="false" />
            </div>              
            </div>
            <div class="form-group row p-b-15">
            <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-control" name="status" id="exampleFormControlSelect1">
                <?php if ($slider['status'] == 1):?>
                    <option value="1" selected>Akfif</option>
                    <option value="0" >NonAktif</option>
                <?php elseif ($slider['status'] == 0):?>
                    <option value="1" >Akfif</option>
                    <option value="0" selected>NonAktif</option>
                <?php endif;?>
                </select>
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
  <?php elseif($page_title == 'Slider Baru'):?>
  <div class="row">
		<div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Slider</h4>
          <!-- <h6 class="card-subtitle">Untuk mengatur ongkos kirim.</h6> -->
        </div>
        <hr class="m-t-0">
        <?php echo form_open_multipart('admin/Slider/create', array("class" => "form-horizontal r-separator"));?>
          <div class="card-body">
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Judul Kategori</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="title" id="inputEmail3" placeholder="Judul Slider">
              </div>
            </div>
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">URL slider</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="url" id="inputEmail3" placeholder="URL slider">
              </div>
            </div>
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Urutan Tampil</label>
              <div class="col-sm-9">
                <input type="number" min="0" class="form-control" name="sort" id="inputEmail3">
              </div>
            </div>
            <div class="form-group row p-b-15">
              <div class="offset-md-3 col-sm-9">
                <input type="file" id="input-file-disable-remove" name="img" class="dropify w-100" data-height="200" data-default-file="" data-show-remove="false" />
              </div>              
            </div>
            <div class="form-group row p-b-15">
              <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Status</label>
              <div class="col-sm-9">
                <select class="form-control" name="status" id="exampleFormControlSelect1">
                    <option value="1" >Akfif</option>
                    <option value="0" >NonAktif</option>
                </select>
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