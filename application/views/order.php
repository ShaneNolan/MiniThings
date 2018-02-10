<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
  <table class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Delivered</th>
                <th>Comments</th>
                <th>Quantity</th>
                <th>Total</th>
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
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($order as $ord){
            echo '<tr><td>' . $ord->productCode . '</td><td>' .
                  $ord->productName . '</td><td>' .$ord->requiredDate . '</td><td>' .
                  (empty($ord->comments) ? "..." : $ord->comments) . '</td><td>' .
                  $ord->quantityOrdered . '</td><td>' .
                  ($ord->quantityOrdered * $ord->priceEach) . '</td></tr>';
          }
          ?>
        </tbody>
    </table>
  </div>
</div>
