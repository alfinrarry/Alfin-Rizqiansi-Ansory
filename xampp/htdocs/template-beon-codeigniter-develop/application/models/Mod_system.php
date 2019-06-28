<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_system extends CI_Model {

  protected $site             = 'em_sites';
  protected $site_address     = 'em_site_addresses';
  protected $site_conf        = 'em_site_confs';
  protected $site_img_default = 'em_site_img_defaults';
  protected $site_bank        = 'em_site_banks';
  protected $site_payment     = 'em_site_payments';
  protected $site_rest        = 'em_site_rests';
  protected $site_visitor        = 'em_site_visitors';
  protected $homepage         = 'em_site_homepages';
  public function getData()
  {
    $this->db->select($this->site.'.*,'.$this->site_address.'.*');
    $this->db->from($this->site);
    $this->db->join($this->site_address, $this->site_address.'.id = '.$this->site.'.id');
    $this->db->order_by($this->site.'.id', 'desc');
    $this->db->limit(1); 
    return $this->db->get();
  }
  public function getConf(){
    $this->db->select('*');
    $this->db->from($this->site_conf);
    $this->db->order_by('id', 'desc');
    $this->db->limit(1); 
    return $this->db->get();
  }
  public function getDefaultImage(){
    return $this->db->get($this->site_img_default, 1);
  }
  public function getPayment(){
    $this->db->where('status', 1);
    $this->db->where('deleted_at', null);
    return $this->db->get($this->site_payment);   
  }
  public function getRest(){
    $this->db->where('id', 1);
    return $this->db->get($this->site_rest);  
  }
  public function mg_send($email, $subject, $message) {

		$from="officialpasarmbois@gmail.com";
		$nama="PasarMbois";
		$ch = curl_init();

	// $domain = 'sandbox668e327dfe40402bb7ea1664206ffee2.mailgun.org';
		$domain = 'penidatrip.com';

		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	// curl_setopt($ch, CURLOPT_USERPWD, 'api:'.'key-264f3a7d772ec865e54fa92523230178');
		curl_setopt($ch, CURLOPT_USERPWD, 'api:'.'key-264f3a7d772ec865e54fa92523230178');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$plain = $message;
		$from = $nama . ' <' . $from . '>';

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => $from,
			'to' => $email,
			'subject' => $subject,
			'html' => $message,
			'text' => $plain));

		$j = json_decode(curl_exec($ch));
		$info = curl_getinfo($ch);

		if($info['http_code'] != 200) {
        // error("Fel 313: Vänligen meddela detta via E-post till support@".$domain);
		}

		curl_close($ch);
		return $j;
  }
  public function getChartVisitor()
	{
		$query = $this->db->query('SELECT MONTHNAME(g.created_at) as month, MONTH (g.created_at) as monthnum, YEAR(g.created_at) as year,
		 COUNT(g.id) as count,
		 COUNT(g.id) +
		 (
		  SELECT COUNT(t.id)
		  FROM '.$this->site_visitor.' t
		  WHERE t.created_at < g.created_at
		 ) 
		 AS accumulate
		  FROM     (
			SELECT id, created_at
			from '.$this->site_visitor.'
			WHERE created_at > DATE_SUB(now(), INTERVAL 6 MONTH)
		  ) g
		 GROUP BY MONTHNAME(g.created_at)
     ORDER BY YEAR, MONTHNUM');
     return $query->result();
  }
  public function homePage(){
    return  $this->db->get($this->homepage, 1);
  }
  public function updateHomePage($cb,$bs,$cc,$cr)
  {
    $data = array(
      'cb_title'        => $_POST['cb_title'],
      'cb_desc'         => $_POST['cb_desc'],
      'cb_id_category'  => $_POST['cb_id_category'],
      'cc_title'        => $_POST['cc_title'],
      'cc_desc'         => $_POST['cc_desc'],
      'cc_id_category'  => $_POST['cc_id_category'],
      'cr_title'        => $_POST['cr_title'],
      'cr_desc'         => $_POST['cr_desc'],
      'cr_id_category'  => $_POST['cr_id_category'],
      'bs_title'        => $_POST['bs_title'],
      'bs_desc'         => $_POST['bs_desc']
    );

    if($cb !=null){
      $data ['cb_img_path'] = @$cb;
    }
    if($bs !=null){
      $data ['bs_img_path'] = @$bs;
    }
    if($cc !=null){
      $data ['cc_img_path'] = @$cc;
    }
    if($cr !=null){
      $data ['cr_img_path'] = @$cr;
    }      
    $this->db->set($data);
    $this->db->where('id', 1);
    $this->db->update($this->homepage);
  }
  public function updateRest($data){
    $this->db->set($data);
    $this->db->where('id',1);
    $this->db->update($this->site_rest);
  }

}

/* End of file Mod_system.php */
