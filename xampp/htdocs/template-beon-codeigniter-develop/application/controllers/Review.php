<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends PIS_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('Mod_product','product');
      $this->load->model('Mod_category','category');
      $this->load->model('Mod_comment','comment');
      $this->load->model('Mod_review','review');
      $this->load->model('Mod_wishlist','wishlist');
    }

    public function addReview(){
        $data_review = array(
          'id_product'      => $_POST['product'],
          'id_user'         => $_SESSION['id'],
          'id_transaction'  => $_POST['transaction'],
          'rating'          => 3,
          'description'     => $_POST['description'],
          'created_at'      => date('Y-m-j H:i:s'),
        );
        // print_r($data_review);die();
        $result =$this->review->addReview($data_review);
        echo json_encode($result);
      }

}

/* End of file Review.php */
