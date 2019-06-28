<div class="container-fluid" data-codepage="<?php echo $codepage ?>">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-12">
			<?php echo form_open_multipart('admin/Setting/setHome');?>
			<div class="row">
				<div class="col-md-7">
					<div class="hero-slider">
						<div class="owl-carousel owl-theme owl-home">
							<div class="item">
								<div class="frame-slider-home w-100">
									<div class="frame-slider-home-message">
										<span>Slider</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="hero-horizontal mt-2">
						<div class="overlay overlay-black"></div>
						<input type="file" id="input-file-disable-remove" name="cb_img_path" class="dropify w-100" data-height="200" data-default-file="<?= img_url($home['cb_img_path']); ?>" data-show-remove="false" />
						<div class="hero-text">
							<div class="form-group mt-2">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Judul</span>
									</div>
									<input type="text" class="form-control is-valid" name="cb_title" value="<?= $home['cb_title']?>">
								</div>
							</div>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="cb_desc" placeholder="Deskripsi Singkat"></textarea>
                            <select class="form-control mt-1" name="cb_id_category" required>
								<?php foreach ($category as $ct):?>
									<option value="<?= $ct['id']?>"><?= $ct['name_category']?></option> 
								<?php endforeach;?>
                            </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-md-12">
							<div class="hero-square">
								<div class="overlay overlay-black "></div>
								<input type="file" id="input-file-disable-remove" name="bs_img_path" class="dropify w-100" data-height="200" data-default-file="<?= img_url($home['bs_img_path']); ?>" data-show-remove="false" />
								<div class="hero-text mb-2">
									<div class="form-group mt-2">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Judul</span>
											</div>
											<input type="text" class="form-control is-valid" name="bs_title" value="<?= $home['bs_title']?>">
										</div>
									</div>
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="bs_desc" placeholder="Deskripsi Singkat"><?= $home['bs_desc']?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="hero-vertical">
								<div class="overlay overlay-black"></div>
									<input type="file" id="input-file-disable-remove" name="cc_img_path" class="dropify w-100" data-height="500" data-default-file="<?= img_url($home['cc_img_path']); ?>" data-show-remove="false" />
								<div class="hero-text">
                                    <div class="form-group mt-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control is-valid" name="cc_title" placeholder="Judul" value="<?= $home['cc_title']?>">
                                        </div>
                                    </div>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="cc_desc" placeholder="Deskripsi Singkat"><?= $home['cc_desc']?></textarea>
                                    <select class="form-control mt-1" name="cc_id_category" required>
									<?php foreach ($category as $ct):?>
                                        <option value="<?= $ct['id']?>"><?= $ct['name_category']?></option> 
									<?php endforeach;?>
                                    </select>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="hero-vertical">
								<div class="overlay overlay-black"></div>
								<input type="file" id="input-file-disable-remove" name="cr_img_path" class="dropify w-100" data-height="500" data-default-file="<?= img_url($home['cr_img_path']); ?>" data-show-remove="false" />
								<div class="hero-text">
                                    <div class="form-group mt-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control is-valid" name="cr_title" placeholder="Judul" value="<?= $home['cr_title']?>">
                                        </div>
                                    </div>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="cr_desc" placeholder="Deskripsi Singkat"><?= $home['cr_desc']?></textarea>
                                    <select class="form-control mt-1" name="cr_id_category" required>
										<?php foreach ($category as $ct):?>
											<option value="<?= $ct['id']?>"><?= $ct['name_category']?></option> 
										<?php endforeach;?>
                                    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group m-b-0 text-right mt-3">
						<button class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-cogs"></i></span> Update</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Page Content -->
</div>