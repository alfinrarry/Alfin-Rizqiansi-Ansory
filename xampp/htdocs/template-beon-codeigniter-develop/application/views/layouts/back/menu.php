<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<!-- dashboard -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard')?>"
					 aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">Dashboard</span></a></li>
				<!-- end dashboard -->
				<li class="nav-small-cap">
					<i class="mdi mdi-dots-horizontal"></i>
					<span class="hide-menu">E-commerce</span>
				</li>
				<!-- Produk -->
				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-archive"></i>
						<span class="hide-menu">Produk </span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Product/addProduct')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Tambah Produk</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Product')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Daftar Produk </span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Product/listProductDraft')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Daftar Produk Draft</span>
							</a>
						</li>
					</ul>
				</li>
				<!-- end Produk -->
				<!-- Transaksi -->
				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-cart"></i>
						<span class="hide-menu">Transaksi </span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Transaction')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Transaksi Terjual</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Transaction/fail')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Transaksi Gagal </span>
							</a>
						</li>
					</ul>
				</li>
				<!-- End Transaksi -->
				<!-- Pendapatan -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Transaction/earning')?>"
					 aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Pendapatan</span></a></li>
				<!-- End Pendapatan -->
				<!-- Pendapatan -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Category')?>"
					 aria-expanded="false"><i class="mdi mdi-folder"></i><span class="hide-menu">Kategori Produk</span></a></li>
				<!-- End Pendapatan -->
				<!-- Bantuan -->
				<!-- <li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-comment-multiple-outline"></i>
						<span class="hide-menu">Laporan Member</span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Ticket')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Daftar Tiket</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/Ticket/category')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Kategori Ticket</span>
							</a>
						</li>
					</ul>
				</li> -->
				<!-- end Bantuan -->
				<!-- Contacact -->
				<!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Contact')?>"
					 aria-expanded="false"><i class="mdi mdi-message"></i><span class="hide-menu">Pesan masuk</span></a></li> -->
				<!-- End Contacact -->
				<li class="nav-small-cap">
					<i class="mdi mdi-dots-horizontal"></i>
					<span class="hide-menu">PIS APP</span>
				</li>
				<!-- Pendapatan -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Setting/setHome')?>"
					 aria-expanded="false"><i class="mdi mdi-web"></i><span class="hide-menu">Halaman Beranda</span></a></li>
				<!-- End Pendapatan -->				
				<!-- ongkos kirim -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Setting/setOngkir')?>"
					 aria-expanded="false"><i class="mdi mdi-truck-delivery"></i><span class="hide-menu">Ongkos Kirim</span></a></li>
				<!-- End ongkos kirim -->
				<li class="nav-small-cap">
					<i class="mdi mdi-dots-horizontal"></i>
					<span class="hide-menu">System</span>
				</li>
				<!-- Kategori Halaman -->
				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-comment-multiple-outline"></i>
						<span class="hide-menu">Halaman</span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/page/faq')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> FAQ</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/page/about')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> About</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/page/help')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Help</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/page/')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Halaman Informasi</span>
							</a>
						</li>
					</ul>
				</li>
				<!-- end Kategori Halaman -->				
				<!-- Slider -->
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Slider')?>"
					 aria-expanded="false"><i class="mdi mdi-folder-multiple-image"></i><span class="hide-menu">Slider</span></a></li>
				<!-- End Slider -->
				<!-- User admin -->

				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-account-key"></i>
						<span class="hide-menu">User Admin</span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/user/formAddUser')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Tambah User Admin</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/user/listUser')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> List User Admin</span>
							</a>
						</li>
						</ul>
						




				
				<!-- end user admin -->
				<!-- Pengaturan -->
				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="mdi mdi-settings"></i>
						<span class="hide-menu">Pengaturan</span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/setting')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Umum</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/setting/setAddress')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Alamat</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo base_url('admin/setting/other')?>" class="sidebar-link">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Lain</span>
							</a>
						</li>
					</ul>
				</li>
				<!-- end Pengaturan -->
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>