<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid ">
  <table class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Shipped Date</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
              <th>Order Number</th>
              <th>Order Date</th>
              <th>Shipped Date</th>
              <th>Status</th>
              <th>Options</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($orders as $order){
              echo '<tr><td>' . $order->orderNumber . '</td><td>' .
                  $order->orderDate . '</td><td>' .$order->shippedDate . '</td><td>' .
                  $order->status . '</td><td><a href="' . site_url("orders/view/") .
                  $order->orderNumber . '">View</a> ';
              if($admin)
                echo '<a href="' . site_url("orders/adminedit/") . $order->orderNumber . '">Amend</a></td></tr>';
              elseif($order->status != "Shipped")
                echo '<a href="' . site_url("orders/edit/") . $order->orderNumber . '">Amend</a></td></tr>';
          }
          ?>
        </tbody>
    </table>
  </div>
</div>
