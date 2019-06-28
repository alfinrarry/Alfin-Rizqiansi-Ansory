<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_transaction extends CI_Model {

  protected $transaction          = 'em_transactions';
  protected $transaction_detail   = 'em_transaction_details';
  protected $transaction_user     = 'em_transaction_users';
  protected $transaction_address  = 'em_transaction_addresses';
  protected $user                 = 'em_users';
  protected $userDetail 	        = 'em_user_details';
  protected $product              = 'em_products';
  protected $product_variant      = 'em_product_variations';
  protected $payment              = 'em_site_payments';
  protected $payment_type         = 'em_site_payment_type';
  protected $payment_bank         = 'em_site_banks';
  protected $category            = 'em_product_categories';

  public function listTransaction(){
    $this->db->select($this->transaction.'.*,'.$this->user.'.id,'.$this->user.'.fullname');
    $this->db->from($this->transaction);
    $this->db->join($this->user, $this->user.'.id = '.$this->transaction.'.id_user');    
    $this->db->where($this->transaction.'.deleted_at ', null);
    $this->db->where($this->transaction.'.status !=',-2);
    $this->db->or_where($this->transaction.'.status !=',-1);
    return $this->db->get();
  }
  public function listFailTransaction(){
    $this->db->select($this->transaction.'.*,'.$this->user.'.*');
    $this->db->from($this->transaction);
    $this->db->join($this->user, $this->user.'.id = '.$this->transaction.'.id_user');
    $this->db->where($this->transaction.'.status',-2);
    $this->db->or_where($this->transaction.'.status',-1);
    return $this->db->get();
  }
  public function getDetail($invoice_code){
    $this->db->select($this->transaction.'.*,'.$this->transaction_address.'.*,'.$this->transaction_user.'.*,'.$this->payment.'.id,'.$this->payment.'.id_bank,'.$this->payment_bank.'.id,'.$this->payment_bank.'.name as bank_name,'.$this->payment_bank.'.account_number');
    $this->db->from($this->transaction);
    $this->db->join($this->transaction_address, $this->transaction_address.'.id_transaction = '.$this->transaction.'.id');
    $this->db->join($this->transaction_user, $this->transaction_user.'.id_transaction = '.$this->transaction.'.id');
    $this->db->join($this->payment, $this->payment.'.id = '.$this->transaction.'.id_payment');
    $this->db->join($this->payment_bank, $this->payment_bank.'.id = '.$this->payment.'.id_bank');
    $this->db->where($this->transaction.'.invoice_code',$invoice_code);
    return $this->db->get();
  }
  public function getProductByInvoice($id_transaction){
    $this->db->select($this->transaction_detail.'.*,'.$this->product.'.id,'.$this->product.'.title_product,'.$this->product_variant.'.id,'.$this->product_variant.'.id_product,'.$this->product_variant.'.variation,'.$this->product_variant.'.size,');
    $this->db->from($this->transaction_detail);
    $this->db->join($this->product, $this->product.'.id = '.$this->transaction_detail.'.id_product');
    $this->db->join($this->product_variant, $this->product_variant.'.id = '.$this->transaction_detail.'.id_variation');
    $this->db->where($this->transaction_detail.'.id_transaction',$id_transaction);
    return $this->db->get();
  }
  public function updateReceipt($data,$invoice_code){
    $this->db->set($data);
    $this->db->where('invoice_code', $invoice_code);
    $this->db->where('deleted_at', null);
    $this->db->update($this->transaction);
  }
  public function delTrans($id){
    $this->db->set('deleted_at',date("Y-m-d h:i:s"));
    $this->db->where('id', $id);
    $this->db->update($this->transaction);
  }
  public function approve($id){
    $this->db->set('status',1);
    $this->db->where('id', 73);
    $this->db->update($this->transaction);
  }
  public function doapprove($id){
    $this->db->set('status',-1);
    $this->db->where('id', $id);
    $this->db->update($this->transaction);
  }

  // pesugihan
  public function getEarningByMonth()
  {
      $this->db->select($this->transaction_detail.'.*, '.$this->product.'.id, '.$this->product.'.price, '.$this->product.'.title_product, '.$this->transaction.'.id,'.$this->transaction.'.created_at');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->product, $this->product.'.id = '.$this->transaction_detail.'.id_product');      
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      $this->db->where('MONTH('.$this->transaction.'.created_at)', date('n')); 
      $this->db->where('YEAR('.$this->transaction.'.created_at)', date('Y'));   
      return $this->db->get();
  }   
  // end pesugihan
  // total produk terjual
  public function getTotProduct()
  {
      $this->db->select_sum($this->transaction_detail.'.qty');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      $this->db->where('MONTH('.$this->transaction.'.created_at)', date('n')); 
      $this->db->where('YEAR('.$this->transaction.'.created_at)', date('Y'));   
      return $this->db->get();
  }        
  // total produk terjual
  // total produk terjual
  public function getTotSell()
  {
      $this->db->select_sum($this->transaction_detail.'.total_price');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      $this->db->where('MONTH('.$this->transaction.'.created_at)', date('n')); 
      $this->db->where('YEAR('.$this->transaction.'.created_at)', date('Y'));   
      return $this->db->get();
  }        
  // total produk terjual
  public function getAllEarning()
  {
      $this->db->select($this->transaction_detail.'.*, '.$this->product.'.id, '.$this->product.'.price, '.$this->product.'.title_product, '.$this->transaction.'.id, '.$this->transaction.'.created_at');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->product, $this->product.'.id = '.$this->transaction_detail.'.id_product');
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      return $this->db->get();
  }
  public function getOrderUsers($id_user){
    $this->db->select($this->transaction.'.*,'.$this->transaction_user.'.id,'.$this->transaction_user.'.name');
    $this->db->from($this->transaction);
    $this->db->join($this->transaction_user, $this->transaction_user.'.id_transaction = '.$this->transaction.'.id');    
    $this->db->where($this->transaction.'.deleted_at ', null);
    $this->db->where($this->transaction.'.id_user',$id_user);
    return $this->db->get();
  } 

  // checkout
  public function getMethodePaymentType(){
    $this->db->where('status', 1);
    return $this->db->get($this->payment_type);
  }
  public function getBankByPayment(){
    $this->db->select($this->payment.'.id as id_payment,'.$this->payment.'.id_bank,'.$this->payment.'.status,'.$this->payment_bank.'.id,'.$this->payment_bank.'.name,');
    $this->db->from($this->payment);
    $this->db->join($this->payment_bank, $this->payment_bank.'.id = '.$this->payment.'.id_bank');     
    $this->db->where($this->payment.'.status ', 1);
    return $this->db->get();
  }

  public function add_transaction($data){
    $this->db->insert($this->transaction, $data);
    return $this->db->insert_id();
  }
  public function getTransactionId($data){
    return $this->db->get_where($this->transaction, $data);
  }
  public function add_transaction_detail($transaction_detail){
    $this->db->insert($this->transaction_detail, $transaction_detail);
    return $this->db->insert_id();
  }
  public function add_transaction_user($transaction_user){
    return $this->db->insert($this->transaction_user, $transaction_user);
  }
  public function add_transaction_address($transaction_address){
    return $this->db->insert($this->transaction_address, $transaction_address);
  }
  public function getTransactionByInv($invoice_code){
    $this->db->where('invoice_code', $invoice_code);
    return $this->db->get($this->transaction);    
  }
  // end checkout
  // statistik
  // grafik Transaksi Admin
  public function getChartTransactionAdmin()
	{
		$query = $this->db->query('SELECT MONTHNAME(i.created_at) as month, MONTH (i.created_at) as monthnum, YEAR(i.created_at) as year,
		 COUNT(i.id) as count,
		 COUNT(i.id) +
		 (
		  SELECT COUNT(t.id)
		  FROM '.$this->transaction.' t
		  WHERE t.created_at < i.created_at AND status = 3
		 ) 
		 AS accumulate
		  FROM     (
			SELECT id, created_at
			from '.$this->transaction.' 
			WHERE created_at > DATE_SUB(now(), INTERVAL 6 MONTH) AND status = 3
		  ) i
		 GROUP BY MONTHNAME(i.created_at)
		 ORDER BY YEAR, MONTHNUM');
		return $query->result();
	}
    // end Grafik transaksi Admin
    public function countTrans(){
      $this->db->select_sum($this->transaction_detail.'.total_price');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      return $this->db->get();
  }
  public function sellProduct(){
      $this->db->select($this->transaction_detail.'.*, '.$this->product.'.id, '.$this->product.'.price, '.$this->product.'.title_product, '.$this->transaction.'.id, '.$this->transaction.'.created_at');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->product, $this->product.'.id = '.$this->transaction_detail.'.id_product');
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      return $this->db->get();
  }
  public function countQtySell(){
      $this->db->select_sum($this->transaction_detail.'.qty');
      $this->db->from($this->transaction_detail);
      $this->db->join($this->transaction, $this->transaction.'.id = '.$this->transaction_detail.'.id_transaction');
      $this->db->where($this->transaction.'.status', 3);
      return $this->db->get();
  }
    // transaksi index dashboard
    public function getAlltransactionDashboard()
    {
      $this->db->where('status', 0);
      $this->db->order_by('id', 'desc');
      return $this->db->get($this->transaction);
    }
    // end transaksi index dashboard    

    public function getChartStatus()
    {
        $result=$this->db->query("select 
        COUNT(CASE WHEN (status = 3 ) then 1 ELSE NULL END) as success,
        COUNT(CASE WHEN (status = 0 or status=2 ) then 1 ELSE NULL END) as pending,
        COUNT(CASE WHEN (status = -1 or status=-2) then 1 ELSE NULL END) as failed
        from $this->transaction");
        return $result->result_array();
    }
    public function listProductDash(){
      $query ="SELECT p.id,p.title_product,p.slug_product,p.status, p.deleted_at, 
      COALESCE((select sum(td.qty) from em_transaction_details td JOIN em_transactions t ON td.id_transaction=t.id where p.id=td.id_product AND t.status=3),0) as sell,
      COALESCE((select sum(v.qty) from em_product_variations v JOIN em_products p ON v.id_product=p.id AND p.status=1 and p.deleted_at=000),0) as qty
      FROM em_products p, em_product_categories c where c.id=p.id_category AND p.deleted_at=000  ORDER BY qty ASC limit 50";
      return $this->db->query($query);
  }
  // endstatistik

  
}
// SELECT p.id,p.title_product,p.slug_product,p.status, p.deleted_at, 
// COALESCE((select sum(td.qty) from em_transaction_details td JOIN em_transactions t ON td.id_transaction=t.id where p.id=td.id_product AND t.status=3),0) as sell,
// COALESCE((select sum(v.qty) from em_product_variations v JOIN em_products p ON v.id_product=p.id AND p.status=1 and p.deleted_at=000),0) as qty
// FROM em_products p, em_product_categories c where c.id=p.id_category AND p.deleted_at=000  ORDER BY qty ASC limit 50;
/* End of file Mod_transaction.php */
