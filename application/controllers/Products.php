<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ProductModel');
    $this->load->model('WishModel');
    $this->load->library('Helpers');
  }

	public function index()
	{
		$this->load->view('header');

    $data["product_code"] = $this->helpers->createProductCards($this->ProductModel->getProducts(!$this->isAdmin()),
      ($this->SESSION ? $this->WishModel->getWishList($this->SESSION->customerNumber) : null));

    $this->load->view('products', $data);
    $this->load->view('footer');
	}

  public function view($product_id)
  {
    $this->load->view('header');

    $data["product"] = $this->ProductModel->getProduct($product_id);
    $data["wishlist"] = $this->SESSION ?
      $this->WishModel->getWishList($this->SESSION->customerNumber) : null;

    $this->load->view('product', $data);
    $this->load->view('footer');
  }

  public function search($search_value){
    $this->load->view('header');

    $data["product_code"] = $this->helpers->createProductCards($this->ProductModel->findProduct($search_value),
      $this->SESSION ? $this->WishModel->getWishList($this->SESSION->customerNumber) : null);

    $this->load->view('products', $data);
    $this->load->view('footer');
  }

  public function edit($product_id){
    if($this->isAdmin()){
      $this->load->view('header');

      $data["product"] = $this->ProductModel->getProduct($product_id);

      $this->load->view('editproduct', $data);
      $this->load->view('footer');
    }else
      $this->view($product_id);
  }

  public function editproduct(){
    if($this->isAdmin()){
      $this->load->view('header');

      $inputs = array("product_name" => "Product Name|productName",
                      "product_line" => "Product Line|productLine",
                      "product_vendor" => "Product Vendor|productVendor",
                      "product_description" => "Product Description|productDescription",
                      "product_stock" => "Product Stock|quantityInStock",
                      "product_buy_price" => "Buy Price|buyPrice",
                      "product_price" => "MSRP|MSRP",
                      "product_code" => "Product Code|productCode",
                      "available" => "Product Availability|available");

      $nproduct = $this->helpers->createPostObject($inputs);
      $nproduct["available"] = $nproduct["available"] == "on" ? 1 : 0;

      $pathToFile = $this->uploadAndResizeFile();
  		$this->createThumbnail($pathToFile);
      $nproduct["image"] = $_FILES['userfile']['name'];

      if(empty($nproduct["productCode"])){
        $nproduct["productCode"] = "S" . rand (0,100) . '_' . rand(1000, 100000);
        $this->ProductModel->addProduct($nproduct);
        $data["message"] = "Product added successfully.";
      }else{
        $this->ProductModel->updateProduct($nproduct);
        $data["message"] = "Product updated successfully.";
      }

      $data["product"] = $this->ProductModel->getProduct($nproduct["productCode"]);

      $this->load->view('editproduct', $data);
      $this->load->view('footer');
    }else
      redirect(site_url("products"));
  }

  public function add(){
    if($this->isAdmin()){
      $p = new stdClass();
      $p->productCode = "";
      $p->productName = "";
      $p->image = "noimage.jpg";
      $p->MSRP = "";
      $p->productLine = "";
      $p->productVendor = "";
      $p->buyPrice = "";
      $p->quantityInStock = "";
      $p->productDescription = "";
      $p->available = "";
      $data["product"] = array($p);

      $this->load->view('header');
      $this->load->view('editproduct', $data);
      $this->load->view('footer');
    }else
      redirect(site_url("products"));
  }

  function uploadAndResizeFile()
	{
		$config['upload_path']='./assets/images/products/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']='10000';
		$config['max_width']='10000';
		$config['max_height']='10000';

		$this->load->library('upload',$config);
		if (!$this->upload->do_upload('userfile'))
      echo $this->upload->display_errors();

		$upload_data = $this->upload->data();
		$path = $upload_data['full_path'];

		$config['source_image']=$path;
		$config['maintain_ratio']='FALSE';
		$config['width']='180';
		$config['height']='200';

		$this->load->library('image_lib',$config);
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();

		$this->image_lib->clear();
		return $path;
	}

	function createThumbnail($path)
	{
		$config['source_image']=$path;
		$config['new_image']='./assets/images/thumbs/';
		$config['maintain_ratio']='FALSE';
		$config['width']='42';
		$config['height']='42';

		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
	}
}
