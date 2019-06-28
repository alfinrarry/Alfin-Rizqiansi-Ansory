<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends PIS_Controller {

  public function index()
  {
    $data['codepage'] = "back_page";
    $this->template->back_views('site/back/page',$data);
  }

}

/* End of file Controllername.php */
