<section class="section codepage" data-codepage="<?php echo $codepage ?>"  data-url="<?= base_url('Address/getCity') ?>">
<?php if ($codepage == "profile_address"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a href="<?= base_url('Address/newAddress')?>"><button class="btn btn-sm btn-outline-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
              Add Address
              </button></a>
            </div>
          </div>
          
          <div class="table-responsive">
          <?php if(!empty($_SESSION['success_msg'])):?>
						<div class="alert alert-success" role="alert">
							<?php echo $_SESSION['success_msg']?>
						</div>
					<?php elseif(!empty($_SESSION['fail_msg'])):?>
					<div class="alert alert-danger" role="alert">
						<?php echo $_SESSION['fail_msg']?>
					</div>
					<?php endif;?>
            <table id="listAddress" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                <!-- <th></th> -->
                  <th width="85%">Title</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($address as $add):?>
                <tr>
                <!-- <td></td> -->
                  <td>
                    <small class="date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 
                    <?php echo tgl_indo($add['created_at'])." ".substr($add['created_at'], 10, 6)?> WIB
                    </small><br>
                    <?= ucwords($add['title_address'])?><br>
                    <?= ucwords($add['name']); echo ', '. ucwords($add['phone'])?><br>
                    <?= ucwords($add['province']);echo ', '. ucwords($add['city'])?><br>
                    <?= ucwords($add['subdistrict']);echo ', '.ucwords($add['zip_code'])?><br>
                    <?= ucwords($add['complete_address'])?><br>
                  </td>
                  <td>
                    <?php if ($add['primary'] == 0):?>
                    <button type="button" class="btn btn-info btn-circle btn-sm set-primary" data-id="<?php echo $add['id']?>" data-dir="<?php echo base_url('Address/setPrimary/')?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </button>
                    <?php endif;?>
                    <button type="button" class="btn btn-danger btn-circle btn-sm del_address" data-id="<?php echo $add['id']?>" data-dir="<?php echo base_url('Address/delAddress/')?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                  </td>
                </tr>
              <?php  $no++; endforeach;?>
                </tfoot>
            </table>
					</div>
        </main>
      </div>
    </div>
<?php elseif($codepage == "profile_address_add"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
          </div> 
          <?= form_open('Address/newAddress');  ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="formGroupExampleInput">Judul alamat</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Judul Alamat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="formGroupExampleInput">Nama Penerima</label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nama penerima">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Kota / Kabupaten</label>
                <input name="province_name"  value="" type="hidden">
                <select class="form-control select-province" name="id_province" required>
                <option selected>Pilih...</option>
                <?php foreach($province as $pr):?>
                  <option value="<?php echo $pr->province_id;?>"><?php echo $pr->province?></option>
                <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Kota / Kabupaten</label>
                <input name="city" value="" type="hidden">
                <select class="form-control  select-city" data-url="<?= base_url('Address/getSubdistrict') ?>" name="id_city" required>
                  <option >Pilih...</option> 
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">              
                <label for="exampleFormControlSelect1">Pilih Kecamatan</label>
                <input name="subdistrict" value="" type="hidden">
                <select class="form-control select-district"name="id_district" required>
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="formGroupExampleInput">No Handphone</label>
                <input type="text" name="phone" class="form-control" id="formGroupExampleInput" placeholder="Handphone">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Alamat Lengkap</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="complete_address" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="formGroupExampleInput">Kode POS</label>
                <input type="number" name="zip_code" class="form-control" id="formGroupExampleInput" placeholder="Kode POS">
              </div>
            </div>
            <div class="col-md-12 text-right">
                  <button name="submit" class="btn btn-outline-dark" type="submit"> <span><i class="fas fa-save"></i> Simpan</span>
                  </button>
                </div>
            </div>
          </div>
          </form>
        </main>
      </div>
    </div>
<?php endif;?>
<section>