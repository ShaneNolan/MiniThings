<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
     <div class="mdl-cell mdl-cell--12-col">
          <div class="mdl-card mdl-shadow--2dp demo-card-wide" style="width:100%;">
            <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">
                <?php echo $this->SESSION ? "Welcome back, " . (empty($this->SESSION->contactFirstName) ? "Admin" : $this->SESSION->contactFirstName) : "Helloooo!"; ?></h2>
            </div>
            <div class="mdl-card__supporting-text">
              Mini-things are a Limerick based distribution company who specialise in selling miniature toys (classic cars, planes, motorcycles, trains etc.) from their Raheen operation to toy shops and collectors all over the world.
            </div>
            <div class="mdl-card__actions mdl-card--border">
              <a href="<?php echo site_url('products'); ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                Browse Products
              </a>
              <?php
              if(!$this->SESSION){
              echo '<a href="'. site_url("login") . '" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect right-card">
                  Login
                </a>
                <a href="' . site_url("login/register") . '" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect right-card">
                  Register
                </a>';
              }else{
                echo '<a href="'. site_url("login/logout") . '" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect right-card">
                    Logout
                  </a>';
              }
              ?>
            </div>
            <div class="mdl-card__menu">
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>">
                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">share</i>
              </button></a>
            </div>
          </div>
      </div>
  </div>

  <div class="mdl-grid">
    <?php
    foreach($products as $prod){
      echo '<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
        <div class="mdl-card__media">
          <img style="height: 200px;" src="' . $this->img_base . "products/" .  $prod->image . '">
        </div>
        <div class="mdl-card__title">
           <h4 class="mdl-card__title-text"><a style="text-decoration:none;color:#636363;" href="' . site_url('products/view/') . $prod->productCode . '">' .
           substr($prod->productName, 0, 12) . "..." . '</a></h4>
        </div>
        <div class="mdl-card__supporting-text">
          <span class="mdl-typography--font-light mdl-typography--subhead">'
          . substr($prod->productDescription, 0, 35) . " ..." .
          '</span>
        </div>

        <div class="mdl-card__actions">
          <a href="' . site_url('products/view/') . $prod->productCode . '"class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">link</i>
          </a>
        </div>
      </div>';
    }?>
  </div>
</main>
