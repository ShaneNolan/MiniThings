<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wish extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('WishModel');
    $this->load->model('ProductModel');
    $this->load->library('Helpers');
  }

	public function index()
	{
    if(!$this->session->userdata('logged_in'))
      redirect('Login');
    else{
      $this->load->view('header');

      $data["wishproducts"] = array();
      foreach($this->WishModel->getWishList($this->SESSION->customerNumber) as $wish)
        array_push($data["wishproducts"], $this->ProductModel->getProduct($wish->PRODUCT_ID)[0]);

      $data["wish_code"] = $this->helpers->createProductCards($data["wishproducts"],
        $this->SESSION ? $this->WishModel->getWishList($this->SESSION->customerNumber) : null,
        $this->img_base, empty($this->SESSION) ? false : true);

      $this->load->view('wish', $data);
      $this->load->view('footer');
    }
	}

  public function addWish($product_id = null){
    if(is_null($product_id))
      redirect('Home');
    if($this->SESSION){
      $wish["CUSTOMER_ID"] = $this->SESSION->customerNumber;
      $wish["PRODUCT_ID"] = $product_id;
      $this->WishModel->addWish($wish);
    }
  }
}
