<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
  <table class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Product Code</th>
                <th>Order Date</th>
                <th>Shipped Date</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
              <th>Order Number</th>
              <th>Product Code</th>
              <th>Order Date</th>
              <th>Shipped Date</th>
              <th>Status</th>
              <th>Quantity</th>
              <th>Total</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($orders as $order){
            echo '<tr><td>' . $order->orderNumber . '</td><td><a href="' . site_url("products/view/") .
                  $order->productCode . '">' . $order->productCode . '</a></td><td>' .
                  $order->orderDate . '</td><td>' .$order->shippedDate . '</td><td>' .
                  $order->status . '</td><td>' . $order->quantityOrdered . '</td><td>' .
                  $order->priceEach * $order->quantityOrdered . '</td></tr>';
          }
          ?>
        </tbody>
    </table>
  </div>
</div>
