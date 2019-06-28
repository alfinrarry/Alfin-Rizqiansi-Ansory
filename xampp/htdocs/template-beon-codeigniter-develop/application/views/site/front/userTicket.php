<section class="section" data-codepage="<?php echo $codepage ?>">
<?php if ($codepage == "profile_ticket"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a href="<?= base_url('Ticket/created')?>"><button class="btn btn-sm btn-outline-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
              New Ticket
              </button></a>
            </div>
          </div>
          
          <div class="table-responsive">
            <table id="listTicket" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th width="75%">Title</th>
                  <th width="15%">Type</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $no = 1;
              foreach ($ticket as $tkt):?>
                <tr>
                  <td>
                    <?= $no?> </td>
                  <td>
                    <small class="date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> 
                    <?php echo tgl_indo($tkt['created_at'])." ".substr($tkt['created_at'], 10, 6)?> WIB
                    </small><br>
                    <?= ucwords($tkt['title'])?><br>
                    <?php if ($tkt['status'] == 0):?>
                        <span class="label label-warning">New</span>
										<?php elseif($tkt['status'] == 1):?>
                        <span class="label label-info">Response</span>
										<?php elseif($tkt['status'] == 2):?>
                        <span class="label label-success">Close</span>
										<?php endif;?>
                  </td>
                  <td>
                    <?= ucwords($tkt['title_type'])?></td>
                  <td>
                    <a href="<?php echo base_url('Ticket/getDetail/'.$tkt['no_ticket'])?>"><button type="button" class="btn btn-info btn-circle btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </button></a>
                  </td>
                </tr>
              <?php  $no++; endforeach;?>
                </tfoot>
            </table>
					</div>
        </main>
      </div>
    </div>
<?php elseif ($codepage == "profile_ticket_add"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
          </div>
          
          <form action="<?= base_url('Ticket/created')?>" method="POST">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="formGroupExampleInput">Judul Tiket</label>
                  <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Judul Tiket">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Jenis Tiket</label>
                  <select class="form-control type_ticket" name="type_ticket">
                  <option selected>Pilih...</option>
                  <?php foreach($type as $ty):?>
                    <option value="<?= $ty['id']?>"><?= $ty['title_type']?></option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
              </div>
              <div class="col-md-12 invoice">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Invoice</label>
                  <select class="form-control" name="invoice" id="exampleFormControlSelect1">
                  <option value="0" selected>Pilih...</option>
                  <?php foreach($invoice as $inv):
                    if ($inv['status'] == 1) {
                      $info = "TERBAYAR";
                    }elseif($inv['status'] == 2){
                      $info = "DIKIRIM";
                    }elseif($inv['status'] == 3){
                      $info = "SELESAI";
                    }elseif($inv['status'] == -1){
                      $info = "GAGAL";
                    }elseif($inv['status'] == -2){
                      $info = "WAKTU HABIS";
                    }elseif($inv['status'] == 0){
                      $info = "BELUM TERBAYAR";
                    }?>
                    <option value="<?= $inv['invoice_code']?>"><?= "[".$info."] ". $inv['invoice_code']?></option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 payment">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Metode</label>
                  <select class="form-control payment_method" name="payment_method" id="exampleFormControlSelect1" require>
                    <option value="0" selected>Pilih...</option>
                  <?php foreach($payments as $pm):?>
                    <option value="<?= $pm['id']?>"><?= $pm['title_payment']?></option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 payment">
                <div class="form-group">
                  <label for="formGroupExampleInput">Atas nama</label>
                  <input type="text" class="form-control" name="bank_name" id="formGroupExampleInput" placeholder="Atas Nama Rekening">
                </div>
              </div>
              <div class="col-md-4 payment">
                <div class="form-group">
                  <label for="formGroupExampleInput">Nomer Rekening</label>
                  <input type="text" class="form-control" name="norek" id="formGroupExampleInput" placeholder="Judul Tiket">
                </div>
              </div>
              <div class="col-md-12 upload">
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>              
              </div>
                
              <div class="col-md-12 mt-4 text-right submit">
                <button class="btn btn-sm btn-success " type="submit" name="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                  Kirim
                </button>
              </div>
            </div>
            
            
          </form>

        </main>
      </div>
    </div>
<?php elseif($codepage == "profile_ticket_detail"):?>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2"><?= $page_title?></h3>
          </div>
          
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?= $ticket['title']?></h4>
            <p><?= $ticket['description']?></p>
            <hr>
            <div class="bd-example bd-example-images">
              <?php foreach (imgTicket($ticket['id_ticket']) as $tf):?>
              <img data-src="holder.js/200x200" class="rounded" alt="200x200" 
              src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16a533c2e86%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16a533c2e86%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2273.640625%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" 
              data-holder-rendered="true" style="width: 100px; height: 100px;">
              <?php endforeach;?>
            </div>
          </div>
          <div class="row">
            <?php foreach ($reply as $rpl):
              if ($rpl['id_user'] == $_SESSION['id'] && $rpl['info'] == 0):?>
            <div class="col-8 mt-3">
              <div class="card">
                <h6 class="card-header text-white bg-success"><?= $rpl['fullname']?></h6>
                <div class="card-body">
                  <p class="card-text">asas</p>
                  <?php 
                  $img_user = imgTicket($rpl['id_ticket']);
                  if ($img_user): ?>
                  <hr>
                  <div class="bd-example bd-example-images">
                    <?php foreach (imgTicket($rpl['id_ticket']) as $tf):?>
                    <img data-src="holder.js/200x200" class="rounded" alt="200x200" 
                    src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16a533c2e86%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16a533c2e86%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2273.640625%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" 
                    data-holder-rendered="true" style="width: 100px; height: 100px;">
                    <?php endforeach;?>
                  </div>
                  <?php endif;?>
                </div>
              </div>
            </div>
            <?php else:?>
            <div class="offset-md-4 col-8  mt-3">
              <div class="card">
                <h6 class="card-header text-white bg-info "><?= $rpl['fullname']?></h6>
                <div class="card-body">
                  <p class="card-text">xxx</p>
                  <hr>
                  <div class="bd-example bd-example-images">
                    <?php foreach (imgTicket($rpl['id_ticket']) as $tf):?>
                    <img data-src="holder.js/200x200" class="rounded" alt="200x200" 
                    src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16a533c2e86%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16a533c2e86%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2273.640625%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" 
                    data-holder-rendered="true" style="width: 100px; height: 100px;">
                    <?php endforeach;?>
                  </div>
                </div>
              </div>
            </div>
            <?php
            endif; 
            endforeach;?>
          </div>          

        </main>
      </div>
    </div>
<?php endif;?>
<section>