<main class="mdl-layout__content mdl-color--grey-100">
  <div style="margin-top: 10px; padding-right:10px; text-align: right;">
    <span class="mdl-card__subtitle-text"><?php echo isset($message) ? $message : "" ?></span>
  </div>
  <div class="mdl-grid" style="clear:both">
  <table class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Delivered</th>
                <th>Comments</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Amend</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Delivered</th>
              <th>Comments</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Amend</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($order as $ord){
            echo '<form method="POST" action="' . site_url("orders/amend/") . $orderid . "/"
                  . $ord->productCode . '">';
            echo '<tr><td>' . $ord->productCode . '</td><td>' .
                  $ord->productName . '</td><td>' .$ord->requiredDate . '</td><td>' .
                  (empty($ord->comments) ? "..." : $ord->comments) . '</td><td><input
                  style="width:30%" type="number" name="quantity" value="' . $ord->quantityOrdered . '"></input>
                  </td><td>' . ($ord->quantityOrdered * $ord->priceEach) . '</td><td>
                  <button class="mdl-button" type="submit"><i class="material-icons
                  right">edit</i></button></td></tr>';
            echo '</form>';
          }
          ?>
        </tbody>
    </table>
  </div>
</div>
