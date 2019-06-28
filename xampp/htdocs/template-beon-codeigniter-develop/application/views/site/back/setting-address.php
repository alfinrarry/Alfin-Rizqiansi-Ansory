<div class="container-fluid" data-codepage="<?php echo $codepage ?>" data-url="<?= base_url('Process/rajaongkir_get_kota') ?>">
<?php if(!empty($_SESSION['success'])):?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				<h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> <?php echo $_SESSION['success']?>.
			</div>
		<?php elseif(!empty($_SESSION['fail'])):?>
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3> <?php echo $_SESSION['fail']?>.
			</div>
		<?php endif;?>
<?php $isEdit = $codepage == "setAddress"? true: false; ?>
	<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="card-body">
          <h5>Alamat Sekarang</h5>
				<?php echo $address['province']; ?>
				<br><?php echo $address['city'];?>
				<?php echo $address['subdistrict'];?>					
				<?php echo $address['complete_address'];?>
				<?php echo $address['zip_code'];?>
				<?php echo $address['phone'];?>
				
				</div>
			</div>
		</div>
		<div class="col-8">
			<div class="card">
				<div class="card-body">
					<form class="m-t-20" action="<?= base_url('Process/updateAddress')?>" method="POST"> 
						<div class="input-group set-address">
							<div class="input-group-prepend">
								<span class="input-group-text">Provinsi</span>
							</div>
							<input name="province"  value="" type="hidden">
							<select class="select2 form-control select2-label select-province" name="id_province" required>
								<option>Select</option>
								<?php foreach($province as $pr):?>
									<option value="<?php echo $pr->province_id;?>"><?php echo $pr->province?></option>
								<?php endforeach;?>
							</select>
            </div>
            <div class="input-group set-address">
							<div class="input-group-prepend">
								<span class="input-group-text">Kota/Kabupaten</span>
							</div>
							<input name="city" value="" type="hidden">
							<select class="select2 form-control select2-label select-city" data-url="<?= base_url('Process/rajaongkir_get_kecamatan') ?>" name="id_city"  required>
								<option>Select</option>
							</select>
            </div>
            <div class="input-group set-address">
							<div class="input-group-prepend">
								<span class="input-group-text">Kecamatan</span>
							</div>
							<input name="subdistrict" value="" type="hidden">
							<select class="select2 form-control select2-label select-district" name="id_subdistrict" required>
								<option value="">Pilih Kecamatan</option>
							</select>
            </div>
            <div class="input-group set-address">
              <div class="col-6">
                <label for="Kodepos">Kodepos</label>
                <input type="text" name="zip_code" class="form-control">
              </div>
              <div class="col-6">
                <label for="Telp">No Telp</label>
                <input type="text" name="phone" class="form-control">
              </div>
							
            </div>
            <div class="set-address">
							<label for="">Alamat Lengkap</label>
              <textarea name="complete_address" id="" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group m-b-0 text-right">
              <button class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-save"></i></span> Update</button>
            </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
