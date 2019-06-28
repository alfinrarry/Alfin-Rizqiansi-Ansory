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
        $data['codepage']       = "back_category";
        $data['page_title']     = "Daftar Category";
        $data['product']        = $this->category->getCategoryAll()->result_array();
        $this->template->back_views('site/back/categoryList',$data);    
    }
    public function detail($id){
      if(isset($_POST['submit'])){
        $config['upload_path']='./assets/img/content/site/';
        $config['allowed_types']='jpg|png|ico';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload('img'))
        {
            $img='img/content/site/';
            $img.=  $this->upload->data('file_name');
        }
        $data = array(
          'name_category'   => $_POST['name'],
          'slug_category'   => slug($_POST['name']),
          'img_path'        => @$img,
          'created_at'      => date('Y-m-d H:m:s')
        );
        $this->category->update($data,$id);
      }
      $data['codepage']       = "back_category_detail";
      $data['page_title']     = "Perbarui Kategori";
      $data['category']       = $this->category->getCategoryByid($id)->row_array();
      $this->template->back_views('site/back/categoryDetail',$data);   
    }
    public function create(){
      if(isset($_POST['submit'])){
        $config['upload_path']='./assets/img/content/site/';
        $config['allowed_types']='jpg|png|ico';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload('img'))
        {
            $img='img/content/site/';
            $img.=  $this->upload->data('file_name');
        }
        $data = array(
          'name_category'   => $_POST['name'],
          'slug_category'   => slug($_POST['name']),
          'img_path'        => @$img,
          'created_at'      => date('Y-m-d H:m:s')
        );
        $this->category->create($data);
        redirect(base_url('admin/Category'),'refresh');
      }
      $data['codepage']       = "back_category_detail";
      $data['page_title']     = "Kategori Baru";
      $this->template->back_views('site/back/categoryDetail',$data);
    }
    public function deleted($id){
      return $this->category->delete($id,array('deleted_at' => date('Y-m-j H:i:s')));        
    }

}

/* End of file Category.php */
