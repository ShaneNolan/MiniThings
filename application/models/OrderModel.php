<?php
class OrderModel extends CI_Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getOrderJoin($id){
    $this->db->select("orderdetails.productCode, products.productName,
      orders.requiredDate, orders.comments, orderdetails.quantityOrdered,
      orderdetails.priceEach");
		$this->db->from('orders');
		$this->db->where('orders.orderNumber', $id);
    $this->db->join('orderdetails', 'orderdetails.orderNumber = orders.orderNumber');
    $this->db->join('products', 'orderdetails.productCode = products.productCode');
		$query = $this->db->get();

    if($query)
      return $query->result();
		return false;
  }

  function getOrders($id){
    $this->db->distinct();
    $this->db->select('orderNumber, orderDate, shippedDate, status');
    $this->db->from('orders');
    $this->db->where('customerNumber', $id);
    $this->db->order_by('orderNumber', 'desc');
    return $this->db->get()->result();
  }

  function getAllOrders(){
    $this->db->distinct();
    $this->db->select('orderNumber, orderDate, shippedDate, status');
    $this->db->from('orders');
    $this->db->order_by('orderNumber', 'desc');
    return $this->db->get()->result();
  }

  function getOrder($id){
    $this->db->select("orderdetails.productCode, products.productName,
      orders.requiredDate, orders.comments, orderdetails.quantityOrdered,
      orderdetails.priceEach, orders.status");
		$this->db->from('orders');
		$this->db->where('orders.orderNumber', $id);
    $this->db->join('orderdetails', 'orderdetails.orderNumber = orders.orderNumber');
    $this->db->join('products', 'orderdetails.productCode = products.productCode');

    return $this->db->get()->result();
  }

  function editOrder($order){
    $this->db->where('orderNumber', $order["orderNumber"]);
    $this->db->where('productCode', $order["productCode"]);
  	return $this->db->update('orderdetails', $order);
  }

  function editOrderAdmin($order){
    $this->db->where('orderNumber', $order["orderNumber"]);
  	return $this->db->update('orders', $order);
  }
}
?>
