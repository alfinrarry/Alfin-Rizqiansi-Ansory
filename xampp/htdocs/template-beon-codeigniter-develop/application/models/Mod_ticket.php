<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_ticket extends CI_Model {

  protected $ticket       = 'em_site_tickets';
  protected $ticket_reply = 'em_site_ticket_replys';
  protected $ticket_type  = 'em_site_ticket_types';
  protected $ticket_file  = 'em_site_ticket_files';
  protected $ticket_detail = 'em_site_ticket_details';
  protected $userDetail 	   = 'em_user_details';
  protected $useradminDetail = 'em_useradmin_details';
  
  public function userTicket($id_user){
    $this->db->select($this->ticket.'.*,'.$this->ticket_type.'.*');
    $this->db->from($this->ticket);
    $this->db->join($this->ticket_type, $this->ticket_type.'.id = '.$this->ticket.'.id_ticket_type');
    $this->db->where($this->ticket.'.id_user',$id_user);
    $this->db->where($this->ticket.'.parent',0);
    $this->db->where($this->ticket.'.id_admin',0);
    return $this->db->get();
  }
  public function created($data_ticket){
    $this->db->insert($this->ticket, $data_ticket);
    return $this->db->insert_id();    
  }
  public function getTypeTicket(){
    $this->db->where('deleted_at', null);
    $this->db->where('status', 1);
    return $this->db->get($this->ticket_type);    
  }
  public function created_file($data_file){
    $this->db->insert($this->ticket_file, $data_file);
  }

  public function created_detail($data_details){
    $this->db->insert($this->ticket_detail, $data_details);
  }
  public function updated_no($no_ticket){
    $this->db->set(array('no_ticket'=>$no_ticket['no_ticket']));
    $this->db->where('id', $no_ticket['id']);
    $this->db->update($this->ticket);
  }
  public function getDetail($no_ticket){
    $this->db->select($this->ticket.'.*,'.$this->ticket.'.id as id_ticket,'.$this->ticket_type.'.*,');
    $this->db->from($this->ticket);
    $this->db->join($this->ticket_type, $this->ticket_type.'.id = '.$this->ticket.'.id_ticket_type');
    $this->db->where($this->ticket.'.no_ticket',$no_ticket);
    return $this->db->get();
  }
  public function getFile($id){
    $this->db->where('id_ticket', $id);
    return $this->db->get($this->ticket_file);  
  }
  public function getReply($parent){
    $this->db->select($this->ticket.'.*,'.$this->ticket.'.id as id_ticket,'.$this->ticket_type.'.*,'.$this->userDetail.'.*,'.$this->useradminDetail.'.*,'.$this->useradminDetail.'.fullname as admin_fullname,');
    $this->db->from($this->ticket);
    $this->db->join($this->ticket_type, $this->ticket_type.'.id = '.$this->ticket.'.id_ticket_type'); 
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->ticket.'.id_user');    
    $this->db->join($this->useradminDetail, $this->useradminDetail.'.id_useradmin = '.$this->ticket.'.id_admin');
    $this->db->where($this->ticket.'.parent',$parent);
    return $this->db->get();
  }

}

/* End of file Mod_ticket.php */
