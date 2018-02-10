<?php
class ProductModel extends CI_Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getProducts($is_customer){
    $this->db->select("productCode, productName, image");
    if($is_customer)
      $this->db->where('available', 0);
    $this->db->from('products');
    $query = $this->db->get();
    return $query->result();
  }

  function getProduct($product_id){
    $this->db->select("*");
		$this->db->from('products');
		$this->db->where('productCode', $product_id);
		$query = $this->db->get();
		return $query->result();
  }

  function findProduct($search_value){
    $this->db->select("*");
    $this->db->from('products');
    $this->db->like('productName', $search_value);
    $this->db->or_like('productLine', $search_value);
    $this->db->or_like('productVendor', $search_value);
    $this->db->or_like('productDescription', $search_value);
    return $this->db->get()->result();
  }

  function updateProduct($product){
    $this->db->where('productCode', $product["productCode"]);
  	return $this->db->update('products', $product);
  }

  function randomProducts(){
    $this->db->select('productCode, productName, productDescription, image');
    $this->db->from('products');
    $this->db->where('image !=', 'noimage.jpg');
    $this->db->order_by('productName', 'RANDOM');
    $this->db->limit(4);
    return $this->db->get()->result();
  }

  function addProduct($product){
    $this->db->insert('products', $product);
    if ($this->db->affected_rows() == 1)
      return true;

    return false;
  }
}
?>
