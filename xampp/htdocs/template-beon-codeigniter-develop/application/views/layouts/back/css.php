<?php if(@$codepage == "back_index"):?>
  <link href="<?php echo vendor_url('plugins/c3/c3.min.css');?>" rel="stylesheet">
  <link href="<?php echo vendor_url('plugins/chartist/chartist.min.css'); ?>" rel="stylesheet">
<?php elseif(@$codepage == "back_product" ||
            @$codepage == "back_slider" ||
            @$codepage == "back_transaction"||
            @$codepage == "back_category" ):?>
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/dataTables.bootstrap4.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/responsive.dataTables.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/buttons.dataTables.min.css') ?>">
<?php elseif(@$codepage == "back_addProduct" || 
             @$codepage == "back_editProduct" ||
             @$codepage == "back_user"):?>
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/summernote/summernote-bs4.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/bootstrapswitch/bootstrap-switch.min.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/dropzone/dropzone.min.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/dataTables.bootstrap4.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/responsive.dataTables.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/datatables/buttons.dataTables.min.css') ?>">
<?php elseif(@$codepage == "back_setting" ||
            @$codepage == "back_setHomePage"||
            @$codepage == "back_category_detail" ||
            @$codepage == "back_slider_detail" ):?>
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/dropify/dropify.min.css') ?>">
  <link rel="stylesheet" href="<?php echo vendor_url('plugins/tagsinput/jquery-tagsinput.min.css') ?>">
<?php endif;?>
  <link href="<?php echo vendor_url('back/css/style.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo vendor_url('plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo assets_url('css','custom.back.css'); ?>" rel="stylesheet">