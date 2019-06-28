<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends PIS_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_address','address');
    }
    
    public function userAddress(){
        $data['codepage']		= "profile_address";
        $data['page_title'] 	= 'Address';
        if($this->session->userdata('id')){ 
            $data['address']    = $this->address->getAddressByUser($_SESSION['id'])->result_array();
            $this->template->front_views('site/front/userAddress', $data);  
        }else{    
            redirect('Home');      
        }
    }
    public function newAddress()
    {
        $data['codepage']       = "profile_address_add";
        $data['page_title']     = "Add Address";
        $data['province']       = rajaongkir('province');
        if($this->session->userdata('id')){ 
            if(isset($_POST['submit'])){
                $data_address = array(
                    'id_user'           => $_SESSION['id'],
                    'title_address'     => $_POST['title'],
                    'name'              => $_POST['name'],
                    'phone'             => $_POST['phone'],
                    'id_province'       => $_POST['id_province'],
                    'id_city'           => $_POST['id_city'],
                    'id_subdistrict'    => $_POST['id_district'],
                    'province'          => $_POST['province_name'],
                    'city'              => $_POST['city'],
                    'subdistrict'       => $_POST['subdistrict'],
                    'zip_code'          => $_POST['zip_code'],
                    'complete_address'  => $_POST['complete_address'],
                    'primary'           => 0,
                    'created_at'        => date("Y-m-d h:i:s")                    
                );
                $ticket = $this->address->created($data_address);
                if ($ticket) {
                    $this->session->set_flashdata('success_msg', 'Tambah Alamat berhasil');
                }else{
                    $this->session->set_flashdata('fail_msg', 'Tambah Alamat gagal');
                }
                redirect(base_url('User/'.getUser($_SESSION['id'])['username'].'/address'));
            }else{
                $this->template->front_views('site/front/userAddress', $data);  
            }  
        }else{    
            redirect('Home');      
        }
        
    }
    public function getCity(){
        $params='city?province='.$_POST['id_province'];
        $data= rajaongkir($params);
        
        echo '<option value="">Pilih Kota</option>';
        foreach ($data as $k) {
            echo "<option value=".$k->city_id.">".$k->type." ".$k->city_name." </option>";
        }
    }
      
    public function getSubdistrict(){
        $params='subdistrict?city='.$_POST['id_city'];
        $data= rajaongkir($params);
        echo '<option value="">Pilih Kecamatan</option>';
        foreach ($data as $k) {
            echo "<option value=".$k->subdistrict_id.">".$k->subdistrict_name." </option>";
        }
    }
    public function setPrimary($id){
        $this->address->setAddressNull();
        $this->address->setPrimary($id);
    }
    public function delAddress($id){
        $this->address->delAddress($id);
    }
      

}

/* End of file Address.php */
