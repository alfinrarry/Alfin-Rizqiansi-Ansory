<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends PIS_Controller {

  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mod_cart','dbCart');  
    $this->load->model('Mod_product','product');
    $this->load->model('Mod_address','address');
    $this->load->model('Mod_transaction','transaction');
    
      
  }
  

  public function index()
  {
    $data['codepage']		= "cart";    
    if (@$_SESSION['id']) {
      $data['cart'] = $this->dbCart->getListCart()->result_array();
    }else{
      $data['cart'] = $this->cart->contents();
    }
    // print_r($data['cart']);die();
    $this->template->front_views('site/front/cart', $data);
  }

  public function addCart(){
    if (@$_SESSION['id']) {
      $data = array(
        'id_product'     => $_POST['product'],
        'id_user'        => $_SESSION['id'],
        'qty'            => $_POST['qty'],
        'id_variation'   => $_POST['variation'],
        'created_at'     => date('Y-m-j H:i:s')
      );
      $this->dbCart->insert($data);
    }else{
      $product =$this->product->getProductbyId($_POST['product'])->row_array();
      $data = array(
        'id'      => $_POST['product'],
        'qty'     => $_POST['qty'],
        'price'   => $product['price'],
        'name'    => $product['title_product'],
        'options' => array(
          'variation' => $_POST['variation'],
        )
      );
      $this->cart->insert($data);
    }  
  }
  public function addCartBylist(){
    $variant =$this->product->getVariantByProduct($_POST['product'])->result_array();
    if (@$_SESSION['id']) {
      $id_product =$_POST['product'];
      $id_variant = $variant[0]['id']; 
      $cart = $this->dbCart->getItemCartByid($id_product,$id_variant)->row_array();
      if ($cart['id']) {
        $id= $cart['id'];
        $qty = $cart['qty']+1;
        $this->dbCart->update($id,$qty);
      }else{  
        $data = array(
          'id_product'     => $_POST['product'],
          'id_user'        => $_SESSION['id'],
          'qty'            => 1,
          'id_variation'   => $variant[0]['id'],
          'created_at'     => date('Y-m-j H:i:s')
        );
        $this->dbCart->insert($data);
      }
    }else{
      $product =$this->product->getProductbyId($_POST['product'])->row_array();
      $data = array(
        'id'      => $_POST['product'],
        'qty'     => $_POST['qty'],
        'price'   => $product['price'],
        'name'    => $product['title_product'],
        'options' => array(
          'variation' =>  $variant[0]['id'],
        )
      );
      $this->cart->insert($data);
    }  
  }
  public function count(){
    if (@$_SESSION['id']) {
      $data = $this->dbCart->getCount();
    }else{
      $data = count($this->cart->contents());
    }
    echo json_encode($data);
  }

  public function update(){
    $id=$_POST['id_cart'];
    $qty=$_POST['qty'];
    $result=$this->dbCart->update($id,$qty);
    echo json_encode($result);
  }
  public function delItem($id){
    $this->dbCart->delItem($id);
  }

  // checkout
  public function checkout(){
    $data['codepage']       = "checkout";
    if (@$_SESSION['id']) {
      $data['address']        = $this->address->getAddressByUser($_SESSION['id'])->result_array();
      $data['prmAddress']     = $this->address->getPrimaryAddress()->row_array();
      $data['cart']           = $this->dbCart->getListCartCheckout()->result_array();
      $data['unique_payment'] =(isset($_SESSION['id']))?generateNumber():0;
      $data['payment']        = $this->transaction->getBankByPayment()->result_array();
      $this->template->front_views('site/front/checkout',$data); 
    }else{
      redirect(base_url('auth'));
    }   
  }
  // address
  public function change_address(){
    $this->address->setAddressNull();
    $result =$this->address->setPrimary($_POST['addr']);
    echo json_encode($result);
  }
  // end address

  // get Biaya kirim
  public function getCost(){
    $destination=$_POST['destination'];
    $weight=$_POST['weight'];
    $courier=$_POST['courier'];
    $data= cost_rajaongkir($destination,$weight,$courier);
    echo "<label>Pilih jenis pengiriman</label>";
    $counter=1;
    foreach ($data[0]->costs as $c) {
      $checked=($counter==1)? 'checked' : '';
      echo '<div class="custom-radio mb-3">'.
      '<input type="radio" required data-price='.$c->cost[0]->value.' id="customRadio'.$counter.'" name="courier_service" '.$checked.' class="custom-control-input courier_service" style="position: unset;" value='.$c->service.'>'.
      '<label class="custom-control-label ml-2 mb-0" for="customRadio'.$counter.'">'.$c->description.'</label>'.
      '   <span class="float-right cart-item__price">Rp '.rupiah($c->cost[0]->value).'</span>'.
      '   <small class="form-text text-muted mt-0">('.str_replace("HARI","",$c->cost[0]->etd).' hari)</small>'.
      '</div>';
      $counter++;
    }
  }
  // end get biaya kirim
  public function getInovice(){
    $check=$this->check_qty();
    if ($check['status']) {
      $transaction = array(
          'id_user'           => $_SESSION['id'],
          'invoice_code'      => 'EM'.$_SESSION['id'].$_POST['price_unique'].$_POST['phone'],
          'price_unique'      => $_POST['price_unique'],
          'total_price'       => $_POST['total_price']+$_POST['price_unique']+$_POST['delivery_fee'],
          'id_payment'        => $_POST['payment'],
          'status'            => 0,
          'courier'           => $_POST['courier'],
          'delivery_fee'      => $_POST['delivery_fee'],
          'courier_service'   => $_POST['courier_service'],
          'expired_date'      => date('Y-m-d H:i:s', time() + 4*(60 * 60)),
          'created_at'        => date("Y-m-d h:i:s")                    
      );
      $result['status']=true;
      $id_transaction=$this->transaction->add_transaction($transaction);      
      $invoice_code = 'EM'.$_SESSION['id'].$_POST['price_unique'].$_POST['phone']; 
      if ($id_transaction) {       
        $cart=$this->dbCart->getListCartCheckout()->result_array();
        foreach ($cart as $c) {
          $transaction_detail=array(
            'id_transaction'    =>$id_transaction,
            'id_product'        =>$c['id_product'],
            'qty'               =>$c['qty'],
            'id_variation'      =>$c['id_variation'],
            'price'             =>product($c['id_product'])['price'],
            'total_price'       =>$c['qty']*product($c['id_product'])['price'],
            'created_at'        => date("Y-m-d h:i:s")   
            );
          $item = $this->transaction->add_transaction_detail($transaction_detail);
          if ($item) {
            $this->dbCart->delItem($c['id']);
          }          
        };
        $transaction_user = array(
          'id_transaction'    =>$id_transaction,
          'name'              =>$_POST['name'],
          'phone'             =>$_POST['phone'],
          'created_at'        => date("Y-m-d h:i:s")   
        );
        $this->transaction->add_transaction_user($transaction_user); 
        $transaction_address = array(
          'id_transaction'    =>$id_transaction,
          'province'          =>$_POST['name'],
          'city'              =>$_POST['phone'],
          'subdistrict'       =>$_POST['subdistrict'],
          'id_province'       =>$_POST['id_province'],
          'id_city'           =>$_POST['id_city'],
          'id_subdistrict'    =>$_POST['id_subdistrict'],
          'complete_address' =>$_POST['complete_address'],
          'zip_code'          =>$_POST['zip_code']  
        );
        $this->transaction->add_transaction_address($transaction_address);  
        $desc="Terdapat Transaksi Baru dengan kode ".$invoice_code;
        $this->send_notification_admin($desc,$id_transaction,0,0,0);
        // $template = $this->site->getEmailByid(3)->row_array();  
        // $system = $this->getSystem();
        // $email=$_POST['email'];
        // $subject= $template['subject'];
        // $content = array  (
        //     'base_url'	=> base_url(), 
        //     'logo'    => img_url($system['logo']),
        //     'button'    => "",
        //     'username'  => "",
        //     'fullname'   =>$_POST['firstname']." ".$_POST['lastname'],
        //     'url'       => "", 
        //     'subject'   => $subject,
        //     'invoice'   => $code_order,
        //     'content'   => $template['content'],
        //     'closing'   => $template['closing'],
        //     'detail'    => $cart,
        //     'created'   => $date,
        //     'expired'   =>$expired_date,
        //     'rekening'  => $pay,
        //     'value'     => ""
        // );
        // $message = ''; 
        // $message .= $this->load->view('email/email-invoice',$content, TRUE);  
        // $this->site->mg_send($email, $subject, $message);
        $result['url']=base_url('cart/invoice/').$invoice_code;
      }
      echo json_encode($result);
    } else {
      echo json_encode($check);
    }
  }
  public function invoice($invoice_code){
    $data['codepage']   = "payment";
    $data['transaction']=$this->transaction->getDetail($invoice_code)->row_array();
    $data['product']      = $this->transaction->getProductByInvoice($data['transaction']['id_transaction'])->result_array();
    // print_r($data['transaction']);die();
    $this->template->front_views('site/front/payment',$data);
  }
  
  public function payment(){
    
  }
}

/* End of file Cart.php */
