<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PIS_Controller extends CI_Controller {

  public function __construct()
    {
        parent::__construct();        
        $this->load->model('Mod_notification','notification');
        $this->load->model('Mod_system','system');        
        $this->load->model('Mod_category','category');
        $this->load->model('Mod_cart','dbCart');
        $this->load->model('Mod_product','product');
        
        //load category
        $data['category'] = $this->category->getCategoryAll()->result_array();
        // system
        $data['system']   = $this->system->getData()->row_array();
        
        $this->load->vars($data);
    }
    public function getSystem(){
      $data   = $this->system->getData()->row_array();
      return $data;
  }
    public function send_notification_member($id_user,$desc,$id_transaction,$id_ticket,$id_comment,$id_review){
      $data=array(
        'id_user'       => $id_user,
        'id_admin'      => $_SESSION['id'],
        'desc'          => $desc,
        'id_transaction'=> $id_transaction,
        'id_ticket'     => $id_ticket,
        'id_comment'    => $id_comment,
        'id_review'     => $id_review,
        'created_at'    => date("Y-m-d h:i:s"),
        'status'        =>0,
        'info'          => 1,
      );
      $insert=$this->notification->addNotif($data);
      return $insert;
    }
    public function send_notification_admin($desc,$id_transaction,$id_ticket,$id_comment,$id_review){
      $data=array(
        'id_user'       => $_SESSION['id'],
        'id_admin'      => 1,
        'desc'          => $desc,
        'id_transaction'=> $id_transaction,
        'id_ticket'     => $id_ticket,
        'id_comment'    => $id_comment,
        'id_review'     => $id_review,
        'created_at'    => date("Y-m-d h:i:s"),
        'status'        =>0,
        'info'          => 0,
      );
      $insert=$this->notification->addNotif($data);
      return $insert;
    }
    public function site_page_conf(){
      $data   = $this->system->getCOnf()->row_array();
      return $data;
    }
    public function getPayments(){
      $data = $this->system->getPayment()->result_array();
      return $data;
    }
    public function check_qty(){
      $cart=$this->dbCart->getListCartCheckout()->result_array();
      $result['data']=array();
      foreach ($cart as $c) {
          $data=$this->product->getVariantByid($c['id_variation'])->row_array();
          if($c['qty']>$data['qty']){
              $result['status']=false;
              array_push($result['data'],array(
                  "title_product"=>product($c['id_product'])['title_product'],
                  "qty"=>$data['qty'],
                  "status"=>"jumlah produk di keranjang melebihi stok"
                  ));
          } else {
              $result['status']=true;
          }
      }
      return $result;
    }
    public function base64url_encode($data) {   
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
    }   
     
    public function base64url_decode($data) {   
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
    }
     

}

/* End of file Pis_controller.php */
