<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends PIS_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_user','user');
    $this->load->model('Mod_system','system');
  }
  public function index()
  {
    $data['codepage'] = "login";
    if($this->user->logged_id()){ 
      base_url('auth'); 
    } else { 
      $this->form_validation->set_rules('email', 'E-mail', 'required'); 
      $this->form_validation->set_rules('password', 'Password', 'required'); //jika session belum terdaftar 
      if ($this->form_validation->run() == false) {
        base_url('auth'); 
      } else { 
        $data_user = array(
          'email'     => $_POST['email'],
          'password'  => $_POST['password']
        );
        $checking = $this->user->check_login($data_user); 
        if ($checking == true) { 
          foreach ($checking as $apps) {
              $session_data = array( 
               'id'         => $apps->id,
               'username'   => $apps->username,
               'email'      => $apps->email, 
               'fullname'   => $apps->fullname,
               'status'     => 'user'
              ); 
              $this->session->set_userdata($session_data); 
              redirect(base_url('Home'));
          } 
        } else { 
          redirect(base_url('auth'));
        } 
      } 
    } 
    $this->template->front_views('site/front/login',$data);
  }
  public function register(){    
    $data['codepage']		= "login";
    if(isset($_POST['submit'])){
      $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required|is_unique[em_users.email]', array(
        'is_unique' => 'This username already exists. Please choose another one.'
      ));
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
      $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'trim|required|min_length[8]|matches[password]' , array(
        'matches' => 'Password does not match.'
      ));
      if ($this->form_validation->run() == false) { 
        $this->template->front_views('site/front/login', $data); 
      } else {
        $data_user = array( 
          'email'      => $_POST['email'], 
          'username'   => $_POST['username'],
          'password'   => hash_password($_POST['password']),
          'id_role'    => 1,
          'created_at' => date('Y-m-j H:i:s'), 
        ); 
        $check_email = $this->user->checkEmail($_POST['email'])->num_rows();
        if ($check_email == 0) {  
          $user = $this->user->create_user($data_user);
          if (!$user){ 
            redirect('register');
          } else {
            $data_detail = array (
              'id_user' => $user, 
              'fullname'   => $_POST['fullname'], 
              'phone'   => $_POST['phone']
            );
            $this->user->create_user_detail($data_detail);
            $this->session->set_flashdata('success_msg_register', 'Daftar Berhasil Silahkan cek email untuk aktivasi');
            $this->template->front_views('site/front/login', $data); 
          } 
        }else {
          $this->session->set_flashdata('fail_msg_register', 'Email sudah terdaftar');
          $this->template->front_views('site/front/login', $data);
        }
      }
    }else{
      $this->session->set_flashdata('fail_msg_register', 'Gagal Mendaftar');
      $this->template->front_views('site/front/login', $data);
    } 
  }

  public function logout(){
    $this->session->sess_destroy();    
    redirect(base_url('auth'));
  }
  public function userDashboard(){
    $data['codepage']		= "profile";
    if($this->user->logged_id()){ 
      $data['user']         = $this->user->getUser($_SESSION['id'])->row_array();
      $this->template->front_views('site/front/dashboard', $data);  
    }else{    
      redirect('Home');      
    }
  }
  public function updateProfile(){
    $data['codepage']		= "profile_update";
    // print_r(getUser($_SESSION['id'])['img_path']);die();
    if($this->user->logged_id()){ 
      $data['user']         = $this->user->getUser($_SESSION['id'])->row_array();
      if(isset($_POST['submit'])){
        $config['upload_path']   = './assets/img/content/user/';
        $config['allowed_types'] = 'gif|jpg|png|ico|svg';
        $this->load->library('upload',$config);   
    
        if($this->upload->do_upload('userfile')){            
            $path = '/user/';
            $path.= $this->upload->data('file_name');
            // print_r($path);die();
            $img = array(
              'img_path' => $path
            );
            $this->user->updateImg($img);
        }
        $data_user = array(
          'fullname'  => $_POST['fullname'],
          'phone'     => $_POST['phone'],
          'gender'    => $_POST['gender'],
          'line'      => $_POST['line'],
          'whatsapp'  => $_POST['whatsapp'],
          'telegram'  => $_POST['telegram'],
          'updated_at'=> date('Y-m-j H:i:s')
        );
        $this->user->updateData($data_user);
        $email = array(
          'email' => $_POST['email']
        );
        $this->user->updateEmail($email);
        $this->template->front_views('site/front/userProfile', $data); 
      }else{
        $this->template->front_views('site/front/userProfile', $data);  
      }
    }else{    
      redirect('Home');      
    }
  }
  public function forgotPwd(){
    $data['code_page']= 'forgotpwd';
    $data 	= array ("page" => "forgot");
    $this->load->library('form_validation');
    $this->load->library('email');
    $config['mailtype'] = 'html'; 
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');            
    if($this->form_validation->run() == FALSE) {  
      $this->template->front_views('site/front/login', $data); 
    }else{  
        $email = $this->input->post('email');  
        $clean = $this->security->xss_clean($email);  
        $userInfo = $this->user->getUserInfoByEmail($clean);
        //build token           
        $token = $this->user->insertToken($userInfo->email);
        $user = $this->user->getUserByEmail($userInfo->email)->row_array();           
        $qstring = $this->base64url_encode($token);
        // $template = $this->system->getEmailByid(2)->row_array();           
        $url = site_url() . '/Home/reset_password/' . $qstring;
        $system = $this->getSystem();
        $subject= 'test';//@$template['subject'];
        $content = array  ( 
          'logo'    => img_url(@$system['logo']),
          'button'    => 'ResetPassword',
          'username'  => $user['username'],
          'fullname'   => $user['fullname'],
          'url'       => $url, 
          'subject'   => @$template['subject'],
          'opening'   => @$template['opening'],
          'content'   => @$template['content'],
          'closing'   => @$template['closing'],
          'detail'    => "",
          'time'      => "",
          'class'     => "",
          'rekening'  => "",
          'value'     => ""
          );
        $message = ''; 
        $message .= $this->load->view('email/email-reset',$content, TRUE);  
        $this->system->mg_send($email, $subject, $message);
        $this->session->set_flashdata('success_msg_register', 'Konfirmasi Reset Password sudah dikirim ke email anda.');  
        redirect(base_url('auth'),'refresh');
    }
  }
  public function checkEmail()
  {
    $email =$_POST['email'];
		$forgotpwd = $this->user->checkEmail($email)->num_rows();
		header('COntent-type: application/json');
		echo json_encode($forgotpwd);
  }
  
}

/* End of file User.php */
