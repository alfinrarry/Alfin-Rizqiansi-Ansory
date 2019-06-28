<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends PIS_Controller {

  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_transaction','transaction');
    $this->load->model('Mod_review','review');
  }  

  // User
  public function userOrder()
  {
    $data['codepage']		= "profile_order";
    $data['page_title'] 	= 'Orders';
    if($this->session->userdata('id')){ 
      $data['orders']         = $this->transaction->getOrderUsers($_SESSION['id'])->result_array();
      // print_r($data['orders']);die();
      $this->template->front_views('site/front/userOrder', $data);  
    }else{    
      redirect('Home');      
    }
  }

  public function  getDetailByinvoice($invoice_code){
    $data['codepage']		= "profile_order_detail";
    if($this->session->userdata('id')){ 
      $data['transaction']  = $this->transaction->getDetail($invoice_code)->row_array();
      $data['product']      = $this->transaction->getProductByInvoice($data['transaction']['id_transaction'])->result_array();
      $data['page_title'] 	= 'Transaction '.$invoice_code;
      $data['productR']       = $this->review->getProductRiview($data['transaction']['id'])->result_array();
      $data['review']       = $this->review->getReviewByTransaction($data['transaction']['id'])->result_array();
      // print_r($data['product'] );die();
      $this->template->front_views('site/front/userOrder', $data);  
    }else{    
      redirect('Home');      
    }
  }

  // End User

}

/* End of file Transaction.php */
