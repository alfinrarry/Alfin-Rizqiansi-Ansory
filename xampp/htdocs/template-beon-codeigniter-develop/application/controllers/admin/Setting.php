<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends PIS_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_system','system');  
    $this->load->model('Mod_address','address');  
  }
  

  public function index()
  {
    $data['codepage'] = "back_setting";
    $data['page_title'] 	= 'Produk';
    $this->template->back_views('site/back/setting',$data);
  }
  public function setAddress()
  {
    $data['codepage']     = "back_setting";
    $data['page_title'] 	= 'Produk';
    $data['address']       = $this->address->getAddressByUser($_SESSION['id'])->row_array();
    $this->template->back_views('site/back/setting-address',$data);
  }
  public function other(){
    $data['codepage'] = "back_setting";
    $data['page_title'] 	= 'Produk';
    $this->template->back_views('site/back/settingOther',$data);
  }
  public function setHome(){
    $data['codepage'] = "back_setHomePage";
    if(isset($_POST['submit'])){
      $config['upload_path']='./assets/img/content/site/';
      $config['allowed_types']='jpg|png|ico';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload',$config);
      if($this->upload->do_upload('cb_img_path'))
      {
          $cb='img/content/site/';
          $cb.=  $this->upload->data('file_name');
      }
      if($this->upload->do_upload('bs_img_path'))
      {
          $bs='img/content/site/';
          $bs.=  $this->upload->data('file_name');
      }
      if($this->upload->do_upload('cc_img_path'))
      {
          $cc ='img/content/site/';
          $cc.=  $this->upload->data('file_name');
      }
      if($this->upload->do_upload('cr_img_path'))
      {
          $cr ='img/content/site/';
          $cr.=  $this->upload->data('file_name');
      }
      // print_r($cb);print_r($bs);print_r($cc);print_r($cr);die();
      $this->system->updateHomePage(@$cb,@$bs,@$cc,@$cr);
    };
    $data['page_title'] 	= 'Seting Homepage';
    $data['home']         = $this->system->homePage()->row_array();
    $this->template->back_views('site/back/settingHome',$data);
  }
  public function setOngkir(){
    if(isset($_POST['submit'])){
      $data = array(
        'auth_key'  => $_POST['hosts'],
        'rest_token'=> $_POST['token']
      );
      $this->system->updateRest($data);
    }
    $data['page_title'] 	= 'Seting Ongkos kirim';
    $data['codepage'] = "back_setOngkir";
    $data['ongkir']  = $this->system->getRest()->row_array();
    $this->template->back_views('site/back/settingOngkir',$data);
  }
  public function slider(){
    $data['codepage']     = "back_slider";
    $data['page_title'] 	= 'Slider';
    $data['slider']       = $this->system->getSlider()->result_array();
    $this->template->back_views('site/back/slider',$data);
  }

}

/* End of file Setting.php */
