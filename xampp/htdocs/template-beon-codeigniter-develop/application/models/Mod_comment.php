<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_comment extends CI_Model {

  protected $comment    = 'em_product_comments';  
  protected $user       = 'em_users';
  protected $userDetail = 'em_user_details';  
  protected $product             = 'em_products';

  public function getCommentByProduct($id_product){
    $this->db->select($this->comment.'.*,'.$this->user.'.is_ban,'.$this->user.'.username,'.$this->userDetail.'.*');
    $this->db->from($this->comment);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->comment.'.id_user');
    $this->db->join($this->user, $this->user.'.id = '.$this->comment.'.id_user');
    $this->db->where($this->comment.'.id_product',$id_product);
    $this->db->where($this->comment.'.parent',0);
    $this->db->order_by($this->comment.'.id', 'desc');
    return $this->db->get();
  }
  public function getReplyCommentByProduct($id_product){
    $this->db->select($this->comment.'.*,'.$this->user.'.is_ban,'.$this->user.'.username,'.$this->userDetail.'.*');
    $this->db->from($this->comment);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->comment.'.id_user');
    $this->db->join($this->user, $this->user.'.id = '.$this->comment.'.id_user');
    $this->db->where($this->comment.'.id_product',$id_product);
    $this->db->where($this->comment.'.parent !=',0);
    $this->db->order_by($this->comment.'.id', 'desc');
    return $this->db->get();
  }
  public function addComment($data){
    $this->db->insert($this->comment, $data);
    return $this->db->insert_id();
  }
  public function getCommentById($id){
    $this->db->where('id', $id);
    return $this->db->get($this->comment);    
  }
  public function getAllComment(){
    $this->db->select($this->comment.'.*,'.$this->user.'.is_ban,'.$this->user.'.username,'.$this->userDetail.'.*,'.$this->product.'.slug_product');
    $this->db->from($this->comment);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->comment.'.id_user');
    $this->db->join($this->user, $this->user.'.id = '.$this->comment.'.id_user');
    $this->db->join($this->product, $this->product.'.id = '.$this->comment.'.id_product');
    $this->db->where($this->comment.'.parent',0);
    $this->db->order_by($this->comment.'.id', 'desc');
    return $this->db->get();
  }
  public function getReplayComment(){
    $this->db->select($this->comment.'.*,'.$this->user.'.is_ban,'.$this->user.'.username,'.$this->userDetail.'.*,'.$this->product.'.slug_product');
    $this->db->from($this->comment);
    $this->db->join($this->userDetail, $this->userDetail.'.id_user = '.$this->comment.'.id_user');
    $this->db->join($this->user, $this->user.'.id = '.$this->comment.'.id_user');
    $this->db->join($this->product, $this->product.'.id = '.$this->comment.'.id_product');
    $this->db->where($this->comment.'.parent',0);
    $this->db->order_by($this->comment.'.id', 'desc');
    $this->db->where('parent !=',0);;
    return $this->db->get();
  }
}

/* End of file Mod_comment.php */
