<!-- Page title -->
<section class="pagetitle">
  <div class="container">
    <div
      class="pagetitle__img"
      style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>');">
      <h3 class="pagetitle__title">Checkout</h3>
      <h6 class="pagetitle__breadcrumb">
        <a href="#">Home</a> / <a href="#"> Cart</a> / Checkout
      </h6>
    </div>
  </div>
</section>
<!-- End Page title -->

<!-- Content -->
<section class="mt-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 text-center">
        <img src="<?php echo vendor_url('front/img/icon-check.svg'); ?>" alt="" width="40" class="mb-4">
        <h4 class="text-uppercase">Pesanan telah diproses</h4>
        <p>silahkan melakukan pembayaran dalam
          waktu 4 jam melalui</p>
        <h5 class="mb-3"><?= $transaction['bank_name']?> <br><?= $transaction['account_number']?></h5>
        <a href="<?= base_url()?>" class="btn btn-primary mb-4 mb-md-5 mb-lg-0">Kembali ke homepage</a>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h5>Ringkasan Pembelian</h5>
          </div>
          <div class="card-body">
          <?php foreach ($product as $p):?>
            <div class="row cart-item summary-item align-items-center">
              <div class="col-3">
                <img
                  src="<?= img_product(thumbImgProduct($p['id_product'])) ?>"
                  alt=""
                  class="cart-item__img img-fluid" />
              </div>
              <div class="col-6">
                <h6 class="cart-item__title"><?= substr($p['title_product'],0,25)?>..</h6>
                <h6 class="cart-item__price">Rp <?= rupiah($p['price'])?></h6>
              </div>
              <div class="col-3 text-right">
                <h6 class="mb-0">X<?= $p['qty']?></h6>
              </div>
            </div>
          <?php endforeach;?>

            <table class="table summary-table-price text-right">
              <tr>
                <td>Subtotal</td>
                <td>Rp</td>
                <td><?= rupiah($transaction['total_price'])?></td>
              </tr>
              <tr>
                <td>Shipping</td>
                <td>Rp</td>
                <td><?= rupiah($transaction['delivery_fee'])?></td>
              </tr>
              <tr>
                <td>Total</td>
                <td>Rp</td>
                <td><?= rupiah($transaction['total_price'])?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Content -->
