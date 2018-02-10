<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
      <form action="<?php echo site_url('products/editproduct'); ?>" method="POST" class="mdl-card mdl-cell mdl-cell--12-col mdl-shadow--2dp" enctype="multipart/form-data">
        <span class="text-center mdl-card__subtitle-text"><?php echo isset($message) ? $message : "" ?></span>
      <figure class="mdl-card__media">
        <input type="file" name="userfile" id="productimage">
        <div class="product_image" id="product_image" style="background-image: url('<?php echo $this->img_base . "products/" . $product[0]->image; ?>')"></div>
        <p id="product_image_message" class="mdl-card__title-text">Click to Upload a Product Image</p>
      </figure>
      <div class="mdl-card__title mdl-card--border">
        <input type="text" placeholder="Product Name" name="product_name" class="mdl-card__title-text no-border" style="width:40%;" value="<?php echo $product[0]->productName; ?>"></input>
        <div class="mdl-layout-spacer"></div>
        <h3 class="mdl-card__title-text">Price €: </h3>
        <input type="number" step="any" name="product_price" name="product_price" class="mdl-card__title-text no-border" style="width: 8%;" value="<?php echo $product[0]->MSRP; ?>"></input>
      </div>
      <div class="mdl-card__title mdl-card--border">
        <input type="text" placeholder="Product Line" name="product_line" class="mdl-card__title-text no-border" style="width:40%" value="<?php echo $product[0]->productLine ?>"></input>
        <div class="mdl-layout-spacer"></div>
        <input type="text" placeholder="Product Vendor" name="product_vendor" class="mdl-card__title-text no-border" style="width:40%" value="<?php echo $product[0]->productVendor;?>"></input>
      </div>
      <div class="mdl-card__title mdl-card--border">
        <input type="text" placeholder="Buy Price" name="product_buy_price" class="mdl-card__title-text no-border" style="width:40%" value="<?php echo $product[0]->buyPrice ?>"></input>
        <div class="mdl-layout-spacer"></div>
        <input type="text" placeholder="Quantity In Stock" name="product_stock" class="mdl-card__title-text no-border" style="width:40%" value="<?php echo $product[0]->quantityInStock;?>"></input>
      </div>
      <div class="mdl-card__supporting-text">
        <textarea placeholder="Product Description" name="product_description" class="mdl-card__subtitle-text no-border" style="width:100%;"><?php echo $product[0]->productDescription; ?></textarea>
      </div>
      <div class="mdl-card__supporting-text">
        <p style="display:inline;"><i class="material-icons">lock_outline</i> Make product unavailable</p>
        <input type="checkbox" name="available" class="checkbox" <?php echo $product[0]->available ? 'checked' : ''; ?> style="margin-left: -280px;">
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <p id="update-note" class="mdl-card__subtitle-text">Click on a element above to add/update its value, finalise by clicking the pencil icon.</p>
        <?php echo strpos(strtolower(current_url()), "edit") ? '<a href="' . site_url() . '/products/view/' . $product[0]->productCode . '"><button type="button" class="mdl-button mdl-button--icon mdl-button--colored right-card"><i class="material-icons">forward</i></button></a>' : ''; ?>
        <button type="submit" class="mdl-button mdl-button--icon mdl-button--colored right-card"><i class="material-icons">mode_edit</i></button>
      </div>
      <input type="hidden" name="product_code" value="<?php echo $product[0]->productCode; ?>"></input>
    </form>
  </div>
</main>
</div>
