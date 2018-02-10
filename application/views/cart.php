<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <?php
    if(empty($cartproducts)){
      echo '<div class="container"><div style="width: 100%; margin: 20% auto;"><h4 class="text-center">Nothing in your shopping cart :(</h4></div></div>';
    }else{
      foreach($cartproducts as $product){
        echo '<div class="container">
          <div class="card-media">
            <div class="card-media-object-container">
              <div class="card-media-object" style="background-image: url(' . $this->img_base . "products/" . $product->image . ');"></div>' .
              ($product->quantityInStock <= 100 ? '<span class="card-media-object-tag subtle">Low Stock</span>' : '') .
            '</div>
            <div class="card-media-body">
              <div class="card-media-body-top">
                <span class="subtle">' . $product->productName . '</span>
              </div>
              <span class="card-media-body-heading">' . substr($product->productDescription, 0, 120) . '...' . '</span>
              <div class="card-media-body-supporting-bottom">
                <span class="card-media-body-supporting-bottom-text subtle">' . $product->productLine . ' - ' . $product->productVendor . '</span>
                <span class="card-media-body-supporting-bottom-text subtle u-float-right">€' . $product->MSRP . '</span>
              </div>
              <div class="card-media-body-supporting-bottom card-media-body-supporting-bottom-reveal">
                <a href="' . site_url("cart/addRemove/") . $product->productCode . '" style="color:orange" class="card-media-body-supporting-bottom-text card-media-link u-float-left">REMOVE FROM CART</a>
                <a href="' . site_url("products/view/") . $product->productCode . '" class="card-media-body-supporting-bottom-text card-media-link u-float-right">VIEW PRODUCT</a>
              </div>
            </div>
          </div>
        </div>';
      }
    }
    ?>
    <div class="container">
      <a href="<?php echo site_url("cart/checkout/"); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect right-card"><i class="material-icons right">shopping_cart</i>checkout</a>
    </div>
  </div>
</main>
