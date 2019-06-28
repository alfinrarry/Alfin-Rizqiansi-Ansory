<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_cart extends CI_Model {

    protected $cart     = 'em_carts';
    protected $product             = 'em_products';
    protected $product_variant     = 'em_product_variations';

    public function getCount(){
        $this->db->where('id_user',$_SESSION['id']);
        $this->db->from($this->cart);
        return $this->db->count_all_results();
    }
    public function getListCart(){
        $this->db->where('id_user',$_SESSION['id']);
        return $this->db->get($this->cart);
    }
    
    public function insert($data){
        $this->db->insert($this->cart, $data);
    }
    public function update($id,$qty){
        $this->db->set('qty', $qty);
        $this->db->where('id', $id);
        $this->db->update($this->cart);
    }
    public function delItem($id){
        $this->db->where('id', $id);
        return $this->db->delete($this->cart); 
    }
    public function getListCartCheckout(){
        $this->db->select($this->cart.'.*,'.$this->cart.'.qty as qty_cart,'.$this->product.'.id,'.$this->product.'.slug_product,'.$this->product.'.title_product,'.$this->product.'.deleted_at,'.$this->product.'.weight,'.$this->product.'.price,'.$this->product.'.status,'.$this->product_variant.'.*,');
        $this->db->from($this->cart);
        $this->db->join($this->product, $this->product.'.id = '.$this->cart.'.id_product');
        $this->db->join($this->product_variant, $this->product_variant.'.id = '.$this->cart.'.id_variation');     
        $this->db->where($this->product.'.status ', 1);
        $this->db->where($this->product.'.deleted_at ', 0000);
        $this->db->where($this->cart.'.id_user', $_SESSION['id']);  
        return $this->db->get();
    }
    public function getItemCartByid($id_product,$id_variant){
        $this->db->where('id_user', $_SESSION['id']);
        $this->db->where('id_product', $id_product);
        $this->db->where('id_variation',$id_variant);
        return $this->db->get($this->cart);
    }
}

/* End of file Mod_cart.php */
