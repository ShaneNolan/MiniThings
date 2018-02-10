<?php
class WishModel extends CI_Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getWishList($customer_id){
    $this->db->select("PRODUCT_ID");
    $this->db->from('wishlists');
    $this->db->where('CUSTOMER_ID', $customer_id);
    $query = $this->db->get();
    return $query->result();
  }

  private function checkWish($product_id, $customer_id){
    $this->db->select("ID");
    $this->db->from('wishlists');
    $this->db->where('CUSTOMER_ID', $customer_id)
             ->where('PRODUCT_ID', $product_id);
    $query = $this->db->get();
    return empty($query->result()) ? false : true;
  }

  function addWish($wish){
    if($this->checkWish($wish["PRODUCT_ID"], $wish["CUSTOMER_ID"])){
      $this->db->where("PRODUCT_ID", $wish["PRODUCT_ID"])
               ->where("CUSTOMER_ID", $wish["CUSTOMER_ID"]);
      $this->db->delete('wishlists');
    } else
      $this->db->insert('wishlists', $wish);

    if ($this->db->affected_rows() == 1) {
      return true;
    } else {
      return false;
    }
  }
}
?>
