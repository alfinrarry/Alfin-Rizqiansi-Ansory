<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_category extends CI_Model {

  protected $category            = 'em_product_categories';
  public function getCategoryAll(){
    $this->db->select('*');
    $this->db->where('deleted_at',null);
    return $this->db->get($this->category);
  }
  public function getCategoryBySlug($slug_category)
  {
      $this->db->select('*');
      $this->db->from($this->category);
      $this->db->where('slug_category', $slug_category);
      $this->db->order_by('created_at','DESC');
      $this->db->limit(1);
      return $this->db->get(); 
  }
  public function getCategoryByid($id)
  {
      $this->db->where('id', $id);
      $this->db->limit(1);
      return $this->db->get($this->category); 
  }
  public function update($data,$id){
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update($this->category);
  }
  public function create($data){
    $this->db->insert($this->category, $data);
  }
  public function delete($id){
    $this->db->set('deleted_at',date('Y-m-d H:m:s'));
    $this->db->where('id', $id);
    $this->db->update($this->category);
  }
}

/* End of file Mod_category.php */
