<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_wishlist extends CI_Model {

    protected $product_wishlist    = 'em_product_wishlists';
    protected $product             = 'em_products';

    public function getWislistByUser($id_user){
        $this->db->select($this->product_wishlist.'.id as id_wishlist,'.$this->product_wishlist.'.*,'.$this->product.'.*');
        $this->db->from($this->product_wishlist);
        $this->db->join($this->product, $this->product.'.id = '.$this->product_wishlist.'.id_product');
        $this->db->where($this->product_wishlist.'.id_user',$id_user);
        return $this->db->get();
    }
    
    public function remove_wishlist($id_wishlist){
        $this->db->where('id', $id_wishlist);    
        return $this->db->delete($this->product_wishlist);
    }
    public function add_wishlist($id_product){
        $check=$this->db->get_where($this->product_wishlist, array('id_user' => $_SESSION['id'],'id_product' => $id_product))->result_array();
        if (sizeof($check)==0) {
            $data_product = array(
                'id_user'       => $_SESSION['id'],
                'id_product'    => $id_product, 
                'created_at'    => date("Y-m-d h:i:s")
            );
            $this->db->insert($this->product_wishlist, $data_product);
            return $this->db->insert_id();
        }
    }

}

/* End of file Mod_wishlist.php */
