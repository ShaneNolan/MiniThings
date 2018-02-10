<?php $in_stock = $product[0]->quantityInStock > 0; ?>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-card mdl-cell mdl-cell--12-col mdl-shadow--2dp">
      <figure class="mdl-card__media">
        <div class="product_image" style="background-image: url('<?php echo $this->img_base . "products/" . $product[0]->image; ?>')"></div>
      </figure>
      <div class="mdl-card__title mdl-card--border">
        <h1 class="mdl-card__title-text"><?php echo $product[0]->productName; ?></h1>
        <div class="mdl-layout-spacer"></div>
        <h3 class="mdl-card__title-text">
        <?php if($in_stock)
            echo 'Price: €' . $product[0]->MSRP;
          else
            echo 'Out Of Stock <span style="font-size:18px; margin: auto;padding-left: 5px;"> :(</span>';
        ?>
        </h3>
      </div>
      <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__subtitle-text"><?php echo $product[0]->productLine . " - "
        . $product[0]->productVendor;?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <p><?php echo $product[0]->productDescription; ?></p>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <?php if($product[0]->available)
          echo '<h2 class="mdl-card__subtitle-text right-card">Product is no longer available</h2>';
          else{
            if(empty($this->SESSION->admin)){
              if($this->SESSION){
                echo '<button id="addToCart" value="' . $product[0]->productCode . '" class="mdl-button mdl-button--icon mdl-button--colored right-card"><i class="material-icons">add_shopping_cart</i></button>';
                echo $this->helpers->makeWishButton($wishlist, $product[0]->productCode, true);
              }
            }
          }?>
      </div>
    </div>
  </div>
</main>
</div>
