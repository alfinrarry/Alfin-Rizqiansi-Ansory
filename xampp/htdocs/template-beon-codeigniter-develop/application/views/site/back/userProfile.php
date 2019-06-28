<div class="container-fluid" data-codepage="<?= $codepage?>">

    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-pic m-b-20 m-t-20">
                        <img src="<?= img_profile($useradmin['img_path'])?>" width="150" class="rounded-circle" alt="user">
                        <h4 class="m-t-20 m-b-0"><?= $useradmin['fullname']?></h4>
                        <a href="mailto:<?= $useradmin['email']?>"><?= $useradmin['email']?></a>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-rounded"><i class="fa fa-check"></i> Terverifikasi</button>
                </div>
                <div class="p-25 border-top m-t-15">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <!-- <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i
                                    class="mdi mdi-message font-20 m-r-5"></i>Message</a> -->
                        </div>
                        <div class="col-6">
                            <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i
                                    class="mdi mdi-developer-board font-20 m-r-5"></i>Non Aktifkan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link  active show" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab"
                            aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <?php if ($useradmin['id'] == $_SESSION['id']):?>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month"
                            role="tab" aria-controls="pills-setting" aria-selected="true">Setting</a>
                    </li>
                    <?php endif;?>
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="pname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled value="<?= $useradmin['username']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ename" class="col-sm-3 text-right control-label col-form-label">Fullname</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="Nama Lengkap" value="<?= $useradmin['fullname']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rate" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="Email" value="<?= $useradmin['email']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="stime" class="col-sm-3 text-right control-label col-form-label">Telegram</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="Telegram" value="<?= $useradmin['telegram']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="etime" class="col-sm-3 text-right control-label col-form-label">Whatsapp</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="Whatsapp" value="<?= $useradmin['whatsapp']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="etime" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="No Handphone" value="<?= $useradmin['phone']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="etime" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                        
                                            <input type="text" class="form-control" disabled placeholder="Gender" value=" <?php if ($useradmin['gender'] == 1) echo"Laki-Laki"; else echo"Perempuan"; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="note1" class="col-sm-3 text-right control-label col-form-label">Terdaftar</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled placeholder="Nama Lengkap" value="<?= tgl_indo($useradmin['created_at'])?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                    <?php if ($useradmin['id'] == $_SESSION['id']):?>
                    <div class="tab-pane fade " id="previous-month" role="tabpanel"
                        aria-labelledby="pills-setting-tab">
                        <div class="card-body">
                            <form class="form-horizontal form-material">
                            <form id="detailAdmin" method="post" action="<?php echo base_url('admin/user/detailAdmin/')?>">
                                <div class="form-group">
                                    <label for="fullname" class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="fullname" name="fullname" id="fullname" value="<?= $useradmin['fullname']?>" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="email " class="form-control form-control-line"  value="<?= $useradmin['email']?>" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text"  class="form-control form-control-line"  value="<?= $useradmin['phone']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Whatsapp</label>
                                    <div class="col-md-12">
                                        <input type="text"class="form-control form-control-line"  value="<?= $useradmin['whatsapp']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Telegram</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line"  value="<?= $useradmin['telegram']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Jenis Kelamin</label>
                                    <div class="col-sm-12">
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
                                <?php endif;?>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-success" >Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>