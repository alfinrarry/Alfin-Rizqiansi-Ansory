<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends PIS_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_slider','slider');  
    }

    public function index(){
        $data['codepage']     = "back_slider";
        $data['page_title']   = 'Slider';
        $data['slider']       = $this->slider->getAllSliderAdmin()->result_array();
        $this->template->back_views('site/back/slider',$data);
    }
    public function create(){
        if(isset($_POST['submit'])){
            $config['upload_path']='./assets/img/content/slider/';
            $config['allowed_types']='jpg|png|ico';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            if($this->upload->do_upload('img'))
            {
                $img='img/content/slider/';
                $img.=  $this->upload->data('file_name');
            }
            $data = array(
                'id_user'           => $_SESSION['id'],
                'title'             => $_POST['title'],
                'url'               => $_POST['url'],
                'status'            => $_POST['status'],
                'img_path'          => @$img,
                'sort'              => $_POST['sort'],  
                'created_at'        => date('Y-m-d H:m:s')
            );
            $this->slider->create($data);
            redirect(base_url('admin/Slider'),'refresh');
        }
        $data['codepage']       = "back_slider_detail";
        $data['page_title']     = "Slider Baru";
        $this->template->back_views('site/back/SliderDetail',$data);   
    }
    public function detail($id){
        if(isset($_POST['submit'])){
            $config['upload_path']='./assets/img/content/slider/';
            $config['allowed_types']='jpg|png|ico';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            if($this->upload->do_upload('img'))
            {
                $img='img/content/slider/';
                $img.=  $this->upload->data('file_name');
                $data = array(
                    'id_user'           => $_SESSION['id'],
                    'title'             => $_POST['title'],
                    'url'               => $_POST['url'],
                    'status'            => $_POST['status'],
                    'img_path'          => @$img,
                    'sort'              => $_POST['sort'],  
                    'created_at'        => date('Y-m-d H:m:s')
                );
            }
            $data = array(
                'id_user'           => $_SESSION['id'],
                'title'             => $_POST['title'],
                'url'               => $_POST['url'],
                'status'            => $_POST['status'],
                'sort'              => $_POST['sort'],  
                'created_at'        => date('Y-m-d H:m:s')
            );
            $this->slider->update($data,$id);
            redirect(base_url('admin/Slider'),'refresh');
        }
        $data['codepage']       = "back_slider_detail";
        $data['page_title']     = "Perbarui Slider";
        $data['slider']         = $this->slider->getDetailById($id)->row_array();
        $this->template->back_views('site/back/SliderDetail',$data); 
    }
    public function deleted($id){
        return $this->slider->deleted($id);        
    }

}

/* End of file Slider.php */
