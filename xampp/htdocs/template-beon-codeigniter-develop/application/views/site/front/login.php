<!-- Page title -->
<section class="pagetitle">
  <div class="container">
    <div class="pagetitle__img" style="background-image:url('<?php echo vendor_url('front/img/pagetitle.jpg'); ?>');">
      <h3 class="pagetitle__title">Login / Register</h3>
    </div>
  </div>
</section>
<!-- End Page title -->
<!-- Content -->
<?php if ($codepage != 'reset'):?>
<section class="mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <?php if(!empty($_SESSION['success_msg_register'])):?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_msg_register']?>
          </div>
        <?php elseif(!empty($_SESSION['fail_msg_register'])):?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION['fail_msg_register']?>
        </div>
        <?php endif;?>
        <nav>
          <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab"
              aria-controls="nav-login"
              aria-selected="true">Masuk</a>
            <a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab"
              aria-controls="nav-register"
              aria-selected="false">Daftar baru</a>
            <a class="nav-item nav-link" id="nav-forgotpassword-tab" data-toggle="tab" href="#nav-forgotpassword" role="tab"
              aria-controls="nav-forgotpassword"
              aria-selected="false">Lupa Password</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
            <form action="<?php echo base_url('auth'); ?>" method="POST">
              <div class="form-group">
                <label for="loginname">Username / Phone / Email</label>
                <input type="text" name="email" class="form-control" id="loginname">
              </div>
              <div class="form-group">
                <label for="loginpassword">Password</label>
                <input type="password" name="password" class="form-control" id="loginpassword">
              </div>
              <button type="submit" name="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
          </div>
          <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
            <form action="<?php echo base_url('register');?>" method="POST">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="registername">Username</label>
                  <input type="text" class="form-control" name="username" id="registername" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="registeremail">Email Address</label>
                  <input type="email" class="form-control" name="email" id="registeremail" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="registername1">Full name</label>
                  <input type="text" class="form-control" name="fullname" id="registername1">
                </div>
                <div class="form-group col-md-6">
                  <label for="registerphone">Telepon</label>
                  <input type="tel" class="form-control" name="phone" id="registerphone" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password" id="registerpassword">
                </div>
                <div class="form-group col-md-6">
                  <label for="">Confirm Password</label>
                  <input type="password" class="form-control" name="conf_pass" id="registerpassword">
                </div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
          </div>
          <div class="tab-pane fade" id="nav-forgotpassword" role="tabpanel" aria-labelledby="nav-forgotpassword-tab">
            <form action="<?= base_url('forgotpwd')?>" method="POST">
              <div class="form-group userEmail">
                <label for="forgotemail">Email</label>
                <input id="userEmail" type="email" class="form-control" name="email" placeholder="Email">
                <br>
                <div class="alert alert-danger" id="format-pwd-invalid"  style="display:none;" for="forgot">Format email salah, cek kembali penulisan email</div>
                <div class="alert alert-danger" id="forgot-pwd-invalid"  style="display:none;" class="errorreg " for="forgot">Email Tidak Tersedia</div>
                <div class="alert alert-info" id="forgot-valid"  style="display:none;" class="success" for="forgot">Email Tersedia</div>
              </div>
              <button type="submit" name="submit" class="btn btn-primary w-100">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else :?>
<section class="mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <?php if(!empty($_SESSION['success_msg_register'])):?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_msg_register']?>
          </div>
        <?php elseif(!empty($_SESSION['fail_msg_register'])):?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION['fail_msg_register']?>
        </div>
        <?php endif;?>
        <nav>
          <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab"
              aria-controls="nav-login"
              aria-selected="true"></a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
            <?php echo form_open('Home/reset_password/'.$token); ?>
              <div class="form-group">
                <label for="registerPassword">Password Baru</label>
                <input class="form-control" type="password" name="password" value="<?php echo set_value('password'); ?>" required/>
                <?php echo form_error('password'); ?>
              </div>
              <div class="form-group">
                <label for="registerPassword">Konfirmasi Password</label>
                <input type="password" class="form-control" name="passconf" value="<?php echo set_value('passconf'); ?>" />
                <?php echo form_error('passconf'); ?>
              </div>
              <button type="submit" name="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif;?>
<!-- End Content -->