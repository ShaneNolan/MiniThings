<?php
class CartModel extends CI_Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getCart($id){
    $this->db->select("productCode, quantity");
		$this->db->from('carts');
		$this->db->where('customerNumber', $id);
    $this->db->where('paid', 0);
		return $this->db->get()->result();
  }

  function addToCart($item){
    $opt;
    if($this->checkCart($item["productCode"], $item["customerNumber"])){
      $this->db->where("productCode", $item["productCode"])
               ->where("customerNumber", $item["customerNumber"]);
      $this->db->delete('carts');
      $opt = false;
    } else {
      $this->db->insert('carts', $item);
      $opt = true;
    }
    return $opt;
  }

  private function checkCart($product_id, $customer_id){
    $this->db->select("id");
    $this->db->from('carts');
    $this->db->where('customerNumber', $customer_id)
             ->where('productCode', $product_id);
    $query = $this->db->get();
    return empty($query->result()) ? false : true;
  }

  function addOrder($order){
    $this->db->insert('orders', $order);
    if($this->db->affected_rows() == 1)
      return $this->db->insert_id();
    else
      return false;
  }

  function addOrderDetails($orderid, $cart, $customernumber){
    foreach($cart as $prod){
      $order["orderNumber"] = $orderid;
      $order["productCode"] = $prod->productCode;
      $order["quantityOrdered"] = $prod->quantity;
      $order["priceEach"] = $prod->buyPrice;
      $this->db->insert('orderdetails', $order);

      $this->db->set('quantityInStock', 'quantityInStock-' . $prod->quantity, FALSE);
      $this->db->where('productCode', $prod->productCode);
      $this->db->update('products');

      $item["productCode"] = $prod->productCode;
      $item["customerNumber"] = $customernumber;
      $this->addToCart($item);
    }
  }

}
?>
