<section>
    <div class="container">
      <div class="row">
        <?php include('sidebar.php');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h2">Update Profile</h3>
          </div>
          <?= form_open_multipart('User/wildanmkf/update');  ?>
          <div class="row">
            <div class="col-md-4">
              <div class="media justify-content-center">
                <img src="<?= img_profile(getUser($_SESSION['id'])['img_path'])?>" width="150" height="150" class="img-thumbnail rounded-circle"
                alt="John Thor">
              </div>
              
              <div class="input-group mt-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="userfile" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02">Unggah Foto</label>
                  </div>
                </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="formGroupExampleInput">Username</label>
                <input type="text" class="form-control" value="<?= $_SESSION['username']?>" readonly>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nama Lengkap</label>
                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname']?>" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Jenis Kelamin</label>
                <select class="form-control" name="gender" required>
                  <option <?php if ($user['gender'] == 0) { echo 'selected';}?>value="0" >Perempuan</option>
                  <option <?php if ($user['gender'] == 1) { echo 'selected';}?> value="1" >Laki-laki</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="formGroupExampleInput">Line</label>
                <input type="text" name="line" class="form-control" value="<?= $user['line']?>" placeholder="Line">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">WhatsApp</label>
                <input type="text" name="whatsapp" class="form-control" value="<?= $user['whatsapp']?>" placeholder="Whatsapp">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Telegram</label>
                <input type="text" name="telegram" class="form-control" value="<?= $user['telegram']?>" placeholder="Telegram">
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="formGroupExampleInput">Telepon</label>
                <input type="text" name="phone" class="form-control" value="<?= $user['phone']?>" placeholder="Telephone">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email']?>" placeholder="Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="formGroupExampleInput">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <button name="submit" class="btn btn-outline-dark" type="submit"> <span><i class="fas fa-save"></i> Simpan</span> </button>
            </div>
          </div>
          </form>
        </main>
      </div>
    </div>
<section>