<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpers {

  private $CI;

  public function __construct(){
    $this->CI =& get_instance();
    $this->CI->load->library('form_validation');
  }

  public function createPostObject($inputs){
    foreach($inputs as $key => $value){
      $val = strtok($value, '|');
      $this->CI->form_validation->set_rules($key, $val, 'trim|required');
      $val = strtok('');
      $object[$val] = $this->CI->input->post($key);
    }
    return $object;
  }

  private function searchWishlist($wishlist, $searchItem){
    if($wishlist == null)
      return false;
    foreach($wishlist as $item){
      if($item->PRODUCT_ID == $searchItem)
        return true;
    }
    return false;
  }

  public function createProductCards($products, $wishlist)
  {
    $product_code = "";
    $counter = 1;
    foreach($products as $product) {
      if($counter == 1) { $product_code .= '<div class="mdl-grid">'; }
      $product_code .= '<div class="mdl-cell mdl-cell--4-col"><div class="product-card-image mdl-card mdl-shadow--2dp';
      switch($counter){
        case 1:
          $product_code .=  '">';
          break;
        case 2:
          $product_code .=  ' center-card">';
          break;
        case 3:
          $product_code .=  ' right-card">';
          break;
      }
      $product_code .=  '<div class="mdl-card__media"><img class="card_product_image" src="' . $this->CI->img_base . "products/" . $product->image .
      '" alt="' . $product->productName . '"></div>';
      $product_code .=  '<div class="mdl-card__actions"><span class="product-card-image__filename">'
      . anchor('Products/' . ($this->CI->isAdmin() ? 'Edit/' : 'View/') . $product->productCode,
      (strlen($product->productName) > 24 ? substr($product->productName, 0, 24) . "..." : $product->productName))
      . '</span>';

      if($this->CI->SESSION && !$this->CI->isAdmin())
        $product_code .= $this->makeWishButton($wishlist, $product->productCode);

      $product_code .= '</div></div></div>';
      $counter++;
      if($counter > 3) { $product_code .=  '</div>'; $counter = 1; }
    }
    if(sizeof($products) % 3 != 0 ) { $product_code .=  '</div>'; }

    return $product_code;
  }

  public function makeWishButton($wishlist, $productCode, $blueheart = false){
    return '<button id="btn_wish" type="button" value="' . $productCode . '" class="mdl-button mdl-button--icon right-card heart-product '
    . ($blueheart ? "blue-heart" : "white-heart") . ($this->searchWishlist($wishlist, $productCode) ? " red-heart" : "") . '"><i class="material-icons">favorite</i></button>';
  }
}
