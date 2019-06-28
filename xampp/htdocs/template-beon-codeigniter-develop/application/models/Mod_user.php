<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_user extends CI_Model {

  protected $user 		       = 'em_users';
  protected $userDetail 	   = 'em_user_details';
  protected $useradmin       = 'em_useradmins';
  protected $useradminDetail = 'em_useradmin_details';
  protected $userRole        = 'em_user_roles';
  protected $userAdminRole   = 'em_useradmin_roles';
  protected $userReset       = 'em_user_resets';

  public function logged_id(){ 
    return $this->session->userdata('id'); 
  }
  //fungsi check login 
  public function check_login($data_user){ 
    $this->db->where("(username='".$data_user['email']."' OR email='".$data_user['email']."')"); 
    $query = $this->db->get($this->user); 
    if ($query->num_rows() == 1) { 
      $hash = $query->row('password'); 
      if (password_verify($data_user['password'],$hash)){ 
        return $query->result(); 
      } else { 
        $this->session->set_flashdata('fail_msg_password', 'Password Salah');
      } 
    } else { 
      $this->session->set_flashdata('fail_msg_account', 'Account Tidak tersedia');
    } 
  } 
  public function create_user($data_user) {
       $this->db->insert($this->user, $data_user); 
       return $this->db->insert_id();
  }
  public function create_user_detail($data_detail){
    return $this->db->insert($this->userDetail, $data_detail); 
  } 
  public function create_useradmin($data_admin){
    return $this->db->insert($this->useradmin, $data_admin); 
  } 
  public function create_useradminDetail($data_admin_detail){
    return $this->db->insert($this->useradminDetail, $data_admin_detail); 
  } 
  public  function checkEmail($email){
    $this->db->where('email',$email);
    return  $this->db->get($this->user);
  }

  // admin
  public function checkLoginAdmin($data_user){ 
    $this->db->where("(username='".$data_user['email']."' OR email='".$data_user['email']."')"); 
    $query = $this->db->get($this->useradmin); 
    if ($query->num_rows() == 1) { 
      $hash = $query->row('password'); 
      if (password_verify($data_user['password'],$hash)){ 
        return $query->result(); 
      } else { 
        $this->session->set_flashdata('fail_msg_password', 'Password Salah');
      } 
    } else { 
      $this->session->set_flashdata('fail_msg_account', 'Account Tidak tersedia');
    } 
  }

  public function addUser($data)
  {
    $this->db->insert($this->useradmin, $data);
    return $this->db->insert_id();
  }

  public function getListUser(){
    $this->db->from($this->useradminDetail);
    $this->db->join($this->useradmin, $this->useradmin.'.id = '.$this->useradminDetail.'.id_useradmin');  
    $this->db->join($this->userAdminRole,$this->useradmin.'.id_role = '.$this->userAdminRole.'.id');
    $this->db->select('*');
    return $this->db->get();
  }

  public function getUser($id=0){
    $this->db->select($this->user.'.*,'.$this->userDetail.'.*');
    $this->db->from($this->user);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->user.'.id');
    $this->db->where($this->user.'.id',$id);
    return $this->db->get();
  }

  public function getRole(){
    
    $this->db->from($this->useradmin);
    $this->db->join($this->userAdminRole,$this->useradmin.'.id_role = '.$this->userAdminRole.'.id');
    $this->db->select($this->useradmin.'.id');
    $this->db->select($this->useradmin.'.fullname');
    $this->db->select($this->userAdminRole.'.name');
    return $this->db->get();
  }

  public function getAllRole(){
    $this->db->select('*');
    $this->db->from($this->userAdminRole);
    return $this->db->get();
  }
  public function updateImg($img){
    $this->db->set($img);
    $this->db->where('id_user', $_SESSION['id']);
    $this->db->update($this->userDetail);    
  }
  public function updateData($data_user){
    $this->db->set($data_user);
    $this->db->where('id_user', $_SESSION['id']);
    $this->db->update($this->userDetail); 
  }

  public function updateDataAdmin($data=0 , $id=0){
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update($this->useradmin); 
  }

  public function updateDataAdminDetail($data=0 , $id_useradmin=0){
    $this->db->set($data);
    $this->db->where('id_useradmin', $id_useradmin);
    $this->db->update($this->useradminDetail); 
  }

  public function updateEmail($email){
    $this->db->set($email);
    $this->db->where('id', $_SESSION['id']);
    $this->db->update($this->user); 
  }
  public function getUserInfoByEmail($email){
    $this->db->select($this->user.'.*,'.$this->userDetail.'.*');
    $this->db->from($this->userDetail);
    $this->db->join($this->user, $this->user.'.id = '.$this->userDetail.'.id_user');
    $this->db->where($this->user.'.email', $email);
    $q = $this->db->get();  
      if($this->db->affected_rows() > 0){  
          $row = $q->row();  
          return $row;  
      }  
  }
  public function getUserByEmail($email){
    $this->db->select($this->user.'.*, '.$this->userDetail.'.*,'.$this->userRole.'.*');
    $this->db->from($this->user);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user'.'='.$this->user.'.id', 'left');
    $this->db->join($this->userRole, $this->userRole.'.id'.'='.$this->user.'.id_role', 'left');   
    $this->db->where($this->user.'.email', $email); 
    return $this->db->get();
}
  public function insertToken($email)  
  {    
    $token = substr(sha1(rand()), 0, 30);
    $user = $this->getUserByEmail($email)->row_array();     
    $string = array( 
        'id_user'    =>$user['id_user'], 
        'token_reset'=> $token,  
        'email'=>$email,
        'status'=>0,
        'created_at' =>date('Y-m-d H:m:s')
      );  
    $query = $this->db->insert_string($this->userReset,$string);  
    $this->db->query($query);  
    return $token . $email;  
  }
  public function isTokenValid($token)  
  {  
    $tkn = substr($token,0,30);  
    $email = substr($token,30);   
    // $this->db->where('token_reset', $tkn);
    // $this->db->where('email', $email);
    // $q = $this->db->get($this->userReset, 1);
    
    $q = $this->db->get_where($this->userReset, array(  
      $this->userReset.'.token_reset' => $tkn,   
      $this->userReset.'.email' => $email, 
      'status'=> 0), 1);               
      
    if($this->db->affected_rows() > 0){  
      $row = $q->row();         
        
      $created = $row->created_at;  
      $createdTS = strtotime($created);  
      $expired = date('Y-m-d H:i:s',strtotime('+4 hour',strtotime($created)));   
      $exp = strtotime($expired);  
        
      if($createdTS > $exp){  
        return false;  
      }  
      $user_info = $this->getUserInfoByEmail($row->email);  
      return $user_info;  
        
    }else{  
      return false;  
    }  
  }
  public function updatePassword($cleanPost)  
  {    
    $this->db->where('id', $cleanPost['id_user']);  
    $this->db->update($this->user, array('password' => $cleanPost['password']));     
    return true;
  }
  public function updateToken($cleanPost){ 
    $this->db->where('email', $cleanPost['email']);  
    $this->db->update($this->userReset, array('status' => 1));
    return true;  
  }
  public function countMember(){
    // $this->db->where('deleted_at !=', 000);
    $this->db->from($this->user);
    return $this->db->count_all_results();
  }
  public function getUserAdmin(){
    $this->db->select($this->useradmin.'.username,'.$this->useradmin.'.id,'.$this->useradminDetail.'.*,'.$this->userAdminRole.'.id,'.$this->userAdminRole.'.name as role');
    $this->db->from($this->useradmin);
    $this->db->join($this->useradminDetail, $this->useradminDetail.'.id_useradmin = '.$this->useradmin.'.id');    
    $this->db->join($this->userAdminRole, $this->userAdminRole.'.id = '.$this->useradmin.'.id_role');
    return $this->db->get();
  }
  public function banadmin($id){
    $this->db->set('is_ban',0);
    $this->db->where('id', $id);
    $this->db->update($this->useradmin); 
  }
  public function getUserAdminByUsername($username){
    $this->db->select($this->useradmin.'.username,'.$this->useradmin.'.id,'.$this->useradmin.'.email,'.$this->useradminDetail.'.*,'.$this->userAdminRole.'.id,'.$this->userAdminRole.'.name as role');
    $this->db->from($this->useradmin);
    $this->db->join($this->useradminDetail, $this->useradminDetail.'.id_useradmin = '.$this->useradmin.'.id');    
    $this->db->join($this->userAdminRole, $this->userAdminRole.'.id = '.$this->useradmin.'.id_role');
    $this->db->where($this->useradmin.'.username', $username);
    return $this->db->get();
  }
  public function getId($username){
    $this->db->where('username',$username);
    $this->db->select('id');
    $this->db->from($this->useradmin);
    return $this->db->get($this->$useradmin);
  }

  public function deluserAdmin($id){
    $this ->db-> where('id', $id);
    $this ->db-> delete($this->useradmin);
}
public function deluserAdminDetail($id_useradmin){
  $this ->db-> where('id_useradmin', $id_useradmin);
  $this ->db-> delete($this->useradminDetail);
}
}

/* End of file Mod_user.php */
