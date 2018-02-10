<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('CartModel');
    $this->load->model('ProductModel');
    if(!$this->SESSION)
      redirect('Login');
  }

	public function index()
	{
    $this->load->view('header');

    $data["cartproducts"] = $this->getUserCart();

    $this->load->view('cart', $data);
    $this->load->view('footer');
	}

  private function getUserCart(){
    $data["cartproducts"] = array();
    foreach($this->CartModel->getCart($this->SESSION->customerNumber) as $prod){
      $product = $this->ProductModel->getProduct($prod->productCode)[0];
      $product->quantity = $prod->quantity;
      array_push($data["cartproducts"], $product);
    }
    return $data["cartproducts"];
  }

  public function addRemove($product_code){
    if(is_null($product_code))
      redirect('Home');

    $item["customerNumber"] = $this->SESSION->customerNumber;
    $item["productCode"] = $product_code;
    $result = $this->CartModel->addToCart($item);
    if($result)
      $data["message"] = "Adding to cart . . .";
    else
      $data["message"] = "Removing from cart . . .";
    $this->load->view('header');
    $this->load->view('loading', $data);
    $this->load->view('footer');
    header('Refresh: 1; URL=' . $_SERVER['HTTP_REFERER']);
  }

  public function checkout(){
    $cart = $this->getUserCart();
    if(!empty($cart)){
      $order["orderDate"] = date("Y-m-d");
      $order["status"] = "In Process";
      $order["customerNumber"] = $this->SESSION->customerNumber;

      $orderid = $this->CartModel->addOrder($order);
      $this->CartModel->addOrderDetails($orderid, $cart, $order["customerNumber"]);
      $this->load->view('header');
      $data["message"] = "Processing your order . . .";
      $this->load->view('loading', $data);
      $this->load->view('footer');
      header('Refresh: 2; URL=' . site_url("orders"));
    }else
      redirect('cart');
  }
}
