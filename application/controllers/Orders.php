<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('OrderModel');
    $this->load->library('Helpers');
    if(!$this->SESSION)
      redirect('home');
  }

	public function index()
	{
		$this->load->view('header');
    if($this->isAdmin())
      $data["orders"] = $this->OrderModel->getAllOrders();
    else
      $data["orders"] = $this->OrderModel->getOrders($this->SESSION->customerNumber);
    $data["admin"] = $this->isAdmin();
    $this->load->view('orders', $data);
    $this->load->view('footer');
	}

  public function view($id){
    $this->load->view('header');
    $data["order"] = $this->OrderModel->getOrderJoin($id);
    $this->checkDelivered($data);
    $this->load->view('order', $data);
    $this->load->view('footer');
  }

  public function edit($orderid, $message = null){
    $this->load->view('header');
    $data["order"] = $this->OrderModel->getOrder($orderid);
    if($this->isAdmin() || $data["order"][0]->status != "Shipped"){
      $this->checkDelivered($data);
      $data["orderid"] = $orderid;
      $data["message"] = $message;
      $this->load->view('editorder', $data);
      $this->load->view('footer');
    }else
      redirect(site_url("orders"));
  }

  public function adminedit($orderid, $message = null){
    $this->load->view('header');
    if($this->isAdmin()){
      $data["order"] = $this->OrderModel->getOrder($orderid);
      $this->checkDelivered($data);
      $data["orderid"] = $orderid;
      $data["message"] = $message;
      $this->load->view('admineditorder', $data);
      $this->load->view('footer');
    }else
      redirect(site_url("orders"));
  }

  private function checkDelivered(&$item){
    foreach($item["order"] as $i){
      if($i->requiredDate == "0000-00-00")
        $i->requiredDate = "Not delivered";
    }
  }

  public function amend($orderNumber, $productCode){
    $order["quantityOrdered"] = $this->input->post("quantity", true);
    $order["orderNumber"] = $orderNumber;
    $order["productCode"] = $productCode;
    $this->OrderModel->editOrder($order);

    if($this->isAdmin()){
      $admin_order = $this->helpers->createPostObject(array("delivered" => "Delivered Date|requiredDate",
                                                            "comments" => "Comments|comments"));
      $admin_order["orderNumber"] = $orderNumber;
      $this->OrderModel->editOrderAdmin($admin_order);
      $this->adminedit($orderNumber, "Updated " . $productCode . " successfully!");
    }else
      $this->edit($orderNumber, "Updated " . $productCode . " successfully!");
  }
}
