<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_address extends CI_Model {

    protected $address          = 'em_user_addresses';
    protected $address_admin    = 'em_useradmin_addresses';
    protected $user             = 'em_user_details';
    protected $user_admin       = 'em_useradmin_detail';
    
    public function getAddressByUser($id_user){
        $this->db->where('id_user',$id_user);
        return $this->db->get($this->address);
    }
    public function created($data_address){
        $this->db->insert($this->address, $data_address);
        return $this->db->insert_id();
    }
    public function setAddressNull()
    {
      $this->db->set('primary', 0);
      $this->db->where('id_user', $_SESSION['id']);
      $this->db->update($this->address);
    }
    public function setPrimary($id)
    {
      $this->db->set('primary', 1);
      $this->db->where('id_user', $_SESSION['id']);    
      $this->db->where('id', $id);
      $this->db->update($this->address);
    }
    public function delAddress($id){
        $this->db->where('id_user', $_SESSION['id']);    
        $this->db->where('id', $id);
        $this->db->delete($this->address);        
    }
    public function getAddressByid($id){
      $this->db->where('id', $id);
      return $this->db->get($this->address);
    }
    public function getPrimaryAddress(){
      $this->db->where('primary', 1);
      $this->db->where('id_user', $_SESSION['id']);
      $this->db->limit(1);      
      return $this->db->get($this->address);
    }

}

/* End of file Mod_address.php */
