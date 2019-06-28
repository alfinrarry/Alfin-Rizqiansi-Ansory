<div class="container-fluid" data-codepage="<?php echo @$codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<!-- basic table -->
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Ongkos Kirim</h4>
					<h6 class="card-subtitle">Untuk mengatur ongkos kirim.</h6>
				</div>
				<hr class="m-t-0">
				<form class="form-horizontal r-separator" action="<?= base_url('admin/Setting/setOngkir')?>" method="POST">
					<div class="card-body">
						<div class="form-group row p-b-15">
							<label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Host</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="hosts" id="inputEmail3" placeholder="Host" value="<?= $ongkir['auth_key']?>">
							</div>
						</div>
						<div class="form-group row p-b-15">
							<label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Token</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputEmail3" name="token" placeholder="Token" value="<?= $ongkir['rest_token']?>">
							</div>
						</div>
						<div class="form-group row p-b-15">
							<label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">IP</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="<?= getHostByName(getHostName())?>" disabled>
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
</div>