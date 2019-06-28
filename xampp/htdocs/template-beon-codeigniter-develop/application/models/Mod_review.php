<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_review extends CI_Model {

  protected $review     = 'em_product_reviews';
  protected $user       = 'em_users';
  protected $userDetail = 'em_user_details';
  protected $product    = 'em_products';
  protected $transaction_detail   = 'em_transaction_details';

  public function getReviewByProduct($id_product){
    $this->db->select($this->review.'.*,'.$this->user.'.id,'.$this->user.'.is_ban,'.$this->user.'.username,'.$this->userDetail.'.*');
    $this->db->from($this->review);    
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->review.'.id_user');
    $this->db->join($this->user, $this->user.'.id = '.$this->review.'.id_user');
    $this->db->where($this->review.'.id_product',$id_product);
    $this->db->where($this->user.'.is_ban',null);
    return $this->db->get();
  }
  public function getAvgRatting($id_product){
    $this->db->where('id_product', $id_product);			
		$this->db->select_avg('rating');
		return $this->db->get($this->review);
  }
  public function countRatingByProduct($id_product){
    $this->db->where('id_product', $id_product);
    $this->db->from($this->review);
		return $this->db->count_all_results(); 
  }
  public function getProductRiview($id_transaction){
    return $this->db->query("select i.*, (select count(r.id) as exist from $this->review r where r.id_transaction = $id_transaction and r.id_product = i.id_product) as exist,p.title_product from $this->transaction_detail i, $this->product p where id_transaction = $id_transaction and p.id = i.id_product");
  }
  public function addReview($data_review){
    return $this->db->insert($this->review, $data_review);
  }
  public function getReviewByTransaction($id_transaction)
  {
    $this->db->select($this->review.'.*,'.$this->product.'.id,'.$this->product.'.title_product');
    $this->db->from($this->review);
    $this->db->join($this->product, $this->product.'.id ='.$this->review.'.id_product'); 
    $this->db->where($this->review.'.id_transaction', $id_transaction); 
    return $this->db->get();    
  }

}

/* End of file Mod_review.php */
