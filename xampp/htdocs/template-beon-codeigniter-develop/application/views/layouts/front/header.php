   <!-- Modal Search -->
  <div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="modalSearch" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSearch">Cari Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('Home/search')?>" methode="GET" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <input type="hidden" id="isHeader" name="isHeader" value="1">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 <!-- Nav -->
 <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light bg-light">
    <div class="container">
      <div class="d-block d-lg-none">
        <a class="navbar-brand" href ="<?= base_url('Home')?>"><img src="<?php echo vendor_url('front/img/logo.png'); ?>" alt="Logo" class="img-fluid"></a>

        <div class="d-inline-block">
          <a href="#" data-toggle="modal" data-target="#modalSearch"><img src="<?php echo vendor_url('front/img/icon-search.svg'); ?>"
              class="navbar-icon"></a>
          <div class="cart-wrapper">
            <div class="cart-notif">12</div>
            <a href="cart.html"><img src="<?php echo vendor_url('front/img/icon-cart.svg'); ?>" class="navbar-icon"></a>
          </div>
        </div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Kategori
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach ($category as $ct):?>
              <a class="dropdown-item" href="<?php echo base_url('Category/'.$ct['slug_category'])?>"><?= $ct['name_category']?></a>
              <?php endforeach;?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('bestseller');?>">Barang Terlaris</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Informasi
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>

        <a class="navbar-brand mx-auto d-none d-lg-inline-block" href="<?= base_url('Home')?>"><img src="<?php echo vendor_url('front/img/logo.png'); ?>" alt="Logo"
            class="img-fluid"></a>

        <a href="#" data-toggle="modal" data-target="#modalSearch"><img src="<?php echo vendor_url('front/img/icon-search.svg'); ?>" class="navbar-icon d-none d-lg-inline-block"></a>
        <div class="cart-wrapper d-none d-lg-inline-block">
          <div class="cart-notif"></div>
          <a href="<?= base_url('Cart');?>"><img src="<?php echo vendor_url('front/img/icon-cart.svg'); ?>" class="navbar-icon"></a>
        </div>
        <?php  if($this->session->userdata('status') == "user"):?>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <?php echo ucwords(getUser(@$_SESSION['id'])['fullname']);?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?= base_url('User/'.getUser($_SESSION['id'])['username'])?>">Profil</a>
                  <a class="dropdown-item" href="<?php echo base_url('logout')?>">Keluar</a>
                </div>
              </li>          
            </ul>
        <?php else:?>
        <p class="mb-0"><a href="<?php echo base_url('auth');?>" class="info-link">Masuk</a> atau <a href="<?php echo base_url('auth');?>" class="info-link">Daftar
            Baru</a></p>
        <!-- <p class="mb-0"><a href="<?php echo base_url('auth');?>" class="info-link"></a></p> -->

        <?php endif;?>
      </div>
    </div>
  </nav>
  <!-- end Nav -->