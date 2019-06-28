<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('hash_password'))
{
  function hash_password($password) { 
    return password_hash($password, PASSWORD_BCRYPT); 
  } 
}
if ( ! function_exists('count_view_product')) {
	function count_view_product($id){
		$CI =& get_instance();
		$CI->load->model('Mod_product');
		$result = $CI->Mod_product->getView($id);
		return $result;
	}
}
if ( ! function_exists('count_variant_product')) {
	function count_variant_product($id){
		$CI =& get_instance();
		$CI->load->model('Mod_product');
    $result = $CI->Mod_product->getStock($id)->row_array();
    $query = $result['qty'];

		return $query;
	}
}
if ( ! function_exists('slug'))
{
	function slug($s) {

		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
		$s = str_replace($d, '', $s); 
		$s = strtolower(str_replace($c, '-', $s));
		return $s;
	}
}
if ( ! function_exists('rupiah'))
{
	function rupiah($nilai, $pecahan = 0){
		return number_format($nilai, $pecahan, ',', '.');
	}
}
//helper tanggal 
if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;   
	}
}
// bulan
if ( ! function_exists('bulan'))
{
	function getBulan($bln)
	{
		switch ($bln)
		{
			case 1: 
			return "Jan";
			break;
			case 2:
			return "Feb";
			break;
			case 3:
			return "Mar";
			break;
			case 4:
			return "Apr";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Jun";
			break;
			case 7:
			return "Jul";
			break;
			case 8:
			return "Agu";
			break;
			case 9:
			return "Sep";
			break;
			case 10:
			return "Okt";
			break;
			case 11:
			return "Nov";
			break;
			case 12:
			return "Des";
			break;
		}
	}
}
if ( ! function_exists('getUser')) {
	function getUser($id){
		$CI =& get_instance();
		$CI->load->model('Mod_user');
		return $CI->Mod_user->getUser($id)->row_array();
	}
}
if(! function_exists('thumbImgProduct')){
	function thumbImgProduct($id){
		$CI =& get_instance();
		$CI->load->model('Mod_product');
		$result = $CI->Mod_product->getImageThumb($id)->result_array();
		$query = @$result[0]['img_path'];
		return $query;
	}
}
if(! function_exists('imgProduct')){
	function imgProduct($libraries = null){
		$CI =& get_instance();
		$CI->load->model('Mod_product');
		$result = $CI->Mod_product->getImageThumb($id)->result_array();
		$img = @$result['img_path'];
		return $img;
	}
}
if(! function_exists('imgTicket')){
	function imgTicket($id){		
		$CI =& get_instance();
		$CI->load->model('Mod_ticket');
		$result = $CI->Mod_ticket->getFile($id)->result_array();	
		return $result;
	}
}

if(! function_exists('rajaongkir')){
	function rajaongkir($param){
		$CI =& get_instance();
		$CI->load->model('Mod_system');
		$rest = $CI->Mod_system->getRest()->row_array();
		$url= $rest['auth_key'];
		$key= $rest['rest_token'];
		$ch = curl_init(); 
			 // set url 
		curl_setopt($ch, CURLOPT_URL, "$url"."$param"); 
	
			//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('key: ' . $key));
		$server_output = curl_exec ($ch);
		curl_close($ch);
		return json_decode($server_output)->rajaongkir->results;
	}
}
if(! function_exists('cost_rajaongkir')){
	function cost_rajaongkir($destination,$weight,$courier){
		$CI =& get_instance();
		$CI->load->model('Mod_system');
		$rest = $CI->Mod_system->getRest()->row_array();
		$url= $rest['auth_key'];
		$key= $rest['rest_token'];
		$origin=256;
			$ch = curl_init();  
			curl_setopt_array($ch, array(
				CURLOPT_URL => "$url"."cost",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "origin=$origin&originType=city&destination=$destination&destinationType=subdistrict&weight=$weight&courier=$courier",
				CURLOPT_HTTPHEADER => array(
					"content-type: application/x-www-form-urlencoded",
					"key: $key"
					),
				));
			$server_output = curl_exec ($ch);
			// $err = curl_error($ch);
			curl_close($ch);
			// return $err;
			return json_decode($server_output)->rajaongkir->results;
	}

}

if(! function_exists('product')){
	function product($id){		
		$CI =& get_instance();
		$CI->load->model('Mod_product');
		$result = $CI->Mod_product->getProductbyId($id)->row_array();	
		return $result;
	}
}
if(! function_exists('variant')){
	function variant($id){		
		$CI =& get_instance();
		$CI->load->model('Mod_product');
		$result = $CI->Mod_product->getVariantByid($id)->row_array();	
		return $result;
	}
}if(! function_exists('generateNumber')){
	function generateNumber($length = 3) {
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}



	
	
	