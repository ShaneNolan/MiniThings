<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ProductModel');
    $this->load->model('LoginModel');
  }

	public function index()
	{
		$this->load->view('header');
    if($this->isAdmin()){
      $data["admins"] = $this->LoginModel->getAdmins();
      $this->load->view('admin', $data);
    }else{
      $data["products"] = $this->ProductModel->randomProducts();
      $this->load->view('main', $data);
    }
    $this->load->view('footer');
	}
}
