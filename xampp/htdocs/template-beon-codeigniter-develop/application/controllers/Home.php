<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends PIS_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_user','user');
    $this->load->model('Mod_system','system');
  }

  public function tambah(){
    $data = array(
      'nama'  => $_POST['nama'],
      'email' => $_POST['email'],
    );
    $this->user->tambah($data);
  }
  public function index()
  {
    $data['codepage']		= "home";
    $data['set']    = $this->system->homePage()->row_array();
    // print_r($data['set']);die();
    $this->template->front_views('site/front/home', $data);
  }
  public function reset_password()  
  {  
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->helper('security');
    $token = $this->base64url_decode($this->uri->segment(3));           
    $cleanToken = $this->security->xss_clean($token);
    $user_info = $this->user->isTokenValid($cleanToken);
  //either false or array();          
    if(!$user_info){  
      $this->session->set_flashdata('fail_msg_register', 'Token Reset Password tidak valid atau kedaluarsa');  
      redirect(base_url('auth'));   
    } 
    $this->form_validation->set_message('min_length', 'Password Kurang panjang');
    $this->form_validation->set_message('matches', 'Password tidak cocok');          
    $this->form_validation->set_rules('password', 'Pasword kurang banya', 'required|min_length[5]');  
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         
      
    if ($this->form_validation->run() == TRUE) {
      $post = $this->input->post(NULL, TRUE);     
      $cleanPost = $this->security->xss_clean($post);      
      $hashed = md5($cleanPost['password']);         
      $cleanPost['password'] = $hashed;  
      $cleanPost['id_user'] = $user_info->id_user;
      $cleanPost['email']   = $user_info->email; 
      unset($cleanPost['passconf']);   
      if(!$this->user->updatePassword($cleanPost)){
        $this->session->set_flashdata('fail_msg_register', 'Update password gagal.');  
      }else{  
        $this->user->updateToken($cleanPost);
        $this->session->set_flashdata('success_msg_register', 'Password anda sudah  
          diperbaharui. Silakan login.');  
      }  
      redirect(base_url('auth'));  
    }else{
      // $data 	= array ();
    $data = array(
      'codepage' => "reset",
      'token'=>$this->base64url_encode($token)  
    );   
    $this->template->front_views('site/front/login', $data); 
    }  
  }
  public function search(){
    $data['codepage']   = "category";
    $data['keyword']     = $_GET['search'];// != null ? $_GET['search'] : ;
    $data['search']      = '?search='.$_GET['search'].'&isHeader='.$_GET['isHeader'];
    $data['filter']      = null;
    $data['data_filter'] = null;

    // search from header
    if ($_GET['isHeader'] == 1) {
      // pagination
      $config['base_url']     = base_url('Home/Search/');
      $config['total_rows']   = $this->product->countProdukBySearch($data['keyword']);
      $config['per_page']     = $this->site_page_conf()['conf_page_category'];
      $config['uri_segment']  = 3;
      $this->pagination->initialize($config);
      $start = $this->uri->segment(3, 0);
      
      // ubah data menjadi tampilan per limit
      $data['rows']     = $config['total_rows'];
      $data['start']    = $start+1;
      $data['end']      = (($start + $this->site_page_conf()['conf_page_category']) > $config['total_rows']) ? $config['total_rows'] : $start + $this->limit;
      $data['product']	= $this->product->getProductBySearch($data['keyword'],$config['per_page'],$start)->result_array();
    }
    else {
      // pagination
      $config['base_url']     = base_url('Home/Search/');
      $config['total_rows']   = $this->product->countProdukBySearchFilter($data['keyword']);
      $config['per_page']     = $this->site_page_conf()['conf_page_category'];
      $config['uri_segment']  = 3;
      $this->pagination->initialize($config);
      $start                  = $this->uri->segment(3, 0);
      $data_filter            = array('SortBy' => $_GET['SortBy'], 'min' => $_GET['min'], 'max' => $_GET['max'], 'score' => $_GET['score']);

      // ubah data menjadi tampilan per limit
      $data['rows']        = $config['total_rows'];
      $data['start']       = $start+1;
      $data['end']         = (($start + $this->site_page_conf()['conf_page_category']) > $config['total_rows']) ? $config['total_rows'] : $start + $this->limit;
      $data['product']	   = $this->product->getProductBySearchFilter($data['keyword'],$config['per_page'],$start)->result_array();
      $data['filter']      = '&SortBy='.$_GET['SortBy'].'&min='.$_GET['min'].'&max='.$_GET['max'].'&score='.$_GET['score'];
      $data['data_filter'] = json_encode($data_filter);
    }
    // get list subkategori
    $data['paging']       = $this->pagination->create_links();
    $this->template->front_views('site/front/search', $data);
  }
  
}

/* End of file Home.php */