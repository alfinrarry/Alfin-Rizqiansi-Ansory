<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends PIS_Controller {

   
   public function __construct()
   {
     parent::__construct();
     $this->load->model('Mod_category','category');
     $this->load->model('Mod_product','product');
   }
   

  public function index()
  {
    $data['codepage']		= "category";
    $slug_category 	     = $this->uri->segment(2);
    $data['ct'] 		 		 = $this->category->getCategoryBySlug($slug_category)->row_array();
    $data['filter']      = null;
    $data['data_filter'] = null;
    $data['slug']        = $slug_category;

    if ($_GET == null) {
      // pagination
      $config['base_url']     = base_url('Category/'.$slug_category);
      $config['total_rows']   = $this->product->countProdukByCategory($data['ct']['id']);
      $config['per_page']     = $this->site_page_conf()['conf_page_category'];
      $config['uri_segment']  = 3;
      $this->pagination->initialize($config);
      $start = $this->uri->segment(3, 0);
      
      // ubah data menjadi tampilan per limit
      $data['rows']     = $config['total_rows'];
      $data['start']    = $start+1;
      $data['end']      = (($start + $this->site_page_conf()['conf_page_category']) > $config['total_rows']) ? $config['total_rows'] : $start + $this->site_page_conf()['conf_page_category'];
      $data['product']	= $this->product->getProductByCategory($data['ct']['id'],$config['per_page'],$start)->result_array();
      // print_r($data['product']);die();
    }else {
      // pagination
      $config['base_url']     = base_url('Category/'.$slug_category);
      $config['total_rows']   = $this->product->countProdukByCategoryFilter($data['ct']['id']);
      $config['per_page']     = $this->site_page_conf()['conf_page_category'];
      $config['uri_segment']  = 3;
      $this->pagination->initialize($config);
      $start                  = $this->uri->segment(3, 0);
      $data_filter            = array('SortBy' => $_GET['SortBy'], 'min' => $_GET['min'], 'max' => $_GET['max'], 'score' =>$_GET['score']);

      // ubah data menjadi tampilan per limit
      $data['rows']        = $config['total_rows'];
      $data['start']       = $start+1;
      $data['end']         = (($start + $this->site_page_conf()['conf_page_category']) > $config['total_rows']) ? $config['total_rows'] : $start + $this->site_page_conf()['conf_page_category'];
      $data['product']	   = $this->product->getProductByCategoryFilter($data['ct']['id'],$config['per_page'],$start)->result_array();
      $data['filter']      = '?SortBy='.$_GET['SortBy'].'&min='.$_GET['min'].'&max='.$_GET['max'].'&score='.$_GET['score'];
      $data['data_filter'] = json_encode($data_filter);
    }
    // get list subkategori
    $data['paging']       = $this->pagination->create_links();
    $this->template->front_views('site/front/category', $data);
  }

}

/* End of file Category.php */
