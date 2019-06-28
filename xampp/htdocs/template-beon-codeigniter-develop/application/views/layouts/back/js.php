<script src="<?php echo vendor_url('plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo vendor_url('plugins/popper/popper.min.js'); ?>"></script>
<script src="<?php echo vendor_url('plugins/bootstrap/bootstrap.min.js'); ?>"></script>
<script src="<?php echo vendor_url('plugins/sweetalert/sweetalert.min.js')?>"></script>

<?php if (@$codepage == "back_login") :?>
 <!-- ============================================================== -->
 <script>
  $('[data-toggle="tooltip"]').tooltip();
  $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
      $("#loginform").slideUp();
      $("#recoverform").fadeIn();
    });
  </script>

<?php elseif (@$codepage == "back_index" ||
  @$codepage == "back_index" ||
  @$codepage == "back_product" ||
  @$codepage == "back_member"||
  @$codepage == "banned_member"||
  @$codepage == "back_transaction"||
  @$codepage == "back_ticket"||
  @$codepage == "back_page" ||
  @$codepage == "back_user" ||
  @$codepage == "profile" ||
  @$codepage == "detail_profile" ||
  @$codepage == "back_addProduct" ||
  @$codepage == "back_addPage" ||
  @$codepage == "list_category" ||
  @$codepage == "back_setting"||
  @$codepage == "back_slider" ||
  @$codepage == "back_addPage" || 
  @$codepage == "back_editProduct" ||
  @$codepage == "detail_profile" || 
  @$codepage == "back_transaction_detail" ||
  @$codepage == "back_earning"||
  @$codepage == "back_contact"||
  @$codepage == "back_setHomePage"||
  @$codepage == "back_setOngkir"||
  @$codepage == "back_category" ||
  @$codepage == "back_category_detail" ||
  @$codepage == "back_slider_detail" ||
  @$codepage == "back_useradmin" ||
  @$codepage == "back_useradmin_detail"  ):?>
  <script src="<?php echo vendor_url('back/js/app.min.js'); ?>"></script>
  <script src="<?php echo vendor_url('back/js/app.init.js'); ?>"></script>
  <script src="<?php echo vendor_url('back/js/app-style-switcher.js'); ?>"></script>
  <script src="<?php echo vendor_url('plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js'); ?>"></script>
  <script src="<?php echo vendor_url('plugins/sparkline/sparkline.js'); ?>"></script>
  <script src="<?php echo vendor_url('back/js/waves.js'); ?>"></script>
  <script src="<?php echo vendor_url('back/js/sidebarmenu.js'); ?>"></script>
  <script src="<?php echo vendor_url('back/js/custom.js'); ?>"></script>

  <?php if (@$codepage =="back_index"):?>
    <!-- charts -->
    <script src="<?php echo vendor_url('plugins/chartist/chartist.min.js'); ?>"></script>
    <script src="<?php echo vendor_url('plugins/chartist/chartist-plugin-tooltip.min.js');?>"></script>
    <!-- End charts -->
    <!-- Ci3 -->
    <script src="<?php echo vendor_url('plugins/c3/c3.min.js'); ?>"></script>
    <script src="<?php echo vendor_url('plugins/c3/d3.min.js'); ?>"></script>
    <!-- End charts -->
    <script src="<?php echo vendor_url('back/js/dashboard3.js'); ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/datatables.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/dataTables.responsive.js') ?>"></script>

  <?php elseif (@$codepage == "back_product" ||
    @$codepage == "back_member" ||
    @$codepage == "banned_member"||
    @$codepage == "back_transaction"||
    @$codepage == "back_ticket"||
    @$codepage == "back_page"||
    @$codepage == "back_user"||
    @$codepage == "back_slider"||
    @$codepage == "back_earning" ||
    @$codepage == "back_list_message"||
    @$codepage == "back_category" ):?>
    <script src="<?php echo vendor_url('plugins/datatables/datatables.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/dataTables.responsive.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/vfs_fonts.js') ?>"></script>

  <?php elseif (@$codepage == "back_addProduct" ||
    @$codepage == "back_addPage" ||
    @$codepage == "back_editProduct" ||
    @$codepage == "back_contact" ):?>
    <script src="<?php echo vendor_url('plugins/summernote/summernote-bs4.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/bootstrapswitch/bootstrap-switch.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/dropzone/dropzone.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/datatables.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/datatables/dataTables.responsive.js') ?>"></script>
    <!--This page JavaScript -->
    <script src="<?php echo vendor_url('plugins/jqueryrepeater/jquery.repeater.min.js') ?>"></script>
    <!-- <script src="<?php echo vendor_url('plugins/jqueryrepeater/repeater-init.js') ?>"></script>   -->
    <script src="<?php echo vendor_url('plugins/jqueryrepeater/dff.js') ?>"></script>
    <script>
      $('body').on('submit', '#form-file-manager', function (e) {
        e.preventDefault();
        alert('Success');
      });
      $('#description').summernote({
        height: 350,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'image', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ],
        buttons: {
          image: function() {
            var ui = $.summernote.ui;
            // create button
            var button = ui.button({
              contents: '<i class="note-icon-picture" />',
              click: function () {
                $('#modal-image').remove();
                $.ajax({
                  url: '<?php echo base_url('filemanager'); ?>',
                  dataType: 'html',
                  beforeSend: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#button-image').prop('disabled', true);
                  },
                  complete: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                    $('#button-image').prop('disabled', false);
                  },
                  success: function(html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                    
                    $('#modal-image').modal('show');
                    
                    $('#modal-image').delegate('a.thumbnail', 'click', function(e) {
                      e.preventDefault();
                      
                      $('#description').summernote('insertImage', $(this).attr('href'));
                                    
                      $('#modal-image').modal('hide');
                    });
                  }
                });						
              }
            });          
            return button.render();
          }
        }
      });
    </script>
  <?php elseif (@$codepage == "back_listCategory" || @$codepage =="back_setting"||
              @$codepage == "back_setHomePage"||
              @$codepage == "back_category_detail" ||
              @$codepage == "back_slider_detail" ):?>
    <script src="<?php echo vendor_url('plugins/dropify/dropify.min.js') ?>"></script>
    <script src="<?php echo vendor_url('plugins/tagsinput/jquery-tagsinput.min.js') ?>"></script>
  <?php elseif (@$codepage == "back_transaction_detail"):?>
    <script src="<?php echo vendor_url('plugins/jquery/jquery.PrintArea.js'); ?>"></script>
  <?php endif; ?>
<script src="<?php echo assets_url('js','custom.back.js'); ?>"></script>
<?php endif; ?>