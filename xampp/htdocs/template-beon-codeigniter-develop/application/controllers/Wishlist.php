<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends PIS_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_wishlist','wishlist');
    }
    
    public function index()
    {
        $data['codepage']   = 'profile_wishlist';
        $data['page_title'] = 'Wishlist';
        if($this->session->userdata('id')){ 
            $data['product']   = $this->wishlist->getWislistByUser($_SESSION['id'])->result_array();
            // print_r( $data['product']);die();
            $this->template->front_views('site/front/userWishlist', $data);  
        }else{    
            redirect('Home');      
        }
    }
    public function action(){
        // print_r($_POST);die();
        if ($_POST['type']=="remove") {
            $id_wishlist=$_POST['id_wishlist'];
            $result=$this->wishlist->remove_wishlist($id_wishlist);
        } else if($_POST['type']=="add" ){
            $id_product=$_POST['id_product'];
            $result=$this->wishlist->add_wishlist($id_product);
        }
        echo json_encode($result);
    }

}

/* End of file Wishlist.php */
