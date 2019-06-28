<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends PIS_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_ticket','ticket');
    $this->load->model('Mod_transaction','transaction');
  }
  

  public function userTicket()
  {
    $data['codepage']		= "profile_ticket";
    $data['page_title'] 	= 'Ticket';
    if($this->session->userdata('id')){ 
      $data['ticket']         = $this->ticket->userTicket($_SESSION['id'])->result_array();
      $this->template->front_views('site/front/userTicket', $data);  
    }else{    
      redirect('Home');      
    }
  }
  
  public function created(){
    $data['codepage']		= "profile_ticket_add";
    $data['page_title'] = 'Buat tiket';
    $data['type']       = $this->ticket->getTypeTicket()->result_array();
    $data['invoice']    = $this->transaction->getOrderUsers($_SESSION['id'])->result_array();
    $data['payments']   = $this->getPayments();
    if($this->session->userdata('id')){ 
      if(isset($_POST['submit'])){
        // print_r($_POST);die();
        $data_ticket = array(
          'id_ticket_type'  => $_POST['type_ticket'],
          'id_user'         => $_SESSION['id'],
          'title'           => $_POST['title'],
          'description'     => $_POST['description'],
          'created_at'      => date('Y-m-j H:i:s')
        );
        $ticket = $this->ticket->created($data_ticket);
        if ($_POST['file']) {
          $config['upload_path']='./assets/img/content/ticket/';
          $config['allowed_types']='jpg|png';
          $this->load->library('upload',$config);
          $this->upload->do_upload('file');
          $img_path='./img/content/ticket/';
          $img_path.=  $this->upload->data('file_name');
          $data_file = array(
            'id_ticket' => $ticket,
            'path_file' => $img_path,
            'created_at'=> date('Y-m-j H:i:s')
          );
          $this->ticket->created_file($data_file);
        }
        $details = @$_POST['invoice'];
        if ($details) {
          $data_details = array(
            'id_ticket'      => $ticket,
            'invoice_code'   => $_POST['invoice'],
            'id_payment'     => $_POST['payment_method'],
            'bank_name'      => $_POST['bank_name'],
            'no_bank'        => $_POST['norek'],
            'created_at'     => date('Y-m-j H:i:s')
          );
          $this->ticket->created_detail($data_details);
        }
        $no_ticket = array(
          'no_ticket' => 'TXT'.$ticket,
          'id'        => $ticket,
        );
        $this->ticket->updated_no($no_ticket);        
        redirect(base_url('User/'.$_SESSION['username'].'/ticket'),'refresh');        
      }else{
        $this->template->front_views('site/front/userTicket', $data);  
      }
    }else{    
      redirect('Home');      
    }
  }
  public function getDetail($no_ticket){
    $data['codepage']		= "profile_ticket_detail";
    if($this->session->userdata('id')){ 
      $data['ticket']     = $this->ticket->getDetail($no_ticket)->row_array();
      $data['reply']      = $this->ticket->getReply($data['ticket']['id_ticket'])->result_array();
      $data['page_title'] = 'Tiket '.$data['ticket']['no_ticket'];
      // print_r($data);die();
      $this->template->front_views('site/front/userTicket', $data);  
    }else{    
      redirect('Home');      
    }
  }

}

/* End of file Ticket.php */
