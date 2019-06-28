<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_notification extends CI_Model {

  protected $notification = 'em_site_notifications';

  public function addNotif($data){
    return $this->db->insert($this->notification, $data); 
  }

}

/* End of file Mod_notification.php */
