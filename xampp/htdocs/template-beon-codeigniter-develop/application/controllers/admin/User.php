<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends PIS_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_user','user');
  }
  

  public function index()
  {
    $data['codepage'] = "back_login";
    $data['page_title'] 	= 'Login';
    if($this->user->logged_id()){ 
      base_url('sarimin'); 
    } else { 
      $this->form_validation->set_rules('email', 'E-mail', 'required'); 
      $this->form_validation->set_rules('password', 'Password', 'required'); //jika session belum terdaftar 
      if ($this->form_validation->run() == false) {
        base_url('sarimin'); 
      } else { 
        $data_user = array(
          'email'     => $_POST['email'],
          'password'  => $_POST['password']
        );
        $checking = $this->user->checkLoginAdmin($data_user); 
        if ($checking == true) { 
          foreach ($checking as $apps) {
              $session_data = array( 
               'id'         => $apps->id,
               'username'   => $apps->username,
               'email'      => $apps->email, 
               'fullname'   => $apps->fullname,
               'status'     => 'admin'
              ); 
              $this->session->set_userdata($session_data); 
              redirect(base_url('admin/dashboard'));
          } 
        } else { 
          redirect(base_url('sarimin'));
        } 
      } 
    } 
    $this->template->back_views('site/back/login',$data);
  }
  public function logout(){
    $this->session->sess_destroy();    
    redirect(base_url('sarimin'));
  }

  public function create_user(){
    $data['codepage'] = "back_addProduct";
    $data['page_title'] 	= 'Add User Admin';
    if(isset($_POST['submit'])){
      if (isset($_POST['status']) == null ) {
        $status = 1;
      }else{
        $status = 0;
       
           }
      $firstname = $_POST ['firstname'];
      $lastname  = $_POST ['lastname'];
      $fullname  = $firstname." ".  $lastname;
      $username  = $_POST ['username'];
      $data_admin = array(
      
        'username'         => $_POST['username'] ,
        'email'            => $_POST['email'],
        'password'         => $_POST['password'] ,
        'id_role'          => $_POST['id_role'] ,
        'created_at'       => date('Y-m-j H:i:s'),
      );
      $data = $this->user->create_useradmin($data_admin);
      $result= $this->user->getId($username)->row(); 
      $getId= $result->id;
      $data_admin_detail = array(
        'id_useradmin'     => $getId,
        'fullname'         => $fullname ,
        'telegram'         => $_POST['telegram'] ,
        'whatsapp'         => $_POST['whatsapp'] ,
        'phone'            => $_POST['phone'] ,
        'gender'            => $_POST['gender'] ,
        'created_at'       => date('Y-m-j H:i:s'),
      );
      $data = $this->user->create_useradminDetail($data_admin_detail);
      redirect(base_url('admin/user/listUser'));
    }
    
  }

  public function formAddUser(){
    $data['codepage']     = "back_addProduct";
    $data['page_title'] 	= 'Add User Admin';
    $data['userAdminRole']         = $this->user->getAllRole()->result_array();
    $this->template->back_views('site/back/addUser',$data);
  }

 

  public function listUser(){
    $data['codepage'] = "back_user";
    $data['page_title'] 	= 'List User Admin';
    $data['user']    = $this->user->getListUser()->result_array();
    
    
    
    $this->template->back_views('site/back/listUser',$data);
    
  }

  public function banAdmin($id){
    return $this->user->banadmin($id);      
  }
  public function detailAdmin(){
    $data['codepage']     = "back_useradmin_detail";
    $data['useradmin']    = $this->user->getUserAdminByUsername($this->uri->segment(3))->row_array();
    $data['userAdminRole']         = $this->user->getAllRole()->result_array();
    $data['page_title'] 	= 'Detail user '.$data['useradmin']['fullname'];
    
    if(isset($_POST['submit'])){
      print_r($_POST);die();
      if (isset($_POST['status']) == null ) {
        $status = 1;
      }else{
        $status = 0;
       
           }
      
       
           
      $firstname = $_POST ['firstname'];
      $lastname  = $_POST ['lastname'];
      $fullname  = $firstname." ".  $lastname;
      $data_useradmin = array(
      
        'username'         => $_POST['username'] ,
        'email'            => $_POST['email'],
        'password'         => $_POST['password'] ,
        'updated_at'       => date('Y-m-j H:i:s'),
      );
      $data = $this->user->updateDataAdmin($_POST['id'],$data_useradmin);
     
      $data_useradminDetail = array(
        
        'fullname'         => $fullname ,
        'telegram'         => $_POST['telegram'] ,
        'whatsapp'         => $_POST['whatsapp'] ,
        'phone'            => $_POST['phone'] ,
        'gender'            => $_POST['gender'] ,
        'updated_at'       => date('Y-m-j H:i:s'),
      );
      print_r($data_useradmin, $data_useradminDetail);
      die();
      $data = $this->user->update_DataAdminDetail($_POST['id_useradmin'],$data_useradminDetail);
      redirect(base_url('admin/user/listUser'));
    
  }
   
    
    $this->template->back_views('site/back/userProfile',$data);
  
  }

  public function del_useradmin($id){
    $this->user->deluserAdmin($id);
    $this->user->deluserAdminDetail($id_useradmin);
    redirect(base_url("admin/user/listUser"));

}
}

/* End of file User.php */
