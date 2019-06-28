<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
<?php $isEdit = $page_title == "Perbarui Produk"? true: false; ?>
		<div class="row">
			<div class="col-12 card">
			<form id="add_user" method="post" action="<?php echo base_url('admin/user/create_user/')?>" data-dir="" data-url="">
			<div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="username" class="control-label col-form-label">Username<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="username" id="username" required <?php if($isEdit) echo "value='".$useradmin['username']."'"?>>
                
                </div>
              </div>
			  <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="firstname" class="control-label col-form-label">Firstname<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="firstname" id="firstname" required <?php if($isEdit) echo "value='".$useradmin['firstname']."'"?>>
                </div>
              </div>
			  <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="lastname" class="control-label col-form-label">Lastname<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="lastname" id="lastname" required <?php if($isEdit) echo "value='".$useradmin['lastname']."'"?>>
                </div>
              </div>
			  <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="email" class="control-label col-form-label">Email<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="email" id="email" required <?php if($isEdit) echo "value='".$useradmin['email']."'"?>>
                
			     <label id="format-invalid" style="display:none;" class="errorreg " for="email">Email yang anda
							masukkan tidak valid</label>
				 <label id="alamat_email-invalid" style="display:none;" class="errorreg" for="alamat_email">Email yang anda
							masukkan sudah terdaftar</label>
				 <label id="alamat_email-valid" style="display:none;" class="success" for="alamat_email">Email yang anda
							masukkan valid</label>
				</div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="telegram" class="control-label col-form-label">Telegram<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="telegram" id="telegram" required <?php if($isEdit) echo "value='".$useradminDetail['telegram']."'"?>>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="whatsapp" class="control-label col-form-label">Whatsapp<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="whatsapp" id="whatsapp" required <?php if($isEdit) echo "value='".$useradminDetail['whatsapp']."'"?>>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="phone" class="control-label col-form-label">Phone<span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="phone" id="phone" required <?php if($isEdit) echo "value='".$useradminDetail['phone']."'"?>>
                </div>
              </div>

			
		        	<div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="jabatan" class="control-label col-form-label">Jabatan<span
                      class="text-danger">*</span></label>
					 
				  <select name="id_role" class="form-control"   id="id_role" required <?php  echo "value='".$useradmin['id_role']."'"?>>
				  <?php foreach($userAdminRole as $r):?>
                  		<option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
						  <?php endforeach ?>
				  </select>
				 
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-12">Jenis Kelamin</label>
                     <div class="col-sm-12 col-md-8">
                     <select class="form-control form-control-line" name="gender">
                    <?php if ($useradmin['gender'] == 1):?>
                       <option value="1" selected>Laki-Laki</option>
                       <option value="0" >Perempuan</option>
                    <?php elseif ($useradmin['gender'] == 0):?>
                      <option value="1" >Laki-Laki</option>
                      <option value="0" selected>Perempuan</option>
                    <?php endif;?>
                      </select>
                      </div>
              </div>
			
			
			<div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="password" class="control-label col-form-label">Password<span
                      class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" required <?php if($isEdit) echo "value='".$useradmin['password']."'"?>>
                </div>
              </div>
                  
					<div class="form-group text-right">
						<button class="btn btn-danger btn-sm waves-effect waves-light" type="submit" name="submit"><span
								class="btn-label"><i class="fas fa-save"></i></span> Simpan</button>
					</div>
				</form>
			</div>