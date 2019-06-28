<!DOCTYPE html>
<html dir="ltr" lang="en">


<!-- Login Page -->
<?php if(@$codepage == "back_login"): ?>
  <head>
    <?php echo @$_head ?>
    <?php echo @$_css ?>
  </head>
  <body> 
    <div class="main-wrapper"> 
      <?php echo @$_preloader; ?>
      <?php echo @$_body; ?>
    </div>
    <?php echo @$_js; ?>
  </body>
<!-- End Login Page -->

<!-- Other Page -->
<?php else: ?>
  <head>
    <?php echo @$_head ?>
    <?php echo @$_css ?>
  </head>
  <body>  
    <?php echo @$_preloader; ?>
    <div id="main-wrapper">
      <?php echo @$_header; ?>
      <?php echo @$_menu; ?>
      <div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title"><?php echo @$page_title; ?></h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="<?php echo base_url('Dashboard')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo @$page_title; ?></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <?php echo @$_body; ?>
        <?php echo @$_footer; ?>
      </div>
    </div>
    <?php echo @$_js; ?>
  </body>
<!-- End Other Page -->
<?php endif; ?>

</html>

