<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends PIS_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_transaction','transaction');
    $this->load->model('Mod_user','user');
    $this->load->model('Mod_product','product');    
    $this->load->model('Mod_system','system');
    $this->load->model('Mod_comment','comment');
    
  }

  public function index()
  {
    $data['codepage'] = "back_index";
    $data['page_title'] 	       = 'Dashboard';
    $data['subpage_title'] 	       = 'Penjelasan Halaman';
    $data['countTrx']              = $this->transaction->countTrans()->row_array();
    $data['countSellProduct']      = $this->transaction->sellProduct()->result_array();
    $bp = 0; $sp = 0;
    foreach($data['countSellProduct'] as $e)
    {
        $bp += $e['qty'] * $e['price'];
        $sp += $e['qty'] * $e['price'];
    }
    $data['totProfit']      = $sp - $bp;
    $data['qty_sell']              = $this->transaction->countQtySell()->row_array();
    $data['countMember']           = $this->user->countMember();
    $data['comment']               = $this->comment->getAllComment()->result_array();
    $data['reply']                = $this->comment->getReplayComment()->result_array();      
    $data['product']               = $this->transaction->listProductDash()->result_array();  
    $data['chartTrx']              = $this->transaction->getChartTransactionAdmin();
    $data['chartGuest']                 = $this->system->getChartVisitor();
    // print_r($data['chartGuest']);die();
    $data['chartStatus']=$this->transaction->getChartStatus();
    $data['transaction']    = $this->transaction->getAlltransactionDashboard()->result_array();
    $this->template->back_views('site/back/dashboard',$data);
  }

}

/* End of file Dashboard.php */
